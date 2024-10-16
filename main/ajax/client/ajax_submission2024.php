<?php
include_once("../../common/common.php");
include_once('../../include/submission_data.php');
//[240125] sujeong / step 2 - file index가 없을 경우에도 돌아가는 코드... 에러로 돌아가는 코드라 수정 해야 함
//error_reporting( E_ALL );
//ini_set( "display_errors", 1 );


$language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
//$locale = locale($language);

$flag = $_POST["flag"];

if ($flag == "step1") {
	// 유저IDX
	$user_idx = $_SESSION["USER"]["idx"];

	// submission IDX
	$submission_idx = $_POST['idx'];


	$af_array = explode("%^", $_POST['afs']);
	$au_array = explode("%^", $_POST['aus']);

	$sql_insert_af = "
			INSERT INTO 
				request_submission_affiliation
				(submission_idx, `order`, affiliation, department, department_detail, nation_no, register, register_date)
			VALUES
		";
	$sql_insert_af_array = array();

	$sql_insert_au = "
			INSERT INTO 
				request_submission_author
				(submission_idx, `order`, same_signup_yn, presenting_yn, corresponding_yn, first_name, last_name, email, affiliation_selected, mobile, register, register_date)
			VALUES
		"; //, name_kor, affiliation_kor
	$sql_insert_au_array = array();

	if (!$submission_idx) {
		// 생성

		//제출고유코드 생성
		$submission_code = createSubmissionCode("abstract");

		// request_submission
		$sql_insert_main = "
				INSERT INTO 
					request_submission
					(submission_code, register, register_date)
				VALUES
					('" . $submission_code . "', '" . $user_idx . "', NOW())
			";
		$sql_insert_main_result = sql_query($sql_insert_main);
		if (!$sql_insert_main_result) {
			return_value(500, 'submission insert fail', array("sql" => $sql_insert_main));
		}

		$submission_idx = sql_insert_id();

		// affiliations
		foreach ($af_array as $af) {
			list($order, $affiliation, $department, $department_other, $country) = explode("@#", $af);

			$sql_insert_af_array[] = "('" . $submission_idx . "', '" . $order . "', '" . $affiliation . "', '" . $department . "', '" . $department_other . "', '" . $country . "', '" . $user_idx . "', NOW())";
		}
		$sql_insert_af .= implode(",", $sql_insert_af_array);
		$sql_insert_af_result = sql_query($sql_insert_af);
		if (!$sql_insert_af_result) {
			return_value(500, 'submission affiliation insert fail', array("sql" => $sql_insert_af));
		}

		// authors
		foreach ($au_array as $au) {
			list($order, $same_signup_yn, $presenting_yn, $corresponding_yn, $name_en_first, $name_en_last, $email, $affiliation1, $affiliation2, $affiliation3, $mobile) = explode("@#", $au); //, $name_ko, $affiliation_ko

			$sql_insert_au_array[] = "('" . $submission_idx . "', '" . $order . "', '" . $same_signup_yn . "', '" . $presenting_yn . "', '" . $corresponding_yn . "', '" . $name_en_first . "', '" . $name_en_last . "', '" . $email . "', '" . $affiliation1 . "|" . $affiliation2 . "|" . $affiliation3 . "', '" . $mobile . "', '" . $user_idx . "', NOW())"; //, '".$name_ko."', '".$affiliation_ko."'
		}
		$sql_insert_au .= implode(",", $sql_insert_au_array);
		$sql_insert_au_result = sql_query($sql_insert_au);
		if (!$sql_insert_au_result) {
			return_value(500, 'submission author insert fail', array("sql" => $sql_insert_au));
		}

		return_value(200, 'submission insert success', array("submission_idx" => $submission_idx));
	} else {
		// 수정

		// affiliations
		foreach ($af_array as $af) {
			list($order, $affiliation, $department, $department_other, $country) = explode("@#", $af);

			$sql_exist = "
					SELECT
						COUNT(idx) AS cnt
					FROM request_submission_affiliation
					WHERE is_deleted = 'N'
					AND submission_idx = '" . $submission_idx . "'
					AND `order` = '" . $order . "'
				";
			$sql_exist_result = sql_fetch($sql_exist);

			if ($sql_exist_result['cnt'] <= 0) {
				// 추가
				$sql_insert_af2 = $sql_insert_af . "('" . $submission_idx . "', '" . $order . "', '" . $affiliation . "', '" . $department . "', '" . $department_other . "', '" . $country . "', '" . $user_idx . "', NOW())";

				$sql_insert_af_result = sql_query($sql_insert_af2);
				if (!$sql_insert_af_result) {
					return_value(500, 'submission affiliation insert fail', array("sql" => $sql_insert_af2));
				}
			} else {
				// 변경
				$sql_update_af = "
						UPDATE request_submission_affiliation
						SET
							affiliation = '" . $affiliation . "', 
							department = '" . $department . "', 
							department_detail = '" . $department_other . "', 
							nation_no = '" . $country . "', 
							modifier = '" . $user_idx . "', 
							modify_date = NOW()
						WHERE is_deleted = 'N'
						AND submission_idx = '" . $submission_idx . "'
						AND `order` = '" . $order . "'
					";

				$sql_update_af_result = sql_query($sql_update_af);
				if (!$sql_update_af_result) {
					return_value(500, 'submission affiliation update fail', array("sql" => $sql_update_af));
				}
			}
		}

		// 삭제
		$sql_delete_af = "
				UPDATE request_submission_affiliation
				SET
					is_deleted = 'Y', 
					delete_date = NOW()
				WHERE is_deleted = 'N'
				AND submission_idx = '" . $submission_idx . "'
				AND `order` > '" . (count($af_array)) . "'
			";
		$sql_delete_af_result = sql_query($sql_delete_af);
		if (!$sql_delete_af_result) {
			return_value(500, 'submission affiliation delete fail', array("sql" => $sql_delete_af));
		}

		// authors
		foreach ($au_array as $au) {
			list($order, $same_signup_yn, $presenting_yn, $corresponding_yn, $name_en_first, $name_en_last, $email, $affiliation1, $affiliation2, $affiliation3, $mobile) = explode("@#", $au); //, $name_ko, $affiliation_ko

			$sql_insert_au_array[] = "('" . $submission_idx . "', '" . $order . "', '" . $same_signup_yn . "', '" . $presenting_yn . "', '" . $corresponding_yn . "', '" . $name_en_first . "', '" . $name_en_last . "', '" . $email . "', '" . $affiliation1 . "|" . $affiliation2 . "|" . $affiliation3 . "', '" . $mobile . "', '" . $user_idx . "', NOW())"; // , '".$name_ko."', '".$affiliation_ko."'



			$sql_exist = "
					SELECT
						COUNT(idx) AS cnt
					FROM request_submission_author
					WHERE is_deleted = 'N'
					AND submission_idx = '" . $submission_idx . "'
					AND `order` = '" . $order . "'
				";
			$sql_exist_result = sql_fetch($sql_exist);

			if ($sql_exist_result['cnt'] <= 0) {
				// 추가
				$sql_insert_au2 = $sql_insert_au . "('" . $submission_idx . "', '" . $order . "', '" . $same_signup_yn . "', '" . $presenting_yn . "', '" . $corresponding_yn . "', '" . $name_en_first . "', '" . $name_en_last . "', '" . $email . "', '" . $affiliation1 . "|" . $affiliation2 . "|" . $affiliation3 . "', '" . $mobile . "', '" . $user_idx . "', NOW())"; //, '".$name_ko."', '".$affiliation_ko."'

				$sql_insert_au_result = sql_query($sql_insert_au2);
				if (!$sql_insert_au_result) {
					return_value(500, 'submission author insert fail', array("sql" => $sql_insert_au2));
				}
			} else {
				// 변경
				$sql_update_af = "
						UPDATE request_submission_author
						SET
							same_signup_yn = '" . $same_signup_yn . "', 
							presenting_yn = '" . $presenting_yn . "', 
							corresponding_yn = '" . $corresponding_yn . "', 
							first_name = '" . $name_en_first . "', 
							last_name = '" . $name_en_last . "', 
							#name_kor = '" . $name_ko . "', 
							#affiliation_kor = '" . $affiliation_ko . "', 
							email = '" . $email . "', 
							affiliation_selected = '" . $affiliation1 . "|" . $affiliation2 . "|" . $affiliation3 . "', 
							mobile = '" . $mobile . "', 
							modifier = '" . $user_idx . "', 
							modify_date = NOW()
						WHERE is_deleted = 'N'
						AND submission_idx = '" . $submission_idx . "'
						AND `order` = '" . $order . "'
					";

				$sql_update_af_result = sql_query($sql_update_af);
				if (!$sql_update_af_result) {
					return_value(500, 'submission author update fail', array("sql" => $sql_update_af));
				}
			}
		}

		// 삭제
		$sql_delete_af = "
				UPDATE request_submission_author
				SET
					is_deleted = 'Y', 
					delete_date = NOW()
				WHERE is_deleted = 'N'
				AND submission_idx = '" . $submission_idx . "'
				AND `order` > '" . (count($au_array)) . "'
			";
		$sql_delete_af_result = sql_query($sql_delete_af);
		if (!$sql_delete_af_result) {
			return_value(500, 'submission author delete fail', array("sql" => $sql_delete_af));
		}

		$sql_update = "
				UPDATE request_submission
				SET
					`status` = 0, 
					modifier = '" . $user_idx . "', 
					modify_date = NOW()
				WHERE idx = '" . $submission_idx . "'
			";
		$sql_update_result = sql_query($sql_update);
		if (!$sql_update_result) {
			return_value(500, 'submission update fail', array("sql" => $sql_update));
		}

		return_value(200, 'submission update success', array("submission_idx" => $submission_idx));
	}
} else if ($flag == "step2") {
	// 유저IDX
	$user_idx = $_SESSION["USER"]["idx"];

	// submission IDX
	$submission_idx = $_POST['idx'];

	$sql_file = "";
	//[240125] sujeong / 파일 수 2개로 제한
	for ($i = 1; $i <= 5; $i++) {
		$key_idx = "abstract_file_idx" . $i;
		$idx = $_POST[$key_idx];

		$key_file = "abstract_file" . $i;
		$file = $_FILES[$key_file];

		$key_caption = "abstract_caption" . $i;
		$caption = $_POST[$key_caption];

		if ($idx <= -1) {
			$sql_file .= "
					image" . $i . "_file = '0', 
					image" . $i . "_caption = '', 
				";
		} else {
			if (isset($_FILES[$key_file])) {
				$sql_file .= "
						image" . $i . "_file = '" . upload_file($file, 0) . "', 
					";
			}
			$sql_file .= "
					image" . $i . "_caption = '" . $caption . "', 
				";
		}
	}
	/*if (isset($_FILES['abstract_file1'])) {
			$sql_file .= "
				image1_file = '".upload_file($_FILES["abstract_file1"], 0)."', 
				image1_caption = '".$_POST['abstract_caption1']."', 
			";
		}
		if (isset($_FILES['abstract_file2'])) {
			$sql_file .= "
				image2_file = '".upload_file($_FILES["abstract_file2"], 0)."', 
				image2_caption = '".$_POST['abstract_caption2']."', 
			";
		}
		if (isset($_FILES['abstract_file3'])) {
			$sql_file .= "
				image3_file = '".upload_file($_FILES["abstract_file3"], 0)."', 
				image3_caption = '".$_POST['abstract_caption3']."', 
			";
		}
		if (isset($_FILES['abstract_file4'])) {
			$sql_file .= "
				image4_file = '".upload_file($_FILES["abstract_file4"], 0)."', 
				image4_caption = '".$_POST['abstract_caption4']."', 
			";
		}
		if (isset($_FILES['abstract_file5'])) {
			$sql_file .= "
				image5_file = '".upload_file($_FILES["abstract_file5"], 0)."', 
				image5_caption = '".$_POST['abstract_caption5']."', 
			";
		}*/

	if ($_POST["prove_age_file_idx"] <= -1) {
		$sql_file .= "
				prove_age_file = '0', 
			";
	} else if (isset($_FILES['prove_age_file'])) {
		$sql_file .= "
				prove_age_file = '" . upload_file($_FILES["prove_age_file"], 0) . "', 
			";
	}

	$sql_update = "
			UPDATE request_submission
			SET
				`status` = 0, 
				preferred_presentation_type	= '" . $_POST['preferred_presentation_type'] . "', 
				topic						= '" . $_POST['topic1'] . "', 
				topic_detail				= '" . $_POST['topic2'] . "', 
				title						= '" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', 
				objectives					= '" . htmlspecialchars($_POST['objectives'], ENT_QUOTES) . "', 
				methods						= '" . htmlspecialchars($_POST['methods'], ENT_QUOTES) . "', 
				results						= '" . htmlspecialchars($_POST['results'], ENT_QUOTES) . "', 
				conclusions					= '" . htmlspecialchars($_POST['conclusions'], ENT_QUOTES) . "', 
				keywords					= '" . htmlspecialchars($_POST['keywords'], ENT_QUOTES) . "', 
				similar_yn = '" . $_POST['similar_yn'] . "', 
				support_yn = '" . $_POST['support_yn'] . "', 
				travel_grants_yn = '" . $_POST['travel_grants_yn'] . "', 
				awards_yn = '" . $_POST['awards_yn'] . "', 
				investigator_grants_yn = '" . $_POST['investigator_grants_yn'] . "', 
				" . $sql_file . "
				modifier = '" . $user_idx . "', 
				modify_date = NOW()
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	return_value(200, 'submission update success');
} else if ($flag == "step3") {

	$sql_update = "
			UPDATE request_submission
			SET
				`status` = 1, 
				modifier = '" . $user_idx . "', 
				modify_date = NOW()
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	$sql_select = "
			SELECT
				rs.topic, rs.topic_detail, rs.title
			FROM request_submission AS rs
			WHERE rs.is_deleted = 'N'
			AND rs.idx = '" . $submission_idx . "'
		";
	$rs_detail = sql_fetch($sql_select);

	$rs_detail['title'] = htmlspecialchars(strip_tags(htmlspecialchars_decode($rs_detail['title'], ENT_QUOTES)), ENT_QUOTES);

	$rs_detail['topic_text'] = "";
	foreach ($topic1_list as $tp) {
		if ($tp['idx'] == $rs_detail['topic']) {
			$rs_detail['topic_text'] = $tp['name_en'];
		}
	}
	// foreach ($topic2_list as $tp) {
	// 	if ($tp['idx'] == $rs_detail['topic']) {
	// 		$rs_detail['topic_text'] .= " > " . $tp['name_en'];
	// 	}
	//}

	$name = $member["first_name"] . " " . $member["last_name"]; //$language == "en" ? $member["first_name"]." ".$member["last_name"] : $member["last_name"].$member["first_name"];
	$email = $member['email'];
	$subject = "[IMCVP 2024] Abstract Successfully Submitted";
	$time = date("Y-m-d H:i:s");
	$nation = $member['nation_no'];

	//0602 임시주석 에러로 페이지가 넘어가지 않는 현상
	// $mail_result = mailer("en", "abstract", $name, $email, $subject, $time, "", "", 1, "", "", "", $email, $time, $rs_detail['topic_text'], $rs_detail['title']);

	// if (!$mail_result) {
	// 	return_value(401, 'send mail fail');
	// }

	return_value(200, 'submission update success', array("name" => $name, "email" => $email, "subject" => $subject, "topic_text" => $rs_detail['topic_text'], "title" => $rs_detail['title'], "nation" => $nation));
} else if ($flag == "delete") {
	$submission_idx = $_POST['idx'];

	$sql_update = "
			UPDATE request_submission
			SET
				is_deleted = 'Y', 
				delete_date = NOW()
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	return_value(200, 'submission update success');
} 
//[240418] sujeong / 초록 심사 코드 etc1 추가
else if($flag == "etc1"){
	$submission_idx = $_POST['idx'];
	$etc1 =  $_POST['etc1'];

	$sql_update = "
			UPDATE request_submission
			SET
				etc1 = '" . $etc1 . "', 
				etc1_date = NOW()
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	return_value(200, 'submission update success');
}

