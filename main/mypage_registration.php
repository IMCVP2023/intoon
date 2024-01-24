<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php
    $user_idx = $member["idx"] ?? -1;

	$sql_during =	"SELECT
						IF(DATE(NOW()) >= '2022-09-12', 'Y', 'N') AS yn
					FROM info_event";
	$during_yn = sql_fetch($sql_during)['yn'];

    $currentDateTime = new DateTime(); // 현재 시간을 가져옴
    $targetDateTime = new DateTime('2023-09-09 18:00:00');

	// [22.04.25] 미로그인시 처리
	if($user_idx <= 0) {
		echo "<script>alert('Need to login'); location.replace(PATH+'login.php');</script>";
		exit;
	}

    $nation_list = get_data($_nation_query);
    $select_user_registration_query = "
        SELECT
            reg.idx, reg.banquet_yn, reg.email, reg.nation_no, reg.first_name, reg.last_name, reg.affiliation, reg.phone, reg.department, reg.member_type, DATE(reg.register_date) AS register_date, DATE_FORMAT(reg.register_date, '%m-%d-%Y %H:%i:%s') AS register_date2, reg.status, reg.is_score,
			reg.attendance_type, reg.licence_number, reg.specialty_number, reg.nutritionist_number, reg.dietitian_number,
			reg.conference_info, reg.welcome_reception_yn, reg.day2_breakfast_yn, reg.day2_luncheon_yn, reg.day3_breakfast_yn, reg.day3_luncheon_yn, reg.special_request_food,
			reg.payment_methods, reg.price, nation.nation_en, IF(nation.nation_tel = 82, 1, 0) AS is_korea,
			(
				CASE
					WHEN reg.ksso_member_status IS NULL OR reg.ksso_member_status = 0 THEN 'Non-member'
					WHEN reg.ksso_member_status > 0 THEN 'Member'
				END
			) AS ksso_member_status,
            p.idx AS payment_idx, p.`type` AS payment_type, p.total_price_kr, p.total_price_us,
            p.etc2, DATE_FORMAT(p.register_date, '%Y-%m-%d %H:%i:%s') AS payment_register_date
        FROM request_registration reg
        LEFT JOIN payment p
        ON reg.payment_no = p.idx
		LEFT JOIN (
			SELECT idx, nation_en, nation_tel FROM nation
		)AS nation
		ON reg.nation_no = nation.idx
        WHERE reg.register = {$user_idx}
        AND reg.is_deleted = 'N'
        ORDER BY reg.register_date DESC
    ";

    $registration_list = get_data($select_user_registration_query);

	$sql_event =	"SELECT
						period_event_start,
						period_event_end,
						period_event_pre_end
					FROM info_event AS ie";
	$event = sql_fetch($sql_event);

	$only_sql = "SELECT
					MAX(rr.idx) AS idx
				FROM request_registration AS rr
				LEFT JOIN member AS mb
					ON mb.idx = rr.register
				LEFT JOIN payment AS pa
					ON pa.idx = rr.payment_no
				WHERE rr.register = {$user_idx}
				AND rr.is_deleted = 'N'
				AND rr.`status` = 2
				GROUP BY rr.idx";

	$only_idx = sql_fetch($only_sql)['idx'];

	$score_sql = "SELECT
						*
					FROM score_second
					WHERE mb_idx = '{$user_idx}'";

	$score_detail = sql_fetch($score_sql);

?>
<style>
	/*2022-05-11 ldh 추가*/
	.c_table td:last-of-type, .c_table2 td:last-of-type  {
		text-align:left;
		padding-left:10px;
	}
	.banquet_label {
		padding-right:20px;
	}
