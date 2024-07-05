<?php include_once("../../common/common.php");?>
<?php include_once("../../common/locale.php");?>

<?php
//include_once('../../common/common.php');
// error_reporting( E_ALL );
// ini_set( "display_errors", 1 );
include_once('../../plugin/google-api-php-client-main/vendor/autoload.php');


$language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
$locale = locale($language);

//define('DOMAIN', "http://54.180.8s6.106/main");
if (php_sapi_name() != 'cli') {
    //throw new Exception('This application must be run on the command line.');
}

$input_post = json_decode(file_get_contents("php://input"), true);
$_POST = empty($_POST) ? $input_post : $_POST;


/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Gmail API PHP Quickstart');
    //$client->setScopes(Google_Service_Gmail::GMAIL_READONLY);
	$client->setAuthConfig('../../plugin/google-api-php-client-main/imcvp2024_credentials.json');
	$client->setIncludeGrantedScopes(true);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
	//$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');

	//$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	
	$redirect_uri = 'https://imcvp.org/main/ajax/client/ajax_gmail.php';
	$client->setRedirectUri($redirect_uri);

	//$client->Authorization("Bearer ya29.a0ARrdaM9mYnPVm2C5-i9h0Av545RZ-52p3qi5fTvhrf4Jyo01DFwZQDCm21sDfNbD6rsq6rYG5V3Us2Pi0yZFcFgVWwnISInUUlbk8b_S0sx81ysEJb0mc3axZWlMAxpCpd4oQgHgNSS0_ho4apRgpNUA9Eae");
	//$client->addScope('https://www.googleapis.com/auth/gmail.labels');
	
	$client->addScope('https://www.googleapis.com/auth/gmail.readonly');
	//$client->addScope('https://www.googleapis.com/auth/analytics.readonly');
	//$client->addScope('https://www.googleapis.com/auth/gmail.send');
	//$client->addScope('https://www.googleapis.com/auth/gmail.compose');
	//$client->addScope('https://www.googleapis.com/auth/gmail.insert');
	$client->addScope('https://www.googleapis.com/auth/gmail.modify');
	//$client->addScope('https://www.googleapis.com/auth/gmail.metadata');
	//$client->addScope('https://www.googleapis.com/auth/gmail.settings.basic');
	//$client->addScope('https://www.googleapis.com/auth/gmail.settings.sharing');
	$client->addScope('https://mail.google.com/');


    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'imcvp2024_token.json';

	// online server
	if($_SERVER['HTTP_HOST'] === "www.imcvp.org" || $_SERVER['HTTP_HOST'] === "imcvp.org") {
		$tokenPath = 'imcvp2024_token.json';
	}

    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        //file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}





// Get the API client and construct the service object.
$client = getClient();

$service = new Google_Service_Gmail($client);

// Print the labels in the user's account.
$user = 'secretariat@imcvp.org';


