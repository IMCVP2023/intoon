<?php
include_once('./include/head.php');
include_once('./include/header.php');

//$_SESSION["abstract"] = "";

//업데이트 시 초록 인덱스
$abstract_idx = $_GET["idx"];
$session_use = $_GET["session"] ?? "N";

//로그인 유무 확인 
if (empty($_SESSION["USER"])) {
	echo "<script>alert(locale(language.value)('need_login')); location.href=PATH+'login.php';</script>";
	exit;
}

//로그인 회원 정보
$user_info = $member;

$user_abstract_category = $user_info["abstract_category"] ?? "";
$user_nation_no = $user_info["nation_no"] ?? "";
$user_first_name = $user_info["first_name"] ?? "";
$user_last_name = $user_info["last_name"] ?? "";
$user_first_name_kor = $user_info["first_name_kor"] ?? "";
$user_last_name_kor = $user_info["last_name_kor"] ?? "";
$user_email = $user_info["email"] ?? "";
$user_info_institution = $user_info["affiliation"] ?? "";
$user_info_department = $user_info["department"] ?? "";
$user_info_affiliation = "";

if ($user_info_department && $user_info_institution) {
	$user_info_affiliation = $user_info_department . ", " . $user_info_institution;
} else if ($user_info_institution) {
	$user_info_affiliation = $user_info_institution;
} else if ($user_info_department) {
	$user_info_affiliation = $user_info_department;
}

//연락처 쪼깨기
$user_info["phone"] = isset($user_info["phone"]) ? str_replace("82-01", "82-1", $user_info["phone"]) : "-";
$_arr_phone = explode("-", $user_info["phone"]);
$user_nation_tel = $_arr_phone[0];
$user_phone = implode("-", array_splice($_arr_phone, 1));

$user_affiliation_value = $user_info_affiliation ?? "";

if (empty($abstract_idx)) {
?>
<!-- 테스트
<section class="submit_application abstract_online_submission container">
    <h1 class="page_title">Online Submission </h1>
    <div class="inner">
        <div class="tab_area">
        </div>
        <div class="container">
            <img class="coming" src="./img/coming.png" />
        </div>

    </div>
</section> -->
<?php
// 테스트
//exit; 
} else {
    // -------------------------------------------------------------- Abstrcat Update -------------------------------------------------------------- //
    if ($abstract_idx) {

        $abstract_sql = "
							SELECT
								ra.idx, ra.nation_no,ra.last_name, ra.first_name, ra.city, ra.state, ra.affiliation, 
								ra.email, ra.phone, ra.position, ra.position_other AS other_position, ra.abstract_category, title_en,
								ra.presenting_author, ra.corresponding_author
							FROM request_abstract AS ra
							LEFT JOIN(
								SELECT
									idx, title_en, title_ko
								FROM info_poster_abstract_category
								WHERE is_deleted = 'N'
							)AS c
							ON ra.abstract_category = c.idx
							WHERE ra.is_deleted = 'N'
						";
        $authors = sql_fetch($abstract_sql . " AND ra.idx = {$abstract_idx} AND ra.parent_author IS NULL ORDER BY ra.register_date DESC LIMIT 1");
		
		
        if ($authors["idx"] == "") {
            echo "<script>alert('Invalid abstract data'); history.back();</script>";
            exit;
        }

		$submit_data = sql_fetch($abstract_sql . "  AND ra.idx = {$abstract_idx}");

        $co_authors = sql_fetch($abstract_sql . "  AND ra.idx = {$abstract_idx}+1 ORDER BY ra.idx ASC");

        foreach ($co_authors as $k => $v) {
            $user_info["co_" . $k] = $v;

            if ($k == "phone") {
                $_arr_phone = explode("-", $v);
                $co_nation_tel = $_arr_phone[0];
                $co_phone = implode("-", array_splice($_arr_phone, 1));

                $user_info["co_nation_tel"] = $co_nation_tel;
                $user_info["co_phone"] = $co_phone;
            }
        }

        $add_co_authors = get_data($abstract_sql . " AND ra.parent_author = {$abstract_idx} AND ra.idx <> {$abstract_idx} ORDER BY ra.idx ASC");

        $no = 0;
        $collect_key = ["first_name", "last_name", "affiliation", "email", "nation_no", "city", "state", "position", "phone", "other_position", "presenting_author", "corresponding_author", "idx"];
        foreach ($add_co_authors as $ca) {
            foreach ($ca as $k => $v) {
                if (in_array($k, $collect_key)) {
                    $coauthor_submit_data[$no]["add_co_" . $k] = $v;
                }
            }

            $no = $no + 1;
        }
    }
}

    // 사전 등록이 된 유저인지 확인(2023-05-15 제거)
    // $registration_idx = check_registration($user_info["idx"]);
    // if (!$registration_idx) {
    //     echo "<script>alert(locale(language.value)('check_registration')); location.href=PATH+'registration_guidelines.php'</script>";
    //     exit;
    // }

	if($session_use == "Y") {
		$submit_data = isset($_SESSION["abstract"]["data"]) ? $_SESSION["abstract"]["data"] : "";
        foreach ($authors as $k => $v) {
            $user_info[$k] = $v;
        }

		$co_list = $_SESSION["abstract"]["co_data"] ?? [];
		$coauthor_submit_data = [];

		//co_author데이터 for문(INTO-ON)
		for ($i = 0; $i < count($co_list); $i++) {
			$coauthor_idx = $co_list[$i]["add_co_idx" . $i] ?? "";
			$coauthor_presenting_author = $co_list[$i]["add_co_presenting_author" . $i] ?? "N";
			$coauthor_corresponding_author = $co_list[$i]["add_co_corresponding_author" . $i] ?? "N";
			$coauthor_nation_no = $co_list[$i]["add_co_nation_no" . $i] ?? "";
			$coauthor_first_name = $co_list[$i]["add_co_first_name" . $i] ?? "";
			$coauthor_last_name = $co_list[$i]["add_co_last_name" . $i] ?? "";
			$coauthor_email = $co_list[$i]["add_co_email" . $i] ?? "";
			$coauthor_nation_tel = $co_list[$i]["add_co_nation_tel" . $i] ?? "";
			$coauthor_phone = $co_list[$i]["add_co_phone" . $i] ?? "";
			$coauthor_affiliation = $co_list[$i]["add_co_affiliation" . $i] ?? "";

			$coauthor_submit_data[] = [
				"add_co_idx"					=> $coauthor_idx,
				"add_co_presenting_author"		=> $coauthor_presenting_author,
				"add_co_corresponding_author"	=> $coauthor_corresponding_author,
				"add_co_nation_no"				=> $coauthor_nation_no,
				"add_co_first_name"				=> $coauthor_first_name,
				"add_co_last_name"				=> $coauthor_last_name,
				"add_co_email"					=> $coauthor_email,
				"add_co_nation_tel"				=> $coauthor_nation_tel,
				"add_co_phone"					=> $coauthor_phone,
				"add_co_affiliation"			=> $coauthor_affiliation
			];
		}

		$data_count = count($coauthor_submit_data);
	}

	if(isset($submit_data)) {
		$data_count = count($coauthor_submit_data);

		if(isset($submit_data["nation_tel"])) {
			$nation_tel = $submit_data["nation_tel"] ?? "";
			$phone = $submit_data["phone"] ?? "";
		} else if (isset($submit_data["phone"])) {
			$_arr_phone = explode("-", $submit_data["phone"]);
			$nation_tel = "+".$_arr_phone[0];
			$phone = implode("-", array_splice($_arr_phone, 1));
		}

		$abstract_category = $submit_data["abstract_category"] ?? "";
		$presenting_author = $submit_data["presenting_author"] ?? "N";
		$corresponding_author = $submit_data["corresponding_author"] ?? "N";
		$nation_no = $submit_data["nation_no"] ?? "";
		$first_name = $submit_data["first_name"] ?? "";
		$last_name = $submit_data["last_name"] ?? "";

		$affiliation_value = array();
		$coauthor_nation_tel = array();

		$submit_data_affiliation = $submit_data["affiliation"];

		$affiliation = $submit_data_affiliation ?? "";
		$affiliation_value = $affiliation;

		$position = $submit_data["position"] ?? "";
		$other_position = $submit_data["other_position"] ?? "";
		$email = $submit_data["email"] ?? "";
		$submit_nation_tel = $nation_tel ?? "";
		$submit_phone = $phone ?? "";
	}

    //국가정보 가져오기
    $nation_query = "SELECT *
					FROM nation
					ORDER BY 
					idx = 25 DESC, nation_en ASC";
    $nation_list = get_data($nation_query);

    //카테고리 정보 가져오기
    $category_list = get_data($_abstract_category_query);

    // -------------------------------------------------------------- Abstrcat Update -------------------------------------------------------------- //

	//세션에 저장된 논문 제출 데이터 (step2에서 step1으로 되돌아올시)
	if(isset($_SESSION["abstract"]["data"])) {
		$submit_data = isset($_SESSION["abstract"]["data"]) ? $_SESSION["abstract"]["data"] : [];
		$co_submit_data = isset($_SESSION["abstract"]["co_data"]) ? $_SESSION["abstract"]["co_data"] : [];
	} else if($abstract_idx) {
		$submit_data_query = "SELECT idx, nation_no, first_name, last_name, affiliation, email, phone
								FROM request_abstract
								WHERE idx = {$abstract_idx}
							";
        $submit_data = sql_fetch($submit_data_query);

		if(isset($submit_data)) {
			$co_submit_data_query = "SELECT idx, nation_no, first_name, last_name, affiliation, email, phone
									FROM request_abstract
									WHERE parent_author = {$abstract_idx}
									";
			$co_submit_data = get_data($submit_data_query);
		}
	}

	if (!empty($nation_list)) {
		echo "<script> var nation = [];";
		foreach ($nation_list as $list) {
			$idx = $list["idx"];
			$nation_ko = $list["nation_ko"];
			$nation_en = $list["nation_en"];

			echo "nation.push({idx : {$idx}, nation_ko : '{$nation_ko}', nation_en : '{$nation_en}'});";
		}
	}
	echo "</script>";

	//제출타입 지정
	echo "<script>var type = 'abstract';</script>";