</style>
<section class="mypage container">
    <h1 class="page_title">Mypage</h1>
    <div class="inner">
		<ul class="tab_green">
			<li><a href="./mypage.php">Account</a></li>
			<li class="on"><a href="./mypage_registration.php">Registration</a></li>
			<li><a href="./mypage_abstract.php">Abstract</a></li>
			<?php
				//if($during_yn == 'N') {
			?>
				<!-- <li class="text_center"><a href="javascript:;" onclick="javascript:alert('행사 종료 후 9월 12일(월)부터 확인 가능합니다.');">평점 확인 (Korean Only)</a></li> -->
				<!-- <li class="text_center"><a href="javascript:;" onclick="javascript:alert('행사 종료 후 9월 12일(월)부터 확인 가능합니다.');">Certification of Completion</a></li> -->
			<?php
				//}
				//if(!empty($score_detail)) {
			?>
				<!-- <li class="text_center"><a href="./mypage_score.php">평점 확인 (Korean Only)</a></li> -->
			<?php
				//}
				//if(!empty($only_idx)) {
			?>
				<!-- <li class="text_center"><a href="./mypage_certification.php">Certification of Completion</a></li> -->
			<?php
				//} 
			?>
		</ul>
		<!-- 행사끝나고 나서 공개예정 -->
        <?php
        if ($currentDateTime >= $targetDateTime){
        ?>
		<div class="rightT">
			<button class="btn green_btn long mb20 certificate_btn" type="button">Certificate of Attendance</button>
		</div>
        <?php
        }
        ?>
		<div class="table_wrap x_scroll">
			<table class="table_vertical registration_table">
				<thead>
					<tr class="centerT">
						<th>Registration No.</th>
						<th><?=$locale("registration_category")?></th>
						<th><?=$locale("registration_fee")?></th>
						<th>Payment Method</th>
						<th>Payment Status</th>
						<th><?=$locale("management")?></th>
					</tr>
				</thead>
				<tbody>
				<?php

					foreach($registration_list as $list) {
						$register_no = $list["idx"] ? "ICOMES2023-".$list["idx"] : "-";
						$payment_url = "./registration2.php?idx={$list['idx']}";
						$popup_class = "revise_pop_btn";
						$price = $list["total_price_kr"] != "" ? "￦ ".number_format($list["total_price_kr"]) : ($list["total_price_us"] != "" ? "$ ".number_format($list["total_price_us"]) : "-");

						// if($list["status"] != ""){
						// }else{
						//     $status_type = $language == "en" ? "holding" : "결제대기";
						//     $payment_url = "./registration2.php?idx=".$list["idx"];
						//     $popup_class = "";
						//     $disabled = "";
						// }

						// 2023 Registeration 페이지 추가정보
						// Type of Participation
						$attendance_type = $list["attendance_type"] ?? "-";
						switch($attendance_type) {
							case 0:
								$attendance_type = "Committee";
								break;
							case 1:
								$attendance_type = "Invited Speaker";
								break;
							case 2:
								$attendance_type = "Chairperson";
								break;
							case 3:
								$attendance_type = "Panel";
								break;
							case 4:
								$attendance_type = "General Participants";
								break;
                            case 5:
                                $attendance_type = "Sponsor";
                                break;
						}

						// Others
						$welcome_reception_yn = $list["welcome_reception_yn"] ?? "N";
						$day2_breakfast_yn = $list["day2_breakfast_yn"] ?? "N";
						$day2_luncheon_yn = $list["day2_luncheon_yn"] ?? "N";
						$day3_breakfast_yn = $list["day3_breakfast_yn"] ?? "N";
						$day3_luncheon_yn = $list["day3_luncheon_yn"] ?? "N";

                        // Special Requset for Food
                        $special_request = $list["special_request_food"] ?? "";
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

						$other_html = "";

						if($welcome_reception_yn === "Y"){
							$other_html .= "
											<input type='checkbox' class='checkbox' id='other1' disabled>
											<label for='other1'><i></i>Welcome Reception – September 7(Thu)</label>
										   ";
						}
						if($day2_breakfast_yn === "Y"){
							$other_html .= $other_html != "" ? "<br/>" : "";
							$other_html .= "
											<input type='checkbox' class='checkbox' id='other2' disabled>
											<label for='other2'><i></i>Day 2 Breakfast Symposium – September 8(Fri)</label>
										   ";
						}
						if($day2_luncheon_yn === "Y"){
							$other_html .= $other_html != "" ? "<br/>" : "";
							$other_html .= "
											<input type='checkbox' class='checkbox' id='other3' disabled>
											<label for='other3'><i></i>Day 2 Luncheon Symposium – September 8(Fri)</label>
										   ";
						}
						if($day3_breakfast_yn === "Y"){
							$other_html .= $other_html != "" ? "<br/>" : "";
							$other_html .= "
											<input type='checkbox' class='checkbox' id='other4' disabled>
											<label for='other4'><i></i>Day 3 Breakfast Symposium – September 9(Sat)</label>
										   ";
						}
						if($day3_luncheon_yn === "Y"){
							$other_html .= $other_html != "" ? "<br/>" : "";
							$other_html .= "
											<input type='checkbox' class='checkbox' id='other5' disabled>
											<label for='other5'><i></i>Day 3 Luncheon Symposium – September 9(Sat)</label>
										   ";
						}

						if($other_html == "") $other_html = "-";

						// Conference Info
						$info_html = "";
						$info = explode("*", $list["conference_info"] ?? "");

						for($a = 0; $a < count($info); $a++){
							if($info[$a]){
								$info_html .= $info_html != "" ? "<br/>" : "";
								$info_html .= "
												<input type='checkbox' class='checkbox' id='conference".$a."' disabled>
												<label for='conference".$a."'><i></i>".$info[$a]."</label>
											  ";
							}
						}

						if($info_html == "") $info_html = "-";

						// 결제정보
						$payment_methods = $list["payment_methods"];
						$payment_methods = $payment_methods == 1 ? "bank" : "card";

						if($payment_methods == "card"){
							if($list["price"] == 0){
								$payment_methods = "Free";
							}else{
								$payment_methods = "Credit card";
							}
						}else{
							$payment_methods = "Bank Transfer";
						}

				?>

						<tr>
							<td><?=$register_no ?? "-"?></td>					
							<td><?=$list["member_type"]?></td>
							<!--<td><?=$list["attendance_type"]?></td>-->
							<!--<td><?=$price?></td>-->
							<td><?=$list["is_korea"] == 1 ? "KRW" : "USD"?> <?=$list["price"] || $list["price"] == 0 ? number_format($list["price"]) : "-"?></td>
							<td><?=$payment_methods?></td>
							

							<?php if($list["status"] == 1){?>
								<td>Payment Needed</td>
								<td>
									<?php if($list["payment_methods"] == 1){?>
										<!--<a href="./online_registration.php" target="_blank" class="btn">Modify</a> 퍼블 ver-->
<!--										<a href="./registration.php?idx=--><?php //=$list["idx"]?><!--" target="_blank" class="btn">Modify</a>-->
									<?php }else{?>
<!--										<button type="button" class="btn payment_btn" data-url="--><?php //=$payment_url?><!--">Payment</button>-->
									<?php }?>
									<button type="button" class="btn cancel_btn" data-idx="<?=$list["idx"]?>">Cancel</button>
								</td>
							<?php }else if($list["status"] == 2 || $list["status"] == 3){?>
								<td>Complete</td>
								<td>
									<button type="button" class="btn review_regi_open" data-idx="<?=$list["idx"]?>">Review</button>
									<button type="button" class="btn registration_receipt_btn" data-idx="<?=$list["idx"]?>">Receipt</button>
									<!--<button type="button" class="btn payment_receipt_btn" data-tid="'.$list['payment_obj']['tid'].'">Payment Receipt</button>-->
									<div class="review_data hidden">
										<table class="detail_table">
											<tbody>
												<tr>
													<th>Registration No.</th>
													<td><?=$register_no ?? "-"?></td>
												</tr>
												<tr>
													<th>Registration Date</th>
													<td><?=$list["register_date2"] ?? "-"?></td>
												</tr>
												<tr>
													<th>Name</th>
													<td><?=$list["first_name"]." ".$list["last_name"]?></td>
												</tr>
												<tr>
													<th>Country</th>
													<td><?=$list["nation_en"]?></td>
												</tr>
												<tr>
													<th>Affiliation</th>
													<td><?=$list["affiliation"] ?? "-"?></td>
												</tr>
												<tr>
													<th>Phone Number</th>
													<td><?=$list["phone"] ?? "-"?></td>
												</tr>
												<tr>
													<th>Member of KSSO</th>
													<td><?=$list["ksso_member_status"] ?? "-"?></td>
												</tr>
												<tr>
													<th>Type of<br/>Participation</th>
													<td><?=$attendance_type?></td>
												</tr>
												<tr>
													<th>Category</th>
													<td><?=$list["member_type"] ?? "-"?></td>
												</tr>
												<?php if($list["is_korea"] == 1){?>
													<tr>
														<th>평점신청</th>
														<td><?=$list["is_score"] == 1 ? "필요" : "불필요"?></td>
													</tr>
													<tr>
														<th>의사 면허번호</th>
														<td><?=$list["licence_number"] ?? "Not applicable"?></td>
													</tr>
													<tr>
														<th>전문의 번호</th>
														<td><?=$list["specialty_number"] ?? "Not applicable"?></td>
													</tr>
													<tr>
														<th>영양사 면허번호</th>
														<td><?=$list["nutritionist_number"] ?? "Not applicable"?></td>
													</tr>
                                                    <tr>
                                                        <th>임상영양사 면허번호</th>
                                                        <td><?=$list["dietitian_number"] ?? "Not applicable"?></td>
                                                    </tr>
												<?php }?>
												<tr>
													<th>Others</th>
													<td><?=$other_html?></td>
												</tr>
                                                <tr>
                                                    <th>Special Request <br/>for Food</th>
                                                    <td><?=$special_request_food?></td>
                                                </tr>
												<tr>
													<th>Where did you get the <br/>information about<br/> the conference?</th>
													<td><?=$info_html?></td>
												</tr>
												<!-- Credit Card 선택 시 -->
												<tr class="tr_bg">
													<th>Registration fee</th>
													<td><?=$list["is_korea"] == 1 ? "KRW" : "USD"?> <?=$list["price"] || $list["price"] == 0 ? number_format($list["price"]) : "-"?></td>
												</tr>
												<tr class="tr_bg">
													<th>Total Registration fee</th>
													<td><?=$list["is_korea"] == 1 ? "KRW" : "USD"?> <?=$list["price"] || $list["price"] == 0 ? number_format($list["price"]) : "-"?></td>
												</tr>
												<tr class="tr_bg">
													<th>Payment Method</th>
													<td>
														<input type="checkbox" disabled class="checkbox">
														<label for="">
															<i></i>
															<?=$payment_methods?>
														</label>
													</td>
												</tr>
												<!-- 이전 개발 -->
												<!-- 
												<tr class="tr_bg">
													<th>Payment Date</th>
													<td><?=$list["payment_register_date"] ?? "-"?></td>
												</tr>
												-->
												<!-- Credit Card 선택 시 퍼블ver -->
												<!--
												<tr class="tr_bg">
													<th>Registration fee</th>
													<td>KRW 84,000</td>
												</tr>
												<tr class="tr_bg">
													<th>Total Registration fee</th>
													<td>KRW 84,000</td>
												</tr>
												<tr class="tr_bg">
													<th>Payment Method</th>
													<td>
														<input type="checkbox" disabled class="checkbox">
														<label for="">
															<i></i>
															Credit Card 
														</label>
													</td>
												</tr>
												-->
												<!-- Bank transfer 선택 시 -->
												<!--
												<tr class="tr_bg">
													<th>Registration fee</th>
													<td>KRW 84,000</td>
												</tr>
												<tr class="tr_bg">
													<th>Total Registration fee</th>
													<td>KRW 84,000</td>
												</tr>
												<tr class="tr_bg">
													<th>Payment Method</th>
													<td>
														<input type="checkbox" disabled class="checkbox">
														<label for="">
															<i></i>
															Bank Transfer
														</label>
													</td>
												</tr>
												<tr>
													<th>Name of Bank</th>
													<td>KEB Hana Bank</td>
												</tr>
												<tr>
													<th>Branch</th>
													<td>HANA BANK, HEAD OFFICE (35, EULJI-RO, JUNG-GU, Seoul, Korea)</td>
												</tr>
												<tr>
													<th>Account Number</th>
													<td>584-910003-16504</td>
												</tr>
												<tr>
													<th>SWIFT CODE(BIC)</th>
													<td>KOEXKRSE</td>
												</tr>
												<tr>
													<th>Account Holder</th>
													<td>대한비만학회 등록비<br>(International Congress on Obesity and Metabolic Syndrome)</td>
												</tr>
												-->
											</tbody>
										</table>
									</div>
								</td>
							<?php }else{?>
								<td>-</td>
								<td>canceled</td>
							<?php }?>
						</tr>
				<?php
					}

					if(count($registration_list) < 1){
						echo '<tr><td colspan="7">Empty registration</td></tr>';
					}
				?>
				</tbody>
			</table>
		</div>
    </div>

	<div class="popup online_regi_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
            <input type="hidden" name="registration_idx" value="">
            <h3 class="pop_title">Online Registration</h3>
            <div class="table_wrap detail_table_common x_scroll">
				<table class="c_table detail_table fixed_table">
					<colgroup>
						<col width="150px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>ID(email)</th>
							<td>bancya@naver.com</td>
						</tr>
						<tr>
							<th>Name</th>
							<td>ban hyeonjeong</td>
						</tr>
						<tr>
							<th>Country</th>
							<td>Korea</td>
						</tr>
						<tr>
							<th>Member Type</th>
							<td>Others(기타)</td>
						</tr>
					</tbody>
				</table>
			</div>
            <div class="table_wrap detail_table_common x_scroll mt10">
				<table class="c_table detail_table fixed_table">
					<colgroup>
						<col width="150px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>Attendance Type</th>
							<td>General Participants</td>
						</tr>
						<tr>
							<th>Registration Type</th>
							<td>on-site</td>
						</tr>
						<tr>
							<th>Registration Fee</th>
							<td>100,000 KRW</td>
						</tr>
					</tbody>
				</table>
			</div>
            <div class="btn_wrap">
                <button type="button" class="btn update_btn pop_save_btn">Save</button>
            </div>
        </div>
    </div>

	<div class="popup review_regi_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
            <input type="hidden" name="registration_idx" value="">
            <h3 class="pop_title">Review of Registration</h3>
			<div class="pop_title_wrap">
				<p>Registration Information</p>			
			</div>
            <div class="table_wrap detail_table_common x_scroll mt10">
				<table class="c_table detail_table fixed_table" style="min-width:400px;">
					<colgroup>
						<col width="190px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>Registration No.</th>
							<td></td>
						</tr>
						<tr>
							<th>Registration Date</th>
							<td>MM-DD-2023 HH:MM:SS</td>
						</tr>
						<tr>
							<th>Name</th>
							<td>Gil-dong Hong</td>
						</tr>
						<tr>
							<th>Country</th>
							<td>Republic of Korea</td>
						</tr>
						<tr>
							<th>Affiliation</th>
							<td>Department of , Institution</td>
						</tr>
						<tr>
							<th>Phone Number</th>
							<td>82-10-1234-5678</td>
						</tr>
						<tr>
							<th>Member of KSSO</th>
							<td>Member</td>
						</tr>
						<tr>
							<th>Type of<br/>Participation</th>
							<td>Speaker</td>
						</tr>
						<tr>
							<th>Category</th>
							<td>Professor</td>
						</tr>
						<tr>
							<th>평점신청</th>
							<td>필요</td>
						</tr>
						<tr>
							<th>의사 면허번호</th>
							<td>123145</td>
						</tr>
						<tr>
							<th>전문의 번호</th>
							<td>14253</td>
						</tr>
						<tr>
							<th>영양사 면허번호</th>
							<td>Not applicable</td>
						</tr>
						<tr>
							<th>Others</th>
							<td>
								<input type="checkbox" disabled class="checkbox">
								<label for="">
									<i></i>
									Welcome Reception – September 7(Thu)
								</label>
							</td>
						</tr>
						<tr>
							<th>Where did you get the <br/>information about<br/> the conference?</th>
							<td>
								<div>
									<input type="checkbox" disabled class="checkbox">
									<label for="">
										<i></i>
										Website of the Korea Society of Obesity
									</label>
								</div>
								<div>
									<input type="checkbox" disabled class="checkbox">
									<label for="">
										<i></i>
										Promotional email from the Korea Society of Obesity
									</label>
								</div>
							</td>
						</tr>
						<!-- Credit Card 선택 시 -->
						<!--
						<tr class="tr_bg">
							<th>Registration fee</th>
							<td>KRW 84,000</td>
						</tr>
						<tr class="tr_bg">
							<th>Total Registration fee</th>
							<td>KRW 84,000</td>
						</tr>
						<tr class="tr_bg">
							<th>Payment Method</th>
							<td>
								<input type="checkbox" disabled class="checkbox">
								<label for="">
									<i></i>
									Credit Card 
								</label>
							</td>
						</tr>
						-->
						<!-- Bank transfer 선택 시 -->
						<!--
						<tr class="tr_bg">
							<th>Registration fee</th>
							<td>KRW 84,000</td>
						</tr>
						<tr class="tr_bg">
							<th>Total Registration fee</th>
							<td>KRW 84,000</td>
						</tr>
						<tr class="tr_bg">
							<th>Payment Method</th>
							<td>
								<input type="checkbox" disabled class="checkbox">
								<label for="">
									<i></i>
									Bank Transfer
								</label>
							</td>
						</tr>
						<tr>
							<th>Name of Bank</th>
							<td>KEB Hana Bank</td>
						</tr>
						<tr>
							<th>Branch</th>
							<td>HANA BANK, HEAD OFFICE (35, EULJI-RO, JUNG-GU, Seoul, Korea)</td>
						</tr>
						<tr>
							<th>Account Number</th>
							<td>584-910003-16504</td>
						</tr>
						<tr>
							<th>SWIFT CODE(BIC)</th>
							<td>KOEXKRSE</td>
						</tr>
						<tr>
							<th>Account Holder</th>
							<td>대한비만학회 등록비<br>(International Congress on Obesity and Metabolic Syndrome)</td>
						</tr>
						-->
					</tbody>
				</table>
			</div>
            <div class="btn_wrap">
                <button type="button" class="btn cancel_btn" name="registration_cancel_pop_btn" style="position:static; width:auto; height:auto; padding:8px 30px;">Cancel</button>
            </div>
        </div>
    </div>

    <div class="popup revise_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
            <input type="hidden" name="registration_idx" value="">
            <h3 class="pop_title">Participant Information</h3>
            <div class="table_wrap form_table">
                <form name="registration_form">
					<table class="c_table2 detail_table">
						<tbody>
							<tr>
								<th><?=$locale("id")?> *</th>
								<td><input type="text" name="email" readonly></td>
							</tr>
							<tr>
								<th><?=$locale("country")?> *</th>
								<td>
									<select class="update" name="nation_no">
										<option selected disabled>Choose </option>
									<?php
										foreach($nation_list as $list){
											$nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
											echo "<option value='".$list["idx"]."'>".$nation."</option>";
										}
									?>
									</select>
								</td>
							</tr>
							<tr>
								<th><?=$locale("first_name")?> *</th>
								<td><input type="text" name="first_name" value="Jihye" readonly></td>
							</tr>
							<tr>
								<th><?=$locale("last_name")?> *</th>
								<td><input type="text" name="last_name" value="Lee" readonly></td>
							</tr>
							<tr>
								<th><?=$locale("phone")?> *</th>
								<td>
									<div class="phone_div clearfix2">
										<select name="nation_tel"> 
											<option selected disabled></option>
										</select>
										<input type="text" name="phone" placeholder="010-1234-1234" readonly></td>
									</div>
								</td>
							</tr>
							<tr>
								<th><?=$locale("affiliation")?></th>
								<td><input class="update" type="text" name="affiliation"></td>
							</tr>
							<tr>
								<th><?=$locale("department")?></th>
								<td><input class="update" type="text" name="department"></td>
							</tr>
							<tr>
								<th>평점신청(Korean Only) * <br><span class="is_scroe_txt red_txt">(Overseas participants, please check '미신청').</th>
								<td class="banquet_style">
									<input type="radio" class="radio" id="applied" name="rating" value="1"><label class="banquet_label" for="applied">신청</label>
									<input type="radio" class="radio" id="not_applied" name="rating" value="0"><label for="not_applied">미신청</label>
								</td>
							</tr>
							<tr class="org tab_contents">
								<th><?php echo $locale("applied_org")?></th>
								<td>
									<input type="checkbox" class="checkbox org_01" id="checkbox1" name="org" value="1"><label for="checkbox1"><?php echo $locale("applied_org1")?></label></br>
									<input type="checkbox" class="checkbox registration_check org_03" id="checkbox3" name="org" value="3"><label for="checkbox3"><?php echo $locale("applied_org3")?></label></br>
									<input type="checkbox" class="checkbox registration_check org_04" id="checkbox4" name="org" value="4"><label for="checkbox4"><?php echo $locale("applied_org4")?></label></br>
								</td>
							</tr>
							<tr>
								<th>Licence Number *</th>
								<td>
									<div class="text_l mb10">
										<input type="checkbox" class="checkbox" id="license_checkbox" name="license_checkbox">
										<label class="tight" for="license_checkbox"><i>Not applicable</i></label>
									</div>
									<input class="update" type="text" name="licence_number">
								</td>
							</tr>
							<tr>
								<th>KSSO Member Status *</th>
								<td class="banquet_style">
									<input type="radio" class="radio" id="member" name="member_status" value="1">
									<label for="member" class="banquet_label"><?=$locale("member_status_select1")?></label>
									<input type="radio" class="radio" id="non_member" name="member_status" value="0">
									<label for="non_member"><?=$locale("member_status_select2")?></label>
								</td>
							</tr>
							<!-- <tr> -->
							<!-- 	<th>KSSO Academy number *</th> -->
							<!-- 	<td><input class="update" type="text" name="academy_number"></td> -->
							<!-- </tr> -->
							<!-- <tr> -->
							<!-- 	<th>Congress Banquet Ceremony *</th> -->
							<!-- 	<td class="banquet_style"> -->
							<!-- 		<input type="radio" class="radio" id="banquet1" name="banquet_yn" value="Y"><label class="banquet_label" for="banquet1">Attend</label> -->
							<!-- 		<input type="radio" class="radio" id="banquet2" name="banquet_yn" value="N"><label for="banquet2">Absent</label> -->
							<!-- 	</td> -->
							<!-- </tr> -->				
						</tbody>   
                    </table>
                </form>
            </div>
            <div class="btn_wrap">
                <button type="button" class="btn update_btn pop_save_btn"><?=$locale("save_btn")?></button>
            </div>
        </div>
    </div>

    <!-- <div class="popup receipt_pop" style="display: block;"> -->
    <!--     <div class="pop_bg"></div> -->
    <!--     <div class="pop_contents"> -->
    <!--         <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button> -->
    <!--         <input type="hidden" name="registration_idx" value=""> -->
    <!--         <h3 class="pop_title">Registration Receipt</h3> -->
    <!--         <img src="./img/img_receipt.png" alt="" class="img_cont"> -->
    <!--         <div class="btn_wrap"> -->
    <!--             <button type="button" class="btn update_btn pop_save_btn"><?=$locale("save_btn")?></button> -->
    <!--         </div> -->
    <!--     </div> -->
    <!-- </div> -->

    <div class="popup payment_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
            <input type="hidden" name="registration_idx" value="">
            <h3 class="pop_title">Payment</h3>
            <img src="./img/img_payment.png" alt="">
            <div class="btn_wrap">
                <button type="button" class="btn update_btn pop_save_btn"><?=$locale("save_btn")?></button>
            </div>
        </div>
    </div>
