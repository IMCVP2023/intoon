<?php
	include_once('./include/head.php');
?>

<style>
/* iOS 11.0 버전 */
constant(safe-area-inset-top)
constant(safe-area-inset-right)
constant(safe-area-inset-bottom)
constant(safe-area-inset-left)

/* iOS 11.2 이상 */
env(safe-area-inset-top)
env(safe-area-inset-right)
env(safe-area-inset-bottom)
env(safe-area-inset-left)

.app_loading {padding: 20px 0 calc(constant(safe-area-inset-bottom) + 50px); padding: 20px 0 calc(env(safe-area-inset-bottom) + 50px);}
</style>

<!-- HUBDNCLHJ : app loading 페이지 -->
<section class="container app_main app_loading app_version">
	<div class="app_main_inner">
		<div class="app_main_box">
			<div class="app_main_txt">
				<img src="./img/app_main_txt.svg" alt="">
				<p>Sep. 7(Thu) ~ Sep. 9(Sat)</p>
				<p>CONRAD Seoul Hotel, Korea</p>
			</div>
			<img src="./img/app_loading_logo.png" alt="" class="logo">
		</div>
	</div>
</section>