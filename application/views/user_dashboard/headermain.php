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
		<div class="navbar navbar-fixed-top bg-light">
	  		<div class="navbar-inner">
	   			<div class="container">
	   				<ul class="nav">
	   					<?php $logged_in_userinfo = ($this->session->userdata("info") == TRUE) ? 
						$this->session->userdata("info"):"" ;?>
	  					<li class="active"><a class="brand" href="#">User Dashboard</a></li>
	  					<li><a href="<?= base_url()?>usersdashboard/dashboard">Dashboard</a></li>
	  					<li><a href="<?= base_url()?>usersdashboard/updateinfo/<?= $logged_in_userinfo['id'] ?>">Profile</a></li>
					</ul>
					<section class="nav pull-right" id="social">
						<a href="<?= base_url()?>usersdashboard/logoff" class="Logoff">Logoff</a>
					</section>
	   			</div>
	   		</div>	
	  	</div>
	</body>
</html>