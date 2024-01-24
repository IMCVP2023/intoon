<?php
include_once('./include/head.php');
include_once('./include/header.php');

$sql_during =    "SELECT
						IF(DATE(NOW()) BETWEEN period_lecture_start AND period_lecture_end, 'Y', 'N') AS yn
					FROM info_event";

$during_yn = sql_fetch($sql_during)['yn'];

//업데이트 시 초록 인덱스
$lecture_idx = $_GET["idx"];

if ($during_yn !== "Y" && empty($lecture_idx)) {
?>
<section class="submit_application sub_page">
    <div class="inner" style="margin-top: 220px;">
        <h1 class="page_title">Lecture Note Submission</h1>
        <ul class="tab_green">
            <li><a href="./lecture_note_submission.php">Lecture Note Submission Guideline</a></li>
            <li class="on"><a href="">Online Submission</a></li>
            <!--
			<li><a href="javascript:;" class="btn active"><?= $locale("lecture_menu1") ?></a></li>
			<li><a href="./lecture_submission.php" class="btn"><?= $locale("lecture_menu2") ?></a></li>
			<li><a href="./oral_presenters.php" class="btn"><?= $locale("lecture_menu3") ?></a></li>
			<li><a href="./eposter_presenters.php" class="btn"><?= $locale("lecture_menu4") ?></a></li> -->
        </ul>
        <div class="section section1">
            <!-- 1. Message | start -->
            <div class="details">
                <!-- <?= htmlspecialchars_decode(strip_tags($info['note_msg'])) ?> -->
                <img class="coming" src="./img/coming.png" />
            </div>
            <!-- 1. Message | end -->

            <!-- 6. Speakers Preview room | end -->


        </div>
    </div>
</section>
<?php
} else {

    if (empty($_SESSION["USER"])) {
        echo "<script>alert(locale(language.value)('need_login')); location.href=PATH+'login.php';</script>";
        exit;
    } else {
        //로그인 회원 정보
        $user_info = $member;
    }

    // 사전 등록이 된 유저인지 확인
    //$registration_idx = check_registration($user_info["idx"]);
    //if(!$registration_idx) {
    //	echo "<script>alert(locale(language.value)('check_registration')); location.href=PATH+'registration_guidelines.php';</script>";
    //	exit;
    //}

    if (!$lecture_idx) {
        //제출 유무 확인
        $check_submission = check_submission($user_info["idx"], "lecture");

        if ($check_submission) {
            echo "<script>alert(locale(language.value)('already_submission')); location.href=PATH+'mypage_abstract.php'</script>";
            exit;
        }
    }

    //국가정보 가져오기
    $nation_list_query = $_nation_query;
    $nation_list = get_data($nation_list_query);


    if (!$lecture_idx) {
        //세션에 저장된 논문 제출 데이터 (step2에서 step1으로 되돌아올시)
        $submit_data = isset($_SESSION["lecture"]["data"]) ? $_SESSION["lecture"]["data"] : "";
        //$co_submit_data1 = isset($_SESSION["lecture"]["co_data1"]) ? $_SESSION["lecture"]["co_data1"] : "";
        //$co_submit_data2 = isset($_SESSION["lecture"]["co_data2"]) ? $_SESSION["lecture"]["co_data2"] : "";

        $data_count = count($_SESSION["lecture"]);
    } else {
        //마이페이지 > abstract 수정 시 idx가 있을때 해당 idx에 해당하는 정보 select
        $select_lecture_detail_query =  "
												SELECT
													nation_no, city, state, first_name, last_name, affiliation, email, phone,
													SUBSTR(REPLACE(phone, SUBSTRING_INDEX(phone, '-', 1), ''), 2) AS phone,
													SUBSTRING_INDEX(phone, '-', 1) AS nation_tel
													
												FROM request_abstract
												WHERE is_deleted = 'N'
												AND idx = {$lecture_idx}
												#OR parent_author = {$lecture_idx}
											";

        $lecture_detail = sql_fetch($select_lecture_detail_query);

        $data_count = count($lecture_detail);

        $submit_data = $lecture_detail;

        //for($i=0; $i<$data_count; $i++) {
        //	if($i == 0) {
        //		$submit_data = $lecture_detail[$i];
        //	} 
        //	else {
        //		${"co_submit_data".$i} = $lecture_detail[$i];
        //		foreach(${"co_submit_data".$i} as $key => $value) {
        //			unset(${"co_submit_data".$i}[$key]);

        //			${"co_submit_data".$i}["co_".$key.$i] = $value;
        //		}
        //	}
        //}
    }

    //업데이트 시 SESSION이 있으면 세션 우선 출력
    $submit_data = isset($_SESSION["lecture"]["data"]) ? $_SESSION["lecture"]["data"] : $submit_data;

    //초기 작성 시 연락처 쪼깨기
    if ($submit_data == "") {
        $_arr_phone = explode("-", $user_info["phone"]);
        $nation_tel = $_arr_phone[0];
        $phone = implode("-", array_splice($_arr_phone, 1));
    }

    //데이터(초기 세팅 및 이전으로 돌아왔을때 입력값 세팅)
    $nation_no = !empty($submit_data) ? $submit_data["nation_no"] : $user_info["nation_no"];
    $city = !empty($submit_data) ? $submit_data["city"] : "";
    $state = !empty($submit_data) ? $submit_data["state"] : "";
    $first_name = !empty($submit_data) ? $submit_data["first_name"] : $user_info["first_name"];
    $last_name = !empty($submit_data) ? $submit_data["last_name"] : $user_info["last_name"];
    $affiliation = !empty($submit_data) ? $submit_data["affiliation"] : $user_info["affiliation"];
    $email = !empty($submit_data) ? $submit_data["email"] : $user_info["email"];
    $nation_tel = !empty($submit_data) ? $submit_data["nation_tel"] : $nation_tel;
    $phone = !empty($submit_data) ? $submit_data["phone"] : $phone;

    //for($i=1; $i<$data_count; $i++) {
    //	${"co_nation_no".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_nation_no".$i] : "";
    //	${"co_city".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_city".$i] : "";
    //	${"co_state".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_state".$i] : "";
    //	${"co_first_name".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_first_name".$i] : "";
    //	${"co_last_name".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_last_name".$i] : "";
    //	${"co_affiliation".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_affiliation".$i] : "";
    //	${"co_email".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_email".$i] : "";
    //	${"co_nation_tel".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_nation_tel".$i] : "";
    //	${"co_phone".$i} = !empty(${"co_submit_data".$i}) ? ${"co_submit_data".$i}["co_phone".$i] : "";
    //}

    //국가 정보 append를 위해 js변수로 변환
    if (!empty($nation_list)) {
        echo "<script> var nation = []; ";
        foreach ($nation_list as $list) {
            $idx = $list["idx"];
            $nation_ko = $list["nation_ko"];
            $nation_en = $list["nation_en"];

            echo "nation.push({idx : {$idx}, nation_ko : '{$nation_ko}', nation_en : '{$nation_en}'});";
        }
    }
    echo "</script>";

    //제출타입 지정
    echo "<script>var type = 'lecture'</script>";
?>

<section class="submit_application container">
    <div class="">
        <div class="sub_banner">
            <h1>Lecture Note Submission</h1>
        </div>
        <ul class="tab_green">
            <li><a href="./lecture_note_submission.php">Lecture Note Submission Guideline</a></li>
            <li class="on"><a href="javascript:;">Online Submission</a></li>
            <!-- <li><a href="./oral_presenters.php"><?= $locale("lecture_menu3") ?></a></li> -->
            <!-- <li><a href="./eposter_presenters.php"><?= $locale("lecture_menu4") ?></a></li> -->
        </ul>
        <div class="">
            <div class="steps_area">
                <ul class="clearfix">
                    <li class="on">
                        <p>Step 1</p>
                        <p class="sm_txt"><?= $locale("lecture_submit_tit1") ?></p>
                    </li>
                    <li>
                        <p>Step 2</p>
                        <p class="sm_txt"><?= $locale("lecture_submit_tit2") ?></p>
                    </li>
                    <li>
                        <p>Step 3</p>
                        <p class="sm_txt"><?= $locale("submit_completed_tit") ?></p>
                    </li>
                </ul>
            </div>
            <div class="input_area">
                <form name="lecture_form">
                    <ul class="basic_ul">
                        <li>
                            <p class="label"><?= $locale("country") ?> *</p>
                            <div>
                                <select class="required3" name="nation_no">
                                    <option value="" selected hidden>Choose </option>
                                    <?php
                                        foreach ($nation_list as $list) {
                                            $nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
                                            if ($nation_no == $list["idx"]) {
                                                echo "<option value='" . $list["idx"] . "' selected>" . $nation . "</option>";
                                            } else {
                                                echo "<option value='" . $list["idx"] . "'>" . $nation . "</option>";
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <p class="label"><?= $locale("city") ?></p>
                            <div>
                                <input type="text" name="city" value="<?= $city ?>" maxlength="100">
                            </div>
                        </li>
                        <li>
                            <p class="label"><?= $locale("state") ?> </p>
                            <div>
                                <input type="text" name="state" value="<?= $state ?>" maxlength="100">
                            </div>
                        </li>
                        <li>
                            <p class="label"><?= $locale("name") ?> *</p>
                            <div class="name_div">
                                <input class="required3" type="text" name="first_name" value="<?= $first_name ?>"
                                    maxlength="50">
                                <input class="required3" type="text" name="last_name" value="<?= $last_name ?>"
                                    maxlength="50">
                            </div>
                        </li>
                        <li>
                            <p class="label"><?= $locale("affiliation") ?> *</p>
                            <div>
                                <input class="required3" type="text" name="affiliation" value="<?= $affiliation ?>"
                                    maxlength="100">
                            </div>
                        </li>
                        <li>
                            <p class="label"><?= $locale("email") ?> *</p>
                            <div>
                                <input class="required3" type="text" name="email" value="<?= $email ?>" maxlength="100">
                            </div>
                        </li>
                        <li>
                            <p class="label"><?= $locale("phone") ?> *</p>
                            <div>
                                <div class="phone_div clearfix2">
                                    <select class="required3" name="nation_tel">
                                        <option value="<?= $nation_tel ?>" selected><?= $nation_tel ?></option>
                                    </select>
                                    <input class="required3" type="text" placeholder="010-0000-0000" name="phone"
                                        value="<?= $phone ?>"></td>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="btn_wrap rightT">
                        <button type="button" class="btn online_btn green_btn"
                            <?= $lecture_idx ? "data-idx='" . $lecture_idx . "'" : "" ?>>Next<span>></span></button>
                        <!-- <button type="button" class="btn form_btn next_btn"><?= $locale("next_btn") ?></button> -->
                    </div>
                </form>
            </div>

            <!--
			<div class="input_area">
				<form name="lecture_form">
					<div class="table_wrap c_table_wrap input_table">
						<table class="c_table">
							<tr>
								<th><?= $locale("country") ?> *</th>
								<td>
									<select class="required3" name="nation_no"> 
										<option value="" selected hidden>Choose </option>
									<?php
                                    foreach ($nation_list as $list) {
                                        $nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
                                        if ($nation_no == $list["idx"]) {
                                            echo "<option value='" . $list["idx"] . "' selected>" . $nation . "</option>";
                                        } else {
                                            echo "<option value='" . $list["idx"] . "'>" . $nation . "</option>";
                                        }
                                    }
                                    ?>
									</select>
								</td>
							</tr>
							<tr>
								<th><?= $locale("city") ?> *</th>
								<td><input class="required3" type="text" name="city" value="<?= $city ?>" maxlength="100"></td>
							</tr>
							<tr>
								<th><?= $locale("state") ?></th>
								<td><input type="text" name="state" value="<?= $state ?>" maxlength="100"></td>
							</tr>
							<tr>
								<th><?= $locale("first_name") ?> *</th>
								<td><input class="required3" type="text" name="first_name" value="<?= $first_name ?>" maxlength="50"></td>
							</tr>
							<tr>
								<th><?= $locale("last_name") ?> *</th>
								<td><input class="required3" type="text" name="last_name" value="<?= $last_name ?>" maxlength="50"></td>
							</tr>
							<tr>
								<th><?= $locale("affiliation") ?> *</th>
								<td><input class="required3" type="text" name="affiliation" value="<?= $affiliation ?>" maxlength="100"></td>
							</tr>
							<tr>
								<th><?= $locale("email") ?> *</th>
								<td><input class="required3" type="text" name="email" value="<?= $email ?>" maxlength="100"></td>
							</tr>
							<tr>
								<th><?= $locale("phone") ?> *</th>
								<td>
									<div class="clearfix">
										<select class="required3" name="nation_tel"> 
											<option value="<?= $nation_tel ?>" selected><?= $nation_tel ?></option>
										</select>
										<input class="required3" type="text" placeholder="010-0000-0000" name="phone" value="<?= $phone ?>"></td>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</form>
					<div class="clearfix2 coauther_wrap" style="display:none;">
						<p><?= $locale("check_co_author2") ?></p>
						
							기존 radio로 co-author를 추가했지만, 추가 버튼으로 입력값 append형태로 변경
						<div class="radio_wrap">
							<ul class="flex">
								<li>
									<input type="radio" class="radio" id="co_yes" name="yn"><label for="co_yes">Yes</label>
								</li>
								<li>
									<input type="radio" class="radio" id="co_no" name="yn" checked><label for="co_no">No</label>
								</li>
							</ul>
						</div>-->
            <!--<div>
							<select class="number_of_author">
								<option vlaue="0" <?= $data_count == "0" ? "selected" : "" ?>>Select</option>
								<option value="1" <?= ($data_count - 1) == "1" ? "selected" : "" ?>>1</option>
								<option value="2" <?= ($data_count - 1) == "2" ? "selected" : "" ?>>2</option>
							</select>
						</div>
					</div>

					<!--coauthor append-->
            <!--<div class="co_author_appended">
					<?php
                    //이전 버튼 누를시 데이터 세팅
                    if ($co_submit_data1 != "") {
                        for ($i = 1; $i < $data_count; $i++) {
                            echo  '<form name="co_lecture_form' . $i . '">';
                            echo      '<div class="table_wrap c_table_wrap input_table">';
                            echo        '<table class="c_table">';
                            echo            '<tr>';
                            echo                '<th>' . $locale("country") . ' *</th>';
                            echo                '<td>';
                            echo                    '<select class="required3 co_nation" name="co_nation_no' . $i . '" data-count=' . $i . '> ';
                            echo                        '<option value="" selected hidden>Choose </option>';
                            foreach ($nation_list as $list) {
                                $nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
                                $selected = ${'co_nation_no' . $i} == $list["idx"] ? "selected" : "";
                                echo                     '<option value="' . $list["idx"] . '"' . $selected . '>' . $nation . '</option>';
                            }
                            echo                    '</select>';
                            echo                '</td>';
                            echo            '</tr>';
                            echo            '<tr>';
                            echo                '<th>' . $locale("city") . ' *</th>';
                            echo                '<td><input class="required3" type="text" name="co_city' . $i . '" value="' . ${"co_city" . $i} . '" maxlength="100"></td>';
                            echo            '</tr>';
                            echo            '<tr>';
                            echo                '<th>' . $locale("state") . '</th>';
                            echo                '<td><input type="text" name="co_state' . $i . '" value="' . ${"co_state" . $i} . '" maxlength="100"></td>';
                            echo            '</tr>';
                            echo            '<tr>';
                            echo                '<th>' . $locale("first_name") . ' *</th>';
                            echo                '<td><input class="required3" type="text" name="co_first_name' . $i . '" value="' . ${"co_first_name" . $i} . '" maxlength="50"></td>';
                            echo            '</tr>';
                            echo            '<tr>';
                            echo                '<th>' . $locale("last_name") . ' *</th>';
                            echo                '<td><input class="required3" type="text" name="co_last_name' . $i . '" value="' . ${"co_last_name" . $i} . '" maxlength="50"></td>';
                            echo            '</tr>';
                            echo            '<tr>';
                            echo                '<th>' . $locale("affiliation") . ' *</th>';
                            echo                '<td><input class="required3" type="text" name="co_affiliation' . $i . '" value="' . ${"co_affiliation" . $i} . '" maxlength="100"></td>';
                            echo            '</tr>';
                            echo            '<tr>';
                            echo                '<th>' . $locale("email") . ' *</th>';
                            echo                '<td><input class="required3" type="text" name="co_email' . $i . '" value="' . ${"co_email" . $i} . '" maxlength="100"></td>';
                            echo            '</tr>';
                            echo            '<tr>';
                            echo                '<th>' . $locale("phone") . ' *</th>';
                            echo                '<td>';
                            echo                    '<div class="clearfix">';
                            echo                        '<select class="required3" name="co_nation_tel' . $i . '"> ';
                            echo                            '<option value="' . ${"co_nation_tel" . $i} . '" selected>' . ${"co_nation_tel" . $i} . '</option>';
                            echo                        '</select>';
                            echo                        '<input class="required3" type="text" placeholder="010-0000-0000" name="co_phone' . $i . '" value="' . ${"co_phone" . $i} . '"></td>';
                            echo                    '</div>';
                            echo                '</td>';
                            echo            '</tr>';
                            echo        '</table>';
                            echo     '</div>';
                            echo '</form>';
                        }
                    }
                    ?>
					</div>
				
				<div class="btn_wrap">
					<button type="button" class="btn submit_btn" <?= $lecture_idx ? "data-idx='" . $lecture_idx . "'" : "" ?>>Next</button>
				</div>
			</div>
			-->
        </div>
        <!--//section1-->

    </div>
</section>
<script src="./js/script/client/submission.js"></script>
<script>
$(document).ready(function() {
    //	$(".green_btn").on("click", function(){
    $(document).on("click", ".green_btn", function() {
        var idx = $(this).data("idx");
        var data = {};

        var formData = $("form[name=lecture_form]").serializeArray();
        //var co_count = $(".number_of_author").val();

        var process = inputCheck(formData);
        var status = process.status;
        data["main_data"] = process.data;

        //if(co_count == "1") {
        //	var co_formData1 = $("form[name=co_lecture_form1]").serializeArray();
        //} else if(co_count == "2") {
        //	var co_formData1 = $("form[name=co_lecture_form1]").serializeArray();
        //	var co_formData2 = $("form[name=co_lecture_form2]").serializeArray();
        //}

        //if(!status) return false; //주저자 데이터 유효성 검증 후 실패 시 return false;

        //if(co_formData1) {
        //	var co_process1 = inputCheck(co_formData1);
        //	status = co_process1.status;
        //	data["co_data1"] = co_process1.data;
        //}

        //if(!status) return false; //공동저자 데이터 유효성 검증 후 실패 시 return false;

        //if(co_formData2) {
        //	var co_process2 = inputCheck(co_formData2);
        //	status = co_process2.status;
        //	data["co_data2"] = co_process2.data;
        //}

        if (status) {
            $.ajax({
                url: PATH + "ajax/client/ajax_submission.php",
                type: "POST",
                data: {
                    flag: "submission_step1",
                    type: type,
                    data: data
                },
                dataType: "JSON",
                success: function(res) {
                    if (res.code == 200) {
                        $(window).off("beforeunload");
                        if (idx) {
                            window.location.href = "./lecture_submission2.php?idx=" + idx;
                        } else {
                            window.location.href = "./lecture_submission2.php"
                        }
                    } else if (res.code == 400) {
                        alert("Please try again.");
                        return false;
                    } else {
                        alert(locale(language.value)("reject_msg"));
                        return false;
                    }
                }
            });
        }
    });

    //연락처 숫자만
    $(document).on("keyup", "input[name*=phone]", function() {
        $(this).val($(this).val().replace(/[^0-9|-]/gi, ""));
    });

    //co-author select on change event
    $('.number_of_author').on('change', function() {
        var num = parseInt($(this).val()) + 1;

        var html = '';

        $('.co_author_appended').empty();
        for (var i = 1; i < num; i++) {
            html = '<form name="co_lecture_form' + i + '">'
            html += '<div class="table_wrap c_table_wrap input_table">';
            html += '<table class="c_table">';
            html += '<tr>';
            html += '<th><?= $locale("country") ?> *</th>';
            html += '<td>';
            html += '<select class="required3 co_nation" name="co_nation_no' + i + '" data-count=' + i +
                '> ';
            html += '<option value="" selected hidden>Choose </option>';
            for (j = 0; j < nation.length; j++) {
                var nation_name = language.value == "en" ? nation[j].nation_en : nation[j].nation_ko;
                html += '<option value="' + nation[j].idx + '">' + nation_name + '</option>';
            }
            html += '</select>';
            html += '</td>';
            html += '</tr>';
            html += '<tr>';
            html += '<th><?= $locale("city") ?> *</th>';
            html += '<td><input class="required3" type="text" name="co_city' + i +
                '" value="" maxlength="100"></td>';
            html += '</tr>';
            html += '<tr>';
            html += '<th><?= $locale("state") ?></th>';
            html += '<td><input type="text" name="co_state' + i + '" value="" maxlength="100"></td>';
            html += '</tr>';
            html += '<tr>';
            html += '<th><?= $locale("first_name") ?> *</th>';
            html += '<td><input class="required3" type="text" name="co_first_name' + i +
                '" value="" maxlength="50"></td>';
            html += '</tr>';
            html += '<tr>';
            html += '<th><?= $locale("last_name") ?> *</th>';
            html += '<td><input class="required3" type="text" name="co_last_name' + i +
                '" value="" maxlength="50"></td>';
            html += '</tr>';
            html += '<tr>';
            html += '<th><?= $locale("affiliation") ?> *</th>';
            html += '<td><input class="required3" type="text" name="co_affiliation' + i +
                '" value="" maxlength="100"></td>';
            html += '</tr>';
            html += '<tr>';
            html += '<th><?= $locale("email") ?> *</th>';
            html += '<td><input class="required3" type="text" name="co_email' + i +
                '" value="" maxlength="100"></td>';
            html += '</tr>';
            html += '<tr>';
            html += '<th><?= $locale("phone") ?> *</th>';
            html += '<td>';
            html += '<div class="clearfix">';
            html += '<select class="required3" name="co_nation_tel' + i + '"> ';
            html += '<option value="" selected>select</option>';
            html += '<option value="1">TEST</option>'
            html += '</select>';
            html += '<input class="required3" type="text" placeholder="010-0000-0000" name="co_phone' +
                i + '" value=""></td>';
            html += '</div>';
            html += '</td>';
            html += '</tr>';
            html += '</table>';
            html += '</div>';
            html == '</form>';

            $('.co_author_appended').append(html);
        }
    });
});


$("input[name=city]").on("change keyup", function(key) {
    var pattern_eng = /[^a-zA-Z\s]/gi;
    var _this = $(this);
    if (key.keyCode != 8) {
        var first_name = _this.val().replace(pattern_eng, '');
        _this.val(first_name);
    }
});
$("input[name=state]").on("change keyup", function(key) {
    var pattern_eng = /[^a-zA-Z\s]/gi;
    var _this = $(this);
    if (key.keyCode != 8) {
        var first_name = _this.val().replace(pattern_eng, '');
        _this.val(first_name);
    }
});
$("input[name=first_name]").on("change keyup", function(key) {
    var pattern_eng = /[^a-zA-Z\s]/gi;
    var _this = $(this);
    if (key.keyCode != 8) {
        var first_name = _this.val().replace(pattern_eng, '');
        _this.val(first_name);
    }
});
$("input[name=last_name]").on("change keyup", function(key) {
    var pattern_eng = /[^a-zA-Z\s]/gi;
    var _this = $(this);
    if (key.keyCode != 8) {
        var first_name = _this.val().replace(pattern_eng, '');
        _this.val(first_name);
    }
});
$("input[name=affiliation]").on("change keyup", function(key) {
    var pattern_eng = /[^a-zA-Z\s]/gi;
    var _this = $(this);
    if (key.keyCode != 8) {
        var first_name = _this.val().replace(pattern_eng, '');
        _this.val(first_name);
    }
});
$("input[name=email]").on("change", function(key) {
    var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    var _this = $(this).val();
    if (_this.match(regExp) == null) {
        $(this).val('');
        alert("check_email");
        return;
    }
});
//핸드폰 유효성
$(document).on('change keyup', "input[name=phone]", function(key) {
    var _this = $(this);
    if (key.keyCode != 8) {
        var phone = _this.val().replace(/[^0-9||-]/gi, '');
        _this.val(phone);
    }
});

function inputCheck(formData) {
    var data = {};
    var length_100 = ["affiliation", "email", "co_afflilation1", "co_email1", "co_afflilation2", "co_email2"]
    var length_50 = ["first_name", "last_name", "co_first_name1", "co_last_name1", "co_first_name2", "co_last_name2"];

    var inputCheck = true;

    // if(type == "my") {
    $.each(formData, function(key, value) {
        var ok = value["name"];
        var ov = value["value"];

        if (ov == "" || ov == null || ov == "undefinded") {
            if (ok == "nation_no") {
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
            } else if (ok == "nation_tel") {
                alert(locale(language.value)("check_phone"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "phone") {
                alert(locale(language.value)("check_phone"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_nation_no1" || ok == "co_nation_no2") {
                alert(locale(language.value)("check_co_nation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_city1" || ok == "co_city2") {
                alert(locale(language.value)("check_co_city"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_first_name1" || ok == "co_first_name2") {
                alert(locale(language.value)("check_co_first_name"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_last_name1" || ok == "co_last_name2") {
                alert(locale(language.value)("check_co_last_name"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_affiliation1" || ok == "co_affiliation2") {
                alert(locale(language.value)("check_co_affiliation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_email1" || ok == "co_email2") {
                alert(locale(language.value)("check_co_email"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_nation_tel1" || ok == "co_nation_tel2") {
                alert(locale(language.value)("check_co_last_name"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_phone1" || ok == "co_phone2") {
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

    return {
        data: data,
        status: inputCheck
    }
}
</script>
<?php
}
include_once('./include/footer.php');
?>