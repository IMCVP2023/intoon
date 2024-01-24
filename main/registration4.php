<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	//if($_SERVER["HTTP_HOST"] == "www.icomes.or.kr") {
	//	echo "<script>location.replace('http://54.180.86.106/main/registration.php')</script>";
	//}


	$sql_during =	"SELECT
						IF(NOW() BETWEEN '2022-08-31 14:00:00' AND '2022-09-03 23:59:59', 'Y', 'N') AS yn
					FROM DUAL";

	/*$sql_during =	"SELECT
						IF(NOW() BETWEEN '2022-08-30 12:00:00' AND '2022-08-30 14:00:00', 'Y', 'N') AS yn
					FROM DUAL";*/
	$during_yn = sql_fetch($sql_during)['yn'];
	if ($during_yn !== "Y") {
?>

<section class="submit_application container">
	<h1 class="page_title">Online Registration</h1>
	<div class="inner">
		<section class="coming">
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
		$nation_list_query = $nation_query;
		$nation_list = get_data($nation_list_query);

		if(!empty($_SESSION["USER"])){
			echo "<script>alert('Not Need to login'); window.location.replace(PATH+'index.php');</script>";
			exit;
		}
		
		$_arr_phone = explode("-",$user_info["phone"]);
		$nation_tel = $_arr_phone[0];
		$phone = implode("-",array_splice($_arr_phone, 1));

		$sql_price =	"SELECT
							type_en, idx
						FROM info_event_price
						WHERE is_deleted = 'N'
						ORDER BY FIELD(idx, 1,2,3,4,5,6,7,8,9,10,12,11)";
		$price = get_data($sql_price);
?>
<style>
	/*2022-04-14 ldh 추가*/
	.gray_btn {
		pointer-events: none; 
	}
	/*.is_scroe_txt {
		font-size : 24px;
	}*/
	/*2022-08-23 ldh 추가*/
	.sign_checkbox_wrap{margin:37px 0 130px; }
	.sign_checkbox_wrap li:not(:first-child){margin-top:34px;}
	.sign_checkbox + label {display:block; position:relative; font-size:16px; font-weight:bold;}
	.sign_checkbox_wrap a{margin-left:18px; font-weight:400;}
	.sign_checkbox + label:before {
    content: '';
    border: 1px solid #B2B2B2;
    width: 19px;
    height: 19px;
    display: inline-block;
    position: absolute;
	top: 50%;
    right: 0;
    transform: translateY(-50%)
    vertical-align: middle;
    cursor: pointer;
    margin-right: 5px;
    border-radius: 5px;}

	/*2022-08-26 ljh 추가*/
	.not_applied_txt {font-size: inherit; word-break: keep-all;}
</style>

<section class="container online_register submit_application">
	<div class="inner">
		<div class="sub_banner">
			<h1>Online Registration</h1>
		</div>
		<div class="input_area">
			<h3 class="title"><?=$locale("participant_tit")?></h3>
			<div class="details details_bg">
				<ul>
					<li>* After pre-registration and payment are completed, a registration approval letter will be sent to the email you entered. If you do not receive an e-mail after registration is complete, please reply to the office.<br/>(mail : icomes_registration@into-on.com)</li>
					<li>* Please register doctor’s license number for GPA</li>
					<li class="red_txt">※ Please fill out all registration information below in English. </li>
				</ul>
			</div>
			<form name="registration_form" class="registration_form" onsubmit="return false">
			<ul class="basic_ul">
				<li>
					<p class="label"><?=$locale("online_offline")?> <span class="red_txt">*</span></p>
					<div>
						<div class="radio_wrap">
							<ul class="flex">
								<li>
									<input checked type="radio" class="radio registration_check" id="offline" name="registration_type" value="0"><label for="offline"><!--<?=$locale("online_offline_select3")?>-->On-site</label>
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li id="chk_org">
					<p class="label">평점신청(Korean Only) <span class="red_txt">*</span></p>
					<div>
						<div class="radio_wrap">
							<ul class="flex">
								<li>
									<input type="radio" class="radio registration_check" id="radio1" name="rating" value="1"><label for="radio1">신청</label>
								</li>
								<li>
									<input type="radio" class="radio registration_check" id="radio2" name="rating" value="0"><label for="radio2">미신청 <span class="red_txt not_applied_txt">(Overseas participants, please check '미신청').</span></label>
									
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li>
					<p class="label"><!--<?=$locale("member_status")?>-->KSSO Member Status(Korean Only) <span class="red_txt">*</span></p>
					<div>
						<div class="radio_wrap">
							<ul class="flex">
								<li>
									<input type="radio" class="radio registration_check" id="member" name="member_status" value="1"><label for="member"><?=$locale("member_status_select1")?></label>
								</li>
								<li>
									<input type="radio" class="radio registration_check" id="non_member" name="member_status" value="0"><label for="non_member"><?=$locale("member_status_select2")?></label>
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li>
					<p class="label"><?=$locale("id")?> <span class="red_txt">*</span></p>
					<div>
						<input class="registration_check" type="text" value="<?=isset($user_info["email"]) ? $user_info["email"] : "" ?>" name="email">
					</div>
				</li>
				<li>
					<p class="label"><?=$locale("country")?> <span class="red_txt">*</span></p>
					<div>
						<select class="required" name="nation_no" id="nation_no" onchange="alert_check()"> 
							<option value="" selected hidden>Choose</option>
							<?php
								foreach($nation_list AS $n) {
									if($language == "ko") {
										$nation = $n["nation_ko"];
									} else {
										$nation = $n["nation_en"];
									}
							?>
								<option value="<?=$n["idx"]?>" <?=$select_option?>><?=$nation?></option>
							<?php
								}	
							?>
						</select>
					</div>
				</li>
				<li>
					<p class="label"><?=$locale("name")?> <span class="red_txt">*</span></p>
					<div class="name_div clearfix2">
						<input class="registration_check name" type="text" value="<?=isset($user_info["first_name"]) ? $user_info["first_name"] : ""?>" name="first_name">
						<input class="registration_check name" type="text" value="<?=isset($user_info["last_name"]) ? $user_info["last_name"] : ""?>" name="last_name">
					</div>
				</li>
				<li>
					<p class="label"><?=$locale("phone")?> <span class="red_txt">*</span></p>
					<div class="phone_div clearfix2">
						<select class="" name="nation_tel"> 
							<option value="<?=$nation_tel?>" selected><?=$nation_tel?></option>
						</select>
						<input class="registration_check" type="text" value="<?=$phone?>" name="phone">
					</div>
				</li>
				<li>
					<p class="label"><!--<?=$locale("registration_type")?>-->Attendance type <span class="red_txt">*</span></p>
					<div>
						<div class="radio_wrap">
							<ul class="flex">
								<li>
									<input type="radio" class="radio registration_check" id="r_type1" name="attendance_type" value="0"><label for="r_type1"><?=$locale("registration_type_select1")?></label>
								</li>
								<li>
									<input type="radio" class="radio registration_check" id="r_type2" name="attendance_type" value="1"><label for="r_type2">Speaker / Chairman / Panel</label>
								</li>
								<li>
									<input type="radio" class="radio registration_check" id="r_type3" name="attendance_type" value="2"><label for="r_type3"><?=$locale("registration_type_select3")?></label>
								</li>
								<li>
									<input type="radio" class="radio registration_check" id="r_type4" name="attendance_type" value="3"><label for="r_type4">Sponsors</label>
								</li>
							</ul>
						</div>
					</div>
					<div class="write_position"><input class="en_keyup" name="write_position" type="text" placeholder="position" onchange="write_check()"></div>
				</li>
				<li id="chk_member_type">
					<p class="label"><?=$locale("member_type")?> <span class="red_txt">*</span></p>
					<div>
						<select class="registration_check" name="member_type"> 
							<option value="" selected hidden>Choose</option>
							<?php
								foreach ($price as $pr) {
							?>
							<option value="<?=$pr['idx']?>"><?=$pr['type_en']?></option>
							<?php
								}
							?>
						</select>
					</div>
				</li>
				<li>
					<p class="label"><?=$locale("affiliation")?> <span class="red_txt">*</span></p>
					<div>
						<input class="registration_check en_keyup" maxlength="50" type="text" name="affiliation" value="<?=$user_info["affiliation"]?>">
					</div>
				</li>
				<li>
					<p class="label"><?=$locale("department")?></p>
					<div>
						<input type="text" name="department" class="en_keyup" maxlength="50" value="<?=$user_info["department"]?>">
					</div>
				</li>
				<li>
					<p class="label">
						<!--<?=$locale("licence_number")?>-->License number <span class="red_txt">*</span>
						<input type="checkbox" class="radio license_check" id="license_checkbox" name="license_checkbox" <?= ($user_info["licence_number"] == "Not applicable") ? "checked" : ""; ?>>
						<label for="license_checkbox" class="tight license_check">Not applicable</label>
					</p>
					<input class="license_check" <?= ($user_info["licence_number"] == "Not applicable") ? "disabled" : ""; ?> type="text" value="<?=($user_info["licence_number"] == "Not applicable") ? "" : $user_info["licence_number"]; ?>" name="licence_number" maxlength="50">
				</li>	
				<li>
					<p class="label"><?=$locale("register_path")?><span class="red_txt"></span></p>
					<div>
						<select name="register_path"> 
							<option selected hidden>Choose</option>
							<option value="ICOMES 2022 promotional mail">ICOMES 2022 promotional mail</option>
							<option value="ICOMES 2022 website">ICOMES 2022 website</option>
							<option value="Bulletin board on the website of the relevant society">Bulletin board on the website of the relevant society</option>
							<option value="Korean Society of Obesity website bulletin board">Korean Society of Obesity website bulletin board</option>
							<option value="Recommendation from an acquaintance">Recommendation from an acquaintance</option>
							<option value="Professor recommendation">Professor recommendation</option>
							<option value="Medical newspaper">Medical newspaper</option>
							<option value="Pharmaceutical company">Pharmaceutical company</option>
							<option value="Other (subjective)">Other (subjective)</option>
						</select>
						<!--기타 선택시 input 옆에 추가되어야 함-->
						<input type="text" class="etc1 en_keyup" style="display:none;" value="" placeholder="Please enter other information.">
					</div>
				</li>
			</ul>
			
			<div class="sign_checkbox_wrap">
				<ul>
					<li>
						<input type="checkbox" class="sign_checkbox checkbox input required" data-name="terms 1" id="terms1" name="terms1" value="Y">
						<label for="terms1">Terms
							<a href="javascript:;" class="term1_btn red_txt"> Details ></a>
						</label>
					</li>
					<li>
						<input type="checkbox" class="sign_checkbox checkbox input required" data-name="terms 2" id="terms2" name="terms2" value="Y">
						<label for="terms2"> Privacy Policy 
							<a href="javascript:;" class="term2_btn red_txt"> Details ></a>
						</label>
					</li>
				</ul>
			</div>
			</form>
			<div class="btn_wrap">
				<!-- 활성화 시, gray_btn 제거 & green_btn 추가 -->
				<button type="button" class="btn online_btn gray_btn next_btn pointer"><?=$locale("next_btn")?></button>
			</div>
		</div>
	</div>
</section>
<div class="loading">
	<img src="./img/icons/loading.gif"/>
</div>

<div class="popup term1">
	<div class="pop_bg"></div>
	<div class="pop_contents">
		<p class="pre"><?=$locale("terms")?></p>
	</div>
</div>

</div>
<div class="popup term2">
	<div class="pop_bg"></div>
	<div class="pop_contents">
		<p class="pre"><?=$locale("privacy")?></p>
		
	</div>
</div>

<script src="./js/script/client/new_registration.js?v=0.5"></script>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
	$(document).ready(function(){
		$('.etc1').hide();
		$("input[name='attendance_type']").click(function(){
			if($(this).val() == "2"){
				$(".write_position").show();
			}else{
				$(".write_position").hide();
				$("input[name=write_position]").val("");
			}
		});

		$(document).on("click", "#license_checkbox", function(){
			if($(this).is(':checked') == true) {
				$("input[name=licence_number]").attr("disabled", true);
				$("input[name=licence_number]").val("");
			} else {
				$("input[name=licence_number]").attr("disabled", false);
							
				$("#submit_btn").removeClass("submit_btn");
				$("#submit_btn").addClass("gray_btn");
			}
		});

		$('select[name=nation_no]').val('25').trigger('change');

		//이메일 중복 검증
		$("input[name=email]").on("change", function(){
			var email = $(this).val();
			var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
			
			if(email.match(regExp) != null) {
				$.ajax({
					url : PATH+"ajax/client/ajax_member.php", 
					type : "POST", 
					data :  {
						flag : "id_check",
						email : email
					},
					dataType : "JSON", 
					success : function(res){
						if(res.code == 200) {
						} else if(res.code == 400) {
							alert(locale(language.value)("used_email_msg"));
							$("input[name=email]").val("").focus();
							write_check();
							return;
						} else {
							alert(locale(language.value)("reject_msg"))
							write_check();
							return;
						}
					}
				});
			} else {
				alert(locale(language.value)("format_email"));
				$(this).val("").focus();
				return;
			}
			write_check();
		});

		//비밀번호 띄어쓰기 막기
		$(".passwords").on("keyup", function(){
			$(this).val($(this).val().replace(/[\s]/g,""));
		});

		$('.term1_btn').on('click',function(){
			$('.term1').show();
			$('#terms1').attr("checked", true);
		});
		$('.term2_btn').on('click',function(){
			$('.term2').show();
			$('#terms2').attr("checked", true);
		});
	});

	$(document).on("change", "input[name=first_name]", function(){
		$(".first_name").val($(this).val());
	});

	$(document).on("change", "input[name=last_name]", function(){
		$(".last_name").val($(this).val());
	});

	//핸드폰 유효성
	$(document).on('change keyup', "input[name=phone]",function(key){
		var _this = $(this);
		if(key.keyCode != 8) {
			var phone = _this.val().replace(/[^0-9||-]/gi,'');
			_this.val(phone);
		}
	});

	//국가 선택 시 국가번호 append
	$("select[name=nation_no]").on("change", function(){
		var nation = $(this).find("option:selected").val();
		var nation_tel_length = $("select[name=nation_tel] option").length;
		$.ajax({
			url : PATH+"ajax/ajax_nation.php",
			type : "POST",
			data : {
				flag : "nation_tel",
				nation : nation
			},
			dataType : "JSON",
			success : function(res) {
				if(res.code == 200) {
					if(nation_tel_length => 2) {
						$("select[name=nation_tel] option").not(":eq(0)").detach();
						$("select[name=nation_tel]").append("<option selected>"+res.tel+"</option>");
					} else {
						$("select[name=nation_tel]").append("<option selected>"+res.tel+"</option>");
					}
				}
			}
		});
	});
	
	$("input[name='attendance_type']").click(function(){
		if($(this).val() == "2"){
			$(".write_position").addClass("on");
		}else{
			$(".write_position").removeClass("on");
		}
	})

	$('select[name=register_path]').on("change", function(){
		if($('select[name=register_path]').val() == "Other (subjective)"){
			$('.etc1').show();
		}else{
			$('.etc1').hide();
			$('.etc1').val(null);
		}
	});

	$('input[name=rating]').on("change", function(){
		if($('input[name=rating]:checked').val() == '1'){
				html = '';
				html += '<li id="applied_org">';
				html +=	 '<p class="label"><?php echo $locale("applied_org")?> *</p>';
				html +=	 '<div>';
				html +=		 '<div class="radio_wrap">';
				html +=			 '<ul>';
				html +=				'<li class="pBot_10">- <?php echo $locale("applied_org_notice1")?></li>';
				html +=				'<li class="pBot_10">- <?php echo $locale("applied_org_notice2")?></li>';
				html +=				 '<li>';
				html +=					 '<input type="checkbox" class="checkbox registration_check org_01" id="checkbox1" name="org" value="1"><label for="checkbox1"><?php echo $locale("applied_org1")?></label>';
				html +=				 '</li>';
				html +=				 '<li>';
				html +=					 '<input type="checkbox" class="checkbox registration_check org_03" id="checkbox3" name="org" value="3"><label for="checkbox3"><?php echo $locale("applied_org3")?></label>';
				html +=				 '</li>';
				html +=				 '<li>';
				html +=					 '<input type="checkbox" class="checkbox registration_check org_04" id="checkbox4" name="org" value="4"><label for="checkbox4"><?php echo $locale("applied_org4")?></label>';
				html +=				 '</li>';
				html +=				 '<li>';
				html +=					 '<input type="hidden" id="result_org" name="result_org">';
				html +=				 '</li>';
				html +=		 '</div>';
				html +=	 '</div>';
				html += '</li>';
				
				$('#chk_org').after(html);
				$("input[name=org]").on("change", function(){
					var result = Array();
					var cnt = 0;
					var chkbox = $(".checkbox");
					for(i=0;i<chkbox.length;i++) {
						if(chkbox[i].checked == true) {
							result[cnt] = chkbox[i].value;
							cnt++;
						}
					}
					$('#result_org').val(result);
				});
		}else{
			$('#applied_org').remove();
		}
	});

	// Invitation letter for VISA application
	$("input[name='invitation']").click(function(){
		if($(this).is(":checked")){
			$(this).val("Y");
			$(".want_invitation_wrap").addClass("on");
		}else{
			$(this).val("");
			$(".want_invitation_wrap").removeClass("on");
		}
	});

	//생년월일유효성
	$(document).on('change keyup', ".date_input",function(key){
		var _this = $(this);
		if(key.keyCode != 8) {
			var date_of_birth = _this.val().replace(/[^0-9]/gi,'');
				if(date_of_birth.length > 9) {
					date_of_birth = date_of_birth.substr(0,2) + "-" + date_of_birth.substr(2,2) + "-" + date_of_birth.substr(4,4);
				} else if(date_of_birth.length > 4) {
					date_of_birth = date_of_birth.substr(0,2) + "-"+date_of_birth.substr(2,2)+"-"+date_of_birth.substr(4,4);
				} else if(date_of_birth.length > 2) {
					date_of_birth = date_of_birth.substr(0,2) +"-" +date_of_birth.substr(2,2);
				}
			_this.val(date_of_birth);
		}
	});

	$(document).on("keyup", ".en_keyup", function(key){
		var pattern_eng = /[^a-zA-Z\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	$(document).on("keyup", ".ko_keyup", function(key){
		var pattern_eng = /[^ㄱ-ㅎ가-힣\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	$(document).on("keyup", ".num_keyup", function(key){
		var pattern_eng = /[^0-9]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	$(document).on("keyup", ".en_num_keyup", function(key){
		var pattern_eng = /[^0-9||a-zA-Z\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	$("input[name=licence_number]").on("change keyup", function(key){
		var pattern_eng = /[^0-9||~-\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	$("input[name=address]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z||0-9\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	$("input[name=passport_number]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z||0-9||~-\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});
	$("input[name=length_of_visit]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z||0-9||~-\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	$(".registration_check").on("change keyup", function(){
		write_check();
	});

	$(".license_check").on("change keyup", function(){
		write_check();
	});

	function write_check() {
		var result = requiredCheck3();
		var result2 = license_number_check();
		
		if(result && result2) {
			$(".btn.online_btn").addClass("green_btn").removeClass("gray_btn");
		} else {
			$(".btn.online_btn").removeClass("green_btn").addClass("gray_btn");
		}
	}
	
function license_number_check() {
	var licence_number = $("input[name=licence_number]").val();
	var licence_number_len = licence_number.trim().length;
	licence_number = (typeof(licence_number) != "undefined") ? licence_number : null;

	if($("#license_checkbox").is(':checked') == false) {
		if(!licence_number || licence_number_len <= 0) {
			return false;
		}
	}
	return true;
}

function requiredCheck3() {
	var registration_check = $(".registration_check");
	var required_val;
	for(i=0; i<registration_check.length; i++) {
		
		required_val = $(registration_check[i]).val();
		if(required_val.trim().length <= 0 || $(registration_check[i]).val() == "" || $(registration_check[i]).val() == null) {
			return false;
		}
	}
	if(!$("input[name=member_status]").is(":checked") || !$("input[name=registration_type]").is(":checked") || !$("input[name=rating]").is(":checked") || !$("input[name=attendance_type]").is(":checked")) {
		return false;
	}
	return true;
}

function alert_check() {
	if($("#online:checked").val() == 1 && $("select[name=nation_no]").val() == 25) {
		alert("Only overseas attendees can select this option");
		$("#online").prop("checked", false);
	}
}
</script>

<?php
	}
	include_once('./include/footer.php');
?>
