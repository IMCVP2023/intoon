<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php
    $user_idx = $member["idx"] ?? -1;
	
	// [22.04.25] 미로그인시 처리
	if($user_idx <= 0) {
		echo "<script>alert('Need to login'); location.replace(PATH+'login.php');</script>";
		exit;
	}
    
    $my_submission_list_query = " 
                                SELECT
                                        ra.idx, ra.submission_code, DATE_FORMAT(ra.register_date, '%Y-%m-%d') AS regist_date, `type`,
                                        (CASE
                                            WHEN `type` = 0
                                            THEN abstract_title
                                            WHEN `type` = 1
                                            THEN cv.original_name
                                            ELSE ''
                                        END) AS title, 
                                        (CASE
                                            WHEN `type` = 0
                                            THEN 'Abstract'
                                            WHEN `type` = 1
                                            THEN 'Lecture'
                                            ELSE ''
                                        END) AS `type_name`,
                                        (CASE
                                            WHEN ra.is_presentation = '0'
                                            THEN 'In Process'
                                            WHEN ra.is_presentation = '1'
                                            THEN 'Completed'
                                            ELSE '-'
                                        END) AS status,
										lecture.original_name AS lecture_file_name, CONCAT(lecture.path,'/',lecture.save_name) AS lecture_path,
										cv.original_name AS cv_file_name, CONCAT(cv.path,'/',cv.save_name) AS cv_path
                                    FROM request_abstract as ra
									LEFT JOIN file lecture
										ON ra.notice_file = lecture.idx
									LEFT JOIN file cv
										ON ra.cv_file = cv.idx
										WHERE ra.is_deleted = 'N'
                                        AND ra.register = {$user_idx}
										AND ra.parent_author IS NULL
										ORDER BY ra.register_date DESC;";

    $submission_list = get_data($my_submission_list_query);

	$total_count = count($submission_list);
	$write_page = 10;
	$write_row = 20;
	$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
	$total_page = ceil($total_count / $write_row);
	$url = $_SERVER['REQUEST_URI'];
	
	$paging_admin = get_paging_arrow($write_row, $write_page, $cur_page, $total_count, $total_page, $url, $add);

	$paging_html = $paging_admin['html'];

	$start_row = $paging_admin['start_row'];
	$end_row = $paging_admin['end_row'];


	$sql_during =	"SELECT
						IF(DATE(NOW()) >= '2022-09-12', 'Y', 'N') AS yn
					FROM info_event";
	$during_yn = sql_fetch($sql_during)['yn'];

	$only_sql = "SELECT
					MAX(rr.idx) AS idx
				FROM request_registration AS rr
				LEFT JOIN member AS mb
					ON mb.idx = rr.register
				LEFT JOIN payment AS pa
					ON pa.idx = rr.payment_no
				WHERE rr.register = {$user_idx}
				AND rr.is_deleted = 'N'
				AND rr.`status` = 2
				GROUP BY rr.idx";

	$only_idx = sql_fetch($only_sql)['idx'];

	$score_sql = "SELECT
						*
					FROM score_second
					WHERE mb_idx = '{$user_idx}'";

	$score_detail = sql_fetch($score_sql);
			
	// abstract_category
	$info_poster_abstract_category_sql = "SELECT 
												idx, title_en, title_ko
											FROM info_poster_abstract_category
											WHERE is_deleted = 'N'";
	$info_poster_abstract_category_data = get_data($info_poster_abstract_category_sql);
	$poster_category_map = [];

	foreach($info_poster_abstract_category_data as $obj) {
		$poster_category_map[$obj["idx"]] = $obj["title_en"];
	}

	// toffic
	$presentation_type_arr = array("Oral Presentation", "Poster Exhibition", "Guided Poster Presentation");

	// Position
	$position_arr = array("Professor", "Physician", "Researcher", "Student", "Other");

	// nation
	$nation_query = "SELECT *
					FROM nation";
	$nation_list = get_data($nation_query);
	$nation_map = [];

	foreach($nation_list as $obj) {
		$nation_map[$obj["idx"]] = $obj["nation_en"];
	}
