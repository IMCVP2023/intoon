<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$lecture_idx = $_GET["idx"];

	if($lecture_idx) {
		 $select_lecture_detail_query = "
											SELECT
												ra.idx, 
												ra.presentation_type, 
												ra.cv,
												f_cv.original_name AS file_name_cv,
												f_abf.original_name AS file_name_abf,
												f_lvf.original_name AS file_name_lvf
												#f_caf.original_name AS file_name_f_caf
											FROM request_abstract ra
											LEFT JOIN file f_cv
												ON ra.cv_file = f_cv.idx
											LEFT JOIN file f_abf
												ON ra.notice_file = f_abf.idx
											LEFT JOIN file f_lvf
												ON ra.lecture_video_file = f_lvf.idx
											LEFT JOIN file f_caf
												ON ra.copyright_agreement_file = f_caf.idx
											WHERE ra.idx = {$lecture_idx}
										";

		$lecture_detail = sql_fetch($select_lecture_detail_query);

		$presentation_type = isset($lecture_detail["presentation_type"]) ? $lecture_detail["presentation_type"] : "";

		$cv = isset($lecture_detail["cv"]) ? $lecture_detail["cv"] : "";
		$file_name_cv = isset($lecture_detail["file_name_cv"]) ? $lecture_detail["file_name_cv"] : "";
		$file_name_abf = isset($lecture_detail["file_name_abf"]) ? $lecture_detail["file_name_abf"] : "";
		$file_name_lvf = isset($lecture_detail["file_name_lvf"]) ? $lecture_detail["file_name_lvf"] : "";
		//$file_name_f_caf = isset($lecture_detail["file_name_f_caf"]) ? $lecture_detail["file_name_f_caf"] : "";
	}

	echo "<script>var type='lecture'; </script>";

	//국가정보 가져오기
	$nation_list_query = $_nation_query;
	$nation_list = get_data($nation_list_query);
	
	//세션에 저장된 논문 제출 데이터 (step2에서 step1으로 되돌아올시)
	$submit_data = isset($_SESSION["lecture"]["data"]) ? $_SESSION["lecture"]["data"] : "";
	//$co_submit_data1 = isset($_SESSION["lecture"]["co_data1"]) ? $_SESSION["lecture"]["co_data1"] : "";
	//$co_submit_data2 = isset($_SESSION["lecture"]["co_data2"]) ? $_SESSION["lecture"]["co_data2"] : "";

	$data_count = count($_SESSION["lecture"]);

	//초기 작성 시 연락처 쪼깨기
	if($submit_data == "") {
		$_arr_phone = explode("-",$user_info["phone"]);
		$nation_tel = $_arr_phone[0];
		$phone = implode("-",array_splice($_arr_phone, 1));
	}

	//데이터(초기 세팅 및 이전으로 돌아왔을때 입력값 세팅)
	$nation_no = !empty($submit_data) ? $submit_data["nation_no"] : $user_info["nation_no"];
	$city = !empty($submit_data) ? $submit_data["city"] : "";
	$state = !empty($submit_data) ? $submit_data["state"] : "";
	$first_name = !empty($submit_data) ? $submit_data["first_name"] : $user_info["first_name"];
	$last_name = !empty($submit_data) ? $submit_data["last_name"] : $user_info["last_name"];
	$affiliation = !empty($submit_data) ? $submit_data["affiliation"] : $user_info["affiliation"];
	$email = !empty($submit_data) ? $submit_data["email"] : $user_info["email"];
	$nation_tel = !empty($submit_data) ? $submit_data["nation_tel"] : $nation_tel;
	$phone = !empty($submit_data) ? $submit_data["phone"] : $phone;

	//$co_nation_no1 = !empty($co_submit_data1) ? $co_submit_data1["co_nation_no1"] : "";
	//$co_city1 = !empty($co_submit_data1) ? $co_submit_data1["co_city1"] : "";
	//$co_state1 = !empty($co_submit_data1) ? $co_submit_data1["co_state1"] : "";
	//$co_first_name1 = !empty($co_submit_data1) ? $co_submit_data1["co_first_name1"] : "";
	//$co_last_name1 = !empty($co_submit_data1) ? $co_submit_data1["co_last_name1"] : "";
	//$co_affiliation1 = !empty($co_submit_data1) ? $co_submit_data1["co_affiliation1"] : "";
	//$co_email1 = !empty($co_submit_data1) ? $co_submit_data1["co_email1"] : "";
	//$co_nation_tel1 = !empty($co_submit_data1) ? $co_submit_data1["co_nation_tel1"] : "";
	//$co_phone1 = !empty($co_submit_data1) ? $co_submit_data1["co_phone1"] : "";

	//$co_nation_no2 = !empty($co_submit_data2) ? $co_submit_data2["co_nation_no2"] : "";
	//$co_city2 = !empty($co_submit_data2) ? $co_submit_data2["co_city2"] : "";
	//$co_state2 = !empty($co_submit_data2) ? $co_submit_data2["co_state2"] : "";
	//$co_first_name2 = !empty($co_submit_data2) ? $co_submit_data2["co_first_name2"] : "";
	//$co_last_name2 = !empty($co_submit_data2) ? $co_submit_data2["co_last_name2"] : "";
	//$co_affiliation2 = !empty($co_submit_data2) ? $co_submit_data2["co_affiliation2"] : "";
	//$co_email2 = !empty($co_submit_data2) ? $co_submit_data2["co_email2"] : "";
	//$co_nation_tel2 = !empty($co_submit_data2) ? $co_submit_data2["co_nation_tel2"] : "";
	//$co_phone2 = !empty($co_submit_data2) ? $co_submit_data2["co_phone2"] : "";
	
	//국가 정보 append를 위해 js변수로 변환
	if(!empty($nation_list)) {	
		echo "<script> var nation = []; ";
		foreach($nation_list AS $list) {
			$idx = $list["idx"];
			$nation_ko = $list["nation_ko"];
			$nation_en = $list["nation_en"];

			echo "nation.push({idx : {$idx}, nation_ko : '{$nation_ko}', nation_en : '{$nation_en}'});";
		}
	}
	echo "</script>";
