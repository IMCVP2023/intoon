<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$board_id = isset($_GET["no"]) ? preg_replace("/[^0-9]/","",$_GET["no"]) : "";
	$page = isset($_GET["p"]) ? preg_replace("/[^0-9]/","",$_GET["p"]) : "";

	$sql =	"
			SELECT
				b.idx, b.title_en, b.title_ko, f.idx AS file_idx, f.path, f.original_name,
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
			AND b.type = 0
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
	$attachment_file = "첨부파일";
	if ($language !== "ko") {
		$title = $detail["title_en"];
		$contents = $detail["content_en"];
		$date_title = "Date";
		$view_title = "View";
		$back_title = "List";
		$attachment_file = "Attachment";
	}

	$i = $_GET["i"] ?? $detail["idx"] ?? "0";
?>

<section class="container board_detail">
	<!-- <div class="sub_banner">
		<h1>FAQ & Notice</h1>
	</div> -->
	<!-- <div class="tab_green">
		<ul class="clearfix">
			<li><a href="./board_faq.php">FAQ</a></li>
			<li class="on"><a href="./board_notice.php">Notice</a></li>
		</ul>
	</div> -->
	<h1 class="page_title">Newsletter</h1>
	<div class="inner">
		<!-- 내용 -->
		<table class="board_table">
			<colgroup>
				<col width="100px" class="num_td">
				<col>
				<col width="120px" class="date_td pc_only">
			</colgroup>
			<thead>
				<tr>
					<th><?=$i?></th>
					<td class="board_title">
						<h5>
							<?=$detail['title_en']?>
							<p class="mb_only"><?=$detail['register_date']?></p>
						</h5>
					</td>
					<td class="pc_only date_td"><?=$detail['register_date']?></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="3">
						<div class="table_editor_wrap">
							<p>
								<?=htmlspecialchars_decode($detail['content_en'])?>
							</p>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- 첨부파일 -->
		<?php if($detail["file_idx"]) { ?>
		<table>
			<colgroup>
				<col width="100px" class="num_td">
				<col>
				<col width="120px" class="date_td pc_only">
			</colgroup>
			<tbody>
				<tr>
					<th><?=$attachment_file?></th>
					<td colspan="2" class="board_title downloads">
						<a href="<?=$detail['path']?>" download><?=$detail['original_name']?></a>
					</td>
					<!-- <td class="pc_only"></td> -->
				</tr>
			</tbody>
		</table>
		<?php } ?>
	</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-rwdImageMaps/1.6/jquery.rwdImageMaps.min.js"></script>

<script>
$(document).ready(function () {
          $('img[usemap]').rwdImageMaps()  
})
</script>
<?php
	include_once('./include/footer.php');
?>