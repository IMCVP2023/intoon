$(document).ready(function(){
    let notice_idx = "";

    $(".app_pin_btn").on("click",function(event) {
        //$(this).toggleClass("on");

        if (event.target.classList.contains('on')) {
            var check_pin = 0;
        } else {
            var check_pin = 1;
        }

        let board_idx = event.target.value;

        $.ajax({
            url: "/main/ajax/admin/ajax_app_notice.php",
            type: "POST",
            data: {
                flag: "pin",
                board_idx: board_idx,
                check_pin: check_pin
            },
            dataType: "JSON",
            success: function (res) {
                if (res.code === 200) {
                    // pin 버튼 토글
                    if (event.target.classList.contains('on')) {
                        event.target.classList.remove('on');
                        return;
                    } else {
                        event.target.classList.add('on');
                    }
                } else {
                    alert("pin error.");
                    return;
                }
            }
        });
    });

    $(".app_push_open").on("click",function(event) {
        let board_idx = event.target.value;

        $.ajax({
            url: "/main/ajax/admin/ajax_app_notice.php",
            type: "POST",
            data: {
                flag: "select",
                board_idx: board_idx
            },
            dataType: "JSON",
            success: function (res) {

                let board = res.result;
                console.log(board);
                console.log(board.title_en)
                $('textarea[name=notice_title]').text('[NOTICE] '+board.title_en)
            }
        });

        $('.app_push_pop_notice').addClass('on');
    });

    $(".push_y").on("click",function(event) {
        let message = $('textarea[name=notice_title]').val();

        $.ajax({
            url: "/main/ajax/admin/ajax_app_notice.php",
            type: "POST",
            data: {
                flag: "push",
                message: message,
                notice_idx: notice_idx
            },
            dataType: "JSON",
            success: function (res) {
                console.log("push")
            }
        });
    });

    $(".app_push_btn").on("click",function(event) {
        notice_idx=event.target.value;
    });

	$(".app_modify_btn").on("click",function(event) {
        let board_idx = event.target.value;

		window.location.href= `./app_notice_detail.php??t=3&i=${board_idx}`;
    });

    $(".app_delete_btn").on("click",function(event) {
        let board_idx = event.target.value;

		if(!confirm("삭제된 내용은 더이상 노출되지 않습니다.\n작성하신 내용을 삭제하시겠습니까?")){
			return false;
		}

        $.ajax({
            url: "/main/ajax/admin/ajax_app_notice.php",
            type: "POST",
            data: {
                flag: "delete",
                board_idx: board_idx
            },
            dataType: "JSON",
            success: function (res) {
                if (res.code === 200) {
                    location.reload()
                } else {
                    alert("pin error.");
                    return;
                }
            }
        });
    });
});