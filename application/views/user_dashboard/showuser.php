<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="user.css">
	</head>
	<body>
		<div class="container-main">
			<div class="header">
				<h1 class="name"><?= $fname." ".$lname ?></h1>
				<p>Registered at : <?= $created_at ?></p>
				<p>User id : <?= $id ?></p>
				<p>Email Address : <?= $email ?></p>
				<p>Description : <?= $description ?></p>
			</div>
			<div class="post-msg">
				<p class="label-postmsg">Leave a message for <?= $fname ?></p>
				<form method="post" action="<?= base_url()?>send_msg"> 
					<input type="hidden" name="receiver_id" value="<?= $id ?>">
					<textarea class="message-bx" name="message_user"></textarea>
					<input type="submit" value="Post a message" class="msg-btn">
				</form>
			</div>
	<?php
	if ($this->session->userdata("messages") == TRUE) {
		$arr = $this->session->userdata("messages"); 
		foreach ($arr as $key => $value) { ?>
		 	<div class="main-content">
				<p class="author-date-msg"><?= $value['fname']." ".$value['lname'] ?> wrote <span class="message_at"><?= timespan(strtotime($value['created_at']),time())." ago" ?></p>
				<form method="get" action="process_message.php" class="del">
					<a href=""></a>
				</form>
				<p class="message-text"><?= $value['message'] ?></p>	
				<?php
					$query =  $this->db->query("SELECT users.fname, users.lname, comments.user_id,
								comments.id, comments.comment, comments.created_at FROM comments
								INNER JOIN messages on comments.message_id = messages.id
								INNER JOIN users on users.id = comments.user_id
								WHERE comments.message_id = ? ",$value['id'])->result_array();
					foreach ($query as $key => $comment_value) { ?>
						<p class="author-date-comment"><?= $comment_value['fname']." ".$comment_value['lname'] ?>
						<span class="comment_at"><?= timespan(strtotime($comment_value['created_at']),time())." ago" ?></span>
						</p>
						<p class="comment-text"><?= $comment_value['comment'] ?></p>
						
			<?php	}

				?>
						<form method="post" action="<?= base_url()?>send_comment" class="comment-form">
							<input type="hidden" name="user_id" value="<?= $id ?>">
							<input type="hidden" value="<?= $value['id'] ?>" name="msg_id"> 
							<textarea class="comment-bx" name="comment_user" placeholder="Write a message"></textarea>
							<input type="submit" value="Post a comment" class="comment-btn">
						</form>
			
			</div>
	<?php } 
	}?>
		</div>
	</body>
</html>