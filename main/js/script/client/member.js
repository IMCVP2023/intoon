var checkType = $("input[name=check_type]").val() ? $("input[name=check_type]").val() : 0;
$(document).ready(function(){
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
						return;
					} else {
						alert(locale(language.value)("reject_msg"))
						return;
					}
				}
			});
		} else {
			alert(locale(language.value)("format_email"));
			$(this).val("").focus();
			return;
		}
	});

	
	//[240216] sujoeng / 모바일 이메일 체크 추가
	$("input[name=mo_email]").on("change", function(){
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
						$("input[name=mo_email]").val("").focus();
						return;
					} else {
						alert(locale(language.value)("reject_msg"))
						return;
					}
				}
			});
		} else {
			alert(locale(language.value)("format_email"));
			$(this).val("").focus();
			return;
		}
	});


	//비밀번호 띄어쓰기 막기
	$(".passwords").on("keyup", function(){
		$(this).val($(this).val().replace(/[\s]/g,""));
	});

	//이름 유효성
	$("input[name=first_name], input[name=mo_first_name]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	$("input[name=last_name], input[name=mo_last_name]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	//소속 유효성
	$("input[name=affiliation], input[name=mo_affiliation]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z||*-_@!#^&||0-9\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	$("input[name=department], input[name=mo_department]").on("change keyup", function(key){
		var pattern_eng = /[^a-zA-Z||*-_@!#^&||0-9\s]/gi;
		var _this = $(this);
		if(key.keyCode != 8) {
			var first_name = _this.val().replace(pattern_eng, '');
			_this.val(first_name);
		}
	});

	//연락처 숫자와 하이픈만
	/*
	$("input[name=phone]").on("keyup", function(){
		$(this).val($(this).val().replace(/[^0-9|-]/g,""));
	});
	*/

	//자격번호 숫자만
	$("input[name=licence_number]").on("keyup", function(){
		$(this).val($(this).val().replace(/[^0-9]/g,""));
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

});

function inputCheck(formData, check_type) {

	var data = {};
	var length_50 = ["email", "first_name", "last_name", "department", "licence_number"];

	var inputCheck = true;
	
	$.each(formData, function(key, value){
		
		var ok = value["name"];
		var ov = value["value"];

		if(ov.trim().length <= 0 || ov == "" || ov == null || ov == "undefinded") {
			
			if(ok == "email" || ok == "password" || ok == "re_password" || ok == "first_name" || ok == "last_name" || ok == "phone" || ok == "affiliation"){
				if(ok == "email") {
					alert(locale(language.value)("check_email"));
				} else if(ok == "password") {
					alert(locale(language.value)("check_password"));
				} else if(ok == "re_password") {
					alert(locale(language.value)("check_password"));
				} else if(ok == "first_name") {
					alert(locale(language.value)("check_first_name"));
				} else if(ok == "last_name") {
					alert(locale(language.value)("check_last_name"));
				} else if(ok == "affiliation") {
					alert("Please enter the affiliation.");
				} else {
					alert(locale(language.value)("check_phone"));
				}

				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			}
			
		} else {
			if((length_50.indexOf(ok)+1) && ov.length > 50) {
				alert(ok+locale(language.value)("under_50"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "password" && ov.length < 6) {
				alert(ok+locale(language.value)("over_6"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "re_password" && ov != $("input[name=password]").val()) {
				alert(locale(language.value)("mismatch_password"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "affiliation" && ov.length > 100) {
				alert(ok+locale(language.value)("under_100"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "phone" && ov.length > 20) {
				alert(ok+locale(language.value)("under_20"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			}
		}
		data[ok] = ov;
		
	});

	if(inputCheck){
		if($("select[name=nation_no]").val() == null || $("select[name=nation_no]").val() == "") {
			alert(locale(language.value)("check_nation"));
			inputCheck = false;
			return false;
		} 
		if(check_type === 0) {
			if($("input[name=terms1]").is(":checked") == false) {
				alert(locale(language.value)("check_terms1"));
				inputCheck = false;
				return false;
			} else if($("input[name=terms2]").is(":checked") == false) {
				alert(locale(language.value)("check_terms2"));
				inputCheck = false;
				return false;
			}
		}
	}
	return {
		data : data,
		status : inputCheck
	}
}


//핸드폰 유효성
$(document).on('change keyup', "input[name=phone]",function(key){
	var _this = $(this);
	if(key.keyCode != 8) {
		var phone = _this.val().replace(/[^0-9||-]/gi,'');
		_this.val(phone);
	}
});


