<?php include_once('./include/head.php'); ?>
<?php 
    $session_user = $_SESSION['USER'] ?? NULL;
    $session_app_type = (!empty($_SESSION['APP']) ? 'Y' : 'N');

    if(!empty($session_user) && $session_app_type == 'Y') {
        include_once('./include/app_header.php');
    } else {
        include_once('./include/header.php');
    }

    $add_section_class = (!empty($session_user) && $session_app_type == 'Y') ? 'app_version' : '';
?>

<style>
    .grade_wrap li a.daewon, .grade_wrap li a.lilly {transform:scale(1) !important;}
</style>

<!-- app일 시 section에 app_version 클래스 추가 -->
<section class="container sponsor <?= $add_section_class; ?>">
	<!-- HUBDNCLHJ : app 메뉴 탭 -->
<?php
    if(!empty($session_user) && $session_app_type == 'Y') {
?>
	<div class="app_title_box">
		<h2 class="app_title">Sponsorship<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
		<ul class="app_menu_tab langth_2">
			<li class="on"><a href="./sponsor.php">Sponsorship</a></li>
			<li><a href="./sponsor_exhibition.php">Exhibition</a></li>
		</ul>
	</div>
<?php
    } 
?>
	<!-- HUBDNCLHJ : APP일시 h1.page_title 주석처리 후 app 메뉴 탭 주석해제 -->

<?php
	if (!empty($session_app_type) && $session_app_type == 'N') {
		// Web일때
?>
   <h1 class="page_title">Sponsorship
			<div class="sub_btn_box">
				<a href="/main/sponsor.php" class="on">Sponsors</a>
				<!-- <a href="/main/sponsor_guidelines.php">Sponsor Guidelines</a> -->
				<a href="/main/comingsoon.php">Exhibition & Social Event</a>

				<!-- <a href="/main/sponsor_exhibition.php">Exhibition & Social Event</a> -->
			</div>
		</h1>
<?php
    }
?>
	<div class="inner">
	<!-- <ul class="tab_green long abstract_submission">
            <li class="on"><a href="./sponsor.php">Sponsors</a></li>
            <li><a href="./sponsor_guidelines.php">Sponsor Guidelines</a></li>
            <li><a href="./sponsor_exhibition.php">Exhibition & Social Event</a></li>
    </ul> -->
		<div class="sponsor_grade">
			<p class="grade_title pink_bg">Supreme</p>
			<ul class="grade_wrap length_1">
				<li>
					<a href="https://m.daewoong.co.kr/en/main/index" class="daewoong">DAEWOONG</a>
				</li>
				<li>
					<a href="https://daewoongbio.co.kr/daewoongbiokr/main/main.web" class="daewoong_bio">DAEWOONG</a>
				</li>
			</ul>	
			<p class="grade_title green_bg05">Diamond</p>
			<ul class="grade_wrap length_1">
				<li>
					<a href="https://www.daiichisankyo.com/" class="daiichi_sankyo">Daiichi Sankyo</a>
				</li>
			</ul> 
			<p class="grade_title gold_bg">Platinum</p>
			<ul class="grade_wrap length_3">
				<li>
					<a href="https://www.boryung.co.kr/en/" class="boryung">BORYUNG</a>
				</li>
				<li class="small">
					<a href="https://www.celltrionph.com/en-us/home/index" class="celltrion">CELLTRION</a>
				</li>
				<li>
					<a href="https://www.hanmipharm.com/ehanmi/handler/Home-Start" class="hanmi_pharm">Hanmi Pharm</a>
				</li>
			
			</ul>
			<p class="grade_title silver_bg">Gold</p>
			<ul class="grade_wrap length_3">
				<li class="small">
					<a href="https://www.daewonpharm.com/eng/main/index.jsp" class="daewon">Daewon</a>
				</li>
				<li>
					<a href="http://www.ckdpharm.com/en/home" class="chong_kun_dang">Chong Kun Dang</a>
				</li>
				<li>
					<a href="https://www.boehringer-ingelheim.com/" class="bily">bily</a>
				</li>

			</ul>
			<p class="grade_title bronze_bg">Silver</p>
			<ul class="grade_wrap length_5">
				<li>
					<a href="https://www.novonordisk.com/" class="novo_nordisk">novo nordisk</a>
				</li>
				<li>
					<a href="https://www.bayer.com/en/" class="bayer">Bayer</a>
				</li>

				<li class="small">
					<a href="https://www.sanofi.com/en/our-company" class="sanofi">sanofi</a>
				</li>
				<li>
					<a href="http://www.dalimpharm.co.kr/en_index.html" class="dalimbiotech">dalimbiotech</a>
				</li>
				<li>
					<a href="https://www.organon.com/" class="organon">ORGANON</a>
				</li>

			</ul>
		</div>
	</div>
</section>

<?php
    if(!empty($session_user) && $session_app_type == 'Y') {
?>
<div class="popup app_pop" style="display:block;">
    <div class="pop_bg"></div>
    <div class="pop_contents">
		<img src="/main/img/app_pop_stamp_tour_event.png" alt="">
    </div>
</div>
<?php
    } 
?>

<?php 
    if (!empty($session_app_type) && $session_app_type == 'Y') {
        // mo일때
        include_once('./include/app_footer.php'); 
    }else {
        include_once('./include/footer.php');
    }
?>