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
<section class="container welcome <?= $add_section_class; ?>">
	<!-- HUBDNCLHJ : app 메뉴 탭 주석 해제 -->
<?php
	if(!empty($session_user) && $session_app_type == 'Y') {
?>
		<div class="app_title_box">
			<h2 class="app_title">ICOMES 2024<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
			<ul class="app_menu_tab">
				<li class="on"><a href="./welcome.php">Welcome Message</a></li>
				<li><a href="./organizing_committee.php">Organization</a></li>
				<li><a href="./app_overview.php">Overview</a></li>
				<li><a href="./venue.php">Venue</a></li>
			</ul>
		</div>
<?php
	} 
?>
<!-- 		<div class="contents_wrap"> -->
<!-- 			<h1 class="page_title">Welcome Message</h1> -->
<!-- 			<div class="inner"> -->
<!-- 				<img class="coming" src="./img/coming.png"> -->
<!-- 			</div> -->
<!-- 		</div> -->
    <div>
		<h1 class="page_title">Opening Address</h1>
        <div class="inner">
            <div>
				<!-- <h3 class="title icon_none">Respected colleagues,</h3> -->
				<p class="welcome_txt">
				It is my great honor to cordially invite all of you to upcoming IMCVP 2024 (International Meeting of Cardiovascular Disease Prevention) (IMCVP
2024). <br/>This IMCVP will be held in Grand Walkerhill Hotel, Seoul, Republic of Korea from 29 November to 30 November 2024. IMCVP is hosted soley by
KSCP and newly named as an official conference of KSCP (Korean Society of Cardiovascular Disease Prevention). It is 3rd international
conference hosted by KSCP. KSCP was founded in 2010 to promote national health through active academic activities in the field of
cardiovascular disease prevention.<br/>In 2023 November, KSCP co-hosted international conference of ISCP at Seoul, Korea and many participants from the world joined us and
shared current scientific evidence. I would like to deeply thank to organizing committee and scientific committee members of last year’s
successful conference for their sincere devotion.<br/>This year, organizing committee of KSCP has decided to hold IMCVP 2024 in-person meeting and would like to invite all of you.<br/>IMCP 2024 will present current edge of scientific evidence and educational contents, key insight, practice-changing updates with world-class
experts. It will bring together key stakeholders in all areas of cardiovascular disease prevention and promote better patient care. Many field of
cardiovascular disease including hypertension, dyslipidemia, diabetes, angina, stroke, heart failure, epidemiology, nutrition, guidelines and
new treatment methods will be covered and excellent professors will share their research results. It is our pride and pleasure to share up-todate scientific information in this field through IMCVP 2024<br/>As a president of KSCP hosting IMCVP 2024, I hope that this meeting can be the one of greatest academic experience you’ve ever had. I would
like to express my sincerest gratitude to all of your attendance and continued support. I look forward to seeing you all at IMCVP in November
2024.<br/>Thank you so much.<br/><br/>With best regards,<br/>Won-Young Lee,<br/>President of KSCP (Korean Society of Cardiovascular Disease Prevention)
				</p>
			</div>
			<img src="./img/headman_img.png" alt = ""/>
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