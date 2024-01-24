<?php include_once('./include/head.php');?>
<?php include_once('./include/app_header.php');?>

<?php
$member_idx = $_SESSION["USER"]["idx"];
$select_program_query = "
                            SELECT @rownum := @rownum+1 AS rownum, P.*
                            FROM (
                                     SELECT p.idx, program_name, program_tag_name, chairpersons, preview, program_place_idx, pp.program_place_name ,program_category_idx, program_date,
                                            date_format(start_time, '%H:%i') as start_time, date_format(end_time, '%H:%i') as end_time, start_time as _start_time,
                                            (CASE
                                                 WHEN s.idx IS NULL THEN 'N'
                                                 ELSE 'Y'
                                                END
                                                ) as schedule_check, path
                                     FROM program p
                                     LEFT JOIN (SELECT va.program_idx, path FROM viewer_abstract va) va ON va.program_idx=p.idx
                                     LEFT JOIN program_place pp on p.program_place_idx = pp.idx
                                     LEFT JOIN(
                                         SELECT s.idx, member_idx, s.program_idx, s.register_date, s.is_deleted
                                         FROM schedule s
                                         WHERE member_idx={$member_idx}
                                           AND is_deleted='N'
                                     )s on s.program_idx=p.idx
                                     JOIN (SELECT @rownum := 0) AS R
                                     WHERE p.is_deleted = 'N'
                                     AND s.idx IS NOT NULL
                                     ORDER BY _start_time ASC, CAST(SUBSTRING_INDEX(program_tag_name, '_', -1) AS SIGNED), program_tag_name
                                 ) P
                            ";

$program_list = get_data($select_program_query);

$select_contents_query = "
                             SELECT pc.idx, program_idx, contents_title, isp.idx AS speaker_idx, first_name, last_name, affiliation, nation, pc.speaker,
                                    date_format(start_time, '%H:%i') as start_time, date_format(end_time, '%H:%i') as end_time
                             FROM program_contents pc
                             LEFT JOIN (
                                SELECT isp.idx, program_contents_idx, first_name, last_name, nation, affiliation
                                FROM invited_speaker isp
                                WHERE isp.is_deleted='N'
                             ) isp ON isp.idx = pc.speaker_idx
                             WHERE is_deleted = 'N'
                             ORDER BY start_time
                            ";
$contents_list = get_data($select_contents_query);

$abstract_category_list= ['5','6','7','8','9','10','11','12','13','14','15','16','17','18'];

$resultObj = [];
foreach($program_list as $pl){
    $pl_idx = $pl['idx'];

    $resultObj[$pl_idx] = [
        'idx' => $pl_idx,
        'program_name' => $pl['program_name'],
        'chairpersons' => $pl['chairpersons'],
        'preview' => $pl['preview'],
        'program_place_name' => $pl['program_place_name'],
        'program_category_idx' => $pl['program_category_idx'],
        'program_date' => $pl['program_date'],
        'start_time' => $pl['start_time'],
        'end_time' => $pl['end_time'],
        'contents' => [],
        'schedule_check' => $pl['schedule_check'],
        'path' => $pl['path']
    ];

    foreach ($contents_list as $cl){
        $program_idx = $cl['program_idx'];
        $cl_info = [
            'cl_idx' => $cl['idx'],
            'program_idx' => $program_idx,
            'contents_title' => $cl['contents_title'],
            'speaker_idx' => $cl['speaker_idx'],
            'first_name' => $cl['first_name'],
            'last_name' => $cl['last_name'],
            'affiliation' => $cl['affiliation'],
            'nation' => $cl['nation'],
            'speaker' => $cl['speaker'],
            'start_time' => $cl['start_time'],
            'end_time' => $cl['end_time']
        ];

        if($pl_idx === $program_idx){
            $resultObj[$pl_idx]['contents'][]=$cl_info;
        }
    }
}

?>

