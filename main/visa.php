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
    <h1 class="page_title">VISA & K-ETA</h1>
    <div class="inner">
        <div class="visa_desc text_box">
            <p>Foreign visitors who wish to enter the Republic of Korea must have a valid passport and obtain a Korean visa before the visitation. However, people from some countries who wish to visit Korea temporarily are permitted to enter without a visa according to visa-exemption agreements or in accordance with principles of reciprocity or national interest.</p>
        </div>
        <div class="section">
            <h3 class="title">VISA</h3>
            <div class="visa_wrap">
                <p>
                    In order to enter the Republic of Korea, a valid passport and a Korean visa are mandatory.<br />
                    For more accurate information, the Secretariat of ICOMES 2023 recommends that you contact the Korean
                    Embassy in your country to ask about the necessary documents for visa issuance. It is highly
                    recommended to apply for a visa at least one month before your departure.<br />
                    Nationals or regions with which Korea has signed a visa waiver agreement can enter without a visa
                    for up to 30 or 90 days. For more information on visa issuance, please visit the website of the
                    Ministry of Foreign Affairs of the Republic of Korea.
                </p>
                <div class="table_wrap detail_table_common x_scroll">
                    <table class="c_table">
                        <tbody>
                            <tr>
                                <th>Ministry of Foreign Affairs</th>
                                <td>
                                    <a href="http://www.mofa.go.kr/eng/index.do"
                                        class="link pc_only">http://www.mofa.go.kr</a>
                                    <a href="http://www.mofa.go.kr/eng/index.do" class="link mb_only">www.mofa.go.kr</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Korea Visa Portal</th>
                                <td>
                                    <a href="https://www.visa.go.kr/?LANG_TYPE=EN"
                                        class="link pc_only">https://www.visa.go.kr</a>
                                    <a href="https://www.visa.go.kr/?LANG_TYPE=EN"
                                        class="link mb_only">www.visa.go.kr</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="section">
            <h3 class="title">Invitation Letter for VISA</h3>
            <div class="visa_wrap">
                <p>
                    The Secretariat will send official invitation letters upon request, but only to those who have
                    completed registration with full payment.<br />This invitation is intended to assist potential
                    participants in raising funds or obtaining visas. Please note that an invitation letter does <span
                        class="bold">NOT</span> guarantee any financial assistance from the organizers.<br />To obtain
                    an invitation letter for attending ICOMES 2023, please send an email to the secretariat at <a
                        href="mailto:icomes@into-on.com" class="link">icomes@into-on.com</a> and provide the following
                    application information.
                </p>
                <div class="text_box">
                    <ul>
                        <li class="f_bold"><span class="bold">1) </span>Full name on passport</li>
                        <li class="f_bold"><span class="bold">2) </span>Nationality</li>
                        <li class="f_bold"><span class="bold">3) </span>Name of the organization</li>
                        <li class="f_bold"><span class="bold">4) </span>Valid passport No.</li>
                        <li class="f_bold"><span class="bold">5) </span>Postal code and postal address</li>
                        <li class="f_bold"><span class="bold">6) </span>Mobile phone numbers</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section">
            <h3 class="title">K-ETA</h3>
            <div class="visa_wrap">
                <p>
                    K-ETA is an electronic travel authorization that <span class="bold">visa-free foreign visitors need
                        to obtain</span> before entering the Republic of Korea, by submitting relevant information
                    online such as their travel information.
                </p>
                <div class="text_box indent">
                    <ul>
                        <li>• The purpose of travel should be for tourism, visiting family members, participating in events or meetings, or commercial business (excluding the pursuit of profit).</li>
                        <li>• Starting 1st September 2021, K-ETA is mandatory for all foreigners entering Korea from visa-waiver countries and visa-free countries. All foreigners without either a K-ETA or a valid Visa will not be permitted to board a plane to Korea. (You do not need a K-ETA if you have a valid visa)</li>
						<li class="bold">• Starting 1st April 1, 2023, K-ETA (The Korea Electronic Travel Authorization) will be temporarily exempted to the 26 countries/regions listed below.<br/>- Austria, Australia, Belgium, Canada, Czech Republic, Denmark, Finland, France, Germany, Hong Kong, Italy, Japan, Macau, Netherlands, New Zealand, Norway, Poland, Qatar, Romania, Saudi Arabia, Singapore, Spain, Sweden, Taiwan, UAE, United Kingdom, United States (including Guam)</li>
                    </ul>
                </div>
            </div>
		</div>
		<div class="section">
			<h3 class="title">How to apply</h3>
			<div class="text_box indent">
                <ul>
                    <li>• You can apply for your K-ETA at the official K-ETA website <a href="http://www.k-eta.go.kr" class="link">www.k-eta.go.kr</a> PC and mobile app.</li>
                    <li>• You must apply for K-ETA at least 72 hours before boarding your flight or ship bound for the Republic of Korea. (Due to the increased number of K-ETA applicants, the process is currently taking more than 72 hours)</li>
                </ul>
            </div>
		</div>
		<div class="section">
			<h3 class="title">Items to prepare</h3>
			<div class="text_box indent">
				<ul>
					<li class="f_bold"><span class="bold">1) </span>A valid passport</li>
					<li class="f_bold"><span class="bold">2) </span>Credit cards (for fee payment)<br>- 10,000 KRW (approximately $9-10, Additional fee excluded).</li>
					<li class="f_bold"><span class="bold">3) </span>E-mail address</li>
					<li class="f_bold"><span class="bold">4) </span>Recent profile photo</li>
				</ul>
			</div>
		</div>
    </div>
</section>

<?php include_once('./include/footer.php');?>