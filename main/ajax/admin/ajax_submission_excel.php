<?php include_once("../../common/common.php");?>
<?php 
	// nation
	$nation_query = "SELECT *
					FROM nation";
	$nation_list = get_data($nation_query);
	$nation_map = [];

	foreach($nation_list as $obj) {
		$nation_map[$obj["idx"]] = $obj["nation_en"];
	}

	// Presentation_type
	$presentation_type_arr = array("Oral Presentation", "Poster Exhibition", "Guided Poster Presentation", "Any of them");

	// Position
	$position_arr = array("Professor", "Physician", "Researcher", "Student", "Other");

	// abstract_category
	$abstract_category_sql = "SELECT 
									idx, title_en, title_ko
								FROM info_poster_abstract_category
								WHERE is_deleted = 'N'";
	$abstract_category_data = get_data($abstract_category_sql);
	$abstract_category_map = [];

	foreach($abstract_category_data as $obj) {
		$abstract_category_map[$obj["idx"]] = $obj["title_en"];
	}

	// author_type
	$author_type_arr = array("Co-author", "Presenting Author", "Corresponding Author", "Any of them");

	// submission_info
	$submission_data_query = "SELECT  
								ra.idx, ra.submission_code, ra.nation_no, ra.first_name, ra.last_name, ra.affiliation, ra.email, ra.phone, 
								ra.abstract_title, ra.presentation_type, ra.abstract_category, f.path, f.save_name, f.original_name, DATE_FORMAT(ra.register_date, '%Y-%m-%d') AS regist_date
							FROM request_abstract AS ra
							LEFT JOIN file AS f ON f.idx = ra.abstract_file
							WHERE ra.is_deleted = 'N' AND ra.submission_code IS NOT NULL AND ra.parent_author IS NULL";
	$submission_data = get_data($submission_data_query) ?? [];
	$submission_map = [];

	foreach($submission_data as $submission) {
		$submission["authors"] = [];
		$submission_map[$submission["idx"]] = $submission;
	}

	// author_list
	$author_data_query = "SELECT IFNULL(parent_author, idx) AS parent_author, nation_no, last_name, first_name, 
								email, phone, affiliation, presenting_author, corresponding_author
							FROM request_abstract
							WHERE ra.is_deleted = 'N'
							ORDER BY idx ASC";
	$author_list = get_data($author_data_query) ?? [];

	foreach($author_list as $author) {
		
	}

	print_r($submission_map);
?>