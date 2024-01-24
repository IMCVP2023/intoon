<?php
	include_once('./include/head.php');

    $user_idx = $member["idx"];

	$sql = "SELECT
				MAX(rr.idx) AS idx,
				mb.nation_no,
				mb.first_name, mb.last_name,
				rr.affiliation, 
				IFNULL(mb.licence_number, '-') AS licence_number_text,
				pa.`type` AS payment_type,
				IFNULL(FORMAT(pa.total_price_kr, 0), 0) AS total_price_kr_text, 
				IFNULL(FORMAT(pa.total_price_us, 0), 0) AS total_price_us_text,
				DATE_FORMAT(rr.register_date, '%Y.%m.%d') AS register_date_text
			FROM request_registration AS rr
			LEFT JOIN member AS mb
				ON mb.idx = rr.register
			LEFT JOIN payment AS pa
				ON pa.idx = rr.payment_no
			WHERE rr.register = {$user_idx}
			AND rr.is_deleted = 'N'
			AND rr.`status` = 2
			GROUP BY rr.idx";


	$data = sql_fetch($sql);

	/*if (!$data) {
		echo "<script>alert('Registration Not Found.');window.close();</script>";
		exit;
	}*/
?>
<link href="https://hangeul.pstatic.net/hangeul_static/css/nanum-myeongjo.css" rel="stylesheet">

<div class="pre_registration_wrap">

	<!-- 행사 끝나면 이걸로 교체-->
	<!-- 사전등록확인증(영문) : eng 클래스 추가 / 문구 구성 및 내용 다소 상이 -->
	<div class="pre_registration_confirm eng">
		<div class="pre_dim"><img src="./img/confirmation_form.svg" alt=""></div>
		<div class="pre_badge"><img src="./img/confirmation_badge2.svg" alt=""></div>
		<div class="pre_cont">
			<h1 class="pre_title_big text_center">ICOMES 2022<br><span>Certification of Completion</span></h1>
			<ul class="pre_info1">
				<li>NAME : <span><?=$data['first_name']?>, <?=$data['last_name']?></span></li>
				<li>AFFILIATION : <span><?=$data['affiliation']?></span></li>
			</ul>
			<p class="pre_msg">We certify that the above person has participated in and <br>completed this conference below.</p>
			<ul class="pre_info2">
				<li>
					Name of Education : <span>ICOMES 2022</span> 
					<span class="pre_fullname">(International Congress on Obesity and Metabolic Syndrome hosted by KSSO)</span>
				</li>
				<li>Institution : <img src="./img/footer_logo_mini.svg" alt=""><span>KSSO (Korean Society for the Study of Obesity)</span></li>
				<li>Date : <span>2022.09.01-2022.09.03</span></li>
				<li>Venue  : <span>Conrad Hotel, Seoul</span></li>
			</ul>
			<p class="pre_date">Issue Date : <span>2022.09.05</span></p>
			<div class="pre_sign"><img src="./img/confirmation_sign2.svg" alt=""></div>
		</div>
	</div>

	<div class="btn_wrap">
		<button type="button" class="btn update_btn pop_save_btn" onclick="CreatePDFfromHTML()">Save</button>
	</div>
</div>
<script>

function CreatePDFfromHTML() {
	window.location.replace("pre_registration_korean_only2.php");
}

</script>
</body>
</html>