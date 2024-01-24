<?php include_once("./common/common.php");?>
<?php
$first_name=$_SESSION["USER"]["first_name"];
$last_name=$_SESSION["USER"]["last_name"];
$affiliation=$_SESSION["USER"]["affiliation"];
$nation_no=$_SESSION["USER"]["nation_no"];

$sql="
        SELECT idx, nation_en
        FROM nation
        WHERE idx={$nation_no}
    ";
$nation_en=sql_fetch($sql)["nation_en"];
?>
<html>
<head>
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/open-sans-all@0.1.3/css/open-sans.min.css" rel="stylesheet">
</head>
<style>
    @page {
        size: A4 landscape;;
        margin: 0;
    }
    @media print {
        html, body {width: 1121px; height: 792px;}
    }
	@media print {
		.no_print { display:none }
	}
</style>
<body style="width:1121px; height:792px; margin:0; padding:0; border:0;">
<div style="width:100%; height:100%; box-sizing:border-box; padding:71px 50px 66px; margin:0; position:relative;" id="pdfDiv">
    <img src="./img/certificate_of_attendance.svg" alt="" style="width:100%; height:100%; position:absolute; left:0; top:0; z-index:-1;">
    <div style="text-align:center;">
        <img src="./img/certificate_of_attendance_logo.svg" alt="ICOMES 2023 로고">
        <p style="font-family: 'Montserrat', sans-serif; font-size:48px; line-height:58px; font-weight:800; letter-spacing:0.216; color:#0F64AF; margin:23px 0 6px;">CERTIFICATE OF ATTENDANCE</p>
        <div style="display:inline-block; position:relative;">
            <img src="./img/certificate_of_attendance_line.svg" alt="" style="position:absolute; top:55%; transform:translate(calc(-100% - 7px), -50%);">
            <span style="font-family: 'Montserrat', sans-serif; font-size:18px; line-height:22px; font-weight:500; letter-spacing:1.288; color:#0F64AF;">This certificate is presented to</span>
            <img src="./img/certificate_of_attendance_line.svg" alt="" style="position:absolute; top:55%; transform:translate(7px, -50%);">
        </div>
    </div>
    <div style="text-align:center; margin:41px 0 47px;">
        <p style="font-family: 'Open Sans', sans-serif; font-size:47px; line-height:64px; font-weight:700; letter-spacing:-0.35; color:#000000; margin:0;"><!--성명--><?=$first_name?> <?=$last_name?></p>
        <p style="font-family: 'Open Sans', sans-serif; font-size:27px; line-height:37px; font-weight:700; letter-spacing:-0.405; color:#000000; margin:11px 0 40px;"><!--소속--><?=$affiliation?>,<br/><!--국가--><?=$nation_en?></p>
        <p style="font-family: 'Montserrat', sans-serif; font-size:18px; line-height:28px; font-weight:600; letter-spacing:-0.72; color:#000000; margin:0;">
            The Korea Society for the Study of Obesity (KSSO) is delighted to present this Certificate to you, <br/>
            acknowledging your participation in ICOMES 2023 (International Congress on Obesity <br/>
            and MEtabolic Syndrome) in Seoul, Korea from September 7 to 9, 2023.
        </p>
    </div>
    <table style="border-collapse: collapse;border-spacing: 0; margin:0 auto;">
        <tbody>
        <tr>
            <td style="width:34%; padding:0;">
                <div style="display:inline-block; vertical-align:middle;">
                    <img src="./img/headman_sign1.png" alt="김성수 서명" style="width:86px; vertical-align:middle; margin-right:25px;">
                    <div style="display:inline-block; text-align:left; vertical-align:middle;">
                        <span style="font-family: 'Montserrat', sans-serif; font-size:15px; line-height:19px; font-weight:700; letter-spacing:-0.57; color:#112747;">Sung Soo Kim</span>
                        <p style="font-family: 'Montserrat', sans-serif; font-size:12px; line-height:15px; font-weight:500; letter-spacing:-0.3; color:#000000; margin:0;">
                            Chairman <br/>
                            The Korea Society for <br/>
                            Study of Obesity
                        </p>
                    </div>
                </div>
            </td>
            <td style="width:32%; padding:0; text-align:center;">
                <img src="./img/certificate_of_attendance_emblem.svg" alt="ICOMES 2023 엠블럼" style="margin:0 auto;">
            </td>
            <td style="width:34%; padding:0;">
                <div style="display:inline-block;">
                    <img src="./img/headman_sign2_1.png" alt="박철영 서명" style="width:116px; vertical-align:middle; margin-right:6px;">
                    <div style="display:inline-block; text-align:left; vertical-align:middle;">
                        <span style="font-family: 'Montserrat', sans-serif; font-size:15px; line-height:19px; font-weight:700; letter-spacing:-0.57; color:#112747;">Cheol-Young Park</span>
                        <p style="font-family: 'Montserrat', sans-serif; font-size:12px; line-height:15px; font-weight:500; letter-spacing:-0.3; color:#000000; margin:0;">
                            President <br/>
                            The Korea Society for <br/>
                            Study of Obesity
                        </p>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="no_print btn_wrap" style="width:1122px; text-align:center; margin-top:20px;">
	<button id="savePdf" type="button" style="margin:0; vertical-align:middle; cursor:pointer; background:transparent; min-width:150px; height:62px; font-size:20px; font-weight:600; padding:0 30px; border:1px solid #585859; color:#000000;">Save</button>
</div>
</body>
</html>
<script src="/main/js/jquery-3.6.0.min.js"></script>
<!--<script src="./plugin/jspdf/html2canvas.js"></script>-->
<!--<script src="./plugin/jspdf/jspdf.min.js"></script>-->
<script>
    $(document).ready(function() {
        $('#savePdf').click(function() { // pdf저장 button id
            window.print();
            // html2canvas($('#pdfDiv')[0]).then(function(canvas) { //저장 영역 div id
            //
            //     // 캔버스를 이미지로 변환
            //     var imgData = canvas.toDataURL('image/png');
            //     var imgWidth = 195*1.414; // 이미지 가로 길이(mm) A4 기준
            //     var imgHeight = 195;
            //     var margin = 10; // 출력 페이지 여백설정
            //     // var doc = new jsPDF('p', 'mm');
            //     const doc = new jsPDF({
            //         format: "a4",
            //         orientation: "landscape"
            //     });
            //     var position = 0;
            //
            //     // 첫 페이지 출력
            //     doc.addImage(imgData, 'PNG', margin, position, imgWidth, imgHeight);
            //
            //     // 파일 저장
            //     doc.save('file-name.pdf');
            // });
        });
    })
</script>

