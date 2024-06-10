<!doctype html>
<html lang="ko-KR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, shrink-to-fit=no, viewport-fit=cover" />
    <title>IMCVP 2024</title>

    <meta property="og:type" content="website">
    <meta property="og:title" content="IMCVP 2024">
    <meta property="og:image" content="/main/img/2024_imcvp_og_img.png" />
    <meta property="og:description" content="2024 IMCVP hosted by KSCP">
    <meta name="description" content="2024 IMCVP hosted by KSCP">
	<link rel="icon" href="../../favicon.ico">

    <!-- datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <!-- slick -->
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" /> -->
	<!-- slick -->
	<link rel="stylesheet" type="text/css" href="/main/js/slick/slick/slick.css" />  
	<!-- [240502] sujeong / theme 넣을 경우 css 깨짐 -->
    <!-- <link rel="stylesheet" type="text/css" href="/main/js/slick/slick/slick-theme.css" />-->

	<!-- Google font -->
    <link rel="stylesheet" href="https://use.typekit.net/uwj4our.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/main/css/common.css?ver=<?= time() ?>">
    <link rel="stylesheet" href="/main/css/style.css?ver=<?= time() ?>">
    <link rel="stylesheet" href="/main/css/style2.css?ver=<?= time() ?>">
    <link rel="stylesheet" href="/main/css/style3.css?ver=<?= time() ?>">
    <link rel="stylesheet" href="/main/css/style4.css?ver=<?= time() ?>">

    <script src="/main/js/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

	<!-- [240502] sujeong / theme 넣을 경우 css 깨짐 -->
	<!-- <script src="/main/js/slick/slick/slick.js"></script> -->
    <script src="/main/js/slick/slick/slick.min.js" ></script>
	
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="/main/js/style.js?ver=<?= time() ?>"></script>
    <script src="/main/js/config.js"></script>
    <script src="/main/js/common.js?ver=<?= time() ?>"></script>
    <script src="/main/js/en.js?ver=<?= time() ?>"></script>
    <script src="/main/js/ko.js?ver=<?= time() ?>"></script>
    <script src="/main/js/lang.js"></script>
    <script src="/main/js/jquery.zoomooz.min.js"></script>
    <script src="/main/js/locale.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KFWND9W0F8"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-KFWND9W0F8');
    </script>
</head>

<body>
    <?php
//[240125] sujeong / 주석 -> 초록 editor 가 에러로 돌아가는 코드라서...주석...
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
	if (strpos($_SERVER["PHP_SELF"], "/main/") !== false) {
		include_once("./common/common.php");
	} else {
		include_once("./main/common/common.php");
	}

	
	// 230718 HUBDNC 위치 변경
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

	$_page = str_replace(".php", "", end(explode("/", $_SERVER["REQUEST_URI"])));

	//초록 마감 기간
	$sql_during =    "SELECT
							IF(DATE(NOW()) BETWEEN period_poster_start AND period_poster_end, 'Y', 'N') AS yn
						FROM info_event";
	$during_yn = sql_fetch($sql_during)['yn'];

	//오늘 날짜 구하기 d_day 구하기
	$today = date("Y. m. d.");
	$d_day = new DateTime("2024-11-29");

	$current_date = new DateTime();
	$current_date->format('Y-m-d');

	$intvl = $current_date->diff($d_day);
	$d_days = $intvl->days ;
?>