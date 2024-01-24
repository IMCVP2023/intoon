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
			<h2 class="app_title">ICOMES 2023<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
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
		<h1 class="page_title">Welcome Message</h1>
        <div class="inner">
            <div>
				<h3 class="title icon_none">Respected colleagues,</h3>
				<p class="welcome_txt">
					We extend our warmest greetings and deepest appreciation to all the esteemed individuals dedicated to advancing academic research in the field of obesity and metabolic syndrome. As we emerge from the challenges of the COVID-19 pandemic, which profoundly impacted our lifestyles with reduced physical activity and changes in eating habits, we acknowledge the pressing concern of increased obesity. We gather here to renew our commitment to the fight against obesity. <br/><br/>The Korean Society for the Study of Obesity (KSSO) proudly presents the ‘International Congress on Obesity and MEtabolic Syndrome 2023 (ICOMES 2023)’ under the theme of ‘Now is the Time to Conquer Obesity.’ The conference will take place at the Conrad Seoul Hotel from September 7th to September 9th. Building upon the success of previous conferences, ‘ICOMES’ has evolved into a prominent international platform for exchanging insights and advancing obesity-related research. Our aim is to foster collaboration and knowledge exchange among obesity specialists, driving advancements in the field.  <br/><br/>This year, we are honored to introduce a distinguished group of Plenary Lecture speakers who will enlighten us with their invaluable expertise. Please join us in welcoming Thiruma V. Arumugam from La Trobe University (Australia), Robert R. Wolfe from the University of Arkansas for Medical Sciences (USA), Tamas Horvath from Yale University (USA), and John Wilding from the University of Liverpool (UK). <br/><br/>Additionally, we are privileged to present our esteemed Keynote Lecture speakers who bring a wealth of expertise and fresh perspectives to the forefront of research. Their captivating presentations will undoubtedly enhance our understanding of cutting-edge advancements in the field. Let us extend a warm welcome to Matthias Blüher from the University of Leipzig (Germany), Jae Myoung Suh from KAIST (Korea), Zachary Knight from the University of California (USA), and Jae-Heon Kang from Sungkyunkwan University (Korea). <br/><br/>At the beginning of this year, KSSO reaffirmed its determination to delve deeper into the field and embrace new challenges through cooperation with other international societies. We had the great opportunity to generously host three Joint Symposia at ICOMES 2023 with the world's most prestigious obesity associations: The Asia Oceania Association for the Study of Obesity (AOASO) as well as the European Association for the Study of Obesity (EASO) and The Obesity Society (TOS). <br/><br/>‘ICOMES 2023’ offers a remarkable opportunity to engage with experts, exchange knowledge, and foster collaborations. We encourage you to seize this chance to contribute to the advancement of obesity-related research and patient care. Now is the time to conquer obesity! <br/><br/>We eagerly anticipate your active participation and presence at ‘ICOMES 2023’.<br/><br/><br/>Best regards,

				</p>
			</div>
            <div class="head_profile">
				<div class="headman">
					<div class="headman_l"><img src="./img/headman_img1.png" alt=""></div>
					<div class="headman_r">
						<!-- <h5>Name</h5> -->
						<h1>Sung Soo Kim, M.D., Ph.D</h1>
						<h5>Chairman</h5>
						<p>Korea Society for Study of Obesity</p>
						<div class="headman_sign"><img src="./img/headman_sign1.png" alt=""></div>
					</div>
				</div>
				<div class="headman">
					<div class="headman_l"><img src="./img/headman_img2.png" alt=""></div>
					<div class="headman_r">
						<!-- <h5>Name</h5> -->
						<h1>Cheol-Young Park, M.D., Ph.D</h1>
						<h5>President</h5>
						<p>Korea Society for Study of Obesity</p>
						<div class="headman_sign"><img src="./img/headman_sign2_1.png" alt=""></div>
					</div>
				</div>
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