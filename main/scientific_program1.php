<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$member_idx = $_SESSION["USER"]["idx"];

	$sql_fave_list = "
		SELECT
			table_idx
		FROM lecture_fave AS lf
		WHERE member_idx = '".$member_idx."'
	";
	$fave_list = get_data($sql_fave_list);
?>

<?php

	$type = $_GET['type'];
	$e = $_GET['e'];
	$e_num = $e[-1];
	$d_num = $day[-1];
	$name = $_GET['name'];

	//echo 'asdasd', $d_num
	
	// echo '<script type="text/javascript">
	// 			  $(document).ready(function(){
	// 				  //탭 활성화
	// 				  if ("'.$e_num.'" = "") {
	// 						$(".room_tab li:first-child").addClass("on");
  	// 				  $(".room_tab").siblings(".tab_wrap").children(".tab_cont:first-child").addClass("on");
	// 				  }
	// 				  //작은탭
	// 				  $(".room_tab li").removeClass("on");
	// 				  $(".room_tab + .tab_wrap .tab_cont2").removeClass("on");
	// 				  $(".room_tab li:nth-child('.$e_num.')").addClass("on");
	// 				  $(".room_tab + .tab_wrap .tab_cont2:nth-child('.$e_num.')").addClass("on");

	// 				  window.onkeydown = function() {
	// 				  	var kcode = event.keyCode;
	// 					if(kcode == 116) {
	// 						history.replaceState({}, null, location.pathname);
	// 						window.scrollTo({top:0, left:0, behavior:"auto"});
	// 					}
	// 				  }

	// 				  //스크롤 위치 & 액션
	// 				  $("table").each(function(){
	// 					  var window_height = $(window).height();
	// 					  var div_height = $(this).parent("div").height();
	// 					  var top = window_height - div_height

	// 					  console.log(top, "top")
	// 					  if ($(window).width() > 1024) {
	// 						if("'.$name.'" === $(this).attr("name")) {
	// 							var this_top = $(this).offset().top;
	// 							$("html, body").scrollTop(this_top - top/2);
	// 							//$("html, body").animate({scrollTop: this_top - 150}, 1000);
	// 							//console.log(this_top)
	// 						}
	// 					  }else {
	// 						  if("'.$name.'_mb" === $(this).attr("name")) {
	// 							var this_top = $(this).offset().top;
	// 							$("html, body").scrollTop(this_top - top/2);
	// 							//$("html, body").animate({scrollTop: this_top - 150}, 1000);
	// 							//console.log(this_top)
	// 						}
	// 					  }
						
	// 				  });

	// 			  });
	// 	</script>';

?>

