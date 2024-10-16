<?php
include_once('./include/head.php');
include_once('./include/header.php');

$sql_event =    "SELECT
						period_event_start,
						period_event_end,
						period_event_pre_end
					FROM info_event AS ie";
$event = sql_fetch($sql_event);

$sql_registration =    "SELECT
							bank_name_" . $language . " AS bank_name,
							account_number_" . $language . " AS account_number,
							account_holder_" . $language . " AS account_holder,
							address_" . $language . " AS `address`,
							CONCAT(fi_pop.path, '/', fi_pop.save_name) AS fi_pop_url
						FROM info_registration AS ir
						LEFT JOIN `file` AS fi_pop
							ON fi_pop.idx = ir.score_pop_" . $language . "_img";
$registration = sql_fetch($sql_registration);

$sql_price =    "SELECT
						type_en, 
						off_member_usd, off_guest_usd, on_member_usd, on_guest_usd, 
						off_member_krw, off_guest_krw, on_member_krw, on_guest_krw
					FROM info_event_price
					WHERE is_deleted = 'N'
					ORDER BY off_member_usd DESC, off_guest_usd DESC, on_member_usd DESC, on_guest_usd DESC";
$price = get_data($sql_price);
?>

<section class="container registration top_btn_move">
    <h1 class="page_title">Registration
			<div class="sub_btn_box">
				<a href="/main/registration_guidelines.php" class="on">Guidelines</a>
				<a href="/main/registration.php">Go to Registration</a>
				<!-- <a href="/main/comingsoon.php" class="kor">평점안내</a> -->
				<a href="/main/registration_rating_guides.php" class="kor">평점안내</a>
			</div>
		</h1>
        <div class="inner">
            <div>
                <div class="section_title_wrap2">
                    <h3 class="title">Registration process</h3>
                </div>
                <div class="steps_area five_steps registration">
                        <ul class="clearfix">
                            <li>
                                <p></p>
                                <p class="">Click the <span class="point4_txt">“Go to Registration”</span> button</p>
                            </li>
                            <li>
                                <p></p>
                                <p class="">Sign up and log into the registration system</p>
                            </li>
                            <li>
                                <p></p>
                                <p class="">Fill out personal information and choose a registration category</p>
                            </li>
                            <li>
                                <p></p>
                                <p class="">Choose a payment method and make a payment</p>
                            </li>
                            <li>
                                <p></p>
                                <p class="">Check your e-mail for a payment confirmation (Successfully completed)</p>
                            </li>
                        </ul>
                    </div>
                </div>
           <!--1. important dates start-->
            <h3 class="title">Key Dates<span>&nbsp;&nbsp;&nbsp; *KST (UTC+9)</span></h3>
            <p class="registration_txt">All participants are required to register through the IMCVP 2024 online registration system and are advised to register in advance (by November 3, 2024). 
                <br/>Please read the following registration guidelines carefully.</p>
            <div class="table_wrap detail_table_common details icomes_air">
                <table class="c_table detail_table type2">
                    <colgroup>
                        <col class="submission_col">
                        <col>
                    </colgroup>
                    <tr>
                        <th>Registration<br class="br_mb_only"> Open</th>
                        <td class="f_bold">Monday, <span class="f_bold point4_txt">June 3</span>, 2024</td>
                    </tr>
                    <tr>
                        <th class="">Early-bird Registration<br class="br_mb_only"> Deadline</th>
                        <td class="f_bold">Monday, <span class="f_bold point4_txt">October 7</span>, 2024</td>
                    </tr>
                    <!-- <tr>
                        <th class="close_th">Early-bird Registration<br class="br_mb_only"> Deadline</th>
                        <td class="f_bold">June 29 (Thu)</td>
                    </tr> -->
                    <tr>
                        <th>Pre-registration<br class="br_mb_only"> Deadline</th>
                        <td class="f_bold">Sunday, <span class="f_bold point4_txt">November 3</span>, 2024</td>
                    </tr>
                </table>
            </div>

            <?php
            if (count($price) > 0) {
                $tb_arr = array();
                $i = -1;
                $off_mb = 0;
                $off_gt = 0;
                $on_mb = 0;
                $on_gt = 0;

                $unit = $language == "en" ? "usd" : "krw";
                $unit_upper = strtoupper($unit);

                $off_mb_col = 'off_member_' . $unit;
                $off_gu_col = 'off_guest_' . $unit;
                $on_mb_col = 'on_member_' . $unit;
                $on_gu_col = 'on_guest_' . $unit;

                foreach ($price as $pr) {
                    if (
                        $off_mb != $pr[$off_mb_col]
                        || $off_gt != $pr[$off_gu_col]
                        || $on_mb != $pr[$on_mb_col]
                        || $on_gt != $pr[$on_gu_col]
                    ) {
                        $i++;
                        $off_mb = $pr[$off_mb_col];
                        $off_gt = $pr[$off_gu_col];
                        $on_mb = $pr[$on_mb_col];
                        $on_gt = $pr[$on_gu_col];

                        $tb_arr[$i] = $pr;
                        unset($tb_arr[$i]['type_en']);
                        $tb_arr[$i]['type_arr'] = array();
                    }

                    array_push($tb_arr[$i]['type_arr'], $pr['type_en']);
                }
            ?>
                <!--2. icomes-Air Registration start-->
                <h3 class="title">Registration Fees for International </h3>
                    <div class="details icomes_air">
					<div class="table_wrap x_scroll">
						<table class="c_table2 detail_table center type1">
                            <colgroup>
                            <col>
                            <col width="13.5%">
                            <col width="13.5%">
                            <col width="13.5%">
                            <col width="13.5%">
                            <col width="13.5%">
                            <col width="13.5%">
                            </colgroup>
							<thead>
								<tr>
									<th rowspan="2">Classification</th>
									<th colspan="2" class="dark_blue_th">Early-bird Registration</th>
									<th colspan="2" class="light_blue_th pre_txt">Pre Registration</th>
									<th colspan="2" class="light_gray_th pre_txt">On-site Registration</th>
								</tr>
                                <tr>
                                    <th class="dark_blue_th_1">Member</th>
                                    <th class="dark_blue_th_1">Non-Member</th>
                                    <th class="light_blue_th_1 pre_txt">Member</th>
                                    <th class="light_blue_th_1 pre_txt">Non-Member</th>
                                    <th class="light_gray_th_1 pre_txt">Member</th>
                                    <th class="light_gray_th_1 pre_txt light_gray_th_2">Non-Member</th>
                                </tr>
							</thead>
							<tbody>
								<tr class="text_center">
									<td>MD, Professor</td>
									<td class="point4_txt ">USD 100</td>
									<td class="point4_txt ">USD 150</td>
									<td class="point4_txt bold">USD 150</td>
									<td class="point4_txt bold">USD 200</td>
									<td>USD 200</td>
									<td>USD 300</td>
								</tr>
                                <tr class="text_center">
									<td>
                                        Healthcare Professional other <br/>than Medical Doctors<span class="red_t">*</span>
                                         <!-- Pharmacist,<br>
										 Nurse, Excercise therapist,<br>
                                         Nutritionists, Researchers<br> -->
										<!-- Corporate member, Others<br> -->
									</td>
									<td class="point4_txt ">USD 75</td>
									<td class="point4_txt ">USD 100</td>
									<td class="point4_txt bold">USD 100</td>
									<td class="point4_txt bold">USD 125</td>
									<td>USD 125</td>
									<td>USD 150</td>
								</tr>
                                <tr class="text_center">
									<td>
                                        Trainee,<br>
										Students
									</td>
									<td class="point4_txt ">USD 50</td>
									<td class="point4_txt ">USD 75</td>
									<td class="point4_txt bold">USD 75</td>
									<td class="point4_txt bold">USD 80</td>
									<td>USD 80</td>
									<td>USD 100</td>
								</tr>
							
							</tbody>
						</table>
                        <p class="text_r">* Nurse, Dietician, Nutritionist, Pharmacist, Exercise Specialist, Corporate Member, Others</p>
					</div>
                </div>
                <!--2. icomes-Air Registration start-->
                <h3 class="title">Registration Fees for Korean</h3>
                <div class="details icomes_air">
					<div class="table_wrap x_scroll">
                        <p class="red_t kor text_r font400">※  국내 Trainee(전공의), Student(학생)은 등록비 무료 <a href="https://forms.gle/aWuj92c7iKmrEyD1A " class="red_t bold under" target="_blank">(자세히알아보기)</a></p>
						<table class="c_table2 detail_table center type1">
							<thead>
								<tr>
									<th rowspan="2">Classification</th>
									<th colspan="2" class="dark_blue_th">Early-bird Registration</th>
									<th colspan="2" class="light_blue_th pre_txt">Pre Registration</th>
									<th colspan="2" class="light_gray_th pre_txt">On-site Registration</th>
								</tr>
                                <tr>
                                    <th class="dark_blue_th_1">Member</th>
                                    <th class="dark_blue_th_1">Non-Member</th>
                                    <th class="light_blue_th_1 pre_txt">Member</th>
                                    <th class="light_blue_th_1 pre_txt">Non-Member</th>
                                    <th class="light_gray_th_1 pre_txt">Member</th>
                                    <th class="light_gray_th_1 pre_txt light_gray_th_2">Non-Member</th>
                                </tr>
							</thead>
							<tbody>
								<tr class="text_center">
									<td>MD (<span class="kor bold">봉직의</span>),Professor</td>
									<td class="point4_txt ">KRW 100,000</td>
									<td class="point4_txt ">KRW 150,000</td>
									<td class="point4_txt bold">KRW 150,000</td>
									<td class="point4_txt bold">KRW 200,000</td>
									<td>KRW 200,000</td>
									<td>KRW 300,000</td>
								</tr>
                                <tr class="text_center">
									<td>
                                    Healthcare Professional other <br/>than Medical Doctors<span class="red_t">*</span>
                                        <!-- Pharmacist, Excercisetherapist<br>
										 Nurse, exercise therapist,<br>
                                         Nutritionists,Researchers<br> -->
										<!-- Corporate member, Others<br> -->
									</td>
									<td class="point4_txt ">KRW 75,000</td>
									<td class="point4_txt ">KRW 100,000</td>
									<td class="point4_txt bold">KRW 100,000</td>
									<td class="point4_txt bold">KRW 125,000</td>
									<td>KRW 125,000</td>
									<td>KRW 150,000</td>
								</tr>
                                <tr class="text_center">
									<td>
                                    Trainee (<span class="kor bold">전임의</span>)
                                    <!-- Trainee (<span class="kor bold">전임의, 전공의</span>),<br>
                                    Students -->
									</td>
                                    <td class="point4_txt ">KRW 50,000</td>
									<td class="point4_txt ">KRW 75,000</td>
									<td class="point4_txt bold">KRW 75,000</td>
									<td class="point4_txt bold">KRW 80,000</td>
									<td>KRW 80,000</td>
									<td>KRW 100,000</td>
								</tr>
								
							</tbody>
						</table>
                        <p class="text_r">* Nurse, Dietician, Nutritionist, Pharmacist, Exercise Specialist, Corporate Member, Others</p>
					</div>
                    
					<div class="mt10">
						<ul class="indent_ul">
                            <!-- <li class="bold">※ 국내 전공의 및 학생은 등록비 무료 （신분증 확인) </li> -->
							<li>• A confirmation letter for registration will be sent to your registered email address once you complete your registration with full payment.<br/>If you have not received it, please contact the congress secretariat(<a href="mailto:info@imcvp.org">info@imcvp.org</a>).</li>
							<li>• For wire transfers, the automatically generated confirmation letter may indicate the payment status as <span class="bold point4_txt">'Unpaid.'</span><br/>If you need to confirm the payment, you can check the payment status on <span class="bold point4_txt">'My Page.'</span> (Please be aware that it may take 3~5 business days for the payment confirmation to be updated).</li>
							<li>• Registration status will not be considered ‘Complete’ after the full payment.</li>
							<li>• The online registration page is optimized for <span class="bold point4_txt">Google Chrome</span> and <span class="bold point4_txt">Microsoft Edge</span>.
                            <!-- <br/>If you encounter any issues with online registration, please reach out to the congress secretariat for assistance. -->
                        </li>
							<li>• For any further assistance, please contact the congress secretariat at <a href="mailto:info@imcvp.org" class="font_inherit link">info@imcvp.org</a></li>
						</ul>
					</div>
                </div>
                <!--2. icomes-Air Registration end-->
            <?php
            }
            ?>
			

            <!--3. Methods of Payment start-->
			<h3 class="title">Methods of Payment</h3>
			<div class="details">
				<!-- <a class="btn long_btn text_long" target="_blank"><img src="./img/icons/icon_download_yellow.svg" alt="">Application for cancellation of registration and refund</a> -->
				<div class="details payment_detail mt10">
					<!-- <p class="pre"><?= $locale("registration_notice_txt") ?></p> -->
					 <div>
						<ul class="indent_ul">
							<li>• Credit Card : Master / VISA</li>
							<li>• Wire Transfer</li>
						</ul>
					</div>
					<div class="table_wrap detail_table_common x_scroll">
						<table class="c_table detail_table type2">
							<colgroup>
								<col>
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>Bank Name</th>
									<td>WOORI BANK</td>
								</tr>
								<tr>
									<th>Account Number</th>
									<td>1005-403-423214</td>
								</tr>
								<tr>
									<th>Account Holder</th>
									<td>Korean Society of Cardiovascular Disease Prevention</td>
								</tr>
								<tr>
									<th>Swift Code</th>
									<td>HVBKKRSEXXX</td>
								</tr>
								<tr>
									<th>Bank Address</th>
									<td>17, WORLDCUP BUK RO 60 GIL, MAPOGU, SEOUL, 03921, SOUTH KOREA</td>
								</tr>
								<!-- <tr>
									<th>Account Holder</th>
									<td>대한비만학회 등록비 <br>(International Congress on Obesity and Metabolic Syndrome)</td>
								</tr> -->
								<!--
								<tr>
									<th>Address</th>
									<td>Seoul, Mapo Gu, manrijaero 14 Renaissance Tower 1010</td>
								</tr>
								-->
							</tbody>
						</table>
					</div>
					<div class="m10">
						<!-- <a 
						href="./download/ICOMES_2022_Application_for_cancellation_of_registration_and_refund.docx"
							class="btn long_btn" target="_blank"> -->
					</div>
				</div>	
			</div>
            
            <!--3. Methods of Payment end-->
			

            <!--3. Cancellation & Refund Policy start-->
            <h3 class="title">Cancellation & Refund Policy</h3>
			<a href="" class="btn long_btn text_long not_yet" target="_blank" style="color:#FFF !important">
			<!-- <a href="./download/ICOMES_2023_Registration_Cancellation_Request_Form.docx" class="btn long_btn text_long" target="_blank"> -->
                <img src="./img/icons/icon_download_white.svg" alt="">Cancellation & Refund  Form Download</a>
            <div class="details payment_detail mt10">
                <!-- <p class="pre"><?= $locale("registration_notice_txt") ?></p> -->
                <div class="">
                    <ul class="indent_ul">
                        <li>• The cancellation of full payment registration and reimbursement will only be accepted in written form and must be submitted via email to the secretariat.<br>(<a href="mailto:info@imcvp.org" class="font_inherit link">info@imcvp.org</a>)</li>
                        <li>• Prior to making a payment, it is possible to cancel registration through <span class="point4_txt bold">"My IMCVP - Registration"</span>. <br/>However, if payment has already been processed, it is necessary to contact the secretariat for further assistance.</li>
                        <li>• Please note that refunds will be processed after the conference.</li>
                        <li>• All bank service charges and administration fees will be deducted from the refund.</li>
                    </ul>
                </div>
                <div class="table_wrap detail_table_common x_scroll">
					<table class="c_table detail_table type2">
						<colgroup>
							<col class="submission_col type2">
							<col>
						</colgroup>
						<tbody>
							<tr>
								<th>Before Pre-Registration Deadline</th>
								<td>Full Refund</td>
							</tr>
							<tr>
								<th>After Pre-Registration Deadline</th>
								<td>No Refund</td>
							</tr>
                        </tbody>
					</table>
                </div>
            </div>
            <!--3. Cancellation & Refund Policy end-->

            <!--4. Payment Method start-->
            <!-- <h3 class="title"><?= $locale("payment_method_tit") ?></h3>
            <div class="details payment_detail clearfix">
                <p><?= $locale("payment_method_txt") ?></p>
                <div class="payment_wrap">
                    <p class="details_title">* <?= $locale("payment_card_tit") ?></p>
                    <div class="img_wrap">
                      <img src="./img/sample/credit_card.jpg" alt="credit_card_img"> -->
        </div>
    </div>
   
    </div>

    <!-- <button type="button" class="fixed_btn" onclick="window.location.href='./registration.php';"> -->
    <!-- 	<?= $locale("registration") ?> -->
    <!-- </button> -->
	<div class="centerT" >
		<a href="./registration.php" class="btn long_btn text_long" style="color:#FFF !important">Go to Registration</a>
	</div>

    <!-- 평점안내 팝업 / 시작 -->
    <div class="popup type2 pop_info rating_new_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <div class="pop_top_banner">
                <img src="./img/pop_top_banner.jpg" alt="">
                <p>평점안내</p>
            </div>
            <div>
                <div>
                    <img class="coming" src="./img/coming.png" />
                    <!-- <p class="alert red_t">※ 각 협회와 확인 중으로 이후 평점이 변경될 수 있습니다.<br/>추후 안내 예정이오니, 참고 부탁드립니다.</p> -->
                    <!-- <div class="x_scroll">
                        <table class="c_table2">
                            <thead>
                                <tr>
                                    <th class="transparent_bg"></th>
                                    <th>참석날짜</th>
                                    <th>9월 1일(목)</th>
                                    <th>9월 2일(금)</th>
                                    <th>9월 3일(토)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bold">의사</td>
                                    <td class="bold">대한의사협회 연수평점</td>
                                    <td>최대 <span class="bold">2평점</span></td>
                                    <td>최대 <span class="bold">6평점</span></td>
                                    <td>최대 <span class="bold">6평점</span></td>
                                </tr>
                                <tr>
                                    <td class="bold">영양사</td>
                                    <td class="bold">한국영양교육평가원<br />임상영양사<br />전문연수교육(CPD)</td>
                                    <td class="bold" colspan="3">5평점</td>
                                </tr>
                                <tr>
                                    <td class="bold">운동사</td>
                                    <td class="bold">대한운동사협회</td>
                                    <td class="bold" colspan="3">40평점</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                    <!-- <ul class="info">
                        <li><i></i><span>의사협회 1일 교육상한 점수는 6평점이며, 교육시간이 중복되는 교육 중복 참가는 불인정됩니다.</span></li>
                        <li><i></i><span>모든 참가자에게 비만전문인정의 평점이 부여되며, 기준은 의사협회와 동일합니다.</span></li>
                    </ul>
                </div>
                <div>
                    <div>
                        <div class="pop_title">의협 연수교육 평점 안내</div>
                        <div class="details_bg">
                            <ul>
                                <li>본 학회는 모든 평점사항에 대하여 입, 퇴장 시 1일 2회의 출결확인의무를 시행합니다.<br />학술대회 개최기간 동안 현장에서 입장과 퇴장에 대한
                                    출결 확인 절차가 필요하며, <br />이에 따른 접속시간 별 평점이 인정됩니다.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="x_scroll mt10">
                        <table class="c_table2 layout_fixed">
                            <thead>
                                <tr>
                                    <th>시스템 기록에 따른 이수시간</th>
                                    <th>일반평점</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>교육 이수시간 1시간 미만</td>
                                    <td>X(없음)</td>
                                </tr>
                                <tr>
                                    <td>1시간 이상 ~ 2시간 미만</td>
                                    <td>1평점</td>
                                </tr>
                                <tr>
                                    <td>2시간 이상 ~ 3시간 미만</td>
                                    <td>2평점</td>
                                </tr>
                                <tr>
                                    <td>3시간 이상 ~ 4시간 미만</td>
                                    <td>3평점</td>
                                </tr>
                                <tr>
                                    <td>4시간 이상 ~ 5시간 미만</td>
                                    <td>4평점</td>
                                </tr>
                                <tr>
                                    <td>5시간 이상 ~ 6시간 미만</td>
                                    <td>5평점</td>
                                </tr>
                                <tr>
                                    <td>6시간 이상 ~</td>
                                    <td>6평점(최대)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                    <!-- <ul class="info">
                        <li><i></i><span>평점 등록을 위하여는 등록 시, 본인 분야에 해당하는 평점신청 및<br />해당 면허 번호를 정확하게 입력해주시기 바랍니다.</span>
                        </li>
                        <li><i></i><span>평점신청을 하신 분들은 현장에서의 입장과 퇴장 시, <br /><span class="red_t underline">반드시 네임택 상의 QR을
                                    태깅 해주시기 바랍니다.</span></span></li>
                        <li><i></i><span>위 부분평점 지침을 참고하시어 불이익을 받는 사례가 없도록 유의하여 주시기 바랍니다.</span></li>
                        <li><i></i><span>학술대회 종료 후, 학회 사무국에서 의사 명단을 의사협회 연수교육 시스템에 등록하게 되면 자동으로 평점이 부여되고 있으며 개인에게 평점카드를
                                발급하지 않습니다. (소요기간 : 약 4주)</span></li>
                    </ul>
                </div>
                <div class="btn_wrap">
                    <div class="half_btn clearfix">
                        <button type="button" class="btn green_btn floatL"
                            onClick="javascript:window.open('http://doc-lic.kma.org/mypage/sub1.asp');">면허신고현황조회
                            바로가기<img src="./img/icons/icon_dubble_arrow.svg" alt=""></button>
                        <button type="button" class="btn green_btn floatR"
                            onClick="javascript:window.open('https://edu.kma.org/dataRoom/drMember.asp');">대한의사협회 안내 공지
                            바로가기<img src="./img/icons/icon_dubble_arrow.svg" alt=""></button>
                    </div>
                    <button type="button" class="btn green_btn"
                        onClick="javascript:window.open('https://edu.kma.org');">대한의사협회 연수교육 필수 평점 이수 내역 확인 바로가기<img
                            src="./img/icons/icon_dubble_arrow.svg" alt=""></button>
                    <ul class="info">
                        <li><i></i><span>대한의사협회 연수교육 필수 평점문의 Tel. 02-6350-6552,</span></li>
                        <li><i></i><span>대한의사협회 면허신고문의 Tel. 02-6350-6610</span></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
    <!-- 평점안내 팝업 / 끝 -->

</section>
<button type="button" class="btn_fixed_triangle fixed_btn_pc" onClick="location.href='./registration.php'">
    <img src="/main/img/icons/2024_regi_icon.svg"/>
</button>
<script>
    $('.show_pop').on('click', function() {
        //$('.pop_info').show();
        alert("Coming soon.")
    });
    $(".rating_new_open").click(function() {
        $(".rating_new_pop").show();
    });
</script>

<?php include_once('./include/footer.php'); ?>