?>

<section class="submit_application container lecture_submission">
	<div>
		<div class="sub_banner">
			<h1>Lecture Note Submission</h1>
		</div>
		<ul class="tab_green">
			<li><a href="./lecture_note_submission.php">Lecture Note Submission Guideline</a></li>
			<li class="on"><a href="javascript:;">Online Submission</a></li>
			<!-- <li><a href="./oral_presenters.php"><?=$locale("lecture_menu3")?></a></li> -->
			<!-- <li><a href="./eposter_presenters.php"><?=$locale("lecture_menu4")?></a></li> -->
		</ul>
		<div>
			<div class="steps_area">
				<ul class="clearfix">
					<li class="next">
						<p>Step 1</p>
						<p class="sm_txt"><?=$locale("lecture_submit_tit1")?></p>
					</li>
					<li class="on">
						<p>Step 2</p>
						<p class="sm_txt"><?=$locale("lecture_submit_tit2")?></p>
					</li>
					<li>
						<p>Step 3</p>
						<p class="sm_txt"><?=$locale("submit_completed_tit")?></p>
					</li>
				</ul>
			</div>
			<div class="input_area">
				<ul class="basic_ul">
					<li>
						<p class="label">Presentation type <span class="red_txt">*</span></p>
						<div class="pl60">
							<div class="radio_wrap clearfix">
								<ul class="clearfix">
									<li>
										<input type="radio" class="radio required" id="presentation1" name="presentation_type" value="0" <?= $presentation_type== "0" ? "checked" : ""; ?>>
										<label for="presentation1">On-site</label>
									</li>
									<li>
										<input type="radio" class="radio required" id="presentation2" name="presentation_type" value="1" <?= $presentation_type== "1" ? "checked" : ""; ?>>
										<label for="presentation2">VOD Submission</label>
									</li>
								</ul>
							</div>
						</div>
					</li>
					<li>
						<p class="label"><?=$locale("lecture_item_cv")?></p>
						<div>
							<div class="file_input clearfix">
								<input type="file" name="cv_file" accept=".docx, .pdf">
								<label class='cv_label' data-js-label><?=$file_name_cv != "" ? $file_name_cv : $locale("lecture_item_cv_placeholder")?></label>
								<span class="btn floatR">search</span>
							</div>
						</div>
					</li>
					<li>
						<p class="label"><!--<?=$locale("abstract_item_file")?>-->Lecture Note</p>
						<div>
							<div class="file_input clearfix">
								<input class="required" type="file" name="lecture_file" accept=".docx, .pdf">
								<label class='label_file' data-js-label><?=$file_name_abf != "" ? $file_name_abf : $locale("abstract_item_file_placeholder")?></label>
								<span class="btn floatR">search</span>
							</div>
						</div>
					</li>
					<li>
						<p class="label"><?=$locale("lecture_item_video")?></p>
						<div>
							<div class="file_input clearfix">
								<input type="file" name="lecture_video_file" accept=".mp4">
								<label class='label_video_file' data-js-label><?=$file_name_lvf != "" ? $file_name_lvf : "MP4 Upload"?></label>
								<span class="btn floatR">search</span>
							</div>
						</div>
					</li>
					<!-- <li> -->
					<!-- 	<p class="label">Copyright Transfer Agreement</p> -->
					<!-- 	<div> -->
					<!-- 		<div class="file_input clearfix"> -->
					<!-- 			<input type="file" name="copyright_agreement_file" accept=".docx, .pdf"> -->
					<!-- 			<label class='label_copyright_file' data-js-label><?=$file_name_f_caf != "" ? $file_name_f_caf : "Copyrigt Transfer Agreement Upload"?></label> -->
					<!-- 			<span class="btn floatR">search</span> -->
					<!-- 		</div> -->
					<!-- 	</div> -->
					<!-- </li> -->
				</ul>	
				<div class="btn_wrap submission_step2">	
					<!-- <button type="button" class="btn online_btn gray_btn" onclick="window.location.href='./lecture_submission.php<?=$lecture_idx ? "?idx=".$lecture_idx : ""?>';"><span><</span><?=$locale("prev_btn")?></button> -->
					<button type="button" class="btn online_btn gray_btn" onclick="prev()"><span><</span><?=$locale("prev_btn")?></button>
					<!-- <a class="btn online_btn gray2_btn" onclick="popup_block()"><?=$locale("preview_btn")?></a> 클래스 preview_pop_btn-->
					<button type="button" class="btn online_btn green_btn on" data-idx=<?=$lecture_idx?>><?=$locale("submit_btn")?><span>></span></button>
				</div>
			</div>
			
			<!--
			<div class="input_area">
				<h3 class="pop_title"><?=$locale("authors")?></h3>
				<div class="table_wrap c_table_wrap input_table">
					<table class="c_table">
						<tr>
							<th>Presentation type *</th>
							<td>
								<div class="radio_wrap">
									<ul class="flex">
										<li>
											<input type="radio" class="radio" id="site" name="presentation_type" value="0" <?=$presentation_type == "0" ? "checked" : ""?>><label for="site">On-site</label>
										</li>
										<li>
											<input type="radio" class="radio" id="VOD" name="presentation_type" value="1" <?=$presentation_type == "1" ? "checked" : ""?>><label for="VOD">VOD Submission</label>
										</li>
									</ul>
								</div>
							</td>
						</tr>
						<tr>
							<th><?=$locale("lecture_item_cv")?> *</th>
							<td>
								<div class="file_input">
									<input class="required" type="file" name="cv_file" accept=".docx, .pdf">
									<span class="btn">Choose</span>
									<span class='cv_label' data-js-label><?=$file_name_cv != "" ? $file_name_cv : $locale("lecture_item_cv_placeholder")?></label>
								</div>
								<!--
									// 21.06.11 퍼블 긴급패치로 인한 추가개발 필요(주석)
									// 21.06.11 기존 cv input text
									<input class="uppercase" type="text" name="cv" value="<?=$cv?>" placeholder="<?=$locale("lecture_item_cv_placeholder")?>" maxlength="25">
								-->
							<!--</td>
						</tr>
						<tr>
							<th><?=$locale("abstract_item_file")?> *</th>
							<td>
								<div class="file_input">
									<input class="required" type="file" name="lecture_file" accept=".docx, .pdf">
									<span class="btn">Choose</span>
									<span class='label' data-js-label><?=$file_name_abf != "" ? $file_name_abf : $locale("abstract_item_file_placeholder")?></label>
								</div>
							</td>
						</tr>
						<tr>
							<th><?=$locale("lecture_item_video")?></th>
							<td class="no_input">
								<?=$locale("lecture_video_submit_txt1")?>
								<a class="btn" href="https://www.dropbox.com/request/MU8mnzHk8Wh3V23foa7V" target="_blank"><?=$locale("vod_btn")?></a>
							</td>
						</tr>
					</table>
				</div>
				<div class="btn_wrap submission_step2">	
					<button type="button" class="btn" onclick="window.location.href='./lecture_submission.php<?=$lecture_idx ? "?idx=".$lecture_idx : ""?>';"><?=$locale("prev_btn")?></button>
					<a class="btn preview_pop_btn"><?=$locale("preview_btn")?></a>
					<button type="button" class="btn submit_btn" data-idx=<?=$lecture_idx?>><?=$locale("submit_btn")?></button>
				</div>
			</div>
			-->
		</div>
		<!--//section1-->
		
	</div>
	<div class="popup revise_pop" style="display: none;">
		<div class="pop_bg"></div>
		<div class="pop_contents">
			<button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
			<div class="input_area">
					<div class="table_wrap c_table_wrap input_table">
						<table class="c_table">
							<form name="lecture_form">
								<tr>
									<th><?=$locale("country")?> *</th>
									<td>
										<select class="required" name="nation_no"> 
											<option value="" selected hidden>Choose </option>
										<?php
											foreach($nation_list AS $list) {
												$nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
												if($nation_no == $list["idx"]) {
													echo "<option value='".$list["idx"]."' selected>".$nation."</option>";
												} else {
													echo "<option value='".$list["idx"]."'>".$nation."</option>";
												}
											}
										?>
										</select>
									</td>
								</tr>
								<tr>
									<th><?=$locale("city")?> *</th>
									<td><input class="required" type="text" name="city" value="<?=$city?>" maxlength="100"></td>
								</tr>
								<tr>
									<th><?=$locale("state")?></th>
									<td><input type="text" name="state" value="<?=$state?>" maxlength="100"></td>
								</tr>
								<tr>
									<th><?=$locale("first_name")?> *</th>
									<td><input class="required" type="text" name="first_name" value="<?=$first_name?>" maxlength="50"></td>
								</tr>
								<tr>
									<th><?=$locale("last_name")?> *</th>
									<td><input class="required" type="text" name="last_name" value="<?=$last_name?>" maxlength="50"></td>
								</tr>
								<tr>
									<th><?=$locale("affiliation")?> *</th>
									<td><input class="required" type="text" name="affiliation" value="<?=$affiliation?>" maxlength="100"></td>
								</tr>
								<tr>
									<th><?=$locale("email")?> *</th>
									<td><input class="required" type="text" name="email" value="<?=$email?>" maxlength="100"></td>
								</tr>
								<tr>
									<th><?=$locale("phone")?> *</th>
									<td>
										<div class="clearfix">
											<select class="required" name="nation_tel"> 
												<option value="<?=$nation_tel?>" selected><?=$nation_tel?></option>
											</select>
											<input class="required" type="text" placeholder="010-0000-0000" name="phone" value="<?=$phone?>"></td>
										</div>
									</td>
								</tr>
							</form>
						</table>
					</div>

					<!-- coauthor append
					<div class="co_author_appended">
					<?php
						// 이전 버튼 누를시 데이터 세팅
						if($co_submit_data1 != "") {
							for($i=1; $i<$data_count; $i++) {
								echo  '<form name="co_lecture_form'.$i.'">';
								echo	  '<div class="table_wrap c_table_wrap input_table">';
								echo		'<table class="c_table">';
								echo			'<tr>';
								echo				'<th>'.$locale("country").' *</th>';
								echo				'<td>';
								echo					'<select class="required co_nation" name="co_nation_no'.$i.'" data-count='.$i.'> ';
								echo						'<option value="" selected hidden>Choose </option>';
														foreach($nation_list as $list) {
															$nation = $language == "en" ? $list["nation_en"] : $list["nation_ko"];
															$selected = ${'co_nation_no'.$i} == $list["idx"] ? "selected" : "";
								echo					 '<option value="'.$list["idx"].'"'.$selected.'>'.$nation.'</option>';
														}
								echo					'</select>';
								echo				'</td>';
								echo			'</tr>';
								echo			'<tr>';
								echo				'<th>'.$locale("city").' *</th>';
								echo				'<td><input class="required" type="text" name="co_city'.$i.'" value="'.${"co_city".$i}.'" maxlength="100"></td>';
								echo			'</tr>';
								echo			'<tr>';
								echo				'<th>'.$locale("state").'</th>';
								echo				'<td><input type="text" name="co_state'.$i.'" value="'.${"co_state".$i}.'" maxlength="100"></td>';
								echo			'</tr>';
								echo			'<tr>';
								echo				'<th>'.$locale("first_name").' *</th>';
								echo				'<td><input class="required" type="text" name="co_first_name'.$i.'" value="'.${"co_first_name".$i}.'" maxlength="50"></td>';
								echo			'</tr>';
								echo			'<tr>';
								echo				'<th>'.$locale("last_name").' *</th>';
								echo				'<td><input class="required" type="text" name="co_last_name'.$i.'" value="'.${"co_last_name".$i}.'" maxlength="50"></td>';
								echo			'</tr>';
								echo			'<tr>';
								echo				'<th>'.$locale("affiliation").' *</th>';
								echo				'<td><input class="required" type="text" name="co_affiliation'.$i.'" value="'.${"co_affiliation".$i}.'" maxlength="100"></td>';
								echo			'</tr>';
								echo			'<tr>';
								echo				'<th>'.$locale("email").' *</th>';
								echo				'<td><input class="required" type="text" name="co_email'.$i.'" value="'.${"co_email".$i}.'" maxlength="100"></td>';
								echo			'</tr>';
								echo			'<tr>';
								echo				'<th>'.$locale("phone").' *</th>';
								echo				'<td>';
								echo					'<div class="clearfix">';
								echo						'<select class="required" name="co_nation_tel'.$i.'"> ';
								echo							'<option value="'.${"co_nation_tel".$i}.'" selected>'.${"co_nation_tel".$i}.'</option>';
								echo						 '<option value="1">TEST</option>';
								echo						'</select>';
								echo						'<input class="required" type="text" placeholder="010-0000-0000" name="co_phone'.$i.'" value="'.${"co_phone".$i}.'"></td>';
								echo					'</div>';
								echo				'</td>';
								echo			'</tr>';
								echo		'</table>';
								echo	 '</div>';
								echo '</form>';
							}
						}
					?>
					</div> -->

				<h3 class="sub_section_title"><?=$locale("authors")?></h3>
				<div class="table_wrap c_table_wrap input_table">
						<table class="c_table">
							<tbody>
							<tr>
								<th>Presentation type *</th>
								<td><input class="required" type="text" name="popup_presentation_type" value="" readonly></td>
							</tr>
							<tr>
								<th><?=$locale("lecture_item_cv")?></th>
								<td><input class="required" type="text" name="popup_lecture_item_cv" value="" readonly></td>
							</tr>
							<tr>
								<th>Lecture Note *</th>
								<td><input class="required" type="text" name="popup_lecture_note" value="" readonly></td>
							</tr>
							<tr>
								<th>Lecture Video</th>
								<td><input class="required" type="text" name="popup_lecture_video" value="" readonly></td>
							</tr>
							<tr>
								<th>Copyright Transfer Agreement</th>
								<td><input class="required" type="text" name="popup_copyright_transfer_agreement" value="" readonly></td>
							</tr>
							<!-- <tr> -->
							<!-- 	<th><?=$locale("abstract_item_file")?> *</th> -->
							<!-- 	<td><input class="required" type="text" name="popup_lecture_file" value="" readonly></td> -->
							<!-- </tr> -->
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="loading">
	<img src="./img/icons/loading.gif"/>