<section class="container scientific_program sub_page">
<h1 class="page_title">Program
			<div class="sub_btn_box">
				<a href="/main/program_glance.php">Program at a Glance</a>
				<a href="/main/scientific_program1.php" class="on">Scientific Program</a>
				<a href="/main/comingsoon.php">Invited Speakers</a>
				<!-- <a href="/main/invited_speaker.php">Invited Speakers</a> -->
			</div>
		</h1>
	<div class="inner">
		<ul class="program_detail_tab">
			<li class="on"><a href="/main/scientific_program1.php">DAY 1 <br class="mb_only"/>(November 29, Fri)</a></li>
			<li><a href="/main/scientific_program2.php">DAY 2 <br class="mb_only"/>(November 30, Sat)</a></li>
		</ul>
		<!-- <ul class="program_color_txt">
			<li><i></i>&nbsp;:&nbsp;Korean</li>
			<li><i></i>&nbsp;:&nbsp;English</li>
		</ul> -->
		<!-- <p class="rightT lecture_alert">※Some lectures will be pre-recorded.</p> -->
		<div class="tab_wrap">
			<!----- Day 01 ----->
			<div>
				<ul class="room_tab">
					<li class="on"><a href="javascript:;">Room A</a></li>
					<li><a href="javascript:;">Room B</a></li>
				</ul>
				<div class="tab_wrap">
					<!-- Room 1-->
					<div class="tab_cont2 on">
						<!-- Symposium 1  -->
						<div>
							<table class="table color_table yellow_table" name="symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="yellow_bg non_border_b plus_tr">
										<th class="dark_yellow_bg">09:00 - 10:40</th>
										<td class="yellow_bg">Symposium 1 
											<br/>2024 Guideline Update for Cardiometabolic Disease 
											<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_1_mb">
								<tbody>
									<tr class="dark_yellow_bg non_border_b">
										<th class="dark_yellow_bg">09:00 - 10:40</th>
									</tr>
									<tr class="yellow_bg non_border_b plus_tr">
										<td class="yellow_bg">Symposium 1 <br/>2024 Guideline Update for Cardiometabolic Disease 
										<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>	
									</td>
									</tr>
								</tbody>
							</table>
							<table class="detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="preview_tr yellow">
										<td colspan="2">
											<p>Organizer : Jong-Chan Youn (The Catholic University of Korea, Korea)</p>
											<ul>
												<li>In this session; we will provide a comprehensive review of the latest guidelines in key areas of cardiometabolic health from the national key opinion leaders. </li>
												<li>We will start with the current guidelines for hypertension, followed by updates on the management of dyslipidaemia. We will then look at the latest recommendations for the management of diabetes and conclude with the current guidelines for the management of heart failure.
												</li>
											</ul>
										</td>
									</tr>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>
												<!-- Won-Young Lee (Sungkyunkwan University, Korea) <br/>Sang Hyun Ihm (The Catholic University of Korea, Korea) -->
											</p>
										</td>
									</tr>
									<tr>
										<th>09:00 - 09:20</th>
										<td>
											<p class="s_bold">Current Guidelines for Hypertension </p>
											<p>Sung Ha Park (Yonsei University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:20 - 09:40</th>
										<td>
											<p class="s_bold">Current Guidelines for Dyslipidemia</p>
											<p>Sin Gon Kim (Korea University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:40 - 10:00</th>
										<td>
											<p class="s_bold">Current Guidelines for Diabetes </p>
											<p>Sung Hee Choi (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>10:00 - 10:20</th>
										<td>
											<p class="s_bold">
												<!-- Current Guidelines for Heart Failure  -->
											</p>
											<p>
												<!-- Byung-Soo Yoo (Yonsei University, Korea) -->
											</p>
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>10:20 - 10:40</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<p>Jong-Chan Youn (The Catholic University of Korea, Korea), Minjae Yoon (Seoul National University, Korea)</p>
											<p>
												<!-- Jun Hwa Hong (Eulji university, Korea),  -->
												Suk Jeon (Kyung Hee University, Korea)</p>
										</td>
									</tr>
									<tr class="non_border_b">
										<th>10:40 - 11:00</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- Opening address  -->
						<div>
							<table class="table color_table gray_table">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_gray_bg">11:00 - 11:10</th>
										<td class="gray_bg">Opening Address<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_mb">
								<tbody>
									<tr class="dark_gray_bg">
										<th class="dark_gray_bg">11:00 - 11:10</th>
									</tr>
									<tr class="gray_bg non_border_b">
										<td class="gray_bg">Opening Address<br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="non_border_b">
										<th></th>
										<td>
											<!-- <p>TBD (TBD)</p> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- plenary 1  -->
						<div>
							<table class="table color_table green_table" name="plenary_lecture_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">11:10 - 11:50</th>
										<td class="green_bg">Plenary Lecture 1<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">11:10 - 11:50</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg">Plenary Lecture 1<br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="green_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>Won-Young Lee (Sungkyunkwan University, Korea)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>11:10 - 11:50</th>
										<td>
											<p class="s_bold">Familial Hypercholesterolaemia, Diagnosis and Management</p>
											<p>Brian Tomlinson (Macau University of Science and Technology, Macao SAR)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- Luncheon Symposium 1 (K) [Daewoong]  -->
						<div>
							<table class="table color_table pink_table" name="luncheon_symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_pink_bg">11:50 - 13:00</th>
										<td class="pink_bg">Luncheon Symposium 1 
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_1_mb">
								<tbody>
									<tr>
										<th class="dark_pink_bg">11:50 - 13:00</th>
									</tr>
									<tr class="non_border_b">
										<td class="pink_bg">Luncheon Symposium 1 </td>
									</tr>
									<!-- <tr>
										<td><button type="button" class="favorite_btn centerT">My Favorite</button></td>
									</tr> -->
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="pink_panel_tr">
										<th class="leftT">
											<p>Chairperson</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)</p> -->
										</td>
									</tr>
									
									<tr class="">
										<th>11:50 - 12:10</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>12:10 - 12:30</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					
						<!-- Symposium 3  -->
						<div>
							<table class="table color_table yellow_table" name="symposium_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="plus_tr">
										<th class="dark_yellow_bg">13:00 - 14:40</th>
										<td class="yellow_bg">Symposium 3 <br/>Non-Atherosclerotic, Non-Cardioembolic Cerebral Infarction
										<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_3_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">13:00 - 14:40</th>
									</tr>
									<tr class="yellow_bg non_border_b plus_tr">
										<td class="yellow_bg">Symposium 3 <br/>Non-Atherosclerotic, Non-Cardioembolic Cerebral Infarction</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="preview_tr yellow">
										<td colspan="2">
											<p>Organizer : Sang-Mi Noh (The Catholic University of Korea, Korea)</p>
											<ul>
												<li>Ischemic stroke is a disease with a variety of etiologies. Most of its cases are due to atherosclerosis which is influenced by traditional vascular risk factors such as diabetes and hypertension or, due to high-risk cardio-embolic sources such as atrial fibrillation.</li>
												<li>There are well-established guidelines and extensive research concerning the causes and treatment of these types of strokes. In this session, we aim to share the latest research and clinical experiences on non-atherosclerotic, non-cardio-embolic stroke which are rare, yet require different therapeutic approaches.</li>
											</ul>
										</td>
									</tr>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>13:00 - 13:20</th>
										<td>
											<p class="s_bold">Dissection</p>
											<p>Seong Joon Lee (Ajou University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>13:20 - 13:40</th>
										<td>
											<p class="s_bold">Vasculitis</p>
											<p>Wookjin Yang (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>13:40 - 14:00</th>
										<td>
											<!-- <p class="s_bold">
												Cancer-related stroke 
											</p>
											<p>
												Dongwhane Lee (Eulji University, Korea)
											</p> -->
										</td>
									</tr>
									<tr>
										<th>14:00 - 14:20</th>
										<td>
											<p class="s_bold">
												Characteristics of PFO-related Stroke and its Secondary Prevention
											</p>
											<p>Hyung Jun Kim (Sungkyunkwan University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>14:20 - 14:40</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>14:40 - 15:00</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					<!-- plenary 2  -->
						<div>
							<table class="table color_table green_table" name="plenary_lecture_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">15:00 - 15:40</th>
										<td class="green_bg">Plenary Lecture 2<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_2_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">15:00 - 15:40</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg">Plenary Lecture 2<br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="green_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br/>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>15:00 - 15:40</th>
										<td>
											 <p class="s_bold">TBD</p>
											<p>Takayoshi Ohkubo (Teikyo University School of Medicine, Japan)</p> 
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 5  -->
						<div>
							<table class="table color_table yellow_table" name="symposium_5">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="plus_tr">
										<th class="dark_yellow_bg">15:40 - 17:20</th>
										<td class="yellow_bg">Symposium 5 <br/>KSCP-ASPC Joint Session: Comprehensive Cardiovascular Health: Risks and Prevention Strategies
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
											<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_5_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg"> 15:40 - 17:20</th>
									</tr>
									<tr class="yellow_bg non_border_b plus_tr">
										<td class="yellow_bg">Symposium 5 <br/>KSCP-ASPC Joint Session: Comprehensive Cardiovascular Health: Risks and Prevention Strategies
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
								<tr class="preview_tr yellow">
										<td colspan="2">
											<p>Organizer : Hyeon Chang Kim (Yonsei University, Republic of Korea)</p>
											<ul>
												<li>Comprehensive Approach in Cardiovascular Prevention, a special event from the collaboration between the American Society for Preventive Cardiology (ASPC) and the Korean Society of Cardiovascular Disease Prevention (KSCP). </li>
												<li>This session will highlight innovative strategies for preventing cardiovascular disease. Dr. Heather M. Johnson will discuss the link between adverse pregnancy outcomes and cardiovascular disease. </li>
												<li>Dr. Jong Chan Yoon will explore prevention strategies for cardiovascular disease among cancer survivors. Dr. Charles German will highlight the role of physical activity measurement in risk assessment, 
and Dr. Hyeon Chang Kim will address the impact of socioeconomic factors on cardiovascular health.</li>
												<li>This joint session offers a unique opportunity to learn from leading experts and advance your knowledge of cardiovascular prevention. Don’t miss out on these valuable insights and discussions.</li>
											</ul>
										</td>
									</tr>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>
												 <!-- Heather M. Johnson (Florida Atlantic University, USA) -->
												<!--<br>Won-Young Lee (Sungkyunkwan University, Korea) -->
											</p>
										</td>
									</tr>
									<tr>
										<th>15:40 - 16:00</th>
										<td>
											<p class="s_bold">Adverse Pregnancy Outcomes and Cardiovascular Disease Risk</p>
											<p>Heather M. Johnson (Florida Atlantic University, USA)</p>
										</td>
									</tr>
									<tr>
										<th>16:00 - 16:20</th>
										<td>
											<p class="s_bold">Prevention of Cardiovascular Disease among Cancer Survivors</p>
											<p>Mi-Hyang Jung (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>16:20 - 16:40</th>
										<td>
											<p class="s_bold">Measurement of Physical Activity for Cardiovascular Disease Risk Assessment</p>
											<p>Charles German (University of Chicago, USA)</p>
										</td>
									</tr>
									<tr>
										<th>16:40 - 17:00</th>
										<td>
											<p class="s_bold">Measurement of Socioeconomic Factors for Cardiovascular Disease Risk Assessmentt</p>
											<p>Hyeon Chang Kim (Yonsei University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>17:00 - 17:20</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Satellite Symposium 1  -->
						<div>
							<table class="table color_table violet_table" name="satellite_symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_violet_bg">17:20 - 18:00</th>
										<td class="violet_bg">Satellite Symposium 1  <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="satellite_symposium_1_mb">
								<tbody>
									<tr class="dark_violet_bg">
										<th class="dark_violet_bg">17:20 - 18:00</th>
									</tr>
									<tr class="violet_bg non_border_b">
										<td class="violet_bg">Satellite Symposium 1 <br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="violet_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br/>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>17:20 - 18:00</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>

								</tbody>
							</table>
						</div>
						<!-- Gala Dinner  -->
						<div>
							<table class="table color_table gray_table">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_gray_bg">18:00 ~</th>
										<td class="gray_bg">Gala Dinner<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile">
								<tbody>
									<tr class="dark_gray_bg">
										<th class="dark_gray_bg">18:00 ~</th>
									</tr>
									<tr class="gray_bg non_border_b">
										<td class="gray_bg">Gala Dinner<br/>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
						<!-- <div class="circle_title">Breakfast &amp; Luncheon Symposium</div> -->
						<!-- Luncheon Symposium 1 (K) [Daewoong]  -->
					
					<!-- !!! Room 2 !!!-->
					<div class="tab_cont2">
						<div>
							<table class="table color_table yellow_table" name="symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_yellow_bg">09:00 - 10:40</th>
										<td class="yellow_bg">Symposium 2 <br/>Updates on Novel Drugs in the Field of Diabetes and Obesity
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_2_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">09:00 - 10:40</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 2 <br/>Updates on Novel Drugs in the Field of Diabetes and Obesity
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br>TBD (TBD)</p> -->
										</td>
									</tr>
									
									<tr>
										<th>09:00 - 09:20</th>
										<td>
											<p class="s_bold">SGLT1/2 Dual Inhibitor</p>
											<p>Eun-Jung Rhee (Sungkyunkwan University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:20 - 09:40</th>
										<td>
											<p class="s_bold">
												Cardiovascular Effects of Tirzepatide 
											</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:40 - 10:00</th>
										<td>
											<p class="s_bold">Anti-Obesity Drugs</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>10:00 - 10:20</th>
										<td>
											<p class="s_bold">Weekly Insulin: Pharmacokinetics/Dosing Strategy and Clinicaloutcome </p>
											<p>Se Eun Park (Sungkyunkwan University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>10:20 - 10:40</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											 <p>Yoo Jin Han (Keimyung University, Korea)</p>
											<!--<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>10:40 - 11:00</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- Opening address  -->
						<div>
							<table class="table color_table gray_table">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_gray_bg">11:00 - 11:10</th>
										<td class="gray_bg">Opening Address<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="opening">
								<tbody>
									<tr class="dark_gray_bg">
										<th class="dark_gray_bg">11:00 - 11:10</th>
									</tr>
									<tr class="gray_bg non_border_b">
										<td class="gray_bg">Opening Address<br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="non_border_b">
										<th></th>
										<td>
											<!-- <p>TBD (TBD)</p> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- plenary 1  -->
						<div>
							<table class="table color_table green_table" name="plenary_lecture_1_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">11:10 - 11:50</th>
										<td class="green_bg">Plenary Lecture 1<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_2_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">11:10 - 11:50</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg">Plenary Lecture 1<br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="green_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>Won-Young Lee (Sungkyunkwan University, Korea)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>11:10 - 11:50</th>
										<td>
										    <p class="s_bold">Familial Hypercholesterolaemia, Diagnosis and Management</p>
											<p>Brian Tomlinson (Macau University of Science and Technology, Macao SAR)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div>
							<table class="table color_table pink_table" name="luncheon_symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_pink_bg">11:50 - 13:00</th>
										<td class="pink_bg">Luncheon Symposium 2 
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_2_mb">
								<tbody>
									<tr class="dark_pink_bg">
										<th class="dark_pink_bg">11:50 - 13:00</th>
									</tr>
									<tr class="pink_bg non_border_b">
										<td class="pink_bg ">Luncheon Symposium 2 </td>
									</tr>
									<!-- <tr>
										<td><button type="button" class="favorite_btn centerT">My Favorite</button></td>
									</tr> -->
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="pink_panel_tr">
										<th class="leftT">
											<p>Chairperson</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>11:50 - 12:10</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>12:10 - 12:30</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 4  -->
						<div>
							<table class="table color_table yellow_table" name="symposium_4">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_yellow_bg">13:00 - 14:40</th>
										<td class="yellow_bg">Symposium 4 <br/>Chronic Diseases/Cardiovascular Diseases in the Elderly
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_4_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">13:00 - 14:40</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 4 <br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br/>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>13:00 - 13:20</th>
										<td>
											<p class="s_bold">Medical Problems and Costs in Korean Elderly</p>
											<p>Seok-Jun Yoon (Korea University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>13:20 - 13:40</th>
										<td>
											<p class="s_bold">Cardiovascular Diseases in the Elderly</p>
											<p>Kwang-il Kim (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>13:40 - 14:00</th>
										<td>
											<p class="s_bold">Diabetes in the Elderly</p>
											<p>Jae Seung Yun (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>14:00 - 14:20</th>
										<td>
											<p class="s_bold">Stroke in the Elderly</p>
											<p>Chi Kyung Kim (Korea University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>14:20 - 14:40</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>14:40 - 15:00</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					<!-- plenary 2  -->
						<div>
							<table class="table color_table green_table" name="plenary_lecture_2_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">15:00 - 15:40</th>
										<td class="green_bg">Plenary Lecture 2<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_2_2_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">15:00 - 15:40</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg">Plenary Lecture 2<br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="green_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br/>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>15:00 - 15:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>Takayoshi Ohkubo (Teikyo University School of Medicine, Japan)</p> 
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 6  -->
						<div>
							<table class="table color_table yellow_table" name="symposium_6">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="plus_tr">
										<th class="dark_yellow_bg">15:40 - 17:20</th>
										<td class="yellow_bg">Symposium 6 <br/>Integrated Approach to CKD Management Including Hypertension, Dyslipidemia, and Diabetes
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
											<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_6_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">15:40 - 17:20</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg plus_tr">Symposium 6 <br/>ntegrated Approach to CKD Management Including Hypertension, Dyslipidemia, and Diabetes
										<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>	
									</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
								<tr class="preview_tr yellow">
										<td colspan="2">
											<p>Organizer : Eun Hui Bae (Chonnam National University, Republic of Korea)</p>
											<ul>
												<li>Integrated Approach to CKD Management Including Hypertension, Dyslipidemia, and Diabetes,  must attend the session at our upcoming conference. </li>
												<li>This session will cover innovative therapeutic strategies for managing CKD with hypertension, presenting the latest updates in hypertension guidelines. </li>
												<li>It will also delve into the newest guidelines for dyslipidemia management in CKD, focusing on practical applications to optimize lipid control and reduce cardiovascular risk. 
												</li>
												<li>Additionally, the symposium will explore prevention and early intervention strategies in diabetic kidney disease, highlighting the latest guidelines which aimed at delaying disease progression. 
												</li>
												<li>Furthermore, the session will discuss how artificial intelligence is being leveraged to advance research in hypertension, showcasing AI-driven innovations that have the potential to revolutionize hypertension management. 
												</li>
												<li>Don’t miss this opportunity to enhance your knowledge and clinical practice in managing CKD and its associated conditions.
												</li>
												<li>We look forward to your participation!</li>
											</ul>
										</td>
									</tr>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br/>TBD (TBD)</p> -->
										</td>
									</tr>
									
									<tr>
										<th>15:40 - 16:00</th>
										<td>
											<p class="s_bold">
												Innovative Therapeutic Strategies in CKD with Hypertension: Update in HTN Guideline in CKD
											</p>
											<p>Jeonghwan Lee (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>16:00 - 16:20</th>
										<td>
											<p class="s_bold">
												Latest Guidelines for Dyslipidemia Management in CKD: Update in Dyslipidemia Guideline in CKD
											</p>
											<p>Tae Hyun Ban (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>16:20 - 16:40</th>
										<td>
											<p class="s_bold">
												Prevention and Early Intervention in Diabetic Kidney Disease: Update Guideline in DKD
											</p>
											<p>Su Hyun Song (Chonnam National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>16:40 - 17:00</th>
										<td>
											<p class="s_bold">Leveraging AI for Hypertension Research Advances</p>
											<p>Jae Boum Youm (Inje University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>17:00 - 17:20</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<p>Eun Hui Bae (Chonnam National University, Korea), Dae Eun Choi (Chungnam National University, Korea)</p>
											<p>Su Hyun Kim (Chung-Ang University, Korea), Won Min Hwang (Konyang University, Korea)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Satellite Symposium 2  -->
						<div>
							<table class="table color_table violet_table" name="satellite_symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_violet_bg">17:20 - 18:00</th>
										<td class="violet_bg">Satellite Symposium 2  <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="satellite_symposium_2_mb">
								<tbody>
									<tr class="dark_violet_bg">
										<th class="dark_violet_bg">17:20 - 18:00</th>
									</tr>
									<tr class="violet_bg non_border_b">
										<td class="violet_bg ">Satellite Symposium 2 <br/>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table detail_table2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="violet_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br>TBD (TBD)</p> -->
										</td>
									</tr>
									
									<tr>
										<th>17:20 - 18:00</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>

								</tbody>
							</table>
						</div>

						<!-- <div class="circle_title">Breakfast &amp; Luncheon Symposium</div> -->
						
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>
<input type="hidden" value="<?= $type ?>" name="type">
<input type="hidden" value="<?= $e ?>" name="e">
<input type="hidden" value="<?= $e_num ?>" name="e_num">
<input type="hidden" value="<?= $d_num ?>" name="d_num">
<input type="hidden" value="<?= $name ?>" name="name">
<?php
	if(!empty($e_num)) {
?>
<script src="./js/script/client/scientific_program.js?v=0.1"></script>
<?php
	}
?>
<script>

	$(document).ready(function() {
		$(".room_tab li").click(function(){
			// style toggle
			$(this).parents(".room_tab").children("li").removeClass("on");
			$(this).addClass("on");
			// pager toggle
			var x = $(this).index();
			$(this).parents(".room_tab").next(".tab_wrap").children(".tab_cont2").removeClass("on");
			$(this).parents(".room_tab").next(".tab_wrap").children(".tab_cont2").eq(x).addClass("on");
		});

		$(".table.detail_table2").each(function(){
			var tr_length = $(this).find(".panel_tr").length;
			if (tr_length === 1){
				$(this).find("tr").addClass("one");
			}
		});

		$(".color_table td").each(function(){
			if ($(this).hasClass("green_bg")){
				$(this).parents(".color_table").siblings(".detail_table2").find(".panel_tr th p").css("color","#00666B")
			}
		});

		const plusBtnList = document.querySelectorAll(".program_plus_btn");
		const plusTrList = document.querySelectorAll(".plus_tr");
		
		
		plusTrList.forEach((plusTr)=>{
			plusTr.addEventListener("click", (e)=>{
				showDetailTr(e)
			})
		})

		plusBtnList.forEach((plusBtn)=>{
			plusBtn.addEventListener("click", (e)=>{
				e.stopPropagation();
				showDetailTr(e)				
			})
		})

		function showDetailTr(e){
				const isMobile = e.target.closest('.color_table').classList.contains('mobile');
				const isImg = e.target.tagName;
				console.log(isImg)
				let targetBtn = ""

				if(isMobile && isImg === "IMG"){
					clickTarget = e.target.closest('.color_table').nextSibling.nextSibling.querySelector('.preview_tr');
					targetBtn = e.target;
				}else if(!isMobile && isImg === "IMG"){
					clickTarget = e.target.closest('.color_table').nextSibling.nextSibling.nextSibling.nextSibling.querySelector('.preview_tr');
					targetBtn = e.target;
				}else if(isMobile && isImg !== "IMG"){
					clickTarget =  e.target.closest('.color_table').nextSibling.nextSibling.querySelector('.preview_tr');
					targetBtn = e.target.querySelector('.program_plus_btn')
				}else if(!isMobile && isImg !== "IMG"){
					clickTarget = e.target.closest('.color_table').nextSibling.nextSibling.nextSibling.nextSibling.querySelector('.preview_tr');
					targetBtn =  e.target.querySelector('.program_plus_btn')
				}
				console.log(targetBtn)
				
				const color = clickTarget.classList[1];
				clickTarget.classList.toggle("on");

				if(clickTarget.classList.contains("on")){
					targetBtn.src = `./img/icons/${color}_cross_btn.svg`

				}else if(!clickTarget.classList.contains("on")){
					targetBtn.src = `./img/icons/${color}_plus_btn.svg`
				}
				
		}
	});
</script>
<?php
	if($member_idx == "") {
?>
<script>
	$(".favorite_btn").click(function(){
		alert(locale(language.value)('need_login'));
	});
</script>
<?php
	} else {
?>
<script>
	//console.log(fave_list);
	$(document).ready(function() {
		var fave_list = JSON.parse('<?=json_encode($fave_list)?>');
		var temp_idx;
		fave_list.forEach(function(el){
			temp_idx = el.table_idx-1;
			$(".tab_cont2>div").eq(temp_idx).find(".favorite_btn").addClass('on');
		});

	});

	

	$(".favorite_btn").click(function(){
		var _this = $(this);

		var index = $(".tab_cont2>div").index((_this.parents('table').parent())) + 1;
		var date = _this.parent().siblings('th').text().replace(")", ") ");
		var title =  _this.parent().html().replace("<br>", " ").replace(/\t/ig, "").split('<button')[0];
		var room = $('.room_tab li.on>a').eq(0).text();
		/*console.log('index', index);
		console.log('date', date);
		console.log('title', title);
		console.log('room', room);*/

		$.ajax({
			url : PATH+"ajax/client/ajax_lecture.php",
			type : "POST",
			data : {
				flag: 'fave',
				idx: index,
				date: date,
				title: title,
				room: room
			},
			dataType : "JSON",
			success : function(res){
				//console.log(res);
				if(res.code == 200) {
					if (res.type == "ins") {
						_this.addClass("on");
					} else {
						_this.removeClass("on");
					}
					//alert(locale(language.value)("send_mail_success"));
					//location.href = './abstract_submission3.php?idx=' + submission_idx
				}
			},
			complete:function(){
				$(".loading").hide();
				$("body").css("overflow-y","auto");

				//alreadyProcess = false;
			}
		});
	});
</script>
<?php
	}

	include_once('./include/footer.php');
?>