function createMessage($language, $mail_type, $fname, $to, $subject, $time, $tmp_password, $callback_url, $type=0, $file="", $cc="", $bcc="", $id="", $date="", $category="", $title="", array $data = [], $registration_no = "") {
 $message = new Google_Service_Gmail_Message();

	if($_SERVER["HTTP_HOST"] == "43.200.170.254") {
		$background_img_url = "https://icomes-hub.store";
	} else {
		$background_img_url = "https://imcvp.org";
	}

 $rawMessageString = "From:IMCVP2024<secretariat@imcvp.org>\r\n";
 $rawMessageString .= "To: <{$to}>\r\n";
 $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
 $rawMessageString .= "MIME-Version: 1.0\r\n";
 $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
 $rawMessageString .= 'Reply-To: sci@imcvp.org' . "\r\n";
 //$rawMessageString .= "Content-Type: text/html; charset=iso-8859-1\r\n";
 //$rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
 $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";

if($language == "ko") {
	if($mail_type == "find_password") {
		 $rawMessageString.= "<div style='width:670px;background-color:#fff;'>
								<img src='https://imcvp.org/main/img/2024_mail_header-2.png' style='width:100%;margin-bottom:60px;'>
								<div style='margin-left:60px;margin-bottom:40px;'>
									<p style='text-align:left;font-size:15px;color:#170F00;line-height:1.8;'>{$fname} 회원님은<br>{$time} 에 임시 비밀번호 요청을 하셨습니다.</p>
									<p style='text-align:left;font-size:12px;color:#AAAAAA;margin-top:22px;'>(만약 임시 비밀번호를 요청하신 적이 없다면 해당 메일을 삭제해 주십시오.)</p>
									<p style='text-align:left;font-size:12px;color:#170F00;margin-top:42px;line-height:1.8;'>저희 사이트는 관리자라도 회원님의 비밀번호를 알 수 없기 때문에,<br>
									비밀번호를 알려드리는 대신 새로운 비밀번호를 생성하여 안내 해드리고 있습니다.<br>아래에서 변경될 비밀번호를 확인하신 후,</p>
									<p style='font-size:13px;color:#FF0000;margin-top:17px;'>임시 비밀번호로 변경 버튼을 클릭하십시오.</p>
									<p style='text-align:left;font-size:12px;color:#170F00;margin-top:42px;line-height:1.8;'>비밀번호가 변경되었다는 인증 메시지가 출력되면,<br>
									홈페이지에서 회원아이디와 변경된 비밀번호를 입력하시고 로그인 하십시오.</p>
									<p style='text-align:left;font-size:12px;color:#AAAAAA;margin-top:17px;'>로그인 후에는 정보수정 메뉴에서 새로운 비밀번호로 변경해 주십시오.</p>
									<p style='text-align:left;font-size:13px;color:#170F00;margin-top:32px;'>회원아이디<span style='text-align:left;font-size:14px;color:#170F00;margin-left:5px;'>{$id}</span></p>
									<p style='text-align:left;font-size:13px;color:#170F00;margin-top:11px;'>변경될 비밀번호<span style='text-align:left;font-size:14px;color:#170F00;margin-left:5px;'>{$tmp_password}</span></p>
									<p style='text-align:left;font-size:14px;color:#170F00;margin-top:51px;'>ICOMES 드림</p>
								</div>
								<a href='{$callback_url}' style='display:block;text-decoration:none;text-align:center;width:180px;max-width:180px;background:#fff;margin-left:60px;border:1px solid #585859;border-radius:30px;padding:14px 50px;background:#fff;cursor:pointer;color:#000;'>임시 비밀번호로 변경</a>
								<img src='https://imcvp.org/main/img/2024_mail_footer-2.png' style='width:100%;margin-top:60px;'>
							</div>";
	}
} else {
	if($mail_type == "sign_up") {
			/* 23.05.12 HUBDNC_NYM 템플릿 변경으로 인해 해당 부분 주석*/
			/*
            $template = new Template($_SERVER["DOCUMENT_ROOT"]."/main/common/lib/confirm.php");
            $template->set('callback_url', $callback_url);
            $content = $template->render();         
			*/
			$data = isset($_POST["data"]) ? $_POST["data"] : "";
			/*
			$mail_query = "SELECT 
								email, last_name, first_name, first_name_kor, last_name_kor, affiliation, affiliation_kor, phone
							FROM member
							WHERE idx = {$user_idx};";
			$user_data = sql_fetch($mail_query);
			*/
			$email = $data["email"];
			$last_name = $data["last_name"];
			$first_name = $data["first_name"];
			$first_name_kor = $data["first_name_kor"];
			$last_name_kor = $data["last_name_kor"];
			$affiliation = $data["affiliation"];
			$affiliation_kor = $data["affiliation_kor"];
			$phone = $data["phone"];
			$title = $data["title"] ?? NULL;

			// 23.05.15 HUBDNC_NYM TITLE 변경 건으로 수정
			if (!empty($title)) {
				switch($title) {
					case "0":
						$title_input = "Professor";
					break;
					case "1":
						$title_input = "Dr.";
					break;
					case "2":
						$title_input = "Mr.";
					break;
					case "3":
						$title_input = "Ms.";
					break;
					case "4":
						$title_input = $data["title_input"];
					break;
				}
			}
			$nation_no = $data["nation_no"];
			
			if($nation_no == 25){
				$name_kor_cont = "<tr>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>성명</th>
									<td style='font-size:14px; padding:10px; border-left:1px solid #000; width:165px; border-bottom:1px solid #000;'>{$first_name_kor}</td>
									<td style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'>{$last_name_kor}</td>
								</tr>";
				$affiliation_kor_cont = "<tr>
											<th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>소속</th>
											<td colspan='2' style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'>{$affiliation_kor}</td>
										</tr>";

				
			}else {
				$name_kor_cont = "";
				$affiliation_kor_cont = "";
			}

							//<img src='".$background_img_url."/img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
			// 23.05.15 HUBDNC_LJH 이메일 템플릿 변경 
			$rawMessageString.= "
								<table width='750' style='border:1px solid #000; padding: 0;'>
									<tbody>
										<tr>
											<td colspan='3'>
												<img src='https://imcvp.org/main/img/2024_mail_header-2.png' width='750' style='width:750px;'>
											</td>
										</tr>
										<tr>
											<td colspan='3'>
												<div style='font-weight:bold; text-align:center;font-size: 21px; color: #257FE6;padding: 20px 0;'>[IMCVP 2024] Welcome to IMCVP 2024!</div>
											</td>
										</tr>
										<tr>
											<td width='74' style='width:74px;'></td>
											<td>
												<div>
													<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear {$first_name} {$last_name},</p>
													<p style='font-size:14px;color:#170F00;margin-top:14px;'>Thank you for signing up for the IMCVP 2024.<br>Your profile has been successfully created.<br>Please review the information that you have entered as below.<br>If necessary, you can access <b>‘IMCVP 2024 website - MY IMCVP’</b> to review, modify or update your personal information.</p>
													<table width='586' style='width:586px; border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
														<tbody>
															<tr>
																<th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>ID (Email Address)</th>
																<td colspan='2' style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'><a href='mailto:{$email}' class='link font_inherit'>{$email}</a></td>
															</tr>
															<tr>
																<th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>Name</th>
																<td style='font-size:14px; padding:10px; border-left:1px solid #000; width:165px; border-bottom:1px solid #000;'>{$first_name}</td>
																<td style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'>{$last_name}</td>
															</tr>
															{$name_kor_cont}
															<tr>
																<th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>Affiliation</th>
																<td colspan='2' style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'>{$affiliation}</td>
															</tr>
															{$affiliation_kor_cont}
															<tr>
																<th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>Telephone number</th>
																<td colspan='2' style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'>{$phone}</td>
															</tr>
														</tbody>	
													</table>
													<p>We express our gratitude to you for your interest in IMCVP 2024.</p>
												</div>
											</td>
											<td width='74' style='width:74px;'></td>
										</tr>
										<tr>
											<td width='74' style='width:74px;'></td>
											<td style='padding-top:16px;'>
												<p>Warmest regards,</p>
												<div style='text-align: center; padding-top:30px;'>
								<table align='center' cellspacing='0' cellpadding='0' width='100%'>
									<tr>
										<td align='center'>
											<table border='0' class='mobile-button' cellspacing='0' cellpadding='0'>
												<tr>
													<td align='center' bgcolor='#ffcc33' style='background-color: #000066; margin: auto; max-width: 600px; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding: 12px 32px;box-shadow: 0px 5px 0px 0px #000066;' width='100%'><!--[if mso]>&nbsp;<![endif]-->
														<a href='https://imcvp.org/main/registration.php' target='_blank' style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #003466; font-weight:600; text-align:center; background-color: #000066; text-decoration: none; border: none; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; display: inline-block;'>
															<span style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #fff; font-weight:600; text-align:center;'>Go to registration</span>
														</a><!--[if mso]>&nbsp;<![endif]-->
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</div>
											</td>
											<td width='74' style='width:74px;'></td>
										</tr>
										<tr>
											<td colspan='3' style='padding-top:50px;'>
												<img src='https://imcvp.org/main/img/2024_mail_footer-2.png' width='750' style='width:750px;'>
											</td>
										</tr>
									</tbody>
								</table>

			";
		
	}

	if($mail_type == "find_password") {
		 $rawMessageString .= "
		 <table width='750' style='border:1px solid #000; padding: 0;'>
		 <tbody>
			 <tr>
				 <td colspan='3'>
					 <img src='https://imcvp.org/main/img/2024_mail_header-2.png' width='750' style='width:100%; max-width:100%;'>
				 </td>
			 </tr>
			 <tr>
				 <td colspan='3'>
					 <div style='font-weight:bold; text-align:center;font-size: 21px; color: #257FE6;padding: 20px 0;'>[IMCVP 2024] Temporary Password</div>
				 </td>
			 </tr>
			 <tr>
				 <td width='74' style='width:74px;'></td>
				 <td>
					 <div>
						 <div style='margin-bottom:20px'>
							 <p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Member of : {$fname}<br><span style='font-size:14px;color:#170F00;font-weight:normal;'>You requested a temporary password at : {$time}</span></p>
						 </div>
						 <p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p>
						 <p style='font-size:14px;color:#170F00;margin-top:14px;'>You can log in to the IMCVP 2024 website using the ID & Temporary Password below and modify your password on the personal information on MY IMCVP.</p>
						 <table width='586' style='width:586px; border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
							 <tbody>
								 <tr>
									 <th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>ID(Email Address)</th>
									 <td style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'><a href='mailto:{$to}' class='link font_inherit'>{$to}</a></td>
								 </tr>
								 <tr>
									 <th style='width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;'>Temporary Password</th>
									 <td style='font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'>{$tmp_password}</td>
								 </tr>
							 </tbody>	
						 </table>
						 <p style='color:#f00;'>Click the 'Change to temporary password' button to check your changed log-in information.</p>
					 </div>
				 </td>
				 <td width='74' style='width:74px;'></td>
			 </tr>
			 <tr>
				 <td width='74' style='width:74px;'></td>
				 <td>
					 <div style='text-align: center; padding-top:30px;'>
			 <table align='center' cellspacing='0' cellpadding='0' width='100%'>
				 <tr>
					 <td align='center'>
						 <table border='0' class='mobile-button' cellspacing='0' cellpadding='0'>
							 <tr>
								 <td align='center' bgcolor='#ffcc33' style='background-color: #000066; margin: auto; max-width: 600px; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding: 12px 32px;box-shadow: 0px 5px 0px 0px #000066;' width='100%'><!--[if mso]>&nbsp;<![endif]-->
									 <a href='{$callback_url}' target='_blank' style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #003466; font-weight:600; text-align:center; background-color: #000066; text-decoration: none; border: none; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; display: inline-block;'>
										 <span style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #fff; font-weight:600; text-align:center;'>Change to temporary password</span>
									 </a><!--[if mso]>&nbsp;<![endif]-->
								 </td>
							 </tr>
						 </table>
					 </td>
				 </tr>
			 </table>
		 </div>
					 <p>Best regards,</p>
				 </td>
				 <td width='74' style='width:74px;'></td>
			 </tr>
			 <tr>
				 <td colspan='3' style='padding-top:50px;'>
					 <img src='https://imcvp.org/main/img/2024_mail_footer-2.png' width='750' style='width:100%; max-width:100%;'>
				 </td>
			 </tr>
		 </tbody>
	 </table>
		 ";
	}

	if($mail_type == "payment") {
			$name_title = $data["name_title"] ?? "";

			$register_no = $data["idx"] ? "IMCVP2024-".$data["idx"] : "-";

			if(!empty($data["idx"])){
				$code_number = $data["idx"];

				while (strlen("" . $code_number) < 4) {
					$code_number = "0" . $code_number;
				}

				$register_no = "IMCVP2024". "-" . $code_number;
			}
			$register_date = $data["register_date"] ?? "-";

			$licence_number = $data["licence_number"] ? $data["licence_number"] : "Not applicable";
			$specialty_number = $data["specialty_number"] ? $data["specialty_number"] : "Not applicable";
			$nutritionist_number = $data["nutritionist_number"] ? $data["nutritionist_number"] : "Not applicable";
			$dietitian_number = $data["dietitian_number"] ? $data["dietitian_number"] : "Not applicable";

			$attendance_type = $data["attendance_type"] ?? "-";
			switch($attendance_type) {
				case 0:
					$attendance_type = "Committee";
					break;
				case 1:
					$attendance_type = "Invited Speaker";
					break;
				case 2:
					$attendance_type = "Chairperson";
					break;
				case 3:
					$attendance_type = "Panel";
					break;
				case 4:
					$attendance_type = "General Participants";
					break;
                case 5:
                    $attendance_type = "Sponsor";
                    break;
			}

			$is_score = $data["is_score"] ?? "";
			$is_score = ($is_score == 1) ? "필요" : "불필요";

			/*
			$member_status = $data["member_status"] ?? "-";
			$member_status = ($member_status == 1) ? "Yes" : "No";
			*/
			$member_status = $data["ksso_member_status"] ?? "-";
            if($member_status == 0) {
                $member_status = "No";
            } else {
                $member_status = "Yes";
            }

			$nation_no = $data["nation_no"] ?? "";
			$nation_sql = "SELECT
								idx, nation_en, nation_tel
							FROM nation
							WHERE idx = {$nation_no}";
			
			$nation = sql_fetch($nation_sql);
			$nation_tel = $nation["nation_tel"] ?? "";
			$nation_en = $nation["nation_en"] ?? "-";

			$phone = $data["phone"] ?? "";
			$member_type = $data["member_type"] ?? "";
			$registration_type = $data["registration_type"] ?? "-";
			$registration_type = ($registration_type == 0) ? "Yes" : "No";

			$affiliation = $data["affiliation"] ?? "-";
			$department = $data["department"] ?? "-";
			$academy_number = $data["academy_number"] ?? "-"; 

			// 평점리뷰
			$review_html = "";

			if($nation_tel == 82){
				$review_html = "
								<tr style='border-bottom:1px solid #000;'>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>평점신청</th>
									<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$is_score}</td>
								</tr>
								<tr style='border-bottom:1px solid #000;'>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>의사 면허번호</th>
									<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$licence_number}</td>
								</tr>
								<tr style='border-bottom:1px solid #000;'>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>전문의 번호</th>
									<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$specialty_number}</td>
								</tr>
							   ";
			}

			// Others
			$day1_luncheon_yn = $data["day1_luncheon_yn"] ?? "N";
			$day1_satellite_yn = $data["day1_satellite_yn"] ?? "N";
			$day2_breakfast_yn = $data["day2_breakfast_yn"] ?? "N";
			$day2_luncheon_yn = $data["day2_luncheon_yn"] ?? "N";
			$day2_satellite_yn = $data["day2_satellite_yn"] ?? "N";

			$other_html = "";

			if($day1_luncheon_yn == "Y"){
				$other_html .= "
								<label for='other1'><i></i>Day 1 Luncheon Symposium – November 29 (Fri)</label>
							   ";
			}
			if($day1_satellite_yn == "Y"){
				$other_html .= $other_html != "" ? "<br/>" : "";
				$other_html .= "
								<label for='other5'><i></i>Day 1 Satellite Symposium – September 9(Sat)</label>
							   ";
			}
			if($day2_breakfast_yn == "Y"){
				$other_html .= $other_html != "" ? "<br/>" : "";
				$other_html .= "
								<label for='other2'><i></i>Day 2 Breakfast Symposium – November 29 (Fri)</label>
							   ";
			}
			if($day2_luncheon_yn == "Y"){
				$other_html .= $other_html != "" ? "<br/>" : "";
				$other_html .= "
								<label for='other3'><i></i>Day 2 Luncheon Symposium – November 30 (Sat)</label>
							   ";
			}
			if($day2_satellite_yn == "Y"){
				$other_html .= $other_html != "" ? "<br/>" : "";
				$other_html .= "
								<label for='other4'><i></i>Day 2 Satellite Symposium – November 30 (Sat)</label>
							   ";
			}
			

			if($other_html == "") $other_html = "-";

			// Conference Info
			$info_html = "";
			$info = explode("*", $data["conference_info"] ?? "");

			for($a = 0; $a < count($info); $a++){
				if($info[$a]){
					$info_html .= $info_html != "" ? "<br/>" : "";
					$info_html .= "
									<label for='conference".$a."'><i></i>".$info[$a]."</label>
								  ";
				}
			}

			if($info_html == "") $info_html = "-";

			// Price
			$pay_type = $data["pay_type"] ?? "";
			$pay_name = "-";

			if($pay_type == "card") $pay_name = "Credit Card";
			else if($pay_type == "bank") $pay_name = "Wire Transfer";
			else if($pay_type == "free") $pay_name = "Free";
			else $pay_name = "ETC";

			$pay_date = $data["payment_date"] ?? "-";
			
			$pay_price = $data["price"] ? number_format($data["price"]) : "-";
			$pay_current = $nation_tel == "82" ? "KRW" : "USD";

			if($pay_type == "card" || $pay_type == "free"){
				$pay_html = "
								<tr style='border-bottom:1px solid #000;'>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Status</th>
									<td style='font-size:14px; padding:10px; color:#00666B; font-weight:bold' >Complete</td>
								</tr>
								<tr style='border-bottom:1px solid #000;'>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Date</th>
									<td style='font-size:14px; padding:10px;'>{$pay_date}</td>
								</tr>
							";
			}else{
				$pay_html = "
								<tr style='border-bottom:1px solid #000;'>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Status</th>
									<td style='font-size:14px; padding:10px; color:#00666B; font-weight:bold'>Needed</td>
								</tr>
								<tr style='border-bottom:1px solid #000;'>
									<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Bank Information</th>
									<td style='font-size:14px; padding:10px;'>1005-403-423214, 	WOORI BANK (우리은행)</td>
								</tr> 
							";
			}

			$rawMessageString .= "
									<table width='750' style='border:1px solid #000; padding: 0;'>
										<tbody>
											<tr>
												<td colspan='3'>
													<img src='https://imcvp.org/main/img/2024_mail_header-2.png' width='750' style='width:100%; max-width:100%;'>
												</td>
											</tr>
											<tr>
												<td width='74' style='width:74px;'></td>
												<td>
													<div style='font-weight:bold; text-align:center; font-size: 21px; color: #257FE6; padding: 20px 0;'>[IMCVP 2024] Completed Registration</div>
												</td>
												<td width='74' style='width:74px;'></td>
											</tr>
											<tr>
												<td width='74' style='width:74px;'></td>
												<td>
													<div>
														<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear {$name_title} {$fname},</p>
														<p style='font-size:14px;color:#170F00;margin-top:14px;'>We express our gratitude for your registration for the International Meeting CardioVascular Disease Prevention (IMCVP) 2024.	The registration details are presented below.<br/>Should you have any inquiries regarding your registration, kindly reach out to the IMCVP 2024 Secretariat for assistance.(<a href='mailto:sci@imcvp.org'>sci@imcvp.org</a>)</p>
														<table width='586' style='width:586px; border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
															<tbody>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Registration No.</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$register_no}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Registration Date</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000; width:165px;'>{$register_date}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Name</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000; width:165px;'>{$fname}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Country</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$nation_en}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Affiliation</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$affiliation}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Phone Number</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$phone}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Member of KSCP</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$member_status}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Type of Participation</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$attendance_type}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Category</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>Professor</td>
																</tr>
																{$review_html}
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Others</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>
																		{$other_html}
																	</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Where did you get the information about the conference?</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>
																		{$info_html}
																	</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px;'>Registration fee</th>
																	<td style='font-size:14px; padding:10px;border-left:1px solid #000;'>{$pay_current} {$pay_price}</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Method</th>
																	<td style='font-size:14px; padding:10px;'>{$pay_name}</td>
																</tr>
																{$pay_html}
																<!-- 카드결제 (결제완료) -->
																<!--
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Method</th>
																	<td style='font-size:14px; padding:10px;'>Credit Card</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Status</th>
																	<td style='font-size:14px; padding:10px; color:#00666B; font-weight:bold' >Complete</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Date</th>
																	<td style='font-size:14px; padding:10px;'>YYYY-MM-DD HH:MM:SS</td>
																</tr>
																 -->
																<!-- 계좌이체 (미결제) -->
																<!--
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Method</th>
																	<td style='font-size:14px; padding:10px;'>Bank Transfer</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Status</th>
																	<td style='font-size:14px; padding:10px; color:#00666B; font-weight:bold'>Needed</td>
																</tr>
																<tr style='border-bottom:1px solid #000;'>
																	<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Bank Information</th>
																	<td style='font-size:14px; padding:10px;'>584-910003-16504, Hana Bank (하나은행)</td>
																</tr> 
																 -->
															</tbody>	
														</table>
														<p>We eagerly anticipate your presence in Seoul, Korea this coming November.</p>
													</div>
												</td>
												<td width='74' style='width:74px;'></td>
											</tr>
											<tr>
												<td width='74' style='width:74px;'></td>
												<td>
													<p>Warmest regards,</p>
													<p>Secretariat of IMVCP 2024</p>
													<br/>
													<div style='text-align: center; padding-top:30px;'>
								<table align='center' cellspacing='0' cellpadding='0' width='100%'>
									<tr>
										<td align='center'>
											<table border='0' class='mobile-button' cellspacing='0' cellpadding='0'>
												<tr>
													<td align='center' bgcolor='#ffcc33' style='background-color: #000066; margin: auto; max-width: 600px; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding: 12px 32px;box-shadow: 0px 5px 0px 0px #000066;' width='100%'><!--[if mso]>&nbsp;<![endif]-->
														<a href='https://imcvp.org/main' target='_blank' style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #003466; font-weight:600; text-align:center; background-color: #000066; text-decoration: none; border: none; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; display: inline-block;'>
															<span style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #fff; font-weight:600; text-align:center;'>Go to IMCVP 2024 Website</span>
														</a><!--[if mso]>&nbsp;<![endif]-->
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</div>
												</td>
												<td width='74' style='width:74px;'></td>
											</tr>
											<tr>
												<td colspan='3' style='padding-top:50px;'>
													<img src='https://imcvp.org/main/img/2024_mail_footer-2.png' width='750' style='width:100%; max-width:100%;'>
												</td>
											</tr>
										</tbody>
									</table>";
	}

	if($mail_type == "registration") {
			echo "dd"; exit;
			$user_idx = $_SESSION["USER"]["idx"];
			$id = $_SESSION["USER"]["email"];
			$data = isset($_POST["data"]) ? $_POST["data"] : "";
			
			//필수
			$attendance_type = isset($data["attendance_type"]) ? $data["attendance_type"] : "";

			switch($attendance_type) {
				case 0:
					$attendance_type = "General Participants";
					break;
				case 1:
					$attendance_type = "Invited Speaker";
					break;
				case 2:
					$attendance_type = "Committee";
					break;
				case 3:
					$attendance_type = "Sponsors";
					break;
			}

			$rating = isset($data["rating"]) ? $data["rating"] : "";
			$is_score = ($rating == 1) ? "Yes" : "No";

			$member_status = isset($data["member_status"]) ? $data["member_status"] : "";
			$member_status = htmlspecialchars($member_status);


			$nation_no = isset($data["nation_no"]) ? $data["nation_no"] : "";
			$nation_sql = "SELECT
								nation_en
							FROM nation
							WHERE idx = {$nation_no}";
			
			$nation_no = sql_fetch($nation_sql)["nation_en"];

			$nation_tel = isset($data["nation_tel"]) ? $data["nation_tel"] : "";
			$phone = isset($data["phone"]) ? $data["phone"] : "";
			$member_type = isset($data["member_type"]) ? $data["member_type"] : "";
			$member_type = ($member_type != "Choose") ? $member_type : "";
			
			$member_status = ($member_status == 1) ? "Yes" : "No";

			$registration_type = isset($data["registration_type"]) ? $data["registration_type"] : "";

			$registration_type = ($registration_type == 0) ? "Yes" : "No";

			$affiliation = isset($data["affiliation"]) ? $data["affiliation"] : "-";
			$affiliation = htmlspecialchars($affiliation);
			$department = isset($data["department"]) ? $data["department"] : "-";
			$department = htmlspecialchars($department);
			$licence_number = isset($data["licence_number"]) ? $data["licence_number"] : "-";
			$academy_number = isset($data["academy_number"]) ? $data["academy_number"] : "-";

			if($nation_tel != "" && $phone != "") {
				$phone = $nation_tel."-".$phone;
			}

			$timenow = date("Y-m-d H:i:s"); 
			$timetarget = "2022-05-20 00:00:00";

			$str_now = strtotime($timenow);
			$str_target = strtotime($timetarget);
			if($str_now <= $str_target) {
				$content_value = "Please visit our website(<a href='{$background_img_url}/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>{$background_img_url}</a>) with your account to					submit the abstract and register.<br>
								If you Early-Bird and pay the registration fee by May 19th(Thu), you will receive a 30% OFF! <br>
								Don’t miss out on early bird rates!<br>
								Note the payment deadline of Jul 28(Thu) at 12pm(KST).<br><br>";
			} else {
				$content_value = "Please visit our website(<a href='{$background_img_url}/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>{$background_img_url}</a>) with your account to					submit the abstract and register.<br>
								If you Registration and pay the registration fee by Jul 28th(Thu), you will receive a 10% OFF! <br>
								Don’t miss out on register rates!<br>
								Note the payment deadline of Jul 28(Thu) at 12pm(KST).<br><br>";
			}

			$rawMessageString .= "<table width='549' cellspacing='0' cellpadding='0' style='width: 549px !important; max-width:549px !important; margin: 0px auto; padding:0; border:1px solid;' >
							<tr>
								<td width='549' valign='top' style='width:549px; vertical-align:top; font-size:0; line-height:0;'>
									<img src='{$background_img_url}/main/img/icomes_mail_top_2022.jpg' alt='2022 mailer' width='549' style='width: 549px; vertical-align: top; border: 0; display:block;'>
								</td>
							</tr>
							<tr>
								<td width='549' valign='top' style='width:549px;'>
									<h1 style='font-size:16px; font-weight:bold; text-align:center; margin-top:50px;'>Personal Information</h1>
								</td>
							</tr>
							<tr>
								<td width='549' style='text-align:center;'>
									<br/><br/>
									<table width='480' style='display:inline-block; width:calc(100% - 80px); box-sizing:border-box;'>
										<tbody>
											<tr>
												<td style='text-align:center;'>
													<table width='420' style='display:inline-block; width:calc(100% - 30px); border-top:2px solid #707070; background-color:#f8f8f8;'>
														<tbody>
															<tr>
																<td style='padding:0 30px 50px;'>
																	<br/>
																	<table style='border-collapse: collapse;' cellspacing='0' cellpadding='0'>
																		<tbody>
																			<tr>
																				<p style='margin-top:24px; font-size:12px; font-weight:bold; color:#000; text-align:left;'>Dear {$fname},</p>
																				<br/>
																				<p style='font-size:10px; line-height:14px; color:#000; text-align:left;'>
																					Thank you for signing up for the 2022 International Congress on Obesity and<br/>Metabolic Syndrome.(ICOMES 2022)
																				</p>
																				<p style='font-size:10px; line-height:14px; color:#000; text-align:left;'>
																					Your account has been successfully created.<br/>Please review the information that you have entered and inform the info of any<br/>errors. 
																				</p>
																			</tr>
																		</tbody>
																	</table>
																	<br/>
																	<table width='420' style='width:100% !important; border-collapse: collapse;' cellspacing='0' cellpadding='0'>
																		<colgroup> 
																			<col width='160px'>
																			<col width='*'>
																		</colgroup>	
																		<tbody>
																			<tr>
																				<th style='border-top:1px solid #707070; border-bottom:1px solid #707070; font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Attendance Type</th>
																				<td style='text-align:left; border-top:1px solid #707070; border-bottom:1px solid #707070; font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$attendance_type}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>On-site</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$registration_type}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>평점신청여부</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$is_score}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>KSCP Membership</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$member_status}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>ID</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$to}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Country</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$nation_no}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Name</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$fname}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Phone number</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$phone}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Attendant type</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$member_type}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Affiliation</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$affiliation}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Department</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$department}</td>
																			</tr>
																			<tr style='border-bottom:1px solid #707070;'>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Doctor’s license Number</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$licence_number}</td>
																			</tr>
																			<tr>
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>학회번호</th>
																				<td style='text-align:left; border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$academy_number}</td>
																			</tr>
																		</tbody>
																	</table>
																	<br/>
																	<table style='border-collapse: collapse;' cellspacing='0' cellpadding='0'>
																		<tbody>
																			<tr>
																				<p style='font-size:10px; line-height:14px; color:#000; text-align:left;'>
																					We express our gratitude to you for your interest in the ICOMES 2022 and look<br/>forward to seeing you in September in Seoul, Korea.
																					<br/><br/>
																					Please visit our website(https://icomes.or.kr) with your account to submit the abstract and register.<br/>If you Early-Register and pay the registration fee by May 12th(Thu), you will receive a 30% discount!<br/>Don’t miss out on early bird register rates!<br/>Note the payment deadline of August 11(Thu) at 12pm(KST).
																					<br/><br/>
																					Warmest regards,
																					<br/><br/>
																					ICOMES 2022 info
																					<br/><br/><br/>
																				</p>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
													<br/><br/><br/>
												</td>
											</tr>
											<tr>
												<td width='549' valign='top' style='width:549px; vertical-align:top; font-size:0; line-height:0;'>
													<img src='{$background_img_url}/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'>
												</td>
											</tr>
										</tbody>
									</table>
								</td>	
							</tr>
						</table>";
	}

	if($mail_type == "visa_registration") {

			$rawMessageString .= "<div style='width:549px;background-color:#fff;border:1px solid #000;'><img src='{$background_img_url}/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'><h1 style='text-align:center; font-size:16px; font-weight:bold'>Letter of Invitation</h1><div style='width:calc(100% - 80px); margin:24px auto 100px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p><p style='font-size:10px; color:#000 ;margin-top:16px; margin-bottom:25px;'>On behalf of the ICOMES organizing committee, we cordially invite you as participant to “ICOMES 2022 International Conference” to be held at the Conrad Seoul Hotel, Seoul, Korea on September 1(Thu)-3(Sat), 2022. </p><p style='font-size:10px; color:#000; margin-bottom:25px;'>ICOMES has grown as a worldwide academic society with more than 1000 participants and eminent representative speakers in obesity every year since 2015 at its launch. ICOMES is an international academic conference that promotes cooperation among multidisciplinary study fields, providing in-depth lectures and symposiums on basic medicine and clinical medicine on obesity, metabolic syndrome, dyslipidemia, and other obesity-related diseases.<br/>The main theme of ICOMES 2022 is ‘The Next Normal - The Future of Obesity Care’. Your Presentation will be a great addition to our conference.</p><p style='font-size:10px; color:#000;'>For building instructive, insightful and interesting meeting, we would like you to take as a role of; </p><div style='padding:10px 0; margin-top:16px; border-top:1px solid #000; border-bottom:1px solid #000;'><div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Date</span><span style='vertical-align:middle; font-size:10px;'>September 1(Thu)~3(Sat)</span></div>
			<div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Venue</span><span style='vertical-align:middle; font-size:10px;'>Conrad Hotel Seoul, Korea</span></div></div><div style='font-size:10px; margin:14px 0 60px;'>
			We invite you to ICOMES 2022 to create an informative, insightful and exciting<br/>meeting. <a href='mailto:icomes_registration@into-on.com' style='font-size:10px; font-weight:bold; color:#10BF99;'>(icomes_registration@into-on.com).</a></div><ul style='margin:0; padding:0; text-align:center; font-size:0;'><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top;'><p style='font-size:12px; font-weight:bold; margin:0;'>Kijin Kim</p><p style='font-size:8px;'>Chairman of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign01.png' alt=''></li><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top; margin-left:15%;'><p style='font-size:12px; font-weight:bold; margin:0;'>Chang-Beom Lee</p><p style='font-size:8px;'>President of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign02.png' style='margin-top:10px;' alt=''></li></ul></div><img src='{$background_img_url}/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'></div>";
		
	}


	if($mail_type == "abstract_pre") {
		$submit_data = $data["submit_data"] ?? [];
		$presenting_author_data = $data["presenting_author_data"] ?? [];
		$corresponding_submit_data = $data["corresponding_submit_data"] ?? [];
		$poster_category_map = $data["poster_category_map"] ?? [];
		$presentation_type_arr = $data["presentation_type_arr"] ?? [];
		$position_arr = $data["position_arr"] ?? [];
		$nation_map = $data["nation_map"] ?? [];

		$submission_code	= $submit_data["submission_code"] ?? "";
		$abstract_category	= $submit_data["abstract_category"] ?? "";
		$abstract_title		= $submit_data["abstract_title"] ?? "";
		$presentation_type	= $submit_data["presentation_type"] ?? "";

		$first_name			= $submit_data["first_name"] ?? "";
		$last_name			= $submit_data["last_name"] ?? "";

		$url = $_SERVER['HTTP_HOST'] ?? "www.icomes.or.kr";

		$rawMessageString .= '<div><table width="750" style=" padding: 0;">
								<tr><td colspan="3"><img src="https://imcvp.org/main/img/2024_mail_header-2.png" width="750" style="width:100%; max-width:100%;"></td></tr>
								<tr><td width="74" style="width:74px;"></td><td>
								<div style="font-weight:bold; text-align:center;font-size: 21px; color: #257FE6;padding: 20px 0;">[IMCVP 2024] Completed Abstract Submission</div></td><td width="74" style="width:74px;"></td></tr>
								<tr><td width="74" style="width:74px;"></td><td><div><p style="font-size:15px; font-weight:bold; color:#000; margin:0;">Dear '.$first_name.' '.$last_name.',</p><p style="font-size:14px;color:#170F00;margin-top:14px;">Thank you for the online submission of your abstract to IMCVP 2024.<br>Your abstract has been successfully submitted as follows.</p>
								<!-- Abstract Submission Status -->
								<p style="font-size:17px; font-weight:bold; color:#000;  margin: 30px 0 0;">Abstract Submission Status</p>
								<table width="586" style="width:586px; border-collapse:collapse; border-top:2px solid #000; width:100%; margin:10px 0 30px;">
								<tbody>
								<tr>
									<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Submission No.</th>
									<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;">'.$submission_code.'</td>
								</tr>
								<tr>
									<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Type of Presentation</th>
									<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="2">'.($presentation_type+1).'. '.$presentation_type_arr[$presentation_type].'</td>
								</tr>
								<tr>
									<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Topic Category</th>
									<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="2">'.$poster_category_map[$abstract_category].'</td>
								</tr>
								<tr>
									<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Abstract Title</th>
									<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000; white-space:nowrap;" colspan="2">'.$abstract_title.'</td>
								</tr>
								</tbody>
								</table>';

		if(count($presenting_author_data) > 0 || count($corresponding_submit_data) > 0) {
			$rawMessageString .= '<p style="font-size:17px; font-weight:bold; color:#000; margin: 20px 0 10px;">Abstract Submission Status</p>';
		}

		if(count($presenting_author_data) > 0) {
			$rawMessageString .= '<!-- Abstract Submission Status > Presenting Author -->
								<p style="font-size:15px; font-weight:600; color:#000; margin:0;">Presenting Author</p>';
			
			foreach($presenting_author_data as $obj) {
				$nation_no			= $obj["nation_no"] ?? "";
				$first_name			= $obj["first_name"] ?? "";
				$last_name			= $obj["last_name"] ?? "";
				$email				= $obj["email"] ?? "";
				$affiliation		= $obj["affiliation"];

				if ($affiliation) { 
					if (!is_array($affiliation)) {
						$affiliation_arr = explode("★", $affiliation);
					} else {
						$affiliation_arr = $affiliation;
					}
				}

				$_arr_phone = explode("-", $obj["phone"]);
				$nation_tel = $_arr_phone[0];
				$phone = implode("-", array_splice($_arr_phone, 1));

				$rawMessageString .= '<table width="586" style="width:586px; border-collapse:collapse; border-top:2px solid #000; width:100%; margin:10px 0 20px;">
										<tbody>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Name</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; width:165px; border-bottom:1px solid #000;">'.$first_name.' '.$last_name.'</td>
											<th style="width:150px; text-align:left; border-left:1px solid #000; font-size:14px; padding:10px; border-bottom:1px solid #000;">Country</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; width:165px; border-bottom:1px solid #000;">'.$nation_map[$nation_no].'</td>
										</tr>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Affiliation</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="3">'.(implode("<br>", $affiliation_arr)).'</td>
										</tr>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">E-mail</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="3"><a href="mailto:'.$email.'">'.$email.'</a></td>
										</tr>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Phone Number</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="3">(+'.$nation_tel.')'.$phone.'</td>
										</tr>
										</tbody>	
										</table>';
			}
		}

		if(count($corresponding_submit_data) > 0) {
			$rawMessageString .= '<!-- Abstract Submission Status > Corresponding Author -->
			<p style="font-size:15px; font-weight:600; color:#000; margin:0;">Corresponding Author</p>';

			foreach($corresponding_submit_data as $obj) {
				$nation_no			= $obj["nation_no"] ?? "";
				$first_name			= $obj["first_name"] ?? "";
				$last_name			= $obj["last_name"] ?? "";
				$email				= $obj["email"] ?? "";
				$affiliation		= $obj["affiliation"];

				if ($affiliation) { 
					if (!is_array($affiliation)) {
						$affiliation_arr = explode("★", $affiliation);
					} else {
						$affiliation_arr = $affiliation;
					}
				}

				$_arr_phone = explode("-", $obj["phone"]);
				$nation_tel = $_arr_phone[0];
				$phone = implode("-", array_splice($_arr_phone, 1));

				$rawMessageString .= '<table width="586" style="width:586px; border-collapse:collapse; border-top:2px solid #000; width:100%; margin:10px 0 20px;">
										<tbody>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Name</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; width:165px; border-bottom:1px solid #000;">'.$first_name.' '.$last_name.'</td>
											<th style="width:150px; text-align:left; border-left:1px solid #000; font-size:14px; padding:10px; border-bottom:1px solid #000;">Country</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; width:165px; border-bottom:1px solid #000;">'.$nation_map[$nation_no].'</td>
										</tr>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Affiliation</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="3">'.(implode("<br>", $affiliation_arr)).'</td>
										</tr>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">E-mail</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="3"><a href="mailto:'.$email.'">'.$email.'</a></td>
										</tr>
										<tr>
											<th style="width:150px; text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #000;">Phone Number</th>
											<td style="font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;" colspan="3">(+'.$nation_tel.')'.$phone.'</td>
										</tr>
										</tbody>	
										</table>';
			}
		}

		$rawMessageString .=  '<p style="margin: 0 34px 10px 0">If you have any questions regarding abstract submission, please contact the secretariat.(<a href="mailto:sci@imcvp.org">sci@imcvp.org</a>) We look forward to seeing you in IMCVP 2024</p>
								</div>
								</td>
								<td width="74" style="width:74px;"></td>
								</tr>
								<tr>
									<td width="74" style="width:74px;"></td>
									<td>
										<!-- 23.04.25 수정된 버튼 마크업 -->
										<p>Best regards,</p>
										<p>Secretariat of IMCVP 2024</p><br/>
										<div style="text-align: center; padding-top:30px;">
								<table align="center" cellspacing="0" cellpadding="0" width="100%">
									<tr>
										<td align="center">
											<table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
												<tr>
													<td align="center" bgcolor="#ffcc33" style="background-color: #000066; margin: auto; max-width: 600px; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding: 12px 32px;box-shadow: 0px 5px 0px 0px #000066;" width="100%"><!--[if mso]>&nbsp;<![endif]-->
														<a href="https://imcvp.org/main" target="_blank" style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #003466; font-weight:600; text-align:center; background-color: #000066; text-decoration: none; border: none; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; display: inline-block;">
															<span style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #fff; font-weight:600; text-align:center;">Go to IMCVP 2024 Website</span>
														</a><!--[if mso]>&nbsp;<![endif]-->
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</div>
									</td>
									<td width="74" style="width:74px;"></td>
								</tr>
								<tr>
									<td style="padding-top:50px;" colspan="3">
										<img src="https://imcvp.org/main/img/2024_mail_footer-2.png" width="750" style="width:100%; max-width:100%;">
									</td>
								</tr>
								</table>
								</div>';
	}
	else if($mail_type == "abstract") {
		$rawMessageString .= "
<table width='750' style='border:1px solid #000; padding: 0;'>
    <tbody>
        <tr>
            <td colspan='3'>
                <img src='https://imcvp.org/main/img/2024_mail_header-2.png' width='750' style='width:100%; max-width:100%;'>
            </td>
        </tr>
        <tr>
            <td colspan='3'>
                <div style='font-weight:bold; text-align:center;font-size: 21px; color: #257FE6;padding: 20px 0;'>[IMCVP 2024] Completed Abstract Submission</div>
            </td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'></td>
            <td>
                <div style='margin-bottom:25px; padding:17px 34px; box-sizing:border-box;'>
                        <p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear {$fname}</p>
                        <p style='font-size:14px;color:#170F00;margin-top:14px;'>
                            Attention Potential Presenting Author: Upon successful submission of your abstract, you will immediately see the following confirmation notice on your screen, followed by the same message via e&#45;mail. If you did not receive the following message, your abstract was not successfully submitted. Please try again, or contact (sci@imcvp.org) for assistance if you are having difficulty. 
                        </p>
    
                        <p style='font-size:15px; font-weight:bold; color:#000; margin-top:30px;'>Abstract Successfully Submitted</p>
                        <p style='font-size:14px; color:#170F00; margin-top:14px;'>This is an automated message. Please do not reply</p>
                        <div style='font-size:14px; padding:10px; border-bottom:1px solid #000; margin-top:10px;'>ID (Email Address) : {$to} </div>
                        <div style='font-size:14px; padding:10px; border-bottom:1px solid #000; margin-top:10px;'>Submission date : {$date} </div>
                        <div style='font-size:14px; padding:10px; border-bottom:1px solid #000; margin-top:10px;'>Topic : {$category} </div>
                        <div style='font-size:14px; padding:10px; border-bottom:1px solid #000; margin-top:10px;'>Abstract title : {$title} </div>
						<div style='font-size:14px; padding:10px; margin-top:10px;'>If you have any questions regarding call for abstracts, please contact the secretariat (sci@imcvp.org)</div>
						<div style='font-size:14px; padding:10px; margin-top:10px;'>We look forward to seeing you in IMCVP 2024.</div>
						<div style='font-size:14px; padding:10px; margin-top:10px;'>Warmest regards, 감사합니다.</div>
						<div style='font-size:14px; padding:10px; margin-top:10px;'>IMCVP 2024 Secretariat.</div>
                </div>
					
            </td>
            <td width='74' style='width:74px;'></td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'></td>
            <td>
                <div style='text-align: center; padding-top:30px;'>
        <table align='center' cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='center'>
                    <table border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td align='center' bgcolor='#ffcc33' style='background-color: #000066; margin: auto; max-width: 600px; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding: 12px 32px;box-shadow: 0px 5px 0px 0px #000066;' width='100%'><!--[if mso]>&nbsp;<![endif]-->
                                <a href='https://imcvp.org/main' target='_blank' style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #003466; font-weight:600; text-align:center; background-color: #000066; text-decoration: none; border: none; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; display: inline-block;'>
                                    <span style='font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #fff; font-weight:600; text-align:center;'>Go to IMCVP 2024 Website</span>
                                </a><!--[if mso]>&nbsp;<![endif]-->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
                
            </td>
            <td width='74' style='width:74px;'></td>
        </tr>
        <tr>
            <td colspan='3' style='padding-top:50px;'>
                <img src='https://imcvp.org/main/img/2024_mail_footer-2.png' width='750' style='width:100%; max-width:100%;'>
            </td>
        </tr>
    </tbody>
</table>
		";
	}

	//[240617] sujoeng / 좌장, 연자, 패널 메일 추가 / 템플릿 변경 필요
	else if($mail_type == "speaker") {
		$title = $data["title"] ?? [];
		
		$attendance_type = isset($data[0]["attendace_type"]) ? $data[0]["attendace_type"] : "";
		$program_place = isset($data[1]["program_place_idx"]) ? $data[1]["program_place_idx"] : "";
		$program_tag_name = isset($data[1]["program_tag_name"]) ? $data[1]["program_tag_name"] : "";

		$attendance_type_text = "";
		$program_place_text = "";
		$program_color = "";

		switch($attendance_type) {
			case 1:
				$attendance_type_text = "좌장";
				break;
			case 2:
				$attendance_type_text = "패널";
				break;
			case 3:
				$attendance_type_text = "연자";
				break;
		}

		switch($program_place) {
			case 1:
				$program_place_text = "Room 1";
				break;
			case 2:
				$program_place_text = "Room 2";
				break;
			case 3:
				$program_place_text = "Room 3";
				break;
			case 4:
				$program_place_text = "Room 4";
				break;
			case 5:
				$program_place_text = "Room 5";
				break;
			case 6:
				$program_place_text = "Room 6";
				break;
			case 7:
				$program_place_text = "Room 7";
				break;
			case 8:
				$program_place_text = "Room 1~3";
				break;
		}

		
		switch($program_tag_name) {
			case "symposium":
				$program_color = "#FFF8AA";
				break;
			case "plenary":
				$program_color = "#D6F8B4";
				break;
			case "luncheon":
				$program_color = "#FFE5E7";
				break;
			case "satellite":
				$program_color = "#EDE2FF";
				break;
			case "breakfast":
				$program_color = "#FFE5E7";
				break;
		}

		$end_time = substr(explode(' ',  $data[5]["end_time"])[1],0, -3);
		$start_time = substr($data[1]["start_time"],0, -3);

		$notice_time = $start_time .' ~ ' . $end_time; 

		$dataTable = "";
		$dataTable .= "
			<table  width='586' style='width:586px; border-collapse:collapse; width:100%; margin:17px 0;'>
				<tr>
					<th style='width:150px; text-align:left; font-size:14px; padding:10px;border-bottom:1px solid #000; background-color:{$program_color}'>{$start_time} ~{$end_time}</th>
					<th style='text-align:left; font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000; background-color:{$program_color}'>{$data[1]['program_name']}</th>
					<th style='text-align:left; font-size:12px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000; background-color:{$program_color}'>{$data[1]['chairpersons']}</th>
				</tr>
				";

				foreach(array_slice($data, 1)  as $item){
					$program_start_time = substr(explode(' ', $item['start_time'])[1] ,0, -3);
					$program_end_time = substr(explode(' ', $item['end_time'])[1],0, -3);
					$dataTable .= "
					<tr>
						<th style='width:150px; text-align:center; font-size:14px; padding:10px;border-bottom:1px solid #000;'>{$program_start_time}-{$program_end_time}</th>
						<td style='text-align:left; font-size:14px; padding:10px; border-left:1px solid #000;border-bottom:1px solid #000;'>{$item['contents_title']}</td>
						<td style='text-align:left; font-size:14px; padding:10px; border-left:1px solid #000; border-bottom:1px solid #000;'>{$item['speaker']}</td>
					</tr>
					";}

		$dataTable .= "</table>";
	
		
		$rawMessageString .= "
		<table width='750' style='border:1px solid #000; padding: 0;'>
    <tbody>
        <tr>
            <td colspan='3'>
                <img src='https://imcvp.org/main/img/2024_mail_header-2.png' width='750' style='width:100%; max-width:100%;'>
            </td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'></td>
            <td>
                <div style='font-weight:bold; text-align:center; font-size: 21px; color: #257FE6; padding: 20px 0;'>[IMCVP 2024] 최종 안내문</div>
            </td>
            <td width='74' style='width:74px;'></td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'></td>
            <td>
                <div>
                    <p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>{$fname}교수님 안녕하십니까</p>
                    <p style='font-size:14px; color:#000; margin:0;'>IMCVP 2024 운영사무국입니다.</p>
                    <p style='font-size:14px; color:#000; margin:0;'>본 학술대회의 {$attendance_type_text}로 수고하여 주심에 다시 한번 감사드립니다.</p>
                    <p style='font-size:14px;color:#170F00;margin-top:14px;'>아래와 같이 행사 참석 안내사항 및 담당 프로그램을 보내 드리오니, 확인하여 주시면 감사하겠습니다.</p>
                    <p style='font-size:14px;color:#170F00;margin-top:14px; font-weight: 700;color: purple;'>[IMCVP 2024 개요]</p>
                    <table width='586' style='width:586px; border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
                        <tbody>
                            <tr style='border-bottom:1px solid #000;'>
                                <th style='width:150px; text-align:left; font-size:14px; padding:10px;border-bottom:1px solid #000;'>날짜</th>
                                <td style='font-size:14px; padding:10px;border-left:1px solid #000;border-bottom:1px solid #000;'>2024년 11월 29일(금) ~ 30일(토)</td>
                            </tr>
                            <tr style='border-bottom:1px solid #000;'>
                                <th style='width:150px; text-align:left; font-size:14px; padding:10px;border-bottom:1px solid #000;'>장소</th>
                                <td style='font-size:14px; padding:10px;border-left:1px solid #000; width:165px;border-bottom:1px solid #000;'>그랜드워커힐 서울 호텔</td>
                            </tr>
                            <tr style='border-bottom:1px solid #000;'>
                                <th style='width:150px; text-align:left; font-size:14px; padding:10px;border-bottom:1px solid #000;'>주제</th>
                                <td style='font-size:14px; padding:10px;border-left:1px solid #000; width:165px;border-bottom:1px solid #000;'>Aiming High for the State-of-the-Art Cardiovascular Disease Prevention</td>
                            </tr>
                            <tr style='border-bottom:1px solid #000;'>
                                <th style='width:150px; text-align:left; font-size:14px; padding:10px;border-bottom:1px solid #000;'>홈페이지</th>
                                <td style='font-size:14px; padding:10px;border-left:1px solid #000; color: blue; text-decoration: underline;border-bottom:1px solid #000;'><a href='https://imcvp.org/' target='_blank'>imcvp.org</a></td>
                            </tr>
                           <tr>
                                <td style='width:150px; text-align:left; font-size:14px; padding:10px;' colspan='2'>*전체 프로그램은 홈페이지를 참고해 주시면 감사하겠습니다.</td>
                           </tr>
                        </tbody>	
                    </table>
                    <p style='font-size:14px;color:#170F00;margin-top:14px; font-weight: 700;color: orangered;'>[행사 참석 및 세션 진행 시 참고 사항]</p>
                    <p style='font-size:14px; color:#000; margin:0;'>- 등록 및 명찰 수령을 위하여 등록데스크로 먼저 방문 부탁드립니다.</p>
                    <p style='font-size:14px; color:#000; margin:0;'>- 세션 시작 1시간 전까지는 행사장에 도착하시어 준비해 주시면 감사하겠습니다.</p>
                </div>
            </td>
            <td width='74' style='width:74px;'>
            </td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'><p></p></td>
            <td>
                <p style='font-size:14px;color:#170F00;margin-top:14px; font-weight: 700;color: orangered;'>[담당 세션 일정]</p>
                    <p style='font-size:14px; color:#000; margin:0;'>- 일시: <span style='font-size:14px; color:red; margin:0;'>{$notice_time}</span></p>
                    <p style='font-size:14px; color:#000; margin:0;'>- 장소: 그랜드 워커힐 서울 서울 호텔, <span style='font-size:14px; color:red; margin:0;'>{$program_place_text}</span></p>
            </td>
            <td width='74' style='width:74px;'></td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'><p></p></td>
            <td>
                <p style='font-size:14px;color:#170F00;margin-top:14px; font-weight: 700;color: orangered;'>[세션 진행 시 참고사항]</p>
                    <p style='font-size:14px; color:#000; margin:0;'>- 발표 및 진행: <span style='font-size:14px; color:red; margin:0;'>영어</span></p>
                    <p style='font-size:14px; color:#000; margin:0;'>- Discussion 시간: <span style='font-size:14px; color:red; margin:0;'>20분</span></p>
                    <p style='font-size:14px; color:#000; margin:0;'>- 모든 연사들의 발표가 끝난 후, 토의가 진행됩니다. 무대에 마련된 좌석에 착석하시어 활발한 토론을 부탁드립니다.</p>
            </td>
            <td width='74' style='width:74px;'></td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'><p></p></td>
            <td>
				<div>
					{$dataTable}
				</div>
            </td>
            <td width='74' style='width:74px;'></td>
        </tr>
        <tr>
            <td width='74' style='width:74px;'></td>
            <td>
                <br/>
                <p>여러 일정으로 바쁘신 가운데도 불구하고 애써 주심에 감사드리며,</p>
                <p>검토하시면서 다른 궁금하신 사항이 있으시면 언제든지 운영사무국으로 연락 부탁드립니다.</p>
                <br/>
                <p>감사합니다.</p>
            </td>
            <td width='74' style='width:74px;'></td>
        </tr>
        <tr>
            <td colspan='3' style='padding-top:50px;'>
                <img src='https://imcvp.org/main/img/2024_mail_footer-2.png' width='750' style='width:100%; max-width:100%;'>
            </td>
        </tr>
    </tbody>
</table>
					";
	}
}



 //$rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
 $rawMessage = rtrim(strtr(base64_encode($rawMessageString), '+/', '-_'), '=');
 $message->setRaw($rawMessage);

 //var_dump($message); exit;
 return $message;
}


