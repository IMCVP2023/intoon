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
	<h1 class="page_title">News & Information
			<div class="sub_btn_box">
				<a href="/main/board_notice.php">News</a>
				<a href="/main/board_newsletter.php" class="on">Newsletter</a>
				<a href="/main/visa.php">VISA</a>
				<a href="/main/useful_information.php">Useful Information</a>
			</div>
		</h1>
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
			
				<h5 class="coming">will be updated</h5>
	
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