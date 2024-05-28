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
<section class="abstract_submission_guideline container abstract_presentation_guideline top_btn_move">
        <h1 class="page_title">Call for Abstract
			<div class="sub_btn_box">
				<a href="/main/abstract_submission_guideline.php">Abstract Submission Guidelines</a>
				<a href="/main/abstract_submission.php">Online submission</a>
				<a href="/main/abstract_submission_oral.php" class="on">Presentation Guidelines</a>
				<a href="/main/abstract_submission_award.php">Awards & Grants</a>
			</div>
		</h1>
    <div class="inner">
        <div class="type_btn_box">
            <div class="oral">Poster oral</div>
            <div>Poster exhibitions</div>
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
					<button type="button" onClick="javascript:window.open('./download/Guided Poster Presentation_0824.pdf')"><img src="./img/icons/download_w.svg" />Guided Poster Presentation</button>
					<button type="button" onClick="javascript:window.open('./download/Poster Exhibition_0824.pdf')"><img src="./img/icons/download_w.svg" />Poster Exhibition</button>
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
			<!--session information-->
            <!-- <div>
                <div class="section_title_wrap2">
                    <h3 class="title">Session Information</h3>
                </div>
                <div class="table_wrap detail_table_common x_scroll">
                     <table class="c_table">
                        <colgroup>
                            <col class="submission_col">
                            <col>
                        </colgroup>
                        <tr>
                            <th class="centerT f_bold text_center">Session</th>
                            <th class="centerT f_bold">Oral Presentation 1</th>
                            <th class="centerT f_bold">Oral Presentation 2</th>
                            <th class="centerT f_bold">Oral Presentation 3</th>
                            <th class="centerT f_bold">Oral Presentation 4</th>
                        </tr>
						<tr>
							<td class="text_center">Date & Time</td>
							<td class="text_center">13:00-14:00, Sep. 8 (Fri)</td>
							<td class="text_center">13:00-14:00, Sep. 8 (Fri)</td>
							<td class="text_center">12:50-13:50, Sep. 9 (Sat)</td>
							<td class="text_center">12:50-13:50, Sep. 9 (Sat)</td>
						</tr>
						<tr>
							<td class="text_center">Location</td>
							<td class="text_center">Room 4, 5F</td>
							<td class="text_center">Room 5, 5F</td>
							<td class="text_center">Room 4, 5F</td>
							<td class="text_center">Room 5, 5F</td>
						</tr>
                    </table>
                </div>
            </div> -->
			<!--Length of Presentation-->
			<div>
				<div class="section_title_wrap2">
					<h3 class="title">Presentation Length</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li>• Each presenter will be given 10 minutes.</li>
						<li>• When the 7-minute presentation ends, a Question and Answer session for participants with the panel and the presenter will follow for 3 minutes.</li>
						<li class="red_t">※ Each individual presenter should take no more than 10 minutes to present. The slide show will end after passing the designated time.</li>
					</ul>
				</div>
			</div>

            <!-- Language  -->

            <div>
				<div class="section_title_wrap2">
					<h3 class="title">Language</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li>• The presentation should be in English, which is the official language of the IMCVP 2024.</li>
					</ul>
				</div>
			</div>


			<!--Preview Room-->
			<div>
				<div class="section_title_wrap2">
					<h3 class="title">Preview Room</h3>
					<p>
                    All speakers must visit the Preview Room to check and upload their presentation files ahead of their session.
					</p>
				</div>
				<!-- <div class="table_wrap detail_table_common">
                       <table class="c_table detail_table">
                           <colgroup>
                               <col>
                               <col>
                               <col>
                           </colgroup>
                           <tr>
                               <th></th>
                               <th class="f_bold text_center">Sep. 8 (Fri)</th>
                               <th class="f_bold text_center">Sep. 9 (Sat)</th>
                           </tr>
						<tr>
							<td class="text_center">Park Studio, 5F</td>
							<td class="text_center">Park Studio, 5F</td>
						</tr>
						<tr>
							<td class="text_center">Operating Hour</td>
							<td class="text_center">07:30 - 18:00</td>
							<td class="text_center">07:30 - 17:00</td>
						</tr>
                       </table>
                   </div> -->
			</div>
			<!--Presentation File-->
			<div>
				<div class="section_title_wrap2">
					<h3 class="title">Presentation File</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li>• Authors should bring the presentation file in a USB memory stick to the preview room to upload onto the common storage device.</li>
						<li>• Lectures should prepare the presentation file in MS PowerPoint in English. And please use only basic fonts for your presentation (e.g. Arial, Times New Roman), as usage of unusual fonts may not be displayed properly. If you must have special fonts on your slide files, please bring the font file as well.</li>
						<li>• Technical staff will be available to assist you in uploading and testing your presentation file. No one other than the presenters will have access to the presentation file once it is loaded into the preview system.</li>
						<li>• If you do not visit the preview room before your presentation for any urgent reason, you will be responsible for loading your file onto the PC in the session room directly.</li>
					</ul>
				</div>
			</div>
			<!--Audio/Visual Guidelines -->
            <div>
				<div class="section_title_wrap2">
					<h3 class="title">Audio/Visual Guidelines</h3>
				</div>
				<div class="text_box indent">
					<ul>
						<li>• Each session room will be equipped with an LCD projector, and a computer running <span class="violet_t">Windows 10 and PowerPoint 2016</span> for your presentation. We recommend you to prepare the presentation slide with 16:9 aspect of ratio. If you must inevitably use your own laptop, you should bring it to the session room at least 60 minutes before the session begins 
                        </li>
					</ul>
				</div>
			</div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<button type="button" class="btn_fixed_triangle fixed_btn_pc" onClick="location.href='./registration.php'">
    <img src="/main/img/icons/2024_abstract_icon.svg"/>
</button>


<?php include_once('./include/footer.php'); ?>