<?php
	include_once('./include/app_check.php');
?>

<!-- 사용자 App header -->
<header class="app_header">
	<div class="hd_inner">
		<h1 class="app_h_logo"><a href="/main/app_index.php"><img src="/main/img/app_logo.svg" alt="ICOMES 로고"></a></h1>
		<button type="button" class="app_nav_btn"><img src="/main/img/icons/icon_hamburger.svg" alt="메뉴"></button>
		<button type="button" class="stamp_admin_close"><img src="/main/img/icons/icon_x_wh.svg" alt="닫기"></button>
	</div>
</header>

<!-- 사용자 App nav -->
<div class="app_nav_bg"></div>
<div class="app_nav">
    <div class="nav_inner">
		<div class="app_nav_top">
			<a href="/main/app_setting.php" class="point_txt"><img src="/main/img/icons/icon_setting.svg" alt="설정">Setting</a>
		</div>
		<div class="app_nav_bot">
			<div class="app_sub_bg"></div>
			<ul class="app_nav_menu">
				<li class="on">
					<a href="javascript:;">ICOMES 2023</a>
					<ul class="app_sub">
						<li><a href="/main/welcome.php">Welcome Message</a></li>
						<li><a href="/main/organizing_committee.php">Organization</a></li>
						<li><a href="/main/app_overview.php">Overview</a></li>
						<li><a href="/main/venue.php">Venue</a></li>
					</ul>
				</li>
				<li>
					<a href="/main/app_floor_plan.php">Floor Plan</a>
				</li>
				<li>
					<a href="javascript:;">Program</a>
					<ul class="app_sub">
						<li><a href="/main/program_glance.php">Program at a Glance</a></li>
						<li><a href="/main/app_program_detail.php">Scientific Program</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">Abstract</a>
					<ul class="app_sub">
						<li><a href="/main/app_abstract.php?category_idx=5">Plenary Lecture</a></li>
						<li><a href="/main/app_abstract.php?category_idx=6">Keynote Lecture</a></li>
						<li><a href="/main/app_abstract.php?category_idx=8">Symposium</a></li>
						<li><a href="/main/app_abstract.php?category_idx=15">Joint Symposium</a></li>
						<li><a href="/main/app_abstract.php?category_idx=9">Obesity Treatment Guidelines Symposium</a></li>
						<li><a href="/main/app_abstract.php?category_idx=7">Best Article in JOMES</a></li>
						<li><a href="/main/app_abstract.php?category_idx=10">Pre-congress Symposium</a></li>
						<li><a href="/main/app_abstract.php?category_idx=11">Breakfast Symposium</a></li>
						<li><a href="/main/app_abstract.php?category_idx=12">Luncheon Symposium</a></li>
						<li><a href="/main/app_abstract.php?category_idx=13">Satellite Symposium</a></li>
						<li><a href="/main/app_abstract.php?category_idx=14">Sponsored Session</a></li>
						<li><a href="/main/app_abstract.php?category_idx=16">Oral Presentation</a></li>
						<li><a href="/main/app_abstract.php?category_idx=17">Guided Poster Presentation</a></li>
						<li><a href="/main/app_abstract.php?category_idx=18">Poster Exhibition</a></li>
					</ul>
				</li>
				<li>
					<a href="/main/app_invited_speakers.php">Invited Speakers</a>
				</li>
				<li>
					<a href="javascript:;">Sponsorship</a>
					<ul class="app_sub">
						<li><a href="/main/sponsor.php">Sponsorship</a></li>
						<li><a href="/main/sponsor_exhibition.php">Exhibition</a></li>
					</ul>
				</li>
				<li>
					<a href="/main/registration_rating_guides.php">평점 안내<br/>(Korean Only)</a>
				</li>
				<li>
					<a href="/main/app_notice.php">Notice</a>
				</li>
				<li>
					<a href="/main/app_survey.php">Survey</a>
				</li>
				<!-- <li>
					<a href="javascript:;">Stamp Tour</a>
					<ul class="app_sub">
						<li><a href="/main/app_stamp_guidelines.php">Stamp Tour Guidelines</a></li>
						<li><a href="/main/app_my_stamp.php">My Stamp</a></li>
						<li><a href="/main/app_tour_map.php">Tour Map</a></li>
					</ul>
				</li> -->
				<li>
					<a href="http://184a8b4a1a076d93.kinxzone.com/Programbook.pdf" download class="pdf_view">Program Book <br/>Download</a>
				</li>
				<li>
					<a href="http://184a8b4a1a076d93.kinxzone.com/Abstractbook.pdf" download class="pdf_view">Abstract Book <br/>Download</a>
				</li>
			</ul>
		</div>
    </div>
	<button type="button" class="app_nav_close"><img src="/main/img/icons/icon_x_wh.svg" alt="닫기"></button>
</div>
<script>
    $(document).ready(function() {
        $(".pdf_view").click(function(event){
            event.preventDefault();
            let path = event.target.href;
            if(path==='javascript:void(0)'){
                alert('Updates are planned.')
                return false;
            } else {
                openPDF(path);
            }
        });

        function openPDF(path) {
            // let path = e.target.href;

            if (typeof (window.AndroidScript) != "undefined" && window.AndroidScript != null) {
                window.AndroidScript.openPDF(path);
            } else if (window.webkit && window.webkit.messageHandlers != null) {
                try {
                    window.webkit.messageHandlers.openPDF.postMessage(path);
                } catch (err) {
                    console.log(err);
                }
            }
        }
    })
</script>