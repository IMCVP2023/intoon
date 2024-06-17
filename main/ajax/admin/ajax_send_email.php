<?php
	include_once("../../common/common.php");

	$flag = $_POST["flag"] ?? $_GET["flag"];

	foreach($_POST as $key=>$value){
		$_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
	}

	
	if ($flag === "modify_program") {

			// 수정
			$sql =	"UPDATE program
					SET
                        chairpersons		= '".$_POST['chairpersons']."',
						preview				= '".$_POST['preview']."'
					WHERE idx = '".$_POST['idx']."'";
			if (!sql_query($sql)) {
				return_value(500, "수정 중 오류가 발생했습니다.\n관리자에게 문의하세요.");
			}

		return_value(200, "완료되었습니다.", array("idx"=>$abstract_idx));
	}

    
	else if ($flag === "modify_program_detail") {

        // 수정
        $sql =	"UPDATE program_contents
                SET
                    contents_title		= '".$_POST['title']."',
                    speaker				= '".$_POST['speaker']."'
                WHERE idx = '".$_POST['idx']."'";
        if (!sql_query($sql)) {
            return_value(500, "수정 중 오류가 발생했습니다.\n관리자에게 문의하세요.");
        }

    return_value(200, "완료되었습니다.", array("idx"=>$abstract_idx));
}



	// 결과값 반환 공통화
	function return_value($code, $msg, $arr=array()){
		$arr["code"] = $code;
		$arr["msg"] = $msg;
		echo json_encode($arr);
		exit;
	}