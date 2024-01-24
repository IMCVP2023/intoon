<?php
include_once('./include/head.php');
include_once('./include/header.php');

$member_idx = $_SESSION['USER']['idx'];
$registration_idx = $_GET["idx"];
if(!$registration_idx) {
    echo "<script>alert('Undefined registration number!'); window.location.replace('./registration.php');</script>";
    exit;
}

//경로 주의
if($_SERVER["HTTP_HOST"] == "www.icomes.or.kr") {
    echo "<script>location.replace('https://icomes.or.kr/main/registration2_test.php?idx={$registration_idx}')</script>";
}

//결제번호 생성
$rNo = $registration_idx;
$date = date("YmdHis");
$random = mt_rand(1, 1000);
while(strlen("".$rNo) < 10){
    $rNo = "0".$rNo;
}
while(strlen("".$random) < 3){
    $random = "0".$random;
}
$order_code = "PR".$date.$random."N".$rNo;

$select_registration_query =	"
										SELECT
											r.*, n.nation_ko, nation_en, f.original_name as file_name, CONCAT(f.path,'/',f.save_name) AS file_path, 
											iep.off_member_usd, iep.off_guest_usd, iep.on_member_usd, iep.on_guest_usd, 
											iep.off_member_krw, iep.off_guest_krw, iep.on_member_krw, iep.on_guest_krw
										FROM request_registration r
										LEFT JOIN nation n
											ON r.nation_no = n.idx
										LEFT JOIN file f
											ON r.etc3 = f.idx
										LEFT JOIN info_event_price AS iep
											ON iep.type_en = r.member_type
										WHERE r.idx = {$registration_idx}
										AND register = '{$member_idx}'
									";


$registration_data = sql_fetch($select_registration_query);

if(!is_array($registration_data)) {
    echo "<script>alert('Undefined registration number!'); window.location.replace('./registration.php');</script>";
    exit;
}

// 데이터
$member_status = isset($registration_data["member_status"]) ? $registration_data["member_status"] : "-";

$price_col_name = "";
$price_col_name .= ($attendance_type == 0) ? "off_" : "on_";
$price_col_name .= ($registration_data["member_status"] == 0) ? "guest_" : "member_";
$price_col_name .= "usd";

$nation_no			= $registration_data["nation_no"] ?? null;

if ($nation_no == 25) {
    $cur = "KRW";
} else {
    $cur = "USD";
}

$registration_type = isset($registration_data["registration_type"]) ? $registration_data["registration_type"] : "-";
$registration_type	= $registration_type == 0 ? "on-site" : ($registration_type == 1 ? "online(Overseas attendees only)" : "-");

$attendance_type	= isset($registration_data["attendance_type"]) ? $registration_data["attendance_type"] : "-";
$attendance_type_no = $attendance_type;
//$attendance_type = ($attendance_type == 0 ? "General Participants" : ($attendance_type == 1 ? "Invited Speaker" : ($attendance_type == 2 ? "Committee" : ($attendance_type == 3 ? "Sponsors" : "-"))));

$member_status		= $member_status == 1 ? $locale("member") : $locale("non_member");

$applied_review		= isset($registration_data["is_score"]) ? $registration_data["is_score"] : "-";
$is_score			= $applied_review == 0 ? "NO" : ($applied_review == 1 ? "YES" : "-");
$email				= isset($registration_data["email"]) ? $registration_data["email"] : "-";
$nation				= isset($registration_data["nation_en"]) ? $registration_data["nation_en"] : "-";
$first_name			= isset($registration_data["first_name"]) ? $registration_data["first_name"] : "-";
$last_name			= isset($registration_data["last_name"]) ? $registration_data["last_name"] : "-";
$phone				= isset($registration_data["phone"]) ? $registration_data["phone"] : "-";

