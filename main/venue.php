<?php
include_once('./include/head.php');

$session_user = $_SESSION['USER'] ?? NULL;
$session_app_type = (!empty($_SESSION['APP']) ? 'Y' : 'N');

//230714 HUBDNC 앱 로그인 시 파라미터 추가 된 부분
if(!empty($session_user) && $session_app_type == 'Y') {
    include_once('./include/app_header.php');
} else {
    include_once('./include/header.php');
}

$language = isset($_SESSION["language"]) ? $_SESSION["language"] : "en";
$locale = locale($language);

$_page_config = array(
    "m1" => [
        "welcome",
        "organizing_committee",
        "overview",
        "venue",
        "photo"
    ],
    "m2" => [
        "program_glance",
        "program_detail",
        "invited_speaker"
    ],
    "m3" => [
        "poster_abstract_submission",
        "abstract_submission",
        "abstract_submission2",
        "abstract_submission3",
        "eposter",
        "lecture_note_submission",
        "lecture_submission",
        "lecture_submission2",
        "lecture_submission3",
        "oral_presenters",
        "eposter_presenters"
    ],
    "m4" => [
        "registration_guidelines",
        "registration",
        "registration2",
        "registration3"
    ],
    "m5" => [
        "sponsor_information",
        "application",
        "application_complete"
    ],
    "m6" => [
        "accommodation",
        "attraction_historic",
        "useful_information"
    ]
);

$_page = str_replace(".php", "", end(explode("/", $_SERVER["REQUEST_URI"])));

//초록 마감 기간
$sql_during =    "SELECT
						IF(DATE(NOW()) BETWEEN period_poster_start AND period_poster_end, 'Y', 'N') AS yn
					FROM info_event";
$during_yn = sql_fetch($sql_during)['yn'];

//오늘 날짜 구하기 d_day 구하기
$today = date("Y. m. d");
$d_day = new DateTime("2023-09-07");

$current_date = new DateTime();
$current_date->format('Y-m-d');

$intvl = $current_date->diff($d_day);
$d_days = $intvl->days + 1;

$sql_info =    "SELECT
					CONCAT(fi_img.path, '/', fi_img.save_name) AS fi_img_url,
					igv.name_" . $language . " AS `name`,
					igv.address_" . $language . " AS address,
					igv.tel_" . $language . " AS tel,
					igv.homepage_en,
					igv.homepage_ko
				FROM info_general_venue AS igv
				LEFT JOIN `file` AS fi_img
					ON fi_img.idx = igv." . $language . "_img";
$info = sql_fetch($sql_info);

	$add_section_class = (!empty($session_user) && $session_app_type == 'Y') ? 'app_version' : '';
?>

<section class="container venue <?= $add_section_class; ?>">
	<!-- HUBDNCLHJ : app 메뉴 탭 -->
<?php
	if(!empty($session_user) && $session_app_type == 'Y') {
?>
    <div class="app_title_box">
        <h2 class="app_title">ICOMES 2023<button type="button" class="app_title_prev" onclick="javascript:window.location.href='./app_index.php';"><img src="/main/img/icons/icon_arrow_prev_wh.svg" alt="이전페이지로 이동"></button></h2>
        <ul class="app_menu_tab">
            <li><a href="./welcome.php">Welcome Message</a></li>
            <li><a href="./organizing_committee.php">Organization</a></li>
            <li><a href="./app_overview.php">Overview</a></li>
            <li class="on"><a href="./venue.php">Venue</a></li>
        </ul>
    </div>    
    <h1 class="page_title">Venue</h1> 
<?php
	} 
?>
	<!-- HUBDNCLHJ : app에선 타이틀 Conrad Seoul>Venue로 변경 됨(위 h1.page_title{Venue} 주석해제 후 아래 h1.page_title{Conrad Seoul} 주석처리). 메뉴 위치 이동 됨. 노출되는 컨텐츠 [호텔 이름과 주소, 연락처]+[지도]. -->
