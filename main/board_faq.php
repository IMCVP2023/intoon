<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$current_page = $_GET["page"] ? @(int) $_GET["page"] : 0;
	$current_page = ($current_page > 0) ? $current_page : 1;

	$category = $_GET["c"] ? @(int) $_GET["c"] : "";

	$sql =	"
			SELECT 
				idx, title_en, title_ko
			FROM board_category
			WHERE is_deleted = 'N'
			ORDER BY register_date DESC
			";
	$category_list = get_data($sql);

	$sql =	"
			SELECT
				b.idx, b.title_en, b.title_ko, b.content_en, b.content_ko, b.answer_en, b.answer_ko, DATE_FORMAT(b.register_date, '%Y-%m-%d') AS register_date,
				bc.title_en AS c_title_en, bc.title_ko AS c_title_ko
			FROM board AS b
			INNER JOIN(
				SELECT 
					idx, title_en, title_ko
				FROM board_category
				WHERE is_deleted = 'N'
			)AS bc
			On b.category = bc.idx
			WHERE b.is_deleted = 'N'
			AND b.`type` = 2
			";
	if($category != ""){
		$sql .= " AND b.category = {$category} ";
	}
	$sql .= " ORDER BY b.register_date ASC";
	$list = get_data($sql);

	$total_count = count($list);

	$pagination_raw = 10;
	$total_page = ceil($total_count/$pagination_raw);

	$start_row = (($current_page-1)*$pagination_raw);
	$end_row = $start_row + $pagination_raw;
	$end_row = $end_row > $total_count ? $total_count : $end_row;
?>

