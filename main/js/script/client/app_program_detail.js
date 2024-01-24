let preventSelectProgram = false

// 뒤로가기 이벤트 핸들링
window.onpageshow = function(event) {
    if (document.location.hash) {
        preventSelectProgram = true;

        var data = history.state;
        if (data) {
            const {date, option_room, option_category} = data

            $('.program li').removeClass('on');
            $(`.program li[value='${date}']`).addClass('on');
            $(`#option_room option[value='${option_room}']`).prop("selected", true);
            $(`#option_category option[value='${option_category}']`).prop("selected", true);

            createHTMLList(data.list, data.active);
			setRoom(true);
        }else{
            //초기설정
            init();
        }

        preventSelectProgram = false;
    }else{
        //초기설정
        init();
    }
}

$(document).ready(function (){

    // Room Select Tab 초기화 / 클릭 스크립트 수정
    $(".app_tab li").click(function(){
//							$(".sort_select").each(function(){
//								var i = $(this).val();
//								if (i === "all"){
//									$(this).parents(".tab_cont").find(".tab_cont").addClass("on");
//								} else {
//									i = (i - 1);
//									$(this).parents(".tab_cont").find(".tab_cont").removeClass("on");
//									$(this).parents(".tab_cont").find(".tab_cont").eq(i).addClass("on");
//									console.log(i)
//								}
//							});
        var date = $(".program > .on").val();
        $("input[name=program_date]").val(date);

        /* var _options = $(".select_day_program select option");

         _options.prop("hidden", true);
         $(".select_day_program select option.day" + date).prop("hidden", false);

         if($(".select_day_program li:first-of-type select option[value=\'" + init_room + "\']").prop("hidden")) {
             $(_options[0]).prop("selected", true);
         } else {
             $(".select_day_program li:first-of-type select option[value=\'" + init_room + "\']").prop("selected", true);
         }*/
        setRoom();
    });

    // 상세
    $(".app_scientific .program_detail_ul").on("click", ".main", function(){
        let hs = history.state;

        $(this).siblings(".detail").stop().slideToggle();

        const isBlock = $(this).siblings(".detail").attr("style").indexOf("block");
        if(isBlock){
            hs.active = $(this).parents("li").index()
        }else{
            hs.active = null
        }
        history.replaceState(hs, '', `#list`);
    });

    //즐겨찾기
    $(".app_scientific .program_detail_ul").on("click", ".info .schedule_btn", function(event){
        event.preventDefault();
        event.stopPropagation();
        //$(".program_alarm_pop").show();
        //$(this).toggleClass("on");
        Schedule(event);
    });

    $(".app_scientific .program_detail_ul").on("click", ".program_detail_btn", function(event){
        event.preventDefault();
        event.stopPropagation();
        $(this).parents("tr").next("tr").find(".program_detail_td").toggleClass("on");
    });

    $(".app_scientific .program_detail_ul").on("click", ".preview_btn", function(event){
        event.preventDefault();
        event.stopPropagation();
        $(this).parent(".main").siblings(".detail_text").stop().slideToggle();
        $(this).toggleClass("on");
    });

    $(".app_scientific .program_detail_ul").on("click", ".right_tag", function(event){
        event.preventDefault();
        event.stopPropagation();
    });
});

// [함수] 페이지 초기설정
function init(){
    let day = parseInt($("input[name=day]").val() ?? "");
        day = isNaN(day) ? 0 : day
    let e_num = parseInt($("input[name=e_num]").val() ?? "");
        e_num = isNaN(e_num) ? 0 : e_num
    let d_num = parseInt($("input[name=d_num]").val() ?? "");
        d_num = isNaN(d_num) ? 0 : d_num

    $(".app_tab li").removeClass("on");
    if(!day){
        // 23.08.30 안재현. day에 대해 예외처리적용 후 이중코드로 주석
        //$(".app_tab li:first-child").addClass("on");
        //$(".app_tab li:nth-child(1)").trigger("click");
    }

    $(".app_tab li:nth-child("+d_num+")").addClass("on");
    //$(".app_tab + .inner .tab_wrap > .tab_cont").removeClass("on");
    $(".app_tab + .inner .tab_wrap > .tab_cont:nth-child("+d_num+")").addClass("on");
    //작은탭
    //$(".app_tab + .inner .tab_wrap > .tab_cont .tab_cont").removeClass("on");
    $(".app_tab + .inner .tab_wrap > .tab_cont.on .tab_cont").eq(e_num - 1).addClass("on");

    setRoom(true);
}