<?php
	if (!empty($session_app_type) && $session_app_type == 'N') {
		// Web일때
?>
    <h1 class="page_title">Venue
			<div class="sub_btn_box">
				<a href="/main/venue.php" class="on">Grand Walkerhil Seoul</a>
				<a href="/main/accommodation.php">Accommodation</a>
				<a href="/main/comingsoon.php">Floor Plan</a>

                <!-- <a href="/main/accommodation.php">Accommodation</a>
				<a href="/main/floor_plan.php">Floor Plan</a> -->
			</div>
		</h1>
<?php
	} 
?>
    <div class="inner">
        <!-- 호텔 이름과 주소, 연락처 -->
        <div class="section section1">
        <div class="useful_list">

        <li>
                <div>
                    <div class="imgs"></div>
                    <div class="btn_wrap">
                    
                         <!-- <button class="btn green_btn"
                        onClick="javascript:window.open('https://www.hilton.com/en/hotels/selcici-conrad-seoul/')">Go to Website</button>
                    <a href="./download/ICOMES_2023_Conrad_Seoul_Reservation_Form.doc" class="btn green_btn download_btn" target="_blank" download=""><img src="./img/icons/icon_download_white.svg" alt="">Reservation Form Download</a> -->
                    <!-- onClick="javascript:alert('Reservation is closed.');" -->
                    </div>
                </div>
                <div>
                    <p class="bold">Grand Walkerhill Seoul, Korea<span class="font_16 bold">(Congress Venue)</span></p>
                    <div class="table_wrap x_scroll">
                        <table class="c_table2 detail_table layout_fixed type2">
                            <colgroup>
                                <col class="col_th">
                                <col width="*">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>Address</th>
                                    <td>177 Walkerhill-ro, Gwangjin-gu, Seoul, Republic of Korea</td>
                                </tr>
                                <tr>
                                    <th>Tel</th>
                                    <td>+82-2-1670-5000</td>
                                </tr>
                                <tr>
                                    <th>Fax</th>
                                    <td>+82-2-452-6867</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <a href="mailto:contact@walkerhill.com" target="_blank"
                                            class="underline link">contact@walkerhill.com </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>
                                        <a href="https://www.walkerhill.com/grandwalkerhillseoul/en/" target="_blank"
                                            class="venue_btn text_center">Go to Website ></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text_l">
                                    Located in east Seoul, Grand Walkerhill Seoul stands as a beacon of luxury amidst the city's bustling landscape.<br/>Nestled amidst the serene beauty of Achasan Mountain and the tranquil Hangang River, it offers a haven of comfort and relaxation.<br/>Boasting 557 elegantly appointed guestrooms, diverse dining options, and 11 versatile convention spaces, including a grand banquet hall capable of hosting up to 1,000 guests, it caters to the discerning needs of both leisure and business travelers.<br/>With its strategic location, just 1.5 hours from Incheon International Airport, 1 hour from Gimpo International Airport, 40 minutes from Seoul Station, and 35 minutes from Suseo Station, Grand Walkerhill Seoul seamlessly combines convenience with sophistication, ensuring an unforgettable experience for every guest.

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </li>
        </div>
        </div>
		<!-- 지도 -->
		<div class="section section2">
			<h3 class="title">Location</h3>
			<div class="map_area" id="map"></div>
		</div>
