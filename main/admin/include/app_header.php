<!-- APP 관리자 header 입니다 -->
<header class="header clearfix hidden-print app_header">
	<div class="login clearfix2">
		<ul class="clearfix ">
			<li class="logo"><a href="./member_list.php" ></a></li>
		</ul>
		<!-- 홍유진 수정 작업본 -->
		<ul class="clearfix menu ">
<!-- 			<li><a href="http://access.icomes.or.kr/access"><img src="./img/icon_qr.png" alt=""></a></li> -->
			<li>
				<a href="javascript:;" class="setting_open"><img src="./img/icon_settings.png" alt=""></a>
				<div class="setting_toggle">
					<a href="./mypage.php"><img src="./img/icon_mypage.png" alt=""> 마이페이지</a>
					<a href="javascript:;" class="logout_btn"><img src="./img/icon_logout.png" alt=""> 로그아웃</a>
				</div>
			</li>
		</ul>
	</div>
</header>
<nav class="nav app_nav">
	<ul>
		<!-- <li class="main_nav"><a href="javascript:;">회원관리</a></li> -->
		<!-- <li class="main_nav"><a href="javascript:;">프로그램 관리</a></li> -->
		<li class="main_nav"><a href="javascript:;">Notice 관리</a></li>
		<!-- <li class="main_nav"><a href="javascript:;">Sponsorship 관리</a></li> -->
		<!-- <li class="main_nav"><a href="javascript:;">File Upload</a></li> -->
	</ul>
</nav>
<script>
	//app_nav 메뉴 클릭
	$(".app_nav li").on("click", function(){
		let idx = $(this).index();
		$(".app_nav li").removeClass('on');
		$(this).eq(idx+1).addClass('on');
	});

	$(".logout_btn").on("click", function(){
		$.ajax({
			url : "../ajax/admin/ajax_admin.php",
			type : "POST",
			data : {
				flag : "logout"
			},
			dataType : "JSON",
			success : function() {
					location.replace("./");
			},
			error : function() {
				alert("일시적으로 로그아웃 요청이 거절되었습니다.");
				return false;
			}
		});
	});

	$(document).ready(function(){
		var auth_account_member = <?=$admin_permission["auth_account_member"]?>;
		var auth_account_admin = <?=$admin_permission["auth_account_admin"]?>;
		var auth_apply_poster = <?=$admin_permission["auth_apply_poster"]?>;
		var auth_apply_lecture = <?=$admin_permission["auth_apply_lecture"]?>;
		var auth_apply_registration = <?=$admin_permission["auth_apply_registration"]?>;
		var auth_apply_sponsorship = <?=$admin_permission["auth_apply_sponsorship"]?>;
		var auth_page_event = <?=$admin_permission["auth_page_event"]?>;
		var auth_page_main = <?=$admin_permission["auth_page_main"]?>;
		var auth_page_general = <?=$admin_permission["auth_page_general"]?>;
		var auth_page_poster = <?=$admin_permission["auth_page_poster"]?>;
		var auth_page_lecture = <?=$admin_permission["auth_page_lecture"]?>;
		var auth_page_registration = <?=$admin_permission["auth_page_registration"]?>;
		var auth_page_sponsorship = <?=$admin_permission["auth_page_sponsorship"]?>;
		var auth_live_popup = <?=$admin_permission["auth_live_popup"]?>;
		var auth_live_lecture = <?=$admin_permission["auth_live_lecture"]?>;
		var auth_live_lecture_qna = <?=$admin_permission["auth_live_lecture_qna"]?>;
		var auth_live_abstract = <?=$admin_permission["auth_live_abstract"]?>;
		var auth_live_conference = <?=$admin_permission["auth_live_conference"]?>;
		var auth_live_event = <?=$admin_permission["auth_live_event"]?>;
		var auth_board_news = <?=$admin_permission["auth_board_news"]?>;
		var auth_board_notice = <?=$admin_permission["auth_board_notice"]?>;
		var auth_board_faq = <?=$admin_permission["auth_board_faq"]?>;

		if(auth_account_member == 0){
			$('nav li.member').hide();
		}
		if(auth_account_admin == 0){
			$('nav li.admin').hide();
		}

		if(auth_apply_poster == 0){
			$('nav li.apply_poster').hide();
		}
		if(auth_apply_lecture == 0){
			$('nav li.apply_lecture').hide();
		}
		if(auth_apply_registration == 0){
			$('nav li.apply_registration').hide();
		}
		if(auth_apply_sponsorship == 0){
			$('nav li.apply_sponsorship').hide();
		}

		if(auth_page_event == 0){
			$('nav li.page_event').hide();
		}
		if(auth_page_main == 0){
			$('nav li.page_main').hide();
		}
		if(auth_page_general == 0){
			$('nav li.page_general').hide();
		}
		if(auth_page_poster == 0){
			$('nav li.page_poster').hide();
		}
		if(auth_page_lecture == 0){
			$('nav li.page_lecture').hide();
		}
		if(auth_page_registration == 0){
			$('nav li.page_registration').hide();
		}
		if(auth_page_sponsorship == 0){
			$('nav li.page_sponsorship').hide();
		}

		if(auth_live_popup == 0){
			$('nav li.live_popup').hide();
		}
		if(auth_live_lecture == 0){
			$('nav li.live_lecture').hide();
		}
		if(auth_live_lecture_qna == 0){
			$('nav li.live_lecture_qna').hide();
		}
		if(auth_live_abstract == 0){
			$('nav li.live_abstract').hide();
		}
		if(auth_live_conference == 0){
			$('nav li.live_conference').hide();
		}
		if(auth_live_event == 0){
			$('nav li.live_event').hide();
		}

		if(auth_board_news == 0){
			$('nav li.news').hide();
		}
		if(auth_board_notice == 0){
			$('nav li.notice').hide();
		}
		if(auth_board_faq == 0){
			$('nav li.faq').hide();
		}
	});
</script>
