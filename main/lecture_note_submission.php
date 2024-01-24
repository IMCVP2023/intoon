<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	// key date
	$sql_key_date =	"SELECT
						idx, `key_date`, contents_".$language." AS contents
					FROM key_date
					WHERE `type` = 'lecture'
					AND `key_date` <> '0000-00-00'
					ORDER BY idx";
	$key_date = get_data($sql_key_date);

	// info
	$sql_info = "SELECT
					note_msg_".$language." AS note_msg,
					formatting_guidelines_".$language." AS formatting_guidelines,
					how_to_modify_".$language." AS how_to_modify
				FROM info_lecture";
	$info = sql_fetch($sql_info);

?>

<section class="container lecture_guideline">
    <div class="inner">
        <h1 class="page_title">Lecture Note Submission</h1>
        <ul class="tab_green">
            <li class="on"><a href="">Lecture Note Submission Guideline</a></li>
            <li><a href="./lecture_submission.php" class="online_submission_alert">Online Submission</a></li>
            <!--
			<li><a href="javascript:;" class="btn active"><?=$locale("lecture_menu1")?></a></li>
			<li><a href="./lecture_submission.php" class="btn"><?=$locale("lecture_menu2")?></a></li>
			<li><a href="./oral_presenters.php" class="btn"><?=$locale("lecture_menu3")?></a></li>
			<li><a href="./eposter_presenters.php" class="btn"><?=$locale("lecture_menu4")?></a></li> -->
        </ul>
        <div class="section section1">
            <!-- 1. Message | start -->
            <div class="details">
                <!-- <?=htmlspecialchars_decode(strip_tags($info['note_msg']))?> -->
                <img class="coming" src="./img/coming.png" />
            </div>
            <!-- 1. Message | end -->

            <!-- 6. Speakers Preview room | end -->


        </div>
    </div>
    <!-- <button type="button" class="fixed_btn" onclick="window.location.href='./lecture_submission.php';"><?=$locale("invited_speakers_btn")?></button> -->
</section>

<?php include_once('./include/footer.php');?>