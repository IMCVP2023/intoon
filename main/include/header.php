<?php
$language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
$locale = locale($language);

?>
<!-- 220308 HUBDNC LJH 추가 -->
<header class="blue_header">
    <div class="g_h_top">
        <div class="container">
            <div class="dday_wrap">
                <div class="dday_top"><span>D+<?= number_format($d_days); ?></span></div>
                <div class="dday_bot">Today is <span><?= $today; ?></span></div>
            </div>
            <!-- <div class="text_center g_h_logo"><img src="/main/img/icon_logo2.svg" alt="" class="pointer" onClick="javascript:location.href='/main/index.php'"></div> -->
            <div class="g_h_logo"><img src="/main/img/icon_logo_blue.svg" alt="" class="pointer"
                    onClick="javascript:location.href='/main/index.php'"></div>
            <ul class="g_h_tool">
                <!-- <li><a href="/main/index.php">Home</a></li> -->
                <?php
                if ($_SESSION["USER"]["idx"] == "") {
                ?>
                <li><a href="/main/login.php">Log in</a></li>
                <li><a href="/main/signup.php">Sign up</a></li>
                <?php
                } else {
                ?>
                <li><a href="/main/mypage.php">My page</a></li>
                <li><a class="logout_btn" href="javascript:;">Logout</a></li>
                <?php
                }
                ?>
                <!-- <li><a href="https://www.lipid.or.kr/">Go to KSoLA</a></li> -->
                <li><a href="https://www.kosso.or.kr/">KSSO</a></li>
            </ul>
            <div class="mb_g_h_tool">
                <ul>
                    <?php
                    if ($_SESSION["USER"]["idx"] == "") {
                    ?>
                    <li><a href="/main/login.php">Log in</a></li>
                    <li><a href="/main/signup.php">Sign up</a></li>
                    <?php
                    } else {
                    ?>
                    <li><a href="/main/mypage.php">My page</a></li>
                    <li><a class="logout_btn" href="javascript:;">Logout</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="https://www.kosso.or.kr/eng/">KSSO</a></li>
                </ul>
                <div>
                    <button type="button" class="m_nav_btn"><img src="/main/img/icons/m_nav.png"></button>
                </div>
            </div>
            <!-- <div class="mb_g_h_tool tablet_show">
				<ul>
					<li><a href="/main/login.php">Log in</a></li>
					<li><a href="/main/signup.php">Sign up</a></li>
					<li><a href="https://www.kosso.or.kr/eng/">KSSO</a></li>
				</ul>
				<button type="button" class="m_nav_btn"><img src="/main/img/icons/m_nav.png"></button>
			</div> -->
        </div>
    </div>
    <div class="g_h_bottom">
        <div class="container">
            <div class="nav_wrap pc_only">
                <ul class="depth01 clearfix">
                    <li>
                        <a href="/main/welcome.php">ICOMES 2023</a>
                        <ul class="sub_nav">
                            <li><a href="/main/welcome.php">Welcome Message</a></li>
                            <li><a href="/main/organizing_committee.php">Organization</a></li>
                            <li><a href="/main/overview.php">Overview</a></li>
                            <!-- <li><a href="/main/venue.php">Venue</a></li> -->
                            <li><a href="/main/photo.php">Photo Gallery</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/main/program_glance.php">Program</a>
                        <ul class="sub_nav">
                            <li><a href="/main/program_glance.php">Program at a Glance</a></li>
                            <li>
                                <!-- <a href="/main/program_detail.php">Program in Detail</a> -->
                            </li>
                            <li><a href="/main/program_detail.php">Scientific Program</a></li>
                            <li><a href="/main/invited_speaker.php">Invited Speakers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/main/abstract_submission_guideline.php">Abstracts</a>
                        <ul class="sub_nav">
                            <!-- <li><a href="/main/abstract_submission_guideline.php">Abstract Submission</a></li> -->
                            <!-- <li><a href="/main/lecture_note_submission.php">Lecture Note Submission</a></li> -->
                            <li>
                                <!-- <a href="/main/abstract_submission_guideline.php">Abstract Submission Guideline</a> -->
                            </li>
                            <li><a href="/main/abstract_submission_guideline.php">Submission Guidelines</a></li>
                            <li><a href="/main/abstract_submission.php" class="online_submission_alert">Online
                                    Submission</a></li>
                            <li><a href="/main/abstract_submission_oral.php">Presentation Guidelines</a></li>
                            <!-- <li><a href="/main/abstract_submission_exhibition.php">Poster Exhibition</a></li> -->
                            <li><a href="/main/abstract_submission_award.php">Awards & Grants</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/main/registration_guidelines.php">Registration</a>
                        <ul class="sub_nav">
                            <li><a href="/main/registration_guidelines.php">Registration Guidelines
                                </a></li>
                            <li><a href="/main/registration.php" class="online_registration_alert">Online Registration</a></li>
                            <li><a href="/main/registration_rating_guides.php">평점 안내</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/main/sponsor.php">Sponsorship</a>
                        <ul class="sub_nav">
                            <li><a href="/main/sponsor.php">Sponsorship</a></li>
                            <li><a href="/main/sponsor_exhibition.php">Exhibition</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/main/venue.php">Venue</a>
                        <ul class="sub_nav">
                            <li><a href="/main/venue.php">Conrad Seoul</a></li>
                            <li><a href="/main/accommodation.php">Accommodation</a></li>
                            <li><a href="/main/floor_plan.php">Floor Plan</a></li>
                            <!-- <li><a href="/main/venue.php">Transportation</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="/main/board_notice.php">Information</a>
                        <ul class="sub_nav">
                            <li><a href="/main/board_notice.php">Notice</a></li>
                            <li><a href="/main/board_newsletter.php">Newsletter</a></li>
                            <!-- <li><a href="/main/accommodation.php">Accommodation</a></li> -->
                            <!-- <li><a href="/main/attraction_historic.php">Attractions in Seoul</a></li> -->
                            <!--/main/attraction_historic.php-->
                            <li><a href="/main/useful_information.php">Useful Information</a></li>
                            <!--useful_information.php-->
                            <li><a href="/main/visa.php">VISA & K-ETA</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="gnb_dim"></div>

<div class="nav_dim"></div>
<!-- 220308 HUBDNC LJH 추가 : 끝-->

<script>
$(document).ready(function() {
    $(".not_yet").click(function() {
        alert("Coming soon.")
    });

    $(".online_submission_alert").click(function(event) {
        event.preventDefault();
        alert("The abstract submission has expired.\nAbstract submission is not available.");

        let parent = event.target.parentElement.parentElement;

        if(parent.classList.contains('m_sub_nav')){
            parent.style.display = 'block';
        }

        return false;
    });

    $(".online_registration_alert").click(function(event) {
        event.preventDefault();
        alert("The registration has expired.\nOnline registration is not available.");

        let parent = event.target.parentElement.parentElement;

        if(parent.classList.contains('m_sub_nav')){
            parent.style.display = 'block';
        }

        return false;
    });
});
</script>

<div class="m_nav_wrap">
    <!--
	<div class="toggle_wrap clearfix <?= $language == "en" ? "" : "left" ?>">
		<input type="radio" value="kor" name="m_language" id="m_kor" <?= ($language == "ko" ? "checked" : "") ?>>
		<label for="m_kor"><?= $locale("korean") ?></label>
		<div class="toggle">
			<div class="toggle__pointer"></div>
		</div>
		<input type="radio" value="eng" name="m_language" id="m_eng" <?= ($language != "ko" ? "checked" : "") ?>>
		<label for="m_eng"><?= $locale("english") ?></label>
	</div>
	-->
    <div class="m_nav_top">
        <img src="/main/img/icon_logo_blue.svg" alt="" class="pointer logo"
            onclick="javascript:location.href='/main/index.php'">
        <button type="button" class="n_nav_close"><img src="/main/img/icons/m_nav_close.svg"></button>
    </div>
    <div class="m_nav">
        <ul class="m_nav_ul">
            <li class="m_nav_li">
                <a href="javascript:;" class="<?= (in_array($_page, $_page_config["m1"]) ? "show" : "") ?>"><span>ICOMES
                        2023</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m1"]) ? "block" : "none") ?>">
                    <li><a href="/main/welcome.php">Welcome Message</a></li>
                    <li><a href="/main/organizing_committee.php">Organization</a></li>
                    <li><a href="/main/overview.php">Overview</a></li>

                    <li><a href="/main/photo.php">Photo Gallery</a></li>
                </ul>
            </li>
            <li class="m_nav_li">
                <a href="javascript:;"
                    class="<?= (in_array($_page, $_page_config["m2"]) ? "show" : "") ?>"><span>Program</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m2"]) ? "block" : "none") ?>">
                    <li><a href="/main/program_glance.php">Program at a Glance</a></li>
                    <!-- <li><a href="/main/program_detail.php">Program in Detail</a></li> -->
                    <li><a href="/main/program_detail.php">Scientific Program</a></li>
                    <li><a href="/main/invited_speaker.php">Invited Speakers</a></li>
                </ul>
            </li>
            <li class="m_nav_li">
                <a href="javascript:;"
                    class="<?= (in_array($_page, $_page_config["m3"]) ? "show" : "") ?>"><span>Abstracts</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m3"]) ? "block" : "none") ?>">
                    <!-- <li><a href="poster_abstract_submission.php">Submission Guideline</a></li> -->
                    <!-- <li><a href="lecture_note_submission.php">Lecture Abstract Guideline</a></li> -->
                    <li><a href="/main/abstract_submission_guideline.php">Submission Guidelines</a></li>
                    <!-- <li><a href="/main/lecture_note_submission.php">Lecture Note Submission</a></li> -->
                    <li><a href="/main/abstract_submission.php" class="online_submission_alert">Online Submission</a>
                    </li>
                    <li><a href="/main/abstract_submission_oral.php">Presentation Guidelines</a></li>
                    <li><a href="/main/abstract_submission_award.php">Awards & Grants</a></li>
                </ul>
            </li>
            <li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m4"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Registration</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m4"]) ? "block" : "none") ?>">
                    <li><a href="/main/registration_guidelines.php">Registration Guidelines</a></li>
                    <li><a href="/main/registration.php">Online Registration</a></li>
                    <li><a href="/main/registration_rating_guides.php">평점 안내</a></li>
                </ul>
            </li>
            <li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m5"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Sponsorship</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m5"]) ? "block" : "none") ?>">
                    <li><a href="/main/sponsor.php">Sponsorship</a></li>
                    <li><a href="/main/sponsor_exhibition.php">Exhibition</a></li>
                    <!-- <li><a href="application.php">Application</a></li> -->
                </ul>
            </li>
            <li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m7"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Venue</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m7"]) ? "block" : "none") ?>">
                    <li><a href="/main/venue.php">Conrad Seoul</a></li>
                    <li><a href="/main/accommodation.php">Accommodation</a></li>
                    <li><a href="/main/floor_plan.php">Floor Plan</a></li>
                </ul>
            </li>
            <li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m6"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Information</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m6"]) ? "block" : "none") ?>">
                    <!-- <li><a href="/main/accommodation.php">Accommodation</a></li> -->
                    <!-- <li><a href="/main/attraction_historic.php">Attractions in Seoul</a></li> -->
                    <li><a href="/main/board_notice.php">Notice</a></li>
                    <li><a href="/main/board_newsletter.php">Newsletter</a></li>
                    <li><a href="/main/useful_information.php">Useful Information</a></li>
                    <li><a href="/main/visa.php">VISA & K-ETA</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!--
    <div class="m_nav">
        <ul class="m_nav_ul">
            <li class="m_nav_li">
                <a href="javascript:;" class="<?= (in_array($_page, $_page_config["m1"]) ? "show" : "") ?>"><span>General
                        Information</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m1"]) ? "block" : "none") ?>">
                    <li><a href="/main/welcome.php">Welcome Message</a></li>
                    <li><a href="/main/organizing_committee.php">Organization</a></li>
                    <li><a href="/main/overview.php">Overview</a></li>
                    <!-- <li><a href="/main/venue.php">Venue</a></li>
                    <li><a href="/main/photo.php">Photo Gallery</a></li>
                </ul>
            </li>
            <li class="m_nav_li">
                <a href="javascript:;" class="<?= (in_array($_page, $_page_config["m2"]) ? "show" : "") ?>"><span>Program</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m2"]) ? "block" : "none") ?>">
                    <li><a href="/main/program_glance.php">Program at a Glance</a></li>
                    <!-- <li><a href="/main/program_detail.php">Program in Detail</a></li>
                    <li><a href="/main/program_detail.php">Scientific Program</a></li>
                    <li><a href="/main/invited_speaker.php">Invited Speakers</a></li>
                </ul>
            </li>
            <li class="m_nav_li">
                <a href="javascript:;" class="<?= (in_array($_page, $_page_config["m3"]) ? "show" : "") ?>"><span>Abstracts</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m3"]) ? "block" : "none") ?>">
                    <!-- <li><a href="poster_abstract_submission.php">Submission Guideline</a></li> -->
    <!-- <li><a href="lecture_note_submission.php">Lecture Abstract Guideline</a></li> 
                    <li><a href="/main/abstract_submission_guideline.php">Submission Guidelines</a></li>
                    <!-- <li><a href="/main/lecture_note_submission.php">Lecture Note Submission</a></li>
					<li><a href="/main/abstract_submission.php" class="online_submission_alert">Online Submission</a></li>
					<li><a href="/main/abstract_submission_oral.php">Presentation Guidelines</a></li>
					<li><a href="/main/abstract_submission_award.php">Awards & Grants</a></li>
                </ul>
            </li>
            <li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m4"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Registration</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m4"]) ? "block" : "none") ?>">
                    <li><a href="/main/registration_guidelines.php">Registration Guidelines</a></li>
                    <li><a href="/main/registration.php">Online Registration</a></li>
					<li><a href="/main/registration_rating_guides.php">평점 안내</a></li>
                </ul>
            </li>
            <li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m5"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Sponsorship</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m5"]) ? "block" : "none") ?>">
                    <li><a href="/main/sponsor.php">Sponsorship</a></li>
                    <li><a href="/main/sponsor_exhibition.php">Exhibition</a></li>
                    <!-- <li><a href="application.php">Application</a></li>
                </ul>
            </li>
			<li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m7"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Venue</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m7"]) ? "block" : "none") ?>">
                    <li><a href="/main/venue.php">Conrad Seoul</a></li>
                    <li><a href="/main/accommodation.php">Accommodation</a></li>
					<li><a href="/main/floor_plan.php">Floor Plan</a></li>
                </ul>
            </li>
            <li class="m_nav_li" class="<?= (in_array($_page, $_page_config["m6"]) ? "show" : "") ?>">
                <a href="javascript:;"><span>Information</span></a>
                <ul class="m_sub_nav" style="display:<?= (in_array($_page, $_page_config["m6"]) ? "block" : "none") ?>">
                    <!-- <li><a href="/main/accommodation.php">Accommodation</a></li> -->
    <!-- <li><a href="/main/attraction_historic.php">Attractions in Seoul</a></li>
					<li><a href="/main/board_notice.php">Notice</a></li>
					<li><a href="/main/board_newsletter.php">Newsletter</a></li>
                    <li><a href="/main/useful_information.php">Useful Information</a></li>
                    <li><a href="/main/visa.php">VISA & K-ETA</a></li>
                </ul>
            </li>
        </ul>
    </div> -->
