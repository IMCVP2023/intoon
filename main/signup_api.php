<?php include_once("./common/common.php");?>
<?php include_once("./common/locale.php");?>
<?php
	try {		
		$data = array(
			'id' => $_POST['id'],
			'pwd' => urlencode($_POST['password'])
		);

		$select_sql = "SELECT
							ksola_member_check
						FROM member
						WHERE ksola_member_check = '".$data['id']."'
						AND is_deleted = 'N'";

		$check_id = sql_fetch($select_sql)['ksola_member_check'];

		if(!empty($check_id)) {
			return_value(200, "ok", ["value" => '{"code":"N7"}']);
		}
		/* 23.05.26 HUBDNC 패스워드decode로 다시 치환 */
		$result_data = array(
			'id' => $data['id'],
			'pwd' => urldecode($data['pwd'])
		);

		$request_data = array(
			'command'=>'get_member_info',
			'body' => $result_data
		);
		$json = json_encode($request_data);
		 
		/*
		  curl = 원하는 url에 값을 넣고 리턴되는 값을 받아오는 함수
		*/
		$ch = curl_init(); //세션 초기화
		/*curl_setopt : curl옵션 세팅
			CURLOPT_URL : 접속할 url
			CURLOPT_POST : 전송 메소드 Post
			CURLOPT_RETURNTRANSFER : 리턴 값을 받음
		*/

		curl_setopt($ch, CURLOPT_URL, "https://www.kosso.or.kr/api-server.php"); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		/*
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		*/
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		//curl_setopt($ch, CURLOPT_POST, true);
		 
		/*
		  curl_exec : 실행
		  curl_getinfo : 전송에 대한 정보
		  CURLINFO_HTTP_CODE : 마지막 HTTP 코드 수신
		*/

		$response = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($status_code == 200) { //정상
			return_value(200, "ok", ["value" => $response, "ksola_member_check" => $data['id']]);
		}
		else {
			echo "Error 내용: ".$response;
		}

	} catch(\Throwable $tw) {
		return_value("저장하는 중 오류가 발생했습니다.", ['error' => $tw->getMessage()]);
	}
	return_value(200, 'ok');

	 // 23.05.10 HUBDNC 결과값 반환 공통화
	function return_value($code, $msg, $arr=array()){
		//var_dump($arr); exit;
		$arr["code"] = $code;
		$arr["msg"] = $msg;
		echo json_encode($arr);
		exit;
	}
 
?>

