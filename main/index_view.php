<?php
	// main
	$img_col_name = check_device() ? "mo_" : "pc_";
	$img_col_name .= $language."_img";
	$banner_query =	"SELECT
						b.idx,
						CONCAT(fi_img.path, '/', fi_img.save_name) AS fi_img_url
					FROM banner AS b
					LEFT JOIN `file` AS fi_img
						ON fi_img.idx = b.".$img_col_name."
					WHERE b.".$img_col_name." > 0";
	$banner = get_data($banner_query);
	$banner_cnt = count($banner);

	// event
	$info_query =	"SELECT
						ie.title AS event_title,
						ie.period_event_start,
						ie.period_event_end,
						igv.name_".$language." AS venue_name
					FROM info_event AS ie
					,info_general_venue igv";
	$info = sql_fetch($info_query);

	//key date
	$key_date_query =	"SELECT
							`key_date`,
							contents_".$language." AS contents
						FROM key_date
						WHERE `type` = 'poster'
						#AND DATE(`key_date`) >= DATE(NOW())
						AND DATE(`key_date`) <> '0000-00-00'
						ORDER BY `key_date`
						LIMIT 4";
	$key_date = get_data($key_date_query);
	$key_date_cnt = count($key_date);

	//2021_06_23 HUBDNC_KMJ NOTICE 쿼리
	$notice_list_query = "SELECT
							idx,
							title_en,
							title_ko,
							DATE_FORMAT(register_date, '%Y-%m-%d') AS date_ymd
						FROM board
						WHERE `type` = 1
						AND is_deleted = 'N'
						ORDER BY register_date DESC
						LIMIT 3";
	$notice_list = get_data($notice_list_query);

	//$notice_cnt = count($notice_list);
?>

<style>
	.index_sponsor_wrap {display:block;}
</style>

