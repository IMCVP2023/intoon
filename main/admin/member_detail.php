<?php
include_once('./include/head.php');
include_once('./include/header.php');

if($admin_permission["auth_account_member"] == 0){
    echo '<script>alert("권한이 없습니다.");history.back();</script>';
}

$member_idx =$_GET["idx"];

$nation_list = get_data($_nation_query);

if($member_idx) {
    $member_detail_query =	"
									SELECT
										email, first_name, last_name, nation_no, affiliation, phone, licence_number, department, DATE_FORMAT(register_date, '%y-%m-%d') AS register_date,
										first_name_kor, last_name_kor, affiliation_kor, department_kor, title, title_option, telephone, ksola_member_status,
										(
											CASE
												WHEN ksola_member_status = 0 THEN '비회원'
												WHEN ksola_member_status = 1 THEN '정회원'
												WHEN ksola_member_status = 2 THEN '평생회원'
												WHEN ksola_member_status = 3 THEN '인터넷회원'
												WHEN ksola_member_status IS NULL THEN '비회원'
											END
										) AS ksola_member_type,
										date_of_birth
									FROM member
									WHERE idx = {$member_idx};
								";
    $member_info = sql_fetch($member_detail_query);
}

$title = isset($member_info["title"]) ? $member_info["title"] : "";
$title_option = isset($member_info["title_option"]) ? $member_info["title_option"] : "";
$email = isset($member_info["email"]) ? $member_info["email"] : "";
$first_name = isset($member_info["first_name"]) ? $member_info["first_name"] : "";
$last_name = isset($member_info["last_name"]) ? $member_info["last_name"] : "";
$first_name_kor = isset($member_info["first_name_kor"]) ? $member_info["first_name_kor"] : "";
$last_name_kor = isset($member_info["last_name_kor"]) ? $member_info["last_name_kor"] : "";
$nation_no = isset($member_info["nation_no"]) ? $member_info["nation_no"] : "";
$phone = isset($member_info["phone"]) ? $member_info["phone"] : "";
$affiliation = isset($member_info["affiliation"]) ? $member_info["affiliation"] : "";
$department = isset($member_info["department"]) ? $member_info["department"] : "";
$affiliation_kor = isset($member_info["affiliation_kor"]) ? $member_info["affiliation_kor"] : "";
$department_kor = isset($member_info["department_kor"]) ? $member_info["department_kor"] : "";
//$licence_number = isset($member_info["licence_number"]) ? $member_info["licence_number"] : "";
$ksola_member_type = isset($member_info["ksola_member_type"]) ? $member_info["ksola_member_type"] : "비회원";
$ksola_member_status = isset($member_info["ksola_member_status"]) ? $member_info["ksola_member_status"] : "0";
$register_date = isset($member_info["register_date"]) ? $member_info["register_date"] : "-";
$telephone = isset($member_info["telephone"]) ? $member_info["telephone"] : "";
$date_of_birth = isset($member_info["date_of_birth"]) ? $member_info["date_of_birth"] : "";

$nation_tel = "+82";
if($phone) {
    $_arr_phone = explode("-",$phone);
    $nation_phone = $_arr_phone[0];
    $phone = implode("-",array_splice($_arr_phone, 1));
}

if($telephone) {
    $_arr_tel = explode("-",$telephone);
    $nation_tel = $_arr_tel[0];
}

/* 23.05.12 HUBDNC NYM
 * 국적이 대한민국일 경우에 한국 이름, 부서, 소속 노출
*/
$is_hide = ($nation_no == 25) ? '' : 'hidden';

