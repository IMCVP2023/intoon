<div class="footer_wrap">
    <!-- 220323 HUBDNC LJH 추가 -->
    <div class="fixed_btn_clone"></div>
    <div class="fixed_btn_wrap">
        <ul class="toolbar_wrap">
            <li>
                <a href="/main/program_glance.php">
                    <img src="/main/img/icons/tool_program.svg" alt="">
                </a>
            </li>
            <?php
            if ($_SESSION["USER"]["regi_status"] == 2 || $_SESSION["USER"]["regi_status"] == 5) {
            ?>
            <!--[230824] 다운로드 버튼 추가 / 파일 전달X-->
            <li>
                <a href="http://184a8b4a1a076d93.kinxzone.com/Abstractbook.pdf" target="_blank" class="type2 pink">
                    <i><img src="/main/img/icons/icon_download_abstract.svg" alt=""></i>
                    Abstract Book <br />Download
                </a>
            </li>
            <li>
                <a href="http://184a8b4a1a076d93.kinxzone.com/Programbook.pdf" target="_blank" class="type2 violet">
                    <i><img src="/main/img/icons/icon_download_program.svg" alt=""></i>
                    Program Book <br />Download
                </a>
            </li>
            <?php
            } else {
            ?>
            <li>
                <button type="button" class="online_registration_alert">
                    <i><img src="/main/img/icons/tool_regist.svg" alt=""></i>Registration
                </button>
            </li>
            <li>
                <button type="button" class="online_submission_alert">
                    <i><img src="/main/img/icons/tool_abstract.svg" alt=""></i>Abstract
                </button>
            </li>
            <?php
            }
            ?>
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
            <li><a href="https://www.alvogen.com/" class="alvogen">Alvogen</a></li>
            <li><a href="https://www.novonordisk.com/" class="novo_nordisk">novo nordisk</a></li>
            <li><a href="https://www.handok.co.kr/eng/" class="handok">HANDOK</a></li>
            <li><a href="http://eng.yuhan.co.kr/Main/" class="yuhan">YUHAN</a></li>
            <li><a href="http://en.donga-st.com/Main.da" class="dong_a">Dong-A ST</a></li>
            <li><a href="https://www.msd.com/" class="msd">MSD</a></li>
            <li><a href="https://www.inno-n.com/eng" class="inno_n">inno N</a></li>
            <li><a href="https://www.hanmipharm.com/ehanmi/handler/Home-Start" class="hanmi_pharm">Hanmi Pharm</a></li>
            <li><a href="http://www.ckdpharm.com/en/home" class="chong_kun_dang">Chong Kun Dang</a></li>
            <li><a href="https://m.daewoong.co.kr/en/main/index" class="daewoong">DAEWOONG</a></li>
            <li><a href="https://www.astrazeneca.com/" class="astra_zeneca">Astra Zeneca</a></li>
            <li><a href="https://www.lgchem.com/main/index" class="lg_chem">LG Chem</a></li>
            <li><a href="https://www.celltrionph.com/en-us/home/index" class="celltrion">CELLTRION</a></li>
            <li><a href="https://www.gccorp.com/eng/index" class="gc_biopharma">GC Niopharma</a></li>
            <li><a href="https://www.sanofi.com/en/our-company" class="sanofi">sanofi</a></li>
            <li><a href="http://ajupharm.co.kr/en/index.html" class="aju_pharm">AJU PHARM</a></li>
            <li><a href="http://eng.ekdp.com/main/main.asp" class="kwangdong">Kwangdong</a></li>
            <li><a href="https://www.daiichisankyo.com/" class="daiichi_sankyo">Daiichi Sankyo</a></li>
            <li><a href="https://www.organon.com/" class="organon">ORGANON</a></li>
            <li><a href="https://www.boehringer-ingelheim.com/" class="boehringer">Boehringer INgelheim</a></li>
            <li><a href="https://www.boryung.co.kr/en/" class="boryung">BORYUNG</a></li>
            <li><a href="http://www.dalimpharm.co.kr/en_index.html" class="dalimbiotech">dalimbiotech</a></li>
            <li><a href="https://www.jw-pharma.co.kr/pharma/en/main.jsp" class="jw_pharm">jw Pharmaceutical</a></li>
            <li class="small"><a href="https://www.lilly.co.kr/" class="lilly">Lilly</a></li>
            <li class="small"><a href="https://www.daewonpharm.com/eng/main/index.jsp" class="daewon">Daewon</a></li>
        </ul>
    </div>
    <footer class="footer">
        <div class="container">
            <br>
            <!--<h5>Supported by</h5>-->
            <div class="f_bottom clearfix">
                <div class="footer_l">
                    <div class="clearfix">
                        <img src="/main/img/icons/fl01.png" alt="">
                        <img src="/main/img/icons/fl02.png" alt="">
                        <a href="https://www.visitseoul.net/index"><img style="margin-top: 35px;"
                                src="/main/img/icons/fl03.png" alt=""></a>
                        <img src="/main/img/icons/fl04.png" alt="">
                    </div>
                </div>
                <div class="footer_c">
                    <!-- <p>Organized by</p> -->
                    <p>Korean Society for the Study of Obesity(KSSO)</p>
                    <ul>
                        <li>Room 1010, Renaissance tower, 14 Mallijae-ro, Mapo-gu, Seoul, Korea</li>
                        <li>T. 82-2-364-0886,0887</li>
                        <li>F. 82-2-364-0883</li>
                        <li>E. <a href="mailto:webmaster@kosso.or.kr"
                                class="font_inherit link">webmaster@kosso.or.kr</a></li>
                        <li>W. <a href="https://www.kosso.or.kr" class="font_inherit link">https://www.kosso.or.kr</a>
                        </li>
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
					-->
                </div>
                <div class="footer_r">
                    <!-- <p>Conference Secretariat</p> -->
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
					-->
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="popup term3">
    <div class="pop_bg"></div>
    <div class="pop_contents">
        <button type="button" class="pop_close"><img src="/main/img/icons/pop_close.png"></button>
        <h3 class="pop_title">Terms</h3>
        <?= $locale("terms") ?>
    </div>
</div>


<div class="popup term4">
    <div class="pop_bg"></div>
    <div class="pop_contents">
        <button type="button" class="pop_close"><img src="/main/img/icons/pop_close.png"></button>
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

    <
    !--$('.type2').on('click', function(event) {
        event.preventDefault();
        alert('Updates are planned.');
        return false;
    }) -- >
</script>