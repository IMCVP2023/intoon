<?php
include_once('./include/head.php');
include_once('./include/header.php');

$sql_info =	"SELECT
					res.*,
					CONCAT(fi_poster.path, '/', fi_poster.save_name) AS fi_poster_url
				FROM (
					SELECT
						ie.title,
						ie.period_event_start,
						ie.period_event_end,
						igv.name_" . $language . " AS venue_name,
						ig.overview_organized_" . $language . " AS overview_organized,
						ig.overview_theme_" . $language . " AS overview_theme,
						ig.overview_official_language_" . $language . " AS overview_official_language,
						ig.overview_secretariat_" . $language . " AS overview_secretariat,
						overview_poster_" . $language . "_img AS overview_poster_img
					FROM info_general AS ig
					, info_general_venue AS igv
					, info_event AS ie
				) AS res
				LEFT JOIN `file` AS fi_poster
					ON fi_poster.idx = res.overview_poster_img";
$info = sql_fetch($sql_info);

$sql_floor =	"SELECT
						igvf.idx,
						igvf.name_" . $language . " AS `name`,
						CONCAT(fi_igvfi.path, '/', fi_igvfi.save_name) AS fi_url
					FROM info_general_venue_floor AS igvf
					LEFT JOIN (
						SELECT
							floor_idx, img
						FROM info_general_venue_floor_img
						WHERE (floor_idx, idx) IN (
							SELECT
								floor_idx,
								MIN(idx) AS idx
							FROM info_general_venue_floor_img
							WHERE is_deleted = 'N'
							GROUP BY floor_idx
						)
					) AS igvfi_min
						ON igvfi_min.floor_idx = igvf.idx
					LEFT JOIN `file` AS fi_igvfi
						ON fi_igvfi.idx = igvfi_min.img
					WHERE igvf.is_deleted = 'N'";
$floor = get_data($sql_floor);
?>

<section class="container overview">
	<!-- HUBDNCLHJ : app 메뉴 탭 -->
<!-- 	<div class="app_title_box"> -->
<!-- 		<h2 class="app_title">ICOMES 2023<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2> -->
<!-- 		<ul class="app_menu_tab"> -->
<!-- 			<li><a href="./welcome.php">Welcome Message</a></li> -->
<!-- 			<li><a href="./organizing_committee.php">Organization</a></li> -->
<!-- 			<li class="on"><a href="./overview.php">Overview</a></li> -->
<!-- 			<li><a href="./venue.php">Venue</a></li> -->
<!-- 		</ul> -->
<!-- 	</div> -->
	<h1 class="page_title">Overview</h1>
    <div class="table_wrap x_scroll inner">
         <table class="c_table2 detail_table">
             <colgroup>
                 <col width="235px">
                 <col width="*">
             </colgroup>
             <tr>
                 <th>Title</th>
                 <td>
                     <!--<?= htmlspecialchars_decode($info['title']) ?>-->
                     <b>ICOMES 2023</b>(2023 International Congress on Obesity and MEtabolic Syndrome)
                 </td>
             </tr>
             <tr>
                 <th>Date</th>
                 <td>
                     <!-- <?= date_format(date_create($info['period_event_start']), "M, j(D)") ?> ~
                     <?= date_format(date_create($info['period_event_end']), "M, j(D)  Y") ?> -->
                     September 7(Thu) ~ 9(Sat), 2023
                 </td>
             </tr>
             <tr>
                 <th>Venue</th>
                 <td>
                     <!--<?= htmlspecialchars_decode($info['venue_name']) ?>-->
                     Conrad Seoul Hotel, Republic of Korea
                 </td>
             </tr>
             <tr>
                 <th>Organized By</th>
                 <td>
                     <?= htmlspecialchars_decode($info['overview_organized']) ?> (KSCP)
                     <!--Korean Society for the Study of Obesity-->
                 </td>
             </tr>
             <tr>
                 <th>Theme</th>
                 <td>
                     Now is the Time to Conquer Obesity

                     <!-- <?= htmlspecialchars_decode($info['overview_theme']) ?> -->

                     <!--The Next Normal: The Future of Obesity Care	-->
                 </td>
             </tr>
             <tr>
                 <th>Official Language</th>
                 <td>
                     <?= htmlspecialchars_decode($info['overview_official_language']) ?>
                     <!--English	-->
                 </td>
             </tr>
             <tr>
                 <th>Secretariat</th>
                 <td>
                     <!--<?= htmlspecialchars_decode($info['overview_secretariat']) ?>-->
                     A-Block Richensia 4F, 341 Baekbeom-ro, Yongsan-gu, Seoul 04315, Korea
                     <br>Tel : +82-2-2285-2582 / Email : icomes@into-on.com

                 </td>
             </tr>
         </table>
    </div>
	<!--
       <div class="sub_banner">
            <h1>Floor Plan </h1>
       </div>
	-->
       <?php
	/*$inner_li = "";

	for ($i = 0; $i < count($floor); $i++) {
		$inner_div = "";
		$fl = $floor[$i];

		$sql_urls =	"SELECT
							GROUP_CONCAT(CONCAT(fi_igvfi.path, '/', fi_igvfi.save_name)) AS urls
						FROM info_general_venue_floor_img AS igvfi
						LEFT JOIN `file` AS fi_igvfi
							ON fi_igvfi.idx = igvfi.img
						WHERE igvfi.is_deleted = 'N'
						AND igvfi.floor_idx = '" . $fl['idx'] . "'";
		$urls = sql_fetch($sql_urls)['urls'];

		$class_active = "";
		$style_display = "";
		if ($i == 0) {
			$class_active = "active";
			$style_display = "display: block;";
		}

		$inner_div .= '<div class="floor_cont_img"><img src="' . $fl['fi_url'] . '"></div>';
		$inner_li .= '<li class="floor_cont"><p>' . $fl['name'] . '</p>' . $inner_div . '</li>';
	}*/
	?>
       <!-- <ul><?= $inner_li ?></ul> -->
</section>

<?php include_once('./include/footer.php'); ?>