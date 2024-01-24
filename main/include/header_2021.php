<?php
	$language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
	$locale = locale($language);

	$_page_config = array(
		"m1" => [
			"welcome",
			"organizing_committee",
			"overview",
			"venue",
			"photo"
		],
		"m2" => [
			"program_glance",
			"program_detail",
			"invited_speaker"
		],
		"m3" => [
			"poster_abstract_submission",
			"abstract_submission",
			"abstract_submission2",
			"abstract_submission3",
			"eposter",
			"lecture_note_submission",
			"lecture_submission",
			"lecture_submission2",
			"lecture_submission3",
			"oral_presenters",
			"eposter_presenters"
		],
		"m4" => [
			"registration_guidelines",
			"registration",
			"registration2",
			"registration3"
		],
		"m5" => [
			"sponsor_information",
			"application",
			"application_complete"
		],
		"m6" => [
			"accommodation",
			"attraction_historic",
			"useful_information"
		]
	);

	$_page = str_replace(".php","",end(explode("/",$_SERVER["REQUEST_URI"])));
?>
<header class="">
	<div class="container">
		<div class="top clearfix2">
			<h1 class="logo"><a href="./index.php"><img src="./img/logo_w.png"><img src="./img/logo.png"></a></h1>
			<div class="right_wrap clearfix2">
				<div class="clearfix">
					<div>
					<?php
						if($_SESSION["USER"]["idx"] == "") {
					?>
						<a class="btn white_border" href="./login.php"><?=$locale("login")?></a> 
						<a class="btn white_border" href="./signup.php"><?=$locale("signup")?></a> 
					<?php
						} else {	
					?>
						<a class="btn white_border" href="./mypage.php"><?=$locale("mypage")?></a> 
						<a class="btn white_border logout_btn" href="javascript:;"><?=$locale("logout_btn")?></a>
					<?php
						}	
					?>
					</div>
					<div class="has_left_bar toggle_wrap clearfix <?=$language == "en" ? "" : "left" ?>">
						<input type="hidden" id="language" value="<?=$language?>">
						<input type="radio" value="kor" name="language" id="kor" <?=($language == "ko" ? "checked" : "")?>>
						<label for="kor"><?=$locale("korean")?></label>
						<div class="toggle">
							<div class="toggle__pointer"></div>
						</div>
						<input type="radio" value="eng" name="language" id="eng" <?=($language != "ko" ? "checked" : "")?>>
						<label for="eng"><?=$locale("english")?></label>
					</div>
				</div>
				<div class="tablet_show">
					<button type="button" class="m_nav_btn"><img src="./img/icons/m_nav.png"></button>
				</div>
			</div>
		</div>
		<div class="nav_wrap pc_only">
			<div class="bar"></div>
			<ul class="depth01">
				<li class="<?=(in_array($_page, $_page_config["m1"]) ? "active" : "")?>">
					<a href="javascript:;"><span>General Information</span><!--<img src="./img/icons/nav_arrow.png">--></a>
					<ul class="sub_nav">
						<li><a href="./welcome.php">Welcome Message</a></li>
						<li><a href="./organizing_committee.php">Organizing Committee</a></li>
						<li><a href="./overview.php">Overview</a></li>
						<li><a href="./venue.php">Venue</a></li>
						<li><a href="./photo.php">Photo Gallery</a></li>
					</ul>
				</li>
				<li class="<?=(in_array($_page, $_page_config["m2"]) ? "active" : "")?>">
					<a href="javascript:;"><span>Program</span><!--<img src="./img/icons/nav_arrow.png">--></a>
					<ul class="sub_nav">
						<li><a href="./program_glance.php">Program at a glance</a></li>
						<li><a href="./program_detail.php">Program in Detail</a></li>
						<li><a href="./invited_speaker.php">Invited Speakers</a></li>
					</ul>
				</li>
				<li class="<?=(in_array($_page, $_page_config["m3"]) ? "active" : "")?>">
					<a href="javascript:;"><span>Call for Abstracts</span><!--<img src="./img/icons/nav_arrow.png">--></a>
					<ul class="sub_nav">
						<li><a href="poster_abstract_submission.php">Submission Guideline</a></li>
						<li><a href="lecture_note_submission.php">Lecture Abstract Guideline</a></li>
					</ul>
				</li>
				<li class="<?=(in_array($_page, $_page_config["m4"]) ? "active" : "")?>">
					<a href="javascript:;"><span>Registration</span><!--<img src="./img/icons/nav_arrow.png">--></a>
					<ul class="sub_nav">
						<li><a href="registration_guidelines.php">Guidelines</a></li>
						<li><a href="./registration.php">Online Registration</a></li>
					</ul>
				</li>
				<li class="<?=(in_array($_page, $_page_config["m5"]) ? "active" : "")?>">
					<a href="javascript:;"><span>Sponsorship & Exhibition</span><!--<img src="./img/icons/nav_arrow.png">--></a>
					<ul class="sub_nav">
						<li><a href="sponsor_information.php">Sponsor Information</a></li>
						<li><a href="application.php">Application</a></li>
					</ul>
				</li>
				<li class="<?=(in_array($_page, $_page_config["m6"]) ? "active" : "")?>">
					<a href="javascript:;"><span>Accommodations & Tour</span><!--<img src="./img/icons/nav_arrow.png">--></a>
					<ul class="sub_nav">
						<li><a href="accommodation.php">Hotel Accommodations</a></li>
						<li><a href="attraction_historic.php">Attractions in Seoul</a></li>
						<li><a href="useful_information.php">Useful Information</a></li>
					</ul>
				</li>
			</ul>
			
		</div>
	</div>

