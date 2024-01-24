<?php
	include_once('./include/head.php');

    $registration_idx = $_GET["idx"];
    $user_idx = $member["idx"];

	$sql = "
		SELECT
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
		WHERE rr.idx = {$registration_idx}
		AND rr.register = {$user_idx}
	";
	$data = sql_fetch($sql);

	/*if (!$data) {
		echo "<script>alert('Registration Not Found.');window.close();</script>";
		exit;
	}*/
?>
<link href="https://hangeul.pstatic.net/hangeul_static/css/nanum-myeongjo.css" rel="stylesheet">

<div class="pre_registration_wrap">
	<?php
		$is_korea = ($data['nation_no'] == 25);

		//if (!$is_korea) {
			// 영문
	?>
	<!-- 행사 끝나면 이걸로 교체-->
	<!-- 사전등록확인증(영문) : eng 클래스 추가 / 문구 구성 및 내용 다소 상이 -->
	<!-- <div class="pre_registration_confirm eng"> -->
	<!-- 	<div class="pre_dim"><img src="./img/confirmation_form.svg" alt=""></div> -->
	<!-- 	<div class="pre_badge"><img src="./img/confirmation_badge2.svg" alt=""></div> -->
	<!-- 	<div class="pre_cont"> -->
	<!-- 		<h1 class="pre_title_big text_center">ICOMES 2022<br><span>Certification of Completion</span></h1> -->
	<!-- 		<ul class="pre_info1"> -->
	<!-- 			<li>NAME : <span><?=$data['first_name']?>, <?=$data['last_name']?></span></li> -->
	<!-- 			<li>AFFILIATION : <span><?=$data['affiliation']?></span></li> -->
	<!-- 		</ul> -->
	<!-- 		<p class="pre_msg">We certify that the above person has participated in and <br>completed this conference below.</p> -->
	<!-- 		<ul class="pre_info2"> -->
	<!-- 			<li> -->
	<!-- 				Name of Education : <span>ICOMES 2022</span>  -->
	<!-- 				<span class="pre_fullname">(International Congress on Obesity and Metabolic Syndrome hosted by KSSO)</span> -->
	<!-- 			</li> -->
	<!-- 			<li>Institution : <img src="./img/footer_logo_mini.svg" alt=""><span>KSSO (Korean Society for the Study of Obesity)</span></li> -->
	<!-- 			<li>Date : <span>2022.09.01-2022.09.03</span></li> -->
	<!-- 			<li>Venue  : <span>Conrad Hotel, Seoul</span></li> -->
	<!-- 		</ul> -->
	<!-- 		<p class="pre_date">Issue Date : <span><?=$data['register_date_text']?></span></p> -->
	<!-- 		<div class="pre_sign"><img src="./img/confirmation_sign2.svg" alt=""></div> -->
	<!-- 	</div> -->
	<!-- </div> -->
	<?php
		//} else {
			// 국문
	?>
	<!-- 사전등록확인증(국문) : kor 클래스 추가 / 문구 구성 및 내용 다소 상이 -->
	<div class="pre_registration_confirm kor">
		<div class="pre_dim"><img src="./img/confirmation_form.svg" alt=""></div>
		<div class="pre_badge"><img src="./img/confirmation_badge2.svg" alt=""></div>
		<div class="pre_cont">
			<h1 class="pre_title_big">ICOMES 2022<br><span>Registration Confirmation Certificate</span></h1>
			<ul class="pre_info1">
				<li>Name : <span><?=$data['last_name']?> <?=$data['first_name']?></span></li>
				<li>Affiliation : <span><?=$data['affiliation']?></span></li>
				<li>Licence number : <span><?=$data['licence_number_text']?></span></li>
				<li>Registration Fee : <span><?=isset($data['total_price_kr_text']) ? "￦".$data['total_price_kr_text'] : "$".$data['total_price_us_text']?></span></li>
			</ul>
			<p class="pre_msg">We certify that the above person has pre-registerd with the academic society below.</p>
			<ul class="pre_info2">
				<li>
					교육명 : <span>ICOMES 2022</span> 
					<span class="pre_fullname">(International Congress on Obesity and Metabolic Syndrome hosted by KSSO)</span>
				</li>
				<li>연수교육기관 : <img src="./img/footer_logo_mini.svg" alt=""><span>KSSO (Korean Society for the Study of Obesity)</span></li>
				<li>참가형태 : <span>Off-line</span></li>
				<li>날짜 : <span>2022.09.01-2022.09.03</span></li>
				<li>장소 : <span>Conrad Hotel, Seoul</span></li>
			</ul>
			<p class="pre_date">Issue Date : <span><?=$data['register_date_text']?></span></p>
			<div class="pre_sign"><img src="./img/confirmation_sign2.svg" alt=""></div>
		</div>
	</div>
	<?php
		//}
	?>
	<div class="btn_wrap">
		<button type="button" class="btn update_btn pop_save_btn" onclick="CreatePDFfromHTML()">Save</button>
		<!-- <a class="btn update_btn pop_save_btn" onclick="CreatePDFfromHTML()">Save</a> -->
	</div>
