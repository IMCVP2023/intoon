$(document).ready(function(){
    $(document).on("click", ".green_btn", function(){

		var process = inputCheck("insert");
		var status = process.status;
		var data = process.data;

		if(data.license_checkbox == "on") {
			data.licence_number = "Not applicable";
		}

		var terms1 = $("input[name=terms1]").is(":checked");
		var terms2 = $("input[name=terms2]").is(":checked");

		if(terms1 == false) {
			alert(locale(language.value)("check_terms1"));
			return;
		}
		if(terms2 == false) {
			alert(locale(language.value)("check_terms2"));
			return;
		}

		data.auto = 'Y';
		
		if(status == true) {
			if(confirm(locale(language.value)("confirm_msg"))) {
				$(".loading").show();
				$("body").css("overflow-y","hidden");

				member_save(data);
			}
		}	
	});

	//필수 입력 시 버튼 활성화
	$(".required").on("change", function(){
		var result = requiredCheck();

		if(result) {
			$(".next_btn").addClass("submit_btn");
		} else {
			$(".next_btn").removeClass("submit_btn");
		}
	});
});

// 무한 패딩 걸렸을 때 더블 클릭하면 끄기
$(document).on("dblclick", ".loading", function(){
	$(".loading").hide();
	$("body").css("overflow-y","auto");
});

function registration_save(data) {
	
	$.ajax({
		url : PATH+"ajax/client/ajax_registration.php",
		type : "POST",
		data : {
			flag : "registration",
			data : data
		},
		dataType : "JSON",
		success : function(res){
			if(res.code == 200) {
				//$(window).off("beforeunload");
				//window.location.replace(PATH+"registration2.php?idx="+res.registration_idx);
				alert("Complete.");
				window.location.replace(PATH+"registration4.php");
			} else if(res.code == 400){
				alert(locale(language.value)("error_registration"));
				return false;
			} else if(res.code == 401){
				alert(locale(language.value)("already_registration"));
				window.location.replace(PATH+"mypage_registration.php");
				return false;
			} else {
				alert(locale(language.value)("reject_msg")+locale(language.value)("retry_msg"));
				return false;
			}
		}, complete:function(){
			$(".loading").hide();
			$("body").css("overflow-y","auto");
		}
	});
}
function member_save(data) {
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
				data.insert_idx = res.insert_idx;
				registration_save(data);
			} else if(res.code == 400) {
				console.log(locale(language.value)("error_signup"))
				return false;
			} else {
				console.log(locale(language.value)("reject_msg"))
				return false;
			}
		}
	});
}

	

function payment(){
	var frm = document.regForm;
	var price = $("input[name=price]").val();

	if(price == "0"){
		window.location.replace("./registration3.php");
	}else{
		var payment_pop = window.open("", "payment", "resizable=yes,scrollbars=yes,width=820,height=600");
		frm.target = "payment";
		frm.submit();
	}
}

function requiredCheck() {
	var required = $(".required");
	for(i=0; i<required.length; i++) {
		if($(required[i]).val() == "" || $(required[i]).val() == null) {
			return false;
		}
	}
	if(!$("input[name=attendance_type]").is(":checked") || !$("input[name=rating]").is(":checked") || !$("input[name=registration_type]").is(":checked")) {
		return false;
	}

	return true;
}
function inputCheck(check_type) {
	
	var data = {};
	var length_50 = ["email", "first_name", "last_name", "department", "licence_number"];

	var formData = $("form[name=registration_form]").serializeArray();

	var inputCheck = true;
	$.each(formData, function(key, value){
		var ok = value["name"];
		var ov = value["value"];

		if(ov == "" || ov == null || ov == "undefinded") {
			if(ok == "email" || ok == "password" || ok == "first_name" || ok == "last_name" || ok == "phone") {
				if(ok == "email") {
					alert(locale(language.value)("check_email"));
				} else if(ok == "password") {
					alert(locale(language.value)("check_password"));
				} else if(ok == "first_name") {
					alert(locale(language.value)("check_first_name"));
				} else if(ok == "last_name") {
					alert(locale(language.value)("check_last_name"));
				} else if(ok == "phone") {
					alert(locale(language.value)("check_phone"));
				}

				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			}
		} else {
			if((length_50.indexOf(ok)+1) && ov.length > 50) {
				alert(ok+locale(language.value)("under_50"));
				inputCheck = false;
				return false;
			} else if(ok == "password" && ov.length < 6) {
				alert(ok+locale(language.value)("over_6"));
				inputCheck = false;
				return false;
			} else if(ok == "affiliation" && ov.length > 100) {
				alert(ok+locale(language.value)("under_100"));
				inputCheck = false;
				return false;
			} else if(ok == "phone" && ov.length > 20) {
				alert(ok+locale(language.value)("under_20"));
				inputCheck = false;
				return false;
			}
		}
		data[ok] = ov;
	});

	if(inputCheck) {
		if(check_type == "insert") {
			if(!$("input[name=attendance_type]").is(":checked")) {
				alert(locale(language.value)("check_attendance_type"));
				inputCheck = false;
				return false;
			}
			if(!$("input[name=rating]").is(":checked")) {
				alert(locale(language.value)("check_review"));
				inputCheck = false;
				return false;
			}
			if(!$("input[name=member_status]").is(":checked")) {
				alert(locale(language.value)("check_member_status"));
				inputCheck = false;
				return false;
			}
			if(!$("input[name=registration_type]").is(":checked")) {
				alert(locale(language.value)("check_registration_type"));
				inputCheck = false;
				return false;
			}
			if($("#radio1").is(":checked") && !$("input[name=org]").is(":checked")) {
				alert(locale(language.value)("check_applied_org"));
				inputCheck = false;
				return false;
			}
		}

		if($("select[name=nation_no]").val() == null || $("select[name=nation_no]").val() == "") {
			alert(locale(language.value)("check_nation"));
			inputCheck = false;
			return false;
		}

		var memberType = $("select[name=member_type] option:selected").text();
		var registerPath = $("select[name=register_path] option:selected").text();
        var etc = $('.etc1').val();
		memberType = (memberType != null && typeof(memberType) != "undefined") ? memberType : "";
		registerPath = (registerPath != null && typeof(registerPath) != "undefined") ? registerPath : "";
		etc = (etc != null && typeof(etc) != "undefined") ? etc : "";

		if(memberType == "Choose"){
			alert(locale(language.value)("check_member_type"));
			inputCheck = false;
			return false;
		}
	}


	var invitation  = $("input[name='invitation']").val();

	if(invitation == 'on') {
		invitation = 'N';
	}

	data["invitation_yn"] = invitation;
	data["member_type"] = memberType;
	data["register_path"] = registerPath;
	data["etc"] = etc;
	data["flag"] = "registration";
	data['terms1'] = $("input[name=terms1]").val();
	data['terms2'] = $("input[name=terms2]").val();
	data["password"] = 123456;
	data['email_certified'] = 'Y';

	//if($("select[name=invitation_nation_no]").val() == "") {
	//	data['invitation_nation_no'] = $("select[name=nation_no]").val();
	//}

	data['invitation_nation_no'] = $("select[name=nation_no]").val();

	//if(!data['invitation_nation_no']) {
	//	data['invitation_nation_no'] = 25;
	//}

	return {
		data : data,
		status : inputCheck
	}
}