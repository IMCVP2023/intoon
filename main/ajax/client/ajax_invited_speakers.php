<?php 
    include_once("../../common/common.php");
	include_once('../../include/invited_speaker_data.php');
    // error_reporting( E_ALL );
    // ini_set( "display_errors", 1 );
?>

<?php
if($_POST["flag"] == "favorite"){
    $member_idx = $_SESSION["USER"]["idx"];
    $invited_speaker_idx = $_POST['invited_speaker_idx'] ?? "";
    $check_favorite = $_POST['check_favorite'];

    if($check_favorite==0){
        $is_deleted = 'Y';
    } else if($check_favorite==1){
        $is_deleted = 'N';
    }

    $select_favorite_query = " 
                                SELECT idx, member_idx, invited_speaker_idx, register_date, is_deleted
                                FROM favorite_invited_speaker
                                WHERE member_idx = '{$member_idx}'
                                AND invited_speaker_idx = '{$invited_speaker_idx}'
                            ";
    $select_favorite = sql_fetch($select_favorite_query);

    if(isset($select_favorite)) {
        $update_favorite_query = "
                            UPDATE favorite_invited_speaker
                            SET
                                is_deleted = '{$is_deleted}'
                            WHERE member_idx = '{$member_idx}'
                            AND invited_speaker_idx = '{$invited_speaker_idx}'
                        ";
        $update_favorite = sql_query($update_favorite_query);

        if($update_favorite){
            $res = [
                "code" => 200,
                "msg" => "success"
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                "code" => 400,
                "msg" => "update favorite error"
            ];
            echo json_encode($res);
            exit;
        }
    } else {
        $insert_favorite_query = "
                                        INSERT favorite_invited_speaker
                                        SET
                                            member_idx = '{$member_idx}',
                                            invited_speaker_idx = '{$invited_speaker_idx}'         
                                    ";
        $insert_favorite = sql_query($insert_favorite_query);

        if($insert_favorite){
            $res = [
                "code" => 200,
                "msg" => "success"
            ];
            echo json_encode($res);
            exit;
        }else {
            $res = [
                "code" => 400,
                "msg" => "insert favorite error"
            ];
            echo json_encode($res);
            exit;
        }
    }

} else if($_POST["flag"] === "select"){
    $member_idx = $_SESSION["USER"]["idx"];
    $keywords = $_POST["keywords"];

    $row_sql = "";

    if($keywords != ""){
        $row_sql .= " AND(last_name LIKE '%{$keywords}%' OR first_name LIKE '%{$keywords}%' OR nation LIKE '%{$keywords}%' OR CONCAT(first_name,' ',last_name) LIKE '%{$keywords}%') ";
    }

    $select_keywords_query = "
                                SELECT DISTINCT LEFT(first_name, 1) AS initial, isp.idx, program_contents_idx, last_name, first_name, nation, affiliation,
                                    (CASE
                                         WHEN fisp.idx IS NULL THEN 'N'
                                         ELSE 'Y'
                                            END
                                    ) AS favorite_check,
									isp.image_path, isp.cv_path
                                FROM invited_speaker isp
                                LEFT JOIN(
                                    SELECT fisp.idx, member_idx, invited_speaker_idx
                                    FROM favorite_invited_speaker fisp
                                    WHERE is_deleted = 'N'
                                    AND member_idx = '{$member_idx}'
                                ) fisp ON isp.idx=fisp.invited_speaker_idx
                                WHERE isp.is_deleted = 'N'
                                {$row_sql}
                                ORDER BY first_name
                            ";
    $keywords_list = get_data($select_keywords_query);

	$select_initial_query = "
                            SELECT DISTINCT LEFT(first_name, 1) AS initial
                            FROM invited_speaker
                            WHERE is_deleted='N'
							{$row_sql}
                            ORDER BY initial ASC;
                        ";
	$initial_list = get_data($select_initial_query);

	$result_arr = [];
	$child_num = 0;

	foreach ($initial_list as $ink => $ini){
		$child_num = 0;
		$result_arr[$ink]['initial'] = $ini['initial'];
		foreach ($keywords_list as $isk => $isl){
			if($isl['initial'] == $ini['initial']){
				$result_arr[$ink]['data'][$child_num]['idx'] = $isl['idx'];
				$result_arr[$ink]['data'][$child_num]['first_name'] = $isl['first_name'];
				$result_arr[$ink]['data'][$child_num]['last_name'] = $isl['last_name'];
				$result_arr[$ink]['data'][$child_num]['image_path'] = $isl['image_path'];
				$result_arr[$ink]['data'][$child_num]['favorite_check'] = $isl['favorite_check'];
				$result_arr[$ink]['data'][$child_num]['initial'] = $isl['initial'];
                $result_arr[$ink]['data'][$child_num]['nation'] = $isl['nation'];
                $result_arr[$ink]['data'][$child_num]['affiliation'] = $isl['affiliation'];
				
				$child_num++;
			}
		}
	}

    if(isset($keywords_list)){
        $res = [
            "code" => 200,
            "msg" => "success",
            "result" => $result_arr
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            "code" => 400,
            "msg" => "select keywords error"
        ];
        echo json_encode($res);
        exit;
    }
}else if($_POST["flag"] === "invited_speaker") {
    include_once('../../include/invited_speaker_data.php');

    $first_word = $_POST["first_word"] ?? null;
    $session_word = $_POST["session_word"] ?? null;
    $search_word = $_POST["search_word"] ?? null;
    $order = $_POST["order"] ?? null;
    $category_bool = $_POST["category_bool"] ?? null;
    //order을 넣은 이유는 가장 늦게 선택한 걸 마지막에 걸러주려고

    $list = $invited_speaker_list;


    //session 여부
    if($category_bool == "true") {
        array_splice($list, 75, 1);
    } else {
        array_splice($list, 76, 2);
    }
        
    if($order == 1) {
    
        if(!empty($session_word)) {
            $list = session_forder($list, $session_word);
        }
        if(!empty($search_word)) {
            $list = search_forder($list, $search_word);
        }
        if(!empty($first_word)) {
            $list = first_order($list, $first_word);
        }
        
    }
    else if($order == 2) {

        if(!empty($first_word)) {
            $list = first_order($list, $first_word);
        }
        if(!empty($search_word)) {
            $list = search_forder($list, $search_word);
        }
        if(!empty($session_word)) {
            $list = session_forder($list, $session_word);
        }
        
    }
    else if($order == 3) {

        if(!empty($first_word)) {
            $list = first_order($list, $first_word);
        }
        if(!empty($session_word)) {
            $list = session_forder($list, $session_word);
        }
        if(!empty($search_word)) {
            $list = search_forder($list, $search_word);
        }
    }
    $res = [
        "code" => 200,
        "msg" => "success",
        "list"=>$list, 
        "total_count"=>count($list)
    ];
    echo json_encode($res);
    exit;

}
else if($_POST["flag"] === "invited_speakers"){
    $member_idx = $_SESSION["USER"]["idx"];
    $search_word = $_POST["search_word"];
    $first_word =  $_POST["first_word"];
    $session_word =  $_POST["session_word"];

    $row_sql = "";

    if($search_word != ""){
        $row_sql .= " AND(last_name LIKE '%{$search_word}%' OR first_name LIKE '%{$search_word}%' OR nation LIKE '%{$search_word}%' OR CONCAT(first_name,' ',last_name) LIKE '%{$search_word}%') ";
    }
    if($first_word != ""){
        $row_sql .= " HAVING initial = '{$first_word}'";
    }
    if($session_word !== ""){
        switch($session_word){
            case 'Plenary Lectures':$row_sql .= " AND program_category_idx = 5"; break;
            case 'Symposium':$row_sql .= " AND program_category_idx = 8"; break;
            case 'joint': $row_sql .= " AND program_category_idx = 15"; break;
        } 
    }

    $select_keywords_query = "
                            SELECT DISTINCT LEFT(first_name, 1) AS initial, isp.idx, last_name, first_name, nation, affiliation, isp.image_path, isp.cv_path, pr.program_category_idx
                            FROM invited_speaker isp
                            LEFT JOIN program_contents pc ON pc.speaker_idx = isp.idx AND pc.is_deleted = 'N'
                            LEFT JOIN program pr ON pc.program_idx = pr.idx
                            WHERE isp.is_deleted = 'N'
                                {$row_sql}
                                ORDER BY first_name
                            ";
   
    $keywords_list = get_data($select_keywords_query);

    if(isset($keywords_list)){
        $res = [
            "code" => 200,
            "msg" => "success",
            "result" => $keywords_list
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            "code" => 400,
            "msg" => "select keywords error"
        ];
        echo json_encode($res);
        exit;
    }
}
else if($_POST["flag"] === "invited_speaker_modal"){
    $modal_idx = $_POST["idx"];

    $select_keywords_query = "
                            SELECT DISTINCT LEFT(first_name, 1) AS initial, isp.idx, last_name, first_name, nation, affiliation, isp.image_path, isp.cv_path, pr.program_category_idx,pr.program_name,pr.program_place_idx,pr.program_date, DATE_FORMAT(pr.start_time, '%H:%i')AS start_time, DATE_FORMAT(pr.end_time, '%H:%i')AS end_time
                            FROM invited_speaker isp
                            LEFT JOIN program_contents pc ON pc.speaker_idx = isp.idx AND pc.is_deleted = 'N'
                            LEFT JOIN program pr ON pc.program_idx = pr.idx
                            WHERE isp.is_deleted = 'N' AND isp.idx = '{$modal_idx}'
                            ORDER BY first_name
                            ";
    $keywords_list = get_data($select_keywords_query);

    if(isset($keywords_list)){
        $res = [
            "code" => 200,
            "msg" => "success",
            "result" => $keywords_list
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            "code" => 400,
            "msg" => "select keywords error"
        ];
        echo json_encode($res);
        exit;
    }
}

