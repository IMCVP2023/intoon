<?php include_once('./include/head.php'); ?>
<?php include_once('./include/header.php'); ?>
<section class="container login_form form_layout find_password login bg style_2023 find_pw">
	<!-- <a href="./index.php" class="logo"><img src="./img/logo.png"></a> -->
	<h1 class="login_title">Find Password</h1>
		<div class="find_pw_txt_box">
			<h3>Forgotten your password?</h3>
			<p>If you do not remember your password, please enter your ID(Email).</p>
			<p>Temporary password will be sent out to your e-mail.</p>
			<p>After you login with the temporary password,</p>
			<p>you may change to a new password at personal information.</p>
		</div>
	
	<div>
		<form name="find_password_form" onsubmit="return false;" class="find_password_form">
			<ul>
				<li>
					<input type="text" name="email" class="find_email" placeholder="ID (email)">
				</li>
			</ul>
			<button type="button" class="btn submit_btn gray_line_btn">Find Password</button>
			<!-- <button type="button" class="btn login_btn main_btn" onclick="javascript:window.location.href='./login.php';"><?= $locale("login") ?></button> -->
			<p>If you don’t remember your e-mail address, please contact the Secretariat.</p>
			<p>E-mail : <a href="mailto:info@imcvp.org">info@imcvp.org</a></p>
		</form>
	</div>
</section>

<div class="loading">
	<img src="./img/icons/loading.gif" />
</div>

<script>
	var alreadyProcess = false; // 더블 클릭 방지

	$(document).ready(function() {
		$("input[name=email]").focus()

		// 비밀번호 찾기 Enter
		$("input[name=email]").on("keyup", function(key) {
			if (key.keyCode == 13) {
				$(".submit_btn").trigger("click");
			}
		});

		// 비밀번호 찾기 버튼
		$(".submit_btn").on("click", function() {
			var email = $("input[name=email]").val();

			if (email == "" || email == "undefined" || email == null) {
				alert(locale(language.value)("check_email"));
				return false;
			}

			if (alreadyProcess) {
				return false;
			}

			alreadyProcess = true;

			$(".loading").show();
			$("body").css("overflow-y", "hidden");

			$.ajax({
				//url: PATH + "ajax/client/ajax_gmail.php",
				url: PATH + "ajax/client/ajax_gmail.php",
				type: "POST",
				data: {
					flag: "find_password",
					email: email
				},
				dataType: "JSON",
				success: function(res) {

					//console.log(res);
					if (res.code == 200) {
						alert(locale(language.value)("send_mail_success"));
					} else if (res.code == 401) {
						alert(locale(language.value)("not_exist_email"));
						return false;
					} else if (res.code == 400) {
						alert(locale(language.value)("error_find_password"));
						return false;
					} else {
						alert(locale(language.value)("reject_msg"));
						return false;
					}
				},
				complete: function() {
					$(".loading").hide();
					$("body").css("overflow-y", "auto");

					alreadyProcess = false;
				}
			});

		});

	});
</script>

<?php include_once('./include/footer.php'); ?>