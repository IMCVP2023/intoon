<!-- [240219] sujeong / 포토 갤러리형 게시판 페이지 -->
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
			AND b.`type` = 0
			";

	$total_count = count(get_data($sql));

	$sql .= " ORDER BY b.register_date desc";
	$list = get_data($sql);
?>

<section class="container board">
	<h1 class="page_title">Newsletter</h1>
	<div class="inner">
		<?php
			if(count($list) > 0){
		?>
		<div>
            <ul class="clearfix photo_list">
                <?php
				foreach ($list as $i => $li) {
					echo "<li onclick='goDetail(" . $li['idx'] . ")'>
						<div class='img_wrap' data-index='" . $i . "'>
							<img src='https://imcvp.org" . $li['path'] . "' width='100%' height='100%'/>
						</div>
					</li>";
				}
				?>
			</ul>
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
								$table_title_arr = ($language == "ko") ? ["번호", "제목", "작성일", "조회수"] : ["번호", "제목", "작성일", "조회수"];
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
							<td colspan="4"> 준비 중입니다. </td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php
			}
		?>

	</div>

</section>
<script>
	height_resize();
	$(window).resize(function() {
		height_resize();
	});

	function height_resize() {
		var width = $(".photo_list li").width();
		$(".photo_list li .img_wrap").height(width);
	}

	function goDetail(id){
		window.location.href = `/main/board_newsletter_detail.php?no=${id}`
	}
</script>
<?php include_once('./include/footer.php');?>