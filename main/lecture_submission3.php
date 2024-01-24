<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>

<section class="submit_application container">
	<div class="">
		<div class="sub_banner">
			<h1>Lecture Note Submission</h1>
		</div>
		<ul class="tab_green">
			<li><a href="./lecture_note_submission.php">Lecture Note Submission Guideline</a></li>
			<li class="on"><a href="javascript:;">Online Submission</a></li>
			<!-- <li><a href="./oral_presenters.php"><?=$locale("lecture_menu3")?></a></li> -->
			<!-- <li><a href="./eposter_presenters.php"><?=$locale("lecture_menu4")?></a></li> -->
		</ul>
		<div>
			<div class="steps_area">
				<ul class="clearfix">
					<li class="next">
						<p>Step 1</p>
						<p class="sm_txt"><?=$locale("lecture_submit_tit1")?></p>
					</li>
					<li class="next">
						<p>Step 2</p>
						<p class="sm_txt"><?=$locale("lecture_submit_tit2")?></p>
					</li>
					<li class="on">
						<p>Step 3</p>
						<p class="sm_txt"><?=$locale("submit_completed_tit")?></p>
					</li>
				</ul>
			</div>
			<div class="completed_box">
				<!-- <p><?=$locale("lecture_submit_msg")?></p> -->
				<!-- <img src="./img/icons/abstract_complete2.png"> -->
				<p>Thank you for submitting Lecture note.<br/>You can modify the submitted CV and lecture note on 'My Page’ up until the submission deadline.</p>
			</div>
		</div>
	</div>
</section>

<?php include_once('./include/footer.php');?>