$affiliation		= isset($registration_data["affiliation"]) ? $registration_data["affiliation"] : "-";
$department			= isset($registration_data["department"]) ? $registration_data["department"] : "-";
$licence_number		= isset($registration_data["licence_number"]) ? $registration_data["licence_number"] : "-";
$academy_number		= isset($registration_data["academy_number"]) ? $registration_data["academy_number"] : "-";
$register_path		= isset($registration_data["register_path"]) ? $registration_data["register_path"] : "-";
$member_type		= isset($registration_data["member_type"]) ? $registration_data["member_type"] : "-";
$etc				= $registration_data["etc1"] ?? "-";
$result_org		= isset($registration_data["etc2"]) ? $registration_data["etc2"] : "";
$result_org = explode(",",$result_org);
foreach($result_org as $key => $value){
    $result_org[$key] = ($value == 1 ? $locale("applied_org1") : ($value == 2 ? $locale("applied_org2") : ($value == 3 ? $locale("applied_org3") : ($value == 4 ? $locale("applied_org4") : '-'))));
}
$identification_file   = isset($registration_data["file_name"]) ? $registration_data["file_name"] : "-";
$identification_file_path = isset($registration_data["file_path"]) ? $registration_data["file_path"] : "";
$price					  = isset($registration_data["price"]) ? $registration_data["price"] : "";
$nation_no	   			  = $registration_data["nation_no"] ?? null;

$name = $last_name." ".$first_name;

// 2023 Registeration 페이지 추가정보
// Type of Participation
$attendance_type = $registration_data["attendance_type"] ?? "-";
switch($attendance_type) {
    case 0:
        $attendance_type = "Committee";
        break;
    case 1:
        $attendance_type = "Invited Speaker";
        break;
    case 2:
        $attendance_type = "Chairperson";
        break;
    case 3:
        $attendance_type = "Panel";
        break;
    case 4:
        $attendance_type = "General Participants";
        break;
    case 5:
        $attendance_type = "Sponsor";
        break;
}

//금액 변환
$us_price = "1";
$ko_price = "1000";
$us_price = $registration_data[$price_col_name];

//echo $us_price;
//exit;

$timenow = date("Y-m-d H:i:s");
//조기 등록 끝
//$timetarget = "2022-05-20 00:00:00";
// 사전 등록 끝
$timetarget = "2022-08-11 00:00:00";

$str_now = strtotime($timenow);
$str_target = strtotime($timetarget);

if($str_now < $str_target || $str_now == $str_target) {

    //if($us_price == 100) {
    //	$us_price = 70;
    //}
    //else if($us_price == 150) {
    //	$us_price = 105;
    //}
    //else if($us_price == 70) {
    //	$us_price = 49;
    //}
    //if($nation_no == 25) {
    //	if($member_status == "NON-MEMBER") {
    //		if($us_price == 70) {
    //			$us_price = 70000;
    //		}
    //	} else {
    //		if($us_price == 70) {
    //			$us_price = 84000;
    //		}
    //	}
    //	if($us_price == 105) {
    //		$us_price = 105000;
    //	}
    //	else if($us_price == 49) {
    //		$us_price = 49000;
    //	}
    //}
    //할인 기간 끝
    if($us_price == 100) {
        $us_price = 90;
    }
    else if($us_price == 150) {
        $us_price = 135;
    }
    else if($us_price == 70) {
        $us_price = 63;
    }
    if($nation_no == 25) {
        //비회원
        if($member_status == "NON-MEMBER") {
            if($us_price == 90) {
                $us_price = 90000;
            }
        } else {
            if($us_price == 90) {
                $us_price = 108000;
            }
        }
        if($us_price == 135) {
            $us_price = 135000;
        }
        else if($us_price == 63) {
            $us_price = 63000;
        }
    }
} else {
    //현장 등록
    if($nation_no == 25) {
        //비회원
        if($member_status == "NON-MEMBER") {
            if($us_price == 100) {
                $us_price = 100000;
            }
        } else {
            if($us_price == 100) {
                $us_price = 120000;
            }
        }
        if($us_price == 150) {
            $us_price = 150000;
        }
        else if($us_price == 70) {
            $us_price = 70000;
        }
    }
}

if($attendance_type_no == 0) {
    $ko_price = $us_price;
    $price = $us_price;
} else {
    $price = 0;
    $ko_price = "0";
}

//$ko_price = "100";

// 가격이 무료인 경우 결제 완료상태로 바로 변경함
/*if ($price == 0 && $registration_data['status'] == 1) {
    $unit_col = ($language == "en") ? "us" : "kr";

    $insert_payment_query = "INSERT INTO
                                    payment
                                    (
                                        `type`, payment_type, payment_type_name, payment_status,
                                        payment_price_{$unit_col}, tax_{$unit_col}, total_price_{$unit_col},
                                        payment_date, register_date, register
                                    )
                                VALUES
                                    (
                                        3, 2, '무료 신청', 2, 0, 0, 0, NOW(), NOW(), '{$member_idx}'
                                    )";
    sql_query($insert_payment_query);
    $payment_new_no = sql_insert_id();

    sql_query("UPDATE request_registration SET `status` = 2, payment_no = '{$payment_new_no}' WHERE idx = '{$registration_idx}'");
}*/

