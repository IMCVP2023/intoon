<?php
	include_once('./include/head.php');

	// 23.05.19 HUBDNC_NYM PC, MOBILE마크업이 다른 부분이여서 체크 필요
	$is_check_mobile = ($_GET["type"] == "pc") ? false : true;

	$registration_idx = $_GET["idx"] ?? NULL;
    $user_idx = $member["idx"] ?? NULL;

	$sql = "SELECT
				mb.nation_no,
				mb.first_name, mb.last_name,
				rr.affiliation, 
				IFNULL(mb.licence_number, '-') AS licence_number_text,
				pa.`type` AS payment_type,
				nt.nation_en, 
				(
					CASE
						WHEN rr.payment_methods = 0 THEN 'Credit Card'
						WHEN rr.payment_methods = 1 THEN 'Bank transfer'
					END
				) AS payment_method_txt,
				IFNULL(FORMAT(pa.total_price_kr, 0), 0) AS total_price_kr_text, 
				IFNULL(FORMAT(pa.total_price_us, 0), 0) AS total_price_us_text,
				DATE_FORMAT(pa.payment_date, '%Y-%m-%d') AS payment_date_text,
				DATE_FORMAT(rr.register_date, '%Y.%m.%d') AS register_date_text,
				rr.price
			FROM request_registration AS rr
			LEFT JOIN member AS mb
				ON mb.idx = rr.register
			LEFT JOIN nation AS nt
				ON mb.nation_no = nt.idx
			LEFT JOIN payment AS pa
				ON pa.idx = rr.payment_no
			WHERE rr.idx = {$registration_idx}
			AND rr.register = {$user_idx};";
	$data = sql_fetch($sql);

	if (!$data) {
		echo "<script>alert('Registration Not Found.');window.close();</script>";
		exit;
	}

	// 변수 설정	
	$register_no = !empty($registration_idx) ? "ICOMES2023-".$registration_idx : "-";

	$register_no = $registration_idx ? "IMCVP2024-".$registration_idx : "-";

	if(!empty($registration_idx)){
		$code_number = $registration_idx;

		while (strlen("" . $code_number) < 4) {
			$code_number = "0" . $code_number;
		}

		$register_no = "IMCVP2024". "-" . $code_number;
	}
	$name = $data["first_name"]." ".$data["last_name"] ?? "-";
	$nation = $data["nation_en"] ?? "-";
	$total_price = ($data["nation_no"] == 25) ? "KRW ".$data["total_price_kr_text"] : "USD ".$data["total_price_us_text"];
	$payment_method = $data["payment_method_txt"] ?? "-";
	$payment_date = $data["payment_date_text"] ?? "-";
?>
<!-- 구글 폰트 불러오기 -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sedan+SC&display=swap" rel="stylesheet">

<div style="max-width:800px;">
	<!-- 영수증 (MB) -->
			<div style="max-width:100%;">
				<div>
					<img src="./img/2024_receipt_top.png" alt="" style="width:100%; max-width:100%;">
					<div style="padding:0 24px; margin-top:30px;">
						<h1 style="font-size:60px; text-align:center; margin-bottom:20px; font-family: 'Sedan SC', serif; font-weight:500">RECEIPT</h1>
						<table style="border-collapse:collapse; border-spacing:0; width:100%; margin-bottom:50px;">
							<tbody>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:rgba(255,207,185,0.3); border-top:1px solid #000; border-right:1px solid #ffcfb9; border-bottom:1px solid #000; text-align:left;">Payment Date</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-top:1px solid #000; border-bottom:1px solid #000;"><?= $payment_date ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:rgba(255,207,185,0.3); border-right:1px solid #ffcfb9; border-bottom:1px solid #000; text-align:left;">Registration No.</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000;"><?= $register_no ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:rgba(255,207,185,0.3); border-right:1px solid #ffcfb9; border-bottom:1px solid #000; text-align:left;">Name</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000;"><?= $name ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:rgba(255,207,185,0.3); border-right:1px solid #ffcfb9; border-bottom:1px solid #000; text-align:left;">Country</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000;"><?= $nation ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:rgba(255,207,185,0.3); border-right:1px solid #ffcfb9; border-bottom:1px solid #000; text-align:left;">Registration Fee</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000;"><?= $total_price ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:rgba(255,207,185,0.3); border-right:1px solid #ffcfb9; border-bottom:1px solid #000; text-align:left;">Payment Method</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000;"><?= $payment_method ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<img src="./img/2024_receipt_bottom.png" alt="" style="width:100%; max-width:100%;">
				</div>
			</div>

</div>
<div class="btn_wrap" style="max-width:800px; text-align:center;">
    <button type="button" class="btn update_btn pop_save_btn" onclick="CreatePDFfromHTML()">Save</button>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script>
    function CreatePDFfromHTML() {
        const buttonBox = document.querySelector(".btn_wrap");
        const button = document.querySelector(".update_btn");

        buttonBox.removeChild(button)
        let doc = new jsPDF('p', 'mm', 'a4');

        doc.addHTML(document.body, function() {
            doc.save('receipt.pdf');
        });
    }
</script>
</html>