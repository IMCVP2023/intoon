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
	<div class="sub_background_box">
		<div class="sub_inner">
			<div>
				<h2>Scientific Program</h2>
				<ul>
					<li>Home</li>
					<li>Program</li>
					<li>Scientific Program</li>
				</ul>
			</div>	
		</div>
	</div>
	<div class="inner">
		<ul class="tab_pager">
			<li><a href="/main/scientific_program1.php">November 29 <i></i>(Fri)</a></li>
			<li class="on"><a href="/main/scientific_program2.php">November 30 <i></i>(Sat)</a></li>
		</ul>
		<ul class="program_color_txt">
			<li><i></i>&nbsp;:&nbsp;Korean</li>
			<li><i></i>&nbsp;:&nbsp;English</li>
		</ul>
		<p class="rightT lecture_alert">※Some lectures will be pre-recorded.</p>
		<div class="tab_wrap">
			<!----- Day 02 ----->
			<div>
				<ul class="room_tab add_poster">
					<li class="on"><a href="javascript:;">Room 1</a></li>
					<li><a href="javascript:;">Room 2</a></li>
				</ul>
				<div class="tab_wrap">
					<!-- Room 1-->
					<div class="tab_cont2 on">
						<!-- Symposium 7 -->
						<div>
							<table class="table color_table" name="symposium_7">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>08:30 - 10:10</th>
										<td class="pink_bg">Symposium 7 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_7_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 08:30 - 10:10</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 7 <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>08:30 - 08:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>08:50 - 09:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:10 - 09:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:30 - 09:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>09:50 - 10:10</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- plenary 3  -->
						<div>
							<table class="table color_table" name="plenary_lecture_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>10:30 - 11:10</th>
										<td class="pink_bg">Plenary Lecture 3<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_3_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 10:30 - 11:10</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 3<br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD(TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>10:30 - 11:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

				<!-- Symposium 9 -->
						<div>
							<table class="table color_table" name="symposium_9">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>11:10 - 12:50</th>
										<td class="pink_bg">Symposium 9 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_9_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 11:10 - 12:50</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 9 <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>11:10 - 11:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>11:30 - 11:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>11:50 - 12:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>12:10 - 12:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>12:30 - 12:50</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
							<!-- Symposium11 -->
							<div>
							<table class="table color_table" name="symposium_11">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>13:50 - 15:00</th>
										<td class="pink_bg">Symposium 11 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_11_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 13:50 - 15:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 11 <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>13:50 - 14:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>14:10 - 14:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>14:30 - 14:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>14:50 - 15:00</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<!-- plenary 4  -->
						<div>
							<table class="table color_table" name="plenary_lecture_4">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>15:20 - 16:00</th>
										<td class="pink_bg">Plenary Lecture 4<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_4_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 15:20 - 16:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 4<br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD(TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>15:20 - 16:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<!-- Satellite Symposium 3  -->
						<div>
							<table class="table color_table" name="satellite_symposium_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>16:00 - 17:40</th>
										<td class="pink_bg">Satellite Symposium 3  <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="satellite_symposium_3_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 16:00 - 17:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Satellite Symposium 3 <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>16:00 - 17:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>

								</tbody>
							</table>
						</div>

						<div class="circle_title">Breakfast &amp; Luncheon Symposium</div>

						<!-- Breakfast Symposium 1  -->
						<div>
							<table class="table color_table" name="breakfast_symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>07:00 - 08:00</th>
										<td class="pink_bg"> Breakfast Symposium 1
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="breakfast_symposium_1_mb">
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat) 07:00 - 08:00</th>
									</tr>
									<tr>
										<td class="pink_bg">Breakfast Symposium 1 </td>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairperson</p>
										</th>
										<td>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>07:00 - 08:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Luncheon Symposium 1  -->
						<div>
							<table class="table color_table" name="luncheon_symposium_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>12:50 - 13:50</th>
										<td class="pink_bg">Luncheon Symposium 3 
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_3_mb">
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat) 12:50 - 13:50</th>
									</tr>
									<tr>
										<td class="pink_bg">Luncheon Symposium 3 </td>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairperson</p>
										</th>
										<td>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>12:50 - 13:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Room 2-->
					<div class="tab_cont2">
							<!-- Symposium 8 -->
							<div>
							<table class="table color_table" name="symposium_8">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>08:30 - 10:10</th>
										<td class="pink_bg">Symposium 8 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_8_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 08:30 - 10:10</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 8 <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>08:30 - 08:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>08:50 - 09:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:10 - 09:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:30 - 09:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>09:50 - 10:10</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- plenary 3  -->
						<div>
							<table class="table color_table" name="plenary_lecture_3_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>10:30 - 11:10</th>
										<td class="pink_bg">Plenary Lecture 3<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_3_2_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 10:30 - 11:10</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 3<br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD(TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>10:30 - 11:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

				<!-- Symposium 10 -->
						<div>
							<table class="table color_table" name="symposium_10">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>11:10 - 12:50</th>
										<td class="pink_bg">Symposium 10 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_10_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 11:10 - 12:50</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 10 <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>11:10 - 11:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>11:30 - 11:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>11:50 - 12:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>12:10 - 12:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>12:30 - 12:50</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
							<!-- Hot topics in CPP -->
							<div>
							<table class="table color_table" name="hot_topics">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>13:50 - 15:00</th>
										<td class="pink_bg">Hot topics in CPP <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="hot_topics_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 13:50 - 15:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Hot topics in CPP <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>13:50 - 14:10</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>14:10 - 14:30</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>14:30 - 14:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>14:50 - 15:00</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<!-- plenary 4  -->
						<div>
							<table class="table color_table" name="plenary_lecture_4_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>15:20 - 16:00</th>
										<td class="pink_bg">Plenary Lecture 4<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_4_2_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 15:20 - 16:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 4<br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD(TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>15:20 - 16:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<!-- Satellite Symposium 4  -->
						<div>
							<table class="table color_table" name="satellite_symposium_4">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>16:00 - 17:40</th>
										<td class="pink_bg">Satellite Symposium 4  <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="satellite_symposium_4_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 30 (Sat) 16:00 - 17:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Satellite Symposium 4 <br/>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairpersons</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>16:00 - 17:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>

								</tbody>
							</table>
						</div>

						<div class="circle_title">Breakfast &amp; Luncheon Symposium</div>

						<!-- Breakfast Symposium 2  -->
						<div>
							<table class="table color_table" name="breakfast_symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>07:00 - 08:00</th>
										<td class="pink_bg"> Breakfast Symposium 2
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="breakfast_symposium_2_mb">
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat) 07:00 - 08:00</th>
									</tr>
									<tr>
										<td class="pink_bg">Breakfast Symposium 2 </td>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairperson</p>
										</th>
										<td>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>07:00 - 08:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Luncheon Symposium 1  -->
						<div>
							<table class="table color_table" name="luncheon_symposium_4">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat)<br/>12:50 - 13:50</th>
										<td class="pink_bg">Luncheon Symposium 4 
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_4_mb">
								<tbody>
									<tr>
										<th class="gray_bg">November 30 (Sat) 12:50 - 13:50</th>
									</tr>
									<tr>
										<td class="pink_bg">Luncheon Symposium 4 </td>
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
									<tr class="panel_tr">
										<th class="leftT">
											<p>Chairperson</p>
										</th>
										<td>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="panel_tr">
										<th class="leftT">
											<p>Panels</p>
										</th>
										<td>
											<p>TBD (TBD), TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>12:50 - 13:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					
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
