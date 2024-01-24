<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>

<section class="container">
	<div class="sub_banner">
		<h1>Attractions in Seoul</h1>
	</div>
	<div class="inner">
		<ul class="tab_green">
			<li><a href="./attraction_historic.php">Historic</a></li>
			<li class="on"><a href="./attraction_shopping.php">Shopping</a></li>
			<li><a href="./attraction_walking.php">Place to Walk Around</a></li>
		</ul>
		<div class="section section1">
			<ul class="attraction_list">
				<li>
					<h3 class="title"><?=$locale("shopping_tit1")?></h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap"><img src="./img/shopping_1.jpg" alt="IFC Mall"></div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p><?=$locale("on_foot")?></p>
										<p><?=$locale("shopping_move1")?></p>
									</li>
									<li class="clearfix">
										<p><?=$locale("subway")?></p>
										<p><?=$locale("shopping_subway1")?></p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="http://www.ifcmallseoul.com/eng/main.do" target="_blank" class="underline">http://www.ifcmallseoul.com/eng/main.do</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details"><p><?=$locale("shopping_txt1")?></p></div>
					</div>
				</li>

				<li>
					<h3 class="title"><?=$locale("shopping_tit2")?></h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap"><img src="./img/shopping_2.jpg" alt="The Hyundai Seoul"></div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p><?=$locale("on_foot")?></p>
										<p><?=$locale("shopping_move2")?></p>
									</li>
									<li class="clearfix">
										<p><?=$locale("subway")?></p>
										<p><?=$locale("shopping_subway2")?></p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="https://www.thehyundaiseoul.com/" target="_blank" class="underline"> https://www.thehyundaiseoul.com/</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details"><p><?=$locale("shopping_txt2")?></p></div>
					</div>
				</li>
                
				<li>
					<h3 class="title">Lotte World Mall</h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap"><img src="" alt="Lotte World Mall"></div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p>Taxi</p>
										<p>60 Mins (20km)</p>
									</li>
									<li class="clearfix">
										<p>Subway</p>
										<p>60 Mins Jamsil Station (Line 2,8)</p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="https://www.lwt.co.kr/en/main/main.do" target="_blank" class="underline">https://www.lwt.co.kr/en/main/main.do</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details">
							<p>Lotte World Mall aims to be the best in the world in all aspects, including size and facilities, stores and brands,stories and designs, and actualizing premium life.It is a place for smart shoppers and leisurely shoppers who enjoy entertainment and experience, to be the place for leading trends and cultural trends.</p>
						</div>
					</div>
				</li>
				<!--
				<li>
					<h3 class="title">Times Square</h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap"><img src="" alt="Times Square"></div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p>Taxi</p>
										<p>15 Mins (2.8km)</p>
									</li>
									<li class="clearfix">
										<p>Subway</p>
										<p>27 Mins Yeongdeungpo Market Station (Line 5)</p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="https://www.thehyundaiseoul.com/" target="_blank" class="underline">https://www.thehyundaiseoul.com/</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details">
							<p>Times Square, which has about 300,000 square meters of shopping and cultural space alone is an advanced country lifestyle center that combines urban and sophisticated spaces such as department stores, multiplexes, shopping malls, and restaurants with relaxed and friendly natural spaces such as rest squares, terraces, fountains and gardens.
							it presents a new concept of Korea's landmark that is comparable to world-famous shopping malls, with a leading trend and lifestyle.
							</p>
						</div>
					</div>
				</li>

				<li>
					<h3 class="title">Starfield Coex Mall</h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap"><img src="" alt="Starfield Coex Mall"></div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p>Taxi</p>
										<p>50 Mins (17.1 km)</p>
									</li>
									<li class="clearfix">
										<p>Subway</p>
										<p>35 Mins Bongeunsa Station (Line 9)</p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="https://www.starfield.co.kr/coexmall/main.do" target="_blank" class="underline">https://www.starfield.co.kr/coexmall/main.do</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details">
							<p>The charm of the city that leads trends and cultural movements. Starfield Coexmall tells a new life in the center of Seoul. From contemporary fashion, gourmet, culture and entertainment Everything of city life with urban sensibility. There is a happiness you want to enjoy.
							Enjoy shopping with 320 brands and benefits from Starfield Starfield. From hip-hop street fashion & cult brands to large SPA brands such as Zara, Uniqlo, H&M, and Oisho, you can read trends just by looking around beauty brands that catch the eye of beautyholic. 
							</p>
						</div>
					</div>
				</li>
				-->
			</ul>
		</div>
	</div>
</section>



<?php include_once('./include/footer.php');?>