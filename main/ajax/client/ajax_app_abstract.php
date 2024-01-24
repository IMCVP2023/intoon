<?php include_once("../../common/common.php");?>

<?php
if($_POST['flag']==='select'){
    $category_idx = $_POST['category_idx'] ?? "";

    $row_sql="";

    if($category_idx!==''){
        $row_sql .= " AND category_idx = {$category_idx}" ;
    }

    $select_abstract_query="
                        SELECT idx, category_idx, path, name
                        FROM viewer_abstract
                        WHERE is_deleted='N'
                        {$row_sql}
                        ";
    $abstract_list = get_data($select_abstract_query);

    if (isset($abstract_list)) {
        $res = [
            code => 200,
            msg => "success",
            result => $abstract_list
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            code => 400,
            msg => "select abstract error"
        ];
        echo json_encode($res);
        exit;
    }
}
?>
