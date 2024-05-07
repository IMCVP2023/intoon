<div class="footer_wrap">
    <!-- 220323 HUBDNC LJH 추가 -->
    <div class="fixed_btn_clone"></div>
    <div class="fixed_btn_wrap">
        <ul class="toolbar_wrap">
            <!-- <li>
                <a class="not_yet">
                <a href="/main/program_glance.php">
                  <img src="/main/img/icons/footer_notice.png" alt="">
                    <img src="/main/img/icons/tool_program.svg" alt="">
                </a>
            </li> -->
            <?php
            if ($_SESSION["USER"]["regi_status"] == 2 || $_SESSION["USER"]["regi_status"] == 5) {
            ?>
            <!--[230824] 다운로드 버튼 추가 / 파일 전달X-->
            <!-- <li>
                <a class="not_yet type2 pink">
                <a href="http://184a8b4a1a076d93.kinxzone.com/Abstractbook.pdf" target="_blank" class="type2 pink"> 
                    <i><img src="/main/img/icons/icon_download_abstract.svg" alt=""></i>
                    Abstract Book <br />Download
                </a>
            </li>
            <li>
                <a class="not_yet type2 violet">
                <a href="http://184a8b4a1a076d93.kinxzone.com/Programbook.pdf" target="_blank" class="not_yet type2 violet"> 
                    <i><img src="/main/img/icons/icon_download_program.svg" alt=""></i>
                    Program Book <br />Download
                </a>
            </li> -->
            <!-- <li>
                <a class="not_yet">
                    <img src="/main/img/icons/footer_registration.png" alt="">
                </a>
            </li>
            <li>
                <a class="not_yet">
                    <img src="/main/img/icons/footer_abstract.png" alt="">
                </a>
            </li> -->
            <?php
            } else {
            ?>
            <!-- <li>
                <a class="not_yet">
                    <img src="/main/img/icons/footer_registration.png" alt="">
                </a>
            </li>
            <li>
                <a class="not_yet">
                    <img src="/main/img/icons/footer_abstract.png" alt="">
                </a>
            </li> -->
            <?php
            }
            ?>
            <?php
            if ($_SESSION["USER"]["idx"] == "") {
            ?>
            <!-- <li><button type="button" onClick="alert('Need to login.')"><i>
                <img src="/main/img/icons/footer_mypage.png" alt="">
                <img src="/main/img/icons/tool_mypage.svg" alt="">
            </i></button></li> -->
                <!-- <li>
                    <a href="/main/login.php" onClick="alert('Need to login.')">
                        <img src="/main/img/icons/footer_mypage.png" alt=""></i></button>
                    </a>
                </li> -->
            <?php
            } else {
            ?>
            <!-- <li><button type="button" onClick="location.href='/main/mypage.php'"><i> -->
                <!-- <li>
                    <a href="/main/mypage.php">
                        <img src="/main/img/icons/footer_mypage.png" alt=""></i></button>
                    </a>
                </li> -->
                 
            <!-- </li> -->
            <?php
            }
            ?>

        </ul>
        <button type="button" class="btn_right">G<br>O<br><br>T<br>O</button>
        <div class="footer_go_to_box">
            <div><a href="/main/program_glance_icola.php">Program</a></div>
            <div><a href="/main/registration.php">Registration</a></div>
            <div><a href="/main/abstract_submission.php">Call for Abstract</a></div>
            <div><a href="/main/mypage.php">My IMCVP</a></div>
        </div>
        <!-- <button type="button" class="btn_plus"><img src="/main/img/icons/icon_plus_white.svg" alt=""></button> -->
        <button type="button" class="btn_top"><img src="/main/img/icons/icon_top_btn.svg" alt=""></button>
    </div>
    <!-- 220323 HUBDNC LJH 추가 : 끝 -->
    <!--
    <div class="sponsor_logo-wrap container">
        <ul class="s_logo_list">
            <li><img src="./img/sponsor/logo01.png" alt=""></li>
            <li><img src="./img/sponsor/logo02.png" alt=""></li>
            <li><img src="./img/sponsor/logo03.png" alt=""></li>
            <li><img src="./img/sponsor/logo04.png" alt=""></li>
            <li><img src="./img/sponsor/logo05.png" alt=""></li>
            <li><img src="./img/sponsor/logo06.png" alt=""></li>
            <li><img src="./img/sponsor/logo07.png" alt=""></li>
            <li><img src="./img/sponsor/logo08.png" alt=""></li>
            <li><img src="./img/sponsor/logo09.png" alt=""></li>
            <li><img src="./img/sponsor/logo10.png" alt=""></li>
            <li><img src="./img/sponsor/logo11.png" alt=""></li>
            <li><img src="./img/sponsor/logo12.png" alt=""></li>
            <li><img src="./img/sponsor/logo13.png" alt=""></li>
            <li><img src="./img/sponsor/logo14_1.png" style="max-height:20px;" alt=""></li>
            <li><img src="./img/sponsor/logo15.png" alt=""></li>
            <li><img src="./img/sponsor/logo16.png" alt=""></li>
            <li><img src="./img/sponsor/logo17.png" alt=""></li>
            <li><img src="./img/sponsor/logo18.png" alt=""></li>
            <li><img src="./img/sponsor/logo19.png" alt=""></li>
            <li><img src="./img/sponsor/logo20.png" alt=""></li>
            <li><img src="./img/sponsor/logo21.png" alt=""></li>
            <li><img src="./img/sponsor/logo22.png" alt=""></li>
            <li><img src="./img/sponsor/logo23.png" alt=""></li>
        </ul>
    </div> -->
    <div class="sponsor_logo-wrap container">
        <ul class="s_logo_list">
        <li>
					<a href="https://m.daewoong.co.kr/en/main/index" class="daewoong">DAEWOONG</a>
				</li>
				<li class="small">
					<a href="https://daewoongbio.co.kr/daewoongbiokr/main/main.web" class="daewoong_bio">DAEWOONG</a>
				</li>
                <li>
					<a href="https://www.daiichisankyo.com/" class="daiichi_sankyo">Daiichi Sankyo</a>
				</li>
                <li>
					<a href="https://www.boryung.co.kr/en/" class="boryung">BORYUNG</a>
				</li>
				<li class="small">
					<a href="https://www.celltrionph.com/en-us/home/index" class="celltrion">CELLTRION</a>
				</li>
				<li>
					<a href="https://www.hanmipharm.com/ehanmi/handler/Home-Start" class="hanmi_pharm">Hanmi Pharm</a>
				</li>
                <li class="small">
					<a href="https://www.daewonpharm.com/eng/main/index.jsp" class="daewon">Daewon</a>
				</li>
				<li>
					<a href="http://www.ckdpharm.com/en/home" class="chong_kun_dang">Chong Kun Dang</a>
				</li>
				<li>
					<a href="" class="bily">Chong Kun Dang</a>
				</li>
                <li>
					<a href="https://www.novonordisk.com/" class="novo_nordisk">novo nordisk</a>
				</li>
				<li>
					<a href="https://www.bayer.com/en/" class="bayer">Bayer</a>
				</li>

				<li class="small">
					<a href="https://www.sanofi.com/en/our-company" class="sanofi">sanofi</a>
				</li>
				<li>
					<a href="http://www.dalimpharm.co.kr/en_index.html" class="dalimbiotech">dalimbiotech</a>
				</li>
				<li>
					<a href="https://www.organon.com/" class="organon">ORGANON</a>
				</li>

        </ul>
    </div>
    <footer class="footer">
        <div class="container">
            <br>
            <!--<h5>Supported by</h5>-->
            <div class="f_bottom clearfix">
                <div class="footer_l">
                    <div class="clearfix">
                        <a href="https://koreascp.or.kr:459/" target="_blank">
                            <img src="/main/img/icons/KSCP_logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="footer_c">
                    <p>Korean Society of Cardiovascular Disease Prevention (KSCP)</p>
                    <ul>
                        <li>#805, 99, Seongsuil-ro, Seongdong-gu, Seoul Korea(Seongsu-dong 1-ga, Seoul Forest AK Valley Knowledge Industry Center)</li>
                        <li>T. 82-2-6408-1505</li>
                        <!-- <li>F. 82-2-364-0883</li> -->
                        <li>E. <a href="mailto:kscpmd@kscpmd.or.kr"
                                class="font_inherit link">kscpmd@kscpmd.or.kr </a></li>
                        <li>W. <a href="https://koreascp.or.kr:459/" class="font_inherit link">https://koreascp.or.kr</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_r">
                    <p>Secretariat of IMCVP 2024</p>
                    <ul>
                        <li>A-Block Richensia 4F, 341 Baekbeom-ro, Yongsan-gu, Seoul 04315, Korea</li>
                        <li>T. 82-2-2285-2592</li>
                        <li>F. 82-2-2039-7804</li>
                        <!--li>E. <a href="mailto:imcvp@into-on.com" class="font_inherit link">imcvp@into-on.com</a></li-->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- <div class="popup term3">
    <div class="pop_bg"></div>
    <div class="pop_contents">
        <button type="button" class="pop_close"><img src="/main/img/icons/pop_close.png"></button>
        <h3 class="pop_title">Terms</h3>
        <?= $locale("terms") ?>
    </div>
