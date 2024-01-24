<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php
	$nation_query = "SELECT
							*
						FROM nation
						ORDER BY 
						idx = 25 DESC, nation_en ASC";
	$nation_list_query = $nation_query;
	$nation_list = get_data($nation_list_query);

	$user_info = $member;

	// [22.04.25] 미로그인시 처리
	if(!$user_info) {
		echo "<script>alert('Need to login'); location.replace(PATH+'login.php');</script>";
		exit;
	}

	$user_idx = $member["idx"] ?? -1;

	$sql_during =	"SELECT
						IF(DATE(NOW()) >= '2022-09-12', 'Y', 'N') AS yn
					FROM info_event";
	$during_yn = sql_fetch($sql_during)['yn'];

	$score_sql = "SELECT
						*
					FROM score_second
					WHERE mb_idx = '{$user_idx}'";

	$score_detail = sql_fetch($score_sql);

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

	if(empty($only_idx)) {
		echo "<script>alert('Only those who attend the event can check.'); location.replace(PATH+'mypage.php');</script>";
		exit;
	}
?>

<section class="container mypage mypage_certification">
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
			<li class="text_center"><a href="./mypage_score.php">평점 확인 (Korean Only)</a></li>
		<?php
			}
			if(!empty($only_idx)) {
		?>
			<li class="text_center on"><a href="./mypage_certification.php">Certification of Completion</a></li>
		<?php
			} 
		?>
	</ul>
	<div class="text_box text_center">
		<p class="text_center">* Thank you very much for participating in ICOMES 2022.<br/>The Certification can be downloaded by clicking the button below.</p>
		<a href="javascript:;" class="btn long_btn korean_only"><img src="./img/icons/icon_download_yellow.svg" alt="">Certification of Completion</a>
	</div>
</section>
<script>
	$(document).ready(function(){
		$(".korean_only").on("click", function(){
			var url = "./pre_registration_korean_only.php";
			window.open(url,"Registration Receipt","width=793, height=2000, top=30, left=30");
		});
	});
</script>
<?php include_once('./include/footer.php');?>