<?php

$root_path = ROOT_PATH;

include_once("{$root_path}/plugin/PHPMailer/PHPMailerAutoload.php");
include_once("{$root_path}/plugin/PHPMailer/class.phpmailer.php");
include_once("{$root_path}/common/locale.php");

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



function mailer($language, $mail_type, $fname, $to, $subject, $time, $tmp_password, $callback_url, $user_idx=0, $type=0, $file="", $cc="", $bcc="", $id="", $date="", $category="", $title="", array $data = [], $registration_no = "") { //$language에 따른 content 처리해야됨
	
	if($_SERVER["HTTP_HOST"] == "43.200.170.254") {
		$background_img_url = "http://".$_SERVER["HTTP_HOST"]."/main";
	} else {
		$background_img_url = "https://2023.icomes.or.kr/";
	}


	$content = "";
	if($language == "ko") {
		if($mail_type == "sign_up") {
            //$template = new Template($_SERVER["DOCUMENT_ROOT"]."/main/common/lib/confirm.php");
            //$template->set('callback_url', $callback_url);
            //$content = $template->render();         
			
			$data = isset($_POST["data"]) ? $_POST["data"] : "";
			//$mail_query = "
			//	SELECT 
			//		email, last_name, first_name, first_name_kor, last_name_kor, affiliation, affiliation_kor, phone
			//	FROM member
			//	WHERE idx = {$user_idx};
			//";
			//$user_data = sql_fetch($mail_query);
			$email = $data["email"];
			$last_name = $data["last_name"];
			$first_name = $data["first_name"];
			$first_name_kor = $data["first_name_kor"];
			$last_name_kor = $data["last_name_kor"];
			$affiliation = $data["affiliation"];
			$affiliation_kor = $data["affiliation_kor"];
			$phone = $data["phone"];
			$title = $data["title"];
			$title = $title == "Others" ? $data["title_input"] : $title;

			$content = "
						<div style='width:670px;background-color:#F8F8F8;border:1px solid #f2f2f2; padding: 0 40px;'>
							<img src='".$background_img_url."/img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
							<div style='width:calc(100% + 80px);margin-left:-40px;margin-bottom:60px;background-color:#00666B;text-align:center;font-size: 21px; color: #FFF;padding: 10px 0;border-top:2px solid #707070;'>[ICOEMS 2023] Welcome to ICOMES 2023!</div>	
							<div>
								<div style='margin-bottom:10px; background-color:#F8F8F8; padding:17px 34px; box-sizing:border-box;'>
									<div>
										<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear {$title} {$first_name} {$last_name},</p>
										<p style='font-size:14px;color:#170F00;margin-top:14px;'>Thank you for signing up for the ICOMES 2023.<br>Your profile has been successfully created.<br>Please review the information that you have entered as below.<br>If necessary, you can access ‘ICOMES 2023 website - MY PAGE’ to review,<br>modify or update your personal information.</p>
										<table style='border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
											<tbody>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>ID (Email Address)</th>
													<td style='font-size:14px; padding:10px;'><a href='javascript:;' class='link'>{$email}</a></td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Name</th>
													<td style='font-size:14px; padding:10px; width:165px;'>{$first_name}</td>
													<td style='font-size:14px; padding:10px; border-left:1px solid #000'>{$last_name}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>성명</th>
													<td style='font-size:14px; padding:10px; width:165px;'>{$first_name_kor}</td>
													<td style='font-size:14px; padding:10px; border-left:1px solid #000'>{$last_name_kor}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Affiliation</th>
													<td style='font-size:14px; padding:10px;'>{$affiliation}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>소속</th>
													<td style='font-size:14px; padding:10px;'>{$affiliation_kor}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>phone number</th>
													<td style='font-size:14px; padding:10px;'>{$phone}</td>
												</tr>
											</tbody>	
										</table>
										<p>We express our gratitude to you for your interest in ICOMES 2023.</p>
									</div>
								</div>
								<!-- 23.04.25 수정된 버튼 마크업 -->
								<p style='margin: 0 0 5px 34px'>Warmest regards,</p>
								<p style='margin: 0 0 34px 34px'>Secretariat of ICOMES 2023</p>
								<div style='text-align: center;'>
									<a href='http://43.200.170.254/main/index.php' type='button' style='display:inline-block; padding:5px 20px 10px 20px; border-radius: 25px;border: 2px solid #174A77;outline: 2px solid #DFDFDF;background: linear-gradient(to top, #293380, #8CC5D1);font-size: 18px;font-weight: 500;color: #FFFFFF;cursor: pointer; text-decoration: none;'>Go to ICOMES 2023 Website</a>
								</div>
							</div>
							<img src='".$background_img_url."/img/mail_footer_2023.png' style='width:calc(100% + 80px); margin-top:60px; margin-left:-40px;'>
						</div>
			";

		}

		if($mail_type == "find_password") {
			$email = $_POST["email"];
			$content =	
						"<div style='width:670px;background-color:#F8F8F8;border:1px solid #f2f2f2; padding: 0 40px;'><img src='".$background_img_url."/img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'><div style='width:calc(100% + 80px);margin-left:-40px;margin-bottom:60px;background-color:#00666B;text-align:center;font-size: 21px; color: #FFF;padding: 10px 0;border-top:2px solid #707070;'>[ICOEMS 2023] Temporary Password</div>	<div><div><div style='margin-bottom:10px; background-color:#F8F8F8; padding:17px 34px; box-sizing:border-box;'><div><div style='margin-bottom:20px'><p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Member of : {$fname} <br><span style='font-size:14px;color:#170F00;font-weight:normal;'>You requested a temporary password at : {$time}</span></p></div><p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear , {$fname}</p><p style='font-size:14px;color:#170F00;margin-top:14px;'>You can log in to the ICOMES 2023 website using the ID & Temporary Password below and<br> modify your password on the personal information on my page.</p><table style='border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'><tbody><tr style='border-bottom:1px solid #000;'><th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>ID (Email Address)</th><td style='font-size:14px; padding:10px;'><a href='mailto:{$email}' class='link font_inherit'>{$email}</a></td></tr><tr style='border-bottom:1px solid #000;'><th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Temporary Password</th><td style='font-size:14px; padding:10px;'>{$tmp_password}</td></tr></tbody></table><p style='color:#f00;'>Click the 'Change to temporary password' button to check your changed log-in information.</p></div></div><!-- 23.04.25 수정된 버튼 마크업 --><p style='margin: 0 0 5px 34px'>Best regards,</p><p style='margin: 0 0 34px 34px'>Secretariat of ICOMES 2023</p><div style='text-align: center;'><a href='http://43.200.170.254/main/login.php' type='button' style='display:inline-block; padding:5px 20px 10px 20px; border-radius: 25px;border: 2px solid #174A77;outline: 2px solid #DFDFDF;background: linear-gradient(to top, #293380, #8CC5D1);font-size: 18px;font-weight: 500;color: #FFFFFF;cursor: pointer; text-decoration: none;'>Change to temporary password</a></div></div><img src='".$background_img_url."/img/mail_footer_2023.png' style='width:calc(100% + 80px); margin-top:60px; margin-left:-40px;'></div>
						";


			//$content =	
			//			"
			//				<div style='width:670px;background-color:#F8F8F8;border:1px solid #f2f2f2; padding: 0 40px;'>
			//					<img src='".$background_img_url."/img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
			//					<div style='width:calc(100% + 80px);margin-left:-40px;margin-bottom:60px;background-color:#00666B;text-align:center;font-size: 21px; color: #FFF;padding: 10px 0;border-top:2px solid #707070;'>[ICOEMS 2023] Temporary Password</div>	
			//					<div>
			//					<div>
			//						<div style='margin-bottom:10px; background-color:#F8F8F8; padding:17px 34px; box-sizing:border-box;'>
			//							<div>
			//								<div style='margin-bottom:20px'>
			//									<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Member of : {$fname} <br><span style='font-size:14px;color:#170F00;font-weight:normal;'>You requested a temporary password at : {$time}</span></p>
			//								</div>
			//								<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear , {$fname}</p>
			//								<p style='font-size:14px;color:#170F00;margin-top:14px;'>You can log in to the ICOMES 2023 website using the ID & Temporary Password below and<br> modify your password on the personal information on my page.</p>
			//								<table style='border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
			//									<tbody>
			//										<tr style='border-bottom:1px solid #000;'>
			//											<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>ID (Email Address)</th>
			//											<td style='font-size:14px; padding:10px;'><a href='mailto:{$email}' class='link font_inherit'>{$email}</a></td>
			//										</tr>
			//										<tr style='border-bottom:1px solid #000;'>
			//											<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Temporary Password</th>
			//											<td style='font-size:14px; padding:10px;'>{$tmp_password}</td>
			//										</tr>
			//									</tbody>	
			//								</table>
			//								<p style='color:#f00;'>Click the 'Change to temporary password' button to check your changed log-in information.</p>
			//							</div>
			//						</div>
			//						<!-- 23.04.25 수정된 버튼 마크업 -->
			//						<p style='margin: 0 0 5px 34px'>Best regards,</p>
			//						<p style='margin: 0 0 34px 34px'>Secretariat of ICOMES 2023</p>
			//						<div style='text-align: center;'>
			//							<a href='http://43.200.170.254/main/login.php' type='button' style='display:inline-block; padding:5px 20px 10px 20px; border-radius: 25px;border: 2px solid #174A77;outline: 2px solid #DFDFDF;background: linear-gradient(to top, #293380, #8CC5D1);font-size: 18px;font-weight: 500;color: #FFFFFF;cursor: pointer; text-decoration: none;'>Change to temporary password</a>
			//						</div>
			//					</div>
			//					<img src='".$background_img_url."/img/mail_footer_2023.png' style='width:calc(100% + 80px); margin-top:60px; margin-left:-40px;'>
			//				</div>
			//			";
		}

		if($mail_type == "abstract") {                  
            $template = new Template($_SERVER["DOCUMENT_ROOT"]."/main/common/lib/abstract.php");
            $template->set('id', $id);
            $template->set('date', $date);
            $template->set('category', $category);
            $template->set('title', $title);
            $content = $template->render();  
		}

	} else if($language == "en") {
		if($mail_type == "sign_up") {
            //$template = new Template($_SERVER["DOCUMENT_ROOT"]."/main/common/lib/confirm.php");
            //$template->set('callback_url', $callback_url);
            //$content = $template->render();         
			
			$data = isset($_POST["data"]) ? $_POST["data"] : "";
			//$mail_query = "
			//	SELECT 
			//		email, last_name, first_name, first_name_kor, last_name_kor, affiliation, affiliation_kor, phone
			//	FROM member
			//	WHERE idx = {$user_idx};
			//";
			//$user_data = sql_fetch($mail_query);
			$email = $data["email"];
			$last_name = $data["last_name"];
			$first_name = $data["first_name"];
			$first_name_kor = $data["first_name_kor"];
			$last_name_kor = $data["last_name_kor"];
			$affiliation = $data["affiliation"];
			$affiliation_kor = $data["affiliation_kor"];
			$phone = $data["phone"];
			$title = $data["title"];
			$title = $title == "Others" ? $data["title_input"] : $title;

			$content = "
						<div style='width:670px;background-color:#F8F8F8;border:1px solid #f2f2f2; padding: 0 40px;'>
							<img src='".$background_img_url."/img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
							<div style='width:calc(100% + 80px);margin-left:-40px;margin-bottom:60px;background-color:#00666B;text-align:center;font-size: 21px; color: #FFF;padding: 10px 0;border-top:2px solid #707070;'>[ICOEMS 2023] Welcome to ICOMES 2023!</div>	
							<div>
								<div style='margin-bottom:10px; background-color:#F8F8F8; padding:17px 34px; box-sizing:border-box;'>
									<div>
										<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear {$title} {$first_name} {$last_name},</p>
										<p style='font-size:14px;color:#170F00;margin-top:14px;'>Thank you for signing up for the ICOMES 2023.<br>Your profile has been successfully created.<br>Please review the information that you have entered as below.<br>If necessary, you can access ‘ICOMES 2023 website - MY PAGE’ to review,<br>modify or update your personal information.</p>
										<table style='border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
											<tbody>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>ID (Email Address)</th>
													<td style='font-size:14px; padding:10px;'><a href='javascript:;' class='link'>{$email}</a></td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Name</th>
													<td style='font-size:14px; padding:10px; width:165px;'>{$first_name}</td>
													<td style='font-size:14px; padding:10px; border-left:1px solid #000'>{$last_name}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Affiliation</th>
													<td style='font-size:14px; padding:10px;'>{$affiliation}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>phone number</th>
													<td style='font-size:14px; padding:10px;'>{$phone}</td>
												</tr>
											</tbody>	
										</table>
										<p>We express our gratitude to you for your interest in ICOMES 2023.</p>
									</div>
								</div>
								<!-- 23.04.25 수정된 버튼 마크업 -->
								<p style='margin: 0 0 5px 34px'>Warmest regards,</p>
								<p style='margin: 0 0 34px 34px'>Secretariat of ICOMES 2023</p>
								<div style='text-align: center;'>
									<a href='http://43.200.170.254/main/index.php' type='button' style='display:inline-block; padding:5px 20px 10px 20px; border-radius: 25px;border: 2px solid #174A77;outline: 2px solid #DFDFDF;background: linear-gradient(to top, #293380, #8CC5D1);font-size: 18px;font-weight: 500;color: #FFFFFF;cursor: pointer; text-decoration: none;'>Go to ICOMES 2023 Website</a>
								</div>
							</div>
							<img src='".$background_img_url."/img/mail_footer_2023.png' style='width:calc(100% + 80px); margin-top:60px; margin-left:-40px;'>
						</div>
			";

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


			$content = "
						<div style='width:670px;background-color:#F8F8F8;border:1px solid #000; border-radius:27px 27px 0 0; padding: 0 40px;'>
							<img src='./img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
							<div style='width:calc(100% + 80px);margin-left:-40px;margin-bottom:60px;background-color:#00666B;text-align:center;font-size: 21px; color: #FFF;padding: 10px 0;border-top:2px solid #707070;'>[ICOEMS 2023] Completed Registration</div>	
							<div>
							<div>
								<div style='margin-bottom:25px; background-color:#F8F8F8; padding:17px 34px; box-sizing:border-box;'>
									<div>
										<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear Bada Lee,</p>
										<p style='font-size:14px;color:#170F00;margin-top:14px;'>We express our gratitude for your registration for the International Congress on Obesity and MEtabolic Syndrome (ICOMES) 2023.	The registration details are presented below.<br/>Should you have any inquiries regarding your registration, kindly reach out to the ICOMES 2023 Secretariat for assistance.(<a href='mailto:icomes@into-on.com'>icomes@into-on.com</a>)</p>
										<table style='border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
											<tbody>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Registration No.</th>
													<td style='font-size:14px; padding:10px;'></td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Registration Date</th>
													<td style='font-size:14px; padding:10px; width:165px;'>MM-DD-2023 HH:MM:SS</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Name</th>
													<td style='font-size:14px; padding:10px; width:165px;'>Gil-dong Hong</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Country</th>
													<td style='font-size:14px; padding:10px;'>Republic of Korea</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Affiliation</th>
													<td style='font-size:14px; padding:10px;'>Department of , Institution</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Phone Number</th>
													<td style='font-size:14px; padding:10px;'>82-10-1234-5678</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Member of KSSO</th>
													<td style='font-size:14px; padding:10px;'>Member</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Type of Participation</th>
													<td style='font-size:14px; padding:10px;'>Speaker</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Category</th>
													<td style='font-size:14px; padding:10px;'>Professor</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>평점신청</th>
													<td style='font-size:14px; padding:10px;'>필요</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>의사 면허번호</th>
													<td style='font-size:14px; padding:10px;'>123145</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>전문의 번호</th>
													<td style='font-size:14px; padding:10px;'>14253</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>영양사 면허번호</th>
													<td style='font-size:14px; padding:10px;'>Not applicable</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Others</th>
													<td style='font-size:14px; padding:10px;'>
														<input type='checkbox' class='checkbox' id='other'>
														<label for='other'><i></i>Welcome Reception – September 7(Thu)</label>
													</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Where did you get the information about the conference?</th>
													<td style='font-size:14px; padding:10px;'>
														<input type='checkbox' class='checkbox' id='conference1'>
														<label for='conference1'><i></i>Website of the Korea Society of Obesity</label>
														<br/>
														<input type='checkbox' class='checkbox' id='conference2'>
														<label for='conference2'><i></i>Promotional email from the Korea Society of Obesity</label>
													</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Registration fee</th>
													<td style='font-size:14px; padding:10px;'>KRW 84,000</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Method</th>
													<td style='font-size:14px; padding:10px;'></td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Status</th>
													<td style='font-size:14px; padding:10px;'></td>
												</tr>
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
										<p>We eagerly anticipate your presence in Seoul, Korea this coming September.</p>
									</div>
								</div>
								<!-- 23.04.25 수정된 버튼 마크업 -->
								<p style='margin: 0 0 5px 34px'>Warmest regards,</p>
								<p style='margin: 0 0 34px 34px'>Secretariat of ICOMES 2023</p>
								<div style='text-align: center; margin-bottom:60px;'>
									<a href='http://43.200.170.254/main/index.php' type='button' style='display:inline-block; padding:5px 20px 10px 20px; border-radius: 25px;border: 2px solid #174A77;outline: 2px solid #DFDFDF;background: linear-gradient(to top, #293380, #8CC5D1);font-size: 18px;font-weight: 500;color: #FFFFFF;cursor: pointer; text-decoration: none;'>Go to ICOMES 2023 Website</a>
								</div>
							</div>
							<img src='./img/mail_footer_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
						</div>
						";

			//$content = "
			//			<div style='width:549px;background-color:#fff;border:1px solid #000;'>
			//				<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'>
			//				<h1 style='font-size:16px; font-weight:bold; text-align:center;'>Payment Confirmation</h1>
			//				<div style='width:calc(100% - 80px); margin:24px auto 50px; background-color:#f8f8f8; padding:27px 35px 30px; border-top:2px solid #707070; box-sizing:border-box;'>
			//					<p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p>
			//					<p style='font-size:10px; color:#000 ;margin-top:19px; margin-bottom:40px;'>
			//						Thank you for payment the registration for the ICOMES 2022 International Congress on Obesity and Metabolic Syndrome.(ICOMES 2022)
			//					</p>
			//					<table style='width: 100%; border-collapse: collapse;'>
			//						<colgroup>
			//							<col width='160px'>
			//							<col width='*'>
			//						</colgroup>	
			//						<tbody>
			//							<tr style='border-bottom:1px solid #707070; border-top:1px solid #707070;;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Attendance Type</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$attendance_type}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>On-site</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$registration_type}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>평점신청여부</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$is_score}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>KSSO Membership</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$member_status}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>ID</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$to}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Country</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$nation_no}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Name</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$fname}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Phone number</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$phone}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Attendant type</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$member_type}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Affiliation</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$affiliation}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Department</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$department}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>Doctor’s license Number</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$licence_number}</td>
			//							</tr>
			//							<tr style='border-bottom:1px solid #707070;'>
			//								<th style='font-size: 8px; font-weight: bold; color: #000000;  text-align: left; padding: 8px 17px; border-right: 1px solid #707070'>학회번호</th>
			//								<td style='font-size: 8px; font-weight: 400; color: #000000; padding: 8px 24px; box-sizing:border-box;'>{$academy_number}</td>
			//							</tr>
			//						</tbody>
			//					</table>
			//					<p style='font-size:10px; color:#000 ;margin-top:19px;'>
			//						You can also view in your account your payment status and receive the payment receipt by going to “My Page” from the <a href='https://icomes.or.kr/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>“ICOMES 2022”</a> website
			//						<br><br>
			//						We express our gratitude to you for your interest in the ICOMES 2022 and look forward to seeing you in September in Seoul, Korea.
			//						<br><br>
			//						Warmest regards,
			//						<br><br>
			//						ICOMES 2022 Secretariat
			//					</p>
			//				</div>
			//				<img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'>
			//			</div>
			//			";
		}

		if($mail_type == "registration") {

			//var_dump($_POST); exit;
			//var_dump($_SESSION); exit;
			//var_dump($data); exit;
			//var_dump($registration_no); exit;
			$user_idx = $_SESSION["USER"]["idx"];
			$id = $_SESSION["USER"]["email"];
			$data = isset($_POST["data"]) ? $_POST["data"] : "";
			
			//필수
			$attendance_type = isset($data["attendance_type"]) ? $data["attendance_type"] : "";
			$participation_type  = isset($data["participation_type"]) ? $data["participation_type"] : "";
			switch($participation_type){
				case "Committee":
					$attendance_type = 0; 
					break;
				case "Speaker":
					$attendance_type = 1;
					break;
				case "ChairPerson":
					$attendance_type = 2;
					break;
				case "Panel":
					$attendance_type = 3;
					break;
				case "Participants":
					$attendance_type = 4;
					break;
			}
			$category  = isset($data["category"]) ? $data["category"] : "";
			$rating = isset($data["rating"]) ? $data["rating"] : "";
			$is_score = ($rating == 1) ? "Yes" : "No";



			$nation_no = $_SESSION["USER"]["nation_no"] ? $_SESSION["USER"]["nation_no"] : "";
			$nation_sql = "SELECT
								nation_en
							FROM nation
							WHERE idx = {$nation_no}";
			
			$nation_no = sql_fetch($nation_sql)["nation_en"];

			//$nation_tel = isset($data["nation_tel"]) ? $data["nation_tel"] : "";
			$phone = isset($_SESSION["USER"]["phone"]) ? $_SESSION["USER"]["phone"] : "";

			//$registration_type = isset($data["registration_type"]) ? $data["registration_type"] : "";

			//$registration_type = ($registration_type == 0) ? "Yes" : "No";

			$affiliation = isset($_SESSION["USER"]["affiliation"]) ? $_SESSION["USER"]["affiliation"] : "-";
			$affiliation = htmlspecialchars($affiliation);
			$department = isset($_SESSION["USER"]["department"]) ? $_SESSION["USER"]["department"] : "-";
			$department = htmlspecialchars($department);
			$licence_number = isset($data["licence_number"]) ? $data["licence_number"] : "-";
			$specialty_number = isset($data["specialty_number"]) ? $data["specialty_number"] : "-";
			$nutritionist_number = isset($data["nutritionist_number"]) ? $data["nutritionist_number"] : "-";
			//$academy_number = isset($data["academy_number"]) ? $data["academy_number"] : "-";

			$others_arr = isset($data["others_arr"]) ? $data["others_arr"] : "";
			$conference_info_arr = isset($data["conference_info_arr"]) ? $data["conference_info_arr"] : "";

			//$timenow = date("Y-m-d H:i:s"); 
			//$timetarget = "2022-05-20 00:00:00";

			//$str_now = strtotime($timenow);
			//$str_target = strtotime($timetarget);
			//if($str_now <= $str_target) {
			//	$content_value = "Please visit our website(<a href='https://icomes.or.kr/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>https://icomes.or.kr</a>) with your account to					submit the abstract and register.<br>
			//					If you Early-Bird and pay the registration fee by May 19th(Thu), you will receive a 30% OFF! <br>
			//					Don’t miss out on early bird rates!<br>
			//					Note the payment deadline of Jul 28(Thu) at 12pm(KST).<br><br>";
			//} else {
			//	$content_value = "Please visit our website(<a href='https://icomes.or.kr/main/' style='font: inherit; font-weight: bold; color: #10BF99; '>https://icomes.or.kr</a>) with your account to					submit the abstract and register.<br>
			//					If you Registration and pay the registration fee by Jul 28th(Thu), you will receive a 10% OFF! <br>
			//					Don’t miss out on register rates!<br>
			//					Note the payment deadline of Jul 28(Thu) at 12pm(KST).<br><br>";
			//}

			$others_cont = "";
			for($i = 0; $i < count($others_arr); $i++){
				$others_cont = $others_cont."\n".$others_arr[$i];
			}
			$conference_info_cont = "";
			for($i = 0; $i < count($conference_info_arr); $i++){
				$conference_info_cont = $conference_info_cont."\n".$conference_info_arr[$i];
			}

			$content = "<div style='width:670px;background-color:#F8F8F8;border:1px solid #000; border-radius:27px 27px 0 0; padding: 0 40px;'>
							<img src='./img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
							<div style='width:calc(100% + 80px);margin-left:-40px;margin-bottom:60px;background-color:#00666B;text-align:center;font-size: 21px; color: #FFF;padding: 10px 0;border-top:2px solid #707070;'>{$subject}</div>	
							<div>
							<div>
								<div style='margin-bottom:25px; background-color:#F8F8F8; padding:17px 34px; box-sizing:border-box;'>
									<div>
										<p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p>
										<p style='font-size:14px;color:#170F00;margin-top:14px;'>We express our gratitude for your registration for the International Congress on Obesity and MEtabolic Syndrome (ICOMES) 2023.	The registration details are presented below.<br/>Should you have any inquiries regarding your registration, kindly reach out to the ICOMES 2023 Secretariat for assistance.(<a href='mailto:icomes@into-on.com'>icomes@into-on.com</a>)</p>
										<table style='border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'>
											<tbody>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Registration No</th>
													<td style='font-size:14px; padding:10px;'>{$registration_no}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Registration Date</th>
													<td style='font-size:14px; padding:10px; width:165px;'>{$time}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Name</th>
													<td style='font-size:14px; padding:10px; width:165px;'>{$fname}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Country</th>
													<td style='font-size:14px; padding:10px;'>{$nation_no}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Affiliation</th>
													<td style='font-size:14px; padding:10px;'>{$department} of , {$affiliation}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Phone Number</th>
													<td style='font-size:14px; padding:10px;'>{$phone}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Member of KSSO</th>
													<td style='font-size:14px; padding:10px;'>Member</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Type of Participation</th>
													<td style='font-size:14px; padding:10px;'>{$participation_type}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Category</th>
													<td style='font-size:14px; padding:10px;'>{$category}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>평점신청</th>
													<td style='font-size:14px; padding:10px;'>{$is_score}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>의사 면허번호</th>
													<td style='font-size:14px; padding:10px;'>{$licence_number}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>전문의 번호</th>
													<td style='font-size:14px; padding:10px;'>{$specialty_number}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>영양사 면허번호</th>
													<td style='font-size:14px; padding:10px;'>{$nutritionist_number}</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Others</th>
													<td style='font-size:14px; padding:10px;'>
														<label for='other'>{$others_cont}</label>
													</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>Where did you get the information about the conference?</th>
													<td style='font-size:14px; padding:10px;'>
														<label for='conference1'><i></i>{$conference_info_cont}</label>
													</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Registration fee</th>
													<td style='font-size:14px; padding:10px;'>KRW 84,000</td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Method</th>
													<td style='font-size:14px; padding:10px;'></td>
												</tr>
												<tr style='border-bottom:1px solid #000;'>
													<th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#DBF5F0; '>Payment Status</th>
													<td style='font-size:14px; padding:10px;'></td>
												</tr>
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
										<p>We eagerly anticipate your presence in Seoul, Korea this coming September.</p>
									</div>
								</div>
								<!-- 23.04.25 수정된 버튼 마크업 -->
								<p style='margin: 0 0 5px 34px'>Warmest regards,</p>
								<p style='margin: 0 0 34px 34px'>Secretariat of ICOMES 2023</p>
								<div style='text-align: center; margin-bottom:60px;'>
									<a href='http://43.200.170.254/main/index.php' type='button' style='display:inline-block; padding:5px 20px 10px 20px; border-radius: 25px;border: 2px solid #174A77;outline: 2px solid #DFDFDF;background: linear-gradient(to top, #293380, #8CC5D1);font-size: 18px;font-weight: 500;color: #FFFFFF;cursor: pointer; text-decoration: none;'>Go to ICOMES 2023 Website</a>
								</div>
							</div>
							<img src='./img/mail_footer_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'>
						</div>";
		}

		if($mail_type == "visa_registration") {

			$content = "<div style='width:549px;background-color:#fff;border:1px solid #000;'><img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'><h1 style='text-align:center; font-size:16px; font-weight:bold'>Letter of Invitation</h1><div style='width:calc(100% - 80px); margin:24px auto 100px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p><p style='font-size:10px; color:#000 ;margin-top:16px; margin-bottom:25px;'>On behalf of the ICOMES organizing committee, we cordially invite you as participant to “ICOMES 2022 International Conference” to be held at the Conrad Seoul Hotel, Seoul, Korea on September 1(Thu)-3(Sat), 2022. </p><p style='font-size:10px; color:#000; margin-bottom:25px;'>ICOMES has grown as a worldwide academic society with more than 1000 participants and eminent representative speakers in obesity every year since 2015 at its launch. ICOMES is an international academic conference that promotes cooperation among multidisciplinary study fields, providing in-depth lectures and symposiums on basic medicine and clinical medicine on obesity, metabolic syndrome, dyslipidemia, and other obesity-related diseases.<br/>The main theme of ICOMES 2022 is ‘The Next Normal - The Future of Obesity Care’. Your Presentation will be a great addition to our conference.</p><p style='font-size:10px; color:#000;'>For building instructive, insightful and interesting meeting, we would like you to take as a role of; </p><div style='padding:10px 0; margin-top:16px; border-top:1px solid #000; border-bottom:1px solid #000;'><div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Date</span><span style='vertical-align:middle; font-size:10px;'>September 1(Thu)~3(Sat)</span></div>
			<div><span style='vertical-align:middle; width:56px; height:18px; border-radius:14px; border:1px solid #5DBC9B; line-height:16px; display:inline-block; text-align:center; font-size:10px; font-weight:bold; margin-right:7px;'>Venue</span><span style='vertical-align:middle; font-size:10px;'>Conrad Hotel Seoul, Korea</span></div></div><div style='font-size:10px; margin:14px 0 60px;'>
			We invite you to ICOMES 2022 to create an informative, insightful and exciting<br/>meeting. <a href='mailto:icomes_registration@into-on.com' style='font-size:10px; font-weight:bold; color:#10BF99;'>(icomes_registration@into-on.com).</a></div><ul style='margin:0; padding:0; text-align:center; font-size:0;'><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top;'><p style='font-size:12px; font-weight:bold; margin:0;'>Kijin Kim</p><p style='font-size:8px;'>Chairman of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign01.png' alt=''></li><li style='text-align:center; list-style:none; display:inline-block; vertical-align:top; margin-left:15%;'><p style='font-size:12px; font-weight:bold; margin:0;'>Chang-Beom Lee</p><p style='font-size:8px;'>President of Korean Society<br/>for the Study of Obesity</p><img src='https://icomes.or.kr/main/img/mail_sign02.png' style='margin-top:10px;' alt=''></li></ul></div><img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'></div>";
		
		}

		if($mail_type == "find_password") {

			//var_dump($_POST);
			//exit;
			//$temporary_password = $tmp_password;
			//$name = $fname;
			$email = $_POST["email"];
			$content =	
						"<div style='width:670px;background-color:#F8F8F8;border:1px solid #f2f2f2; padding: 0 40px;'><img src='".$background_img_url."/img/mail_header_2023.png' style='width:calc(100% + 80px);margin-left:-40px;'><div style='width:calc(100% + 80px);margin-left:-40px;margin-bottom:60px;background-color:#00666B;text-align:center;font-size: 21px; color: #FFF;padding: 10px 0;border-top:2px solid #707070;'>[ICOEMS 2023] Temporary Password</div>	<div><div><div style='margin-bottom:10px; background-color:#F8F8F8; padding:17px 34px; box-sizing:border-box;'><div><div style='margin-bottom:20px'><p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Member of : {$fname} <br><span style='font-size:14px;color:#170F00;font-weight:normal;'>You requested a temporary password at : {$time}</span></p></div><p style='font-size:15px; font-weight:bold; color:#000; margin:0;'>Dear , {$fname}</p><p style='font-size:14px;color:#170F00;margin-top:14px;'>You can log in to the ICOMES 2023 website using the ID & Temporary Password below and<br> modify your password on the personal information on my page.</p><table style='border-collapse:collapse; border-top:2px solid #000; width:100%; margin:17px 0;'><tbody><tr style='border-bottom:1px solid #000;'><th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1; '>ID (Email Address)</th><td style='font-size:14px; padding:10px;'><a href='mailto:{$email}' class='link font_inherit'>{$email}</a></td></tr><tr style='border-bottom:1px solid #000;'><th style='width:150px; text-align:left; font-size:14px; padding:10px; background-color:#f1f1f1;'>Temporary Password</th><td style='font-size:14px; padding:10px;'>{$tmp_password}</td></tr></tbody></table><p style='color:#f00;'>Click the 'Change to temporary password' button to check your changed log-in information.</p></div></div><!-- 23.04.25 수정된 버튼 마크업 --><p style='margin: 0 0 5px 34px'>Best regards,</p><p style='margin: 0 0 34px 34px'>Secretariat of ICOMES 2023</p><div style='text-align: center;'><a href='http://43.200.170.254/main/login.php' type='button' style='display:inline-block; padding:5px 20px 10px 20px; border-radius: 25px;border: 2px solid #174A77;outline: 2px solid #DFDFDF;background: linear-gradient(to top, #293380, #8CC5D1);font-size: 18px;font-weight: 500;color: #FFFFFF;cursor: pointer; text-decoration: none;'>Change to temporary password</a></div></div><img src='".$background_img_url."/img/mail_footer_2023.png' style='width:calc(100% + 80px); margin-top:60px; margin-left:-40px;'></div>
						";

			//$content = "<div style='width:549px;background-color:#fff;border:1px solid #000;'><img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'><h1 style='text-align:center; font-size:16px; font-weight:bold'>Temporary Password</h1><div style='width:calc(100% - 80px); margin:24px auto 50px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'><div><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Member of : <span>{$fname}</span></p><p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>You requested a temporary password at : <span>{$time}</span></p><p style='font-size:10px; color:#707070; margin:10px 0 0 0;'>(If you have never requested a temporary password, please delete the email.)</p></div><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Since our site does not have your password even if you are an administrator, Instead of giving you your password, we’re creating a new one and guiding you.</p><p style='font-size:12px; font-weight:bold; color:#FF3333; margin:25px 0 0 0;'>Check the password below to change.<br/>Click the “<span style='font:inherit; color:inherit; text-decoration:underline;'>Change to temporary password</span>” button.</p><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>When an authentication message is printed stating that the password has been changed,</p><p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Please enter your member ID and changed password on the homepage and log in.</p><p style='font-size:10px; color:#707070;'>After logging in, please change to a new password from the Modify Information menu.</p><div style='padding:16px; border:1px solid #5DBC9B; border-radius:15px; margin-top:25px;'><ul style='padding:0; margin:0;'><li style='list-style:none;'><i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i><span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Member ID : {$to}</span><input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'></li><li style='list-style:none;'><i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i><span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Temporary password :{$tmp_password}</span><input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'></li></ul></div><p style='font-size:12px; line-height:22px; color:#000; margin-top:20px; margin-bottom:0;'>Regards,<br/>ICOMES</p><a href='{$callback_url}' style='text-decoration:none;'><button type='button' style='display:block; margin:70px auto 0; font-size:16px; font-weight:bold; color:#FFEB00; background-color:#23BF99; padding:10px 58px 34px 58px; border-radius:30px; border:none;'>Change to temporary password<span style='margin-left:10px; font:inherit;'>&gt;</span></button></a></div><img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'></div>";


			
			//위에 작성된 거 들여쓰기 한 것. 들여쓰기 안 해야 br이 생성이 안 됨
			//$content = "
			//				<div style='width:549px;background-color:#fff;border:1px solid #000;'>
			//					<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'>
			//					<h1 style='text-align:center; font-size:16px; font-weight:bold'>Temporary Password</h1>

			//					<div style='width:calc(100% - 80px); margin:24px auto 50px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'>
			//						<div>
			//							<p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Member of : <span>{$fname}</span></p>
			//							<p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>You requested a temporary password at : <span>{$time}</span></p>
			//							<p style='font-size:10px; color:#707070; margin:10px 0 0 0;'>(If you have never requested a temporary password, please delete the email.)</p>
			//						</div>
			//						<p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Since our site does not have your password even if you are an administrator, Instead of giving you your password, we’re creating a new one and guiding you.</p>
			//						<p style='font-size:12px; font-weight:bold; color:#FF3333; margin:25px 0 0 0;'>Check the password below to change.<br/>Click the “<span style='font:inherit; color:inherit; text-decoration:underline;'>Change to temporary password</span>” button.</p>
			//						<p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>When an authentication message is printed stating that the password has been changed,</p>
			//						<p style='font-size:12px; color:#000 ;margin:25px 0 0 0;'>Please enter your member ID and changed password on the homepage and log in.</p>
			//						<p style='font-size:10px; color:#707070;'>After logging in, please change to a new password from the Modify Information menu.</p>
			//						<div style='padding:16px; border:1px solid #5DBC9B; border-radius:15px; margin-top:25px;'>
			//							<ul style='padding:0; margin:0;'>
			//								<li style='list-style:none;'>
			//									<i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i>
			//									<span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Member ID : {$to}</span>
			//									<input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'>
			//								</li>
			//								<li style='list-style:none;'>
			//									<i style='display:inline-block; width:4px; height:4px; border-radius:50%; background-color:#10BF99; vertical-align:middle;'></i>
			//									<span style='font-size:12px; font-weight:bold; vertical-align:middle;'>Temporary password :{$tmp_password}</span>
			//									<input type='text' style='vertical-align:middle; background:transparent; border:none; outline:none;'>
			//								</li>
			//							</ul>
			//						</div>
			//						<p style='font-size:12px; line-height:22px; color:#000; margin-top:20px; margin-bottom:0;'>Regards,<br/>ICOMES</p>
			//						<a href='{$callback_url}' style='text-decoration:none;'>
			//							<button type='button' style='display:block; margin:70px auto 0; font-size:16px; font-weight:bold; color:#FFEB00; background-color:#23BF99; padding:10px 58px; border-radius:30px; border:none;'>Change to temporary password<span style='margin-left:10px; font:inherit;'>&gt;</span></button>
			//						</a>
			//					</div>
			//					<img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'>
			//				</div>
			//		";


			//$content =	
			//			"
			//				<div style='width:670px;background-color:#fff;border:1px solid #ADF002;'>
			//					<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:60px;'>
			//					<div style='margin-left:60px;margin-bottom:40px;'>
			//						<p style='text-align:left;font-size:15px;color:#170F00;line-height:1.8;'>Member of {$fname}, <br>You requested a temporary password at {$time}</p>
			//						<p style='text-align:left;font-size:12px;color:#AAAAAA;margin-top:22px;'>(If you have never requested a temporary password, please delete the email.)</p>
			//						<p style='text-align:left;font-size:12px;color:#170F00;margin-top:42px;line-height:1.8;'>Since our site does not have your password even if you are an administrator,<br>
			//						Instead of giving you your password, we're creating a new one and guiding you.<br>Check the password below to change.</p>
			//						<p style='font-size:13px;color:#FF0000;margin-top:17px;'>Click the Change to temporary password button.</p>
			//						<p style='text-align:left;font-size:12px;color:#170F00;margin-top:42px;line-height:1.8;'>When an authentication message is printed stating that the password has been changed,<br>
			//						Please enter your member ID and changed password on the homepage and log in.</p>
			//						<p style='text-align:left;font-size:12px;color:#AAAAAA;margin-top:17px;'>After logging in, please change to a new password from the Modify Information menu.</p>
			//						<p style='text-align:left;font-size:13px;color:#170F00;margin-top:32px;'>Member ID<span style='text-align:left;font-size:14px;color:#170F00;margin-left:5px;'>{$id}</span></p>
			//						<p style='text-align:left;font-size:13px;color:#170F00;margin-top:11px;'>Temporary password<span style='text-align:left;font-size:14px;color:#170F00;margin-left:5px;'>{$tmp_password}</span></p>
			//						<p style='text-align:left;font-size:14px;color:#170F00;margin-top:51px;'>Regards, <br> ICOMES</p>
			//					</div>
			//					<a href='{$callback_url}' style='display:block;text-decoration:none;text-align:center;width:180px;max-width:180px;background:#fff;margin-left:60px;border:1px solid #585859;border-radius:30px;padding:14px 50px;background:#fff;cursor:pointer;color:#000;'>Change to temporary password</a>
			//					<img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;margin-top:60px;'>
			//				</div>";

			/*$content = 
						"
							<div style='width:549px;background-color:#fff;border:1px solid #000;'>
								<img src='http://icomes.or.kr/main/img/icomes_mail_top_2022.jpg' style='width:100%;margin-bottom:47px;'>
								<h1 style='text-align:center; font-size:16px; font-weight:bold'>Temporary Password</h1>
								<div style='width:calc(100% - 80px); margin:24px auto 100px; background-color:#f8f8f8; padding:17px 34px 78px 17px; border-top:2px solid #707070; box-sizing:border-box;'>
									<p style='font-size:12px; font-weight:bold; color:#000; margin:0;'>Dear {$fname},</p>
									<p style='font-size:12px; color:#000 ;margin-top:19px; margin-bottom:40px;'>Please use the temporary password to access your account via by <br/>visiting ICOMES 2022. Once successfully logged in to your account, <br/>You will be prompted to establish a new password on Personal Information of “MY PAGE”.</p>
									<button type='button' style='display:block; margin:0 auto; font-size:16px; font-weight:bold; color:#FFEB00; background-color:#23BF99; padding:0px 58px; border-radius:30px; border:none;'>Reset Your Password<span style='margin-left:10px; font:inherit;'>&gt;</span></button>
									<p style='font-size:12px; line-height:22px; color:#000; margin-top:40px; margin-bottom:0;'>Thank you.<br/>Warmest regards,</p>
									<p style='font-size:12px; margin-top:34px; margin-bottom:0;'>ICOMES 2022 Secretariat</p>
								</div>
								<a href='http://54.180.86.106/main/login.php' style='cursor: pointer;' target='_blank'>
									<img src='http://icomes.or.kr/main/img/icomes_mail_bottom_2022.jpg' style='width:100%;'>
								</a>
							</div>
						";*/
		}

		if($mail_type == "abstract") {           
            //$template = new Template($_SERVER["DOCUMENT_ROOT"]."/main/common/lib/abstract.php");
            //$template->set('id', $id);
            //$template->set('date', $date);
            //$template->set('category', $category);
            //$template->set('title', $title);
            //$content = $template->render(); 

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

	}

	if ($type != 1) {
		$content = nl2br($content);
	}

    $mail = new PHPMailer(true); // defaults to using php "mail()"
	$mail->ContentType = "text/html";
    $mail->CharSet = "utf-8";
	
    /*$mail->ContentType = "text/html";
    $mail->CharSet = "utf-8";

	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.naver.com"; //네이버 맞는지?
	$mail->Port = 465;
	$mail->Username = ""; // admin@domain.com //ICOMES 측 이메일 확인받아야함 info@icomes.or.kr
	$mail->Password = "";// 비밀번호 into2285
	//$mail->SMTPDebug = 3;

	$mail->From = ""; //보낸 사람 이메일
	$mail->FromName = "ICOLA2022"; //보낸 사람 이름
	$mail->Subject = $subject;
    $mail->AltBody = ""; // optional, comment out and test
    $mail->IsHTML(true);
    //$mail->Body = $content;//허브디앤씨 작성 -> mail body가 plane text 인 경우
    $mail->MsgHTML($content);//인투온 작성 -> mail body가 html인 경우*/

	$account['username'] = "info@icomes.or.kr"; // info@icomes.or.kr
	$account['password'] = "into2285"; // into2285
//https://icomes.or.kr/
	//$mail->CharSet = "EUC-KR";
	$mail->Encoding = "base64";

	$mail->IsSMTP();
	//$mail->SMTPDebug = 1;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com"; //네이버 맞는지?
	$mail->Port = 465;
	$mail->IsHTML(true);
	$mail->Username = $account['username']; // admin@domain.com //ICOMES 측 이메일 확인받아야함 info@icomes.or.kr
	$mail->Password = $account['password'];// 비밀번호 into2285
	//$mail->SMTPDebug = 3;

	//$mail->CharSet = 'UTF-8';
	$mail->From = $account['username']; //보낸 사람 이메일
	$mail->FromName = "ICOMES2023"; //보낸 사람 이름
	$mail->Subject = $subject;
	$mail->AltBody = ""; // optional, comment out and test
	$mail->MsgHTML($content);



	$mail->addAddress($to);
	if ($cc)
		$mail->addCC($cc);
	if ($bcc)
		$mail->addBCC($bcc);
	//print_r2($file); exit;
	if ($file != "") {
		foreach ($file as $f) {
			$mail->addAttachment($f['path'], $f['name']);
		}
	}
	
	return $mail->send();
	//return $content;
}

// 파일을 첨부함
function attach_file($filename, $tmp_name) {
	// 서버에 업로드 되는 파일은 확장자를 주지 않는다. (보안 취약점)
	$dest_file = D9_DATA_PATH.'/tmp/'.str_replace('/', '_', $tmp_name);
	move_uploaded_file($tmp_name, $dest_file);
	$tmpfile = array("name" => $filename, "path" => $dest_file);
	return $tmpfile;
}
?>
