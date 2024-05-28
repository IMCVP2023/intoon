$(document).ready(function(){

	//app_program_detail
	$(".app_program_detail .app_tab li").click(function(){
		var idx = $(this).index();
		$(".tab_cont .day_ul").removeClass("on");
		$(".tab_cont .day_ul").eq(idx).addClass("on");
	});

	// 아이폰 사파리에서 더블 탭 막기
	var lastTouchEnd = 0;
	document.documentElement.addEventListener('touchend', function (event) {
		var now = (new Date()).getTime();
		if (now - lastTouchEnd <= 300) {
		  event.preventDefault();
		}
		lastTouchEnd = now;
	}, false);

	//아이폰에 사파리에서 핀치 줌 막기 / 안드로이드에서 더블탭, 핀치 줌 막기
	document.documentElement.addEventListener('gesturestart', function (e) {
		e.preventDefault();
	});

	


	//데이트피커
	$(".date_input").datepicker({
		//dateFormat: "yy-mm-dd"
		dateFormat: "dd-mm-yy"
	});

	//pc header hover action 
	$('.depth01 li a').on('mouseenter',function(){
		var bar_width = $(this).width();
		var left_position = $(this).position().left;
		$('.depth01 li a img').attr('src','./img/icons/nav_arrow_black.png');
		$(this).children('img').attr('src','./img/icons/nav_arrow_on.png');
		$('.bar').css('width', bar_width);
		$('.bar').css('left', left_position);
		$(this).parents('header').addClass('nav_show');
		$('.nav_dim').show();
	});
	$("header .depth01 li ul").mouseover(function(){
		var left_spot = $(this).parent("li").position().left;
		$('.bar').css('left', left_spot);
	});

	//footer s_logo_list
	$('.s_logo_list').slick({
		dots: false,
		infinite: true,
		slidesToShow: 6,
		arrows : true,
        autoplay: true,
        autoplaySpeed: 2000,
		responsive: [
		{
		  breakpoint: 1100,
		  settings: {
			slidesToShow: 4
		  }
		},
		{
		  breakpoint: 780,
		 settings: {
			slidesToShow: 3
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 2
		  }
		}
	  ]
	});

	$('header .top, .nav_dim').on('mouseenter',function(){
		$('.nav_dim').hide();
		$('.depth01 li a img').attr('src','./img/icons/nav_arrow.png');
		$('header').removeClass('nav_show');
	});
	//pc header hover action end

	//popup
	$('.pop_bg, .pop_close').on('click',function(){
		$(this).parents('.popup').hide();
	});

	//input type radio
	$('.toggle_wrap input').on('change',function(){
		var target = $(this).parents(".toggle_wrap").find("input[type=radio]:checked");
		var choice = target.val();

		language_change("change", choice);
		
	});
	
	//toggle pointer click event
	$('.toggle__pointer').on('click',function(){
		var target = $(this).parents(".toggle_wrap").find("input[type=radio]:checked");
		var choice = target.val();

		language_change("click", choice);
	});

	//mobile nav
	$('.m_nav_btn').on('click',function(){
		var i = $(this).index();
		$('.m_nav_wrap').addClass('opened');
		$('.m_nav_li a').removeClass('show')
		$('.m_sub_nav').hide();
		$('.m_nav_li a').eq(i).addClass('show');
		$('.m_sub_nav').eq(i).show();
	});
	$('.m_nav_li a').on('click',function(){
		if(!$(this).hasClass('show')){
			$('.m_sub_nav').hide(); //.slideUp();
			$('.m_nav_li a').removeClass('show');
			$(this).addClass('show');
			$(this).siblings('.m_sub_nav').show(); //.slideDown();
		}else{
			// $('.m_sub_nav').slideUp();
			// $('.m_nav_li a').removeClass('show');
		}
	});
	$('.n_nav_close').on('click',function(){
		$('.m_nav_wrap').removeClass('opened');
	});
	
	listR();
	
	$(window).resize(function(){
		listR();
	});

	// pagination toggle
	$(".pagination li").click(function(){
		$(".pagination li").removeClass("on");
		$(this).addClass("on");
	});

	// select arrow toggle
	$(".select").focus(function(){
		$(this).parents(".select_box").addClass("on");
	}).blur(function(){
		$(this).parents(".select_box").removeClass("on")
	});
	$(".select").change(function(){
		$(this).parents(".select_box").removeClass("on");
		$(this).blur();
	})
		
	//댑
	$(".tab_green li, .tab_li li").click(function() {
		var i = $(this).index();
		$(this).parent("ul").next(".tab_wrap").children(".tab_cont").removeClass("on");
		$(this).parent("ul").next(".tab_wrap").children(".tab_cont").eq(i).addClass("on");
		$(this).siblings("li").removeClass("on");
		$(this).addClass("on");
		console.log($(this).parent("ul").next(".tab_wrap").children(".tab_cont"))
	});

	$(".tab_pager li, .tab_li li").click(function() {
		var i = $(this).index();
		$(this).parent("ul").next(".tab_wrap").children(".tab_cont").removeClass("on");
		$(this).parent("ul").next(".tab_wrap").children(".tab_cont").eq(i).addClass("on");
		$(this).siblings("li").removeClass("on");
		$(this).addClass("on");
		console.log($(this).parent("ul").next(".tab_wrap").children(".tab_cont"))
	});

	// 탭 li 텍스트 두줄 이상일 경우
	tabMax();

	function tabMax(){
		if ($(".tab_green")) {
			var tab_max_h = 0; 
			$(".tab_green > li > a").each(function(){ // 최대 높이 구하기
				var tab_h = parseInt($(this).css("height"));
				if (tab_max_h < tab_h) {
					tab_max_h = tab_h;
				};
			});
			$(".tab_green > li > a").each(function(){ // 최대 높이 설정
				$(this).css({height: tab_max_h});
				$(this).parent(".tab_green > li").css({height: tab_max_h});
			});
		};
	};

	// FAQ > arrow toggle
	$(".faq_quest").click(function(){
		if($(this).hasClass("on")){
			$(".faq_quest").removeClass("on");
		}else{
			$(".faq_quest").removeClass("on");
			$(this).addClass("on");
		}
		
	});

	
	if($("section").hasClass("index_test")){
		$(".fixed_btn_wrap").addClass("index_pg");
	}
	// fixed button 스크롤할때 고정
	if (!$(".container").hasClass("onsite_register") && !$(".container").hasClass("app_version")){
		var footer_height = $('.footer_wrap').outerHeight();
		$(window).on('scroll', function(){
			var scroll_top = $(window).scrollTop();
			if(scroll_top > 50){
				//$(".btn_top").fadeIn(300);
				$(".btn_top").css("opacity",1);
			}else{
				//$(".btn_top").fadeOut(300);
				$(".btn_top").css("opacity",0);
			}

			var footer_top = $(".footer_wrap").offset().top;
			var fixed_bottom = $(".fixed_btn_clone").offset().top + $(".fixed_btn_clone").outerHeight();
			if(!$("section").hasClass("index_test")){
				//console.log(footer_top - fixed_bottom)
				if(170 >= footer_top - fixed_bottom ){
					$(".fixed_btn_wrap").addClass("on");
					// $(".btn_top").css("bottom", footer_height+32+"px");
					if($("section").hasClass("top_btn_move")){ // 우측하단에 register btn이 있는 경우
						$(".fixed_btn_wrap").css("bottom", "570px");
						$(".btn_top").css("bottom", "420px");
						$(".btn_fixed_triangle").css("position", "absolute");
						$(".btn_fixed_triangle").css("bottom", "485px");
					}else{
						$(".fixed_top").css("bottom", footer_height+30+"px");
					}
				}
				else{
					$(".fixed_btn_wrap").removeClass("on");
					//$(".btn_top").css("bottom", "32px");
					if($("section").hasClass("top_btn_move")){ // 우측하단에 register btn이 있는 경우
						$(".fixed_btn_wrap").css("bottom", "170px");
						$(".btn_top").css("bottom", "185px");
						$(".btn_fixed_triangle").css("position", "fixed");
						$(".btn_fixed_triangle").css("bottom", "85px");
					}else{
						$(".btn_top").css("bottom", "32px");
					}
				}
			}
		});
	}



	// top button 클릭이벤트
	$(".btn_top").click(function(){
		$("html, body").animate({scrollTop: 0}, 500)
	})

	/** eligibility pop up */
	$(".eligibility_open").click(function(){
		$(this).children(".eligibility_pop").toggleClass("on");
	});

	// 메인페이지 화살표(하단 이동) button 클릭이벤트
	$(".main_section .btn_circle_arrow").click(function(){
		var main_section_height = $(".main_section").outerHeight();
		var header_height = $("header").outerHeight();
		var move_main_cont = main_section_height - header_height;
		console.log(move_main_cont);
		$("html, body").animate({scrollTop: move_main_cont}, 500);
	});

	//로그인 백그라운드 높이값
	$(".login.bg").css("min-height", $(window).height());
	//$(".login.bg").outerHeight($(window).height());

	//필수값 입력시 버튼 활성화 (gray_btn > green_btn)
	$(".required").on("change keyup", function(){
		var result = requiredCheck2();

		if(result) {
			$(".btn.online_btn").addClass("green_btn").removeClass("gray_btn");
		} else {
			$(".btn.online_btn").removeClass("green_btn").addClass("gray_btn");
		}
	});

	//필수값 입력시 버튼 활성화 (gray_btn > green_btn)
	$(".required3").on("change keyup", function(){
		var result = requiredCheck4();

		if(result) {
			$(".btn.online_btn").addClass("green_btn").removeClass("gray_btn");
		} else {
			$(".btn.online_btn").removeClass("green_btn").addClass("gray_btn");
		}
	});

	// 230523 메인페이지 height (1024 아래 해상도)
	$(window).resize(function(){
		var win_width = $(window).width();
		if ($("section").hasClass("main_section")){
			var win_height = $(window).height();
			if (win_width <= 1024) {
				$(".section_bg").css({"padding-top":"0", "height":win_height, "min-height":"auto"})
			} else {
				$(".section_bg").css({"padding-top":"117px", "height":win_height, "min-height":"850px"})
			}
		}
	});
	$(window).trigger("resize");
});


