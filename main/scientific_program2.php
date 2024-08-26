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
	$day = $_GET['day'];
	$e_num = $e[-1];
	$d_num = $day[-1];
	$name = $_GET['name'];

	//echo 'asdasd', $d_num
	
	/*echo '<script type="text/javascript">
				  $(document).ready(function(){
					  //탭 활성화
					  if ("'.$e_num.'" = "") {
							$(".room_tab li:first-child").addClass("on");
  					  $(".room_tab").siblings(".tab_wrap").children(".tab_cont:first-child").addClass("on");
					  }
					  //작은탭
					  $(".room_tab li").removeClass("on");
					  $(".room_tab + .tab_wrap .tab_cont2").removeClass("on");
					  $(".room_tab li:nth-child('.$e_num.')").addClass("on");
					  $(".room_tab + .tab_wrap .tab_cont2:nth-child('.$e_num.')").addClass("on");

					  window.onkeydown = function() {
					  	var kcode = event.keyCode;
						if(kcode == 116) {
							history.replaceState({}, null, location.pathname);
							window.scrollTo({top:0, left:0, behavior:"auto"});
						}
					  }

					  //스크롤 위치 & 액션
					  $("table").each(function(){
						  var window_height = $(window).height();
						  var div_height = $(this).parent("div").height();
						  var top = window_height - div_height

						  console.log(top, "top")
						  if ($(window).width() > 1024) {
							if("'.$name.'" === $(this).attr("name")) {
								var this_top = $(this).offset().top;
								$("html, body").scrollTop(this_top - top/2);
								//$("html, body").animate({scrollTop: this_top - 150}, 1000);
								//console.log(this_top)
							}
						  }else {
							  if("'.$name.'_mb" === $(this).attr("name")) {
								var this_top = $(this).offset().top;
								$("html, body").scrollTop(this_top - top/2);
								//$("html, body").animate({scrollTop: this_top - 150}, 1000);
								//console.log(this_top)
							}
						  }
						
					  });

				  });
		</script>';*/

?>

