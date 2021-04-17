<?php

	class UserDashboard extends CI_Model {
		
		//signup saving data process
		public function save_user($post) {
			/*check if the users table is empty, if it's empty 
			make the first created user an admin*/
			$is_admin = 0;
			if ($this->get_rows() == 0) {
				$is_admin = 9;
			}
			else {
				$is_admin = 1;
			}
			$this->load->library("form_validation");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			date_default_timezone_set("Asia/Manila");
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$date = date("Y-m-d H:i:s");
			$this->form_validation->set_rules("fname", "First name", "trim|required");
			$this->form_validation->set_rules("lname", "Last name", "trim|required");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
			$this->form_validation->set_rules("cpassword", "Confirm Password", "trim|required|matches[password]");
			if ($this->form_validation->run() === TRUE) {
				$fname = $post['fname'];
				$lname = $post['lname'];
				$email = $post['email'];
				$pass = $post['password'];
				$cpass = $post['cpassword'];
				//encrypt pass using md5 and salt
				$encrypt_pass = md5($pass.''.$salt);
				/*if user is valid to the following codes */
				if ($this->is_name_has_number($fname, $lname)) {
					/*check if there are user with the same email address if email already exist 
					do the else*/
					if ($this->isExist($email) == 0) {
					$query = "INSERT INTO users (email, password, salt, fname, lname, is_admin, description, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?,?)";
					$values = array($email, $encrypt_pass, $salt, $fname, $lname, $is_admin, "",
								$date = date("Y-m-d H:i:s"), $date = date("Y-m-d H:i:s"));
					return $this->db->query($query, $values);
					}
					else {
						$this->session->set_flashdata("msg","User already exist");
						return false;
					}

				}
			}
			else {
				$this->session->set_flashdata("msg",validation_errors());
			}
		}
		/*this block of codes was built for user authentication*/
		public function authenticate($post) {
			$this->load->library("form_validation");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() === TRUE) {
				$email = $post['email'];
				$pass = $post['password'];
				$result	= $this->db->query("SELECT * from users WHERE email = ?",array($email))->row_array();
				$encrypt_pass = md5($pass.''.$result['salt']);
				if ($encrypt_pass == $result['password']) {
					$user = array(
							"id"=>$result["id"],
							"email"=>$result["email"],
							"fname"=>$result["fname"],
							"lname"=>$result["lname"],
							"user_lvl"=>$result['is_admin'],
							"is_logged_in"=>true
					);
					$this->session->set_userdata("info",$user);
					return true;
				}
				else {
					$this->session->set_flashdata("msg","Incorrect email or password");
					return false;
				}
			}
			else {
				
				$this->session->set_flashdata("msg",validation_errors());
				return false;
			}
		}

		/* only the admin can access this block of codes to edit the specific user info */
		public function edit_user_info($post) {
			$this->load->library("form_validation");
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules("fname", "First name", "trim|required");
			$this->form_validation->set_rules("lname", "Last name", "trim|required");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
			if ($this->form_validation->run() === TRUE){
				$fname = $post['fname'];
				$lname = $post['lname'];
				$email = $post['email'];
				$user_lvl = $post["user_lvl"];
				$id = $post['id'];
				if ($this->is_name_has_number($fname, $lname)) {
					/*check if there are user with the same email address if email already exist 
					do the else*/
					$query = "UPDATE users SET fname = ?, lname = ?, email = ?, is_admin = ?
								  WHERE id = ?";
					$values = array($fname, $lname, $email, $user_lvl, $id);
					return $this->db->query($query, $values);
				}
				else {
					$this->session->set_flashdata("msg","Invalid name");
					return false;
				}
			}
			
			else {
				$this->session->set_flashdata("msg",validation_errors());
				return false;
				
			}
		}


		/* any registered user can access this block of codes to update thier profile data */
		public function edit_user_profile($post) {
			$this->load->library("form_validation");
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules("fname", "First name", "trim|required");
			$this->form_validation->set_rules("lname", "Last name", "trim|required");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
			if ($this->form_validation->run() === TRUE){
				$fname = $post['fname'];
				$lname = $post['lname'];
				$email = $post['email'];
				$id = $post['id'];
				if ($this->is_name_has_number($fname, $lname)) {
					/*check if there are user with the same email address if email already exist 
					do the else*/
					$query = "UPDATE users SET fname = ?, lname = ?, email = ?
								  WHERE id = ?";
					$values = array($fname, $lname, $email, $id);
					return $this->db->query($query, $values);
				}
				else {
					$this->session->set_flashdata("msg","Invalid name");
					return false;
				}
			}
			
			else {
				$this->session->set_flashdata("msg",validation_errors());
				return false;
				
			}
		}

		public function changepass($post) {
			$this->load->library("form_validation");
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
			$this->form_validation->set_rules("cpassword", "Confirm Password", "trim|required|matches[password]");
			if ($this->form_validation->run() === TRUE){
				$pass = $post['password'];
				$id = $post['id'];
				$encrypt_pass = md5($pass.''.$salt);
				$query = "UPDATE users SET password = ?, salt = ? WHERE id = ?";
				$values = array($encrypt_pass, $salt, $id);
				return $this->db->query($query, $values);
			}
			else {
				$this->session->set_flashdata("msg",validation_errors());
				return false;
			}
		}

		public function remove($id) {
			return $this->db->query("DELETE from users WHERE id = ?",array($id));
		}
		public function send_msg($post) {
			$array = $this->session->userdata("info");
			$receiver_id = $post['receiver_id'];
			$sender_id = $array['id'];
			$msg = $post['message_user'];
			date_default_timezone_set("Asia/Manila");
			$date = date("Y-m-d H:i:s");
			$query = "INSERT INTO messages (receiver_id, sender_id, message, created_at, updated_at)
					   VALUES(?,?,?,?,?)";
			$values = array($receiver_id, $sender_id, $msg, $date, $date);
			return $this->db->query($query, $values);
		}

		public function send_comment($post) {
			$array = $this->session->userdata("info");
			$msg_id = $post['msg_id'];
			$userid = $array['id'];
			$comment = $post['comment_user'];
			date_default_timezone_set("Asia/Manila");
			$date = date("Y-m-d H:i:s");
			$query = "INSERT INTO comments (user_id, message_id, comment, created_at, updated_at)
				  			VALUES(?, ?, ?, ?, ?)";
			$values = array($userid, $msg_id, $comment, $date, $date);
			return $this->db->query($query, $values);
		}

		public function update_desc($post) {
			$desc = $post['desc'];
			$id = $post['id'];
			$query = "UPDATE users SET description = ? WHERE id = ?";
			$values = array($desc, $id);
			return $this->db->query($query, $values);
		}


		/////////////////////////////////////////////////////////////////////

		/* all the codes below used for display and error trapping */

		public function get_all() {
			return $this->db->query("SELECT * from users")->result_array();
		}
		public function get_rows() {
			return $this->db->query("SELECT * from users")->num_rows();
		}
		public function get_user_byid($id) {
			return $this->db->query("SELECT * from users WHERE id = ?",array($id))->row_array();
		}

		/* check if the specific exist we can use this for signing up */
		public function isExist($email) {
			$query = $this->db->query("SELECT * from users WHERE email = ?",array($email));
			return $query->num_rows();
		}

		
		public function get_messages_byid($id) {
			$query =  "SELECT users.fname, users.lname, messages.sender_id, messages.message, 
							   messages.created_at, messages.id FROM users
							   INNER JOIN messages on users.id = messages.sender_id
							   WHERE messages.receiver_id = ?
							   ORDER BY messages.created_at desc";
			return $this->db->query($query, array($id))->result_array();
		}


		/* to check if user input invalid name like numbers on their name  */
		public function is_name_has_number($fname, $lname) {
		$isValid = true;
		$fname_valid = preg_match('/[0-9]/', $fname);
		if ($fname_valid) {
			$this->session->set_flashdata("msg","Invalid name");
			$isValid = false;
		}

		$lname_valid = preg_match('/[0-9]/', $lname);
		if ($lname_valid) {
			$this->session->set_flashdata("msg","Invalid name");
			$isValid = false;
		}
		return $isValid;
	}

	}

?>