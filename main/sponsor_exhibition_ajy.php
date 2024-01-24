<?php include_once('./include/head.php'); ?>
<?php
    $session_user = $_SESSION['USER'] ?? NULL;
    $session_app_type = (!empty($_SESSION['APP']) ? 'Y' : 'N');

    if(!empty($session_user) && $session_app_type == 'Y') {
        include_once('./include/app_header.php');
    } else {
        //include_once('./include/header.php');
		include_once('./include/app_header.php');
    }

    $add_section_class = (!empty($session_user) && $session_app_type == 'Y') ? 'app_version' : '';
?>

<!-- app일 시 section에 app_version 클래스 추가 -->
<section class="container sponsor app_tour_map exhibition <?= $add_section_class; ?> app_version">
	<!-- HUBDNCLHJ : app 메뉴 탭 -->
<?php
	//if(!empty($session_user) && $session_app_type == 'Y') {
    if(!empty($session_user) && $session_app_type == 'N') {
?>
	<div class="app_title_box">
		<h2 class="app_title">Sponsorship<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
		<ul class="app_menu_tab langth_2">
			<li><a href="./sponsor.php">Sponsorship</a></li>
			<li class="on"><a href="./sponsor_exhibition.php">Exhibition</a></li>
		</ul>
	</div>
<?php
    } 
?>
	<!-- HUBDNCLHJ : APP일시 아래 h1.page_title{Exhibition} 주석처리 후 app 메뉴 탭 주석해제 -->
<?php
	if (!empty($session_app_type) && $session_app_type == 'N') {
		// Web일때
?>
    <!-- <h1 class="page_title">Exhibition</h1> -->
<?php
    }
?>
	<!-- HUBDNCLHJ : APP일시 div.inner 주석 후 container_inner 주석해제 -->
    <!-- 앱 뷰 -->
