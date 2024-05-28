<?php include_once('./include/head.php'); ?>
<!-- HUBDNCAJY : app 일 경우 전용 헤더 app_header 사용필요 -->
<?php include_once('./include/header.php'); ?>

<!-- HUBDNCAJY : App 일 경우 padding/margin을 조정하는 app_version 클래스가 container에 들어가야 함 -->
<section class="container sponsor">
	<!-- HUBDNCAJY : App 일 경우 타이틀 영역 입니다. -->
	<!-- <div class="app_title_box">
	 	<h2 class="app_title">Floor Plan</h2>
	</div> -->
    <h1 class="page_title">Venue
			<div class="sub_btn_box">
				<a href="/main/venue.php">Grand Walkerhil Seoul</a>
				<a href="/main/accommodation.php">Accommodation</a>
				<a href="/main/floor_plan.php" class="on">Floor Plan</a>
			</div>
		</h1>
    <div class="inner type2">
		<!--
        <div class="sub_banner">
            <h1>Floor Plan</h1>
        </div> -->
        <div class="section section1">
            <div class="img_wrap">
                <img class="floor_map" src="./img/ICOMES 2023_Floor plan (web).jpg"/>            
            </div>
        </div>
    </div>
</section>

<?php include_once('./include/footer.php'); ?>