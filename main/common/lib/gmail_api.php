<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/main/plugin/PHPMailer/PHPMailerAutoload.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/main/plugin/PHPMailer/class.phpmailer.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/main/common/locale.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

//include_once('../../common/common.php');
include_once('../../plugin/google-api-php-client-main/vendor/autoload.php');

class Template
{
    protected $_file;
    protected $_data = array();

    public function __construct($file = null)
    {
        $this->_file = $file;
    }

    public function set($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }

    public function render()
    {
        extract($this->_data);
        ob_start();
        include($this->_file);
        return ob_get_clean();
    }
}


//define('DOMAIN', "http://54.180.86.106/main");
if (php_sapi_name() != 'cli') {
    //throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Gmail API PHP Quickstart');
    //$client->setScopes(Google_Service_Gmail::GMAIL_READONLY);
	$client->setAuthConfig('../../plugin/google-api-php-client-main/credentials.json');
	$client->setIncludeGrantedScopes(true);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
	//$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');

	//$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	
	$redirect_uri = 'https://icomes.or.kr/main/common/lib/gmail_api.php';
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
    $tokenPath = 'token.json';
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
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}





// Get the API client and construct the service object.
$client = getClient();

$service = new Google_Service_Gmail($client);

// Print the labels in the user's account.
$user = 'info@icomes.or.kr';
$results = $service->users_labels->listUsersLabels($user);

if (count($results->getLabels()) == 0) {
  print "No labels found.\n";
} else {
  print "Labels:\n";
  foreach ($results->getLabels() as $label) {
    printf("- %s\n", $label->getName());
  }
}


/**
* @param $sender string sender email address 문자열 발신자 이메일 주소
* @param $to string recipient email address 문자열 수신자 이메일 주소
* @param $subject string email subject 문자열 이메일 제목
* @param $messageText string email text 문자열 이메일 텍스트
* @return Google_Service_Gmail_Message
*/


