<?php include_once('./include/head.php');?>
<?php include_once('./include/app_header.php');?>

<?php
    $member_idx=$_SESSION["USER"]["idx"];
    $sql_info = "
                    SELECT
                        registration_no ,qr_num, m.first_name, m.last_name, m.first_name_kor, m.last_name_kor, n.nation_en, m.affiliation, m.department, m.nation_no, qr.idx AS r_idx
                    FROM member m
                    LEFT JOIN nation n ON m.nation_no = n.idx
                    LEFT JOIN (
                        SELECT rr.idx, rr.register, @rownum:=@rownum+1 AS qr_num, CONCAT('ICOMES2023-',rr.idx) AS registration_no
                        FROM request_registration rr, (SELECT @rownum:=0) TMP
                        WHERE status IN (2,5)
                        AND is_deleted = 'N'
                        ORDER BY idx ASC
                        LIMIT 9999
                    ) AS qr ON qr.register = m.idx
                    WHERE m.idx = {$member_idx}
                    AND is_deleted = 'N'
                    ";
    $member_data = sql_fetch($sql_info);
?>

<!-- HUBDNCLHJ : app qr_code 페이지 -->
<section class="container app_qr_code app_version">
	<div class="app_title_box">
		<h2 class="app_title">
			QR CODE
			<button type="button" class="app_title_prev" onclick="javascript:window.history.back();"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button>
		</h2>
	</div>
	<div class="container_inner inner">
		<div class="contents_box">
			<div class="contents_wrap">
                <p class="app_qr_num">No. <?=$member_data['r_idx']?></p>
                <div class="app_qr_area" id="qrcode" data-encrypt="<?=$member_data['registration_no']?>"></div>
                <div class="app_txt_area">
                    <strong class="app_qr_name"><?=$member_data['first_name']." ".$member_data['last_name']?></strong>
                    <p class="app_qr_affiliation"><?=$member_data['affiliation']?> <span><?=$member_data['nation_en']?></span></p>
                </div>
            </div>
            <!-- 성함, 소속 2줄일 경우 확인을 위한 예시 마크업 -->
            <!-- <div class="contents_wrap">
                <p class="app_qr_num">No. 0001</p>
                <div class="app_qr_area" id="qrcode" data-encrypt="<?=$member_data['registration_no_encrypt']?>"></div>
                <div class="app_txt_area">
                    <strong class="app_qr_name">Theresia Handayani Mina Handayani Mina</strong>
                    <p class="app_qr_affiliation">The Catholic Catholic University of Korea <span>Republic of Korea</span></p>
                </div>
            </div> -->
		</div>
	</div>
</section>

<script type="text/javascript" src="/main/admin/js/qrcode.js"></script>
<script>
    $(document).ready(function(){
        // qrcode 생성
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: document.getElementById("qrcode").dataset.encrypt,
            width: 220,
            height: 220,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    });
</script>

<?php include_once('./include/app_footer.php');?>