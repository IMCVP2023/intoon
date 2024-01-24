<?php
$member_idx = $_SESSION["USER"]["idx"];
$select_notice_query = "
                            SELECT idx, type, title_en
                            FROM board
                            WHERE is_deleted='N'
                            AND type=3
                        ";
$notice_list = get_data($select_notice_query);

$select_schedule_query = "
                            SELECT p.idx, program_name, program_date, start_time
                            FROM program p
                            LEFT JOIN(
                                SELECT s.idx, member_idx, s.program_idx, s.register_date, s.is_deleted
                                FROM schedule s
                                WHERE member_idx='{$member_idx}'
                                AND s.is_deleted = 'N'
                            )s on s.program_idx=p.idx
                            WHERE p.is_deleted = 'N'
                            AND s.idx IS NOT NULL
                            AND NOW()>=start_time - interval 10 minute
                            AND NOW()<=start_time + interval 1 minute
                            ORDER BY program_date ASC, start_time ASC
                        ";
$schedule = sql_fetch($select_schedule_query);
?>

<!-- 사용자 App footer -->
<footer class="app_footer">
	<div class="rolling_wrap">
        <?php
            if(!empty($schedule)){
        ?>
            <div class="schedule">
                <a href="javascript:void(0);">[My schedule] <?=$schedule['program_name']?> will start in 10 minutes.</a>
            </div>
        <?php
        }
        ?>
        <?php
            if(!empty($notice_list)){
        ?>
		<div class="notice">
			<div style="height:20px; overflow:hidden;">
				<ul>
                    <?php
                        foreach ($notice_list as $notice){
                    ?>
							<li><a href="/main/app_notice_detail.php?idx=<?=$notice['idx']?>">[NOTICE] <?=$notice['title_en']?> </a></li>
                    <?php
						}
                    ?>
				</ul>
			</div>
        <?php
        }
        ?>
		</div>
	</div>
	<div class="ft_inner">
		<ul class="ft_menu">
			<li>
				<a href="/main/app_index.php"><img src="/main/img/icons/icon_ft_home.svg" alt=""><span>HOME</span></a>
			</li>
			<li>
				<a href="/main/program_glance.php"><img src="/main/img/icons/icon_ft_program.svg" alt=""><span>PROGRAM</span></a>
			</li>
			<li class="round_menu">
				<a href="/main/app_qr_code.php">
					<div class="qr_blue">
						<img src="/main/img/icons/icon_ft_qr.svg" alt="">
					</div>
					<span>QR CODE</span>
				</a>
			</li>
			<li>
				<a href="/main/app_abstract.php"><img src="/main/img/icons/icon_ft_abstract.svg" alt=""><span>ABSTRACT</span></a>
			</li>
			<li>
				<a href="/main/app_schedule.php"><img src="/main/img/icons/icon_ft_schedule.svg" alt=""><span>MY SCHEDULE</span></a>
			</li>
		</ul>
	</div>
	<input type="hidden" name="total_notice" value="<?= count($notice_list); ?>">
</footer>

<script src="/main/js/jquery.vticker.js"></script>
<script>
	$(document).ready(function(){
		var total_notice = parseInt($("[name=total_notice]").val());
		if (total_notice > 0) {
			$('.notice > div').vTicker();
		}
	});
</script>