?>
<style>
/*ldh 추가*/
.btns {
    width: calc(100% - 32px);
    height: 59px;
    max-width: 675px;
    display: block;
    font-size: 24px;
    font-weight: bold;
    margin: 0 auto;
}

.btns span {
    margin-left: 18px;
    color: #fff;
}
</style>
<script src="./js/script/client/submission.js" defer></script>
<script defer>
function other_change(value) {

    var name = value.name;
    var value = $('input[name=' + name + ']:checked').val();

    if (value == '4') {
        $("input[name=" + name + "]").parent().find(".other_input").show();

    } else {
        $("input[name=" + name + "]").parents("ul").find(".other_input").hide();
    }
}

/*function change_select_box() {
	$("#submit_btn").removeClass("blue_btn");
	$("#submit_btn").addClass("gray_btn");
}*/
$(document).ready(function() {
    //[240124] sujoeng / abstract 허용
    // alert("The abstract submission has expired.\nAbstract submission is not available.");
    // window.history.back();
    // window.location.href = "/main/index.php";
    // return;

    $(document).on("click", ".blue_btn", function() {
        var idx = $(this).data("idx");
        var data = {};

        var formData = $("form[name=abstract_form]").serializeArray();
        var process = inputCheck(formData);
        var status = process.status;
        data["main_data"] = process.data;

        if (!status) return false; // 유효성 검증 후 실패 시 return false;
		

		var form_list = $(".co_author_appended .abstract_form");
		var co_form_cnt = form_list.length;

		var co_data_arr = new Array();
		var co_data_temp;
		var co_data_chk;
		var co_process;
		var co_status;
		var co_data;

		if(form_list.length > 0) {
			co_data_temp = $("form[name=coauthor_abstract_form"+i+"]").serializeArray();
			co_process = inputCheck(co_data_temp);
			co_status = co_process.status;
			if (!co_status) return false;
			co_data = co_process.data;
			co_data_arr[i] = co_data;
		}

		for(var i=0;i<co_form_cnt;i++){
			co_data_temp = $("form[name=coauthor_abstract_form"+i+"]").serializeArray();
			co_process = inputCheck(co_data_temp);
			co_status = co_process.status;
			if (!co_status) return false;
			co_data = co_process.data;
			co_data_arr[i] = co_data;
		}

		data["co_data"] = co_data_arr;

        if (status) {
            $.ajax({
                url: PATH + "ajax/client/ajax_submission.php",
                type: "POST",
                data: {
                    flag: "submission_step1",
                    type: "abstract",
                    data: data,
                },
                dataType: "JSON",
                success: function(res) {
                    if (res.code == 200) {
                        $(window).off("beforeunload");

                        if (idx != "") {
                            window.location.href = "./abstract_submission2.php?idx=" + idx;
                        } else {
                            window.location.href = "./abstract_submission2.php";
                        }

                    } else if (res.code == 400) {
                        alert(locale(language.value)("reject_msg"));
                        return false;
                    }
                    else {
                        alert(locale(language.value)("retry_msg"));
                        return false;
                    }
                }
            });
        }
    });

	$(document).on('change', '.nation', function() {
		if($(this).val() == "25") {
			$("input[name=phone]").attr("placeholder", "10-0000-0000");
		} else {
			$("input[name=phone]").attr("placeholder", "");
		}
	});

	$(document).on('change', '.add_co_nation', function() {
		const num = $(this).closest(".abstract_form").data("num");
		if($(this).val() == "25") {
			$("input[name=add_co_phone"+num+"]").attr("placeholder", "10-0000-0000");
		} else {
			$("input[name=add_co_phone"+num+"]").attr("placeholder", "");
		}
	});

    $(document).on('click', '.affiliation_add', function() {
        var instit = $(this).siblings('.institution').val();
        var depart = $(this).siblings('.department').val();
        var affiliation_input = $(this).parent().next().find("input");

		var form_name = this.form.name;
		var affiliation_cnt = $("form[name="+form_name+"]").find('.affiliation_wrap').find('li').length;

        if (instit == '') {
            alert('Please insert institution');
        } else if (depart == '') {
            alert('Please insert department');
        } else if (affiliation_cnt > 9) {
			alert('Affiliation cannot exceed 10');	
        } else {
			const value = depart + ', ' + instit;
			const items = $(this).parent().next('.affiliation_form').find('.affiliation_wrap .affiliation_item');
			for(var i = 0; i < items.length; i++) {
				if(items[i].innerHTML == value) {
					alert("Affiliation cannot be duplicated");
					return;
				}
			}

            html = '';
            html += '<li class="clearfix">';
            html += '<div><p class="affiliation_item">' + value + '</p></div>';
            html += '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
            html += '</li>';

            $(this).siblings('.institution').val('');
            $(this).siblings('.department').val('');
            $(this).parent().next('.affiliation_form').show();
            $(this).parent().next('.affiliation_form').find('.affiliation_wrap').append(html);
        }

        var affiliation = $(this).parent().next().children();
        var affiliation_value = "";

        for (var i = 0; i < affiliation.eq(0).find("p").length; i++) {
            affiliation_value += affiliation.eq(0).find("p:eq(" + i + ")").text() + "★";
        }

        affiliation_input.val(affiliation_value);

        check_value();
    });

    $(document).on('click', '.affiliation_delete', function() {
        var hidden_value = $(this).parent().parent().next()[0].value;

        var hidden_values = hidden_value.split("★");
        $(this).parent().parent().next()[0].value = "";

        for (var i = 0; i < hidden_values.length - 2; i++) {
            $(this).parent().parent().next()[0].value += hidden_values[i] + "★";
        }

        var parents = $(this).parents('.affiliation_form');
        var num = parents.children('li').length;
        var affiliation_input = parents.siblings("input");
        $(this).parent('li').remove();
        if (num == 1) {
            parents.hide();
        }

        //소속 업데이트
        var affiliation_list = [];
        var affiliation = parents.children("li");
        for (i = 0; i < num; i++) {
            affiliation_list.push(affiliation.eq(i).find("p").text());
        }
        affiliation_input.val(affiliation_list);

        check_value();
    });

    $('input[name=position]').on('click', function() {
        var name = $(this).attr("name");
        var value = $('input[name=' + name + ']:checked').val();

        if (value == '4') {
            $(this).parent().find(".other_input").show();
        } else {
            $(this).parents("ul").find(".other_input").hide();
        }
    });

    $('input[name=co_position]').on('click', function() {
        var name = $(this).attr("name");
        var value = $('input[name=' + name + ']:checked').val();

        if (value == '4') {
            $(this).parent().find(".other_input").show();
        } else {
            $(this).parents("ul").find(".other_input").hide();
        }
    });


    //국가 값
    var nation_list = <?php echo json_encode($nation_list) ?>;

    //co-author select on change event
    $('.number_of_author').on('change', function() {
        var num = parseInt($(this).val());
        var current_count = $('.co_author_appended .abstract_form').length;

        if (num == 0) {
            $('.co_author_appended').empty();
        } else if (current_count < num) {
            var html = '';
            for (i = current_count; i < num; i++) {
				html = '';

                html += '<form name="coauthor_abstract_form' + i + '" class="abstract_form co_abstract" data-num="'+i+'">';
                html += '<ul class="basic_ul">';
                html += '<li>';
                html += '<p class="label author_num">Author #' + (i + 2) + '</p>';
                html += '<div>';
                html += '<ul class="author_chk_wrap">';
				html += '<li>';
				html += '<input type="checkbox" class="checkbox" id="author_chk1_1_'+i+'" onchange="setUserInformation($(this))">';
				html += '<label for="author_chk1_1_'+i+'">';
				html += '<i></i>Same as sign-up information<span class="red_txt">*</span>';
				html += '</label>';
                html += '</li>';
				html += '<li>';
				html += '<input type="checkbox" class="checkbox presenting_author" id="author_chk1_2_'+i+'" name="add_co_presenting_author'+i+'" value="Y" onchange="check_value()">';
				html += '<label for="author_chk1_2_'+i+'">';
				html += '<i></i>Presenting Author<span class="red_txt">*</span>';
				html += '</label>';
                html += '</li>';
				html += '<li>';
				html += '<input type="checkbox" class="checkbox corresponding_author" id="author_chk1_3_'+i+'" name="add_co_corresponding_author'+i+'" value="Y" onchange="check_value()">';
				html += '<label for="author_chk1_3_'+i+'">';
				html += '<i></i>Corresponding Author<span class="red_txt">*</span>';
				html += '</label>';
                html += '</li>';
                html += '</ul>';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html += '<p class="label"><?= $locale("country") ?> <span class="red_txt">*</span></p>';
                html += '<div>';
                html += '<select onchange="check_value()" class="required2 add_co_nation" name="add_co_nation_no' + i + '" data-count="' + i + '">';
                html += '<option selected hidden>CHOOSE</option>';
                $.each(nation_list, function(idx, value) {
                    html += '<option value=' + value["idx"] + '>' + value["nation_en"] +
                        '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html += '<p class="label"><?= $locale("name") ?> <span class="red_txt">*</span></p>';
                html += '<div class="name_div clearfix2">';
                html += '<input maxlength="60" placeholder="First name" class="required2 en_keyup" type="text" name="add_co_first_name' + i + '" value="" onchange="check_value()">';
                html += '<input maxlength="60" placeholder="Last name" class="required2 en_keyup" type="text" name="add_co_last_name' + i + '" value="" onchange="check_value()">';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html +=
                    '<p class="label"><?= $locale("affiliation") ?> <span class="red_txt">*</span>  <span class="mb10"><b style="color:#c71b1b;">Please click the "Add" button to add one or more affiliations or departments.</b></span></p>';
                html += '<div>';
                html += '<div class="clearfix affiliation_input">';
                html += '<input maxlength="300" type="text" class="institution en_affiliation_keyup" placeholder="Institution">';
                html += '<input maxlength="300" type="text" class="department en_affiliation_keyup" placeholder="Department">';
                html += '<button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>';
                html += '</div>';
                html += '<div class="clearfix affiliation_form">';
                html += '<ul class="affiliation_wrap affiliation_wrap_' + i + '">';
                html += '<li>';
                html += '</li>';
                html += '</ul>';
                html += '<input type="hidden" name="add_co_affiliation' + i + '" onchange="check_value()">';
                html += '</div>';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html += '<p class="label"><?= $locale("email") ?> <span class="red_txt">*</span></p>';
                html += '<div>';
                html += '<input maxlength="60" class="required2 email" type="text" name="add_co_email' + i + '" value="" onchange="check_value()">';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html += '<p class="label"><?= $locale("phone") ?> <span class="red_txt">*</span></p>';
                html += '<div class="phone_div clearfix2">';
                html += '<select class="required2" name="add_co_nation_tel' + i + '">';
                html += '<option value="" selected></option>';
                html += '</select>';
                html += '<input class="required2 phone" type="text" name="add_co_phone' + i + '" value="" onchange="check_value()">';
                html += '</div>';
                html += '</li>';
                html += '</ul>';
                html == '</form>';

				$('.co_author_appended').append(html);
            }
        } else if (current_count > num) {
            for (i = current_count; i > num; i--) {
                console.log('i', i);

                $('.co_author_appended .section_title_wrap2').eq((i - 1)).remove();
                $('.co_author_appended .abstract_form').eq((i - 1)).remove();
            }
        }

		check_value();
    });
});

//주저자와 공동저자가 동일 시 체크버튼 이벤트
function same_add_author() {
    if ($("#same_withs").is(":checked")) {
        var nation_no = $("select[name=nation_no]").val();

        if (nation_no != "") {
            $("select[name=co_nation_no]").children("option[value=" + nation_no + "]").prop("selected", true);
            $("select[name=co_nation_tel1] option").val($("select[name=nation_tel] option").val()).text($("select[name=nation_tel] option").val());
        }
        var position = $("input[name=position]:checked").val();

        $("input[name=co_first_name]").val($("input[name=first_name]").val());
        $("input[name=co_last_name]").val($("input[name=last_name]").val());
        $("input[name=co_email").val($("input[name=email]").val());
        $("input[name=co_phone]").val($("input[name=phone]").val());
        if (position == "4") {
            $("input[name=co_position][value=" + position + "]").prop("checked", true);
            $("input[name=co_other_position]").val($("input[name=other_position]").val());
            $("form[name=co_abstract_form] .other_input").show();

        } else {
            $("input[name=co_position][value=" + position + "]").prop("checked", true);
        }

        if ($("input[name=affiliation]").val() != "") {

            var affiliation_wrap_02 = document.getElementsByClassName("affiliation_wrap_02")[0];
            while (affiliation_wrap_02.hasChildNodes()) {
                affiliation_wrap_02.removeChild(affiliation_wrap_02.firstChild);

            }
            $("input[name=co_affiliation]").val($("input[name=affiliation]").val());
            $(".affiliation_wrap_02").append($(".affiliation_wrap_01").html()).show();
        }
    } else {
        var nation_no = $("select[name=nation_no]").val();

        if (nation_no != "") {
            $("select[name=co_nation_no]").children("option[value=" + nation_no + "]").prop("selected", false);
            $("select[name=co_nation_no]").children("option[hidden]").prop("selected", true);
        }

        $("select[name=co_nation_tel1] option").val("").text("select");
        $("input[name=co_first_name]").val("");
        $("input[name=co_last_name]").val("");
        $("input[name=co_affililation]").val("");
        $("input[name=co_position]").prop("checked", false); //[value="+position+"]
        $("input[name=co_other_postion]").val("");
        $("input[name=co_other_position]").hide();
        $("input[name=co_email]").val("");
        $("input[name=co_phone]").val("");

        $(".affiliation_wrap_02").empty();
    }

    check_value();
}

//주저자와 교신저자가 동일 시 체크버튼 이벤트
function add_author(i) {
    if ($("#same_with" + i).is(":checked")) {
        var nation_no = $("select[name=nation_no]").val();

        if (nation_no != "") {
            $("select[name=add_co_nation_no" + i + "]").children("option[value=" + nation_no + "]").prop("selected",
                true);
            $("select[name=add_co_nation_tel" + i + "] option").val($("select[name=nation_tel] option").val()).text($("select[name=nation_tel] option").val());
        }
        var position = $("input[name=position]:checked").val();

        $("input[name=add_co_first_name" + i + "]").val($("input[name=first_name]").val());
        $("input[name=add_co_last_name" + i + "]").val($("input[name=last_name]").val());
        $("input[name=add_co_city" + i + "]").val($("input[name=city]").val());
        $("input[name=add_co_state" + i + "]").val($("input[name=state]").val());
        $("input[name=add_co_email" + i + "]").val($("input[name=email]").val());
        $("input[name=add_co_phone" + i + "]").val($("input[name=phone]").val());
        if (position == "4") {
            $("input[name=add_co_position" + i + "][value=" + position + "]").prop("checked", true);
            $("input[name=add_co_other_position" + i + "]").val($("input[name=other_position]").val());
            $("form[name=coauthor_abstract_form" + i + "] .other_input").show();

        } else {
            $("input[name=add_co_position" + i + "][value=" + position + "]").prop("checked", true);
        }

        if ($("input[name=affiliation]").val() != "") {
            var add_co_affiliation = document.getElementsByClassName("affiliation_wrap_" + i)[0];
            while (add_co_affiliation.hasChildNodes()) {
                add_co_affiliation.removeChild(add_co_affiliation.firstChild);

            }
            $("input[name=add_co_affiliation" + i + "]").val($("input[name=affiliation]").val());
            $(".affiliation_wrap_" + i).append($(".affiliation_wrap_01").html()).show();
        }
    } else {
        var nation_no = $("select[name=nation_no]").val();

        if (nation_no != "") {
            $("select[name=add_co_nation_no" + i + "]").children("option[value=" + nation_no + "]").prop("selected",
                false);
            $("select[name=add_co_nation_no" + i + "]").children("option[hidden]").prop("selected", true);
        }

        $("select[name=add_co_nation_tel" + i + "] option").val("").text("select");
        $("input[name=add_co_first_name" + i + "]").val("");
        $("input[name=add_co_last_name" + i + "]").val("");
        $("input[name=add_co_city" + i + "]").val("");
        $("input[name=add_co_state" + i + "]").val("");
        $("input[name=add_co_affililation" + i + "]").val("");
        $("input[name=add_co_position" + i + "]").prop("checked", false); //[value="+position+"]
        $("form[name=coauthor_abstract_form" + i + "] .other_input").val("").hide();
        $("input[name=add_co_email" + i + "]").val("");
        $("input[name=add_co_phone" + i + "]").val("");

        $(".affiliation_wrap_" + i).empty();
    }

    check_value();
}

function inputCheck(formData) {

    var data = {};
    var length_100 = ["email", "co_email"]
    var length_50 = ["first_name", "last_name", "co_first_name", "co_last_name"];

    var inputCheck = true;

    $.each(formData, function(key, value) {
        var ok = value["name"];
        var ov = value["value"];

        if (ov == "" || ov == null || ov == "undefinded") {
            if (ok == "abstract_category") {
                alert(locale(language.value)("check_abstract_category"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "nation_no") {
                alert(locale(language.value)("check_nation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "first_name") {
                alert(locale(language.value)("check_first_name"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "last_name") {
                alert(locale(language.value)("check_last_name"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "affiliation") {
                alert(locale(language.value)("check_affiliation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "email") {
                alert(locale(language.value)("check_email"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "phone") {
                alert(locale(language.value)("check_phone"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok.includes("add_co_nation_no")) {
                alert(locale(language.value)("check_co_nation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok.includes("add_co_first_name")) {
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok.includes("add_co_last_name")) {
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok.includes("add_co_email")) {
                alert(locale(language.value)("check_co_email"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok.includes("co_affiliation")) {
                alert(locale(language.value)("check_co_affiliation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok.includes("add_co_phone")) {
                alert(locale(language.value)("check_co_phone"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            }
        } else {
            if ((length_50.indexOf(ok) + 1) && ov.length > 50) {
                alert(ok + locale(language.value)("under_50"));
                inputCheck = false;
                return false;
            } else if ((length_100.indexOf(ok) + 1) && ov.length > 100) {
                alert(ok + locale(language.value)("under_100"));
                inputCheck = false;
                return false;
            } else if (ok == "phone" && ov.length < 6) {
                alert(ok + locale(language.value)("over_6"));
                inputCheck = false;
                return false;
            } else if (ok == "phone" && ov.length > 20) {
                alert(ok + locale(language.value)("under_20"));
                inputCheck = false;
                return false;
            }
        }

        data[ok] = ov;
    });

	if($(".presenting_author:checked").length != 1) {
		alert("please check only one presenting_author");
		return false;
	}

	if($(".corresponding_author:checked").length != 1) {
		alert("please check only one corresponding_author");
		return false;
	}

    return {
        data: data,
        status: inputCheck
    }
}

//체크 벨류
function check_value() {
	let email_regex = new RegExp('[a-z0-9]+@[a-z0-9]+\.[a-z]{2,3}');

    var affiliation_len = $(".affiliation_wrap li").length;;

    if (affiliation_len < 0) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    }

	var nation_no = $("select[name=nation_no]").val();

    // position 유효성
    var position_count = $('input.other_input').length;
    var position_checked_count = $('input.radio.required2:checked').length;
    var position_other_check_count = $('input.radio.required2[value=4]:checked').length;
    var position_other_write_count = 0;
    $('input.other_input').each(function() {
        if ($(this).val()) {
            position_other_write_count++;
        }
    });

    // position 체크 안됨
    if (position_count > position_checked_count) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    }

    // position other 체크했지만 값 입력하지 않음
    if (position_other_check_count > position_other_write_count) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    }

    var abstract_category = $("select[name=abstract_category]").val();

    var first_name = $("input[name=first_name]").val();
    var first_name_len = first_name.trim().length;
    first_name = (typeof(first_name) != "undefined") ? first_name : null;

    var last_name = $("input[name=last_name]").val();
    var last_name_len = last_name.trim().length;
    last_name = (typeof(last_name) != "undefined") ? last_name : null;

    //var city = $("input[name=city]").val();
    //var city_len = city.trim().length;
    //city = (typeof(city) != "undefined") ? city : null;

    var affiliation = $("input[name=affiliation]").val();
    var affiliation_len = affiliation.trim().length;
    affiliation = (typeof(affiliation) != "undefined") ? affiliation : null;

    var email = $("input[name=email]").val();
    var email_len = email.trim().length;
    email = (typeof(email) != "undefined") ? email : null;

    var phone = $("input[name=phone]").val();
    var phone_len = phone.trim().length;
    phone = (typeof(phone) != "undefined") ? phone : null;

	if (nation_no == "") {
		$("#submit_btn").removeClass("blue_btn");
		$("#submit_btn").addClass("gray_btn");
		$("input[name=phone]").attr("placeholder", "");
		return;
	}
    if (abstract_category == "") {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    }
    if (!first_name) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    }
    if (!last_name) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    }
    if (!affiliation_len < 0) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    }
    if (!email) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    } else if(!email_regex.test(email)) {
		$("#submit_btn").removeClass("blue_btn");
		$("#submit_btn").addClass("gray_btn");
		alert("Please check email adress field.");
		return;
	}

    if (!phone) {
        $("#submit_btn").removeClass("blue_btn");
        $("#submit_btn").addClass("gray_btn");
        return;
    } else {
		if($("select[name=nation_no]").val() == 25) { // Republic of Korea
			var regPhone = /^1([0|1|6|7|8|9])-?([0-9]{3,4})-?([0-9]{4})$/;
			if (!regPhone.test(phone)) {
				$("#submit_btn").removeClass("blue_btn");
			    $("#submit_btn").addClass("gray_btn");
				alert("Please enter your phone number correctly \nexample) 10-0000-0000");
				return;
			}
		} else { // 해외 - 숫자만
			var regPhone = /^[0-9]+$/;
			if (!regPhone.test(phone)) {
				$("#submit_btn").removeClass("blue_btn");
			    $("#submit_btn").addClass("gray_btn");
				alert("Please enter only digits for phone number field.");
				return;
			}
		}
	}

	var form_list = $(".co_author_appended .abstract_form");
	var is_valid = true;
	if(form_list.length > 0) {
		form_list.each(function (idx, obj) {
			const form = $(obj);
			const num = $(form).data("num");

			var co_nation_no = form.find("select[name=add_co_nation_no"+num+"]").val();

			var co_first_name = form.find("input[name=add_co_first_name"+num+"]").val();
			co_first_name = (typeof(co_first_name) != "undefined") ? co_first_name : null;

			var co_last_name = form.find("input[name=add_co_last_name"+num+"]").val();
			co_last_name = (typeof(co_last_name) != "undefined") ? co_last_name : null;

			var co_affiliation_len = form.find(".affiliation_wrap li").length;

			var co_email = form.find("input[name=add_co_email"+num+"]").val();
			co_email = (typeof(co_email) != "undefined") ? co_email : null;

			var co_phone = form.find("input[name=add_co_phone"+num+"]").val();
			co_phone = (typeof(co_phone) != "undefined") ? co_phone : null;

			if (co_nation_no == "") {
				$("#submit_btn").removeClass("blue_btn");
				$("#submit_btn").addClass("gray_btn");
				form.find("input[name=add_co_phone"+num+"]").attr("placeholder", "");
				is_valid = false;
				return;
			} else {
				if(co_nation_no == "25") {
					form.find("input[name=add_co_phone"+num+"]").attr("placeholder", "10-0000-0000");
				} else {
					form.find("input[name=add_co_phone"+num+"]").attr("placeholder", "");
				}
			}
			if (!co_first_name) {
				$("#submit_btn").removeClass("blue_btn");
				$("#submit_btn").addClass("gray_btn");
				is_valid = false;
				return;
			}
			if (!co_last_name) {
				$("#submit_btn").removeClass("blue_btn");
				$("#submit_btn").addClass("gray_btn");
				is_valid = false;
				return;
			}
			if (co_affiliation_len < 1) {
				$("#submit_btn").removeClass("blue_btn");
				$("#submit_btn").addClass("gray_btn");
				is_valid = false;
				return;
			}
			if (!co_email) {
				$("#submit_btn").removeClass("blue_btn");
				$("#submit_btn").addClass("gray_btn");
				is_valid = false;
				return;
			}
			if (!co_phone) {
				$("#submit_btn").removeClass("blue_btn");
				$("#submit_btn").addClass("gray_btn");
				is_valid = false;
				return;
			}
		});
	}

	if(is_valid) {
		$("#submit_btn").removeClass("gray_btn");
		$("#submit_btn").addClass("blue_btn");
	}
}

// Same as sign-up information
function setUserInformation(target) {
	const form = target.closest(".abstract_form");

	if(target.prop("checked")) {
		if(form.hasClass("co_abstract")) {
			const num = form.data("num");

			form.find("select[name=add_co_nation_no"+num+"]").val($("input[name=user_nation_no]").val());
			form.find("input[name=add_co_first_name"+num+"]").val($("input[name=user_first_name]").val());
			form.find("input[name=add_co_last_name"+num+"]").val($("input[name=user_last_name]").val());
			form.find("input[name=add_co_email"+num+"]").val($("input[name=user_email]").val());
			form.find("input[name=add_co_phone"+num+"]").val($("input[name=user_phone]").val());
			form.find("select[name=add_co_nation_tel"+num+"] option")[0].value = $("input[name=user_nation_tel]").val();
			form.find("select[name=add_co_nation_tel"+num+"] option")[0].textContent = $("input[name=user_nation_tel]").val();
			form.find("select[name=add_co_nation_tel"+num+"] option").click();

			form.find(".institution").val($("input[name=user_info_institution]").val());
			form.find(".department").val($("input[name=user_info_department]").val());
			form.find(".affiliation_wrap").empty();
			form.find(".affiliation_add").click();
		} else {
			form.find("select[name=nation_no]").val($("input[name=user_nation_no]").val());
			form.find("input[name=first_name]").val($("input[name=user_first_name]").val());
			form.find("input[name=last_name]").val($("input[name=user_last_name]").val());
			form.find("input[name=email]").val($("input[name=user_email]").val());
			form.find("input[name=phone]").val($("input[name=user_phone]").val());
			form.find("select[name=nation_tel] option")[0].value = $("input[name=user_nation_tel]").val();
			form.find("select[name=nation_tel] option")[0].textContent = $("input[name=user_nation_tel]").val();
			form.find("select[name=nation_tel] option").click();

			form.find(".institution").val($("input[name=user_info_institution]").val());
			form.find(".department").val($("input[name=user_info_department]").val());
			form.find(".affiliation_wrap").empty();
			form.find(".affiliation_add").click();
		}
	} else {
		if(form.hasClass("co_abstract")) {
			const num = form.data("num");

			form.find("select[name=add_co_nation_no"+num+"]").val("");
			form.find("input[name=add_co_first_name"+num+"]").val("");
			form.find("input[name=add_co_last_name"+num+"]").val("");
			form.find("input[name=add_co_email"+num+"]").val("");
			form.find("input[name=add_co_phone"+num+"]").val("");
			form.find("select[name=add_co_nation_tel"+num+"] option")[0].value = "";
			form.find("select[name=add_co_nation_tel"+num+"] option")[0].textContent = "";

			form.find(".institution").val("");
			form.find(".department").val("");
			form.find(".affiliation_wrap").empty();
			form.find("input[name=add_co_affiliation"+num+"]").val("");
		} else {
			form.find("select[name=nation_no]").val("");
			form.find("input[name=first_name]").val("");
			form.find("input[name=last_name]").val("");
			form.find("input[name=email]").val("");
			form.find("input[name=phone]").val("");
			form.find("select[name=nation_tel] option")[0].value = "";
			form.find("select[name=nation_tel] option")[0].textContent = "";
			form.find("select[name=nation_tel] option").click();

			form.find(".institution").val("");
			form.find(".department").val("");
			form.find(".affiliation_wrap").empty();
			form.find("input[name=affiliation]").val("");
		}
	}
	
	check_value();
}

//핸드폰 유효성
$(document).on('change keyup', ".phone", function(key) {
    var _this = $(this);
    if (key.keyCode != 8) {
        var phone = _this.val().replace(/[^0-9 || -]/gi, '');
        _this.val(phone);
    }
});
$(document).ready(function() {
    $(document).on("keyup", ".en_keyup", function(key) {
        var pattern_eng = /[^a-zA-Z\s]/gi;
        var _this = $(this);
        if (key.keyCode != 8) {
            var first_name = _this.val().replace(pattern_eng, '');
            _this.val(first_name.trim());
        }
    });

    $(document).on("keyup", ".num_keyup", function(key) {
        var pattern_eng = /[^0-9]/gi;
        var _this = $(this);
        if (key.keyCode != 8) {
            var first_name = _this.val().replace(pattern_eng, '');
            _this.val(first_name.trim());
        }
    });
    $(document).on("keyup", ".en_num_keyup", function(key) {
        var pattern_eng = /[^0-9||a-zA-Z\s]/gi;
        var _this = $(this);
        if (key.keyCode != 8) {
            var first_name = _this.val().replace(pattern_eng, '');
            _this.val(first_name);
        }
    });
	$(document).on("keyup", ".en_affiliation_keyup", function(key) {
        var pattern_eng = /[^0-9||*-_@!#^&||a-zA-Z\s]/gi;
        var _this = $(this);
        if (key.keyCode != 8) {
            var first_name = _this.val().replace(pattern_eng, '');
            _this.val(first_name);
        }
    });

    $(document).on("change", ".email", function() {
        var email = $(this).val().trim();
        var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;

        if (email.match(regExp) != null) {
            $(this).val(email);
        } else {
            alert("Invalid email format.");
            $(this).val("").focus();
            return;
        }
    });
});
</script>

<section class="submit_application abstract_online_submission container">
	<input type="hidden" name="user_abstract_category" value="<?=$user_abstract_category?>" />
	<input type="hidden" name="user_nation_no" value="<?=$user_nation_no?>" />
	<input type="hidden" name="user_first_name" value="<?=$user_first_name?>" />
	<input type="hidden" name="user_last_name" value="<?=$user_last_name?>" />
	<input type="hidden" name="user_first_name" value="<?=$user_first_name?>" />
	<input type="hidden" name="user_last_name" value="<?=$user_last_name?>" />
	<input type="hidden" name="user_info_institution" value="<?=$user_info_institution?>" />
	<input type="hidden" name="user_info_department" value="<?=$user_info_department?>" />
	<input type="hidden" name="user_email" value="<?=$user_email?>" />
	<input type="hidden" name="user_nation_tel" value="<?=$user_nation_tel?>" />
	<input type="hidden" name="user_phone" value="<?=$user_phone?>" />

    <h1 class="page_title">Online Submission</h1>
    <div class="inner">
        <div>
            <div class="steps_area">
                <ul class="clearfix">
                    <li class="on">
                        <p>Step 1</p>
						<p class="sm_txt">Fill out author’s information</p>
                    </li>
                    <li>
                        <p>Step 2</p>
                        <p class="sm_txt">Enter the abstract section, including the type of presentation, topic categories, and title.</p>
                    </li>
                    <li>
                        <p>Step 3</p>
                        <p class="sm_txt">Complete and confirm submission.</p>
                    </li>
                </ul>
            </div>
            <div class="input_area">
                <form name="abstract_form" class="abstract_form">
                    <div>
                        <div class="section_title_wrap2">
                            <h3 class="title">
								Author Information
								<p class="mini_alert essential"><span class="red_txt">*</span> All requested field(<span class="red_txt">*</span>) should be completed.</p>
							</h3>
                        </div>
                        <ul class="basic_ul">
							<li>
                                <p class="label author_num">Author #1</p>
                                <div>
									<ul class="author_chk_wrap">
										<li>
											<input type="checkbox" class="checkbox" id="author_chk1_1" onchange="setUserInformation($(this))">
											<label for="author_chk1_1">
												<i></i>Same as sign-up information<span class="red_txt">*</span>
											</label>
										</li>
										<li>
											<input type="checkbox" class="checkbox presenting_author" id="author_chk1_2" name="presenting_author" value="Y" <?= $presenting_author == "Y" ? "checked" : "" ?> onchange="check_value()">
											<label for="author_chk1_2">
												<i></i>Presenting Author<span class="red_txt">*</span>
											</label>
										</li>
										<li>
											<input type="checkbox" class="checkbox corresponding_author" id="author_chk1_3" name="corresponding_author" value="Y" <?= $corresponding_author == "Y" ? "checked" : "" ?> onchange="check_value()">
											<label for="author_chk1_3">
												<i></i>Corresponding Author<span class="red_txt">*</span>
											</label>
										</li>
									</ul>
                                </div>
                            </li>
                            <li>
                                <p class="label"><?= $locale("country") ?> <span class="red_txt">*</span></p>
                                <div>
                                    <select class="required2 nation" name="nation_no" data-count="0" onchange="check_value()">
                                        <option value="" selected hidden>Choose </option>
                                        <?php
                                            foreach ($nation_list as $list) {
                                                $nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
                                                $selected = $nation_no == $list["idx"] ? "selected" : "";
                                                echo "<option value='" . $list["idx"] . "'" . $selected . ">" . $nation . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <p class="label"><?= $locale("name") ?> <span class="red_txt">*</span></p>
                                <div class="name_div clearfix2">
                                    <input maxlength="60" placeholder="First name" class="required2 en_keyup" type="text" name="first_name"
                                        value="<?= $first_name ?>" onchange="check_value()">
                                    <input maxlength="60" placeholder="Last name" class="required2 en_keyup" type="text" name="last_name"
                                        value="<?= $last_name ?>" onchange="check_value()">
                                </div>
                            </li>
                            <li>
                                <p class="label"><?= $locale("affiliation") ?> <span class="red_txt">*</span> <span class="mb10"><b style="color:#c71b1b;">Please click the "Add" button to add one or more affiliations or departments.</b></span></p>
                                <div>
                                    <div class="clearfix affiliation_input">
                                        <input maxlength="300" type="text" class="institution en_affiliation_keyup" placeholder="Institution">
                                        <input maxlength="300" type="text" class="department en_affiliation_keyup" placeholder="Department">
                                        <button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>
                                    </div>
                                    <div class="clearfix affiliation_form">
                                        <ul class="affiliation_wrap affiliation_wrap_01" style="<?= $affiliation != "" ? "display:block" : "" ?>">
                                        <?php 
											if (count($affiliation) - 1 <= 0) { 
												if (!is_array($affiliation)) {
													$affiliation_arr = explode("★", $affiliation);
												} else {
													$affiliation_arr = $affiliation;
												}

												for ($j = 0; $j < count($affiliation_arr) - 1; $j++) {
													echo '<li class="clearfix">';
													echo    '<div class="clearfix">';
													echo        '<p class="affiliation_item">' . $affiliation_arr[$j] . '</p>';
													echo    '</div>';
													echo    '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
													echo '</li>';
												}
											}
										?>
										</ul>
                                        <input type="hidden" name="affiliation" value="<?= $affiliation ?>" onchange="check_value()">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p class="label"><?= $locale("email") ?> <span class="red_txt">*</span></p>
                                <div>
                                    <input maxlength="60" class="required2 email" type="text" name="email"
                                        value="<?= $email ?>" onchange="check_value()">
                                </div>
                            </li>
                            <li>
                                <p class="label"><?= $locale("phone") ?> <span class="red_txt">*</span></p>
                                <div class="phone_div clearfix2">
                                    <select class="required2" name="nation_tel">
                                        <option value="<?= isset($submit_phone) && $submit_phone != "" ? $submit_nation_tel : "" ?>" selected><?= isset($submit_phone) && $submit_phone != "" ? $submit_nation_tel : "" ?></option>
                                    </select>
                                    <input maxlength="60" class="required2 phone" type="text" name="phone" value="<?= $submit_phone ?>" onchange="check_value()">
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
			</div>
            <div class="clearfix2 coauthor_wrap">
                <p><?= $locale("check_co_author2") ?></p>
                <div>
                    <select class="number_of_author">
                        <?php
                            for ($i = 0; $i <= 12; $i++) {
                                if ($i == 0) {
                                    echo "<option value='0' selected>Select</option>";
                                } else {
                                    if (($data_count - 2) == $i) {
                                        echo "<option value=" . $i . " selected>" . $i . "</option>";
                                    } else {
                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                    }
                                }
                            }
                            ?>
                    </select>
                </div>
            </div>

            <!--coauthor append-->
			<input type="hidden" id="co_count" value="<?= ($data_count - 1) ?>" />
            <div class="co_author_appended">
                <?php
                    if (isset($coauthor_submit_data)) {
                        for ($i = 0; $i < count($coauthor_submit_data); $i++) {
							$coauthor = $coauthor_submit_data[$i];

                            echo  '<form name="coauthor_abstract_form'.$i.'" class="abstract_form co_abstract" data-num="'.$i.'">';
							echo     '<input type="hidden" name="add_co_idx' . $i . '" value="'.$coauthor["add_co_idx"].'">';
                            echo        '<ul class="basic_ul">';
							echo            '<li>';
                            echo                '<p class="label author_num">' . 'Author #' . ($i + 2) . '</p>';
                            echo                '<div>';
                            echo                    '<ul class="author_chk_wrap">';
                            echo						'<li>';
                            echo							'<input type="checkbox" class="checkbox" id="author_chk1_1_'.$i.'" onchange="setUserInformation($(this))">';
                            echo							'<label for="author_chk1_1_'.$i.'">';
                            echo								'<i></i>Same as sign-up information<span class="red_txt">*</span>';
                            echo							'</label>';
                            echo						'</li>';
							echo						'<li>';
                            echo							'<input type="checkbox" class="checkbox presenting_author" id="author_chk1_2_'.$i.'"  name="add_co_presenting_author'.$i.'" value="Y" '.($coauthor["add_co_presenting_author"] == 'Y' ? "checked" : "").' onchange="check_value()">';
                            echo							'<label for="author_chk1_2_'.$i.'">';
                            echo								'<i></i>Presenting Author<span class="red_txt">*</span>';
                            echo							'</label>';
                            echo						'</li>';
							echo						'<li>';
                            echo							'<input type="checkbox" class="checkbox corresponding_author"  id="author_chk1_3_'.$i.'"  name="add_co_corresponding_author'.$i.'" value="Y" '.($coauthor["add_co_corresponding_author"] == 'Y' ? "checked" : "").' onchange="check_value()">';
                            echo							'<label for="author_chk1_3_'.$i.'">';
                            echo								'<i></i>Corresponding Author<span class="red_txt">*</span>';
                            echo							'</label>';
                            echo						'</li>';
                            echo                    '</ul>';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("country") . '<span class="red_txt">*</span></p>';
                            echo                '<div>';
                            echo                    '<select onchange="check_value()" class="required2 add_co_nation" name="add_co_nation_no'.$i.'" data-count="'.$i.'">';
                            echo                        '<option hidden>CHOOSE</option>';
                            foreach ($nation_list as $list) {
                                $nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
                                $selected = $coauthor["add_co_nation_no"] == $list["idx"] ? "selected" : "";
                                echo "<option value='" . $list["idx"] . "'" . $selected . ">" . $nation . "</option>";
                            }
                            echo                    '</select>';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("name") . ' <span class="red_txt">*</span></p>';
                            echo                '<div class="name_div clearfix2">';
                            echo                    '<input maxlength="60" placeholder="First name" class="required2 en_keyup" type="text" name="add_co_first_name'.$i.'" value="' . $coauthor["add_co_first_name"] . '" onchange="check_value()">';
                            echo                    '<input maxlength="60" placeholder="Last name" class="required2 en_keyup" type="text" name="add_co_last_name'.$i.'" value="' . $coauthor["add_co_last_name"] . '" onchange="check_value()">';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("affiliation") . ' <span class="red_txt">*</span>  <span class="mb10"><b style="color:#c71b1b;">Please click the "Add" button to add one or more affiliations or departments.</b></span></p>';
                            echo                '<div>';
                            echo                    '<div class="clearfix affiliation_input">';
                            echo                        '<input maxlength="300" type="text" class="institution en_affiliation_keyup" placeholder="Institution">';
                            echo                        '<input maxlength="300" type="text" class="department en_affiliation_keyup" placeholder="Department">';
                            echo                        '<button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>';
                            echo                    '</div>';
                            echo                    '<div class="clearfix affiliation_form">';
                            echo                        '<ul class="affiliation_wrap affiliation_wrap_' . $i . '">';
							if ($coauthor["add_co_affiliation"] != "") {
                                if (!is_array($coauthor["add_co_affiliation"])) {
                                    $coauthor_affiliation_arr = explode("★", $coauthor["add_co_affiliation"]);
                                } else {
                                    $coauthor_affiliation_arr = $coauthor["add_co_affiliation"];
                                }

                                for ($j = 0; $j < count($coauthor_affiliation_arr)-1; $j++) {
                                    echo '<li class="clearfix">';
                                    echo    '<div class="clearfix">';
                                    echo        '<p class="affiliation_item">' . $coauthor_affiliation_arr[$j] . '</p>';
                                    echo    '</div>';
                                    echo    '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
                                    echo '</li>';
                                }
                            }
                            echo                        '</ul>';
                            echo                        '<input type="hidden" value="' . $coauthor["add_co_affiliation"] . '" name="add_co_affiliation' . $i . '" onchange="check_value()">';
                            echo                    '</div>';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("email") . ' <span class="red_txt">*</span></p>';
                            echo                '<div>';
                            echo                    '<input maxlength="60" class="required2 email" type="text" name="add_co_email' . $i . '" value="' . $coauthor["add_co_email"] . '" onchange="check_value()">';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("phone") . ' <span class="red_txt">*</span></p>';
                            echo                '<div class="phone_div clearfix2">';
                            echo                    '<select class="required2" name="add_co_nation_tel' . $i . '">';
							if(!isset($coauthor["add_co_nation_tel"])) {
								$co_arr_phone = explode("-", $coauthor["add_co_phone"]);
								$co_nation_tel = isset($co_arr_phone[0]) ? '+'.$co_arr_phone[0] : "" ;
								$co_phone = implode("-", array_splice($co_arr_phone, 1));
							} else {
								$co_nation_tel = $coauthor["add_co_nation_tel"];
								$co_phone = $coauthor["add_co_phone"];
							}
                            echo                        '<option value="' . $co_nation_tel . '" selected>' . $co_nation_tel . '</option>';
                            echo                    '</select>';
                            echo                    '<input maxlength="60" class="required2 phone" type="text" name="add_co_phone' . $i . '" value="' . $co_phone . '" onchange="check_value()">';
                            echo                '</div>';
                            echo            '</li>';
                            echo        '</ul>';
                            echo        '<input type="hidden" value=' . $coauthor["add_co_idx"] . ' name="add_co_idx' . $i . '">';
                            echo     '</form>';
                        }
                    }
                    ?>
            </div>
            <!-- online_btn -->
            <?php
                if (!empty($abstract_idx) || !empty($submit_data)) {
            ?>
            <button type="button" id="submit_btn" class="btn btns blue_btn submit_btn" data-idx=<?= $abstract_idx ?>><?= $locale("next_btn") ?><!-- <span>&gt;</span> --></button>
            <?php
                } else {
            ?>
            <button type="button" id="submit_btn" class="btn btns gray_btn submit_btn"
                data-idx=<?= $abstract_idx ?>><?= $locale("next_btn") ?><!-- <span>&gt;</span> --></button>
            <?php
                }
            ?>
        </div>
    </div>
    <!--//section1-->
    </div>
</section>

<?php
include_once('./include/footer.php');
?>