if ($attendance_type_no != 0) {
    $unit_col = ($nation_no != 25) ? "us" : "kr";

    $insert_payment_query = "INSERT INTO 
										payment 
										(
											`type`, payment_type, payment_type_name, payment_status, 
											payment_price_{$unit_col}, tax_{$unit_col}, total_price_{$unit_col}, 
											payment_date, register_date, register
										)
									VALUES
										(
											3, 2, '무료 신청', 2, 0, 0, 0, NOW(), NOW(), '{$member_idx}'
										)";
    sql_query($insert_payment_query);
    $payment_new_no = sql_insert_id();

    sql_query("UPDATE request_registration SET `status` = 2, payment_no = '{$payment_new_no}' WHERE idx = '{$registration_idx}'");
}


// KG INICIS 결제모듈 정보로드
include_once(D9_PATH."/plugin/KG_INICIS/inicis_loader.php");
?>

    <!-- 이니시스 표준결제 js -->
    <!-- 테스트용
    <script language="javascript" type="text/javascript" src="https://stgstdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>
    -->
    <script language="javascript" type="text/javascript" src="https://stdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>

    <script type="text/javascript">
        function kgpay() {
            var price = $("input[name=price]").val();

            if(price == "0"){
                window.location.replace("./registration3.php");
            }else{
                if(isMobile()){
                    var kginicis = $("#SendPayForm_id")[0];
                    kginicis.action = "https://mobile.inicis.com/smart/payment/";
                    kginicis.submit();

                }else{
                    INIStdPay.pay('SendPayForm_id');
                }
            }
        }

        function isMobile(){
            var UserAgent = navigator.userAgent;
            if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null){
                return true;
            }else{
                return false;
            }
        }

    </script>


    <section class="submit_application payment container registration2">
        <div class="inner">
            <div class="sub_banner">
                <h1>Online Registration</h1>
            </div>
            <div class="section section1 input_area">
                <!--1-->
                <div class="section_title_wrap2">
                    <h3 class="title"><?=$locale("registration_info_tit")?></h3>
                </div>
                <div class="details">
                    <p><?=$locale("registration_info_txt")?></p>
                    <br>
                    <div class="table_wrap detail_table_common">
                        <table class="c_table detail_table">
                            <colgroup>
                                <col class="col_th">
                                <col width="*">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th><?=$locale("id")?></th>
                                <td><?=$email?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?=$name?></td>
                            </tr>
                            <!--
                            <tr>
                                <th>Name(Kor)</th>
                                <td>최원석</td>
                            </tr>
                            -->
                            <tr>
                                <th><?=$locale("country")?></th>
                                <td><?=$nation?></td>
                            </tr>
                            <tr>
                                <th>Member Type</th>
                                <td><?= $member_type; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="table_wrap detail_table_common">
                        <table class="c_table detail_table">
                            <colgroup>
                                <col class="col_th">
                                <col width="*">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th><!--<?=$locale("online_offline")?>-->Attendance Type</th>
                                <td><?=$attendance_type?></td>
                            </tr>
                            <tr>
                                <th><?=$locale("registration_type")?></th>
                                <td><?=$registration_type?></td>
                            </tr>
                            <tr>
                                <th><!--<?=$locale("price")?>-->Registration Fee</th>
                                <td><?=(($nation_no == 25) ? number_format($ko_price) : number_format($price))." ".$cur?></td>
                            </tr>
                            <!--
                            <tr>
                                <th>Promotion Code</th>
                                <td>-</td>
                            </tr>
                            -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--2-->
                <div class="section_title_wrap2">
                    <h3 class="title"><?=$locale("payment_info_tit")?></h3>
                </div>
                <div class="details">
                    <ul>
                        <li><?=$locale("total_price")?> <span class="point_txt s_bold"><?=(($nation_no == 25) ? number_format($ko_price) : number_format($price))." ".$cur?></span></li>
                        <li>Cancellation Policy <span class="red_txt cancel_btn pointer">Details ></li>
                    </ul>
                </div>

                <!--3-->
                <div class="btn_wrap text_center">
                    <?php
                    if($nation_no == 25) {
                        ?>
                        <button type="button" class="btn long_btn submit" onclick="kgpay();"><!--<?=$locale("d_payment_btn")?>--> payment ></button>
                        <?php
                    } else {
                        ?>
                        <button type="button" class="btn long_btn submit" onclick="payment();"><!--<?=$locale("payment_btn")?>--> payment ></button>
                        <?php
                    }
                    ?>
                    <!-- <button type="button" class="btn submit" onclick="kgpay();"><?=$locale("d_payment_btn")?></button> -->
                    <!-- <button type="button" class="btn submit" onclick="payment();"><?=$locale("payment_btn")?></button> -->
                    <?php if($_SESSION["language"] != "ko"){?>

                    <?php }?>
                </div>

            </div>
            <!--// contents end -->
        </div>

        <!-- 엑심베이 결제 -->
        <form class="form-horizontal" name="regForm" method="post" action="https://icomes.or.kr/main/plugin/eximbay/request.php">
            <!-- 결제에 필요 한 필수 파라미터 -->
            <input type="hidden" name="ver" value="230" /><!-- 연동 버전 -->
            <input type="hidden" name="txntype" value="PAYMENT" /><!-- 거래 타입 -->
            <input type="hidden" name="charset" value="UTF-8" /><!-- 고정 : UTF-8 -->

            <!-- statusurl(필수 값) : 결제 완료 시 Back-end 방식으로 Eximbay 서버에서 statusurl에 지정된 가맹점 페이지를 Back-end로 호출하여 파라미터를 전송 -->
            <!-- 스크립트, 쿠키, 세션 사용 불가 -->
            <input type="hidden" name="statusurl" value="https://icomes.or.kr/main/plugin/eximbay/status.php" />
            <input type="hidden" name="returnurl" value="https://icomes.or.kr/main/plugin/eximbay/return.php" />

            <!--결제 완료 시 Front-end 방식으로 사용자 브라우저 상에 호출되어 보여질 가맹점 페이지 -->

            <!-- 결제 응답 값 처리 파라미터 -->
            <input type="hidden" name="rescode" />
            <input type="hidden" name="resmsg" />

            <!-- 테스트용
            <input type="hidden" name="mid" value="1849705C64">
            -->
            <input type="hidden" name="mid" value="1F17E83190">
            <input type="hidden" name="ref" value="<?=$order_code?>">
            <input type="hidden" name="ostype" value="P">
            <input type="hidden" name="displaytype" value="P">
            <input type="hidden" name="email" value="<?=$email?>">
            <input type="hidden" name="buyer" value="<?=$name; ?>">
            <input type="hidden" name="tel" value="<?=$phone?>">
            <input type="hidden" name="item_0_product" value="<?=$language == "ko" ? "대한비만학회 등록비" : "ICOMES 2022" ?>">
            <input type="hidden" name="item_0_quantity" value="1">
            <input type="hidden" name="item_0_unitPrice" value="<?=$us_price?>">


            <input type="hidden" name="lang" value="<?=$language == "ko" ? "KR" : "EN"?>">
            <input type="hidden" name="cur" value="USD">
            <input type="hidden" name="amt" value="<?=$us_price?>">

        </form>

        <!-- KG INICIS -->
        <form id="SendPayForm_id" name="" method="POST" accept-charset="EUC-KR">
            <!-- 필수 -->
            <input type="hidden" name="version"			value="1.0"/>
            <input type="hidden" name="mid"				value="<?=$mid?>"/>
            <input type="hidden" name="goodname"		value="<?=$language == "ko" ? "대한비만학회 등록비" : "ICOMES 2022"?>"/>
            <input type="hidden" name="oid"				value="<?=$orderNumber?>"/>
            <input type="hidden" name="price"			value="<?=$kg_price?>"/>
            <input type="hidden" name="currency"		value="WON"/>
            <input type="hidden" name="buyername"		value="<?=$name?>"/>
            <input type="hidden" name="buyertel"		value="<?=$phone?>"/>
            <input type="hidden" name="buyeremail"		value="<?=$email?>"/>
            <input type="hidden" name="timestamp"		value="<?=$timestamp?>"/>
            <input type="hidden" name="signature"		value="<?=$sign?>"/>
            <input type="hidden" name="returnUrl"		value="<?=$siteDomain?>/plugin/KG_INICIS/result.php"/>
            <input type="hidden" name="mKey"			value="<?=$mKey?>"/>

            <!-- 기본옵션 -->
            <input type="hidden" name="gopaymethod"		value="Card" >									<!--결제수단-->
            <input type="hidden" name="offerPeriod"		value="" >										<!--제공기간-->
            <input type="hidden" name="acceptmethod"	value="HPP(1):no_receipt:va_receipt:below1000" >

            <input type="hidden" name="languageView"	value="ko" >									<!--초기 표시 언어-->
            <input type="hidden" name="charset"			value="UTF-8" >
            <input type="hidden" name="payViewType"		value="overlay" >
            <input type="hidden" name="closeUrl"		value="<?=$siteDomain?>/plugin/KG_INICIS/close.php" >
            <input type="hidden" name="popupUrl"		value="<?=$siteDomain?>/plugin/KG_INICIS/popup.php" >

            <!-- 결제 수단별 옵션[카드] -->
            <input type="hidden" name="nointerest"		value="<?=$cardNoInterestQuota?>" >				<!--무이자 할부 개월-->
            <input type="hidden" name="quotabase"		value="<?=$cardQuotaBase?>" >					<!--할부 개월-->

            <!-- 결제 수단별 옵션[가상계좌] -->
            <input type="hidden" name="INIregno"		value="" >

            <input type="hidden" name="merchantData"	value="<?=$registration_idx?>" >

            <!-- 모바일 -->
            <input type="hidden" name="P_AMT"			value="<?=$kg_price?>" />
            <input type="hidden" name="P_INI_PAYMENT"	value="CARD">
            <input type="hidden" name="P_NOTI"			value="">
            <input type="hidden" name="P_NOTI_URL"		value="<?=$siteDomain?>/payment_vacct_result_m.do">
            <input type="hidden" name="P_HPP_METHOD"	value="1">
            <input type="hidden" name="P_GOODS"			value="<?=$language == "ko" ? "대한비만학회 등록비" : "ICOMES 2022"?>" />
            <input type="hidden" name="P_MID"			value="<?=$mid?>" />
            <input type="hidden" name="P_CHARSET"		value="utf8">
            <input type="hidden" name="P_OID"			value="<?=$orderNumber?>" />
            <input type="hidden" name="P_EMAIL"			value="<?=$email?>" />
            <input type="hidden" name="P_UNAME"			value="<?=$name; ?>" />
            <input type="hidden" name="P_NEXT_URL"		value="<?=$siteDomain?>/plugin/KG_INICIS/result.php" />
        </form>

        <div class="popup cancel_pop">
            <div class="pop_bg"></div>
            <div class="pop_contents cancel_details">
                <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
                <h3 class="pop_title"><?=$locale("cancellation_tit")?></h3>
                <p class="pre"><!--<?=$locale("cancellation_txt")?>-->* For administrative reasons, please note that refunds will be issued after the end of the event.
                    - If you are registered but are not able to attend or need to cancel your registration, you can cancel your registration in "My page" before the end of the pre-registration period.
                    - Refunds will be made immediately upon receipt of the written notice after the end of the society meeting.
                    - All bank fees must be paid by the register.
                    - If pre-registration fee was paid by credit card, refunds will be made after deducting the card fee.</p>
                <div class="table_wrap c_table_wrap2" >
                    <table class="c_table2">
                        <thead>
                        <tr>
                            <th><?=$locale("date")?></th>
                            <th><?=$locale("cancellation_table_category2")?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <!--<?=$locale("cancellation_table_data1")?>-->
                                Received before JUL 28(Thu), 2022(24:00 KST)
                            </td>
                            <td>
                                <!--<?=$locale("cancellation_table_data1_1")?>-->
                                100% Refund
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!--<?=$locale("cancellation_table_data2")?>-->
                                Received after Jul 28(Thu) 2022(24:00 KST)
                            </td>
                            <td>
                                <!--<?=$locale("cancellation_table_data2_1")?>-->
                                Non-Refund
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <script src="./js/script/client/registration.js"></script>
    <script>

        $('.cancel_btn').on('click',function(){
            $('.cancel_pop').show();
        });

        function move() {
            location.replace('/main/registration3.php')
        }

        function error() {
            setTimeout(function() {
                var error_msg = $("input[name=resmsg]").val();
                alert(locale(language.value)("payment_fail_msg")+" "+locale(language.value)("retry_msg")+"\n"+error_msg);
            },50)
        }
    </script>

<?php include_once('./include/footer.php');?>