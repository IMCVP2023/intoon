<!--[240225] sujeong / iscp admin 추가!!! -->
<?php
include_once('./include/head.php');
include_once('./include/header.php');
include_once('../include/submission_data.php');

if ($admin_permission["auth_apply_poster"] == 0) {
	echo '<script>alert("권한이 없습니다.");history.back();</script>';
}

$id = isset($_GET["id"]) ? $_GET["id"] : "";
$name = isset($_GET["name"]) ? $_GET["name"] : "";
$title = isset($_GET["title"]) ? $_GET["title"] : "";
$s_date = isset($_GET["s_date"]) ? $_GET["s_date"] : "";
$e_date = isset($_GET["e_date"]) ? $_GET["e_date"] : "";
$category = isset($_GET["category"]) ? $_GET["category"] : "";

$where = "";

if ($id != "") {
	$where .= " AND m.email LIKE '%" . $id . "%' ";
}

if ($name != "") {
	$where .= " AND `name` LIKE '%" . $name . "%' ";
}

if ($title != "") {
	$where .= " AND rs.title LIKE '%" . $title . "%' ";
}

if ($s_date != "") {
	$where .= " AND DATE(rs.modify_date) >= '" . $s_date . "' ";
}

if ($e_date != "") {
	$where .= " AND DATE(rs.modify_date) <= '" . $e_date . "' ";
}

if ($category != "") {
	$where .= " AND rs.topic LIKE '%" . $category . "%' ";
}

$abstract_list_query = "SELECT
								rs.idx, rs.etc1, rs.etc2,rs.etc1_date, rs.etc3, rs.etc4, rr.status AS registration_status,
								member_idx, rs.register_date,
								DATE_FORMAT(rs.modify_date, '%y-%m-%d') AS submission_date,
								IFNULL(rs.submission_code,'-') AS submission_code,
								m.email,
								nation_ko,
								`name`,
								CASE
									WHEN preferred_presentation_type = 0 THEN 'Poster Oral'
									WHEN preferred_presentation_type = 1 THEN 'Poster Exhibition only' 
									WHEN preferred_presentation_type = 2 THEN 'Either' 
								END AS pre_type,
								rs.topic,
								rs.topic_detail,
								rs.title,
								rs.objectives,
								rs.methods,
								rs.results,
								rs.conclusions,
								rs.keywords,
								aff.aff_idx,
								aff.aff_affiliation,
								aff.aff_department,
								aff.aff_nation_en,
								GROUP_CONCAT( au.presenting_yn) AS au_presenting_yn,
								GROUP_CONCAT( au.corresponding_yn) AS au_corresponding_yn,
								GROUP_CONCAT( au.affiliation_selected) AS au_affiliation_selected,
								GROUP_CONCAT( au_name) AS au_name,
								GROUP_CONCAT( au_email) AS au_email,
								GROUP_CONCAT( au_phone_number) AS au_phone_number,
								rs.similar_yn,
								rs.support_yn,
								rs.travel_grants_yn,
								rs.awards_yn,
								rs.investigator_grants_yn,
								paths1,
								image1_caption,
								paths2,
								image2_caption,
								paths3,
								image3_caption,
								paths4,
								image4_caption,
								paths5,
								image5_caption,
								documents
							FROM request_submission AS rs
							LEFT JOIN(
								SELECT
									m.idx AS member_idx, m.email, n.nation_ko AS nation_ko, CONCAT(m.first_name,' ',m.last_name) AS `name`
								FROM member m
								JOIN nation n
								ON m.nation_no = n.idx
							) AS m
							ON rs.register = m.member_idx
							LEFT JOIN(
								SELECT rr.status, rr.register, rr.is_deleted
								FROM request_registration AS rr
								WHERE rr.is_deleted = 'N'
							) AS rr
							ON rr.register = m.member_idx
							LEFT JOIN(
								SELECT 
									aff.idx, aff.submission_idx,
									GROUP_CONCAT(aff.submission_idx ORDER BY aff.`order` SEPARATOR '★|') AS aff_idx,
									GROUP_CONCAT(aff.affiliation ORDER BY aff.`order` SEPARATOR '★|') AS aff_affiliation,
									GROUP_CONCAT(aff.department ORDER BY aff.`order` SEPARATOR '★|') AS aff_department,
									GROUP_CONCAT(n_aff.nation_en ORDER BY aff.`order` SEPARATOR '★|') AS aff_nation_en
								FROM request_submission_affiliation AS aff
								LEFT JOIN(
									SELECT
										*
									FROM nation
								) AS n_aff
								ON nation_no = n_aff.idx
								WHERE aff.is_deleted = 'N'
								GROUP BY aff.submission_idx
								ORDER BY aff.`order` DESC
							) AS aff
							ON rs.idx = aff.submission_idx
							LEFT JOIN(
								SELECT	
									au.idx,
									au.submission_idx,
									au.presenting_yn,
									au.corresponding_yn,
									CONCAT(au.first_name,' ',au.last_name) AS au_name,
									au.affiliation_selected,
									au.email AS au_email,
									au.mobile AS au_phone_number
								FROM request_submission_author AS au
								WHERE au.is_deleted = 'N'
								#ORDER BY au.`order`
							) AS au
							ON rs.idx = au.submission_idx
							LEFT JOIN(
								SELECT
									idx,
									CONCAT('https://imcvp.org',fi1.path,'/',fi1.save_name) AS paths1
								FROM file AS fi1
							) AS fi1
							ON rs.image1_file = fi1.idx
							LEFT JOIN(
								SELECT
									idx,
									CONCAT('https://imcvp.org',fi2.path,'/',fi2.save_name) AS paths2
								FROM file AS fi2
							) AS fi2
							ON rs.image2_file = fi2.idx
							LEFT JOIN(
								SELECT
									idx,
									CONCAT('https://imcvp.org',fi3.path,'/',fi3.save_name) AS paths3
								FROM file AS fi3
							) AS fi3
							ON rs.image3_file = fi3.idx
							LEFT JOIN(
								SELECT
									idx,
									CONCAT('https://imcvp.org',fi4.path,'/',fi4.save_name) AS paths4
								FROM file AS fi4
							) AS fi4
							ON rs.image4_file = fi4.idx
							LEFT JOIN(
								SELECT
									idx,
									CONCAT('https://imcvp.org',fi5.path,'/',fi5.save_name) AS paths5
								FROM file AS fi5
							) AS fi5
							ON rs.image5_file = fi5.idx
							LEFT JOIN(
								SELECT
									idx,
									CONCAT('https://imcvp.org',documents.path,'/',documents.save_name) AS documents
								FROM file AS documents
							) AS documents
							ON rs.prove_age_file = documents.idx
							WHERE rs.is_deleted = 'N'
							AND rs.`status` = 1
							{$where}
							GROUP BY rs.idx
							ORDER BY rs.register_date DESC
	";

