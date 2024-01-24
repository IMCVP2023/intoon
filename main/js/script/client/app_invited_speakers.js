function favorite(e){
    var invited_speaker_idx = e.target.value;
    if(e.target.classList.contains('on')){
        var check_favorite=0;
    } else {
        var check_favorite=1;
    }

    $.ajax({
        url: PATH + "ajax/client/ajax_invited_speakers.php",
        type: "POST",
        data: {
            flag: "favorite",
            invited_speaker_idx: invited_speaker_idx,
            check_favorite: check_favorite
        },
        dataType: "JSON",
        success: function (res) {
            if (res.code == 200) {
                // favorite 버튼 토글
                if(e.target.classList.contains('on')){
                    e.target.classList.remove('on');
                } else {
                    e.target.classList.add('on');
                }
                location.reload();
            } else {
                alert("favorite error.");
                return;
            }
        }
    });
}

$(document).on("keydown", "#keywords", function(key){
	if(key.keyCode == 13){
		$(".search_icon").click();
	}
});

function selectKeywords(){
    let keywords = $('#keywords').val();

    $.ajax({
        url: PATH + "ajax/client/ajax_invited_speakers.php",
        type: "POST",
        data: {
            flag: "select",
            keywords: keywords
        },
        dataType: "JSON",
        success: function (res) {
            if (res.code == 200) {
                let keywords_list = res.result;
                let _html = "";
				let _ini_html = "";
                let category_html = "";
                let ul_html = '<p class="category"></p>'+'<ul class=speakers_list>'+'</ul>';
				var _kewords_num = 0; 

				if (keywords == "") {
					$(".favorite_list_type").show();
					$(".ajax_favorite_list").show();
				} else {
					$(".favorite_list_type").hide();
					$(".ajax_favorite_list").hide();
				}
				
				if (keywords_list.length <= 0) {
					_html += '<div>'+
								'<ul class="speakers_list">'+
									'<li style="border-bottom:none;"><div class="no_data">No Data</div></li>' +
								'</ul>'+
							'</div>';
				} else {
					Object.values(keywords_list).forEach(kl=>{
						_kewords_num = kl.data.length;
									
						for (var k=0; k < _kewords_num; k++) {
							console.log(k);
							let check_favorite = "";
							if (kl.data[k]['favorite_check'] == 'Y') {
								check_favorite = 'on';
							} else {
								check_favorite = '';
							}


							let is_img_path = ((kl.data[k]['image_path'] != null) ? kl.data[k]['image_path'] : '/main/img/profile_empty.png');
						
							if (k == 0) {
								_html += '<p class="category">'+kl.initial+'</p>';
							}

							if(kl.data[k]['initial'] == kl.initial){

								_html += '<div>'+
											'<ul class="speakers_list">'+
												'<li>' +
												'<a href="./app_invited_speakers_detail.php?idx=' + kl.data[k]['idx'] + '">' +
												'<div class="speakers_info">' +
												'<img src="' + is_img_path + '" alt="">' +
												'<p>' + kl.data[k]['first_name'] + ' ' + kl.data[k]['last_name'] + '<span class="sub">'+kl.data[k]['affiliation']+', '+kl.data[k]['nation']+'</span>' + '</p>' +
												'</div>' +
												'</a>' +
												'<button type="button" class="favorite_btn ' + check_favorite + '" value="' + kl.data[k]['idx'] + '">' + '</button>' +
												'</li>'+
											'</ul>'+
										'</div>';
							}
						}
						
						//$('.initial_list').html(kl.initial);
					})
				}

				$('.ajax_speakers_list').html(_html);

                //ul_html = '<p class="category">'++'</p><ul class="speakers_list">'+_html+'</ul>';

				//$('.speakers_area').html(_html);

                $(".favorite_btn").click(function(e){
                    favorite(e);
                })
            } else {
                alert("favorite error.");
                return;
            }
        }
    });

}