<?php include_once("../../common/common.php");?>
<?php include_once("../../common/locale.php");?>

<?php
include_once('../../plugin/google-api-php-client-main/vendor/autoload.php');

$abstract_idx = $_POST["idx"];

// submission_info
$submit_data_query = "SELECT 
							ra.idx, ra.submission_code, ra.nation_no, ra.first_name, ra.last_name, ra.affiliation, ra.email, ra.phone, 
							ra.abstract_title, ra.presentation_type, ra.abstract_category, f.path, f.save_name, f.original_name
						FROM request_abstract AS ra
						LEFT JOIN file AS f ON f.idx = ra.abstract_file";
$submit_data = sql_fetch($submit_data_query." WHERE ra.idx = ".$abstract_idx) ?? [];

// presenting_author
$presenting_author_data = get_data($submit_data_query." WHERE (ra.idx=".$abstract_idx." OR parent_author=".$abstract_idx.") AND presenting_author='Y'") ?? [];

// corresponding_author
$corresponding_author_data = get_data($submit_data_query." WHERE (ra.idx=".$abstract_idx." OR parent_author=".$abstract_idx.") AND corresponding_author='Y'") ?? [];

$result = array(
	"submit_data" => $submit_data, 
	"presenting_author_data" => $presenting_author_data,
	"corresponding_author_data" => $corresponding_author_data
);

echo json_encode(array(
	"code"	=> 200,
	"msg"	=> "success",
	"data"	=> $result
));
exit;
?>