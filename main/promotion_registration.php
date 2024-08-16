<?php include_once('./include/head.php');?>

<?php
    $nation_query = "SELECT
                                *
                            FROM nation
                            ORDER BY 
                            idx = 25 DESC, nation_en ASC";
    $nation_list_query = $nation_query;
    $nation_list = get_data($nation_list_query);
	$promotion_code = isset($_GET['promotion_code']) ? $_GET['promotion_code'] : '';
?>
<script src="./js/script/client/onsite_registration.js"></script>
<style>
	.ksola_signup {
		display:none;
	}
	.ksola_signup.on {
		display:revert;
	}
	.radio_list li:not(:first-child){
		margin-top:8px;
	}
	.section_div {
		margin-top:60px;
	}
    .korea_only, .korea_radio{
        display:none;
    }
    .korea_only.on, .korea_radio.on{
        display:revert;
    }
    .mo_korea_only, .korea_radio{
        display:none;
    }
    .mo_korea_only.on, .korea_radio.on{
        display:revert;
    }
</style>

<img src="./img/2024_mail_header-2.png" class="w100" alt="">
<div class="promotion_header">
	<img src="./img/icons/KSCP_logo.png"/>
	<img src="./img/icons/pop_close.png"/>
	<img src="./img/icons/ASPC_Logo_NEW.jpg"/>