<section class="main_section icola_main">
	<!-- 배경이미지
	<div class="bg_wrap">
		<div class="dim"></div>
		<div class="main_bg_slider">
			<div class="video_wrap">
				<video src="https://player.vimeo.com/external/595050190.hd.mp4?s=f5a9471e806bff619dc115c9dfc5db80d5df87fb&profile_id=174" autoplay="autoplay" muted="muted" playsinline id="main_video_bg" loop></video>
			</div>
			<?php
				foreach ($banner as $bn) {
			?>
			<div class="main_img_wrap"><img src="<?=$bn['fi_img_url']?>"></div>
			<?php
				}
			?>
		</div>
	</div>
	-->
	<div class="section_bg">
		<div class="container">
			<!-- 상단 타이틀 -->
			<img src="/main/img/2024_imcvp_main_logo-3.png" class="pc_only img_vsl_text" alt="">
			<!-- <img src="/main/img/2024_imcvp_main_logo-1.svg" class="pc_only img_vsl_text" alt=""> -->
			<!-- <img src="/main/img/2024_main_day_popup.png" alt=""/> -->
			<div class="pc_only main_day_popup_img">
				<p class="main_dday">D-<?php echo number_format($d_days); ?></p>
				<a href="/main/registration_guidelines.php"></a>
			</div>
			<div class="mb_only img_vsl_text" style="">
				<img src="/main/img/2024_imcvp_main_logo-3.png" alt="">
				<!-- <img src="/main/img/2024_imcvp_main_logo-1.svg" alt=""> -->
				<!-- <p>Sep. 7(Thu) ~ Sep. 9(Sat)</p>
				<p>CONRAD Seoul Hotel, Korea</p> -->
			</div>
			<div class="txt_wrap">

				<!-- <h1><?=$info['event_title']?>ICoLA 2022 <br/><span class="green_t"><span class="light">with</span> APSAVD</h1></span>
				<p class="event_name">
					
					The 11<sup>th</sup> <b>I</b>nternational <b>C</b>ongress <b>o</b>n <b>L</b>ipid & <b>A</b>therosclerosis
					<br/>with <b>A</b>sian-<b>P</b>acific <b>S</b>ociety of <b>A</b>therosclerosis and <b>V</b>ascular <b>D</b>isease -->
					
					<!--<b>T</b>he <b>c</b>onference <b>f</b>ormat (Face-to-face or online) <b>w</b>ill <b>b</b>e <b>a</b>nnounced <b>b</b>efore <b>l</b>ong <b>i</b>n<br class="responsive_br"/><b>c</b>onsideration <b>o</b>f <b>t</b>he <b>C</b>OVID 19 <b>s</b>ituation. <b>P</b>lease <b>c</b>heck <b>o</b>ur <b>w</b>ebsite <b>r</b>egularly.-->
				<!-- </p> -->
				<!-- <p class="event_hold">
					<?php
						$date_start = date_create($info['period_event_start']);
						$date_end = date_create($info['period_event_end']);

						$format_start = "M d(D)";
						$format_end = "d(D), Y";

						if (date_format($date_start, 'Y') != date_format($date_end, 'Y')) {
							$format_start = "M d(D), Y";
							$format_end = "M d(D), Y";
						} else if (date_format($date_start, 'F') != date_format($date_end, 'F')) {
							$format_end = "M d(D), Y";
						}

						$date_text = date_format($date_start, $format_start)."~".date_format($date_end, $format_end);
						$venue_text = $info['venue_name'];
					?>
					<?=$date_text?>&nbsp;/&nbsp;<?=$venue_text?>
					<span class="event_date">SEP 15<span>(Thu)</span> ~ 17<span>(Sat)</span>, 2022</span>
					<span class="event_place">CONRAD Seoul, Korea</span>
					
				</p>
				<p class="event_msg">* This congress will be an on-site event in Seoul, Republic of Korea.</p> -->
				
				<!-- <p class="sub_section_title main_theme"><?=$locale("theme_txt")?></p>
				<div class="clearfix2">
					<div class="live_btn">
						<p class="live_tit">Connecting to Live Platform</p>
						<p class="onair_btn w1024"> ON-AIR <span>Technical Support - Tel. +82-2-2039-7802,  +82-2-6959-4868, +82-2-3275-3028</span></p>
						<p class="sub_section_title main_theme liveenter_btn">Enter</p>
					</div>
				</div> -->
				
				<!-- <div class="main_btn_wrap">
				<button type="button" class="btn_register_now" onClick="javascript:alert('Coming soon.');">Register Now</button>
					<button type="button" class="btn_circle_arrow"></button>
				</div> -->
			</div>
		</div>
		<div class="main_btn_wrap">
			<button type="button" class="btn_circle_arrow"></button>
		</div>
	</div>
</section>

<!-- Plenary Speakers -->
<div class="speakers_wrap">
	<div class="container">
		<h1 class="speakers_wrap_title">Invited Speakers</h1>
		<div class="speakers_slick">
			<ul class="main_speaker2 slick-slider">
				<li class="index_speaker1">
					<div class="profile_circle"><div class="profile_wrap"></div></div>
					<h5 class="title">Brian Tomlinson</h5>
					<div class="career">Macau University of Science and Technology,<br>Macao SAR</div>
						<!-- ,<br>TBD -->
				</li>
				<li class="index_speaker2">
					<div class="profile_circle"><div class="profile_wrap"></div></div>
					<h5 class="title">Takayoshi Ohkubo</h5>
					<div class="career">Teikyo University School of Medicine,<br>Japan</div>
						<!-- <br>TBD -->
				</li>
				<li class="index_speaker3">
					<div class="profile_circle"><div class="profile_wrap"></div></div>
					<h5 class="title">David Cherney</h5>
					<div class="career">University Health Network,<br>Canada</div>
				</li>
				<li class="index_speaker4">
					<div class="profile_circle"><div class="profile_wrap"></div></div>
					<h5 class="title">Yong-Jae Kim</h5>
					<div class="career">The Catholic University of Korea,<br>Korea</div>
				</li>
				<!-- <li class="index_speaker5">
					<div class="profile_circle"><div class="profile_wrap"></div></div>
					<h5 class="title">TBD</h5>
					<div class="career">TBD,<br>TBD</div>
				</li>
				<li class="index_speaker6">
					<div class="profile_circle"><div class="profile_wrap"></div></div>
					<h5 class="title">TBD</h5>
					<div class="career">TBD,<br>TBD</div>
				</li> -->
			</ul>
		</div>
	</div>
