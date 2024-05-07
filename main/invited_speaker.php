<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>

<section class="invited invited2 container">
    <h1 class="page_title">Invited Speakers</h1>
	<div class="inner">
		<div>
			<div class="searchArea">
				<!-- <form action=""> -->
					<div class="sort">
						<div class="all on"><a href="#">ALL</a></div>
						<ul class="sort first_words">
							<li><a href="#" class="click_sumbit">A</a></li>
							<li><a href="#" class="click_sumbit">B</a></li>
							<li><a href="#" class="click_sumbit">C</a></li>
							<li><a href="#" class="click_sumbit">D</a></li>
							<li><a href="#" class="click_sumbit">E</a></li>
							<li><a href="#" class="click_sumbit">F</a></li>
							<li><a href="#" class="click_sumbit">G</a></li>
							<li><a href="#" class="click_sumbit">H</a></li>
							<li><a href="#" class="click_sumbit">I</a></li>
							<li><a href="#" class="click_sumbit">J</a></li>
							<li><a href="#" class="click_sumbit">K</a></li>
							<li><a href="#" class="click_sumbit">L</a></li>
							<li><a href="#" class="click_sumbit">M</a></li>
							<li><a href="#" class="click_sumbit">N</a></li>
							<li><a href="#" class="click_sumbit">O</a></li>
							<li><a href="#" class="click_sumbit">P</a></li>
							<li><a href="#" class="click_sumbit">Q</a></li>
							<li><a href="#" class="click_sumbit">R</a></li>
							<li><a href="#" class="click_sumbit">S</a></li>
							<li><a href="#" class="click_sumbit">T</a></li>
							<li><a href="#" class="click_sumbit">U</a></li>
							<li><a href="#" class="click_sumbit">V</a></li>
							<li><a href="#" class="click_sumbit">W</a></li>
							<li><a href="#" class="click_sumbit">X</a></li>
							<li><a href="#" class="click_sumbit">Y</a></li>
							<li><a href="#" class="click_sumbit">Z</a></li>
						</ul>
						<ul class="category">
							<li><a href="#" class="click_sumbit">Plenary Lectures</a></li>
							<li><a href="#" class="click_sumbit">Symposium</a></li>
							<li><a href="#" class="click_sumbit">Sponsors session</a></li>
							<!-- <li><a href="#" class="click_sumbit">Joint Symposia</a></li> -->
						</ul>
					</div>
					<div class="bg">
						<input type="text" name="keyword" id="keyword" value="" onkeyup="enterkey()">
						<input id="submit" type="button" value="Search">
					</div>
				<!-- </form>	 -->
			</div>
			<ul class="speaker_list">
			</ul>
		</div>
	</div>
</section>
<input type="hidden" name="first_word">
<input type="hidden" name="session_word">

<div class="modal_background" onclick="hideModal()" style="display: none;"></div>
<div class="modal" style="display:none;">
	<div class="modal_img_box">
		<img class="modal_img" src="/main/img/invited_speaker/Alice_Pik_Shan_Kong/SYM16-1_Alice_PS_Kong.jpg" alt="speaker_img"/>
		<div>
			<p class="modal_name">Alice Pik Shan Kong</p>
			<p class="modal_org">The Chinese University of Hong Kong</p>
			<p class="italic modal_nation">Hong Kong</p>
		</div>
	</div>
	<div class="modal_content_box">
		<div class="content">
		</div>
	</div>
