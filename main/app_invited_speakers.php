<?php include_once('./include/head.php');?>
<?php include_once('./include/app_header.php');?>
<script src="./js/script/client/app_invited_speakers.js?ver=0.1"></script>

<?php
$member_idx = $_SESSION["USER"]["idx"];

$select_invited_speaker_query = "
                                SELECT DISTINCT LEFT(first_name, 1) AS initial, isp.idx, program_contents_idx, last_name, first_name, affiliation, 
                                    (CASE
                                         WHEN fisp.idx IS NULL THEN 'N'
                                         ELSE 'Y'
                                            END
                                    ) AS favorite_check,
									image_path, cv_path, nation
                                FROM invited_speaker isp
                                LEFT JOIN(
                                    SELECT fisp.idx, member_idx, invited_speaker_idx
                                    FROM favorite_invited_speaker fisp
                                    WHERE is_deleted = 'N'
                                    AND member_idx = '{$member_idx}'
                                ) fisp ON isp.idx=fisp.invited_speaker_idx
                                WHERE isp.is_deleted = 'N'
                                ORDER BY first_name
                                ";

$invited_speaker_list = get_data($select_invited_speaker_query);

$select_initial_query = "
                            SELECT DISTINCT LEFT(first_name, 1) AS initial
                            FROM invited_speaker
                            WHERE is_deleted='N'
                            ORDER BY initial ASC;
                        ";
$initial_list = get_data($select_initial_query);
?>

<!-- App - Invited Speakers 페이지 -->
<section class="container app_version app_invited_speakers">
	<div class="app_title_box">
		<h2 class="app_title">
			Invited Speakers
			<button type="button" class="app_title_prev" onclick="javascript:history.back();"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button>
		</h2>
	</div>
	<div class="container_inner">
		<div class="contents_box">
			<div class="app_search_area fix_cont">
				<!-- <p class="f_bold">Please enter keywords</span></p> -->
				<div class="search_input">
					<input id="keywords" type="text" placeholder="Please enter keywords" oninput="selectKeywords();">
					<button type="button" class="search_icon"></button>
				</div>
			</div>
			<div class="speakers_area">
				<!-- My Favorite -->			
				<p class="category favorite_list_type">My Favorite</p>
				<ul class="speakers_list ajax_favorite_list">
                    <?php
                        foreach ($invited_speaker_list as $isl){
                            if($isl['favorite_check']==='Y'){
								$is_profile_img = ($isl['image_path'] ?? '/main/img/profile_empty.png');
                    ?>
								<li>
									<a href="./app_invited_speakers_detail.php?idx=<?=$isl['idx']?>">
										<div class="speakers_info">
											<img src="<?= $is_profile_img ?>" alt="profile_img">
											<p><?=$isl['first_name']?> <?=$isl['last_name']?> <span class="sub"><?=$isl['affiliation']?>, <?=$isl['nation']?></span></p>
										</div>
									</a>
									<button type="button" class="favorite_btn on" value="<?=$isl['idx']?>"></button>
								</li>
                    <?php
							}
						}
                    ?>
				</ul>
				<!-- J -->
				<div class="ajax_speakers_list">
                <?php
                    foreach ($initial_list as $ini){
                ?>
					
					<div>
						<p class="category"><?=$ini['initial']?></p>
						<ul class="speakers_list">
                <?php
						foreach ($invited_speaker_list as $isl){
							if($isl['favorite_check']==='Y'){
								$favorite = "on";
							} else {
								$favorite = "";
							}

							
							$is_profile_img = ($isl['image_path'] ?? '/main/img/profile_empty.png');

							if($isl['initial']==$ini['initial']){
                ?>
								<li>
									<a href="./app_invited_speakers_detail.php?idx=<?=$isl['idx']?>">
										<div class="speakers_info">
											<img src="<?= $is_profile_img ?>" alt="profile_img">
											<p><?=$isl['first_name']?> <?=$isl['last_name']?> <span class="sub"><?=$isl['affiliation']?>, <?=$isl['nation']?></span></p>
										</div>
									</a>
									<button type="button" class="favorite_btn <?=$favorite?>" value="<?=$isl['idx']?>"></button>
								</li>
                <?php
							}
						}
				?>
						</ul>
					</div>
				<?php
					}
                ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){
		$(".favorite_btn").click(function(e){
            favorite(e);
		})

        $(".search_icon").click(function(){
            selectKeywords();
        })
	});
</script>

<?php include_once('./include/app_footer.php');?>