/**
* @param $service Google_Service_Gmail an authorized Gmail API service instance.
* @param $user string User's email address or "me"
* @param $message Google_Service_Gmail_Message
* @return Google_Service_Gmail_Draft
*/
function createDraft($service, $user, $message) {
 $draft = new Google_Service_Gmail_Draft();
 $draft->setMessage($message);

 try {
   $draft = $service->users_drafts->create($user, $draft);
   //print 'Draft ID: ' . $draft->getId();
 } catch (Exception $e) {
   //print 'An error occurred: ' . $e->getMessage();
 }

 return $draft;
}


/**
* @param $service Google_Service_Gmail an authorized Gmail API service instance.
* @param $userId string User's email address or "me"
* @param $message Google_Service_Gmail_Message
* @return null|Google_Service_Gmail_Message
*/
function sendMessage($service, $userId, $message) {
 try {
   $message = $service->users_messages->send($userId, $message);
   //print 'Message with ID: ' . $message->getId() . ' sent.';
   return $message;
 } catch (Exception $e) {
   print 'An error occurred: ' . $e->getMessage();
 }

 return null;
}

if($_POST["flag"] == "signup") {
	$data = $_POST["data"];
	//var_dump($data); exit;
	$email = isset($data["email"]) ? $data["email"] : "";
	
	try {
		 $select_user_query =	"
									SELECT
										*
									FROM member
									WHERE email = '{$email}'
									AND is_deleted = 'N'
								";
		
		$user_data = sql_fetch($select_user_query);

		$subject = "[IMCVP 2024] Welcome to IMCVP 2024!";
		$callback_url = D9_DOMAIN."/signup_certified.php?idx=".$user_data["idx"];
		
		$message =createMessage("en", "sign_up", "", $email, $subject, date("Y-m-d H:i:s"), "", $callback_url, 1);
		//var_dump($message); exit;
		createDraft($service, "secretariat@imcvp.org", $message);
		sendMessage($service, "secretariat@imcvp.org", $message);

	} catch(\Throwable $tw) {
		echo $tw->getMessage();
		exit;
	}
}

