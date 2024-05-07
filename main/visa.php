<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$sql_info =	"SELECT
					CONCAT(fi_img.path, '/', fi_img.save_name) AS fi_img_url,
					igv.name_".$language." AS `name`,
					igv.address_".$language." AS address,
					igv.tel_".$language." AS tel,
					igv.homepage_en,
					igv.homepage_ko
				FROM info_general_venue AS igv
				LEFT JOIN `file` AS fi_img
					ON fi_img.idx = igv.".$language."_img";
	$info = sql_fetch($sql_info);
?>

<section class="container visa">
    <h1 class="page_title">VISA</h1>
    <div class="inner">
    <div>
			<!--1-->
			<h3 class="title">Ministry of Foreign Affairs</h3>
			<div class="details">
				<p><a href="https://www.mofa.go.kr/eng/index.do" class="s_bold underline">Link</a></p>
			</div>
			<!--2-->
			<h3 class="title">Immigration Bureau</h3>
			<div class="details">
				<p><a href="https://www.immigration.go.kr/immigration_eng/index.do" class="s_bold underline break_all">Link</a></p>
				<p>
					All visitors to Korea must have a valid passport and visa before coming. Visitors from countries that have a special agreement with Korea are exempt from the visa requirement and allowed to stay in Korea without a visa for 30 days or up to 90 days, depending on agreements. For more information, please contact the local Korean consulate or embassy, or visit the official website of the Korean Ministry of Foreign Affairs and Trade.
				</p>
			</div>
			<!--3-->
			<h3 class="title">Countries under visa exemption agreements</h3>
			<div class="table_wrap detail_table_common x_scroll">
				<table class="c_table detail_table">
					<thead>
						<tr>
							<th>Total</th>
							<th>Passport Type</th>
							<th colspan="2">Countries</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="12">103 countries<br>(up to 90 Days unless noticed otherwise)</td>
							<td>Diplomatic<br>(2 countries)</td>
							<td colspan="2">Turkmenistan (30 days), Ukraine (90 days)</td>
						</tr>
						<tr>
							<td class="border_left nowrap">Diplomatic & Official <br>(35 countries)</td>
							<td colspan="2">
								Algeria, Argentina, Azerbaijan (30 days), Bangladesh, Belarus, Belize, Benin, Cambodia (60 days), China (30 days), Cyprus, Croatia, Ecuador (Diplomatic: as needed for work performance, Official: 3 months), Egypt, Gabon, India, Iran (3 months), Japan (3 months), Kuwait, Laos, Mongolia, Pakistan (3 months), Paraguay, the Philippines (Unlimited), Uzbekistan (60 days), Uruguay, Vietnam, Moldova (90 days within 180 days), Tajikistan, Georgia, Myanmar, Bolivia, Kyrgyz (30 days), Armenia, Angola (30 days), Oman
							</td>
						</tr>
						<tr>
							<td rowspan="8" class="border_left">Diplomatic<br>& Official<br>& Ordinary<br>(66 countries)</td>
							<td>Asia <br>(4 countries)</td>
							<td>Malaysia, New Zealand, Singapore, Thailand</td>
						</tr>
						<tr>
							<td class="border_left">America <br>(25 countries)</td>
							<td>
								Antigua and Barbuda, Bahamas, Barbados, Brazil, Chile, Colombia, Commonwealth of Dominica, Costa Rica, Dominican Republic, El Salvador, Grenada, Guatemala, Haiti, Jamaica, Mexico, Nicaragua, Panama, Peru, Saint Kitts and Nevis, Saint Lucia, Saint Vincent and the Grenadines, Suriname, Trinidad and Tobago, Venezuela (Diplomatic/Official: 30 days, Ordinary: 90 days), Uruguay
							</td>
						</tr>
						<tr>
							<td class="border_left" rowspan="2">Europe <br>(32 countries)</td>
							<td>
								[Schengen countries (except for Slovenia out of the 26 Schengen countries)], Austria (Diplomatic/Official: 180 days), Belgium, Czech Republic, France, Germany, Greece, Hungary, Italy, Liechtenstein, Lithuania, Latvia, Luxemburg, Malta, Netherlands, Poland, Portugal (60days), Slovakia, Spain, Switzerland ※ Denmark, Estonia, Finland, Iceland, Norway, Sweden (90 days within 180 days)
							</td>
						</tr>
						<tr>
							<td class="border_left">
								[Non-Schengen countries] Bulgaria, Ireland, Romania, Turkey, UK, Kazakhstan ※ Russia (60 days in a row, not exceeding 90 days within 180 days)
							</td>
						</tr>
						<tr>
							<td class="border_left nowrap">Africa & Middle East <br>(5 countries)</td>
							<td>Israel, Liberia, Morocco, Tunisia (30 days), Lesotho (60 days)</td>
						</tr>
					</tbody>
				</table>
			</div>


		</div>
    </div>
</section>

<?php include_once('./include/footer.php');?>