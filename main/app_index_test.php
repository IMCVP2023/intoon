<?php
	include_once('./include/head.php');
	include_once('./include/app_header.php');
?>

<style>
	html {background: url("./img/img_app_vsl5.jpg") no-repeat left bottom /cover;}
	html, body {min-height:100%;}
	.rolling_wrap {display:block;}
</style>

<!-- HUBDNCLHJ : app loading 페이지 -->
<section class="container app_version main">
	<div class="app_vsl">
		<img src="./img/img_app_vsl_text2.svg" class="text" alt="">
	</div>
	<div class="app_main_inner">
		<ul class="app_index_menu">
			<li>
				<a href="javascript:;">
					<img src="./img/icons/app_menu01.svg" alt="">
					<span>ICOMES 2023</span>
				</a>
			</li>
			<li>
				<a href="/main/program_glance.php">
					<img src="./img/icons/app_menu02.svg" alt="">
					<span>PROGRAM</span>
				</a>
			</li>
			<li>
				<a href="/main/app_abstract.php">
					<img src="./img/icons/app_menu03.svg" alt="">
					<span>ABSTRACT</span>
				</a>
			</li>
			<li>
				<a href="/main/app_invited_speakers.php">
					<img src="./img/icons/app_menu04.svg" alt="">
					<span>INVITED<br/>SPEAKERS</span>
				</a>
			</li>
			<li>
				<a href="/main/app_happening_now.php">
					<img src="./img/icons/app_menu05.svg" alt="">
					<span>HAPPENING<br/>NOW</span>
				</a>
			</li>
			<li>
				<a href="/main/app_floor_plan.php">
					<img src="./img/icons/app_menu06.svg" alt="">
					<span>FLOOR PLAN</span>
				</a>
			</li>
			<li>
				<a href="/main/sponsor.php">
					<img src="./img/icons/app_menu07.svg" alt="">
					<span>SPONSORSHIP</span>
				</a>
			</li>
			<li>
				<a href="/main/app_notice.php">
					<img src="./img/icons/app_menu08.svg" alt="">
					<span>NOTICE</span>
				</a>
			</li>
			<li>
				<a href="https://www.kosso.or.kr/">
					<img src="./img/icons/app_menu09.svg" alt="">
					<span>KSSO</span>
				</a>
			</li>
		</ul>
	</div>
</section>

<script>
	$(document).ready(function(){
		$(".app_header").addClass("simple");
		$(".app_nav_btn img").attr("src", "/main/img/icons/icon_hamburger2.svg");
	});
</script>

<?php
	include_once('./include/app_footer_test.php');
?>