<?php
include_once('./include/head.php');
include_once('./include/header.php');
include_once('../plugin/editor/smarteditor2/editor.lib.php');

$board_type_list = ["NewsLetter", "Notice", "FAQ", "App Notice"];

$board_type = isset($_GET["t"]) ? preg_replace("/[^0-9]/","",$_GET["t"]) : "";
$board_type = ($board_type == 1 || $board_type == 2) ? $board_type : 0;

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
				WHERE b.type = {$board_type}
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
                <h1 class="font_title"><?=$board_type_list[$board_type]?></h1>
            </div>
            <div class="contwrap has_fixed_title">
                <input type="hidden" name="category_id" value="<?=$category_id?>"/>
                <input type="hidden" name="board_type" value="<?=$board_type?>"/>
                <input type="hidden" name="board_id" value="<?=$board_id?>"/>
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
                            <td></td>
                        </tr>
                        <tr>
                            <th>title *</th>
                            <td colspan="3"><input type="text" name="title_en" value="<?=stripslashes($detail["title_en"])?>"></td>
                        </tr>
                        <tr>
                            <th>contents *</th>
                            <td colspan="3">
                                <?=editor_html("content_en", htmlspecialchars_decode(stripslashes($detail["content_en"])));?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="btn_wrap">
                    <button type="button" class="border_btn" onclick="location.href='./board_list.php?t=<?=$board_type?>&c=<?=$category_id?>'">목록</button>
                    <?php
                    if($is_modify){
                        if ($_GET["i"]) {
                            ?>
                            <button type="button" class="btn gray_btn remove_btn">삭제</button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn save_btn">저장</button>
                        <?php
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
            //     var file = e.target.files[0];			// 단일 파일업로드만 고려된 개발
            //     var label = $(this).parent().find(".label");
            //
            //     if(!file.type.match('image.*')){
            //         alert("썸네일은 이미지 파일만 가능합니다");
            //         return;
            //     }
            //
            //     if(file && file != "" && typeof(file) != "undefined"){
            //         thumbnail = file;
            //         label.text(file.name);
            //     }
            //
            //     $(this).val("");
            // });

            // 저장버튼 Event
            $(".save_btn").on("click", function(){
                // var category = $("input[name=category_id]").val();
                // var boardType = $("input[name=board_type]").val();
                //var boardId = $("input[name=board_id]").val();
                var titleEn = $("input[name=title_en]").val();
                var contentEn = "";

                var formData = new FormData();

                <?php if($board_type == 2){?>

                contentEn = $("textarea[name=content_en]").val();

                <?= get_editor_js("answer_en"); ?>
                <?= chk_editor_js("answer_en"); ?>

                answerEn = answer_en_editor_data;

                <?php }else{?>
                // Notice, News
                <?= get_editor_js("content_en"); ?>
                <?= chk_editor_js("content_en"); ?>

                contentEn = content_en_editor_data;
                contentKo = content_ko_editor_data;
                <?php }?>


                if(!confirm("작성하신 내용을 저장하시겠습니까?")){
                    return false;
                }

                formData.append("flag", "save");
                formData.append("c_id", category);
                formData.append("b_type", boardType);
                formData.append("b_id", boardId);
                formData.append("title_en", titleEn);
                formData.append("content_en", contentEn);
                formData.append("answer_en", answerEn);
                formData.append("file", thumbnail);

                $.ajax({
                    url:"../ajax/admin/ajax_board.php",
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    success:function(data){
                        data = (data) ? JSON.parse(data) : null;

                        if(data.code == 200){
                            alert("작성된 내용이 저장되었습니다.");
                            window.location.replace("./board_list.php?t="+type+"&c="+category);
                        }else if(data.code == 400){
                            alert(data.msg);
                        }else if(data.code == 401){
                            alert("로그인이 필요합니다");
                            window.location.replace("./");
                        }else{
                            alert("저장 요청이 거절되었습니다. 관리자에게 문의해주세요.");
                        }
                    },
                    error:function(){
                        alert("저장 요청이 거절되었습니다. 관리자에게 문의해주세요.");
                    },
                    complete:function(){
                        // 로딩창 닫기
                    }
                });
            });

            // 삭제버튼 Event
            $(".remove_btn").on("click",function(){
                var b_id = $("input[name=board_id]").val();
                b_id = (b_id && b_id != "" && typeof(b_id) != "undefined") ? b_id : "";

                if(b_id == ""){
                    alert("유효하지 않은 게시글 정보입니다.");
                    return false;
                }

                if(!confirm("삭제된 내용은 더이상 노출되지 않습니다.\n작성하신 내용을 삭제하시겠습니까?")){
                    return false;
                }

                $.ajax({
                    url:"../ajax/admin/ajax_board.php",
                    type:"POST",
                    data:{
                        flag:"remove",
                        b_id: b_id
                    },
                    dataType:"JSON",
                    success:function(data){
                        if(data.code == 200){
                            alert("삭제가 되었습니다.");
                            window.location.replace("./board_list.php?t="+type);
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