</div>
<input type="hidden" value="<?= $during_yn ?>" name="during_yn">
<script>
$(document).ready(function() {
    $(".logout_btn").on("click", function() {
        if (PATH == "./") {
            path_content = "/main/";
        } else {
            path_content = PATH;
        }

        $.ajax({
            url: path_content + "ajax/client/ajax_member.php",
            type: "GET",
            data: {
                flag: "logout"
            },
            dataType: "JSON",
            success: function() {
                window.location.replace(PATH);
            },
            error: function() {
                alert("일시적으로 로그아웃 요청이 거절되었습니다.");
            }
        });
    });

    /* 220308 HUBDNC LJH2 추가 */
    var header_height = $(".header").outerHeight();
    $(".depth2").css("top", header_height);
    $(".gnb li, .depth2 li").mouseenter(function() {
        $(".gnb li").removeClass("on");
        $(this).addClass("on");
        $(this).parents("li").addClass("on");
    });
});

/* 220308 HUBDNC LJH2 추가 */
var header_height = $(".header").outerHeight();
$(".depth2").css("top", header_height);
$(".gnb li, .depth2 li").mouseenter(function() {
    $(".gnb li").removeClass("on");
    $(this).addClass("on");
    $(this).parents("li").addClass("on");
});

/* 220314 HUBDNC LJH2 추가 */
$(".gnb > li, .depth2").hover(function() {
    $(".depth2").css("height", "100%");
}, function() {
    $(".depth2").css("height", "0");
})

// $(".online_submission_alert").click(function() {
//     var during_yn = $("input[name=during_yn]").val();
//     if (during_yn !== 'Y') {
//         alert("The abstract submission deadline has expired and submission is not possible.");
//         return false;
//     }
// });
</script>