<?php
    //root 절대주소로 변경_211025
	include_once($d9_path['path']."/common/common.php");
	function locale($type) {
		include_once(D9_COMMON_PATH."/lang.php");
		try {
			return function ($text) use ($type , $lang) {
				if ($lang[$type][$text]) {
					return $lang[$type][$text];	
				} else {
					return "!!!".$text."!!!";
				}
			};
		} catch(Exception $e) {
			return function ($text) use ($type , $lang) {
				return 'error';
			};
		}
	}
?>