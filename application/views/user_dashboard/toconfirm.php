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
		<div class="container">
			<h2 class="title-toconfirm">Are you sure you want to delete the following user?</h2>
			<section class="name-section">
				<label class="name-lbl">Name: </label><p class="name"><?= $fname." ".$lname ?></p>
			</section>
			<section class="desc-section">
				<label class="desc-lbl">Description:</label><p class="desc"><?= $description ?></p>
			</section>
			<form>
			<a href="<?= base_url() ?>usersdashboard/dashboard" class="no">No</a>
			<a href= "<?= base_url() ?>usersdashboard/remove/<?= $id ?>" class="yes">Yes i want to delete this</a>
			</form>
		</div>
	</body>
</html>