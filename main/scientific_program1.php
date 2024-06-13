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
			<li class="on"><a href="/main/scientific_program.php">DAY 1 <br class="mb_only"/>(November 29, Fri)</a></li>
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
									<tr class="yellow_bg non_border_b">
										<th class="dark_yellow_bg">09:00 - 10:40</th>
										<td class="yellow_bg">Symposium 1 
											<br/>2024 Guideline Update for Cardiometabolic Disease
											<!-- <img class="program_plus_btn" src="./img/icons/yellow_plus_btn.svg"/> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_1_mb">
								<tbody>
									<tr class="dark_yellow_bg non_border_b">
										<th class="dark_yellow_bg">09:00 - 10:40</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 1 <br/>2024 Guideline Update for Cardiometabolic Disease 
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
									<tr class="yellow_panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>Won-Young Lee (Sungkyunkwan University, Korea) <br/>Sang Hyun Ihm (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:00 - 09:20</th>
										<td>
											<p class="s_bold">Current Guidelines for Hypertension </p>
											<p>Sungha Park (Yonsei University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:20 - 09:40</th>
										<td>
											<p class="s_bold">Current Guidelines for Dyslipidemia</p>
											<p>Kim, Sin Gon (Korea University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>09:40 - 10:00</th>
										<td>
											<p class="s_bold">Current Guidelines for Diabetes </p>
											<p>Choi, SungHee (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>10:00 - 10:20</th>
										<td>
											<p class="s_bold">Current Guidelines for Heart Failure </p>
											<p>Byung-Soo Yoo (Yonsei University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>10:20 - 10:40</th>
										<td>
											<p class="s_bold">Panel discussion</p>
											<p>Jong-Chan Youn (The Catholic University of Korea, Korea), Minjae Yoon (Seoul National University, Korea)</p>
											<p>Jun Hwa Hong (Eulji university, Korea), Suk Chon (Kyung Hee University, Korea)</p>
										</td>
									</tr>
									<tr class="non_border_b">
										<th>10:40 - 11:00</th>
										<td>
											<p>Coffee break</p>
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
										<th class="dark_gray_bg">11:10 - 11:50</th>
										<td class="gray_bg">Opening address<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_mb">
								<tbody>
									<tr class="dark_gray_bg">
										<th class="dark_gray_bg">15:30 - 17:00</th>
									</tr>
									<tr class="gray_bg non_border_b">
										<td class="gray_bg">Opening address<br/>
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
										<th class="dark_green_bg">15:30 - 17:00</th>
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
											<!-- <p>TBD (TBD)<br> TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>11:10 - 11:50</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
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
									
									<tr class="non_border_b">
										<th>11:50 - 13:00</th>
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
									<tr>
										<th class="dark_yellow_bg">13:00 - 14:40</th>
										<td class="yellow_bg">Symposium 3 <br/>non-atherosclerotic, non-cardioembolic cerebral infarction
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
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 3 <br/>non-atherosclerotic, non-cardioembolic cerebral infarction</td>
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
										<th>13:00 - 13:20</th>
										<td>
											<p class="s_bold">Dissection</p>
											<p>Seong-Joon Lee (Ajou University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>13:20 - 13:40</th>
										<td>
											<p class="s_bold">Cervical and cerebral artery dissection</p>
											<p>Wookjin Yang (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>13:40 - 14:00</th>
										<td>
											<p class="s_bold">Cancer-related stroke </p>
											<p>Han-Jin Cho (Pusan National University)</p>
										</td>
									</tr>
									<tr>
										<th>14:00 - 14:20</th>
										<td>
											<p class="s_bold">PFO-paradoxilcal embolic cause of stroke?</p>
											<p>Hyung Jun Kim (Sungkyunkwan University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>14:20 - 14:40</th>
										<td>
											<p class="s_bold">Panel discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>14:40 - 15:00</th>
										<td>
											<p>Coffee break</p>
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
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
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
									<tr>
										<th class="dark_yellow_bg">15:40 - 17:20</th>
										<td class="yellow_bg">Symposium 5 <br/>KSCP-ASPC joint session: Comprehensive Cardiovascular Health: Risks and Prevention Strategies
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_5_mb">
								<tbody>
									<tr class="dark_yellow_bg">
										<th class="dark_yellow_bg"> 15:40 - 17:20</th>
									</tr>
									<tr class="yellow_bg non_border_b">
										<td class="yellow_bg">Symposium 5 <br/>KSCP-ASPC joint session: Comprehensive Cardiovascular Health: Risks and Prevention Strategies
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
											<p>
												Heather M. Johnson (Florida Atlantic University, USA)
												<br>Won-Young Lee (Sungkyunkwan University, Korea)
								
											</p>
										</td>
									</tr>
									<tr>
										<th>15:40 - 16:00</th>
										<td>
											<p class="s_bold">Adverse Pregnancy Outcomes and Cardiovascular Disease Risk; Autoimmune Conditions and CVD</p>
											<p>Heather M. Johnson (Florida Atlantic University, USA)</p>
										</td>
									</tr>
									<tr>
										<th>16:00 - 16:20</th>
										<td>
											<p class="s_bold">Prevention of Cardiovascular Disease among Cancer Survivors</p>
											<p>Jung Mi-hyang (The Catholic University of Korea, Korea)</p>
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
											<p class="s_bold">Measurement of Socioeconomic Factors for Cardiovascular Disease Risk Assessment</p>
											<p>Hyeon Chang Kim (Yonsei University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>17:00 - 17:20</th>
										<td>
											<p class="s_bold">Panel discussion</p>
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
										<td class="yellow_bg">Symposium 2 <br/>
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
										<td class="yellow_bg">Symposium 2 <br/>
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
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>09:20 - 09:40</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>09:40 - 10:00</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>10:00 - 10:20</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>10:20 - 10:40</th>
										<td>
											<p class="s_bold">Panel discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>10:40 - 11:00</th>
										<td>
											<p>Coffee break</p>
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
										<th class="dark_gray_bg">11:10 - 11:50</th>
										<td class="gray_bg">Opening address<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_mb">
								<tbody>
									<tr class="dark_gray_bg">
										<th class="dark_gray_bg">15:30 - 17:00</th>
									</tr>
									<tr class="gray_bg non_border_b">
										<td class="gray_bg">Opening address<br/>
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
										<th class="dark_green_bg">15:30 - 17:00</th>
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
											<!-- <p>TBD (TBD)<br> TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>11:10 - 11:50</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
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
									<tr class="non_border_b">
										<th>11:50 - 13:00</th>
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
										<td class="yellow_bg">Symposium 4 <br/>
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
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>13:20 - 13:40</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>13:40 - 14:00</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr>
										<th>14:00 - 14:20</th>
										<td>
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="discussion yellow_panel_tr">
										<th>14:40 - 11:00</th>
										<td>
											<p class="s_bold">Panel discussion</p>
											<!-- <p>TBD (TBD), TBD (TBD)</p>
											<p>TBD (TBD), TBD (TBD)</p> -->
										</td>
									</tr>
									<tr class="non_border_b">
										<th>10:40 - 11:00</th>
										<td>
											<p>Coffee break</p>
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
											<!-- <p class="s_bold">TBD</p>
											<p>TBD (TBD)</p> -->
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
									<tr>
										<th class="dark_yellow_bg">15:40 - 17:20</th>
										<td class="yellow_bg">Symposium 6 <br/>Integrated Approach to CKD Management Including Hypertension, Dyslipidemia, and Diabetes
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
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
										<td class="yellow_bg">Symposium 6 <br/>Integrated Approach to CKD Management Including Hypertension, Dyslipidemia, and Diabetes
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
										<th>15:40 - 16:00</th>
										<td>
											<p class="s_bold">Innovative Therapeutic Strategies in CKD with Hypertension: update in HTN guideline in CKD</p>
											<p>Jeonghwan Lee (Seoul National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>16:00 - 16:20</th>
										<td>
											<p class="s_bold">Latest Guidelines for Dyslipidemia Management in CKD: update in dyslipidemia guideline in CKD</p>
											<p>Ban Tae Hyun (The Catholic University of Korea, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>16:20 - 16:40</th>
										<td>
											<p class="s_bold">Prevention and Early Intervention in Diabetic Kidney Disease: update guideline in DKD</p>
											<p>Song, Soo Hyun (Chonnam National University, Korea)</p>
										</td>
									</tr>
									<tr>
										<th>16:40 - 17:00</th>
										<td>
											<p class="s_bold">Leveraging AI for Hypertension Research Advances</p>
											<p>Yeom, Jae-Beom (Inje University, Korea)</p>
										</td>
									</tr>
									<tr class="discussion non_border_b">
										<th>17:00 - 17:20</th>
										<td>
											<p class="s_bold">Panel discussion</p>
											<p>Eun Hui Bae (Chonnam National University, Korea), Dae Eun Choi (Chungnam National University)</p>
											<p>Soo Hyun Kim (Chung-Ang University, Korea), Won Min Hwang (Konyang University, Korea)</p>
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
