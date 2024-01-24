$(document).ready(function(){
	//페이지 이동시 확인창
	$(window).on("beforeunload", function(){
		return locale(language.value)("leave_page");
	});

	//저자 국가 선택 시 국가번호 append
	$("select[name=nation_no]").on("change", function(){
		var nation = $(this).find("option:selected").val();
		var nation_tel_length = $("select[name=nation_tel] option").length;
		$.ajax({
			url : PATH+"ajax/ajax_nation.php",
			type : "POST",
			data : {
				flag : "nation_tel",
				nation : nation
			},
			dataType : "JSON",
			success : function(res) {
				if(res.code == 200) {
					if(nation_tel_length => 2) {
						$("select[name=nation_tel] option").detach();
						$("select[name=nation_tel]").append("<option selected>"+res.tel+"</option>");
					} else {
						$("select[name=nation_tel]").append("<option selected>"+res.tel+"</option>");
					}
				}
			}
		});
	});

	//공동저자 국가 선택 시 국가번호 append
	$(document).on("change", ".co_nation",function(){
		var nation = $(this).find("option:selected").val();
		var nation_tel_length = $("select[name^=co_nation_tel]").length;
        var co_count = $(this).data("count");

		$.ajax({
			url : PATH+"ajax/ajax_nation.php",
			type : "POST",
			data : {
				flag : "nation_tel",
				nation : nation
			},
			dataType : "JSON",
			success : function(res) {
				if(res.code == 200) {
					if(nation_tel_length => 2) {
						$("select[name=co_nation_tel"+co_count+"] option").detach();
						$("select[name=co_nation_tel"+co_count+"]").append("<option selected>"+res.tel+"</option>");
					} else {
						$("select[name=co_nation_tel"+co_count+"]").append("<option selected>"+res.tel+"</option>");
					}
				}
			}
		});
	});

	//교신저자 국가 선택 시 국가번호 append
	$(document).on("change", ".add_co_nation",function(){
		var nation = $(this).find("option:selected").val();
		var nation_tel_length = $("select[name^=add_co_nation_tel]").length;
        var co_count = $(this).data("count");
	
		$.ajax({
			url : PATH+"ajax/ajax_nation.php",
			type : "POST",
			data : {
				flag : "nation_tel",
				nation : nation
			},
			dataType : "JSON",
			success : function(res) {
					console.log(res);
				if(res.code == 200) {
					if(nation_tel_length => 2) {
						$("select[name=add_co_nation_tel"+co_count+"] option").detach();
						$("select[name=add_co_nation_tel"+co_count+"]").append("<option selected>"+res.tel+"</option>");
					} else {
						$("select[name=add_co_nation_tel"+co_count+"]").append("<option selected>"+res.tel+"</option>");
					}
				}
			}
		});
	});

	// docs만 업로드 가능
	$("input[name=abstract_file]").on("change", function() {
		var fileVal = $(this).val();
		if( fileVal != "" ){
			var ext = fileVal.split('.').pop().toLowerCase(); //확장자분리
			//아래 확장자가 있는지 체크
			if($.inArray(ext, ['doc', 'docx']) == -1) {
			  $(this).val("");
			  $(".search_file label.label_form").text("Please attach the abstract file");
			  alert('Please check the file extension');
			  return;
			}
		}
	});

    //영문만 입력 및 대문자 변환
	$(".uppercase").on("keyup", function(){
		$(this).val($(this).val().replace(/[^a-z|A-Z| ]/g,""));
		$(this).val($(this).val().toUpperCase());
	});
});