//    error_log(print_r($abstract_list_query, TRUE), 3, '/tmp/errors.log');


$no = 1;
$aff_cnt_title = 1;
$au_cnt_title = 1;
$aff_cnt = 0;
$au_cnt = 0;
$abstract_list = get_data($abstract_list_query);

$time = new DateTime();
$date_time = $time->format("Y-m-d");

$count = count($abstract_list);

foreach ($abstract_list as $al) {

	$aff_count = $al["aff_idx"];
	$aff_counts = explode('★|', $aff_count);

	$aff_counts_plus[] = count($aff_counts);

	$au_count = $al["au_presenting_yn"];
	$au_counts = explode(',', $au_count);

	$au_counts_plus[] = count($au_counts);
}


$max_aff = MAX($aff_counts_plus);
$max_au = MAX($au_counts_plus);

$html = '<table id="datatable" class="list_table">';
$html .= '<thead>';
$html .= '<thead>';
$html .= '<tr class="tr_center">';
$html .= '<th style="background-color:#D0CECE; border-style: solid; border-width:thin;" colspan="7">Submission Information</th>';
$html .= '<th style="background-color:#D0CECE; border-style: solid; border-width:thin;" colspan="4">Abstract Information</th>';
$html .= '<th style="background-color:#D9E1F2; border-style: solid; border-width:thin;" colspan="8">Abstract</th>';

for ($i = 0; $i < $max_aff; $i++) {
	$html .= '<th style="background-color:#FCE4D6; border-style: solid; border-width:thin;" colspan="5">Affiliation #' . $i . '</th>';
}

for ($i = 0; $i < $max_au; $i++) {
	$html .= '<th style="background-color:#FFF2CC; border-style: solid; border-width:thin;" colspan="7">Author #' . $i . '</th>';
}

