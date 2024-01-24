<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php
	$nation_query = "SELECT
							*
						FROM nation
						ORDER BY 
						idx = 25 DESC, nation_en ASC";
		//$nation_list_query = $_nation_query;
		$nation_list_query = $nation_query;
		$nation_list = get_data($nation_list_query);
?>

<style>
	/* 21.05.31 안재현 */
	/*.submit_btn{background:#ADF000; color:#fff; border-color:#ADF000;}*/
	.submit_btn{width:100%; background:#10BF99; color:#fff; border-color:#10BF99;}

	/* 2022.04.01*/
	.gray_btn {
		background: #9e9e9e;
		color: #fff;
		font-size: 18px;
		height: 50px;
		width: 100%;
		color: #fff;
		border-color: #10BF99;
		border-radius: 30px;
		margin-top: 100px;
		pointer-events: none;
	}
</style>

<section class="signup form_section">
	<!-- <a href="./index.php" class="logo"><img src="./img/logo.png"></a> -->
	<h1 class="page_title">Sign up</h1>
	<form name="signup_form">
		<ul class="signup_list">
			<li>
				<p class="label"><?=$locale("id")?> <span class="red_txt">*</span></p>
				<input type="text" name="email" class="required" placeholder="ID(email)" maxlength="50" onchange="check_value()">
			</li>	
			<li>
				<p class="label"><?=$locale("password")?> <span class="red_txt">*</span></p>
				<input class="passwords" type="password" name="password" class="required" placeholder="Password" onkeyup="check_value()">
			</li>	
			<li>
				<p class="label"><?=$locale("re_type_password")?> <span class="red_txt">*</span></p>
				<input class="passwords" type="password" name="re_password" class="required" placeholder="Password" onkeyup="check_value()">
			</li>	
			
			<li>
				<p class="label"><?=$locale("country")?> <span class="red_txt">*</span></p>
				<select name="nation_no" id="nation_no" class="required" onchange="check_value()"> 
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
			</li>
			<li>
				<p class="label"><?=$locale("name")?> <span class="red_txt">*</span></p>
				<div class="name_div clearfix2">
					<input type="text" name="first_name" class="required" maxlength="50" placeholder="First name" onkeyup="check_value()">
					<input type="text" name="last_name" class="required" maxlength="50" placeholder="Last name" onkeyup="check_value()">
				</div>
			</li>
			<li>
				<p class="label"><?=$locale("phone")?> <span class="red_txt">*</span></p>
				<div class="phone_div clearfix2">
					<select name="nation_tel" class="required"> 
						<option value="" selected hidden>select</option>
					</select>
					<input type="text" name="phone" class="required" placeholder="010-0000-0000" maxlength="20" onkeyup="check_value()">
				</div>
			</li>	
			<li>
				<p class="label"><?=$locale("affiliation")?> <span class="red_txt">*</span></p>
				<input class="required" type="text" name="affiliation" maxlength="100" onkeyup="check_value()">
			</li>		
			<li>
				<p class="label"><?=$locale("department")?></p>
				<input type="text" name="department" maxlength="50">
			</li>	
			<li>
				<p class="label">
					<!--<?=$locale("licence_number")?>-->License number <span class="red_txt">*</span>
					<input type="checkbox" class="radio" id="license_checkbox" name="license_checkbox">
					<label for="license_checkbox" class="tight">Not applicable</label>
				</p>
				<input class="required" type="text" name="licence_number" maxlength="50" onkeyup="check_value()">
			</li>	
			<!-- <li> -->
			<!-- 	<p class="label">Dietitian/nutritionist license number</p> -->
			<!-- 	<input type="text"> -->
			<!-- </li>		 -->
		</ul>
		<div class="checkbox_wrap">
			<ul>
				<li>
					<input type="checkbox" class="checkbox input required" data-name="terms 1" id="terms1" name="terms1" value="Y">
					<label for="terms1">Terms
						<a href="javascript:;" class="term1_btn red_txt"> Details ></a>
					</label>
				</li>
				<li>
					<input type="checkbox" class="checkbox input required" data-name="terms 2" id="terms2" name="terms2" value="Y">
					<label for="terms2"> Privacy Policy 
						<a href="javascript:;" class="term2_btn red_txt"> Details ></a>
					</label>
				</li>
			</ul>
		</div>
		<div class="btn_wrap">	
			<button type="button" id="submit_btn" class="form_btn gray_btn" name="join_btn">Submit</button>
		</div>
	</form>
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
<script src="./js/script/client/member.js"></script>
<script>
$(document).ready(function(){

	$(document).on("click", "#license_checkbox", function(){
		//console.log($(this).is(':checked'));
		if($(this).is(':checked') == true) {
			$("input[name=licence_number]").attr("disabled", true);
			$("input[name=licence_number]").val("");
			check_value();
		} else {
			$("input[name=licence_number]").attr("disabled", false);
						
			$("#submit_btn").removeClass("submit_btn");
			$("#submit_btn").addClass("gray_btn");
		}
	});

	var submit_btn = document.getElementById("submit_btn").className;
    $('select[name=nation_no]').val('25').trigger('change');
    
	//회원가입 이벤트
	$(document).on("click", "[name=join_btn]", function(){
		if(document.getElementById("submit_btn").className == "form_btn submit_btn") {
			var formData = $("form[name=signup_form]").serializeArray();

			var process = inputCheck(formData, checkType);
			var is_checked = process.status;
			var data = process.data;

			if(is_checked) {

				if(data.license_checkbox == "on") {
					data.licence_number = "Not applicable";
				}

				$(".loading").show();
				$("body").css("overflow-y","hidden");

				$.ajax({
					url : PATH+"ajax/client/ajax_member.php",
					type : "POST",
					data : {
						flag : "signup",
						data : data
					},
					dataType : "JSON",
					success : function(res) {
						if(res.code == 200) {
							console.log(locale(language.value)("complet_signup"))
							alert("Sign up complete.");
							console.log(res);
							return;
							window.location.replace("login.php");
						} else if(res.code == 400) {
							console.log(locale(language.value)("error_signup"))
							return false;
						} else {
							console.log(locale(language.value)("reject_msg"))
							return false;
						}
					},
					complete:function(){
						$(".loading").hide();
						$("body").css("overflow-y","auto");
					}
				});
			}
		}
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


$(document).on("change", "input[name=password]", function(){
	var _this = $(this).val();
	var _this_len = _this.trim().length;

	if(_this_len < 6) {
		alert("Please enter at least 6 digits of password");
	}
	
	var re_password = $("input[name=re_password]").val();
	var re_password_len = re_password.trim().length;

	if(_this_len >= 6 && re_password_len >= 6) {
		if(_this != re_password) {
			alert("Passwords do not match");
		}
	}
});
$(document).on("change", "input[name=re_password]", function(){
	var _this = $(this).val();
	var _this_len = _this.trim().length;

	if(_this_len < 6) {
		alert("Please enter at least 6 digits of re-type password");
	}
	var password = $("input[name=password]").val();
	var password_len = password.trim().length;

	if(_this_len >= 6 && password_len >= 6) {
		if(_this != password) {
			alert("Passwords do not match");
		}
	}
});


function check_value() {

	var email = $("input[name=email]").val();
	var email_len = email.trim().length;
	email = (typeof(email) != "undefined") ? email : null;

	var password = $("input[name=password]").val();
	var password_len = password.trim().length;
	password = (typeof(password) != "undefined") ? password : null;

	var re_password = $("input[name=re_password]").val();
	var re_password_len = re_password.trim().length;
	re_password = (typeof(re_password) != "undefined") ? re_password : null;

	var nation_no = $("#nation_no option:selected").val();

	var first_name = $("input[name=first_name]").val();
	var first_name_len = first_name.trim().length;
	first_name = (typeof(first_name) != "undefined") ? first_name : null;

	var last_name = $("input[name=last_name]").val();
	var last_name_len = last_name.trim().length;
	last_name = (typeof(last_name) != "undefined") ? last_name : null;

	var phone = $("input[name=phone]").val();
	var phone_len = phone.trim().length;
	phone = (typeof(phone) != "undefined") ? phone : null;

	var affiliation = $("input[name=affiliation]").val();
	var affiliation_len = affiliation.trim().length;
	affiliation = (typeof(affiliation) != "undefined") ? affiliation : null;

	var licence_number = $("input[name=licence_number]").val();
	var licence_number_len = licence_number.trim().length;
	licence_number = (typeof(licence_number) != "undefined") ? licence_number : null;

	if(!email || email_len <= 0) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}
	if(!password || password_len < 6) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}
	if(!re_password || re_password_len < 6) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}
	if(password != re_password) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}
	if(nation_no == "") {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}
	if(!first_name || first_name_len <= 0) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}
	if(!last_name || last_name_len <= 0) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}
	if(!phone || phone_len <= 0) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}

	if(!affiliation || affiliation_len <= 0) {
		$("#submit_btn").removeClass("submit_btn");
		$("#submit_btn").addClass("gray_btn");
		return;
	}

	if($("#license_checkbox").is(':checked') == false) {
		if(!licence_number || licence_number_len <= 0) {
			$("#submit_btn").removeClass("submit_btn");
			$("#submit_btn").addClass("gray_btn");
			return;
		}
	}

	$("#submit_btn").removeClass("gray_btn");
	$("#submit_btn").addClass("submit_btn");
}
</script>
<?php include_once('./include/footer.php');?>