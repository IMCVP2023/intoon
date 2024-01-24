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
<section class="abstract_submission_guideline container">
    <h1 class="page_title">Submission Guidelines</h1>
    <div class="inner">
        <ul class="tab_green long abstract_submission">
            <li class="on"><a href="./abstract_submission_guideline.php">Submission Guidelines</a></li>
            <li><a href="./abstract_submission.php" class="online_submission_alert">Online Submission</a></li>
            <!-- <li><a href="./abstract_submission_oral.php">Oral Presenters</a></li> -->
            <!-- <li><a href="./abstract_submission_exhibition.php">Poster Exhibition</a></li> -->
            <li><a href="./abstract_submission_award.php">Awards & Grants</a></li>
        </ul>
        <div class="section section1">
            <div>
                <div class="text_box">
                    <ul>
                        <li>The ICOMES 2023 organizing committee cordially invites you to submit abstracts for oral presentations, poster exhibitions, and guided poster presentations. </li>
                        <li>All abstracts must be submitted via the online submission system. <br/>Please read the guidelines before submitting your abstract(s).</li>
                        <!--
						<li class="f_bold">• If you are selected by submitting an abstract, 100% of the registration fee can be reduced.</li>
						<li>• The reduction is based on the payment of the pre-registration fee, and only the submitter will receive a refund within 2 weeks after the congress.</li>
						-->
                    </ul>
                </div>
                <div class="text_center btn_box mt25">
                    <!-- <a href="https://image.webeon.net/icomes/ICOMES%202023_Abstract%20template_ver1.docx" class="btn long_btn" target="_blank" download><img src="./img/icons/icon_download_yellow.svg" alt="">Abstract Template Download</a> -->
					<a href="./download/ICOMES_2023_Abstract_form.docx" class="btn long_btn" target="_blank" download><img src="./img/icons/icon_download_white.svg" alt="">Abstract Form Download</a>
                    <a href="./abstract_submission.php" class="btn long_btn yellow_btn online_submission_alert">Go to Abstract Submission</a>
                </div>
                <!-- <a href="./download/ICOMES_2022_Abstract_template.docx" class="btn long_btn" target="_blank"><img src="./img/icons/icon_download_yellow.svg" alt="">Abstract Template Download</a></div> -->
            </div>
            <!-- <div class="details"> -->
            <!-- 	<?= htmlspecialchars_decode(strip_tags($info['note_msg'])) ?> -->
            <!-- </div> -->
            <?php
            if (count($key_date) > 0) {
                $weekday = ["일", "월", "화", "수", "목", "금", "토"];
            ?>
                <!--keydate start-->
                <div>
                    <div class="section_title_wrap2">
                        <h3 class="title"><!--<?= $locale("keydate") ?>-->Key Dates</h3>
                    </div>
                    <div class="table_wrap detail_table_common x_scroll">
						<table class="c_table detail_table td_nowrap_table">
							<colgroup>
								<col class="submission_col">
								<col>
							</colgroup>
							<tr>
								<th>Abstract Submission<br class="br_mb_only"> System Open</th>
								<td class="f_bold">Mid-May</td>
							</tr>
							<tr>
								<th class="close_th">Abstract Submission<br class="br_mb_only"> Deadline</th>
								<td><span class="font_inherit f_bold red_t">August 10 (Thu)</span></td>
							</tr>
							<tr>
								<th>Notification of<br class="br_mb_only"> Abstract Acceptance</th>
								<td class="f_bold">August 14 (Mon)</td>
							</tr>
							<tr>
								<th>Registration Deadline for<br class="br_mb_only"> Approved Abstract Presenters</th>
								<td class="f_bold">August 24 (Thu)</td>
							</tr>
						</table>
						<!--
                        <table class="c_table detail_table">
                            <colgroup>
                                <col class="submission_col">
                                <col>
                            </colgroup>
                            <tr>
                                <th>Early May</th>
                                <td>Abstract submission system open</td>
                            </tr>
                            <tr>
                                <th>July <span class="font_inherit red_t">6</span> (Thu)</th>
                                <td>Abstract submission deadline</td>
                            </tr>
                            <tr>
                                <th>August 14(Mon)</th>
                                <td>Notification of abstract acceptance</td>
                            </tr>
                            <tr>
                                <th>August 24(Thu)</th>
                                <td>Registration deadline for approved abstract presenters</td>
                            </tr>
                            <!--<tr>
                                <th>Sep 7(Thu) ~ 9 (Sat), 2023</th>
                                <td>ICOMES 2023</td>
                            </tr>
                        </table>
						-->
                </div>
            </div>
            <!--keydate end-->
            <?php
            }
            ?>
            <!--Presentation Type start-->
            <!--<div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("presentation_type") ?></h3>
                </div>
                <div class="text_box">
                    When you submit the abstract, select the possibility regarding the Oral presentation on the abstract
                    submission page. It will be posted in the form of an Poster or given the oral presentation according
                    to the selection.
                    <div>
                        <button type="button">Oral Presentation</button>
                        <button type="button">Poster Exhibition</button>
                    </div>
                </div>
            </div>-->
            <!--Presentation Type end-->
            <!--Steps for Abstract Submission start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("steps_for_abstract_submission") ?></h3>
                </div>
				<div class="steps_area five_steps">
					<ul class="clearfix">
						<li>
							<p>Step 1</p>
							<p class="sm_txt">Sign up and log in to the ICOMES 2023 website.</p>
						</li>
						<li>
							<p>Step 2</p>
							<p class="sm_txt">Read the submission guidelines and download the abstract form.</p>
						</li>
						<li>
							<p>Step 3</p>
							<p class="sm_txt">Fill out the abstract form and submit an abstract.</p>
						</li>
						<li>
							<p>Step 4</p>
							<p class="sm_txt">Enter the author's information and abstract section, including the type of presentation, topic categories, and title.</p>
						</li>
						<li>
							<p>Step 5</p>
							<p class="sm_txt">Complete and confirm submission.</p>
						</li>
					</ul>
				</div>
            </div>
            <!--Steps for Abstract Submission end-->
            <!--Topic Categories start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("topic_categories") ?></h3>
                </div>
                <div class="text_box">
                    <ul>
                        <li class="f_bold"><span class="bold">1. </span>Behavior and Public Health for Obesity</li>
                        <li class="f_bold"><span class="bold">2. </span>Nutrition, Education and Exercise for Obesity
                        </li>
                        <li class="f_bold"><span class="bold">3. </span>Epidemiology of Obesity and Metabolic Syndrome
                        </li>
                        <li class="f_bold"><span class="bold">4. </span>Digital Therapeutics and Big Data Study</li>
                        <li class="f_bold"><span class="bold">5. </span>Diabetes and Obesity</li>
                        <li class="f_bold"><span class="bold">6. </span>Dyslipidemia, Hypertension and Obesity</li>
                        <li class="f_bold"><span class="bold">7. </span>Other Comorbidities of Obesity and Metabolic
                            Syndrome</li>
                        <li class="f_bold"><span class="bold">8. </span>Pathophysiology of Obesity and Metabolic
                            Syndrome</li>
                        <li class="f_bold"><span class="bold">9. </span>Therapeutics of Obesity and Metabolic Syndrome
                        </li>
                        <li class="f_bold"><span class="bold">10. </span>Metabolic and Bariatric Surgery</li>
                        <li class="f_bold"><span class="bold">11. </span>Obesity and Metabolic Syndrome in Children and
                            Adolescents</li>
                    </ul>
                </div>
            </div>
            <!--Topic Categories end-->
            <!--Instructions start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("instructions") ?></h3>
                </div>
                <div class="table_wrap detail_table_common x_scroll">
                    <table class="c_table detail_table">
                        <colgroup>
                            <col class="submission_col type2">
                            <col>
                        </colgroup>
                        <tr>
                            <th>Presentation Type </th>
                            <td>
                                <p>1) Oral Presentation</p>
                                <p>2) Poster Exhibition</p>
                                <p>3) Guided Poster Presentation <br />
                                    (*Scientific committee may change the presentation type by review.)
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>Language</th>
                            <td>English</td>
                        </tr>
                        <tr>
                            <th>Length of Title</th>
                            <td>No longer than 30 words</td>
                        </tr>
                        <tr>
                            <th>Method of Submission</th>
                            <td>Online submission via the website.</td>
                        </tr>
                        <tr>
                            <th>Format</th>
                            <td>
                                <p>Download and use the official abstract form. <br />Contain 4 sections: background,
                                    methods & materials, results, and conclusions. <br />(keywords are optional)</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Length of body</th>
                            <td>No longer than 300 words</td>
                        </tr>
                        <tr>
                            <th>Figure / Table</th>
                            <td>
                                <p>- 1 figure in 1 abstract: Allowed</p>
                                <p>- 1 table in 1 abstract: Allowed</p>
                                <p>- 1 figure & 1 table in 1 abstract: Not allowed <br />
                                    (*Each figure or table will be counted as 50 words.)
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>Modification</th>
                            <td>Abstract review or modification will be available until the deadline.</td>
                        </tr>
                        <tr>
                            <th>Withdrawal</th>
                            <td>Request to the secretariat via email (icomes_abstracts@into-on.com)</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--Instructions end-->
			<!--Originality & Eligibility start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title">Originality & Eligibility</h3>
                </div>
                <div class="text_box indent">
                    <ul>
                        <li>• If the submission does not comply with the prescribed format or deviates from the basic purpose of this congress, it may be rejected at the discretion of the scientific program committee.</li>
                        <li>• The subject of the abstract is limited to unpublished research results, and editing of content previously presented at other conferences is not accepted for submission.</li>
                        <li>• The submitted and accepted abstracts may be published on the website, application, abstract book, and other printed materials of the Korean Society for the Study of Obesity.</li>
						<li>• If any related issue arises, please contact the congress secretariat at <a href="mailto:icomes@into-on.com" class="link">icomes@into-on.com.</a></li>
                    </ul>
                </div>
            </div>
            <!--Notification of Acceptance start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("notification_of_acceptance") ?></h3>
                </div>
                <div class="text_box indent">
                    <ul>
                        <li>• Following the evaluation of all abstract submissions by the scientific committee, the
                            presenting author and the corresponding author will receive an email notification regarding
                            the acceptance of their submission.</li>
                        <li>• It is mandatory for all presenters to complete the registration process and pay the full
                            registration fee by the registration deadline of <span class="bold">August 24, 2023</span>.
                            The registration fee will be fully refunded after the conference.</li>
                        <li>• If the submission deadline changes, the acceptance notification also changes. The
                            secretariat will be notified via ICOMES website or newsletter.</li>
                    </ul>
                </div>
            </div>
            <!--Notification of Acceptance end-->
            <!--Withdrawal Policy start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("withdrawal_policy") ?></h3>
                </div>
                <div class="text_box indent">
                    <ul>
                        <li>• Failure to register by the presenter registration deadline will result in the automatic withdrawal of the accepted abstract from the final program.</li>
                        <li>• To request the withdrawal of an abstract, send an email to the ICOMES 2023 secretariat(<a href="mailto:icomes_abstracts@into-on.com" class="link font_inherit">icomes_abstracts@into-on.com</a>) at your earliest convenience.</li>
                    </ul>
                </div>
            </div>
            <!--Withdrawal Policy end-->
            <!--Contact for Abstract start-->
            <!--
			<div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("contact_for_abstract") ?></h3>
                </div>
                <div class="text_box contact">
                    <ul class="devide_ul">
                        <li><span class="green_t bold">TEL :</span> +82-2-2285-2582</li>
                        <li><span class="green_t bold">E-mail :</span> icomes_abstracts@into-on.com</li>
                    </ul>
                </div>
            </div>
			-->
            <!--Contact for Abstract end-->
        </div>
        <!--//section1-->

    </div>
    <!-- <button type="button" class="fixed_btn" onclick="window.location.href='./abstract_submission.php';"><?= $locale("abstract_submission_btn") ?></button> -->
</section>

<?php include_once('./include/footer.php'); ?>