$html .= '<th style="background-color:#E7E6E6; border-style: solid; border-width:thin;" colspan="3">Others</th>';
$html .= '<th style="background-color:#000000; color:#FFFFFF; border-style: solid; border-width:thin;" colspan="11">Attachment</th>';
$html .= '</tr>';
$html .= '<tr class="tr_center">';
$html .= '<th style="border-style: solid; border-width:thin;">No.</th>';
$html .= '<th style="border-style: solid; border-width:thin;">제출일자</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Submission Code</th>';
$html .= '<th style="border-style: solid; border-width:thin;">ID(Email)</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Country</th>';
$html .= '<th style="border-style: solid; border-width:thin;">사전 등록 상태</th>';
$html .= '<th style="border-style: solid; border-width:thin;">초록 심사 유무</th>';
$html .= '<th style="border-style: solid; border-width:thin;">초록 심사 일자</th>';
$html .= '<th style="border-style: solid; border-width:thin;">초록 채택 유무</th>';
$html .= '<th style="border-style: solid; border-width:thin;">초록 TG 유무</th>';
$html .= '<th style="border-style: solid; border-width:thin;">초록 발급 프로모션코드</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Name</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Oral or Poster / Poster</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Topic Category</th>';
// $html .= '<th style="border-style: solid; border-width:thin;">Detail Category</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Title</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Objectives</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Materials and Methods</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Results</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Conclusions</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Keywords</th>';


for ($i = 0; $i < $max_aff; $i++) {
	$html .= '<th style="border-style: solid; border-width:thin;">F Code' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">F Affiliation' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">F Department' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">F Country' . strval($i) . '</th>';
}

for ($i = 0; $i < $max_au; $i++) {
	$html .= '<th style="border-style: solid; border-width:thin;">U Code' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">U Author type' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">U Name' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">U Affiliation' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">U Department' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">U Email' . strval($i) . '</th>';
	$html .= '<th style="border-style: solid; border-width:thin;">U Phone Number' . strval($i) . '</th>';
}

 $html .= '<th style="background-color:#CCCCFF; border-style: solid; border-width:thin;">Q1. Have you submitted this abstract or ab abstract of a similar topic at another conference? </th>';
$html .= '<th style="background-color:#CCCCFF; border-style: solid; border-width:thin;">Q2. TThis research is supported by the grant of Korean Society of Cardiovascular Disease Prevention</th>';
$html .= '<th style="background-color:#CC66E1; border-style: solid; border-width:thin;">Travel Grants</th>';
// $html .= '<th style="background-color:#CC66E1; border-style: solid; border-width:thin;">APSAVD Award</th>';
// $html .= '<th style="background-color:#CC66E1; border-style: solid; border-width:thin;">IAS Grant</th>';
$html .= '<th style="border-style: solid; border-width:thin;">image1</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Caption1</th>';
$html .= '<th style="border-style: solid; border-width:thin;">image2</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Caption2</th>';
$html .= '<th style="border-style: solid; border-width:thin;">image3</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Caption3</th>';
$html .= '<th style="border-style: solid; border-width:thin;">image4</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Caption4</th>';
$html .= '<th style="border-style: solid; border-width:thin;">image5</th>';
$html .= '<th style="border-style: solid; border-width:thin;">Caption5</th>';
$html .= '<th style="background-color:#CC66E1; border-style: solid; border-width:thin;">Copy of documents</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