</div>
<section class="container window_open onsite_register promotion_reg">
	<div class="">
		<div class="term_wrap">
			<h3 class="title">Use of Personal Information</h3>
			<div class="term_box">
			<strong>Purpose</strong>
					<p>Korean Society of Cardiovascular Disease Prevention (KSCP) provides online pre-registration services for IMCVP 2024. Based on your personal information, you can sign up for the conference and complete the payment for registration.</p>
					<strong>Collecting Personal Information</strong>
					<p>IMCVP 2024 requires you to provide your personal information to complete pre-registration online. You will be asked to enter your name, ID (email), password, date of birth, institution/organization, department, mobile, and telephone number.</p>
					<strong>Storing Personal Information</strong>
					<p>IMCVP 2024 will continue to store your personal information to provide you with useful services, such as conference updates and newsletters.</p>
			</div>
			<div class="term_label">
				<input type="checkbox" class="checkbox input required" data-name="terms 1" id="terms1" name="terms1" value="Y">
				<label for="terms1" class="terms1_label">I agree to the collection and use of my personal information. </label>
			</div>	
		</div>
		<div class="section_div">
			<h3 class="title">Participant Information<span class="mini_alert"><span class="red_txt font_inherit">*</span>All requested field (<span class="red_txt font_inherit">*</span>) should be completed.</span></h3>
			<div class="table_wrap detail_table_common x_scroll">
				<table class="table detail_table">
					<colgroup>
						<col class="col_th"/>
						<col width="*"/>
					</colgroup>
					<tbody>
						<tr>
							<th><span class="red_txt">*</span> Country</th>
							<td>
								<div class="max_normal">
									<select id="nation_no" name="nation_no" class="required" onChange="calc_fee()">
										<option value="" selected hidden>Choose</option>
									<?php
										foreach($nation_list AS $n) {
											if($language == "ko") {
												$nation = $n["nation_ko"];
											} else {
												$nation = $n["nation_en"];
											}
									?>
										<option data-nt="<?= $n['nation_tel']; ?>" value="<?=$n["idx"]?>" <?=$select_option?>><?=$nation?></option>
									<?php
										}
									?>
									</select>
								</div>
							</td>
						</tr>
						<tr class="korea_radio">
							<th class="nowrap"><span class="red_txt">*</span> 대한심뇌혈관질환예방학회(KSCP) 회원 여부</th>
							<td>
								<div class="label_wrap">
									<input type="radio" class="new_radio" name="user" id="user1" value="1">
									<label for="user1"><i></i>회원</label>
									<input checked type="radio" class="new_radio" name="user" id="user2" value="0">
									<label for="user2"><i></i>비회원</label>
                                    <input type="hidden" name="ksso_member_check">
                                    <input type="hidden" name="ksso_member_type">
								</div>
							</td>
						</tr>
						<tr class="ksola_signup">
							<th style="background-color:transparent"></th>
							<td>
								<p>대한심뇌혈관질환예방학회 회원 정보로 간편 가입</p>
								<ul class="simple_join clearfix">
									<li>
										<label for="">KSCP Email<span class="red_txt">*</span></label>
										<input class="email_id" name="kor_id" type="text" maxlength="60">
									</li>
									<li>
										<label for="">성함<span class="red_txt">*</span></label>
										<input class="" name="kor_name" type="text" maxlength="60">
									</li>
									<li>
										</li>
									</ul>
									<button onclick="kor_api()" type="button" class="btn">회원인증</button>
									<a href="https://www.kosso.or.kr/join/search_id.html" target="_blank" class="id_pw_find" style="padding: 6px 10px;">KSSO 회원 ID/PW 찾기</a>
								<div class="clearfix2">
									<div>
										<input type="checkbox" class="checkbox" id="privacy">
										<label for="privacy">
											제 3자 개인정보 수집에 동의합니다.
										</label>
									</div>
									
								</div>
							</td>
						</tr>
						<tr>
							<th><span class="red_txt">*</span> ID(email)</th>
							<td>
								<div class="max_long responsive_float">
									<input type="text" name="email" class="required" maxlength="50">
								</div>
								<span class="mini_alert brown_txt">Please make sure you have entered your ID correctly as you can't modify it later.</span>
							</td>
						</tr>
						<tr>
							<th><span class="red_txt">*</span> Password</th>
							<td>
								<div class="max_long">
									<input class="passwords" type="password" name="password" class="required" placeholder="Password" maxlength="60">
								</div>
							</td>
						</tr>
						<tr>
							<th><span class="red_txt">*</span> Verify Password</th>
							<td>
								<div class="max_long">
									<input class="passwords" type="password" name="password2" class="required" placeholder="Re-type Password" maxlength="60">
								</div>
							</td>
						</tr>
						<!-- Name -->
						<tr>
							<th><span class="red_txt">*</span> Name</th>
							<td class="name_td clearfix">
								<div class="max_normal">
									<input name="first_name" type="text" placeholder="First name" maxlength="60">
								</div>
								<div class="max_normal">
									<input name="last_name" type="text" placeholder="Last name" maxlength="60">
								</div>
							</td>
						</tr>
						<tr class="korea_only">
							<th><span class="red_txt">*</span> 성명</th>
							<td class="name_td clearfix">
								<div class="max_normal">
									<input name="first_name_kor" type="text" placeholder="이름" maxlength="60">
								</div>
								<div class="max_normal">
									<input name="last_name_kor" type="text" placeholder="성" maxlength="60">
								</div>
							</td>
						</tr>
						<tr>
							<th><span class="red_txt">*</span> Affiliation (Institute)</th>
							<td>
								<div class="max_long">
									<input type="text" name="affiliation" maxlength="100">
								</div>
							</td>
						</tr>
						<tr class="korea_only">
							<th><span class="red_txt">*</span>소속</th>
							<td>
								<div class="max_long">
									<input type="text" name="affiliation_kor" maxlength="100">
								</div>
							</td>
						</tr>
						<!-- Department -->
						<tr>
							<th><span class="red_txt">*</span> Department</th>
							<td>
								<div class="max_long">
									<input type="text" name="department" maxlength="100">
								</div>
							</td>
						</tr>
						<tr class="korea_only">
							<th><span class="red_txt">*</span>부서</th>
							<td>
								<div class="max_long">
									<input type="text" name="department_kor" maxlength="100">
								</div>
							</td>
						</tr>
						<tr>
							<th rowspan = "2"><span class="red_txt">*</span>Mobile Phone Number</th>
							<td>
								<div class="max_normal phone">
									<input class="numbers" name="nation_tel" type="text" maxlength="60" readonly>
									<input name="phone" id="phone" type="text" maxlength="15">
								</div>
							</td>
						</tr>
						<tr>
							<td class="font_small brown_txt">Please enter your phone number including the country codes.<br/>(Example: 82 1012341234)</td>
						</tr>
						<!--2022-05-09 추가사항-->
						<tr>
							<th><span class="red_txt">*</span>Date of Birth</th>
							<td>
								<div class="max_normal">
									<input name="date_of_birth" pattern="^[0-9]+$"  type="text" placeholder="dd-mm-yyyy" id="datepicker" onKeyup="birthChk(this)"/>
									<!-- <span class="mini_alert red_txt red_alert">good</span> -->
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="section_div">
			<h3 class="title">Registration Information</h3>
			<div class="table_wrap detail_table_common x_scroll">
				<table class="table detail_table">
					<colgroup>
						<col class="col_th"/>
						<col width="*"/>
					</colgroup>
					<tbody>
						<tr>
							<th><span class="red_txt">*</span> Type of Participation</th>
							<td>
								<div class="max_normal">
									<select id="participation_type" name="participation_type" class="required" onChange="calc_fee()">
                                        <option value="" selected hidden>Choose</option>
                                        <?php
                                        $participation_arr = array("Participants", "Committee", "Speaker", "Chairperson", "Panel", "Sponsor");
                                      
										foreach($participation_arr as $a_arr) {
											$attendance_type = "";
											if(!empty($prev["attendance_type"])){
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
												default:
													$attendance_type = "Participants";
											}
										}else{
											$attendance_type = "Participants";
										}
											$selected = $attendance_type === $a_arr ? "selected" : "";

											echo '<option value="'.$a_arr.'" '.$selected.'>'.$a_arr.'</option>';
		//									$idx = $idx + 1;
										}
									?>
									</select>
								</div>
							</td>
						</tr>

						<tr>
							<th><span class="red_txt">*</span> Category</th>
							<td>
								<ul class="max_normal flex_hide">
                                    <li>
                                        <select id="category" name="category" class="required" onChange="calc_fee()">
                                            <option value="" selected hidden>Choose</option>
                                            <?php
                                            $category_arr = array("Certified M.D.", "Professor", "Researcher", "Nutritionist", "Exercise Specialist", "Nurse", "Pharmacist", "Trainee","Student", "Others");

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
							</td>
						</tr>
						<tr class="korea_only">
							<th><span class="red_txt">*</span> 평점 신청</th>
							<td>
								<div class="label_wrap">
									<input type="radio" class="new_radio" name="review" id="review1" value="1">
									<label for="review1"><i></i>신청함</label>
									<input checked="" type="radio" class="new_radio" name="review" id="review2" value="0">
									<label for="review2"><i></i>신청 안 함</label>
								</div>
							</td>
						</tr>
						<tr class="review_sub_list korea_only">
							<th>의사 면허번호</th>
							<td>
								<div class="max_normal">
									<input type="text" name="licence_number" id="licence_number">
								</div>
							</td>
						</tr>
						<tr class="review_sub_list korea_only">
							<th>전문의 번호</th>
							<td>
								<div class="max_normal">
									<input type="text" name="specialty_number" id="specialty_number">
								</div>
							</td>
						</tr>
						<tr>
							<th><span class="red_txt">*</span> Others</th>
							<td>
								<ul class="radio_list">
                                    <?php
                                        $others_arr = array(
											"Day 1 Luncheon Symposium",
											"Day 1 Satellite Symposium",
											"Day 2 Breakfast Symposium",
											"Day 2 Luncheon Symposium",
											"Day 2 Satellite Symposium"
										);

                                        for($i = 1; $i <= count($others_arr); $i++) {
                                            $content = $others_arr[$i-1];
                                            $checked = "";

                                            if($content && in_array($content, $prev_list)){
                                                $checked = "checked";
                                            }

                                            echo "
                                            <li>
                                                <input type='checkbox' class='checkbox other_check' id='others".$i."' name='others' value='".$others_arr[$i-1]."' ".$checked.">
                                                <label for='others".$i."'>
                                                    <i></i>".$others_arr[$i-1]."
                                                </label>
                                            </li>
                                            ";

                                        }
                                    ?>
								</ul>
							</td>
						</tr>
                        <tr>
                            <th><span class="red_txt">*</span> Special Request for Food</th>
                            <td>
                                <ul class="chk_list info_check_list flex_center type2">
                                    <?= $prev["special_request_food"] === '0' ? "selected" : "" ?>
                                    <li>
                                        <input type="radio" class='new_radio' id="special_request1" name='special_request' value="0" <?= $prev["special_request_food"] === '0' ? "checked" : "" ?>/>
                                        <label for="special_request1"><i></i>Not Applicable</label>
                                    </li>
                                    <li>
                                        <input type="radio" class='new_radio' id="special_request2" name='special_request' value="1" <?= $prev["special_request_food"] === '1' ? "checked" : "" ?>/>
                                        <label for="special_request2"><i></i>Vegetarian</label>
                                    </li>
                                    <li>
                                        <input type="radio" class='new_radio' id="special_request3" name='special_request' value="2" <?= $prev["special_request_food"] === '2' ? "checked" : "" ?>/>
                                        <label for="special_request3"><i></i>Halal</label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
						<tr>
							<th><span class="red_txt">*</span> Where did you get the information about the conference?</th>
							<td>
								<ul class="radio_list">
                                    <?php
                                        $conference_info_arr = array(
											"Advertising email or the bulletin board from the ASPC (The American Society for Preventive Cardiology)"
                                        );

                                        $prev_list = explode("*", $prev["conference_info"] ?? "");

                                        for($i = 1; $i <= count($conference_info_arr); $i++) {
                                            $content = $conference_info_arr[$i-1];
                                            $checked = "checked";

                                            if($content && in_array($content, $prev_list)){
                                                $checked = "checked";
                                            }

                                            echo "
                                            <li>
                                                <input type='checkbox' class='checkbox other_check' id='list".$i."' name='list' value='".$conference_info_arr[$i-1]."' ".$checked.">
                                                <label for='list".$i."'>
                                                    <i></i>".$conference_info_arr[$i-1]."
                                                </label>
                                            </li>
                                            ";

                                        }
                                    ?>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="section_div">
			<h3 class="title">Registration fee</h3>
			<div class="table_wrap detail_table_common x_scroll">
				<table class="table detail_table">
					<colgroup>
						<col class="col_th"/>
						<col width="*"/>
					</colgroup>
					<tbody>
						<tr>
							<th>Total</th>
							<td><input type="text" id="reg_fee" name="reg_fee" style="border: none; background: transparent;" placeholder="0" readonly value="<?=$prev["calc_fee"] || $prev["calc_fee"] == 0 ? number_format($prev["calc_fee"]) : ""?>"></td>
						</tr>
						<tr class="">
							<th>Invitation Code</th>
							<td>
								<ul class="half_ul" style="min-width:300px;justify-content :flex-start;">
									<li>
										<input type="text" placeholder="Invitation Code" name="promotion_code" value="<?=$promotion_code ?? ""?>" disabled>
										<input type="hidden" name="promotion_confirm_code"/>
									</li>
									<!-- <li><input type="text" placeholder="Recommended by" name="recommended_by" value="<?=$prev["recommended_by"] ?? ""?>" maxlength="100" onkeyup="checkRegExp(this);" onchange="checkRegExp(this);"></li>-->
									<!-- <li class="">
										<button type="button" class="btn gray2_btn form_btn apply_btn" style="color:#FFF!important">Apply</button>
									</li>  -->
								</ul>
							</td>
						</tr>
						<tr>
							<th>Payment Methods</th>
							<td>
								<ul class="chk_list info_check_list flex_center type2">
                                    <li>
                                        <input type="radio" class='new_radio' id="card" name='payment_method' value="1"/>
                                        <label for="card"><i></i>Credit card</label>
                                    </li>
                                    <li>
                                        <input type="radio" class='new_radio' id="bank" name='payment_method' value="2"/>
                                        <label for="bank"><i></i>Wire transfer</label>
                                    </li>
                                </ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="pager_btn_wrap half">
			<button id="submit" type="button" class="btn green_btn" onclick="promotion_submit()">Submit</button>
		</div>
	</div>
