<?php
	include_once('./include/head.php');

	$session_user = $_SESSION['USER'] ?? NULL;
	$session_app_type = (!empty($_SESSION['APP']) ? 'Y' : 'N');

	//230714 HUBDNC 앱 로그인 시 파라미터 추가 된 부분
	if(!empty($session_user) && $session_app_type == 'Y') {
		include_once('./include/app_header.php');
	} else {
		include_once('./include/header.php');
	}

	$add_section_class = (!empty($session_user) && $session_app_type == 'Y') ? 'app_version' : '';
?>

<!-- app일 시 app_version 클래스 추가 -->
<section class="container registration registration_rating_guides top_btn_move <?= $add_section_class; ?>">
	<!-- HUBDNCLHJ : app 메뉴 탭 -->
<?php
	if(!empty($session_user) && $session_app_type == 'Y') {
?>
	<div class="app_title_box">
		<h2 class="app_title kor">평점 안내<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
	</div>
<?php
	} 
?>
	<!-- APP에선 h1.page_title{평점 안내} 주석처리 후 위 app 메뉴 탭 주석해제 -->
	<!-- HUBDNCHYJ : Web 에서는 이 클래스 사용하시면 됩니다. -->
<?php
	if (!empty($session_app_type) && $session_app_type == 'N') {
		// Web일때
?>

<?php
	}
