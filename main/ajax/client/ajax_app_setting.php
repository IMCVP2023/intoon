<?php include_once("../../common/common.php");?>
<?php
if($_POST["flag"]==="update"){
    $member_idx = $_SESSION["USER"]["idx"];
    $is_alarm = $_POST['is_alarm'];
//    if($is_alarm===true){
//        $_is_alarm = 'Y';
//    } else {
//        $_is_alarm = 'N';
//    }

    $update_permisson_query = "
                                UPDATE member
                                SET is_alarm = '{$is_alarm}'
                                WHERE idx = {$member_idx}
                                ";
    $update_permission = sql_query($update_permisson_query);
    if ($update_permission) {
        $res = [
            code => 200,
            msg => "success"
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            code => 400,
            msg => "update permission error"
        ];
        echo json_encode($res);
        exit;
    }
} else if ($_POST["flag"]==="select"){
    $member_idx = $_SESSION["USER"]["idx"];
    $select_permission_query = "
                                   SELECT is_alarm FROM member WHERE idx = {$member_idx}
                                ";

    $select_permission = sql_fetch($select_permission_query)['is_alarm'];

    if (isset($select_permission)) {
        $res = [
            code => 200,
            msg => "success",
            is_alarm => $select_permission
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            code => 400,
            msg => "select permission error"
        ];
        echo json_encode($res);
        exit;
    }
}
?>