function createMessage($language, $mail_type, $fname, $to, $subject, $time, $tmp_password, $callback_url, $type=0, $file="", $cc="", $bcc="", $id="", $date="", $category="", $title="", array $data = [], $registration_no = "") {


	 $message = new Google_Service_Gmail_Message();

	 $rawMessageString = "From: <info@icomes.or.kr>\r\n";
	 $rawMessageString .= "To: <{$to}>\r\n";
	 $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
	 $rawMessageString .= "MIME-Version: 1.0\r\n";
	 $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
	 //$rawMessageString .= "Content-Type: text/html; charset=iso-8859-1\r\n";
	 //$rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
	 $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";


	if($language == "ko") {
		if($mail_type == "find_password") {
		 $rawMessageString .=	
					"
						<div style='width:670px;background-color:#fff;border:1px solid #ADF002;'>
							<img src='http://icomes.or.kr/main/img/icomes_mail_top.png' style='width:100%;margin-bottom:60px;'>
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
							<img src='http://icomes.or.kr/main/img/icomes_mail_bottom.png' style='width:100%;margin-top:60px;'>
						</div>";
		}

	} else {
		
		if($mail_type == "payment") {
					
				$licence_number = $data["licence_number"] ?? "-";
				$attendance_type = $data["attendance_type"] ?? "-";
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
				$is_score = $data["is_score"] ?? "";
				$is_score = ($is_score == 1) ? "Yes" : "No";

				$member_status = $data["member_status"] ?? "-";
				$member_status = ($member_status == 1) ? "Yes" : "No";

				$nation_no = $data["nation_no"] ?? "";
				$nation_sql = "SELECT
									nation_en
								FROM nation
								WHERE idx = {$nation_no}";
				
				$nation_no = sql_fetch($nation_sql)["nation_en"];

				$phone = $data["phone"] ?? "";
				$member_type = $data["member_type"] ?? "";
				$registration_type = $data["registration_type"] ?? "-";
				$registration_type = ($registration_type == 0) ? "Yes" : "No";

				$affiliation = $data["affiliation"] ?? "-";
				$department = $data["department"] ?? "-";
				$academy_number = $data["academy_number"] ?? "-"; 


				$rawMessageString .= "
							<div style='width:549px;background-color:#fff;border:1px solid #000;'>
								<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'>
								<h1 style='font-size:16px; font-weight:bold; text-align:center;'>Payment Confirmation</h1>
								<div style='width:calc(100% - 80px); margin:24px auto 50px; background-color:#f8f8f8; padding:27px 35px 30px; border-top:2px solid #707070; box-sizing:border-box;'>
									<p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p>
									<p style='font-size:10px; color:#000 ;margin-top:19px; margin-bottom:40px;'>
										Thank you for payment the registration for the ICOMES 2022 International Congress on Obesity and Metabolic Syndrome.(ICOMES 2022)
									</p>
									<table style='width: 100%; border-collapse: collapse;'>
										<colgroup>
											<col width='160px'>
											<col width='*'>
										</colgroup>	
										<tbody>
											<tr style='border-bottom:1px solid #707070; border-top:1px solid #707070;;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Attendance Type</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$attendance_type}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>On-site</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$registration_type}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>평점신청여부</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$is_score}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>KSSO Membership</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$member_status}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>ID</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$to}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Country</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$nation_no}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Name</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$fname}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Phone number</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$phone}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Attendant type</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$member_type}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Affiliation</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$affiliation}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Department</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$department}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Doctor’s license Number</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$licence_number}</td>
											</tr>
											<tr style='border-bottom:1px solid #707070;'>
												<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>학회번호</th>
												<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$academy_number}</td>
											</tr>
										</tbody>
									</table>
									<p style='font-size:10px; color:#000 ;margin-top:19px;'>
										You can also view in your account your payment status and receive the payment receipt by going to “My Page” from the <a href='https://icomes.or.kr/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>“ICOMES 2022”</a> website
										<br><br>
										We express our gratitude to you for your interest in the ICOMES 2022 and look forward to seeing you in September in Seoul, Korea.
										<br><br>
										Warmest regards,
										<br><br>
										ICOMES 2022 Secretariat
									</p>
								</div>
								<img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'>
							</div>";
				}
		}



		if($mail_type == "registration") {

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
					$content_value = "Please visit our website(<a href='https://icomes.or.kr/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>https://icomes.or.kr</a>) with your account to					submit the abstract and register.<br>
									If you Early-Bird and pay the registration fee by May 19th(Thu), you will receive a 30% OFF! <br>
									Don’t miss out on early bird rates!<br>
									Note the payment deadline of Jul 28(Thu) at 12pm(KST).<br><br>";
				} else {
					$content_value = "Please visit our website(<a href='https://icomes.or.kr/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>https://icomes.or.kr</a>) with your account to					submit the abstract and register.<br>
									If you Registration and pay the registration fee by Jul 28th(Thu), you will receive a 10% OFF! <br>
									Don’t miss out on register rates!<br>
									Note the payment deadline of Jul 28(Thu) at 12pm(KST).<br><br>";
				}

				$rawMessageString .= "<table width='549' cellspacing='0' cellpadding='0' style='width: 549px !important; max-width:549px !important; margin: 0px auto; padding:0; border:1px solid;' >
								<tr>
									<td width='549' valign='top' style='width:549px; vertical-align:top; font-size:0; line-height:0;'>
										<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' alt='2022 mailer' width='549' style='width: 549px; vertical-align: top; border: 0; display:block;'>
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
										<table width='480' style='width:calc(100% - 80px); box-sizing:border-box;'>
											<tbody>
												<tr>
													<table width='420' style='display:inline-block; width:calc(100% - 30px); border-top:2px solid #707070; background-color:#f8f8f8;'>
														<tbody>
															<tr>
																<td style='padding:0 30px;'>
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
																					Your account has been successfully created.<br/>Please review the information that you have entered and inform the secretariat of any<br/>errors. 
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
																				<th style='border-bottom:1px solid #707070; font-size: 8px; line-height:12px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>KSSO Membership</th>
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
																					ICOMES 2022 Secretariat
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
												</tr>
												<tr>
													<td width='549' valign='top' style='width:549px; vertical-align:top; font-size:0; line-height:0;'>
														<img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'>
													</td>
												</tr>
											</tbody>
										</table>
									</td>	
								</tr>
							</table>";
		}


		if($mail_type == "visa_registration") {

			$content = "<div style='width:549px;background-color:#fff;border:1px solid #000;'><img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'><h1 style='text-align:center; font-size:16px; font-weight:bold'>Letter of Invitation</h1><div style='width:calc(100% - 80px); margin:24px auto 100px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p><p style='font-size:10px; color:#000 ;margin-top:16px; margin-bottom:25px;'>On behalf of the ICOMES organizing committee, we cordially invite you as participant to “ICOMES 2022 International Conference” to be held at the Conrad Seoul Hotel, Seoul, Korea on September 1(Thu)-3(Sat), 2022. </p><p style='font-size:10px; color:#000; margin-bottom:25px;'>ICOMES has grown as a worldwide academic society with more than 1000 participants and eminent representative speakers in obesity every year since 2015 at its launch. ICOMES is an international academic conference that promotes cooperation among multidisciplinary study fields, providing in-depth lectures and symposiums on basic medicine and clinical medicine on obesity, metabolic syndrome, dyslipidemia, and other obesity-related diseases.<br/>The main theme of ICOMES 2022 is ‘The Next Normal - The Future of Obesity Care’. Your Presentation will be a great addition to our conference.</p><p style='font-size:10px; color:#000;'>For building instructive, insightful and interesting meeting, we would like you to take as a role of; </p><div style='padding:10px 0; margin-top:16px; border-top:1px solid #000; border-bottom:1px solid #000;'><div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Date</span><span style='vertical-align:middle; font-size:10px;'>September 1(Thu)~3(Sat)</span></div>
			<div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Venue</span><span style='vertical-align:middle; font-size:10px;'>Conrad Hotel Seoul, Korea</span></div></div><div style='font-size:10px; margin:14px 0 60px;'>
			We invite you to ICOMES 2022 to create an informative, insightful and exciting<br/>meeting. <a href='mailto:icomes_registration@into-on.com' style='font-size:10px; font-weight:bold; color:#10BF99;'>(icomes_registration@into-on.com).</a></div><ul style='margin:0; padding:0; text-align:center; font-size:0;'><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top;'><p style='font-size:12px; font-weight:bold; margin:0;'>Kijin Kim</p><p style='font-size:8px;'>Chairman of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign01.png' alt=''></li><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top; margin-left:15%;'><p style='font-size:12px; font-weight:bold; margin:0;'>Chang-Beom Lee</p><p style='font-size:8px;'>President of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign02.png' style='margin-top:10px;' alt=''></li></ul></div><img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'></div>";
		
		}

		if($mail_type == "find_password") {

			$content = "<div style='width:549px;background-color:#fff;border:1px solid #000;'><img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'><h1 style='text-align:center; font-size:16px; font-weight:bold'>Temporary Password</h1><div style='width:calc(100% - 80px); margin:24px auto 50px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'><div><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Member of : <span>{$fname}</span></p><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>You requested a temporary password at : <span>{$time}</span></p><p style='font-size:10px; color:#707070; margin:10px 0 0 0;'>(If you have never requested a temporary password, please delete the email.)</p></div><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Since our site does not have your password even if you are an administrator, Instead of giving you your password, we’re creating a new one and guiding you.</p><p style='font-size:12px; font-weight:bold; color:#FF3333; margin:25px 0 0 0;'>Check the password below to change.<br/>Click the “<span style='font:inherit; color:inherit; text-decoration:underline;'>Change to temporary password</span>” button.</p><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>When an authentication message is printed stating that the password has been changed,</p><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Please enter your member ID and changed password on the homepage and log in.</p><p style='font-size:10px; color:#707070;'>After logging in, please change to a new password from the Modify Information menu.</p><div style='padding:16px; border:1px solid #5DBC9B; border-radius:15px; margin-top:25px;'><ul style='padding:0; margin:0;'><li style='list-style:none;'><i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i><span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Member ID : {$to}</span><input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'></li><li style='list-style:none;'><i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i><span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Temporary password :{$tmp_password}</span><input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'></li></ul></div><p style='font-size:12px; line-height:22px; color:#000; margin-top:20px; margin-bottom:0;'>Regards,<br/>ICOMES</p><a href='{$callback_url}' style='text-decoration:none;'><button type='button' style='display:block; margin:70px auto 0; font-size:16px; font-weight:bold; color:#FFEB00; background-color:#23BF99; padding:10px 58px 34px 58px; border-radius:30px; border:none;'>Change to temporary password<span style='margin-left:10px; font:inherit;'>&gt;</span></button></a></div><img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'></div>";

		}

		if($mail_type == "abstract") {           

			$content = "
							<div style='width:549px;background-color:#fff;border:1px solid #000;'>
								<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'>
								<h1 style='font-size:16px; font-weight:bold; text-align:center;'>Abstract Successfully Submitted </h1>
								<div style='width:calc(100% - 80px); margin:24px auto 0; background-color:#f8f8f8; padding:27px 35px 30px; border-top:2px solid #707070; box-sizing:border-box;'>
									<p style='font-size:12px; line-height:20px; color:#000; margin:0;'>Thank you for your interest in ICOMES 2022! Your abstract submission has been received. Please read the following information carefully, mark your calendar with important dates and deadlines, and save this message.<br><br>Upon successful submission of your abstract, you will immediately see the following confirmation notice on your screen, followed by the same message via e‐ mail. If you did not receive the following message, your abstract was not successfully submitted. Please try again, or contact <a href='mailto:icomes_abstracts@into-on.com' style='font-weight:bold; color:#10BF99; text-decoration:underline;'>icomes_abstracts@into-on.com</a> for assistance if you are having difficulty. The deadline for abstract submissions is 16 July (submissions close at 11:59 p.m. Korea Standard Time). It is your responsibility to address questions about submissions before 16 July, so that if there is a problem, we can still help you make the submission on time. Be sure to print and/or save the confirmation of submission notices for reference in case of a problem or question.</p>
								</div>
								<p style='font-size:12px; font-weight:bold; color:#000; line-height:20px; padding:0 75px; margin:23px 0 72px;'>This is an automated message, Please do not reply. <br>**Please save this information for reference.</p>
								<img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'>
							</div>
			";
		}





 //$rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
 $rawMessage = rtrim(strtr(base64_encode($rawMessageString), '+/', '-_'), '=');
 $message->setRaw($rawMessage);
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
   print 'Draft ID: ' . $draft->getId();
 } catch (Exception $e) {
   print 'An error occurred: ' . $e->getMessage();
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
   print 'Message with ID: ' . $message->getId() . ' sent.';
   return $message;
 } catch (Exception $e) {
   print 'An error occurred: ' . $e->getMessage();
 }

 return null;
}


function gmail_start($language, $mail_type, $fname, $to, $subject, $time, $tmp_password, $callback_url, $type=0, $file="", $cc="", $bcc="", $id="", $date="", $category="", $title="", array $data = [], $registration_no = ""){

	//$message =createMessage($language, "find_password", $name, $email, "[ICOMES]".$subject, date("Y-m-d H:i:s"), $temporary_password, $callback_url, 0);
	//createDraft($service, "info@icomes.or.kr", $message);
	//sendMessage($service, "info@icomes.or.kr", $message);

}


?>