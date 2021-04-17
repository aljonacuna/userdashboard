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
			<div class="createuser-content">
				<p class="error"><?php echo($this->session->flashdata("msg") == TRUE) ? $this->session->flashdata("msg") : ""; ?></p>
				<h2 class="createuser-h2">Add a new user</h2>
				<a href="<?= base_url()?>usersdashboard/dashboard" class="back-link">Return to dashboard</a>
				<form method="post" action="<?= base_url()?>new" class="reg-form">
					<input type="hidden" name="action" value="register">
					<label>First name:</label>
					<input type="text" name="fname" class="fname" placeholder="First name">
					<label>Last name:</label>
					<input type="text" name="lname" class="lname" placeholder="Last name">
					
					<label>Email Address:</label>
					<input type="text" name="email" class="email" placeholder="Email Address">
					
					<label>Password:</label>
					<input type="password" name="password" class="password" placeholder="Password">
					
					<label>Confirm Password:</label>
					<input type="password" name="cpassword" class="cpassword" placeholder="Confirm Password">
					
					<input type="submit" value="Signup" class="reg-btn">
				</form>
				
			</div>
		</div>
	</body>
</html>