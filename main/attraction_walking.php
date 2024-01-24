<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>

<style>
	.attraction_list .clearfix2 li p + p:not(:nth-child(2)){display:block; width:calc(100% - 70px); padding-left:70px;}
</style>

<section class="container submit_application">
	<div class="sub_banner">
		<h1>Attractions in Seoul</h1>
	</div>
	<div class="inner">
		<ul class="tab_green">
			<li><a href="./attraction_historic.php">Historic</a></li>
			<li><a href="./attraction_shopping.php">Shopping</a></li>
			<li class="on"><a href="./attraction_walking.php">Place to Walk Around</a></li>
		</ul>
		<!-- content -->
		<div class="section section1">
			<ul class="attraction_list">
				<li>
					<h3 class="title"><?=$locale("walk_tit1")?></h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap">
								<img src="./img/place_1.jpg" alt="Yeouido Han river Park">
							</div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p><?=$locale("on_foot")?></p>
										<p><?=$locale("walk_move1")?></p>
									</li>
									<li class="clearfix">
										<p><?=$locale("subway")?></p>
										<p><?=$locale("walk_subway1")?></p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="https://hangang.seoul.go.kr/archives/46758" target="_blank" class="underline">https://hangang.seoul.go.kr/archives/46758</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details">
							<p><?=$locale("walk_txt1")?></p>
						</div>
					</div>
				</li>

				<li>
					<h3 class="title"><?=$locale("walk_tit2")?></h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap">
								<img src="./img/place_2.jpg" alt="Seonyudo Park">
							</div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p><?=$locale("taxi")?></p>
										<p><?=$locale("walk_move2")?></p>
									</li>
									<li class="clearfix">
										<p><?=$locale("subway")?></p>
										<p><?=$locale("walk_subway2")?></p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="http://parks.seoul.go.kr/template/sub/seonyudo.do" target="_blank" class="underline">http://parks.seoul.go.kr/template/sub/seonyudo.do</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details">
							<p><?=$locale("walk_txt2")?></p>
						</div>
					</div>
				</li>

				<li>
					<h3 class="title"><?=$locale("walk_tit3")?></h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap">
								<img src="./img/place_3.jpg" alt="Bukchon Hanok Village">
							</div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p><?=$locale("taxi")?></p>
										<p><?=$locale("walk_move3")?></p>
									</li>
									<li class="clearfix">
										<p><?=$locale("subway")?></p>
										<p><?=$locale("walk_subway3")?></p>
									</li>
									<li class="clearfix">
										<p>URL</p>
										<p><a href="https://hanok.seoul.go.kr/front/eng/town/town01.do" target="_blank" class="underline">https://hanok.seoul.go.kr/front/eng/town/town01.do</a></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details">
							<p><?=$locale("walk_txt3")?></p>
						</div>
					</div>
				</li>

				<li>
					<h3 class="title"><?=$locale("walk_tit4")?></h3>
					<div class="details_info_wrap">
						<div class="clearfix2">
							<div class="img_wrap">
								<img src="./img/place_4.jpg" alt="Cheonggyecheon Stream">
							</div>
							<div class="info">
								<ul>
									<li class="clearfix">
										<p><?=$locale("taxi")?></p>
										<p><?=$locale("walk_move4")?></p>
									</li>
									<li class="clearfix">
										<p>Subway</p>
										<p><?=$locale("walk_subway4")?></p>
									</li>
								</ul>
							</div>
						</div>
						<div class="details">
							<p><?=$locale("walk_txt4")?></p>
						</div>
					</div>
				</li>
			</ul>
		
		</div>
	</div>
</section>

<?php include_once('./include/footer.php');?>