<?php
	include_once('./include/head.php');
	include_once('./include/header.php');
	include_once('../plugin/editor/smarteditor2/editor.lib.php');
	
	$board_type_list = ["NewsLetter", "Notice", "FAQ"];

	$board_type = isset($_GET["t"]) ? preg_replace("/[^0-9]/","",$_GET["t"]) : "";
	$board_type = ($board_type == 1 || $board_type == 2 || $board_type == 3) ? $board_type : 0; 

	$category_id = "";
	$board_id	 = isset($_GET["i"]) ? preg_replace("/[^0-9]/","",$_GET["i"]) : "";

	switch ($board_type) {
		case 0 :
			$auth = $admin_permission["auth_board_news"];
			break;
		case 1 :
			$auth = $admin_permission["auth_board_notice"];
			break;
		case 2 :
			$auth = $admin_permission["auth_board_faq"];
			break;
	}
	if($auth < 2){
		echo '<script>alert("권한이 없습니다.")</script>';
		echo '<script>history.back();</script>';
	}
	$is_modify = ($auth >= 2);

	if($board_type == 2){
		$category_id = isset($_GET["c"]) ? preg_replace("/[^0-9]/","",$_GET["c"]) : "";
	
		$sql = "SELECT idx, title_en, title_ko FROM board_category WHERE is_deleted = 'N' AND idx = {$category_id}";
		$category = sql_fetch($sql);

		if($category["idx"] == ""){
			echo "<script>alert('카테고리 정보가 유효하지 않습니다.'); window.location.replace('./board_category_list.php');</script>";
			exit;
		}
	}

	if($board_id != ""){
		$sql = "
				SELECT
					b.idx, b.title_en, b.title_ko, f.original_name AS thumb_name, f.path AS thumb_path, 
					b.content_en, b.content_ko, b.answer_en, b.answer_ko, 
					b.view, DATE_FORMAT(b.register_date, '%y-%m-%d') AS register_date  
				FROM board AS b
				LEFT JOIN(
					SELECT
						idx, CONCAT(path,'/',save_name) AS path, original_name
					FROM `file`
				)AS f
				ON b.thumnail = f.idx
				WHERE b.type = 3
				AND b.idx = {$board_id}
				AND b.is_deleted = 'N'
				ORDER BY b.register_date DESC
				";
		$detail = sql_fetch($sql);

		if($detail["idx"] == ""){
			echo "<script>alert('유효하지 않은 게시글입니다.'); window.location.replace('./board_list.php?t=".$board_type."')</script>";
			exit;
		}
	}

    $today = date('Y-m-d', time());
?>

	<section class="detail">
		<div class="container">
			<div class="title">
				<h1 class="font_title">Notice</h1>
			</div>
			<div class="contwrap has_fixed_title">
				<input type="hidden" name="category_id" value="<?=$category_id?>"/>
				<input type="hidden" name="board_type" value="<?=$board_type?>"/>
				<input type="hidden" name="board_id" value="<?=$board_id?>"/>
                <p class="table_title">Contents</p>
				<table>
					<colgroup>
							<col width="10%">
							<col width="40%">
							<col width="10%">
							<col width="40%">
					</colgroup>
					<tbody>
							<tr>
								<th>Date</th>
								<td><?=$today?></td>
								<th>Viewing</th>
								<td><?=number_format($detail["view"])?></td>
							</tr>
							<tr>
								<th>Title <span class="red_color">*</span></th>
								<td colspan="3">
									<input type="text" name="title_en" value="<?=$detail["title_en"]?>">
								</td>
							</tr>
							<tr>
								<th>Contents <span class="red_color">*</span></th>
								<td colspan="3">
<!-- 									<textarea name="content_en" value="<?=$detail["content_en"]?>"><?=stripslashes($detail["content_en"])?></textarea> -->
									<?=editor_html("content_en", htmlspecialchars_decode(stripslashes($detail["content_en"])));?>
								</td>
							</tr>
					</tbody>
				</table>
				
				<div class="btn_wrap">
					<button type="button" class="border_btn" onclick="location.href='./app_notice.php'">List</button>
					<button type="button" class="btn save_btn" data-idx="<?= $board_id ?>">Complete</button>
					<?php
						if($is_modify){
							if ($_GET["i"]) {
					?>
								<button type="button" class="btn gray_btn remove_btn" data-idx="<?= $board_id ?>">Delete</button>
					<?php
							}
						}
					?>
				</div>
			</div>
		</div>
	</section>
	<script>
		var type = $("input[name=board_type]").val();
		var thumbnail = null;

		$(document).ready(function(){

			// 파일업로드 감지
			// $(".file_input").on("change",function(e){
			// 	var file = e.target.files[0];			// 단일 파일업로드만 고려된 개발
			// 	var label = $(this).parent().find(".label");
            //
			// 	if(!file.type.match('image.*')){
			// 		alert("썸네일은 이미지 파일만 가능합니다");
			// 		return;
			// 	}
            //
			// 	if(file && file != "" && typeof(file) != "undefined"){
			// 		thumbnail = file;
			// 		label.text(file.name);
			// 	}
			//
			// 	$(this).val("");
			// });

			// 저장버튼 Event
			$(".save_btn").on("click", function(){
				var titleEn = $("input[name=title_en]").val();
				var contentEn = $("textarea[name=content_en]").val();

				<?= get_editor_js("content_en"); ?>
				<?= chk_editor_js("content_en"); ?>

				contentEn = content_en_editor_data;

				var idx = $(this).data('idx');

				if(!confirm("작성하신 내용을 저장하시겠습니까?")){
					return false;
				}
                
				$.ajax({
                    url: "/main/ajax/admin/ajax_app_notice.php",
					type:"POST",
					data:{
                        flag: "insert",
                        data: {
                            title_en: titleEn,
                            content_en: contentEn,
							idx : idx
                        }
                    },
                    dataType: "JSON",
					success:function(res){
						if(res.code === 200){
							alert("작성된 내용이 저장되었습니다.");
							window.location.replace("./app_notice.php");
						}else if(res.code == 400){
							alert(res.msg);
						}else if(res.code == 401){
							alert("로그인이 필요합니다");
							window.location.replace("./");
						}
					}
				});
			});
			
			// 삭제버튼 Event
			$(".remove_btn").on("click",function(){
				var idx = $(this).data('idx');
				
				if(!confirm("삭제된 내용은 더이상 노출되지 않습니다.\n작성하신 내용을 삭제하시겠습니까?")){
					return false;
				}

				$.ajax({
					url:"../ajax/admin/ajax_board.php",
					type:"POST",
					data:{
						flag:"remove",
						b_id: idx
					},
					dataType:"JSON",
					success:function(data){
						if(data.code == 200){
							alert("삭제가 되었습니다.");
							window.location.replace("./app_notice.php");
						}else if(data.code == 400){
							alert(data.msg);
						}else if(data.code == 401){
							alert("로그인이 필요합니다");
							window.location.replace("./");
						}else{
							alert("삭제 요청이 거절되었습니다. 관리자에게 문의해주세요.");
						}
					},
					error:function(){
						alert("삭제 요청이 거절되었습니다. 관리자에게 문의해주세요.");
					},
					complete:function(){
						// 로딩창 닫기
					}
				});

			});
		});
	</script>
<?php include_once('./include/footer.php');?>