</div>
<!-- Key dates & News,Notice -->
<section class="key_date_section">
	<div class="container">
		<div class="noti_wrap">
			<div class="dates_area">
				<h3 class="noti_wrap_title title">Key dates</h3>
				<ul>
					<li>
						<a href="/main/registration_guidelines.php">
							<h2>Early bird<br/>registration<br/>deadline</h2>
							<div>
								<p>October</p>
								<p>7</p>
							</div>
						</a>
					</li>
					<li>
						<a href="/main/abstract_submission_guideline.php">
						<!-- <h2>Abstract<br/>submission<br/>deadline</h2>
							<div>
								<p>August</p>
								<p>28</p>
							</div> -->
						</a>
					</li>
					<li>
						<a href="/main/registration_guidelines.php">
						<!-- <h2>Notification of<br/>acceptance</h2>
							<div>
								<p>October</p>
								<p>25</p>
							</div> -->
						</a>
					</li>
					<li>
						<a href="/main/registration_guidelines.php">
							<h2>Pre-registration<br/>Deadline</h2>
							<div>
								<p>November</p>
								<p>3</p>
							</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="noti_area">
				<h3 class="noti_wrap_title title">News & Information</h3>
				<ul>					
				<?php if(count($notice_list) > 0) { ?>
						<?php 
							for($i = 0; $i < count($notice_list); $i++) { 
								$notice = $notice_list[$i];
						?>
							<li><a href="/main/board_notice_detail.php?no=<?= $notice["idx"] ?>&i=<?= $total_notice - $i ?>"><p><?= $notice["title_en"] ?? "" ?></p><span><?= $notice["date_ymd"] ?? "" ?></span></a></li>
						<?php } ?>
					<?php } else { ?>
						<li>
							<div class='no_data'>Will be updated</div>
						</li>
					<?php } ?>
					
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- <script>
	// 오늘 하루만 보기

	// 쿠키 가져오기
	function getCookie (name) {
		var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
		return value? value[2] : null;
	}

	console.log(getCookie("pop"))

	//쿠키가 존재하지 않으면 팝업창을 연다.
	if(getCookie("pop") == null)  {
		$('.pop_2023').show();
		$('.travel_grant_pop').show();
		$('.deadline_pop').show();
		$('.notification_pop').show();
	} else {
		$('.pop_2023').hide();
		$('.travel_grant_pop').hide();
		$('.deadline_pop').hide();
		$('.notification_pop').hide();
	}

	$('.pop_2023 .close_area a, .travel_grant_pop .pop_close, .deadline_pop .pop_close, .notification_pop .pop_close').click(function(){
		if($("#today_check, #today_check1").is(":checked")){
			var toDate = new Date();
			setHeaderCookie("pop", "done", 1);

			console.log($("#today_check, #today_check1").is(":checked"))
		}
		$(this).parents(".popup").hide();
		//$('.travel_grant_pop, .deadline_pop, .notification_pop').hide();
	});

</script> -->

<div class="popup deadline_pop extension">
	<div class="pop_bg"></div>
	<div class="pop_contents">
		<img src="./img/deadline_logo.png" alt="">
		<div class="inner">
			<div>
				<h1>Exciting news! <br/>We’re thrilled to announce that we’ve extended the early bird registration rates until <p>Monday 7 October 2024.</p> Don’t miss out on this fantastic offer— it’s available for a limited time only!</h1>
				<!-- <p>August 26(Fri)</p> -->
				<button type="button" class="main_pop_btn" onClick="javascript:window.open('/main/registration_guidelines.php')">Register Now<img src="./img/travel_pointer.png" alt=""></button>			
			</div>
		</div>
		<div class="close_area clearfix2">
			<div>
				<input type="checkbox" id="today_check" class="checkbox input required">
				<label for="today_check">Do not open this window for 24 hours.</label>
			</div>
			<a href="javascript:;" class="pop_close">Close <img src="./img/main_pop_close.png" alt=""></a>
		</div>	
	</div>
