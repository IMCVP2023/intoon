<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>

<section class="container program_glance_sj sub_page">
	<div class="sub_background_box">
		<div class="sub_inner">
			<div>
				<h2>Program at a glance</h2>
				<ul>
					<li>Home</li>
					<li>Program</li>
					<li>Program at a glance</li>
				</ul>
				<!--
				<button onclick="javascript:window.location.href='./download/2022_program_glance2.pdf'" class="btn" target="_blank">Program at a Glance Download</button>-->
				<!-- <a href="./download/ICoLA2022_Program at a Glance.pdf" target="_blank" class="btn" download>Program at a Glance Download</a> -->
			</div>	
		</div>
	</div>
	<div class="inner">
		<ul class="tab_pager">
			<li class="on"><a href="javascript:;">November 29 <i></i>(Fri)</a></li>
			<li><a href="javascript:;">November 30 <i></i>(Sat)</a></li>
			<!-- <li><a href="javascript:;">September 17 <i></i>(Sat)</a></li> -->
		</ul>
		<ul	class="program_color_txt">
			<li><i></i>&nbsp;:&nbsp;Korean</li>
			<li><i></i>&nbsp;:&nbsp;English</li>
		</ul>
		<div class="tab_wrap">
			<div class="tab_cont on">
				<table class="table program_glance_table" name="1">
					<colgroup>
						<col class="grogram_time">
						<col/>
						<col/>
						<col width="10%"/>
					</colgroup>	
					<thead>
						<tr>
							<th>Room</th>
							<th>Room A</th>
							<th>Room B</th>
							<th>Room C</th>
						</tr>
					</thead>
					<tbody name="day" class="day_1">
						<tr>
							<td class="">08:50~09:00</td>
							<td colspan="2">Registration and Opening Remark</td>
							<td rowspan="11">TBD</td>
						</tr>
						<tr>
							<td class="">09:00~10:40</td>
							<td class="pink_bg pointer" name="symposium_1">
								 Symposium 1<br/>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="green_bg pointer" name="symposium_2">
								Symposium 2<br/>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="">10:40~11:00</td>
							<td colspan="2">Coffee Break</td>
						</tr>
						<tr>
							<td class="">11:00~11:10</td>
							<td colspan="2">Opening Address</td>
						</tr>
						<tr>
							<td class="">11:10~11:50</td>
							<td colspan="2" class="green_bg pointer" name="plenary_lecture_1">
								Plenary Lecture 1
								<input type="hidden" name="e" value="room1">
							</td>
						</tr>
						<tr>
							<td class="">11:50~13:00</td>
							<td class="pink_bg pointer" name="luncheon_symposium_1">
								Luncheon Symposium 1
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="pink_bg pointer" name="luncheon_symposium_2">
								Luncheon Symposium 2
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="">13:00~14:40</td>
							<td class="pink_bg pointer" name="symposium_3">
								Symposium 3
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="pink_bg pointer" name="symposium_4">
								Symposium 4
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="">14:40~15:00</td>
							<td colspan="2">Coffee Break</td>
						</tr>
						<tr>
							<td class="">15:00~15:40</td>
							<td colspan="2" class="green_bg pointer" name="plenary_lecture_2">
								Plenary Lecture 2
								<input type="hidden" name="e" value="room1">
							</td>
						</tr>
						<tr>
							<td class="">15:40~17:20</td>
							<td class="pink_bg pointer" name="symposium_5">
								Symposium 5
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="pink_bg pointer" name="symposium_6">
								Symposium 6
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="">17:20~18:00</td>
							<td class="pink_bg pointer" name="satellite_symposium_1">
								Satellite Symposium 1
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="pink_bg pointer" name="satellite_symposium_2">
								Satellite Symposium 2
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tab_cont">
				<table class="table program_glance_table" name="2">
					<colgroup>
						<col class="grogram_time">
						<col/>
						<col/>
						<col width="10%"/>
					</colgroup>	
					<thead>
						<tr>
							<th>Room</th>
							<th>Room A</th>
							<th>Room B</th>
							<th>Room C</th>
						</tr>
					</thead>
					<tbody name="day" class="day_2">
						<tr>
							<td class="">07:00~08:00</td>
							<td class="pink_bg pointer" name="breakfast_symposium_1">
								Breakfast Symposium 1<br/>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="green_bg pointer" name="breakfast_symposium_2">
								Breakfast Symposium 2<br/>
								<input type="hidden" name="e" value="room2">
							</td>
							<td rowspan="12">TBD</td>
						</tr>
						<tr>
							<td class="">08:00~08:30</td>
							<td colspan="2">Break</td>
						</tr>
						
						<tr>
							<td class="">08:30~10:10</td>
							<td class="green_bg pointer" name="symposium_7">
								Symposium 7
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="green_bg pointer" name="symposium_8">
								Symposium 8
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="">10:10~10:30</td>
							<td colspan="2">Coffee Break</td>
						</tr>
						<tr>
							<td class="">10:30~11:10</td>
							<td class="green_bg pointer" colspan="2" name="plenary_lecture_3">
								Plenary Lecture 3 
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
						</tr>
						<tr>
							<td class="">11:10~12:50</td>
							<td class="green_bg pointer" name="symposium_9">
								Symposium 9<br/>
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="pink_bg pointer" name="symposium_10">
								Symposium 10
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="pointer">12:50~13:50</td>
							<td class="pink_bg pointer" name="luncheon_symposium_3">
								Luncheon Symposium 3<br/>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="green_bg pointer" name="luncheon_symposium_4">
								Luncheon Symposium 4<br/>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="">13:50~15:00</td>
							<td class="green_bg pointer" name="symposium_11">
								Symposium 11
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="green_bg pointer" name="hot_topics">
								Hot topics in CPP<br/>
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
						</tr>
						<tr>
							<td class="">15:00~15:20</td>
							<td colspan="2">Coffee Break</td>
						</tr>
						<tr>
							<td class="">15:20~16:00</td>
							<td class="green_bg pointer" colspan="2" name="plenary_lecture_4">
								Plenary Lecture 4
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
						</tr>
						<tr>
							<td class="">16:00~17:40</td>
							<td class="pink_bg pointer" name="satellite_symposium_3">
								Satellite Symposium 3
								<p></p>
								<input type="hidden" name="e" value="room1">
							</td>
							<td class="pink_bg pointer" name="satellite_symposium_4">
								Satellite Symposium 4
								<p></p>
								<input type="hidden" name="e" value="room2">
							</td>
							
						</tr>
						<tr>
							<td class="">17:40~18:00</td>
							<td colspan="2">Closing Ceremony</td>
						</tr>
						
					</tbody>
				</table>
			</div>
			
		</div>
		
	</div>
	