<section class="container board faq">
	<div class="sub_banner">
		<h1>FAQ & Notice</h1>
	</div>
	<div class="tab_green">
		<ul class="clearfix">
			<li class="on"><a href="./board_faq.php">FAQ</a></li>
			<li><a href="./board_notice.php">Notice</a></li>
		</ul>
	</div>
	<div class="inner">
		<!--select_box-->
		<div class="select_box text_r">
			<select name="category_select" class="select">
				<option value=""><?=($language == "ko" ? "전체" : "Category")?></option>
				<?php 
					foreach($category_list as $cl){
						$selected = ($category == $cl["idx"]) ? "selected" : "";
						$title = ($language == "ko" ? $cl["title_ko"] : $cl["title_en"]);
						echo "<option value='".$cl["idx"]."' ".$selected.">".stripslashes($title)."</option>";
					}
				?>
			</select>
			<div class="select_icon"><img src="./img/icons/icon_triangle.svg" alt=""></div>
		</div>
		<!--faq_list-->
		<div class="toggle_contents_wrap faq_list">
			<?php
				if($total_count > 0){
					$col_title		= "c_title_".$language;
					$col_contents	= "content_".$language;
					$col_answer		= "answer_".$language;

					for($i=$start_row;$i<$end_row;$i++){
						$l = $list[$i];

						$active = "";
						$block = "none";
						if ($i==0) {
							$active = "on active";
							$block = "block";
						}
			?>
				<div class="toggle_title faq_quest <?=$active?>">
					<b class="qa">Q</b>
					<p class="faq_tag"><?=stripslashes($l[$col_title])?></p>
					<h1><?=stripslashes($l[$col_contents])?></h1>
					<button type="button" class="btn_faq_more"><img src="./img/icons/icon_faq_arrow.svg" alt=""></button>
				</div>
				<ul class="faq_detail toggle_contents" style="display: <?= $block; ?>">
					<li><?=stripslashes($l[$col_contents])?></li>
					<li><?=htmlspecialchars_decode(stripslashes($l[$col_answer]))?></li>
				</ul>
			<?php
					}
				} else {
			?>
				<!-- <div class='no_data'>Will be updated</div> -->
				<!-- 아래 마크업은 확인용 퍼블입니다. -->
				<div class="toggle_title faq_quest <?=$active?>">
					<b class="qa">Q</b>
					<p class="faq_tag"><?=stripslashes($l[$col_title])?>학회문의</p>
					<h1><?=stripslashes($l[$col_contents])?>질문제목입니다.</h1>
					<button type="button" class="btn_faq_more"><img src="./img/icons/icon_faq_arrow.svg" alt=""></button>
				</div>
				<ul class="faq_detail toggle_contents" style="display:<?=$block?>;">
					<li><?=stripslashes($l[$col_contents])?>질문 내용입니다.</li>
					<li><?=htmlspecialchars_decode(stripslashes($l[$col_answer]))?> 답변 내용입니다.</li>
				</ul>
				<div class="toggle_title faq_quest <?=$active?>">
					<b class="qa">Q</b>
					<p class="faq_tag"><?=stripslashes($l[$col_title])?>학회문의</p>
					<h1><?=stripslashes($l[$col_contents])?>질문제목입니다.</h1>
					<button type="button" class="btn_faq_more"><img src="./img/icons/icon_faq_arrow.svg" alt=""></button>
				</div>
				<ul class="faq_detail toggle_contents" style="display:<?=$block?>;">
					<li><?=stripslashes($l[$col_contents])?>질문 내용입니다.</li>
					<li><?=htmlspecialchars_decode(stripslashes($l[$col_answer]))?> 답변 내용입니다.</li>
				</ul>
				<div class="toggle_title faq_quest <?=$active?>">
					<b class="qa">Q</b>
					<p class="faq_tag"><?=stripslashes($l[$col_title])?>학회문의</p>
					<h1><?=stripslashes($l[$col_contents])?>질문제목입니다.</h1>
					<button type="button" class="btn_faq_more"><img src="./img/icons/icon_faq_arrow.svg" alt=""></button>
				</div>
				<ul class="faq_detail toggle_contents" style="display:<?=$block?>;">
					<li><?=stripslashes($l[$col_contents])?>질문 내용입니다.</li>
					<li><?=htmlspecialchars_decode(stripslashes($l[$col_answer]))?> 답변 내용입니다.</li>
				</ul>
				<div class="toggle_title faq_quest <?=$active?>">
					<b class="qa">Q</b>
					<p class="faq_tag"><?=stripslashes($l[$col_title])?>학회문의</p>
					<h1><?=stripslashes($l[$col_contents])?>질문제목입니다.</h1>
					<button type="button" class="btn_faq_more"><img src="./img/icons/icon_faq_arrow.svg" alt=""></button>
				</div>
				<ul class="faq_detail toggle_contents" style="display:<?=$block?>;">
					<li><?=stripslashes($l[$col_contents])?>질문 내용입니다.</li>
					<li><?=htmlspecialchars_decode(stripslashes($l[$col_answer]))?> 답변 내용입니다.</li>
				</ul>
				<div class="toggle_title faq_quest <?=$active?>">
					<b class="qa">Q</b>
					<p class="faq_tag"><?=stripslashes($l[$col_title])?>학회문의</p>
					<h1><?=stripslashes($l[$col_contents])?>질문제목입니다.</h1>
					<button type="button" class="btn_faq_more"><img src="./img/icons/icon_faq_arrow.svg" alt=""></button>
				</div>
				<ul class="faq_detail toggle_contents" style="display:<?=$block?>;">
					<li><?=stripslashes($l[$col_contents])?>질문 내용입니다.</li>
					<li><?=htmlspecialchars_decode(stripslashes($l[$col_answer]))?> 답변 내용입니다.</li>
				</ul>
				<!-- 아래 마크업은 확인용 퍼블입니다. / 끝 -->
			<?php
				}
			?>
		</div>
		<!--pagination-->
		<div class="pagination">
			<ul class="clearfix">
				<?php
					if($category != ""){
						$url = "?c=".$category."&page=";
					}else{
						$url = "?page=";
					}

					// 이전페이지
					if($page > 1){
						echo "<li><a href='./board_faq.php".($url.($current_page-1))."'><img src='./img/icons/arrows_left.png'></a></li>";
					}

					for($page = 1; $page <= $total_page; $page++){
						$on = ($current_page == $page) ? "on" : "";
						echo "<li class='".$on."'><a href='./board_faq.php".($url.$page)."'>".$page."</a></li>";
					}

					// 다음페이지
					if($total_page > $current_page){
						echo "<li><a href='./board_faq.php".($url.($current_page+1))."'><img src='./img/icons/arrows_right.png'></a></li>";
					}
				?>
			</ul>
		</div>

	</div>

</section>
<style>
	.toggle_contents {display: none}
</style>
<script>
	$(document).ready(function(){
		$('.toggle_title').click(function(e) {
			e.preventDefault();
			var notthis = $('.toggle_contents_wrap .active').not(this);
			notthis.toggleClass('active').next('.toggle_contents').slideToggle(300);
			$(this).toggleClass('active').next().slideToggle("fast");
		});

		$("select[name=category_select]").on("change",function(){
			var category = $(this).val();
			category = (category && category != "" && typeof(category) != "undefined") ? category : "";

			if(category != ""){
				window.location.href = './board_faq.php?c='+category;
			}else{
				window.location.href = './board_faq.php';
			}
			
		});
	});
</script>
<?php include_once('./include/footer.php');?>