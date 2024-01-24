<?php
include_once('./include/head.php');
include_once('./include/header.php');

// key date
$sql_key_date =    "SELECT
						idx, `key_date`, contents_" . $language . " AS contents
					FROM key_date
					WHERE `type` = 'lecture'
					AND `key_date` <> '0000-00-00'
					ORDER BY idx";

$key_date = get_data($sql_key_date);

// info
$sql_info = "SELECT
					note_msg_" . $language . " AS note_msg,
					formatting_guidelines_" . $language . " AS formatting_guidelines,
					how_to_modify_" . $language . " AS how_to_modify
				FROM info_lecture";
$info = sql_fetch($sql_info);

?>
<section class="abstract_submission_guideline container abstract_presentation_guideline">
    <h1 class="page_title">Presentation Guidelines</h1>
    <div class="inner">
        <ul class="tab_green long presentation">
            <li><a href="./abstract_submission_oral.php">Oral Presentation</a></li>
            <li class="on"><a href="./abstract_submission_poster.php">Guided Poster Presentation</a></li>
            <li><a href="./abstract_submission_exhibition.php">Poster Exhibition</a></li>
        </ul>
        <div class="section section1">
            <?php
            if (count($key_date) > 0) {
                $weekday = ["일", "월", "화", "수", "목", "금", "토"];
            ?>
            <!--List of Accepted Abstract-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title">List of Accepted Abstract</h3>
                </div>
                <div class="list_accepted_abstract_btn">
					<button type="button" onClick="javascript:window.open('./download/Oral Presentation_0830.pdf')"><img src="./img/icons/download_w.svg" />Oral Presentation</button>
					<button type="button" onClick="javascript:window.open('./download/Guided Poster Presentation_0817.pdf')"><img src="./img/icons/download_w.svg" />Guided Poster Presentation</button>
					<button type="button" onClick="javascript:window.open('./download/Poster Exhibition_0817_v2.pdf')"><img src="./img/icons/download_w.svg" />Poster Exhibition</button>
                </div>
            </div>
            <!--keydate-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title">Key Dates</h3>
                </div>
                <div class="table_wrap detail_table_common">
                    <table class="c_table detail_table">
                        <colgroup>
                            <col class="submission_col">
                            <col>
                        </colgroup>
                        <tr>
                            <th>Abstract Submission System Open</th>
                            <td class="f_bold">Mid-May</td>
                        </tr>
                        <tr>
                            <th class="close_th">Abstract Submission Deadline</th>
                            <td><span class="font_inherit red_t f_bold">August 10 (Thu)</span></td>
                        </tr>
                        <tr>
                            <th>Notification of Abstract Acceptance</th>
                            <td class="f_bold">August 14 (Mon)</td>
                        </tr>
                        <tr>
                            <th>Registration Deadline for Approved Abstract Presenters</th>
                            <td class="f_bold">August 24 (Thu)</td>
                        </tr>
                    </table>
                </div>
            </div>
			<!--session information-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title">Session Information</h3>
                </div>
                <div class="table_wrap detail_table_common x_scroll">
                     <table class="c_table detail_table ">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <tr>
                            <th class="f_bold text_center">Session</th>
                            <th class="f_bold text_center">Guided Poster Presentation 1</th>
                            <th class="f_bold text_center">Guided Poster Presentation 2</th>
                        </tr>
						<tr>
							<td class="text_center">Date & Time</td>
							<td class="text_center">13:00-14:00, Sep. 8(Fri)</td>
							<td class="text_center">12:50-13:50, Sep. 9(Sat)</td>
						</tr>
						<tr>
							<td class="text_center">Location</td>
							<td class="text_center">Room 7, 6F</td>
							<td class="text_center">Room 7, 6F</td>
						</tr>
                    </table>
                </div>
            </div>
			<!--Language & Length of Presentation-->
			<div>
				<div class="section_title_wrap2">
					<h3 class="title">Language & Length of Presentation</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li>• Language: English</li>
						<li>• Each presenter will be given 10 minutes. (7 minutes talk / 3 minutes Q&A)</li>
					</ul>
				</div>
			</div>
			<!--Submission of Presentation Material-->
			<div>
				<div class="section_title_wrap2">
					<h3 class="title">Submission of Presentation Material</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li>• The ICOMES secretariat will be responsible for the printing and displaying of posters on behalf of the presenter.</li>
						<li>• All presenters of posters must submit their final presentation materials, including PPT and PDF formats, to the secretariat via email <a href="mailto:icomes_abstracts@into-on.com" class="parentheses">(<span class="font_inherit link">icomes_abstracts@into-on.com</span>)</a> before the deadline of <span class="f_bold italic">August 24 (Thu).</span></li>
						<li class="f_bold">• Please download the designated poster form below.</li>
						<li>• If presenters fail to submit their posters before the designated deadlines, they may face penalties such as automatic withdrawal of their accepted abstracts. Therefore, it is strongly advised that presenters keep this in mind and submit their posters in a timely manner.</li>
					</ul>
				</div>
				<div class="text_center btn_box mt25">
					<a href="./download/ICOMES_2023_Poster_template.pptx" class="btn long_btn" target="_blank" download><img src="./img/icons/icon_download_white.svg" alt="">Poster Form Download</a>
					<!--
                    <a href="javascript:;" class="btn long_btn type2" target="_blank" download="">
						Poster Form Download<img src="./img/icons/icon_download_yellow.svg" alt="">
					</a> -->
                </div>
			</div>
			<!--Poster Panel-->
			<div class="poster_panel">
				<div class="section_title_wrap2">
					<h3 class="title">Poster Panel</h3>
				</div>
				<div class="text_box indent">
					<img src="./img/poster_panel.png" alt="Poster Panel">
					<ul>
						<li>• Poster Panel Size: W100 x H250</li>
						<li>• Paper Size: A0 (W84.1 X H118.9)</li>
					</ul>
				</div>
			</div>
            <?php
            }
            ?>
        </div>
    </div>
</section>



<?php include_once('./include/footer.php'); ?>