<section class="container scientific_program sub_page">
<h1 class="page_title">Program
			<div class="sub_btn_box">
				<a href="/main/program_glance.php">Program at a Glance</a>
				<a href="/main/scientific_program1.php" class="on">Scientific Program</a>
				<a href="/main/invited_speaker.php">Invited Speakers</a>
				<!-- <a href="/main/invited_speaker.php">Invited Speakers</a> -->
			</div>
		</h1>
	<div class="inner">
		<ul class="program_detail_tab day2">
			<li><a href="/main/scientific_program1.php">DAY 1 <br class="mb_only"/>(November 29, Fri)</a></li>
			<li class="on"><a href="/main/scientific_program2.php">DAY 2 <br class="mb_only"/>(November 30, Sat)</a></li>
		</ul>
		<!-- <ul class="program_color_txt">
			<li><i></i>&nbsp;:&nbsp;Korean</li>
			<li><i></i>&nbsp;:&nbsp;English</li>
		</ul> -->
		<!-- <p class="rightT lecture_alert">※Some lectures will be pre-recorded.</p> -->
		<div class="tab_wrap">
			<!----- Day 02 ----->
			<div>
				<ul class="room_tab day2 add_poster">
					<li class="on"><a href="javascript:;">Room A</a></li>
					<li><a href="javascript:;">Room B</a></li>
				</ul>
				<div class="tab_wrap">
					<!-- !!! Room 1 !!! -->
					<div class="tab_cont2 on">
						<!-- Breakfast Symposium 1  -->
							<div>
							<table class="table color_table pink_table" name="breakfast_symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_pink_bg">07:00 - 08:00</th>
										<td class="pink_bg"> Breakfast Symposium 1 [ Daiichi-Sankyo ]
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="breakfast_symposium_1_mb">
								<tbody>
									<tr class="dark_pink_bg"> 
										<th class="dark_pink_bg"> 07:00 - 08:00</th>
									</tr>
									<tr class="pink_bg non_border_b">
										<td class="pink_bg">Breakfast Symposium 1 [ Daiichi-Sankyo ]</td>
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
										<p class="">TBD</p>
											<!-- <p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="">
										<th>07:00 - 07:30</th>
										<td>
										<p class="s_bold">TBD</p>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="pink_panel_tr">
										<th>07:30 - 08:00</th>
										<td>
										<p class="s_bold">TBD</p>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>08:00 - 08:30</th>
										<td>
											<p>Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 7 -->
						<div>
							<table class="table color_table yellow_table" name="symposium_7">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="plus_tr">
										<th class="dark_yellow_bg">08:30 - 10:10</th>
										<td class="yellow_bg">Symposium 7 <br/>What SGLT2 Inhibitors have Changed in Our Field - Multidisciplinary Perspectives 
										<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_7_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">08:30 - 10:10</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg plus_tr">Symposium 7 <br/>What SGLT2 Inhibitors have Changed in Our Field - Multidisciplinary Perspectives 
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
											<p>Organizer : Jong-Chan Youn (The Catholic University of Korea, Korea)</p>
											<ul>
												<li>In this multidisciplinary session, we begin with an exploration of the known and unknown mechanisms of SGLT2 inhibitors, providing a foundational understanding of their function and impact.</li>
												<li>Next, we will hear from leading experts in various fields: diabetologists will discuss the transformative effects of SGLT2 inhibitors on diabetes management, cardiologists will share insights into cardiovascular benefits, and nephrologists will examine the implications for kidney health.

												</li>
											</ul>
										</td>
									</tr>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
										 <p>Hye Young Lee (Seoul National University, Korea)<br>
										 Jae Hyuk Lee (Myongji Hospital, Korea)</p>  
										</td>
									</tr>
									
									<tr>
										<th>08:30 - 08:50</th>
										<td>
											<p class="s_bold">
												The Known and Unknonw Mechanisms of SGLT2 Inhibitors 
											</p>
											<p>Yong-Ho Lee (Yonsei University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>08:50 - 09:10</th>
										<td>
											<p class="s_bold">
												What SGLT2 Inhibitors have Changed in Our Field - Diabetologist's Perspectives
											</p>
											<p>Eun Young Lee (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:10 - 09:30</th>
										<td>
											<p class="s_bold">
												What SGLT2 Inhibitors have Changed in Our Field - Cardiologist's Perspectives
											</p>
											<p>Dong-Hyuk Cho (Korea University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:30 - 09:50</th>
										<td>
											<p class="s_bold">
												What SGLT2 Inhibitors have Changed in Our Field - Nephrologist's Perspectives
											</p>
											<p>Hyung Deok Kim (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>09:50 - 10:10</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<p>Jinhwa Kim (Chosun University, Korea), Yoo Ran Ahn (The Catholic University of Korea, Korea)</p>
											<p>Han Bi Lee (The Catholic University of Korea, Korea), Ji Yeon Hong (Hallym University, Korea)</p>
										</td>
									</tr>
									<tr class="non_border_b">
										<th>10:10 - 10:30</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- plenary 3  -->
						<div>
							<table class="table color_table green_table" name="plenary_lecture_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">10:30 - 11:10</th>
										<td class="green_bg">Plenary Lecture 3<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_3_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">10:30 - 11:10</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg non_border_b">Plenary Lecture 3<br/>
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
											<p>Sang Hong Baek (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
								 
									<tr class="non_border_b">
										<th>10:30 - 11:10</th>
										<td>
											<p class="s_bold">The Role of SGLT2i in Integrative Management of Cardio-Renal-Metabolic Diseases</p>
											<p>David Cherney (University Health Network, Canada)</p> 
										</td>
									</tr>
								</tbody>
							</table>
						</div>

				<!-- Symposium 9 -->
						<div>
							<table class="table color_table yellow_table" name="symposium_9">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="plus_tr">
										<th class="dark_yellow_bg">11:10 - 12:50</th>
										<td class="yellow_bg">Symposium 9 <br/>Obesity and Cardiovascular Disease 
										<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_9_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">11:10 - 12:50</th>
									</tr>
									<tr class="yellow_bg non_border_b plus_tr">
										<td class="yellow_bg">Symposium 9 <br/>Obesity and Cardiovascular Disease 
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
											<p>Organizer : Jong-Chan Youn (The Catholic University of Korea, Korea)</p>
											<ul>
												<li>In this session, we will explore the intricate link between these two critical health conditions. Our program begins with an overview of obesity, its definition, and clinical implications, setting the stage for understanding its impact on cardiovascular health. We'll then delve into the intriguing obesity paradox in cardiovascular disease, followed by insights into the role of bariatric surgery for obese patients with cardiovascular conditions. Finally, we will discuss the latest advancements in pharmacotherapy for these patients.</li>
											</ul>
										</td>
									</tr>
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>Hyuk Sang Kwon (The Catholic University of Korea, Korea)<br/>
											Sang Hak Lee (Yonsei University, Korea)</p>  
										</td>
									</tr>
									<tr>
										<th>11:10 - 11:30</th>
										<td>
											<p class="s_bold">Obesity: Definition and Clinical Implications </p>
											<p>Sang Woo Oh (Dongguk University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>11:30 - 11:50</th>
										<td>
											<p class="s_bold">Obesity Paradox in Cardiovascular Disease</p>
											<p>Da Rae Kim (Sungkyunkwan University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>11:50 - 12:10</th>
										<td>
											<p class="s_bold">Bariatric Surgery for Obese Patients with Cardiovascular Disease</p>
											<p>Moon Won Yoo (University of Ulsan, Korea)</p>
											<!-- <p>Moon Won Yoo (University of Ulsan, Korea)</p> -->
										</td>
									</tr>
									<tr>
										<th>12:10 - 12:30</th>
										<td>
											<p class="s_bold">Novel Pharmacotherapy for Obese Patients with Cardiovascular Disease</p>
											<p>Soo Lim (Seoul National University, Korea)</p>
											<!-- <p>Soo Lim (Seoul National University, Korea)</p> -->
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>12:30 - 12:50</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<p>Dae Young Cheon (Hallym University, Korea), Joon Ho Hyun (University of Ulsan, Korea)
											</p>
											<p>Yeoree Yang (The Catholic University of Korea, Korea), Mihae Seo (Soonchunhyang University, Korea)</p>
										</td>
									</tr>
									
								</tbody>
							</table>
						</div>
						
						<!-- Luncheon Symposium 3  -->
						<div>
							<table class="table color_table pink_table" name="luncheon_symposium_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_pink_bg">12:50 - 13:50</th>
										<td class="pink_bg">Luncheon Symposium 3 [ Daewoong Bio Incorporated ]

											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_3_mb">
								<tbody>
									<tr class="dark_pink_bg">
										<th class="dark_pink_bg">12:50 - 13:50</th>
									</tr>
									<tr class="pink_bg non_border_b">
										<td class="pink_bg">Luncheon Symposium 3 [ Daewoong Bio Incorporated ]</td>
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
											<p>Sang Hyun Lim (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr class="non_border_b">
										<th>12:50 - 13:50</th>
										<td>
											<p class="s_bold">[ICOSA] Clinical Value of EPA</p>
											<p>Dae Young Cheon (Hallym University, Korea)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

							<!-- plenary 4  -->
							<div>
							<table class="table color_table green_table" name="plenary_lecture_4">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">13:50 - 14:30</th>
										<td class="green_bg">Plenary Lecture 4<br/>		
										<img class="program_plus_btn" src="./img/icons/green_plus_btn.svg"/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_4_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">13:50 - 14:30</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg">Plenary Lecture 4<br/>
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
								<tr class="preview_tr green">
										<td colspan="2">
											<ul>
												<li>The carotid intima‑media thickness test (CIMT) is a measure used to diagnose the extent of carotid atherosclerotic vascular disease. The test measures the thickness of the inner two layers of the carotid artery—the intima and media—and alerts physicians to any thickening when patients are still asymptomatic. CIMT shows good correlation with the extent of one person’s atherosclerotic disease and predicts future cardiovascular events. CIMT is non-invasive and could be easily performed in the clinic for the prediction of atherosclerotic disease in our patients. In this plenary lecture, Prof. Yong-Jae Kim from The Catholic University of Korea will tell us about the role of CIMT in the risk stratification of cardiovascular risk.

												</li>
											</ul>
										</td>
									</tr>
									<tr class="green_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>Kyung Yeol Lee (Yonsei University, Korea)</p> -->
										</td>
									</tr>
									<tr class="green_panel_tr">
										<th>13:50 - 14:30</th>
										<td>
											<p class="s_bold">Black and White: The Evolving Role of Carotid Intima-Media Thickness in Risk Stratification</p>
											<p>Yong-Jae Kim (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr class="non_border_b">
										<th>14:30 - 14:50</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
				
							<!-- Symposium11 -->
							<div>
							<table class="table color_table yellow_table" name="symposium_11">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_yellow_bg">14:50 - 16:30</th>
										<td class="yellow_bg">Symposium 11 <br/> Lifestyle Modification for Prevention of Cardiovascular Disease
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_11_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">13:50 - 15:00</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 11 <br/> Lifestyle Modification for Prevention of Cardiovascular Disease
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
										<th>14:50 - 15:10</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>15:10 - 15:30</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>15:30 - 15:50</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>15:50 - 16:10</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>16:10 - 16:30</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<!-- Satellite Symposium 3  -->
						<!-- <div>
							<table class="table color_table violet_table" name="satellite_symposium_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_violet_bg">16:00 - 17:40</th>
										<td class="violet_bg">Satellite Symposium 3 <br/>
										
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="satellite_symposium_3_mb">
								<tbody>
									<tr class="dark_violet_bg">
										<th class="dark_violet_bg">16:00 - 17:40</th>
									</tr>
									<tr class="violet_bg non_border_b">
										<td class="violet_bg">Satellite Symposium 3 <br/>
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
											 <p>TBD (TBD)<br>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>16:00 - 16:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>16:20 - 16:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> 
										</td>
									</tr>
									<tr>
										<th>16:40 - 17:00</th>
										<td>
											 <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> 
										</td>
									</tr>
									<tr>
										<th>17:00 - 17:20</th>
										<td>
											 <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> 
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>17:20 - 17:40</th>
										<td>
											<p class="s_bold">Panel discussion</p>
											 <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> 
										</td>
									</tr>
									 <tr class="non_border_b">
										<th>15:00 - 15:20</th>
										<td>
											<p>Coffee break</p>
										</td>
									</tr> 
								</tbody>
							</table>
						</div> -->

						<!-- Closing Ceremony  -->
						<div>
							<table class="table color_table gray_table">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_gray_bg">16:30 - 16:50</th>
										<td class="gray_bg">Closing Ceremony<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_mb">
								<tbody>
									<tr class="dark_gray_bg">
										<th class="dark_gray_bg">16:30 - 16:50</th>
									</tr>
									<tr class="gray_bg non_border_b">
										<td class="gray_bg">Closing Ceremony<br/>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
						<!-- <div class="circle_title">Breakfast &amp; Luncheon Symposium</div> -->

					
					<!--!!! Room 2 !!!-->
					<div class="tab_cont2">

						<!-- Breakfast Symposium 2  -->
						<div>
							<table class="table color_table pink_table" name="breakfast_symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_pink_bg">07:00 - 08:00</th>
										<td class="pink_bg"> Breakfast Symposium 2 [TBD]
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="breakfast_symposium_2_mb">
								<tbody>
									<tr class="dark_pink_bg">
										<th class="dark_pink_bg">07:00 - 08:00</th>
									</tr>
									<tr class="pink_bg non_border_b">
										<td class="pink_bg">Breakfast Symposium 2 [TBD]</td>
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
										<th>07:00 - 07:30</th>
										<td>
											 <p class="s_bold">TBD</p>
											<!--<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="pink_panel_tr">
										<th>07:30 - 08:00</th>
										<td>
											 <p class="s_bold">TBD</p>
										<!--	<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>08:00 - 08:30</th>
										<td>
											<p>Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
							<!-- Symposium 8 -->
							<div>
							<table class="table color_table yellow_table" name="symposium_8">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_yellow_bg">08:30 - 10:10</th>
										<td class="yellow_bg">Symposium 8 <br/>Non-Traditional Risk Factors of Cardiovascular Disease 
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_8_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">08:30 - 10:10</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 8 <br/>Non-Traditional Risk Factors of Cardiovascular Disease 
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
										<th>08:30 - 08:50</th>
										<td>
											<p class="s_bold">Cardiovascular Risk in Breast Cancer Survivorship: Latest Findings </p>
											<p>Yong-Moon Mark Park (University of Arkansas for Medical Sciences, USA)</p>
										</td>
									</tr>
									<tr>
										<th>08:50 - 09:10</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>09:10 - 09:30</th>
										<td>
											<p class="s_bold">
												Synergistic Effect of Lipoprotein (a) and C-reactive Protein on Prognosis of Familial Hypercholesterolemia
											</p>
											<p>Hayato Tada (Kanazawa University, Japan)</p>
										</td>
									</tr>
									<tr>
										<th>09:30 - 09:50</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>09:50 - 10:10</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>10:10 - 10:30</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- plenary 3  -->
						<div>
							<table class="table color_table green_table" name="plenary_lecture_3_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">10:30 - 11:10</th>
										<td class="green_bg">Plenary Lecture 3<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_3_2_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">10:30 - 11:10</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg">Plenary Lecture 3<br/>
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
											<p>Sang Hong Baek (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
								 
									<tr class="non_border_b">
										<th>10:30 - 11:10</th>
										<td>
											<p class="s_bold">The Role of SGLT2i in Integrative Management of Cardio-Renal-Metabolic Diseases</p>
											<p>David Cherney (University Health Network, Canada)</p> 
										</td>
									</tr>
								</tbody>
							</table>
						</div>

				<!-- Symposium 10 -->
						<div>
							<table class="table color_table yellow_table" name="symposium_10">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr class="plus_tr">
										<th class="dark_yellow_bg">11:10 - 12:50</th>
										<td class="yellow_bg">Symposium 10 <br/>Regional, Social Disparities in CV and Metabolic Health Outcomes
										<img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_10_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">11:10 - 12:50</th>
									</tr>
									<tr class="yellow_bg non_border_b plus_tr">
										<td class="yellow_bg">Symposium 10 <br/>Regional, Social Disparities in CV and Metabolic Health Outcomes
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
											<p>Organizer : Seung-Hyun Ko (The Catholic University of Korea, Korea)</p>
											<ul>
												<li>Cardiometabolic diseases are major health issues all around the world, especially in Korea, and standard guidelines for the average person continue to evolve. However, health disparities in certain groups still exist, and efforts to resolve them are on-going. This session explores the uneven distribution of these conditions across different social and regional factors, examining how factors such as socioeconomic status, urbanization, and access to healthcare influence these disparities. By understanding the underlying causes and regional differences, we aim to develop targeted interventions and policies to alleviate these disparities, improve public health outcomes, and ensure equitable healthcare access for all Koreans.
												</li>
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
										<th>11:10 - 11:30</th>
										<td>
											<p class="s_bold">
												Cardiovascular and Renal Health Outcomes in Single-Person Households 
											</p>
											<p>Seung-Hwan Lee (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>11:30 - 11:50</th>
										<td>
											<p class="s_bold">
												Regional Disparities in Prehospital Delay of Acute Ischemic Stroke 
											</p>
											<p>Keun-Hwa Jung (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>11:50 - 12:10</th>
										<td>
											<p class="s_bold">
												Disparities in Mortality and Cardiovascular Events by Income and Blood Pressure Levels Among Patients with Hypertension in South Korea 
											</p>
											<p>Ki-Chul Sung (Sungkyunkwan University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>12:10 - 12:30</th>
										<td>
											<!-- <p class="s_bold">
												Increasing Disparities in Diabetes Mellitus Prevalence Among People with Disabilities in South Korea
											</p>
											<p>
												Jong Hyuk Park (Chungbuk National University Hospital, Korea)
											</p>  -->
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>12:30 - 12:50</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						

						<!-- Luncheon Symposium 4  -->
						<div>
							<table class="table color_table pink_table" name="luncheon_symposium_4">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_pink_bg">12:50 - 13:30</th>
										<td class="pink_bg">Luncheon Symposium 4 [Celltrion & Boryung ]

											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_4_mb">
								<tbody>
									<tr class="dark_pink_bg">
										<th class="dark_pink_bg">12:50 - 13:50</th>
									</tr>
									<tr class="pink_bg non_border_b">
										<td class="pink_bg">Luncheon Symposium 4 [Celltrion & Boryung ]
										</td>
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
											<p>TBD</p>
											<!-- <p>TBD (TBD)</p> -->
										</td>
									</tr>
									
									<tr class="non_border_b">
										<th>12:50 - 13:10</th>
										<td>
											 <p class="s_bold">TBD</p>
											<!--<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>13:10 - 13:30</th>
										<td>
											 <p class="s_bold">TBD</p>
											<p>Seung-Hwan Lee (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<!-- plenary 4  -->
						<div>
							<table class="table color_table green_table" name="plenary_lecture_4_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_green_bg">13:50 - 14:30</th>
										<td class="green_bg">Plenary Lecture 4<br/>	
										<img class="program_plus_btn" src="./img/icons/green_plus_btn.svg"/>									
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_4_2_mb">
								<tbody>
									<tr class="dark_green_bg">
										<th class="dark_green_bg">13:50 - 14:30</th>
									</tr>
									<tr class="green_bg non_border_b">
										<td class="green_bg">Plenary Lecture 4<br/>
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
								<tr class="preview_tr green">
										<td colspan="2">
											<ul>
												<li>The carotid intima‑media thickness test (CIMT) is a measure used to diagnose the extent of carotid atherosclerotic vascular disease. The test measures the thickness of the inner two layers of the carotid artery—the intima and media—and alerts physicians to any thickening when patients are still asymptomatic. CIMT shows good correlation with the extent of one person’s atherosclerotic disease and predicts future cardiovascular events. CIMT is non-invasive and could be easily performed in the clinic for the prediction of atherosclerotic disease in our patients. In this plenary lecture, Prof. Yong-Jae Kim from The Catholic University of Korea will tell us about the role of CIMT in the risk stratification of cardiovascular risk.

												</li>
											</ul>
										</td>
									</tr>
									<tr class="green_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<!-- <p>TBD (TBD)<br>TBD (TBD)</p> -->
										</td>
									</tr>
									
									<tr class="green_panel_tr">
										<th>13:50 - 14:30</th>
										<td>
											<p class="s_bold">Black and White: The Evolving Role of Carotid Intima-Media Thickness in Risk Stratification</p>
											<p>Yong-Jae Kim (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr class="non_border_b">
										<th>14:30 - 14:50</th>
										<td>
											<p>Coffee Break</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
							<!--Symposium 12-->
							<div>
							<table class="table color_table yellow_table" name="symposium_12">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_yellow_bg">14:50 - 16:30</th>
										<td class="yellow_bg">Symposium 12<br/>Digital Healthcare
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_12_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg">14:50 - 16:30</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 12<br/>
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
										<th>14:50 - 15:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>Seonghoon Choi (Hallym University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>15:10 - 15:30</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>15:30 - 15:50</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
                                    <tr>
										<th>15:50 - 16:10</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>16:10 - 16:30</th>
										<td>
											<p class="s_bold">Panel Discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									
								</tbody>
							</table>
						</div>
					
						<!-- Closing Ceremony  -->
						<div>
							<table class="table color_table gray_table">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="dark_gray_bg">16:30 - 16:50</th>
										<td class="gray_bg">Closing Ceremony<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_mb">
								<tbody>
									<tr class="dark_gray_bg">
										<th class="dark_gray_bg">16:30 - 16:50</th>
									</tr>
									<tr class="gray_bg non_border_b">
										<td class="gray_bg">Closing Ceremony<br/>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
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