?>

    <section class="detail member_detail_page">
        <div class="container">
            <div class="title">
                <h1 class="font_title">일반회원</h1>
            </div>
            <div class="contwrap has_fixed_title">
                <?php
                if($member_idx) {
                    include_once("./include/member_nav.php");
                }
                ?>
                <form name="member_detail_form">
                    <table>
                        <colgroup>
                            <col width="10%">
                            <col width="40%">
                            <col width="10%">
                            <col width="40%">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>ID(Email)</th>
                            <td><input type="text" name="email" value="<?=$email?>"></td>
                            <th>Password</th>
                            <td class="input_wrap"><input type="password" name="<?=$member_idx ? "" : "password"?>" id="password" class="width_30 passwords" placeholder="비밀번호"><input type="password"  name="<?=$member_idx ? "" : "re_password"?>" id="re_password" class="width_30 passwords" placeholder="비밀번호 확인"></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><input type="text" name="first_name" value="<?=$first_name?>"></td>
                            <th>Last Name</th>
                            <td><input type="text"name="last_name" value="<?=$last_name?>"></td>
                        </tr>
                        <tr class="input_kor <?= $is_hide ?>">
                            <th>이름</th>
                            <td><input type="text" name="first_name_kor" value="<?=$first_name_kor?>"></td>
                            <th>성</th>
                            <td><input type="text"name="last_name_kor" value="<?=$last_name_kor?>"></td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td colspan="3">
                                <ul class="half_ul">
                                    <li>
                                        <div class="max_normal">
                                            <select name="title" id="title" class="title_select">
                                                <option value="0" <?= (($title_option == 0) ? 'selected' : ''); ?>>Professor</option>
                                                <option value="1" <?= (($title_option == 1) ? 'selected' : ''); ?>>Dr.</option>
                                                <option value="2" <?= (($title_option == 2) ? 'selected' : ''); ?>>Mr.</option>
                                                <option value="3" <?= (($title_option == 3) ? 'selected' : ''); ?>>Ms.</option>
                                                <option value="4" <?= (($title_option == 4) ? 'selected' : ''); ?>>Others</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <input type="text" class="<?= ($title_option == 4) ? '' : 'hidden'; ?>" id="title_input" name="title_input" value="<?= ($title_option == 4) ? $title : ''; ?>">
                                    </li>
                                </ul>
                                <!--
                                <div class="max_normal">
                                    <select name="title" id="title" class="title_select">
                                        <option value="Professor">Professor</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <input type="text" id="title_input" name="title_input">
                                -->
                            </td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td colspan="3">
                                <select name="nation_no">
                                    <option value="" selected hidden>Choose </option>
                                    <?php
                                    foreach($nation_list as $list) {
                                        $selected = $nation_no == $list["idx"] ? "selected" : "";
                                        echo  '<option value="'.$list["idx"].'"'.$selected.'>'.$list["nation_ko"].'</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Mobile Phone Number</th>
                            <td>
                                <ul class="half_ul">
                                    <li>
                                        <div class="max_normal">
                                            <input class="numbers" name="nation_tel" type="text" maxlength="60" value="<?= $nation_phone ?>" readonly>
                                        </div>
                                    </li>
                                    <li>
                                        <input name="phone" id="phone" type="text" maxlength="15" value="<?= $phone ?>">
                                    </li>
                                </ul>
                            </td>
                            <th>Telephone Number</th>
                            <td>
                                <ul class="half_ul">
                                    <li>
                                        <input class="tel_number tel_phone" name="nation_tel" type="text" maxlength="60" value="<?= $nation_tel ?>" readonly>
                                    </li>
                                    <li>
                                        <input class="tel_numbers tel_phone" name="telephone1" type="text" maxlength="60" value="<?= $_arr_tel[1] ?>">
                                    </li>
                                    <li>
                                        <input class="tel_numbers tel_phone2" name="telephone2" type="text" maxlength="60" value="<?= $_arr_tel[2] ?>">
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>affiliation</th>
                            <td><input type="text" name="affiliation" value="<?=$affiliation?>"></td>
                            <th>Department</th>
                            <td><input type="text" name="department" value="<?=$department?>" placeholder=""></td>
                        </tr>
                        <tr class="input_kor <?= $is_hide ?>">
                            <th>소속</th>
                            <td><input type="text" name="affiliation_kor" value="<?=$affiliation_kor?>"></td>
                            <th>부서</th>
                            <td><input type="text" name="department_kor" value="<?=$department_kor?>" placeholder=""></td>
                        </tr>
                        <tr>
                            <th>KSCP 회원 여부</th>
                            <td>
                                <div id="ksola_member_status" class="<?= $is_hide ?>">
                                    <input <?= (!$ksola_member_status ? "" : "checked") ?> type="radio" class="new_radio" name="user" id="user1" value="1">
                                    <label for="user1"><i></i>회원</label>
                                    <input <?= (!$ksola_member_status ? "checked" : "") ?> type="radio" class="new_radio" name="user" id="user2" value="0">
                                    <label for="user2"><i></i>비회원</label>
                                </div>
                                <span class="<?= $is_hide == "" ? "hidden" : "" ?>"><?= $ksola_member_type ?></span>
                            </td>
                            <th>생년월일</th>
                            <td>
                                <input name="date_of_birth" pattern="^[0-9]+$" type="text" placeholder="dd-mm-yyyy" id="datepicker" value="<?= $date_of_birth ?>" onkeyup="birthChk(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td colspan="3"><?=$register_date?></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <div class="btn_wrap">
                    <button type="button" class="border_btn" onclick="location.href='./member_list.php'">목록</button>
                    <?php
                    if ($admin_permission["auth_account_member"] > 1) {
                        if($member_idx) {
                            ?>
                            <button type="button" class="btn gray_btn delete_btn">삭제</button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn save_btn">저장</button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" name="ori_email" value="<?= $email ?>">
    <script>
        $(document).ready(function(){
            $("#user1").change(function(){
                if($("#user1").prop('checked') == true) {
                    $(".ksola_signup").addClass("on");
                }
            });
            $("#user2").change(function(){
                if($("#user2").prop('checked') == true) {
                    $(".ksola_signup").removeClass("on");
                }
            });

            $("input[name=kor_id]").on("change", function() {
                var _this = $(this);
                _this.val();
                kor_api_check("kor_id", _this.val());
            });
            $("input[name=kor_pw]").on("change", function() {
                var _this = $(this);
                _this.val();
                kor_api_check("kor_password", _this.val());
            });

            $(".not_checkbox").click(function(){
                var _this =$(this).is(":checked");
                if(_this == true) {
                    $(this).next().next().attr("disabled", true);
                    $(this).next().next().val("");
                } else {
                    $(this).next().next().attr("disabled", false);
                }
            });

            $(".tab_wrap").children("li").eq(0).addClass("active");

            //비밀번호 띄어쓰기 막기
            $(".passwords").on("keyup", function(){
                $(this).val($(this).val().replace(/[\s]/g,""));
            });

            //이메일 중복 검증
            $("input[name=email]").on("change", function(){
                var email = $(this).val();
                var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;

                if(email.match(regExp) != null) {
                    $.ajax({
                        url : "../ajax/client/ajax_member.php",
                        type : "POST",
                        data :  {
                            flag : "id_check",
                            email : email
                        },
                        dataType : "JSON",
                        success : function(res){
                            if(res.code == 200 || ($("[name=ori_email]").val() == email)) {
                            } else if(res.code == 400) {
                                alert("이미 사용 중인 이메일입니다.");
                                $("input[name=email]").val("").focus();
                                return;
                            } else {
                                alert("일시적으로 요청이 거절되었습니다.")
                                return;
                            }
                        }
                    });
                } else {
                    alert("올바르지 않은 이메일 형식입니다.");
                    $(this).val("").focus();
                    return;
                }
            });

            //이름 유효성
            $("input[name=first_name]").on("change keyup", function(key){
                var pattern_eng = /[^a-zA-Z\s]/gi;
                var _this = $(this);
                if(key.keyCode != 8) {
                    var first_name = _this.val().replace(pattern_eng, '');
                    _this.val(first_name);
                }
            });

            $("input[name=last_name]").on("change keyup", function(key){
                var pattern_eng = /[^a-zA-Z\s]/gi;
                var _this = $(this);
                if(key.keyCode != 8) {
                    var first_name = _this.val().replace(pattern_eng, '');
                    _this.val(first_name);
                }
            });

            //소속 유효성
            $("input[name=affiliation]").on("change keyup", function(key){
                var pattern_eng = /[^a-zA-Z||*-_@!#^&||0-9\s]/gi;
                var _this = $(this);
                if(key.keyCode != 8) {
                    var first_name = _this.val().replace(pattern_eng, '');
                    _this.val(first_name);
                }
            });

            $("input[name=department]").on("change keyup", function(key){
                var pattern_eng = /[^a-zA-Z||*-_@!#^&||0-9\s]/gi;
                var _this = $(this);
                if(key.keyCode != 8) {
                    var first_name = _this.val().replace(pattern_eng, '');
                    _this.val(first_name);
                }
            });

            $("input[name=first_name_kor]").keyup(function (event) {
                regexp = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;
                v = $(this).val();
                if (regexp.test(v)) {
                    //alert("한글만 입력가능 합니다.");
                    $(this).val(v.replace(regexp, ''));
                }
            });

            $("input[name=last_name_kor]").keyup(function (event) {
                regexp = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;
                v = $(this).val();
                if (regexp.test(v)) {
                    //alert("한글만 입력가능 합니다.");
                    $(this).val(v.replace(regexp, ''));
                }
            });

            $("input[name=affiliation_kor]").keyup(function (event) {
                regexp = /[a-z0-9]|[\[\]{}()<>?|`~$%+=,.;:\"'\\]/g;
                v = $(this).val();
                if (regexp.test(v)) {
                    //alert("한글만 입력가능 합니다.");
                    $(this).val(v.replace(regexp, ''));
                }
            });

            $("input[name=department_kor]").keyup(function (event) {
                regexp = /[a-z0-9]|[\[\]{}()<>?|`~$%+=,.;:\"'\\]/g;
                //regexp = /^[가-힣\s]+$/;
                v = $(this).val();
                if (regexp.test(v)) {
                    //alert("한글만 입력가능 합니다.");
                    $(this).val(v.replace(regexp, ''));
                }
            });

            //비밀번호 변경시 인풋체크 활성화
            $("#password, #re_password").on("change", function(){
                if(!$(this).attr("name")) {
                    $(this).attr("name", $(this).attr("id"));
                }
            });

            //국가 선택 시 국가번호 추가
            $("select[name=nation_no]").on("change", function(){
                var nation = $(this).val();
                $.ajax({
                    url : "../ajax/ajax_nation.php",
                    type : "POST",
                    data : {
                        flag : "nation_tel",
                        nation : nation
                    },
                    dataType : "JSON",
                    success : function(res) {
                        if(res.code == 200) {
                            $("[name=nation_tel]").val(res.tel);
                            $("#user2").click();
                            if (nation == 25) {
                                $(".input_kor").removeClass("hidden");
                                $("#ksola_member_status").removeClass("hidden").siblings().addClass("hidden");
                            } else {
                                $(".input_kor").addClass("hidden");
                                $("#ksola_member_status").addClass("hidden").siblings().removeClass("hidden");
                            }
                        }
                    }
                });
            });

            // Title 변경 시
            $("select[name=title]").on("change", function(){
                var _target_val = parseInt($(this).val());
                console.log(_target_val)
                if (_target_val == 4) {
                    $("[name=title_input]").val("");
                    $("[name=title_input]").removeClass("hidden");
                } else {
                    $("[name=title_input]").addClass("hidden");
                }
            });

            //삭제
            $(".delete_btn").on("click", function() {
                var member_idx = "<?=$member_idx?>";
                if(confirm("해당 회원을 삭제하시겠습니까?")) {
                    $.ajax({
                        url : "../ajax/client/ajax_member.php",
                        type : "POST",
                        data : {
                            flag : "delete",
                            idx : member_idx
                        },
                        dataType : "JSON",
                        success : function(res) {
                            if(res.code == 200) {
                                alert("회원이 삭제되었습니다.");
                                window.location.replace("./member_list.php");
                            } else if(res.code == 400) {
                                alert("회원 삭제에 실패하였습니다.");
                                return false;
                            } else {
                                alert("일시적으로 요청이 거절되었습니다.");
                                return false;
                            }
                        }
                    });
                }
            });

            $(".save_btn").on("click", function(){
                var member_idx = "<?=$member_idx?>";
                var flag = member_idx != "" ? "update" : "signup";

                var process = inputCheck();

                var status = process.status;
                var data = process.data;

                // console.log(data['nation_tel']);
                // console.log(data['phone']);

                if (data['phone'] != "") {
                    data['phone'] = data['nation_tel'] + '-' + data['phone'];
                }

                if (data['telephone1'] != "" && data['telephone2'] != "") {
                    data['telephone'] = data['nation_tel'] + '-' + data['telephone1'] + '-' + data['telephone2'];
                }

                /*
                var ksola_member_check = $("input[name=ksola_member_check]").val();
                var ksola_member_type = $("input[name=ksola_member_type]").val();

                if(ksola_member_type == "인터넷회원"){
                    ksola_member_status = 3;
                }else if(ksola_member_type == "평생회원"){
                    ksola_member_status = 2;
                }else if(ksola_member_type == "정회원"){
                    ksola_member_status = 1;
                }else {
                    ksola_member_status = 0;
                }
                */

                // 비회원으로 저장
                /*
                if($("#user2:checked").length > 0) {
                    ksola_member_status = 0;
                    ksola_member_check = "";
                }

                data['ksola_member_check'] = ksola_member_check;
                */
                data['ksola_member_status'] = $("[name=user]:checked").val();

                if(status) {
                    if(confirm("저장하시겠습니까?")) {
                        $.ajax({
                            url : "/main/ajax/client/ajax_member.php",
                            type : "POST",
                            data : {
                                flag : flag,
                                idx : member_idx,
                                register_type : "admin",
                                data : data
                            },
                            dataType : "JSON",
                            success : function(res) {
                                if(res.code == 200) {
                                    alert("저장이 완료되었습니다.");
                                    window.location.reload();
                                } else if(res.code == 400){
                                    alert("저장에 실패하였습니다.");
                                    return false;
                                } else {
                                    alert("일시적으로 요청이 거절되었습니다.");
                                    return false;
                                }
                            }
                        });
                    }
                }
            });
        });

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

        function inputCheck() {
            var data = {};
            var formData = $("form[name=member_detail_form]").serializeArray();

            // 23.05.12 HUBDNC_NYM 대한민국 국적일 때만 한국이름 체크
            var nationNo = parseInt($("select[name=nation_no] :selected").val());
            // 23.05.12 HUBDNC_NYM Title -> Others 선택시
            var titleNo = parseInt($("select[name=title] :selected").val());

            var inputCheck2 = true;

            console.log(formData);

            $.each(formData, function(key, value){
                var ok = value["name"];
                var ov = value["value"];

                if(ov == "" || ov == undefined || ov == null) {
                    if(ok == "email" || ok == "password" || ok == "re_password" || ok == "first_name" || ok == "last_name" || ok == "first_name_kor" || ok == "last_name_kor" || ok == "phone" || ok == "affiliation" || ok == "department" || ok == "affiliation_kor" || ok == "department_kor" || ok == "date_of_birth") {
                        if(ok == "email") {
                            alert("이메일을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "password") {
                            alert("비밀번호를 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "re_password") {
                            alert("비밀번호 확인을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "first_name") {
                            alert("영문 이름을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "last_name") {
                            alert("영문 이름(성)을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if((nationNo == 25) && (ok == "first_name_kor")) {
                            alert("국문 이름을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if((nationNo == 25) && (ok == "last_name_kor")) {
                            alert("국문 이름(성)을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "phone") {
                            alert("핸드폰 번호를 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "affiliation") {
                            alert("영문 소속을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "department") {
                            alert("영문 부서를 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if((nationNo == 25) && (ok == "affiliation_kor")) {
                            alert("국문 소속을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if((nationNo == 25) && (ok == "department_kor")) {
                            alert("국문 부서를 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        } else if(ok == "date_of_birth") {
                            alert("생년월일을 입력하지 않으셨습니다.");
                            inputCheck2 = false;
                            return false;
                        }

                        $('input[name="'+ok+'"]').focus();
                    }
                } else {
                    if(ok== "re_password" && ov != $("input[name=password]").val()) {
                        alert("비밀번호가 일치하지 않습니다.");
                        $("input[name="+ok+"]").focus();
                        inputCheck2 = false;
                        return false;
                    }
                }

                data[ok] = ov;
            });

            if(inputCheck2) {
                var result_birth = $("[name=date_of_birth]").val();
                if(!$("select[name=nation_no]").val()) {
                    alert("국가를 선택하지 않으셨습니다.");
                    inputCheck2 = false;
                    return false;
                }

                else if ((titleNo == 4) && !$("[name=title_input]").val()) {
                    alert("Title입력하지 않으셨습니다.");
                }

                else if (result_birth) {
                    var regex = /[^0123456789-]/g;
                    if(regex.test(result_birth)){
                        alert("생년월일은 숫자만 입력이 가능합니다");
                        return;
                    }
                    var regex2 = /^(\d{2})-(\d{2})-(\d{4})$/;
                    if(!regex2.test(result_birth)){
                        alert("생년월일 포맷이 일치 하지 않습니다.\n ex) 01-01-1999");
                        return;
                    }
                }
            }

            var licence_number_bool = $("input[name=licence_number2]").is(":checked");
            data.licence_number_bool = licence_number_bool;

            return {
                data : data,
                status : inputCheck2
            }
        }


        function kor_api() {
            var kor_id = $("input[name=kor_id]").val().trim();
            var kor_pw = $("input[name=kor_pw]").val().trim();
            //제 3자 개인정보 수집에 동의 여부
            var privacy = $("#privacy").is(":checked");

            if(!kor_id) {
                alert("Invalid id");
                //$(".red_api").eq(0).html("format_id");
                return;
            }
            if(!kor_pw) {
                alert("Invalid password");
                //$(".red_api").eq(0).html("format_password");
                return;
            }

            if(privacy == false) {
                alert("Please agree to the collection of personal information.");
                $(".red_api").eq(0).html("Please agree to the collection of personal information.");
                return;
            }

            var data = {
                'id' : kor_id,
                'password' : kor_pw
            };

            $.ajax({
                url			: "/main/signup_api.php",
                type		: "POST",
                data		: data,
                dataType	: "JSON",
                success		: success,
                fail		: fail,
                error		: error
            });

            function success(res) {
                var kor_sign = JSON.parse(res.value);
                console.log(kor_sign);
                var user_row = kor_sign.user_row;

                if(kor_sign.code == "N1") {
                    alert("아이디를 입력해주세요.");
                } else if(kor_sign.code == "N2") {
                    alert("비밀번호를 입력해주세요.");
                } else if(kor_sign.code == "N3") {
                    alert("가입되지 않은 아이디입니다.");
                } else if(kor_sign.code == "N4") {
                    alert("잘못된 비밀번호 입니다.");
                } else if(kor_sign.code == "N5") {
                    alert("탈퇴된 아이디 입니다.");
                } else if(kor_sign.code == "N7") {
                    alert("이미 인증된 계정입니다.");
                    $("[name=kor_id]").val("");
                    $("[name=kor_pw]").val("");
                    $("#privacy").prop("checked", false);
                    $("[name=kor_id]").focus();
                } else if(kor_sign.code == "N6") {
                    alert("회원님은 대한비만학회 " + user_row.user_type + " 입니다");

                    $("input[name=ksola_member_type]").val(user_row.user_type);
                    $("input[name=ksola_member_check]").val(user_row.id);
                }
            }
            function fail(res) {
                alert("Failed.\nPlease try again later.");
                return false;
            }
            function error(res) {
                alert("An error has occurred. \nPlease try again later.");
                return false;
            }
        }
        function kor_api_check(name, value) {
            var first_name = value;
            var first_name_len = first_name.trim().length;
            first_name = (typeof(first_name) != "undefined") ? first_name : null;

            if(!first_name || first_name_len <= 0) {
                alert("Invalid_"+name);
            }
        }
    </script>
<?php include_once('./include/footer.php');?>