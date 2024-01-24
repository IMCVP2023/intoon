<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php
    $user_idx = $member["idx"] ?? -1;
	
	// [22.04.25] 미로그인시 처리
	if($user_idx <= 0) {
		echo "<script>alert('Need to login'); location.replace(PATH+'login.php');</script>";
		exit;
	}

	$sql_during =	"SELECT
						IF(DATE(NOW()) >= '2022-09-12', 'Y', 'N') AS yn
					FROM info_event";
	$during_yn = sql_fetch($sql_during)['yn'];

	$score_sql = "SELECT
						*
					FROM score_second
					WHERE mb_idx = '{$user_idx}'";

	$score_detail = sql_fetch($score_sql);

	if(empty($score_detail)) {
		echo "<script>alert('Only those who attend the event can check.'); location.replace(PATH+'mypage.php');</script>";
		exit;
	}
	
	$time1 = $score_detail['time1'];
	$time2 = $score_detail['time2'];
	$time3 = $score_detail['time3'];
	$score1 = $score_detail['score1'];
	$score2 = $score_detail['score2'];
	$score3 = $score_detail['score3'];
	$score4 = $score_detail['score4'];

	$time1 = time_all($time1, $score1);
	$time2 = time_all($time2, $score1);
	$time3 = time_all($time3, $score1);
	
	function time_all($time, $score1) {

		if($score1 == 0) {
			$time = 0;
		}
		return $time;
	}

	$only_sql = "SELECT
					MAX(rr.idx) AS idx
				FROM request_registration AS rr
				LEFT JOIN member AS mb
					ON mb.idx = rr.register
				LEFT JOIN payment AS pa
					ON pa.idx = rr.payment_no
				WHERE rr.register = {$user_idx}
				AND rr.is_deleted = 'N'
				AND rr.`status` = 2
				GROUP BY rr.idx";

	$only_idx = sql_fetch($only_sql)['idx'];
?>

<section class="container mypage">
	<div class="sub_banner">
		<h1>My page</h1>
	</div>
	<ul class="tab_green">
		<li><a href="./mypage.php">Account</a></li>
		<li><a href="./mypage_registration.php">Registration</a></li>
		<li><a href="./mypage_abstract.php">Abstract</a></li>
		<?php
			if($during_yn == 'N') {
		?>
			<li class="text_center"><a href="javascript:;" onclick="javascript:alert('행사 종료 후 9월 12일(월)부터 확인 가능합니다.');">평점 확인 (Korean Only)</a></li>
			<li class="text_center"><a href="javascript:;" onclick="javascript:alert('행사 종료 후 9월 12일(월)부터 확인 가능합니다.');">Certification of Completion</a></li>
		<?php
			}
			if(!empty($score_detail)) {
		?>
			<li class="text_center on"><a href="./mypage_score.php">평점 확인 (Korean Only)</a></li>
		<?php
			}
			if(!empty($only_idx)) {
		?>
			<li class="text_center"><a href="./mypage_certification.php">Certification of Completion</a></li>
		<?php
			} 
		?>
	</ul>
	<div class="details table_wrap icomes_air">
		<table class="c_table mypage_score_table">
			<thead>
				<tr>
					<th></th>
					<th>참석날짜</th>
					<th>9월 1일(목)</th>
					<th>9월 2일(금)</th>
					<th>9월 3일(토)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="2" class="light_gray_bg">의사</td>
					<td>대한의사협회 연수평점</td>
					<td class="font_16"><?= number_format($time1);?>평점</td>
					<td class="font_16"><?= number_format($time2);?>평점</td>
					<td class="font_16"><?= number_format($time3);?>평점</td>
				</tr>
				<tr>
					<td>총평점</td>
					<td class="font_16" colspan="3"><?= number_format($score1);?>평점</td>
				</tr>
				<tr>
					<td class="light_gray_bg ">영양사</td>
					<td>한국영양교육평가원<br>임상영양사<br>전문연수교육(CPD)</td>
					<td class="font_20" colspan="3"><?= number_format($score3);?>평점</td>
				</tr>
				<tr>
					<td class="light_gray_bg">운동사</td>
					<td>대한운동사협회</td>
					<td class="font_20" colspan="3"><?= number_format($score4);?>평점</td>
				</tr>
			</tbody>
		</table>
	</div>
	<ul class="mypage_score_ul">
		<li>• 의사협회 1일 교육상한 점수는 6평점이며, 교육시간이 중복되는 교육 중복 참가는 불인정됩니다.</li>
		<li>• 모든 참가자에게 비만전문인정의 평점이 부여되며, 기준은 의사협회와 동일합니다.</li>
	</ul>
</section>


<?php include_once('./include/footer.php');?>