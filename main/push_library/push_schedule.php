<?php
	include_once('/var/www/icomes.or.kr/main/common/common.php');
	include_once('/var/www/icomes.or.kr/main/push_library/push.php');

	$select_query = "SELECT 
						ps.idx, ps.member_idx, ps.type, ps.token, ps.program_idx, 
						p.program_name, ps.push_time, m.is_alarm 
					FROM push_schedule AS ps
					LEFT JOIN (
						SELECT 
							idx, program_name
						FROM program
						WHERE is_deleted = 'N'
					) AS p 
					ON p.idx = ps.program_idx
					INNER JOIN (
						SELECT 
							idx, is_alarm
						FROM member
						WHERE is_deleted='N'
						AND is_alarm='Y'
					) AS m 
					ON m.idx = ps.member_idx
					WHERE push_time >= DATE_ADD(NOW(), INTERVAL -1 MINUTE)
                    AND push_time <= DATE_ADD(NOW(), INTERVAL +1 MINUTE)
                    AND ps.type IS NOT NULL
                    AND ps.token IS NOT NULL
					";

	$push_list = get_data($select_query);

	if (empty($push_list)) {
		exit;
	}

	$title   = "ICOMES2023";
	$url     = '/main/app_schedule.php';
	$message = '';

	//$data = [
	//    "title"    => $title,
	//    "msg"      => $message,
	//    "link_url" => $url,
	//];

	$ios_token_list[] = [];
	$ios_token_list_history[] = [];
	$android_token_list[] = [];
	$android_token_list_history = [];

	foreach ($push_list AS $pl) {
		if ($pl['token'] !== '' && $pl['type'] !== '') {

			$message = $pl['program_name'] . ' will start in 10minute';

			$data = [
				"title" => $title,
				"msg" => $message,
				"link_url" => $url,
			];

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
    // 안드로이드 그룹발송은 1번당 최대 1000명
//    if(count($android_token_list) > 999) {
//        $android_token_list = array_values(array_filter($android_token_list));
//        Push::fcmMultiPushV2($title, $message, "android", $android_token_list, $data);
//        $android_token_list = [];
//    }
//
//    // IOS 그룹발송은 1번당 최대 20명
//    if(count($ios_token_list) > 19) {
//        $ios_token_list = array_values(array_filter($ios_token_list));
//        Push::fcmMultiPushV2($title, $message, "ios", $ios_token_list, $data);
//        $ios_token_list = [];
//    }

//    // 안드로이드 유저 단체발송
//    if(count($android_token_list) <=19) {
//        $android_token_list = array_values(array_filter($android_token_list));
//        Push::fcmMultiPushV2($title, $message, "android", $android_token_list, $data);
//    }
//
//    // IOS 유저 단체발송
//    if(count($ios_token_list) <=999) {
//        $ios_token_list = array_values(array_filter($ios_token_list));
//        Push::fcmMultiPushV2($title, $message, "ios", $ios_token_list, $data);
//    }

?>