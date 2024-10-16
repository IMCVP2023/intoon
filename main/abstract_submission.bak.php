<?php
include_once('./include/head.php');
include_once('./include/header.php');

//$_SESSION["abstract"] = "";

//업데이트 시 초록 인덱스
$abstract_idx = $_GET["idx"];
//

if ($during_yn === "Y" && empty($abstract_idx)) {
?>

<section class="submit_application abstract_online_submission container">
    <h1 class="page_title">Online Submission </h1>
    <div class="inner">
        <!-- <div class="sub_banner">
            <h5>Call for Abstracts</h5>
            <h1>Abstract Submission</h1>
        </div> -->
        <div class="tab_area">
            <!-- <ul class="clearfix">
                <li><a href="./poster_abstract_submission.php" class="btn"><?= $locale("abstract_menu1") ?></a></li>
                <li><a href="javascript:;" class="btn active"><?= $locale("abstract_menu2") ?></a></li>
                <li><a href="./eposter.php" class="btn"><?= $locale("abstract_menu3") ?></a></li>
            </ul> -->
        </div>
        <!-- <ul class="tab_green long">
                <li><a href="./abstract_submission_guideline.php">Abstract Submission Guideline</a></li>
                <li class="on"><a href="./abstract_submission.php">Online Submission</a></li>
                <li><a href="./abstract_submission_oral.php">Oral Presenters</a></li>
                <li><a href="./abstract_submission_exhibition.php">Poster Exhibition</a></li>
                <li><a href="./abstract_submission_award.php">Awards & Grants</a></li>
            </ul> -->
        <div class="container">
            <img class="coming" src="./img/coming.png" />
        </div>

    </div>
</section>
<?php
} else {

    //로그인 유무 확인 
    if (empty($_SESSION["USER"])) {
        echo "<script>alert(locale(language.value)('need_login')); location.href=PATH+'login.php';</script>";
        exit;
    } else {
        //로그인 회원 정보
        $user_info = $member;
    }
	
	//var_dump($user_info); exit;

    // 사전 등록이 된 유저인지 확인
    $registration_idx = check_registration($user_info["idx"]);
    if (!$registration_idx) {
        echo "<script>alert(locale(language.value)('check_registration')); location.href=PATH+'registration_guidelines.php'</script>";
        exit;
    }

    /* 제출 유무 확인 주석 (중복제출가능)
		if(!$abstract_idx) {
			//제출 유무 확인
			$check_submission = check_submission($user_info["idx"], "abstract");
		
			if($check_submission) {
				echo "<script>alert(locale(language.value)('already_submission')); location.href=PATH+'mypage_abstract.php'</script>";
				exit;
			}
		}
		*/

    //국가정보 가져오기
    $nation_query = "SELECT
							*
						FROM nation
						ORDER BY 
						idx = 25 DESC, nation_en ASC";
    //$nation_list_query = $_nation_query;
    $nation_list_query = $nation_query;
    $nation_list = get_data($nation_list_query);

    //카테고리 정보 가져오기
    $category_list = get_data($_abstract_category_query);

    // -------------------------------------------------------------- Abstrcat Update -------------------------------------------------------------- //
    if ($abstract_idx) {

        $abstract_sql = "
							SELECT
								ra.idx, ra.nation_no,ra.last_name, ra.first_name, ra.city, ra.state, ra.affiliation, 
								ra.email, ra.phone, ra.position, ra.position_other AS other_position, ra.abstract_category, title_en
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

        //echo $abstract_sql." AND ra.idx = {$abstract_idx} AND ra.parent_author IS NULL ORDER BY ra.register_date DESC LIMIT 1";
        //exit;

        $authors = sql_fetch($abstract_sql . " AND ra.idx = {$abstract_idx} AND ra.parent_author IS NULL ORDER BY ra.register_date DESC LIMIT 1");
		
		
        if ($authors["idx"] == "") {
            echo "<script>alert('Invalid abstract data'); history.back();</script>";
            exit;
        }

        $submit_data = isset($_SESSION["abstract"]["data"]) ? $_SESSION["abstract"]["data"] : "";
        foreach ($authors as $k => $v) {

            $user_info[$k] = $v;
            //if($k == "affiliation") {
            //	$user_info["affiliation"] = !empty($_SESSION["abstract"]) ? $submit_data['affiliation'] : json_decode($v);
            //	$user_info["affiliation_value"] = !empty($_SESSION["abstract"]) ? $submit_data['affiliation'] : implode(json_decode($v), ","); 
            //}

        }

        /*
			$co_authors = sql_fetch($abstract_sql." AND ra.parent_author = {$abstract_idx} AND ra.city IS NOT NULL ORDER BY ra.idx ASC");
			*/

        //echo $abstract_sql."  AND ra.idx = {$abstract_idx}+1 ORDER BY ra.idx ASC";
        //exit;

        $co_authors = sql_fetch($abstract_sql . "  AND ra.idx = {$abstract_idx}+1 ORDER BY ra.idx ASC");

        //print_r($co_authors);

        foreach ($co_authors as $k => $v) {
            $user_info["co_" . $k] = $v;

            //if($k == "affiliation") {
            //	$user_info["co_affiliation"] = json_decode($v);
            //	$user_info["co_affiliation_value"] = implode(json_decode($v), ","); 
            //}

            if ($k == "phone") {
                $_arr_phone = explode("-", $v);
                $co_nation_tel = $_arr_phone[0];
                $co_phone = implode("-", array_splice($_arr_phone, 1));

                $user_info["co_nation_tel"] = $co_nation_tel;
                $user_info["co_phone"] = $co_phone;
            }
        }


        //echo $abstract_sql." AND ra.parent_author = {$abstract_idx} AND ra.idx <> {$abstract_idx} ORDER BY ra.idx ASC";
        //exit;

        $add_co_authors = get_data($abstract_sql . " AND ra.parent_author = {$abstract_idx} AND ra.idx <> {$abstract_idx}+1 ORDER BY ra.idx ASC");

        $no = 0;
        $collect_key = ["first_name", "last_name", "affiliation", "email", "nation_no", "city", "state", "position", "phone", "other_position", "idx"];
        foreach ($add_co_authors as $ca) {
            foreach ($ca as $k => $v) {
                if (in_array($k, $collect_key)) {
                    $coauthor_submit_data[$no]["add_co_" . $k . $no] = $v;

                    //if($k == "affiliation") {
                    //	$coauthor_submit_data[$no]["add_co_".$k.$no] = ($v); 
                    //	$coauthor_submit_data[$no]["add_co_".$k."_value".$no] = ($v);
                    //}
                }
            }

            $no = $no + 1;
        }

        $count_idx_query =  "
									SELECT
										idx
									FROM request_abstract
									WHERE idx = {$abstract_idx}
									OR parent_author = {$abstract_idx}
									AND is_deleted = 'N'
								";


        $count = get_data($count_idx_query);
    }
    // -------------------------------------------------------------- Abstrcat Update -------------------------------------------------------------- //

    //세션에 저장된 논문 제출 데이터 (step2에서 step1으로 되돌아올시)
    $submit_data = isset($_SESSION["abstract"]["data"]) ? $_SESSION["abstract"]["data"] : "";
    $co_submit_data1 = isset($_SESSION["abstract"]["co_data1"]) ? $_SESSION["abstract"]["co_data1"] : "";
    $data_count = $abstract_idx ? count($count) : count($_SESSION["abstract"]);


    //co_author데이터 for문(INTO-ON)
    for ($i = 0; $i < ($data_count - 2); $i++) {
        $coauthor_submit_data[$i] = isset($_SESSION["abstract"]["coauthor_data" . $i]) ? $_SESSION["abstract"]["coauthor_data" . $i] : $coauthor_submit_data[$i];
    }


    //초기 작성 시 연락처 쪼깨기
    if ($submit_data == "") {
        $_arr_phone = explode("-", $user_info["phone"]);
        $nation_tel = $_arr_phone[0];
        $phone = implode("-", array_splice($_arr_phone, 1));
    }

    //데이터(초기 세팅 및 이전으로 돌아왔을때 입력값 세팅)
    $abstract_category = !empty($submit_data) ? $submit_data["abstract_category"] : $user_info["abstract_category"];
    $nation_no = !empty($submit_data) ? $submit_data["nation_no"] : $user_info["nation_no"];
    $city = !empty($submit_data) ? $submit_data["city"] : $user_info["city"];
    $state = !empty($submit_data) ? $submit_data["state"] : $user_info["state"];
    $first_name = !empty($submit_data) ? $submit_data["first_name"] : $user_info["first_name"];
    $last_name = !empty($submit_data) ? $submit_data["last_name"] : $user_info["last_name"];

    $affiliation_value = array();
    $coauthor_nation_tel = array();

    //echo $user_info["affiliation"];
    //exit;

    if ($abstract_idx) {
        $affiliation = !empty($user_info["affiliation"]) ? $user_info["affiliation"] : "";
    } else {
        $submit_data_affiliation = $submit_data["affiliation"];

        $user_info_affiliation_exist = $user_info["affiliation"] != "";
        $user_info_department_exist = $user_info["department"] != "";
        $user_info_affiliation = "";
        if ($user_info_affiliation_exist && $user_info_affiliation_exist) {
            $user_info_affiliation = $user_info["department"] . ", " . $user_info["affiliation"];
        } else if ($user_info_affiliation_exist && !$user_info_affiliation_exist) {
            $user_info_affiliation = $user_info["affiliation"];
        } else if (!$user_info_affiliation_exist && $user_info_affiliation_exist) {
            $user_info_affiliation = $user_info["department"];
        }

        $affiliation = !empty($submit_data) ? $submit_data_affiliation : $user_info_affiliation;
        $affiliation_value = $affiliation;
    }


    $position = !empty($submit_data) ? $submit_data["position"] : $user_info["position"];
    $other_position = !empty($submit_data) ? $submit_data["other_position"] : $user_info["other_position"];
    $email = !empty($submit_data) ? $submit_data["email"] : $user_info["email"];
    $nation_tel = !empty($submit_data) ? $submit_data["nation_tel"] : $nation_tel;
    $phone = !empty($submit_data) ? $submit_data["phone"] : $phone;

    $co_idx = !empty($co_submit_data1) ? $co_submit_data1["co_idx"] : $user_info["co_idx"];
    $co_nation_no = !empty($co_submit_data1) ? $co_submit_data1["co_nation_no"] : $user_info["co_nation_no"];
    $co_city = !empty($co_submit_data1) ? $co_submit_data1["co_city"] : $user_info["co_city"];
    $co_state = !empty($co_submit_data1) ? $co_submit_data1["co_state"] : $user_info["co_state"];
    $co_first_name = !empty($co_submit_data1) ? $co_submit_data1["co_first_name"] : $user_info["co_first_name"];
    $co_last_name = !empty($co_submit_data1) ? $co_submit_data1["co_last_name"] : $user_info["co_last_name"];
    $co_affiliation = !empty($co_submit_data1) ? $co_submit_data1["co_affiliation"] : $user_info["co_affiliation"];
    //$co_affiliation_value = !empty($submit_data) ? $submit_data["co_affiliation"] : $user_info["co_affiliation_value"];
    $co_position = !empty($co_submit_data1) ? $co_submit_data1["co_position"] : $user_info["co_position"];
    $co_other_position = !empty($co_submit_data1) ? $co_submit_data1["co_other_position"] : $user_info["co_other_position"];
    $co_email = !empty($co_submit_data1) ? $co_submit_data1["co_email"] : $user_info["co_email"];
    $co_nation_tel = !empty($co_submit_data1) ? $co_submit_data1["co_nation_tel1"] : $user_info["co_nation_tel"];
    $co_phone = !empty($co_submit_data1) ? $co_submit_data1["co_phone"] : $user_info["co_phone"];

    //co_author데이터 for문(INTO-ON)

    for ($i = 0; $i < (($data_count) - 1); $i++) {
        //coauthor
        $coauthor_idx[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_idx" . $i] : "";
        $coauthor_first_name[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_first_name" . $i] : "";
        $coauthor_last_name[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_last_name" . $i] : "";
        $coauthor_email[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_email" . $i] : "";
        $coauthor_affiliation[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_affiliation" . $i] : "";
        //$coauthor_affiliation_value[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_affiliation".$i] : "";
        $coauthor_state[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_state" . $i] : "";
        $coauthor_city[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_city" . $i] : "";
        $coauthor_phone[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_phone" . $i] : "";
        $coauthor_nation_no[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_nation_no" . $i] : "";
        $coauthor_position[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_position" . $i] : "";
        $coauthor_other_position[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_other_position" . $i] : "";
        $coauthor_nation_tel[$i] = !empty($coauthor_submit_data[$i]) ? $coauthor_submit_data[$i]["add_co_nation_tel" . $i] : "";

        //if($coauthor_submit_data != "") {
        if (empty($_SESSION["abstract"])) {
            //초기 작성 시 연락처 쪼깨기
            $arr_coauthor_phone = explode("-", $coauthor_phone[$i]);
            $coauthor_nation_tel[$i] = $arr_coauthor_phone[0];
            $coauthor_phone[$i] = implode("-", array_splice($arr_coauthor_phone, 1));
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
<section class="submit_application abstract_online_submission container">
    <h1 class="page_title">Online Submission</h1>
    <div class="inner">
        <!-- <ul class="tab_green long">
            <li><a href="./abstract_submission_guideline.php">Abstract Submission Guideline</a></li>
            <li class="on"><a href="./abstract_submission.php">Online Submission</a></li>
            <li><a href="./abstract_submission_oral.php">Oral Presenters</a></li>
            <li><a href="./abstract_submission_exhibition.php">Poster Exhibition</a></li>
            <li><a href="./abstract_submission_award.php">Awards & Grants</a></li>
        </ul> -->
        <div>
            <div class="steps_area">
                <ul class="clearfix">
                    <li class="on">
                        <p>Step 1</p>
						<!-- <p></p> -->
						<p class="sm_txt">Fill out author’s information</p>
                        <!-- <p class="sm_txt"><?= $locale("abstract_online_tit1") ?></p> -->
                    </li>
                    <li>
                        <p>Step 2</p>
                        <p class="sm_txt">Enter the abstract section, including the type of presentation, topic categories, and title.</p>
                        <!-- <p class="sm_txt"><?= $locale("abstract_submit_tit2") ?></p> -->
                    </li>
                    <li>
                        <p>Step 3</p>
                        <p class="sm_txt">Complete and confirm submission.</p>
                        <!-- <p class="sm_txt"><?= $locale("submit_completed_tit") ?></p> -->
                    </li>
                </ul>
            </div>
            <div class="input_area">
                <form name="abstract_form" class="abstract_form">
                    <!-- <div>
                        <div class="section_title_wrap2">
                            <h3 class="title"><?= $locale("abstract_status_tit") ?></h3>
                        </div>
                        <ul class="basic_ul">
                            <li>
                                <p class="label"><?= $locale("categories") ?> <span class="red_txt">*</span></p>
                                <div>
                                    <select name="abstract_category" onchange="check_value()">
                                        <option value="" selected hidden>Choose</option>
                                        <?php
                                            $i = 1;
                                            foreach ($category_list as $list) {
                                                $selected = $abstract_category == $list["idx"] ? "selected" : "";
                                                echo "<option value='" . $list["idx"] . "'" . $selected . ">" . $i . ". " . $list["title_" . $language] . "</option>";
                                                $i++;
                                            }
                                            ?>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div> -->
                    <div>
                        <div class="section_title_wrap2">
                            <h3 class="title">
								Author Information
								<p class="mini_alert essential"><span class="red_txt">*</span> All requested field(<span class="red_txt">*</span>) should be completed.</p>
							</h3>
                            <!-- <h3 class="title"><?= $locale("presenting_authors") ?></h3> -->
                        </div>
                        <ul class="basic_ul">
							<li>
                                <p class="label author_num">Author #1</p>
                                <div>
									<ul class="author_chk_wrap">
										<li>
											<input type="checkbox" class="checkbox" id="author_chk1_1">
											<label for="author_chk1_1">
												<i></i>Same as sign-up information<span class="red_txt">*</span>
											</label>
										</li>
										<li>
											<input type="checkbox" class="checkbox" id="author_chk1_2">
											<label for="author_chk1_2">
												<i></i>Presenting Author<span class="red_txt">*</span>
											</label>
										</li>
										<li>
											<input type="checkbox" class="checkbox" id="author_chk1_3">
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
                                    <select class="required2 nation" name="nation_no" data-count="0"
                                        onchange="check_value()">
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
                            <!-- <li>
                                <p class="label"><?= $locale("city") ?> <span class="red_txt"></span></p>
                                <div>
                                    <input maxlength="60" class="required2 en_keyup" type="text" name="city"
                                        value="<?= $city ?>" onchange="check_value()">
                                </div>
                            </li> -->
                            <!-- <li>
                                <p class="label"><?= $locale("state") ?></p>
                                <div>
                                    <input maxlength="60" type="text" name="state" class="en_keyup"
                                        value="<?= $state ?>">
                                </div>
                            </li> -->
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
                                <p class="label"><?= $locale("affiliation") ?> <span class="red_txt">*</span></p>
                                <div>
                                    <div class="clearfix affiliation_input">
                                        <input maxlength="25" type="text" class="institution en_num_keyup"
                                            placeholder="Institution">
                                        <input maxlength="25" type="text" class="department en_num_keyup"
                                            placeholder="Department">
                                        <button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>
                                    </div>
                                    <div class="clearfix affiliation_form">
                                        <ul class="affiliation_wrap affiliation_wrap_01"
                                            style="<?= $affiliation != "" ? "display:block" : "" ?>">
                                            <?php
                                                if ($affiliation != "") {
                                                    if (!is_array($affiliation)) {
                                                        $affiliation_arr = explode("★", $affiliation);
                                                    } else {
                                                        $affiliation_arr = $affiliation;
                                                    }

                                                    for ($i = 0; $i <= count($affiliation_arr) - 1; $i++) {
                                                        echo '<li class="clearfix">';
                                                        echo    '<div class="clearfix">';
                                                        echo        '<p>' . $affiliation_arr[$i] . '</p>';
                                                        echo    '</div>';
                                                        echo    '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
                                                        echo '</li>';
                                                    }
                                                }
                                                ?>
                                            <!--
										<?php
                                        if ($affiliation != "") {
                                            if (!is_array($affiliation)) {
                                                $affiliation_arr = explode(",", $affiliation);
                                            } else {
                                                $affiliation_arr = $affiliation;
                                            }
                                            foreach ($affiliation_arr as $list) {
                                                echo '<li class="clearfix">';
                                                echo    '<p>' . $list . '</p>';
                                                echo    '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
                                                echo '</li>';
                                            }
                                        }
                                        ?>
										-->
                                        </ul>
                                        <?php
                                            if (count($affiliation_arr) - 1 <= 0) {
                                            ?>
                                        <!-- <button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button> -->
                                        <input type="hidden" name="affiliation" value="<?= $affiliation ?>"
                                            onchange="check_value()">
                                        <?php
                                            } else {
                                            ?>
                                        <!-- <button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button> -->
                                        <input type="hidden" name="affiliation" value="<?= $affiliation; ?>"
                                            onchange="check_value()">
                                        <?php
                                            }
                                            ?>

                                    </div>
                                </div>
                            </li>
                            <!-- <li>
                                <p class="label"><?= $locale("abstract_item_position") ?> <span class="red_txt">*</span>
                                </p>
                                <div class="pl60">
                                    <div class="radio_wrap clearfix">
                                        <ul class="clearfix">
                                            <li>
                                                <input onchange="check_value()" type="radio" checked
                                                    class="radio required2" id="position1" name="position" value="0"
                                                    <?= $position == "0" ? "checked" : "" ?>><label
                                                    for="position1">Professor</label>
                                            </li>
                                            <li>
                                                <input onchange="check_value()" type="radio" class="radio required2"
                                                    id="position2" name="position" value="1"
                                                    <?= $position == "1" ? "checked" : "" ?>><label
                                                    for="position2">Physician</label>
                                            </li>
                                            <li>
                                                <input onchange="check_value()" type="radio" class="radio required2"
                                                    id="position3" name="position" value="2"
                                                    <?= $position == "2" ? "checked" : "" ?>><label
                                                    for="position3">Researcher</label>
                                            </li>
                                            <li>
                                                <input onchange="check_value()" type="radio" class="radio required2"
                                                    id="position4" name="position" value="3"
                                                    <?= $position == "3" ? "checked" : "" ?>><label
                                                    for="position4">Student</label>
                                            </li>
                                            <li class="other_input_wrap">
                                                <input onchange="check_value()" type="radio"
                                                    class="radio required2 other_position_check" id="position5"
                                                    name="position" value="4"
                                                    <?= $position == "4" ? "checked" : "" ?>><label
                                                    for="position5">Others</label>
                                                <input onchange="check_value()" type="text"
                                                    class="other_input en_num_keyup other_position"
                                                    name="other_position" value="<?= $other_position ?>"
                                                    style="<?= $position == "4" ? "display:inline-block" : "" ?>">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li> -->
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
                                        <option value="<?= $nation_tel ?>" selected><?= $nation_tel ?></option>
                                    </select>
                                    <input maxlength="60" class="required2 phone" type="text"
                                        placeholder="010-0000-0000" name="phone" value="<?= $phone ?>"
                                        onchange="check_value()"></td>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                </form>
                <!-- <form name="co_abstract_form">
				                    <div class="section_title_wrap2">
				                        <h3 class="title"><?= $locale("corresponding_authors") ?></h3>
				                        <div style="margin-top:16px;">
				                            <input type="checkbox" class="checkbox" id="same_withs" onchange="same_add_author()"><label
				                                for="same_withs"><?= $locale("as_author") ?></label>
				                        </div>
				                    </div>
				                    <ul class="basic_ul">
						<li>
							<p class="label">Author #2</p>
							<div>
								<ul class="half_ul">
									<li>
										<input type="checkbox" class="checkbox" id="author_chk2_1">
										<label for="author_chk2_1">
											<i></i>Same as sign-up information<span class="red_txt">*</span>
										</label>
									</li>
									<li>
										<input type="checkbox" class="checkbox" id="author_chk2_2">
										<label for="author_chk2_2">
											<i></i>Presenting Author<span class="red_txt">*</span>
										</label>
									</li>
									<li>
										<input type="checkbox" class="checkbox" id="author_chk2_3">
										<label for="author_chk2_3">
											<i></i>Corresponding Author<span class="red_txt">*</span>
										</label>
									</li>
								</ul>
							</div>
						</li>
				                        <li>
				                            <p class="label"><?= $locale("country") ?> <span class="red_txt">*</span></p>
				                            <div>
				                                <select class="required2 co_nation" name="co_nation_no" data-count="1"
				                                    onchange="check_value()">
				                                    <option value="" selected hidden>Choose </option>
				                                    <?php
				                                        foreach ($nation_list as $list) {
				                                            $nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
				                                            $selected = $co_nation_no == $list["idx"] ? "selected" : "";
				                                            echo "<option value='" . $list["idx"] . "'" . $selected . ">" . $nation . "</option>";
				                                        }
				                                        ?>
				                                </select>
				                            </div>
				                        </li>
				                        <li>
				                            <p class="label"><?= $locale("city") ?> <span class="red_txt"></span></p>
				                            <div>
				                                <input maxlength="60" class="required2 en_keyup" type="text" name="co_city"
				                                    value="<?= $co_city ?>" onchange="check_value()">
				                            </div>
				                        </li>
				                        <li>
				                            <p class="label"><?= $locale("state") ?></p>
				                            <div>
				                                <input maxlength="60" class="en_keyup" type="text" name="co_state"
				                                    value="<?= $co_state ?>">
				                            </div>
				                        </li>
				                        <li>
				                            <p class="label"><?= $locale("name") ?> <span class="red_txt">*</span></p>
				                            <div class="name_div clearfix2">
				                                <input maxlength="60" placeholder="First name" class="required2 en_keyup" type="text" name="co_first_name"
				                                    value="<?= $co_first_name ?>" onchange="check_value()">
				                                <input maxlength="60" placeholder="Last name" class="required2 en_keyup" type="text" name="co_last_name"
				                                    value="<?= $co_last_name ?>" onchange="check_value()">
				                            </div>
				                        </li>
				                        <li>
				                            <p class="label"><?= $locale("affiliation") ?> <span class="red_txt">*</span></p>
				                            <div>
				                                <div class="clearfix affiliation_input">
				                                    <input maxlength="25" type="text" class="institution en_num_keyup"
				                                        placeholder="Institution">
				                                    <input maxlength="25" type="text" class="department en_num_keyup"
				                                        placeholder="Department">
				                                    <button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>
				                                </div>
				                                <div class="clearfix affiliation_form">
				                                    <ul class="affiliation_wrap affiliation_wrap_02"
				                                        style="<?= $co_affiliation != "" ? "display:block" : "" ?>">
				                                        <?php
				                                            if ($co_affiliation != "") {
				                                                if (!is_array($co_affiliation)) {
				                                                    $co_affiliation_arr = explode("★", $co_affiliation);
				                                                } else {
				                                                    $co_affiliation_arr = $co_affiliation;
				                                                }
				                                                for ($i = 0; $i < count($co_affiliation_arr) - 1; $i++) {
				                                                    echo '<li class="clearfix">';
				                                                    echo    '<div class="clearfix">';
				                                                    echo        '<p>' . $co_affiliation_arr[$i] . '</p>';
				                                                    echo    '</div>';
				                                                    echo    '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
				                                                    echo '</li>';
				                                                }
				                                            }
				                                            ?>
				                                    </ul>
				                                    <input type="hidden" name="co_affiliation" value="<?= $co_affiliation ?>"
				                                        onchange="check_value()">
				                                </div>
				                            </div>
				                        </li>
				                        <li>
				                            <p class="label"><?= $locale("abstract_item_position") ?> <span class="red_txt">*</span></p>
				                            <div class="pl60">
				                                <div class="radio_wrap">
				                                    <ul class="flex">
				                                        <li>
				                                            <input onchange="check_value()" type="radio" checked class="radio required2"
				                                                id="co_position6" name="co_position" value="0"
				                                                <?= $co_position == "0" ? "checked" : "" ?>><label
				                                                for="co_position6">Professor</label>
				                                        </li>
				                                        <li>
				                                            <input onchange="check_value()" type="radio" class="radio required2"
				                                                id="co_position7" name="co_position" value="1"
				                                                <?= $co_position == "1" ? "checked" : "" ?>><label
				                                                for="co_position7">Physician</label>
				                                        </li>
				                                        <li>
				                                            <input onchange="check_value()" type="radio" class="radio required2"
				                                                id="co_position8" name="co_position" value="2"
				                                                <?= $co_position == "2" ? "checked" : "" ?>><label
				                                                for="co_position8">Researcher</label>
				                                        </li>
				                                        <li>
				                                            <input onchange="check_value()" type="radio" class="radio required2"
				                                                id="co_position9" name="co_position" value="3"
				                                                <?= $co_position == "3" ? "checked" : "" ?>><label
				                                                for="co_position9">Student</label>
				                                        </li>
				                                        <li class="other_input_wrap">
				                                            <input onchange="check_value()" type="radio"
				                                                class="radio required2 co_other_position_check" id="co_position10"
				                                                name="co_position" value="4"
				                                                <?= $co_position == "4" ? "checked" : "" ?>><label
				                                                for="co_position10">Others</label>
				                                            <input onchange="check_value()" type="text"
				                                                class="other_input en_num_keyup co_other_position"
				                                                name="co_other_position" value="<?= $co_other_position ?>"
				                                                style="<?= $co_position == "4" ? "display:inline-block" : "" ?>">
				                                        </li>
				                                    </ul>
				                                </div>
				                            </div>
				                        </li>
				                        <li>
				                            <p class="label"><?= $locale("email") ?> <span class="red_txt">*</span></p>
				                            <div>
				                                <input maxlength="60" class="required2 email" type="text" name="co_email"
				                                    value="<?= $co_email ?>" onchange="check_value()">
				                            </div>
				                        </li>
				                        <li>
				                            <p class="label"><?= $locale("phone") ?> <span class="red_txt">*</span></p>
				                            <div class="phone_div clearfix2">
				                                <select class="required2" name="co_nation_tel1">
				                                    <option value="<?= $co_nation_tel ?>" selected>
				                                        <?= $co_nation_tel != "" ? $co_nation_tel : "select" ?></option>
				                                </select>
				                                <input maxlength="60" class="required2 phone" type="text" placeholder="010-0000-0000"
				                                    name="co_phone" value="<?= $co_phone ?>" onchange="check_value()">
				                            </div>
				                        </li>
				                    </ul>
				                    <input type="hidden" value="<?= $co_idx; ?>" name="co_idx">
				</form> -->
			</div>
            <div class="clearfix2 coauthor_wrap">
                <p><?= $locale("check_co_author2") ?></p>
                <!-- 기존 radio로 co-author를 추가했지만, 추가 버튼으로 입력값 append형태로 변경
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
            <div class="co_author_appended">
                <?php
                    if ($coauthor_submit_data[0] != "") {
                        for ($i = 0; $i < ($data_count - 1); $i++) {
                            $display = $coauthor_affiliation[$i] != "" ? "block" : "none";
                            $position0 = "";
                            $position1 = "";
                            $position2 = "";
                            $position3 = "";
                            $position4 = "";
                            switch ($coauthor_position[$i]) {
                                case 0:
                                    $position0 = "checked";
                                    break;
                                case 1:
                                    $position1 = "checked";
                                    break;
                                case 2:
                                    $position2 = "checked";
                                    break;
                                case 3:
                                    $position3 = "checked";
                                    break;
                                case 4:
                                    $position4 = "checked";
                                    break;
                            }
                            /*echo    '<div class="section_title_wrap2">';
                            echo        '<h3 class="title">' . $locale("co_author_tit") . ($i + 1) . '</h3>';
                            echo    '</div>';*/
                            echo  '<form name="coauthor_abstract_form' . $i . '" class="abstract_form">';
                            echo        '<ul class="basic_ul">';
                            /*echo            '<li class="coauthor_wrap">';
                            echo                '<input type="checkbox" class="checkbox" onchange="add_author(' . $i . ')" id="same_with' . $i . '" "data-count="' . $i . '">';
                            echo                '<label onchange="check_value()" for ="same_with' . $i . '">' . $locale("as_author") . '</label>';
                            echo            '<li>';*/
							echo            '<li>';
                            echo                '<p class="label author_num">' . 'Author #' . ($i + 0) . '</p>';
                            echo                '<div>';
                            echo                    '<ul class="author_chk_wrap">';
                            echo						'<li>';
                            echo							'<input type="checkbox" class="checkbox" id="author_chk1_1">';
                            echo							'<label for="author_chk1_1">';
                            echo								'<i></i>Same as sign-up information<span class="red_txt">*</span>';
                            echo							'</label>';
                            echo						'</li>';
							echo						'<li>';
                            echo							'<input type="checkbox" class="checkbox" id="author_chk1_2">';
                            echo							'<label for="author_chk1_2">';
                            echo								'<i></i>Presenting Author<span class="red_txt">*</span>';
                            echo							'</label>';
                            echo						'</li>';
							echo						'<li>';
                            echo							'<input type="checkbox" class="checkbox" id="author_chk1_3">';
                            echo							'<label for="author_chk1_3">';
                            echo								'<i></i>Corresponding Author<span class="red_txt">*</span>';
                            echo							'</label>';
                            echo						'</li>';
                            echo                    '</ul>';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("country") . '<span class="red_txt">*</span></p>';
                            echo                '<div>';
                            echo                    '<select onchange="check_value()" class="required2 add_co_nation" name="add_co_nation_no' . $i . '" data-count="' . $i . '">';
                            echo                        '<option hidden>CHOOSE</option>';
                            foreach ($nation_list as $list) {
                                $nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
                                $selected = $coauthor_nation_no[$i] == $list["idx"] ? "selected" : "";
                                echo "<option value='" . $list["idx"] . "'" . $selected . ">" . $nation . "</option>";
                            }
                            echo                    '</select>';
                            echo                '</div>';
                            echo            '</li>';
                            /*echo            '<li>';
                            echo                '<p class="label">' . $locale("city") . '<span class="red_txt"></span></p>';
                            echo                '<div>';
                            echo                    '<input maxlength="60" class="required2 en_keyup" type="text" name="add_co_city' . $i . '" value="' . $coauthor_city[$i] . '" onchange="check_value()">';
                            echo                '</div>';
                            echo            '<li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("state") . '</p>';
                            echo                '<div>';
                            echo                    '<input maxlength="60" class="en_keyup" type="text" name="add_co_state' . $i . '" value="' . $coauthor_state[$i] . '">';
                            echo                '</div>';
                            echo            '<li>';*/
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("name") . ' <span class="red_txt">*</span></p>';
                            echo                '<div class="name_div clearfix2">';
                            echo                    '<input maxlength="60" placeholder="First name" class="required2 en_keyup" type="text" name="add_co_first_name' . $i . '" value="' . $coauthor_first_name[$i] . '" onchange="check_value()">';
                            echo                    '<input maxlength="60" placeholder="Last name" class="required2 en_keyup" type="text" name="add_co_last_name' . $i . '" value="' . $coauthor_last_name[$i] . '" onchange="check_value()">';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("affiliation") . ' <span class="red_txt">*</span></p>';
                            echo                '<div>';
                            echo                    '<div class="clearfix affiliation_input">';
                            echo                        '<input maxlength="25" type="text" class="institution en_keyup" placeholder="Institution">';
                            echo                        '<input maxlength="25" type="text" class="department en_keyup" placeholder="Department">';
                            echo                        '<button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>';
                            echo                    '</div>';
                            echo                    '<div class="clearfix affiliation_form">';
                            echo                        '<ul class="affiliation_wrap affiliation_wrap_' . $i . '">';
                            if ($coauthor_affiliation[$i] != "") {
                                if (!is_array($coauthor_affiliation[$i])) {
                                    $coauthor_affiliation_arr = explode("★", $coauthor_affiliation[$i]);
                                } else {
                                    $coauthor_affiliation_arr = $coauthor_affiliation[$i];
                                }

                                for ($j = 0; $j < count($coauthor_affiliation_arr) - 1; $j++) {
                                    echo '<li class="clearfix">';
                                    echo    '<div class="clearfix">';
                                    echo        '<p>' . $coauthor_affiliation_arr[$j] . '</p>';
                                    echo    '</div>';
                                    echo    '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
                                    echo '</li>';
                                }
                            }
                            echo                        '</ul>';
                            echo                        '<input type="hidden" value=' . $coauthor_affiliation[$i] . ' name="add_co_affiliation' . $i . '" onchange="check_value()">';
                            echo                    '</div>';
                            echo                '</div>';
                            echo            '</li>';
                            /*echo            '<li>';
                            echo                '<p class="label">' . $locale("abstract_item_position") . ' <span class="red_txt">*</span></p>';
                            echo                '<div class="pl60">';
                            echo                    '<div class="radio_wrap">';
                            echo                        '<ul class="flex">';
                            echo                            '<li>';
                            echo                                '<input onchange="check_value()" type="radio" ' . $position0 . ' class="radio required2 other_input_show" id="add_co_position1_' . $i . '" name="add_co_position' . $i . '" value="0" onclick=other_change(this)>';
                            echo                                '<label for="add_co_position1_' . $i . '">Professor</label>';
                            echo                            '</li>';
                            echo                            '<li>';
                            echo                                '<input onchange="check_value()" type="radio" ' . $position1 . ' class="radio required2 other_input_show" id="add_co_position2_' . $i . '" name="add_co_position' . $i . '" value="1" onclick=other_change(this)>';
                            echo                                '<label for="add_co_position2_' . $i . '">Physician</label>';
                            echo                            '</li>';
                            echo                            '<li>';
                            echo                                '<input onchange="check_value()" type="radio" ' . $position2 . ' class="radio required2 other_input_show" id="add_co_position3_' . $i . '" name="add_co_position' . $i . '" value="2" onclick=other_change(this)>';
                            echo                                '<label for="add_co_position3_' . $i . '">Researcher</label>';
                            echo                            '</li>';
                            echo                            '<li>';
                            echo                                '<input onchange="check_value()" type="radio" ' . $position3 . ' class="radio required2 other_input_show" id="add_co_position4_' . $i . '" name="add_co_position' . $i . '" value="3" onclick=other_change(this)>';
                            echo                                '<label for="add_co_position4_' . $i . '">Student</label>';
                            echo                            '</li>';
                            echo                            '<li class="other_input_wrap">';
                            echo                                '<input onchange="check_value()" type="radio" ' . $position4 . ' class="radio required2 other_input_show add_co_other_position_check" id="add_co_position5_' . $i . '" name="add_co_position' . $i . '" value="4" onclick=other_change(this)>';
                            echo                                '<label for="add_co_position5_' . $i . '">Others</label>';
                            if ($position4 == 'checked') {
                                echo                                '<input onchange="check_value()" type="text" class="other_input en_num_keyup add_co_other_position' . $i . '" name="add_co_other_position' . $i . '" value="' . $coauthor_other_position[$i] . '" style="display: inline-block;">';
                            } else {
                                echo                                '<input onchange="check_value()" type="text" class="other_input add_co_other_position' . $i . '" name="add_co_other_position' . $i . '" value="">';
                            }
                            echo                            '</li>';
                            echo                        '</ul>';
                            echo                    '</div>';
                            echo                '</div>';
                            echo            '<li>';*/
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("email") . ' <span class="red_txt">*</span></p>';
                            echo                '<div>';
                            echo                    '<input maxlength="60" class="required2 email" type="text" name="add_co_email' . $i . '" value="' . $coauthor_email[$i] . '" onchange="check_value()">';
                            echo                '</div>';
                            echo            '</li>';
                            echo            '<li>';
                            echo                '<p class="label">' . $locale("phone") . ' <span class="red_txt">*</span></p>';
                            echo                '<div class="phone_div clearfix2">';
                            echo                    '<select class="required2" name="add_co_nation_tel' . $i . '">';
                            echo                        '<option value="' . $coauthor_nation_tel[$i] . '" selected>' . $coauthor_nation_tel[$i] . '</option>';
                            echo                    '</select>';
                            echo                    '<input maxlength="60" class="required2 phone" type="text" placeholder="010-0000-0000" name="add_co_phone' . $i . '" value="' . $coauthor_phone[$i] . '" onchange="check_value()">';
                            echo                '</div>';
                            echo            '</li>';
                            echo        '</ul>';
                            echo        '<input type="hidden" value=' . $coauthor_idx[$i] . ' name="add_co_idx' . $i . '">';
                            echo     '</form>';
                        }
                    }
                    ?>
            </div>
            <!-- online_btn -->
            <!-- <button type="button" class="btn submit is_submit" onclick="javascript:window.location.href='./abstract_submission2.php';"><?= $locale("next_btn") ?></button> -->
            <?php
                if (!empty($abstract_idx) || !empty($submit_data)) {
                ?>
            <button type="button" id="submit_btn" class="btn btns green_btn submit_btn"
                data-idx=<?= $abstract_idx ?>><?= $locale("next_btn") ?><!-- <span>&gt;</span> --></button>
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
<script src="./js/script/client/submission.js"></script>
<script>
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
	$("#submit_btn").removeClass("green_btn");
	$("#submit_btn").addClass("gray_btn");
}*/
$(document).ready(function() {
    $(document).on("click", ".green_btn", function() {
        var idx = $(this).data("idx");
        var data = {};

        var formData = $("form[name=abstract_form]").serializeArray();
        var process = inputCheck(formData);
        var status = process.status;
        data["main_data"] = process.data;

        if (!status) return false; // 유효성 검증 후 실패 시 return false;
		

		var co_data_arr = new Array();
		var co_form_cnt = document.querySelectorAll(".co_abstract").length;
		var co_data_temp;
		var co_data_chk;
		var co_process;
		var co_status;
		var co_data;
		for(var i=0;i<co_form_cnt;i++){
			co_data_temp = $("form[name=coauthor_abstract_form"+i+"]").serializeArray();
			co_process = inputCheck(co_data_temp);
			co_status = co_process.status;
			if (!co_status) return false;
			co_data = co_process.data;
			co_data_arr[i] = co_data;
		}
		data["co_data"] = co_data_arr;

		//for(var i=0;i<co_form_cnt;i++){
		//	co_data_temp = $("form[name=coauthor_abstract_form"+i+"]").serializeArray();
		//	co_data_arr[i] = co_data_temp;
		//}
		//inputCheck(co_data_arr);
		//console.log(co_data_arr.length);
		//return;

		
        //var co_process1 = inputCheck(co_formData1);
        //status = co_process1.status;
        //data["co_data1"] = co_process1.data;

        //if (!status) return false; //유효성 검증 후 실패 시 return false;

        //var coauthor_formData = [];

        //for (i = 0; i < co_count; i++) {
        //    coauthor_formData[i] = $("form[name=coauthor_abstract_form" + i + "]").serializeArray();

        //    if (coauthor_formData[i]) {
        //        var coauthor_process = inputCheck(coauthor_formData[i]);
        //        status = coauthor_process.status;
        //        data["coauthor_data" + i] = coauthor_process.data;
        //    }

        //    if (!status) return false; //공동저자 데이터 유효성 검증 후 실패 시 return false;

        //}

        // Abstract 수정하기 정보
        // var abstract_no = $("input[name=abstract_no]").val();
        // 	abstract_no = (abstract_no && abstract_no != "" && typeof(abstract_no) != undefined) ? abstract_no : "";
		

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
                    /* 제출 유무 확인 주석 (중복제출가능) else if(res.code == 401) {
						alert(locale(language.value)("already_submission"));
						location.href="./mypage_abstract.php";
					}*/
                    else {
                        alert(locale(language.value)("retry_msg"));
                        return false;
                    }
                }
            });
        }
    });

    $(document).on('click', '.affiliation_add', function() {
        var instit = $(this).siblings('.institution').val();
        var depart = $(this).siblings('.department').val();
        //var affiliation_input = $(this).parent().siblings("input");
        var affiliation_input = $(this).parent().next().find("input");

		//var affiliation_cnt = $('.affiliation_wrap').find('li').length;

		//var form_idx = this.form.name;
		var form_name = this.form.name;
		//alert(form_name);
		var affiliation_cnt = $("form[name="+form_name+"]").find('.affiliation_wrap').find('li').length;
		//alert(affiliation_cnt);
		


        if (instit == '') {
            alert('Please insert institution');
        } else if (depart == '') {
            alert('Please insert department');
        } else if (affiliation_cnt > 9) {
			alert('Affiliation cannot exceed 10');	
        } else {
            html = '';

            html += '<li class="clearfix">';
            html += '<div><p>' + depart + '<span class="middle">, </span>' + instit + '</p></div>';
            html += '<button type="button" class="btn gray2_btn form_btn affiliation_delete">Delete</button>';
            html += '</li>';

            $(this).siblings('.institution').val('');
            $(this).siblings('.department').val('');
            $(this).parent().next('.affiliation_form').show();
            $(this).parent().next('.affiliation_form').find('.affiliation_wrap').append(html);
        }

        //소속 항목 input에 추가
        //var affiliation_list = [];
        //var affiliation_count = $(this).parent().next().children().length;
        //for(i=0; i<affiliation_count; i++) {
        //	affiliation_list.push(affiliation.eq(i).find("p").text());
        //}


        var affiliation = $(this).parent().next().children();
        var affiliation_value = "";

        for (var i = 0; i < affiliation.eq(0).find("p").length; i++) {
            affiliation_value += affiliation.eq(0).find("p:eq(" + i + ")").text() + "★ ";
        }

        affiliation_input.val(affiliation_value);

        check_value();
    });

    $(document).on('click', '.affiliation_delete', function() {
        //console.log($(this).parent().parent().next());

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
        //console.log(affiliation_input.val());

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

        console.log('current_count', current_count);
        console.log('num', num);


        if (num == 0) {
            $('.co_author_appended').empty();
        } else if (current_count < num) {
            var html = '';
            for (i = current_count; i < num; i++) {
                /*html = '<div class="section_title_wrap2">';
                html += '<h3 class="title"><?= $locale("co_author_tit") ?> ' + (i + 1) + '</h3>';
                html += '</div>';*/

				/////////////////
				html = '';
				/////////////////


                html += '<form name="coauthor_abstract_form' + i + '" class="abstract_form co_abstract">';
                html += '<ul class="basic_ul">';
                /*html += '<li class="coauthor_wrap">';
                html += '<input type="checkbox" class="checkbox" onchange="add_author(' + i +
                    ')" id="same_with' + i + '" "data-count="' + i + '">';
                html += '<label onchange="check_value()" for ="same_with' + i +
                    '"><?= $locale("as_author") ?></label>';
                html += '<li>';*/
                html += '<li>';
                html += '<p class="label author_num">Author #' + (i + 2) + '</p>';
                html += '<div>';
                html += '<ul class="author_chk_wrap">';
				html += '<li>';
				html += '<input type="checkbox" class="checkbox" id="author_chk1_1">';
				html += '<label for="author_chk1_1">';
				html += '<i></i>Same as sign-up information<span class="red_txt">*</span>';
				html += '</label>';
                html += '</li>';
				html += '<li>';
				html += '<input type="checkbox" class="checkbox" id="author_chk1_2">';
				html += '<label for="author_chk1_2">';
				html += '<i></i>Presenting Author<span class="red_txt">*</span>';
				html += '</label>';
                html += '</li>';
				html += '<li>';
				html += '<input type="checkbox" class="checkbox" id="author_chk1_3">';
				html += '<label for="author_chk1_3">';
				html += '<i></i>Corresponding Author<span class="red_txt">*</span>';
				html += '</label>';
                html += '</li>';
                html += '</ul>';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html += '<p class="label"><?= $locale("country") ?> <span class="red_txt">*</span></p>';
                html += '<div>';
                html +=
                    '<select onchange="check_value()" class="required2 add_co_nation" name="add_co_nation_no' +
                    i + '" data-count="' + i + '">';
                html += '<option selected hidden>CHOOSE</option>';
                $.each(nation_list, function(idx, value) {
                    html += '<option value=' + value["idx"] + '>' + value["nation_en"] +
                        '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</li>';
                /*html += '<li>';
                html += '<p class="label"><?= $locale("city") ?> <span class="red_txt"></span></p>';
                html += '<div>';
                html +=
                    '<input maxlength="60" class="required2 en_keyup" type="text" name="add_co_city' +
                    i + '" value="" onchange="check_value()">';
                html += '</div>';
                html += '<li>';
                html += '<li>';
                html += '<p class="label"><?= $locale("state") ?></p>';
                html += '<div>';
                html += '<input maxlength="60" type="text" class="en_keyup" name="add_co_state' + i +
                    '" value="">';
                html += '</div>';
                html += '<li>';*/
                html += '<li>';
                html += '<p class="label"><?= $locale("name") ?> <span class="red_txt">*</span></p>';
                html += '<div class="name_div clearfix2">';
                html +=
                    '<input maxlength="60" placeholder="First name" class="required2 en_keyup" type="text" name="add_co_first_name' +
                    i + '" value="" onchange="check_value()">';
                html +=
                    '<input maxlength="60" placeholder="Last name" class="required2 en_keyup" type="text" name="add_co_last_name' +
                    i + '" value="" onchange="check_value()">';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html +=
                    '<p class="label"><?= $locale("affiliation") ?> <span class="red_txt">*</span></p>';
                html += '<div>';
                html += '<div class="clearfix affiliation_input">';
                html +=
                    '<input maxlength="25" type="text" class="institution en_num_keyup" placeholder="Institution">';
                html +=
                    '<input maxlength="25" type="text" class="department en_num_keyup" placeholder="Department">';
                html += '<button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>';
                html += '</div>';
                html += '<div class="clearfix affiliation_form">';
                html += '<ul class="affiliation_wrap affiliation_wrap_' + i + '">';
                html += '<li>';
                html += '</li>';
                html += '</ul>';
                html += '<input type="hidden" name="add_co_affiliation' + i +
                    '" onchange="check_value()">';
                html += '</div>';
                html += '</div>';
                html += '</li>';
                /*html += '<li>';
                html +=
                    '<p class="label"><?= $locale("abstract_item_position") ?> <span class="red_txt">*</span></p>';
                html += '<div class="pl60">';
                html += '<div class="radio_wrap">';
                html += '<ul class="flex">';
                html += '<li>';
                html +=
                    '<input onchange="check_value()" type="radio" checked class="radio required2 other_input_show" id="add_co_position1_' +
                    i + '" name="add_co_position' + i + '" value="0" onclick=other_change(this)>';
                html += '<label for="add_co_position1_' + i + '">Professor</label>';
                html += '</li>';
                html += '<li>';
                html +=
                    '<input onchange="check_value()" type="radio" class="radio required2 other_input_show" id="add_co_position2_' +
                    i + '" name="add_co_position' + i + '" value="1" onclick=other_change(this)>';
                html += '<label for="add_co_position2_' + i + '">Physician</label>';
                html += '</li>';
                html += '<li>';
                html +=
                    '<input onchange="check_value()" type="radio" class="radio required2 other_input_show" id="add_co_position3_' +
                    i + '" name="add_co_position' + i + '" value="2" onclick=other_change(this)>';
                html += '<label for="add_co_position3_' + i + '">Researcher</label>';
                html += '</li>';
                html += '<li>';
                html +=
                    '<input onchange="check_value()" type="radio" class="radio required2 other_input_show"  id="add_co_position4_' +
                    i + '" name="add_co_position' + i + '" value="3" onclick=other_change(this)>';
                html += '<label for="add_co_position4_' + i + '">Student</label>';
                html += '</li>';
                html += '<li class="other_input_wrap">';
                html +=
                    '<input onchange="check_value()" type="radio" class="radio required2 other_input_show add_co_other_position_check' +
                    i + '" id="add_co_position5_' + i + '" name="add_co_position' + i +
                    '" value="4" onclick=other_change(this)>';
                html += '<label for="add_co_position5_' + i + '">Others</label>';
                html +=
                    '<input onchange="check_value()" type="text" class="other_input add_co_other_position' +
                    i + '" name="add_co_other_position' + i + '" value="">';
                html += '</li>';
                html += '</ul>';
                html += '</div>';
                html += '</div>';
                html += '<li>';*/
                html += '<li>';
                html += '<p class="label"><?= $locale("email") ?> <span class="red_txt">*</span></p>';
                html += '<div>';
                html += '<input maxlength="60" class="required2 email" type="text" name="add_co_email' +
                    i + '" value="" onchange="check_value()">';
                html += '</div>';
                html += '</li>';
                html += '<li>';
                html += '<p class="label"><?= $locale("phone") ?> <span class="red_txt">*</span></p>';
                html += '<div class="phone_div clearfix2">';
                html += '<select class="required2" name="add_co_nation_tel' + i + '">';
                html += '<option value="" selected></option>';
                html += '</select>';
                html +=
                    '<input class="required2 phone" type="text" placeholder="010-0000-0000" name="add_co_phone' +
                    i + '" value="" onchange="check_value()">';
                html += '</div>';
                html += '</li>';
                html += '</ul>';
                //전에있던 원본소스
                //html +=  '<form name="coauthor_abstract_form'+i+'">';
                //html +=  '<div class="table_wrap c_table_wrap input_table">';
                //html +=		'<table class="c_table">';
                //html +=			'<tr>';
                //html +=				'<th><?= $locale("first_name") ?> *</th>';
                //html +=				'<td><input class="required2" type="text" name="add_co_first_name'+i+'" value="" maxlength="50"></td>';
                //html +=			'</tr>';
                //html +=			'<tr>';
                //html +=				'<th><?= $locale("last_name") ?> *</th>';
                //html +=				'<td><input class="required2" type="text" name="add_co_last_name'+i+'" value="" maxlength="50"></td>';
                //html +=			'</tr>';
                ///* 21.06.11 퍼블 긴급패치로 인한 추가개발 필요(주석)*/
                //html +=			'<tr>';
                //html +=				'<th><?= $locale("email") ?> *</th>';
                //html +=				'<td><input class="required2" type="text" name="add_co_email'+i+'" value="" maxlength="50"></td>';
                //html +=			'</tr>';
                //html +=			'<tr>';
                //html +=				'<th><?= $locale("affiliation") ?> *</th>';
                //html +=				'<td class="affiliation_td">';
                //html +=					'<div class="clearfix affiliation_input">';
                //html +=						'<input type="text" class="institution" placeholder="Institution">';
                //html +=						'<input type="text" class="department" placeholder="Department">';
                //html +=						'<button type="button" class="btn gray2_btn form_btn affiliation_add">ADD</button>';
                //html +=					'</div>';
                //html +=					'<ul class="affiliation_wrap affiliation_wrap_'+i+'">';
                //html +=					'</ul>';
                //html +=				 '<input type="hidden" name="add_co_affiliation'+i+'" value="">';
                //html +=				'</td>';
                //html +=			'</tr>';
                //html +=		'</table>';
                //html +=	'</div>';
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


        //check_value();
    });

    //주저자와 공동저자가 동일 시 체크버튼 이벤트
    //$("#same_with").on("change", function(){
    //	if($(this).is(":checked")) {
    //		var nation_no = $("select[name=nation_no]").val();
    //		var position = $("input[name=position]:checked").val();
    //		$("select[name=co_nation_no]").children("option[value="+nation_no+"]").prop("selected", true);
    //		$("select[name=co_nation_tel1] option").val($("select[name=nation_tel] option").val()).text($("select[name=nation_tel] option").val());
    //		$("input[name=co_first_name]").val($("input[name=first_name]").val());
    //		$("input[name=co_last_name]").val($("input[name=last_name]").val());
    //		$("input[name=co_city]").val($("input[name=city]").val());
    //		$("input[name=co_state]").val($("input[name=state]").val());
    //		$("input[name=co_email]").val($("input[name=email]").val());
    //		$("input[name=co_phone]").val($("input[name=phone]").val());
    //		if(position == "4") {
    //			$("input[name=co_position][value="+position+"]").prop("checked", true);
    //			$("input[name=co_other_position]").val($("input[name=other_position]").val());
    //			$("form[name=co_abstract_form] .other_input").show();
    //			
    //		} else {
    //			$("input[name=co_position][value="+position+"]").prop("checked", true);
    //		}

    //		if($("input[name=affiliation]").val() != "") {
    //			$("input[name=co_affiliation]").val($("input[name=affiliation]").val());
    //			$(".affiliation_wrap_2").append($(".affiliation_wrap_1").html()).show();
    //		}
    //	} else {
    //		$("select[name=co_nation_no]").children("option[value="+nation_no+"]").prop("selected", false);
    //		$("select[name=co_nation_no]").children("option[hidden]").prop("selected", true);
    //		$("select[name=co_nation_tel1] option").val("").text("select");
    //		$("input[name=co_first_name]").val("");
    //		$("input[name=co_last_name]").val("");
    //		$("input[name=co_city]").val("");
    //		$("input[name=co_state]").val("");
    //		$("input[name=co_affililation]").val("");
    //		$("input[name=co_position][value="+position+"]").prop("checked", false);
    //		$("input[name=co_other_postion]").val("");
    //		$("input[name=co_other_position]").hide();
    //		$("input[name=co_email]").val("");
    //		$("input[name=co_phone]").val("");

    //		$(".affiliation_wrap_2").empty().hide();
    //	}
    //});

});

//주저자와 공동저자가 동일 시 체크버튼 이벤트
function same_add_author() {
    if ($("#same_withs").is(":checked")) {
        var nation_no = $("select[name=nation_no]").val();

        if (nation_no != "") {
            $("select[name=co_nation_no]").children("option[value=" + nation_no + "]").prop("selected", true);
            $("select[name=co_nation_tel1] option").val($("select[name=nation_tel] option").val()).text($(
                "select[name=nation_tel] option").val());
        }
        var position = $("input[name=position]:checked").val();

        $("input[name=co_first_name]").val($("input[name=first_name]").val());
        $("input[name=co_last_name]").val($("input[name=last_name]").val());
        $("input[name=co_city").val($("input[name=city]").val());
        $("input[name=co_state]").val($("input[name=state]").val());
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
        $("input[name=co_city]").val("");
        $("input[name=co_state]").val("");
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
            $("select[name=add_co_nation_tel" + i + "] option").val($("select[name=nation_tel] option").val()).text($(
                "select[name=nation_tel] option").val());
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
            ///$("input[name=add_co_affiliation"+i+"]").val("");

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
            }

            //else if(ok == "city") {
            //	alert(locale(language.value)("check_city"));
            //	$("input[name="+ok+"]").focus();
            //	inputCheck = false;
            //	return false;
            //} 
            else if (ok == "affiliation") {
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
            } else if (ok == "co_nation_no" || ok == "add_co_nation_no0" || ok == "add_co_nation_no1" || ok ==
                "add_co_nation_no2" || ok == "add_co_nation_no3" || ok == "add_co_nation_no4" || ok ==
                "add_co_nation_no5" || ok == "add_co_nation_no6" || ok == "add_co_nation_no7" || ok ==
                "add_co_nation_no8" || ok == "add_co_nation_no9") {
                alert(locale(language.value)("check_co_nation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            }

            //else if(ok == "co_city" || ok == "add_co_city0" || ok == "add_co_city1" || ok == "add_co_city2" || ok == "add_co_city3" || ok == "add_co_city4" || ok == "add_co_city5" || ok == "add_co_city6" || ok == "add_co_city7" || ok == "add_co_city8" || ok == "add_co_city9") {
            //	alert(locale(language.value)("check_co_city"));
            //	$("input[name="+ok+"]").focus();
            //	inputCheck = false;
            //	return false;
            //} 
            else if (ok == "co_first_name" || ok == "add_co_first_name0" || ok == "add_co_first_name1" || ok ==
                "add_co_first_name2" || ok == "add_co_first_name3" || ok == "add_co_first_name4" || ok ==
                "add_co_first_name5" || ok == "add_co_first_name6" || ok == "add_co_first_name7" || ok ==
                "add_co_first_name8" || ok == "add_co_first_name9") {
                alert(locale(language.value)("check_co_first_name"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_last_name" || ok == "add_co_last_name0" || ok == "add_co_last_name1" || ok ==
                "add_co_last_name2" || ok == "add_co_last_name3" || ok == "add_co_last_name4" || ok ==
                "add_co_last_name5" || ok == "add_co_last_name6" || ok == "add_co_last_name7" || ok ==
                "add_co_last_name8" || ok == "add_co_last_name9") {
                alert(locale(language.value)("check_co_last_name"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            }
            /* 21.06.11 퍼블 긴급패치로 인한 추가개발 필요(주석)*/
            else if (ok == "co_email" || ok == "add_co_email0" || ok == "add_co_email1" || ok ==
                "add_co_email2" || ok == "add_co_email3" || ok == "add_co_email4" || ok == "add_co_email5" ||
                ok == "add_co_email6" || ok == "add_co_email7" || ok == "add_co_email8" || ok == "add_co_email9"
            ) {
                alert(locale(language.value)("check_co_email"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_email" || ok == "add_co_email0" || ok == "add_co_email1" || ok ==
                "add_co_email2" || ok == "add_co_email3" || ok == "add_co_email4" || ok == "add_co_email5" ||
                ok == "add_co_email6" || ok == "add_co_email7" || ok == "add_co_email8" || ok == "add_co_email9"
            ) {
                alert(locale(language.value)("check_co_email"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_affiliation" || ok == "add_co_affiliation0" || ok == "add_co_affiliation1" ||
                ok == "add_co_affiliation2" || ok == "add_co_affiliation3" || ok == "add_co_affiliation4" ||
                ok == "add_co_affiliation5" || ok == "add_co_affiliation6" || ok == "add_co_affiliation7" ||
                ok == "add_co_affiliation8" || ok == "add_co_affiliation9") {
                alert(locale(language.value)("check_co_affiliation"));
                $("input[name=" + ok + "]").focus();
                inputCheck = false;
                return false;
            } else if (ok == "co_phone" || ok == "add_co_phone0" || ok == "add_co_phone1" || ok ==
                "add_co_phone2" || ok == "add_co_phone3" || ok == "add_co_phone4" || ok == "add_co_phone5" ||
                ok == "add_co_phone6" || ok == "add_co_phone7" || ok == "add_co_phone8" || ok == "add_co_phone9"
            ) {
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

        //console.log($("input[name=position]:checked").val());
        //return;
    });


    //if(inputCheck) {
    //	if(!$("input[name=position]").is(":checked")) {
    //		alert(locale(language.value)("check_position"));
    //		inputCheck = false;
    //		return false;
    //	}
    //	if(!$("input[name=co_position]").is(":checked")) {
    //		alert(locale(language.value)("check_co_position"));
    //		inputCheck = false;
    //		return false;
    //	}
    //}

    return {
        data: data,
        status: inputCheck
    }
}

//체크 벨류
function check_value() {

    var affiliation = $("input[name=affiliation]").val();
    var affiliation_len = affiliation.trim().length;
    affiliation = (typeof(affiliation) != "undefined") ? affiliation : null;

    if (!affiliation || affiliation_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("b");
        return;
    }

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
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("bd");
        return;
    }

    // position other 체크했지만 값 입력하지 않음
    if (position_other_check_count > position_other_write_count) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("bd");
        return;
    }

    /*var other_position_check = $(".other_position_check").is(":checked");
    var other_position = $(".other_position").val();
    var other_position_len = other_position.trim().length;
    other_position = (typeof(other_position) != "undefined") ? other_position : null;

    var co_other_position_check = $(".co_other_position_check").is(":checked");
    var co_other_position = $(".co_other_position").val();
    var co_other_position_len = co_other_position.trim().length;
    co_other_position = (typeof(co_other_position) != "undefined") ? co_other_position : null;


    if(other_position_check == true) {
    	if(!other_position || other_position_len < 0) {
    		$("#submit_btn").removeClass("green_btn");
    		$("#submit_btn").addClass("gray_btn");
    		console.log("bd");
    		return;
    	} 
    }

    if(co_other_position_check == true) {
    	if(!co_other_position || co_other_position_len < 0) {
    		$("#submit_btn").removeClass("green_btn");
    		$("#submit_btn").addClass("gray_btn");
    		console.log("bd");
    		return;
    	} 
    }*/

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


    if (abstract_category == "") {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("a");
        return;
    }

    //if(!city || city_len < 0) {
    //	$("#submit_btn").removeClass("green_btn");
    //	$("#submit_btn").addClass("gray_btn");
    //	console.log("bC");
    //	return;
    //} 

    if (!first_name || first_name_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("c");
        return;
    }
    if (!last_name || last_name_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("d");
        return;
    }
    if (!affiliation || affiliation_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("e");
        return;
    }
    if (!email || email_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("f");
        return;
    }
    if (!phone || phone_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("g");
        return;
    }

    var co_nation_no = $("select[name=co_nation_no]").val();

    var co_first_name = $("input[name=co_first_name]").val();
    var co_first_name_len = co_first_name.trim().length;
	
    co_first_name = (typeof(co_first_name) != "undefined") ? co_first_name : null;

    var co_last_name = $("input[name=co_last_name]").val();
    var co_last_name_len = co_last_name.trim().length;
    co_last_name = (typeof(co_last_name) != "undefined") ? co_last_name : null;

    //var co_city = $("input[name=co_city]").val();
    //var co_city_len = co_city.trim().length;
    //co_city = (typeof(co_city) != "undefined") ? co_city : null;

    var co_affiliation = $("input[name=co_affiliation]").val();
    var co_affiliation_len = co_affiliation.trim().length;
    co_affiliation = (typeof(co_affiliation) != "undefined") ? co_affiliation : null;

    var co_email = $("input[name=co_email]").val();
    var co_email_len = co_email.trim().length;
    co_email = (typeof(co_email) != "undefined") ? co_email : null;

    var co_phone = $("input[name=co_phone]").val();
    var co_phone_len = co_phone.trim().length;
    co_phone = (typeof(co_phone) != "undefined") ? co_phone : null;


    //if(!co_city || co_city_len < 0) {
    //	$("#submit_btn").removeClass("green_btn");
    //	$("#submit_btn").addClass("gray_btn");
    //	console.log("h");
    //	return;
    //}
    if (co_nation_no == "") {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("i");
        return;
    }
    if (!co_first_name || co_first_name_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("j");
        return;
    }
    if (!co_last_name || co_last_name_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("k");
        return;
    }
    if (!co_affiliation || co_affiliation_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("l");
        return;
    }
    if (!co_email || co_email_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("m");
        return;
    }
    if (!co_phone || co_phone_len < 0) {
        $("#submit_btn").removeClass("green_btn");
        $("#submit_btn").addClass("gray_btn");
        console.log("n");
        return;
    }


    var abstract_form_len = $(".abstract_form").length;

    if (abstract_form_len > 1) {
        for (var i = 0; i < abstract_form_len - 1; i++) {

            /*var add_co_affiliation = $("input[name=add_co_affiliation"+i+"]").val();
            var add_co_affiliation_len = add_co_affiliation.trim().length;
            add_co_affiliation = (typeof(add_co_affiliation) != "undefined") ? add_co_affiliation : null;

            console.log('add_co_affiliation', add_co_affiliation);
            console.log('add_co_affiliation_len', add_co_affiliation_len);

            if(!add_co_affiliation || add_co_affiliation_len < 0) {
            	$("#submit_btn").removeClass("green_btn");
            	$("#submit_btn").addClass("gray_btn");
            	console.log("b");
            	return;
            }*/
            // affiliation 유효성
            var temp;
            var affiliation_flag = true;
            $('.affiliation_wrap').each(function() {
                temp = $(this);
                console.log(temp.children('li').length, temp);
                if (temp.children('li').length <= 0) {
                    affiliation_flag = !affiliation_flag;
                    return;
                }
            });
            if (!affiliation_flag) {
                $("#submit_btn").removeClass("green_btn");
                $("#submit_btn").addClass("gray_btn");
                console.log("b");
                return;
            }

            var add_co_other_position_check = $(".add_co_other_position_check" + i).is(":checked");
            var add_co_other_position = $(".add_co_other_position" + i).val();
            var add_co_other_position_len = add_co_other_position.trim().length;
            add_co_other_position = (typeof(add_co_other_position) != "undefined") ? add_co_other_position : null;

            if (add_co_other_position_check == true) {
                if (!add_co_other_position || add_co_other_position_len < 0) {
                    $("#submit_btn").removeClass("green_btn");
                    $("#submit_btn").addClass("gray_btn");
                    console.log("bd");
                    return;
                }
            }

            var add_nation_no = $("select[name=add_co_nation_no" + i + "]").val();

            var add_first_name = $("input[name=add_co_first_name" + i + "]").val();
            var add_first_name_len = add_first_name.trim().length;
            add_first_name = (typeof(add_first_name) != "undefined") ? add_first_name : null;

            var add_last_name = $("input[name=add_co_last_name" + i + "]").val();
            var add_last_name_len = add_last_name.trim().length;
            add_last_name = (typeof(add_last_name) != "undefined") ? add_last_name : null;

            //var add_city = $("input[name=add_co_city"+i+"]").val();
            //var add_city_len = add_city.trim().length;
            //add_city = (typeof(add_city) != "undefined") ? add_city : null;

            /*var add_affiliation = $("input[name=add_co_affiliation"+i+"]").val();
            var add_affiliation_len = add_affiliation.trim().length;
            add_affiliation = (typeof(add_affiliation) != "undefined") ? add_affiliation : null;*/

            var add_email = $("input[name=add_co_email" + i + "]").val();
            var add_email_len = add_email.trim().length;
            add_email = (typeof(add_email) != "undefined") ? add_email : null;

            var add_phone = $("input[name=add_co_phone" + i + "]").val();
            var add_phone_len = add_phone.trim().length;
            add_phone = (typeof(add_phone) != "undefined") ? add_phone : null;


            //if(!add_city || add_city_len < 0) {
            //	$("#submit_btn").removeClass("green_btn");
            //	$("#submit_btn").addClass("gray_btn");
            //	console.log(i+"1");
            //	return;
            //}
            if (add_nation_no == "") {
                $("#submit_btn").removeClass("green_btn");
                $("#submit_btn").addClass("gray_btn");
                console.log(i + "2");
                return;
            }
            if (!add_first_name || add_first_name_len < 0) {
                $("#submit_btn").removeClass("green_btn");
                $("#submit_btn").addClass("gray_btn");
                console.log(i + "3");
                return;
            }
            if (!add_last_name || add_last_name_len < 0) {
                $("#submit_btn").removeClass("green_btn");
                $("#submit_btn").addClass("gray_btn");
                console.log(i + "4");
                return;
            }
            /*if(!add_affiliation || add_affiliation_len < 0) {
            	$("#submit_btn").removeClass("green_btn");
            	$("#submit_btn").addClass("gray_btn");
            	console.log(i+"5");
            	return;
            }*/
            if (!add_email || add_email_len < 0) {
                $("#submit_btn").removeClass("green_btn");
                $("#submit_btn").addClass("gray_btn");
                console.log(i + "6");
                return;
            }
            if (!add_phone || add_phone_len < 0) {
                $("#submit_btn").removeClass("green_btn");
                $("#submit_btn").addClass("gray_btn");
                console.log(i + "7");
                return;
            }
        }

    }

    $("#submit_btn").removeClass("gray_btn");
    $("#submit_btn").addClass("green_btn");

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
            _this.val(first_name.trim());
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
<?php
}

include_once('./include/footer.php');
?>