<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	if($admin_permission["auth_account_member"] == 0){
		echo '<script>alert("권한이 없습니다.");history.back();</script>';
	}

	$id		= isset($_GET["id"])		? $_GET["id"]		: "";
	$name	= isset($_GET["name"])		? $_GET["name"]		: "";
	$phone	= isset($_GET["phone"])		? $_GET["phone"]	: "";
	$s_date = isset($_GET["s_date"])	? $_GET["s_date"]	: "";
	$e_date = isset($_GET["e_date"])	? $_GET["e_date"]	: "";
	$for_offline = ($_GET["for"] == "offline");
	//$for_offline = True;

	$where = "";

	if($id != ""){
		$where .= " AND m.email LIKE '%".$id."%' ";
	}

	if($name != ""){
		$where .= " AND CONCAT(m.first_name, ' ', m.last_name) LIKE '%".$name."%' ";
	}

	if($phone != ""){
		$where .= " AND m.phone LIKE '%".$phone."%' ";
	}

	if($s_date != ""){
		$where .= " AND DATE(m.regist_date) > '".$s_date."' ";
	}

	if($e_date != ""){
		$where .= " AND DATE(DATE_ADD(m.regist_date, INTERVAL 1 DAY)) LIKE < '".$e_date."' ";
	}

	$join_req_type = "LEFT";
	if ($for_offline) {
		$join_req_type = "INNER";
	}

	$select_member_list_query = "
									SELECT
										m.idx, 
										m.email, 
										m.nation_no, n.nation_en, 
										m.first_name, m.last_name, 
										m.first_name_kor, m.last_name_kor,
										m.phone, m.title, m.title_option,
										(
											CASE
												WHEN m.ksola_member_status = 0 THEN '비회원'
												WHEN m.ksola_member_status = 1 THEN '정회원'
												WHEN m.ksola_member_status = 2 THEN '평생회원'
												WHEN m.ksola_member_status = 3 THEN '인터넷회원'
												WHEN m.ksola_member_status IS NULL THEN '비회원'
											END
										)AS ksola_member_status,
										IF(m.telephone IS NULL, '-', m.telephone) AS telephone, 
										IF(m.affiliation IS NULL, '-', m.affiliation) AS affiliation, 
										IF(m.affiliation_kor IS NULL, '-', m.affiliation_kor) AS affiliation_kor, 
										IF(m.department IS NULL, '-', m.department) AS department, 
										IF(m.department_kor IS NULL, '-', m.department_kor) AS department_kor, 
										#IF(req.idx IS NULL, 'N', 'Y') AS printable_nametag_yn,
										IF(mb_idx IS NULL, 'N', 'Y') AS printable_nametag_yn,
										IFNUll(m.date_of_birth, '-') AS date_of_birth,
										DATE_FORMAT(m.register_date, '%y-%m-%d') AS regist_date
									FROM member m
									{$join_req_type} JOIN (
										SELECT
											rr.idx, rr.register
										FROM request_registration AS rr
										INNER JOIN payment AS pmt
											ON pmt.idx = rr.payment_no
										WHERE rr.`status` = 2 AND
                                              rr.is_deleted = 'N' AND
                                              pmt.payment_status = 2
									) AS req
										ON req.register = m.idx
									LEFT JOIN nation n
									ON m.nation_no = n.idx
									LEFT JOIN(
										SELECT
											mb_idx
										FROM score_second
									) AS s
									ON s.mb_idx = m.idx
									WHERE is_deleted = 'N'
									{$where}
									GROUP BY m.idx
									ORDER BY m.register_date DESC
								";
	$member_list = get_data($select_member_list_query);

	$html = '<table id="datatable" class="list_table">';
	$html .= '<thead>';
	$html .= '<tr class="tr_center">';
	$html .= '<th>No</th>';
	$html .= '<th>Date of Sign-up</th>';
	$html .= '<th>ID(Email)</th>';
	$html .= '<th>국내/국외</th>';
	$html .= '<th>Country(ENG)</th>';
	$html .= '<th>KSCP 회원 여부</th>';
	$html .= '<th>Name</th>';
	$html .= '<th>First Name</th>';
	$html .= '<th>Last Name</th>';
	$html .= '<th>성명(국문)</th>';
	$html .= '<th>Title</th>';
	$html .= '<th>Affiliation(Institution)</th>';
	$html .= '<th>소속</th>';
	$html .= '<th>Affiliation(Department)</th>';
	$html .= '<th>부서</th>';
	$html .= '<th>Phone Number</th>';
	$html .= '<th>Telephone Number</th>';
	$html .= '<th>Date of Birth</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	foreach($member_list as $mk => $ml){
		$nation_type = ($ml["nation_no"] == 25) ? "국내" : "국외";
		$name_kor = ($ml["nation_no"] == 25) ? $ml["last_name_kor"].$ml["first_name_kor"] : "-";

		if (!empty($ml['title_option'])) {
			switch($ml['title_option']) {
				case '0':
					$title_option_txt = "Professor";
				break;
				case '1':
					$title_option_txt = "Dr.";
				break;
				case '2':
					$title_option_txt = "Mr.";
				break;
				case '3':
					$title_option_txt = "Ms.";
				break;
				case '4':
					$title_option_txt = $ml['title'];
				break;
			}
		} else {
			$title_option_txt = "-";
		}

		$html .= '<tr class="tr_center">';
		$html .= '<td>'.($mk+1).'</td>';
		$html .= '<td>'.$ml["regist_date"].'</td>';
		$html .= '<td><a href="./member_detail.php?idx='.$ml["idx"].'">'.$ml["email"].'</a></td>';
		$html .= '<td>'.$nation_type.'</td>';
		$html .= '<td>'.$ml["nation_en"].'</td>';
		$html .= '<td>'.$ml["ksola_member_status"].'</td>';
		$html .= '<td>'.$ml["first_name"]." ".$ml["last_name"].'</td>';
		$html .= '<td>'.$ml["first_name"].'</td>';
		$html .= '<td>'.$ml["last_name"].'</td>';
		$html .= '<td>'.$name_kor.'</td>';
		$html .= '<td>'.$title_option_txt.'</td>';
		$html .= '<td>'.$ml["affiliation"].'</td>';
		$html .= '<td>'.$ml["affiliation_kor"].'</td>';
		$html .= '<td>'.$ml["department"].'</td>';
		$html .= '<td>'.$ml["department_kor"].'</td>';
		$html .= '<td>'.$ml["phone"].'</td>';
		$html .= '<td>'.$ml["telephone"].'</td>';
		$html .= '<td>'.$ml["date_of_birth"].'</td>';
		$html .= '</tr>';
	}
	$html .= '</tbody>';
	$html .= '</table>';

	$html = str_replace("'", "\'", $html);
	$html = str_replace(array("\r\n","\r","\n"),'',$html);
	$count = count($member_list);
