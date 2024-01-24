<?php include_once('./include/head.php'); ?>
<?php include_once('./include/header.php'); ?>



<?php

$type = $_GET['type'];
$e = $_GET['e'];
$day = $_GET['day'];
$e_num = $e[-1];
$d_num = $day[-1];

$name = $_GET['name'];

//echo 'asdasd', $e_num;

//kcode == 116 새로고침

echo '<script type="text/javascript">
				  $(document).ready(function(){
					  //탭 활성화
					  //큰탭
					  $(".tab_green li").removeClass("on");
					  if ("' . $day . '" === "") {
						$(".tab_green li:first-child").addClass("on");
					  }
					  $(".tab_green li:nth-child(' . $d_num . ')").addClass("on");
					  $(".tab_green + .tab_wrap > .tab_cont").removeClass("on");
					  $(".tab_green + .tab_wrap > .tab_cont:nth-child(' . $d_num . ')").addClass("on");
					  //작은탭
					  $(".tab_green + .tab_wrap .tab_cont .tab_li li").removeClass("on");
					  $(".tab_green + .tab_wrap .tab_cont .tab_li li:nth-child(' . $e_num . ')").addClass("on");
					  $(".tab_green + .tab_wrap .tab_cont .tab_cont").removeClass("on");
					  $(".tab_green + .tab_wrap .tab_cont .tab_cont:nth-child(' . $e_num . ')").addClass("on");

					  window.onkeydown = function() {
					  	var kcode = event.keyCode;
						if(kcode == 116) {
							history.replaceState({}, null, location.pathname);
							window.scrollTo({top:0, left:0, behavior:"auto"});
						}
					  }

					  //스크롤 위치 & 액션
					  $(".program_detail_ul li").each(function(){
						if("' . $name . '" === $(this).attr("name")) {
							var this_top = $(this).offset().top;
							$("html, body").animate({scrollTop: this_top - 400}, 1000);
							console.log("scrollTop: ", this_top - 150)
						}
					  });

				  });
		</script>';


?>