</section>
<script src="./js/script/client/promotion.js?v=0.3"></script>
<script>
	$(document).ready(function(){
        $("select[name=nation_no]").change(function(){

            var value = $(this).val();

            if (value == 25){

                $(".korea_only").addClass("on");
                $(".korea_radio").addClass("on");
            } else {
                $(".korea_radio").removeClass("on");
                $(".korea_only").removeClass("on");
                $(".ksola_signup").removeClass("on");

                remove_value();
                $("#user2").prop('checked', true);
            }

            var nt = $("#nation_no option:selected").data("nt");
            $("input[name=nation_tel]").val(nt);
            $("input[name=tel_nation_tel]").val(nt);


            $("input[name=ksso_member_type]").val('');
            $("input[name=ksso_member_check]").val('');

        });

        $("input[name='user']:radio").change(function (){
            calc_fee();
        });

        $("#user1").change(function(){
			if($("#user1").prop('checked') == true) {
				$(".ksola_signup").addClass("on");
			}
		});
		$("#user2").change(function(){
			if($("#user2").prop('checked') == true) {
				$(".ksola_signup").removeClass("on");
				$("input[name=ksola_member_type]").val("");
			}
		});

        $("select[name=category]").on("change", function(){
            const val = $(this).val();
            const prevTitle = $("input[name=title_prev_input]").val() ?? "";

            if(val == 'Others'){
                if(!$(this).parent("li").next('.hide_input').hasClass("on")){
                    $(this).parent("li").next('.hide_input').addClass("on");
                }
            }else{
                $(this).parent("li").next('.hide_input').removeClass("on");
                $("input[name=title_input]").val(prevTitle);
            }
        });

		
		$("input[name=promotion_confirm_code]").on("change", function(){
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
			console.log(v)
			$("input[name=reg_fee]").val(comma(v));

			// if(v < 1){
			// 	if(!$(".payment_method_wrap").hasClass("hidden")){
			// 		$(".payment_method_wrap").addClass("hidden");
			// 	}
			// 	$(".payment_method_wrap li input[name=payment_method]:eq(0)").prop("checked", true);
            //     // 0628 추가
            //     $(".online_btn.next_btn").addClass("green_btn");
			// }else{
			// 	$(".payment_method_wrap").removeClass("hidden");
			// 	$(".payment_method_wrap li input[name=payment_method]").prop("checked", false);
			// }
		})
	});
</script>
