<?php
    include_once("../../common/common.php");

    $language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
    $locale = locale($language);

	//var_dump($_POST); exit;
    if($_POST["flag"] == "submission_step1") {

        // 유저IDX
        $user_idx = $_SESSION["USER"]["idx"];

        // 등록 타입(abstract:논문, lecture:강연노트)
        $type = isset($_POST["type"]) ? $_POST["type"] : "";
        $submission_type = $type == "abstract" ? "0" : "1";

        // 제출 정보
        $data = isset($_POST["data"]) ? $_POST["data"] : "";

        // 주저자 정보
        $main_data = isset($data["main_data"]) ? $data["main_data"] : "";

        // 공동저자 정보
        $co_data = $data["co_data"] ?? [];

        //for($i=0; $i<10; $i++) {
        //    $coauthor_data[$i] = isset($data["coauthor_data".$i]) ? $data["coauthor_data".$i] : "";
        //}

        // STEP2에서 최종 입력 후 INSERT를 위해 SESSION에 임시 저장
        if($type == "abstract") {
            $_SESSION["abstract"] = "";
            $_SESSION["abstract"] = [
                "data" => $main_data,
                "co_data" => $co_data
            ];
            //co_author데이터 for문(INTO-ON)
            //for($i=0; $i<10; $i++) {
            //    if($coauthor_data[$i] != "") {
            //        $_SESSION["abstract"]["coauthor_data".$i] = $coauthor_data[$i];
            //    }
            //}
            
        } else if($type == "lecture") {
            $_SESSION["lecture"] = "";
            $_SESSION["lecture"] = [
                "data" => $main_data
            ];

            if($co_data1 != "") {
                $_SESSION["lecture"]["co_data1"] = $co_data1;
            }

            if($co_data2 != "") {
                $_SESSION["lecture"]["co_data2"] = $co_data2;
            }
        }
        
        if($type == "abstract") {
            if($_SESSION["abstract"]) {
                echo json_encode(array(
                    "code" => 200,
                    "msg" => "success"
                ));
                exit;
            } else {
                echo json_encode(array(
                    "code" => 400,
                    "msg" => "abstract session error"
                ));
                exit;
            }
        } else if($type == "lecture") {
            if($_SESSION["lecture"]) {
                echo json_encode(array(
                    "code" => 200,
                    "msg" => "success"
                ));
                exit;
            } else {
                echo json_encode(array(
                    "code" => 400,
                    "msg" => "lecture session error"
                ));
                exit;
            }
        }
    
    } else if($_POST["flag"] == "lecture_step2") {

        //로그인 회원 idx
        $user_idx = $_SESSION["USER"]["idx"];

        //업데이트시 필요한 데이터
        $lecture_idx = isset($_POST["idx"]) ? $_POST["idx"] : "";
        $type = isset($_POST["type"]) ? $_POST["type"] : "";

        //제출고유코드 생성
        $submission_code = createSubmissionCode("lecture");

        //SESSION에 저장한 STEP1 데이터
        //$data = isset($_SESSION["lecture"]["data"]) ? $_SESSION["lecture"]["data"] : "";
        //$co_data1 = isset($_SESSION["lecture"]["co_data1"]) ? $_SESSION["lecture"]["co_data1"] : "";
        //$co_data2 = isset($_SESSION["lecture"]["co_data2"]) ? $_SESSION["lecture"]["co_data2"] : "";
        foreach($data as $d){
            $d = addslashes(htmlspecialchars($d));
        }
        foreach($co_data1 as $d){
            $d = addslashes(htmlspecialchars($d));
        }
        foreach($co_data2 as $d){
            $d = addslashes(htmlspecialchars($d));
        }
		
        //강연 정보
        $lecture_presentation_type = isset($_POST["presentation_type"]) ? $_POST["presentation_type"] : "";
        $lecture_cv = isset($_POST["cv"]) ? $_POST["cv"] : "";

        //주저자
		$presenting_author = isset($_POST["presenting_author"]) ? $_POST["presenting_author"] : "N";
		$corresponding_author = isset($_POST["corresponding_author"]) ? $_POST["corresponding_author"] : "N";
        $nation_no = isset($_POST["nation_no"]) ? $_POST["nation_no"] : "";
        $city = isset($_POST["city"]) ? $_POST["city"] : "";
        $state = isset($_POST["state"]) ? $_POST["state"] : "";
        $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : "";
        $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : "";
        $affiliation = isset($_POST["affiliation"]) ? $_POST["affiliation"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $nation_tel = isset($_POST["nation_tel"]) ? $_POST["nation_tel"] : "";
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";

        $phone = phoneNumberTransform($nation_tel, $phone);

        if($type == "update") {
            $submission_query = "
                                    UPDATE request_abstract
                                    SET
                                        modifier = {$user_idx},
                                        modify_date = NOW(),
                                ";
        } else {
            $submission_query = "
                                    INSERT request_abstract
                                    SET
                                        `type` = 1,
                                        submission_code = '{$submission_code}',
                                        register = {$user_idx},

                                ";
        }

        $submission_query .=    "
                                    nation_no        =        {$nation_no},
                                    last_name        =        '{$last_name}',
                                    first_name        =        '{$first_name}',
                                    city            =        '{$city}',
                                    affiliation        =        '{$affiliation}',
                                    email            =        '{$email}',
                                    phone            =        '{$phone}',
                                    presentation_type    =    {$lecture_presentation_type},
									presenting_author	 =    '{$presenting_author}',
									corresponding_author =    '{$corresponding_author}'
                                ";
        
        if($state != "") {
            $submission_query .=    " , state = '{$state}' ";
        }
        
/*        
        //error_log(print_r($email, true));
        //error_log(print_r($user_idx, true));

        $file_no = upload_file($_FILES["lecture_file"], 1);
        error_log(print_r($_FILES["lecture_file"], true));
        error_log("file_no: " . print_r($file_no, true));
        if($file_no == "") {
            error_log("4444");
            $res = [
                code => 401,
                msg => "lecture_file upload error"
            ];
            echo json_encode($res);
            exit;
        }

        if($file_no != "") {
            $insert_submission_query .= ", notice_file = '{$file_no}' ";
        }

        //파일 업로드
        $file_no2 = upload_file($_FILES["cv_file"], 1);
        error_log(print_r($_FILES["cv_file"], true));
        error_log("file_no2: " . print_r($file_no2, true));

        if($file_no2 == "") {
            error_log("5555");
            $res = [
                code => 401,
                msg => "cv_file upload error"
            ];
            echo json_encode($res);
            exit;
        }

        if($file_no2 != "") {
            $insert_submission_query .= ", cv_file = '{$file_no2}' ";
        }
*/

        if($_FILES["lecture_file"]) {
            //파일 업로드
            $file_no = upload_file($_FILES["lecture_file"], 1);

            if($file_no == "") {
                $res = [
                    code => 401,
                    msg => "file upload error"
                ];
                echo json_encode($res);
                exit;
            }

            if($file_no != "") {
                $submission_query .= ", notice_file = '{$file_no}' ";
            }
        }
        
        if($_FILES["cv_file"]) {
            //파일 업로드
            $file_no = upload_file($_FILES["cv_file"], 1);

            if($file_no == "") {
                $res = [
                    code => 401,
                    msg => "file upload error"
                ];
                echo json_encode($res);
                exit;
            }

            if($file_no != "") {
                $submission_query .= ", cv_file = '{$file_no}' ";
            }
        }
		if($_FILES["lecture_video_file"]) {

			$file_no = upload_file($_FILES["lecture_video_file"], 1);

			if($file_no == "") {
				$res = [
					code => 401,
					msg => "file upload error"
				];
				echo json_encode($res);
				exit;
			}

			if($file_no != "") {
				 $submission_query .= ", lecture_video_file = '{$file_no}' ";
			}
		}

		//if($_FILES["copyright_agreement_file"]) {
		//	$file_no = upload_file($_FILES["copyright_agreement_file"], 1);

		//	if($file_no == "") {
		//		$res = [
		//			code => 401,
		//			msg => "file upload error"
		//		];
		//		echo json_encode($res);
		//		exit;
		//	}

		//	if($file_no != "") {
		//		 $submission_query .= ", copyright_agreement_file = '{$file_no}' ";
		//	}
		//}

        if($type == "update") {
            $submission_query .=    " WHERE idx = {$lecture_idx} ";
        }

        $result = sql_query($submission_query);

        if(!$result) {
            $res = [
                code => 400,
                msg => "main query error"
            ];
            echo json_encode($res);
            exit;
        } 
		//else {
        //    for($i=1; $i<count($_SESSION["lecture"]); $i++) {
        //        if($type == "update") {
        //            $co_submission_query =  "
        //                                        UPDATE request_abstract
        //                                        SET
        //                                            modifier = {$user_idx},
        //                                            modify_date = NOW(),
        //                                    ";

        //            $select_co_idx_query =  "
        //                                        SELECT
        //                                            idx
        //                                        FROM request_abstract
        //                                        WHERE register = {$user_idx}
        //                                        AND parent_author = {$lecture_idx}
        //                                        ORDER BY idx
        //                                    ";

        //            $co_lecture_idx = get_data($select_co_idx_query);
        //        } else {
        //            $select_last_idx_query =    "
        //                                            SELECT 
        //                                                MAX(idx) AS last_idx
        //                                            FROM request_abstract
        //                                            WHERE register = {$user_idx}
        //                                            AND parent_author IS NULL
        //                                            ORDER BY register_date DESC
        //                                        ";
        //                        
        //            $last_idx = sql_fetch($select_last_idx_query)["last_idx"];

        //            $co_submission_query =  "
        //                                        INSERT request_abstract
        //                                        SET
        //                                            `type`          =           1,
        //                                            register        =           {$user_idx},
        //                                            parent_author   =           {$last_idx},
    
        //                                    ";
        //        }

        //        $co_submission_query .=    "
        //                                    nation_no =            '".${'co_nation_no'.$i}."',
        //                                    city =                '".${'co_city'.$i}."',
        //                                    last_name =            '".${'co_last_name'.$i}."',
        //                                    first_name =        '".${'co_first_name'.$i}."',
        //                                    affiliation =        '".${'co_affiliation'.$i}."',
        //                                    email =                '".${'co_email'.$i}."',
        //                                    phone =                '".${'co_phone'.$i}."'
        //                                ";

        //        if($type == "update") {
        //            $co_submission_query .= " WHERE idx = {$co_lecture_idx[($i-1)]['idx']} "; //co_author의 값을 들고올때 $co_lecture_idx[0]부터 시작하기에 $i-1
        //        }

		//		//echo $co_submission_query;
        //        $co_result = sql_query($co_submission_query);

        //        if(!$co_result) {
        //            echo json_encode(array(
        //                "code" => 400,
        //                "msg" => "co".$i." query error"
        //            ));
        //            exit;
        //        }
        //    }
        //}

        //세션 초기화
        $_SESSION["lecture"] = "";

        $res = [
            code => 200,
            msg => "success"
        ];
        echo json_encode($res);
        exit;

    } else if($_POST["flag"] == "abstract_step2") {
        //로그인 회원 idx
        $user_idx = $_SESSION["USER"]["idx"];

        //업데이트시 필요한 데이터
        $abstract_idx = isset($_POST["idx"]) ? $_POST["idx"] : "";
        $type = isset($_POST["type"]) ? $_POST["type"] : "";

        //제출고유코드 생성
        $submission_code = createSubmissionCode("abstract");

        //SESSION에 저장한 STEP1 데이터
        $data = isset($_SESSION["abstract"]["data"]) ? $_SESSION["abstract"]["data"] : "";

        //co_author데이터 for문(INTO-ON)
        for($i=0; $i<(count($_SESSION["abstract"])-2); $i++) {
            $coauthor_data[$i] = isset($_SESSION["abstract"]["coauthor_data".$i]) ? $_SESSION["abstract"]["coauthor_data".$i] : "";
        }

        foreach($data as $key=>$value){
            $value = stripslashes($value);
            if ($key == "affiliation") {
                $data["affiliation"] = htmlspecialchars($value, ENT_QUOTES);
            } else {
                $value = addslashes(htmlspecialchars($value, ENT_QUOTES));
            }
        }
        foreach($_POST as $key=>$value){
            $value = stripslashes($value);
            $value = addslashes(htmlspecialchars($value, ENT_QUOTES));
        }

        //논문 정보
        $abstract_category = isset($_POST["abstract_category"]) ? $_POST["abstract_category"] : "";
        $abstract_title = isset($_POST["title"]) ? $_POST["title"] : "";
        //$oral_presentation = isset($_POST["oral_presentation"]) ? $_POST["oral_presentation"] : "";
		$presentation_type_yn = isset($_POST["presentation_type_yn"]) ? $_POST["presentation_type_yn"] : "";
		$presentation_type = isset($_POST["presentation_type"]) ? $_POST["presentation_type"] : "";
		

        //주저자
		$presenting_author = isset($data["presenting_author"]) ? $data["presenting_author"] : "N";
		$corresponding_author = isset($data["corresponding_author"]) ? $data["corresponding_author"] : "N";
        $nation_no = isset($data["nation_no"]) ? $data["nation_no"] : "";
        $city = isset($data["city"]) ? $data["city"] : "";
        $state = isset($data["state"]) ? $data["state"] : "";
        $first_name = isset($data["first_name"]) ? $data["first_name"] : "";
        $last_name = isset($data["last_name"]) ? $data["last_name"] : "";
        $affiliation = isset($data["affiliation"]) ? $data["affiliation"] : "";
        $email = isset($data["email"]) ? $data["email"] : "";
        $position = isset($data["position"]) ? $data["position"] : "";
        if($position == "4") {
            $position_other = isset($data["other_position"]) ? $data["other_position"] : "";
        }
        $nation_tel = isset($data["nation_tel"]) ? $data["nation_tel"] : "";
		$nation_tel = str_replace('+', '', $nation_tel);
        $phone = isset($data["phone"]) ? $data["phone"] : "";

        $phone = phoneNumberTransform($nation_tel, $phone);
        //$affiliation = affiliationJson($affiliation);

        $coauthor_affiliation = array();
        $coauthor_first_name = array();
        $coauthor_last_name = array();
        $coauthor_email = array();
        $coauthor_affiliation = array();

		$coauthor_nation_no = array();
		$coauthor_city = array();
		$coauthor_state = array();
		$coauthor_position = array();
		$coauthor_phone = array();
		$coauthor_position_other = array();

        //co_author데이터 for문(INTO-ON)
        if($coauthor_data){
            for($i=0; $i<(count($coauthor_data)); $i++) {
                //coauthor
				$coauthor_idx[$i] = isset($coauthor_data[$i]["add_co_idx".$i]) ? $coauthor_data[$i]["add_co_idx".$i] : "";
                $coauthor_first_name[$i] = isset($coauthor_data[$i]["add_co_first_name".$i]) ? $coauthor_data[$i]["add_co_first_name".$i] : "";
                $coauthor_last_name[$i] = isset($coauthor_data[$i]["add_co_last_name".$i]) ? $coauthor_data[$i]["add_co_last_name".$i] : "";
                $coauthor_email[$i] = isset($coauthor_data[$i]["add_co_email".$i]) ? $coauthor_data[$i]["add_co_email".$i] : "";
                $coauthor_affiliation[$i] = isset($coauthor_data[$i]["add_co_affiliation".$i]) ? $coauthor_data[$i]["add_co_affiliation".$i] : "";
			
				$coauthor_affiliation[$i] = preg_replace('/[[\]\;\"]+/', '', $coauthor_affiliation[$i]); 

                $coauthor_affiliation[$i] = htmlspecialchars(stripslashes($coauthor_affiliation[$i]), ENT_QUOTES);
                //$coauthor_affiliation_value[$i] = affiliationJson($coauthor_affiliation[$i]);

				$coauthor_nation_no[$i] = isset($coauthor_data[$i]["add_co_nation_no".$i]) ? $coauthor_data[$i]["add_co_nation_no".$i] : "";
				$coauthor_city[$i] = isset($coauthor_data[$i]["add_co_city".$i]) ? $coauthor_data[$i]["add_co_city".$i] : "";
				$coauthor_state[$i] = isset($coauthor_data[$i]["add_co_state".$i]) ? $coauthor_data[$i]["add_co_state".$i] : "";
				$coauthor_position[$i] = isset($coauthor_data[$i]["add_co_position".$i]) ? $coauthor_data[$i]["add_co_position".$i] : "";

				if($coauthor_position[$i] == "4") {
					$coauthor_position_other[$i] = isset($coauthor_data[$i]["add_co_other_position".$i]) ? $coauthor_data[$i]["add_co_other_position".$i] : "";
				}
				
				$coauthor_nation_tel = isset($coauthor_data[$i]["add_co_nation_tel".$i]) ? $coauthor_data[$i]["add_co_nation_tel".$i] : "";
				$coauthor_phone[$i] = isset($coauthor_data[$i]["add_co_phone".$i]) ? $coauthor_data[$i]["add_co_phone".$i] : "";
				$coauthor_phone[$i] = phoneNumberTransform($coauthor_nation_tel, $coauthor_phone[$i]);
				
            }
        }


        if($type == "update") {
            $submission_query = "
                                UPDATE request_abstract
                                SET
                                    modifier            =           {$user_idx},
                                    modify_date         =           NOW(),

                            ";
        } else {
            $submission_query =    "
                                    INSERT request_abstract
                                    SET 
                                        `type`            =        0,
                                        submission_code =       '{$submission_code}',
                                        register        =        {$user_idx},
                                ";
        }

        $abstract_title = isset($_POST["title"]) ? $_POST["title"] : "";

		if(!empty($abstract_title)) {
			$abstract_title = "abstract_title      =   '{$abstract_title}',";
		}

        $submission_query .=    "
                                    nation_no        =        {$nation_no},
									{$abstract_title}
                                    last_name        =        '{$last_name}',
                                    first_name        =        '{$first_name}',
                                    city            =        '{$city}',
                                    affiliation        =        '{$affiliation}',
                                    email            =        '{$email}',
                                    phone            =        '{$phone}',
                                    position        =       '{$position}',
                                    abstract_category   =   {$abstract_category},
									presentation_type_yn  = '{$presentation_type_yn}',
									presentation_type  = {$presentation_type},
									presenting_author	 =    '{$presenting_author}',
									corresponding_author =    '{$corresponding_author}'
                                ";



        if($state != "") {
            $submission_query .= " , state = '{$state}' ";
        }

        if($position_other != "") {
            $submission_query .= " , position_other = '{$position_other}' ";
        }

        if($_FILES["abstract_file"]) {

            $file_no = upload_file($_FILES["abstract_file"], 0);

            if($file_no != "") {
                $submission_query .= ", abstract_file = '{$file_no}' ";
            }

            if($file_no == "") {
                $res = [
                    code => 401,
                    msg => "file upload error"
                ];
                echo json_encode($res);
                exit;
            }
        }

		
        if($type == "update") {
            $submission_query .=    " WHERE idx = {$abstract_idx} ";
        }
		$result = sql_query($submission_query);

        if(!$result) {
            $res = [
                code => 400,
                msg => "main query error"
            ];
            echo json_encode($res);
            exit;
        } else {
			if(!$abstract_idx) {
				$select_last_idx_query =    "
												SELECT 
													MAX(idx) AS last_idx
												FROM request_abstract
												WHERE register = {$user_idx}
												ORDER BY register_date DESC
											";
				$last_idx = sql_fetch($select_last_idx_query)["last_idx"];
			} else {
				$last_idx = $abstract_idx;
			}

            $select_co_idx_query =  "
                                        SELECT
                                            idx
                                        FROM request_abstract
                                        WHERE register = {$user_idx}
                                        AND parent_author = {$abstract_idx}
                                        ORDER BY idx
                                    ";
            $co_abstract_idx = get_data($select_co_idx_query);

			if($type == "update") {
				$update_delete_query = "
											UPDATE request_abstract
											SET	
												is_deleted = 'Y'
											WHERE parent_author = {$abstract_idx}
											AND idx <> {$co_idx1}
										";

				sql_query($update_delete_query);
			}

            for($i=0; $i < count($_SESSION["abstract"]["co_data"]); $i++) {
				$co_data = isset($_SESSION["abstract"]["co_data"][$i]) ? $_SESSION["abstract"]["co_data"][$i] : [];

				//공동저자
				$co_idx = $co_data["add_co_idx".$i] ?? "";

				$co_presenting_author = $co_data["add_co_presenting_author".$i] ?? "N";
				$co_corresponding_author = $co_data["add_co_corresponding_author".$i] ?? "N";
				$co_nation_no = $co_data["add_co_nation_no".$i] ?? "";
				$co_first_name = $co_data["add_co_first_name".$i] ?? "";
				$co_last_name = $co_data["add_co_last_name".$i] ?? "";
				$co_affiliation = htmlspecialchars($co_data["add_co_affiliation".$i] ?? "", ENT_QUOTES);
				$co_email = $co_data["add_co_email".$i] ?? "";
				$co_nation_tel = $co_data["add_co_nation_tel".$i] ?? "";
				$co_nation_tel = str_replace('+', '', $co_nation_tel);
				$co_phone = phoneNumberTransform($co_nation_tel, $co_data["add_co_phone".$i] ?? "");

				if($co_idx) {
                    $co_submission_query =  "
                                                UPDATE request_abstract
                                                SET
                                                    modifier            =           {$user_idx},
                                                    modify_date         =           NOW(),
                                            ";

                } else {
                    $co_submission_query =  "
                                                INSERT request_abstract
                                                SET
                                                    `type`          =           0,
                                                    register        =           {$user_idx},
                                            ";
					if($type != "update") {
						 $co_submission_query .= "
													  parent_author   =           {$last_idx},
												 ";
					} else {
						$co_submission_query .= "
													  parent_author   =           {$abstract_idx},
												 ";
					}
    
                }

				$co_submission_query .=    "
											nation_no        =        {$co_nation_no},
											last_name        =        '{$co_last_name}',
											first_name       =        '{$co_first_name}',
											affiliation      =        '{$co_affiliation}',
											email            =        '{$co_email}',
											phone            =        '{$co_phone}',
											position         =        '{$co_position}',
											is_deleted		 =		  'N',
											presenting_author	 =    '{$co_presenting_author}',
											corresponding_author =    '{$co_corresponding_author}'
										";

				if(!empty($co_idx) && $type == "update") {
					$co_submission_query .= " WHERE idx = {$co_idx}";
				}
                $co_result = sql_query($co_submission_query);

                if(!$co_result) {
                    echo json_encode(array(
                        "code" => 400,
                        "msg" => "co".$i." query error"
                    ));
                    exit;
                }
            }
        }

        if($type != "update") {        
            $select_user_query ="
                                    SELECT
                                        *
                                    FROM member
                                    WHERE idx = '{$user_idx}'
                                    AND is_deleted = 'N'
                                ";
            
            $select_category_query = "
                                    SELECT
                                        *
                                    FROM category
                                    WHERE type = 0
                                    AND idx = '{$abstract_category}'
                                ";
            
            $user_data = sql_fetch($select_user_query);
            $category_data = sql_fetch($select_category_query);
            //$mail_result = mailer($language, "abstract", "", $email, "[ICOMES]".$subject, date("Y-m-d H:i:s"), "", "", 1, "", "", "", $user_data['email'], date("Y-m-d H:i:s"), $category_data['title'], $abstract_title);
            if(!$mail_result) {
               // $res = [
                //    code => 401,
                //    msg => "send mail fail"
               // ];
              //  echo json_encode($res);
               // exit;
            }
        }
        
		$subject = $language == "ko" ? "초록 신청 완료" : "Your abstract has been successfully submitted.";

        //세션 초기화
        $_SESSION["abstract"] = "";

        $res = [
            code => 200,
            msg => "success",
			language => $language,
			idx => $last_idx,
			language => $language,
			email => $email,
			subject => $subject,
			user_email => $user_data['email'],
			title => $category_data['title'],
			abstract_title => $abstract_title
        ];
        echo json_encode($res);
        exit;
    } else if($_POST["flag"] == "submission_delete") {
        $user_idx = $_SESSION["USER"]["idx"];
        $idx = isset($_POST["idx"]) ? $_POST["idx"] : "";

        $abstract_delete_query =    "
                                        UPDATE request_abstract
                                        SET
                                            is_deleted  = 'Y',
                                            modifier = {$user_idx},
                                            modify_date = NOW()
                                        WHERE idx = {$idx}
                                        OR parent_author = {$idx}
                                    ";
        $delete = sql_query($abstract_delete_query);

        if(!$delete)  {
            $res = [
                code => 400,
                msg => "delete query error"
            ];
            echo json_encode($res);
            exit;
        }

        $res = [
            code => 200,
            msg => "success"
        ];
        echo json_encode($res);
        exit;
    
    }


function affiliationJson($affiliation) {
    if($affiliation != "") {
        if(strpos($afflilation, ",")) {
            $affiliation =  substr($affiliation, -1, 1);
        }
    
        $arr = explode(",", $affiliation);

        $json_data = json_encode($arr, JSON_UNESCAPED_UNICODE);
    
        return $json_data;
    } else {
        return $affiliation;
    }
}

function createSubmissionCode($type) {
    $year = date("Y");

    $type_no = $type == "abstract" ? 0 : 1;
    $type_name = $type == "abstract" ? "A" : "L";

    $count_query =  "
                            SELECT
                                count(idx) AS count
                            FROM request_abstract
                            WHERE `type` = {$type_no}
                            AND parent_author IS NULL
                        ";

    $count = sql_fetch($count_query)["count"];

    $code_number = $count+1;

    while(strlen("".$code_number)< 6){
        $code_number = "0".$code_number;
    }
    
    $code = "ICOMES".$year."-".$type_name."-".$code_number;
    return $code;
}
?>