if($_POST["flag"] == "find_password"){

	try {
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

		$message =createMessage($language, "find_password", $name, $email, "[IMCVP 2024]This is a find password mail.", date("Y-m-d H:i:s"), $temporary_password, $callback_url, 0);
		createDraft($service, "secretariat@imcvp.org", $message);
		sendMessage($service, "secretariat@imcvp.org", $message);

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
				"code" => 200,
				"msg" => "success"
			];
			echo json_encode($res);
			exit;	
		} else {
			$res = [
				"code" => 400,
				"msg" => "update query error"
			];
			echo json_encode($res);
			exit;
		}
	} catch(\throwable $tw) {
		echo $tw->getMessage();
		exit;
	}
}

else if($_POST["flag"] == "payment"){
	$name = $_POST["name"] ?? null;
	$email = $_POST["email"] ?? null;
	$data = $_POST["data"] ?? null;
	$message =createMessage("en", "payment", $name , $email, "[IMCVP 2024] Payment Confirmation", date("Y-m-d H:i:s"), "", "", 1, "", "", "", "", "", "", "", $data);
	createDraft($service, "secretariat@imcvp.org", $message);
	sendMessage($service, "secretariat@imcvp.org", $message);
}

else if($_POST["flag"] == "registration"){
	$name = $_POST["name"] ?? null;
	$email = $_POST["email"] ?? null;
	$data = $_POST["data"] ?? null;
	$registration_idx = $_POST["registration_idx"] ?? null;
	$message =createMessage("en", "registration", $name , $email, "[IMCVP 2024] Registration", date("Y-m-d H:i:s"), "", "", 1, "", "", "", "", "", "", "", $data);
	createDraft($service, "secretariat@imcvp.org", $message);
	sendMessage($service, "secretariat@imcvp.org", $message);

	$invitation_check_yn = $_POST["invitation_check_yn"] ?? null;
	if($invitation_check_yn == "Y") {
		$message =createMessage("en", "visa_registration", $name , $email, "[IMCVP 2024] Registration Invitation", date("Y-m-d H:i:s"), "", "", 1);
		createDraft($service, "secretariat@imcvp.org", $message);
		sendMessage($service, "secretariat@imcvp.org", $message);
	}

	if($message) {
		$res = [
			"code" => 200,
			"msg" => "success"
		];
		echo json_encode($res);
		exit;	
	} else {
		$res = [
			"code" => 400,
			"msg" => "update query error"
		];
		echo json_encode($res);
		exit;
	}
}

