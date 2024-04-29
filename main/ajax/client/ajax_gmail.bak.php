<?php include_once("../../common/common.php");?>
<?php include_once("../../common/locale.php");?>

<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

//include_once('../../common/common.php');

include_once('../../plugin/google-api-php-client-main/vendor/autoload.php');


$language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
$locale = locale($language);


//define('DOMAIN', "http://54.180.8s6.106/main");
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
	
	$redirect_uri = 'https://icomes.or.kr/main/ajax/client/ajax_gmail.php';
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
        //file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}





// Get the API client and construct the service object.
$client = getClient();

$service = new Google_Service_Gmail($client);

// Print the labels in the user's account.
$user = 'secretariat@icomes.or.kr';
$results = $service->users_labels->listUsersLabels($user);

if (count($results->getLabels()) == 0) {
 // print "No labels found.\n";
} else {
 // print "Labels:\n";
  foreach ($results->getLabels() as $label) {
    //printf("- %s\n", $label->getName());
  }
}




	
function createMessage($language, $mail_type, $fname, $to, $subject, $time, $tmp_password, $callback_url, $type=0, $file="", $cc="", $bcc="", $id="", $date="", $category="", $title="", array $data = [], $registration_no = "") {
 $message = new Google_Service_Gmail_Message();

 $rawMessageString = "From: ICOMES2022<secretariat@icomes.or.kr>\r\n";
 $rawMessageString .= "To: <{$to}>\r\n";
 $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
 $rawMessageString .= "MIME-Version: 1.0\r\n";
 $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
 //$rawMessageString .= "Content-Type: text/html; charset=iso-8859-1\r\n";
 //$rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
 $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";

if($language == "ko") {

	if($mail_type == "find_password") {
		 $rawMessageString .= "<div style='width:670px;background-color:#fff;border:1px solid #ADF002;'>
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
	if($mail_type == "sign_up") {
		$rawMessageString .= "
		<div style='width:549px;background-color:#fff;border:1px solid #000;'>
			<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'>
			<h1 style='text-align:center; font-size:16px; font-weight:bold'>Sign-up Confirmation</h1>
			<div style='width:calc(100% - 80px); margin:24px auto 75px; background-color:#f8f8f8; padding:27px 34px 30px 17px; border-top:2px solid #707070; box-sizing:border-box;'>
				<p style='margin: 0; font-size: 15px; line-height: 26px; text-align: center; mso-line-height-alt: 26px; margin-top: 0; margin-bottom: 0;'>Thank you for joining ICOMES2022.<br>If you click the button below,<br>All services of ICOMES2022 are available.</p>
			</div>
			<div align='center' style='padding-top:5px;padding-right:0px;padding-bottom:0px;padding-left:0px;'>
			<!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'><tr><td align='center' style='padding-top: 5px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px'><xroundrect href='{$callback_url}' style='height:40.5pt;width:258.75pt;v-text-anchor:middle;'><xanchorlock></xanchorlock><xtextbox><center style='color:#ffffff; font-family:Arial, sans-serif; font-size:20px'><![endif]--><a href='{$callback_url}' style=':276px; line-:40px; font-size: 16px; font-weight:bold; color:#ffeb00; -webkit-text-size-adjust: none; text-decoration: none; display: inline-block; background-color: #23bf99; border-radius: 40px; -webkit-border-radius: 40px; -moz-border-radius: 40px; border: 2px solid #23bf99; font-family: arial, helvetica neue, helvetica, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; padding:10px 58px 10px 58px;' target='_blank' rel='noreferrer noopener'>E-mail Authentication<span style='margin-left:10px; font:inherit;'>&gt;</span></a>
			<!--[if mso]></center></xtextbox></xroundrect></td></tr></table><![endif]-->
			</div>
			<div style='border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;background-image:url('');background-position:center top;background-repeat:no-repeat'>
				<!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:640px'><tr style='background-color:#ffffff'><![endif]--><!--[if (mso)|(IE)]><td align='center' valign='top' width='640' style='background-color:#ffffff;width:640px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:35px; padding-bottom:0px;'><![endif]-->
				<div style='min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;'>
				<div style='width:100% !important;'>
				<!--[if (!mso)&(!IE)]><!-- -->
				<div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:100px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;'>
				<!--&lt;![endif]-->
				<div align='center' style='padding-right: 0px;padding-left: 0px;'>
				<!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr style='line-height:0px'><td align='center' style='padding-right: 0px;padding-left: 0px;'><![endif]--><img align='center' alt='Logo' border='0' src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 640px; display: block;' title='Logo' width='640' loading='lazy'>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-- -->
				</div>
				<!--&lt;![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		</div>";
	}

	if($mail_type == "find_password") {
		 $rawMessageString .= "<div style='width:549px;background-color:#fff;border:1px solid #000;'><img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'><h1 style='text-align:center; font-size:16px; font-weight:bold'>Temporary Password</h1><div style='width:calc(100% - 80px); margin:24px auto 50px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'><div><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Member of : <span>{$fname}</span></p><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>You requested a temporary password at : <span>{$time}</span></p><p style='font-size:10px; color:#707070; margin:10px 0 0 0;'>(If you have never requested a temporary password, please delete the email.)</p></div><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Since our site does not have your password even if you are an administrator, Instead of giving you your password, we’re creating a new one and guiding you.</p><p style='font-size:12px; font-weight:bold; color:#FF3333; margin:25px 0 0 0;'>Check the password below to change.<br/>Click the “<span style='font:inherit; color:inherit; text-decoration:underline;'>Change to temporary password</span>” button.</p><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>When an authentication message is printed stating that the password has been changed,</p><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Please enter your member ID and changed password on the homepage and log in.</p><p style='font-size:10px; color:#707070;'>After logging in, please change to a new password from the Modify Information menu.</p><div style='padding:16px; border:1px solid #5DBC9B; border-radius:15px; margin-top:25px;'><ul style='padding:0; margin:0;'><li style='list-style:none;'><i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i><span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Member ID : {$to}</span><input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'></li><li style='list-style:none;'><i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i><span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Temporary password :{$tmp_password}</span><input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'></li></ul></div><p style='font-size:12px; line-height:22px; color:#000; margin-top:20px; margin-bottom:0;'>Regards,<br/>ICOMES</p><a href='{$callback_url}' style='text-decoration:none;'><button type='button' style='display:block; margin:70px auto 0; font-size:16px; font-weight:bold; color:#FFEB00; background-color:#23BF99; padding:10px 58px 34px 58px; border-radius:30px; border:none;'>Change to temporary password<span style='margin-left:10px; font:inherit;'>&gt;</span></button></a></div><img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'></div>";
	}
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
									<table width='549' cellspacing='0' cellpadding='0' style='width: 549px !important; max-width:549px !important; margin: 0px auto; padding:0; border:1px solid;' >
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
												</td>
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

			$rawMessageString .= "<div style='width:549px;background-color:#fff;border:1px solid #000;'><img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'><h1 style='text-align:center; font-size:16px; font-weight:bold'>Letter of Invitation</h1><div style='width:calc(100% - 80px); margin:24px auto 100px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p><p style='font-size:10px; color:#000 ;margin-top:16px; margin-bottom:25px;'>On behalf of the ICOMES organizing committee, we cordially invite you as participant to “ICOMES 2022 International Conference” to be held at the Conrad Seoul Hotel, Seoul, Korea on September 1(Thu)-3(Sat), 2022. </p><p style='font-size:10px; color:#000; margin-bottom:25px;'>ICOMES has grown as a worldwide academic society with more than 1000 participants and eminent representative speakers in obesity every year since 2015 at its launch. ICOMES is an international academic conference that promotes cooperation among multidisciplinary study fields, providing in-depth lectures and symposiums on basic medicine and clinical medicine on obesity, metabolic syndrome, dyslipidemia, and other obesity-related diseases.<br/>The main theme of ICOMES 2022 is ‘The Next Normal - The Future of Obesity Care’. Your Presentation will be a great addition to our conference.</p><p style='font-size:10px; color:#000;'>For building instructive, insightful and interesting meeting, we would like you to take as a role of; </p><div style='padding:10px 0; margin-top:16px; border-top:1px solid #000; border-bottom:1px solid #000;'><div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Date</span><span style='vertical-align:middle; font-size:10px;'>September 1(Thu)~3(Sat)</span></div>
			<div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Venue</span><span style='vertical-align:middle; font-size:10px;'>Conrad Hotel Seoul, Korea</span></div></div><div style='font-size:10px; margin:14px 0 60px;'>
			We invite you to ICOMES 2022 to create an informative, insightful and exciting<br/>meeting. <a href='mailto:icomes_registration@into-on.com' style='font-size:10px; font-weight:bold; color:#10BF99;'>(icomes_registration@into-on.com).</a></div><ul style='margin:0; padding:0; text-align:center; font-size:0;'><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top;'><p style='font-size:12px; font-weight:bold; margin:0;'>Kijin Kim</p><p style='font-size:8px;'>Chairman of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign01.png' alt=''></li><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top; margin-left:15%;'><p style='font-size:12px; font-weight:bold; margin:0;'>Chang-Beom Lee</p><p style='font-size:8px;'>President of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign02.png' style='margin-top:10px;' alt=''></li></ul></div><img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'></div>";
		
	}


	if($mail_type == "abstract") {           

			$rawMessageString .= "
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
   //print 'An error occurred: ' . $e->getMessage();
 }

 return null;
}

if($_POST["flag"] == "sign_up") {
	
	$email = isset($_POST["email"]) ? $_POST["email"] : "";

	try {
		 $select_user_query =	"
									SELECT
										*
									FROM member
									WHERE email = '{$email}'
									AND is_deleted = 'N'
								";
		
		$user_data = sql_fetch($select_user_query);

		$subject = $locale("mail_sign_up_subject");
		$callback_url = D9_DOMAIN."/signup_certified.php?idx=".$user_data["idx"];
		
		$message =createMessage("en", "sign_up", "", $email, "[ICOMES]".$subject, date("Y-m-d H:i:s"), "", $callback_url, 1);
		createDraft($service, "secretariat@icomes.or.kr", $message);
		sendMessage($service, "secretariat@icomes.or.kr", $message);

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

		$message =createMessage($language, "find_password", $name, $email, "[ICOMES]".$subject, date("Y-m-d H:i:s"), $temporary_password, $callback_url, 0);
		createDraft($service, "secretariat@icomes.or.kr", $message);
		sendMessage($service, "secretariat@icomes.or.kr", $message);

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
	} catch(\throwable $tw) {
		echo $tw->getMessage();
		exit;
	}
}

else if($_POST["flag"] == "payment"){
	$name = $_POST["name"] ?? null;
	$email = $_POST["email"] ?? null;
	$data = $_POST["data"] ?? null;
	$message =createMessage("en", "payment", $name , $email, "[ICOMES] Payment Confirmation", date("Y-m-d H:i:s"), "", "", 1, "", "", "", "", "", "", "", $data);
	createDraft($service, "secretariat@icomes.or.kr", $message);
	sendMessage($service, "secretariat@icomes.or.kr", $message);
}

else if($_POST["flag"] == "registration"){
	$name = $_POST["name"] ?? null;
	$email = $_POST["email"] ?? null;
	$data = $_POST["data"] ?? null;
	$registration_idx = $_POST["registration_idx"] ?? null;
	$message =createMessage("en", "registration", $name , $email, "[ICOMES] Registration", date("Y-m-d H:i:s"), "", "", 1, "", "", "", "", "", "", "", $data);
	createDraft($service, "secretariat@icomes.or.kr", $message);
	sendMessage($service, "secretariat@icomes.or.kr", $message);

	$invitation_check_yn = $_POST["invitation_check_yn"] ?? null;
	if($invitation_check_yn == "Y") {
		$message =createMessage("en", "visa_registration", $name , $email, "[ICOMES] Registration Invitation", date("Y-m-d H:i:s"), "", "", 1);
		createDraft($service, "secretariat@icomes.or.kr", $message);
		sendMessage($service, "secretariat@icomes.or.kr", $message);
	}

	if($message) {
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
}

else if($_POST["flag"] == "abstract"){

	$language = $_POST["language"] ?? "en";
	$email = $_POST["email"] ?? "";
	$subject = $_POST["subject"] ?? "";
	$user_email = $_POST["user_email"] ?? "";
	$title = $_POST["title"] ?? "";
	$abstract_title = $_POST["abstract_title"] ?? "";

	$message =createMessage($language, "abstract", "", $email, "[ICOMES]".$subject, date("Y-m-d H:i:s"), "", "", 1, "", "", "", $user_email, date("Y-m-d H:i:s"), $title, $abstract_title);
	createDraft($service, "secretariat@icomes.or.kr", $message);
	sendMessage($service, "secretariat@icomes.or.kr", $message);
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