?>
<style>
	.register_btn {float: right;}
	.excel_download_btn {float: right;margin-right: 10px;}
</style>
	<section class="list">
		<div class="container">
			<div class="title clearfix">
				<?php
					if ($for_offline) {
				?>
					<h1 class="font_title">일반 회원 (오프라인 회원만 보기)</h1>
					<button class="btn register_btn" onclick="javascript:window.open('./member_nametag.php?idx=all')">전체 네임택 보기</button>
				<?php
					} else {
						if($admin_permission["auth_account_member"] > 1){
				?>
					<h1 class="font_title">일반 회원</h1>
					<button class="btn register_btn" onclick="javascript:location.href='./member_detail.php'">회원 등록</button>
				<?php
						}
					}
				?>
				<button class="btn excel_download_btn" onclick="javascript:fnExcelReport('member_list', html);">엑셀 다운로드</button>
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
									<input type="text" name="id" value="<?=$id?>">
								</td>
								<th>Name</th>
								<td class="select_wrap clearfix2">
									<input type="text" name="name" value="<?=$name?>" data-type="string">
								</td>
							</tr>
							<tr>
								<th>Phone Number</th>
								<td>
									<input type="text" name="phone" value="<?=$phone?>" data-type="phone">
								</td>
								<th>등록일</th>
								<td class="input_wrap"><input type="text" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" name="s_date" value="<?=$s_date?>" data-type="date"> <span>~</span> <input type="text" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" name="e_date" value="<?=$e_date?>" data-type="date"></td>
							</tr>
						</tbody>
					</table>
				   <button type="button" class="btn search_btn">검색</button>
			   </form>
			</div>
			<div class="contwrap">
				<p class="total_num">총 <?=number_format($count)?>명</p>
				<table id="datatable" class="list_table">
					<thead>
					<!--
						<tr class="tr_center">
							<th>ID(Email)</th>
							<th>Country</th>
							<th>Name</th>
							<th>Phone Number</th>
							<th>Affiliation</th>
							<th>네임택</th>
							<th>등록일</th>
						</tr>
					-->
						<tr class="tr_center">
							<th>ID(Email)</th>
							<th>Country(Eng)</th>
							<th>KSCP 회원 여부</th>
							<th>Name</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>성명(국문)</th>
							<th>Affiliation(Institution)</th>
							<th>Phone Number</th>
							<th>Date of Sign-up</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if(!$member_list) {
							echo '<tr><td colspan="7">No member data</td></tr>';
						} else {
							foreach($member_list as $list) {
					?>
						<tr class="tr_center">
							<td><a href="./member_detail.php?idx=<?=$list["idx"]?>"><?=$list["email"]?></a></td>
							<td><?=$list["nation_en"]?></td>
							<td><?=$list["ksola_member_status"]?></td>
							<td><?=$list["first_name"]." ".$list["last_name"]?></td>
							<td><?=$list["first_name"]?></td>
							<td><?=$list["last_name"]?></td>
							<td><?=$list["last_name_kor"]."".$list["first_name_kor"]?></td> <!-- 국문 -->
							<td><?=$list["affiliation"]?></td>
							<td><?=$list["phone"]?></td>
							<td><?=$list["regist_date"]?></td>
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
<script src="./js/common.js"></script>
<script>
	var html = '<?=$html?>';
</script>
<?php include_once('./include/footer.php');?>