<!-- HUBDNCHYJ : App - My Schedule 페이지 -->
<section class="container app_version app_scientific">
	<div class="app_title_box">
		<h2 class="app_title">
			MY SCHEDULE
			<button type="button" class="app_title_prev" onclick="javascript:history.back();"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button>
		</h2>
	</div>
	<div class="contents_box">
		<div class="sponsor_grade schedule_area">
			<a href="javascript:;" class="grade_title green_bg">Day 1 / September 7(Thu)</a>
			<ul class="program_detail_ul">
                <?php
                foreach ($resultObj as $program){
                    if($program['schedule_check']==='Y'){
                        $schedule="on";
                    } else {
                        $schedule="";
                    }
                    if($program['program_date']==='2023-09-07'){
                    ?>
                    <li name="">
                        <div class="main">
                            <?php
                                if(in_array($program['program_category_idx'], $abstract_category_list, true)){
                            ?>
                            <a href="<?=$program['path'] ?? 'javascript:void(0)'?>" class="right_tag">Abstract</a>
                            <?php
                            }
                            ?>
                            <p class="title"><?=$program['program_name']?></p>
                            <?php
                            if($program['chairpersons']!=null){
                                if(substr_count($program['chairpersons'],',')>=2){
                                    $chairperson = 'Chairpersons:';
                                } else {
                                    $chairperson = 'Chairperson:';
                                }
                                ?>
                                <p class="chairperson"><span class="bold"><?=$chairperson?> </span> <?=$program['chairpersons']?></p>
                                <?php
                            }
                            ?>
                            <div class="info">
                                <button class="<?=$schedule?>" value="<?=$program['idx']?>"></button>
                                <span class="time"><?=$program['start_time']?>-<?=$program['end_time']?></span>
                                <span class="branch"><?=$program['program_place_name']?></span>
                            </div>
                            <?php
                            if($program['preview']!=null || $program['preview']!=""){
                                ?>
                                <button class="preview_btn">Preview</button>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if($program['preview']!=null || $program['preview']!=""){
                            ?>
                            <div class="detail_text"><?=$program['preview']?></div>
                            <?php
                        }
                        ?>
                        <div class="detail">
                            <?php
                            foreach ($program['contents'] as $contents){
                                ?>
                                <div>
                                    <p class="title"><?=$contents['contents_title']?></p>
                                    <?php
                                        if($contents['speaker_idx']!==null){
                                    ?>
                                    <p class="chairperson">
                                        <span class="bold"><?=$contents['first_name']?> <?=$contents['last_name']?></span> (<?=$contents['affiliation']?>, <?=$contents['nation']?>)
                                    </p>
                                    <?php
                                    } else {
                                        if($contents['speaker']!==null){
                                    ?>
                                    <p class="chairperson">
                                        <span><?=$contents['speaker']?></span>
                                    </p>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <div class="info">
                                        <span class="time"><?=$contents['start_time']?>-<?=$contents['end_time']?></span>
                                        <?php
                                        if($contents['speaker_idx']!==null){
                                            ?>
                                            <a href="/main/app_invited_speakers_detail.php?idx=<?=$contents['speaker_idx']?>" class="invited_tag">Speakers info</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                <?php
                    }
                }
                ?>
			</ul>
			<a href="javascript:;" class="grade_title purple_bg">Day 2 / September 8(Fri)</a>
			<ul class="program_detail_ul">
                <?php
                foreach ($resultObj as $program){
                    if($program['schedule_check']==='Y'){
                        $schedule="on";
                    } else {
                        $schedule="";
                    }
                    if($program['program_date']==='2023-09-08'){
                        ?>
                        <li name="">
                            <div class="main">
                                <?php
                                if(in_array($program['program_category_idx'], $abstract_category_list, true)){
                                    ?>
                                    <a href="<?=$program['path'] ?? 'javascript:void(0)'?>" class="right_tag">Abstract</a>
                                    <?php
                                }
                                ?>
                                <p class="title"><?=$program['program_name']?></p>
                                <?php
                                if($program['chairpersons']!=null){
                                    if(substr_count($program['chairpersons'],',')>=2){
                                        $chairperson = 'Chairpersons:';
                                    } else {
                                        $chairperson = 'Chairperson:';
                                    }
                                    ?>
                                    <p class="chairperson"><span class="bold"><?=$chairperson?> </span> <?=$program['chairpersons']?></p>
                                    <?php
                                }
                                ?>
                                <div class="info">
                                    <button class="<?=$schedule?>" value="<?=$program['idx']?>"></button>
                                    <span class="time"><?=$program['start_time']?>-<?=$program['end_time']?></span>
                                    <span class="branch"><?=$program['program_place_name']?></span>
                                </div>
                                <?php
                                if($program['preview']!=null || $program['preview']!=""){
                                    ?>
                                    <button class="preview_btn">Preview</button>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            if($program['preview']!=null || $program['preview']!=""){
                                ?>
                                <div class="detail_text"><?=$program['preview']?></div>
                                <?php
                            }
                            ?>
                            <div class="detail">
                                <?php
                                foreach ($program['contents'] as $contents){
                                    ?>
                                    <div>
                                        <p class="title"><?=$contents['contents_title']?></p>
                                        <?php
                                            if($contents['speaker_idx']!==null){
                                        ?>
                                        <p class="chairperson">
                                            <span class="bold"><?=$contents['first_name']?> <?=$contents['last_name']?></span> (<?=$contents['affiliation']?>, <?=$contents['nation']?>)
                                        </p>
                                        <?php
                                        } else {
                                            if($contents['speaker']!==null){
                                        ?>
                                        <p class="chairperson">
                                            <span><?=$contents['speaker']?></span>
                                        </p>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="info">
                                            <span class="time"><?=$contents['start_time']?>-<?=$contents['end_time']?></span>
                                            <?php
                                            if($contents['speaker_idx']!=null){
                                                ?>
                                                <a href="/main/app_invited_speakers_detail.php?idx=<?=$contents['speaker_idx']?>" class="invited_tag">Speakers info</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
			</ul>
			<a href="javascript:;" class="grade_title pink_bg">Day 3 / September 9(Sat)</a>
			<ul class="program_detail_ul">
                <?php
                foreach ($resultObj as $program){
                    if($program['schedule_check']==='Y'){
                        $schedule="on";
                    } else {
                        $schedule="";
                    }
                    if($program['program_date']==='2023-09-09'){
                        ?>
                        <li name="">
                            <div class="main">
                                <?php
                                if(in_array($program['program_category_idx'], $abstract_category_list, true)){
                                    ?>
                                    <a href="<?=$program['path'] ?? 'javascript:void(0)'?>" class="right_tag">Abstract</a>
                                    <?php
                                }
                                ?>
                                <p class="title"><?=$program['program_name']?></p>
                                <?php
                                if($program['chairpersons']!=null){
                                    if(substr_count($program['chairpersons'],',')>=2){
                                        $chairperson = 'Chairpersons:';
                                    } else {
                                        $chairperson = 'Chairperson:';
                                    }
                                    ?>
                                    <p class="chairperson"><span class="bold"><?=$chairperson?> </span> <?=$program['chairpersons']?></p>
                                    <?php
                                }
                                ?>
                                <div class="info">
                                    <button class="<?=$schedule?>" value="<?=$program['idx']?>"></button>
                                    <span class="time"><?=$program['start_time']?>-<?=$program['end_time']?></span>
                                    <span class="branch"><?=$program['program_place_name']?></span>
                                </div>
                                <?php
                                if($program['preview']!=null || $program['preview']!=""){
                                    ?>
                                    <button class="preview_btn">Preview</button>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            if($program['preview']!=null || $program['preview']!=""){
                                ?>
                                <div class="detail_text"><?=$program['preview']?></div>
                                <?php
                            }
                            ?>
                            <div class="detail">
                                <?php
                                foreach ($program['contents'] as $contents){
                                    ?>
                                    <div>
                                        <p class="title"><?=$contents['contents_title']?></p>
                                        <?php
                                            if($contents['speaker_idx']!==null){
                                        ?>
                                        <p class="chairperson">
                                            <span class="bold"><?=$contents['first_name']?> <?=$contents['last_name']?></span> (<?=$contents['affiliation']?>, <?=$contents['nation']?>)                                        </p>
                                        <?php
                                        } else {
                                            if($contents['speaker']!==null){
                                        ?>
                                        <p class="chairperson">
                                            <span><?=$contents['speaker']?></span>
                                        </p>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="info">
                                            <span class="time"><?=$contents['start_time']?>-<?=$contents['end_time']?></span>
                                            <?php
                                            if($contents['speaker_idx']!=null){
                                                ?>
                                                <a href="/main/app_invited_speakers_detail.php?idx=<?=$contents['speaker_idx']?>" class="invited_tag">Speakers info</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
			</ul>
		</div>
	</div>
    <!-- 아래 program_alarm_pop 팝업에서 처리 -->
<!--     <div class="schedule_btn_wrap">
        <button type="button" class="remove_alarm_btn">Remove alarm complete</button>    
    </div> -->
</section>

<div class="popup bottom alarm_message_pop">
    <div class="pop_bg"></div>
    <div class="pop_contents">
        <!-- 팝업창 문구 -->
        <span class="tags"></span>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".program_detail_btn").click(function(event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parents("tr").next("tr").find(".program_detail_td").toggleClass("on");
        });

        $(".preview_btn").on("click", function(event){
            event.preventDefault();
            event.stopPropagation();
            $(this).parent(".main").siblings(".detail_text").stop().slideToggle();
            $(this).toggleClass("on");
        });

        $(".app_scientific .info button").click(function(event){
            Schedule(event);
        });

        $(".right_tag").click(function(event){
            event.preventDefault();
            let path = event.target.href;
            if(path==='javascript:void(0)'){
                alert('Updates are planned.');
                return false;
            } else {
                openPDF(path);
            }
        });

        function Schedule(e){
            var program_idx= e.target.value;
            if(e.target.classList.contains('on')){
                var check_schedule=0;
            } else {
                var check_schedule=1;
            }

            $.ajax({
                url: PATH + "ajax/client/ajax_app_program.php",
                type: "POST",
                data: {
                    flag: "schedule",
                    program_idx: program_idx,
                    check_schedule: check_schedule
                },
                dataType: "JSON",
                success: function (res) {
                    // Scientific Program 내 스케줄 버튼 토글
                    if(e.target.classList.contains('on')){
                        e.target.classList.remove('on');
                        setAlarm(program_idx)
                        AlarmMessage('Remove alarm complete');
                        setTimeout(() => window.location.reload(), 500);
                    } else {
                        alert("schedule error.");
                        return;
                    }
                }
            });
        }

        function openPDF(path){
            if (typeof(window.AndroidScript) != "undefined" && window.AndroidScript != null) {
                window.AndroidScript.openPDF(path);
            } else if(window.webkit && window.webkit.messageHandlers!=null) {
                try{
                    window.webkit.messageHandlers.openPDF.postMessage(path);
                } catch (err){
                    console.log(err);
                }
            }
        }

        function setAlarm(program_idx){
            $.ajax({
                url: PATH + "ajax/client/ajax_app_program.php",
                type: "POST",
                data: {
                    flag: "alarm",
                    program_idx: program_idx,
                    is_push: "delete"
                },
                dataType: "JSON",
                success: function (res) {
                    if (res.code == 200) {
                        $(".program_alarm_pop").show();
                    } else {
                        alert("setAlarm error.");
                        return;
                    }
                }
            });
        }

        function AlarmMessage(msg) {
            $('.alarm_message_pop .tags').text(msg).show();
            $('.alarm_message_pop').show();
        }


    });
</script>

<?php include_once('./include/app_footer.php');?>