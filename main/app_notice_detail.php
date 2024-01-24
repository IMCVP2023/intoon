<?php include_once('./include/head.php');?>
<?php include_once('./include/app_header.php');?>
<script src="./js/app_notice.js"></script>
<?php
$idx=$_GET['idx'];

$select_notice_detail_query="
                                SELECT idx, type, title_en, content_en
                                FROM board
                                WHERE is_deleted='N'
                                AND type=3
                                ANd idx = {$idx}
                            ";
$notice = sql_fetch($select_notice_detail_query);
?>

<!-- HUBDNCAJY : App - Notice > 상세 페이지 -->
<section class="container app_version">
	<div class="app_title_box">
		<h2 class="app_title">
			NOTICE
			<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_notice.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button>
		</h2>
	</div>
	<div class="container_inner">
		<div class="contents_box">
			<div class="app_contents_wrap type3">
				<div class="app_notice_detail">
					<div class="app_notice_title">
						<?=$notice['title_en']?>
					</div>
					<div class="app_notice_cont">
						<?=$notice['content_en']?>
					</div>
				</div>
			</div> 
		</div>
	</div>
</section>

<?php include_once('./include/app_footer.php');?>