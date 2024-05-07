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
			<h3 class="title mt10">Ministry of Foreign Affairs</h3>
			<div class="details mb20">
				<button class="visa_btn"><a href="https://www.mofa.go.kr/eng/index.do" class="s_bold underline">Link</a></button>
			</div>
			<!--2-->
			<h3 class="title mt10">Immigration Bureau</h3>
			<div class="details mb20">
				<button class="visa_btn"><a href="https://www.immigration.go.kr/immigration_eng/index.do" class="s_bold break_all underline">Link</a></button>
				<p>
					All visitors to Korea must have a valid passport and visa before coming. Visitors from countries that have a special agreement with Korea are exempt from the visa requirement and allowed to stay in Korea without a visa for 30 days or up to 90 days, depending on agreements. For more information, please contact the local Korean consulate or embassy, or visit the official website of the Korean Ministry of Foreign Affairs and Trade.
				</p>
			</div>
			<!--3-->
			<h3 class="title mt10">Countries under visa exemption agreements</h3>
			<div class="table_wrap detail_table_common x_scroll mb20">
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

            <h3 class="title mt10">Nationals of countries or regions allowed for visa-free entry (30/90) days unless noticed other</h3>
			<div class="table_wrap detail_table_common x_scroll">
				<table class="c_table detail_table">
					<thead>
						<tr>
							<th>Continents</th>
							<th>Countries or Regions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
                                Asia or regions<br>
                                (6 countries)
                            </td>
                            <td>
                                Brunei (30 days), Hong Kong (90 days), Indonesia (diplomatic and official 30 days), Japan (90 days), Macau (90 days), Taiwan (90 days)
                            </td>
						</tr>
                        <tr>
							<td>
                                America<br>
                                (7 countries)
                            </td>
                            <td>
                                Argentina (30 days), Canada (90 days), Ecuador (90 days), Guyana (30 days), Honduras (30 days), Paraguay (30 days), United States (90 days)
                            </td>
						</tr>
                        <tr>
							<td>
                                Europe<br>
                                (11 countries)
                            </td>
                            <td>
                                Albania (30 days), Italy (30 days), Bosnia-Herzegovina (30 days), Croatia (90 days), Cyprus (30 days), Monaco (30 days), Montenegro (30 days), San Marino (30 days), Serbia (90 days), Slovenia (90 days), Vatican (30 days)
                            </td>
						</tr>
                        <tr>
							<td>
                                Oceania or regions<br>
                                (13 countries)
                            </td>
                            <td>
                                Australia (90 days), Fiji (30 days), Guam (30 days), Kiribati (30 days), Marshall Islands (30 days), Micronesia (30 days), Nauru (30 days), New Caledonia (30 days), Palau (30 days), Samoa (30 days), Solomon Islands (30 days), Tonga (30 days), Tuvalu (30 days)
                            </td>
						</tr>
                        <tr>
							<td>
                                Middle East ans Africa<br>
                                (12 countries)
                            </td>
                            <td>
                                Bahrain (90 days), Egypt (30 days), Kuwait (30 days), Lebanon (diplomatic and official 30 days), Mauritius (30 days), Oman (30 days), Qatar (30 days), Saudi Arabia (30 days), Seychelles (30 days), South Africa (30 days), Swaziland (30 days), United Arab Emirates (30 days)
                            </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
    </div>
</section>

<?php include_once('./include/footer.php');?>