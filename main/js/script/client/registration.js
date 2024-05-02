$(document).ready(function(){
	$(document).on("click", ".prev_btn", function(){
		const search = window.location.search.substr(1);
		const arr = search.split("&");
		
		let searchParam = {};

		for(let a = 0; a < arr.length; a++){
			const t = arr[0].split("=");

			if(t[0]){
				searchParam[t[0]] = t.length > 1 ? t[1] : undefined;
			}
		}

		if(searchParam.cb){
			window.location.replace(searchParam.cb);
		}else{
			history.go(-1);
		}
	});

    $(".online_register, .abstract_online_submission").on("click", ".green_btn", function(){
		const prevNo = $("input[name=prev_no]").val();	// 수정시

		var process = inputCheck();
		var status = process.status;
		var data = process.data;

//        for (let key of data.keys()) {
//          console.log(key);
//        }
//            console.log("value");
//        // FormData의 value 확인
//        for (let value of data.values()) {
//          console.log(value);
//        }
		//if(data.license_checkbox == "on") {
		//	data.licence_number = "Not applicable";
		//}

		// 0509
		var temp_arr = document.getElementsByName("list");
		var conference_info_arr = new Array();
		for(var i = 0; i < temp_arr.length; i++){
			if(temp_arr[i].checked == true){
				conference_info_arr.push(temp_arr[i].value);
			}
		}
		
		data["conference_info_arr"] = conference_info_arr;

		var rows = document.getElementById("othersList").getElementsByTagName("tr");
		var chkVal;
		var others_arr = new Array();
		for(var i = 1; i <= rows.length; i++){
			chkVal = $('input[name=others'+i+']:checked').val();
			if(chkVal != "no"){
				//console.log(chkVal);
				others_arr.push(chkVal);
			}
		}
		data["others_arr"] = others_arr;

		let regFee = data["reg_fee"] ?? "";
		let totalRegFee = data["total_reg_fee"] ?? "";

		regFee = regFee.toString().replace(/[^0-9.]/gi, "");
		totalRegFee = totalRegFee.toString().replace(/[^0-9.]/gi, "");

		data["reg_fee"] = regFee ? parseFloat(regFee) : 0;
		data["total_reg_fee"] = totalRegFee ? parseFloat(totalRegFee) : 0;

		if(status == true) {
			if(confirm(prevNo ? "Would you like to modify with the item you entered?" :locale(language.value)("confirm_msg"))) {
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
							var registration_idx = res.registration_idx;
							var reg_promotion_code = $("input[name=promotion_code]").val();
							var reg_recommender = $("input[name=recommended_by]").val();

							if(reg_promotion_code != "" && reg_recommender != ""){
								regist_promotion_code(registration_idx,reg_promotion_code,reg_recommender);
							}

							if(res.email != null){
								// 구글 메일 발송
								$.ajax({
									url:PATH+"ajax/client/ajax_gmail.php",
									type:"POST",
									data:{
										"flag":"payment",
										"name":res.name,
										"email":res.email,
										"data":res.data
									},
									dataType:"JSON"
								});
							}

							window.location.replace(PATH+"registration2.php?idx="+res.registration_idx);
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
					}

				});
			}
		}	
	});
    

	//페이지 이동시 확인창
	//$(window).on("beforeunload", function(){
	//	return locale(language.value)("leave_page");
	//});

	//필수 입력 시 버튼 활성화
	$("input, select").on("change", function(){
		var result = requireChecked();

		if(result == 1) {
			$(".prev_btn").removeClass("gray_btn");
			if(!$(".next_btn").hasClass("green_btn")){
				$(".next_btn").addClass("green_btn");
			}
		} else {
			if(!$(".prev_btn").hasClass("gray_btn")){
				$(".prev_btn").addClass("gray_btn");
			}
			$(".next_btn").removeClass("green_btn");
		}
	});
});

function regist_promotion_code(registration_idx,promotion_code, recommender) {

	data = {
		registration_idx: registration_idx,
		promotion_code: promotion_code,
		recommender: recommender
	}

	$.ajax({
		url: PATH + "ajax/client/ajax_promotion.php",
		type: "POST",
		data: {
			flag: "regist",
			data: data
		},
		dataType: "JSON",
		success: function (res) {
			if (res.code == 200) {
				alert("A promotional code has been applied successfully.");
			} else {
				alert("regist promotion error.");
				return;
			}
		}
	});
}

function gmail_registration(email, name, data, registration_idx) {
	$.ajax({
		url : PATH+"ajax/client/ajax_gmail.php",
		type : "POST",
		data : {
			flag : "registration",
			email : email,
			name  : name,
			data : data,
			//invitation_check_yn	: invitation_check_yn,
			registration_idx : registration_idx
		},
		dataType : "JSON",
		success : function(res){
			if(res.code == 200) {
				$(window).off("beforeunload");
				window.location.replace(PATH+"registration2.php?idx="+registration_idx);
			} else {
				
				alert("mailer error.");
				return;
			}
		}
	});
}
	

