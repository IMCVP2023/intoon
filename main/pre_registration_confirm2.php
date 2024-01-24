<?php
include_once('./common/common.php');
require_once('./plugin/dompdf/vendor/autoload.php');
require_once('./plugin/dompdf/autoload.inc.php');


// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

//define('DOMAIN', "http://54.180.86.106/main");

// 이미지 경로 공통값
//$confirmation_form_svg = 'data:image/svg;base64,'.transfer_base64("/img/confirmation_form.svg");
//$confirmation_form = transfer_base64("/img/confirmation_form2.png");
//$confirmation_badge = transfer_base64("/img/confirmation_badge.png");
//$footer_logo_mini = transfer_base64("/img/footer_logo_mini.png");
//$confirmation_sign2 = transfer_base64("/img/confirmation_sign2.png");



$registration_idx = $_GET["idx"];
$user_idx = $member["idx"];

$sql = "
	SELECT
		mb.nation_no,
		mb.first_name, mb.last_name,
		rr.affiliation, 
		IFNULL(mb.licence_number, '-') AS licence_number_text,
		pa.`type` AS payment_type,
		IFNULL(FORMAT(pa.total_price_kr, 0), 0) AS total_price_kr_text, 
		IFNULL(FORMAT(pa.total_price_us, 0), 0) AS total_price_us_text,
		DATE_FORMAT(rr.register_date, '%Y.%m.%d') AS register_date_text
	FROM request_registration AS rr
	LEFT JOIN member AS mb
		ON mb.idx = rr.register
	LEFT JOIN payment AS pa
		ON pa.idx = rr.payment_no
	WHERE rr.idx = {$registration_idx}
	AND rr.register = {$user_idx}
";
//$data = sql_fetch($sql);
/*if (!$data) {
	echo "<script>alert('Registration Not Found.');window.close();</script>";
	exit;
}*/

// 행사 끝나고 출력해야함
//$is_korea = ($user_idx == 14);
//if ($is_korea) {
//	// 영문
//	$inner_style = "";
//	$inner_body = '
//		<div style="position:fixed; width:100%; height:100%; top:50%; left:50%; transform:translate(-50%,-50%); background:url(\''.$confirmation_form.'\') no-repeat center /contain; margin:0; padding:0;">
//			<img src="'.$confirmation_badge.'" style="position:absolute; top:0; right:60px; z-index:10; width:76px;" alt=""/>
//			<div style="width: 100%; padding: 72px 0 60px; box-sizing:border-box; margin:0;">
//				<h1 style="font-size: 58px; font-weight: 900; color: #754D42; text-align: center; margin-bottom: 45px; margin-top:50px;">ICOMES 2022<br><span style="color: inherit; font: inherit; font-size: 46px;">Certification of Completion</span></h1>
//				<ul style="padding:0 66px 0 106px; box-sizing:border-box;">
//					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2.6;">NAME : <span style="font-size: inherit; font-weight: 400;">'.$data['first_name'].', '.$data['last_name'].'</span></li>
//					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2.6;">AFFILIATION : <span style="font-size: inherit; font-weight: 400;">'.$data['affiliation'].'</span></li>
//				</ul>
//				<p style="width:600px; font-size: 13px; font-weight: 900; color: #754D42; line-height:1.4; text-align: center; padding: 10px 20px; margin: 50px auto 48px; border: 1px solid #754D42; border-radius: 15px;">We certify that the above person has participated in and <br>completed this conference below.</p>
//				<ul style="padding:0 66px 0 106px; box-sizing:border-box;">
//					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">
//						Name of Education : <span style="font-size: inherit; font-weight: 400;">ICOMES 2022</span> 
//						<span style="display: block; font-size: 10px;">(International Congress on Obesity and Metabolic Syndrome hosted by KSSO)</span>
//					</li>
//					<li style="list-style:none; font-size: 13px; font-weight: bold; vertical-align:middle; margin-top:16px;">Institution : <img style="vertical-align:middle; margin-right:4px; height:16px;" src="'.$footer_logo_mini.'" alt=""><span style="vertical-align:middle; font-size: inherit; font-weight: 400;">KSSO (Korean Society for the Study of Obesity)</span></li>
//					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">Date : <span style="font-size: inherit; font-weight: 400;">2022.09.01-2022.09.03</span></li>
//					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">Venue  : <span style="font-size: inherit; font-weight: 400;">Conrad Hotel, Seoul</span></li>
//				</ul>
//				<p style="font-size: 14px; font-weight: bold; margin: 70px 0 40px; text-align: center;">Issue Date : <span style="font-size: inherit; font-weight: 400;">'.$data['register_date_text'].'</span></p>
//				<div style="text-align: center;"><img style="width: 50%;" src="'.$confirmation_sign2.'" alt=""></div>
//			</div>
//		</div>
//	';
//} else {
	$inner_style = "";
	$inner_body = '
		<div style="position:fixed; width:100%; height:100%; top:50%; left:50%; transform:translate(-50%,-50%); background:url(\'http://54.180.86.106/main/img/confirmation_form2.png\') no-repeat center /contain; margin:0; padding:0;">
			<img src="http://54.180.86.106/main/img/confirmation_badge.png" style="position:absolute; top:0; right:60px; z-index:10; width:76px;" alt=""/>
			<div style="width: 100%; padding: 50px 0 60px; box-sizing:border-box; margin:0;">
				<h1 style="font-size: 58px; color: #754D42; text-align: center; margin-bottom: 45px; margin-top:50px;">ICOMES 2022<br><span style="color: inherit; font-weight: inherit; font-weight: 700; font-size: 36px;">Registration Confirmation Certificate</span></h1>
				<ul style="padding:0 66px 0 106px; box-sizing:border-box;">
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">Name : <span style="font-size: inherit; font-weight: 400;">'.$data['last_name'].' '.$data['first_name'].'</span></li>
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">Affiliation : <span style="font-size: inherit; font-weight: 400;">'.$data['affiliation'].'</span></li>
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">Licence number : <span style="font-size: inherit; font-weight: 400;">'.$data['licence_number_text'].'</span></li>
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">Registration Fee : <span style="font-size: inherit; font-weight: 400;">'.(isset($data['total_price_kr_text']) ? "￦".$data['total_price_kr_text'] : "$".$data['total_price_us_text']).'</span></li>
				</ul>
				<p style="width:600px; font-size: 13px; font-weight: 700; color: #754D42; line-height:1.4; text-align: center; padding: 10px 20px; margin: 50px auto 48px; border: 1px solid #754D42; border-radius: 15px;">We certify that the above person has pre-registerd with the academic society below.
				</p>
				<ul style="padding:0 66px 0 106px; box-sizing:border-box;">
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">
						교육명 : <span style="font-size: inherit; font-weight: 400;">ICOMES 2022</span> 
						<span style="display: block; font-size: 10px;">(International Congress on Obesity and Metabolic Syndrome hosted by KSSO)</span>
					</li>
					<li style="list-style:none; font-size: 13px; font-weight: bold; vertical-align:middle; margin-top:16px;">연수교육기관 : <img style="vertical-align:middle; margin-right:4px; height:16px;" src="http://54.180.86.106/main/img/footer_logo_mini.png" alt=""><span style="vertical-align:middle; font-size: inherit; font-weight: 400;">KSSO (Korean Society for the Study of Obesity)</span></li>
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">참가형태 : <span style="font-size: inherit; font-weight: 400;">Off-line</span></li>
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">날짜 : <span style="font-size: inherit; font-weight: 400;">2022.09.01-2022.09.03</span></li>
					<li style="list-style:none; font-size: 13px; font-weight: bold; line-height:2;">장소 : <span style="font-size: inherit; font-weight: 400;">Conrad Hotel, Seoul</span></li>
				</ul>
				<p style="font-size: 14px; font-weight: bold; margin: 50px 0 30px; text-align: center;">Issue Date : <span style="font-size: inherit; font-weight: 400;">'.$data['register_date_text'].'</span></p>
				<div style="text-align: center;"><img style="width: 50%;" src="https://gz-dev.site/upload/editor/confirmation_sign2.png" alt=""></div>
			</div>
		</div>
	';
