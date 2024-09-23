<?php
	include_once('./include/head.php');
	include_once('./include/header.php');

	$member_idx = $_GET["idx"];
	if(!$member_idx) {
		echo"<script>alert('비정상적인 접근 방법입니다.'); window.location.replace('./member_list.php');</script>";
		exit;
	}
	if($admin_permission["auth_account_member"] == 0){
		echo '<script>alert("권한이 없습니다.");history.back();</script>';
	}

	$member_registration_query =	"
										SELECT
											rr.idx, rr.member_type, rr.attendance_type, rr.etc2, DATE_FORMAT(rr.register_date, '%y-%m-%d') AS regist_date,
											p.total_price_us, p.total_price_kr, rr.status,
											(CASE
													WHEN rr.status = '0'
													THEN '등록취소'
													WHEN rr.status = '1'
													THEN '결제대기'
													WHEN rr.status = '2'
													THEN '결제완료'
													WHEN rr.status = '3'
													THEN '환불대기'
													WHEN rr.status = '4'
													THEN '환불완료'
													WHEN rr.status = '5'
													THEN '현장등록'
													WHEN rr.status = '6'
													THEN '프로모션등록'
													WHEN rr.status = '7'
													THEN '그룹등록'
													ELSE '-'
											END) AS registration_status,
                                            (CASE
                                                WHEN rr.registration_type = '2'
                                                THEN '위원회'
                                                WHEN rr.registration_type = '1'
                                                THEN '연설자'
                                                WHEN rr.registration_type = '0'
                                                THEN '일반참가자'
                                                ELSE '-'
                                            END) AS registration_type,
											(CASE
												WHEN rr.attendance_type = '0'
												THEN 'Offline'
												WHEN rr.attendance_type = '1'
												THEN 'Online'
												WHEN rr.attendance_type = '2'
												THEN 'Online + Offline'
												ELSE '-'
											END) AS attendance_type,
											(CASE rr.attendance_type
													WHEN '0' THEN 'Committee'
													WHEN '1' THEN 'Speaker'
													WHEN '2' THEN 'Chairperson'
													WHEN '3' THEN 'Panel'
													WHEN '4' THEN 'Participants'
													ELSE '-'
												END
											) AS attendance_type_text,
                                            (CASE
                                                WHEN rr.is_score = '1'
                                                THEN '신청'
                                                WHEN rr.is_score = '0'
                                                THEN '미신청'
                                                ELSE '-'
                                            END) AS is_score
										FROM request_registration rr
										LEFT JOIN payment p
										ON rr.payment_no = p.idx
										WHERE rr.is_deleted = 'N'
										AND rr.register = {$member_idx}
									";
	$member_registration = get_data($member_registration_query);

?>
<style>
	.no_data {font-size: 18px; text-align: center;}
</style>
	<section class="detail">
		<div class="container">
			<div class="title clearfix2">
				<h1 class="font_title">일반회원</h1>
			</div>
			<div class="contwrap has_fixed_title">
				<?php include_once("./include/member_nav.php");?>
				<table class="list_table">
					<thead>
						<tr class="tr_center">
							<th>결제상태</th>
							<th>Member Type</th>
							<th>참석유형</th>
							<th>Registration Fee</th>
							<th>Online/Offline</th>
							<th>평점신청여부</th>
							<th>신청협회</th>
							<th>등록일</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if(!$member_registration) {
							echo "<tr><td class='no_data' colspan='8'>No Data</td></tr>";
						} else {

							foreach($member_registration as $member_registration) {

								$registration_idx = isset($member_registration["idx"]) ? $member_registration["idx"] : "";
								$member_type = isset($member_registration["member_type"]) ? $member_registration["member_type"] : "";
								$registration_type = isset($member_registration["registration_type"]) ? $member_registration["registration_type"] : "";
								$attendance_type_text = isset($member_registration["attendance_type_text"]) ? $member_registration["attendance_type_text"] : "";
								$payment_price = isset($member_registration["total_price_us"]) ? "$ ".$member_registration["total_price_us"] : (isset($member_registration["total_price_kr"]) ? "￦ ".$member_registration["total_price_kr"] : "-");
								$is_score = isset($member_registration["is_score"]) ? $member_registration["is_score"] : "";
								
								//평점신청협회 DB에서 select (21.11.03)
								$result_org		= isset($member_registration["etc2"]) ? $member_registration["etc2"] : "";
								$result_org = explode(",",$result_org);
								foreach($result_org as $key => $value){
									$apply_org_query =	"
															SELECT
																iao.idx,iao.org_en,iao.org_ko
															FROM info_apply_org iao
															WHERE iao.idx = {$value}
															AND is_deleted = 'N'
														";
									$apply_org_data = sql_fetch($apply_org_query);
									$result_org[$key] = $language == "en" ? $apply_org_data['org_en'] : $apply_org_data['org_ko'];
								}

								$register_date = isset($member_registration["regist_date"]) ? $member_registration["regist_date"] : "";
								$attendance_type = isset($member_registration["attendance_type"]) ? $member_registration["attendance_type"] : "";
								$registration_status = isset($member_registration["registration_status"]) ? $member_registration["registration_status"] : "";

								$status = isset($member_registration["status"]) ? $member_registration["status"] : "";
								if($status == 0 || $status == 1) {
									$payment_price = "-";
								}
					?>
						<tr class="tr_center">
							<td><a href="./registration_detail.php?idx=<?=$registration_idx?>"><?=$registration_status?></a></td>
							<td><?=$member_type?></td>
							<td><?=$attendance_type_text?></td>
							<td><?=$payment_price?></td>
							<td>On-site</td>
							<td><?=$is_score?></td>
							<td>-</td>
							<td><?=$register_date?></td>
						</tr>
					<?php
							}
						}
					?>
					</tbody>
				</table>
				<div class="btn_wrap">
					<button type="button" class="border_btn" onclick="location.href='./member_list.php'">목록</button>
				</div>
			</div>
		</div>
	</section>
<script>
$(document).ready(function(){
	$(".tab_wrap").children("li").eq(3).addClass("active");
});
</script>
<?php include_once('./include/footer.php');?>