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
			<div class="dashboard-content">
				<h2 class="lbl-manage">Manage users</h2>
				<a href="<?= base_url()?>usersdashboard/createuser" class="add-link">Add new</a>
			<?php 
			if ($this->session->userdata("all_users") == TRUE) { 
				$logged_in_userinfo = ($this->session->userdata("info") == TRUE) ? 
						$this->session->userdata("info"):"" ;?>
				
				<table>	
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Create at</th>
						<th>User level</th>
						<th>Actions</th>
					</tr> 
		<?php	$array = $this->session->userdata("all_users");
				foreach ($array as $key => $value) { 
						$user_role = ($value['is_admin'] == 9) ? "admin" : "normal"; 
					?>
					<tr>
						<td><?=$value['id'] ?></td>
						<td><a href="<?= base_url()?>usersdashboard/showuser/<?= $value['id'] ?>"><?= $value['fname']." ".$value['lname'] ?></a></td>
						<td><?= $value['email'] ?></td>
						<td><?= $value['created_at'] ?></td>
						<td><?= $user_role ?></td>
						
						<td>
							<a href="<?=base_url()?>usersdashboard/edituser/<?= $value['id'] ?>" class="edit-link">Edit</a>
							<a href="<?=base_url()?>usersdashboard/toconfirm/<?= $value['id'] ?>" class="del-link">remove</a></td>
					</tr>
		<?php 	}
						
					?>
	<?php	} ?>
					
				</table>
			</div>
		</div>
	</body>
</html>