// 리스트 반응형 처리
function listR(){
	if ($(window).width() < 780) {
		for(var a = 0; a < $('.tab_area .clearfix').length; a++){
			var cf = $('.tab_area .clearfix').eq(a);
			var cfTotalWidth = 0;

			for(var b = 0; b < cf.children('li').length; b++){
				cfTotalWidth += cf.children('li').eq(b).width() + 10;
			}
			cf.css("width", cfTotalWidth);
		}
		//tab scroll
		if($('.tab_area a').hasClass('active')){
			var offset = $('.tab_area .active').offset();
			var left = offset.left;
			$('.tab_area').scrollLeft(left - 20);
		}
	}
}

// 필수값 입력 여부 확인
function requiredCheck2() {
	var required = $(".required");
	for(i=0; i<required.length; i++) {
		if($(required[i]).val() == "" || $(required[i]).val() == null) {
			return false;
		}
	}
	if(!$("input[name=attendance_type]").is(":checked") || !$("input[name=rating]").is(":checked") || !$("input[name=registration_type]").is(":checked")) {
		return false;
	}

	return true;
}
// 필수값 입력 여부 확인
function requiredCheck4() {
	var required = $(".required3");
	var required_val;
	for(i=0; i<required.length; i++) {
		required_val = $(required[i]).val();
		if(required_val.trim().length <= 0 || $(required[i]).val() == "" || $(required[i]).val() == null) {
			return false;
		}
	}
	return true;
}