<?php
    if(empty($session_user) && $session_app_type == 'N') {
?>
        <!-- 교통편 START / 웹 뷰 --> 
        <div class="section section3"> 
            <ul class="contact_list"> 
                <li>  
                    <div class="details_info_wrap">  
                        <div class="clearfix2">
                            <div class="info"> 
                                <!-- <h3 class="title">Airport ▶ Grand Walkerhil Seoul Hotel, Korea</h3> -->
                                <!-- <div class="airplane_cont">
                                    <h5>By Bus <span>(No. 6019 / Airport Bus)</span></h5>
                                    <div class="table_wrap detail_table_common x_scroll">
                                        <table class="c_table">
                                            <tbody>
                                                <tr>
                                                    <th>Board</th>
                                                    <td>Terminal 1 : Arrival Gate 6B-1 (1F) / Terminal 2 : Arrival Gate 27 (B1)</td>
                                                </tr>
                                                <tr>
                                                    <th>Travel Time</th>
                                                    <td>
                                                        - Approx. 70mins (20mins from Terminal 2 to 1)
                                                        <br>
                                                        - Time : 6:45 am – 22:45 pm / Allocation : every 50 mins
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Fare</th>
                                                    <td>KRW 17,000
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Bus Stop</th>
                                                    <td>Marriott Hotel (Yeouido Station)</td>
                                                </tr>
                                                <tr>
                                                    <th>Remarks</th>
                                                    <td>
                                                        Advance ticket purchase is required before boarding the bus.<br>
                                                        - Location of airport ticket counter. Terminal 1 Gate 6~13 (1F) / Terminal 2 : Eastside B1<br>
                                                        - K-Limousine Website : <a href="http://www.klimousine.com/eng/main" target="_blank" class="link">www.klimousine.com</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  -->
                                <!-- <div class="airplane_cont">
                                    <h5>By Subway</h5> -->
                                    <!-- <p>
                                        The Airport Railroad Express (AREX) provides transportation services that connect Incheon International Airport and Gimpo Airport. Passengers arriving at Gimpo Airport have the option to transfer to Subway Line 9 for further transportation. You can take the AREX (Airport Railroad Express) at the Incheon Airport Transportation Center.
                                    </p>
                                    <div class="table_wrap detail_table_common x_scroll">
                                        <table class="c_table type1">
                                            <thead>
                                                <tr>
                                                    <th>Route</th>
                                                    <th>Traveling Time</th>
                                                    <th>Fare</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img class="venue_airplane" src="./img/venue_airplane1.svg" alt=""></td>
                                                    <td>Approx. T2: 78 min <br>Approx. T1: 70 min</td>
                                                    <td>T2: KRW 4,750 <br>T1: KRW 4,150</td>
                                                    <td>
                                                        Take Airport Railroad (AREX) from Incheon<br>airport Terminal 1
                                                        or 2(bound for Gongdeok<br>Station) then Transfer to subway Line
                                                        #5 at<br>Gongdeok Station (bound for Banghwa station)<br> → take
                                                        off at Yeouido Station
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="venue_airplane" src="./img/venue_airplane2.svg" alt=""></td>
                                                    <td>Approx. T2: 78 min <br>Approx. T1: 70 min</td>
                                                    <td>T2: KRW 4,550 <br>T1: KRW 4,050</td>
                                                    <td>
                                                        From Gimpo Airport (approximately 18 min):<br>Take the Subway
                                                        express line #9 at Gimpo<br>International Airport station Get
                                                        off at Yeouido<br>station which provides direct access to
                                                        Conrad<br>Seoul
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="venue_airplane" src="./img/venue_airplane3.svg" alt=""></td>
                                                    <td>19 min (6 line Express) <br>T1: 26 min(5 line)</td>
                                                    <td>KRW 1,350</td>
                                                    <td>Yeouido Stn. (exit #3) is 10 min <br>walking distance away from
                                                        Hotel</td>
                                                </tr>
                                            </tbody>
                                        </table> -->
                                    <!-- </div>
                                </div> 
                                <div class="airplane_cont">
                                    <h5>By Taxi</h5> -->
                                        <!-- <p>Taxi services are always available, and the fare from Incheon International Airport to the Venue (Conrad Seoul) is approximately KRW 55,000 for a standard taxi. The expressway fee (KRW 7,100 each way) will be added to the total fare. The rides take about 40-50 minutes. However, it may vary depending on traffic conditions. There is an additional fee for taxi rides taken between 22:00 pm and 4:00 am, resulting in an approximate 20%~ 40% increase in the fare.</p> 
                                    <div class="table_wrap detail_table_common x_scroll">
                                        <table class="c_table type2">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" >Type</th>
                                                    <th rowspan="2">Base Fare (KRW)</th>
                                                    <th colspan="2">Stop Location</th>
                                                    <th rowspan="2">Remarks</th>
                                                </tr>
												<tr>
													<th>Terminal 1</th>
													<th>Terminal 2</th>
												</tr>
                                            </thead>
                                            <tbody>
                                                <tr>
													<td>Standard Taxi</td>
													<td>4,800</td>
													<td>5C, 6C, 6D</td>
													<td>5C</td>
													<td>22:00 - 04:00<br/>Additional late-night charge of 20% ~ 40%</td>
												</tr>
												<tr>
													<td>First-Class / Oversized Taxi<br>(Up to 9 passengers)</td>
													<td>7,000</td>
													<td>7C/8C</td>
													<td>5D</td>
													<td>22:00 - 04:00<br/>Additional late-night charge of 20% ~ 40%</td>
												</tr>
												<tr>
													<td>International Taxi</td>
													<td>Standard Seoul's<br>distance fare applies</td>
													<td>4C</td>
													<td>1C</td>
													<td>
														Taxis are officially designated to provide foreign<br>
														language service<br>
														For reservation: <a href="http://www.intltaxi.co.kr" target="_blank" class="link">www.intltaxi.co.kr</a>
													</td>
												</tr>
                                            </tbody>
                                        </table> -->
                                    <!-- </div>   -->
									<!-- <div class="taxi_text_area">
										For more information on each mode of transportation and the related services, please visit the websites below.
										<div>
											-
											<a href="https://www.airport.kr/ap/en/index.do" target="_blank" class="link">Incheon International Airport(click!) </a>
											/
											<a href="https://www.airport.co.kr/gimpoeng/index.do" target="_blank" class="link">Gimpo International Airport(click!)</a>   
										</div>
									</div>  -->
                                </div>
                            </div>  
                        </div>  
                    </div>
                </li> 
            </ul>  
        </div>
<?php
	} 
?>
        <!-- 교통편 / end -->
    </div>
</section>

<script>

window.initMap = function () {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 37.555272, lng: 127.110912 },
    zoom: 15,
  });

  const tourStops = [
    [{ lat: 37.555272, lng: 127.110912 }, "Grand Walkerhill Seoul"]
  ];
  // Create an info window to share between markers.
  const infoWindow = new google.maps.InfoWindow();

  // Create the markers.
  tourStops.forEach(([position, title], i) => {
    const marker = new google.maps.Marker({
      position,
      map,
      title: `${title}`,
      label: ``,
      optimized: false,
    });

    // Add a click listener for each marker, and set up the info window.
    marker.addListener("click", () => {
      infoWindow.close();
      infoWindow.setContent(marker.getTitle());
      infoWindow.open(marker.getMap(), marker);
    });
  });