?>

<section class="container mypage">
    <h1 class="page_title">Mypage</h1>
	<ul class="tab_green">
		<li><a href="./mypage.php">Account</a></li>
		<li><a href="./mypage_registration.php">Registration</a></li>
		<li class="on"><a href="./mypage_abstract.php">Abstract</a></li>
		<?php
			//if($during_yn == 'N') {
		?>
			<!-- <li class="text_center"><a href="javascript:;" onclick="javascript:alert('행사 종료 후 9월 12일(월)부터 확인 가능합니다.');">평점 확인 (Korean Only)</a></li> -->
			<!-- <li class="text_center"><a href="javascript:;" onclick="javascript:alert('행사 종료 후 9월 12일(월)부터 확인 가능합니다.');">Certification of Completion</a></li> -->
		<?php
			//}
			//if(!empty($score_detail)) {
		?>
			<!-- <li class="text_center"><a href="./mypage_score.php">평점 확인 (Korean Only)</a></li> -->
		<?php
			//}
			//if(!empty($only_idx)) {
		?>
			<!-- <li class="text_center"><a href="./mypage_certification.php">Certification of Completion</a></li> -->
		<?php
			//} 
		?>
	</ul>
	<div class="inner">
		<div class="section section1">
			<div class="table_wrap x_scroll">
				<table class="table_vertical registration_table">
					<thead>
						<tr class="centerT">
                            <th>No.</th>
							<th>Submission No.</th>
							<th>Title</th>
							<th>Status</th>
							<th>Date of Submission</th>
							<th>Modify / Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($submission_list as $i => $submission) { ?>
						<tr>
                            <td><?= $i+1 ?></td>
							<td><?= $submission["submission_code"] ?></td>
							<td>
								<a href="javascript:;" class="text_center underline"><?= $submission["title"] ?></a>
							</td>
							<td><?= $submission["status"] ?></td>
							<td><?= $regist_date ?></td>
							<td data-idx="<?= $submission["idx"] ?>">
								<button type="button" class="btn review_regi_open">Review</button>
								<button type="button" class="btn modify_btn">Modify</button>
								<button type="button" class="btn delete_btn">Delete</button>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="pagination">
				<!-- <ul class="clearfix"> -->
				<!-- 	<li><a href=""><img src="./img/icons/arrows_left.png"></a></li> -->
				<!-- 	<li class="on"><a href="">1</a></li> -->
				<!-- 	<li><a href="">2</a></li> -->
				<!-- 	<li><a href="">3</a></li> -->
				<!-- 	<li><a href="">4</a></li> -->
				<!-- 	<li><a href=""><img src="./img/icons/arrows_right.png"></a></li> -->
				<!-- </ul> -->
				<!-- <?= $paging_html; ?> -->
			</div>
			<div class="centerT">
				<button class="btn green_btn long" onclick="javascript:window.location.href='./abstract_submission.php';">Make a new submission</button>
			</div>
		</div> 
	</div>
</section>

<!-- 교육이수내역(사후생성) 팝업 from ICOLA :: 22.04.01 HUBDNC LJH2 추가 -->
<div class="popup mp_pop pop_education">
	<div class="pop_bg"></div>
	<div class="pop_contents">
		<h1 class="pop_title clearfix">
			<span>
				<!-- <?=$_SESSION["USER"]["first_name"]." ".$_SESSION["USER"]["last_name"]?> 님 -->
				<!--(<span><?=$_SESSION["USER"]["affiliation"]?></span>)-->
				JIHYE LEE
			</span>
			<img class="pop_close pointer floatR" src="./img/icons/icon_x.png" alt="아이콘_x">
		</h1>
		<div class="pop_cont">
			<div class="alert">
				<!--
				<p class="point_txt">For Korean Participant Only</p>
				<p class="bold_txt">각 협회 및 기관 평점 인정 기준에 따라, 각 세션마다 출결 시간 기록이 필요합니다.</p>
				-->
				<p class="font_thin">
					· 오프라인 출결확인은 현장 QR태그를 통해 확인 가능하며, 학회 종료 이후 현 My Page에서 확인 가능합니다.<br/>
					· Entrance Time / Exit Time은 입출입 시간으로 표기 되며, 최종 이수 평점은 브레이크 시간 및 기타 시간은 자동 제외 되어 계산 됩니다.<br>
					· 현 페이지의 기록 및 평점 내용은 현장 방송 사정에 따라 상이 할 수 있습니다.<br>
					· 학회 종료 후 최종 이수평점 확인은 SMS 문자 안내드릴 예정이며, 현 My Page에서도 확인 가능합니다.
				</p>
			</div>
			<div>
				<ul class="tab_pager">
					<?php
						for($i=0;$i<$_PERIOD_COUNT;$i++){
							$class_on = $i==0 ? "on" : "";
							$ymd = date_create($_PERIOD[$i]);
					?>
					<li class="<?=$class_on?>">
						<a href="javascript:;">
							<?php
								echo check_device() ? date_format($ymd, "M. j(D)")."<br>".date_format($ymd, "Y") : date_format($ymd, "M. j(D) Y");
							?>
						</a>
					</li>
					<?php
						}
					?>
					<li class="on"><a href="javascript:;">Sep. 15(Thu)<br>2022</a></li>
					<li><a href="javascript:;">Sep. 16(Fri)<br>2022</a></li>
					<li><a href="javascript:;">Sep. 15(Thu)<br>2022</a></li>
				</ul>
				<div class="tab_wrap">
					<?php
						for($i=0;$i<$_PERIOD_COUNT;$i++){
							$class_on = $i==0 ? "on" : "";
							$ymd = $_PERIOD[$i];
							$daily_watch_time_min = 0;
					?>
					<div class="tab_cont on <?=$class_on?>">
						<div class="x_scroll">
							<table class="table color_table">
								<colgroup>
									<col style="width: 40%;">
									<col style="width: 40%;">
									<col style="width: 20%;">
								</colgroup>
								<thead>
									<tr>
										<th>Entrance Time</th>
										<th>Exit Time</th>
										<th>Watch Time</th>
									</tr>
								</thead>
								<tbody name="lecs">
									<tr class="text_center"><td colspan="4">No Data</td></tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="x_scroll">
							<table class="custom_table">
								<colgroup>
									<col class="custom_col"/>
									<col width="*"/>
									<col class="custom_col"/>
								</colgroup>
								<tr>
									<th>Daily Watch Time</th>
									<td name="total_watch_time"> h</td>
									<td></td>
								</tr>
							</table>
						</div>
						<div class="x_scroll">
							<table class="table table_bt mb_custom_table">
								<colgroup>
									<col class="custom_col"/>
									<col width="*"/>
									<col class="custom_col"/>
								</colgroup>
								<thead>
									<tr>
										<th></th>
										<th>오늘 이수 평점</th>
										<th>현재까지 이수 총평점</th>
									</tr>
								</thead>
								<tbody name="score">
									<tr>
										<th></th>
										<td> 점</td>
										<td> 점</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<?php
						}
					?>
					<!-- 화면노출 확인용 마크업 / 시작 -->
					<div class="tab_cont on <?=$class_on?>">
						<div class="x_scroll">
							<table class="table color_table">
								<colgroup>
									<col style="width: 40%;">
									<col style="width: 40%;">
									<col style="width: 20%;">
								</colgroup>
								<thead>
									<tr>
										<th>Entrance Time</th>
										<th>Exit Time</th>
										<th>Watch Time</th>
									</tr>
								</thead>
								<tbody name="lecs">
									<tr class="text_center"><td colspan="3">No Data</td></tr>
									<tr>
										<td>2022-09-15 14:36:00</td>
										<td>2022-09-15 20:36:00</td>
										<td>02:31 h</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="x_scroll">
							<table class="custom_table">
								<colgroup>
									<col class="custom_col"/>
									<col width="*"/>
									<col class="custom_col"/>
								</colgroup>
								<tr>
									<th>Daily Watch Time</th>
									<td name="total_watch_time">02:31 h</td>
									<td></td>
								</tr>
							</table>
						</div>
						<div class="x_scroll">
							<table class="table table_bt mb_custom_table">
								<colgroup>
									<col class="custom_col"/>
									<col width="*"/>
									<col class="custom_col"/>
								</colgroup>
								<thead>
									<tr>
										<th></th>
										<th>오늘 이수 평점</th>
										<th>현재까지 이수 총평점</th>
									</tr>
								</thead>
								<tbody name="score">
									<tr>
										<th>대한의사협회</th>
										<td>0 점</td>
										<td>12 점</td>
									</tr>
									<tr>
										<th>대한지질동맥경화학회</th>
										<td>2 점</td>
										<td>14 점</td>
									</tr>
									<tr>
										<th>한국영양교육평가원<br>임상영양사 전문연수교육<br>(CPD)</th>
										<td>2 점</td>
										<td>5 점</td>
									</tr>
									<tr>
										<th>대한운동사협회</th>
										<td>6 점</td>
										<td>40 점</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- 화면노출 확인용 마크업 / 끝 -->
				</div>
				<div class="text_center">
					<button type="button" class="btn">교육이수증 받기</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 교육이수내역(사후생성) 팝업 from ICOLA :: 끝 -->

<div class="popup online_regi_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
            <input type="hidden" name="registration_idx" value="">
            <h3 class="pop_title">Online Registration</h3>
            <div class="table_wrap detail_table_common x_scroll">
				<table class="c_table detail_table fixed_table">
					<colgroup>
						<col width="150px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>ID(email)</th>
							<td>bancya@naver.com</td>
						</tr>
						<tr>
							<th>Name</th>
							<td>ban hyeonjeong</td>
						</tr>
						<tr>
							<th>Country</th>
							<td>Korea</td>
						</tr>
						<tr>
							<th>Member Type</th>
							<td>Others(기타)</td>
						</tr>
					</tbody>
				</table>
			</div>
            <div class="table_wrap detail_table_common x_scroll mt10">
				<table class="c_table detail_table fixed_table">
					<colgroup>
						<col width="150px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>Attendance Type</th>
							<td>General Participants</td>
						</tr>
						<tr>
							<th>Registration Type</th>
							<td>on-site</td>
						</tr>
						<tr>
							<th>Registration Fee</th>
							<td>100,000 KRW</td>
						</tr>
					</tbody>
				</table>
			</div>
            <div class="btn_wrap">
                <button type="button" class="btn update_btn pop_save_btn">Save</button>
            </div>
        </div>
    </div>

	<div class="popup review_regi_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
            <input type="hidden" name="registration_idx" value="">
            <h3 class="pop_title">Review of Submission</h3>
			<!-- Presenting Author -->
			<div class="pop_title_wrap">
				<h4>Author Information</h4>
				<p id="presenting_author_title">Presenting Author</p>
			</div>
            <div class="table_wrap x_scroll" id="presenting_author"></div>

			<!-- Corresponding Author -->
			<div class="pop_title_wrap">
				<p id="corresponding_author_title">Corresponding Author</p>
			</div>
            <div class="table_wrap x_scroll" id="corresponding_author"></div>

			<!-- Author Template -->
			<template id="author_template">
				<table class="c_table detail_table fixed_table mt10 detail_table_common" style="min-width:400px;">
					<colgroup>
						<col>
						<col>
						<col width="100px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>Name</th>
							<td><span id="first_name"></span> <span id="last_name"></span></td>
							<th>Country</th>
							<td id="nation"></td>
						</tr>
						<tr>
							<th>Affiliation</th>
							<td colspan="3" id="affiliation"></td>
						</tr>
						<tr>
							<th>E-mail</th>
							<td colspan="3">
								<a href="mailto:icomes@into-on.com" class="link" id="email"></a>
							</td>
						</tr>
						<tr>
							<th class="initial">Phone Number</th>
							<td colspan="3"><span id="co_nation_tel"></span><span id="phone"></span></td>
						</tr>
					</tbody>
				</table>
			</template>

			<!-- Abstract Submission Status -->
			<div class="pop_title_wrap">
				<p>Abstract Submission Status</p>
			</div>
            <div class="table_wrap detail_table_common x_scroll mt10">
				<table class="c_table detail_table fixed_table" style="min-width:400px;">
					<colgroup>
						<col>
						<col>
						<col width="100px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th class="initial">Submission No.</th>
							<td colspan="3" id="submission_code"></td>
						</tr>
						<tr>
							<th class="initial">Type of Presentation</th>
							<td colspan="3" id="presentation_type"></td>
						</tr>
						<tr>
							<th class="initial">Topic Category</th>
							<td colspan="3"><span id="abstract_category"></span> <span id="abstract_category_text"><span></td>
						</tr>
						<tr>
							<th>Abstract Title</th>
							<td colspan="3" id="abstract_title"></td>
						</tr>
						<tr>
							<th>Abstract File</th>
							<td colspan="3">
								<a href="javascript:;" class="link" id="file"></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
            <div class="btn_wrap">
                <button type="button" class="btn pop_close" style="position:static; width:auto; height:auto; padding:8px 30px;">Cancel</button>
            </div>
        </div>
    </div>

    <div class="popup revise_pop">
        <div class="pop_bg"></div>
        <div class="pop_contents">
            <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
            <input type="hidden" name="registration_idx" value="">
            <h3 class="pop_title">Participant Information</h3>
            <div class="table_wrap form_table">
                <form name="registration_form">
					<table class="c_table2 detail_table">
						<tbody>
							<tr>
								<th><?=$locale("id")?> *</th>
								<td><input type="text" name="email" readonly></td>
							</tr>
							<tr>
								<th><?=$locale("country")?> *</th>
								<td>
									<select class="update" name="nation_no">
										<option selected disabled>Choose </option>
									<?php
										foreach($nation_list as $list){
											$nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
											echo "<option value='".$list["idx"]."'>".$nation."</option>";
										}
									?>
									</select>
								</td>
							</tr>
							<tr>
								<th><?=$locale("first_name")?> *</th>
								<td><input type="text" name="first_name" value="Jihye" readonly></td>
							</tr>
							<tr>
								<th><?=$locale("last_name")?> *</th>
								<td><input type="text" name="last_name" value="Lee" readonly></td>
							</tr>
							<tr>
								<th><?=$locale("phone")?> *</th>
								<td>
									<div class="phone_div clearfix2">
										<select name="nation_tel"> 
											<option selected disabled></option>
										</select>
										<input type="text" name="phone" placeholder="010-1234-1234" readonly></td>
									</div>
								</td>
							</tr>
							<tr>
								<th><?=$locale("affiliation")?></th>
								<td><input class="update" type="text" name="affiliation"></td>
							</tr>
							<tr>
								<th><?=$locale("department")?></th>
								<td><input class="update" type="text" name="department"></td>
							</tr>
							<tr>
								<th>평점신청(Korean Only) * <br><span class="is_scroe_txt red_txt">(Overseas participants, please check '미신청').</th>
								<td class="banquet_style">
									<input type="radio" class="radio" id="applied" name="rating" value="1"><label class="banquet_label" for="applied">신청</label>
									<input type="radio" class="radio" id="not_applied" name="rating" value="0"><label for="not_applied">미신청</label>
								</td>
							</tr>
							<tr class="org tab_contents">
								<th><?php echo $locale("applied_org")?></th>
								<td>
									<input type="checkbox" class="checkbox org_01" id="checkbox1" name="org" value="1"><label for="checkbox1"><?php echo $locale("applied_org1")?></label></br>
									<input type="checkbox" class="checkbox registration_check org_03" id="checkbox3" name="org" value="3"><label for="checkbox3"><?php echo $locale("applied_org3")?></label></br>
									<input type="checkbox" class="checkbox registration_check org_04" id="checkbox4" name="org" value="4"><label for="checkbox4"><?php echo $locale("applied_org4")?></label></br>
								</td>
							</tr>
							<tr>
								<th>Licence Number *</th>
								<td>
									<div class="text_l mb10">
										<input type="checkbox" class="checkbox" id="license_checkbox" name="license_checkbox">
										<label class="tight" for="license_checkbox"><i>Not applicable</i></label>
									</div>
									<input class="update" type="text" name="licence_number">
								</td>
							</tr>
							<tr>
								<th>KSSO Member Status *</th>
								<td class="banquet_style">
									<input type="radio" class="radio" id="member" name="member_status" value="1">
									<label for="member" class="banquet_label"><?=$locale("member_status_select1")?></label>
									<input type="radio" class="radio" id="non_member" name="member_status" value="0">
									<label for="non_member"><?=$locale("member_status_select2")?></label>
								</td>
							</tr>
							<!-- <tr> -->
							<!-- 	<th>KSSO Academy number *</th> -->
							<!-- 	<td><input class="update" type="text" name="academy_number"></td> -->
							<!-- </tr> -->
							<!-- <tr> -->
							<!-- 	<th>Congress Banquet Ceremony *</th> -->
							<!-- 	<td class="banquet_style"> -->
							<!-- 		<input type="radio" class="radio" id="banquet1" name="banquet_yn" value="Y"><label class="banquet_label" for="banquet1">Attend</label> -->
							<!-- 		<input type="radio" class="radio" id="banquet2" name="banquet_yn" value="N"><label for="banquet2">Absent</label> -->
							<!-- 	</td> -->
							<!-- </tr> -->				
						</tbody>   
                    </table>
                </form>
            </div>
            <div class="btn_wrap">
                <button type="button" class="btn update_btn pop_save_btn"><?=$locale("save_btn")?></button>
            </div>
        </div>
    </div>


<script>
	$(document).ready(function(){
		$(".delete_btn").on("click", function(){
			const idx = $(this).parent().data("idx");
			if(confirm(locale(language.value)("submission_cancel_msg"))) {
				$.ajax({
					url : PATH+"ajax/client/ajax_submission.php",
					type : "POST",
					data : {
						flag : "submission_delete",
						idx : idx
					},
					dataType : "JSON",
					success : function(res){
						if(res.code == 200) {
							alert(locale(language.value)("complet_submission_cancel"));
							location.reload();
						} else if(res.code == 400) {
							alert(locale(language.value)("error_submission_cancel"));
							return false;
						} else {
							alert(locale(language.value("reject_msg")));
							return false;
						}
					}
				});
			}
		});
		
		$(".modify_btn").on("click", function(){
			const idx = $(this).parent().data("idx");
			window.location.href="./abstract_submission.php?idx="+idx;
		})

		$(".review_regi_open").click(function(){
			const idx = $(this).parent().data("idx");

			$.ajax({
				url : PATH+"ajax/client/ajax_submission_author.php",
				type : "POST",
				data : {idx : idx},
				dataType : "JSON",
				success : function(res){
					if(res.code == 200) {
						setReviewPop(res.data);
						$(".review_regi_pop").show();
					} else {
						alert(locale(language.value("reject_msg")));
						return false;
					}
				}
			});
		});
	});

	$(".korean_only").on("click", function(){
		var url = "./pre_registration_korean_only.php";
		window.open(url,"Registration Receipt","width=793, height=2000, top=30, left=30");
	});

	function setReviewPop(data) {
		const submit_data = data.submit_data;
		const presenting_author_data = data.presenting_author_data ?? [];
		const corresponding_author_data = data.corresponding_author_data ?? [];

		if(presenting_author_data.length < 1) {
			console.log();
			$("#presenting_author_title").remove();
		}

		if(corresponding_author_data.length < 1) {
			$("#corresponding_author_title").remove();
		}
	}
</script>

<?php include_once('./include/footer.php');?>