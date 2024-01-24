<?php include_once("../../common/common.php");?>
<?php include_once('../../push_library/push.php'); ?>
<?php
if($_POST["flag"]==="pin"){

    $board_idx = $_POST['board_idx'];
    $check_pin = $_POST['check_pin'];
    $pin = "";

    if($check_pin==1){
        $pin = "Y";
    } else if($check_pin==0){
        $pin = "N";
    }

    $update_pin_query = "
                            UPDATE board
                            SET
                                pin = '{$pin}'
                            WHERE type = 3
                            AND idx = '{$board_idx}'
                        ";

    $update_pin = sql_query($update_pin_query);

    if($update_pin){
        $res = [
            'code' => 200,
            'msg' => "success"
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            'code' => 400,
            'msg' => "update pin error"
        ];
        echo json_encode($res);
        exit;
    }

} else if($_POST["flag"] === "push"){
    $push_message = $_POST["message"];
    $notice_idx = $_POST["notice_idx"];

    $select_query = "
                    SELECT DISTINCT token, type, m.idx, is_alarm
                    FROM member m
                    LEFT JOIN (
                        SELECT r.idx, status, register
                        FROM request_registration r
                        WHERE is_deleted='N'
                        AND status IN (2,5)
                    )r ON r.register = m.idx
                    INNER JOIN (
                        SELECT DISTINCT token, member_idx, type
                        FROM device_token
                    )d ON d.member_idx = m.idx
                    WHERE is_alarm='Y'
                ";

    $push_list = get_data($select_query);
    if (empty($push_list)) {
        exit;
    }

    $title = "ICOMES2023";
    $url = '/main/app_notice_detail.php?idx='.$notice_idx;
    $message = $push_message;

    $data = [
        "title"    => $title,
        "msg"      => $message,
        "link_url" => $url,
    ];

    $ios_token_list[] = [];
    $ios_token_list_history[] = [];
    $android_token_list[] = [];
    $android_token_list_history = [];

    foreach ($push_list as $pl) {
        if ($pl['token'] !== '' && $pl['type'] !== '') {

            if ($pl["type"] === 'I' && $pl['is_alarm'] === 'Y') {
                $ios_token_list[] = $pl["token"];
                $ios_token_list_history[] = $pl["token"];

                $ios_token_list = array_values(array_filter($ios_token_list));
                Push::fcmMultiPushV2($title, $message, "ios", $ios_token_list, $data);
                $ios_token_list = [];
            } else if (!in_array($pl["token"], $android_token_list_history) && $pl['is_alarm'] == 'Y') {
                $android_token_list[] = $pl["token"];
                $android_token_list_history[] = $pl["token"];

                $android_token_list = array_values(array_filter($android_token_list));
                Push::fcmMultiPushV2($title, $message, "android", $android_token_list, $data);
                $android_token_list = [];
            }
        }
    }

} else if($_POST["flag"]==="select"){
    $board_idx = $_POST["board_idx"];

    $select_query = "
                        SELECT idx, type, title_en, pin
                        FROM board
                        WHERE type = 3
                        AND is_deleted = 'N'
                        AND idx = '{$board_idx}'
                    ";
    $board = sql_fetch($select_query);

    if(isset($board)){
        $res = [
            'code' => 200,
            'msg' => "success",
            'result' => $board
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            'code' => 400,
            'msg' => "select board error"
        ];
        echo json_encode($res);
        exit;
    }
} else if($_POST["flag"]==="delete"){
    $board_idx = $_POST["board_idx"];

    $delete_notice_query = "
                            UPDATE board
                            SET
                                is_deleted = 'Y'
                            WHERE type = 3
                            AND idx = '{$board_idx}'
                        ";

    $delete_notice = sql_query($delete_notice_query);

    if($delete_notice){
        $res = [
            'code' => 200,
            'msg' => "success"
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            'code' => 400,
            'msg' => "delete notice error"
        ];
        echo json_encode($res);
        exit;
    }
} else if($_POST["flag"] === 'insert'){
    $title_en = $_POST['data']['title_en'];
    $content_en = $_POST['data']['content_en'];
	$idx = $_POST['data']['idx'] ?? NULL;

    $register = $_SESSION["ADMIN"]["idx"];

//    print_r($title_en);
//    print_r($content_en);

	if (!empty($idx)) {

		$insert_query = "
							UPDATE board
							SET 
								title_en = '{$title_en}',
								title_ko = NULL,
								content_en = '{$content_en}',
								content_ko = NULL,
								modifier = '{$register}',
								modify_date = NOW()
							WHERE idx = {$idx}
					";
	} else {
		$insert_query = "
							INSERT board
							SET 
								type = 3,
								title_en = '{$title_en}',
								title_ko = NULL,
								content_en = '{$content_en}',
								content_ko = NULL,
								register = '{$register}'          
					";
	}

    $insert_notice = sql_query($insert_query);

    if($insert_notice){
        $res = [
            'code' => 200,
            'msg' => "success"
        ];

        echo json_encode($res);
        exit;
    } else {
        $res = [
            'code' => 400,
            'msg' => "insert notice error"
        ];
        echo json_encode($res);
        exit;
    }
}

?>

