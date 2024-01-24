<?php
include_once('./include/head.php');
include_once('./include/header.php');

$current_year = $_GET["year"] ? $_GET["year"] : "";

$total_count = 0;
$current_page = $_GET["page"] ? @(int) $_GET["page"] : 0;
$current_page = ($current_page > 0) ? $current_page : 1;

$sql_years =	"
						SELECT
							GROUP_CONCAT(year ORDER BY year DESC) AS years
						FROM (
							SELECT 
								year
							FROM photo_gallery
							WHERE is_deleted = 'N'
							GROUP BY year
						) AS pg_group
					";
$years = explode(',', sql_fetch($sql_years)['years']);
?>
<section class="container photo">
	<h1 class="page_title">Photo Gallery</h1>
	<div class="inner">
		<!-- <div class="tab_green">
            <ul class="clearfix">
                <li class="on"><a href="javascript:;">2022</a></li>
                <li><a href="javascript:;">2021</a></li>
                <li><a href="javascript:;">2020</a></li>
                <li><a href="javascript:;">2019</a></li>
                <li><a href="javascript:;">2018</a></li>
                <li><a href="javascript:;">2017</a></li>
                <li><a href="javascript:;">2016</a></li>
            </ul>
        </div> -->
		<!-- <img class="coming" src="./img/coming.png" /> -->
        <div class="year_slider_wrap section">
            <div class="photo_tab_wrap">
                <ul class="tab_green">
                    <?php
					$is_first = true;
					//foreach($photo_gallery as $key => $value){
						foreach ($years as $key => $value) {

							$on = "";
							if (($is_first && $current_year == "") || ($current_year == $value)) {
								$on = "on";

								$current_year = $value;
							}

							echo "	<li class='" . $on . "'>";
							echo "		<a href='./photo.php?year=" . $value . "' class='img_wrap'>" . $value . "</a>";
							echo "	</li>";

							$is_first = false;
						}

					$sql_file = "
										SELECT
											CONCAT(fi_img.path, '/', fi_img.save_name) AS url
										FROM photo_gallery AS pg
										LEFT JOIN `file` AS fi_img
											ON fi_img.idx = pg.img
										WHERE pg.is_deleted = 'N'
										AND pg.`year` = '" . $current_year . "'
										ORDER BY pg.idx
									";
					$file = get_data($sql_file);
					$total_count = count($file);
					
					?>
                </ul>
            </div>
        </div>
        <div>
            <ul class="clearfix photo_list">
                <?php
				$i = 0;
				$current = 15 * ($current_page - 1);
				$max = (15 * ($current_page) < $total_count) ? 15 * ($current_page) : $total_count;

				$slider_inner = "";

				for ($a = $current; $a < $max; $a++) {
					$pg = $photo_gallery[$current_year][$a];
					$url = $file[$a]['url'];

					echo "<li><div class='img_wrap' data-index='" . $i . "'><img src='" . $url . "' width='100%' height='100%'></div></li>";

					$slider_inner .= "<li><div class='img_wrap'><img src='" . $url . "' width='100%' height='100%'></div></li>";

					$i++;
				}
				?>
			</ul>
			<div class="pagination">
				<ul class="clearfix">
					<?php
					$total_page = ($total_count % 15 != 0) ? intval($total_count / 15) + 1 : intval($total_count / 15);

					$pagination_raw = 10;
					$pagination_total_page = ($total_page % $pagination_raw != 0) ? intval($total_page / $pagination_raw) + 1 : intval($total_page / $pagination_raw);
					$pagination_current_page = ($current_page % $pagination_raw == 0) ? intval($current_page / $pagination_raw) - 1 : intval($current_page / $pagination_raw) + 1;
					$pagination_current_page = ($pagination_current_page > 1) ? $pagination_current_page : 1;


					if ($current_year != "") {
						$url = "?year=" . $current_year . "&page=";
					} else {
						$url = "?page=";
					}

					// 이전페이지
					if ($pagination_current_page > 1) {
						echo "<li><a href='/main/photo.php" . ($url . ($pagination_raw * ($pagination_current_page - 1))) . "'><img src='./img/icons/arrows_left.png'></a></li>";
					}

					$max = $pagination_raw > $total_page ? $total_page : $pagination_raw;
					for ($a = 0; $a < $max; $a++) {
						$page = ($pagination_raw * ($pagination_current_page - 1)) + 1 + $a;
						$on = ($current_page == $page) ? "on" : "";

						echo "<li class='" . $on . "'><a href='/main/photo.php" . ($url . $page) . "'>" . $page . "</a></li>";
					}

					// 다음페이지
					if ($pagination_total_page > $current_page) {
						echo "<li><a href='/main/photo.php" . ($url . ($page + 1)) . "'><img src='./img/icons/arrows_right.png'></a></li>";
					}
					?>
				</ul>
			</div>
		</div>
		<!--//section1-->
	</div>
	<div class="popup more_img_pop">
		<div class="pop_bg"></div>
		<div class="pop_contents">
			<button type="button" class="pop_close pop_close_w"><img src="./img/icons/pop_close_white.png"></button>
			<ul class="pop_slider">
				<?= $slider_inner ?>
			</ul>
		</div>
	</div>
</section>
<script>
	//$('.year_slider_wrap ul').slick({
	//	dots: false,
	//	infinite: true,
	//	slidesToShow: 6,
	//	slidesToScroll: 1,
	//	responsive: [
	//		{
	//			breakpoint: 1100,
	//			settings: {
	//				slidesToShow: 5
	//			}
	//		},
	//		{
	//			breakpoint: 780,
	//			settings: {
	//				slidesToShow: 3
	//			}
	//		},
	//		{
	//			breakpoint: 486,
	//			settings: {
	//				slidesToShow: 2
	//			}
	//		}
	//	]
	//});

	var _slider = $('.pop_slider');
	$('.photo_list .img_wrap').on('click', function() {
		if (!_slider.hasClass('slick-slider')) {
			_slider.slick({
				dots: false,
				infinite: true,
				slidesToShow: 1
			});
		}
		_slider.slick('goTo', ($(this).data('index')));
		$('.more_img_pop').show();
	});

	height_resize();
	$(window).resize(function() {
		height_resize();
	});

	function height_resize() {
		var width = $(".photo_list li").width();
		$(".photo_list li .img_wrap").height(width);
	}
</script>
<?php include_once('./include/footer.php'); ?>