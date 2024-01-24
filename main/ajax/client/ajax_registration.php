<?php include_once("../../common/common.php");?>
<?php
	if($_POST["flag"] == "registration") {
			
		//var_dump($_POST); exit;
		//var_dump($_SESSION); exit;

		$user_idx = $_SESSION["USER"]["idx"];
		$data = isset($_POST["data"]) ? $_POST["data"] : "";
		$update_idx = isset($data["prev_no"]) ? $data["prev_no"] : "";

		// 수정시, 수정권한이 있는지 체크
		if($update_idx) {
			$sql ="
					SELECT 
						idx, `status`
					FROM request_registration 
					WHERE is_deleted = 'N'
					AND (NOT status = 2 AND NOT status = 3)
					AND register = {$user_idx}
					AND idx = {$update_idx}
				  ";

			$prev = sql_fetch($sql);

			if(!$prev["idx"]){
				$res = [
					code => 403,
					msg => "Can not modify registration, should be checked registration status and owner"
				];
				echo json_encode($res);
				exit;
			}
		}
		
		//필수
		$participation_type  = $data["participation_type"] ?? "";					// Type of Participation

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

		$category            = isset($data["category"]) ? $data["category"] : "";										// Category
		$category_other      = isset($data["title_input"]) ? $data["title_input"] : "";

        $occupation            = isset($data["occupation"]) ? $data["occupation"] : "";									// Type of Participation
        $occupation_other      = isset($data["occupation_input"]) ? $data["occupation_input"] : "";

		$rating              = isset($data["review"]) ? $data["review"] : "";											// 평점신청
		$licence_number      = $data["licence_number"] != "" ? $data["licence_number"] : "";							// 의사면허번호
		$specialty_number    = $data["specialty_number"] != "" ? $data["specialty_number"] : "";						// 전문의번호
		$nutritionist_number = $data["nutritionist_number"] != "" ? $data["nutritionist_number"] : "";					// 영양사면허번호
        $dietitian_number    = $data["dietitian_number"] != "" ? $data["dietitian_number"] : "";                        // 임상영양사자격번호

		// 0509
		$user_idx	 = isset($_SESSION["USER"]["idx"]) ? $_SESSION["USER"]["idx"] : "";

		$sql = "SELECT * FROM member WHERE idx = {$user_idx}";
		$user = sql_fetch($sql);

		$email       = isset($user["email"]) ? $user["email"] : "";								// 이메일
		$nation_no   = isset($user["nation_no"]) ? $user["nation_no"] : "";						// 국가번호
		$last_name   = isset($user["last_name"]) ? $user["last_name"] : "";						// 성
		$first_name  = isset($user["first_name"]) ? $user["first_name"] : "";					// 이름
		$phone       = isset($user["phone"]) ? $user["phone"] : "";								// 휴대폰번호
		$affiliation = isset($user["affiliation"]) ? $user["affiliation"] : "";					// 소속
		$affiliation = htmlspecialchars($affiliation);
		$department  = isset($user["department"]) ? $user["department"] : "";
		$department  = htmlspecialchars($department);
		$ksso_member_status = isset($user["ksola_member_status"]) || $user["ksola_member_status"] == 0 ? $user["ksola_member_status"] : "";
		
		$welcome_reception_yn = $data["others1"] != "no" ? "Y" : "N";
		$day2_breakfast_yn    = $data["others2"] != "no" ? "Y" : "N";
		$day2_luncheon_yn     = $data["others3"] != "no" ? "Y" : "N";
		$day3_breakfast_yn    = $data["others4"] != "no" ? "Y" : "N";
		$day3_luncheon_yn     = $data["others5"] != "no" ? "Y" : "N";
        $promotion_code_number= isset($data["promotion_code"]) ? $data["promotion_code"] : "";                          // 프로모션코드 번호
		$promotion_code       = isset($data["promotion_confirm_code"]) ? $data["promotion_confirm_code"] : "";			// 프로모션코드 할인율(0:100%, 1:50%, 2:30%)
		$recommended_by       = isset($data["recommended_by"]) ? $data["recommended_by"] : "";							// 추천인
		$payment_method       = isset($data["payment_method"]) ? $data["payment_method"] : "";							// 결제 방식(0:카드 결제, 1:계좌 이체)
		$payment_method       = $payment_method == "credit" ? 0 : 1;													
		$conference_info      = implode("*", $data["conference_info_arr"]);									// 정보획득매체

        $special_request      = $data["special_request"] ?? "";                                                            // Special Request For Food

		$price				  = isset($data["reg_fee"]) ? $data["reg_fee"] : "";										// 결제금액
		$total_price		  = isset($data["total_reg_fee"]) ? $data["total_reg_fee"] : "";							// 최종 결제금액

		if(!$update_idx){
			if($price == "" || $total_price == ""){
				$res = [
					code => 400,
					msg => "empty the price data"
				];
				echo json_encode($res);
				exit;
			}

			//$conference_info_arr = $data["conference_info_arr"];
			//$others = implode("*", $data["others_arr"]);																	// 심포지엄일정


			//$member_status = isset($data["member_status"]) ? $data["member_status"] : "";
			//$member_status = htmlspecialchars($member_status);
			//$email = isset($data["email"]) ? $data["email"] : "";
			//$nation_no = isset($data["nation_no"]) ? $data["nation_no"] : "";
			//$last_name = isset($data["last_name"]) ? $data["last_name"] : "";
			//$first_name = isset($data["first_name"]) ? $data["first_name"] : "";
			//$nation_tel = isset($data["nation_tel"]) ? $data["nation_tel"] : "";
			//$phone = isset($data["phone"]) ? $data["phone"] : "";
			//$member_type = isset($data["member_type"]) ? $data["member_type"] : "";
			//$member_type = ($member_type != "Choose") ? $member_type : "";
			//$registration_type = isset($data["registration_type"]) ? $data["registration_type"] : "";
			//2022-05-11 추가
			//$banquet_yn = isset($data["banquet_yn"]) ? $data["banquet_yn"] : "";

			//$affiliation = isset($data["affiliation"]) ? $data["affiliation"] : "";
			//$affiliation = htmlspecialchars($affiliation);
			//$department = isset($data["department"]) ? $data["department"] : "";
			//$department = htmlspecialchars($department);
			//$academy_number = isset($data["academy_number"]) ? $data["academy_number"] : "";
			//$register_path = isset($data["register_path"]) ? $data["register_path"] : "";
			//$register_path = ($register_path != "Choose") ? $register_path : "";
			//$etc = $data["etc"] ?? null;
			//$etc = htmlspecialchars($etc);
			//$result_org = isset($data["result_org"]) ? $data["result_org"] : "";
			//if($nation_tel != "" && $phone != "") {
			//	$phone = $nation_tel."-".$phone;
			//}

			//$write_position = isset($data["write_position"]) ? $data["write_position"] : "";

			////비자 여부
			//$invitation_check_yn = isset($data["invitation_yn"]) ? $data["invitation_yn"] : "";

			//$invitation_nation_no = isset($data["invitation_nation_no"]) ? $data["invitation_nation_no"] : "";
			//$address = isset($data["address"]) ? $data["address"] : "";
			//$address_detail = isset($data["address_detail"]) ? $data["address_detail"] : "";
			//$address_detail = htmlspecialchars($address_detail);
			//$passport_number = isset($data["passport_number"]) ? $data["passport_number"] : "";
			//$date_of_birth = isset($data["date_of_birth"]) ? $data["date_of_birth"] : "";
			//$date_of_issue = isset($data["date_of_issue"]) ? $data["date_of_issue"] : "";
			//$date_of_expiry = isset($data["date_of_expiry"]) ? $data["date_of_expiry"] : "";
			//$length_of_visit = isset($data["length_of_visit"]) ? $data["length_of_visit"] : "";
			//$length_of_visit = htmlspecialchars($length_of_visit);

			$check_registration_query =	"
											SELECT
												r.idx, r.status, 
												p.idx AS payment_idx, p.payment_status
											FROM request_registration AS r
											LEFT JOIN(
												SELECT
													idx, payment_status
												FROM payment
											)AS p
											ON r.payment_no = p.idx
											WHERE is_deleted = 'N'
											AND register = {$user_idx}
											ORDER BY register_date DESC
											LIMIT 1
										";

			$check_registration = sql_fetch($check_registration_query);
			
			$registration_idx = $check_registration["idx"];
			$payment_idx = $check_registration["payment_idx"];
			$payment_status = $check_registration["status"];
		
			if($registration_idx && ($payment_status != "0" && $payment_status != "4")){
				$res = [
					code => 401,
					msg => "already registration"
				];
				echo json_encode($res);
				exit;
			}
		}
		
		$add_set = "";

		// UPDATE
		if($update_idx){
			if($prev["status"] != 2 && $prev["status"] != 3){
				if($category != "") {
					$add_set .= ", member_type = '{$category}' ";

					if($category == 'Others'){
						$add_set .= $category_other != "" ? ", member_other_type = '{$category_other}' " : ", member_other_type = NULL ";
					}else{
						$add_set .= ", member_other_type = NULL ";
					}
				}else{
					$add_set .= ", member_type = NULL ";
					$add_set .= ", member_other_type = NULL ";
				}

				if($data["promotion_confirm_code"] != ''){
                    if($promotion_code_number != "") {
                        $add_set .= ", promotion_code_number = '{$promotion_code_number}' ";
                    }else{
                        $add_set .= ", promotion_code_number = NULL ";
                    }

                    if($promotion_code != "") {
						$add_set .= ", promotion_code = '{$promotion_code}' ";
					}else{
						$add_set .= ", promotion_code = NULL ";
					}

					if($recommended_by != "") {
						$add_set .= ", recommended_by = '{$recommended_by}' ";
					}else{
						$add_set .= ", recommended_by = NULL ";
					}
				}else{
                    $add_set .= ", promotion_code_number = NULL ";
					$add_set .= ", promotion_code = NULL ";
					$add_set .= ", recommended_by = NULL ";
				}

				$add_set .= "
								, attendance_type = {$attendance_type}
								, payment_methods = '{$payment_method}'
								, price = {$total_price}
							";
			}

		// INSERT
		}else{
			if($ksso_member_status !== ""){
				$add_set .= ", ksso_member_status = {$ksso_member_status} ";
			}
			if($affiliation !== "") {
				$add_set .= ", affiliation = '{$affiliation}' ";
			}
			if($department !== "") {
				$add_set .= ", department = '{$department}' ";
			}
			if($category !== "") {
				$add_set .= ", member_type = '{$category}' ";

				if($category == 'Others'){
					$add_set .= $category_other != "" ? ", member_other_type = '{$category_other}' " : ", member_other_type = NULL ";
				}else{
					$add_set .= ", member_other_type = NULL ";
				}
			}
            if($occupation !== "") {
                $add_set .= ", occupation_type = '{$occupation}' ";

                if($occupation == 'Others'){
                    $add_set .= $occupation_other != "" ? ", occupation_other_type = '{$occupation_other}' " : ", occupation_other_type = NULL ";
                }else{
                    $add_set .= ", occupation_other_type = NULL ";
                }
            }

			if($data["promotion_confirm_code"] !== ''){
				if($promotion_code_number != ""){
                    $add_set .= ", promotion_code_number = '{$promotion_code_number}' ";
                }
                if($promotion_code != "") {
					$add_set .= ", promotion_code = '{$promotion_code}' ";
				}
				if($recommended_by != "") {
					$add_set .= ", recommended_by = '{$recommended_by}' ";
				}
			}
			
			if($payment_method !== "") {
				$add_set .= ", payment_methods = '{$payment_method}' ";
			}
		}

		// COMMON
		if($rating !== "") {
			$add_set .= ", is_score = {$rating} ";
		}else{
			$add_set .= ", is_score = NULL ";
		}
		
		if($licence_number !== "") {
			$add_set .= ", licence_number = '{$licence_number}' ";
		}else{
			$add_set .= ", licence_number = NULL ";
		}

		if($specialty_number !== "") {
			$add_set .= ", specialty_number = '{$specialty_number}' ";
		}else{
			$add_set .= ", specialty_number = NULL ";
		}

		if($nutritionist_number !== "") {
			$add_set .= ", nutritionist_number = '{$nutritionist_number}' ";
		}else{
			$add_set .= ", nutritionist_number = NULL ";
		}

        if($dietitian_number !== "") {
            $add_set .= ", dietitian_number = '{$dietitian_number}' ";
        }else{
            $add_set .= ", dietitian_number = NULL ";
        }

		if($academy_number !== "") {
			$add_set .= ", academy_number = '{$academy_number}' ";
		}else{
			$add_set .= ", academy_number = NULL ";
		}

		if($register_path !== "") {
			$add_set .= ", register_path = '{$register_path}' ";
		}else{
			$add_set .= ", register_path = NULL ";
		}

        if(!empty($etc)){
            $add_set .= ", etc1 = '{$etc}' ";
        }else{
			$add_set .= ", etc1 = NULL ";
		}

        if(!empty($result_org)){
            $add_set .= ", etc2 = '{$result_org}' ";
        }else{
			$add_set .= ", etc2 = NULL ";
		}

		if($invitation_nation_no !== "") {
			$add_set .= ", invitation_nation_no = '{$invitation_nation_no}' ";
		}else{
			$add_set .= ", invitation_nation_no = NULL ";
		}

		if($address !== "") {
			$add_set .= ", address = '{$address}' ";
		}else{
			$add_set .= ", address = NULL ";
		}

		if($address_detail !== "") {
			$add_set .= ", address_detail = '{$address_detail}' ";
		}else{
			$add_set .= ", address_detail = NULL ";
		}

		if($passport_number !== "") {
			$add_set .= ", passport_number = '{$passport_number}' ";
		}else{
			$add_set .= ", passport_number = NULL ";
		}

		if($date_of_birth !== "") {
			$add_set .= ", date_of_birth = '{$date_of_birth}' ";
		}else{
			$add_set .= ", date_of_birth = NULL ";
		}

		if($date_of_issue !== "") {
			$add_set .= ", date_of_issue = '{$date_of_issue}' ";
		}else{
			$add_set .= ", date_of_issue = NULL ";
		}

		if($date_of_expiry !== "") {
			$add_set .= ", date_of_expiry = '{$date_of_expiry}' ";
		}else{
			$add_set .= ", date_of_expiry = NULL ";
		}

		if($length_of_visit !== "") {
			$add_set .= ", length_of_visit = '{$length_of_visit}' ";
		}else{
			$add_set .= ", length_of_visit = NULL ";
		}

		if($write_position !== "") {
			$add_set .= ", write_position = '{$write_position}' ";
		}else{
			$add_set .= ", write_position = NULL ";
		}

		if($conference_info !== "") {
			$add_set .= ", conference_info = '{$conference_info}' ";
		}else{
			$add_set .= ", conference_info = NULL ";
		}

        if($special_request !== ""){
            $add_set .= ", special_request_food = {$special_request} ";
        }

		if($update_idx){
			$sql =	"
					UPDATE request_registration
					SET
						modifier = '{$user_idx}',
						modify_date = NOW(),
						welcome_reception_yn = '{$welcome_reception_yn}',
						day2_breakfast_yn = '{$day2_breakfast_yn}',
						day2_luncheon_yn = '{$day2_luncheon_yn}',
						day3_breakfast_yn = '{$day3_breakfast_yn}',
						day3_luncheon_yn = '{$day3_luncheon_yn}'
						{$add_set}
					WHERE idx = {$update_idx}
					";
		}else{
			$sql =	"
					INSERT request_registration
					SET
						attendance_type = {$attendance_type},
						email = '{$email}',
						nation_no = {$nation_no},
						last_name = '{$last_name}',
						first_name = '{$first_name}',
						phone = '{$phone}',
						register = '{$user_idx}',
						welcome_reception_yn = '{$welcome_reception_yn}',
						day2_breakfast_yn = '{$day2_breakfast_yn}',
						day2_luncheon_yn = '{$day2_luncheon_yn}',
						day3_breakfast_yn = '{$day3_breakfast_yn}',
						day3_luncheon_yn = '{$day3_luncheon_yn}',
						price = {$total_price}
						{$add_set}
					";
		}

		$res = sql_query($sql);
		if($res) {
			//사전등록
			if(!$update_idx){
				$sql = "SELECT LAST_INSERT_ID() AS last_idx";
				$registration_idx = sql_fetch($sql)['last_idx'];
			}else{
				$registration_idx = $update_idx;
			}

			$check_user_query =	"
										SELECT
											idx, email, first_name, last_name, title
										FROM member
										WHERE email = '{$email}'
										AND is_deleted = 'N'
									";
		
			$check_user = sql_fetch($check_user_query);

			$name = $check_user["last_name"]." ".$check_user["first_name"];
			
			// 2023-05-11 mailer 작업때문에 잠시 막아둠
			//mailer("en", "registration", $name , $email, "[ICOMES] Registration Invitation", date("Y-m-d H:i:s"), "", "", 1, "", "", "", "", "", "", "", "", $data, $registration_idx);


			$regustration_query = "SELECT
										idx, attendance_type, is_score, nation_no, phone,
										member_type, ksso_member_status, registration_type, affiliation, department,
										licence_number, specialty_number, nutritionist_number, dietitian_number, academy_number, register_path,
										welcome_reception_yn, day2_breakfast_yn, day2_luncheon_yn, day3_breakfast_yn, day3_luncheon_yn, 
										conference_info, price, payment_no,
										DATE_FORMAT(register_date, '%m-%d-%Y %h:%i:%s') AS register_date
									FROM request_registration
									WHERE idx= {$registration_idx}";

			$data = sql_fetch($regustration_query);

			if(!$data["payment_no"] && $total_price < 1) {
				//현장등록
				$unit_col = ($nation_no != 25) ? "us" : "kr";
				$insert_payment_query = "INSERT INTO 
												payment 
												(
													`type`, payment_type, payment_type_name, payment_status, 
													payment_price_{$unit_col}, tax_{$unit_col}, total_price_{$unit_col}, 
													payment_date, register_date, register
												)
											VALUES
												(
													3, 2, '무료 신청', 2, 0, 0, 0, NOW(), NOW(), '{$user_idx}'
												)";
				sql_query($insert_payment_query);
				$payment_new_no = sql_insert_id();

				sql_query("UPDATE request_registration SET `status` = 2, payment_no = '{$payment_new_no}' WHERE idx = '{$registration_idx}'");

				$data["pay_type"] = "free";
			}else{
				$data["pay_type"] = $payment_method == 0 ? "card" : "bank";
			}

			$data["name_title"] = $check_user["title"] ?? "";
			$data["payment_date"] = date("Y-m-d H:i:s");

			echo json_encode(array(
				code => 200,
				msg => "success",
				registration_idx => $registration_idx,
				email => $data["pay_type"] == "card" ? null : $email,
				name => $data["pay_type"] == "card" ? null : $name,
				data => $data
			));
			exit;
		} else {
			echo json_encode(array(
				code => 400,
				msg => "error"
			));
			exit;
		}
	} else if($_POST["flag"] == "update") {
		$user_idx = $_SESSION["USER"]["idx"];
		$idx = isset($_POST["idx"]) ? $_POST["idx"] : "";
		//$_POST = isset($_POST["data"]) ? $_POST["data"] : "";

		if($idx == "") {
			$res = [
				code => 401,
				msg => "no idx"
			];
			echo json_encode($res);
			exit;
		}

		//$banquet_yn = isset($_POST["banquet_yn"]) ? $_POST["banquet_yn"] : "";

		//if(!empty($banquet_yn)) {
		//	$banquet = "banquet_yn = '{$banquet_yn}', ";
		//}

		$nation_no = isset($_POST["nation_no"]) ? $_POST["nation_no"] : "";
		$affiliation = isset($_POST["affiliation"]) ? $_POST["affiliation"] : "";
		$department = isset($_POST["department"]) ? $_POST["department"] : "";
		$licence_number = isset($_POST["licence_number"]) ? $_POST["licence_number"] : "";
		//$academy_number = isset($_POST["academy_number"]) ? $_POST["academy_number"] : "";
		$rating = isset($_POST["rating"]) ? $_POST["rating"] : "";

		$member_status = isset($_POST["member_status"]) ? $_POST["member_status"] : "";
		$etc2 = isset($_POST["etc2"]) ? $_POST["etc2"] : "";

		$update_registration_query =	"
											UPDATE request_registration
											SET
												{$banquet}
												etc2		= '{$etc2}',
												nation_no   = {$nation_no},
												affiliation = '{$affiliation}',
												department = '{$department}',
												licence_number = '{$licence_number}',
												#academy_number = '{$academy_number}',
												is_score		= '{$rating}',
												member_status	= '{$member_status}',
												modifier = {$user_idx},
												modify_date = NOW()
											WHERE idx = {$idx}
										";

		$update = sql_query($update_registration_query);

		if($update) {
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
	} else if($_POST["flag"] == "cancel") {
		$user_idx = $_SESSION["USER"]["idx"];
		$registration_idx = isset($_POST["idx"]) ? $_POST["idx"] : "";
		
		$select_payment_idx_query =	"
									SELECT
										payment_no, register
									FROM request_registration
									WHERE idx = {$registration_idx}
									";

		$payment = sql_fetch($select_payment_idx_query);

		if($user_idx == "" || $payment["register"] != $user_idx){
			// 허가받지 않은 사람이나 타인이 요청한 경우
			$res = [
				code => 401,
				msg => "invalid auth"
			];
			echo json_encode($res);
			exit;
		}

		if($payment["payment_no"]){
			// 이미 결제건은 취소가 불가능하고 환불요청으로 넘어가야됨.
			$res = [
				code => 402,
				msg => "invalid request status"
			];
			echo json_encode($res);
			exit;
		}

        // 프로모션코드 취소
        $select_promotion_query =	"
											SELECT idx, registration_idx, promotion_code_idx
											FROM management_promotion_code
											WHERE registration_idx = '{$registration_idx}'
										";
        $promotion_code_idx = sql_fetch($select_promotion_query)['promotion_code_idx'];

        if($promotion_code_idx){
            $update_promotion_query =	"
											UPDATE promotion_code
											SET 
												count_limit = '1'
											WHERE idx = '{$promotion_code_idx}'
										";
            $update_promotion_result = sql_query($update_promotion_query);
        }

		$update_registration_query =	"
											UPDATE request_registration
											SET 
												status = '0',
												is_deleted = 'Y',
												delete_date = NOW()
											WHERE idx = {$registration_idx}
										";
		$update_payment = sql_query($update_registration_query);

		if($update_payment) {
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

	} else if($_POST["flag"] == "refund") {
		$user_idx = $_SESSION["USER"]["idx"];
		$registration_idx = isset($_POST["idx"]) ? $_POST["idx"] : "";
		$payment_status = isset($_POST["payment_status"]) ? $_POST["payment_status"] : "";
		
		$update_status = $payment_status == 1 ? "0" : "3"; //결제상태가 결제대기였으면 결제상태를 등록취소(0)로 결제 완료상태이였을땐 환불대기(3) 상태로
		
		$select_payment_idx_query =	"
									SELECT
										payment_no
									FROM request_registration
									WHERE idx = {$registration_idx}
									";

		$payment_no = sql_fetch($select_payment_idx_query)["payment_no"];

		$update_registration_query =	"
											UPDATE request_registration
											SET
												`status` = '{$update_status}',
												modifier = '{$user_idx}',
												modify_date = NOW()
											WHERE idx = '{$registration_idx}'
										";

		$update_registration = sql_query($update_registration_query);

		if(!$update_registration) {
			$res = [
				code => 400,
				msg => "registration query error"
			];
			echo json_encode($res);
			exit;
		}

		$update_payment_query =		"
										UPDATE payment
										SET 
											payment_status = '{$update_status}'
									";

		if($update_status == "3") {
			$update_payment_query .=	" , refund_request_date = NOW() ";
		}

		$update_payment_query .= " WHERE idx = {$payment_no} ";

		$update_payment = sql_query($update_payment_query);

		 if(!$update_payment) {
			$res = [
				code => 400,
				msg => "payment query error"
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

	} else if($_POST["flag"] == "registration_information") {
		$registration_idx = isset($_POST["idx"]) ? $_POST["idx"] : "";

		$registration_info_query =	"
										SELECT
											reg.*, payment.payment_status
										FROM request_registration reg
										LEFT JOIN payment
										ON reg.payment_no = payment.idx
										WHERE reg.idx = {$idx}
									";

		$registration_info = sql_fetch($registration_info_query);

		if($registration_info) {
			$res = [
				code => 200,
				msg => "success",
				data => $registration_info
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
	} else if($_POST["flag"] == "calc_fee") {
		$user_idx = $_SESSION["USER"]["idx"];
		$category = $_POST["category"];
        $country = $_POST["country"] ?? "";

		// 카테고리별 상품금액 조회
		$calc_fee_query =	"
								SELECT
									on_member_usd, on_guest_usd, on_member_krw, on_guest_krw
								FROM info_event_price
								WHERE type_en = '{$category}';
							";
		$calc_fee = sql_fetch($calc_fee_query);

		$result = calcFee($user_idx, $category, $country);
		
		//$result = isset($calc_fee["on_member_usd"]) ? $calc_fee["on_member_usd"] : "0";
		if($calc_fee) {

			$res = [
				'code' => 200,
				'msg' => "success",
				'data' => $result,
				'country' => $country
			];
			echo json_encode($res);
			exit;

		} else {

			$res = [
				'code' => 400,
				'msg' => "error",
			];
			echo json_encode($res);
			exit;

		}
	} 

	function calcFee($user_idx, $category, $country){
		// 회원검증
		$sql = "SELECT 
					m.idx, 
					IF(korea_nation.idx IS NOT NULL, 1, 0) AS is_korean, 
					ksola_member_status 
				FROM member AS m
				LEFT JOIN(
					SELECT idx FROM nation WHERE nation_tel = '82'
				)AS korea_nation
				ON m.nation_no = korea_nation.idx
				WHERE m.is_deleted = 'N' 
				AND m.`status` = 'Y' 
				AND m.idx = {$user_idx}
			   ";
		$member = sql_fetch($sql);

		$member_idx = $member["idx"] ?? NULL;
		$member_is_korean = $member["is_korean"] ?? 0;
		$member_ksola = $member["ksola_member_status"] ?? NULL;
		
		// 카테고리별 상품금액 조회
		$calc_fee_query =	"
								SELECT
									on_member_usd, on_guest_usd, on_member_krw, on_guest_krw
								FROM info_event_price
								WHERE type_en = '{$category}';
							";
		$calc_fee = sql_fetch($calc_fee_query);

//		if($member_is_korean == 1 || $country==25){
//			if($member_ksola >= 1){
//                if($country==25){
//				    $result = $calc_fee["on_member_krw"];
//                }
//			}else{
//                if($country==25){
//				    $result = $calc_fee["on_guest_krw"];
//                }
//			}
//		}else{
//			if(($member_idx && !isset($calc_fee["on_member_usd"])) || (!$member_idx && !isset($calc_fee["on_guest_usd"]))){
//				echo json_encode(array("code"=>403, "msg"=>"Not invalid price type"));
//				exit;
//			}
//
//			if($member_ksola >= 1){
//				$result = $calc_fee["on_member_usd"];
//			}else{
//				$result = $calc_fee["on_guest_usd"];
//			}
//		}

//        print_r($calc_fee);
//        print_r("memberiskorean=".$member_is_korean);
//        print_r("memberksola=".$member_ksola);

        if($country==null){
            if($member_is_korean == 1){
                if($member_ksola >= 1){
                    $result = $calc_fee["on_member_krw"];
                }else{
                    $result = $calc_fee["on_guest_krw"];
                }
            }else{
                if(($member_idx && !isset($calc_fee["on_member_usd"])) || (!$member_idx && !isset($calc_fee["on_guest_usd"]))){
                    echo json_encode(array("code"=>403, "msg"=>"Not invalid price type"));
                    exit;
                }

                if($member_ksola >= 1){
                    $result = $calc_fee["on_member_usd"];
                }else{
                    $result = $calc_fee["on_guest_usd"];
                }
            }
        } else {
            if($country == 25){
                if($member_ksola >= 1){
                    $result = $calc_fee["on_member_krw"];
                }else{
                    $result = $calc_fee["on_guest_krw"];
                }
            }else{
                if(($member_idx && !isset($calc_fee["on_member_usd"])) || (!$member_idx && !isset($calc_fee["on_guest_usd"]))){
                    echo json_encode(array("code"=>403, "msg"=>"Not invalid price type"));
                    exit;
                }

                if($member_ksola >= 1){
                    $result = $calc_fee["on_member_usd"];
                }else{
                    $result = $calc_fee["on_guest_usd"];
                }
            }
        }

		return $result;
	}
?>