</div>

<script src="./js/script/client/submission.js"></script>
<script>
	$(document).ready(function(){
		$(".green_btn").on("click", function(){

			//팝업 삭제로 삭제
			//var formData = $("form[name=lecture_form]").serializeArray();
			//var process2 = inputCheck2(formData);
			//var status2 = process2.status;

			//if(!status2) {
			//	return;
			//}

			var idx = $(this).data("idx");
			var type = idx ? "update" : "insert";

			var process = InputCheck(type, idx);
			var status = process.status;
			var data = process.data;
			//console.log(data);

			if(status) {
				$(".loading").show();
				$("body").css("overflow-y","hidden");

				$.ajax({
					url : "./ajax/client/ajax_submission.php",
					type : "POST",
					data : data,
					dataType : "JSON",
					contentType:false,
					processData:false,
					success : function(res) {
						if(res.code == 200) {
							alert(locale(language.value)("complet_submission"));
							$(window).off("beforeunload");
							window.location.replace("./lecture_submission3.php");
						} else if(res.code == 400) {
							alert(locale(language.value)("lecture_submit_error")+"\n"+locale(language.value)("retry_msg"));
							return false;
						} else {
							alert(res.code);
							alert(locale(language.value)("reject_msg"));
							return false;
						}
					},
					complet : function(){
						$(".loading").hide();
						$("body").css("overflow-y","auto");
					}
				});
			}
		});

		$("input[name=lecture_file]").on("change", function(){
			var lecture_file_type = ["DOCX", "PDF"];
			var label = $(this).val().replace(/^.*[\\\/]/, '');
			var type = $(this).val().replace(/^.*[.]/, '').toUpperCase();

			//파일 용량 제한
			if($(this)[0].files[0]) {
				var file = $(this)[0].files[0];
				var fileCheck = 1024*1024*20;//true; //fileCheck(file);

				if(!lecture_file_type.includes(type)) {
					alert(locale(language.value)("mismatch_file_type"));
					$(this).val("");
					return false;
				}

				if(!fileCheck) {
					// alert(locale(language.value)("file_size_error"));
					//alert(locale(language.value)("file_size_error"));
					//You can only attach files up to 5GB.
					alert("You can only attach files up to 20MB.");
					$(this).val("");
					return false;
				}
			}
			
			if($(this).val() != "") {
				$(".label_file").text(label);
			} else {
				$(".label_file").text("Please attach the an abstract file");
			}
			
		});

		/* 21.06.11 퍼블 긴급패치로 인한 추가개발 필요(주석)*/
		$("input[name=cv_file]").on("change", function(){
			var cv_file_type = ["DOCX", "PDF"];
			var label = $(this).val().replace(/^.*[\\\/]/, '');
			var type = $(this).val().replace(/^.*[.]/, '').toUpperCase();

			if($(this)[0].files[0]) {
				//파일 용량 제한
				var fileSize = $(this)[0].files[0].size;
				var maxSize = 1024*1024*20;//

				if(!cv_file_type.includes(type)) {
					alert(locale(language.value)("mismatch_file_type"));
					$(this).val("");
					return false;
				}

				if(fileSize > maxSize) {
					//alert(locale(language.value)("file_size_error"));
					//You can only attach files up to 5GB.
					alert("You can only attach files up to 20MB.");
					$(this).val("");
					return false;
				}
			}
			
			if($(this).val() != "") {
				$(".cv_label").text(label);
			} else {
				$(".cv_label").text("Please attach the an cv file");
			}
		});
		
		$("input[name=lecture_video_file]").on("change", function(){
			var cv_file_type = ["MP4"];
			var label = $(this).val().replace(/^.*[\\\/]/, '');
			var type = $(this).val().replace(/^.*[.]/, '').toUpperCase();


			if($(this)[0].files[0]) {
				//파일 용량 제한
				var fileSize = $(this)[0].files[0].size;
				var maxSize = 1024*1024*55;//
				console.log('fileSize', fileSize);
				console.log('maxSize', maxSize);

				if(!cv_file_type.includes(type)) {
					alert(locale(language.value)("mismatch_file_type"));
					$(this).val("");
					return false;
				}

				if(fileSize > maxSize) {
					//alert(locale(language.value)("file_size_error"));
					//You can only attach files up to 5GB.
					alert("You can only attach files up to 55MB.");
					$(this).val("");
					return false;
				}
			}

			//console.log($(this).val());
			if($(this).val() != "") {
				$(".label_video_file").text(label);
			} else {
				$(".label_video_file").text("MP4 Upload");
			}
			
		});
		//$("input[name=copyright_agreement_file]").on("change", function(){
		//	var cv_file_type = ["DOCX", "PDF"];
		//	var label = $(this).val().replace(/^.*[\\\/]/, '');
		//	var type = $(this).val().replace(/^.*[.]/, '').toUpperCase();

		//	//파일 용량 제한
		//	var fileSize = $(this)[0].files[0].size;
		//	var maxSize = 5 * 1024 * 1024 * 1024;

		//	if(!cv_file_type.includes(type)) {
		//		alert(locale(language.value)("mismatch_file_type"));
		//		$(this).val("");
		//		return false;
		//	}

		//	if(fileSize > maxSize) {
		//		alert(locale(language.value)("file_size_error"));
		//		$(this).val("");
		//		return false;
		//	}
		//	
		//	if($(this).val() != "") {
		//		$(".label_copyright_file").text(label);
		//	} else {
		//		$(".label_copyright_file").text("");
		//	}
		//});
		
	});

	$('.preview_pop_btn').on('click',function(){
		
		var presentation_type = $('.section .radio_wrap input[name=presentation_type]:checked+label').html();
		var lecture_item_cv = $('.section .file_input .cv_label').html();
		var lecture_file = $('.section .file_input span.label').html();
		$(".preview_pop input[name=presentation_type]").val(presentation_type);
		$(".preview_pop input[name=lecture_item_cv]").val(lecture_item_cv);
		$(".preview_pop input[name=lecture_file]").val(lecture_file);
		$('.preview_pop input[name=presentation_type]').attr('disabled',true);
		// $('.preview_pop input[name=co_position]').attr('disabled',true);
		$('.preview_pop').show();
	});

	function InputCheck(type, idx='') {
		var formData = new FormData();
		var inputCheck = true;

		if(!$("input[name=presentation_type]").is(":checked")) {
			console.log(locale(language.value)("check_presentation_type"));
			alert(locale(language.value)("check_presentation_type"));
			inputCheck = false;
			return false;
		}

		//if($("input[name=cv]").val() == "") {
		//	alert(locale(language.value)("check_cv"));
		//	inputCheck = false;
		//	return false;
		//}
		if(type != "update") {
			//if(!$("input[name=lecture_file]").val()) {
			//	alert(locale(language.value)("check_lecture_file"));
			//	inputCheck = false;
			//	return false;
			//}
		} else {
			formData.append("type", type);
			formData.append("idx", idx); 
		}

		formData.append("presentation_type", $("input[name=presentation_type]").val());
		formData.append("cv", $("input[name=cv]").val());
		formData.append("lecture_file", $("input[name=lecture_file]")[0].files[0]);
		// 21.06.11 퍼블 긴급패치로 인한 추가개발 필요(주석)
		formData.append("cv_file", $("input[name=cv_file]")[0].files[0]);
		formData.append("lecture_video_file", $("input[name=lecture_video_file]")[0].files[0]);
		//formData.append("copyright_agreement_file", $("input[name=copyright_agreement_file]")[0].files[0]);

		formData.append("flag", "lecture_step2");

		var formData_step1 = $("form[name=lecture_form]").serializeArray();
		formData.append("nation_no", formData_step1[0]["value"]);
		formData.append("city", formData_step1[1]["value"]);
		formData.append("state", formData_step1[2]["value"]);
		formData.append("first_name", formData_step1[3]["value"]);
		formData.append("last_name", formData_step1[4]["value"]);
		formData.append("affiliation", formData_step1[5]["value"]);
		formData.append("email", formData_step1[6]["value"]);
		formData.append("nation_tel", formData_step1[7]["value"]);
		formData.append("phone", formData_step1[8]["value"]);
		return {
			data : formData,
			status : inputCheck
		}
	}

	//팝업 띄우기
	function popup_block() {

		var presentation_type = "";
		if($("input[name=presentation_type]").is(":checked")) {
			presentation_type = $("input[name=presentation_type]:checked").val();
		}
		if(presentation_type == 0 && presentation_type != "") {
			presentation_type = "On-site";
		} else if(presentation_type == 1){
			presentation_type = "VOD Submission";
		}

		var popup_lecture_item_cv = $(".cv_label").text();
		var popup_lecture_note = $(".label_file").text();
		var popup_lecture_video = $(".label_video_file").text();
		var popup_copyright_transfer_agreement = $(".label_copyright_file").text();

		if(!$("input[name=cv_file]")[0].files[0]) {
			popup_lecture_item_cv = "";
		}
		if(!$("input[name=lecture_file]")[0].files[0]) {
			popup_lecture_note = "";
		}
		if(!$("input[name=lecture_video_file]")[0].files[0]) {
			popup_lecture_video = "";
		}
		if(!$("input[name=copyright_agreement_file]")[0].files[0]) {
			popup_copyright_transfer_agreement = "";
		}

		$("input[name=popup_presentation_type]").val(presentation_type);
		$("input[name=popup_lecture_item_cv]").val(popup_lecture_item_cv);
		$("input[name=popup_lecture_note]").val(popup_lecture_note);
		$("input[name=popup_lecture_video]").val(popup_lecture_video);
		$("input[name=popup_copyright_transfer_agreement]").val(popup_copyright_transfer_agreement);

		var revise_pop = document.getElementsByClassName("revise_pop")[0];

		if(revise_pop.style.display == "block") {
			revise_pop.style.display="none";
		} else {
			revise_pop.style.display="block";
		}
	}

