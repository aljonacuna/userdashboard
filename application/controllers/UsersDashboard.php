<?php
	
	class UsersDashboard extends CI_Controller {
		
		public function index() {
			$this->load->view("user_dashboard/header");
			$this->load->view("user_dashboard/home");
		}
		public function signin() {
			$this->load->view("user_dashboard/header");
			$this->load->view("user_dashboard/signin");
		}
		public function signup() {
			$this->load->view("user_dashboard/header");
			$this->load->view("user_dashboard/signup");
		}
		public function dashboard() {
			$this->load->model("user_dashboard/UserDashboard");
			$result = $this->UserDashboard->get_all();
			$this->session->set_userdata("all_users",$result);
			$info = $this->session->userdata("info");
			$this->load->view("user_dashboard/headermain");

			/*check if user is admin or normal user if = 9 load dashboard 
			for admin if it is 1  load the normal dashboard for normal users*/
			if ($info['user_lvl'] == 9) {
				$this->load->view("user_dashboard/dashboard");
			}
			else {
				$this->load->view("user_dashboard/dashboard_normal");
			}
		}

		/*to create a user only the admin can access this 
		via add new user button on admin dasboard */
		public function createuser() {
			$this->load->view("user_dashboard/headermain");
			$this->load->view("user_dashboard/createuser");
		}

		//show user based on their id's on users dashboard
		public function showuser($id) {
			$this->load->model("user_dashboard/UserDashboard");
			$result = $this->UserDashboard->get_user_byid($id);
			$messages = $this->UserDashboard->get_messages_byid($id);
			$this->session->set_userdata("messages",$messages);
			$this->load->view("user_dashboard/headermain");
			$this->load->view("user_dashboard/showuser",$result);
		}

		//update page everyone can access this function
		public function updateinfo($id) {
			$this->load->view("user_dashboard/headermain");
			$this->load->view("user_dashboard/edit_profile",$this->get_data_byid($id));
		}

		// update page for user only the admin  can access this function
		public function edituser($id) {
			$this->load->view("user_dashboard/headermain");
			$this->load->view("user_dashboard/edit",$this->get_data_byid($id));
		}

		//confirmation page for deleting a specific user
		public function toconfirm($id) {
			$this->load->view("user_dashboard/headermain");
			$this->load->view("user_dashboard/toconfirm",$this->get_data_byid($id));
		}



		/* all the codes below used for saving ,checking , removing , retrieving */

		//if user press logoff this function will unset users info on session
		public function logoff() {
			$this->session->unset_userdata("info");
			redirect("UsersDashboard/index");
		}


		//function for saving the messages on db
		public function send_msg() {
			$this->load->model("user_dashboard/UserDashboard");
			$input = $this->input->post();
			$id = $input['receiver_id'];
			$result = $this->UserDashboard->send_msg($input);
			if ($result == TRUE) {
				redirect("UsersDashboard/showuser/$id");
			}
			else {
				redirect("UsersDashboard/showuser/$id");
			}
		}

		//function for saving the comments on db
		public function send_comment() {
			$this->load->model("user_dashboard/UserDashboard");
			$input = $this->input->post();
			$id = $input['user_id'];
			$result = $this->UserDashboard->send_comment($input);
			if ($result == TRUE) {
				redirect("UsersDashboard/showuser/$id");
			}
			else {
				redirect("UsersDashboard/showuser/$id");
			}
		}

		//get user data based on id's
		public function get_data_byid($id) {
			$this->load->model("user_dashboard/UserDashboard");
			return $this->UserDashboard->get_user_byid($id);
		}


		//function when admin want to delete a specific user
		public function remove($id) {
			$this->load->model("user_dashboard/UserDashboard");
			$result = $this->UserDashboard->remove($id);
			if ($result == TRUE) {
				redirect("UsersDashboard/dashboard");
			}
			else {
				redirect("UsersDashboard/toconfirm");
			}
		}

		//this function is for saving the updated data of users
		public function update_profile() {
			$input = $this->input->post();
			$id = $input['id'];
			$this->load->model("user_dashboard/UserDashboard");
			$result = $result = $this->UserDashboard->edit_user_profile($input);
			if ($result == TRUE) {
				redirect("UsersDashboard/dashboard");
			}
			else {
				redirect("UsersDashboard/updateinfo/$id");
			}
		}

		//this function can only access by admin to update users information
		public function save_info() {
			$input = $this->input->post();
			$id = $input['id'];
			$this->load->model("user_dashboard/UserDashboard");
			$result = $this->UserDashboard->edit_user_info($input);
			if ($result == TRUE) {
				redirect("UsersDashboard/dashboard");
			}
			else {
				redirect("UsersDashboard/edituser/$id");
			}
		}

		public function changepass($tag) {
			$input = $this->input->post();
			$this->load->model("user_dashboard/UserDashboard");
			$result = $this->UserDashboard->changepass($input);
			$id = $input["id"];
			if ($result == TRUE) {
				redirect("UsersDashboard/dashboard");
			}
			else {
				if ($tag == "1") {
					redirect("UsersDashboard/updateinfo/$id");
				}
				else {
					redirect("UsersDashboard/edituser/$id");
				}

			}
		}

		public function update_desc() {
			$this->load->model("user_dashboard/UserDashboard");
			$input = $this->input->post();
			$id = $input['id'];
			$result = $this->UserDashboard->update_desc($input);
			if ($result == TRUE) {
				redirect("UsersDashboard/dashboard");
			}
			else {
				redirect("UsersDashboard/updateinfo/$id");
			}
		}

		//this is the saving process when user signup
		public function add_user() {
			$this->load->model("user_dashboard/UserDashboard");
			//save input to $input variable
			$input = $this->input->post();
			$result = $this->UserDashboard->save_user($input);
			if ($result == TRUE) {
				redirect("UsersDashboard/signin");
			}
			else {
				redirect("UsersDashboard/signup");
			}
		}

		//this is for admin when admin add a new user this function will it's data
		public function new_user() {
			$this->load->model("user_dashboard/UserDashboard");
			//save input to $input variable
			$input = $this->input->post();
			$result = $this->UserDashboard->save_user($input);
			echo $result;
			if ($result == TRUE) {
				redirect("UsersDashboard/dashboard");
			}
			else {
				redirect("UsersDashboard/createuser");
			}
		}

		//this function was built for login
		public function authentication() {
			$this->load->model("user_dashboard/UserDashboard");
			//save input to $input variable
			$input = $this->input->post();
			$isValid = $this->UserDashboard->authenticate($input);
			if ($isValid) {
				redirect("UsersDashboard/dashboard");
			}
			else {
				redirect("UsersDashboard/signin");
			}
		}

	}

?>