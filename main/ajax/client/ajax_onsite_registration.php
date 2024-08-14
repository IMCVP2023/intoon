<?php include_once("../../common/common.php");?>
<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

if($_POST["flag"] === "onsite") {
    $data = isset($_POST["data"]) ? $_POST["data"] : "";

    // ksso 회원 상태(0:비회원, 1:정회원, 2:평생회원)
    $ksso_member_status = $data["ksso_member_status"] ?? "0";
    // ksso 회원 id
    $ksso_member_check = $data["ksso_member_check"] ?? "";

    // member
    $nation_no = $data["nation_no"] ?? "";
    $email = $data["email"] ?? "";
    $password = $data["password"] ?? "";
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $first_name = $data["first_name"] ?? "";
    $first_name_kor = $data["first_name_kor"] ?? "";
    $last_name = $data["last_name"] ?? "";
    $last_name_kor = $data["last_name_kor"] ?? "";
    $affiliation = $data["affiliation"] ?? "";
    $affiliation_kor = $data["affiliation_kor"] ?? "";
    $department = $data["department"] ?? "";
    $department_kor = $data["department_kor"] ?? "";
    $phone = $data["phone"] ?? "";
    $date_of_birth = $data["date_of_birth"] ?? "";

    // registration
    $participation_type = $data["participation_type"] ?? "";

    switch($participation_type){
        case "Committee":
            $attendance_type = 0;
            break;
        case "Speaker":
            $attendance_type = 1;
            break;
        case "Chairperson":
            $attendance_type = 2;
            break;
        case "Panel":
            $attendance_type = 3;
            break;
        case "Participants":
            $attendance_type = 4;
            break;
        case "Sponsor":
            $attendance_type = 5;
            break;
    }
    $occupation = $data["occupation"] ?? "";
    $occupation_other_type = $data["occupation_other_type"] ?? "";
    $member_type = $data["member_type"] ?? "";
    $member_other_type = $data["member_other_type"] ?? "";
    $is_score = $data["is_score"] ?? "";
    $licence_number = $data["licence_number"] ?? "";
    $nutritionist_number = $data["nutritionist_number"] ?? "";
    $dietitian_number = $data["dietitian_number"] ?? "";

    $day1_luncheon_yn = $data["day1_luncheon_yn"] !== null ? "Y" : "N";
    $day1_satellite_yn    = $data["day1_satellite_yn"] !== null ? "Y" : "N";
    $day2_breakfast_yn     = $data["day2_breakfast_yn"] !== null ? "Y" : "N";
    $day2_luncheon_yn    = $data["day2_luncheon_yn"] !== null ? "Y" : "N";
    $day2_satellite_yn     = $data["day2_satellite_yn"] !== null ? "Y" : "N";

    $special_request = $data["special_request"] ?? "";

    $conference_info = implode("*", $data["conference_info_arr"]);
    $price = $data["price"] ?? "";
    $fee= str_replace(",","",$price);

    $insert_member_query =	"
                                INSERT member
                                SET
                                    nation_no = {$nation_no},
                                    email = '{$email}',
                                    password = '{$password_hash}',
                                    last_name = '{$last_name}',
                                    first_name = '{$first_name}',
                                    affiliation = '{$affiliation}',
                                    department = '{$department}',
                                    phone = '{$phone}', 
                                    date_of_birth = '{$date_of_birth}',
                                    terms_access = 'Y',
                                    terms_access_date = NOW(),
                                    privacy_access = 'Y',
                                    privacy_access_date = NOW(),
                                    email_certified = 'Y',
                                    ksola_member_status = '{$ksso_member_status}'
                            ";

    // 국내 일 때
    if($nation_no == 25) {
        $insert_member_query .= ", last_name_kor = '{$last_name_kor}' ";
        $insert_member_query .= ", first_name_kor = '{$first_name_kor}' ";
        $insert_member_query .= ", affiliation_kor = '{$affiliation_kor}' ";
        $insert_member_query .= ", department_kor = '{$department_kor}' ";
    }

    if($ksso_member_status == 1 || $ksso_member_status == 2) {
        $insert_member_query .= ", ksola_member_check = '{$ksso_member_check}' ";
    }

    sql_query($insert_member_query);
    $insert_member =  sql_insert_id();

    $member_idx = $insert_member;

    $insert_registration_query =	"
                                        INSERT request_registration
                                        SET
                                            status = 5,
                                            attendance_type = '{$attendance_type}',
                                            is_score = '{$is_score}',
                                            ksso_member_status = '{$ksso_member_status}',
                                            email = '{$email}',
                                            nation_no = '{$nation_no}',
                                            last_name = '{$last_name}',
                                            first_name = '{$first_name}',
                                            phone = '{$phone}',
                                            affiliation = '{$affiliation}',
                                            department = '{$department}',
                                            member_type = '{$member_type}',
                                            occupation_type = '{$occupation}',
                                            register_path = 'onsite',
                                            register = '{$member_idx}',
                                            conference_info = '{$conference_info}',
                                            day1_luncheon_yn = '{$day1_luncheon_yn}',
                                            day1_satellite_yn = '{$day1_satellite_yn}',
                                            day2_breakfast_yn = '{$day2_breakfast_yn}',
                                            day2_luncheon_yn = '{$day2_luncheon_yn}',
                                            day2_satellite_yn = '{$day2_satellite_yn}',
                                            special_request_food = {$special_request},
                                            payment_methods = 2,
                                            price = '{$fee}'
                                    ";

    if(!empty($member_other_type)){
        $insert_registration_query .= ", member_other_type = '{$member_other_type}' ";
    } else {
        $insert_registration_query .= ", member_other_type = NULL ";
    }

    if(!empty($occupation_other_type)){
        $insert_registration_query .= ", occupation_other_type = '{$occupation_other_type}' ";
    } else {
        $insert_registration_query .= ", occupation_other_type = NULL ";
    }

    if(!empty($licence_number)){
        $insert_registration_query .= ", licence_number = '{$licence_number}' ";
    }
    if(!empty($nutritionist_number)){
        $insert_registration_query .= ", nutritionist_number = '{$nutritionist_number}' ";
    }
    if(!empty($dietitian_number)){
        $insert_registration_query .= ", dietitian_number = '{$dietitian_number}' ";
    }

    $insert_registration = sql_query($insert_registration_query);

    // reg2. users insert 230822
    $select_registration_sql = "
                                SELECT rr.idx, email, nation_no, nation_en
                                FROM request_registration rr
                                JOIN nation n ON n.idx = rr.nation_no
                                WHERE email = '{$email}'
                                ";
    $users_registration = sql_fetch($select_registration_sql);
    $registration_idx = $users_registration['idx'];
    $nation_eng = $users_registration['nation_en'];
    $registration_no = 'ICOMES2023-'.$registration_idx;
    $name_kor = $last_name_kor.$first_name_kor;

    $ksso_member_status_text="";
    switch($ksso_member_status) {
        case 0:
            $ksso_member_status_text = "비회원";
            break;
        case 1:
            $ksso_member_status_text = "정회원";
            break;
        case 2:
            $ksso_member_status_text = "평생회원";
            break;
    }

    $is_score_text="";
    switch($is_score) {
        case 0 :
            $is_score_text = "미신청";
            break;
        case 1 :
            $is_score_text = "신청";
            break;
    }

    $special_request_text="";
    switch($special_request){
        case 0 :
            $special_request_text = "Not Applicable";
            break;
        case 1 :
            $special_request_text = "Vegetarian";
            break;
        case 2 :
            $special_request_text = "Halal";
            break;
    }

    $insert_reg_user_sql = "
                        INSERT reg2.users
                        SET
                            registration_no = '{$registration_no}',
                            first_name = '{$first_name}',
                            last_name = '{$last_name}',
                            email = '{$email}',
                            nation = '{$nation_eng}',
                            phone = '{$phone}',
                            affiliation = '{$affiliation}',
                            department = '{$department}',
                            org_nametag = '{$affiliation}',
                            attendance_type = '{$participation_type}',
                            member_type = '{$member_type}',
                            occupation_type = '{$occupation}',
                            ksso_member_status = '{$ksso_member_status_text}',
                            fee = '{$fee}',
                            is_score = '{$is_score_text}',
                            conference_info = '{$conference_info}',
                            day1_luncheon_yn = '{$day1_luncheon_yn}',
                            day1_satellite_yn = '{$day1_satellite_yn}',
                            day2_breakfast_yn = '{$day2_breakfast_yn}',
                            day2_luncheon_yn = '{$day2_luncheon_yn}',
                            day2_satellite_yn = '{$day2_satellite_yn}',
                            special_request_food = '{$special_request_text}',
                            date_of_birth = '{$date_of_birth}'
                    ";

    if($nation_no == 25) {
        $insert_reg_user_sql .= ", name_kor = '{$name_kor}' ";
        $insert_reg_user_sql .= ", affiliation_kor = '{$affiliation_kor}' ";
        $insert_reg_user_sql .= ", department_kor = '{$department_kor}' ";
    }

    if(!empty($licence_number)){
        $insert_reg_user_sql .= ", licence_number = '{$licence_number}' ";
    }
    if(!empty($nutritionist_number)){
        $insert_reg_user_sql .= ", nutritionist_number = '{$nutritionist_number}' ";
    }
    if(!empty($dietitian_number)){
        $insert_reg_user_sql .= ", dietitian_number = '{$dietitian_number}' ";
    }

    if(!empty($member_other_type)){
        $insert_reg_user_sql .= ", member_other_type = '{$member_other_type}' ";
    } else {
        $insert_reg_user_sql .= ", member_other_type = NULL ";
    }

    if(!empty($occupation_other_type)){
        $insert_reg_user_sql .= ", occupation_other_type = '{$occupation_other_type}' ";
    } else {
        $insert_reg_user_sql .= ", occupation_other_type = NULL ";
    }

    $insert_reg_user = sql_query($insert_reg_user_sql);

    if($insert_reg_user) {
        $res = [
            'code' => 200,
            'msg' => "onsite_registration success"
        ];
        echo json_encode($res);
    } else {
        $res = [
            'code' => 400,
            'msg' => "onsite_registration error"
        ];
        echo json_encode($res);
    }
    exit;
} else if($_POST["flag"] === "promotion_onsite") {
    $data = isset($_POST["data"]) ? $_POST["data"] : "";

    // ksso 회원 상태(0:비회원, 1:정회원, 2:평생회원)
    $ksso_member_status = $data["ksso_member_status"] ?? "0";
    // ksso 회원 id
    $ksso_member_check = $data["ksso_member_check"] ?? "";

    // member
    $nation_no = $data["nation_no"] ?? "";
    $email = $data["email"] ?? "";
    $password = $data["password"] ?? "";
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $first_name = $data["first_name"] ?? "";
    $first_name_kor = $data["first_name_kor"] ?? "";
    $last_name = $data["last_name"] ?? "";
    $last_name_kor = $data["last_name_kor"] ?? "";
    $affiliation = $data["affiliation"] ?? "";
    $affiliation_kor = $data["affiliation_kor"] ?? "";
    $department = $data["department"] ?? "";
    $department_kor = $data["department_kor"] ?? "";
    $phone = $data["phone"] ?? "";
    $date_of_birth = $data["date_of_birth"] ?? "";

    // registration
    $participation_type = $data["participation_type"] ?? "";

    switch($participation_type){
        case "Committee":
            $attendance_type = 0;
            break;
        case "Speaker":
            $attendance_type = 1;
            break;
        case "Chairperson":
            $attendance_type = 2;
            break;
        case "Panel":
            $attendance_type = 3;
            break;
        case "Participants":
            $attendance_type = 4;
            break;
        case "Sponsor":
            $attendance_type = 5;
            break;
    }

    $member_type = $data["member_type"] ?? "";
    $member_other_type = $data["member_other_type"] ?? "";

    $is_score = $data["is_score"] ?? "";
    $licence_number = $data["licence_number"] ?? "";
    $specialty_number = $data["specialty_number"] ?? "";

    $day1_luncheon_yn = $data["day1_luncheon_yn"] !== null ? "Y" : "N";
    $day1_satellite_yn    = $data["day1_satellite_yn"] !== null ? "Y" : "N";
    $day2_breakfast_yn     = $data["day2_breakfast_yn"] !== null ? "Y" : "N";
    $day2_luncheon_yn    = $data["day2_luncheon_yn"] !== null ? "Y" : "N";
    $day2_satellite_yn     = $data["day2_satellite_yn"] !== null ? "Y" : "N";

    //sujeong / promotion code 
    $promotion_code = $data["promotion_code"] ?? "";
    $payment_methods = $data["payment_methods"] ?? "";

    $special_request = $data["special_request"] ?? "";

    $conference_info = implode("*", $data["conference_info_arr"]);
    $price = $data["price"] ?? "";
    $fee= str_replace(",","",$price);

    $insert_member_query =	"
                                INSERT member
                                SET
                                    nation_no = {$nation_no},
                                    email = '{$email}',
                                    password = '{$password_hash}',
                                    last_name = '{$last_name}',
                                    first_name = '{$first_name}',
                                    affiliation = '{$affiliation}',
                                    department = '{$department}',
                                    phone = '{$phone}', 
                                    date_of_birth = '{$date_of_birth}',
                                    terms_access = 'Y',
                                    terms_access_date = NOW(),
                                    privacy_access = 'Y',
                                    privacy_access_date = NOW(),
                                    email_certified = 'Y',
                                    ksola_member_status = '{$ksso_member_status}'
                            ";

    // 국내 일 때
    if($nation_no == 25) {
        $insert_member_query .= ", last_name_kor = '{$last_name_kor}' ";
        $insert_member_query .= ", first_name_kor = '{$first_name_kor}' ";
        $insert_member_query .= ", affiliation_kor = '{$affiliation_kor}' ";
        $insert_member_query .= ", department_kor = '{$department_kor}' ";
    }

    if($ksso_member_status == 1 || $ksso_member_status == 2) {
        $insert_member_query .= ", ksola_member_check = '{$ksso_member_check}' ";
    }

    sql_query($insert_member_query);
    $insert_member =  sql_insert_id();

    $member_idx = $insert_member;

    $insert_registration_query =	"
                                        INSERT request_registration
                                        SET
                                            status = 6,
                                            attendance_type = '{$attendance_type}',
                                            is_score = '{$is_score}',
                                            ksso_member_status = '{$ksso_member_status}',
                                            email = '{$email}',
                                            nation_no = '{$nation_no}',
                                            last_name = '{$last_name}',
                                            first_name = '{$first_name}',
                                            phone = '{$phone}',
                                            affiliation = '{$affiliation}',
                                            department = '{$department}',
                                            member_type = '{$member_type}',
                                            register = '{$member_idx}',
                                            conference_info = '{$conference_info}',
                                            day1_luncheon_yn = '{$day1_luncheon_yn}',
                                            day1_satellite_yn = '{$day1_satellite_yn}',
                                            day2_breakfast_yn = '{$day2_breakfast_yn}',
                                            day2_luncheon_yn = '{$day2_luncheon_yn}',
                                            day2_satellite_yn = '{$day2_satellite_yn}',
                                            special_request_food = {$special_request},
                                            payment_methods = '{$payment_methods}',
                                            promotion_code_number = '{$promotion_code}',
                                            price = '{$fee}'
                                    ";

    if(!empty($member_other_type)){
        $insert_registration_query .= ", member_other_type = '{$member_other_type}' ";
    } else {
        $insert_registration_query .= ", member_other_type = NULL ";
    }

    if(!empty($occupation_other_type)){
        $insert_registration_query .= ", occupation_other_type = '{$occupation_other_type}' ";
    } else {
        $insert_registration_query .= ", occupation_other_type = NULL ";
    }

    if(!empty($licence_number)){
        $insert_registration_query .= ", licence_number = '{$licence_number}' ";
    }
    if(!empty($nutritionist_number)){
        $insert_registration_query .= ", nutritionist_number = '{$nutritionist_number}' ";
    }
    if(!empty($dietitian_number)){
        $insert_registration_query .= ", dietitian_number = '{$dietitian_number}' ";
    }

    $insert_registration = sql_query($insert_registration_query);
    $insert_reg = sql_insert_id();

    $reg_idx = $insert_reg;

    if($insert_registration) {
        $res = [
            'code' => 200,
            'msg' => "onsite_registration success",
            'member_idx' => $member_idx,
            'reg_idx' => $reg_idx 
        ];
        echo json_encode($res);
    } else {
        $res = [
            'code' => 400,
            'msg' => "onsite_registration error"
        ];
        echo json_encode($res);
    }
    exit;
} else if($_POST["flag"] === "calc_fee"){

    $ksso_member_status = $_POST["ksso_member_status"];
    $category = $_POST["category"];
    $country = $_POST["country"] ?? "";

    $result = calcFee($ksso_member_status,$category, $country);

    if($result>=0) {
        $res = [
            code => 200,
            msg => "success",
            data => $result,
            country => $country
        ];
        echo json_encode($res);
        exit;

    } else {
        $res = [
            code => 400,
            msg => "error",
        ];
        echo json_encode($res);
        exit;

    }
}

function calcFee($ksso_member_status, $category, $country){

    // 카테고리별 상품금액 조회
    $calc_fee_query =	"
								SELECT
									on_member_usd, on_guest_usd, on_member_krw, on_guest_krw
								FROM info_event_price
								WHERE type_en = '{$category}';
							";

    $calc_fee = sql_fetch($calc_fee_query);

    if($country == 25){
        if($ksso_member_status >= 1){
            $result = $calc_fee["on_member_krw"];
        }else{
            $result = $calc_fee["on_guest_krw"];
        }
    }else{
        if(($ksso_member_status && !isset($calc_fee["on_member_usd"])) || (!$ksso_member_status && !isset($calc_fee["on_guest_usd"]))){
            echo json_encode(array("code"=>403, "msg"=>"Not invalid price type"));
            exit;
        }

        if($ksso_member_status >= 1){
            $result = $calc_fee["on_member_usd"];
        }else{
            $result = $calc_fee["on_guest_usd"];
        }
    }

    return $result;
}

?>