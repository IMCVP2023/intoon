<?php include_once('./include/head.php');?>
<?php include_once('./include/app_header.php');?>

<?php
$invited_speaker_idx = $_GET['idx'] ?? "";

$select_invited_speaker_query = "
                                    SELECT isp.idx, program_contents_idx, last_name, first_name, affiliation, nation, isp.image_path, isp.cv_path
                                    FROM invited_speaker isp
                                    WHERE isp.idx= {$invited_speaker_idx}
                                    AND is_deleted='N'
                                ";

$invited_speaker = sql_fetch($select_invited_speaker_query);

$is_profile_img = ($invited_speaker['image_path'] ?? '/main/img/profile_empty.png');


$select_program_query = "
                            SELECT p.idx, isp.idx, first_name, last_name, contents_title, program_name,program_tag_name,p.chairpersons, p.preview, pp.program_place_name, program_category_idx, p.program_date,
                                   date_format(p.start_time, '%H:%i') as start_time, date_format(p.end_time, '%H:%i') as end_time,
                                   (CASE
                                       WHEN program_date = '2023-09-07' THEN 'day_1'
                                       WHEN program_date = '2023-09-08' THEN 'day_2'
                                       WHEN program_date = '2023-09-09' THEN 'day_3'
                                       ELSE ''
                                       END
                                   ) as day,
                                   (CASE
                                       WHEN program_date = '2023-09-07' THEN 'Sep.7(Thu)'
                                       WHEN program_date = '2023-09-08' THEN 'Sep.8(Fri)'
                                       WHEN program_date = '2023-09-09' THEN 'Sep.9(Sat)'
                                       ELSE ''
                                       END
                                   ) as date
                            FROM program p
                            LEFT JOIN (
                                SELECT pc.idx, pc.program_idx, pc.contents_title, pc.speaker_idx
                                FROM program_contents pc
                                WHERE pc.is_deleted = 'N'
                            )pc ON pc.program_idx=p.idx
                            LEFT JOIN invited_speaker isp on isp.idx=pc.speaker_idx
                            LEFT JOIN program_place pp on pp.idx = p.program_place_idx
                            WHERE isp.is_deleted = 'N'
                            AND p.is_deleted = 'N'
							AND isp.idx= {$invited_speaker_idx}
                            ";

$program_list = get_data($select_program_query);

?>

<!-- App - Invited Speakers 페이지 -->
<section class="container app_version app_scientific app_invited_speakers_detail">
	<div class="app_title_box">
		<h2 class="app_title">
			Invited Speakers
			<button type="button" class="app_title_prev" onclick="javascript:history.back();"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button>
		</h2>
	</div>
	<div class="inner">
		<ul class="speaker_list_wrap">
			<li class="speaker08 on">
				<div class="speakers_detail">
					<img src="<?= $is_profile_img ?>" alt="profile img">
					<div class="detail_box">
						<p><?=$invited_speaker['first_name']?> <?=$invited_speaker['last_name']?><span><?=$invited_speaker['affiliation']?><br><?=$invited_speaker['nation']?></span></p>
						<?php
							if (!empty($invited_speaker['cv_path'])) {
						?>
								<a href="<?= $invited_speaker['cv_path'] ?>" class="download_btn pdf_view">CV</a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="schedule_area">
					<ul class="program_detail_ul">
                        <?php
                            foreach ($program_list as $program){
                                if(substr_count($program['chairpersons'],',')>=2){
                                    $chairperson = 'Chairpersons:';
                                } else {
                                    $chairperson = 'Chairperson:';
                                }
                        ?>
						<li name="<?=$program['program_tag_name']?>" class="<?=$program['day']?>">
							<div class="main">
								<button class="detail_btn"></button>
								<p class="title"><?=$program['program_name']?></p>
                                <?php
                                    if($program['chairpersons']!==null){
                                ?>
								<p class="chairperson"><span class="bold"><?=$chairperson?> </span> <?=$program['chairpersons']?></p>
                                <?php
                                }
                                ?>
								<div class="info">
									<span class="time"><?=$program['start_time']?>-<?=$program['end_time']?>, <?=$program['date']?></span>
									<span class="branch"><?=$program['program_place_name']?></span>
								</div>
							</div>
							<input type="hidden" name="e" value="<?=$program['program_place_name']?>">
						</li>
                        <?php
                        }
                        ?>
					</ul>
				</div>
			</li>
			<li class="speaker01">
				<!-- 해당 speaker01 content -->
			</li>
			<li class="speaker02">
				<!-- 해당 speaker02 content -->
			</li>
			<li class="speaker03">
				<!-- 해당 speaker03 content -->
			</li>
			<li class="speaker04">
				<!-- 해당 speaker04 content -->
			</li>
			<li class="speaker05">
				<!-- 해당 speaker05 content -->
			</li>
			<li class="speaker06">
				<!-- 해당 speaker06 content -->
			</li>
		</ul>
	</div>
</section>

<script>
	$(document).ready(function() {

		$(".program_detail_ul > li").click(function() {
			var e = $(this).find("input[name=e]").val();
			var day = $(this).attr("class");
			var target = $(this)
			var this_name = $(this).attr("name");
			/*console.log(event, "event")
			console.log(target, "target")
			console.log(e, "e")
			console.log(day, "day")
			console.log(this_name, "this_name")*/
			table_location(event, target, e, day, this_name);

			
		});

		$(".pdf_view").click(function(event){
            event.preventDefault();
            let path = event.target.href;
            openPDF(path);
        });

	});

	function openPDF(path) {
		// let path = e.target.href;

		if (typeof (window.AndroidScript) != "undefined" && window.AndroidScript != null) {
			window.AndroidScript.openPDF(path);
		} else if (window.webkit && window.webkit.messageHandlers != null) {
			try {
				window.webkit.messageHandlers.openPDF.postMessage(path);
			} catch (err) {
				console.log(err);
			}
		}
	}

	function table_location(event, _this, e, day, this_name) {
		// window.location.href = "./program_detail.php?day=" + day + "&e=" + e + "&name=" + this_name;
		window.location.href = "./app_program_detail.php?day=" + day + "&e=" + e + "&name=" + this_name;
	}

/*
	$(".program_detail_ul > li").click(function() {
		var e = $(this).find("input[name=e]").val();
		var day = $(this).attr("class");
		var target = $(this)
		var this_name = $(this).attr("name");

		table_location(event, target, e, day, this_name);
	});

	function table_location(event, _this, e, day, this_name) {
		//window.location.href = "./program_detail.php?day=" + day + "&e=" + e + "&name=" + this_name;
		window.location.href = "./app_program_detail.php?day=" + day + "&e=" + e + "&name=" + this_name;
	};
});
*/
</script>

<?php include_once('./include/app_footer.php');?>