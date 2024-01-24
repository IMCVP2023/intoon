<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>

<section class="container terms">
	<div class="sub_banner">
		<h1>Terms</h1>
	</div>
	<div class="tab_green">
		<ul class="clearfix">
			<li><a href="./terms1.php">Terms1</a></li>
			<li class="on"><a href="./terms2.php">Terms2</a></li>
		</ul>
	</div>
	<div class="inner">
		<div class="details">
			<p class="pre">
<strong>Privacy Policy</strong>
We, ICoLA 2022 secretariat, collect and use personal information for the following purposes described below.


<span>1. Collection and Use of Personal Information</span>
• Personal information is data that can be used to identify or contact a single person.
• We do not use the personal information for any purpose that disclose such information to any third party without the consent of the participant.


<span>2. What personal information we collect</span>
• When you create an ICoLA 2022 we may collect a variety of information, including your e-mail, password, country, name, organization, phone number, and address information.


<span>3. Duration of Retention and Use of Personal Information and Destruction</span>
• As a general rule, the ICoLA 2022 retains and uses participant’s personal information for the notified and agreed durations and once the purposes of collection and use of the personal information are achieved, it is without delay destroyed.
• The duration of retention / use of collected personal information will start from when the User Agreement is entered into (i.e., signing up for a membership) and end when the User Agreement is terminated (including, but not limited to, applying for withdrawal from the membership, and discretionary withdrawal/dismissal). Further, in the case of termination of the User Agreement upon mutual agreement, the Company will without delay destroy all of your personal information other than contained in materials required to retain for a certain period for the afore-mentioned reasons for data retention, and will also instruct its third-party service providers to destroy the personal information provided to them for the outsourcing of data processing. 
• Your personal information will be destroyed without delay if the purposes of collection and use of the personal information are achieved. If printed on paper, your personal information will be destroyed by shredding or incinerating the paper documents or otherwise and, if saved in the form of electronic files, your personal information will be destroyed by technical means making the records non reproducible. 
			</p>
		</div>
	</div>
</section>

<div class="popup contact_pop" style="display: block">
	<div class="pop_bg"></div>
	<div class="pop_contents">
		<h3 class="pop_title">Contact Us</h3>
		<button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
		<ul class="contact_pop_info">
			<li>
				<p>Secretariat of ICoLA & APSAVD 2022</p>
				<p>INTO-ON, Inc.</p>
			</li>
			<li>Tel: +82-2-2285-2596</li>
			<li>Fax: +82-2-3275-3044</li>
			<li>E-mail: <a href="mailto:secretariat@icola.org" target="_blank" class="underline">secretariat@icola.org</a></li>
			<li>2F, Wonhyo-ro, #204, Yongsan-gu, Seoul, Korea</li>
		</ul>
	</div>
</div>

<style>
	.contact_pop .pop_contents li:before {display: none;}
	.contact_pop_info li {text-align: center;}
	.contact_pop_info li:nth-of-type(1) {display: flex; justify-content: center;}
	.contact_pop_info li:nth-of-type(1) p:first-child {margin-right: 20px; position: relative;}
	.contact_pop_info li:nth-of-type(1) p:first-child:after {content: ""; display: block; width: 1px; height: 15px; background-color: #707070; position: absolute; right: -10px; top: 50%; transform: translateY(-50%);}
	
	@media screen and (max-width: 600px){
		.contact_pop_info li:nth-of-type(1) {flex-direction: column; align-items: center;}
		.contact_pop_info li:nth-of-type(1) p:first-child {margin-right: 0; margin-bottom: 5px;}
		.contact_pop_info li:nth-of-type(1) p:first-child:after {display: none;}
	}
</style>

<?php include_once('./include/footer.php');?>