function calc_fee(obj){

	if(obj.name == "participation_type"){
		var participation_type = obj.value;												
		var category = document.getElementById("category").value;	
		if(category == ""){
			return;
		}
		

	}else if (obj.name == "category"){
		var category = obj.value;														
		var participation_type = document.getElementById("participation_type").value;
		if(participation_type == ""){	
			return;
		}
	}

	if(participation_type == "Participants" || participation_type =="Sponsor"){
		if(participation_type == "Sponsor"){
			category="Others";
		}
		$.ajax({
			url : PATH+"ajax/client/ajax_registration.php",
			type : "POST",
			data : {
				flag : "calc_fee",
				category : category
			},
			dataType : "JSON",
			success : function(res){
				if(res.code == 200) {
					$("input[name=reg_fee]").val(comma(res.data)).change();
				} else if(res.code == 400){
					alert(locale(language.value)("error_registration"));
					return false;
				} else if(res.code == 401){
					alert(locale(language.value)("already_registration"));
					window.location.replace(PATH+"mypage_registration.php");
					return false;
				}
			}

		});
	}else{
		$("input[name=reg_fee]").val(0).change();
		return;
	}
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

function inputCheck(check_type) {
	
	var data = {};
	var length_50 = ["email", "first_name", "last_name", "department", "licence_number"];

	var formData = $("form[name=registration_form]").serializeArray();

	var inputCheck = true;
	var returnData = {
		data: null,
		inputCheck: false
	};

	let infoList = [];
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
				return returnData;
			}
		} else {
			if((length_50.indexOf(ok)+1) && ov.length > 50) {
				alert(ok+locale(language.value)("under_50"));
				inputCheck = false;
				return returnData;
			} else if(ok == "password" && ov.length < 6) {
				alert(ok+locale(language.value)("over_6"));
				inputCheck = false;
				return returnData;
			} else if(ok == "affiliation" && ov.length > 100) {
				alert(ok+locale(language.value)("under_100"));
				inputCheck = false;
				return returnData;
			} else if(ok == "phone" && ov.length > 20) {
				alert(ok+locale(language.value)("under_20"));
				inputCheck = false;
				return returnData;
			}
		}

		if(ok != 'list'){
			data[ok] = ov;
		}
	});

	if(inputCheck) {
		const requireCheck = requireChecked();

		if(requireCheck !== 1){
			if(requireCheck == -1){
				alert(locale(language.value)("check_registration_participation_type"));
			}else if(requireCheck == -2){
				alert(locale(language.value)("check_registration_category"));
			}else if(requireCheck == -3){
				alert('Please selected type of review.');
			}else if(requireCheck == -4){
				alert('Please checked licences data.');
			}else if(requireCheck == -5){
				alert('Please checked others options.');
			}else if(requireCheck == -6){
				alert('Please select one or more ways you are got the information about this conference.');
			}else if(requireCheck == -7) {
				alert('Please select payment method');
			}else if(requireCheck == -8) {
				alret('check occupation category')
			}else if(requireCheck == -9) {
				alert('check special request for food')
			}else{
				alert('Please checked input data');
			}

			inputCheck = false;
			return returnData;
		}
	}
	
	returnData.data = data;
	returnData.status = inputCheck;

	return returnData;
}

function requireChecked(){
	// Type of Participation
	if(!$("select[name=participation_type] option:selected").val()){
		return -1;
	}

	// Type of Occupation
	// if(!$("select[name=occupation] option:selected").val()) {
	// 	return -8;
	// }

	// Category
	if(!$("select[name=category] option:selected").val()){
		return -2;
	}

	// Review
	if($("input[name=review]").length > 0){
		if(!$("input[name=review]").is(":checked")) {
			return -3;
		}else if($("input[name=rating]:checked").val() == '1'){
			let review_sub_check = true;

			for(let a = 0; a < $(".review_sub_list").length; a++){
				const t = $(".review_sub_list").eq(a);

				const val = t.find("input[type=text]").val();
				const isChecked = t.find("input[type=checkbox]").is(":checked");

				if(!val && !isChecked){
					review_sub_check = false;
				}
			}

			if(!review_sub_check){
				return -4;
			}
		}
	}

	
	// Others
	const otherTotalCount = $("#othersList tr").length;
	const otherCheckCount = $("input[name^=other]:checked").length;

	// console.log("total",otherTotalCount)
	// console.log("check",otherCheckCount)

	if(otherTotalCount > otherCheckCount){
		return -5;
	}

	// Special food
	if(!$('input:radio[name=special_request]').is(':checked')){
		return -9;
	}

	// Info Check
	const infoCheckCount = $(".info_check_list li input[type=checkbox]:checked").length;

	if(infoCheckCount < 1){
		return -6;
	}

	// Payment 
	const paymentMethod  = $("input[name=payment_method]:checked").val();

	if($("input[name=payment_method]").length > 0){
		if(paymentMethod != 0 && !paymentMethod){
			return -7;
		}
	}

	return 1;
}

//0627 공백,특수문자 사용 방지
function checkRegExp(obj)
{
	var regExp = /[ \{\}\[\]\?.,;:|\~!^\-_+┼<>@\#$%&\'\"\\=]/gi;
	if( regExp.test(obj.value) ){
		obj.focus();
		obj.value = obj.value.substring( 0 , obj.value.length - 1 ); // 입력한 특수문자 한자리 지움
		obj.value = obj.value.replace(' ',''); // 공백제거
	}
}