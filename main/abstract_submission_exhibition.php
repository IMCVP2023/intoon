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
		<h1 class="page_title">Call for Abstract
			<div class="sub_btn_box">
				<a href="/main/abstract_submission_guideline.php">Abstract Submission Guidelines</a>
				<a href="/main/abstract_submission.php">Online submission</a>
				<a href="/main/abstract_submission_oral.php" class="on">Presentation Guidelines</a>
				<a href="/main/abstract_submission_award.php">Awards & Grants</a>
				
				<!-- <a href="/main/abstract_submission_oral.php" class="on">Presentation Guidelines</a>
				<a href="/main/abstract_submission_award.php">Awards & Grants</a> -->
			</div>
		</h1>
    <div class="inner">
        <div class="type_btn_box exhibition">
            <div class="" onclick="window.location.href='/main/abstract_submission_oral.php'">Poster oral</div>
            <div class="exhibition" onclick="window.location.href='/main/abstract_submission_exhibition.php'">Poster exhibitions</div>
        </div>
       
        <div class="section section1">
            <?php
            if (count($key_date) > 0) {
                $weekday = ["일", "월", "화", "수", "목", "금", "토"];
            ?>
            <!--List of Accepted Abstract-->
            <!-- <div>
                <div class="section_title_wrap2">
                    <h3 class="title">List of Accepted Abstract</h3>
                </div>
                <div class="list_accepted_abstract_btn">
					<button type="button" onClick="javascript:window.open('./download/Oral Presentation_0830.pdf')"><img src="./img/icons/download_w.svg" />Oral Presentation</button>
					<button type="button" onClick="javascript:window.open('./download/Guided Poster Presentation_0817.pdf')"><img src="./img/icons/download_w.svg" />Guided Poster Presentation</button>
					<button type="button" onClick="javascript:window.open('./download/Poster Exhibition_0817_v2.pdf')"><img src="./img/icons/download_w.svg" />Poster Exhibition</button>
                </div>
            </div> -->
            <!--keydate-->
            <!-- <div>
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
            </div> -->
			<!--Schedule of Poster Exhibition-->
            <!-- <div>
                <div class="section_title_wrap2">
                    <h3 class="title">Schedule of Poster Exhibition</h3>
                </div>
                <div class="table_wrap detail_table_common x_scroll">
				   <table class="c_table detail_table">
					   <colgroup>
						   <col>
						   <col>
						   <col>
					   </colgroup>
					   <tr>
						   <th></th>
						   <th class="f_bold text_center">Sep. 8(Fri)</th>
						   <th class="f_bold text_center">Sep. 9 (Sat)</th>
					   </tr>
					<tr>
						<td class="text_center">Location</td>
						<td class="text_center">Poster Zone, 6F</td>
						<td class="text_center">Poster Zone, 6F</td>
					</tr>
					<tr>
						<td class="text_center">Time</td>
						<td class="text_center">07:30 - 18:00</td>
						<td class="text_center">07:30 - 17:00</td>
					</tr>
				   </table>
                </div>
            </div>
			<p class="mt10">* September 7th is closed for poster installation. </p> -->
			<!--Submission of Presentation Material-->
			<!-- <div>
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
                </div>
			</div> -->
			<!--Poster Panel-->
			<div class="poster_panel">
				<div class="section_title_wrap2">
					<h3 class="title">Poster Panel</h3>
				</div>
				<div class="text_box indent">
					<img src="./img/poster_panel.png" alt="Poster Panel">
					<ul>
						<li>• Poster Panel Size: W100 x H250 cm</li>
						<li>• Paper Size: A0 (W84.1 X H118.9 cm)</li>
					</ul>
				</div>
			</div>

			<!--Poster Template-->
			<div class="poster_panel">
				<div class="section_title_wrap2">
					<h3 class="title">Poster Template</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li class="underline">• Please use the official IMCVP2024 template.</li>
						<button class="template" onClick="javascript:window.open('./download/IMCVP2024_Poster_template.pptx')">Poster template</button>
					</ul>
				</div>
			</div>

			<div>
				<div class="section_title_wrap2">
					<h3 class="title">Schedule for Affixation & Removal</h3>
				</div>
				<table class="c_table2 detail_table type2">
					<tr>
						<th>Date</th>
						<td>November 29th (Friday) – November 30th (Saturday)</td>
					</tr>
					<tr>
						<th>Venue</th>
						<td>Grandball Room, Exhibition & Poster Zone (B1)</td>
					</tr>
					<tr>
						<th>Affixation</th>
						<td>November 29th (Friday) – 09:00 ~</td>
					</tr>
					<tr>
						<th>Removal</th>
						<td>November 30th (Saturday) – 16:00 ~ 17:00</td>
					</tr>
				</table>
				<div class="text_box indent">
					<ul>
						<li>• All presenters are requested to affix and remove posters on the appropriate dates and time as indicated.</li>
						<li>• Each poster will be provided with 1 panel.</li>
					</ul>
				</div>
			</div> 

			<div>
				<div class="section_title_wrap2">
					<h3 class="title">Regulations</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li>• Posters should be readable by viewers from 1.5 meters away. The poster title, author(s)'s name(s) and affiliation(s) should appear on the top. The message should be clear and understandable without oral explanation.</li>
						<li>• Posters should be able to show the main content or the main results of the research.</li>
						<li>• 3M Double-sided tapes and adhesive tapes will be available to attach your poster to the panel.<br/>(The tapes will be provided on the site.)</li>
						<li>• All presenters should remove posters at the removal time. Otherwise, the remaining posters will be removed by staff without notice and the organizing committee will not take responsibilities for any damages or losses of the posters.</li>
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