<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

    if($admin_permission["auth_apply_registration"] == 0){
		echo '<script>alert("권한이 없습니다.");history.back();</script>';
	}

	$registration_idx = $_GET["idx"];

	$auth = $admin_permission["auth_apply_registration"];
	if($auth == 0){
		echo '<script>alert("권한이 없습니다.")</script>';
		echo '<script>history.back();</script>';
	}
	$is_modify = ($auth >= 2);

	$registration_detail_query =	"
										SELECT
											rr.attendance_type,
											rr.nation_no,
											rr.banquet_yn,
											rr.member_type,
											rr.occupation_type,
											rr.ksso_member_status,
											m.member_idx, m.member_email, m.member_name, m.member_nation,
											DATE(rr.register_date) AS register_date, rr.email AS registration_email, CONCAT(rr.first_name,' ',rr.last_name) AS registration_name, rr.phone,
											rr.affiliation, rr.department, rr.licence_number, rr.specialty_number, rr.nutritionist_number, rr.dietitian_number,rr.academy_number, 
											rr.welcome_reception_yn,
											rr.day2_breakfast_yn,
											rr.day2_luncheon_yn,
											rr.day3_breakfast_yn,
											rr.day3_luncheon_yn,
											rr.special_request_food,
											rr.price,
											IFNULL(rr.status, '1') AS registration_status,
											DATE(p.payment_date) AS payment_date, p.total_price_kr, p.total_price_us, p.refund_reason, DATE_FORMAT(p.refund_date, '%Y-%m-%d') AS refund_date, p.refund_bank, p.refund_holder, p.refund_account, p.refund_amount,
											n.nation_ko AS registration_nation, rr.register_path, rr.conference_info, rr.etc1,
											f.original_name as file_name, CONCAT(f.path,'/',f.save_name) AS file_path,
											(
												CASE rr.registration_type
													#WHEN '2' THEN 'Online + Offline'
													WHEN '1' THEN 'Online'
													WHEN '0' THEN 'On-site'
													ELSE '-'
												END
											) AS registration_type_text,
											(
												CASE rr.attendance_type
													WHEN '0' THEN 'Committee'
													WHEN '1' THEN 'Speaker'
													WHEN '2' THEN 'Chairperson'
													WHEN '3' THEN 'Panel'
													WHEN '4' THEN 'Participants'
													WHEN '5' THEN 'Sponsor'
													WHEN '6' THEN 'Others'
													ELSE '-'
												END
											) AS attendance_type_text,
											(CASE
											    WHEN rr.ksso_member_status = '2'
												THEN 'Member'
												WHEN rr.ksso_member_status = '1'
												THEN 'Member'
												WHEN rr.ksso_member_status = '0'
												THEN 'Non-Member'
												ELSE '-'
											END) AS member_status_text,
											rr.is_score,
											(CASE
												WHEN rr.is_score = 1
												THEN 'Applied'
												WHEN rr.is_score = 0
												THEN 'Not applied'
												ELSE '-'
											END) AS is_score_text,
										    (
											CASE
												WHEN rr.payment_methods = '0' THEN 'Credit card'
												WHEN rr.payment_methods = '1' THEN 'Bank transfer'
												WHEN rr.payment_methods = '2' THEN 'Onsite payment'
												WHEN rr.payment_methods = '3' THEN 'Admin registration'
											END
										    ) AS payment_methods,
											rr.invitation_check_yn, n_visa.nation_ko AS invitation_nation_text, 
											rr.address, rr.address_detail, 
											rr.passport_number, 
											rr.date_of_birth, rr.date_of_Issue, rr.date_of_Expiry, 
											rr.length_of_visit
										FROM request_registration rr
										LEFT JOIN (
											SELECT
												m.idx AS member_idx, m.email AS member_email, CONCAT(m.first_name,' ',m.last_name) AS member_name, n.nation_ko AS member_nation
											FROM member m
											JOIN nation n
												ON m.nation_no = n.idx
											AND m.idx = (
												SELECT 
													register
												FROM request_registration
												WHERE idx = {$registration_idx}
											)
										) AS m
											ON rr.register = m.member_idx
										LEFT JOIN nation n
											ON rr.nation_no = n.idx
										LEFT JOIN payment p
											ON rr.payment_no = p.idx
										LEFT JOIN file f
											ON rr.etc3 = f.idx
										LEFT JOIN nation n_visa
											ON rr.nation_no = rr.invitation_nation_no
										WHERE rr.idx = {$registration_idx}
									";
	$registration_detail = sql_fetch($registration_detail_query);

	//2022-05-11 추가
	$nation_no =  isset($registration_detail["nation_no"]) ? $registration_detail["nation_no"] : "";
	$banquet_yn = isset($registration_detail["banquet_yn"]) ? $registration_detail["banquet_yn"] : "";

	$member_idx = isset($registration_detail["member_idx"]) ? $registration_detail["member_idx"] : "";
	$member_type = isset($registration_detail["member_type"]) ? $registration_detail["member_type"] : "";
	$occupation_type = isset($registration_detail["occupation_type"]) ? $registration_detail["occupation_type"] : "";
	$member_status = isset($registration_detail["ksso_member_status"]) ? $registration_detail["ksso_member_status"] : "";
	$member_email = isset($registration_detail["member_email"]) ? $registration_detail["member_email"] : "";
	$member_name = isset($registration_detail["member_name"]) ? $registration_detail["member_name"] : "";
	$member_nation = isset($registration_detail["member_nation"]) ? $registration_detail["member_nation"] : "";
	$attendance_type = isset($registration_detail["attendance_type"]) ? $registration_detail["attendance_type"] : "";
	//$registration_type = isset($registration_detail["registration_type"]) ? $registration_detail["registration_type"] : "";
	$is_score = isset($registration_detail["is_score"]) ? $registration_detail["is_score"] : "";
	$registration_email = isset($registration_detail["registration_email"]) ? $registration_detail["registration_email"] : "";
	$registration_nation = isset($registration_detail["registration_nation"]) ? $registration_detail["registration_nation"] : "";
	$registration_name = isset($registration_detail["registration_name"]) ? $registration_detail["registration_name"] : "";
	$phone = isset($registration_detail["phone"]) ? $registration_detail["phone"] : "";
	$affiliation = isset($registration_detail["affiliation"]) ? $registration_detail["affiliation"] : "-";
	$department = isset($registration_detail["department"]) ? $registration_detail["department"] : "-";
	$licence_number = isset($registration_detail["licence_number"]) ? $registration_detail["licence_number"] : "-";
	$specialty_number = isset($registration_detail["specialty_number"]) ? $registration_detail["specialty_number"] : "-";
	$nutritionist_number = isset($registration_detail["nutritionist_number"]) ? $registration_detail["nutritionist_number"] : "-";
	$dietitian_number = isset($registration_detail["dietitian_number"]) ? $registration_detail["dietitian_number"] : "-";
	$academy_number = isset($registration_detail["academy_number"]) ? $registration_detail["academy_number"] : "-";
	$registration_status = isset($registration_detail["registration_status"]) ? $registration_detail["registration_status"] : "";
	$payment_date = isset($registration_detail["payment_date"]) ? $registration_detail["payment_date"] : "-";
	$payment_methods = isset($registration_detail["payment_methods"]) ? $registration_detail["payment_methods"] : "-";
	$payment_price = isset($registration_detail["total_price_us"]) ? "$ ".number_format($registration_detail["total_price_us"]) : (isset($registration_detail["total_price_kr"]) ? "￦ ".number_format($registration_detail["total_price_kr"]) : "-");
	$refund_reason = isset($registration_detail["refund_reason"]) ? $registration_detail["refund_reason"] : "";
	$refund_date = isset($registration_detail["refund_date"]) ? $registration_detail["refund_date"] : "-";
	$refund_bank = isset($registration_detail["refund_bank"]) ? $registration_detail["refund_bank"] : "";
	$refund_holder = isset($registration_detail["refund_bank"]) ? $registration_detail["refund_holder"] : "";
	$refund_account = isset($registration_detail["refund_account"]) ? $registration_detail["refund_account"] : "";
    $refund_amount = $registration_detail["refund_amount"] ?? $payment_price;

    // Special Request For Food
    $special_request = $registration_detail["special_request_food"] ?? "";
    $special_request_food = "";
    if($special_request === '0'){
        $special_request_food = "Not Applicable";
    } else if($special_request === '1'){
        $special_request_food = "Vegetarian";
    } else if($special_request === '2'){
        $special_request_food = "Halal";
    } else {
        $special_request_food = "-";
    }

	$register_date = isset($registration_detail["register_date"]) ? $registration_detail["register_date"] : "";
	$register_path = $registration_detail["register_path"] ?? null;
	$etc = $registration_detail["etc1"] ?? null;
	$identification_file = isset($registration_detail["file_name"]) ? $registration_detail["file_name"] : "";
	$identification_file_path = isset($registration_detail["file_path"]) ? $registration_detail["file_path"] : "";

	// 2022 개발 시 워딩 변경
	$registration_type_text = isset($registration_detail["registration_type_text"]) ? $registration_detail["registration_type_text"] : "";
	$is_score_text = isset($registration_detail["is_score_text"]) ? $registration_detail["is_score_text"] : "";
	$member_status_text = isset($registration_detail["member_status_text"]) ? $registration_detail["member_status_text"] : "";
	$attendance_type_text = isset($registration_detail["attendance_type_text"]) ? $registration_detail["attendance_type_text"] : "";
	$invitation_check_yn = isset($registration_detail["invitation_check_yn"]) ? $registration_detail["invitation_check_yn"] : "N";
	$invitation_nation_text = isset($registration_detail["invitation_nation_text"]) ? $registration_detail["invitation_nation_text"] : "";
	$address = isset($registration_detail["address"]) ? $registration_detail["address"] : "";
	$address_detail = isset($registration_detail["address_detail"]) ? $registration_detail["address_detail"] : "";
	$passport_number = isset($registration_detail["passport_number"]) ? $registration_detail["passport_number"] : "";
	$date_of_birth = isset($registration_detail["date_of_birth"]) ? $registration_detail["date_of_birth"] : "";
	$date_of_issue = isset($registration_detail["date_of_Issue"]) ? $registration_detail["date_of_Issue"] : "";
	$date_of_expiry = isset($registration_detail["date_of_Expiry"]) ? $registration_detail["date_of_Expiry"] : "";
	$length_of_visit = isset($registration_detail["length_of_visit"]) ? $registration_detail["length_of_visit"] : "";

	$disabled = $registration_status == "3" ? "" : ($registration_status == "4" ? "" : "disabled");

	// 2023 개발시 파라미터 추가
	$conference_info = isset($registration_detail["conference_info"]) ? $registration_detail["conference_info"] : "";
	$price = isset($registration_detail["price"]) ? $registration_detail["price"] : 0;

	//2022-05-12 추가
	$select_registration_query =	"
										SELECT
											r.*, n.nation_ko, nation_en, f.original_name as file_name, CONCAT(f.path,'/',f.save_name) AS file_path, 
											iep.off_member_usd, iep.off_guest_usd, iep.on_member_usd, iep.on_guest_usd, 
											iep.off_member_krw, iep.off_guest_krw, iep.on_member_krw, iep.on_guest_krw
										FROM request_registration r
										LEFT JOIN nation n
											ON r.nation_no = n.idx
										LEFT JOIN file f
											ON r.etc3 = f.idx
										LEFT JOIN info_event_price AS iep
											ON iep.type_en = r.member_type
										WHERE r.idx = {$registration_idx}
										AND register = '{$member_idx}'
									";


	$registration_data = sql_fetch($select_registration_query);
	$price_col_name = "";
	$price_col_name .= ($attendance_type == 0) ? "off_" : "on_";
	$price_col_name .= ($registration_data["member_status"] == 0) ? "guest_" : "member_";
	$price_col_name .= "usd";
	$us_price = $registration_data[$price_col_name];

	$timenow = date("Y-m-d H:i:s"); 
	//조기 등록 끝
	//$timetarget = "2022-05-20 00:00:00";
	// 사전 등록 끝
	$timetarget = "2022-08-11 00:00:00";

	$str_now = strtotime($timenow);
	$str_target = strtotime($timetarget);

	if($str_now < $str_target || $str_now == $str_target) {

		//if($us_price == 100) {
		//	$us_price = 70;
		//}
		//else if($us_price == 150) {
		//	$us_price = 105;
		//}
		//else if($us_price == 70) {
		//	$us_price = 49;
		//}
		//if($nation_no == 25) {
		//	if($member_status == "NON-MEMBER") {
		//		if($us_price == 70) {
		//			$us_price = 70000;
		//		}
		//	} else {
		//		if($us_price == 70) {
		//			$us_price = 84000;
		//		}
		//	}
		//	if($us_price == 105) {
		//		$us_price = 105000;
		//	}
		//	else if($us_price == 49) {
		//		$us_price = 49000;
		//	}
		//}
		//할인 기간 끝
		if($us_price == 100) {
			$us_price = 90;
		}
		else if($us_price == 150) {
			$us_price = 135;
		}
		else if($us_price == 70) {
			$us_price = 63;
		}
		if($nation_no == 25) {
			//비회원
			if($member_status_text == "Non-Member") {
				if($us_price == 90) {
					$us_price = 90000;
				}
			} else {
				if($us_price == 90) {
					$us_price = 108000;
				}
			}
			if($us_price == 135) {
				$us_price = 135000;
			}
			else if($us_price == 63) {
				$us_price = 63000;
			}
		}
	} else {
		//현장 등록
		if($nation_no == 25) {
			//비회원
			if($member_status_text == "Non-Member") {
				if($us_price == 100) {
					$us_price = 100000;
				}
			} else {
				if($us_price == 100) {
					$us_price = 120000;
				}
			}
			if($us_price == 150) {
				$us_price = 150000;
			}
			else if($us_price == 70) {
				$us_price = 70000;
			}
		}
	}
	

	$attendance_type_no = $attendance_type; 

	if($attendance_type_no != 0) {
		$us_price = 0;
	} 
	