</section>

<script>
$(document).ready(function() {

		  //탭
	 $(".tab_pager li").click(function(){
		if (!$(this).parent("ul").hasClass("location")){
			var i = $(this).index();
			$(".tab_pager li").removeClass("on");
			$(this).addClass("on");
			$(".tab_cont").removeClass("on");
			$(".tab_cont").eq(i).addClass("on");
		}
		
	});

	$('.program_table').each(function(){
		var parents_div = $(this).parents('.program_table_wrap');
		$(this).clone(true).appendTo(parents_div).addClass('clone');   
	});
   var i = 1;
	$('.program_table td').each(function(){ 
       if (!$(this).is(':empty')){
           var td = $(this).attr('colspan');
           if(!$(this).hasClass("dark_bg") && !(td == 5)){
               var tabId = $(this).closest('.program_table_wrap').attr('id');
               var lectureId = "lId_" + i;
               var lectureSrc = "./program_detail.php#"+tabId+"&#"+lectureId;
               $(this).attr('id',lectureId);
               $(this).wrapInner('<a target="_blank" href="'+lectureSrc+'"></a>');
//               $('<a target="_blank" href="'+lectureSrc+'"></a>').prependTo($(this));
               i = i+1;                
           }
       }
	});
});
</script>

<script>
	$(document).ready(function(){
		$("td.pointer").click(function(){
			var e = $(this).find("input[name=e]").val();
			var day = $(this).parents("tbody[name=day]").attr("class");
			var target = $(this)
			var this_name = $(this).attr("name");
			var table_num = $(this).parents("table").attr("name")

			table_location(event, target, e, day, this_name, table_num);
		});
	});

	function table_location(event, _this, e, day, this_name, table_num){
		window.location.href="./scientific_program"+table_num+".php?&e="+e+"&name="+this_name;
	}
</script>

<?php include_once('./include/footer.php');?>