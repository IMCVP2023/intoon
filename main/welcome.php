<?php
	include_once('./include/head.php');

	$session_user = $_SESSION['USER'] ?? NULL;
	$session_app_type = (!empty($_SESSION['APP']) ? 'Y' : 'N');

	//230714 HUBDNC 앱 로그인 시 파라미터 추가 된 부분
	if(!empty($session_user) && $session_app_type == 'Y') {
		include_once('./include/app_header.php');
	} else {
		include_once('./include/header.php');
	}

	//$language
	$sql_info = "SELECT
						overview_welcome_msg_" . $language . " AS welcome_msg,
						CONCAT(fi_sign.path, '/', fi_sign.save_name) AS fi_sign_url
					FROM info_general as ig
					left join `file` as fi_sign
						on fi_sign.idx = ig.overview_welcome_sign_" . $language . "_img";
	$info = sql_fetch($sql_info);

	$add_section_class = (!empty($session_user) && $session_app_type == 'Y') ? 'app_version' : '';
?>

<!-- app일때 section에 app_version 클래스 추가 -->
<section class="container welcome">
	<!-- HUBDNCLHJ : app 메뉴 탭 주석 해제 -->

<!-- 		<div class="contents_wrap"> -->
<!-- 			<h1 class="page_title">Welcome Message</h1> -->
<!-- 			<div class="inner"> -->
<!-- 				<img class="coming" src="./img/coming.png"> -->
<!-- 			</div> -->
<!-- 		</div> -->
    <div>
		<h1 class="page_title">IMCVP 2024
			<div class="sub_btn_box">
				<a href="/main/welcome.php" class="on">Welcome Message</a>
				<a href="/main/organizing_committee.php">Organization</a>
				<a href="/main/overview.php">Overview</a>
			</div>
		</h1>
        <div class="inner">
			<h3 class="sub_title">Welcome Message</h3>
            <div>
				<h3 class="title icon_none">Dear distinguished guests, esteemed colleagues, and valued participants,</h3>
				<p class="welcome_txt">
				It is my great honor to cordially invite all of you to upcoming <span class="f_bold">IMCVP 2024 (International Meeting of Cardiovascular Disease Prevention)</span> (<a href="https://imcvp.org/" class="link under">IMCVP 2024</a>).  <br/><br/>The IMCVP will be held at Grand Walkerhill Hotel in Seoul, Republic of Korea, from November 29 to November 30 2024. <br/>IMCVP is hosted solely by KSCP and has been newly named as an official conference of KSCP (Korean Society of Cardiovascular Disease Prevention).<br/><br/>It is the 3<sup class="font_small">rd</sup> international conference hosted by KSCP. <br/><br/>KSCP was founded in 2010 to promote national health through active academic activities in the field of cardiovascular disease prevention. <br/><br/>In November 2023, KSCP co-hosted an international conference of ISCP in Seoul, Korea and many participants from around the world joined us to share current scientific evidence.<br/><br/>I would like to extend my heartfelt thanks to the organizing committee and scientific committee members of last year’s successful conference for their dedicated efforts.<br/><br/>This year, the organizing committee of KSCP has decided to hold the IMCVP 2024 in-person meeting and would like to invite all of you.<br/><br/> IMCP 2024 will present current edge of scientific evidence and educational content, as well as key insights, practice-changing updates with world-class experts.<br/><br/>It will bring together key stakeholders in all areas of cardiovascular disease prevention and promote better patient care.<br/>Many fields of cardiovascular disease, including hypertension, dyslipidemia, diabetes, angina, stroke, heart failure, epidemiology, nutrition, guidelines, and new treatment methods, will be covered, and excellent professors will share their research results.<br/><br/>It is our pride and pleasure to share up-to-date scientific information in this field through IMCVP 2024.<br/><br/>As the President of KSCP hosting IMCVP 2024, I hope that this meeting can be one of the greatest academic experiences you’ve ever had. <br/><br/>I would like to express my sincerest gratitude to all of you for your attendance and continued support.<br/>I look forward to seeing all of you at IMCVP in November 2024.<br/><br/>Respectfully yours,

				<!-- Thank you so much.<br/><br/>With best regards,<br/><br/>Won-Young Lee,<br/><br/>President of KSCP (Korean Society of Cardiovascular Disease Prevention) -->
				</p>
			</div>
			<img src="./img/2024_headman_img-1.png" alt = ""/>
            <div class="head_profile">
				<div class="headman">
				
					<!-- <div class="headman_l"><img src="./img/headman_img1.png" alt=""></div>
					<div class="headman_r">
						<h1>Sung Soo Kim, M.D., Ph.D</h1>
						<h5>Chairman</h5>
						<p>Korea Society for Study of Obesity</p>
						<div class="headman_sign"><img src="./img/headman_sign1.png" alt=""></div>
					</div> -->
				</div>
				<!-- <div class="headman">
					<div class="headman_l"><img src="./img/headman_img2.png" alt=""></div>
					<div class="headman_r">
						<h1>Cheol-Young Park, M.D., Ph.D</h1>
						<h5>President</h5>
						<p>Korea Society for Study of Obesity</p>
						<div class="headman_sign"><img src="./img/headman_sign2_1.png" alt=""></div>
					</div>
				</div> -->
			</div>
        </div>
    </div>
</section>

<?php 
    if (!empty($session_app_type) && $session_app_type == 'Y') {
        // mo일때
        include_once('./include/app_footer.php'); 
    }else {
        include_once('./include/footer.php');
    }
?>