function first_order($list, $first_word) {
    $list_value = array();
    foreach($list as $l) {
        $last_name = substr($l["last_name"], 0, 1);

        if($first_word == $last_name) {
            $list_value[] = $l;
        }
    }
    return $list_value;
}
function session_forder($list, $session_word) {
    
    $list_value = array();

    foreach($list as $l) {
        $session_type = $l["session_type"];
        $joint = $l["joint"];

        if(strrpos($session_type, $session_word) !== false || strrpos($joint, $session_word) !== false) {
            $list_value[] = $l;
        } else {
            if($l["idx"] == 71) {
                $session_type2 = $l["session_type2"];
                if(strrpos($session_type2, $session_word) !== false || strrpos($joint, $session_word) !== false) {
                    $list_value[] = $l;
                }
            }
        }
        
    }
    return $list_value;
}
function search_forder($list, $search_word) {
    $list_value = array();

    $search_word = strtolower($search_word);

    foreach($list as $l) {
        $first_name =strtolower($l["first_name"]);
        $last_name = strtolower($l["last_name"]);

        $name = $first_name." ".$last_name;

        $affiliation = strtolower($l["affiliation"]);
        $nation = strtolower($l["nation"]);
        $session_type = strtolower($l["session_type"]);
        $title = strtolower($l["title"]);
        
        if(strrpos($name, $search_word) !== false || strrpos($affiliation, $search_word) !== false || strrpos($nation, $search_word) !== false || strrpos($title, $search_word) !== false || strrpos($session_type, $search_word) !== false) {
            $list_value[] = $l;
        } else {
            if($l["idx"] == 71) {
                $session_type2 = $l["session_type2"];
                $title2 = strtolower($l["title2"]);
                if(strrpos($session_type2, $search_word) !== false || strrpos($title2, $search_word) !== false) {
                    $list_value[] = $l;
                }
            }
        }
    }
    return $list_value;
}


?>