</div>
<script>

	var brian_height =''; 

	$(document).ready(function(){
		search_list();
	});

	function enterkey() {
		if (window.event.keyCode == 13) {
			// 엔터키가 눌렸을 때
			ajax_submit(3);
		}
	}


	$(".all").click(function(){
		
		$(".all").addClass("on");
		$(".first_words").find(".on").removeClass("on");
		$(".category").find(".on").removeClass("on");
		$("#keyword").val("");
		$("input[name=first_word]").val("");
		$("input[name=session_word]").val("");
		search_list();
	});

	$(".first_words li").click(function(){

		$(".all").removeClass("on");
		$(".first_words").find(".on").removeClass("on");
		$(this).addClass("on");

		var first_word_value = $(this).children().html();
		$("input[name=first_word]").val(first_word_value);

		ajax_submit(1);

	});


	$(".category li").click(function(){
		$(".all").removeClass("on");
		$(".category").find(".on").removeClass("on");
		$(this).addClass("on");

		var session_word_value = $(this).children().html();
		if(session_word_value === "Plenary lectures") {
			session_word_value = "Plenary";
		} else if(session_word_value === "Symposia") {
			session_word_value = "Symposium";
		} else if(session_word_value === "Workshops") {
			session_word_value = "Workshop";
		} else if(session_word_value === "Joint Symposia") {
			session_word_value = "joint";
		}

		$("input[name=session_word]").val(session_word_value);

		ajax_submit(2);

	});

	$("#submit").click(function(){
		ajax_submit(3);
	});

	function ajax_submit(order) {
		var first_word = $("input[name=first_word]").val();
		var session_word= $("input[name=session_word]").val();
		var search_word= $("#keyword").val();

		search_list(first_word, session_word, search_word, order);

	}


	function search_list(first_word=null, session_word=null, search_word=null, order=null) {
		
		var category_bool = $(".category").children().hasClass("on");

		var data = {
			"flag"				: "invited_speakers",
			"first_word"		: first_word,
			"session_word"		: session_word,
			"search_word"		: search_word,
			"order"				: order,
			"category_bool"		: category_bool
		};
		
		$.ajax({
			url : PATH+"ajax/client/ajax_invited_speakers.php",
			type : "POST",
			data : data,
			dataType : "JSON",
			success : function(res){
				if(res.code == 200) {
					//console.log(res);
					var html = "";

					$(".speaker_list").html(html);

					var s_list = res["result"];

					for(var i=0; i < s_list.length; i++) {
						
						var list =s_list[i];
						var logo_img = "";
						if(list["image"] == "./img/footer_logo.png") {
							logo_img= " logo_img";
						}

						html += "<li data-idx='" + list['idx'] + "' onclick='showModal(\"" + list['idx'] + "\")'>";
						html +=     "<div class='clearfix2'>";
						html +=         "<div class='speaker_img" + logo_img + "' style='background:url(" + "\"" + list["image_path"] + "\"" + ") no-repeat center /cover;'></div>";
						html +=         "<div class='speaker_info'>";
						html +=             "<p class='bold'>" + list['first_name'] + " " + list['last_name'] + "</p>";
						html +=             "<p>" + list['affiliation'] + "</p>";
						html +=             "<p class='italic'>" + list['nation'] + "</p>";
						html +=         "</div>";
						html +=     "</div>";
						html += "</li>";

						$(".speaker_list").html(html);

					}
					var speaker_arr = [];
					var max = '';
					var text_height ='';
				} else if(res.code == 400){
					alert(res.msg);
					return;
				}
			}
		});
	}

	const modalBackground = document.querySelector(".modal_background");
	const modal = document.querySelector(".modal");

	/** modal 띄우는 함수 */
	function showModal(idx){
		modalBackground.style.display = "";
		modal.style.display = "";
		getModalDetail(idx)
	}

	/** ajax 요청 */
	function getModalDetail(idx){
		var data = {
			"flag": "invited_speaker_modal",
			"idx" : idx
		};
		
		$.ajax({
			url : PATH+"ajax/client/ajax_invited_speakers.php",
			type : "POST",
			data : data,
			dataType : "JSON",
			success : function(res){
				if(res.code == 200) {
					drawModal(res.result)
				} else if(res.code == 400){
					alert(res.msg);
					return;
				}
			}
		});
	}

	function drawModal(list){
		const speakerImg = document.querySelector(".modal_img");
		const speakerName = document.querySelector(".modal_name");
		const speakerOrg = document.querySelector(".modal_org");
		const speakerNation = document.querySelector(".modal_nation");
		const contents = document.querySelector(".modal_content_box")
		// console.log(list)

		let contentsHtml = "";
		let roomText = "";
		list.map((li)=>{

			speakerImg.src = li.image_path;
			speakerName.innerText = li.first_name + " " + li.last_name;
			speakerOrg.innerText = li.affiliation;
			speakerNation.innerText = li.nation;
			
			switch(Number(li.program_place_idx)){
				case 1 : roomText = "Room1"; break;
				case 2 : roomText = "Room2"; break;
				case 3 : roomText = "Room3"; break;
				case 4 : roomText = "Room4"; break;
				case 5 : roomText = "Room5"; break;
				case 6 : roomText = "Room6"; break;
				case 7 : roomText = "Room7"; break;
				case 8 : roomText = "Room1~3"; break;
			}

			contentsHtml += `
						<div class="content">
							<div>
								<p>• ${li.program_date?.split("-")[1]}월 ${li.program_date?.split("-")[2]}일</p>
								<p>• ${li.start_time}~${li.end_time}</p>
								<p>• ${roomText}</p>
							</div>
							<div>
								<p>${li.program_name}</p>
							</div>
						</div>
			`

		})
		contents.innerHTML = contentsHtml;
	}

	/** modal 없애는 함수 */
	function hideModal(){
		modalBackground.style.display = "none";
		modal.style.display = "none";
	}
</script>

<?php include_once('./include/footer.php');?>