foreach ($abstract_list as $al) {
	$title = $al["title"];
	$title =  preg_replace('/\s+/', ' ', $title);
	$title = htmlspecialchars_decode($title);

	$objectives = $al["objectives"];
	$objectives = preg_replace('/\s+/', ' ', $objectives);
	$objectives = htmlspecialchars_decode($objectives);

	$methods = $al["methods"];
	$methods = preg_replace('/\s+/', ' ', $methods);
	$methods = htmlspecialchars_decode($methods);

	$results = $al["results"];
	$results = preg_replace('/\s+/', ' ', $results);
	$results = htmlspecialchars_decode($results);

	$conclusions = $al["conclusions"];
	$conclusions = preg_replace('/\s+/', ' ', $conclusions);
	$conclusions = htmlspecialchars_decode($conclusions);

	$keywords = $al["keywords"];
	$keywords = preg_replace('/\s+/', ' ', $keywords);
	$keywords = htmlspecialchars_decode($keywords);

	$aff_idx = $al["aff_idx"];
	$aff_idxs = explode('★|', $aff_idx);
	$aff_affiliation = $al["aff_affiliation"];
	$aff_affiliations = explode('★|', $aff_affiliation);
	$aff_department = $al["aff_department"];
	$aff_departments = explode('★|', $aff_department);
	$aff_nation_en = $al["aff_nation_en"];
	$aff_nation_ens = explode('★|', $aff_nation_en);

	$au_presenting_yn = $al["au_presenting_yn"];
	$au_presenting_yns = explode(',', $au_presenting_yn);
	$au_corresponding_yn = $al["au_corresponding_yn"];
	$au_corresponding_yns = explode(',', $au_corresponding_yn);
	$au_name = $al["au_name"];
	$au_names = explode(',', $au_name);
	$au_affiliation_selected = $al["au_affiliation_selected"];
	$au_affiliation_selecteds = explode(',', $au_affiliation_selected);

	$au_email = $al["au_email"];
	$au_emails = explode(',', $au_email);
	$au_phone_number = $al["au_phone_number"];
	$au_phone_numbers = explode(',', $au_phone_number);

	$topic = "";
	$topic_detail = "";

	foreach ($topic1_list as $tp) {
		if ($tp['idx'] == $al['topic']) {
			$topic = $tp["idx"] . ". " . $tp["name_en"];
		}
	}
	foreach ($topic2_list as $tp) {
		if ($tp['idx'] == $al['topic_detail']) {
			$topic_detail = $tp["idx"] . ". " . $tp['order'] . ". " . $tp["name_en"];
		}
	}
	$regist_status_text = "";
	if($al["registration_status"] == 1){
		$regist_status_text = "결제대기";
	}else if($al["registration_status"] == 2){
		$regist_status_text = "결제완료";
	}else if($al["registration_status"] == 3){
		$regist_status_text = "환불대기";
	}else if($al["registration_status"] == 4){
		$regist_status_text = "환불완료";
	}else if(!$al["registration_status"]){
		$regist_status_text = "미등록";
	}

	$html .= '<tr class="tr_center">';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $no++ . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["submission_date"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["submission_code"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;"><a href="mailto:' . $al["email"] . '">' . $al["email"] . '</a></td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["nation_ko"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $regist_status_text . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["etc1"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["etc1_date"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["etc2"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["etc4"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["etc3"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["name"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["pre_type"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $topic . '</td>';
	// $html .= '<td style="border-style: solid; border-width:thin;">' . $topic_detail . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $title . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $objectives . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $methods . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $results . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $conclusions . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $keywords . '</td>';


	for ($i = 0; $i < $max_aff; $i++) {
		$au_cnt = 0;

		if (!empty($aff_affiliations[$aff_cnt])) {
			$aff_code = "#" . ($aff_cnt + 1);
		} else {
			$aff_code = "";
		}

		$aff_department_list = "";
		foreach ($department_list as $v) {
			if ($aff_departments[$aff_cnt] == $v["idx"]) {
				$aff_department_list = $v["name_en"];
				break;
			}
		}

		$html .= '<td style="border-style: solid; border-width:thin;">' . $aff_code . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $aff_affiliations[$aff_cnt] . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $aff_department_list . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $aff_nation_ens[$aff_cnt] . '</td>';

		$aff_cnt++;
	}
	for ($i = 0; $i < $max_au; $i++) {
		$aff_cnt = 0;

		if (!empty($au_names[$au_cnt])) {
			$au_code = "#" . ($au_cnt + 1);
		} else {
			$au_code = "";
		}

		$au_type = '';
		if ($au_presenting_yns[$au_cnt] == 'Y' && $au_corresponding_yns[$au_cnt] == 'Y') {
			$au_type = 'Presenting author,<br style="mso-data-placement:same-cell;"> Corresponding author';
		} else if ($au_presenting_yns[$au_cnt] == 'Y') {
			$au_type = 'Presenting author';
		} else if ($au_corresponding_yns[$au_cnt] == 'Y') {
			$au_type = 'Corresponding author';
		} else {
			$au_type = '';
		}

		$au_sel = str_replace('||', '', $au_affiliation_selecteds[$au_cnt]);
		$au_sel = str_replace('|', ', #', $au_sel);

		if (!empty($au_sel)) {
			$au_sel = '#' . $au_sel;
		}
		if (strlen($au_sel) == 9) {
			$au_sel = substr($au_sel, 0, -3);
		}

		$html .= '<td style="border-style: solid; border-width:thin;">' . $au_code . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $au_type . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $au_names[$au_cnt] . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $au_sel . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $au_sel . '</td>';
		$html .= '<td style="border-style: solid; border-width:thin;"><a href="mailto:' . $au_emails[$au_cnt] . '">' . $au_emails[$au_cnt] . '</a></td>';
		$html .= '<td style="border-style: solid; border-width:thin;">' . $au_phone_numbers[$au_cnt] . '</td>';

		$au_cnt++;
	}

	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["similar_yn"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["support_yn"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["travel_grants_yn"] . '</td>';
	// $html .= '<td style="border-style: solid; border-width:thin;">' . $al["awards_yn"] . '</td>';
	// $html .= '<td style="border-style: solid; border-width:thin;">' . $al["investigator_grants_yn"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;"><a href="' . $al["paths1"] . '">' . $al["paths1"] . '</a></td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["image1_caption"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;"><a href="' . $al["paths2"] . '">' . $al["paths2"] . '</a></td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["image2_caption"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;"><a href="' . $al["paths3"] . '">' . $al["paths3"] . '</a></td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["image3_caption"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;"><a href="' . $al["paths4"] . '">' . $al["paths4"] . '</a></td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["image4_caption"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;"><a href="' . $al["paths5"] . '">' . $al["paths5"] . '</a></td>';
	$html .= '<td style="border-style: solid; border-width:thin;">' . $al["image5_caption"] . '</td>';
	$html .= '<td style="border-style: solid; border-width:thin;"><a href="' . $al["documents"] . '">' . $al["documents"] . '</a></td>';

	$html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';

$html = str_replace("'", "\'", $html);
$html = str_replace("\n", "", $html);

$count = count($abstract_list);
?>
<section class="list">
	<div class="container">
		<div class="title clearfix">
			<h1 class="font_title">Poster Abstract Submission</h1>
			<button class="btn excel_download_btn" onclick="javascript:fnExcelReport('Poster Abstract Submission', html);">엑셀 다운로드</button>
		</div>
		<div class="contwrap centerT has_fixed_title">
			<form name="search_form">
				<table>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<tbody>
						<tr>
							<th>ID(Email)</th>
							<td>
								<input type="text" name="id" value="<?= $id; ?>">
							</td>
							<th>Name</th>
							<td class="select_wrap clearfix2">
								<input type="text" name="name" data-type="string" value="<?= $name; ?>">
							</td>
						</tr>
						<tr>
							<th>Title</th>
							<td>
								<input type="text" name="title" data-type="string">
							</td>
							<th>등록일</th>
							<td class="input_wrap"><input type="text" value="<?= $s_date; ?>" name="s_date" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" data-type="date"> <span>~</span> <input type="text" value="<?= $e_date; ?>" name="e_date" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" data-type="date"></td>
						</tr>
						<tr>
							<th>카테고리</th>
				
							<td colspan="3">
									<select name="category">
										<option value="">카테고리를 선택해주세요.</option>
										<option value="1">1. Ischemic Heart Disease/Coronary Artery Disease</option>
										<option value="2">2. Heart Failure with Reduced Ejection Fraction and Preserved Ejection Fraction</option>
										<option value="3">3. Cardiomyopathies</option>
										<option value="4">4. Chronic Kidney Disease and Cardiovascular Disease</option>
										<option value="5">5. Preventive Cardiology</option>
										<option value="6">6. Cardiac Arrhythmias</option>
										<option value="7">7. Peripheral Arterial Disease</option>
										<option value="8">8. Basic Science and Genetics</option>
										<option value="9">9. COVID-19 Related Cardio-Pharmacotherapy</option>
										<option value="10">10. Diabetes and Obesity</option>
										<option value="11">11. Hyperlipidemia and Cardiovascular Disease</option>
										<option value="12">12. Epidemiology</option>
										<option value="13">13. Precision Medicine/Digital Healthcare</option>
										<option value="14">14. Others</option>
									</select>
								</td>
						</tr>
					</tbody>
				</table>
				<button type="button" class="btn search_btn">검색</button>
			</form>
		</div>
		<div class="contwrap">
			<div>
				<p class="total_num">총 <?= number_format($count) ?>개 <button class="all_etc1_check btn">일괄심사등록</button></p>
				
			</div>
			<table id="datatable" class="list_table table_fixed">
				<colgroup>
					<col width="3%">
					<col width="10%">
					<col width="5%">
					<col width="5%">
					<col width="5%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="*">
					<col width="10%">

				</colgroup>
				<thead>
					<tr class="tr_center">
						<th><input type="checkbox" id="all_check"/></th>
						<th>논문번호</th>
						<th>사전등록</th>
						<th>심사유무</th>
						<th>채택유무</th>
						<th>ID(Email)</th>
						<th>Country</th>
						<th>Name</th>
						<th>Title</th>
						<th class="ellipsis">등록일</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!$abstract_list) {
						echo "<tr><td class='no_data' colspan='8'>No Data</td></tr>"; //좋아요 및 댓글기능 미개발로 colspan 8 -> 7로 변경
					} else {
						foreach ($abstract_list as $list) {
							$ext = strtolower(end(explode(".", $list["abstract_file_name"])));
							$regist_text = "";
							if($list["registration_status"] == 1){
								$regist_text = "결제대기";
							}else if($list["registration_status"] == 2){
								$regist_text = "결제완료";
							}else if($list["registration_status"] == 3){
								$regist_text = "환불대기";
							}else if($list["registration_status"] == 4){
								$regist_text = "환불완료";
							}else if(!$list["registration_status"]){
								$regist_text = "미등록";
							}
					?>
							<tr class="tr_center">
								<td class="ellipsis"><input type="checkbox" class="etc1_check" value="<?= $list["submission_code"] ?>"/></td>
								<td class="ellipsis"><?= $list["submission_code"] ?></td>
								<td><?= $regist_text ?></td>
								<!-- <td><?= $list["registration_status"] == 2 ? 'Y' : 'N'?></td> -->
								<td><?= $list["etc1"] ?></td>
								<td><?= $list["etc2"] ?></td>
								<td><a href="./member_detail.php?idx=<?= $list["member_idx"] ?>"><?= $list["email"] ?></a></td>
								<td><?= $list["nation_ko"] ?></td>
								<td class="ellipsis"><?= $list["name"] ?></td>
								<td><a class="ellipsis" href="./abstract_application_detail3.php?idx=<?= $list["idx"] ?>&no=<?= $list['member_idx'] ?>"><?= strip_tags(htmlspecialchars_decode($list["title"])) ?></a>
								</td>
								<td class="ellipsis"><?= $list["register_date"] ?></td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<script>
	var html = '<?= $html ?>';

	const allCheckBtn = document.querySelector('.all_etc1_check');
	const checkList = document.querySelectorAll('.etc1_check');
	const allCheck = document.querySelector("#all_check");
	const checkboxes = document.querySelectorAll('input[type="checkbox"]');

	checkList.forEach((checkBox)=>{
		checkBox.dataset.id = ""
	})

	allCheck.addEventListener("change", ()=>{
		if(allCheck.checked){
			checkboxes.forEach((ck) => {
				ck.checked = true;
    		});
		}else{
			checkboxes.forEach((ck) => {
				ck.checked = false;
    		});
		}
	
	})

	allCheckBtn.addEventListener("click", () => {
    const checkList = [];
    
    // 모든 체크박스 요소를 선택합니다.

    // 체크박스 요소를 반복하면서 체크된 항목을 checkList 배열에 추가합니다.
    checkboxes.forEach((ck) => {
        if (ck.checked) {
            checkList.push(ck.value);
        }
    });

    if (window.confirm('선택한 초록을 일괄 심사 업데이트 하시겠습니까?')) {
        console.log(checkList);
        $.ajax({
            url: "https://imcvp.org/main/" + "ajax/client/ajax_submission2024.php",
            type: "POST",
            data: {
                flag: "all_check",
				'idx_list[]': checkList
            },
            dataType: "JSON",
            success: function(res) {
                if (res.code == 200) {
                    alert("초록 심사가 업데이트 되었습니다.");
                    window.location.reload(); 
                } else if (res.code == 400) {
                    alert("초록 심사 업데이트에 실패했습니다.");
                    return false;
                } else {
                    alert("초록 심사 업데이트에 실패했습니다.");
                    return false;
                }
            }
        });
    }
});
</script>
<script src="./js/common.js?v=0.15"></script>
<?php include_once('./include/footer.php'); ?>