function setRoom(init = false) {
    const init_room = $("input[name=init_room]").val();
    var date = $(".program > .on").val();
    var _options = $(".select_day_program select option");

    _options.prop("disabled", true);
    $(".select_day_program select option.day" + date).prop("disabled", false);

    if(init) {
        if($(".select_day_program li:first-of-type select option[value=\'" + init_room + "\']").prop("disabled")) {
            $(_options[0]).prop("selected", true);
        } else {
            $(".select_day_program li:first-of-type select option[value=\'" + init_room + "\']").prop("selected", true);
        }
    } else {
        $(_options[0]).prop("selected", true);
    }
    $(".select_day_program li:last-of-type select option:first-of-type").prop("selected", true);

    preventSelectProgram = false;
    selectProgram();
}

// [함수] 스케줄 리스트 조회
function selectProgram(){
    if(preventSelectProgram) return;

    let date = $('.program > .on').val();
    let option_room = $("#option_room option:selected").val();
    let option_category = $("#option_category option:selected").val();

    let data = {
        date : date,
        option_room : option_room,
        option_category : option_category
    };

    $(".program_detail_ul li").detach();
    $(".program_detail_ul").append(`<li class="loading_list"><img src="/main/img/icons/loading.gif"></li>`);

    $.ajax({
        url : PATH+"ajax/client/ajax_app_program.php",
        type : "POST",
        data :  {
            flag : "select",
            data : data
        },
        dataType : "JSON",
        success : function(res){
            if(res.code == 200) {
                let program_list = res.result;

                history.replaceState({list:program_list, date, option_room, option_category, active: null},'', `#list`);

                createHTMLList(program_list);
            } else if(res.code == 400) {
                alert(res.msg);
                return;
            } else {
                alert(res.msg);
                return;
            }
        },
    });
}

// [함수] 스케줄 리스트 HTML 생성
function createHTMLList(program_list, active){
    let _html = "";

    const abstract_category_list= ['5','6','7','8','9','10','11','12','13','14','15','16','17','18'];

    if($(".program_detail_ul .loading_list").length > 0){
        $(".program_detail_ul .loading_list").detach();
    }

    let index = 0;
    Object.values(program_list).forEach(pl=>{
        let contents_html = "";
        let abstract_html = "";
        let chairpersons_html = "";
        let preview_html = "";
        let detail_text_html = "";

        let isActvie = active && active == index;

        Object.values(pl.contents).forEach(cl=>{
            let speaker_info_html = "";
            let speaker_html = "";

            if(cl.speaker_idx!=null){
                speaker_info_html += '<a href="/main/app_invited_speakers_detail.php?idx='+cl.speaker_idx+'" class="invited_tag">Speakers info</a>';
                speaker_html += '<p class="chairperson">'+'<span class="bold">'+cl.first_name+' '+cl.last_name+'</span>'+'('+cl.affiliation+', '+cl.nation+')'+'</p>';
            } else {
                if(cl.speaker!=null){
                    speaker_html += '<p class="chairperson">'+'<span class="">'+cl.speaker+'</span>'+'</p>';
                }
            }

            contents_html += `
                                <div>
                                    <p class="title">${cl.contents_title}</p>
                                    ${speaker_html}
                                    <div class="info">
                                        <span class="time">${cl.start_time}-${cl.end_time}</span>
                                        ${speaker_info_html}
                                    </div>
                                </div>
                             `
        })

        var schedule = "";
        if(pl.schedule_check=='Y') {
            schedule = 'on';
        }

        if(abstract_category_list.includes(pl.program_category_idx)){
            if(pl.path==null){
                pl.path = 'javascript:void(0)';
            }
            abstract_html += '<a href="'+pl.path+'" class="right_tag" onclick="openPDF(event)">Abstract</a>'
        }

        if(pl.chairpersons!=null){
            var chairperson = "";
            if((pl.chairpersons.split(',').length-1)>=2){
                chairperson = "Chairpersons: ";
            } else {
                chairperson = "Chairperson: "
            }
            chairpersons_html += '<p class="chairperson"><span class="bold">'+chairperson+'</span>'+pl.chairpersons+'</p>'
        }

        if(pl.preview!=null){
            preview_html = ' <button class="preview_btn">Preview</button>';
            detail_text_html += '<div class="detail_text">'+pl.preview+'</div>';
        }

        _html += `
                    <li name="${pl.program_tag_name}">
                        <div class="main">
                            ${abstract_html}
                            <p class="title">${pl.program_name}</p>
                            ${chairpersons_html}
                            <div class="info">
                                <button class="${schedule} schedule_btn" value="${pl.idx}"></button>
                                <span class="time">${pl.start_time}-${pl.end_time}</span>
                                <span class="branch">${pl.program_place_name}</span>
                            </div>
                            ${preview_html}
                        </div>
                        ${detail_text_html}
                        <div class="detail" style="display:${isActvie ? "block" : "none"}">${contents_html}</div>
                    </li>
                 `
        index++;
    })

    $('.program_detail_ul li').detach();
    $('.program_detail_ul').html(_html);
    scrollHandler()
}