?>
    <h1 class="page_title">Registration
			<div class="sub_btn_box">
				<a href="/main/registration_guidelines.php">Guidelines</a>
				<a href="/main/registration.php">Go to Registration</a>
				<a href="/main/registration_rating_guides.php" class="on kor">평점안내</a>
			</div>
		</h1>
	<!-- <div class="inner"> -->
	<!-- 	<img class="coming" src="./img/coming.png"> -->
	<!-- </div> -->
	<div class="inner">
		<!-- 1. 연수 평점 안내 start -->
		<h3 class="title">CME Credits (Korean Only)<br class="mb_only"/><span class="red_t bold kor">&nbsp;&nbsp;** 11월 29일(금)부터 30일(토) 내에 이수한 강의만 평점 인정됩니다.</span></h3>
		<div class="details">
			<!-- <ul class="indent_ul">
				<li>• 'ICOMES 2023' 참가에 따른 평점을 아래와 같이 안내해 드립니다.</li>
				<li>• 평점 신청을 위해 참가등록 시 면허번호 및 자격번호를 정확히 입력해 주십시오.</li>
				<li>• 면허번호 및 자격번호 오류 시 평점 이수 명단에서 누락될 수 있습니다.</li>
				<li>• 교육 시간이 중복될 경우 중복되는 시간의 평점은 인정되지 않습니다.</li>
			</ul> -->
		</div>
	    <!-- 1. 연수 평점 안내 end -->

		<!-- 2. 제공 평점 start -->
		<h3 class="title kor">제공 평점 <!--<span class="red_txt font_inherit">(예정)</span>--></h3>
		<div class="details">
			<div class="table_wrap x_scroll">
				<table class="c_table2 detail_table center type1 kor">
					<thead>
						<tr>
							<th class="kor">구분</th>
							<th class="kor">11/29(금)</th>
							<th class="kor">11/30(토)</th>
							<th class="kor">합계</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="kor">대한의사협회</td>
							<td class="kor">최대 6평점<span class="red_t bold">(예상)</span></td>
							<td class="kor">최대 6평점<span class="red_t bold">&nbsp;(예상)</span></td>
							<td class="kor">최대 12평점<span class="red_t bold">&nbsp;(예상)</span></td>
						</tr>
						<!-- <tr>
							<td class="kor">내과전공의 외부학술회의(학술대회)</td>
							<td class="kor">최대 2평점</td>
							<td class="kor">최대 2평점</td>
							<td class="kor">최대 4평점</td>
						</tr>
						<tr>
							<td class="kor">기타</td>
							<td class="kor">해당 없음</td>
							<td class="kor">해당 없음</td>
							<td class="kor">해당 없음</td>
						</tr> -->
						<!-- <tr>
							<td>한국영양교육평가원 임상영양사 <br/>전문연수교육(CPD)</td>
							<td colspan="3">5평점 <br/><span class="font_small">* 5시간 이상 참석 필수</span></td>
						</tr>
						<tr>
							<td>대한운동사협회</td>
							<td>없음</td>
							<td colspan="2">40평점<br/><span class="font_small">* 부분 평점 없음. 6시간 참석 필수</span></td>
						</tr> -->
					</tbody>
				</table>
			</div>
		</div>
		<!-- 2. 제공 평점 end -->

		<!-- 3. 이수 시간에 따른 부분 평점 및 주의사항 안내 start -->
		<!-- <h3 class="title">이수 시간에 따른 부분 평점 및 주의사항 안내</h3>
		<div class="details">
			<div class="table_wrap x_scroll">
				<table class="c_table2 detail_table center">
					<thead>
						<tr>
							<th>구분</th>
							<th>11월 29일(금)</th>
							<th>11월 30일(토)</th>
						</tr>
						<tr>
							<th>시스템 기록에 따른 이수 시간</th>
							<th colspan="2">인정평점</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1시간 미만</td>
							<td>없음</td>
							<td>없음</td>
						</tr>
						<tr>
							<td>1시간 이상 ~ 2시간 미만</td>
							<td>1평점</td>
							<td>1평점</td>
						</tr>
						<tr>
							<td>2시간 이상 ~ 3시간 미만</td>
							<td>2평점</td>
							<td>2평점</td>
						</tr>
						<tr>
							<td>3시간 이상 ~ 4시간 미만</td>
							<td>3평점</td>
							<td>3평점</td>
						</tr>
						<tr>
							<td>4시간 이상 ~ 5시간 미만</td>
							<td>4평점</td>
							<td>4평점</td>
						</tr>
						<tr>
							<td>5시간 이상 ~ 6시간 미만</td>
							<td>5평점</td>
							<td>5평점</td>
						</tr>
						<tr>
							<td>6시간 이상</td>
							<td>6평점</td>
							<td>6평점</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mt10">
				<ul class="indent_ul">
					<li>• 이수 시간은 학술대회장에 설치된 '입출결 확인 시스템'으로 기록됩니다.</li>
					<li class="bold">• 입실 시와 퇴실 시 1일 2회 명찰 혹은 어플리케이션의 QR 코드를 입출결 확인 시스템에 태깅하여 주십시오.</li>
					<li>• 입/퇴실 시 QR 코드를 태깅하지 않은 경우 이수 시간이 인정되지 않습니다.</li>
					<li class="red_txt bold">• 휴게 시간은 이수 시간에 포함되지 않습니다.</li>
					<li class="red_txt bold">• 이수 시간은 학술대회 시작 시간부터 종료 시간 내에서만 인정됩니다.</li>
					<li>• 학술대회 종료 후, 학회 사무국에서 취합된 명단을 의사협회 연수 교육 시스템에 등록하여 자동으로 평점이 부여됩니다(약 4주 소요). 개인에게 평점카드를 발급하지 않습니다.</li>
				</ul>
			</div>
		</div> -->
		<!-- 3. 이수 시간에 따른 부분 평점 및 주의사항 안내 end -->
		 <h3 class="title kor">평점인정기준<br class="mb_only"/><span class="red_t bold kor">&nbsp;&nbsp;** 수강 시간의 총합으로 평점 발급</span></h3>
		<div class="details">
			<div class="table_wrap x_scroll flex_table">
				<table class="c_table2 detail_table center type1 ">
					<thead>
						<tr>
							<th class="kor">구분</th>
							<th class="kor">기준<span class="red_t bold">&nbsp;(예상)</span></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="kor">의사협회</td>
							<td class="kor line6">
							1시간 이상 2시간 미만: 1평점<br/>
							2시간 이상 3시간 미만: 2평점<br/>
							3시간 이상 4시간 미만: 3평점<br/>
							4시간 이상 5시간 미만: 4평점<br/>
							5시간 이상 6시간 미만: 5평점<br/>
							6시간 이상: 6평점(1일 최대 이수가능평점)
							</td>
						</tr>
					</tbody>
				</table>
				<!-- <table class="c_table2 detail_table center type1">
					<thead>
						<tr>
							<th colspan="2" class="kor">구분</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="kor">내과전공의 외부학술회의</td>
							<td class="kor line6">
							본인 참석(대리 출석 불가),<br/>
							일별 2회 이상 출결체크(입장, 퇴장) <br/>
							완료한 내과 전공의만 해당
							</td>
						</tr>
						<tr>
							<td class="kor">기타</td>
							<td class="kor">해당 없음</td>
						</tr>
					</tbody>
				</table> -->
			</div>

			<!-- <div class="mt10">
				<ul class="indent_ul">
					<li>• 이수 시간은 학술대회장에 설치된 '입출결 확인 시스템'으로 기록됩니다.</li>
					<li class="bold">• 입실 시와 퇴실 시 1일 2회 명찰 혹은 어플리케이션의 QR 코드를 입출결 확인 시스템에 태깅하여 주십시오.</li>
					<li>• 입/퇴실 시 QR 코드를 태깅하지 않은 경우 이수 시간이 인정되지 않습니다.</li>
					<li class="red_txt bold">• 휴게 시간은 이수 시간에 포함되지 않습니다.</li>
					<li class="red_txt bold">• 이수 시간은 학술대회 시작 시간부터 종료 시간 내에서만 인정됩니다.</li>
					<li>• 학술대회 종료 후, 학회 사무국에서 취합된 명단을 의사협회 연수 교육 시스템에 등록하여 자동으로 평점이 부여됩니다(약 4주 소요). 개인에게 평점카드를 발급하지 않습니다.</li>
				</ul>
			</div> -->
		</div>
		<h3 class="title kor">출결방법(오프라인 참석)<br class="mb_only"/><span class="red_t bold kor">&nbsp;&nbsp;** 현장 1일 최소 2회의 QR코드 미 태그 시, 평점 인정이 불가합니다.</span></h3>
		<div class="text_box">
			<ul>
				<li class="kor">• 현장 1일 최소 2회의 QR 태그 필수</li>
				<li class="kor">• 출결 시간은 최초 입장 시간과 최종 퇴장시간으로 산출합니다.</li>
				<li class="kor">• 출결 시간 산출은 의협 평점 이수 시간 기준으로 운영됩니다.</li>
			</ul>
        </div>
   </div>
</section>
<button type="button" class="btn_fixed_triangle fixed_btn_pc pc_only" onClick="location.href='./registration.php'">
    <img src="/main/img/icons/2024_regi_icon.svg"/>
</button>

<?php 
    if (!empty($session_app_type) && $session_app_type == 'Y') {
        // mo일때
        include_once('./include/app_footer.php'); 
    }else {
        include_once('./include/footer.php');
    }
?>