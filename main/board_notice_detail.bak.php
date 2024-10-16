<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$board_id = isset($_GET["no"]) ? preg_replace("/[^0-9]/","",$_GET["no"]) : "";
	$page = isset($_GET["p"]) ? preg_replace("/[^0-9]/","",$_GET["p"]) : "";

	$sql =	"
			SELECT
				b.idx, b.title_en, b.title_ko, f.path, 
				b.content_en, b.content_ko, b.answer_en, b.answer_ko, 
				b.view, DATE_FORMAT(b.register_date, '%Y-%m-%d') AS register_date  
			FROM board AS b
			LEFT JOIN(
				SELECT
					idx, CONCAT(path,'/',save_name) AS path, original_name
				FROM `file`
			)AS f
			ON b.thumnail = f.idx
			WHERE b.idx = {$board_id}
			AND b.is_deleted = 'N'
			AND b.type = 1
			";
	$detail = sql_fetch($sql);

	if($detail["idx"] == ""){
		echo "<script>alert('유효하지 않은 게시글입니다.'); window.location.replace('./board_notice.php?t=".$board_type."')</script>";
		exit;
	}

	$view_sql = "UPDATE board SET view = view+1 WHERE idx = {$board_id}";
	sql_query($view_sql);

	$title = $detail["title_ko"];
	$contents = $detail["content_ko"];
	$date_title = "등록일";
	$view_title = "조회수";
	$back_title = "목록";
	if ($language !== "ko") {
		$title = $detail["title_en"];
		$contents = $detail["content_en"];
		$date_title = "Date";
		$view_title = "View";
		$back_title = "List";
	}
?>

<section class="container board_detail">
	<div class="sub_banner">
		<h1>FAQ & Notice</h1>
	</div>
	<div class="tab_green">
		<ul class="clearfix">
			<li><a href="./board_faq.php">FAQ</a></li>
			<li class="on"><a href="./board_notice.php">Notice</a></li>
		</ul>
	</div>
	<div class="inner">
		<div class="notice_top">
			<?php
				echo stripslashes($title);

				$view = $detail["view"];			
				$boardtime = $detail["register_date"];
				$timenow = date("Y-m-d");
				$time_yesterday = date("Y-m-d", strtotime($day." -1 day"));
				if($boardtime >= $time_yesterday && $boardtime <= $timenow){
					echo '<p class="alert_new_mini">NEW</p>';
				}
			?>
			<div>
				<h1 class="n_t_left"><?=$date_title?></h1>
				<div class="clearfix2">
					<span class="n_t_right bold"><?=$boardtime?></span>				
					<span class="n_t_right">Views <span><?= $view; ?></span></span>				
				</div>
			</div>
		</div>
		<div class="notice_bot">
			<?=htmlspecialchars_decode(stripslashes($contents))?>
		</div>
		<!--
		<div class="btn_wrap">
			<button type="button" class="btn" onclick="javascript:window.location.replace('./board_notice.php?page=<?=$page?>');"><?=$back_title?>ddddddddd</button>
		</div>
		-->
	</div>
</section>
<?php include_once('./include/footer.php');?>