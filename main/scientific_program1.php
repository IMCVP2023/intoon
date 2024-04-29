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
			<li class="on"><a href="/main/scientific_program1.php">November 29 <i></i>(Fri)</a></li>
			<li><a href="/main/scientific_program2.php">November 30 <i></i>(Sat)</a></li>
		</ul>
		<ul class="program_color_txt">
			<li><i></i>&nbsp;:&nbsp;Korean</li>
			<li><i></i>&nbsp;:&nbsp;English</li>
		</ul>
		<p class="rightT lecture_alert">※Some lectures will be pre-recorded.</p>
		<div class="tab_wrap">
			<!----- Day 01 ----->
			<div>
				<ul class="room_tab">
					<li class="on"><a href="javascript:;">Room 1</a></li>
					<li><a href="javascript:;">Room 2</a></li>
					<!-- <li><a href="javascript:;">Room 3</a></li>
					<li><a href="javascript:;">Room 4</a></li> -->
					<!-- <li><a href="javascript:;">Meeting Room</a></li> -->
				</ul>
				<div class="tab_wrap">
					<!-- Room 1-->
					<div class="tab_cont2 on">
						<!-- Symposium 1  -->
						<div>
							<table class="table color_table" name="symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>09:00 - 10:40</th>
										<td class="pink_bg">Symposium 1 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_1_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 09:00 - 10:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 1 <br/>
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
										<th>09:00 - 09:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:20 - 09:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:40 - 10:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>10:00 - 10:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>10:20 - 10:40</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- plenary 1  -->
						<div>
							<table class="table color_table" name="plenary_lecture_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>11:10 - 11:50</th>
										<td class="pink_bg">Plenary Lecture 1<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 15:30 - 17:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 1<br/>
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
										<th>11:10 - 11:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 3  -->
						<div>
							<table class="table color_table" name="symposium_3">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>13:00 - 14:40</th>
										<td class="pink_bg">Symposium 3 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_3_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 13:00 - 14:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 3 <br/>
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
										<th>13:00 - 13:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>13:20 - 13:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>13:40 - 14:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>14:00 - 14:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>14:20 - 14:40</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					<!-- plenary 2  -->
						<div>
							<table class="table color_table" name="plenary_lecture_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>15:00 - 15:40</th>
										<td class="pink_bg">Plenary Lecture 2<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_2_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 15:00 - 15:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 2<br/>
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
										<th>15:00 - 15:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 5  -->
						<div>
							<table class="table color_table" name="symposium_5">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>15:40 - 17:20</th>
										<td class="pink_bg">Symposium 5 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_5_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 15:40 - 17:20</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 5 <br/>
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
										<th>15:40 - 16:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
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
									<tr class="discussion">
										<th>17:00 - 17:20</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Satellite Symposium 1  -->
						<div>
							<table class="table color_table" name="satellite_symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>17:20 - 18:00</th>
										<td class="pink_bg">Satellite Symposium 1  <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="satellite_symposium_1_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 17:20 - 18:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Satellite Symposium 1 <br/>
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
										<th>17:20 - 18:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>

								</tbody>
							</table>
						</div>

						<div class="circle_title">Breakfast &amp; Luncheon Symposium</div>
						<!-- Luncheon Symposium 1 (K) [Daewoong]  -->
						<div>
							<table class="table color_table" name="luncheon_symposium_1">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>11:50 - 13:00</th>
										<td class="pink_bg">Luncheon Symposium 1 
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_1_mb">
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri) 11:50 - 13:00</th>
									</tr>
									<tr>
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
										<th>11:50 - 13:00</th>
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
					<div>
							<table class="table color_table" name="symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>09:00 - 10:40</th>
										<td class="pink_bg">Symposium 2 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_2_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 09:00 - 10:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 2 <br/>
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
										<th>09:00 - 09:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:20 - 09:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>09:40 - 10:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>10:00 - 10:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>10:20 - 10:40</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- plenary 1  -->
						<div>
							<table class="table color_table" name="plenary_lecture_1_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>11:10 - 11:50</th>
										<td class="pink_bg">Plenary Lecture 1<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_1_2_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 15:30 - 17:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 1<br/>
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
										<th>11:10 - 11:50</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 4  -->
						<div>
							<table class="table color_table" name="symposium_4">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>13:00 - 14:40</th>
										<td class="pink_bg">Symposium 4 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_4_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 13:00 - 14:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 4 <br/>
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
										<th>13:00 - 13:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>13:20 - 13:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>13:40 - 14:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr>
										<th>14:00 - 14:20</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
									<tr class="discussion">
										<th>14:20 - 14:40</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					<!-- plenary 2  -->
						<div>
							<table class="table color_table" name="plenary_lecture_2_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>15:00 - 15:40</th>
										<td class="pink_bg">Plenary Lecture 2<br/>								
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="plenary_lecture_2_2_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 15:00 - 15:40</th>
									</tr>
									<tr class="pink_bg">
										<td>Plenary Lecture 2<br/>
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
										<th>15:00 - 15:40</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Symposium 6  -->
						<div>
							<table class="table color_table" name="symposium_6">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>15:40 - 17:20</th>
										<td class="pink_bg">Symposium 6 <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="symposium_6_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 15:40 - 17:20</th>
									</tr>
									<tr class="pink_bg">
										<td>Symposium 6 <br/>
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
										<th>15:40 - 16:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
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
									<tr class="discussion">
										<th>17:00 - 17:20</th>
										<td>
											<p class="s_bold">Discussion</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Satellite Symposium 1  -->
						<div>
							<table class="table color_table" name="satellite_symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>17:20 - 18:00</th>
										<td class="pink_bg">Satellite Symposium 2  <br/>
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="satellite_symposium_2_mb">
								<tbody>
									<tr class="gray_bg">
										<th class="gray_bg">November 29 (Fri) 17:20 - 18:00</th>
									</tr>
									<tr class="pink_bg">
										<td>Satellite Symposium 2 <br/>
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
										<th>17:20 - 18:00</th>
										<td>
											<p class="s_bold">TBD</p>
											<p>TBD (TBD)</p>
										</td>
									</tr>

								</tbody>
							</table>
						</div>

						<div class="circle_title">Breakfast &amp; Luncheon Symposium</div>
						<!-- Luncheon Symposium 1 (K) [Daewoong]  -->
						<div>
							<table class="table color_table" name="luncheon_symposium_2">
								<colgroup>
									<col class="col_th">
									<col width="*">
								</colgroup>
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri)<br/>11:50 - 13:00</th>
										<td class="pink_bg">Luncheon Symposium 2 
											<!-- <button type="button" class="favorite_btn centerT">My Favorite</button> -->
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table color_table mobile" name="luncheon_symposium_2_mb">
								<tbody>
									<tr>
										<th class="gray_bg">November 29 (Fri) 11:50 - 13:00</th>
									</tr>
									<tr>
										<td class="pink_bg">Luncheon Symposium 2 </td>
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
										<th>11:50 - 13:00</th>
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