// [함수] 스크롤 핸들링 - 퍼블
function scrollHandler(){
    const targetName = $("input[name='scroll_target']").val();

    //스크롤 위치 & 액션 가운데로 수정
    var window_h = $(window).outerHeight() / 2.3;
    $(".program_detail_ul li").each(function(){
        if(targetName === $(this).attr("name")) {
            var this_top = $(this).offset().top;
            $("html, body").animate({scrollTop: this_top - window_h}, 1000);
            console.log(this_top + window_h)
        }
    });
}


function AlarmMessage(msg) {
    $('.alarm_message_pop .tags').text(msg).show();
    $('.alarm_message_pop').show();
}

function Schedule(e){
    var program_idx= e.target.value;
    let is_push = "";
    if(e.target.classList.contains('on')){
        var check_schedule=0;
    } else {
        var check_schedule=1;
    }

    $.ajax({
        url: PATH + "ajax/client/ajax_app_program.php",
        type: "POST",
        data: {
            flag: "schedule",
            program_idx: program_idx,
            check_schedule: check_schedule
        },
        dataType: "JSON",
        success: function (res) {
            if (res.code == 200) {
                // Scientific Program 내 스케줄 버튼 토글
                if(e.target.classList.contains('on')){
                    AlarmMessage('Cancel');
                    e.target.classList.remove('on');
                    is_push = 'delete';
                    setAlarm(program_idx, is_push);
                    return;
                } else {
                    e.target.classList.add('on');

                    $('.program_alarm_pop').show()
                    $(".is_alarm_y").click(function(event) {
                        $('.program_alarm_pop').hide();
                        is_push = 'insert';
                        setAlarm(program_idx, is_push);
                        AlarmMessage('Add alarm complete');
                    });
                    $(".is_alarm_n").click(function(event) {
                        $('.program_alarm_pop').hide();
                        AlarmMessage('Complete');
                    });
                }
            } else {
                alert("schedule error.");
                return;
            }
        }
    });
}

function openPDF(e){
    e.preventDefault();
    let path=e.target.href;

    if(path === 'javascript:void(0)'){
        alert('Updates are planned.');
        return false;
    } else{
        if (typeof(window.AndroidScript) != "undefined" && window.AndroidScript != null) {
            window.AndroidScript.openPDF(path);
        } else if(window.webkit && window.webkit.messageHandlers!=null) {
            try{
                window.webkit.messageHandlers.openPDF.postMessage(path);
            } catch (err){
                console.log(err);
            }
        }
    }
}

function setAlarm(program_idx, is_push){
    $.ajax({
        url: PATH + "ajax/client/ajax_app_program.php",
        type: "POST",
        data: {
            flag: "alarm",
            program_idx: program_idx,
            is_push: is_push
        },
        dataType: "JSON",
        success: function (res) {
            if (res.code == 200) {
                console.log("success")
            } else {
                alert("setAlarm error.");
                return;
            }
        }
    });
}

