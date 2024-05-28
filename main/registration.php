<?php
include_once('./include/head.php');
include_once('./include/header.php');

$_POST = [];											// 해당페이지는 정식 API 가 아니기에 예외처리
include_once('./ajax/client/ajax_registration.php');	// 요금관련 함수 호출을 위해 import (calcFee)

$registrationNo = preg_replace("/[^0-9]*/s", "", $_GET["idx"] ?? "");
$prev = NULL;

if($registrationNo){
	$sql = "SELECT * FROM request_registration WHERE is_deleted = 'N' AND idx = {$registrationNo}";
	$prev = sql_fetch($sql);

	$registrationNo = $prev["idx"] ?? "";

	if($registrationNo){
		$register = $prev["register"] ?? 0;
		$category = $prev["member_type"] ?? "";
        $occupation = $prev["occupation_type"] ?? "";
        $nation_no = $prev["nation_no"] ?? "";

        if($prev["attendance_type"] == 4 || $prev["attendance_type"] == 5){
            $calc_fee = calcFee($register, $category, $nation_no);
        } else{
            $calc_fee = 0;
        }
		//$calc_fee = $prev["attendance_type"] == 4 ? calcFee($register, $category, $nation_no) : 0;
		$prev["calc_fee"] = $calc_fee;
	}
}

//경로 주의
if ($_SERVER["HTTP_HOST"] == "www.imcvp.org") {
	echo "<script>location.replace('https://imcvp.org/main/registration.php')</script>";
}

//날짜 변경 필요!!!
$sql_during =	"SELECT
						IF(NOW() BETWEEN '2022-08-18 17:00:00' AND '2024-09-07 22:00:00', 'Y', 'N') AS yn
					FROM info_event";