</div>

<script>
// 오늘 하루만 보기

	// 쿠키 가져오기
	function getCookie (name) {
		var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
		return value? value[2] : null;
	}

	console.log(getCookie("pop"))

	//쿠키가 존재하지 않으면 팝업창을 연다.
	if(getCookie("pop") == null)  {
		$('.pop_2023').show();
		$('.travel_grant_pop').show();
		$('.deadline_pop').show();
		$('.notification_pop').show();
	} else {
		$('.pop_2023').hide();
		$('.travel_grant_pop').hide();
		$('.deadline_pop').hide();
		$('.notification_pop').hide();
	}

	$('.pop_2023 .close_area a, .travel_grant_pop .pop_close, .deadline_pop .pop_close, .notification_pop .pop_close').click(function(){
		if($("#today_check, #today_check1").is(":checked")){
			var toDate = new Date();
			setHeaderCookie("pop", "done", 1);

			console.log($("#today_check, #today_check1").is(":checked"))
		}
		$(this).parents(".popup").hide();
		//$('.travel_grant_pop, .deadline_pop, .notification_pop').hide();
	});

</script>


<script>
	$('document').ready(function(){
		$('.close_area a').click(function(){
			$(this).parents('.popup').hide();
		});
		$('body').addClass('main');

		// $('.main_day_popup_img').click(function(){
		// 	window.location.href = "/main/registration_guidelines.php"
		// });
		
		$('.main_speaker2').slick({
			dots: false,
			navigation: true,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 6000,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 850,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]

		});

		//bg slider
		var bg_slider = $('.main_bg_slider').slick({
			dots: false,
			infinite: true,
			slidesToShow: 1,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 10000
		});

		
		// var vid = document.getElementById("main_video_bg");
		//vid.onended = function() {
		//	bg_slider.slick('slickNext');
		//};
		//on-air 버튼 깜빡이기
		//setInterval(function () {
		//$('.onair_btn').toggleClass('changed');
		//}, 700);

		// circle_arrow click이벤트
		// var header_top = $("header.green_header").outerHeight();
		// var speakers_top = $(".speakers_wrap").offset().top;
		// var want_position = speakers_top - header_top;
		// $(".btn_circle_arrow").click(function(){
		// 	$("html, body").animate({scrollTop: want_position + "px"}, 500);
		// });

	});

	$(function () {
		function load () {
			console.log('x')
		}
	})
	
	// 쿠키 헤더 생성
	function setHeaderCookie(name, value, hours, minute) {
		var todayDate = new Date();
		//var set_date = 24 - today.getHours();
		todayDate.setHours(todayDate.getHours() + (hours + 9));
		todayDate.setMinutes(todayDate.getMinutes() + minute);
		todayDate.setSeconds(0);

		document.cookie = name+ "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";";
	}

	// 쿠키 가져오기
	function getCookie (name) {
		var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
		return value? value[2] : null;
	}

	
	//page loading bar 주석
	// $('.live_btn, .live_btn2').click(function(){
	// 	$('#vid_auto').html('<source src="https://player.vimeo.com/external/595045789.hd.mp4?s=53cc26f55fa424c019f24192b49b06a165528174&profile_id=174">');
	// 	$('.page_loading').addClass('active');
	// })

	// function myFunction(){
	// 	$('.page_loading').removeClass('active');
	// 	window.location.href = '/main/live';
	// }

	$(document).ready(function(){
		$(window).resize(function(){
			$(".main_bg_slider").slick("resize");
			$(".main_bg_slider").slick("refresh");
		})
		$(window).trigger("resize")
	});
</script>