else if($_POST["flag"] == "abstract_pre"){
	$abstract_idx = $_POST["idx"];

	// submission_info
	$submit_data_query = "SELECT 
							idx, submission_code, nation_no, first_name, last_name, affiliation, email, phone, abstract_title, presentation_type, abstract_category
						FROM request_abstract";
	$submit_data = sql_fetch($submit_data_query." WHERE idx = ".$abstract_idx) ?? [];

	// presenting_author
	$presenting_author_data = get_data($submit_data_query." WHERE (idx=".$abstract_idx." OR parent_author=".$abstract_idx.") AND presenting_author='Y'") ?? [];

	// corresponding_author
	$corresponding_submit_data = get_data($submit_data_query." WHERE (idx=".$abstract_idx." OR parent_author=".$abstract_idx.") AND corresponding_author='Y'") ?? [];
			
	// abstract_category
	$info_poster_abstract_category_sql = "SELECT 
												idx, title_en, title_ko
											FROM info_poster_abstract_category
											WHERE is_deleted = 'N'";
	$info_poster_abstract_category_data = get_data($info_poster_abstract_category_sql);
	$poster_category_map = [];

	foreach($info_poster_abstract_category_data as $obj) {
		$poster_category_map[$obj["idx"]] = $obj["title_en"];
	}

	// toffic
	$presentation_type_arr = array("Oral Presentation", "Poster Exhibition", "Guided Poster Presentation", "Any of them");

	// Position
	$position_arr = array("Professor", "Physician", "Researcher", "Student", "Other");

	// nation
	$nation_query = "SELECT *
					FROM nation";
	$nation_list = get_data($nation_query);
	$nation_map = [];

	foreach($nation_list as $obj) {
		$nation_map[$obj["idx"]] = $obj["nation_en"];
	}

	$data = [
		"submit_data"				=> $submit_data,
		"presenting_author_data"	=> $presenting_author_data,
		"corresponding_submit_data"	=> $corresponding_submit_data,
		"poster_category_map"		=> $poster_category_map,
		"presentation_type_arr"		=> $presentation_type_arr,
		"position_arr"				=> $position_arr,
		"nation_map"				=> $nation_map
	];

	$message =createMessage($language, "abstract", "", $email, "[IMCVP 2024]".$subject, date("Y-m-d H:i:s"), "", "", 1, "", "", "", $user_email, date("Y-m-d H:i:s"), $title, $abstract_title, $data);
	createDraft($service, "secretariat@imcvp.org", $message);
	sendMessage($service, "secretariat@imcvp.org", $message);
}
if($_POST["flag"] == "abstract") {

	$email = $_POST["email"];
	$name = $_POST["name"];
	$subject = $_POST["subject"];
	$title = $_POST["title"];
	$topic_text = $_POST["topic_text"];
	$nation = $_POST["nation"];
	$time = date("Y-m-d H:i:s");

	$message =createMessage("en", "abstract", $name, $email, "[IMCVP 2024] Abstract Successfully Submitted", $time, "", "", 1, "", "", "", $email, $time, $topic_text, $title);
	createDraft($service, "secretariat@imcvp.org", $message);
	sendMessage($service, "secretariat@imcvp.org", $message);

	$res = [
		code => 200,
		msg => "success"
	];
	echo json_encode($res);
	exit;	
}

	//[240419] sujoeng / 초록 채택 메일 추가 / 템플릿 변경 필요
