<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	if($admin_permission["auth_apply_poster"] == 0){
		echo '<script>alert("권한이 없습니다.");history.back();</script>';
	}

	$id = $_GET["id"] ?? "";
	$name = $_GET["name"] ?? "";
	$title = $_GET["title"] ?? "";
	$s_date = $_GET["s_date"] ?? "";
	$e_date = $_GET["e_date"] ?? "";

	$where = "";
	
	if($id != "") {
		$where .= " AND ra.email LIKE '%".$id."%' ";
	}

	if($name != "") {
		$where .= " AND CONCAT(ra.first_name,' ',ra.last_name) LIKE '%".$name."%' ";
	}

	if($title != "") {
		$where .= " AND ra.abstract_title LIKE '%".$title."%' ";
	}

	if($s_date != "") {
		$where .= " AND DATE(ra.register_date) >= '".$s_date."' ";
	}

	if($e_date != "") {
		$where .= " AND DATE(ra.register_date) <= '".$e_date."' ";
	}

	$abstract_list_query =  "
								SELECT
                                    ra.submission_code, ra.idx AS abstract_idx, ra.abstract_title,
                                    DATE_FORMAT(ra.register_date, '%y-%m-%d') AS register_date, ra.oral_presentation,
                                    m.idx AS member_idx, m.email, m.name, m.nation_ko, m.nation_en, m.affiliation, m.department,
                                    f.original_name AS abstract_file_name, CONCAT(f.path,'/',f.save_name) AS path,
                                    c.title_en AS category,
                                    (
                                        CASE ra.presentation_type
                                            WHEN 0 THEN 'Oral Presentation'
                                            WHEN 1 THEN 'Poster Exhibition'
                                            WHEN 2 THEN 'Guided Poster Presentation'
                                            WHEN 3 THEN 'Any of Them'
                                            ELSE ''
                                            END
                                        ) AS presentation_type_text,
                                    (SELECT IF(presenting_author='N' AND corresponding_author='N','Co_author',
                                    IF(presenting_author='Y','Presenting Author', IF(corresponding_author='Y' ,'Corresponding Author', NULL)))) AS author_type,
                                    CONCAT(ra.first_name,' ',ra.last_name) AS ra_name, n.nation_en AS ra_country,
                                    ra.affiliation AS 'ra_affiliation', ra.email AS ra_email, ra.phone AS ra_phone,
                                    ra.presenting_author, ra.corresponding_author,
                                    IFNULL(ra.parent_author, ra.idx) AS parent_author
                                FROM request_abstract ra
                                         LEFT JOIN (
                                    SELECT
                                        m.idx, m.email, CONCAT(m.first_name,' ',m.last_name) AS name, 
                                        n.nation_ko AS nation_ko, n.nation_en AS nation_en, affiliation, department, is_deleted
                                    FROM member m
                                             JOIN nation n
                                                  ON m.nation_no = n.idx
                                ) AS m
                                                   ON ra.register = m.idx
                                         LEFT JOIN info_poster_abstract_category c
                                                   ON ra.abstract_category = c.idx
                                         LEFT JOIN file f
                                                   ON ra.abstract_file = f.idx
                                         LEFT JOIN nation n ON ra.nation_no=n.idx
                                WHERE ra.is_deleted = 'N'
                                  AND ra.parent_author IS NULL
                                  AND ra.`type` = 0
                                  AND m.is_deleted = 'N'
                                  {$where}
                                ORDER BY ra.register_date DESC
							";

    $request_abstract_list_query = "
                                SELECT
                                    (SELECT IF(presenting_author='N' AND corresponding_author='N','Co_author',
                                               IF(presenting_author='Y','Presenting Author', IF(corresponding_author='Y' ,'Corresponding Author', NULL)))) AS author_type,
                                    CONCAT(ra.first_name,' ',ra.last_name) AS ra_name, n.nation_en AS ra_country,
                                    ra.affiliation AS 'ra_affiliation', ra.email AS 'ra_email', ra.phone AS 'ra_phone',
                                    ra.presenting_author, ra.corresponding_author,
                                    IFNULL(ra.parent_author, ra.idx) AS parent_author
                                FROM request_abstract ra
                                         LEFT JOIN (
                                    SELECT
                                        m.idx, m.email, CONCAT(m.first_name,' ',m.last_name) AS name, n.nation_en AS nation, m.affiliation, m.department, is_deleted
                                    FROM member m
                                             JOIN nation n
                                                  ON m.nation_no = n.idx
                                ) AS m
                                                   ON ra.register = m.idx
                                         LEFT JOIN info_poster_abstract_category c
                                                   ON ra.abstract_category = c.idx
                                         LEFT JOIN file f
                                                   ON ra.abstract_file = f.idx
                                         LEFT JOIN nation n ON ra.nation_no=n.idx
                                WHERE ra.is_deleted = 'N'
                                  AND ra.`type` = 0
                                  AND m.is_deleted = 'N'
                                  AND ra.parent_author IS NOT NULL
                                ORDER BY ra.register_date DESC
                            ";

    $request_abstract_count_query = "
                                SELECT COUNT(IFNULL(parent_author, idx)) AS count
                                FROM request_abstract
                                WHERE is_deleted = 'N'
                                GROUP BY IFNULL(parent_author, idx)
                                ORDER BY count DESC
                                LIMIT 1                                 
                            ";

	$abstract_list = get_data($abstract_list_query);
    $request_abstract_list = get_data($request_abstract_list_query);
    $request_abstract_count = sql_fetch($request_abstract_count_query)['count'];

	// 엑셀 다운로드
	$html = '<table id="datatable" class="list_table">';
	$html .= '<thead>';
	$html .= '<tr class="tr_center">';
	$html .= '<th>NO</th>';
	$html .= '<th>Date of Submission</th>';
	$html .= '<th>Submission No.</th>';
	$html .= '<th>ID(Email)</th>';
	$html .= '<th>Country</th>';
	$html .= '<th>Name</th>';
    $html .= '<th>Affiliation (Institution)</th>';
    $html .= '<th>Affiliation (Department)</th>';
	$html .= '<th>Preferred Presentation Type</th>';
	$html .= '<th>Topic Category</th>';
	$html .= '<th>Title</th>';
	$html .= '<th>File</th>';
	$html .= '<th>Presenting Author Name</th>';
	$html .= '<th>Presenting Author Affiliation</th>';
	$html .= '<th>Presenting Author E-mail</th>';
	$html .= '<th>Corresponding Author Name</th>';
	$html .= '<th>Corresponding Author E-mail</th>';
    for($i=1;$i<=$request_abstract_count;$i++){
        $html .= '<th>Author No</th>';
        $html .= '<th>Author Type</th>';
        $html .= '<th>Name</th>';
        $html .= '<th>Country</th>';
        $html .= '<th>Affiliation (Department of Institution)</th>';
        $html .= '<th>E-mail</th>';
        $html .= '<th>Phone Number</th>';
    }
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';

    $presenting_author_name="";
    $presenting_author_email="";
    $corresponding_author_name="";
    $corresponding_author_email="";

    $resultData = [];

    foreach ($abstract_list as $num => $al) {
        $no = (int)$num+1;

        $al_ra_name = $al["ra_name"];
        $al_ra_email = $al["ra_email"];
        $al_ra_affiliation = $al["ra_affiliation"];

        $resultData[$no] = [
            'presenting_author_name' => null,
            'presenting_author_email' => null,
            'presenting_author_affiliation' => null,
            'corresponding_author_name' => null,
            'corresponding_author_email' => null,
        ];

        if($al["presenting_author"]==='Y') {
            $resultData[$no]['presenting_author_name'] = $al_ra_name;
            $resultData[$no]['presenting_author_email'] = $al_ra_email;
            $resultData[$no]['presenting_author_affiliation'] = $al_ra_affiliation;
        }

        if($al["corresponding_author"]==='Y'){
            $resultData[$no]['corresponding_author_name'] = $al_ra_name;
            $resultData[$no]['corresponding_author_email'] = $al_ra_email;
        }

        foreach ($request_abstract_list as $ral){

            $ral_ra_name = $ral["ra_name"];
            $ral_ra_email = $ral["ra_email"];
            $ral_ra_affiliation = $ral["ra_affiliation"];

            if($al["parent_author"]===$ral["parent_author"]){
                if($ral["presenting_author"]==='Y'){
                    $resultData[$no]['presenting_author_name'] = $ral_ra_name;
                    $resultData[$no]['presenting_author_email'] = $ral_ra_email;
                    $resultData[$no]['presenting_author_affiliation'] = $ral_ra_affiliation;
                }

                if($ral["corresponding_author"]==='Y'){
                    $resultData[$no]['corresponding_author_name'] = $ral_ra_name;
                    $resultData[$no]['corresponding_author_email'] = $ral_ra_email;
                }
            }
        }
    }

 	foreach($abstract_list as $num => $al){
        $no = (int)$num+1;
		$html .= '<tr class="tr_center">';
		$html .= '<td>'.$no.'</td>';
		$html .= '<td>'.$al["register_date"].'</td>';
		$html .= '<td>'.$al["submission_code"].'</td>';
		$html .= '<td>'.$al["email"].'</td>';
		$html .= '<td>'.$al["nation_en"].'</td>';
		$html .= '<td>'.$al["name"].'</td>';
		$html .= '<td>'.$al["affiliation"].'</td>';
		$html .= '<td>'.$al["department"].'</td>';
		$html .= '<td>'.$al["presentation_type_text"].'</td>';
		$html .= '<td>'.$al["category"].'</td>';
		$html .= '<td>'.$al["abstract_title"].'</td>';
		$html .= '<td>'.$al["abstract_file_name"].'</td>';

		$html .= '<td>'.$resultData[$no]['presenting_author_name'].'</td>';
		$html .= '<td>'.str_replace('★','<br>',$resultData[$no]["presenting_author_affiliation"]).'</td>';
		$html .= '<td>'.$resultData[$no]['presenting_author_email'].'</td>';
		$html .= '<td>'.$resultData[$no]['corresponding_author_name'].'</td>';
		$html .= '<td>'.$resultData[$no]['corresponding_author_email'].'</td>';

        $html .= '<td>'.'1'.'</td>';
        $html .= '<td>'.$al["author_type"].'</td>';
        $html .= '<td>'.$al["ra_name"].'</td>';
        $html .= '<td>'.$al["ra_country"].'</td>';
        $html .= '<td>'.str_replace('★','<br>',$al["ra_affiliation"]).'</td>';
        $html .= '<td>'.$al["ra_email"].'</td>';
        $html .= '<td>'.$al["ra_phone"].'</td>';

        $ra_author_No=2;

        foreach ($request_abstract_list as $ral){
            if($al["parent_author"]===$ral["parent_author"]){
                $html .= '<td>'.$ra_author_No.'</td>';
                $html .= '<td>'.$ral["author_type"].'</td>';
                $html .= '<td>'.$ral["ra_name"].'</td>';
                $html .= '<td>'.$ral["ra_country"].'</td>';
                $html .= '<td>'.str_replace('★','<br>',$ral["ra_affiliation"]).'</td>';
                $html .= '<td>'.$ral["ra_email"].'</td>';
                $html .= '<td>'.$ral["ra_phone"].'</td>';
                ++$ra_author_No;
            }
        }
        $html .= '</tr>';
	}
	$html .= '</tbody>';
	$html .= '</table>';

	$html = str_replace("'", "\'", $html);
	$html = str_replace("\n", "", $html);
	$count= count($abstract_list);
