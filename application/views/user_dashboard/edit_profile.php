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
			<div class="edit-content">
				<h2>Edit User <?= $id ?></h2>
				<div class="edit-info">
					<p class="error"><?php echo($this->session->flashdata("msg") == TRUE) ? $this->session->flashdata("msg") : "";?></p>
					<form method="post" action="<?= base_url()?>update_profile" class="editinfo-form">
						
						<h4>Edit information</h4>
						<input type="hidden" name="id" value="<?= $id ?>">
						<label>Email address:</label>
						<input type="text" name="email" class="email" value="<?= $email ?>" placeholder="Email address">
						<label>First Name:</label>
						<input type="text" name="fname" class="fname" value="<?= $fname ?>" placeholder="First name">
						<label>Last Name:</label>
						<input type="text" name="lname" class="lname" value="<?= $lname ?>" placeholder="Last name">
						<input type="submit" value="Save" class="save-btn">
					</form>
					<form method="post" action="<?= base_url()?>changepass/1" class="edit-auth-profile">
						<h4>Change password</h4>
						<input type="hidden" name="id" value="<?= $id ?>">
						<label>Password:</label>
						<input type="password" name="password" class="password" placeholder="Password">
						<label>Confirm password:</label>
						<input type="password" name="cpassword" class="cpassword" placeholder="Confirm Password">
						<input type="submit" value="Update Password" class="update-btn">
					</form>
					<form method="post" action="<?= base_url()?>update_desc" class="add-desc">
						<h4>Edit Description</h4>
						<input type="hidden" name="id" value="<?= $id ?>">
						<textarea name="desc" class="desc"><?= $description ?></textarea>
						<input type="submit" value="Save" class="save-btn">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