else if($_POST["flag"] == "abstract_etc2"){
	$name = $_POST["name"] ?? null;
	$email = $_POST["email"] ?? null;
	$title = $_POST["title"] ?? null;
	$topic = $_POST["topic_text"] ?? null;
	$data = [
		'title' => $title,
		'topic' => $topic
	];
	$message =createMessage("en", "abstract_etc2", $name , $email, "[IMCVP 2024] 초록이 채택되었습니다!", date("Y-m-d H:i:s"), "", "", 1, "", "", "", "", "", "", "", $data);
	createDraft($service, "secretariat@imcvp.org", $message);
	sendMessage($service, "secretariat@imcvp.org", $message);

	if($message) {
		$res = [
			"code" => 200,
			"msg" => "success"
		];
		echo json_encode($res);
		exit;	
	} else {
		$res = [
			"code" => 400,
			"msg" => "update query error"
		];
		echo json_encode($res);
		exit;
	}
}


	//[240419] sujoeng / 좌장/연자/패널 메일 발송
	else if($_POST["flag"] == "speaker"){
		$post_data = $_POST["data"];

		$email = $data["email"] ?? null;
		$name = $data["nickname"] ?? null;
		$programIdx = $data["program_idx"] ?? null;

		$select_user_query =	"
						SELECT *
						FROM program AS p
						LEFT JOIN program_contents AS pc ON pc.program_idx = p.idx
						WHERE p.idx = {$programIdx}
		";

		$user_data = get_data($select_user_query);
	    array_unshift($user_data, $post_data); 

		$message =createMessage("en", "speaker", $name , $email, "[IMCVP 2024] 최종 안내문", date("Y-m-d H:i:s"), "", "", 1, "", "", "", "", "", "", "", $user_data);
		createDraft($service, "secretariat@imcvp.org", $message);
		sendMessage($service, "secretariat@imcvp.org", $message);
	
		if($message) {
			$res = [
				"code" => 200,
				"msg" => "success"
			];
			echo json_encode($res);
			exit;	
		} else {
			$res = [
				"code" => 400,
				"msg" => "update query error"
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