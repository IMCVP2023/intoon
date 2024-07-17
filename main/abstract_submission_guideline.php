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
<section class="abstract_submission_guideline container top_btn_move">
        <h1 class="page_title">Call for Abstract
			<div class="sub_btn_box">
				<a href="/main/abstract_submission_guideline.php" class="on">Abstract Submission Guidelines</a>
				<a href="/main/abstract_submission.php">Online Submission</a>
                <a href="/main/comingsoon.php">Presentation Guidelines</a>
				<a href="/main/abstract_submission_award.php">Awards & Grants</a>

				<!-- <a href="/main/abstract_submission_oral.php">Presentation Guidelines</a>
				<a href="/main/abstract_submission_award.php">Awards & Grants</a> -->
			</div>
		</h1>
    <!-- <h1 class="page_title">Submission Guidelines</h1> -->
    <div class="inner">
        <div class="section section1">
            <div>
                <div class="text_box">
                    <ul>
                        <li>The IMCVP 2024 organizing committee cordially invites you to submit abstracts for <span class="dark_blue_t bold">poster Oral,&nbsp;</span><span class="light_blue_t bold">Poster Exhibitions,&nbsp;</span><span class="dark_gray_txt bold">either.</span></li>
                        <li>All congress abstracts must be submitted online via the "Online Submission System."</li>
                        <li>Submitted abstracts will be reviewed by the Scientific Program Committee, and committee might request an oral presentation.</li>
                        <li>All presenters are required to register and pay the registration fee.</li>
                        <li>Please read the guidelines carefully before submitting your abstract.</li>
                    </ul>
                </div>
                <!-- <div class="text_center btn_box mt25">
					<a href="./download/ICOMES_2023_Abstract_form.docx" class="btn long_btn" target="_blank" download><img src="./img/icons/icon_download_white.svg" alt="">Abstract Form Download</a>
                    <a href="./abstract_submission.php" class="btn long_btn yellow_btn online_submission_alert">Go to Abstract Submission</a>
                </div> -->
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
                        <h3 class="title"><!--<?= $locale("keydate") ?>-->Key Dates<span>&nbsp;&nbsp;&nbsp; *KST (UTC+9)</span></h3>
                    </div>
                    <div class="abstract_key_date_box">
                        <img src="/main/img/icons/key_date-1-1.png" alt="key_dates-1"/>
                        <img src="/main/img/icons/key_date-2-1.png" alt="key_dates-2"/>
                        <img src="/main/img/icons/key_date-3-1.png" alt="key_dates-3"/>
                    </div>
                    <!-- <div class="table_wrap detail_table_common x_scroll">
						<table class="c_table detail_table td_nowrap_table">
							<colgroup>
								<col class="submission_col">
								<col>
							</colgroup>
							<tr>
								<th>Abstract Submission<br class="br_mb_only"> System Open</th>
								<td class="f_bold">Monday, <span class="f_bold violet_t">June 3</span>, 2024</td>
							</tr>
							<tr>
								<th>1<sup class="font_small">st</sup> round Abstract Submission<br class="br_mb_only"> Deadline</th>
								<td><span class="font_inherit f_bold">Sunday, <span class="f_bold violet_t">August 18</span>, 2024</span></td>
							</tr>
                            <tr>
								<th>2<sup class="font_small">nd</sup> round Abstract Submission<br class="br_mb_only"> Deadline</th>
								<td><span class="font_inherit f_bold">Sunday, <span class="f_bold violet_t">October 6</span>, 2024</span></td>
							</tr>
							<tr>
								<th>Notification of<br class="br_mb_only">Notification of acceptance</th>
								<td class="f_bold">Wednesday, <span class="f_bold violet_t">October 16</span>, 2024</td>
							</tr>
							<tr>
								<th>Registration Deadline for<br class="br_mb_only"> Approved Abstract Presenters</th>
								<td class="f_bold">Sunday, <span class="f_bold violet_t">November 3</span>, 2024</td>
							</tr>
						</table>
					
                </div> -->
            </div>
            <!--keydate end-->
            <div>
                    <div class="section_title_wrap2">
                        <h3 class="title">Abstract Submission Type</h3>
                    </div>
                    <div class="text_box">
                    <ul class="abstract_type">
                        <li><a href="./comingsoon.php">Poster Oral</a></li>
                        <!-- <li><a href="./abstract_submission_oral.php">Poster oral</a></li> -->
                        <li><a href="./comingsoon.php">Poster Exhibitions</a></li>
                        <li><a href="./comingsoon.php">Either</a></li>
                    </ul>
                </div>
            </div>
            <?php
            }
            ?>
            <!--Presentation Type start-->
           
            <!--Presentation Type end-->
            <!--Steps for Abstract Submission start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("steps_for_abstract_submission") ?></h3>
                </div>
				<div class="steps_area five_steps">
					<ul class="clearfix">
						<li>
							<p></p>
							<p class="">All presenters must complete their registration before the registration deadline.</p>
						</li>
						<li>
							<p></p>
							<p class="">Upon submitting your abstract, a confirmation letter will be emailed to you.</p>
						</li>
						<li>
							<p></p>
							<p class="">To review or make changes to your submitted abstracts, please visit <span class="bold point4_txt">‘My IMCVP’</span>.</p>
						</li>
						<li>
							<p></p>
							<p class="">You will receive an acceptance notification via email.</p>
						</li>
					</ul>
                    <p class="red_t bold text_center font20">* Note: Accepted abstracts qualify for free registration to <span class="bold dark_blue_t font20">the presenting author only per abstract.</span></p>
				</div>
            </div>
            <!--Steps for Abstract Submission end-->
          
            <!--Instructions start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title">General Guidelines</h3>
                </div>
                <div class="table_wrap detail_table_common x_scroll">
                    <table class="c_table detail_table type2">
                        <colgroup>
                            <col class="submission_col type2">
                            <col>
                        </colgroup>
                        <tr>
                            <th>Presentation Type </th>
                            <td>
                                <p class="dark_blue_t bold">Poster Oral</p>
                                <p class="light_blue_t bold">Poster Exhibitions Only</p>
                                <p class="dark_gray_txt bold">Either</p>
                                <p>(* Scientific Program Committee may change your presentation type after reviewing it.)</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Language</th>
                            <td>English Only</td>
                        </tr>
                        <tr>
                            <th>Length of Body</th>
                            <td>No longer than 300 words</td>
                        </tr>
                        <tr>
                            <th>Method of Submission</th>
                            <td>Online submission via the website only</td>
                        </tr>
                        <tr>
                            <th>Figure / Table</th>
                            <td>
                                <p>- 1 figure in 1 abstract: <span class="red_t">Allowed</span></p>
                                <p>- 1 table in 1 abstract: <span class="red_t">Allowed</span></p>
                                <p>- 1 figure & 1 table in 1 abstract: <span class="red_t">Not allowed</span> <br />
                                 * A figure or table counts as 50 words.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>
                                <p class="red_t bold">Do not use capital letters except for the first letter when writing a title. </p>
                                <p>Example: This is a properly formatted abstract title. </p>
                            </td>
                        </tr>
                        <tr>
                            <th>Structure of Research Abstract</th>
                            <td>Objectives / Methods / Results / Conclusions</td>
                        </tr>
                        <!-- <tr>
                            <th>Length of body</th>
                            <td>No longer than 300 words</td>
                        </tr>
                        -->
                        <tr>
                            <th>Modification</th>
                            <td>Abstract review or modification will be available until the abstract submission deadline.<br>
                            (* Upon abstract submission, a confirmation email will be sent to your provided email address.)
                            
                        </td>
                        </tr>
                        <tr>
                            <th>Withdrawal</th>
                            <td>Request to the secretariat via email <a class="link under" href="mailto:sci@imcvp.org">sci@imcvp.org</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--Instructions end-->
              <!--Topic Categories start-->
              <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("topic_categories") ?></h3>
                </div>
                <div class="text_box">
                    <ul>
                        <li class="f_bold"><span class="bold">1. </span>Ischemic Heart Disease/Coronary Artery Disease</li>
                        <li class="f_bold"><span class="bold">2. </span>Heart Failure with Reduced Ejection Fraction and Preserved Ejection Fraction</li>
                        <li class="f_bold"><span class="bold">3. </span>Cardiomyopathies</li>
                        <li class="f_bold"><span class="bold">4. </span>Chronic Kidney Disease and Cardiovascular Disease</li>
                        <li class="f_bold"><span class="bold">5. </span>Preventive Cardiology</li>
                        <li class="f_bold"><span class="bold">6. </span>Cardiac Arrhythmias</li>
                        <li class="f_bold"><span class="bold">7. </span>Peripheral Arterial Disease</li>
                        <li class="f_bold"><span class="bold">8. </span>Basic Science and Genetics</li>
                        <li class="f_bold"><span class="bold">9. </span>COVID-19 Related Cardio-Pharmacotherapy</li>
                        <li class="f_bold"><span class="bold">10. </span>Diabetes and Obesity</li>
                        <li class="f_bold"><span class="bold">11. </span>Hyperlipidemia and Cardiovascular Disease</li>
                        <li class="f_bold"><span class="bold">12. </span>Epidemiology</li>
                        <li class="f_bold"><span class="bold">13. </span>Precision Medicine/Digital Healthcare</li>
                        <li class="f_bold"><span class="bold">14. </span>Others</li>
                    </ul>
                </div>
            </div>
            <!--Topic Categories end-->
              <!--Notification of Acceptance start-->
              <div>
                <div class="section_title_wrap2">
                    <h3 class="title"><?= $locale("notification_of_acceptance") ?></h3>
                </div>
                <div class="text_box indent">
                    <ul class="indent_ul">
                        <li>• All submitted abstracts will be reviewed by the Scientific Program Committee, following the reviewing procedures.</li>
                        <li>• It is mandatory for all presenters to complete the registration process and pay the full registration fee by the registration deadline of <span class="point4_txt bold">November 3, 2024.</span> The registration fee will be fully refunded after the conference.</li>
                        <li>• If the submission deadline changes, the acceptance notification date will also change. The
                            secretariat will announce via IMCVP website or newsletter.</li>
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
                    <ul class="indent_ul">
                        <li>• If the presenting author of an accepted abstract does not register by November 3, 2024 the abstract will be automatically withdrawn from the final program.</li>
                        <li>• If you would like to withdraw an abstract, please notify the IMCVP 2024 Secretariat(<a class="link under" href="mailto:sci@imcvp.org">sci@imcvp.org</a>) as soon as possible.</li>
                    </ul>
                </div>
            </div>
            <!--Withdrawal Policy end-->

			<!--Originality & Eligibility start-->
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title">Originality & Eligibility</h3>
                </div>
                <div class="text_box indent">
                    <ul class="indent_ul">
                        <li>• If the submission does not comply with the prescribed format or deviates from the basic purpose of this congress, it may be rejected at the discretion of the Scientific Committee.</li>
                        <li>• The subject of the abstract is limited to unpublished research results, and editing of content previously presented at other conferences will not be accepted. </li>
                        <li>• The submitted and accepted abstracts may be published on the website, application, abstract book(PDF), and other printed materials of the Korean Society of Cardiovascular Disease Prevention(KSCP).</li>
						<!-- <li>• If any related issue arises, please contact the congress secretariat at <a class="link under" href="mailto:sci@imcvp.org">sci@imcvp.org</a>.</li> -->
						<li>• Submitted abstracts may be considered for online or offline publications and presentations, but they should not have been previously announced, publicized, or distributed online and offline in full article form before the abstract submission deadline.</li>
                        <li>• For any further assistance, please contact the IMCVP2024 secretariat at <a class="link under" href="mailto:sci@imcvp.org">sci@imcvp.org</a>.</li>
                    </ul>
                </div>
            </div>
          
            
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
<button type="button" class="btn_fixed_triangle fixed_btn_pc pc_only" onClick="location.href='./abstract_submission.php'">
    <img src="/main/img/icons/2024_abstract_icon.svg" class="go_abstract_icon" style="width: 100%;"/>
    <!-- <img src="/main/img/icons/2024_abstract_icon.svg" class="go_abstract_icon"/> -->
</button>

<script>
    
        // const abstractImg = document.querySelector(".go_abstract_icon");

        // abstractImg.addEventListener("mouseover", ()=>{
        //     console.log("hi")
        //     abstractImg.src = "/main/img/icons/2024_abstract_icon-1.svg"
        // })

        // abstractImg.addEventListener("mouseleave", ()=>{
        //     console.log("hi")
        //     abstractImg.src = "/main/img/icons/2024_abstract_icon.svg"
        // })
 
</script>
<?php include_once('./include/footer.php'); ?>