//[240418] sujeong / 초록 채택 코드 etc2 추가
else if($flag == "etc2"){
	$submission_idx = $_POST['idx'];
	$etc2 =  $_POST['etc2'];

	$sql_update = "
			UPDATE request_submission
			SET
				etc2 = '" . $etc2 . "', 
				etc2_date = NOW()
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	return_value(200, 'submission update success');
}

//[240909] sujeong / 초록 채택 프로모션 코드 etc3 추가
else if($flag == "etc3"){
	$submission_idx = $_POST['idx'];
	$etc3 =  $_POST['etc3'];

	$sql_update = "
			UPDATE request_submission
			SET
				etc3 = '" . $etc3 . "'
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	return_value(200, 'submission update success');
}



//[240909] sujeong / 초록 TG etc4 추가
else if($flag == "etc4"){
	$submission_idx = $_POST['idx'];
	$etc4 =  $_POST['etc4'];

	$sql_update = "
			UPDATE request_submission
			SET
				etc4 = '" . $etc4 . "'
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	return_value(200, 'submission update success');
}

//[240702] suejong / 일괄 심사 완료 추가
// else if ($flag == 'all_check'){
// 	$submission_code_list = $_POST['idx_list'];
// 	$sql_update_result = "";

// 	foreach($submission_code_list as $sl){
// 		$sql_update = "
// 			UPDATE request_submission
// 			SET
// 				etc1 = 'Y', 
// 				etc1_date = NOW()
// 			WHERE submission_code = '" . $sl . "'
// 		";
// 	$sql_update_result += sql_query($sql_update);
	
