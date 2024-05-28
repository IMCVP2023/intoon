<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$total_count = 0;
	$current_page = $_GET["page"] ? @(int) $_GET["page"] : 0;
	$current_page = ($current_page > 0) ? $current_page : 1;
	$start = 10 * ($current_page-1);

	$sql =	"
			SELECT
				b.idx, b.title_en, b.title_ko, f.path, DATE_FORMAT(b.register_date, '%Y-%m-%d') AS register_date, b.view
			FROM board AS b
			LEFT JOIN(
				SELECT
					idx, CONCAT(path,'/',save_name) AS path
				FROM `file`
			)AS f
			ON b.thumnail = f.idx
			WHERE b.is_deleted = 'N'
			AND b.`type` = 1
			";

	$total_count = count(get_data($sql));

	$sql .= " ORDER BY b.register_date DESC LIMIT {$start}, 10 ";
	$list = get_data($sql);
?>

<section class="container board">
    <!-- <div class="sub_banner">
		<h1>FAQ & Notice</h1>
	</div> -->
    <!-- <div class="tab_green">
		<ul class="clearfix">
			<li><a href="./board_faq.php">FAQ</a></li>
			<li class="on"><a href="./board_notice.php">Notice</a></li>
		</ul>
	</div> -->
	<h1 class="page_title">News & Information
			<div class="sub_btn_box">
				<a href="/main/board_notice.php" class="on">News</a>
				<a href="/main/visa.php">VISA</a>
				<a href="/main/useful_information.php">Useful Information</a>
			</div>
		</h1>
	<div class="inner">
		<?php
			if(count($list) > 0){
		?>
			<div class="table_wrap x_scroll">
				<table class="table_vertical notice_table">
					<colgroup>
						<col class="col_date" />
						<col width="*" />
						<col class="col_date" />
						<col class="col_date" />
					</colgroup>
					<thead>
						<tr>
							<?php
								$table_title_arr = ($language == "ko") ? ["번호", "제목", "작성일", "조회수"] : ["No", "Title", "Date", "Views"];
								foreach($table_title_arr as $th_text){
							?>
							<th><?=$th_text?></th>
							<?php
								}
							?>

						</tr>
					</thead>
					<tbody>
						<?php
							$col_title = "title_".$language;
							$timenow = date("Y-m-d");
							$time_yesterday = date("Y-m-d", strtotime($timenow." -1 day"));

							for($i=0;$i<count($list);$i++){
								$l = $list[$i];
								$no = $total_count - ($i + $start);
						?>
							<tr>
								<td><?= $no ?></td>
								<td class="notice_title">
									<a href="./board_notice_detail.php?no=<?=$l["idx"]?>&p=<?=$current_page?>&i=<?=$no?>">
										<?php
											$boardtime = $l["register_date"];
											$view = $l["view"];

											if($boardtime >= $time_yesterday && $boardtime <= $timenow){
												echo '<span class="alert_new">NEW</span>';
											}
										?>
										<?=stripslashes($l[$col_title])?>
									</a>
								</td>
								<td class="gray_txt"><?=$boardtime?></td>
								<td class="gray_txt"><?= $view; ?></td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		<?php
			} else {
		?>
			<!-- <div class="inner"> -->
				<!-- <img class="coming" src="./img/coming.png" /> -->
				<!-- <div class="not_ready">Will be updated soon</div> -->
				<!-- <img class="coming" src="./img/coming.png"> -->
			<!-- </div> -->
			<div class="table_wrap x_scroll">
				<table class="table_vertical notice_table">
					<colgroup>
						<col class="col_date" />
						<col width="*" />
						<col class="col_date" />
						<col class="col_date" />
					</colgroup>
					<thead>
						<tr>
							<?php
								$table_title_arr = ($language == "ko") ? ["번호", "제목", "작성일", "조회수"] : ["No", "Title", "Date", "Views"];
								foreach($table_title_arr as $th_text){
							?>
							<th><?=$th_text?></th>
							<?php
								}
							?>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="4"> Will be updated </td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php
			}
		?>


		<!-- 화면 확인용 마크업 -->
		<!-- 
		<div class="table_wrap">
			<table class="table_vertical">
				<colgroup>
					<col width="*" />
					<col class="col_date" />
				</colgroup>
				<thead>
					<tr>
						<th>Title</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a href="./board_notice_detail.php"><span class="alert_new">NEW</span>welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php"><span class="alert_new">NEW</span>welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
					<tr>
						<td><a href="./board_notice_detail.php">welcome ICOMES</a></td>
						<td>2022.03.17</td>
					</tr>
				</tbody>
			</table>
		</div>
		 -->
		<!-- 화면 확인용 마크업 / end -->


		<div class="pagination">
			<ul class="clearfix">
				<?php 
					$total_page = ($total_count % 10 != 0) ? intval($total_count/10) + 1 : intval($total_count/10);
					
					$pagination_raw = 10;
					$pagination_total_page = ($total_page % $pagination_raw != 0) ? intval($total_page/$pagination_raw) + 1 : intval($total_page/$pagination_raw);
					$pagination_current_page = ($current_page % $pagination_raw == 0) ? intval($current_page/$pagination_raw) - 1 : intval($current_page/$pagination_raw) + 1;
					$pagination_current_page = ($pagination_current_page > 1) ? $pagination_current_page : 1; 

					$url = "?page=";

					// 이전페이지
					if($pagination_current_page > 1){
						echo "<li><a href='./board_notice.php".($url.($pagination_raw * ($pagination_current_page - 1)))."'><img src='./img/icons/arrows_left.png'></a></li>";
					}

					$max = $pagination_raw > $total_page ? $total_page : $pagination_raw;
					for($a = 0; $a < $max; $a++){
						$page = ($pagination_raw * ($pagination_current_page - 1)) + 1 + $a;
						$on = ($current_page == $page) ? "on" : "";

						echo "<li class='".$on."'><a href='./board_notice.php".($url.$page)."'>".$page."</a></li>";
					}

					// 다음페이지
					if($pagination_total_page > $current_page){
						echo "<li><a href='./board_notice.php".($url.($page+1))."'><img src='./img/icons/arrows_right.png'></a></li>";
					}
				?>
			</ul>
		</div>

	</div>

</section>

<?php include_once('./include/footer.php');?>