</div> -->

<!-- 
<div class="popup term4">
    <div class="pop_bg"></div>
    <div class="pop_contents">
        <button type="button" class="pop_close"><img src="/main/img/icons/pop_close.png"></button>
        <h3 class="pop_title">Conditions</h3>
        <?= $locale("privacy") ?>
    </div>
</div> -->
<script>
// $('.term3_btn').on('click', function() {
//     $('.term3').show();
// })
// $('.term4_btn').on('click', function() {
//         $('.term4').show();
//     })

//     $('.type2').on('click', function(event) {
//         event.preventDefault();
//         alert('Updates are planned.');
//         return false;
//     }) 


//[240415] sujeong plus btn

// $('.toolbar_wrap').css({
//     opacity: 0,
//     transform: 'translateY(100%)', 
//     transition: 'opacity 0.5s ease-in-out, transform 0.5s ease-in-out' 
// })
// $('.btn_plus, .toolbar_wrap').hover(() => {
//     $('.toolbar_wrap').css({
//         opacity: 1,
//         transform: 'translateY(-10%)' 
// })
// },()=>{
//     $('.toolbar_wrap').css({
//         opacity: 0,
//         transform: 'translateY(100%)'
// })
// });

//[240502] sujeong / right btn
$('.footer_go_to_box').css({
    opacity: 0,
    transform: 'translateX(100%)', 
    transition: 'opacity 0.5s ease-in-out, transform 0.5s ease-in-out' 
})
$('.btn_right, .footer_go_to_box').hover(() => {
    $('.footer_go_to_box').css({
        opacity: 1,
        transform: 'translateX(0%)' 
})
$('.btn_right').css({
        opacity: 1,
        transform: 'translateX(-150px)',
        transition: 'opacity 0.5s ease-in-out, transform 0.5s ease-in-out'  
})
},()=>{
    $('.footer_go_to_box').css({
        opacity: 0,
        transform: 'translateX(100%)'
})
$('.btn_right').css({
        opacity: 1,
        transform: 'translateX(0px)',
        transition: 'opacity 0.5s ease-in-out, transform 0.5s ease-in-out'  
})
});

</script>