//이전 버튼 눌렀을 때 팝업에서 데이터 수정했을 때를 대비한다.
function prev() {
	var idx = "<?=$lecture_idx; ?>";
	var data = {};

	var formData = $("form[name=lecture_form]").serializeArray();
	//var co_count = $(".number_of_author").val();

	var process = inputCheck2(formData);
	var status = process.status;
	data["main_data"] = process.data;

	if(status) {
		$.ajax({
			url : PATH+"ajax/client/ajax_submission.php",
			type : "POST",
			data : {
				flag : "submission_step1",
				type : type,
				data : data
			},
			dataType : "JSON",
			success : function(res){
				if(res.code == 200) {
					$(window).off("beforeunload");
					if(idx) {
						window.location.href="./lecture_submission.php?idx="+idx;
					} else {
						window.location.href="./lecture_submission.php"
					}
				} else if(res.code == 400) {
					alert("Please try again.");
					return false;
				} else {
					alert(locale(language.value)("reject_msg"));
					return false;
				}
			}
		});
	}
}

function inputCheck2(formData) {
	var data = {};
	var length_100 = ["affiliation", "email", "co_afflilation1", "co_email1", "co_afflilation2", "co_email2"]
	var length_50 = ["first_name", "last_name", "co_first_name1", "co_last_name1", "co_first_name2", "co_last_name2"];

	var inputCheck = true;
	
	// if(type == "my") {
	$.each(formData, function(key, value){
		var ok = value["name"];
		var ov = value["value"];

		if(ov == "" || ov == null || ov == "undefinded") {
			if(ok == "nation_no") {
				alert(locale(language.value)("check_nation"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "city") {
				alert(locale(language.value)("check_city"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "first_name") {
				alert(locale(language.value)("check_first_name"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "last_name") {
				alert(locale(language.value)("check_last_name"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "affiliation") {
				alert(locale(language.value)("check_affiliation"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "email") {
				alert(locale(language.value)("check_email"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "nation_tel") {
				alert(locale(language.value)("check_phone"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "phone") {
				alert(locale(language.value)("check_phone"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_nation_no1" || ok == "co_nation_no2") {
				alert(locale(language.value)("check_co_nation"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_city1" || ok == "co_city2") {
				alert(locale(language.value)("check_co_city"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_first_name1" || ok == "co_first_name2") {
				alert(locale(language.value)("check_co_first_name"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_last_name1" || ok == "co_last_name2") {
				alert(locale(language.value)("check_co_last_name"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_affiliation1" || ok == "co_affiliation2") {
				alert(locale(language.value)("check_co_affiliation"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_email1" || ok == "co_email2") {
				alert(locale(language.value)("check_co_email"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_nation_tel1" || ok == "co_nation_tel2") {
				alert(locale(language.value)("check_co_last_name"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			} else if(ok == "co_phone1" || ok == "co_phone2") {
				alert(locale(language.value)("check_co_phone"));
				$("input[name="+ok+"]").focus();
				inputCheck = false;
				return false;
			}

			   
		} else {
			if((length_50.indexOf(ok)+1) && ov.length > 50) {
				alert(ok+locale(language.value)("under_50"));
				inputCheck = false;
				return false;
			} else if((length_100.indexOf(ok)+1) && ov.length > 100) {
				alert(ok+locale(language.value)("under_100"));
				inputCheck = false;
				return false;
			} else if(ok == "phone" && ov.length < 6) {
				alert(ok+locale(language.value)("over_6"));
				inputCheck = false;
				return false;
			} else if(ok == "phone" && ov.length > 20) {
				alert(ok+locale(language.value)("under_20"));
				inputCheck = false;
				return false;
			} 
		}

		data[ok] = ov;
	});

	return {
		data : data,
		status : inputCheck
	}
}


$("input[name=city]").on("change keyup", function(key){
	var pattern_eng = /[^a-zA-Z]/gi;
	var _this = $(this);
	if(key.keyCode != 8) {
		var first_name = _this.val().replace(pattern_eng, '');
		_this.val(first_name);
	}
});
$("input[name=state]").on("change keyup", function(key){
	var pattern_eng = /[^a-zA-Z]/gi;
	var _this = $(this);
	if(key.keyCode != 8) {
		var first_name = _this.val().replace(pattern_eng, '');
		_this.val(first_name);
	}
});
$("input[name=first_name]").on("change keyup", function(key){
	var pattern_eng = /[^a-zA-Z]/gi;
	var _this = $(this);
	if(key.keyCode != 8) {
		var first_name = _this.val().replace(pattern_eng, '');
		_this.val(first_name);
	}
});
$("input[name=last_name]").on("change keyup", function(key){
	var pattern_eng = /[^a-zA-Z]/gi;
	var _this = $(this);
	if(key.keyCode != 8) {
		var first_name = _this.val().replace(pattern_eng, '');
		_this.val(first_name);
	}
});
$("input[name=affiliation]").on("change keyup", function(key){
	var pattern_eng = /[^a-zA-Z]/gi;
	var _this = $(this);
	if(key.keyCode != 8) {
		var first_name = _this.val().replace(pattern_eng, '');
		_this.val(first_name);
	}
});
$("input[name=email]").on("change", function(key){
	var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
	var _this = $(this).val();
	if(_this.match(regExp) == null) {
		$(this).val('');
		alert("check_email");
		return;
	}
});
//핸드폰 유효성
$(document).on('change keyup', "input[name=phone]",function(key){
	var _this = $(this);
	if(key.keyCode != 8) {
		var phone = _this.val().replace(/[^0-9||-]/gi,'');
		_this.val(phone);
	}
});
</script>

<?php
	include_once('./include/footer.php');
?>