window.initMap = initMap;


  /*const malls = [
    { label: "C", name: "코엑스몰", lat: 37.5115557, lng: 127.0595261 },
    { label: "G", name: "고투몰", lat: 37.5062379, lng: 127.0050378 },
    { label: "D", name: "동대문시장", lat: 37.566596, lng: 127.007702 },
    { label: "I", name: "IFC몰", lat: 37.5251644, lng: 126.9255491 },
    { label: "L", name: "롯데월드타워몰", lat: 37.5125585, lng: 127.1025353 },
    { label: "M", name: "명동지하상가", lat: 37.563692, lng: 126.9822107 },
    { label: "T", name: "타임스퀘어", lat: 37.5173108, lng: 126.9033793 },
  ];
  malls.forEach(({ label, name, lat, lng }) => {
    const marker = new google.maps.Marker({
      position: { lat, lng },
      label,
      map,
    });
  });*/
};

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG07_wEQCuA6ATw57sOmlXHl49_hR1_mA&callback=initMap"
  ></script>

<!--
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=855afe12d2495e8a68f985bd09c52bc5"></script>
<script>
	var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
	var options = { //지도를 생성할 때 필요한 기본 옵션
		center: new kakao.maps.LatLng(37.525609, 126.925992), //지도의 중심좌표.
		level: 2 //지도의 레벨(확대, 축소 정도)
	};

	var map = new kakao.maps.Map(container, options);
</script>
-->

<?php 
    if (!empty($session_app_type) && $session_app_type == 'Y') {
        // mo일때
        include_once('./include/app_footer.php'); 
    }else {
        include_once('./include/footer.php');
    }
?>