</header>
<div class="nav_dim"></div>


<div class="m_nav_wrap">
	<div class="toggle_wrap clearfix <?=$language == "en" ? "" : "left" ?>">
		<input type="radio" value="kor" name="m_language" id="m_kor" <?=($language == "ko" ? "checked" : "")?>>
		<label for="m_kor"><?=$locale("korean")?></label>
		<div class="toggle">
			<div class="toggle__pointer"></div>
		</div>
		<input type="radio" value="eng" name="m_language" id="m_eng" <?=($language != "ko" ? "checked" : "")?>>
		<label for="m_eng"><?=$locale("english")?></label>
	</div>
	<button type="button" class="n_nav_close"><img src="./img/icons/m_nav_close.png"></button>
	<div class="m_nav">
		<ul class="m_nav_ul">
			<li class="m_nav_li">
				<a href="javascript:;" class="<?=(in_array($_page, $_page_config["m1"]) ? "show" : "")?>"><span>General Information</span> <img src="./img/icons/nav_arrow.png"></a>
				<ul class="m_sub_nav" style="display:<?=(in_array($_page, $_page_config["m1"]) ? "block" : "none")?>">
                    <li><a href="./welcome.php">Welcome Message</a></li>
                    <li><a href="./organizing_committee.php">Organizing Committee</a></li>
                    <li><a href="./overview.php">Overview</a></li>
					<li><a href="./venue.php">Venue</a></li>
					<li><a href="./photo.php">Photo Gallery</a></li>
				</ul>
			</li>
			<li class="m_nav_li">
				<a href="javascript:;" class="<?=(in_array($_page, $_page_config["m2"]) ? "show" : "")?>"><span>Program</span> <img src="./img/icons/nav_arrow.png"></a>
				<ul class="m_sub_nav" style="display:<?=(in_array($_page, $_page_config["m2"]) ? "block" : "none")?>">
					<li><a href="./program_glance.php">Program at a glance</a></li>
					<li><a href="./program_detail.php">Program in Detail</a></li>
					<li><a href="./invited_speaker.php">Invited Speakers</a></li>
				</ul>
			</li>
			<li class="m_nav_li">
				<a href="javascript:;" class="<?=(in_array($_page, $_page_config["m3"]) ? "show" : "")?>"><span>Call for Abstracts</span> <img src="./img/icons/nav_arrow.png"></a>
				<ul class="m_sub_nav" style="display:<?=(in_array($_page, $_page_config["m3"]) ? "block" : "none")?>">
					<li><a href="poster_abstract_submission.php">Submission Guideline</a></li>
					<li><a href="lecture_note_submission.php">Lecture Abstract Guideline</a></li>
				</ul>
			</li>
			<li class="m_nav_li" class="<?=(in_array($_page, $_page_config["m4"]) ? "show" : "")?>">
				<a href="javascript:;"><span>Registration</span> <img src="./img/icons/nav_arrow.png"></a>
				<ul class="m_sub_nav" style="display:<?=(in_array($_page, $_page_config["m4"]) ? "block" : "none")?>">
					<li><a href="registration_guidelines.php">Guidelines</a></li>
					<li><a href="./registration.php">Online Registration</a></li>
				</ul>
			</li>
			<li class="m_nav_li" class="<?=(in_array($_page, $_page_config["m5"]) ? "show" : "")?>">
				<a href="javascript:;"><span>Sponsorship & Exhibition</span> <img src="./img/icons/nav_arrow.png"></a>
				<ul class="m_sub_nav" style="display:<?=(in_array($_page, $_page_config["m5"]) ? "block" : "none")?>">
					<li><a href="sponsor_information.php">Sponsor Information</a></li>
					<li><a href="application.php">Application</a></li>
				</ul>
			</li>
			<li class="m_nav_li" class="<?=(in_array($_page, $_page_config["m6"]) ? "show" : "")?>">
				<a href="javascript:;"><span>Accommodations & Tour</span> <img src="./img/icons/nav_arrow.png"></a>
				<ul class="m_sub_nav" style="display:<?=(in_array($_page, $_page_config["m6"]) ? "block" : "none")?>">
					<li><a href="accommodation.php">Hotel Accommodations</a></li>
					<li><a href="attraction_historic.php">Attractions in Seoul</a></li>
					<li><a href="useful_information.php">Useful Information</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".logout_btn").on("click", function(){
		$.ajax({
			url : PATH+"ajax/client/ajax_member.php",
			type : "GET",
			data : {
				flag : "logout"
			},
			dataType : "JSON",
			success : function(){
				window.location.replace(PATH);
			},
			error : function(){
				alert("일시적으로 로그아웃 요청이 거절되었습니다.");
			}
		});
	});
});
</script>