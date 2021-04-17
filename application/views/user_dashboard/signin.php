<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url()?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url()?>css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script type="text/javascript" src="<? asset_url()?>js/bootstrap.js"></script>
	</head>
	<body>
		<div class="main-div">
			<?php
				if ($this->session->userdata("info") == TRUE) {
					redirect("usersdashboard/dashboard");
				}
			?>
			<div class="login-content">
				<p><?php echo($this->session->flashdata("msg") == TRUE) ? $this->session->flashdata("msg") : "";?></p>
				<h2 class="login-h2">Login</h2>
				<form method="post" action="<?=base_url()?>login" class="lognin-form">
					<input type="hidden" name="action" value="login">
					<section class="email-log-sec">
						<label>Email Address:</label>
						<input type="text" name="email" class="email" placeholder="Email Address">
					</section>
					<section class="pass-log-sec">
						<label>Password:</label>
						<input type="password" name="password" class="password" placeholder="Password">
					</section>
					<input type="submit" value="Signin" class="login-btn">
				</form>
				 <label class="label-signup">Don't have an account?</label><a href="<?= base_url()?>usersdashboard/signup" class="signup-link">Signup</a>
			</div>
		</div>
	</body>
</html>