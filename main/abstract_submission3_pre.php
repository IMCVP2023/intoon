<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<style>
	.submit_application .steps_area {margin-top: 100px;}
</style>
<section class="submit_application abstract_online_submission container">
    <div class="">
        <!-- <div class="sub_banner">
            <h1 class="point_txt">Abstract Submission</h1>
        </div> -->
        <!-- <ul class="tab_green long">
			<li><a href="./abstract_submission_guideline.php">Abstract Submission Guideline</a></li>
			<li class="on"><a href="./abstract_submission.php">Online Submission</a></li>
			<li onclick="javascript:alert('Coming Soon.')"><a href="javascript:;">Oral Presenters</a></li>
			<li onclick="javascript:alert('Coming Soon.')"><a href="javascript:;">Poster Exhibition</a></li>
			<li><a href="./abstract_submission_award.php">Awards & Grants</a></li>
		</ul> -->
        <!-- <div class="tab_area"> -->
        <!-- 	<ul class="clearfix"> -->
        <!-- 		<li><a href="./poster_abstract_submission.php" class="btn"><?=$locale("abstract_menu1")?></a></li> -->
        <!-- 		<li><a href="javascript:;" class="btn active"><?=$locale("abstract_menu2")?></a></li> -->
        <!-- 		<li><a href="./eposter.php" class="btn"><?=$locale("abstract_menu3")?></a></li> -->
        <!-- 	</ul> -->
        <!-- </div> -->
		<h1 class="page_title">Online Submission</h1>
        <div class="section section1">
            <div class="steps_area">
                <div class="steps_area">
                    <ul class="clearfix">
                        <li class="next">
                            <p>Step 1</p>
                            <!-- <p></p> -->
							<p class="sm_txt">Fill out author’s information</p>
                            <!-- <p class="sm_txt"><?=$locale("abstract_online_tit1")?></p> -->
                        </li>
                        <li class="next">
                            <p>Step 2</p>
							<p class="sm_txt">Enter the abstract section, including the type of presentation, topic categories, and title.</p>
                            <!-- <p class="sm_txt"><?=$locale("abstract_submit_tit2")?></p> -->
                        </li>
                        <li class="on">
                            <p>Step 3</p>
							<p class="sm_txt">Complete and confirm submission.</p>
                            <!-- <p class="sm_txt"><?=$locale("submit_completed_tit")?></p> -->
                        </li>
                    </ul>
                </div>
            </div>
            <div class="completed_box">
                <!-- <img src="./img/icons/post_complete.png"> -->
                <!-- <h1><?=$locale("abstract_submit_msg")?></h1> -->
                <p>Thank you for submitting abstract.<br />Approval for your submission will be sent to the email
                    address provided by you<br /><br />You can modify the submitted abstract on 'My Page’ up until the
                    submission deadline. </p>
            </div>
        </div>
        <!--//section1-->

    </div>
</section>




<?php include_once('./include/footer.php');?>