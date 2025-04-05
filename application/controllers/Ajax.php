<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	public function login(){
		// echo '<pre>';
		// print_r($this->input->post());
		// echo '</pre>';die;
		$this->db->cache_delete_all();
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
			if ($this->form_validation->run() === FALSE) {
				//Either you can print value or you can send value to database
				$response = array(
					'message' => "Please Enter Username and Password.",
					'status' => 0,
				);
			} else {
				//Execute Your Code
				$data = array(
					'username' => $this->input->post('username', TRUE),
					'password' => md5($this->input->post('password', TRUE))
				);
				$admins = $this->admin_model->adminLogin($data);
				$base_url = base_url() . 'admin/dashboard';
				if ($admins) {
					if ($admins->is_active == 1) {
						$session_data = array(
							'logged_in_id' => $admins->id,
							'screen_name' => $admins->name,
							'email' => $admins->email,
							'role' => $admins->role,
						);
						$this->session->set_userdata('logged_in_admin_data', $session_data);
						//Either you can print value or you can send value to database
						$response = array(
							'message' => "The system has validated your login credentials. Redirecting<span class='loader__dot'>.</span><span class='loader__dot'>.</span><span class='loader__dot'>.</span>",
							'redirect_url' => $base_url,
							'status' => 1,
						);
					} else {
						$response = array(
							'message' => "Your account does not active.Please try again later!",
							'status' => 0,
						);
					}
				} else {
					//Either you can print value or you can send value to database
					$response = array(
						'message' => "Invalid Username and Password. Please try again!",
						'status' => 0,
					);
				}
			}
			$this->output->set_header('Content-type: application/json');
			$this->output->set_output(json_encode($response));
			//echo json_encode($response);
		}
	}

	public function ajaxProcess()
	{
		$response = array();
		if ($this->input->is_ajax_request()) {
			$request = $this->input->post('request', TRUE);
			$date_at = date("Y-m-d H:i:s");
			//get post name is available or not
			if (!empty($request) && $request === 'check-post-name') {
				$post_name = trim($this->input->post('post_name', TRUE));
				$action = $this->input->post('action', TRUE);
				$post_id = $this->input->post('post_id', TRUE);
			
				if (!empty($action)) {
					$response = $this->admin_model->checkPostName('pages', $post_name,'page_title', $action, $post_id);
				} else {
					$response = [
						'message' => "Page Title check is not working. Please try again!",
						'id' => $post_name,
						'dataContent' => ''
					];
				}
			}
			

			//get edit page data
			if (!empty($request) && $request === 'edit_page_data') {
				$post_id = $this->input->post('post_id', TRUE);
				$postDetails = $this->admin_model->getOneRecord('pages', 'id', $post_id, '*');
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'id' => $post_id,
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'id' => $post_id,
						'dataContent' => '',
					);
				}
			}
			if (!empty($request) && $request === 'edit_course_data') {
				$post_id = $this->input->post('post_id', TRUE);
				$postDetails = $this->admin_model->getOneRecord('courses', 'page_id', $post_id, '*') ;
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'id' => $post_id,
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'id' => $post_id,
						'dataContent' => '',
					);
				}
			}
			if (!empty($request) && $request === 'edit_testimonial_data') {
				$post_id = $this->input->post('post_id', TRUE);
				$postDetails = $this->admin_model->getOneRecord('courses', 'page_id', $post_id, '*') ;
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'id' => $post_id,
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'id' => $post_id,
						'dataContent' => '',
					);
				}
			}
			if (!empty($request) && $request === 'edit_blog_data') {
				$post_id = $this->input->post('post_id', TRUE);
				$postDetails = $this->admin_model->getOneRecord('blogs', 'id', $post_id, '*') ;
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'id' => $post_id,
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'id' => $post_id,
						'dataContent' => '',
					);
				}
			}

		}	
		$this->output->set_header('Content-type: application/json');
		$this->output->set_output(json_encode($response));
	}
	public function getHomepage(){
		$response = array();
		if ($this->input->is_ajax_request()) {
				$postDetails = $this->admin_model->getData('home_page') ;
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'dataContent' => '',
					);
				}
			}
		$this->output->set_header('Content-type: application/json');
		$this->output->set_output(json_encode($response));
	}
	public function getCategory()
	{
		// print_r($this->input->post());die;
		$post_id = $this->input->post('post_id');
		$response = array();
		if ($this->input->is_ajax_request()) {
				$postDetails = $this->admin_model->getData('categories',["id"=>$post_id ]);
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'dataContent' => '',
					);
				}
			}
		$this->output->set_header('Content-type: application/json');
		$this->output->set_output(json_encode($response));
	}

	public function getCourse()
	{
		// print_r($this->input->post());die;
		$post_id = $this->input->post('post_id');
		$response = array();
		if ($this->input->is_ajax_request()) {
				$postDetails = $this->admin_model->getData('courses',["id"=>$post_id ]);
				// print_r($postDetails);die;
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'dataContent' => '',
					);
				}
			}
		$this->output->set_header('Content-type: application/json');
		$this->output->set_output(json_encode($response));
	}
	public function getFinance()
	{
		$response = array();
		if ($this->input->is_ajax_request()) {
				$postDetails = $this->admin_model->getData('finance') ;
				if (isset($postDetails) && !empty($postDetails)) {
					$response = array(
						'dataContent' => $postDetails,
					);
				} else {
					$response = array(
						'dataContent' => '',
					);
				}
			}
		$this->output->set_header('Content-type: application/json');
		$this->output->set_output(json_encode($response));
	}

}