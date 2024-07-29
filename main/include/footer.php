<div class="footer_wrap">
    <!-- 220323 HUBDNC LJH 추가 -->
    <div class="fixed_btn_clone"></div>
    <div class="fixed_btn_wrap">
        <ul class="toolbar_wrap">
             <li>
                <!-- <a class="not_yet"> -->
                <a href="/main/program_glance.php">
                  <!-- <img src="/main/img/icons/footer_notice.png" alt=""> -->
                    <img src="/main/img/icons/2024_tool_program.svg" alt="" class="program_icon">
                </a>
            </li> 
            <li>
                <a href="/main/registration_guidelines.php">
                    <img src="/main/img/icons/2024_footer_registration.svg" alt="" class="regi_icon">
                </a>
            </li>
            <li>
                <a href="/main/abstract_submission_guideline.php">
                    <img src="/main/img/icons/2024_footer_abstract.svg" alt="" class="abstract_icon">
                </a>
            </li>
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
                <a href="/main/registration_guidelines.php">
                    <img src="/main/img/icons/2024_footer_registration.svg" alt="" class="regi_icon">
                </a>
            </li>
            <li>
                <a href="/main/abstract_submission_guideline.php">
                    <img src="/main/img/icons/2024_footer_abstract.svg" alt="" class="abstract_icon">
                </a>
            </li> -->
            <?php
            }
            ?>
            <?php
            if ($_SESSION["USER"]["idx"] == "") {
            ?>
           <!-- <li>
            <button type="button" onClick="alert('Need to login.')">
                <img src="/main/img/icons/2024_tool_mypage.svg" alt="" class="mypage_icon">
            </button>
            </li> -->
                <li>
                    <a href="/main/login.php" onClick="alert('Need to login.')">
                        <img src="/main/img/icons/2024_tool_mypage.svg" alt="" class="mypage_icon"></i></button>
                    </a>
                </li>
            <?php
            } else {
            ?>
             <li>
                    <a href="/main/mypage.php">
                        <img src="/main/img/icons/2024_tool_mypage.svg" alt=""class="mypage_icon"></i></button>
                    </a>
                </li>
              <!-- <li>
            <button type="button" onClick="alert('Need to login.')">
                <img src="/main/img/icons/2024_tool_mypage.svg" alt="" class="mypage_icon">
            </button>
            </li>
             <li><button type="button" onClick="location.href='/main/mypage.php'"><i>
                    <a href="/main/mypage.php">
                        <img src="/main/img/icons/2024_tool_mypage.svg" alt=""></i></button>
                    </a>
                </li>  -->
                 
            <!-- </li> -->
            <?php
            }
            ?>

