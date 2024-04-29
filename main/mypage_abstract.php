
<?php include_once('./include/head.php'); ?>
<?php include_once('./include/header.php'); ?>

<?php
$user_idx = $member["idx"] ?? -1;

// [22.04.25] 미로그인시 처리
if ($user_idx <= 0) {
    echo "<script>alert('Need to login'); location.replace(PATH+'login.php');</script>";
    exit;
}

$my_submission_list_query = "
		SELECT
			rs.idx, rs.`status`, rs.submission_code, rs.etc2,
			IFNULL(rs.title, '-') AS title,
			(
				CASE rs.`status`
					WHEN 0 THEN 'In progress'
					WHEN 1 THEN 'Complete'
				END
			) AS status_text,
			DATE(rs.register_date) AS register_ymd
		FROM request_submission AS rs
		WHERE rs.is_deleted = 'N'
		AND rs.register = '{$user_idx}'
		ORDER BY rs.idx DESC
	";


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
?>

<section class="container mypage sub_page">
<h1 class="page_title">Mypage</h1>
    <div class="inner bottom_short">
        <ul class="tab_green">
			<li><a href="./mypage.php">Account</a></li>
			<li><a href="./mypage_registration.php">Registration</a></li>
			<li class="on"><a href="./mypage_abstract.php">Abstract</a></li>
		</ul>
        <!-- <div class="sub_banner"> -->
        <!-- 	<h1>Mypage</h1> -->
        <!-- </div> -->
        <div>
            <div class="x_scroll">
                <table class="table_vertical registration_table">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="5%">
                        <col width="350px">
                        <col width="5%">
                        <col width="5%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Submission No.</th>
                            <th>Abstract of Accepted</th>
                            <!-- [240419] sujeong / title 글자 넘치지 않도록 -->
                            <th class="abstract_title_box">Title</th>
                            <th>Status</th>
                            <th>Date of Submission</th>
							<th>Modify / Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!$submission_list) {
                            echo "<tr><td colspan='6' class='centerT'>No Data</td></tr>";
                        } else {
                            for ($i = $start_row; $i <= $end_row; $i++) {
                                $sb = $submission_list[$i];
                        ?>
                       
                        <tr>
                            <td><?= $i + 1 ?></td>
							<td><?= $sb["submission_code"] ?></td>
							<td><?php echo $sb["etc2"] == 'Y' ? 'Accepted' : 'Non-Accepted' ?></td>
                            <td class="abstract_title_box">
                                <!-- <div class="abstract_title_box"> -->
                                    <?= strip_tags(htmlspecialchars_decode($sb["title"], ENT_QUOTES)) ?>
                                <!-- </div> -->
                            </td>
                            <td><?= $sb["status_text"] ?></td>
                            <td><?= $sb["register_ymd"] ?></td>
                            <td>
                                <?php
                                        if ($sb['status'] == 0) {
                                        ?>
                                <button type="button" class="btn modify_btn"
                                    onclick="javascript:location.href='./abstract_submission.php?idx=<?= $sb["idx"] ?>'">Modify</button>
                                <?php
                                        } else {
                                        ?>
                                <button type="button" class="btn modify_btn"
                                    onclick="javascript:location.href='./abstract_submission3.php?idx=<?= $sb["idx"] ?>'">Detail</button>
                                <?php
                                        }
                                        ?>
                                <button type="button" class="btn delete_btn"
                                    data-idx="<?= $sb['idx'] ?>">Delete</button>
                            </td>
                        </tr>

                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?= $paging_html; ?>
    </div>
</section>

<script>
const _PERIOD = JSON.parse('<?= json_encode($_PERIOD) ?>');
$(".table_open").click(function() {
    var member_idx = "<?= $_SESSION['USER']['idx'] ?>";
    var admin_idx = "<?= $_SESSION['ADMIN']['idx'] ?>";

    if (!member_idx && admin_idx) {
        alert('사용자 로그인 후 이용해주세요.');
    } else {
        $.ajax({
            url: "/main/ajax/client/ajax_lecture.php?flag=calc_score",
            type: "GET",
            dataType: "JSON",
            success: function(res) {
                var ymd, inner, day;
                _PERIOD.forEach(function(ymd, index) {
                    // daily
                    day = res.entrance_log[ymd];
                    inner = '';
                    if (day.watch_mins <= 0) {
                        inner += '<tr class="centerT"><td colspan="4">No Data</td></tr>';
                    } else {
                        inner += '<tr>';
                        inner += '<td>' + day.entrance_date + '</td>';
                        inner += '<td>' + day.exit_date + '</td>';
                        inner += '<td>' + day.watch_time + ' h</td>';
                        inner += '</tr>';
                    }
                    $('[name=lecs]').eq(index).html(inner);
                    $('[name=total_watch_time]').eq(index).html(day.watch_time + " h");

                    // score
                    inner = '';
                    if (res.score.length <= 0) {
                        inner += '<tr class="centerT"><td colspan="4">No Data</td></tr>';
                    } else {
                        res.score.forEach(function(group) {
                            inner += '<tr>';
                            inner += '<th>' + group.name + '</th>';
                            inner += '<td>' + group[ymd] + ' 점</td>';
                            inner += '<td>' + group.total + ' 점</td>';
                            inner += '</tr>';
                        });
                    }
                    $('[name=score]').eq(index).html(inner);
                });

                $(".table_pop").addClass("on");
            },
            error: function() {
                alert("일시적으로 요청이 거절되었습니다.");
            }
        });
    }
});

//탭
$(".table_pop .tab_pager li").click(function() {
    var _this = $(this);

    var _targets = $(".table_pop .tab_pager li");
    var i = 0;
    _targets.each(function(index) {
        if ($(this).children('a').text() == _this.children('a').text()) {
            i = index;
            return false;
        }
    });
    _targets.removeClass("on");
    _this.addClass("on");

    var _conts = _this.parents('ul').siblings('.tab_wrap').children('.tab_cont');
    _conts.removeClass("on");
    _conts.eq(i).addClass("on");
});
</script>
<script>
$(document).ready(function() {
    $(".delete_btn").on("click", function() {
        var idx = $(this).data("idx");
        if (confirm(locale(language.value)("submission_cancel_msg"))) {
            $.ajax({
                url: PATH + "ajax/client/ajax_submission2024.php",
                type: "POST",
                data: {
                    flag: "delete",
                    idx: idx
                },
                dataType: "JSON",
                success: function(res) {
                    if (res.code == 200) {
                        alert(locale(language.value)("complet_submission_cancel"));
                        location.reload();
                    } else if (res.code == 400) {
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

    $(".modfy_btn").on("click", function() {
        <?php
            $_SESSION["abstract"] = "";
            ?>
    })
});
</script>
<?php include_once('./include/footer.php'); ?>