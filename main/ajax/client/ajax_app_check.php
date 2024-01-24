<?php include_once("../../common/common.php");?>

<?php
if($_POST["flag"]==="updateDeviceToken"){
    $device = $_POST["device"];
    $deviceToken = $_POST["deviceToken"];
    $member_idx = $_SESSION["USER"]["idx"];
    $type= "";

    if($device==="IOS"){
        $type = "I";
    } else {
        $type = "A";
    }

    $update_token_query = "
                            UPDATE device_token
                            SET type = '{$type}',
                                token = '{$deviceToken}'
                            WHERE member_idx = '{$member_idx}'
                            ";

    $update_token_result = sql_query($update_token_query);

    $update_push_schedule_query = "
                                    UPDATE push_schedule
                                    SET token = '{$deviceToken}',
                                        type = '{$type}'
                                    WHERE member_idx = '{$member_idx}'
                                ";
    $update_push_schedule = sql_query($update_push_schedule_query);
}
?>