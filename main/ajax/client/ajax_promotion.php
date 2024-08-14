<?php include_once("../../common/common.php");?>
<?php
    if($_POST["flag"] == "select") {
        $promotion_code=$_POST["promotion_code"];

        $sql ="
					SELECT idx, promotion_code, discount_rate, count_limit
                    FROM promotion_code
                    WHERE promotion_code = '{$promotion_code}'
				  ";

        $result = sql_fetch($sql);

        if($result) {
            $res = [
                code => 200,
                msg => "success",
                result => $result
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                code => 400,
                msg => "update query error"
            ];
            echo json_encode($res);
            exit;
        }

    } else if($_POST["flag"] == "regist"){
        $registration_idx = $_POST["data"]["registration_idx"];
        $promotion_code = $_POST["data"]["promotion_code"] ?? "";
        $recommender = $_POST["data"]["recommender"] ?? "";

        $promotion_code_sql ="
					SELECT idx, promotion_code
                    FROM promotion_code
                    WHERE promotion_code = '{$promotion_code}'
                    AND count_limit = 1
				  ";

        $promotion_code_idx = sql_fetch($promotion_code_sql)['idx'];

        $sql =	"
					INSERT management_promotion_code
					SET
						registration_idx = '{$registration_idx}',
						promotion_code_idx = '{$promotion_code_idx}',
						recommender = '{$recommender}',
						regist_date = NOW()
					";

        $result = sql_query($sql);

        if($result) {
            $res = [
                code => 200,
                msg => "success",
                
                //sujeong / 프로모션 코드 중복 사용 가능
                //update($promotion_code_idx)
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                code => 400,
                msg => "insert query error"
            ];
            echo json_encode($res);
            exit;
        }
    }

    function update($idx){
        $sql = "
                UPDATE promotion_code
                SET
                    count_limit = 0
                WHERE idx = '{$idx}'
                ";

        $result = sql_query($sql);

        if($result) {
            $res = [
                code => 200,
                msg => "success"
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                code => 400,
                msg => "update query error"
            ];
            echo json_encode($res);
            exit;
        }
    }

?>