// 	}

// 	if (!$sql_update_result) {
// 		return_value(500, 'submission update fail', array("sql" => $sql_update));
// 	}

// 	return_value(200, 'submission update success');
// }
else if ($flag == 'all_check') {
    // idx_list가 배열로 전달되었는지 확인
    $submission_code_list = isset($_POST['idx_list']) ? $_POST['idx_list'] : null;

    if (is_array($submission_code_list)) {
        print_r($submission_code_list); // 배열 출력 확인
		
		$in_list = empty($submission_code_list)?'NULL':"'".implode("','", $submission_code_list)."'";

        $sql_update = "
            UPDATE request_submission
            SET
                etc1 = 'Y', 
                etc1_date = NOW()
            WHERE submission_code IN ($in_list)
        ";

        // 쿼리 실행 및 결과 확인
        $result = sql_query($sql_update);
        if ($result) {
            return_value(200, $sql_update);
        } else {
            error_log("SQL Error: " . mysqli_error($db));
            error_log("SQL Query: " . $sql_update);
            return_value(500, 'submission update fail', array("sql" => $sql_update));
        }
    } else {
        return_value(400, 'Invalid submission code list');
    }
}

//[240909] sujeong / 초록 메일 status
else if($flag == "mail_status"){
	$submission_idx = $_POST['idx'];
	$mail_status =  $_POST['mail_status'];

	$sql_update = "
			UPDATE request_submission
			SET
				mail_status = '" . $mail_status . "'
			WHERE idx = '" . $submission_idx . "'
		";
	$sql_update_result = sql_query($sql_update);
	
	if (!$sql_update_result) {
		return_value(500, 'submission update fail', array("sql" => $sql_update));
	}

	return_value(200, 'submission update success');
}


function affiliationJson($affiliation)
{
	if ($affiliation != "") {
		if (strpos($affiliation, ",")) {
			$affiliation =  substr($affiliation, -1, 1);
		}

		$arr = explode(",", $affiliation);
		$json_data = json_encode($arr, JSON_UNESCAPED_UNICODE);

		return $json_data;
	} else {
		return $affiliation;
	}
}

function createSubmissionCode($type)
{
	$year = date("Y");

	$type_no = $type == "abstract" ? 0 : 1;
	$type_name = $type == "abstract" ? "A" : "L";

	$count_query =  "
							SELECT
								count(idx) AS count
							FROM request_submission
						";
	$count = sql_fetch($count_query)["count"];
	$code_number = $count + 1;

	while (strlen("" . $code_number) < 6) {
		$code_number = "0" . $code_number;
	}

	$code = "IMCVP" . $year . "-" . $type_name . "-" . $code_number;
	return $code;
}
// 결과값 반환 공통화
function return_value($code, $msg, $arr=array()){
	http_response_code($code);

	$arr["code"] = $code;
	$arr["msg"] = $msg;
	echo json_encode($arr, JSON_NUMERIC_CHECK);

	exit;
}