?>
	<section class="list">
		<div class="container">
			<div class="title clearfix">
				<h1 class="font_title">Poster Abstract Submission</h1>
                <button class="btn excel_download_btn" onclick="javascript:fnExcelReport('Poster Abstract Submission', html);">엑셀 다운로드</button>
                <button class="btn excel_download_btn" onclick="javascript:window.location.href='/main/common/lib/zipArchive.php'">전체 파일 다운로드</button>
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
									<input type="text" name="title" data-type="string" value="<?= $title; ?>">
								</td>
								<th>등록일</th>
								<td class="input_wrap"><input type="text" name="s_date" value="<?= $s_date; ?>" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" data-type="date"> <span>~</span> <input type="text" value="<?= $e_date; ?>" name="e_date" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" data-type="date"></td>
							</tr>
						</tbody>
					</table>
					<button type="button" class="btn search_btn">검색</button>
				</form>
			</div>
			<div class="contwrap">
				<p class="total_num">총 <?=number_format($count)?>개</p>
				<table id="datatable" class="list_table">
					<thead>
						<tr class="tr_center">
							<th>논문번호</th>
							<th>ID(Email)</th>
							<th>Country</th>
							<th>Name</th>
							<th>Title</th>
							<th>파일명</th>
							<th>카테고리</th>
							<th>Preferred Presentation Type</th>
							<!-- <th>oral</th>
							<th>좋아요수 / 댓글수</th> -->
							<th>등록일</th>
							<th>삭제</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if(!$abstract_list) {
							echo "<tr><td class='no_data' colspan='9'>No Data</td></tr>"; //좋아요 및 댓글기능 미개발로 colspan 8 -> 7로 변경
						} else {
							foreach($abstract_list as $list) {
								$ext = strtolower(end(explode(".",$list["abstract_file_name"])));
					?>
						<tr class="tr_center">
							<td><?=$list["submission_code"]?></td>
							<td><a href="./member_detail.php?idx=<?=$list["member_idx"]?>"><?=$list["email"]?></a></td>
							<td><?=$list["nation_ko"]?></td>
							<td><?=$list["name"]?></td>
							<td><a href="./abstract_application_detail.php?idx=<?=$list["abstract_idx"]?>"><?=$list["abstract_title"]?></a></td>
						<?php if($ext === "pdf") { ?>
							<td><a href="./pdf_viewer.php?path=<?=$list["path"]?>" target="_blank"><?=$list["abstract_file_name"]?></a></td>
						<?php } else { ?>
							<td><a href="<?=$list["path"]?>" download="<?=$list["submission_code"]?>"><?=$list["abstract_file_name"]?></a></td>
						<?php } ?>
							<td><?=$list["category"]?></td>
							<td><?=$list["presentation_type_text"]?></td>
							<!-- <td><?=$list["oral_presentation"] == 0 ? "No" : "Yes"?></td>
							<td>13 / 32</td> -->
							<td><?=$list["register_date"]?></td>
							<td><a href="javascript:;" onclick="delete_submission('<?=$list["abstract_idx"]?>')">삭제</a></td>
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
	var html = '<?=$html?>';

	function delete_submission(idx) {
		if(confirm("초록을 삭제하시겠습니까?")) {
			$.ajax({
				url : "/main/ajax/client/ajax_submission.php",
				type : "POST",
				data : {
					flag : "submission_delete",
					idx : idx
				},
				dataType : "JSON",
				success : function(res){
					if(res.code == 200) {
						alert("초록 삭제가 완료되었습니다.");
						location.reload();
					} else if(res.code == 400) {
						alert("초록 삭제에 실패하였습니다.");
						return false;
					} else {
						alert("일시적으로 요청이 거절되었습니다.");
						return false;
					}
				}
			});
		}
	}
</script>
<script src="./js/common.js?v=0.1"></script>
<?php include_once('./include/footer.php');?>