<section class="container program_detail">
    <h1 class="page_title">Scientific Program</h1>
    <div class="inner">
        <ul class="tab_green long centerT detail_program">
            <li id="tab1" class="on"><a href="javascript:;">Sep.7 (Thu)
                </a></li>
            <li id="tab2"><a href="javascript:;">Sep.8 (Fri)
                </a></li>
            <li id="tab3"><a href="javascript:;">Sep.9 (Sat)
                </a></li>
        </ul>
        <div class="tab_wrap">
            <div class="tab_cont on">
                <!-- <img class="coming" src="./img/coming.png" /> -->
                <ul class="tab_li">
                    <li id="tab1" class="on"><a href="javascript:;">Room1</a></li>
                    <li id="tab2"><a href="javascript:;">Room2</a></li>
                    <li id="tab3"><a href="javascript:;">Room3</a></li>
                </ul>
                <div class="tab_wrap">
                    <div class="tab_cont on">
                        <ul class="program_detail_ul">
                            <li name="pre_congress_symposium_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="purple_bg">
                                                <td>15:00-16:45</td>
                                                <td>
                                                    <p class="font_20 bold">Pre-congress Symposium 1 : 적절한 비만관리를 위한 정책적
                                                        논의</p>
                                                    <p><span class="bold">Chairpersons : 김성수</span> (대한비만학회 회장), <span
                                                            class="bold">김종화</span> (부천세종병원 내분비내과)</p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:00-15:05</td>
                                                                    <td class="bold">
                                                                        개회사
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">박철영</p>(대한비만학회 이사장)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:05-15:10</td>
                                                                    <td class="bold">
                                                                        축사
                                                                    </td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:10-15:25</td>
                                                                    <td class="bold">
                                                                        학회에서 바라는 비만 관리를 위한 정부 정책 방향
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">김경곤</p>(대한비만학회 부회장)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:25-15:45</td>
                                                                    <td class="bold">
                                                                        비만대사수술 청구 현황 분석 및 제언
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">박정혜</p>(건강보험심사평가원 심사운영부 부장)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:45-16:05</td>
                                                                    <td class="bold">
                                                                        소아청소년 비만 관리 제언
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">홍용희</p>(대한비만학회 소아청소년위원회 이사)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:05-16:45</td>
                                                                    <td class="bold">
                                                                        패널토의
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">이충헌</p>(KBS 기자),<br>
                                                                        <p class="bold">정연희</p>(보건복지부 건강증진과 과장),<br>
                                                                        <p class="bold">한병덕</p>(고려의대 가정의학과 교수),<br>
                                                                        <p class="bold">한상문</p>(대한비만학회 비만대사수술위원회 이사)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:45-17:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="satellite_symposium_1">
                                <!--
                                <div class="clearfix2 caption">
                                    <span>Sep.7(Thu)</span>
                                    <span>Room1(3F)</span>
                                </div>
								-->
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>18:00-18:30</td>
                                                <td>
                                                    <p class="font_20 bold">Satellite Symposium 1</p>
                                                    <p><span class="bold">Chairperson : Sang Yeoup Lee</span> (Pusan
                                                        National University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>18:00-18:30</td>
                                                                    <td class="bold">
                                                                        Empagliflozin, Treatment of T2D patients
                                                                        Considering Renal Function
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yong-ho Lee</p>(Yonsei
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="satellite_symposium_2">
                                <!--
                                <div class="clearfix2 caption">
                                    <span>Sep.7(Thu)</span>
                                    <span>Room1(3F)</span>
                                </div>
								-->
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>18:30-19:00</td>
                                                <td>
                                                    <p class="font_20 bold">Satellite Symposium 2</p>
                                                    <p><span class="bold">Chairperson : Sung Soo Kim</span> (Chungnam
                                                        National University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>18:30-19:00</td>
                                                                    <td class="bold">Hypertension Management in Older
                                                                        Persons: Intensive vs Standard Treatment</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Won Yoon Suh</p>(Chungnam
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:45-17:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="pre_congress_symposium_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="purple_bg">
                                                <td>17:00-18:00</td>
                                                <td>
                                                    <p class="font_20 bold">Pre-congress Symposium 2 : Obesity in
                                                        Asia-Pacific – Is It Different from Rest of the World?</p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Kyu Rae Lee</span> (Gachon
                                                        University, Republic of Korea), <br><span class="bold">Koutaro
                                                            Yokote</span> (Chiba University, Japan)
                                                    </p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>17:00-17:20</td>
                                                                    <td class="bold">Prevalence and Trends of Obesity
                                                                        and Metabolic Syndrome in the Asia-pacific
                                                                        Region</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jun-Hyuk Lee</p>(Eulji
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:20-17:40</td>
                                                                    <td class="bold">Perspective on Diagnostic Criteria
                                                                        for Obesity in Asia and Global</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hyuktae Kwon</p>(Seoul National
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:40-18:00</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Gaga Irawan Nugraha</p>(Faculty
                                                                        of Medicine, Universitas Padjadjaran,
                                                                        Indonesia),<br>
                                                                        <p class="bold">Daruneewan Warodomwichit</p>
                                                                        (Ramathibodi Hospital, Mahidol University,
                                                                        Thailand),<br>
                                                                        <p class="bold">Sang Yeoup Lee</p>(Pusan
                                                                        National University, Republic of Korea),<br>
                                                                        <p class="bold">Wen-Yuan Lin</p>(China Medical
                                                                        University and Hospital, Taiwan),<br>
                                                                        <p class="bold">Kwang Wei Tham</p>(Woodlands
                                                                        Health, Singapore)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="satellite_symposium_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>18:30-19:00</td>
                                                <td>
                                                    <p class="font_20 bold">Satellite Symposium 3</p>
                                                    <p><span class="bold">Chairperson : Bom Taeck Kim</span> (Ajou
                                                        University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>18:30-19:00</td>
                                                                    <td class="bold">Atorvastatin/Ezetimibe Treatment
                                                                        for the Dyslipidemia in Patients with Type 2
                                                                        Diabetes</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Chang Hee Jung</p>(University of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="welcome_cocktail_party">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>19:00-21:00</td>
                                                <td>
                                                    <p class="font_20 bold mb_0">Welcome Cocktail Party</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab_cont">
                <ul class="tab_li">
                    <li id="tab1" class="on"><a href="javascript:;">Room1</a></li>
                    <li id="tab2"><a href="javascript:;">Room2</a></li>
                    <li id="tab3"><a href="javascript:;">Room3</a></li>
                    <li id="tab3"><a href="javascript:;">Room4</a></li>
                    <li id="tab3"><a href="javascript:;">Room5</a></li>
                    <li id="tab3"><a href="javascript:;">Room6</a></li>
                    <li id="tab3"><a href="javascript:;">Room7</a></li>
                </ul>
                <div class="tab_wrap">
                    <div class="tab_cont on">
                        <ul class="program_detail_ul">
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>08:20-08:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>08:30-09:10</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 1</p>
                                                    <p><span class="bold">Chairperson : Kyu Rae Lee</span> (Gachon
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer : Jang Won Son (The Catholic University of
                                                        Korea, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Thiruma V. Arumugam, a distinguished researcher in
                                                            the fields of physiology and pharmacology at La Trobe
                                                            University, Australia, is pushing the boundaries of
                                                            neuroscience and metabolism. In his upcoming lecture, he
                                                            will discuss how his work on intermittent metabolic
                                                            switching has enhanced our comprehension of its effect on
                                                            brain health, paving the way for potential therapeutic
                                                            interventions.</li>
                                                        <li>His recent publication in Theranostics, titled
                                                            "Time-restricted feeding modulates the DNA methylation
                                                            landscape, attenuates hallmark neuropathology and cognitive
                                                            impairment in a mouse model of vascular dementia," has
                                                            presented novel insights into the therapeutic potential of
                                                            intermittent metabolic switching, offering promising
                                                            strategies for managing and potentially reversing cognitive
                                                            impairment in dementia.</li>
                                                        <li>Further expanding our understanding, Professor Arumugam's
                                                            article in Cell Metabolism, "Hallmarks of Brain Aging:
                                                            Adaptive and Pathological Modification by Metabolic States,"
                                                            continues to revolutionize our perspective on the role of
                                                            metabolism in brain aging.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>08:30-09:00</td>
                                                                    <td class="bold">
                                                                        Intermittent Metabolic Switching and Brain
                                                                        Health
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Thiruma V. Arumugam</p>(La Trobe
                                                                        University, Australia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:00-09:10</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>09:10-09:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 1 : Obesity and Cancer</p>
                                                    <p><span class="bold">Chairpersons : Sung Rae Kim</span> (The
                                                        Catholic University of Korea, Republic of Korea), <br><span
                                                            class="bold">Yoon-Sok Chung</span> (Ajou University,
                                                        Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Seung-Hwan Lee (The Catholic University
                                                        of Korea, Republic of Korea), Jae Hyun Bae (Korea University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Obesity is strongly associated with increased incidence and
                                                            progression of cancers, significantly contributing to
                                                            cancer-related mortality. This session will delve into the
                                                            latest perspectives on the relationship between obesity and
                                                            cancer. Professor Yun Kyung Cho will present epidemiological
                                                            studies that elucidate the impact of obesity on cancer risk.
                                                            Professor Haejin Yoon will explore the regulation of
                                                            mitochondrial metabolism and its role in metabolic diseases.
                                                            Professor Annie Anderson will discuss evidence-based
                                                            strategies to effectively address excess body fatness in
                                                            cancer survivors.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Cho YK, Lee J, Kim HS, et al. Metabolic health is a
                                                            determining factor for incident colorectal cancer in the
                                                            obese population: A nationwide population-based cohort
                                                            study. Cancer Med. 2021;10(1):220-229.<br />
                                                            2. Yoon H, Spinelli JB, Zaganjor E, et al. PHD3 loss
                                                            promotes exercise capacity and fat oxidation in skeletal
                                                            muscle. Cell Metab. 2020;32(2):215-228.<br />
                                                            3. Anderson AS, Martin RM, Renehan AG, et al. Cancer
                                                            survivorship, excess body fatness and weight-loss
                                                            intervention-where are we in 2020? Br J Cancer.
                                                            2021;124(6):1057-1065
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        Obesity and the Risk of Cancer: Key Lessons from
                                                                        Epidemiologic Studies
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yun Kyung Cho</p>(University of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        Dynamic Regulation of Mitochondrial Metabolism
                                                                        in Metabolic Disease
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Haejin Yoon</p>(UNIST, Republic
                                                                        of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        Obesity Care in Cancer Survivors
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Annie Anderson</p>(University of
                                                                        Dundee, UK)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae Hyun Bae</p>(Korea
                                                                        University, Republic of Korea),<br>
                                                                        <p class="bold">You-Bin Lee</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>10:50-11:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="opening_address">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>11:00-11:10</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Opening Address</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>11:10-11:50</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 1</p>
                                                    <p><span class="bold">Chairperson : Sung Soo Kim</span> (Chungnam
                                                        National University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Matthias Blüher is Head of the Obesity Outpatient Clinic for
                                                            Adults at the University of Leipzig Department of Medicine
                                                            in Leipzig, Germany. He is Professor of Molecular
                                                            Endocrinology, with board certifications in Internal
                                                            Medicine, Endocrinology and Diabetology. From 2006 to 2012,
                                                            Professor Blüher served as Head of the Clinical Research
                                                            Group ‘Atherobesity,’ and since 2013, he has been Speaker of
                                                            the Collaborative Research Center on obesity mechanisms.
                                                        </li>
                                                        <li>Professor Blüher has won several awards, including the
                                                            Obesity Research Award of the German Society for the Study
                                                            of Obesity, the Ferdinand-Bertram-Prize of the German
                                                            Diabetes Association, and the Rising Star Lecture at the
                                                            44th European Association for the Study of Diabetes (EASD)
                                                            meeting. More recently, he received the Hans Christian
                                                            Hagedorn Award from the German Diabetes Association in 2011
                                                            and the Minkowski Award from the EASD in 2015.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Blüher M, Aras M, Aronne LJ, Batterham RL, Giorgino F, Ji
                                                            L, Pietiläinen KH, Schnell O, Tonchevska E, Wilding JPH. New
                                                            insights into the treatment of obesity. Diabetes Obes Metab.
                                                            2023 Apr 13. doi: 10.1111/dom.15077.<br />
                                                            2. Blüher M. Metabolically Healthy Obesity. Endocr Rev. 2020
                                                            May 1;41(3):bnaa004.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:10-11:40</td>
                                                                    <td class="bold">
                                                                        Adipose Tissue – A Treasure Box for Discoveries
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Matthias Blüher</p>
                                                                        (University of Leipzig, Germany)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>11:40-11:50</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>11:50-12:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="luncheon_symposium_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>12:00-13:00</td>
                                                <td>
                                                    <p class="font_20 bold">Luncheon Symposium 1</p>
                                                    <p><span class="bold">Chairperson : Bumjo Oh</span> (Seoul National
                                                        University, Republic of Korea)</p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>12:00-13:00</td>
                                                                    <td class="bold">
                                                                        The Cardio-Renal Benefits of Dapagliflozin and
                                                                        Combination Therapy
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Eun Young Lee</p>(The Catholic
                                                                        University of Korea, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>13:00-14:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_5">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>14:00-15:30</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 5 : Emerging Anti-obesity Drugs: Expectations and Apprehensions</p>
                                                    <p><span class="bold">Chairperson : Young Seol Kim</span> (Kyung Hee University, Republic of Korea)</p>
													<button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Kyung Hee Park (Hallym University,
                                                        Republic of Korea), Jin-Wook Kim (Hippocrata Clinic), Yoon Jeong
                                                        Cho (Daegu Catholic University, Republic of Korea)</p>
                                                    <ul>
                                                        <li>The development of new drugs for treating obesity is
                                                            ongoing, and more potent medications are being introduced.
                                                            Among them, semaglutide and tirzepatide will soon be
                                                            available in Korea, and their efficacy has been proven based
                                                            on various clinical trials. In Symposium 5, we will discuss
                                                            the efficacy of semaglutide and tirzepatide, as well as
                                                            expectations and side effects associated with their use. In
                                                            line with this, we will explore the safety and status of
                                                            drug abuse when using anti-obesity drugs, which should be
                                                            considered as important as their efficacy. This symposium
                                                            will provide an opportunity for us to collectively
                                                            contemplate the direction for optimal treatment in this
                                                            field.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. J Obes Metab Syndr. 2023 Jun 30; 32(2): 121–129.
                                                            Diagnosis of Obesity: 2022 Update of Clinical Practice
                                                            Guidelines for Obesity by the Korean Society for the Study
                                                            of Obesity<br />
                                                            2. Lancet Diabetes Endocrinol 2022; 10: 193–206. Semaglutide
                                                            once a week in adults with overweight or obesity, with or
                                                            without type 2 diabetes in an east Asian population (STEP
                                                            6): a randomised, double-blind, double-dummy,
                                                            placebo-controlled, phase 3a trial<br />
                                                            3. Diabetes Obes Metab. 2023 Apr;25(4):1056-1067. Safety and
                                                            efficacy analyses across age and body mass index subgroups
                                                            in East Asian participants with type 2 diabetes in the phase
                                                            3 tirzepatide studies (SURPASS programme)<br />
                                                            4. Diabetes Obes Metab.2021;23:1232–1241.Cardiovascular
                                                            safety of evogliptin in patients with type 2 diabetes: A
                                                            nationwide cohort study.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:00-14:25</td>
                                                                    <td class="bold">
                                                                        STEP Up Your Weight Management with Semaglutide
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Bom Taeck Kim</p>(Ajou
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:25-14:50</td>
                                                                    <td class="bold">
                                                                        Safety and Abuse of Anti-obesity Drugs
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ju Young Shin</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:50-15:15</td>
                                                                    <td class="bold">
                                                                        The Metabolic Effects of Tirzepatide, especially
                                                                        in East-Asian Patients from the SURPASS Program
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Robert J. Heine</p>(Eli Lilly,
                                                                        USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:15-15:30</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jin-Wook Kim</p>(Hippocrata
                                                                        Clinic, Republic of Korea), <br>
                                                                        <p class="bold">Seo Young Kang</p>(Eulji
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>15:30-15:40</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>15:40-16:20</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 2</p>
                                                    <p><span class="bold">Chairperson : Jeong-Taek Woo</span> (Kyung Hee
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Il-Young Kim (Gachon University, Republic
                                                        of Korea)</p>
                                                    <ul>
                                                        <li>Prof. Wolfe is widely respected as the world’s foremost
                                                            authority on stable isotope tracer methodology and on amino
                                                            acid/protein nutrition. His research focuses on the
                                                            regulation of muscle metabolism, particularly as affected by
                                                            aging, obesity, insulin resistance, and stressors such as
                                                            sepsis and cancer in humans. Prof. Wolfe has developed
                                                            numerous metabolic tracing models using stable isotope
                                                            tracers to quantify a variety of metabolic processes in
                                                            humans, which has formed the foundation of our understanding
                                                            of many aspects of normal and abnormal metabolism of
                                                            glucose, fatty acid, and amino acid/protein in humans. In
                                                            his plenary lecture, the particular emphasis will be placed
                                                            on the response of fatty acid kinetics to different
                                                            conditions (exercise, glucose intake, obesity) in the
                                                            context of the triglyceride-fatty acid cycle, with his more
                                                            than 50 years of experience in the human metabolic research.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Kim IY et al., Tracing metabolic flux in vivo: basic
                                                            model structures of tracer methodology. 2022
                                                            Sep;54(9):1311-1322. doi: 10.1038/s12276-022-00814-z.<br />
                                                            2. Miyoshi H et al., Hormonal control of substrate cycling
                                                            in humans, J Clin Invest. 1988. 1988 May;81(5):1545-55. doi:
                                                            10.1172/JCI113487.<br />
                                                            3. Sidossis LS, Wolfe RR. Glucose and insulin-induced
                                                            inhibition of fatty acid oxidation: the glucose-fatty acid
                                                            cycle reversed. Am J Physiol. 1996 Apr;270(4 Pt 1):E733-8.
                                                            doi: 10.1152/ajpendo.1996.270.4.E733. PMID: 8928782.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:40-16:10</td>
                                                                    <td class="bold">
                                                                        Understanding Human Metabolic Dysregulation in
                                                                        Vivo Using Stable Isotope Tracers: More than 50
                                                                        Years of Experience
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Robert R. Wolfe</p>(University
                                                                        of Arkansas for Medical Sciences, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:10-16:20</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:20-16:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_9">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>16:30-18:00</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 9 : Obesity in Special Conditions
                                                    </p>
                                                    <p><span class="bold">Chairpersons : Moon-Kyu Lee</span> (Eulji
                                                        University, Republic of Korea), <br><span class="bold">In Ju
                                                            Kim</span> (Pusan National University, Republic of Korea)
                                                    </p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Yun-Hee Lee (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>The topic of this session is “Obesity in special
                                                            conditions”. Beyond recognizing obesity as the same disease
                                                            condition, we would like to have time to look at cases with
                                                            various accompanying diseases. The first speaker, Dicky L.
                                                            Tahapary, will discuss the diagnosis and treatment of obese
                                                            patients with diabetes. The second speaker, Wen-Yuan Lin,
                                                            will introduce studies related to obesity with sarcopenia.
                                                            The last speaker, Professor Tae Nyun Kim, will discuss the
                                                            new concept of osteoporosis-sarcopenic obesity.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>16:30-16:55</td>
                                                                    <td class="bold">
                                                                        Diabesity: From Disease Mechanism to Clinical
                                                                        Management
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Dicky L. Tahapary</p>
                                                                        (Cardiovascular and Research
                                                                        Centre-IMERI(Indonesia Medical Education and
                                                                        Research Institute), Indonesia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:55-17:20</td>
                                                                    <td class="bold">
                                                                        Sarcopenia and Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Wen-Yuan Lin</p>(China Medical
                                                                        University and Hospital, Taiwan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:20-17:45</td>
                                                                    <td class="bold">
                                                                        Osteo-Sarcopenic Obesity: A New Concept of an
                                                                        Old Problem
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Tae Nyun Kim</p>(Inje
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:45-18:00</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Bumjo Oh</p>(Seoul National
                                                                        University, Republic of Korea), <br>
                                                                        <p class="bold">Hyon-Seung Yi</p>(Chungnam
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="breakfast_symposium_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>07:30-08:20</td>
                                                <td>
                                                    <p class="font_20 bold">Breakfast Symposium 1</p>
                                                    <p><span class="bold">Chairperson : Kiyoung Lee</span> (Gachon
                                                        University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>07:30-08:20</td>
                                                                    <td class="bold">
                                                                        Optimizing Combination Therapy for Type 2
                                                                        Diabetes
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae Hyun Bae</p>(Korea
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>08:20-08:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_1_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>08:30-09:10</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 1</p>
                                                    <p><span class="bold">Chairperson : Kyu Rae Lee</span> (Gachon
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer : Jang Won Son (The Catholic University of
                                                        Korea, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Thiruma V. Arumugam, a distinguished researcher in
                                                            the fields of physiology and pharmacology at La Trobe
                                                            University, Australia, is pushing the boundaries of
                                                            neuroscience and metabolism. In his upcoming lecture, he
                                                            will discuss how his work on intermittent metabolic
                                                            switching has enhanced our comprehension of its effect on
                                                            brain health, paving the way for potential therapeutic
                                                            interventions.</li>
                                                        <li>His recent publication in Theranostics, titled
                                                            "Time-restricted feeding modulates the DNA methylation
                                                            landscape, attenuates hallmark neuropathology and cognitive
                                                            impairment in a mouse model of vascular dementia," has
                                                            presented novel insights into the therapeutic potential of
                                                            intermittent metabolic switching, offering promising
                                                            strategies for managing and potentially reversing cognitive
                                                            impairment in dementia.</li>
                                                        <li>Further expanding our understanding, Professor Arumugam's
                                                            article in Cell Metabolism, "Hallmarks of Brain Aging:
                                                            Adaptive and Pathological Modification by Metabolic States,"
                                                            continues to revolutionize our perspective on the role of
                                                            metabolism in brain aging.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>08:30-09:00</td>
                                                                    <td class="bold">
                                                                        Intermittent Metabolic Switching and Brain
                                                                        Health
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Thiruma V. Arumugam</p>(La Trobe
                                                                        University, Australia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:00-09:10</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>09:10-09:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 2 : Obesity and Neurodegenerative
                                                        Diseases</p>
                                                    <p><span class="bold">Chairpersons : Jaetaek Kim</span> (Chung-Ang
                                                        University, Republic of Korea), <br><span class="bold">Ki Woo
                                                            Kim</span> (Yonsei University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer : Jang Won Son (The Catholic University of
                                                        Korea, Republic of Korea), Kyung Ae Lee (Jeonbuk National
                                                        University)</p>
                                                    <ul>
                                                        <li>In this session, Professor Thiruma V. Arumugam will
                                                            elucidate on the transformative effects of dietary
                                                            restriction on vascular dementia, providing invaluable
                                                            insights into how our eating habits can directly impact our
                                                            cognitive health. Following him, Professor Dong Gyu Jo will
                                                            elaborate on adiponectin's role in Alzheimer's Disease,
                                                            offering clues for potential therapeutic strategies. Lastly,
                                                            Professor Theresia Handayani Mina will explore the link
                                                            between body fat, metabolic risks, and cognitive function.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Hallmarks of Brain Aging: Adaptive and Pathological
                                                            Modification by Metabolic States. Cell Metab. 2018 Jun
                                                            5;27(6):1176-1199.<br />
                                                            2. Physiology and pharmacology of amyloid precursor protein.
                                                            Pharmacol Ther. 2022 Jul;235:108122.<br />
                                                            3. Adiposity impacts cognitive function in Asian
                                                            populations: an epidemiological and Mendelian Randomization
                                                            study. Lancet Reg Health West Pac. 2023 Feb 14;33:100710.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        Dietary Restriction and Vascular Dementia
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Thiruma V. Arumugam</p>(La Trobe
                                                                        University, Australia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        Role of Adiponectin Signaling in Alzheimer's
                                                                        Disease
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Dong-Gyu Jo</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        The Impact of Adiposity and Cognitive Function:
                                                                        Closer than You Think
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Theresia Handayani Mina</p>
                                                                        (Nanyang Technological University, Singapore)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jang Won Son</p>(The Catholic
                                                                        University of Korea, Republic of Korea), <br>
                                                                        <p class="bold">Kyung Ae Lee</p>(Jeonbuk
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>10:50-11:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="opening_address_2">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>11:00-11:10</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Opening Address</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_1_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>11:10-11:50</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 1</p>
                                                    <p><span class="bold">Chairperson : Sung Soo Kim</span> (Chungnam
                                                        National University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Matthias Blüher is Head of the Obesity Outpatient Clinic for
                                                            Adults at the University of Leipzig Department of Medicine
                                                            in Leipzig, Germany. He is Professor of Molecular
                                                            Endocrinology, with board certifications in Internal
                                                            Medicine, Endocrinology and Diabetology. From 2006 to 2012,
                                                            Professor Blüher served as Head of the Clinical Research
                                                            Group ‘Atherobesity,’ and since 2013, he has been Speaker of
                                                            the Collaborative Research Center on obesity mechanisms.
                                                        </li>
                                                        <li>Professor Blüher has won several awards, including the
                                                            Obesity Research Award of the German Society for the Study
                                                            of Obesity, the Ferdinand-Bertram-Prize of the German
                                                            Diabetes Association, and the Rising Star Lecture at the
                                                            44th European Association for the Study of Diabetes (EASD)
                                                            meeting. More recently, he received the Hans Christian
                                                            Hagedorn Award from the German Diabetes Association in 2011
                                                            and the Minkowski Award from the EASD in 2015.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Blüher M, Aras M, Aronne LJ, Batterham RL, Giorgino F, Ji
                                                            L, Pietiläinen KH, Schnell O, Tonchevska E, Wilding JPH. New
                                                            insights into the treatment of obesity. Diabetes Obes Metab.
                                                            2023 Apr 13. doi: 10.1111/dom.15077.<br />
                                                            2. Blüher M. Metabolically Healthy Obesity. Endocr Rev. 2020
                                                            May 1;41(3):bnaa004.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:10-11:40</td>
                                                                    <td class="bold">
                                                                        Adipose Tissue – A Treasure Box for Discoveries
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Matthias Blüher</p>
                                                                        (University of Leipzig, Germany)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>11:40-11:50</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>11:50-12:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="luncheon_symposium_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>12:00-13:00</td>
                                                <td>
                                                    <p class="font_20 bold">Luncheon Symposium 2</p>
                                                    <p><span class="bold">Chairperson : Kyung-Soo Kim</span> (The
                                                        Catholic University of Korea, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>12:00-13:00</td>
                                                                    <td class="bold">
                                                                        Novel Enhanced SGLT2 Inhibitor 'Enavogliflozin'
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yun Kyung Cho</p>(Univeristy of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>13:00-14:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_6">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>14:00-15:30</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 6 : Clinical Exercise with Obesity
                                                    </p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Hyo Youl Moon</span> (Seoul
                                                        National University, Republic of Korea),<br />
                                                        <span class="bold">Minchul Lee</span> (CHA University, Republic
                                                        of Korea)
                                                    </p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:00-14:25</td>
                                                                    <td class="bold">
                                                                        Mild Exercise May Alleviate Memory Dysfunction
                                                                        and Regulate Hippocampal Lactate Metabolism in
                                                                        Type II Diabetic Rats
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hideaki Soya</p>(University of
                                                                        Tsukuba, Japan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:25-14:50</td>
                                                                    <td class="bold">
                                                                        Beyond Weight Loss: Unveiling the Vital Roles of
                                                                        Exercise in Conquering Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sukho Lee</p>(Texas A & M
                                                                        University, USA)
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>14:50-15:15</td>
                                                                    <td class="bold">
                                                                        From Exercise to Lifestyle Coaching: A Data
                                                                        based Wellness Coaching System
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jung Gi Hong</p>(CHA University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:15-15:30</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <!-- <td class="text_r panels">
                                                                        <p><span class="bold">Kyeongho Byun</span> (Incheon National University, Republic of Korea),</p>
                                                                        <p><span class="bold">Min-Seong Ha</span> (University of Seoul, Republic of Korea)</p>
                                                                    </td> -->
                                                                    <td class="text_r">
                                                                        <p class="bold">Kyeongho Byun</p>(Incheon
                                                                        National University, Republic of Korea),<br>
                                                                        <p class="bold">Min-Seong Ha</p>(University of
                                                                        Seoul, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>15:30-15:40</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_2_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>15:40-16:20</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 2</p>
                                                    <p><span class="bold">Chairperson : Jeong-Taek Woo</span> (Kyung Hee
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Il-Young Kim (Gachon University, Republic
                                                        of Korea)</p>
                                                    <ul>
                                                        <li>Prof. Wolfe is widely respected as the world’s foremost
                                                            authority on stable isotope tracer methodology and on amino
                                                            acid/protein nutrition. His research focuses on the
                                                            regulation of muscle metabolism, particularly as affected by
                                                            aging, obesity, insulin resistance, and stressors such as
                                                            sepsis and cancer in humans. Prof. Wolfe has developed
                                                            numerous metabolic tracing models using stable isotope
                                                            tracers to quantify a variety of metabolic processes in
                                                            humans, which has formed the foundation of our understanding
                                                            of many aspects of normal and abnormal metabolism of
                                                            glucose, fatty acid, and amino acid/protein in humans. In
                                                            his plenary lecture, the particular emphasis will be placed
                                                            on the response of fatty acid kinetics to different
                                                            conditions (exercise, glucose intake, obesity) in the
                                                            context of the triglyceride-fatty acid cycle, with his more
                                                            than 50 years of experience in the human metabolic research.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Kim IY et al., Tracing metabolic flux in vivo: basic
                                                            model structures of tracer methodology. 2022
                                                            Sep;54(9):1311-1322. doi: 10.1038/s12276-022-00814-z.<br />
                                                            2. Miyoshi H et al., Hormonal control of substrate cycling
                                                            in humans, J Clin Invest. 1988. 1988 May;81(5):1545-55. doi:
                                                            10.1172/JCI113487.<br />
                                                            3. Sidossis LS, Wolfe RR. Glucose and insulin-induced
                                                            inhibition of fatty acid oxidation: the glucose-fatty acid
                                                            cycle reversed. Am J Physiol. 1996 Apr;270(4 Pt 1):E733-8.
                                                            doi: 10.1152/ajpendo.1996.270.4.E733. PMID: 8928782.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:40-16:10</td>
                                                                    <td class="bold">
                                                                        Understanding Human Metabolic Dysregulation in
                                                                        Vivo Using Stable Isotope Tracers: More than 50
                                                                        Years of Experience
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Robert R. Wolfe</p>(University
                                                                        of Arkansas for Medical Sciences, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:10-16:20</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:20-16:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_10">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>16:30-18:00</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 10 : Neuropsychological Aspect of Obesity</p>
                                                    <p><span class="bold">Chairpersons : Kyu Chang Won</span> (Yeungnam University, Republic of Korea), <br><span class="bold">Min-Seon Kim</span> (University of Ulsan, Republic of Korea)</p>
													<button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
													<p class="bold">Organizer: Hyung Jin Choi (Seoul National University, Republic of Korea)</p>
													<ul>
														<li>In this session, we will delve into the intricate interplay between neuropsychology and obesity. Dr. Yun Ha Jeong from the Korea Brain Research Institute will discuss the impact of obesity and HDL concentration on the pathology of Alzheimer's disease (AD). Through an analysis of AD pathological changes in 5XFAD mice after obesity induction through a high-fat diet, Dr. Jeong presents a noteworthy phenomenon where the increase in HDL and APOA-I serum levels mitigates AD features, offering a potential avenue for novel therapeutic strategies.</li>
														<li>Subsequently, Professor Kwang Wei Tham from  Singapore Woodlands Health will elucidate how weight-related biases affect the physical, mental health, and obesity management of individuals. Lastly, Professor Youn Huh from Eulji University will explore the link between type 2 diabetes and dementia, emphasizing the growing relevance of preventing and managing these conditions, and discussing how type 2 diabetes escalates dementia risks, urging the derivation of preventive strategies based on research findings in light of the increasing prevalence of both diseases.</li>
													</ul>
												</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>16:30-16:55</td>
                                                                    <td class="bold">
                                                                        The Effect of Obesity and HDL Concentration on
                                                                        AD Pathology
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yun Ha Jeong</p>(Korea Brain
                                                                        Research Institute (KBRI), Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:55-17:20</td>
                                                                    <td class="bold">
                                                                        Weight Bias and Stigma: The Occult Barrier in
                                                                        Obesity Care
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Kwang Wei Tham</p>(Woodlands
                                                                        Health, Singapore)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:20-17:45</td>
                                                                    <td class="bold">
                                                                        Type 2 Diabetes and Dementia
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Youn Huh</p>(Eulji University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:45-18:00</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ga Eun Nam</p>(Korea University,
                                                                        Republic of Korea),<br />
                                                                        <p class="bold">Young Sang Lyu</p>(Chosun
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="breakfast_symposium_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>07:30-08:20</td>
                                                <td>
                                                    <p class="font_20 bold">Breakfast Symposium 2</p>
                                                    <p><span class="bold">Chairperson : Changhyun Lee</span> (Seoul
                                                        Happiness Clinic of Internal Medicine)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>07:30-08:20</td>
                                                                    <td class="bold">
                                                                        Bupropion+Naltrexone: Using a Phenotype-guided
                                                                        Approach for the Treatment of Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Seo Young Kang</p> (Eulji
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>08:20-08:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_1_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>08:30-09:10</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 1</p>
                                                    <p><span class="bold">Chairperson : Kyu Rae Lee</span> (Gachon
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer : Jang Won Son (The Catholic University of
                                                        Korea, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Thiruma V. Arumugam, a distinguished researcher in
                                                            the fields of physiology and pharmacology at La Trobe
                                                            University, Australia, is pushing the boundaries of
                                                            neuroscience and metabolism. In his upcoming lecture, he
                                                            will discuss how his work on intermittent metabolic
                                                            switching has enhanced our comprehension of its effect on
                                                            brain health, paving the way for potential therapeutic
                                                            interventions.</li>
                                                        <li>His recent publication in Theranostics, titled
                                                            "Time-restricted feeding modulates the DNA methylation
                                                            landscape, attenuates hallmark neuropathology and cognitive
                                                            impairment in a mouse model of vascular dementia," has
                                                            presented novel insights into the therapeutic potential of
                                                            intermittent metabolic switching, offering promising
                                                            strategies for managing and potentially reversing cognitive
                                                            impairment in dementia.</li>
                                                        <li>Further expanding our understanding, Professor Arumugam's
                                                            article in Cell Metabolism, "Hallmarks of Brain Aging:
                                                            Adaptive and Pathological Modification by Metabolic States,"
                                                            continues to revolutionize our perspective on the role of
                                                            metabolism in brain aging.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>08:30-09:00</td>
                                                                    <td class="bold">
                                                                        Intermittent Metabolic Switching and Brain
                                                                        Health
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Thiruma V. Arumugam</p>(La Trobe
                                                                        University, Australia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:00-09:10</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>09:10-09:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 3 : Digital Therapeutics</p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Won Young Lee</span>
                                                        (Sungkyunkwan University, Republic of Korea),<br />
                                                        <span class="bold">Sang-Yong Kim</span> (Chosun University,
                                                        Republic of Korea)
                                                    </p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Sang Youk Rhee (Kyung Hee University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>This session aims to explore the latest status of
                                                            intervention methodology based on Information and
                                                            Communication Technologies (ICTs) for the management of
                                                            diverse chronic diseases, such as obesity and metabolic
                                                            syndrome. First, Professor Ki-Hyun Jeon from Seoul National
                                                            University will open the session by introducing the latest
                                                            research advancements in the related field, including his
                                                            own studies. Doctor Laura Falvey from Reset Health will then
                                                            present highly reliable evidence for the remarkable effects
                                                            of digital treatment methods based on the results of
                                                            randomized controlled trials (RCTs) from the Roczen
                                                            Programme, which were recently released at the European
                                                            Congress on Obesity. Lastly, Professor Sang Youl Rhee from
                                                            Kyung Hee University will discuss the effectiveness of the
                                                            ICT-based intervention and the necessary approaches for
                                                            their wide use in various chronic disease patients in the
                                                            future, drawing on a wealth of literature introduced thus
                                                            far, including systematic literature reviews.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        The Role of Digital Innovations in Obesity and
                                                                        Metabolic Syndrome Treatment
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ki-Hyun Jeon</p>(Seoul National
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        The Roczen Programme: A Digitally-Enabled,
                                                                        Medically Led Intervention for Obesity and T2DM
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Laura Falvey</p>(Reset Health,
                                                                        UK)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        Management of Obesity and Metabolic Diseases
                                                                        through Digital Intervention: Current Evidence
                                                                        and Future Prospects
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sunyoung Kim</p>(Kyung Hee
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sang Youl Rhee</p>(Kyung Hee
                                                                        University, Republic of Korea),
                                                                        <p class="bold">Hyunji Sang</p>(Kyung Hee
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>10:50-11:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li class="opening_address_3">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>11:00-11:10</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Opening Address</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_1_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>11:10-11:50</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 1</p>
                                                    <p><span class="bold">Chairperson : Sung Soo Kim</span> (Chungnam
                                                        National University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Matthias Blüher is Head of the Obesity Outpatient Clinic for
                                                            Adults at the University of Leipzig Department of Medicine
                                                            in Leipzig, Germany. He is Professor of Molecular
                                                            Endocrinology, with board certifications in Internal
                                                            Medicine, Endocrinology and Diabetology. From 2006 to 2012,
                                                            Professor Blüher served as Head of the Clinical Research
                                                            Group ‘Atherobesity,’ and since 2013, he has been Speaker of
                                                            the Collaborative Research Center on obesity mechanisms.
                                                        </li>
                                                        <li>Professor Blüher has won several awards, including the
                                                            Obesity Research Award of the German Society for the Study
                                                            of Obesity, the Ferdinand-Bertram-Prize of the German
                                                            Diabetes Association, and the Rising Star Lecture at the
                                                            44th European Association for the Study of Diabetes (EASD)
                                                            meeting. More recently, he received the Hans Christian
                                                            Hagedorn Award from the German Diabetes Association in 2011
                                                            and the Minkowski Award from the EASD in 2015.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Blüher M, Aras M, Aronne LJ, Batterham RL, Giorgino F, Ji
                                                            L, Pietiläinen KH, Schnell O, Tonchevska E, Wilding JPH. New
                                                            insights into the treatment of obesity. Diabetes Obes Metab.
                                                            2023 Apr 13. doi: 10.1111/dom.15077.<br />
                                                            2. Blüher M. Metabolically Healthy Obesity. Endocr Rev. 2020
                                                            May 1;41(3):bnaa004.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:10-11:40</td>
                                                                    <td class="bold">
                                                                        Adipose Tissue – A Treasure Box for Discoveries
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Matthias Blüher</p>
                                                                        (University of Leipzig, Germany)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>11:40-11:50</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>11:50-12:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="luncheon_symposium_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>12:00-13:00</td>
                                                <td>
                                                    <p class="font_20 bold">Luncheon Symposium 3</p>
                                                    <p><span class="bold">Chairperson : Jae-Heon Kang</span>
                                                        (Sungkyunkwan University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>12:00-13:00</td>
                                                                    <td class="bold">
                                                                        Optimum Clinical Approach to Combination-Use of
                                                                        SGLT2i+DPP4i for T2D Patients with Sidapvia
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Soo Kyoung Kim</p>(Gyeongsang
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>13:00-14:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_7">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>14:00-15:30</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 7 : Metabolic Signaling in
                                                        Obesity-related Diseases</p>
                                                    <p><span class="bold">Chairpersons : Chul Sik Kim</span> (Yonsei
                                                        University, Republic of Korea), <br><span class="bold">Yun-Hee
                                                            Lee</span> (Seoul National University, Republic of Korea)
                                                    </p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer : Yun-Hee Lee (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>This conference session will explore the intriguing topic of
                                                            "Metabolic Signaling in Obesity-related Diseases." Our
                                                            esteemed speakers will present cutting-edge research and
                                                            share their valuable insights. Our first speaker, Dr. Zach
                                                            Gerhart-Hines, will showcase his recent accomplishments in
                                                            the exploration of novel GPCR pathways for the treatment of
                                                            obesity and type 2 diabetes. </li>
                                                        <li>Next, we have Dr. EH Koh, who will enlighten the audience
                                                            about the pivotal role of the NLRP3 inflammasome in adipose
                                                            tissue. Lastly, our final speaker Dr. JK Seong will delve
                                                            into the metabolic roles of the microbiota in obesity mouse
                                                            models., offering potential avenues for future research and
                                                            treatment options.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br>
                                                            1. Gerhart-Hines Z et al. Lipolysis drives expression of the
                                                            constitutively active receptor GPR3 to induce adipose
                                                            thermogenesis. Cell. 2021 Jun 24;184(13):3502-3518.e33.<br>
                                                            2. Koh EH, Lee KU et al. Mitophagy deficiency increases
                                                            NLRP3 to induce brown fat dysfunction in mice. Autophagy.
                                                            2021 May;17(5):1205-1221.<br>
                                                            3. Seong JK. et al. Bifidobacterial carbohydrate/nucleoside
                                                            metabolism enhances oxidative phosphorylation in white
                                                            adipose tissue to protect against diet-induced obesity.
                                                            Microbiome. 2022 Nov 4;10(1):188.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:00-14:25</td>
                                                                    <td class="bold">
                                                                        Uncovering Novel GPCR Pathways for the Treatment
                                                                        of Obesity and Type 2 Diabetes
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Zachary Gerhart-Hines</p>
                                                                        (University of Copenhagen, Denmark)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:25-14:50</td>
                                                                    <td class="bold">
                                                                        The Double-edged Role of the NLRP3 Inflammasome
                                                                        in Adipose Tissue
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Eun Hee Koh</p>(University of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:50-15:15</td>
                                                                    <td class="bold">
                                                                        Microbiota in Obesity-related Metabolic Diseases
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Je Kyung Seong</p>(Seoul
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:15-15:30</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Dughyun Choi</p>(Soonchunhyang
                                                                        University, Republic of Korea),<br />
                                                                        <p class="bold">Hye Yeon Koo</p>(Seoul National
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>15:30-15:40</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_2_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>15:40-16:20</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 2</p>
                                                    <p><span class="bold">Chairperson : Jeong-Taek Woo</span> (Kyung Hee
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Il-Young Kim (Gachon University, Republic
                                                        of Korea)</p>
                                                    <ul>
                                                        <li>Prof. Wolfe is widely respected as the world’s foremost
                                                            authority on stable isotope tracer methodology and on amino
                                                            acid/protein nutrition. His research focuses on the
                                                            regulation of muscle metabolism, particularly as affected by
                                                            aging, obesity, insulin resistance, and stressors such as
                                                            sepsis and cancer in humans. Prof. Wolfe has developed
                                                            numerous metabolic tracing models using stable isotope
                                                            tracers to quantify a variety of metabolic processes in
                                                            humans, which has formed the foundation of our understanding
                                                            of many aspects of normal and abnormal metabolism of
                                                            glucose, fatty acid, and amino acid/protein in humans. In
                                                            his plenary lecture, the particular emphasis will be placed
                                                            on the response of fatty acid kinetics to different
                                                            conditions (exercise, glucose intake, obesity) in the
                                                            context of the triglyceride-fatty acid cycle, with his more
                                                            than 50 years of experience in the human metabolic research.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Kim IY et al., Tracing metabolic flux in vivo: basic
                                                            model structures of tracer methodology. 2022
                                                            Sep;54(9):1311-1322. doi: 10.1038/s12276-022-00814-z.<br />
                                                            2. Miyoshi H et al., Hormonal control of substrate cycling
                                                            in humans, J Clin Invest. 1988. 1988 May;81(5):1545-55. doi:
                                                            10.1172/JCI113487.<br />
                                                            3. Sidossis LS, Wolfe RR. Glucose and insulin-induced
                                                            inhibition of fatty acid oxidation: the glucose-fatty acid
                                                            cycle reversed. Am J Physiol. 1996 Apr;270(4 Pt 1):E733-8.
                                                            doi: 10.1152/ajpendo.1996.270.4.E733. PMID: 8928782.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:40-16:10</td>
                                                                    <td class="bold">
                                                                        Understanding Human Metabolic Dysregulation in
                                                                        Vivo Using Stable Isotope Tracers: More than 50
                                                                        Years of Experience
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Robert R. Wolfe</p>(University
                                                                        of Arkansas for Medical Sciences, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:10-16:20</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:20-16:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_11">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>16:30-18:00</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 11 : Social and Environmental
                                                        Determinants: Nutritional View of Obesity</p>
                                                    <p><span class="bold">Chairpersons : Cho-il Kim</span> (Seoul
                                                        National University, Republic of Korea), <br><span
                                                            class="bold">Eun Mi Kim</span> (Kangbuk Samsung Hospital,
                                                        Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>16:30-16:55</td>
                                                                    <td class="bold">
                                                                        Social Determinants of Health and Obesity and
                                                                        Approaches to Obesity Prevention and Management
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Seung-Yeon Lee</p>(University of
                                                                        Cincinnati, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:55-17:20</td>
                                                                    <td class="bold">
                                                                        Influence of Social and Environmental Factors on
                                                                        Nutrition and Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ji-Yun Hwang</p>(Sangmyung
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:20-17:45</td>
                                                                    <td class="bold">
                                                                        Socioeconomic Inequalities in Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hyeon Chang Kim</p>(Yonsei
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:45-18:00</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Oh Yoen Kim</p>(Dong-A
                                                                        University, Republic of Korea),<br />
                                                                        <p class="bold">Min-Jeong Shin</p>(Korea
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="symposium_4">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 4 : The Myosteatosis: Novel Aspect
                                                        of Sarcopenia and Obesity</p>
                                                    <p><span class="bold">Chairpersons : Hyuk-Sang Kwon</span> (The
                                                        Catholic University of Korea, Republic of Korea), <br><span
                                                            class="bold">Jee-Hyun Kang</span> (Konyang University,
                                                        Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer : Chang Hee Jung (University of Ulsan,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Numerous studies have been conducted on the association
                                                            between the decline in muscle mass, known as sarcopenia, and
                                                            cardio-metabolic diseases. Recently, there has been a
                                                            growing interest in the quality of muscles, as research
                                                            findings suggest that muscle quality is important in various
                                                            aspects, in addition to muscle mass reduction.</li>
                                                        <li>Myosteatosis, an important factor determining muscle
                                                            quality, has emerged as a risk factor for new
                                                            cardio-metabolic diseases beyond sarcopenia. In this
                                                            session, we aim to explore the prevalence of myosteatosis
                                                            and its relationship with cardio-metabolic diseases.
                                                            Furthermore, we aim to investigate its significance by
                                                            comparing it with the accumulation of other ectopic fats.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br>
                                                            1. Age-related changes in muscle quality and development of
                                                            diagnostic cutoff points for myosteatosis in lumbar skeletal
                                                            muscles <br>
                                                            measured by CT scan Clin Nutr. 2021 Jun;40(6):4022-4028.<br>
                                                            2. Association between sarcopenic obesity and poor muscle
                                                            quality based on muscle quality map and abdominal computed
                                                            tomography. Obesity (Silver Spring). 2023
                                                            Jun;31(6):1547-1557.<br>
                                                            Fat Distribution Patterns and Future Type 2 Diabetes
                                                            Diabetes. 2022 Sep 1;71(9):1937-1945
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        Changes in Body Composition with Aging: Visceral
                                                                        Fat Obesity, Low Muscle Mass, and Myosteatosis
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hong-Kyu Kim</p>(University of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        Clinical Implications of Myosteatosis in
                                                                        Cardiometabolic Health
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Chang Hee Jung</p>(University of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        New Insights into Fat Distribution: An
                                                                        Integrated Analysis of Hepatic, Pancreatic,
                                                                        Muscular, and Visceral Fat
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hajime Yamazaki</p>(Kyoto
                                                                        University, Japan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yun-Hee Lee</p>(Seoul National
                                                                        University, Republic of Korea), <br>
                                                                        <p class="bold">Kye-Yeung Park</p>(Hanyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="oral_presentation_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_orange_bg">
                                                <td>13:00-14:00</td>
                                                <td>
                                                    <p class="font_20 bold">Oral Presentation 1</p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Yeong Sook Yoon</span> (Inje
                                                        University, Republic of Korea), <br><span class="bold">Yang-Im
                                                            Hur</span> (CHA University, Republic of Korea)
                                                    </p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>13:00-13:10</td>
                                                                    <td class="bold">Late Night Eaters are Canaries in
                                                                        Coal Mine for Metabolic Predisposition to Human
                                                                        obesity, T2DM and Cardio-Metabolic Disorders
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Qulsoom Naz</p>(King Georges
                                                                        Medical University, India)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:10-13:20</td>
                                                                    <td class="bold">Effectiveness of SGLT-2 Inhibitors
                                                                        and GLP-1 Receptor Agonists in Obesity: A
                                                                        Retrospective Cohort Study</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Minji Sohn</p>(Seoul National
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:20-13:30</td>
                                                                    <td class="bold">Successful vs. Unsuccessful Weight
                                                                        Loss Maintainers: A finding from a Hybrid
                                                                        Mindfulness-Integrated Weight Loss Intervention
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Siti Munirah Abdul Basir</p>
                                                                        (Universiti Kebangsaan Malaysia, Malaysia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:30-13:40</td>
                                                                    <td class="bold">The Association between Normal
                                                                        Weight Obesity and Metabolic Syndrome in Korean
                                                                        Adults</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Seamon Kang</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:40-13:50</td>
                                                                    <td class="bold">Overall Obesity, Abdominal Obesity,
                                                                        and the 10-Year Cardiovascular Disease Risk in
                                                                        the Indonesian Population: Analysis of the 2018
                                                                        Indonesian National Health Survey</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Fathimah Sulistyowati Sigit </p>
                                                                        (Universitas Indonesia, Indonesia)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_8">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>14:00-15:30</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 8 : Long-term Weight Loss Results
                                                        and Problems in Asia</p>
                                                    <p><span class="bold">Chairpersons : Sang Kwon Lee</span> (Daejeon
                                                        Catholic University, Republic of Korea), <br><span
                                                            class="bold">Seung-Wan Ryu</span> (Keimyung University,
                                                        Republic of Korea)</p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:00-14:25</td>
                                                                    <td class="bold">
                                                                        Long-term Outcomes and Problems of Sleeve
                                                                        Gastrectomy
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yosuke Seki</p>(Yotsuya Medical
                                                                        Cube, Japan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:25-14:50</td>
                                                                    <td class="bold">
                                                                        From Gastric bypass to Sleeve Plus
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Chih-Kun Huang</p>(China Medical
                                                                        University, Taiwan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:50-15:15</td>
                                                                    <td class="bold">
                                                                        Sleeve Conversion to Bypass or Sleeve Plus
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Han Hong Lee</p>(The Catholic
                                                                        University of Korea, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:15-15:30</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">HanMo Yoo</p>(The Catholic
                                                                        University of Korea, Republic of Korea), <br>
                                                                        <p class="bold">Sol Lee</p>(Seoul Medical
                                                                        Center, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_12">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>16:30-18:00</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 12 : Obesity: Transition from
                                                        Adolescence to Young Adult</p>
                                                    <p><span class="bold">Chairpersons : Kee-Hyoung Lee</span> (Korea
                                                        University, Republic of Korea), <br><span class="bold">So
                                                            ChungChung</span> (Konkuk University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Jae Hyun Kim (Seoul National University,
                                                        Republic of Korea), Yong Hee Hong (Soonchunhyang University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>As obesity in children and adolescents increases, we should
                                                            take note of its development into obesity in adults, as well
                                                            as its connection with type 2 diabetes in adolescents and
                                                            young adults. In this session, we will explore the lifecycle
                                                            perspective of obesity and type 2 diabetes, starting from
                                                            childhood to adulthood, and gain an understanding of glucose
                                                            patterns in children and adolescents with obesity and
                                                            diabetes through continuous glucose measurement.
                                                            Additionally, we will discuss recent advancements in new
                                                            biomarkers associated with type 2 diabetes in obese children
                                                            and adolescents.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Choi D, Kim S, Woo J, et al. Weight Change Alters the
                                                            Small RNA Profile of Urinary Extracellular Vesicles in
                                                            Obesity. Obes Facts. 2022;15(2):292-301.<br /> 2. Choi IH,
                                                            Yeom SW, Kim SY, You J, Kim JS, Kim M. Analysis of
                                                            Cause-of-Death Mortality in Children and Young Adults with
                                                            Diabetes: A Nationwide 10-Year Follow-Up Cohort Study.
                                                            Children (Basel). 2023;10(2):358.<br /> 3. Leister KR,
                                                            Cilhoroz BT, Rosenberg J, Brown EC, Kim JY. Metabolic
                                                            syndrome: Operational definitions and aerobic and resistance
                                                            training benefits on physical and metabolic health in
                                                            children and adolescents. Diabetes Metab Syndr.
                                                            2022;16(6):102530.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>16:30-16:55</td>
                                                                    <td class="bold">
                                                                        Facing Obesity and Type 2 Diabetes: From
                                                                        Childhood to Adulthood
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Dughyun Choi</p>(Soonchunhyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:55-17:20</td>
                                                                    <td class="bold">
                                                                        Continuous Glucose Monitoring to Understand
                                                                        Obese and Diabetic Adolescents
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Minsun Kim</p>(Jeonbuk National
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:20-17:45</td>
                                                                    <td class="bold">
                                                                        Emerging Biomarkers of Type 2 Diabetes in Obese
                                                                        Youth vs Adult
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Joon Young Kim</p>(Syracuse
                                                                        University, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:45-18:00</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Byoungduck Han</p>(Korea
                                                                        University, Republic of Korea),<br />
                                                                        <p class="bold">Yong Hyuk Kim</p>(Yonsei
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="sponsored_session_1">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Sponsored Session 1 : Journey to the
                                                        Combination Phentermine plus Topiramate ER from Clinical Trials
                                                        to Practice</p>
                                                    <p><span class="bold">Chairpersons : Suk Chon</span> (Kyung Hee
                                                        University, Republic of Korea), <br><span class="bold">Jae
                                                            Hyoung Cho</span> (The Catholic University of Korea,
                                                        Republic of Korea)</p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:50</td>
                                                                    <td class="bold">
                                                                        Phentermine plus Topiramate ER Review & More
                                                                        Expectation
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Su Jin Jeong</p>(Sejong General Hospital, Bucheon, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:50-10:20</td>
                                                                    <td class="bold">
                                                                        Exploring the Efficacy of Phentermine plus
                                                                        Topiramate ER in Treating Obesity: Real Cases
                                                                        from Korea
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Kyoung Min Kim</p>(Yonsei
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:20-10:50</td>
                                                                    <td class="bold">
                                                                        FAQ Finder : A Case-based Approach to
                                                                        Prescription of Combination Phentermine plus
                                                                        Topiramate ER
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sohyun Chun</p>(Samsung Medical
                                                                        Center, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="oral_presentation_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_orange_bg">
                                                <td>13:00-14:00</td>
                                                <td>
                                                    <p class="font_20 bold">Oral Presentation 2</p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Jang Won Son</span> (The
                                                        Catholic University of Korea, Republic of Korea), <br><span
                                                            class="bold">Jung Hwan Park</span> (Hanyang University,
                                                        Republic of Korea)
                                                    </p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>13:00-13:10</td>
                                                                    <td class="bold">Impaired Autophagy Flux Contributes
                                                                        to Enhanced Ischemia Reperfusion Injury in the
                                                                        Diabetic Heart</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hyekyoung Sung</p>(York
                                                                        University, Canada)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:10-13:20</td>
                                                                    <td class="bold">Mitigation of Hepatic Steatosis and
                                                                        Dyslipidemia by Hesperidin in High-Fat High
                                                                        Fructose Diet via Al Altering Genes Expression
                                                                        Related to Lipid Metabolism</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Deepika Singh</p>(Sam
                                                                        Higginbottom University of Agriculture,
                                                                        Technology And Sciences, India)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:20-13:30</td>
                                                                    <td class="bold">Vutiglabridin, an Autophagy
                                                                        Activator, Enhances Fat Reduction and Normalizes
                                                                        Body Weight in DIO mice when Combined with
                                                                        Calorie Restriction</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hyung Soon Park</p>(Glaceum
                                                                        Inc.., Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:30-13:40</td>
                                                                    <td class="bold">Health Effects of Alternate-Day
                                                                        Fasting and Pair-Fed Isocaloric Consumption in
                                                                        High-Fat Diet-Induced Obese C57BL/6NTac Mice
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hadia Nawaz</p>(Hanyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:40-13:50</td>
                                                                    <td class="bold">Thigh Muscle Fat Density as a
                                                                        Predictor of Vascular Events in Korean Adults
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hun Jee Choe</p>(Dongtan Sacred
                                                                        Heart Hospital, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="sponsored_session_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>14:00-15:30</td>
                                                <td>
                                                    <p class="font_20 bold">Sponsored Session 2 : Benefit of DPP4I in
                                                        Evidence-based Perspective</p>
                                                    <p><span class="bold">Chairpersons : Jaehyeock Lee</span> (Myongji
                                                        Hospital, Republic of Korea), <br> <span class="bold">Jun Hwa
                                                            Hong</span>(Eulji University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:00-14:30</td>
                                                                    <td class="bold">
                                                                        Key Factors on Glucose Management in
                                                                        Evidence-based Perspective
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jung Hwan Park</p> (Hanyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:30-15:00</td>
                                                                    <td class="bold">
                                                                        Role of DPP4-I under the Latest Treatment Trend
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Eun Roh</p>(Hallym University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:00-15:30</td>
                                                                    <td class="bold">
                                                                        How to Find the Optimal Combination Therapy with
                                                                        DPP4-I
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jong Han Choi</p>(Konkuk
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="obesity_treatment_guidelines_symposium">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="purple_bg">
                                                <td>16:30-18:00</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Obesity Treatment Guidelines Symposium : <br>Behind the Scenes: The Journey of Evolution and Revising Obesity Guidelines</p>
                                                    <p><span class="bold">Chairpersons : Chong Hwa Kim</span> (Sejong General Hospital, Bucheon, Republic of Korea), <br><span class="bold">Hyuktae Kwon</span> (Seoul National University, Republic of Korea)</p>
													<!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>16:30-16:55</td>
                                                                    <td class="bold">
                                                                        Update of JASSO’s Guidelines in Accordance with
                                                                        Unmet Needs for Obesity Treatment
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yasushi Ishigaki</p>(Iwate
                                                                        Medical University, Japan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:55-17:20</td>
                                                                    <td class="bold">
                                                                        Update on Obesity Guidelines: What We Need Else?
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Luca Busetto</p>(University of
                                                                        Padova, Italy)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:20-17:45</td>
                                                                    <td class="bold">
                                                                        Unveiling the Process of Establishing Clinical
                                                                        Practice Guidelines for Obesity by KSSO
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jee Hyun Kang</p>(Konyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:45-18:00</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jun Hwa Hong</p>(Eulji
                                                                        University, Republic of Korea),<br />
                                                                        <p class="bold">Yang-Im Hur</p>(CHA University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="joint_symposium_EASO">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="purple_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Joint Symposium KSSO-EASO<br />Decoding
                                                        Weight Regain in Obesity Management: Key Insights and Strategies
                                                    </p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Cheol-Young Park</span>
                                                        (Sungkyunkwan University, Republic of Korea),<br />
                                                        <span class="bold">Jason Halford</span> (University of Leeds,
                                                        UK)
                                                    </p>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">Biological Mechanisms of Weight
                                                                        Regain</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Luca Busetto</p> (University of
                                                                        Padova, Italy)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">Management of Weight Regain</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jun Hwa Hong</p> (Eulji
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">Effects of New Drugs on Appetite
                                                                        and Eating Behaviour</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jason Halford</p> (University of
                                                                        Leeds, UK)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Se Hee Min</p>(Univeristy of
                                                                        Ulsan, Republic of Korea),<br>
                                                                        <p class="bold">Jungha Park</p>(Kyung Hee
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="joint_symposium_AOASO_1">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="purple_bg">
                                                <td>14:00-15:30</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Joint Symposium KSSO-AOASO<br />The
                                                        Contemporary Landscape of Obesity Management in the
                                                        Asian-Oceanian Region</p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Kyoung-Kon Kim</span> (Gachon
                                                        University, Republic of Korea),<br />
                                                        <span class="bold">Yoon Jeong Cho</span> (Daegu Catholic
                                                        University, Republic of Korea)
                                                    </p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:00-14:25</td>
                                                                    <td class="bold">Tackling Obesity in Malaysia. Are
                                                                        We Doing Enough?</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Geeta Appannah</p>(University
                                                                        Putra Malaysia, Malaysia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:25-14:50</td>
                                                                    <td class="bold">
                                                                        Prevention of Obesity among School-aged Children
                                                                        in Vietnam: Experiences in Developing
                                                                        Nutrition-related Policy
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Do Thi Ngoc Diep</p>(Vietnam
                                                                        Nutrition Association, Vietnam)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:50-15:15</td>
                                                                    <td class="bold">Current Status and Facts of Obesity
                                                                        Prevalence for Obesity Prevention and Management
                                                                        in Korea</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hae-Jin Ko</p>(Kyungpook
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:15-15:30</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Chang Hee Jung</p>(University of
                                                                        Ulsan, Republic of Korea),<br />
                                                                        <p class="bold">Won Yoon Suh</p>(Chungnam
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="congress_banquet_ceremony">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>18:30-20:30</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Congress Banquet <span
                                                            class="font_inherit red_txt">*</span>Invited Only</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="guided_poster_presentation_1">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_orange_bg">
                                                <td>13:00-14:00</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Guided Poster Presentation 1</p>
                                                    <p><span class="bold">Chairperson : Ga Eun Nam</span> (Korea
                                                        University, Republic of Korea)</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>13:00-13:10</td>
                                                                    <td class="bold">Contribution of Inactivity
                                                                        Associated with Disaster to Obesity: A Five-Year
                                                                        Longitudinal Changes in Body Composition</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Makoto Ayabe</p>(Okayama
                                                                        Prefectural University, Japan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:10-13:20</td>
                                                                    <td class="bold">Systemic Approach of Chronic
                                                                        Inflammation, Macrophage and Mitochondrial
                                                                        Dysfunction, and Their Role in Obesity-Induced
                                                                        Insulin Resistance</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Heekyong Bae</p>(Kyungpook
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:20-13:30</td>
                                                                    <td class="bold">Skatole Mitigates Lipotoxicity in
                                                                        Hepatocytes Induced by Free Fatty Acids</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sin Hyoung Hong</p>(Korea Basic
                                                                        Science Institute, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:30-13:40</td>
                                                                    <td class="bold">Iron Profiles and Inflammatory
                                                                        Biomarkers in Malaysian Primary School-Aged
                                                                        Children with Overweight and Obesity: Findings
                                                                        from SEANUTS II</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Wan Siti Fatimah binti Wan Abdul
                                                                            Rahman</p>(Universiti Kebangsaan Malaysia,
                                                                        Malaysia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:40-13:50</td>
                                                                    <td class="bold">Depletion of Ahcyl1 in Brown
                                                                        Adipose Tissue Improves Metabolic Health</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Soo Kyung Kang</p>(Seoul
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab_cont">
                <ul class="tab_li">
                    <li class="on"><a href="javascript:;">Room1</a></li>
                    <li><a href="javascript:;">Room2</a></li>
                    <li><a href="javascript:;">Room3</a></li>
                    <li><a href="javascript:;">Room4</a></li>
                    <li><a href="javascript:;">Room5</a></li>
                    <li><a href="javascript:;">Room6</a></li>
                    <li><a href="javascript:;">Room7</a></li>
                </ul>
                <div class="tab_wrap">
                    <div class="tab_cont on">
                        <ul class="program_detail_ul">
                            <li name="breakfast_symposium_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>07:30-08:20</td>
                                                <td>
                                                    <p class="font_20 bold">Breakfast Symposium 3</p>
                                                    <p><span class="bold">Chairperson : Seong Ho Han</span> (Dong-A
                                                        University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>07:30-08:20</td>
                                                                    <td class="bold">
                                                                        Thiazolidinediones and SGLT2i: A Rational
                                                                        Combination Based on T2DM Pathophysiology
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jun Hwa Hong</p>(Eulji
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>08:20-08:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>08:30-09:10</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 3</p>
                                                    <p><span class="bold">Chairperson : Hye Soon Park</span> (University
                                                        of Ulsan, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Jae Geun Kim (Incheon National
                                                        University, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Tamas Horvath is Chair of the Department of
                                                            Comparative Medicine at Yale University School of Medicine
                                                            in the United States and one of the leading researchers in
                                                            the field of study on the hypothalamic control of energy
                                                            homeostasis. In particular, his research on the regulation
                                                            of synaptic plasticity by AgRP neurons in hypothalamic
                                                            neuronal circuitries is one of his most noteworthy
                                                            accomplishments. In this session, Professor Horvath will
                                                            introduce the role of hypothalamic AgRP neurons that can be
                                                            applied to obesity treatment.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Hunger-promoting AgRP neurons trigger an
                                                            astrocyte-mediated feed-forward autoactivation loop in mice.
                                                            J Clin Invest. 2021 <br />
                                                            2. AgRP neurons control compulsive exercise and survival in
                                                            an activity-based anorexia model. Nature Metabolism. 2020.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>08:30-09:00</td>
                                                                    <td class="bold">
                                                                        The Role of Hunger-promoting Hypothalamic
                                                                        Neurons in Obesity Therapeutics
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Tamas Horvath</p>(Yale
                                                                        University, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:00-09:10</td>
                                                                    <td class="bold">
                                                                        Q&A
                                                                    </td>
                                                                    <td class="text_r">

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>09:10-09:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_13">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 13 : Health Consequences of
                                                        Obesity</p>
                                                    <p><span class="bold">Chairpersons : Seungjoon Oh</span> (Kyung Hee
                                                        University, Republic of Korea), <br><span class="bold">Won Jun
                                                            Kim</span> (University of Ulsan, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer : Jun Hwa Hong (Eulji University, Republic
                                                        of Korea)</p>
                                                    <ul>
                                                        <li>In this session, we will explore the relationship between
                                                            fatty liver associated with obesity and its diverse
                                                            complications. Considering the recently increasing
                                                            prevalence and growing interest in treatment of chronic
                                                            kidney disease due to the introduction of SGLT2i, Professor
                                                            Sang-Man Jin from Sungkyunkwan University School of Medicine
                                                            will present data analyzing non-alcoholic fatty liver
                                                            disease (NAFLD) and metabolic dysfunction-associated fatty
                                                            liver disease (MAFLD) in relation to the cause of incident
                                                            chronic kidney disease.</li>
                                                        <li>Professor Ming-Hua Zheng from China will analyze and present
                                                            differences in implications for cardiovascular risk based on
                                                            the cause of fatty liver. Particularly, Professor Bo-Kyung
                                                            Koo from Seoul National University College of Medicine will
                                                            explore data on factors related to the prognosis of
                                                            cardiovascular and kidney disease, given the diverse impacts
                                                            that complications in NAFLD patients have on cardiovascular
                                                            and kidney conditions as well as liver condition.</li>
                                                        <li> We hope this session will assist you in managing the
                                                            complications associated with MAFLD.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br>
                                                            1. MAFLD and NAFLD in the prediction of incident chronic
                                                            kidney disease. Sci Rep. 2023 Jan 31;13(1):1796.<br>
                                                            2. Metabolic dysfunction-associated fatty liver disease and
                                                            implications for cardiovascular risk and disease prevention.
                                                            Cardiovasc Diabetol. 2022 Dec 3;21(1):270.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        MAFLD and NAFLD in the Prediction of CKD, DM,
                                                                        and Diastolic Dysfunction
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sang-Man Jin</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        Real-world Data Applications in Glucose
                                                                        Tolerance Status, MAFLD and Cardiovascular
                                                                        Disease?
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Kazuya Fujihara</p>(Niigata
                                                                        University, Japan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        Determinants of the Prognosis of NAFLD
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Bo Kyung Koo</p>(Seoul National
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jun Hwa Hong</p>(Eulji
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>10:50-11:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>11:00-11:40</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 2</p>
                                                    <p><span class="bold">Chairperson : Kwan Woo Lee</span> (Ajou
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea), Jun Hwa Hong (Eulji University, Republic of
                                                        Korea)</p>
                                                    <ul>
                                                        <li>The interplay between adipose tissue's function as an energy
                                                            reservoir and an endocrine organ is crucial for maintaining
                                                            metabolic health. A key player in this dynamic balance is
                                                            leptin, a hormone whose regulation is tightly linked to fat
                                                            mass. Here we will discuss the multifaceted role of
                                                            LATS1/2-YAP/TAZ signaling in regulating adipocyte plasticity
                                                            and leptin production to maintain metabolic homeostasis.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br>
                                                            1. Sethi, J.K. and A.J. Vidal-Puig, Thematic review series:
                                                            adipocyte biology. Adipose tissue function and plasticity
                                                            orchestrate nutritional adaptation. J Lipid Res, 2007.
                                                            48(6): p. 1253-62.<br>
                                                            2. Halder, G. and R.L. Johnson, Hippo signaling: growth
                                                            control and beyond. Development, 2011. 138(1): p. 9-22.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:00-11:30</td>
                                                                    <td class="bold">
                                                                        Decoding Adipocyte Plasticity: YAP/TAZ's Dual
                                                                        Control over Energy Storage and Leptin
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae Myoung Suh</p>(KAIST,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>11:30-11:40</td>
                                                                    <td class="bold">
                                                                        Q&A
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold"></p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>11:40-11:50</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="luncheon_symposium_4">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>11:50-12:50</td>
                                                <td>
                                                    <p class="font_20 bold">Luncheon Symposium 4</p>
                                                    <p><span class="bold">Chairperson : Kwang-Won Kim</span> (Gachon
                                                        University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:50-12:50</td>
                                                                    <td class="bold">
                                                                        In-Depth Review of Phentermine plus Topiramate
                                                                        ER
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sung Hoon Yu</p>(Hanyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>12:50-13:50</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>13:50-14:30</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 3</p>
                                                    <p><span class="bold">Chairperson : Soon-Jib Yoo</span> (The
                                                        Catholic University of Korea, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Hyung Jin Choi (Seoul National
                                                        University, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Zachary Knight is a pioneer in the field of
                                                            elucidating the neural mechanisms of appetite, homeostasis,
                                                            and obesity, having published some of the finest research in
                                                            Nature, Cell, and elsewhere over the past few years. His use
                                                            of potent neuroscience tools is always accompanied by a
                                                            profound understanding of concepts related to appetite. In
                                                            this keynote lecture, he will present his most recent
                                                            findings regarding the function of neural circuits in the
                                                            brainstem in regulating eating behavior.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Nature. Dopamine subsystems that track internal states.
                                                            2022<br />
                                                            2. Cell. Genetic identification of vagal sensory neurons
                                                            that control feeding. 2019
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>13:50-14:20</td>
                                                                    <td class="bold">Brainstem Circuits that Control
                                                                        Ingestion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Zachary Knight</p>(University of
                                                                        California, San Francisco, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:20-14:30</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_4">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>14:30-15:10</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 4</p>
                                                    <p><span class="bold">Chairperson : Young kil Choi</span> (Kyung Hee
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Obesity is not only a serious disease in itself, but also a
                                                            health risk factor that causes various diseases, so
                                                            governmental plan and policy cooperation are needed. Korean
                                                            government established and announced the first national
                                                            obesity management comprehensive plan in 2018 to provide an
                                                            opportunity to raise public awareness of the importance of
                                                            obesity prevention and management and to monitor the
                                                            pregress. In this lecture, I would like to introduce the
                                                            past, present and future of Korea's national obesity
                                                            strategy.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:30-15:00</td>
                                                                    <td class="bold">
                                                                        National Obesity Strategy in Korea: Past,
                                                                        Present and Future
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae-Heon Kang</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:00-15:10</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>15:10-15:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_17">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>15:20-16:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 17 : The Power of Synergy:
                                                        Optimizing Anti-obesity Treatment with Combination
                                                        Pharmacotherapy</p>
                                                    <p><span class="bold">Chairpersons : Cheol-Young Park</span>
                                                        (Sungkyunkwan University, Republic of Korea), <br><span
                                                            class="bold">Chang Hee Jung</span> (Univeristy of Ulsan,
                                                        Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:20-15:45</td>
                                                                    <td class="bold">
                                                                        Unveiling the New Wave: A Comprehensive Overview
                                                                        of Emerging Anti-Obesity Medications
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jang Won Son</p>(The Catholic
                                                                        University of Korea, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:45-16:10</td>
                                                                    <td class="bold">
                                                                        A Phase 1 Randomized, Double-blind
                                                                        placebo-controlled Single and Multiple Ascending
                                                                        Dose Study of AMG 133 in Subjects with Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jennifer Strande</p>(AMGEN, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:10-16:35</td>
                                                                    <td class="bold">A Novel Triple GIP, GLP-1, and
                                                                        Glucagon Receptor Agonist in for Obesity
                                                                        Treatment</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Se Hee Min</p>(Univeristy of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:35-16:50</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Eun Roh</p>(Hallym University,
                                                                        Republic of Korea),<br>
                                                                        <p class="bold">Jun Sung Moon</p>(Yeungnam
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:50-17:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_4">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>17:00-17:40</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 4</p>
                                                    <p><span class="bold">Chairperson : Chang Beom Lee</span> (Hanyang
                                                        University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>17:00-17:30</td>
                                                                    <td class="bold">
                                                                        Current and Future in Obesity Management
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">John Wilding</p>(University of
                                                                        Liverpool, UK)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:30-17:40</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="closing_ceremony">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>17:40-18:00</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Closing & Award Ceremony</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="breakfast_symposium_4">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>07:30-08:20</td>
                                                <td>
                                                    <p class="font_20 bold">Breakfast Symposium 4</p>
                                                    <p><span class="bold">Chairperson : Tae Sun Park</span> (Jeonbuk
                                                        National University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>07:30-08:20</td>
                                                                    <td class="bold">
                                                                        Cutting Edge Care of Pitavastatin with Ezetimibe
                                                                        Combination Therapy
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Young Sang Lyu</p>(Chosun
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>08:20-08:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_3_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>08:30-09:10</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 3</p>
                                                    <p><span class="bold">Chairperson : Hye Soon Park</span> (University
                                                        of Ulsan, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Jae Geun Kim (Incheon National
                                                        University, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Tamas Horvath is Chair of the Department of
                                                            Comparative Medicine at Yale University School of Medicine
                                                            in the United States and one of the leading researchers in
                                                            the field of study on the hypothalamic control of energy
                                                            homeostasis. In particular, his research on the regulation
                                                            of synaptic plasticity by AgRP neurons in hypothalamic
                                                            neuronal circuitries is one of his most noteworthy
                                                            accomplishments. In this session, Professor Horvath will
                                                            introduce the role of hypothalamic AgRP neurons that can be
                                                            applied to obesity treatment.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Hunger-promoting AgRP neurons trigger an
                                                            astrocyte-mediated feed-forward autoactivation loop in mice.
                                                            J Clin Invest. 2021 <br />
                                                            2. AgRP neurons control compulsive exercise and survival in
                                                            an activity-based anorexia model. Nature Metabolism. 2020.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>08:30-09:00</td>
                                                                    <td class="bold">
                                                                        The Role of Hunger-promoting Hypothalamic
                                                                        Neurons in Obesity Therapeutics
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Tamas Horvath</p>(Yale
                                                                        University, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:00-09:10</td>
                                                                    <td class="bold">
                                                                        Q&A
                                                                    </td>
                                                                    <td class="text_r">

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>09:10-09:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_14">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 14 : Promoting Healthy Muscle and
                                                        Liver Metabolism</p>
                                                    <p><span class="bold">Chairpersons : Kijin Kim</span> (Keimyung
                                                        University, Republic of Korea), <br><span class="bold">Yun-A
                                                            Shin</span> (Dankook University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Il-Young Kim (Gachon University, Republic
                                                        of Korea), Seung-Hwan Lee (The Catholic University of Korea,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>In this session, latest research on the important role of
                                                            optimal provision of nutrition (e.g., essential amino acids
                                                            and proteins) and/or exercise for one’s overall metabolic
                                                            health with the focus on skeletal muscle and the liver will
                                                            be discussed. The two most important metabolic organs in the
                                                            body will be discussed by world-renowned metabolic
                                                            researchers who have extensive experience in the use of
                                                            stable isotope tracer methodology and/or traditional
                                                            biological tools in dissecting in vivo human metabolism in
                                                            relation to various aspects of human (animal)
                                                            pathophysiology, such as obesity, insulin resistance, type 2
                                                            diabetes, NAFLD, and sarcopenia.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Weijs PJ, Wolfe RR. Exploration of the protein
                                                            requirement during weight loss in obese adults. Clin Nutr
                                                            35(2):394-8, Apr 2016. PMID:25788405.<br />
                                                            2. Fordham TM et al., Metabolic effects of an essential
                                                            amino acid supplement in adolescents with PCOS and obesity,
                                                            Obesity, 2023 (in revision).<br />
                                                            3. Jang et al., Balanced Free Essential Amino Acids and
                                                            Resistance Exercise Training Synergistically Improve
                                                            Dexamethasone-Induced Impairments in Muscle Strength,
                                                            Endurance, and Insulin Sensitivity in Mice, Int J Mol Sci
                                                            202. PMID: 36077132
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        The Role of Muscle in Weight Management
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Robert R. Wolfe</p>(University
                                                                        of Arkansas for Medical Sciences, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        Effectors of NAFLD Development: Metabolic,
                                                                        Nutritional and Pharmacologic
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Melanie Cree-Green</p>
                                                                        (University of Colorado Anschutz, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        Roles of Dietary Essential Amino Acids and
                                                                        Exercise for Muscle and Metabolic Health
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Il-Young Kim</p>(Gachon
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">Panel Discussion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yong-ho Lee</p>(Yonsei
                                                                        University, Republic of Korea), <br>
                                                                        <p class="bold">Gyuri Kim</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>10:50-11:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_2_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>11:00-11:40</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 2</p>
                                                    <p><span class="bold">Chairperson : Kwan Woo Lee</span> (Ajou
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea), Jun Hwa Hong (Eulji University, Republic of
                                                        Korea)</p>
                                                    <ul>
                                                        <li>The interplay between adipose tissue's function as an energy
                                                            reservoir and an endocrine organ is crucial for maintaining
                                                            metabolic health. A key player in this dynamic balance is
                                                            leptin, a hormone whose regulation is tightly linked to fat
                                                            mass. Here we will discuss the multifaceted role of
                                                            LATS1/2-YAP/TAZ signaling in regulating adipocyte plasticity
                                                            and leptin production to maintain metabolic homeostasis.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br>
                                                            1. Sethi, J.K. and A.J. Vidal-Puig, Thematic review series:
                                                            adipocyte biology. Adipose tissue function and plasticity
                                                            orchestrate nutritional adaptation. J Lipid Res, 2007.
                                                            48(6): p. 1253-62.<br>
                                                            2. Halder, G. and R.L. Johnson, Hippo signaling: growth
                                                            control and beyond. Development, 2011. 138(1): p. 9-22.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:00-11:30</td>
                                                                    <td class="bold">
                                                                        Decoding Adipocyte Plasticity: YAP/TAZ's Dual
                                                                        Control over Energy Storage and Leptin
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae Myoung Suh</p>(KAIST,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>11:30-11:40</td>
                                                                    <td class="bold">
                                                                        Q&A
                                                                    </td>
                                                                    <td class="text_r">

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>11:40-11:50</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="luncheon_symposium_5">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>11:50-12:50</td>
                                                <td>
                                                    <p class="font_20 bold">Luncheon Symposium 5</p>
                                                    <p><span class="bold">Chairperson : Hyung Joon Yoo</span> (CM
                                                        Hospital, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:50-12:50</td>
                                                                    <td class="bold">
                                                                        STEP UP in Obesity Treatment with New Generation
                                                                        of GLP-1 RA
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Robert Busch</p>(Albany Medical
                                                                        Center, USA)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>12:50-13:50</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_3_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>13:50-14:30</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 3</p>
                                                    <p><span class="bold">Chairperson : Soon-Jib Yoo</span> (The
                                                        Catholic University of Korea, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Hyung Jin Choi (Seoul National
                                                        University, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Zachary Knight is a pioneer in the field of
                                                            elucidating the neural mechanisms of appetite, homeostasis,
                                                            and obesity, having published some of the finest research in
                                                            Nature, Cell, and elsewhere over the past few years. His use
                                                            of potent neuroscience tools is always accompanied by a
                                                            profound understanding of concepts related to appetite. In
                                                            this keynote lecture, he will present his most recent
                                                            findings regarding the function of neural circuits in the
                                                            brainstem in regulating eating behavior.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Nature. Dopamine subsystems that track internal states.
                                                            2022<br />
                                                            2. Cell. Genetic identification of vagal sensory neurons
                                                            that control feeding. 2019
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>13:50-14:20</td>
                                                                    <td class="bold">Brainstem Circuits that Control
                                                                        Ingestion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Zachary Knight</p>(University of
                                                                        California, San Francisco, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:20-14:30</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_4_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>14:30-15:10</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 4</p>
                                                    <p><span class="bold">Chairperson : Young kil Choi</span> (Kyung Hee
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Obesity is not only a serious disease in itself, but also a
                                                            health risk factor that causes various diseases, so
                                                            governmental plan and policy cooperation are needed. Korean
                                                            government established and announced the first national
                                                            obesity management comprehensive plan in 2018 to provide an
                                                            opportunity to raise public awareness of the importance of
                                                            obesity prevention and management and to monitor the
                                                            pregress. In this lecture, I would like to introduce the
                                                            past, present and future of Korea's national obesity
                                                            strategy.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:30-15:00</td>
                                                                    <td class="bold">
                                                                        National Obesity Strategy in Korea: Past,
                                                                        Present and Future
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae-Heon Kang</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:00-15:10</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>15:10-15:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_18">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>15:20-16:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 18 : Neuroscience</p>
                                                    <p><span class="bold">Chairpersons : Eun-Jung Rhee</span>
                                                        (Sungkyunkwan University, Republic of Korea), <br><span
                                                            class="bold">Hyung Jin Choi</span> (Seoul National
                                                        University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:20-15:45</td>
                                                                    <td class="bold">
                                                                        High-fat Food Biases Hypothalamic and Mesolimbic
                                                                        Expression of Consummatory Drives
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Michael Krashes</p>(National
                                                                        Institute of Diabetes and Digestive and Kidney
                                                                        Diseases(NIDDK), USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:45-16:10</td>
                                                                    <td class="bold">
                                                                        Feeding Regulation by Tuberal Nucleus
                                                                        Somatostatin Neurons
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yu Fu</p>
                                                                        (Institute of Molecular and Cell Biology (IMCB),
                                                                        Singapore)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:10-16:35</td>
                                                                    <td class="bold">
                                                                        Hypothalamic GABRA5-positive Neurons Control
                                                                        Obesity via Astrocytic GABA
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Changjoon Lee</p>(Institute for
                                                                        Basic Science (IBS), Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:35-16:50</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Won Jun Kim</p>(University of
                                                                        Ulsan, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:50-17:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_4_2">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>17:00-17:40</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 4</p>
                                                    <p><span class="bold">Chairperson : Chang Beom Lee</span> (Hanyang
                                                        University, Republic of Korea)</p>
                                                    <!-- <p><span class="bold">Chairperson : Moon-Kyu Lee</span> (Eulji University, Korea)</p> -->
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>17:00-17:30</td>
                                                                    <td class="bold">
                                                                        Current and Future in Obesity Management
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">John Wilding</p>(University of
                                                                        Liverpool, UK)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:30-17:40</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="closing_ceremony_2">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>17:40-18:00</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Closing & Award Ceremony</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="breakfast_symposium_5">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>07:30-08:20</td>
                                                <td>
                                                    <p class="font_20 bold">Breakfast Symposium 5</p>
                                                    <p><span class="bold">Chairperson : Jung Hwan Kim</span> (Eulji
                                                        University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>07:30-08:20</td>
                                                                    <td class="bold">
                                                                        Which Combination is Optimal Choice after
                                                                        Metformin?
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yeoree Yang</p>(The Catholic
                                                                        University of Korea, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>08:20-08:30</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_3_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>08:30-09:10</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 3</p>
                                                    <p><span class="bold">Chairperson : Hye Soon Park</span> (University
                                                        of Ulsan, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Jae Geun Kim (Incheon National
                                                        University, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Tamas Horvath is Chair of the Department of
                                                            Comparative Medicine at Yale University School of Medicine
                                                            in the United States and one of the leading researchers in
                                                            the field of study on the hypothalamic control of energy
                                                            homeostasis. In particular, his research on the regulation
                                                            of synaptic plasticity by AgRP neurons in hypothalamic
                                                            neuronal circuitries is one of his most noteworthy
                                                            accomplishments. In this session, Professor Horvath will
                                                            introduce the role of hypothalamic AgRP neurons that can be
                                                            applied to obesity treatment.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Hunger-promoting AgRP neurons trigger an
                                                            astrocyte-mediated feed-forward autoactivation loop in mice.
                                                            J Clin Invest. 2021 <br />
                                                            2. AgRP neurons control compulsive exercise and survival in
                                                            an activity-based anorexia model. Nature Metabolism. 2020.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>08:30-09:00</td>
                                                                    <td class="bold">
                                                                        The Role of Hunger-promoting Hypothalamic
                                                                        Neurons in Obesity Therapeutics
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Tamas Horvath</p>(Yale
                                                                        University, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:00-09:10</td>
                                                                    <td class="bold">
                                                                        Q&A
                                                                    </td>
                                                                    <td class="text_r">

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>09:10-09:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_15">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 15 : Community-based Nutrition
                                                        Interventions and Approaches for Vulnerable Groups</p>
                                                    <p><span class="bold">Chairpersons : Kyu Rae Lee</span> (Gachon
                                                        University, Republic of Korea), <br><span class="bold">Sung Nim
                                                            Han</span> (Seoul National University, Republic of Korea)
                                                    </p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Hyunjung Lim (Kyung Hee University),
                                                        Sujin Song (Hannam University), Oh Yoen Kim (Dong-A University)
                                                    </p>
                                                    <ul>
                                                        <li>Obesity is no longer an individual or family problem but is
                                                            recognized as a disease that society must solve together. It
                                                            is also pointed out as a cause of socially enormous economic
                                                            loss and class polarization. This session introduces
                                                            community-based nutrition interventions and approaches for
                                                            obesity management in vulnerable groups. The first speaker
                                                            Dr. Shirley Y. Chao from the Massachusetts Executive Office
                                                            of Elder Affairs in the USA will lecture on ‘Integrating
                                                            Frailty and Malnutrition Screening into Community Care for
                                                            Older Adults and Their Caregivers.' The second speaker
                                                            Professor Seung Eun Jung from the University of Alabama in
                                                            the USA will introduce 'Community-based Strategies to
                                                            Decrease Health Disparities and Improve Nutritional Status
                                                            for US Low-income Population.' Lastly, Professor Minsun Jeon
                                                            of Chungnam National University in the Republic of Korea
                                                            lectures on 'Nutrition Management Strategies for the Elderly
                                                            and the Disabled in Social Welfare Facilities' and discusses
                                                            obesity management in vulnerable groups in this session.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Chao S, Corish CA, Keller H, Rasmussen H, Arensberg MB,
                                                            Dwyer JT.<br />Are you prepared for the decade of healthy
                                                            aging 2020-2030? A panel summary from the academy of
                                                            nutrition and dietetics 2020 food & nutrition conference &
                                                            expo virtual event, Nutrition Today 56(4):183-192, 2021.
                                                            <br />
                                                            2. Jung SE, Shin YH, Kim H, Hermann J, Bice C. Identifying
                                                            Underlying Beliefs About Fruit and Vegetable Consumption
                                                            Among Low-Income Older Adults: An Elicitation Study Based on
                                                            the Theory of Planned Behavior, J Nutr Educ Behav.
                                                            49(9):717-723, 2017<br />
                                                            3. Han S, Jeon M Development and Application of Nutrition
                                                            Education Program for the Elderly in Low Income Korean
                                                            Journal of Human Ecology. 28(2):171-183, 2019.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        Integrating Frailty and Malnutrition Screening
                                                                        into Community Care for Older Adults and Their
                                                                        Caregivers
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Shirley Y. Chao</p>(Food Policy
                                                                        Insights, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        Community-based Strategies to Decrease Health
                                                                        Disparities and Improve Nutritional Status for
                                                                        US Low-income Population
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Seung Eun Jung</p>(The
                                                                        University of Alabama, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        Nutrition Education Strategies for the Elderly
                                                                        and the Disabled in Social Welfare Facilities
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Min Sun Jeon</p>(Chungnam
                                                                        National University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">SuJin Song</p>(Hannam
                                                                        University, Republic of Korea),<br />
                                                                        <p class="bold">Hannah Oh</p>(Korea University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>10:50-11:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_2_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>11:00-11:40</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 2</p>
                                                    <p><span class="bold">Chairperson : Kwan Woo Lee</span> (Ajou
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea), Jun Hwa Hong (Eulji University, Republic of
                                                        Korea)</p>
                                                    <ul>
                                                        <li>The interplay between adipose tissue's function as an energy
                                                            reservoir and an endocrine organ is crucial for maintaining
                                                            metabolic health. A key player in this dynamic balance is
                                                            leptin, a hormone whose regulation is tightly linked to fat
                                                            mass. Here we will discuss the multifaceted role of
                                                            LATS1/2-YAP/TAZ signaling in regulating adipocyte plasticity
                                                            and leptin production to maintain metabolic homeostasis.
                                                        </li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br>
                                                            1. Sethi, J.K. and A.J. Vidal-Puig, Thematic review series:
                                                            adipocyte biology. Adipose tissue function and plasticity
                                                            orchestrate nutritional adaptation. J Lipid Res, 2007.
                                                            48(6): p. 1253-62.<br>
                                                            2. Halder, G. and R.L. Johnson, Hippo signaling: growth
                                                            control and beyond. Development, 2011. 138(1): p. 9-22.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:00-11:30</td>
                                                                    <td class="bold">
                                                                        Decoding Adipocyte Plasticity: YAP/TAZ's Dual
                                                                        Control over Energy Storage and Leptin
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae Myoung Suh</p>(KAIST,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>11:30-11:40</td>
                                                                    <td class="bold">
                                                                        Q&A
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold"></p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>11:40-11:50</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="luncheon_symposium_6">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>11:50-12:50</td>
                                                <td>
                                                    <p class="font_20 bold">Luncheon Symposium 6</p>
                                                    <p><span class="bold">Chairperson : Ho-Young Son</span> (The
                                                        Catholic University of Korea, Republic of Korea)</p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>11:50-12:50</td>
                                                                    <td class="bold">
                                                                        Obesity Management in Digital Era
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sang Youl Rhee</p>(Kyung Hee
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>12:50-13:50</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_3_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>13:50-14:30</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 3</p>
                                                    <p><span class="bold">Chairperson : Soon-Jib Yoo</span> (The
                                                        Catholic University of Korea, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Hyung Jin Choi (Seoul National
                                                        University, Republic of Korea)</p>
                                                    <ul>
                                                        <li>Professor Zachary Knight is a pioneer in the field of
                                                            elucidating the neural mechanisms of appetite, homeostasis,
                                                            and obesity, having published some of the finest research in
                                                            Nature, Cell, and elsewhere over the past few years. His use
                                                            of potent neuroscience tools is always accompanied by a
                                                            profound understanding of concepts related to appetite. In
                                                            this keynote lecture, he will present his most recent
                                                            findings regarding the function of neural circuits in the
                                                            brainstem in regulating eating behavior.</li>
                                                        <li>
                                                            <span class="font_inherit bold">• References</span><br />
                                                            1. Nature. Dopamine subsystems that track internal states.
                                                            2022<br />
                                                            2. Cell. Genetic identification of vagal sensory neurons
                                                            that control feeding. 2019
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>13:50-14:20</td>
                                                                    <td class="bold">Brainstem Circuits that Control
                                                                        Ingestion</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Zachary Knight</p>(University of
                                                                        California, San Francisco, USA)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14:20-14:30</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="keynote_lecture_4_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>14:30-15:10</td>
                                                <td>
                                                    <p class="font_20 bold">Keynote Lecture 4</p>
                                                    <p><span class="bold">Chairperson : Young kil Choi</span> (Kyung Hee
                                                        University, Republic of Korea)</p>
                                                    <button class="btn gray2_btn program_detail_btn">Preview</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    <p class="bold">Organizer: Soo Lim (Seoul National University,
                                                        Republic of Korea)</p>
                                                    <ul>
                                                        <li>Obesity is not only a serious disease in itself, but also a
                                                            health risk factor that causes various diseases, so
                                                            governmental plan and policy cooperation are needed. Korean
                                                            government established and announced the first national
                                                            obesity management comprehensive plan in 2018 to provide an
                                                            opportunity to raise public awareness of the importance of
                                                            obesity prevention and management and to monitor the
                                                            pregress. In this lecture, I would like to introduce the
                                                            past, present and future of Korea's national obesity
                                                            strategy.</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>14:30-15:00</td>
                                                                    <td class="bold">
                                                                        National Obesity Strategy in Korea: Past,
                                                                        Present and Future
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae-Heon Kang</p>(Sungkyunkwan
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:00-15:10</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>15:10-15:20</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_19">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>15:20-16:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 19 : Diversity and Challenges of
                                                        Pediatric Obesity</p>
                                                    <p><span class="bold">Chairpersons : Young-Jun Rhie</span> (Korea
                                                        University, Republic of Korea), <br><span class="bold">Yong Hee
                                                            Hong</span> (Soonchunhyang University, Republic of Korea)
                                                    </p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:20-15:45</td>
                                                                    <td class="bold">
                                                                        Explore the Latest Data of Pediatric Obesity:
                                                                        Update of AAP Guidelines 2023
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ja Hyang Cho</p>(Kyung Hee
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:45-16:10</td>
                                                                    <td class="bold">
                                                                        From Origin of Morbid Obesity to
                                                                        New-anti-obesity Therapies in Children
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Antje Korner</p>(University of
                                                                        Leipzig, Germany)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:10-16:35</td>
                                                                    <td class="bold">
                                                                        Childhood Obesity and Mental Health
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jeewon Lee</p>(Soonchunhayng
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:35-16:50</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">In Hyuk Chung</p>(National
                                                                        Health Insurance Service Ilsan Hospital,
                                                                        Republic of Korea),<br />
                                                                        <p class="bold">Eungu Kang</p>(Korea University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="break" class="border_bottom_70">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_gray_bg">
                                                <td>16:50-17:00</td>
                                                <td>
                                                    <p class="font_20 bold">Break</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="plenary_lecture_4_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="pink_bg">
                                                <td>17:00-17:40</td>
                                                <td>
                                                    <p class="font_20 bold">Plenary Lecture 4</p>
                                                    <p><span class="bold">Chairperson : Chang Beom Lee</span> (Hanyang
                                                        University, Republic of Korea)</p>
                                                    <!-- <p><span class="bold">Chairperson : Moon-Kyu Lee</span> (Eulji University, Korea)</p> -->
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>17:00-17:30</td>
                                                                    <td class="bold">
                                                                        Current and Future in Obesity Management
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">John Wilding</p>(University of
                                                                        Liverpool, UK)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17:30-17:40</td>
                                                                    <td class="bold">Q&A</td>
                                                                    <td class="text_r"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="closing_ceremony_3">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="yellow_bg">
                                                <td>17:40-18:00</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Closing & Award Ceremony</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="symposium_16">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 16 : International Collaboration
                                                    </p>
                                                    <p><span class="bold">Chairpersons : Soo Lim</span> (Seoul National
                                                        University, Republic of Korea), <br><span class="bold">Luca
                                                            Busetto</span> (University of Padova, Italy)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:45</td>
                                                                    <td class="bold">
                                                                        Impact of Sleep Disturbance on Obesity and
                                                                        Energy Homeostasis
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Alice PS Kong</p>(The Chinese
                                                                        University of Hong Kong, Hong Kong)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:45-10:10</td>
                                                                    <td class="bold">
                                                                        Guidelines for the Management of Obesity as a
                                                                        Disease: Japanese Update
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Koutaro Yokote</p>(Chiba
                                                                        University, Japan)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:10-10:35</td>
                                                                    <td class="bold">
                                                                        A Translational Journey from Fundamental Basic
                                                                        Research to Adiponectin Therapeutics
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Gary Sweeney</p>(York
                                                                        University, Canada)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:35-10:50</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ji Won Yoon</p>(Seoul National University, Republic of Korea), <br>
                                                                        <p class="bold">Jin Hwa Kim</p>(Chosun University, Republic of Korea) 
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="oral_presentation_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_orange_bg">
                                                <td>12:50-13:50</td>
                                                <td>
                                                    <p class="font_20 bold">Oral Presentation 3</p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Bo Kyung Koo</span> (Seoul
                                                        National University, Republic of Korea), <br><span
                                                            class="bold">Jun Sung Moon</span> (Yeungnam University,
                                                        Republic of Korea)
                                                    </p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>12:50-13:00</td>
                                                                    <td class="bold">A Deep Learning-Based Early
                                                                        Prediction Framework for Weight Management Using
                                                                        Real-World Lifelong Data</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hyunji Sang</p>(Kyung Hee
                                                                        University Medical Center, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:00-13:10</td>
                                                                    <td class="bold">Remission of Type 2 Diabetes after
                                                                        Metabolic and Bariatric Surgery in Less Obese
                                                                        People versus Severely Obese People: A
                                                                        Systematic Review and Meta-Analysis</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jae Hyun Bae</p>(Korea
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:10-13:20</td>
                                                                    <td class="bold">Hypothalamic Inflammation Triggers
                                                                        Adipose and Muscle Wasting Through Sympathetic
                                                                        Activation</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Saeha Kim</p>(Hallym University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:20-13:30</td>
                                                                    <td class="bold">Decoding Body Fat Percentage: A
                                                                        Comparative Analysis of Random Forest and
                                                                        Support Vector Regression Algorithms</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Rifaldy Fajar</p>(Karlstad
                                                                        University, Sweden)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:30-13:40</td>
                                                                    <td class="bold">Metformin Ameliorates
                                                                        Olanzapine-Induced Obesity and Glucose
                                                                        Intolerance via Regulating Hypothalamic
                                                                        Inflammation and Microglial Activation in Female
                                                                        Mice</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Su Bin Moon</p>(Hallym
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="symposium_20">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="green_bg">
                                                <td>15:20-16:50</td>
                                                <td>
                                                    <p class="font_20 bold">Symposium 20 : Basic Exercise with Obesity
                                                    </p>
                                                    <p><span class="bold">Chairpersons : Jong-Hee Kim</span> (Hanyang
                                                        University, Republic of Korea), <br><span class="bold">Jeonga
                                                            Lee</span> (Kyung Hee University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:20-15:45</td>
                                                                    <td class="bold">
                                                                        A Sports Psychological Approach to Increase
                                                                        Participation in Exercise for People with
                                                                        Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Seok Ryu</p>(Kyung Hee
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:45-16:10</td>
                                                                    <td class="bold">
                                                                        The Benefits of Physical Activity Interventions
                                                                        for Obese People
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ji Suk Chae</p>(JS Sports
                                                                        Medicine Center, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:10-16:35</td>
                                                                    <td class="bold">
                                                                        Exercise Guidelines for Severe Obese People
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hae Sung Lee</p>(Wonkwang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:35-16:50</td>
                                                                    <td class="bold">
                                                                        Panel Discussion
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hyunseok Jee</p>(Yeungnam University, Republic of Korea), <br>
                                                                        <p class="bold">Jin-Wook Lee</p>(Dankook University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="sponsored_session_3">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>09:20-10:50</td>
                                                <td>
                                                    <p class="font_20 bold">Sponsored Session 3 : Is GLP-1RA Changing
                                                        the Paradigm of Obesity Management?</p>
                                                    <p><span class="bold">Chairpersons : Young-Sung Suh</span> (Keimyung
                                                        University, Republic of Korea), <br><span
                                                            class="bold">Seung-Hwan Lee</span> (The Catholic University
                                                        of Korea, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>09:20-09:50</td>
                                                                    <td class="bold">The Burden of Obesity and the
                                                                        Challenges Associated with Weight Management
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Sean Wharton</p> (Wharton
                                                                        Medical Clinic, Canada)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>09:50-10:20</td>
                                                                    <td class="bold">The Principles of Obesity
                                                                        Management; Can TIDES Make a Change?</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Hyuktae Kwon</p> (Seoul National
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10:20-10:50</td>
                                                                    <td class="bold">New Perspectives on Obesity
                                                                        Pharmaco-therapy: GLP-1RA Clinical Development
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Robert Busch</p> (Albany Medical
                                                                        Center, USA)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="oral_presentation_4">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_orange_bg">
                                                <td>12:50-13:50</td>
                                                <td>
                                                    <p class="font_20 bold">Oral Presentation 4</p>
                                                    <p>
                                                        <span class="bold">Chairpersons : Oh Yoen Kim</span> (Dong-A
                                                        University, Republic of Korea), <br><span class="bold">Ji Won
                                                            Yun</span> (Seoul National University, Republic of Korea)
                                                    </p>
                                                    <!-- [↓] 확정 시 까지 버튼 숨김 -->
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview </button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>12:50-13:00</td>
                                                                    <td class="bold">Time Restricted Feeding Prevents
                                                                        the Loss of Rhythmicity in High Fat Diet-Induced
                                                                        Obesity</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Nazmin Fatima</p>(King Georges
                                                                        Medical University, India)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:00-13:10</td>
                                                                    <td class="bold">Effects of Circuit Exercise
                                                                        Combined with a Remote Platform on Body
                                                                        Composition and Metabolic Hormones in Obese
                                                                        Patients after Laparoscopic Sleeve Gastrectomy
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Taeyang Kim</p>(Hanyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:10-13:20</td>
                                                                    <td class="bold">Effects of Dietary Restriction and
                                                                        Exercise on Autophagy Regulatory Proteins in
                                                                        Skeletal Muscles in High-Fat Diet-induced
                                                                        Obesity</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Fujue Ji</p>(Hanyang University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:20-13:30</td>
                                                                    <td class="bold">Comparison of Type 2 Diabetes
                                                                        Remission Between Roux-en-Y Gastric Bypass and
                                                                        Sleeve Gastrectomy Plus Duodenojejunal Bypass
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Dongjae Jeon</p>(H + YANGJI
                                                                        Hospital, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:30-13:40</td>
                                                                    <td class="bold">Perceptions and Attitudes towards
                                                                        Obesity among Adolescents Living with Obesity,
                                                                        Caregivers, and Healthcare Professionals in
                                                                        South Korea: Data from the ACTION Teens Global
                                                                        Survey Study</td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Yong Hee Hong</p>(Soonchunhyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li name="jomes_session">
                                <div class="table_wrap detail_table_common x_scroll">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="sky_bg">
                                                <td>15:20-16:30</td>
                                                <td>
                                                    <p class="font_20 bold">Best Articles in JOMES</p>
                                                    <p><span class="bold">Chairpersons : Dae Jung Kim</span> (Ajou
                                                        University, Republic of Korea), <br><span class="bold">You-Cheol
                                                            Hwang</span> (Kyung Hee University, Republic of Korea)</p>
                                                    <!-- <button class="btn gray2_btn program_detail_btn">Preview</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>15:20-15:35</td>
                                                                    <td class="bold">
                                                                        Obesity Fact Sheet in Korea, 2021: Trends in
                                                                        Obesity Prevalence and Obesity-Related
                                                                        Comorbidity Incidence Stratified by Age from
                                                                        2009 to 2019
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Ye Seul Yang</p>(Seoul National
                                                                        University, Republic of Korea))
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:35-15:50</td>
                                                                    <td class="bold">
                                                                        Reference Values for Waist Circumference and
                                                                        Waist–Height Ratio in Korean Children and
                                                                        Adolescents
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Jieun Lee</p>(Inje University,
                                                                        Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15:50-16:05</td>
                                                                    <td class="bold">
                                                                        Maintaining Physical Activity Is Associated with
                                                                        Reduced Major Adverse Cardiovascular Events in
                                                                        People Newly Diagnosed with Diabetes
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Kyoung Hwa Ha</p>(Ajou
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:05-16:20</td>
                                                                    <td class="bold">
                                                                        Updated Meta-Analysis of Studies from 2011 to
                                                                        2021 Comparing the Effectiveness of Intermittent
                                                                        Energy Restriction and Continuous Energy
                                                                        Restriction
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Kyoung-Kon Kim</p>(Gachon
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16:20-16:30</td>
                                                                    <td class="bold">
                                                                        Award Ceremony
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold"></p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <!-- <li name="joint_symposium_TOS">
							                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
							                                    <table class="c_table detail_table">
							                                        <colgroup>
							                                            <col class="col_date">
							                                            <col>
							                                        </colgroup>
							                                        <tbody>
							                                            <tr class="purple_bg">
							                                                <td>09:20-10:50</td>
							                                                <td>
							                                                    <p class="font_20 bold mb0">Joint Symposium TOS</p>
							                                                </td>
							                                            </tr>
											<tr>
												<td colspan="2" class="program_detail_td">
													will be updated.
												</td>
											</tr>
											<tr>
							                                                <td colspan="2">
							                                                    <div>
							                                                        <table class="c_table detail_table padding_0">
							                                                            <colgroup>
							                                                                <col class="col_date">
							                                                                <col>
							                                                            </colgroup>
							                                                            <tbody>
							                                                                <tr>
							                                                                    <td>09:20-09:45</td>
							                                                                    <td class="bold"></td>
							                                                                    <td class="text_r"></td>
							                                                                </tr>
							                                                                <tr>
							                                                                    <td>09:45-10:10</td>
							                                                                    <td class="bold"></td>
							                                                                    <td class="text_r"></td>
							                                                                </tr>
																<tr>
							                                                                    <td>10:10-10:35</td>
							                                                                    <td class="bold"></td>
							                                                                    <td class="text_r"></td>
							                                                                </tr>
																<tr>
							                                                                    <td>10:35-10:50</td>
							                                                                    <td class="bold">Panel Discussion</td>
							                                                                    <td class="text_r"></td>
							                                                                </tr>
							                                                            </tbody>
							                                                        </table>
							                                                    </div>
							                                                </td>
							                                            </tr>
							                                        </tbody>
							                                    </table>
							                                </div>
							                            </li> -->
                            <!--
							<li name="plenary_oral">
                                <div class="clearfix2 caption">
                                    <span>Sep.9(Sat)</span>
                                </div>
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="purple_bg">
                                                <td>16:00-17:30</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Plenary Oral (가안)</p>
                                                </td>
                                            </tr>
											<tr>
												<td colspan="2" class="program_detail_td">
													will be updated.
												</td>
											</tr>
											<tr>
                                                <td colspan="2">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td><!-- 09:20-09:50</td>
                                                                    <td class="bold"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><!-- 09:50-10:20</td>
                                                                    <td class="bold"></td>
                                                                    <td></td>
                                                                </tr>
                                            					<tr>
                                                                    <td><!-- 10:20-10:50</td>
                                                                    <td class="bold"></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
							-->
                        </ul>
                    </div>
                    <div class="tab_cont">
                        <ul class="program_detail_ul">
                            <li name="guided_poster_presentation_2">
                                <div class="table_wrap detail_table_common x_scroll border_bottom_70">
                                    <table class="c_table detail_table">
                                        <colgroup>
                                            <col class="col_date">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr class="light_orange_bg">
                                                <td>12:50-13:50</td>
                                                <td>
                                                    <p class="font_20 bold mb0">Guided Poster Presentation 2</p>
                                                    <p><span class="bold">Chairperson : Jun Hwa Hong</span> (Eulji
                                                        University, Republic of Korea)</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="program_detail_td">
                                                    will be updated.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="on">
                                                    <div>
                                                        <table class="c_table detail_table padding_0">
                                                            <colgroup>
                                                                <col class="col_date">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td>12:50-13:00</td>
                                                                    <td class="bold">
                                                                        Protective Effect of Hesperidin against High Fat
                                                                        Diet-Induced Obese Diabetic Wistar Rats via
                                                                        Reduction of Cytokines and Nrf2 Pathway
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Vikas Kumar</p>(Sam Higginbottom
                                                                        University of Agriculture, Technology And
                                                                        Sciences, India)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:00-13:10</td>
                                                                    <td class="bold">
                                                                        A Herbal Blend of Sphaeranthus indicus and
                                                                        Garcinia mangostana Reduces Adiposity in
                                                                        High-Fat Diet-Induced Obese Mice
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Su Min Kang</p>(Hanyang
                                                                        University, Republic of Korea)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:10-13:20</td>
                                                                    <td class="bold">
                                                                        Laparoscopic Sleeve Gastrectomy Safety and 5
                                                                        year Results in 263 Morbidly Obese Indian
                                                                        Patients A Single Center Experience
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Apoorv Shrivastava</p>(Amaltas
                                                                        Institute of Medical Sciences, India)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:20-13:30</td>
                                                                    <td class="bold">
                                                                        Adherence to 24-Hour Movement Guidelines based
                                                                        on Parental-report and Accelerometer-based
                                                                        Measures: Associations with Body Weight Status
                                                                        among Preschoolers in Peninsular Malaysia
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Christine Joan</p>(Universiti
                                                                        Kebangsaan Malaysia, Malaysia)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13:30-13:40</td>
                                                                    <td class="bold">
                                                                        Muscle Fat Content Predicts Bariatric Surgery
                                                                        Response in Patients with Morbid Obesity
                                                                    </td>
                                                                    <td class="text_r">
                                                                        <p class="bold">Eugene Han</p>(Keimyung
                                                                        University School of Medicine, Republic of
                                                                        Korea)
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
</section>

<script>
$(document).ready(function() {
    // 모든 세션의 내용 숨김처리 후, 펼칠 세션의 td에 on 클래스를 붙여 해당 세션의 내용만 펼칩니다.
    $(".program_detail_ul .detail_table_common > table > tbody > tr:first-child").next("tr").next("tr")
        .children("td").children("div").css("display", "none");
    $(".program_detail_ul .detail_table_common > table > tbody > tr:first-child").next("tr").next("tr")
        .children("td.on").children("div").css("display", "block");

    $(".program_detail_ul .detail_table_common > table > tbody > tr:first-child").click(function() {
        $(this).next("tr").next("tr").children("td.on").children("div").slideToggle();
    });

    // $(".program_detail_ul .detail_table_common > table > tbody > tr:first-child").click(function() {
    //     $(this).next("tr").next("tr").children("td").children("div").slideToggle();
    // });

    $(".tab_green li, .tab_li li").click(function() {
        var i = $(this).index();
        $(this).parent("ul").next(".tab_wrap").children(".tab_cont").removeClass("on");
        $(this).parent("ul").next(".tab_wrap").children(".tab_cont").eq(i).addClass("on");
        $(this).siblings("li").removeClass("on");
        $(this).addClass("on");
    });

    $(".program_detail_btn").click(function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parents("tr").next("tr").find(".program_detail_td").toggleClass("on");
    });
    //$('.toggle_title').click(function(e) {
    //	if($(this).hasClass('has_contents')){
    //		e.preventDefault();
    //		var notthis = $('.toggle_contents_wrap2 .has_contents .active').not(this);
    //		notthis.toggleClass('active').next('.toggle_contents2').slideToggle(300);
    //		$(this).toggleClass('active').next().slideToggle("fast");
    //	}
    //});
    //$('.tab_area2 li').on('click',function(){
    //	var idx = $(this).index();
    //	$('.tab_area2 li').removeClass('active');
    //	$(this).addClass('active');
    //	$('.tab_contents').hide();
    //	$('.tab_contents').eq(idx).show();
    //})
    // $('.toggle_title').addClass('active');
    // $('.toggle_contents2').attr('style','display:block;');

    // var hash_parts = location.hash.split('&', 2); 
    // var tab        = hash_parts[0]; 
    // var anc        = hash_parts[1];
    // var tabId      = tab;
    // var idx = $(tabId).index();

    // if(tab){
    //     $('.tab_area2 li').removeClass('active');
    //     $(tabId).addClass('active');
    //     $('.tab_contents').hide();
    //     $('.tab_contents').eq(idx).show();
    //     $('html, body').animate({'scrollTop': ($(anc).offset().top-223)}, 1000); // Animated scroll to anchor.
    //     
    // }
    //var i = 1;
    // $('li.date').each(function(){ 
    //    if ($(this).html() == '　'){
    //        $(this).addClass('no_cont')
    //    }
    // });
});
</script>

<?php include_once('./include/footer.php'); ?>