?>
<style>
	.rs2_hidden{display: none;margin-top: 10px;width: calc(100% - 180px);}
	[name=rs2_unit]{width: 30% !important;}
	[name=rs2_price]{width: calc(68% - 10px) !important;margin-left: 10px;}
	.wid_150 {width: 150px !important;}
	.registration_detail_table {margin-bottom:0; border-bottom:none; table-layout:fixed;}
	.registration_detail_table th, .registration_detail_table td {border-bottom:1px solid #ccc;}
	.registration_detail_table th {width:10%;}
	.registration_detail_table td:last-of-type {width:20%;}
	.registration_detail_table + table {border-top:none;}
</style>
	<section class="detail">
		<div class="container">
			<div class="title">
				<h1 class="font_title">Registration</h1>
			</div>
			<div class="contwrap has_fixed_title">
				<h2 class="sub_title">회원 정보</h2>
				<input type="hidden" name="registration_idx" value="<?=$registration_idx?>">
				<table>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<tbody>
						<tr>
							<th>ID(Email)</th>
							<td><a href="./member_detail.php?idx=<?=$member_idx?>"><?=$member_email?></a></td>
							<th>Name / Country</th>
							<td><?=$member_name?> / <?=$member_nation?></td>
						</tr>
						<tr>
							<th>등록일</th>
							<td colspan="3"><?=$register_date?></td>
						</tr>
					</tbody>
				</table>
				<h2 class="sub_title">신청자 정보</h2>
				<table>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<tbody>
						<tr>
							<th>Registration Type</th>
							<td><?=$registration_type_text?></td>
							<th>Applied Review</th>
							<td><?=$is_score_text?></td>
						</tr>
						<tr>
							<th>KSCP Member Status</th>
							<td><?=$member_status_text?></td>
							<th>KSCP Academy number</th>
							<td><?=$academy_number?></td>
						</tr>
						<tr>
							<th>ID(Email)</th>
							<td><?=$registration_email?></td>
							<th>Country</th>
							<td><?=$registration_nation?></td>
						</tr>
						<tr>
							<th>Name</th>
							<td><?=$registration_name?></td>
							<th>Phone Number</th>
							<td><?=$phone?></td>
						</tr>
                        <tr>
                            <th>Attendance type</th>
                            <td colspan="3"><?=$attendance_type_text?></td>
                        </tr>
						<tr>
							<th>Occupation type</th>
							<td><?=$occupation_type?></td>
							<th>Member Type</th>
							<td><?=$member_type?></td>
						</tr>
						<tr>
							<th>Affiliation</th>
							<td><?=$affiliation?></td>
							<th>Department</th>
							<td><?=$department?></td>
						</tr>
						<tr>
							<th>Doctor's Licence Number</th>
							<td><?=$licence_number?></td>
							<th>Specialist's Licence Number</th>
							<td><?=$specialty_number?></td>
						</tr>
						<tr>
							<th>Nutritionist's licence number</th>
							<td><?=$nutritionist_number?></td>
							<th>dietitian_number</th>
							<td><?=$dietitian_number?></td>
						</tr>
                        <tr>
                            <th>Congress Banquet Ceremony</th>
                            <td colspan="3"><?= $banquet_yn=="Y" ? "Attend" : "Absent"; ?></td>
                        </tr>
						<tr>
							<th>Others</th>
							<td colspan="3">
								<div>
									Welcome Reception : <?=$registration_detail["welcome_reception_yn"] == "Y" ? "Yes" : "No"?><br/>
									Day 2 Breakfast Symposium : <?=$registration_detail["day2_breakfast_yn"] == "Y" ? "Yes" : "No"?><br/>
									Day 2 Luncheon Symposium : <?=$registration_detail["day2_luncheon_yn"] == "Y" ? "Yes" : "No"?><br/>
									Day 3 Breakfast Symposium : <?=$registration_detail["day3_breakfast_yn"] == "Y" ? "Yes" : "No"?><br/>
									Day 3 Luncheon Symposium : <?=$registration_detail["day3_luncheon_yn"] == "Y" ? "Yes" : "No"?><br/>
								</div>
							</td>
						</tr>
                        <tr>
                            <th>Special Request for Food</th>
                            <td colspan="3"><?=$special_request_food?></td>
                        </tr>
						<tr>
							<th>Register Path</th>
							<td colspan="3">
							<?php
								echo $register_path;
								if(!empty($etc)){
									echo ' / '.$etc;
								}

								$conference_info_list = explode("*", $conference_info);

								for($a = 0; $a < count($conference_info_list); $a++){
									$ctxt = $conference_info_list[$a];

									if($ctxt){
										echo $ctxt."<br/>";
									}
								}
							?>
							</td>
						</tr>
					</tbody>
				</table>
				<?php
					if ($invitation_check_yn == "Y") {
				?>
				<h2 class="sub_title">비자 관련 정보</h2>
				<table>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<tbody>
						<tr>
							<th>Name of Passport</th>
							<td><?=$invitation_nation_text?></td>
							<th>Country</th>
							<td><?=$invitation_nation_text?></td>
						</tr>
						<tr>
							<th>Address</th>
							<td><?=$address." ".$address_detail?></td>
							<th>Passport Number</th>
							<td><?=$passport_number?></td>
						</tr>
						<tr>
							<th>Date of Birth</th>
							<td><?=$date_of_birth?></td>
							<th>Date of Issue</th>
							<td><?=$date_of_issue?></td>
						</tr>
						<tr>
							<th>Date of Expiry</th>
							<td><?=$date_of_expiry?></td>
							<th>Length of Visit</th>
							<td><?=$length_of_visit?></td>
						</tr>
					</tbody>
				</table>
				<?php
					}
				?>
				<h2 class="sub_title">결제 정보</h2>
				<table class="registration_detail_table">
					<!-- <colgroup>
						<col width="10%">
						<col width="30%">
						<col width="10%">
						<col width="30%">
						<col width="10%">
						<col width="10%">
					</colgroup> -->
					<tbody>
						<!--<tr>
							<th>Online/Offline</th>
							<td><?=$attendance_type?></td>
							<th>참석유형</th>
							<td><?=$registration_type_text?></td>
						</tr>
						<tr>
							<th>평점신청여부</th>
							<td><?=$is_score?></td>
							<th>회원여부</th>
							<td><?=$member_status?></td>
						</tr>
						<tr>
							<th>ID(Email)</th>
							<td><?=$registration_email?></td>
							<th>Country</th>
							<td><?=$registration_nation?></td>
						</tr>
						<tr>
							<th>Name</th>
							<td><?=$registration_name?></td>
							<th>Phone Number</th>
							<td><?=$phone?></td>
						</tr>
						<tr>
							<th>Affiliation</th>
							<td><?=$affiliation?></td>
							<th>Department</th>
							<td><?=$department?></td>
						</tr>
						<tr>
							<th>Doctor’s Licence Number</th>
							<td><?=$licence_number?></td>
							<th>학회번호</th>
							<td><?=$academy_number?></td>
						</tr>
						<tr>
							<th>Register Path</th>
							<td>
							<?php
								echo $register_path;
								if(!empty($etc)){
									echo ' / '.$etc;
								}
							?>
							</td>
							<th>증빙서류</th>
							<?php
								if(!$identification_file) {
									echo "<td>No Data</td>";
								} else {
									$ext = strtolower(end(explode(".",$identification_file)));
							?>
							<?php if($ext == "pdf") { ?>
								<td><a href="./pdf_viewer.php?path=<?=$identification_file_path?>" target="_blank"><?=$identification_file?></a></td>
							<?php } else { ?>
								<td><a href="<?=$identification_file_path?>" download><?=$identification_file?></a></td>
							<?php } ?>
							<?php
								}
							?>
						</tr>-->
						<tr>
							<th>결제상태</th>
							<td class="input_btn_wrap">
								<select name="payment_status">
									<option value="1" <?=$registration_status == 1 ? "selected" : ""?>>Holding</option>
									<option value="2" <?=$registration_status == 2 ? "selected" : ""?>>Payment Received</option>
									<option value="3" <?=$registration_status == 3 ? "selected" : ""?>>Request Cancel</option>
									<option value="4" <?=$registration_status == 4 ? "selected" : ""?>>Canceled</option>
								</select>
								<div class="rs2_hidden">
									<select name="rs2_unit">
										<option>KRW</option>
										<option>USD</option>
									</select>
									<input type="text" name="rs2_price" placeholder="price">
								</div>
								<?php
									if ($is_modify) {
								?>
								<button type="button" class="btn submit" data-type="update_payment_status">저장</button>
								<?php
									}
								?>
							</td>
							<?php
								if ($registration_status == 1) {
							?>
							<th>결제 예정금액</th>
							<td>
								<?= ($nation_no != 25 ) ? "USD ".number_format($price) : "KRW ".number_format($price); ?>
							</td>
							<?php
								} else {
							?>
							<th>결제 방법</th>
                            <td><?=$payment_methods?></td>
						</tr>
						<tr>
                            <th>결제일 / 결제금액</th>
                            <td><?=$payment_date." / ".$payment_price?></td>
                            <?php
                            }
                            ?>
							<th>환불일 / 환불금액</th>
							<!-- <td><?=$refund_date?> / <input type="text" class="" name="refund_amount" placeholder="환불금액"/><button type="button" class="btn submit refund" data-type="update_refund_amount" <?=$disabled?>>저장</button></td> -->
							<td>
								<div class="refund_forms">
									<span><?=$refund_date?> / </span><input type="text" class="refund" name="refund_amount" placeholder="환불금액" value="<?=$refund_amount?>" <?=$disabled?>/>
                                    <?php
                                    if ($is_modify) {
                                    ?>
                                    <button type="button" class="btn submit refund" data-type="update_refund_amount" <?=$disabled?>>저장</button>
                                        <?php
                                    }
                                    ?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<table>
					<colgroup>
						<col width="10%">
						<col width="60%">
						<col width="10%">
						<col width="20%">
					</colgroup>
					<tbody>
						<tr>
							<th>환불받을 계좌</th>
							<td colspan="1">
								<div class="clearfix input_wrap2 flex" style="width:100%;">
									<input type="text" class="refund wid_150" name="refund_bank" placeholder="은행명" value="<?=$refund_bank?>" <?=$disabled?>>
									<input type="text" class="refund wid_150" name="refund_holder" placeholder="예금주" value="<?=$refund_holder?>" <?=$disabled?>>
									<input type="text" class="refund wid_150" name="refund_account" placeholder="계좌번호" value="<?=$refund_account?>" <?=$disabled?>>
									<?php
										if ($is_modify) {
									?>
									<button type="button" class="btn submit refund" data-type="update_refund_info" <?=$disabled?>>저장</button>
									<?php
										}
									?>
								</div>
							</td>
                            <th>환불사유</th>
                            <td class="input_btn_wrap">
                                <input type="text" class="refund" name="refund_reason" maxlength="100" value="<?=$refund_reason?>" <?=$disabled?>>
                                <?php
                                if ($is_modify) {
                                    ?>
                                    <button type="button" class="btn submit refund" data-type="update_refund_reason" <?=$disabled?>>저장</button>
                                    <?php
                                }
                                ?>
                            </td>
						</tr>
					</tbody>
				</table>
				<div class="btn_wrap">
					<button type="button" class="border_btn" onclick="location.href='./registration_list.php'">목록</button>
				</div>
			</div>
		</div>
	</section>
<script>
$(document).ready(function(){
	const reg_status = "<?=$registration_status?>";
	$("select[name=payment_status]").on("change", function(){
		var _this_status = $(this).val();

		if (reg_status == 1 && _this_status == 2) {
			$('.rs2_hidden').css('display', 'inline-block');
		} else {
			$('.rs2_hidden').hide();
		}

		if(_this_status == 3 || _this_status == 4) {
			$(".refund").attr("disabled", false);
		} else {
			$(".refund").attr("disabled", true);
		}
	});

	// 결제 금액 숫자만
	$("input[name=rs2_price]").keyup(function(){
		var _this = $(this);
		if(_this==0) return 0;
		var n = _this.val().toString().replace(/[^0-9]/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		_this.val(n);
	});

	$(".submit").on("click", function(){
		var data = {};
		var submit_type = $(this).data("type");

		var registration_idx = $("input[name=registration_idx]").val();
        var refund_amount = $("input[name=refund_amount]").val();

		if(submit_type == "update_payment_status") {
			if(!$("select[name=payment_status]").val()) {
				alert("결제상태가 선택되지 않았습니다.");
				return false;
			}
			data["payment_status"] = $("select[name=payment_status]").val();

			if (reg_status == 1 && data["payment_status"] == 2) {
				// 금액
				if(!$("input[name=rs2_price]").val()) {
					alert("결제금액이 입력되지 않았습니다.");
					return false;
				} else {
					data["payment_unit"]	= $("select[name=rs2_unit]").val();
					data["payment_price"]	= $("input[name=rs2_price]").val().replace(/[^0-9]/g, "");
				}
			}
		} else if(submit_type == "update_refund_reason") {
			if($("input[name=refund_reason]").val() == "") {
				alert("환불사유가 입력되지 않았습니다.");
				return false;
			}
			data["refund_reason"] = $("input[name=refund_reason]").val();
		} else if(submit_type == "update_refund_info") {
			if($("input[name=refund_bank]").val() == "" || $("input[name=refund_holder]").val() == "" || $("input[name=refund_account]").val() == "") {
                alert("환불받은 계좌 정보를 확인해주세요.");
                return false;
			}
			data["refund_bank"] = $("input[name=refund_bank]").val();
			data["refund_holder"] = $("input[name=refund_holder]").val();
			data["refund_account"] = $("input[name=refund_account]").val();
			
		} else if(submit_type === "update_refund_amount") {
            if(refund_amount===""){
                alert("환불금액이 입력되지 않았습니다.")
                return false;
            }
            data["refund_amount"] = refund_amount;
        }

		if(confirm("입력하신 내용으로 저장하시겠습니까?")) {
			$.ajax({
			url : "../ajax/admin/ajax_payment.php",
			type : "POST",
			data : {
				flag : "update_payment",
				idx : registration_idx,
				type : submit_type,
				data : data
			},
			dataType : "JSON",
			success : function(res){
				if(res.code == 200) {
					alert("저장이 완료되었습니다.");
					window.location.reload();
				} else if(res.code == 400) {
					alert("저장에 실패하였습니다.");
					return false;
				} else if(res.code == 401) {
					alert("결제정보가 존재하지 않아 환불정보 입력에 실패하였습니다.");
					return false;
				} else {
					alert("일시적으로 요청이 거절되었습니다. 잠시 후 다시 시도해주세요.");
					return false;
				}
			}
		});
		}
	});
	
});
</script>
<?php include_once('./include/footer.php');?>