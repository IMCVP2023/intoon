<?php include_once("../../common/common.php");?>
<?php include_once('../../push_library/push.php'); ?>
<?php
if($_POST["flag"] == "select") {
    $member_idx = $_SESSION["USER"]["idx"];
    $date = $_POST["data"]["date"] ?? "";
    $option_room = $_POST["data"]["option_room"] ?? "";
    $option_category = $_POST["data"]["option_category"] ?? "";

    $row_sql="";
    $row_sql2="";

    switch ($date){
        case "1" : $program_date = "2023-09-07";
            break;
        case "2" : $program_date = "2023-09-08";
            break;
        case "3" : $program_date = "2023-09-09";
            break;
    }

    if($date !== ""){
        $row_sql .= " AND program_date = '{$program_date}' ";
        $row_sql2 = " AND start_time >= '{$program_date}' ";
    }

    if($option_room !== ""){
        if($option_room == 1 || $option_room ==2 || $option_room==3){
            $row_sql .= " AND program_place_idx IN ($option_room, 8) ";
        } else{
            $row_sql .= " AND program_place_idx = $option_room ";
        }
    }

    if($option_category !== ""){
        $row_sql .= " AND program_category_idx = $option_category ";
    }

    $select_program_query = "
                            SELECT @rownum := @rownum+1 AS rownum, P.*
                            FROM (
                                     SELECT p.idx, program_name, program_tag_name, chairpersons, preview, program_place_idx, pp.program_place_name ,program_category_idx, program_date,
                                            date_format(start_time, '%H:%i') as start_time, date_format(end_time, '%H:%i') as end_time, start_time as _start_time,
                                            (CASE
                                                 WHEN s.idx IS NULL THEN 'N'
                                                 ELSE 'Y'
                                                END
                                                ) as schedule_check, path
                                     FROM program p
                                     LEFT JOIN (SELECT va.program_idx, path FROM viewer_abstract va) va ON va.program_idx=p.idx
                                     LEFT JOIN program_place pp on p.program_place_idx = pp.idx
                                     LEFT JOIN(
                                         SELECT s.idx, member_idx, s.program_idx, s.register_date, s.is_deleted
                                         FROM schedule s
                                         WHERE member_idx={$member_idx}
                                           AND is_deleted='N'
                                     )s on s.program_idx=p.idx
                                     JOIN (SELECT @rownum := 0) AS R
                                     WHERE p.is_deleted = 'N'
                                     {$row_sql}
                                     ORDER BY _start_time ASC, program_place_idx ASC, CAST(SUBSTRING_INDEX(program_tag_name, '_', -1) AS SIGNED), program_tag_name
                                 ) P
                            ";
    $program_list = get_data($select_program_query);

    $select_contents_query = "
                             SELECT pc.idx, program_idx, contents_title, isp.idx AS speaker_idx, first_name, last_name, affiliation, nation, pc.speaker,
                                    date_format(start_time, '%H:%i') as start_time, date_format(end_time, '%H:%i') as end_time
                             FROM program_contents pc
                             LEFT JOIN (
                                SELECT isp.idx, program_contents_idx, first_name, last_name, nation, affiliation
                                FROM invited_speaker isp
                                WHERE isp.is_deleted='N'
                             ) isp ON isp.idx = pc.speaker_idx
                             WHERE is_deleted = 'N'
                             {$row_sql2}
                             ORDER BY start_time
                            ";
    $contents_list = get_data($select_contents_query);

    $resultObj = [];
	$room_list = [];
    foreach($program_list as $pl){
        $pl_idx = $pl['idx'];

        $resultObj[$pl['rownum']] = [
            'idx' => $pl_idx,
            'program_name' => $pl['program_name'],
            'program_tag_name' => $pl['program_tag_name'],
            'chairpersons' => $pl['chairpersons'],
            'preview' => $pl['preview'],
            'program_place_name' => $pl['program_place_name'],
            'program_category_idx' => $pl['program_category_idx'],
            'program_date' => $pl['program_date'],
            'start_time' => $pl['start_time'],
            'end_time' => $pl['end_time'],
            'contents' => [],
            'schedule_check' => $pl['schedule_check'],
            'path' => $pl['path']
        ];

        foreach ($contents_list as $cl){
            $program_idx = $cl['program_idx'];
            $cl_info = [
                'cl_idx' => $cl['idx'],
                'program_idx' => $program_idx,
                'contents_title' => $cl['contents_title'],
                'speaker_idx' => $cl['speaker_idx'],
                'first_name' => $cl['first_name'],
                'last_name' => $cl['last_name'],
                'affiliation' => $cl['affiliation'],
                'nation' => $cl['nation'],
                'speaker' => $cl['speaker'],
                'start_time' => $cl['start_time'],
                'end_time' => $cl['end_time']
            ];

            if($pl_idx === $program_idx){
                $resultObj[$pl['rownum']]['contents'][]=$cl_info;
            }
        }

		if (!in_array($pl['program_place_name'], $room_list)) {
			$room_list[] = $pl['program_place_name'];
		}
    }

    if (isset($resultObj)) {
        $res = [
            'code' => 200,
            'msg' => "success",
            'result' => $resultObj,
			'room_result' => $room_list
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            'code' => 400,
            'msg' => "select program error"
        ];
        echo json_encode($res);
        exit;
    }

} else if($_POST["flag"] === "schedule"){
    $member_idx = $_SESSION["USER"]["idx"];
    $program_idx = $_POST['program_idx'] ?? "";
    $check_schedule = $_POST['check_schedule'];

    if($check_schedule==0){
        $is_deleted = 'Y';
    } else if($check_schedule==1){
        $is_deleted = 'N';
    }

    $select_schedule_query = " 
                                SELECT idx, member_idx, program_idx, register_date, is_deleted
                                FROM schedule
                                WHERE member_idx = '{$member_idx}'
                                AND program_idx = '{$program_idx}'
                            ";
    $select_schedule = sql_fetch($select_schedule_query);

    if(isset($select_schedule)){
        $update_schedule_query = "
                            UPDATE schedule
                            SET
                                is_deleted = '{$is_deleted}'
                            WHERE member_idx = '{$member_idx}'
                            AND program_idx = '{$program_idx}'
                        ";
        $update_schedule = sql_query($update_schedule_query);

        if($update_schedule){
            $res = [
                'code' => 200,
                'msg' => "success"
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                'code' => 400,
                'msg' => "update schedule error"
            ];
            echo json_encode($res);
            exit;
        }
    } else {
        $insert_schedule_query = "
                                        INSERT schedule
                                        SET
                                            member_idx = '{$member_idx}',
                                            program_idx = '{$program_idx}'         
                                    ";
        $insert_schedule = sql_query($insert_schedule_query);

        if($insert_schedule){
            $res = [
                'code' => 200,
                'msg' => "success",
                'program_idx' => $program_idx
            ];
            echo json_encode($res);
            exit;
        }else {
            $res = [
                'code' => 400,
                'msg' => "insert schedule error"
            ];
            echo json_encode($res);
            exit;
        }
    }
} else if($_POST["flag"]==="alarm"){
    $member_idx = $_SESSION["USER"]["idx"];
    $program_idx = $_POST["program_idx"];
    $is_push = $_POST["is_push"];

    $select_push_schedule_query="
                                    SELECT member_idx, type, token, program_idx
                                    FROM push_schedule
                                    WHERE member_idx = '{$member_idx}'
                                    AND program_idx = '{$program_idx}'
                                ";

    $result = sql_fetch($select_push_schedule_query);

    if(!empty($result) && $is_push==="delete"){

        $delete_push_schedule="
                                DELETE FROM push_schedule
                                WHERE member_idx = '{$member_idx}'
                                AND program_idx = '{$program_idx}'
                            ";
        $delete_result = sql_query($delete_push_schedule);

    } else if(empty($result) && $is_push==="insert"){
        $select_device_query = "
                                    SELECT distinct token, member_idx, type, is_alarm
                                    FROM device_token dt
                                    LEFT JOIN (
                                        SELECT m.idx, is_alarm
                                        FROM member m
                                        WHERE idx={$member_idx}
                                    ) m on m.idx=dt.member_idx
                                    WHERE member_idx={$member_idx}
                                    ";
        $device_info = sql_fetch($select_device_query);
        
        $select_push_time_query = "
                                        SELECT start_time
                                        FROM program
                                        WHERE idx = {$program_idx}
                                        AND is_deleted='N'
                                        ";
        $start_time = sql_fetch($select_push_time_query)['start_time'];
        $push_time = date("Y-m-d H:i:s", strtotime("-10 minutes", strtotime($start_time)));

        $token = $device_info['token'];
        $type = $device_info['type'];

        $insert_push_schedule_query = "
                                            INSERT push_schedule
                                            SET
                                                type = '{$type}',
                                                token = '{$token}',
                                                member_idx = '{$member_idx}',
                                                program_idx = '{$program_idx}',
                                                push_time = '{$push_time}'      
                                        ";
        $insert_push_schedule = sql_query($insert_push_schedule_query);
    }

    if(!empty($member_idx)){
        $res = [
            'code' => 200,
            'msg' => "success"
        ];
        echo json_encode($res);
        exit;
    }else {
        $res = [
            'code' => 400,
            'msg' => "push_schedule error"
        ];
        echo json_encode($res);
        exit;
    }
} else if($_POST["flag"]==="test") {
    $select_query = "SELECT ps.idx, member_idx, type, token, program_idx, program_name, push_time, is_alarm 
                FROM push_schedule ps
                LEFT JOIN (
                    SELECT p.idx, program_name
                    FROM program p
                    WHERE is_deleted = 'N'
                )p ON p.idx = ps.program_idx
                LEFT JOIN (
                    SELECT m.idx, is_alarm
                    FROM member m
                    WHERE is_deleted='N'
                )m ON m.idx = ps.member_idx
                ##WHERE push_time <=NOW()
                ";

    $push_list = get_data($select_query);
    if (empty($push_list)) {
        exit;
    }

    $title = "ICOMES2023";
    $url = 'url';
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

    foreach ($push_list as $pl) {
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
}



