<?php
include_once('./include/head.php');

$session_user = $_SESSION['USER'] ?? NULL;
$session_app_type = (!empty($_SESSION['APP']) ? 'Y' : 'N');

if(!empty($session_user) && $session_app_type == 'Y') {
    include_once('./include/app_header.php');
} else {
    include_once('./include/header.php');
}

$sql_title =    "SELECT
						GROUP_CONCAT(title) AS title_concat
					FROM (
						SELECT 
							title_" . $language . " AS title
						FROM info_general_commitee
						WHERE is_deleted = 'N'
						AND title_" . $language . " <> ''
						GROUP BY title_" . $language . "
						ORDER BY idx
					) AS res";
$titles = explode(',', sql_fetch($sql_title)['title_concat']);

$add_section_class = (!empty($session_user) && $session_app_type == 'Y') ? 'app_version' : '';
?>

<!-- app일 시 section에 app_version 클래스 추가 -->
<section class="container organizing <?= $add_section_class; ?>">
	<!-- HUBDNCLHJ : app 메뉴 탭 -->
    <?php
        if(!empty($session_user) && $session_app_type == 'Y') {
    ?>
        <div class="app_title_box">
            <h2 class="app_title">ICOMES 2023<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
            <ul class="app_menu_tab">
                <li><a href="./welcome.php">Welcome Message</a></li>
                <li class="on"><a href="./organizing_committee.php">Organization</a></li>
                <li><a href="./app_overview.php">Overview</a></li>
                <li><a href="./venue.php">Venue</a></li>
            </ul>
        </div>
    <?php
        } 
    ?>
    <div>
    <h1 class="page_title">IMCVP 2024
		<div class="sub_btn_box">
				<a href="/main/welcome.php">Welcome Message</a>
				<a href="/main/organizing_committee.php" class="on">Organization</a>
				<a href="/main/overview.php">Overview</a>
			</div>
	</h1>
        <div class="inner">
            <h3 class="title">Organizing Committee</h3>
            <div class="table_wrap">
                <table class="c_table2 center_table fixed_table type1">
                    <colgroup>
                        <col width="380px">
                        <col width="200px">
                        <col width="*">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Affiliation</th>
                        </tr>
                    </thead>
                    <tbody class="cat1">
                        <!-- <img class="coming" src="./img/coming.png" /> -->
                        <tr>
                            <th>President</th>
                            <td>Won Young Lee</td>
                            <td>Sungkyunkwan University, Korea</td>
                        </tr>
                        <tr>
                            <th rowspan="4">Vice-president</th>
                            <td>Kyung-Yul Lee</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <td>Sang Hyun Ihm</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <td>Dae-Jung Kim</td>
                            <td>Ajou University, Korea</td>
                        </tr>
                        <tr>
                            <td>Hyuk Sang Kwon</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>Secretory General</th>
                            <td>Eun-Jung Rhee</td>
                            <td>Sungkyunkwan University, Korea</td>
                        </tr>
                        <tr>
                            <th rowspan="3">Vice Secretory General</th>
                            <td>Jun Hwa Hong</td>
                            <td>Eulji University Hospital, Korea</td>
                        </tr>
                        <tr>
                            <td>Dae Young Cheon</td>
                            <td>Hallym University, Korea</td>
                        </tr>
                        <tr>
                            <td>Kwon-Duk Seo</td>
                            <td>National Health Insurance Service Ilsan Hospital, Korea</td>
                        </tr>
                        <tr>
                            <th>Treasurer</th>
                            <td>Jae Hyuk Lee</td>
                            <td>Hanyang University, Korea</td>
                        </tr>
                        <tr>
                            <th>Scientific Program Committee</th>
                            <td>Seung-Hyun Ko</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>International Liaison Committee</th>
                            <td>Hyeon Chang Kim</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <th>Local Liaison Committee</th>
                            <td>Jong-Chan Youn</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>Public Relation Committee</th>
                            <td>Mee-Kyung Kim</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>Information Technology Committee</th>
                            <td>Sungha Park</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <th>Registration Committee</th>
                            <td>Yo-han Jeong</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <th>Accommodation & Transportation Committee</th>
                            <td>Hun-Jun Park</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>Sponsorship and Exhibition Committee</th>
                            <td>Hae-Young Lee</td>
                            <td>Seoul National University, Korea</td>
                        </tr>
                        <tr>
                            <th>Protocol and Social Program Committee</th>
                            <td>Sung-Hee Choi</td>
                            <td>Seoul National University, Korea</td>
                        </tr>
                        <tr>
                            <th>Publication Committee</th>
                            <td>Junghyun Noh</td>
                            <td>Inje University, Korea</td>
                        </tr>
                        <tr>
                            <th>Auditor</th>
                            <td>Jeong-Min Lee</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th rowspan="18">Domestic Faculty</th>
                            <td>Seong-Hoon Choi</td>
                            <td>Hallym University, Korea</td>
                        </tr>
                        <tr>
                            <td>Sang-Ho Jo</td>
                            <td>Hallym University, Korea</td>
                        </tr>
                        <tr>
                            <td>Sang Hak Lee</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <td>Sang Won Han</td>
                            <td>Inje University, Korea</td>
                        </tr>
                        <tr>
                            <td>Hyung-Min Kwon</td>
                            <td>Seoul National University, Korea</td>
                        </tr>
                        <tr>
                            <td>Woo-Baek Chung</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <td>Song Vogue Ahn</td>
                            <td>Ewha Womans University, Korea</td>
                        </tr>
                        <tr>
                            <td>Jae-sun Eom</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <td>Min-ho Shin</td>
                            <td>Chonnam National University, Korea</td>
                        </tr>
                        <tr>
                            <td>Kyung-Do Han</td>
                            <td>Soongsil University, Korea</td>
                        </tr>
                        <tr>
                            <td>JeongHyun Lim</td>
                            <td>Seoul National University Hospital, Korea</td>
                        </tr>
                        <tr>
                            <td>Kwang Joon Kim</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <td>Jong-Yun Lee</td>
                            <td>National Medical Center, Korea</td>
                        </tr>
                        <tr>
                            <td>Hun-Sung Kim</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <td>Jong-Young Lee</td>
                            <td>Sungkyunkwan University, Korea</td>
                        </tr>
                        <tr>
                            <td>Bum-Soon Choi</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <td>Suk Chon</td>
                            <td>Kyung Hee University, Korea</td>
                        </tr>
                        <tr>
                            <td>Jin Oh Na</td>
                            <td>Korea University, Korea</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- [240502] sujeong / 미확정 주석처리 -->
			<!-- <h3 class="title">Scientific Program Committee</h3>
            <div class="table_wrap">
                <table class="c_table2">
                    <colgroup>
                        <col width="380px">
                        <col width="200px">
                        <col width="*">
                    </colgroup>
					<thead>
						<tr>
							<th>Title</th>
							<th>Name</th>
							<th>Affiliation</th>
						</tr>
					</thead>
                    <tbody class="cat2">
                        <tr>
                            <th>Scientific Program Committee</th>
                            <td>Seung-Hyun Ko</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>International Liaison Committee</th>
                            <td>Hyeon Chang Kim</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <th>Local Liaison Committee</th>
                            <td>Jong-Chan Youn</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>Public Relation Committee</th>
                            <td>Mee-Kyung Kim</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>Information Technology Committee</th>
                            <td>Sungha Park</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <th>Registration Committee</th>
                            <td>Yo-han Jeong</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <th>Accommodation & Transportation Committee</th>
                            <td>Hun-Jun Park</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th>Sponsorship and Exhibition Committee</th>
                            <td>Hae-Young Lee</td>
                            <td>Seoul National University, Korea</td>
                        </tr>
                        <tr>
                            <th>Protocol and Social Program Committee</th>
                            <td>Sung-Hee Choi</td>
                            <td>Seoul National University, Korea</td>
                        </tr>
                        <tr>
                            <th>Publication Committee</th>
                            <td>Junghyun Noh</td>
                            <td>Inje University, Korea</td>
                        </tr>
                        <tr>
                            <th>Auditor</th>
                            <td>Jeong-Min Lee</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <th rowspan="18">Domestic Faculty</th>
                            <td>Seong-Hoon Choi</td>
                            <td>Hallym University, Korea</td>
                        </tr>
                        <tr>
                            <td>Sang-Ho Jo</td>
                            <td>Hallym University, Korea</td>
                        </tr>
                        <tr>
                            <td>Sang Hak Lee</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <td>Sang Won Han</td>
                            <td>Inje University, Korea</td>
                        </tr>
                        <tr>
                            <td>Hyung-Min Kwon</td>
                            <td>Seoul National University, Korea</td>
                        </tr>
                        <tr>
                            <td>Woo-Baek Chung</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <td>Song Vogue Ahn</td>
                            <td>Ewha Womans University, Korea</td>
                        </tr>
                        <tr>
                            <td>Jae-sun Eom</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <td>Min-ho Shin</td>
                            <td>Chonnam National University, Korea</td>
                        </tr>
                        <tr>
                            <td>Kyung-Do Han</td>
                            <td>Soongsil University, Korea</td>
                        </tr>
                        <tr>
                            <td>JeongHyun Lim</td>
                            <td>Seoul National University Hospital, Korea</td>
                        </tr>
                        <tr>
                            <td>Kwang Joon Kim</td>
                            <td>Yonsei University, Korea</td>
                        </tr>
                        <tr>
                            <td>Jong-Yun Lee</td>
                            <td>National Medical Center, Korea</td>
                        </tr>
                        <tr>
                            <td>Hun-Sung Kim</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <td>Jong-Young Lee</td>
                            <td>Sungkyunkwan University, Korea</td>
                        </tr>
                        <tr>
                            <td>Bum-Soon Choi</td>
                            <td>The Catholic University of Korea, Korea</td>
                        </tr>
                        <tr>
                            <td>Suk Chon</td>
                            <td>Kyung Hee University, Korea</td>
                        </tr>
                        <tr>
                            <td>Jin Oh Na</td>
                            <td>Korea University, Korea</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->
        </div>
    </div>
</section>

<?php 
    if (!empty($session_app_type) && $session_app_type == 'Y') {
        // mo일때
        include_once('./include/app_footer.php'); 
    }else {
        include_once('./include/footer.php');
    }
?>