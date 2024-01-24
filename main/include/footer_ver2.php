<div class="footer_wrap">
    <!-- 220323 HUBDNC LJH 추가 -->
    <div class="fixed_btn_clone"></div>
    <div class="fixed_btn_wrap">
        <ul class="toolbar_wrap">
            <li><button type="button" onClick="location.href='/main/board_notice.php'"><i><img
                            src="/main/img/icons/tool_faq.svg" alt=""></i>Notice</button></li>
            <li><button type="button" onClick="location.href='/main/registration.php'"><i><img
                            src="/main/img/icons/tool_regist.svg" alt=""></i>Registration</button></li>
            <li><button type="button" onClick="location.href='/main/abstract_submission.php'"><i><img
                            src="/main/img/icons/tool_abstract.svg" alt=""></i>Abstract</button></li>
            <?php
            if ($_SESSION["USER"]["idx"] == "") {
            ?>
            <li><button type="button" onClick="alert('Need to login.')"><i><img src="/main/img/icons/tool_mypage.svg"
                            alt=""></i>My page</button></li>
            <?php
            } else {
            ?>
            <li><button type="button" onClick="location.href='/main/mypage.php'"><i><img
                            src="/main/img/icons/tool_mypage.svg" alt=""></i>My Page</button></li>
            <?php
            }
            ?>

        </ul>
        <button type="button" class="btn_top"><img src="/main/img/icons/icon_top_btn.svg" alt=""></button>
    </div>
    <!-- 220323 HUBDNC LJH 추가 : 끝 -->
    <div class="sponsor_logo-wrap container">
        <ul class="s_logo_list">
            <li><img src="/main/img/sponsor/logo01.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo02.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo03.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo04.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo05.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo06.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo07.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo08.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo09.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo10.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo11.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo12.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo13.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo14_1.png" style="max-height:20px;" alt=""></li>
            <li><img src="/main/img/sponsor/logo15.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo16.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo17.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo18.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo19.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo20.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo21.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo22.png" alt=""></li>
            <li><img src="/main/img/sponsor/logo23.png" alt=""></li>
        </ul>
    </div>
    <footer class="footer2">
        <div class="container">
            <br>
            <!--<h5>Supported by</h5>-->
			<div class="f_bottom clearfix">
				<div class="footer_t">
					<p class="footer_title">• Supported by</p>
				</div>
				<div class="footer_b">
					<p class="footer_title">• Organized by</p>
					<div>
						<div class="footer_l">
							<img src="/main/img/icons/fl01.png" alt="">
							<div>
								<p class="footer_l_title">Korean Society for the Study of Obesity(KSSO)</p>
								<ul>
									<!-- <li><span>T.</span> 82-2-6941-0888, 82-2-364-0886,0887</li> -->
									<li><span>T.</span> 82-2-364-0886,0887</li>
									<li><span>F.</span> 82-2-364-0883</li>
									<!-- <li><span>Email.</span> <a href="mailto:webmaster@kosso.or.kr" class="font_inherit">webmaster@kosso.or.kr</a> / <br class="min_br"><a href="mailto:kosso@kosso.or.kr" class="font_inherit">kosso@kosso.or.kr</a></li> -->
									<li><span>E.</span> <a href="mailto:webmaster@kosso.or.kr" class="font_inherit">webmaster@kosso.or.kr</a></li>
									<li><span>W.</span> <a href="https://www.kosso.or.kr" class="font_inherit">https://www.kosso.or.kr</a></li>
									<!-- <li><span>Business Registration Number. <br class="min_br"></span>121-82-61144</li> -->
									<!-- <li><span>President.</span> Chang Beom Lee</li> -->
									<li>Room 1010, Renaissance tower, <br class="min_br">14 Mallijae-ro, Mapo-gu, Seoul, Korea</li>
								</ul>
							</div>
				
						</div>
						<div class="footer_r">
							<p class="footer_r_title">Secretariat of ICOMES 2023</p>
							<ul>
								<li><span>T.</span> 82-2-2285-2582</li>
								<li><span>F.</span> 82-2-2285-2530</li>
								<li><span>E.</span> <a href="mailto:icomes@into-on.com" class="font_inherit">icomes@into-on.com</a></li>
								<!-- <li>2F, Wonhyo-ro, #204, Yongsan-gu, Seoul, Korea</li> -->
								<li>A-Block Richensia 4F, 341 Baekbeom-ro, Yongsan-gu, Seoul 04315, Korea</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--
            <div class="f_bottom clearfix">
                <div class="footer_l">
                    <div class="clearfix">
                        <img src="./img/icons/fl01.png" alt="">
						<img src="./img/icons/fl02.png" alt="">
                        <img src="./img/icons/fl03.png" alt="">
                        <img src="./img/icons/fl04.png" alt="">
                    </div>
                </div>
                <div class="footer_c">
                    <!-- <p>Organized by</p>
					<p>Korean Society for the Study of Obesity(KSSO)</p>
					<ul>
						<li>Room 1010, Renaissance tower, 14 Mallijae-ro, Mapo-gu, Seoul, Korea</li>
						<li>T. 82-2-364-0886,0887</li>
						<li>F. 82-2-364-0883</li>
						<li>E. <a href="mailto:webmaster@kosso.or.kr" class="font_inherit link">webmaster@kosso.or.kr</a></li>
						<li>W. <a href="https://www.kosso.or.kr" class="font_inherit link">https://www.kosso.or.kr</a></li>
					</ul>
					<!--
                    <ul>
                        <li>Tel. 82-2-6941-0888, 82-2-364-0886,0887 / Fax. 82-2-364-0883</li>
                        <li>Email. webmaster@kosso.or.kr / kosso@kosso.or.kr</li>
                        <li>Business Registration Number. 121-82-61144</li>
                    </ul>
                    <ul>
                        <li><span class="bold">President.</span> Chang Beom Lee</li>
                        <li>Room 1010, Renaissance tower, 14 Mallijae-ro, Mapo-gu, Seoul, Kore</li>
                    </ul>
					
                </div>
                <div class="footer_r">
                    <!-- <p>Conference Secretariat</p>
					<p>Secretariat of ICOMES 2023</p>
					<ul>
						<li>A-Block Richensia 4F, 341 Baekbeom-ro, Yongsan-gu, Seoul 04315, Korea</li>
						<li>T. 82-2-2285-2582</li>
						<li>F. 82-2-2285-2530</li>
						<li>E. <a href="mailto:icomes@into-on.com" class="font_inherit link">icomes@into-on.com</a></li>
					</ul>
					<!--
                    <ul>
                        <li>Tel. +82-2-2285-2582  | Fax : 82-2-2285-2530
                            <br />Email : icomes@into-on.com
                        </li>
                        <li><br /></li>
                        <li>A-Block Richensia 4F, 341 Baekbeom-ro,
                            <br /> Yongsan-gu, Seoul, Korea
                        </li>
                        <li>Tel : +82-2-2285-2582 ㅣEmail : icomes@into-on.com</li>
                    </ul>
					
                </div>
            </div> -->
        </div>
    </footer>
</div>

<div class="popup term3">
    <div class="pop_bg"></div>
    <div class="pop_contents">
        <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
        <h3 class="pop_title">Terms</h3>
        <?= $locale("terms") ?>
    </div>
</div>


<div class="popup term4">
    <div class="pop_bg"></div>
    <div class="pop_contents">
        <button type="button" class="pop_close"><img src="./img/icons/pop_close.png"></button>
        <h3 class="pop_title">Conditions</h3>
        <?= $locale("privacy") ?>
    </div>
</div>
<script>
$('.term3_btn').on('click', function() {
    $('.term3').show();
})
$('.term4_btn').on('click', function() {
    $('.term4').show();
})
</script>