//}




///* dompdf 설정 */

//// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->set_option('enable_remote', true);

$dompdf->set_option('isRemoteEnabled', true);
$dompdf->set_option('defaultFont', true);
$dompdf->set_option('debugKeepTemp', true);
$dompdf->set_option('isHtml5ParserEnabled', true);

$context = stream_context_create([ 
    'ssl' => [ 
        'verify_peer' => FALSE, 
        'verify_peer_name' => FALSE,
        'allow_self_signed'=> TRUE 
    ] 
]);
$dompdf->setHttpContext($context);

$markup = make_html($inner_style, $inner_body);
$dompdf->loadHtml($markup);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper("DOMPDF_DEFAULT_PAPER_SIZE", 'portrait');

// Render the HTML as PDF
$dompdf->render();

//파일 이름 설정
$datetime = date("YmdHis");
$file_name = "icomes2022_certification_".$datetime.".pdf";

// Output the generated PDF to Browser
$dompdf->stream($file_name);

/* //dompdf 설정 */


/* 공통함수 */

// 이미지 출력 필요한 경우 경로를 base64 값으로 변경해야함
// 링크에는 도메인이 포함되어 있어야 함
//function transfer_base64($url){//"https://icomes.or.kr/main";

//	$url = DOMAIN.$url;
//	$url_encode = base64_encode(file_get_contents_curl(@$url));
//	//$url_encode = base64_encode(file_get_contents(@$url));
//	$url_src = "data:image/png;base64,".$url_encode;

//	return $url_src;
//}

//function file_get_contents_curl($url) {
//  $ch = curl_init();
//  curl_setopt($ch, CURLOPT_HEADER, 0);
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//  curl_setopt($ch, CURLOPT_URL, $url);
//  $data = curl_exec($ch);
//  curl_close($ch);
//  return $data;
//}



// html 기본 폼 붙여주기
function make_html($inner_style, $inner_body){
	$font_path = DOMAIN."/plugin/dompdf/vendor/dompdf/dompdf/lib/fonts";

	$html = "";
	$html .= '<!DOCTYPE html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"><style>html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, sub, sup, tt, var, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video, button, input, br, textarea {margin: 0;padding: 0;border: 0;box-sizing: border-box;color: #444;line-height: 1.2;letter-spacing: -0.36px;}* {-webkit-tap-highlight-color: transparent;font-size: 14px;word-break: keep-all;color: #170F00;}@font-face {font-family: "Nanum Myeongjo";src: url("'.$font_path.'/NanumMyeongjo.ttf") format("truetype");}body {font-family:"NanumMyeongjo", "나눔명조", "dotum", "돋움"; font-size: 11px;padding: 30px;}@font-face {font-family: "NanumMyeongjoBold";src: url("'.$font_path.'/NanumMyeongjoBold.ttf") format("truetype");}@font-face {font-family: "NanumMyeongjoExtraBold";src: url("'.$font_path.'/NanumMyeongjoExtraBold.ttf") format("truetype");}'.$inner_style.'</style></head><body><div style="width:794px;">';
	$html .= $inner_body;
	$html .= "</div></body></html>";

	return $html;
}

?>