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
	$name = $data["first_name"]." ".$data["last_name"] ?? "-";
	$nation = $data["nation_en"] ?? "-";
	$total_price = ($data["nation_no"] == 25) ? "KRW ".$data["total_price_kr_text"] : "USD ".$data["total_price_us_text"];
	$payment_method = $data["payment_method_txt"] ?? "-";
	$payment_date = $data["payment_date_text"] ?? "-";
?>

<div style="max-width:800px;">
	<!-- 영수증 (PC) -->
	<?php
		if (!$is_check_mobile) {
	?>
			<div style="max-width:100%; border:5px solid #004793">
				<div style="padding-top:100px; position:relative;">
					<div>
						<img src="./img/receipt_logo.svg" alt="" style="width:180px; max-width:100%; max-height:80px; position:absolute; top:20px; left:15px;">
						<h1 style="font-size:66px; font-weight:900; color:#000000; text-align:center;">RECEIPT</h1>	
					</div>
					<div style="padding:0 50px; margin-top:30px;">
						<table style="border-collapse:collapse; border-spacing:0; width:100%;">
							<tbody>
								<tr>
									<th width="180" style="width:180px; padding:16px 20px; font-size:16px; font-weight:800; color:#000000; background-color:#DEEAF6; border-top:3px solid #000066; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Payment Date</th>
									<td style="padding:16px 20px; font-size:16px; color:#000000; border-top:3px solid #000066; border-bottom:1px solid #000066;"><?= $payment_date ?></td>
								</tr>
								<tr>
									<th width="180" style="width:180px; padding:16px 20px; font-size:16px; font-weight:800; color:#000000; background-color:#DEEAF6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Registration No.</th>
									<td style="padding:16px 20px; font-size:16px; color:#000000; border-bottom:1px solid #000066;"><?= $register_no ?></td>
								</tr>
								<tr>
									<th width="180" style="width:180px; padding:16px 20px; font-size:16px; font-weight:800; color:#000000; background-color:#DEEAF6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Name</th>
									<td style="padding:16px 20px; font-size:16px; color:#000000; border-bottom:1px solid #000066;"><?= $name ?></td>
								</tr>
								<tr>
									<th width="180" style="width:180px; padding:16px 20px; font-size:16px; font-weight:800; color:#000000; background-color:#DEEAF6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Country</th>
									<td style="padding:16px 20px; font-size:16px; color:#000000; border-bottom:1px solid #000066;"><?= $nation ?></td>
								</tr>
								<tr>
									<th width="180" style="width:180px; padding:16px 20px; font-size:16px; font-weight:800; color:#000000; background-color:#DEEAF6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Registration Fee</th>
<!--									<td style="padding:16px 20px; font-size:16px; color:#000000; border-bottom:1px solid #000066;">--><?php //= $total_price ?><!--</td>-->
									<td style="padding:16px 20px; font-size:16px; color:#000000; border-bottom:1px solid #000066;"><?= number_format($data['price']) ?></td>
								</tr>
								<tr>
									<th width="180" style="width:180px; padding:16px 20px; font-size:16px; font-weight:800; color:#000000; background-color:#DEEAF6; border-right:1px solid #000066; border-bottom:3px solid #000066; text-align:left;">Payment Method</th>
									<td style="padding:16px 20px; font-size:16px; color:#000000; border-bottom:3px solid #000066;"><?= $payment_method ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<img src="./img/receipt_bottom.png" alt="" style="width:100%; max-width:100%;">
				</div>
			</div>
	<?php
		} else {
	?>
	<!-- 영수증 (MB) -->
			<div style="max-width:100%;">
				<div>
					<img src="./img/receipt_top_mb.png" alt="" style="width:100%; max-width:100%;">
					<div style="padding:0 24px; margin-top:30px;">
						<table style="border-collapse:collapse; border-spacing:0; width:100%;">
							<tbody>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:#F6F6F6; border-top:3px solid #000066; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Payment Date</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-top:3px solid #000066; border-bottom:1px solid #000066;"><?= $payment_date ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:#F6F6F6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Registration No.</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000066;"><?= $register_no ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:#F6F6F6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Name</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000066;"><?= $name ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:#F6F6F6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Country</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000066;"><?= $nation ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:#F6F6F6; border-right:1px solid #000066; border-bottom:1px solid #000066; text-align:left;">Registration Fee</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:1px solid #000066;"><?= $total_price ?></td>
								</tr>
								<tr>
									<th width="135" style="width:135px; padding:12px; font-size:14px; font-weight:800; color:#000000; background-color:#F6F6F6; border-right:1px solid #000066; border-bottom:3px solid #000066; text-align:left;">Payment Method</th>
									<td style="padding:12px; font-size:14px; color:#000000; border-bottom:3px solid #000066;"><?= $payment_method ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<img src="./img/receipt_bottom_mb.png" alt="" style="width:100%; max-width:100%;">
				</div>
			</div>
	<?php
		}
	?>
</div>
</body>
</html>