<?php
    //if(!empty($session_user) && $session_app_type == 'Y') {
	if(!empty($session_user) && $session_app_type == 'N') {
?>
	<div class="container_inner">
		<div class="contents_box">
			<ul class="app_tab min_tab">
				<li class="on"><a href="javascript:;">3F</a></li>
				<li><a href="javascript:;">5F</a></li>
				<li><a href="javascript:;">6F</a></li>
			</ul>
			<div class="app_contents_wrap type2">
				<div class="floor floor_3 on">
					<div class="floor_map">
						<!-- <img src="/main/img/floor_map_3f.png" alt=""> -->
						<img src="/main/img/img_floor_3.png" alt="">
					</div>
					<div class="floor_table_wrap">
						<table class="floor_table">
							<colgroup>
								<col width="17%"/>
								<col width="25%"/>
								<col />
							</colgroup>
							<tbody>
								<tr>
									<td>01~03</td>
									<td class="aqua_td">Platinum</td>
									<td>Novo Nordisk</td>
								</tr>
								<tr>
									<td>04~05</td>
									<td class="gold_td">Gold</td>
									<td>Handok</td>
								</tr>
								<tr>
									<td>06</td>
									<td class="violet_td">Others</td>
									<td>viatris</td>
								</tr>
								<tr>
									<td>07~08</td>
									<td class="gold_td">Gold</td>
									<td>Yuhan</td>
								</tr>
								<tr>
									<td>09~10</td>
									<td class="gold_td">Gold</td>
									<td>Dong-A ST</td>
								</tr>
								<tr>
									<td>11~12</td>
									<td class="gold_td">Gold</td>
									<td>MSD</td>
								</tr>
								<tr>
									<td>13~14</td>
									<td class="gold_td">Gold</td>
									<td>inno.N</td>
								</tr>
								<tr>
									<td>15~18</td>
									<td class="pink_td">Diamond</td>
									<td>Alvogen</td>
								</tr>
								<tr>
									<td>19</td>
									<td class="violet_td">Others</td>
									<td>Novartis</td>
								</tr>
								<tr>
									<td>20</td>
									<td class="violet_td">Others</td>
									<td>Jeil Pharm</td>
								</tr>
								<tr>
									<td>21~22</td>
									<td class="gold_td">Gold</td>
									<td>Hanmi Pharm.</td>
								</tr>
								<tr>
									<td>23~24</td>
									<td class="gold_td">Gold</td>
									<td>Chong Kun Dang</td>
								</tr>
								<tr>
									<td>25~26</td>
									<td class="gold_td">Gold</td>
									<td>Daewoong</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="floor floor_5">
					<div class="floor_map">
						<!-- <img src="/main/img/floor_map_5f.png" alt=""> -->
						<img src="/main/img/img_floor_5.png" alt="">
					</div>
					<div class="floor_table_wrap">
						<table class="floor_table">
							<colgroup>
								<col width="17%"/>
								<col width="25%"/>
								<col />
							</colgroup>
							<tbody>
								<tr>
									<td>27~28</td>
									<td class="gold_td">Gold</td>
									<td>AstraZeneca</td>
								</tr>
								<tr>
									<td>29~30</td>
									<td class="silver_td">Silver</td>
									<td>LG Chem</td>
								</tr>
								<tr>
									<td>31</td>
									<td class="violet_td">Others</td>
									<td>SELVAS Healthcare</td>
								</tr>
								<tr>
									<td>32~33</td>
									<td class="silver_td">Silver</td>
									<td>Celltrion</td>
								</tr>
								<tr>
									<td>34</td>
									<td class="violet_td">Others</td>
									<td>Kukje Pharm</td>
								</tr>
								<tr>
									<td>35~36</td>
									<td class="silver_td">Silver</td>
									<td>GC Biopharma</td>
								</tr>
								<tr>
									<td>37~38</td>
									<td class="silver_td">Silver</td>
									<td>Sanofi</td>
								</tr>
								<tr>
									<td>39~40</td>
									<td class="bronze_td">Bronze</td>
									<td>Aju Pharm</td>
								</tr>
								<tr>
									<td>41</td>
									<td class="violet_td">Others</td>
									<td>Lphysio</td>
								</tr>
								<tr>
									<td>42~43</td>
									<td class="bronze_td">Bronze</td>
									<td>Kwangdong</td>
								</tr>
								<tr>
									<td>44~45</td>
									<td class="bronze_td">Bronze</td>
									<td>Daiichi-Sankyo</td>
								</tr>
								<tr>
									<td>46</td>
									<td class="violet_td">Others</td>
									<td>Eoflow</td>
								</tr>
								<tr>
									<td>47</td>
									<td class="violet_td">Others</td>
									<td>InBody</td>
								</tr>
								<tr>
									<td>48~49</td>
									<td class="bronze_td">Bronze</td>
									<td>Oraganon</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="floor floor_6">
					<div class="floor_map">
						<!-- <img src="/main/img/floor_map_6f.png" alt=""> -->
						<img src="/main/img/img_floor_6.png" alt="">
					</div>
					<div class="floor_table_wrap">
						<table class="floor_table">
							<colgroup>
								<col width="17%"/>
								<col width="25%"/>
								<col />
							</colgroup>
							<tbody>
								<tr>
									<td>50~51</td>
									<td class="bronze_td">Bronze</td>
									<td>Boryung</td>
								</tr>
								<tr>
									<td>52~53</td>
									<td class="bronze_td">Bronze</td>
									<td>BILLY</td>
								</tr>
								<tr>
									<td>54</td>
									<td class="lime_td">JOMES</td>
									<td>JOMES</td>
								</tr>
								<tr>
									<td>55~56</td>
									<td class="bronze_td">Bronze</td>
									<td>Dalimbiotech</td>
								</tr>
								<tr>
									<td>57</td>
									<td class="violet_td">Others</td>
									<td>Nexpharm Korea</td>
								</tr>
								<tr>
									<td>58~59</td>
									<td class="bronze_td">Bronze</td>
									<td>Daewon</td>
								</tr>
								<tr>
									<td>60</td>
									<td class="violet_td">Others</td>
									<td>Kuhnil</td>
								</tr>
								<tr>
									<td>61~62</td>
									<td class="bronze_td">Bronze</td>
									<td>Lilly</td>
								</tr>
								<tr>
									<td>63~64</td>
									<td class="bronze_td">Bronze</td>
									<td>JW Pahrmacutical</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div> 
		</div>
	</div>
<?php
    } 
?>
    <!-- 웹 뷰 -->
<?php
	if (!empty($session_app_type) && $session_app_type == 'N') {
		// Web일때
?>
    <!-- <div class="inner">
    		<div class="sponsor_exhibition">
    			<img class="coming" src="./img/coming.png" />
    		</div>
    	</div> -->
<?php
    }
?>
	
</section>

<script>
	$(document).ready(function() {
		$(window).resize(function() {
			if ($(window).width() > 480) {
				$(".sponsor_exhibition .clearfix2 > img").each(function() {
					var img_height = $(this).height();
					$(this).siblings("table").css("min-height", img_height)
					$(this).siblings(".in_clear").css("min-height", img_height)
					var div_height = $(this).siblings(".in_clear").height();
					$(this).siblings(".in_clear").find("table").css("min-height", div_height)
					//console.log(div_min_height);
				});
			}
		});
		$(window).trigger("resize");
	});

	// Tour Map 층별 탭
	$(".app_tour_map .app_tab li").click(function(){
		var i = $(this).index();
		$(".app_contents_wrap").children(".floor").removeClass("on");
		$(".app_contents_wrap").children(".floor").eq(i).addClass("on");
	});
</script>


<?php 
    if (!empty($session_app_type) && $session_app_type == 'Y') {
        // mo일때
        include_once('./include/app_footer.php'); 
    }else {
        //include_once('./include/footer.php');
		include_once('./include/app_footer.php');
    }
?>