</ul>
<button type="button" class="btn_top"><img src="/main/img/icons/2024_icon_top_btn.svg" alt=""></button>
        <!-- <button type="button" class="btn_right">G<br>O<br><br>T<br>O</button>
        <div class="footer_go_to_box">
            <div><a href="/main/program_glance_icola.php">Program</a></div>
            <div><a href="/main/registration.php">Registration</a></div>
            <div><a href="/main/abstract_submission.php">Call for Abstract</a></div>
            <div><a href="/main/mypage.php">My IMCVP</a></div>
        </div> -->
        <!-- <button type="button" class="btn_plus"><img src="/main/img/icons/icon_plus_white.svg" alt=""></button> -->
    </div>
    <!-- 220323 HUBDNC LJH 추가 : 끝 -->
   
    <div class="sponsor_logo-wrap container">
        <ul class="s_logo_list">
                <li>
					<a href="https://m.daewoong.co.kr/en/main/index" class="daewoong">DAEWOONG</a>
				</li>
				<li class="small">
					<a href="https://daewoongbio.co.kr/daewoongbiokr/main/main.web" class="daewoong_bio">DAEWOONG</a>
				</li>
                <li>
					<a href="https://www.daiichisankyo.com/" class="daiichi_sankyo">Daiichi Sankyo & DAEWOONG</a>
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

				<li>
					<a href="https://www.jw-pharma.co.kr/pharma/en/main.jsp" class="jw_pharm">jw_pharm</a>
				</li>
				<li class="">
					<a href="http://en.donga-st.com/Main.da" class="dong_a">dong-a</a>
				</li>
				<li>
					<a href="http://eng.yuhan.co.kr/Main/" class="yuhan">yuhan</a>
				</li>
				<li>
					<a href="https://www.lgchem.com/main/index" class="lg_chem">lg_chem</a>
				</li>
                <li class="small">
					<a href="https://www.inno-n.com/eng/" class="inno_n">inno_n</a>
				</li>

                <li class="small">
					<a href="https://www.daewonpharm.com/eng/main/index.jsp" class="daewon">Daewon</a>
				</li>
				<li>
					<a href="http://www.ckdpharm.com/en/home" class="chong_kun_dang">Chong Kun Dang</a>
				</li>
				<li>
					<a href="https://www.boehringer-ingelheim.com" class="bily">bily</a>
				</li>
                <li>
					<a href="https://www.viatris.com/en" class="viatris">viatris</a>
				</li>
				<li>
					<a href="https://www.astrazeneca.com/" class="astra_zeneca">astra_zeneca</a>
				</li>
                <li>
					<a href="https://www.otsuka.co.jp/en/" class="otsuka">otsuka</a>
				</li>
                <li>
					<a href="https://www.novonordisk.com/" class="novo_nordisk">novo nordisk</a>
				</li>
				<li>
					<a href="https://www.bayer.com/en/" class="bayer">Bayer</a>
				</li>
                <li>
                    <a href="http://www.dalimpharm.co.kr/en_index.html" class="dalimbiotech">dalimbiotech</a>
                </li>
				<li class="small">
					<a href="https://www.sanofi.com/en/our-company" class="sanofi">sanofi</a>
				</li>
				<li>
					<a href="https://www.organon.com/" class="organon">ORGANON</a>
				</li>
				<li class="small">
					<a href="https://www.handok.co.kr" class="handok">handok</a>
				</li>
				<li>
					<a href="http://www.gcbiopharma.com/kor/index.do" class="gc_biopharma">gc</a>
				</li>
				<li>
					<a href="https://www.dksh.com/kr-ko/home" class="dksh">dksh</a>
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
                            <img src="/main/img/icons/2024_kscp_white.svg" alt="">
                        </a>
                        <a href="https://imcvp.org/" target="_blank">
                            <img src="/main/img/icons/2024_imcvp_footer_logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="footer_c">
                    <p class="footer_pink_t">Korean Society of Cardiovascular Disease Prevention</p>
                    <ul>
                        <li>805, 99, Seongsuil-ro, Seongdong-gu, Seoul 04790, Republic of Korea</li>
                        <li>(Seongsu-dong 1-ga, Seoul Forest AK Valley Knowledge Industry Center)</li>
                        <li>+82-2-6408-1505&nbsp;&nbsp;|&nbsp;&nbsp;<a class="font14" href="mailto:kscpmd@kscpmd.or.kr">kscpmd@kscpmd.or.kr</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="https://koreascp.or.kr:459/index.htm" target="_blank" class="font14" >www.koreascp.or.kr</a></li>
                    </ul>
                    <p class="footer_blue_t">Secretariat of IMCVP 2024</p>
                    <ul>
                        <li>4F, A-Block, Richensia, 341, Baekbeom-ro, Yongsan-gu,</li>
                        <li>Seoul 04315, Republic of Korea</li>
                        <li>+82-2-2285-2578&nbsp;&nbsp;|&nbsp;&nbsp;<a class="font14"  href="mailto:info@imcvp.org">info@imcvp.org</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="font14"  href="https://imcvp.org/">www.imcvp.org</a></li>
                    </ul>
                </div>
                <div class="footer_r">
                    <!-- <p class="footer_blue_t">Secretariat of IMCVP 2024</p>
                    <ul>
                        <li>2F, Wonhyo-ro, #204, Yongsan-gu, Seoul, Korea</li>
                        <li>T. 82-2-2039-7804</li>
                        <li>F. 82-2-3275-3044</li>
                        <li>E. <a href="mailto:info@imcvp.org" class="font_inherit link">info@imcvp.org</a></li>
                        <li>W. <a href="http://into-on.com/" class="font_inherit link">into-on.com</a></li>
                    </ul> -->
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

window.onload = ()=>{
    changeIcon();
    function changeIcon(){
        const icons = [
        { element: document.querySelector(".program_icon"), hoverSrc: "/main/img/icons/2024_tool_program-1.svg", defaultSrc: "/main/img/icons/2024_tool_program.svg" },
        { element: document.querySelector(".regi_icon"), hoverSrc: "/main/img/icons/2024_footer_registration-1.svg", defaultSrc: "/main/img/icons/2024_footer_registration.svg" },
        { element: document.querySelector(".abstract_icon"), hoverSrc: "/main/img/icons/2024_footer_abstract-1.svg", defaultSrc: "/main/img/icons/2024_footer_abstract.svg" },
        { element: document.querySelector(".mypage_icon"), hoverSrc: "/main/img/icons/2024_tool_mypage-1.svg", defaultSrc: "/main/img/icons/2024_tool_mypage.svg" }
    ];

    icons.forEach(icon => {
        icon.element.addEventListener("mouseenter", () => {
            icon.element.src = icon.hoverSrc;
        });

        icon.element.addEventListener("mouseleave", () => {
            icon.element.src = icon.defaultSrc;
        });
    });
    }
}


</script>