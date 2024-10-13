$(document).ready(function(){
    //이메일 중복 검증
    $("input[name=email]").on("change", function(){
        var email = $(this).val();
        checkEmail(email);
    });

//sujeong / email 중복체크
    function checkEmail(emailValue){
        var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;

        if(emailValue.match(regExp) != null) {
            $.ajax({
                url : PATH+"ajax/client/ajax_member.php",
                type : "POST",
                data :  {
                    flag : "id_check",
                    email : emailValue
                },
                dataType : "JSON",
                success : function(res){
                    if(res.code == 200) {
                        return true;
                    } else if(res.code == 400) {
                        alert(locale(language.value)("used_email_msg"));
                        $("input[name=email]").val("").focus();
                        return false;
                    } else {
                        alert(locale(language.value)("reject_msg"))
                        return false;
                    }
                }
            });
        } else {
            alert(locale(language.value)("format_email"));
            $(this).val("").focus();
            return false;
        }
    }

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

//핸드폰 유효성
$(document).on('change keyup', "input[name=phone]",function(key){
    var _this = $(this);
    if(key.keyCode != 8) {
        var phone = _this.val().replace(/[^0-9||-]/gi,'');
        _this.val(phone);
    }
});

// 생일 입력 정규표현식 유효성검사
function birthChk(input) {

    var value = input.value.replace(/[^0-9]/g, "").substr(0,8); // 입력된 값을 숫자만 남기고 모두 제거
    if (value.length === 8) {
        var regex = /^(\d{2})(\d{2})(\d{4})$/;
        var formattedValue = value.replace(regex, "$1-$2-$3");
        input.value = formattedValue;
    }else{
        input.value = value;
    }

}

// 요금계산(프로모션 적용X)
function calc_fee(){
    // if(obj.name == "participation_type"){
    //     var participation_type = obj.value;
    //     var category = document.getElementById("category").value;
    //     if(category == ""){
    //         return;
    //     }
    // }else if (obj.name == "category"){
    //     var category = obj.value;
    //     var participation_type = document.getElementById("participation_type").value;
    //     if(participation_type == ""){
    //         return;
    //     }
    // }

    var category = document.getElementById("category").value;
    var participation_type = document.getElementById("participation_type").value;

    if(category == ""){
        return;
    }
    if(participation_type==""){
        return;
    }

    var country =  $("select[name=nation_no]").val();

    if(participation_type == "Participants" || participation_type =="Sponsor"){
        if(participation_type == "Sponsor"){
            category="Others";
        }

        var ksso_member_type = $("input[name=ksso_member_type]").val();
        var ksso_member_status = 0;

        if(ksso_member_type == "평생회원"){
            ksso_member_status = 2;
        }else if(ksso_member_type == "정회원"){
            ksso_member_status = 1;
        }else {
            ksso_member_status = 0; //비회원
        }

        $.ajax({
            url : PATH+"ajax/client/ajax_onsite_registration.php",
            type : "POST",
            data : {
                flag : "calc_fee",
                category : category,
                country : country,
                ksso_member_status : ksso_member_status
            },
            dataType : "JSON",
            success : function(res){
                if(res.code == 200) {
                    $("input[name=reg_fee]").val(comma(res.data)).change();
                    const promotionCode = $("input[name=promotion_code]").val();
                    select_promotion_code(promotionCode);
                    
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

function remove_value() {
    $("input[name=affiliation_kor]").val("");
    $("input[name=name_kor]").val("");
    $("input[name=licence_number]").val("");
    $("input[name=specialty_number]").val("");
    $("input[name=nutritionist_number]").val("");
}

function select_promotion_code(promotion_code) {
    $.ajax({
        url: PATH + "ajax/client/ajax_promotion.php",
        type: "POST",
        data: {
            flag: "select",
            promotion_code: promotion_code
        },
        dataType: "JSON",
        success: function (res) {
            if (res.code == 200) {
                var result=res.result;
                var discount_rate = result.discount_rate;
                    $("input[name=promotion_code_idx]").val(result.idx).change();
                    if(discount_rate == 0){
                        $("input[name=promotion_confirm_code]").val(0).change();
                    } else if (discount_rate == 1) {
                        $("input[name=promotion_confirm_code]").val(1).change();
                    } else if (discount_rate == 2) {
                        $("input[name=promotion_confirm_code]").val(2).change();
                    }
            } else {
                alert("Please check the promotion code.");
                return;
            }
        }
    });
}


function submit(){
    if(requiredCheck()!=false){
        if(confirm("Would you like to proceed with on-site registration?")){
            if(checkEmail($("input[name=email]").val())){
                onsite_submit();
            }
        } else {
            return;
        }
    }
}
function onsite_submit(){
    var nation_no = $('#nation_no > option:selected').val();
    var email = $("input[name=email]").val();
    var password = $("input[name=password]").val();
    var first_name = $("input[name=first_name]").val();
    var first_name_kor = $("input[name=first_name_kor]").val();
    var last_name = $("input[name=last_name]").val();
    var last_name_kor = $("input[name=last_name_kor]").val();
    var affiliation = $("input[name=affiliation]").val();
    var affiliation_kor = $("input[name=affiliation_kor]").val();
    var department = $("input[name=department]").val();
    var department_kor = $("input[name=department_kor]").val();
    var nation_tel = $("input[name=nation_tel]").val();
    var phone = nation_tel+"-"+$("input[name=phone]").val();
    var date_of_birth = $("input[name=date_of_birth]").val();

    var participation_type = $('#participation_type > option:selected').val();
   // var occupation = $('#occupation > option:selected').val();
   // var occupation_other_type = $("input[name=occupation_input]").val();
    var member_type = $('#category > option:selected').val();
    var member_other_type = $("input[name=title_input]").val();
    var is_score = $('input[name=review]:checked').val();
    var licence_number = $("input[name=licence_number]").val();
    var specialty_number = $("input[name=specialty_number]").val();
  //  var nutritionist_number = $("input[name=nutritionist_number]").val();
   // var dietitian_number = $("input[name=dietitian_number]").val();

    var day1_luncheon_yn = $("input:checkbox[id='others1']:checked").val()
    var day1_satellite_yn = $("input:checkbox[id='others2']:checked").val()
    var day2_breakfast_yn = $("input:checkbox[id='others3']:checked").val()
    var day2_luncheon_yn = $("input:checkbox[id='others4']:checked").val()
    var day2_satellite_yn = $("input:checkbox[id='others5']:checked").val()

    var special_request = $("input[name='special_request']:checked").val()

    const conference_info_arr=[];
    var info = $("input[name='list']:checked");
    $(info).each(function (){
        conference_info_arr.push($(this).val());
    });

    var price = $("input[name=reg_fee]").val();

    // ksso api 연동 id
    var ksso_member_check = $("input[name=ksso_member_check]").val();
    // ksso 회원 유형
    var ksso_member_status = 0;

    if(ksso_member_check !== ""){
        ksso_member_status = 1;
    }else {
        ksso_member_status = 0; //비회원
    }

    var data = {
        nation_no : nation_no,
        ksso_member_check : ksso_member_check,
        ksso_member_status : ksso_member_status,
        email : email,
        password : password,
        first_name : first_name,
        first_name_kor, first_name_kor,
        last_name : last_name,
        last_name_kor : last_name_kor,
        affiliation : affiliation,
        affiliation_kor : affiliation_kor,
        department : department,
        department_kor : department_kor,
        phone : phone,
        date_of_birth : date_of_birth,
        participation_type : participation_type,
        member_type : member_type,
        member_other_type : member_other_type,
        is_score : is_score,
        licence_number : licence_number,
        specialty_number : specialty_number,
        day1_luncheon_yn : day1_luncheon_yn,
        day1_satellite_yn : day1_satellite_yn,
        day2_breakfast_yn : day2_breakfast_yn,
        day2_luncheon_yn : day2_luncheon_yn,
        day2_satellite_yn : day2_satellite_yn,
        special_request : special_request,
        conference_info_arr : conference_info_arr,
        price : price
    };

    $.ajax({
        url : PATH+"ajax/client/ajax_onsite_registration.php",
        type : "POST",
        data : {
            flag : "onsite",
            data : data
        },
        dataType : "JSON",
        success : function(res){
            if(res.code == 200) {
                console.log(res);
                alert("On-site registration has been completed.\n" +
                    "Please pay your registration fee at the registration desk.");
                window.location.replace(PATH+"onsite_registration.php");
            } else {
                alert("onsite registration error.");
                return;
            }
        }
    });
}



//프로모션 사이트 등록
function promotion_submit(){
    if(requiredCheck()!=false){
        if(confirm("Would you like to proceed with on-site registration?")){
            if(checkEmail($("input[name=email]").val())){
                promotion_onsite_submit();
            }
        } else {
            return;
        }
    }
}

//promotion registration 1, 2 => promotion code 필요
function promotion_onsite_submit(){
    var nation_no = $('#nation_no > option:selected').val();
    var email = $("input[name=email]").val();
    var password = $("input[name=password]").val();
    var first_name = $("input[name=first_name]").val();
    var first_name_kor = $("input[name=first_name_kor]").val();
    var last_name = $("input[name=last_name]").val();
    var last_name_kor = $("input[name=last_name_kor]").val();
    var affiliation = $("input[name=affiliation]").val();
    var affiliation_kor = $("input[name=affiliation_kor]").val();
    var department = $("input[name=department]").val();
    var department_kor = $("input[name=department_kor]").val();
    var nation_tel = $("input[name=nation_tel]").val();
    var phone = nation_tel+"-"+$("input[name=phone]").val();
    var date_of_birth = $("input[name=date_of_birth]").val();

    var participation_type = $('#participation_type > option:selected').val();
   // var occupation = $('#occupation > option:selected').val();
   // var occupation_other_type = $("input[name=occupation_input]").val();
    var member_type = $('#category > option:selected').val();
    var member_other_type = $("input[name=title_input]").val();
    var is_score = $('input[name=review]:checked').val();
    var licence_number = $("input[name=licence_number]").val();
    var specialty_number = $("input[name=specialty_number]").val();
  //  var nutritionist_number = $("input[name=nutritionist_number]").val();
   // var dietitian_number = $("input[name=dietitian_number]").val();

    var day1_luncheon_yn = $("input:checkbox[id='others1']:checked").val()
    var day1_satellite_yn = $("input:checkbox[id='others2']:checked").val()
    var day2_breakfast_yn = $("input:checkbox[id='others3']:checked").val()
    var day2_luncheon_yn = $("input:checkbox[id='others4']:checked").val()
    var day2_satellite_yn = $("input:checkbox[id='others5']:checked").val()

    var special_request = $("input[name='special_request']:checked").val()

    const conference_info_arr=[];
    var info = $("input[name='list']:checked");
    $(info).each(function (){
        conference_info_arr.push($(this).val());
    });

    var price = $("input[name=reg_fee]").val();

    // ksso api 연동 id
    var ksso_member_check = $("input[name=ksso_member_check]").val();
    // ksso 회원 유형
    var ksso_member_status = 0;

    if(ksso_member_check !== ""){
        ksso_member_status = 1;
    }else {
        ksso_member_status = 0; //비회원
    }

    //sujeong / promotion code 
    const promotion_code = $("input[name=promotion_code]").val();

    const payment_method = Number($('input[name=payment_method]:checked').val());

    //[240923] sujeong / promotion 등록 status 추가
    const status = $('input[name=registration_status]').val();

    // if(status == '6' && price == 0){
    //     payment_method = "3";
    // }

    var data = {
        status : status,
        nation_no : nation_no,
        ksso_member_check : ksso_member_check,
        ksso_member_status : ksso_member_status,
        email : email,
        password : password,
        first_name : first_name,
        first_name_kor, first_name_kor,
        last_name : last_name,
        last_name_kor : last_name_kor,
        affiliation : affiliation,
        affiliation_kor : affiliation_kor,
        department : department,
        department_kor : department_kor,
        phone : phone,
        date_of_birth : date_of_birth,
        participation_type : participation_type,
        member_type : member_type,
        member_other_type : member_other_type,
        is_score : is_score,
        licence_number : licence_number,
        specialty_number : specialty_number,
        day1_luncheon_yn : day1_luncheon_yn,
        day1_satellite_yn : day1_satellite_yn,
        day2_breakfast_yn : day2_breakfast_yn,
        day2_luncheon_yn : day2_luncheon_yn,
        day2_satellite_yn : day2_satellite_yn,
        special_request : special_request,
        conference_info_arr : conference_info_arr,
        price : price,
        promotion_code : promotion_code,
        payment_method : payment_method
    };

    $.ajax({
        url : PATH+"ajax/client/ajax_onsite_registration.php",
        type : "POST",
        data : {
            flag : "promotion_onsite",
            data : data
        },
        dataType : "JSON",
        success : function(res){
            if(res.code == 200) {
                console.log(res);
                alert("Registration has been completed.");
                //window.location.href = `/main`;
                
                // sujeong 결제 필요시 
                if(data.price != 0){
                    window.location.href = `/main/registration2.php?idx=${res.reg_idx}&member=${res.member_idx}`;
                }
            } else {
                alert("registration error.");
                return;
            }
        }
    });
}


function requiredCheck(){
    // Terms
    if(!$('#terms1').is(':checked')) {
        alert("Please check the Terms section.");
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        $('.terms1_label').css("color", "red");
        $('.terms1_label').css("font-weight", "bold");

        return false;
    // Country
    } else if(!$('#nation_no > option:selected').val()) {
        alert("Please check the Country section.");
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        $('#nation_no').css("border-color", "red");
        return false;
    // Email
    } else if(!$("input[name=email]").val()) {
        alert("Please check the Email section.");
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        $('input[name=email]').css("border-color", "red");
        return false;
    // Password
    } else if(!$("input[name=password]").val()) {
        alert("Please check the Password section.");
        window.scrollTo({
            top: 100,
            behavior: 'smooth'
        });
        $('input[name=password]').css("border-color", "red");
        return false;
    // Password match
    } else if($("input[name=password]").val()!=$("input[name=password2]").val()) {
        alert("Please check the Password section.\n" +
            "Password do not match.");
            window.scrollTo({
                top: 100,
                behavior: 'smooth'
            });
            $('input[name=password]').css("border-color", "red");
            $('input[name=password2]').css("border-color", "red");
        return false;
    // Verify password
    } else if(!$("input[name=password2]").val()) {
        alert("Please check the Verify Password section.");
        window.scrollTo({
            top: 100,
            behavior: 'smooth'
        });
        $('input[name=password2]').css("border-color", "red");
        return false;
    // Fisrt name
    } else if(!$("input[name=first_name]").val()) {
        alert("Please check the Name section.");
        window.scrollTo({
            top: 500,
            behavior: 'smooth'
        });
        $('input[name=first_name]').css("border-color", "red");
        return false;
    // Last name
    } else if(!$("input[name=last_name]").val()) {
        alert("Please check the Name section.");
        window.scrollTo({
            top: 500,
            behavior: 'smooth'
        });
        $('input[name=last_name]').css("border-color", "red");
        return false;
    // Affiliation
    } else if(!$("input[name=affiliation]").val()) {
        alert("Please check the Affiliation(Institute) section.");
        window.scrollTo({
            top: 500,
            behavior: 'smooth'
        });
        $('input[name=affiliation]').css("border-color", "red");
        return false;
    // Department
    } else if(!$("input[name=department]").val()) {
        alert("Please check the Department section.");
        window.scrollTo({
            top: 500,
            behavior: 'smooth'
        });
        $('input[name=department]').css("border-color", "red");
        return false;
    // Phone
    } else if(!$("input[name=phone]").val()) {
        alert("Please check the Mobile Phone Number section.");
        window.scrollTo({
            top: 500,
            behavior: 'smooth'
        });
        $('input[name=phone]').css("border-color", "red");
        return false;
    // Date of birth
    } else if(!$("input[name=date_of_birth]").val()) {
        alert("Please check the Date of Birth section.");
        window.scrollTo({
            top: 500,
            behavior: 'smooth'
        });
        $('input[name=date_of_birth]').css("border-color", "red");
        return false;
    // Paticipation type
    } else if(!$('#participation_type > option:selected').val()) {
        alert("Please check the Type of Participation section.");
        window.scrollTo({
            top: 1200,
            behavior: 'smooth'
        });
        $('#participation_type').css("border-color", "red");
        return false;
    // Occupation type
    // } else if(!$('#occupation > option:selected').val()) {
    //     alert("Please check the Type of Occupation section.");
    //     return false;
    // Category
    } else if(!$('#category > option:selected').val()) {
        alert("Please check the Category section.");
        window.scrollTo({
            top: 1200,
            behavior: 'smooth'
        });
        $('#category').css("border-color", "red");
        return false;
    // Others
    } else if(others_check()==false){
        window.scrollTo({
            top: 1200,
            behavior: 'smooth'
        });
        $('input[name=others]').css("border-color", "red");
        return false;
    // Special Request for Food
    } else if(!$('input:radio[name=special_request]').is(':checked')){
        alert("Please check the Special Request for Food section.");
        window.scrollTo({
            top: 1200,
            behavior: 'smooth'
        });
        $('input[name=special_request]').css("border-color", "red");
        return false;
    // Information
    } else if(info_check()==false){
        window.scrollTo({
            top: 1200,
            behavior: 'smooth'
        });
        $('input[name=list]').css("border-color", "red");
        return false;
    // payment_method
    // } else if(!$('input:radio[name=payment_method]').is(':checked')){
    //     alert("Please check the Payment Methods section.");
    //     $('input[name=payment_method]').css("border-color", "red");
    //     return false;
    // Country = Repulic of Korea 한국일때 추가 입력값
    } else if($('#nation_no > option:selected').val() == '25'){
        // KSSO Member
        if(!$('input:radio[name=user]').is(':checked')){
            alert("Please check the KSSO Member section");
            window.scrollTo({
                top: 500,
                behavior: 'smooth'
            });
            $('input:radio[name=user]').css("border-color", "red");
            return false;
        // 이름
        } else if(!$("input[name=first_name_kor]").val()) {
            alert("Please check the Name_kor section.");
            window.scrollTo({
                top: 500,
                behavior: 'smooth'
            });
            $('input[name=first_name_kor]').css("border-color", "red");
            return false;
        // 성
        } else if(!$("input[name=last_name_kor]").val()) {
            alert("Please check the Name_kor section.");
            window.scrollTo({
                top: 500,
                behavior: 'smooth'
            });
            $('input[name=last_name_kor]').css("border-color", "red");
            return false;
        // 소속
        } else if(!$("input[name=affiliation_kor]").val()) {
            alert("Please check the Affiliation_kor section.");
            window.scrollTo({
                top: 500,
                behavior: 'smooth'
            });
            $('input[name=affiliation_kor]').css("border-color", "red");
            return false;
        // 부서
        } else if(!$("input[name=department_kor]").val()) {
            alert("Please check the Department_kor section.");
            window.scrollTo({
                top: 500,
                behavior: 'smooth'
            });
            $('input[name=department_kor]').css("border-color", "red");
            return false;
        // 평점 신청
        } else if(!$('input:radio[name=review]').is(':checked')) {
            alert("Please check the Review section.");
            window.scrollTo({
                top: 500,
                behavior: 'smooth'
            });
            $('input:radio[name=review]').css("border-color", "red");
            return false;
        }
    }
}

// Others 리스트 체크
function others_check(){
    var list_others = document.querySelectorAll('input[name="others"]:checked').length;
    if(list_others==0){
        alert("Please check the Others section");
        return false;
    }
}


// information 리스트 체크
function info_check(){
    var list_info = document.querySelectorAll('input[name="list"]:checked').length;
    if(list_info==0){
        alert("Please check the Information section");
        return false;
    }
}

//이메일 중복 체크 한국으로 체크시
function email_check(email) {
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
                //$(".red_alert").eq(0).html("good");
                //$(".red_alert").eq(0).css('display', 'none');
                //$(".mo_red_alert").eq(0).html("good");
                //$(".mo_red_alert").eq(0).css('display', 'none');
            } else if(res.code == 400) {
                alert("used_email_msg");
                $("input[name=email]").val("");
                $("input[name=mo_email]").val("");
                //$(".mo_red_alert").eq(0).html("used_email_msg");
                //$(".mo_red_alert").eq(0).css('display', 'block');
                return false;
            } else {
                //alert("reject_msg");
                //$(".mo_red_alert").eq(0).html("reject_msg");
                //$(".mo_red_alert").eq(0).css('display', 'block');
                return false;
            }
        }
    });
}

function kor_api() {


	var kor_id = $("input[name=kor_id]").val().trim();
	var kor_name = $("input[name=kor_name]").val().trim();
	//제 3자 개인정보 수집에 동의 여부
	var privacy = $("#privacy").is(":checked");

	if(!kor_id) {
		alert("Invalid id");
		//$(".red_api").eq(0).html("format_id");
		return;
	}
	if(!kor_name) {
		alert("Invalid Name");
		//$(".red_api").eq(0).html("format_password");
		return;
	}
	
	if(privacy == false) {
		alert("Please agree to the collection of personal information.");
		$(".red_api").eq(0).html("Please agree to the collection of personal information.");
		return;
	}

	$.ajax({
        url: PATH + "ajax/client/ajax_member.php",
        type: "POST",
        data: {
            flag: "kscp_memeber_check",
            email: kor_id,
            nick_name: kor_name
        },
        dataType: "JSON",
        success: function(res) {
            //console.log("1",res);
            if (res.code == 200) { 
				if(res.result.is_used === "1"){
					alert("이미 사용된 ID입니다.")
					return false;
				}else if(res.result.is_used === "0"){
					alert("회원이 인증되었습니다."); 
					setInfo(res.result); 
                    calc_fee();        
				}
            }
             else if(res.code == 401) {
				alert("ID와 성함을 확인해주세요.")
			}
        },
        complete: function(res) {
            //console.log("2",res)
        }
    });
}


//kscp 정보 받아와서 넣어주기(email, name_kor, affiliation_kor, department_kor)
function setInfo(result){
	const email = result.email;
	const nickname = result.nick_name;
	const org = result.org;
	const department = result.department;
	const userId = result.id;

	$('input[name=ksola_member_check]').val(email);
    $('input[name=email]').val(email);
    $('input[name=first_name_kor]').val(nickname.slice(1));
    $('input[name=last_name_kor]').val(nickname.slice(0,1));
    $('input[name=affiliation_kor]').val(org);
    $('input[name=department_kor]').val(department);
	
}

