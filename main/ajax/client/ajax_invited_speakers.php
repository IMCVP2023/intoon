<?php include_once("../../common/common.php");?>
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
                code => 200,
                msg => "success"
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                code => 400,
                msg => "update favorite error"
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
                code => 200,
                msg => "success"
            ];
            echo json_encode($res);
            exit;
        }else {
            $res = [
                code => 400,
                msg => "insert favorite error"
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
            code => 200,
            msg => "success",
            result => $result_arr
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            code => 400,
            msg => "select keywords error"
        ];
        echo json_encode($res);
        exit;
    }
}

?>