</section>


<script src="./js/script/client/registration.js"></script>
<script>
    $(document).ready(function(){
        $(window).off("beforeunload");
		
		$(document).on("click", "#license_checkbox", function(){
			//console.log($(this).is(':checked'));
			if($(this).is(':checked') == true) {
				$("input[name=licence_number]").attr("disabled", true);
				$("input[name=licence_number]").val("");
			} else {
				$("input[name=licence_number]").attr("disabled", false);
							
				$("#submit_btn").removeClass("submit_btn");
				$("#submit_btn").addClass("gray_btn");
			}
		});
		
		$(".online_regi_open").click(function(){
			$(".online_regi_pop").show();
		});

		$(".review_regi_open").click(function(){
			const html = $(this).siblings(".review_data").find('.detail_table tbody').children().clone();
			$(".review_regi_pop tbody").html(html);
			const member_idx = $(this).data("idx");
			$("[name=registration_cancel_pop_btn]").data("idx", member_idx).attr("data-idx", member_idx);
			
			$(".review_regi_pop").show();
		});
    });

    $('.revise_pop_btn').on('click',function(){
        var idx = $(this).data("idx");
        $.ajax({
            url : PATH+"ajax/client/ajax_registration.php",
            type : "POST",
            data : {
                flag : "registration_information",
                idx : idx
            },
            dataType : "JSON",
            success : function(res) {
                if(res.code == 200 && res.data) {
                    var nation_tel = res.data.phone.split("-")[0];
                    var _phone = res.data.phone.split("-");
                    var _remove = _phone.splice(0,1);
                    var phone = _phone.join("-");
                    if(res.data.payment_status == 0 || res.data.payment_status == 3 || res.data.payment_status == 4) {
                        $(".revise_pop input").attr("readonly", true);
                        $(".revise_pop select").attr("disabled", true);
                        $(".update_btn").attr("disabled", true);
                    } else {
                        $(".update").attr("readonly", false);
                        $(".revise_pop select").attr("disabled", false);
                        $(".update_btn").attr("disabled", false);
                    }
                    $("input[name=registration_idx]").val(res.data.idx);
                    $("input[name=email]").val(res.data.email);
                    $("option[value="+res.data.nation_no+"]").attr("selected", true);
                    $("input[name=first_name]").val(res.data.first_name);
                    $("input[name=last_name]").val(res.data.last_name);
                    $("select[name=nation_tel] option").val(nation_tel).text(nation_tel);
                    $("input[name=phone]").val(phone);
                    $("input[name=affiliation]").val(res.data.affiliation);
                    $("input[name=department]").val(res.data.department);
					
					//if(res.data.banquet_yn == "Y") {
					//	$("#banquet1").prop("checked", true);
					//} else {
					//	$("#banquet2").prop("checked", true);
					//}

					if(res.data.licence_number == "Not applicable") {
						$("#license_checkbox").prop("checked", true);
						$("input[name=licence_number]").attr("disabled", true);
					} else {
						$("input[name=licence_number]").val(res.data.licence_number);
					}

					//2022-05-18
					if(res.data.member_status == 1) {
						$("#member").prop("checked", true);
					} else {
						$("#non_member").prop("checked", true);
					}

					var orgs = "";
					var org = res.data.etc2;
					//console.log(org);
					if(org) {
						$(".org").removeClass("tab_contents");
						orgs = org.split(",");
						
						for(var i=0; i<orgs.length; i++) {
							
							if(orgs[i] == 1) {
								$("#checkbox1").prop("checked", true);
							} else if (orgs[i] == 3) {
								$("#checkbox3").prop("checked", true);
							} else if(orgs[i] == 4) {
								$("#checkbox4").prop("checked", true);
							}
						}
					} else {
						$(".org").addClass("tab_contents");
						$("#checkbox1").prop("checked", false);
						$("#checkbox3").prop("checked", false);
						$("#checkbox4").prop("checked", false);
					}

					if(res.data.is_score == 1) {
						$("#applied").prop("checked", true);
						$(".org").removeClass("tab_contents");
					} else {
						$("#not_applied").prop("checked", true);
					}
                   
                    //$("input[name=academy_number]").val(res.data.academy_number);
                    $('.revise_pop').show();
                } else if(res.code == 400) {
                        return false;
                }
            }
        });
        
    });

    $(".update_btn").on("click", function(){

        var idx = $("input[name=registration_idx]").val();
        var process = inputCheck("update");
        var status = process.status;
        var data = process.data;

		data.flag = "update";
		data.idx = idx;

		var etc2 = "";

		$('input:checkbox[name="org"]').each(function() {

			if(this.checked == true) {
				etc2 += this.value+",";	
			} 
		});
		etc2 = etc2.substring(0, etc2.length - 1);
		
		data.etc2 = etc2;

		//유효성
		var licence_number = $("input[name=licence_number]").val();
		var licence_number_len = licence_number.trim().length;
		licence_number = (typeof(licence_number) != "undefined") ? licence_number : null;

		if($("#license_checkbox").is(':checked') == false) {
			if(!licence_number || licence_number_len <= 0) {
				alert("Please enter the licence number.");
				return;
			}
		}

		if(data.license_checkbox == "on") {
			data.licence_number = "Not applicable";
		}

        if(confirm(locale(language.value)("registration_modify_msg"))) {
            if(status) {
                $.ajax({
                    url : PATH+"ajax/client/ajax_registration.php",
                    type : "POST",
                    data : data,
                    dataType : "JSON",
                    success : function(res) {
                        if(res.code == 200) {
                            alert(locale(language.value)("complet_registration_modify"));
                            location.reload();
                        } else if(res.code == 401) {
                            alert(locale(language.value)("error_registration_modify"));
                            return false;
                        } else if(res.code == 400) {
                            alert(locale(language.value)("error_registration_modify"));
                            return false;
                        } else {
                            alert(locale(language.value)("reject_msg"));
                            return false;
                        }
                    }
                });
            }
        }
    });

	$(document).on("change", "#applied", function(){
		
		var _this = $(this).is(":checked");
		if(_this) {
			
			$(".org").removeClass("tab_contents");
		}
	});
	$(document).on("change", "#not_applied", function(){
		
		var _this = $(this).is(":checked");
		if(_this) {
			$(".org").addClass("tab_contents");
			$("#checkbox1").prop("checked", false);
			$("#checkbox3").prop("checked", false);
			$("#checkbox4").prop("checked", false);
		}
	});


    $(".payment_btn").on("click",function(){
        var paymentUrl = $(this).data("url");
        window.location.href = paymentUrl;
    });

	$(".certificate_btn").on("click", function(){
        var url = "./certificate_of_attendance.php";
        window.open(url,"Certificate of attendance","width=1150, height=900, top=30, left=200");
	});

    $(".cancel_btn").on("click",function(){
        var idx = $(this).data("idx");
        if(confirm(locale(language.value)("registration_cancel_msg"))) {
            $.ajax({
                url : PATH+"ajax/client/ajax_registration.php",
                type : "POST",
                data : {
                    flag : "cancel",
                    idx : idx
                },
                dataType : "JSON",
                success : function(res) {
                    if(res.code == 200) {
                        alert(locale(language.value)("complet_registration_cancel"));
                        location.reload();
                    } else if(res.code == 400) {
                        alert(locale(language.value)("error_registration_cancel"));
                        return false;
                    } else if(res.code == 401) {
                        alert(locale(language.value)("invalid_auth"));
                        return false;
                    } else if(res.code == 402) {
                        alert(locale(language.value)("invalid_registration_status"));
                        return false;
                    } else {
                    alert(locale(language.value)("reject_msg"));
                    return false;
                    }
                }
            });
        }
    });

    $(".refund_btn").on("click", function(){
        var payment_status = $(this).data("status");
        var idx = $(this).data("idx");
        if(confirm(locale(language.value)("registration_refund_msg"))) {
            $.ajax({
                url : PATH+"ajax/client/ajax_registration.php",
                type : "POST",
                data : {
                    flag : "refund",
                    payment_status : payment_status,
                    idx : idx
                },
                dataType : "JSON",
                success : function(res) {
                    if(res.code == 200) {
                        alert(locale(language.value)("complet_registration_refund"));
                        location.reload();
                    } else if(res.code == 400) {
                        alert(locale(language.value)("error_registration_refund"));
                        return false;
                    } else if(res.code == 401) {
                        return false;
                    } else if(res.code == 402) {
                        return false;
                    } else {
                        alert(locale(language.value)("reject_msg"));
                        return false;
                    }
                }
            });
        }
    });

	// registration receipt
	$(".registration_receipt_btn").on("click", function(){
		console.log(device);
		//$(".receipt_pop").show();
		var idx = $(this).data("idx");
		//var url = "./pre_registration_confirm.php?idx="+idx;
		var url = "./mypage_receipt.php?type="+device+"&idx="+idx;
		window.open(url,"Registration Receipt","width=793, height=1097, top=30, left=30");
	});

	//$(".korean_only").on("click", function(){
	//	var url = "./pre_registration_korean_only.php";
	//	window.open(url,"Registration Receipt","width=793, height=2000, top=30, left=30");
	//});


	// payment receipt
	$(".payment_receipt_btn").on("click", function(){
		var tid = $(this).data("tid");
		var url = "https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=" + tid + "&noMethod=1";
		window.open(url);
	});

	$("input[name=affiliation]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	$("input[name=department]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	$("input[name=licence_number]").on("change keyup", function(key){
		var pattern_eng = /[^0-9]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	$("input[name=academy_number]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z||0-9\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	//$("input[name=banquet_yn]").on("change keyup", function(key){
	//	var pattern_eng = /[^a-zA-Z||0-9\s]/gi;
	//	var _this = $(this);
	//	if(key.keyCode != 8) {
	//		var first_name = _this.val().replace(pattern_eng, '');
	//		_this.val(first_name);
	//	}
	//});
</script>
<?php include_once('./include/footer.php');?>