/*======================== 
	23.06.13 APP JS
==========================*/
$(document).ready(function(){
	//App Nav show
	$(".app_header .app_nav_btn").click(function(){
		$(".app_nav").addClass("on");
		$(".app_nav_bg").addClass("on");
		$("html, body").css({"height": "100%", "overflowY": "hidden"});
	});

	//App Nav hide
	$(".app_nav .app_nav_close, .app_nav_bg").click(function(){
		$(".app_nav").removeClass("on");
		$(".app_nav_bg").removeClass("on");
		$("html, body").css({"height" : "auto", "overflowY" : "visible"});
	});

	//App GNB 
	$(".app_nav_menu > li").click(function(){
		$(this).addClass("on");
		$(this).siblings().removeClass("on");
	});

	//App 탭
	if ($(".container").hasClass("app_scientific")){
		$(".app_tab li").click(function() {
            var i = $(this).index();
//            $(this).parent("ul").next(".inner").children(".tab_wrap").children(".tab_cont").removeClass("on");
//            $(this).parent("ul").next(".inner").children(".tab_wrap").children(".tab_cont").eq(i).addClass("on");
            $(this).siblings("li").removeClass("on");
            $(this).addClass("on");
        });
	}else {
		$(".app_tab li").click(function() {
			var i = $(this).index();
			$(this).parent("ul").next(".inner").find(".tab_cont").removeClass("on");
			$(this).parent("ul").next(".inner").find(".tab_cont").eq(i).addClass("on");
			$(this).siblings("li").removeClass("on");
			$(this).addClass("on");
			// console.log($(this).parent("ul").next(".inner").find(".tab_cont"))
		});
	}
	
	// APP 메뉴 탭 높이 맞춤
	appMenuTab();

	function appMenuTab(){
		if ($(".app_menu_tab")) {
			var menu_tab_max_h = 0; 
			$(".app_menu_tab > li > a").each(function(){ // 최대 높이 구하기
				var menu_tab_h = parseInt($(this).css("height"));
				if (menu_tab_max_h < menu_tab_h) {
					menu_tab_max_h = menu_tab_h;
				};
			});
			$(".app_menu_tab > li > a").each(function(){ // 최대 높이 설정
				$(this).css({height: menu_tab_max_h});
			});
		};
	};
	
	//기본 가이드 밖 풀로 빠지는 레이아웃
	$(window).resize(function(){
		//var title_left = $(".app_version .page_title").offset().left;
		//$(".app_version .page_title").css("margin-left", "-"+title_left+"px")
		//console.log(title_left);
		//$(".app_version .page_title, .app_title_box, .app_tab, .app_version.app_setting .contents_box, .app_contents_box > div").offset({left : 0})
	});
	//$(window).trigger("resize");

	// APP 로그인/로딩페이지 height 설정
	//if ($(".app_main .app_main_inner > div").hasClass("app_main_box")) {
	//	//$(window).resize(resizing);
	//	//resizing();
	//	//function resizing(){
	//		document.querySelector(".app_main .app_main_box").style.height = window.innerHeight + "px";	
	//	//}
	//}

	// APP 로그인/로딩페이지 height 설정
	if ($(".app_main .app_main_inner > div").hasClass("app_main_box")) {
		$(window).resize(function(){
			var  window_height = $(window).outerHeight();
			$(".app_main .app_main_box").height(window_height);
			//$(".app_main .app_main_box").css("min-height", window_height);
		});
		$(window).trigger("resize");
	}

	// preventDefault
	//$(".no_event").on("click", function(event){
	//	event.preventDefault();
	//	event.stopPropagation();
	//})

	// Scientific Program 내 스케줄 버튼 토글
	$(".app_scientific .info button").click(function(event){
		event.preventDefault();
		event.stopPropagation();
		//$(".program_alarm_pop").show();
		//$(this).toggleClass("on");
	});

	// Scientific Program 상세영역 토글
	$(".app_scientific .program_detail_ul .main").on("click", function(){
		$(this).siblings(".detail").stop().slideToggle();
	});

	//팝업
	$(".pop_dim").click(function() {
		$(this).parents(".pop_wrap").removeClass("on");
	});

	// My Stamp 로고 클릭시 장소 정보 노출
	$(".app_my_stamp .grade_wrap li").click(function(){
		if ($(this).hasClass("complete_stamp")){
		} else {
			$(this).children(".location").toggleClass("on");
		}
	});

	//My Stamp - 관리자 접근 화면
	if($("section").hasClass("app_my_stamp_admin")){
		//관리자 화면 종료버튼 show
		$(".app_header .stamp_admin_close").addClass("on");
		//관리자 화면 종료
		$(".stamp_admin_close").click(function(){
			$(this).removeClass("on");
			window.location.href='./app_my_stamp.php';
		});
		//스탬프 완료/취소
		$(".stamp_control .complete").click(function(){
			$(this).parents(".grade_wrap li").addClass("complete_stamp");
		});
		$(".stamp_control .delete").click(function(){
			$(this).parents(".grade_wrap li").removeClass("complete_stamp");
		});
		//전체 스탬프 완료/취소
		$(".stamp_count .stamp_control .complete").click(function(){
			$(".grade_wrap li").addClass("complete_stamp");
		});
		$(".stamp_count .stamp_control .reset").click(function(){
			$(".grade_wrap li").removeClass("complete_stamp");
		});
	};

	$(".schedule_area .grade_title").click(function(){
		$(this).toggleClass("on");
		$(this).next(".program_detail_ul").slideToggle();
	});

	// 페이지 상단영역 고정 - (공통 : ~ app_title_box까지)
	fixTopCont();

	function fixTopCont() {
		var app_title_h = $(".app_title_box").outerHeight();                     // .app_title_box 의 height 
		var container_mg_top = $(".container").css("margin-top");
		var num_mg_top = parseInt(container_mg_top);                             // container 의 기존 상단 margin
		$(".container").css("margin-top", (app_title_h+num_mg_top-1) + "px");

		// 개별 고정요소가 있을 경우
		if ($("*").hasClass("fix_cont")) {
			var fix_cont_h = $(".fix_cont").outerHeight();
			var num_cont_h = parseInt(fix_cont_h);

			$(".container").css("margin-top", (app_title_h+num_mg_top+num_cont_h-1) + "px");
			$(".fix_cont").css("top", (app_title_h+num_mg_top) + "px")
			
			// 하단에 개별 고정요소가 있을 경우
			if ($("*").hasClass("fix_cont_sub")) {
				var fix_cont_sub_h = $(".fix_cont_sub").outerHeight();
				var num_cont_sub_h = parseInt(fix_cont_sub_h);

				$(".container").css("margin-top", (app_title_h+num_mg_top+num_cont_h+num_cont_sub_h-1) + "px");
				$(".fix_cont_sub").css("top", (app_title_h+num_mg_top+num_cont_h) + "px")
			}
		}
	}

});