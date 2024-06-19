<?php include_once("../../common/common.php");?>
<?php include_once("../../common/locale.php");?>
<?php //include_once("../../common/lib/gmail_api.php");?>


<?php
	$language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
	$locale = locale($language);
	if($_POST["flag"] == "id_check") {
		$email = isset($_POST["email"]) ? $_POST["email"] : "";

		if($email == "") {
			echo json_encode(array(
				code=>401,
				msg=>"no email"
			));
			exit;
		}

		$select_id_query =	"
								SELECT
									COUNT(*) AS check_cnt
								FROM member
								WHERE email = '{$email}'
								AND is_deleted = 'N'
							";
		
		$is_checked = sql_fetch($select_id_query)["check_cnt"];

		if($is_checked == 0) {
			echo json_encode(array(
				code=>200,
				msg=>"success"
			));
			exit;
		} else {
			echo json_encode(array(
				code=>400,
				msg=>"email already used"
			));
			exit;
		}

	} else if($_POST["flag"] == "signup") {
        $register_type = isset($_POST["register_type"]) ? "admin" : "user"; //관리자 회원가입용
		$data = isset($_POST["data"]) ? $_POST["data"] : "";

		$email = isset($data["email"]) ? $data["email"] : "";
		$password = isset($data["password"]) ? $data["password"] : "";
		$password = password_hash($password, PASSWORD_DEFAULT);
		$nation_no = isset($data["nation_no"]) ? $data["nation_no"] : "";
		$first_name = isset($data["first_name"]) ? $data["first_name"] : "";
		$last_name = isset($data["last_name"]) ? $data["last_name"] : "";
		$nation_tel = isset($data["nation_tel"]) ? $data["nation_tel"] : "";
		$phone = isset($data["phone"]) ? $data["phone"] : "";
		$phone = $phone != "" ? $data["nation_tel"]."-".$phone : "";
		$affiliation = isset($data["affiliation"]) ? $data["affiliation"] : "";
		$department = isset($data["department"]) ? $data["department"] : "";
		//$licence_number = isset($data["licence_number"]) ? $data["licence_number"] : "";
		//$licence_number_bool = isset($data["licence_number_bool"]) ? $data["licence_number_bool"] : "";

		// 2023-05-03 
		$first_name_kor		 = isset($data["first_name_kor"]) ? $data["first_name_kor"] : "";
		$last_name_kor		 = isset($data["last_name_kor"]) ? $data["last_name_kor"] : "";

		$title				 = isset($data["title"]) ? $data["title"] : "";
		$title_input		 = isset($data["title_input"]) ? $data["title_input"] : "";
		$terms1				 = isset($data["terms1"]) ? $data["terms1"] : "";
		$affiliation_kor	 = isset($data["affiliation_kor"]) ? $data["affiliation_kor"] : "";
		$department_kor		 = isset($data["department_kor"]) ? $data["department_kor"] : "";
		$date_of_birth		 = isset($data["date_of_birth"]) ? $data["date_of_birth"] : "";
		//$telephone1			 = substr($data["telephone1"],1);
		$telephone			 = $data["telephone1"]."-".$data["telephone2"];
		$telephone			 = $telephone != "" ? $data["nation_tel"]."-".$telephone : "";
		$email_certified	 = isset($data["email_certified"]) ? $data["email_certified"] : "";

		
		//비회원 회원가입 및 인증
		$auto = isset($data["auto"]) ? $data["auto"] : "";
		$ksola_member_check  = isset($data["ksola_member_check"]) ? $data["ksola_member_check"] : "";
		//$ksola_member_status = !empty($ksola_member_check) ? 1 : 0;
		$ksola_member_status = isset($data["ksola_member_status"]) ? $data["ksola_member_status"] : "";

        if($register_type == "admin") {
            $arr_phone = explode($phone, "-");
            $nation_tel = $arr_phone[0];
            $phone = implode("-", array_splice($arr_phone,1));
        }

		$insert_member_query =	"
									INSERT member
									SET
										email = '{$email}',
										password = '{$password}',
										nation_no = {$nation_no},
										last_name = '{$last_name}',
										first_name = '{$first_name}',
										phone = '{$phone}', 
										title_option = '{$title}',
										date_of_birth = '{$date_of_birth}'
								";
										//ksola_member_check = '{$ksola_member_check}'
		
		//if($licence_number != "") {
		//	$insert_member_query .= ", licence_number = '{$licence_number}' ";
		//} else {
		//	if($licence_number_bool == true) {
		//		 $insert_member_query .= ", licence_number = 'Not applicable' ";
		//	} else {
		//		 $insert_member_query .= ", licence_number = NULL ";
		//	}
        //}

		// 국내 일 때
		if($nation_no == 25) {
			$insert_member_query .= ", last_name_kor = '{$last_name_kor}' ";
			$insert_member_query .= ", first_name_kor = '{$first_name_kor}' ";
			$insert_member_query .= ", affiliation_kor = '{$affiliation_kor}' ";
			$insert_member_query .= ", department_kor = '{$department_kor}' ";
		}

		if($ksola_member_status != "") {
			$insert_member_query .= ", ksola_member_status = {$ksola_member_status}";
		} else {
			$insert_member_query .= ", ksola_member_status = NULL";
		}

		if($ksola_member_check != "") {
			// 중복 체크용 id 저장
			$insert_member_query .= ", ksola_member_check = '{$ksola_member_check}' ";
		} else {
			$insert_member_query .= ", ksola_member_check = NULL ";
		}

		if(!empty($data["telephone1"]) && !empty($data["telephone2"])) {
			$insert_member_query .= ", telephone = '{$telephone}' ";
		} else {
			$insert_member_query .= ", telephone = NULL ";
		}

		if($title_input != "") {
			$insert_member_query .= ", title = '{$title_input}' ";
		}

		if($affiliation != "") {
			$insert_member_query .= ", affiliation = '{$affiliation}' ";
		}
		if($department != "") {
			$insert_member_query .= ", department = '{$department}' ";
		}

		if($terms1) {
			$insert_member_query .= ", terms_access = 'Y' ";
			$insert_member_query .= ", terms_access_date = NOW() ";
		}

		//if($terms2 != "") {
		//	$insert_member_query .= ", privacy_access = '{$terms2}' ";
		//	$insert_member_query .= ", privacy_access_date = NOW() ";
		//}

		// 이메일인증 불필요로 인해 항상 Y할당
		if(true) {
			$insert_member_query .= ", email_certified = 'Y' ";
		}

        if($register_type == "admin") {
            $insert_member_query .= ", email_certified = 'Y' ";
            $insert_member_query .= ", register_type = 1 ";
        }
		
		$insert = sql_query($insert_member_query);

		if(!$insert) {
			$res = [
				code => 400,
				msg => "sign_up error"
			];
			echo json_encode($res);
			exit;
		} else {
			$insert_idx_sql = "SELECT LAST_INSERT_ID() AS idx FROM member";	
			$insert_idx = sql_fetch($insert_idx_sql)['idx'];
		}

        if($register_type != "admin") {
            $select_user_query =	"	SELECT
											*
										FROM member
										WHERE email = '{$email}'
										AND is_deleted = 'N'";
            $user_data = sql_fetch($select_user_query);
			
            $subject = "[ICOMES 2023] Welcome to ICOMES 2023!";//$locale("mail_sign_up_subject");
			$user_idx = isset($user_data["idx"]) ? $user_data["idx"] : "";
            $callback_url = D9_DOMAIN."/signup_certified.php?idx=".$user_data["idx"];
			// var_dump($subject); exit; // string(25) "Please verify your email."
			// var_dump($callback_url); exit; // string(55) "https://icomes.or.kr/main/signup_certified.php?idx=1338"

			//if($auto != 'Y') {
			//	$mail_result = mailer($language, "sign_up", "", $email, $subject, date("Y-m-d H:i:s"), "", $callback_url, $user_idx, 1);
			//	if(!$mail_result) {
			//		$res = [
			//			code => 401,
			//			msg => "send mail fail"
			//		];
			//		echo json_encode($res);
			//		exit;
			//	}
			//}
        }

		if(!empty($ksola_member_check)){
			//[240531] sujeong / kscp_memeber is_used update
			$update_kscp_member_query =	"
			UPDATE kscp_member
			SET
				is_used = 1
			WHERE id = '{$ksola_member_check}'
			";
		sql_query($update_kscp_member_query);
	}

		$res = [
			code => 200,
			msg => "success",
			mail_result => $mail_result
		];

		$res['insert_idx'] = $insert_idx;
	
		echo json_encode($res);
		exit;
	} else if($_POST["flag"] == "update") {
		$data = isset($_POST["data"]) ? $_POST["data"] : "";
		$register_type = isset($_POST["register_type"]) ? $_POST["register_type"] : NULL;

		$email = isset($data["email"]) ? $data["email"] : "";
		$password = isset($data["password"]) ? $data["password"] : "";
		if(!empty($password)) {
			$password = password_hash($password, PASSWORD_DEFAULT);
		}
		$nation_no = isset($data["nation_no"]) ? $data["nation_no"] : "";
		$first_name = isset($data["first_name"]) ? $data["first_name"] : "";
		$last_name = isset($data["last_name"]) ? $data["last_name"] : "";
		$first_name_kor = isset($data["first_name_kor"]) ? $data["first_name_kor"] : "";
		$last_name_kor = isset($data["last_name_kor"]) ? $data["last_name_kor"] : "";
		$nation_tel = isset($data["nation_tel"]) ? $data["nation_tel"] : "";
		$phone = isset($data["phone"]) ? $data["phone"] : "";
		$telephone = isset($data["telephone"]) ? $data["telephone"] : "";
		// 관리자일 경우
		/*
		if (!empty($register_type) && $register_type == 'admin') {
			$phone = $phone != "" ? $data["nation_tel"]."-".$phone : "";
			$telephone = $telephone != "" ? $data["nation_tel"]."-".$telephone : "";
		}
		*/

		$affiliation = isset($data["affiliation"]) ? $data["affiliation"] : "";
		$affiliation_kor = isset($data["affiliation_kor"]) ? $data["affiliation_kor"] : "";
		$department = isset($data["department"]) ? $data["department"] : "";
		$department_kor = isset($data["department_kor"]) ? $data["department_kor"] : "";
		$title = isset($data["title"]) ? $data["title"] : ""; // title option값
		$title_input = isset($data["title_input"]) ? $data["title_input"] : "";
		$date_of_birth = isset($data["date_of_birth"]) ? $data["date_of_birth"] : "";
		$ksola_member_check = isset($data["ksola_member_check"]) ? $data["ksola_member_check"] : "";
		$ksola_member_status = isset($data["ksola_member_status"]) ? $data["ksola_member_status"] : "";

		$update_member_query =	"
									UPDATE member
									SET
										nation_no = {$nation_no},
										last_name = '{$last_name}',
										first_name = '{$first_name}',
										phone = '{$phone}'
								";
		if(!empty($password)) {
			$update_member_query .= ", password = '{$password}'";
		}
		/* 23.05.12 HUBDNC_NYM 회원가입 페이지에서 해당 부분 삭제
		if($licence_number != "") {
			$update_member_query .= ", licence_number = '{$licence_number}' ";
		} else {
			if($licence_number_bool == true) {
				$update_member_query .= ", licence_number = 'Not applicable' ";
			} else {
				$update_member_query .= ", licence_number = NULL ";
			}
        }
		*/
		// Title Option값
		if($title != "") {
			$update_member_query .= ", title_option = '{$title}' ";
		} else {
            $update_member_query .= ", title_option = NULL ";
        }

		// Others input값
		if($title_input != "") {
			$update_member_query .= ", title = '{$title_input}' ";
		} else {
            $update_member_query .= ", title = NULL ";
        }

		if($first_name_kor != "") {
			$update_member_query .= ", first_name_kor = '{$first_name_kor}' ";
		} else {
            $update_member_query .= ", first_name_kor = NULL ";
        }

		if($last_name_kor != "") {
			$update_member_query .= ", last_name_kor = '{$last_name_kor}' ";
		} else {
            $last_name_kor .= ", last_name_kor = NULL ";
        }

		if($affiliation != "") {
			$update_member_query .= ", affiliation = '{$affiliation}' ";
		} else {
            $update_member_query .= ", affiliation = NULL ";
        }

		if($department != "") {
			$update_member_query .= ", department = '{$department}' ";
		} else {
            $update_member_query .= ", department = NULL ";
        }

		if($affiliation_kor != "") {
			$update_member_query .= ", affiliation_kor = '{$affiliation_kor}' ";
		} else {
            $update_member_query .= ", affiliation_kor = NULL ";
        }

		if($department_kor != "") {
			$update_member_query .= ", department_kor = '{$department_kor}' ";
		} else {
            $update_member_query .= ", department_kor = NULL ";
        }

		if($date_of_birth != "") {
			$update_member_query .= ", date_of_birth = '{$date_of_birth}' ";
		} else {
            $update_member_query .= ", date_of_birth = NULL ";
        }

		if($telephone != "") {
			$update_member_query .= ", telephone = '{$telephone}' ";
		} else {
            $update_member_query .= ", telephone = NULL ";
        }

		if($ksola_member_status != "") {
			$update_member_query .= ", ksola_member_status = {$ksola_member_status} ";
		}

		if($ksola_member_check != "") {
			$update_member_query .= ", ksola_member_check = '{$ksola_member_check}' ";
		}

		$update_member_query .= "	WHERE email = '{$email}' AND is_deleted = 'N' ";
		$update_member = sql_query($update_member_query);

		if($update_member) {
			$res = [
				code => 200,
				msg => "success"
			];
			echo json_encode($res);
			exit;
		} else {
			$res = [
				code => 400,
				msg => "error"
			];
			echo json_encode($res);
			exit;
		}
	
	} else if($_POST["flag"] == "login") {
		$email = isset($_POST["email"]) ? $_POST["email"] : "";
		$password = isset($_POST["password"]) ? $_POST["password"] : "";
		$hash_password = password_hash($password, PASSWORD_DEFAULT);

		$login_query =	"
							SELECT
								idx, email, password, nation_no, last_name, first_name, phone, affiliation, department, licence_number, email_certified, register_type, 
								DATE(last_login) AS last_login_date, temporary_password, r_idx, rr.status
							FROM member
							LEFT JOIN (
								SELECT rr.idx AS r_idx, status, rr.register
								FROM request_registration rr
								WHERE rr.is_deleted = 'N'
							) rr ON rr.register=member.idx
							WHERE email = '{$email}'
							AND is_deleted = 'N'
							ORDER BY r_idx DESC
							LIMIT 1
						";
		$member = sql_fetch($login_query);

		if($member["idx"] == "") {
			echo json_encode(array(
				"code" => 400,
				"msg" => "입력하신 아이디/이메일을 확인해주세요."
			));
			exit;
		}

		if(password_verify($password, $member["password"]) == false && password_verify($password, $member["temporary_password"]) == false) {
			echo json_encode(array(
				"code" => 401,
				"msg" => "입력하신 비밀번호를 확인해주세요"
			));
			exit;
		}

		//if(password_verify($password, $member["password"]) == false) {
		//	echo json_encode(array(
		//		"code" => 401,
		//		"msg" => "입력하신 비밀번호를 확인해주세요"
		//	));
		//	exit;
		//}

		if($member["email_certified"] == "N" && $member["register_type"] == 0) {
			$res = [
				code => 402,
				"msg" => "이메일 인증이 완료되지 않은 계정입니다."
			];
			echo json_encode($res);
			exit;
		}

		// 오늘 처음 로그인인 경우 출석체크 처리함
		if ($member['last_login_date'] != date('Y-m-d')) {
			$insert_daily_check_query =	"INSERT INTO 
											event_daily_check
											(member_idx)
										VALUES
											('".$member["idx"]."')";
			sql_query($insert_daily_check_query);
		}

		$update_login_date_query =	"
										UPDATE member
										SET
											last_login = NOW()
										WHERE email = '{$email}'
										AND is_deleted = 'N'
									";
		$update_login_date = sql_query($update_login_date_query);

		$_SESSION["USER"] = [
			"idx" => $member["idx"],
			"email" => $member["email"],
			"first_name" => $member["first_name"],
			"last_name" => $member["last_name"],
			"phone" => $member["phone"],
			"nation_no" => $member["nation_no"],
			"affiliation" => $member["affiliation"],
			"department" => $member["department"],
			"licence_number" => $member["licence_number"],
			"regi_status" => $member["status"]
		];

		echo json_encode(array(
			code => 200,
			msg => "로그인 성공",
			idx => $member["idx"]
		));

	} else if($_GET["flag"] == "logout") {
		$_SESSION["USER"] = [];
		$_SESSION["abstract"] = [];
		$_SESSION["lecture"] = [];

		echo json_encode(array(
			code => 200,
			msg => "로그아웃 성공"
		));
	} else if($_POST["flag"] == "find_password") {
		$email = isset($_POST["email"]) ? $_POST["email"] : "";

		$check_user_query =	"
										SELECT
											idx, email, first_name, last_name
										FROM member
										WHERE email = '{$email}'
										AND is_deleted = 'N'
									";
		
		$check_user = sql_fetch($check_user_query);

		if(!$check_user) {
			$res = [
				code => 401,
				msg => "does not exist email"
			];
			echo json_encode($res);
			exit;
		}

		$temporary_password = "";
		$random_token = generator_token();		// 비밀번호 찾기시 사용되는 토큰

		for($i=0; $i<6; $i++) {
			$temporary_password .= mt_rand(1, 9);
		}

		//$name = $language == "en" ? $check_user["first_name"]." ".$check_user["last_name"] : $check_user["last_name"].$check_user["first_name"];

		$name = $check_user["first_name"]." ".$check_user["last_name"];

		$subject = $locale("mail_find_password_subject");
		$callback_url = D9_DOMAIN."/password_reset.php?e=".$email."&t=".$random_token;
		$mail_result = mailer($language, "find_password", $name, $email, "[ICOMES]".$subject, date("Y-m-d H:i:s"), $temporary_password, $callback_url, 0, 0);



		if(!$mail_result) {
			$res = [
				code => 402,
				msg => "mail send fail."
			];
			echo json_encode($res);
			exit;
		}

		$hash_temporary_password = password_hash($temporary_password, PASSWORD_DEFAULT);

		$update_temporary_password_query =	"
												UPDATE member
												SET
													temporary_password = '{$hash_temporary_password}',
													temporary_password_token = '{$random_token}'
												WHERE email = '{$email}'
												AND is_deleted = 'N'
											";
		
		$update_temporary_password = sql_query($update_temporary_password_query);

		if($update_temporary_password) {
			$res = [
				code => 200,
				msg => "success"
			];
			echo json_encode($res);
			exit;	
		} else {
			$res = [
				code => 400,
				msg => "update query error"
			];
			echo json_encode($res);
			exit;
		}
		
	} else if($_POST["flag"] == "delete") {
        $member_idx = isset($_POST["idx"]) ? $_POST["idx"] : "";

        if($member_idx == "") {
            $res = [
                code => 400,
                msg => "error"
            ];
            echo json_encode($res);
            exit;
        }

        $delete_member_query =  "
                                    UPDATE member
                                    SET
                                        is_deleted = 'Y'
                                    WHERE idx = {$member_idx};
                                ";
        $delete_member = sql_query($delete_member_query);

        if($delete_member) {
            $res = [
                code => 200,
                msg => "delete success"
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                code => 400,
                msg => "error"
            ];
            echo json_encode($res);
            exit;
        }
    } else if($_POST["flag"] === "app_login"){
		$email = $_POST["email"] ?? "";
		$password = $_POST["password"] ?? "";
		$hash_password = password_hash($password, PASSWORD_DEFAULT);

		$type="";
		$icomes_device=$_POST["icomes_device"];
		if($icomes_device==="IOS"){
			$type="I";
		} else if($icomes_device==="AOS"){
			$type="A";
		}
		$icomes_token=$_POST["icomes_token"];

		$login_query =	"
							SELECT
								idx, email, password, nation_no, last_name, first_name, phone, affiliation, department, licence_number, email_certified, register_type,
								DATE(last_login) AS last_login_date, temporary_password
							FROM member m
							INNER JOIN
								(SELECT status, register
								 FROM request_registration
								 WHERE status IN (2,5)
								 AND is_deleted='N') rr ON rr.register = m.idx
							WHERE email = '{$email}'
							AND is_deleted = 'N'
						";
		$member = sql_fetch($login_query);
		$member_idx = $member["idx"];

		if($member["idx"] == "") {
			echo json_encode(array(
				"code" => 400,
				"msg" => "입력하신 아이디/이메일을 확인해주세요"
			));
			exit;
		}

		if(password_verify($password, $member["password"]) == false && password_verify($password, $member["temporary_password"]) == false) {
			echo json_encode(array(
				"code" => 401,
				"msg" => "입력하신 비밀번호를 확인해주세요"
			));
			exit;
		}

		if($member["email_certified"] == "N" && $member["register_type"] == 0) {
			$res = [
				code => 402,
				"msg" => "이메일 인증이 완료되지 않은 계정입니다"
			];
			echo json_encode($res);
			exit;
		}

		$update_login_date_query =	"
										UPDATE member
										SET
											last_login = NOW()
										WHERE email = '{$email}'
										AND is_deleted = 'N'
									";
		$update_login_date = sql_query($update_login_date_query);

		$select_token_query = "
								SELECT idx, member_idx, type, token
								FROM device_token
								WHERE member_idx= '{$member_idx}'
							";
		$icomes_device_token = sql_fetch($select_token_query);

		if(empty($icomes_device_token)){
			$insert_token_query = "
									INSERT device_token
									SET
										member_idx = '{$member_idx}',
										type = '{$type}',
										token = '{$icomes_token}'
								";
			$token_result = sql_query($insert_token_query);
		} else {
			$update_token_query = "
									UPDATE device_token
									SET type = '{$type}',
									    token = '{$icomes_token}'
									WHERE member_idx = '{$member_idx}'
								";
			$update_token_result = sql_query($update_token_query);
		}

		$_SESSION["USER"] = [
			"idx" => $member["idx"],
			"email" => $member["email"],
			"first_name" => $member["first_name"],
			"last_name" => $member["last_name"],
			"phone" => $member["phone"],
			"nation_no" => $member["nation_no"],
			"affiliation" => $member["affiliation"],
			"department" => $member["department"],
			"licence_number" => $member["licence_number"]
		];

		$_SESSION["APP"] = $icomes_device;

		echo json_encode(array(
			'code' => 200,
			'msg' => "로그인 성공",
			'idx' => $member["idx"],
			'device' => $icomes_device,
			'token' => $icomes_token
		));
	} else if ($_POST["flag"] === "app_logout"){
		$_SESSION["USER"] = [];
		$_SESSION["abstract"] = [];
		$_SESSION["lecture"] = [];
		$_SESSION["APP"] = [];

		echo json_encode(array(
			'code' => 200,
			'msg' => "로그아웃 성공"
		));
	}
	//[240531] sujeong / kscp member check
	else if($_POST["flag"] === "kscp_memeber_check"){
		$email = $_POST["email"] ?? "";
		$nick_name = $_POST["nick_name"] ?? "";

		$find_kscp_query =	"
							SELECT *
							FROM kscp_member
							WHERE email = '{$email}' AND nick_name = '{$nick_name}' AND is_deleted = 'N'
						";
		
		$kscp_member_check = sql_fetch($find_kscp_query);
		
        if($kscp_member_check) {
            $res = [
                code => 200,
                msg => "success",
				result => $kscp_member_check
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                code => 401,
                msg => "error"
            ];
            echo json_encode($res);
            exit;
        }

	}


		//[240531] sujeong / speaker email send
		else if($_POST["flag"] === "speaker_email"){
			$idx = $_POST["idx"] ?? "";

			$update_speaker_email_query =	"
										UPDATE email_speaker
										SET 
											is_mailed = 'Y'
										WHERE idx = {$idx}
							";
			
			$update_speaker_email_check = sql_query($update_speaker_email_query);
			
			if($update_speaker_email_check) {
				$res = [
					code => 200,
					msg => "success",
					result => $update_speaker_email_check
				];
				echo json_encode($res);
				exit;
			} else {
				$res = [
					code => 401,
					msg => "error"
				];
				echo json_encode($res);
				exit;
			}
	
		}
	
	function generator_token(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 10; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
    }
?>