<!--	 <div style="display:none">-->
<!--	 	<a class="a_tag" href="./pdf_library/viewer.html?file=sample.pdf">view</a>-->
<!--	 	<iframe src="./pdf_library/viewer.html?file=sample.pdf" style="width:500px; height:300px; border:1px solid #00c;"></iframe>-->
<!--	 </div>-->
	
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>-->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>-->

<script>

//function CreatePDFfromHTML() {
//
//	var idx = "<?php //= $idx?>//";
//
//	window.location.replace("pre_registration_confirm2.php?idx="+idx);
//
//}

// function CreatePDFfromHTML() {
//
//     var HTML_Width = $(".pre_registration_confirm").width();
//     var HTML_Height = $(".pre_registration_confirm").height();
//     var top_left_margin = 15;
//     var PDF_Width = (HTML_Width + (top_left_margin * 2));
//     var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
//     var canvas_image_width = HTML_Width;
//     var canvas_image_height = HTML_Height;
//
//     var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
//
// 	var newWidth = HTML_Width * 3;
// 	var newHeight = HTML_Height;
//
// 	var pre = $(".pre_registration_confirm")[0];
//
// 	$(pre).css({
// 		'width': newWidth,
// 		'height': newHeight
// 	});
//
//
//     html2canvas(pre).then(function (canvas) {
//        var imgData = canvas.toDataURL("image/PNG", 1);
//
// 		imgData.onload = function(){
// 		var width = this.naturalWidth,
// 				height = this.naturalHeight,
// 				canvas = document.getElementById('c'),
// 				ctx = canvas.getContext('2d');
//
// 			canvas.width = Math.floor(width / 2);
// 			canvas.height = Math.floor(height / 2);
//
// 			ctx.scale(0.5, 0.5);
// 			ctx.drawImage(this, 0, 0);
// 			ctx.rect(0,0,500,500);
// 			ctx.stroke();
//
// 			// restore original 1x1 scale
// 			ctx.scale(2, 2);
// 			ctx.rect(0,0,500,500);
// 			ctx.stroke();
// 		};
//        var pdf = new jsPDF('p', 'pt', [PDF_Width , PDF_Height]);
//        pdf.addImage(imgData, 'PNG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
//        for (var i = 1; i <= totalPDFPages; i++) {
//            pdf.addPage(PDF_Width, PDF_Height);
//            pdf.addImage(imgData, 'PNG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
//        }
//
// 	   var today = new Date();
//
// 		var year = today.getFullYear();
// 		var month = ('0' + (today.getMonth() + 1)).slice(-2);
// 		var day = ('0' + today.getDate()).slice(-2);
//
// 		var hours = ('0' + today.getHours()).slice(-2);
// 		var minutes = ('0' + today.getMinutes()).slice(-2);
// 		var seconds = ('0' + today.getSeconds()).slice(-2);
//
// 		var today_tile = year + month  + day + hours + minutes + seconds;
//
// 	   pdf.save("icomes2022_certification_"+today_tile+".pdf");
//
//     });
// }

</script>
</body>
</html>