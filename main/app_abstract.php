<?php
	include_once ("./include/head.php");
	include_once ("./include/app_header.php");
?>
<script src="./js/script/client/app_abstract.js?v=0.4"></script>

<?php

$category_idx = $_GET['category_idx'] ?? "";
$row_sql="";
if($category_idx!==''){
    $row_sql .= " AND category_idx = {$category_idx}" ;
}

$select_category_sql = " SELECT idx, title 
                         FROM program_category 
                         WHERE idx IN(5,6,7,8,9,10,11,12,13,14,15,16,17,18)
                         ORDER BY sort_num ASC;
                         ";
$category_list = get_data($select_category_sql);

$select_abstract_query="
                        SELECT idx, category_idx, path, name
                        FROM viewer_abstract
                        WHERE is_deleted='N'
                        AND category_idx IS NOT NULL
                        {$row_sql}
                        ORDER BY sort_num
                        ";
$abstract_list = get_data($select_abstract_query);
?>

<section class="container app_version app_abstract">
	<div class="app_title_box">
		<h2 class="app_title">Abstract<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
	</div>
	<div class="container_inner w_full">
		<div class="app_contents_box">
			<div class="app_contents_wrap type3">
				<ul class="app_sort_form app_half_ul fix_cont">
					<li>
						<select name="" id="abstract_category" onchange="selectAbstract()">
							<option value="" hidden>Select Category</option>
							<option value="">All</option>
                            <?php
                            foreach ($category_list as $category){
                                ?>
							<option value="<?=$category['idx']?>" <?=$category['idx']==$category_idx?"selected":""?>><?=$category['title']?></option>
                                <?php
                            }
                            ?>
						</select>
					</li>
				</ul>
				<ul class="pdf_list">
                    <?php
                        foreach ($abstract_list as $abstract){
                    ?>
					<li class="pdf">
                        <a href="<?=$abstract['path'] ?? 'javascript:void(0)'?>" class="pdf_viewer"><?=$abstract['name']?></a>
                    </li>
                    <?php
                    }
                    ?>
				</ul>
			</div>
		</div>
	</div>
</section>

<script>
    $(".pdf_viewer").click(function(event){
        event.preventDefault();
        let path = event.target.href;
        openPDF(path);
    });
</script>
<?php
	include_once ("./include/app_footer.php");
?>
