
<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	if($admin_permission["auth_board_notice"] == 0){
		echo '<script>alert("권한이 없습니다.");history.back();</script>';
	}

    if($_SESSION["ADMIN"]===[]){
        echo '<script>alert("권한이 없습니다.");history.back();</script>';
    }

    $title = $_GET["app_title"] ?? "";
    $s_date = $_GET["s_date"] ?? "";
    $e_date = $_GET["e_date"] ?? "";

    $where = "";

    if($title != ""){
        $where .= " AND (b.title_en LIKE '%{$title}%') ";
    }

    if($s_date != ""){
        $where .= " AND b.register_date >= '{$s_date}' ";
    }

    if($e_date != ""){
        $where .= " AND b.register_date <= '{$e_date}' ";
    }

    $sql =	"
                SELECT
                    b.idx, b.title_en, pin, b.register_date
					#DATE_FORMAT(b.register_date, '%Y-%m-%d') AS register_date
                FROM board AS b
                WHERE b.is_deleted = 'N'
                AND b.`type` = 3
                {$where}
                ORDER BY register_date DESC
                ";

    $list = get_data($sql);
    $total_count = count($list);

    $today = date('Y-m-d', time());
?>
<style>
	.register_btn {float: right;}
</style> 
	<section class="list app_notice">
		<div class="container">
			<div class="title clearfix">
				<?php
                    if($admin_permission["auth_board_notice"] > 1){
				?>
					<h1 class="font_title">Notice</h1>
<!-- 					<button type="button" class="btn floatR">엑셀 다운로드</button> -->
				<?php
                }
				?>
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
								<th>제목</th>
								<td>
									<input type="text" name="app_title" value="<?=$title?>" data-type="app_title">
								</td>
								<th>등록일</th>
								<td class="input_wrap"><input type="text" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" name="s_date" value="<?=$s_date?>" data-type="date"> <span>~</span> <input type="text" class="datepicker-here" data-language="en" data-date-format="yyyy-mm-dd" name="e_date" value="<?=$e_date?>" data-type="date"></td>
							</tr>
						</tbody>
					</table>
				   <button type="submit" class="btn search_btn">검색</button>
			   </form>
			</div>
			<div class="contwrap">
                <div class="flex_between title_wrap">
    				<p class="table_title">List</p>
                    <button type="button" class="btn app_add_notice_btn" onclick="location.href='./app_notice_detail.php'">Notice 등록</button>
                </div>
<!-- 				<table id="datatable" class="list_table"> -->
				<table id="datatable" class="list_table app">
					<colgroup>
						<col width="10%">
						<col width="60%">
						<col width="10%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr class="tr_center">
							<th>등록일시</th>
							<th>Title</th>
							<th>Push</th>
							<th>Management</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        foreach ($list as $l) {
                            if($l['pin']==='Y'){
                                $pin = 'on';
                            } else {
                                $pin = '';
                            }
                    ?>
						<tr class="tr_center">
                            <!-- 230717 HUBDNCLHJ : register_date 년,월,일 시,분,초 까지 노출되어야 합니다.-->
 						    <td><?=$l["register_date"]?></td>
							<td class="notice_title"><p class="ellipsis"><?=$l["title_en"]?></p></td>
							<td><button type="button" class="btn app_push_btn app_push_open" name="pop_btn" value="<?=$l['idx']?>">Push</button></td>
							<td>
								<button type="button" class="btn app_pin_btn <?=$pin?>" value="<?=$l['idx']?>">Pin</button>
								<button type="button" class="btn app_modify_btn" value="<?=$l['idx']?>">Modify</button>
								<button type="button" class="btn app_delete_btn" value="<?=$l['idx']?>">Delete</button>
							</td>	
						</tr>
					</tbody>
                    <?php
                    }
                    ?>
				</table>
			</div>
            <!--
			<div class="contwrap">
				<p class="table_title">Contents</p>
				<form name="">
					<table class="overview">
						<colgroup>
							<col width="10%">
							<col width="*">
							<col width="200px">
							<col width="*">
						</colgroup>
						<tbody>
							<tr>
								<th>Date</th>
								<td>2023-09-07</td>
							</tr>
							<tr>
								<th>Title</th>
								<td>ICOMES 2023 Welcome Cocktail Party begins soon!</td>
							</tr>
							<tr>
								<th>Contents</th>
								<td colspan="3">
									editor area
								</td>
							</tr>
						</tbody>
					</table>
					<div class="btn_wrap leftT">
						<button type="button" class="btn" name="save">Complete</button>
					</div>
				</form>
			</div> -->
            <!-- 페이지네이션 -->
<!--            <div class="row centerT">-->
<!--                <div class="col-sm-12 col-md-5"></div>-->
<!--                <div class="col-sm-12 col-md-7">-->
<!--                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">-->
<!--                        <ul class="pagination">-->
<!--                            <li class="paginate_button page-item previous disabled" id="datatable_previous">-->
<!--                                <a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>-->
<!--                            </li>-->
<!--                            <li class="paginate_button page-item active">-->
<!--                                <a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a>-->
<!--                            </li>-->
<!--                            <li class="paginate_button page-item ">-->
<!--                                <a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a>-->
<!--                            </li>-->
<!--                            <li class="paginate_button page-item ">-->
<!--                                <a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a>-->
<!--                            </li>-->
<!--                            <li class="paginate_button page-item ">-->
<!--                                <a href="#" aria-controls="datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a>-->
<!--                            </li>-->
<!--                            <li class="paginate_button page-item ">-->
<!--                                <a href="#" aria-controls="datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a>-->
<!--                            </li>-->
<!--                            <li class="paginate_button page-item next" id="datatable_next">-->
<!--                                <a href="#" aria-controls="datatable" data-dt-idx="6" tabindex="0" class="page-link">Next</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--		</div>-->
	</section>

<!-- Push popup -->
<div class="pop_wrap app_push_pop_notice">
	<div class="pop_dim"></div>
	<div class="pop_cont">
		<div class="pop_title">Push
			<button type="button" class="pop_close"></button>
		</div>
		<div class="pop_inner center_t">
			<p class="pop_inner_title">title</p>
			<div class="text_area">
				<textarea name="notice_title" id="notice_title" cols="30" rows="10" disabled></textarea>
			</div>

			<ul class="flex app_date_ul">
				<li class="flex">
					<span>Date</span>
					<input type="text" class="" data-language="en" data-date-format="yyyy-mm-dd" name="s_date" value="<?=$today?>" data-type="date" disabled/>
				</li>
			<!-- 23-06-12 예약발송 제외하기로 함 -->
			<!--
				<li class="flex">
					<span>Time</span>
					<input type="text" name="time">
				</li> -->
			</ul> 
		</div>
		<p class="center_t bold">Would you like to proceed with the app push?</p>
		<div class="btn_wrap center_t">
			<button type="button" class="btn pop_close">No</button>
			<button type="button" class="btn pop_close push_y">Yes</button>
		</div>
	</div>
</div>

<script src="./js/common.js"></script>
<script src="./js/app_notice.js"></script>
<script src="../js/config.js"></script>
<script>
	var html = '<?=$html?>';

	$(document).ready(function(){
		$(".app_nav li").eq(0).addClass("on");
	});
</script>
<?php include_once('./include/footer.php');?>
