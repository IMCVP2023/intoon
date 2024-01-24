<head>
  <meta name="robots" content="noindex">
  <meta http-equiv="refresh" content="0;URL='https://icomes.or.kr/main'" />
</head>
<?php
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-store");
    header("Pragma: no-cache");

    require "KCPComLibrary.php";              // library [수정불가]
?>
<?php

	echo "aaaaaaaaaaa";
    // 쇼핑몰 페이지에 맞는 문자셋을 지정해 주세요.
    $charSetType      = "utf-8";             // UTF-8인 경우 "utf-8"로 설정//euc-kr
    
    $siteCode         = $_POST[ "site_cd"     ];
    $orderID          = $_POST[ "ordr_idxx"   ];
    $paymentMethod    = $_POST[ "pay_method"  ];
    $escrow           = ( $_POST[ "escw_used"   ] == "Y" ) ? true : false;
    $productName      = $_POST[ "good_name"   ];

    // 아래 두값은 POST된 값을 사용하지 않고 서버에 SESSION에 저장된 값을 사용하여야 함.
    $paymentAmount    = $_SESSION[ "good_mny"    ]; // 결제 금액
    $returnUrl        = $_SESSION[ "Ret_URL"     ];

    // Access Credential 설정
    $accessLicense    = "";
    $signature        = "";
    $timestamp        = "";

    // Base Request Type 설정
    $detailLevel      = "0";
    $requestApp       = "WEB";
    $requestID        = $orderID;
    $userAgent        = $_SERVER['HTTP_USER_AGENT'];
    $version          = "0.1";

	

    try
    {

        $g_wsdl = "KCPPaymentService.wsdl";      // 개발서버 
        //$g_wsdl = "real_KCPPaymentService.wsdl"; // 운영서버
        $payService = new PayService( $g_wsdl );

        $payService->setCharSet( $charSetType );
        
        $payService->setAccessCredentialType( $accessLicense, $signature, $timestamp );
        $payService->setBaseRequestType( $detailLevel, $requestApp, $requestID, $userAgent, $version );
        $payService->setApproveReq( $escrow, $orderID, $paymentAmount, $paymentMethod, $productName, $returnUrl, $siteCode );

        $approveRes = $payService->approve();
                
		
        printf( "%s,%s,%s,%s", $payService->resCD,  $approveRes->approvalKey,
                               $approveRes->payUrl, $payService->resMsg );


    }
    catch (SoapFault $ex )
    {
        printf( "%s,%s,%s,%s", "95XX", "", "", iconv("EUC-KR","UTF-8//IGNORE","연동 오류 (PHP SOAP 모듈 설치 필요)" ) );
    }
?>