$during_yn = sql_fetch($sql_during)['yn'];
//!=="Y"
if ($during_yn !== "Y") {

?>

<section class="submit_application container">
    <div class="inner">
        <div class="sub_banner">
            <h1>Online Registration</h1>
        </div>
        <section class="coming">
            <img class="coming" src="./img/coming.png" />
            <div class="container">
                <div class="sub_banner">
					<h5>Pre-Registration<br>has been closed</h5>
				</div>
            </div>
        </section>
    </div>
</section>

<?php
} else {
	$nation_query = "SELECT
							*
						FROM nation
						ORDER BY 
						idx = 25 DESC, nation_en ASC";
	//$nation_list_query = $_nation_query;
	$nation_list_query = $nation_query;
	$nation_list = get_data($nation_list_query);

	if (!empty($_SESSION["USER"])) {
		$user_info = $_SESSION["USER"];
	} else {
		echo "<script>alert('Need to login'); window.location.replace(PATH+'login.php');</script>";
		exit;
	}

	$_arr_phone = explode("-", $user_info["phone"]);
	$nation_tel = $_arr_phone[0];
	$phone = implode("-", array_splice($_arr_phone, 1));

	$sql_price =	"SELECT
							type_en, idx
						FROM info_event_price
						WHERE is_deleted = 'N'
						ORDER BY FIELD(idx, 1,2,3,4,5,6,7,8,9,10,12,11)";
	$price = get_data($sql_price);

	$member_idx = $_SESSION["USER"]['idx'];
	$sql_info = "
				SELECT
					m.email, m.first_name, m.last_name, m.first_name_kor, m.last_name_kor, n.nation_en, m.affiliation, m.department, m.phone, m.ksola_member_status, m.nation_no
				FROM member m
				LEFT JOIN nation n
				ON m.nation_no = n.idx
				WHERE m.idx = {$member_idx}
				";
	$member_data = sql_fetch($sql_info);
	
?>
<style>
/*2022-04-14 ldh 추가*/
.gray_btn {
    pointer-events: none;
}

.is_scroe_txt {
    font-size: 24px;
}

.korea_only, .usd_only {display: none;}
.korea_only.on, .usd_only.on {display:revert;}
</style>

<!-- <section class="container online_register submit_application"> -->
<section class="container online_register abstract_online_submission top_btn_move">
		<h1 class="page_title">Registration
			<div class="sub_btn_box">
				<a href="/main/registration_guidelines.php">Guidelines</a>
				<a href="/main/registration.php" class="on">Go to Registration</a>
				<a href="/main/registration_rating_guides.php" class="kor">평점안내</a>
			</div>
		</h1>
    <div class="inner">
        <!-- <div class="sub_banner"> -->
        <!--     <h1>Online Registration</h1> -->
        <!-- </div> -->
        <div class="input_area">
            <h3 class="title">
				<?= $locale("participant_tit") ?>
				<p class="mt10"><span class="red_txt">*</span> In the "My Page - Account" section, users have the ability to edit their personal information.</p>
			</h3>
			<div class="table_wrap detail_table_common x_scroll">
				<table class="c_table detail_table type2">
					<colgroup>
						<col class="submission_col">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>ID(email)</th>
							<td><a href="mailto:<?= $member_data['email']?>" class="font_inherit link"><?= $member_data['email'] ?></a></td>
						</tr>
						<tr>
							<th>Name</th>
							<td><?= $member_data["first_name"]." ".$member_data["last_name"]?></td>
						</tr>
						<?php
							$name_kor_cont = "<tr> 
												<th>성명</th>
												<td>".$member_data['last_name_kor']."".$member_data['first_name_kor']."</td>
											</tr>";
							if($member_data['nation_en'] === "Republic of Korea"){
								echo $name_kor_cont;
							}
						?>
						<tr>
							<th>Country</th>
							<td id='country'><?= $member_data['nation_en']?></td>
						</tr>
						<tr>
							<th>Affiliation</th>
							<td><?= $member_data['department']?> of , <?= $member_data['affiliation']?></td>
						</tr>
						<tr>
							<th>Phone Number</th>
							<td><?= $member_data['phone']?></td>
						</tr>
						<?php if($member_data['nation_en'] === "Republic of Korea"){ ?>
							<tr> 
								<th>Member of KSCP</th>
								<td id='ksola_member_status'><?=$member_data['ksola_member_status'] == 0 ? 'Non-Member' : 'Member'?></td>
							</tr>
						<?php }?>
						<!-- <tr> -->
						<!-- 	<th>Member of KSSO</th> -->
						<!-- 	<td><?= $member_data['ksola_member_status'] == 0 ? 'Non-Member' : 'Member'?></td> -->
						<!-- </tr> -->
					</tbody>
				</table>
			</div>
            <form name="registration_form" class="registration_form">
				<input type="hidden" name="prev_no" value="<?=$registrationNo?>"/>
				<input type="hidden" id="nation" name="nation" value="<?= $member_data['nation_en']?>">
			<!-- onsubmit="return false" -->
                <ul class="basic_ul">
                    <li>
						<p class="mb10"><span class="red_txt">*</span> All requested field(<span class="red_txt">*</span>) should be completed.</p>
                        <p class="label"><?=$locale("register_online_question2_2023")?> <span class="red_txt">*</span></p>
                        <select id="participation_type" name="participation_type" onChange="calc_fee(this)" <?=$prev["status"] == 2 || $prev["status"] == 3 ? "readonly disabled" : ""?>>
							<option value="" selected hidden>Choose</option>
							<?php
								$participation_arr = array("Committee", "Speaker", "Chairperson", "Panel", "Participants", "Sponsor");

								foreach($participation_arr as $a_arr) {
                                    $attendance_type = "";
                                    switch($prev["attendance_type"]) {
                                        case 0:
                                            $attendance_type = "Committee";
                                            break;
                                        case 1:
                                            $attendance_type = "Speaker";
                                            break;
                                        case 2:
                                            $attendance_type = "Chairperson";
                                            break;
                                        case 3:
                                            $attendance_type = "Panel";
                                            break;
                                        case 4:
                                            $attendance_type = "Participants";
                                            break;
                                        case 5:
                                            $attendance_type = "Sponsor";
                                            break;
                                    }

									$selected = $attendance_type === $a_arr ? "selected" : "";

									echo '<option value="'.$a_arr.'" '.$selected.'>'.$a_arr.'</option>';
//									$idx = $idx + 1;
								}
							?>
                        </select>
                    </li>
                    <li style="display: none;">
                        <p class="label">Type of Occupation <span class="red_txt">*</span></p>
                        <ul class="half_ul">
                            <li>
                                <select id="occupation" name="occupation" >
                                    <option value="" selected hidden>Choose</option>
                                    <?php
                                    $occupation_arr = array("Medical", "Food & Nutrition", "Exercise", "Others");

                                    foreach($occupation_arr as $a_arr) {
                                        $selected = $prev["occupation_type"] === $a_arr ? "selected" : "";

                                        echo '<option value="'.$a_arr.'" '.$selected.'>'.$a_arr.'</option>';
                                    }
                                    ?>
                                </select>
                            </li>
                            <!-- 'Other' 선택시, ▼ li.hide_input에 'on' 클래스 추가 -->
                            <li class="hide_input <?=$prev["occupation_type"] === "Others" ? "on" : ""?>">
                                <input type="hidden" name="occupation_prev_input" value="<?=$prev["occupation_other_type"] ?? ""?>"/>
                                <input type="text" id="occupation_input" name="occupation_input" value="<?=$prev["occupation_other_type"] ?? ""?>">
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p class="label"><?=$locale("register_online_question3_2023")?> <span class="red_txt">*</span></p>
						<ul class="half_ul">
							<li>
								<select id="category" name="category" onChange="calc_fee(this)" <?=$prev["status"] == 2 || $prev["status"] == 3 ? "readonly disabled" : ""?>>
									<option value="" selected hidden>Choose</option>
									<?php
										$category_arr = array("Certified M.D.", "Professor", "Researcher", "Nutritionist", "Exercise Specialist", "Nurse", "Pharmacist", "Trainee", "Student", "Others");

										foreach($category_arr as $a_arr) {
											$selected = $prev["member_type"] == $a_arr ? "selected" : "";

											echo '<option value="'.$a_arr.'" '.$selected.'>'.$a_arr.'</option>';
										}
									?>
								</select>
							</li>
							<!-- 'Other' 선택시, ▼ li.hide_input에 'on' 클래스 추가 -->
							<li class="hide_input <?=$prev["member_type"] === "Others" ? "on" : ""?>">
								<input type="hidden" name="title_prev_input" value="<?=$prev["member_other_type"] ?? ""?>"/>
								<input type="text" id="title_input" name="title_input" value="<?=$prev["member_other_type"] ?? ""?>">
							</li>
						</ul>
                    </li>

					<?php if($member_data['nation_en'] == "Republic of Korea"){?>
						<li id='chk_org'>
							<p class='label'>평점신청 <span class='red_txt'>*</span></p>
							<div>
								<div class='radio_wrap'>
									<ul class='flex'>
										<li>
											<input type='radio' class='new_radio registration_check' id='radio1' name='review' value='1' <?=($prev["is_score"] == 1 ? "checked" : "")?>>
											<label for='radio1'><i></i>필요</label>
										</li>
										<li>
											<input type='radio' class='new_radio registration_check' id='radio2' name='review' value='0' <?=($prev["is_score"] == 0 ? "checked" : "")?>>
											<label for='radio2'><i></i>불필요
												<!-- <span class='is_scroe_txt red_txt'>(Overseas participants, please check '미신청').</span> -->
											</label>

										</li>
									</ul>
								</div>
							</div>
						</li>
						<!-- review_sub_list 클래스는 개발에서 show/hide 기능 대상 클래스로 사용하고 있습니다. -->
						<li class="review_sub_list <?=($prev["is_score"] == 1 ? "" : "hidden")?>">
							<p class="label">
								의사 면허번호 <span class="red_txt">*</span>
								<input type="checkbox" id="app1" class="checkbox" <?=$prev["is_score"] == 1  && ! $prev["licence_number"] ? "checked" : ""?>>
								<label for="app1">
									<i></i> <?=$locale("not_applicable")?>
								</label>
							</p>
							<input type="text" name="licence_number" id="licence_number" class="under_50 input_license" value="<?=$prev["is_score"] == 1 ? $prev["licence_number"] ?? "" : ""?>">
						</li>
						<li class="review_sub_list <?=($prev["is_score"] == 1 ? "" : "hidden")?>">
							<p class="label">
								전문의 번호 <span class="red_txt">*</span>
								<input type="checkbox" id="app2" class="checkbox" <?=$prev["is_score"] == 1  && ! $prev["specialty_number"] ? "checked" : ""?>>
								<label for="app2">
									<i></i> <?=$locale("not_applicable")?>
								</label>
							</p>
							<input type="text" name="specialty_number" id="specialty_number" class="under_50 input_license" value="<?=$prev["is_score"] == 1 ? $prev["specialty_number"] ?? "" : ""?>">
						</li>
						<li class="review_sub_list <?=($prev["is_score"] == 1 ? "" : "hidden")?>">
							<p class="label">
								영양사 면허번호  <span class="red_txt">*</span>
								<input type="checkbox" id="app3" class="checkbox" <?=$prev["is_score"] == 1  && ! $prev["nutritionist_number"] ? "checked" : ""?>>
								<label for="app3">
									<i></i> <?=$locale("not_applicable")?>
								</label>
							</p>	
							<input type="text" name="nutritionist_number" id="nutritionist_number" class="under_50 input_license" value="<?=$prev["is_score"] == 1 ? $prev["nutritionist_number"] ?? "" : ""?>">
						</li>
                        <li class="review_sub_list <?=($prev["is_score"] == 1 ? "" : "hidden")?>">
                            <p class="label">
                                임상영양사 자격번호  <span class="red_txt">*</span>
                                <input type="checkbox" id="app4" class="checkbox" <?=$prev["is_score"] == 1  && ! $prev["dietitian_number"] ? "checked" : ""?>>
                                <label for="app4">
                                    <i></i> <?=$locale("not_applicable")?>
                                </label>
                            </p>
                            <input type="text" name="dietitian_number" id="dietitian_number" class="under_50 input_license" value="<?=$prev["is_score"] == 1 ? $prev["dietitian_number"] ?? "" : ""?>">
                        </li>
					<?php }?>
                    <li>
                        <p class="label type2"><?=$locale("register_online_question5_2023")?> <span class="red_txt">*</span></p>
						<p class="mb10">Please confirm your attendance for all of the following events. </p>
                        <div class="table_wrap detail_table_common x_scroll">
							<table class="c_table detail_table type2" id=" othersList_table" name=" othersList_table">
								<colgroup>
									<col class="submission_col">
									<col>
								</colgroup>
								<tbody id="othersList">
									<?php
										$others_arr = array(
												"Welcome Reception",
												"Day 1 Luncheon Symposium",
												"Day 2 Breakfast Symposium",
												"Day 2 Luncheon Symposium"
										);
										$other_date_arr = array(
												"November 29 (Fri)",
												"November 29 (Fri)",
												"November 30 (Sat)",
												"November 30 (Sat)"
										);

										$prev_data_arr = [];
										if($prev["welcome_reception_yn"] == "Y"){
											array_push($prev_data_arr ,1);
										}
										if($prev["day2_breakfast_yn"] == "Y"){
											array_push($prev_data_arr ,2);
										}
										if($prev["day2_luncheon_yn"] == "Y"){
											array_push($prev_data_arr ,3);
										}
										if($prev["day3_breakfast_yn"] == "Y"){
											array_push($prev_data_arr ,4);
										}
										if($prev["day3_luncheon_yn"] == "Y"){
											array_push($prev_data_arr ,5);
										}
										
										for($i = 1; $i <= count($others_arr); $i++) {
											$valueType = "";
											$content = $others_arr[$i-1];

											$is_yes = in_array($i, $prev_data_arr);

											echo "<tr>
													<th class='border_r_none'>".$others_arr[$i-1]."</th>
													<th>".$other_date_arr[$i-1]."</th>
													<td>
														<div class='radio_wrap' id='focus_others' tabindex='0'>
															<ul class='flex'>
																<li>
																	<input type='radio' id='yes".$i."' class='new_radio' name='others".$i."' value='".$others_arr[$i-1].$other_date_arr[$i-1]."' ".($is_yes ? "checked" : "").">
																	<label for='yes".$i."'>
																		<i></i> Yes
																	</label>
																</li>
																<li>
																	<input type='radio' id='no".$i."' class='new_radio' name='others".$i."' value='no' ".($is_yes || !$prev ? "" : "checked").">
																	<label for='no".$i."'>
																		<i></i> No
																	</label>
																</li>
															</ul>
														</div>
													</td>
												</tr>";
										}
									?>
								</tbody>
							</table>
						</div>
                    </li>
                    <li>
                        <p class="label">Special Request for Food <span class="red_txt">*</span></p>
                        <ul class="chk_list info_check_list flex_center type2">
                            <?= $prev["special_request_food"] === '0' ? "selected" : "" ?>
                            <li>
                                <input type="radio" class='checkbox' id="special_request1" name='special_request' value="0" <?= $prev["special_request_food"] === '0' ? "checked" : "" ?>/>
                                <label for="special_request1"><i></i>Not Applicable</label>
                            </li>
                            <li>
                                <input type="radio" class='checkbox' id="special_request2" name='special_request' value="1" <?= $prev["special_request_food"] === '1' ? "checked" : "" ?>/>
                                <label for="special_request2"><i></i>Vegetarian</label>
                            </li>
                            <li>
                                <input type="radio" class='checkbox' id="special_request3" name='special_request' value="2" <?= $prev["special_request_food"] === '2' ? "checked" : "" ?>/>
                                <label for="special_request3"><i></i>Halal</label>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p class="label">
							<?=$locale("register_online_question6_2023")?> <span class="red_txt">*</span>
						</p>
						<!-- info_check_list 클래스는 개발에서 checkbox의 box wrap을 감지하기 위한 수단으로 이용하고 있습니다. -->
                        <ul class="chk_list info_check_list">
							<?php
								$conference_info_arr = array(
									"Website of the Korean Society of Cardiovascular Disease Prevention",
									"Promotional email from the Korean Society of Cardiovascular Disease Prevention",
									"Advertising email or the bulletin board from the relevant society",
									"Information about affiliated companies/organizations",
									"Invited as a speaker, moderator, and panelist",
									"Recommended by a professor",
									"Recommended by acquaintances",
									"Pharmaceutical company",
									"Medical community (MEDI:GATE, Dr.Ville, etc.)",
									"Medical news and journals"
									);

								$prev_list = explode("*", $prev["conference_info"] ?? "");

								for($i = 1; $i <= count($conference_info_arr); $i++) {
									$content = $conference_info_arr[$i-1];
									$checked = "";
									
									if($content && in_array($content, $prev_list)){
										$checked = "checked";
									}

									echo "
										<li>
											<input type='checkbox' class='checkbox' id='list".$i."' name='list' value='".$conference_info_arr[$i-1]."' ".$checked.">
											<label for='list".$i."'>
												<i></i>".$conference_info_arr[$i-1]."
											</label>
										</li>
										";
									
								}
							?>

                        </ul>
                    </li>
					<?php if($prev["status"] != 2 && $prev["status"] != 3){?>
						<li>
							<p class="label type2"><?=$locale("register_online_question7_2023")?></p>
							<div class="table_wrap detail_table_common x_scroll">
								<table class="c_table detail_table type2">
									<colgroup>
										<col class="col_th_s">
										<col>
									</colgroup>
									<tbody>
										<tr>
											<th>Registration Fee</th>
											<td class="regi_fee">
												<!-- USD / KRW -->
												<div class="fee_chk">
												<?php
													if ($member_data['nation_no'] == 25) {
												?>
														<p class="korea_only on">KRW</p>
												<?php
													} else {
												?>
														<p class="usd_only on">USD</p>
												<?php
													}
												?>
												</div>
												<input type="text" id="reg_fee" name="reg_fee" placeholder="0" readonly value="<?=$prev["calc_fee"] || $prev["calc_fee"] == 0 ? number_format($prev["calc_fee"]) : ""?>">
											</td>
										</tr>
										<tr>
											<th>Promotion Code</th>
											<td>
												<ul class="half_ul" style="min-width:300px;">
													<li>
														<input type="text" placeholder="Promotion code" name="promotion_code" value="<?=$prev["promotion_code_number"] ?? ""?>">
														<input type="hidden" name="promotion_confirm_code" value="<?=$prev["promotion_code"] ?? ""?>"/>
													</li>
													<li><input type="text" placeholder="Recommended by" name="recommended_by" value="<?=$prev["recommended_by"] ?? ""?>" maxlength="100" onkeyup="checkRegExp(this);" onchange="checkRegExp(this);"></li>
													<li class="flex_none">
														<button type="button" class="btn gray2_btn form_btn apply_btn">Apply</button>
													</li>
												</ul>
											</td>
										</tr>
										<tr>
											<th class="red_txt">Total Registration Fee</th>
											<td><input type="text" id="total_reg_fee" name="total_reg_fee" placeholder="0" value="<?=$prev["price"] || $prev["price"] == 0 ? number_format($prev["price"]) : ""?>" readonly></td>
										</tr>
										<!-- payment_method_wrap 클래스는 개발에서 결제수단을 히든처리 및 이벤트 트리거로 이용하고 있습니다. -->
										<tr class="payment_method_wrap">
											<th>Payment Methods</th>
											<td>
												<div class="radio_wrap">
													<ul class="flex">
														<li>
															<input type="radio" id="credit" class="new_radio" name="payment_method" value="credit" <?=isset($prev["payment_methods"]) && $prev["payment_methods"] !== '1' ? "checked" : ""?>>
															<label for="credit">
																<i></i>Credit card
															</label>
														</li>
														<li>
															<input type="radio" id="bank" class="new_radio" name="payment_method" value="bank" <?=isset($prev["payment_methods"]) && $prev["payment_methods"] === '1' ? "checked" : ""?>>
															<label for="bank">
																<i></i>Wire transfer
															</label>
														</li>
													</ul>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</li>
					<?php }?>
                </ul>
				
            </form>
            <div class="btn_wrap gap">
                <!-- 활성화 시, gray_btn 제거 & blue_btn 추가 -->
                <button type="button" class="btn online_btn <?=$registrationNo ? "" : "gray_btn"?> prev_btn pointer">
					<!-- <?= $locale("prev_btn") ?> -->
					Previous
				</button>
                <button type="button" class="btn online_btn <?=$registrationNo ? "green_btn" : ""?> next_btn pointer">
					<!-- <?= $locale("next_btn") ?> -->
					<?=$registrationNo ? "Modify" : "Submit"?>
				</button>
            </div>
        </div>
    </div>
</section>

<script src="./js/script/client/registration.js?v=0.3"></script>
<script src="./js/script/client/promotion.js?v=0.3"></script>
<!-- <script src="./js/script/client/registration.js"></script> -->
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
	$(document).ready(function() {
        // alert("The registration has expired.\nOnline registration is not available.");
        // window.history.back();
        // window.location.href = "/main/index.php";
        // return;

		$('.etc1').hide();

		$(document).on("click", "#license_checkbox", function() {
			//console.log($(this).is(':checked'));
			if ($(this).is(':checked') == true) {
				$("input[name=licence_number]").attr("disabled", true);
				$("input[name=licence_number]").val("");
			} else {
				$("input[name=licence_number]").attr("disabled", false);

				$("#submit_btn").removeClass("submit_btn");
				$("#submit_btn").addClass("gray_btn");
			}
		});

		$('input[name=review]').on("change", function() {
			if($('input[name=review]:checked').val() == '1'){
				$(".review_sub_list").removeClass("hidden");
			}else{
				// init
				$(".review_sub_list input[type=text]").val("");
				$(".review_sub_list input[type=checkbox]").prop("checked", false);

				if(!$(".review_sub_list").hasClass("hidden")){
					$(".review_sub_list").addClass("hidden");
				}
			}
		});

		$(".review_sub_list input[type=checkbox]").on("change", function(){
			const checked = $(this).is(":checked");

			if(checked){
				$(this).parent().next('input').val("");
			}
		});

		$(".input_license").on("keyup", function(){
			let v = $(this).val();

			v = v.replace(/[^0-9]/gi, "").substring(0, 50);

			if(v.length > 0){
				$(this).prev().find('input[type=checkbox]').prop("checked", false);
			}
			
			$(this).val(v);
		});

		/*
		$(".apply_btn").on("click", function(){
			const promotionCode = $("input[name=promotion_code]").val();
			const recommendBy = $("input[name=recommended_by]").val();

			if(!promotionCode){
				 $("input[name=promotion_code]").focus();
				alert("Please Enter the code.");
				return
			}

			if(!recommendBy){
				$("input[name=recommended_by]").focus();
				alert("Please Enter the recommender.");
				return
			}


			if(promotionCode == 0){
				$("input[name=promotion_confirm_code]").val(0).change();
			}else if(promotionCode == 1){
				$("input[name=promotion_confirm_code]").val(1).change();
			}
		});
		*/

        $(".next_btn").on("click", function (){
             if(!$("input[name=others1]").is(":checked") | !$("input[name=others2]").is(":checked") |
                 !$("input[name=others3]").is(":checked") | !$("input[name=others4]").is(":checked")) {
                 $("#focus_others").focus();
                 alert("Please confirm the 'Others' section");
                 return false;
             }
        });

		$("select[name=category]").on("change", function(){
			const val = $(this).val();
			const prevTitle = $("input[name=title_prev_input]").val() ?? "";

			if(val === 'Others'){
				if(!$(this).parent("li").next('.hide_input').hasClass("on")){
					$(this).parent("li").next('.hide_input').addClass("on");
				}
			}else{
				$(this).parent("li").next('.hide_input').removeClass("on");
				$("input[name=title_input]").val(prevTitle);
			}
		});

        $("select[name=occupation]").on("change", function(){
            const val2 = $(this).val();
            const prevTitle2 = $("input[name=occupation_prev_input]").val() ?? "";

            if(val2 === 'Others'){
                if(!$(this).parent("li").next('.hide_input').hasClass("on")){
                    $(this).parent("li").next('.hide_input').addClass("on");
                }
            }else{
                $(this).parent("li").next('.hide_input').removeClass("on");
                $("input[name=occupation_input]").val(prevTitle2);
            }
        });

		$("input[name=reg_fee], input[name=promotion_confirm_code]").on("change", function(){
			const status =  $("input[name=promotion_confirm_code]").val() ?? "";
			let v = $("input[name=reg_fee]").val();

			v = (v != "") ? parseFloat(v.replace(/[^0-9.]/gi, "")) : 0;

			if(status !== ""){
				if(status == 0){
					v = v  - (v * 1.0);
				}else if(status == 1){
					v = v  - (v * 0.5);
				} else if(status == 2){
                    v = v  - (v * 0.3);
                }
			}

			$("input[name=total_reg_fee]").val(comma(v));

			if(v < 1){
				if(!$(".payment_method_wrap").hasClass("hidden")){
					$(".payment_method_wrap").addClass("hidden");
				}
				$(".payment_method_wrap li input[name=payment_method]:eq(0)").prop("checked", true);
                // 0628 추가
                $(".online_btn.next_btn").addClass("green_btn");
			}else{
				$(".payment_method_wrap").removeClass("hidden");
				$(".payment_method_wrap li input[name=payment_method]").prop("checked", false);
			}
		})
	});
</script>
<?php
}
include_once('./include/footer.php');
?>