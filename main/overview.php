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
	<h1 class="page_title">IMCVP 2024
		<div class="sub_btn_box">
				<a href="/main/welcome.php">Welcome Message</a>
				<a href="/main/organizing_committee.php">Organization</a>
				<a href="/main/overview.php" class="on">Overview</a>
			</div>
	</h1>
    <div class="table_wrap x_scroll inner">
		<h3 class="title">Overview</h3>
         <table class="c_table2 detail_table type2">
             <colgroup>
                 <col width="280px">
                 <col width="*">
             </colgroup>
             <tr>
                 <th>Title</th>
                 <td>
				 	2024 International Meeting of CardioVascular Disease Prevention
                 </td>
             </tr>
			 <tr>
                 <th>Abbreviation of the Title</th>
                 <td>
				 	IMCVP 2024
                 </td>
             </tr>
             <tr>
                 <th>Date</th>
                 <td>
				 	Friday, November 29, 2024 ~ Saturday, November 30, 2024
                 </td>
             </tr>
             <tr>
                 <th>Venue</th>
                 <td>
				 	Grand Walkerhill Seoul, Republic of Korea
                 </td>
             </tr>
             <tr>
                 <th>Hosted by</th>
                 <td>
				 	Korean Society of Cardiovascular Disease Prevention (KSCP)
                 </td>
             </tr>
             <!-- <tr>
                 <th>Theme</th>
                 <td>
                     Now is the Time to Conquer Obesity
                 </td>
             </tr> -->
             <tr>
                 <th>Official Language</th>
                 <td>
                     English	
                 </td>
             </tr>
			 <tr>
                 <th>Official Website</th>
                 <td>
                     <a href="https://imcvp.org" class="link under">imcvp.org</a>
                 </td>
             </tr>
             <tr>
                 <th>IMCVP 2024 Secretariat</th>
                 <td>
                   <a href="mailto:info@imcvp.org" class="link under">info@imcvp.org</a>
                 </td>
             </tr>
         </table>
		</div>
		<div class="table_wrap x_scroll inner">
			<h3 class="title">Important Dates</h3>
			<table class="c_table2 detail_table type2">
				<colgroup>
					<col width="280px">
					<col width="*">
				</colgroup>
				<tr>
					<th>Abstract Submission Deadline 1<sup class="font_small">st</sup></th>
					<td>Sunday, <span class="bold point4_txt">August 18</span>, 2024</td>
				</tr>
				<tr>
					<th>Abstract Submission Deadline 2<sup class="font_small">nd</sup></th>
					<td>Sunday, <span class="bold point4_txt">October 6</span>, 2024</td>
				</tr>
				<tr>
					<th>Notification of Abstract Acceptance</th>
					<td>Wednesday, <span class="bold point4_txt">October 16</span>, 2024</td>
				</tr>
				<tr>
					<th>Early-Bird Registration Deadline</th>
					<td>Sunday, <span class="bold point4_txt">September 1</span>, 2024</td>
				</tr>
				<tr>
					<th>Pre-Registration Deadline</th>
					<td>Sunday, <span class="bold point4_txt">November 3</span>, 2024</td>
				</tr>
			</table>
		</div>
	
</section>

<?php include_once('./include/footer.php'); ?>