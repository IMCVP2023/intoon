<?php include_once('./include/head.php');?>
<?php include_once('./include/app_header.php');?>

<!-- HUBDNCAJY : App - STAMP TOUR > Tour Map 페이지 -->
<section class="container app_version app_tour_map"> <!-- 23.06.14 HUBDNCAJY : .layout_type2 클래스 삭제 -->
	<div class="app_title_box">
		<h2 class="app_title">STAMP TOUR</h2>
		<ul class="app_menu_tab langth_3">
			<li><a href="./app_stamp_guidelines.php">Stamp Tour Guidelines</a></li>
			<li><a href="./app_my_stamp.php">My Stamp</a></li>
			<li class="on"><a href="./app_tour_map.php">Tour Map</a></li>
		</ul>
	</div>
	<div class="container_inner">
		<div class="contents_box">
			<ul class="app_tab min_tab">
				<li class="on"><a href="javascript:;">3F</a></li>
				<li><a href="javascript:;">5F</a></li>
				<li><a href="javascript:;">6F</a></li>
			</ul>
			<div class="app_contents_wrap type2">
				<!------ 3F ------>
				<div class="floor floor_3 on">
					<div class="floor_map">
						<img src="/main/img/floor_map_img01.png" alt="">
					</div>
					<div class="floor_table_wrap">
						<table class="floor_table">
							<colgroup>
								<col width="12%"/>
								<col width="18%"/>
								<col />
							</colgroup>	
							<thead>
								<tr>
									<th>No.</th>
									<th>Grade</th>
									<th>Company Name</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1~3</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>4~6</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>7~10</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>11</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>12~13</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>14~16</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!------ 5F ------>
				<div class="floor floor_5">
					<div class="floor_map">
						<img src="/main/img/floor_map_img02.png" alt="">
					</div>
					<div class="floor_table_wrap">
						<table class="floor_table">
							<colgroup>
								<col width="12%"/>
								<col width="18%"/>
								<col />
							</colgroup>	
							<thead>
								<tr>
									<th>No.</th>
									<th>Grade</th>
									<th>Company Name</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1~3</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>4~6</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>7~10</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>11</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>12~13</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>14~16</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!------ 6F ------>
				<div class="floor floor_6">
					<div class="floor_map">
						<img src="/main/img/floor_map_img03.png" alt="">
					</div>
					<div class="floor_table_wrap">
						<table class="floor_table">
							<colgroup>
								<col width="12%"/>
								<col width="18%"/>
								<col />
							</colgroup>	
							<thead>
								<tr>
									<th>No.</th>
									<th>Grade</th>
									<th>Company Name</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1~3</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>4~6</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>7~10</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>11</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>12~13</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
								<tr>
									<td>14~16</td>
									<td>Platinum</td>
									<td>SANOFI</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div> 
		</div>
	</div>
</section>

<script>
	// Tour Map 층별 탭
	$(".app_tour_map .app_tab li").click(function(){
		var i = $(this).index();
		$(".app_contents_wrap").children(".floor").removeClass("on");
		$(".app_contents_wrap").children(".floor").eq(i).addClass("on");
	});
</script>

<?php include_once('./include/app_footer.php');?>