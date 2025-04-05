<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->db->cache_delete_all();
		$this->load->library('form_validation');
	}
	public function index(){
		if ($this->admin_model->check_logged() === true) {
			redirect(base_url() . 'admin/dashboard');
		}
		$data['title'] = 'Login';
		$this->load->view('Admin/login', $data);
	}
    public function dashboard(){
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		$where_condition = array();
		// $data['totalPages'] = $this->admin_model->getNumRows('pages', $where_condition);
		$data['totalAdminUser'] = $this->admin_model->getNumRows('admin', $where_condition);
		$data['title'] = 'Dashboard';
		$this->load->view('Admin/include/header', $data);
		$this->load->view('Admin/include/left-menu', $data);
		$this->load->view('Admin/dashboard', $data);
		$this->load->view('Admin/include/footer');
	}
	public function logout(){
		$isCheck = $this->session->unset_userdata('logged_in_admin_data');
		if (empty($isCheck)) {
			$this->session->set_flashdata('login_success', 'Successfully! Logged Out!');
		} else {
			$this->session->set_flashdata('login_error', 'Failed! to Logged Out!');
		}
		redirect("/admin", 'refresh');
	}
	private function upload_img($field_name, $upload_path, $allowed_types, $max_size,$redirect,$prev_data='') {
		// echo $upload_path;die;
        if (!empty($_FILES[$field_name]['name'])) {
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = $allowed_types;
            $config['max_size'] = $max_size;
            $config['file_name'] = time() . '_' . $_FILES[$field_name]['name'];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($field_name)) {
                $error = $this->upload->display_errors('', '');
                log_message('error', "Image upload failed: " . $error); 
				$this->session->set_flashdata('post_error',$error);
				// echo $field_name .':'. $error;die;
                redirect($redirect);
            } else {
                if (!empty($prev_data)) { 
                    $this->delete_file('uploads/course_images/' . $prev_data); 
                }
                return $this->upload->data('file_name');
            }
        }
		return null;
    }
	public function manage_home_page(){
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		$data['blogList'] = $this->admin_model->getData('blogs');
		$data['categoryList'] = $this->admin_model->getCategories();

		$data['title'] = 'Home Page';
		$this->load->view('Admin/include/header', $data);
		$this->load->view('Admin/include/left-menu', $data);
		$this->load->view('Admin/manage-home-page', $data);
		$this->load->view('Admin/include/footer');
	}
	public function add_home_page(){
		if ($this->admin_model->check_logged() === false) {
			echo json_encode(["status" => "post_error", "message" => "Failed to update. Please try again later."]);
			exit;
		}
		// print_r($this->input->post());die;
		$tag = $this->input->post('tag');
		$id = $this->input->post('post_id');
		$page_type = $this->input->post('type');
		
		$date = date("Y-m-d H:i:s");
		$data = array();
		$type = '*';
		$size = 2048;
		// echo $db;die;

		if($page_type == 'home_page'){
			$db = "home_page";
			$path = 'uploads/home_images/';
			$name = "Home Page";
		}elseif($page_type == 'category'){
			$db = "categories";
			$path = 'uploads/category_images/';
			$name = "Category";
			$redirect = "admin/category_list";
		}elseif($page_type == 'course'){
			$db = "courses";
			$path = 'uploads/course_images/';
			$name = "Course";
			$redirect = "admin/courses_list";

		}
			
		if($tag == 'create_page'){
			$this->form_validation->set_rules('page_title', 'page_title', 'required');
			$this->form_validation->set_rules('slug', 'slug', 'required');
			
			if($page_type != 'course'){
				$this->form_validation->set_rules('seo_title', 'seo_title', 'required');
				$this->form_validation->set_rules('seo_description', 'seo_description', 'required');
			}
		}elseif($tag == 'add_banner'){
			$this->form_validation->set_rules('banner_heading', 'banner_heading', 'required');
			$this->form_validation->set_rules('banner_content', 'banner_content', 'required');
		}elseif($tag == 'add_usp'){
			$this->form_validation->set_rules('usp_heading', 'usp_heading', 'required');
		}elseif($tag == 'add_why_ey'){
			$this->form_validation->set_rules('why_ey_heading', 'why_ey_heading', 'required');
		}elseif($tag == 'add_solution'){
			$this->form_validation->set_rules('solution_heading', 'solution_heading', 'required');
		}elseif($tag == 'add_cat'){
			$this->form_validation->set_rules('category_heading', 'category_heading', 'required');
		}elseif($tag == 'add_mode'){
			$this->form_validation->set_rules('mode_heading', 'mode_heading', 'required');
		}elseif($tag == 'add_comprehensive'){
			$this->form_validation->set_rules('comprehensive_heading', 'comprehensive_heading', 'required');
		}elseif($tag == 'add_testimonial'){
			$this->form_validation->set_rules('testimonal_main_heading', 'testimonal_main_heading', 'required');
		}elseif($tag == 'add_blogs'){
			$this->form_validation->set_rules('blog_heading', 'blog_heading', 'required');
		}elseif($tag == 'add_about'){
			$this->form_validation->set_rules('about_heading', 'about_heading', 'required');
		}elseif($tag == 'add_ap'){
			$this->form_validation->set_rules('ap_heading', 'ap_heading', 'required');
		}elseif($tag == 'add_pd'){
			$this->form_validation->set_rules('pd_heading', 'pd_heading', 'required');
		}elseif($tag == 'add_co'){
			$this->form_validation->set_rules('co_heading', 'co_heading', 'required');
		}elseif($tag == 'add_po'){
			$this->form_validation->set_rules('po_heading', 'po_heading', 'required');
		}elseif($tag == 'add_info'){
			$this->form_validation->set_rules('name', 'name', 'required');
		}elseif($tag == 'add_related_course'){
			$this->form_validation->set_rules('related_course_heading', 'related_course_heading', 'required');
		}elseif($tag == 'add_faq'){
			$this->form_validation->set_rules('faq_heading', 'faq_heading', 'required');
		}elseif($tag == 'deleteCategory') {
			$post_id = $this->input->post('post_id');
			if (empty($post_id)) {
				$this->session->set_flashdata('post_error', "Invalid request. $name ID is missing.");
				redirect($redirect);
			}

			$deleted = $this->admin_model->deleteWithWhereConditions($db, ['id' => $post_id]);
			if ($deleted) {
				$this->session->set_flashdata('post_success', "$name has been deleted successfully.");
			} else {
				log_message('error', "Failed to delete $name with ID: $post_id");
				$this->session->set_flashdata('post_error', "Failed to delete $name. Please try again later.");
			}
			redirect($redirect);
		}elseif($tag == 'deleteCourse') {
			$post_id = $this->input->post('post_id');
			if (empty($post_id)) {
				$this->session->set_flashdata('post_error', "Invalid request. $name ID is missing.");
				redirect($redirect);
			}

			$deleted = $this->admin_model->deleteWithWhereConditions($db, ['id' => $post_id]);
			if ($deleted) {
				$this->session->set_flashdata('post_success', "$name has been deleted successfully.");
			} else {
				log_message('error', "Failed to delete $name with ID: $post_id");
				$this->session->set_flashdata('post_error', "Failed to delete $name. Please try again later.");
			}
			redirect($redirect);
		}
		if ($this->form_validation->run() == FALSE) {
			$response = ["status" => "post_error","message" => validation_errors()];
			echo json_encode($response);
			exit;
		}
		
		if($tag == 'create_page'){
			$data = array(
				"page_title" => $this->input->post('page_title'),
				"slug" => $this->input->post('slug'),
				"status" => $this->input->post('status')
			);
			
			// Conditionally add SEO fields if $page_type is not 'course'
			if ($page_type != 'course') {
				$data["seo_title"] = $this->input->post('seo_title');
				$data["seo_description"] = $this->input->post('seo_description');
			}else{
				$data["category"] = json_encode($this->input->post('categories'));
				$data["is_detail"] = ($this->input->post('isDetail') === "on") ? 1 : 0;
				
			}
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$data['created_at'] = $date;
				// print_r($data);die;
				$inserted_id = $this->admin_model->addData($db, $data);
				if ($inserted_id) {
					$response = ["status" => "post_success","message" => "$name has been added successfully.","post_id"=>$inserted_id];
				} else {
					$response = ["status" => "post_error","message" => "Failed to add $name. Please try again later."];
				}
				
			}else{

				// print_r($page);	
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
		}elseif($tag == 'add_banner'){
			$banner_data = array(
				"banner_heading"=>$this->input->post('banner_heading'),
				"banner_content"=>$this->input->post('banner_content'),
				"stu_count"=>$this->input->post('stu_count'),
				"lesson_count"=>$this->input->post('lesson_count'),
				"rating_count"=>$this->input->post('rating_count'),
				"videos_count"=>$this->input->post('videos_count'),
			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$banner = $page[0]->banner;
			// print_r($page[0]->banner);die;
			
			if(!empty($banner) && $banner !='null'){
				if (!empty($_FILES['banner_img']['name'])) {
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;
					$config['max_size'] = $size;
					$config['file_name'] = time() . '_' . $_FILES['banner_img']['name'];
		
					$this->load->library('upload', $config);
		
					if (!$this->upload->do_upload('banner_img')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error","message" =>$error];
						echo json_encode($response);
						exit;
					}else{
						$banner_data['banner_img'] = $this->upload->data('file_name');
					}
				}else{
					$banner_decode = json_decode($banner);
					$banner_data['banner_img'] = $banner_decode->banner_img;
				}
				$banner_json = json_encode($banner_data);
				$data['banner'] = $banner_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				if (!empty($_FILES['banner_img']['name'])) {
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;
					$config['max_size'] = $size;
					$config['file_name'] = time() . '_' . $_FILES['banner_img']['name'];
		
					$this->load->library('upload', $config);
		
					if (!$this->upload->do_upload('banner_img')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error","message" =>$error];
						echo json_encode($response);
						exit;
					} else {
						$banner_data['banner_img'] = $this->upload->data('file_name');
					}
				}
				$banner_json = json_encode($banner_data);
				$data['banner'] = $banner_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
			
		}elseif($tag == 'add_info'){
			$info_data = array(
				"name"=>$this->input->post('name'),
				"email"=>$this->input->post('email'),
				"phone_no"=>$this->input->post('phone_no'),
				"email2"=>$this->input->post('email2'),
			);
			$course = $this->admin_model->getData($db,['id'=>$id]);
			if(!$course){
				$response = ["status" => "post_error","message" =>"Please add course title"];
				echo json_encode($response);
				exit;
			}
			$info = $course[0]->info;
			// print_r($course[0]->course);die;
			// print_r($_FILES['info_file']);die;
			if (!empty($info) && $info != 'null') {
				if (!empty($_FILES['info_img']['name'])) {
					$config = [];
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;
					$config['max_size'] = $size;
					$config['file_name'] = time() . '_' . $_FILES['info_img']['name'];
			
					$this->load->library('upload', $config); // Load upload library
					$this->upload->initialize($config); // Re-initialize upload library
			
					if (!$this->upload->do_upload('info_img')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error", "message" => $error];
						echo json_encode($response);
						exit;
					} else {
						$info_data['info_img'] = $this->upload->data('file_name');
					}
				} else {
					$info_decode = json_decode($info);
					$info_data['info_img'] = $info_decode->info_img;
				}
			
				if (!empty($_FILES['info_file']['name'])) {
					$config = [
						'upload_path'   => $path,
						'allowed_types' => $type,
						'max_size'      => $size,
						'file_name'     => time() . '_' . $_FILES['info_file']['name']
					];
				
					$this->load->library('upload', $config); // Load Upload Library
					$this->upload->initialize($config); // Initialize Upload
				
					if (!$this->upload->do_upload('info_file')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error", "message" => $error];
						echo json_encode($response);
						exit;
					} else {
						$info_data['info_file'] = $this->upload->data('file_name');
					}
				} else {
					$info_decode = json_decode($info, true); // Convert JSON to an associative array
					$info_data['info_file'] = isset($info_decode['info_file']) ? $info_decode['info_file'] : null;

				}
			
				$info_json = json_encode($info_data);
				$data['info'] = $info_json;
				$data['updated_at'] = $date;
			
			
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success", "message" => "Home course has been updated successfully."];
				} else {
					$response = ["status" => "post_error", "message" => "Failed to update Home course. Please try again later."];
				}
			} else {
				if (!empty($_FILES['info_img']['name'])) {
					$config = [];
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;
					$config['max_size'] = $size;
					$config['file_name'] = time() . '_' . $_FILES['info_img']['name'];
			
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
			
					if (!$this->upload->do_upload('info_img')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error", "message" => $error];
						echo json_encode($response);
						exit;
					} else {
						$info_data['info_img'] = $this->upload->data('file_name');
					}
				}
			
				if (!empty($_FILES['info_file']['name'])) {
					$config = [];
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;
					$config['max_size'] = $size;
					$config['file_name'] = time() . '_' . $_FILES['info_file']['name'];
			
					$this->upload->initialize($config);
			
					if (!$this->upload->do_upload('info_file')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error", "message" => $error];
						echo json_encode($response);
						exit;
					} else {
						$info_data['info_file'] = $this->upload->data('file_name');
					}
				}
			
				$info_json = json_encode($info_data);
				$data['info'] = $info_json;
				$data['updated_at'] = $date;
			
			
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success", "message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error", "message" => "Failed to update $name. Please try again later."];
				}
			}
			
			
		}elseif($tag == 'add_usp'){
			$usps_data = array(
				"usp_heading"=>$this->input->post('usp_heading'),
			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$usps = $page[0]->usps;
			if(!empty($usps) && $usps !='null'){
				$totalUSPs = 6;
				for ($i = 1; $i <= $totalUSPs; $i++) {
					$usps_data['usp_heading'.$i] = $this->input->post('usp_heading'.$i);
					if (!empty($_FILES['usp_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['usp_img'.$i]['name'];
			
						$this->load->library('upload', $config);
			
						if (!$this->upload->do_upload('usp_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$usps_data['usp_img'.$i] = $this->upload->data('file_name');
						}
					}else{
						$usps_decode = json_decode($usps);
						// print_r($usps_decode);die;
						$usps_data['usp_img' . $i] = isset($usps_decode->{'usp_img' . $i}) ? $usps_decode->{'usp_img' . $i} : '';

					}
					$usps_data['content'.$i] = $this->input->post('content'.$i);
				}
				$usps_json = json_encode($usps_data);
				$data['usps'] = $usps_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				$totalUSPs = 6;
				for ($i = 1; $i <= $totalUSPs; $i++) {
					$usps_data['usp_heading'.$i] = $this->input->post('usp_heading'.$i);
					if (!empty($_FILES['usp_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['usp_img'.$i]['name'];
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('usp_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$usps_data['usp_img'.$i] = $this->upload->data('file_name');
						}
					}
					$usps_data['content'.$i] = $this->input->post('content'.$i);
				}
				$usps_data_json = json_encode($usps_data);
				$data['usps'] = $usps_data_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
		}elseif($tag == 'add_why_ey'){
			// print_r($this->input->post());die;
			$why_EY_data = array(
				"why_ey_heading"=>$this->input->post('why_ey_heading'),
			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$why_EY = $page[0]->why_EY;
			if(!empty($why_EY) && $why_EY !='null'){
				$totalwhy_EY = 9;
				for ($i = 1; $i <= $totalwhy_EY; $i++) {
					$why_EY_data['why_ey_title'.$i] = $this->input->post('why_ey_title'.$i);

					if (!empty($_FILES['why_ey_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['why_ey_img'.$i]['name'];
			
						$this->load->library('upload', $config);
			
						if (!$this->upload->do_upload('why_ey_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$why_EY_data['why_ey_img'.$i] = $this->upload->data('file_name');
						}
					}else{
						$why_EY_decode = json_decode($why_EY);
						// print_r($why_EY_decode);die;
						$why_EY_data['why_ey_img' . $i] = isset($why_EY_decode->{'why_ey_img' . $i}) ? $why_EY_decode->{'why_ey_img' . $i} : '';

					}
					$why_EY_data['why_ey_content'.$i] = $this->input->post('why_ey_content'.$i);
				}
				$why_EY_decode_json = json_encode($why_EY_data);
				$data['why_EY'] = $why_EY_decode_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				$totalwhy_EY = 9;
				for ($i = 1; $i <= $totalwhy_EY; $i++) {
					$why_EY_data['why_ey_title'.$i] = $this->input->post('why_ey_title'.$i);
					if (!empty($_FILES['why_ey_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['why_ey_img'.$i]['name'];
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('why_ey_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$why_EY_data['why_ey_img'.$i] = $this->upload->data('file_name');
						}
					}
					$why_EY_data['why_ey_content'.$i] = $this->input->post('why_ey_content'.$i);
				}
				$why_EY_data_json = json_encode($why_EY_data);
				$data['why_EY'] = $why_EY_data_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
		}elseif($tag == 'add_solution'){
			// print_r($this->input->post());die;
			$solution_data = array(
				"solution_heading"=>$this->input->post('solution_heading'),
			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			// print_r($page);die;	
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$solutions = $page[0]->solutions;
			if(!empty($solutions) && $solutions !='null'){
				$totalsolutions = 4;
				for ($i = 1; $i <= $totalsolutions; $i++) {
					$solution_data['solution_title'.$i] = $this->input->post('solution_title'.$i);
					if (!empty($_FILES['solution_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['solution_img'.$i]['name'];
			
						$this->load->library('upload', $config);
			
						if (!$this->upload->do_upload('solution_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$solution_data['solution_img'.$i] = $this->upload->data('file_name');
						}
					}else{
						$solution_decode = json_decode($solutions);
						// print_r($solution_decode);die;
						$solution_data['solution_img' . $i] = isset($solution_decode->{'solution_img' . $i}) ? $solution_decode->{'solution_img' . $i} : '';

					}
					$solution_data['solution_btn_txt'.$i] = $this->input->post('solution_btn_txt'.$i);
					$solution_data['solution_btn_url'.$i] = $this->input->post('solution_btn_url'.$i);
				}
				$solution_json = json_encode($solution_data);
				$data['solutions'] = $solution_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				$totalsolutions = 6;
				for ($i = 1; $i <= $totalsolutions; $i++) {
					$solution_data['solution_title'.$i] = $this->input->post('solution_title'.$i);
					if (!empty($_FILES['solution_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['solution_img'.$i]['name'];
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('solution_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$solution_data['solution_img'.$i] = $this->upload->data('file_name');
						}
					}
					$solution_data['solution_btn_url'.$i] = $this->input->post('solution_btn_url'.$i);
				}
				$solution_data_json = json_encode($solution_data);
				$data['solutions'] = $solution_data_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
		}elseif($tag == 'add_cat'){
			// print_r($this->input->post());die;	
			$blog = array(
				"category_heading"=>$this->input->post("category_heading"),
				"category_select" => json_encode($this->input->post('categories')),
				"cat_btn_txt" =>$this->input->post('cat_btn_txt'),
				"cat_btn_url" => $this->input->post('cat_btn_url'),
				
			);
			$data['categories'] = json_encode($blog);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$categories = $page[0]->categories;
			if(!empty($categories) && $categories !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
			
	
		}elseif($tag == 'add_mode'){
			$modes_data = array(
				"mode_heading"=>$this->input->post('mode_heading'),
			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$modes = $page[0]->modes;
			if(!empty($modes) && $modes !='null'){
				$totalModes = 4;
				for ($i = 1; $i <= $totalModes; $i++) {
					$modes_data['mode_heading'.$i] = $this->input->post('mode_heading'.$i);
					if (!empty($_FILES['mode_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['mode_img'.$i]['name'];
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('mode_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$modes_data['mode_img'.$i] = $this->upload->data('file_name');
						}
					}else{
						$modes_decode = json_decode($modes);
						$modes_data['mode_img' . $i] = isset($modes_decode->{'mode_img' . $i}) ? $modes_decode->{'mode_img' . $i} : '';

					}
					$modes_data['mode_content'.$i] = $this->input->post('mode_content'.$i);
				}
				$modes_json = json_encode($modes_data);
				$data['modes'] = $modes_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				$totalModes = 4;
				for ($i = 1; $i <= $totalModes; $i++) {
					$modes_data['mode_heading'.$i] = $this->input->post('mode_heading'.$i);
					if (!empty($_FILES['mode_img'.$i]['name'])) {
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['max_size'] = $size;
						$config['file_name'] = time() . '_' . $_FILES['mode_img'.$i]['name'];
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('mode_img'.$i)) {
							$error = $this->upload->display_errors('', '');
							$response = ["status" => "post_error","message" =>$error];
							echo json_encode($response);
							exit;
						} else {
							$modes_data['mode_img'.$i] = $this->upload->data('file_name');
						}
					}
					$modes_data['mode_content'.$i] = $this->input->post('mode_content'.$i);
				}
				$modes_data_json = json_encode($modes_data);
				$data['modes'] = $modes_data_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
		}elseif($tag == 'add_comprehensive'){
			$comprehensive_data = array(
				"comprehensive_heading"=>$this->input->post('comprehensive_heading'),
				"comprehensive_content" => $this->input->post('comprehensive_content')

			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$comprehensive_img = $page[0]->comprehensive_img;
			if(!empty($comprehensive_img) && $comprehensive_img !='null'){
				if (!empty($_FILES['comprehensive_img']['name'])) {
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;
					$config['max_size'] = $size;
					$config['file_name'] = time() . '_' . $_FILES['comprehensive_img']['name'];
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('comprehensive_img')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error","message" =>$error];
						echo json_encode($response);
						exit;
					} else {
						$comprehensive_data['comprehensive_img'] = $this->upload->data('file_name');
					}
				}else{
					$comprehensive_data_decode = json_decode($comprehensive_img);
					$comprehensive_data['comprehensive_img'] = isset($comprehensive_data_decode->{'comprehensive_img'}) ? $comprehensive_data_decode->{'comprehensive_img'} : '';

				}
				$comprehensive_data_json = json_encode($comprehensive_data);
				$data['comprehensive'] = $comprehensive_data_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				if (!empty($_FILES['comprehensive_img']['name'])) {
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;
					$config['max_size'] = $size;
					$config['file_name'] = time() . '_' . $_FILES['comprehensive_img']['name'];
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('comprehensive_img')) {
						$error = $this->upload->display_errors('', '');
						$response = ["status" => "post_error","message" =>$error];
						echo json_encode($response);
						exit;
					} else {
						$comprehensive_data['comprehensive_img'] = $this->upload->data('file_name');
					}
				}
				$comprehensive_data_json = json_encode($comprehensive_data);
				$data['comprehensive'] = $comprehensive_data_json;
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
		}elseif($tag == 'add_testimonial'){
			$testimonial = array(
				"testimonal_main_heading"=>$this->input->post('testimonal_main_heading'),
				'testimonials' => []
			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$testimonials = $page[0]->testimonials;
			if(!empty($testimonials) && $testimonials !='null'){
				// print_R($_FILES);die;
				$existing_testimonials = json_decode($testimonials, true) ?? [];
				$files = $_FILES['testimonal_img'];
				$uploaded_images = [];
				$this->load->library('upload');
				foreach ($files['name'] as $key => $filename) {
					if (!empty($filename)) { // Only upload if a new file is selected
						$_FILES['file']['name'] = $files['name'][$key];
						$_FILES['file']['type'] = $files['type'][$key];
						$_FILES['file']['tmp_name'] = $files['tmp_name'][$key];
						$_FILES['file']['error'] = $files['error'][$key];
						$_FILES['file']['size'] = $files['size'][$key];
						$config['upload_path'] = $path;
						$config['allowed_types'] = $type;
						$config['file_name'] = time() . '_' . $filename;

						$this->upload->initialize($config);

						if ($this->upload->do_upload('file')) {
							$uploaded_images[$key] = $this->upload->data('file_name');
						} else {
							$uploaded_images[$key] = $existing_testimonials['testimonials'][$key]['image'] ?? null; // Keep the old image if upload fails
						}
					} else {
						$uploaded_images[$key] = $existing_testimonials['testimonials'][$key]['image'] ?? null; // Use existing image if no new image is uploaded
					}
				}
				foreach ($_POST['testimonal_heading'] as $index => $heading) {
					$testimonial['testimonials'][] = [
						'heading' => $heading,
						'image' => $uploaded_images[$index] ?? null,
						'content' => $_POST['testimonal_content'][$index],
						'name' => $_POST['testimonal_name'][$index],
						'profession' => $_POST['testimonal_profession'][$index]
					];
				}
				$data['testimonials'] = json_encode($testimonial);
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				// echo 1;
				// print_R($_FILES);die;

				$files = $_FILES['testimonal_img'];
				$uploaded_images = [];
				$this->load->library('upload');

				foreach ($files['name'] as $key => $filename) {
					$_FILES['file']['name'] = $files['name'][$key];
					$_FILES['file']['type'] = $files['type'][$key];
					$_FILES['file']['tmp_name'] = $files['tmp_name'][$key];
					$_FILES['file']['error'] = $files['error'][$key];
					$_FILES['file']['size'] = $files['size'][$key];
					$config['upload_path'] = $path;
					$config['allowed_types'] = $type;	
					$config['file_name'] = time() . '_' . $filename;
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
						$uploaded_images[$key] = $this->upload->data('file_name');
					} else {
						$uploaded_images[$key] = null;
					}
				}
				foreach ($_POST['testimonal_heading'] as $index => $heading) {
					$testimonial['testimonials'][] = [
						'heading' => $heading,
						'image' => $uploaded_images[$index] ?? null,
						'content' => $_POST['testimonal_content'][$index],
						'name' => $_POST['testimonal_name'][$index],
						'profession' => $_POST['testimonal_profession'][$index]
					];
				}
				$data["testimonials"] = json_encode($testimonial);
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
			
	
		}elseif($tag == 'add_blogs'){
			// print_r($this->input->post());die;	
			$blog = array(
				"blog_heading"=>$this->input->post("blog_heading"),
				'blog_select' => json_encode($this->input->post('blogs'))
			);
			$data['blogs'] = json_encode($blog);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$blogs = $page[0]->blogs;
			if(!empty($blogs) && $blogs !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
			
	
		}elseif($tag == 'add_about'){
			$about = array(
				"about_heading"=>$this->input->post("about_heading"),
				"about_content"=>$this->input->post("about_content"),
				"about_btn_url"=>$this->input->post("about_btn_url"),
			);
			$data['about'] = json_encode($about);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$about = $page[0]->about;
			if(!empty($about) && $about !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}
		}elseif($tag == 'add_ap'){
			$audience_profile = array(
				"ap_heading"=>$this->input->post("ap_heading"),
				"ap_content"=>$this->input->post("ap_content"),
				"ap_btn_url"=>$this->input->post("ap_btn_url"),
			);
			$data['audience_profile'] = json_encode($audience_profile);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$audience_profile = $page[0]->audience_profile;
			if(!empty($audience_profile) && $audience_profile !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}
		}elseif($tag == 'add_pd'){
			$program_deliveriables = array(
				"pd_heading"=>$this->input->post("pd_heading"),
				"pd_content"=>$this->input->post("pd_content"),
				"pd_btn_url"=>$this->input->post("pd_btn_url"),
			);
			$data['program_deliveriables'] = json_encode($program_deliveriables);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$program_deliveriables = $page[0]->program_deliveriables;
			if(!empty($program_deliveriables) && $program_deliveriables !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}
		}elseif($tag == 'add_co'){
			$course_outline = array(
				"co_heading"=>$this->input->post("co_heading"),
				"co_content"=>$this->input->post("co_content"),
				"co_btn_url"=>$this->input->post("co_btn_url"),
			);
			$data['course_outline'] = json_encode($course_outline);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$course_outline = $page[0]->course_outline;
			if(!empty($course_outline) && $course_outline !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}
		}elseif($tag == 'add_po'){
			$program_outcomes = array(
				"po_heading"=>$this->input->post("po_heading"),
				"po_content"=>$this->input->post("po_content"),
				"po_btn_url"=>$this->input->post("po_btn_url"),
			);
			$data['program_outcomes'] = json_encode($program_outcomes);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$program_outcomes = $page[0]->program_outcomes;
			if(!empty($program_outcomes) && $program_outcomes !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}
		}elseif($tag == 'add_related_course'){
			// print_r($this->input->post());die;	
			$course = array(
				"related_course_heading"=>$this->input->post("related_course_heading"),
				'course_select' => json_encode($this->input->post('courses'))
			);
			$data['related_course'] = json_encode($course);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$related_course = $page[0]->related_course;
			if(!empty($related_course) && $related_course !='null'){
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}else{
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "course page has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update course page . Please try again later."];
				}
			}
			
	
		}elseif($tag == 'add_faq'){
			$faq = array(
				"faq_heading"=>$this->input->post('faq_heading'),
				'faqs' => []
			);
			$page = $this->admin_model->getData($db,['id'=>$id]);
			if(!$page){
				$response = ["status" => "post_error","message" =>"Please add Page title"];
				echo json_encode($response);
				exit;
			}
			$faqs = $page[0]->faqs;
			if(!empty($faqs) && $faqs !='null'){
				// $existing_FAQs = json_decode($page[0]->FAQs, true) ?? [];
				foreach ($_POST['FAQ_Q'] as $index => $question) {
					$faq['faqs'][] = [
						'question' => $question,
						'answer' => $_POST['FAQ_A'][$index] ?? ''
					];
				}
				$data['FAQs'] = json_encode($faq);
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}else{
				foreach ($_POST['FAQ_Q'] as $index => $question) {
					$faq['faqs'][] = [
						'question' => $question,
						'answer' => $_POST['FAQ_A'][$index] ?? ''
					];
				}
				$data['FAQs'] = json_encode($faq);
				$data['updated_at'] = $date;
				$updated = $this->admin_model->update_entry($db, $data, ['id' => $id]);
				if ($updated) {
					$response = ["status" => "post_success","message" => "$name has been updated successfully."];
				} else {
					$response = ["status" => "post_error","message" => "Failed to update $name . Please try again later."];
				}
			}
		}
		echo json_encode($response);
		exit;
	}
	public function category_list(){	
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		$table = 'categories';
		$list = 'categoryList';
		$title = 'Category List';
		$search_criteria = $search_criteria_or = array();
		$serach_query = trim($this->input->get('serach-query', TRUE));
		$status = $this->input->get('status', TRUE);
		$from = $this->input->get('date_from', TRUE);
		$to = $this->input->get('date_to', TRUE);
		if (!isset($from) && !isset($to) && !isset($serach_query) && !isset($status) && empty($status) && empty($serach_query) && empty($from) && empty($to)) {
		}
		$serach_query = (isset($serach_query) && $serach_query != '') ? $serach_query : "";
		$status = (isset($status) && $status != '') ? $status : "";
		$from = (isset($from) && $from != '') ? $from : "";
		$to = (isset($to) && $to != '') ? $to : "";
		if (isset($from) && !empty($from) && $from != '') {
			$from = date("Y-m-d", strtotime($from));
			$search_criteria['DATE('.$table.'.created_at) >='] = $from;
		}
		if (isset($to) && !empty($to) && $to != '') {
			$to = date("Y-m-d", strtotime($to));
			$search_criteria['DATE('.$table.'.created_at) <='] = $to;
		}
		if (isset($status) && $status != '') {
			$search_criteria[''.$table.'.status ='] = $status;
		}
		if (isset($serach_query) && $serach_query != '') {
			$search_criteria[''.$table.'.page_title LIKE'] = '%' . $serach_query . '%';
		}
		$data[$list] = $this->admin_model->getData($table,$search_criteria);
		$data['title'] = $title;
		$this->load->view('Admin/include/header', $data);
		$this->load->view('Admin/include/left-menu', $data);
		$this->load->view('Admin/category-list', $data);
		$this->load->view('Admin/include/footer');
	}
	public function manage_category($post_id =null){
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		if($post_id != null){
			$data['post_id'] = $post_id;
			$postDetails = $this->admin_model->getData('categories',["id"=>$post_id]);
			if(empty($postDetails)){
				redirect(base_url() . 'admin');
			}

		}
		$data['blogList'] = $this->admin_model->getData('blogs');
		$data['categoryList'] = $this->admin_model->getCategories();
		$data['title'] = "Category Page";
		$this->load->view('Admin/include/header', $data);
		$this->load->view('Admin/include/left-menu', $data);
		$this->load->view('Admin/add-category', $data);
		$this->load->view('Admin/include/footer');
	}
	public function manage_course($post_id =null){
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		if($post_id != null){
			$data['post_id'] = $post_id;
			$postDetails = $this->admin_model->getData('courses',["id"=>$post_id]);
			if(empty($postDetails)){
				redirect(base_url() . 'admin');
			}

		}
		$data['courseList'] = $this->admin_model->getCoursewithdetails();
		$data['categoryList'] = $this->admin_model->getCategories();
		// echo '<pre>';
		// print_r($data['categoryList']);die;
		$data['title'] = "Course Page";
		$this->load->view('Admin/include/header', $data);
		$this->load->view('Admin/include/left-menu', $data);
		$this->load->view('Admin/add-course', $data);
		$this->load->view('Admin/include/footer');
	}
	public function post_status(){
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		if ($this->input->method() === 'get') {
			$do = trim($this->input->get('do', TRUE));
			$post_id = trim($this->input->get('post_id', TRUE));
			switch ($do) {
				case 'pending':
					$update_data = array(
						'status' => 1
					);
					$where_conditions = array("id" => $post_id);
					$last_inserted_id = $this->admin_model->update_entry('pages', $update_data, $where_conditions);
					break;
				case 'publish':
					$update_data = array(
						'status' => 2
					);
					$where_conditions = array("id" => $post_id);
					$last_inserted_id = $this->admin_model->update_entry('pages', $update_data, $where_conditions);
					break;
				case 'draft':
					$update_data = array(
						'status' => 3
					);
					$where_conditions = array("id" => $post_id);
					$last_inserted_id = $this->admin_model->update_entry('pages', $update_data, $where_conditions);
					break;
			}

			$this->session->set_flashdata('post_success', 'Post Status has been changed successfully.');
			if ($this->agent->referrer()) {
				//redirect to some function
				redirect($this->agent->referrer());
			} else {
				redirect("admin/posts_list");
			}
		}
	}
	public function blogs_list(){	
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		$search_criteria = $search_criteria_or = array();
		$serach_query = trim($this->input->get('serach-query', TRUE));
		$status = $this->input->get('status', TRUE);
		$from = $this->input->get('date_from', TRUE);
		$to = $this->input->get('date_to', TRUE);
		if (!isset($from) && !isset($to) && !isset($serach_query) && !isset($status) && empty($status) && empty($serach_query) && empty($from) && empty($to)) {
		}
		$serach_query = (isset($serach_query) && $serach_query != '') ? $serach_query : "";
		$status = (isset($status) && $status != '') ? $status : "";
		$from = (isset($from) && $from != '') ? $from : "";
		$to = (isset($to) && $to != '') ? $to : "";
		if (isset($from) && !empty($from) && $from != '') {
			$from = date("Y-m-d", strtotime($from));
			$search_criteria['DATE(blogs.created_at) >='] = $from;
		}
		if (isset($to) && !empty($to) && $to != '') {
			$to = date("Y-m-d", strtotime($to));
			$search_criteria['DATE(blogs.created_at) <='] = $to;
		}
		if (isset($status) && $status != '') {
			$search_criteria['blogs.status ='] = $status;
		}
		if (isset($serach_query) && $serach_query != '') {
			$search_criteria['blogs.blog_title LIKE'] = '%' . $serach_query . '%';
		}
		$data['blogsList'] = $this->admin_model->getData('blogs',$search_criteria);
		$data['title'] = 'Blogs List';
		$this->load->view('Admin/include/header', $data);
		$this->load->view('Admin/include/left-menu', $data);
		$this->load->view('Admin/blogs-list', $data);
		$this->load->view('Admin/include/footer');
	}
	public function add_blog() {
		if (!$this->admin_model->check_logged()) {
			redirect(base_url() . 'admin');
		}
		$redirect = 'admin/blogs_list';
		$db = 'blogs';
		$name = "Manage Blogs";
		$date = date("Y-m-d H:i:s");
		$action = $this->input->post('action', TRUE);
	
		if ($action === 'deleteBlog') {
			$post_id = $this->input->post('post_id');
			if (empty($post_id)) {
				$this->session->set_flashdata('post_error', "Invalid request. $name ID is missing.");
				redirect($redirect);
			}

			$deleted = $this->admin_model->deleteWithWhereConditions($db, ['id' => $post_id]);
			if ($deleted) {
				$this->session->set_flashdata('post_success', "$name has been deleted successfully.");
			} else {
				log_message('error', "Failed to delete $name with ID: $post_id");
				$this->session->set_flashdata('post_error', "Failed to delete $name. Please try again later.");
			}
			redirect($redirect);
		}
		if ($action === 'addBlog' || $action === 'editBlog') {
			$this->form_validation->set_rules('blog_title', 'Blog Title', 'required');
			$this->form_validation->set_rules('slug', 'Blog URL Last Path', 'required');
			$this->form_validation->set_rules('blog_description', 'Blog Description', 'required');
			$this->form_validation->set_rules('status', 'Blog Status', 'required');
			$this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
		}
		$data = [
			'blog_title' => $this->input->post('blog_title'),
			'slug' => $this->input->post('slug'),
			'blog_description' => $this->input->post('blog_description'),
			'status' => $this->input->post('status'),
			'date' => $this->input->post('date'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country')
		];

		$path = 'uploads/blog_images/';
		$type = '*';
		$size = 2048;
		if ($action === 'addBlog') {
			// print_r($_FILES);die;		
			if (!empty($_FILES['blog_img']['name'])) {
				$data['blog_image'] = $this->upload_img('blog_img',$path,$type,$size,$redirect);
			}
			$data['created_at'] = $date;
			// print_r($data);die;		

			$inserted_id = $this->admin_model->addData($db, $data);
			if ($inserted_id) {
				$this->session->set_flashdata('post_success', "$name has been added successfully.");
			} else {
				$this->session->set_flashdata('post_error', "Failed to add $name. Please try again later.");
			}
		} elseif ($action === 'editBlog') {
			$post_id = $this->input->post('id', TRUE);
			if (empty($post_id)) {
				$this->session->set_flashdata('post_error', "$name not found.");
				redirect($redirect);
			}
			$blogs = $this->admin_model->getData($db,['id'=>$post_id]);
			// print_r($_FILES);die;		
			if (!empty($_FILES['blog_img']['name'])) {
				$data['blog_image'] = $this->upload_img('blog_img',$path,$type,$size,$redirect);
			}else{
				$data['blog_image'] = $blogs[0]->blog_image;
			}
			$data['updated_at'] = $date;
			$updated = $this->admin_model->update_entry($db, $data, ['id' => $post_id]);
			if ($updated) {
				$this->session->set_flashdata('post_success', "$name has been updated successfully.");
			} else {
				$this->session->set_flashdata('post_error', "Failed to update $name. Please try again later.");
			}
		}
	
		redirect($redirect);
	}
	public function courses_list(){	
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}
		$table = 'courses';
		$list = 'courseList';
		$title = 'Course List';
		$search_criteria = $search_criteria_or = array();
		$serach_query = trim($this->input->get('serach-query', TRUE));
		$status = $this->input->get('status', TRUE);
		$from = $this->input->get('date_from', TRUE);
		$to = $this->input->get('date_to', TRUE);
		if (!isset($from) && !isset($to) && !isset($serach_query) && !isset($status) && empty($status) && empty($serach_query) && empty($from) && empty($to)) {
		}
		$serach_query = (isset($serach_query) && $serach_query != '') ? $serach_query : "";
		$status = (isset($status) && $status != '') ? $status : "";
		$from = (isset($from) && $from != '') ? $from : "";
		$to = (isset($to) && $to != '') ? $to : "";
		if (isset($from) && !empty($from) && $from != '') {
			$from = date("Y-m-d", strtotime($from));
			$search_criteria['DATE('.$table.'.created_at) >='] = $from;
		}
		if (isset($to) && !empty($to) && $to != '') {
			$to = date("Y-m-d", strtotime($to));
			$search_criteria['DATE('.$table.'.created_at) <='] = $to;
		}
		if (isset($status) && $status != '') {
			$search_criteria[''.$table.'.status ='] = $status;
		}
		if (isset($serach_query) && $serach_query != '') {
			$search_criteria[''.$table.'.page_title LIKE'] = '%' . $serach_query . '%';
		}
		$data[$list] = $this->admin_model->getData($table,$search_criteria);
		$data['title'] = $title;
		$this->load->view('Admin/include/header', $data);
		$this->load->view('Admin/include/left-menu', $data);
		$this->load->view('Admin/courses-list', $data);
		$this->load->view('Admin/include/footer');
	}
	public function delete_image(){
		if ($this->admin_model->check_logged() === false) {
			redirect(base_url() . 'admin');
		}

		if ($this->input->is_ajax_request()) {
			$id         = $this->input->post('id');
			$tag        = $this->input->post('tag'); // e.g., "home"
			$image_name = $this->input->post('image_name'); // e.g., "solution_img1"
			$dbName     = $this->input->post('dbName'); // e.g., "solutions"

			$table = '';
			if ($tag == "home") {
				$table = 'home_page';
			}elseif ($tag == "category") {
				$table = 'categories';
			}elseif ($tag == "course") {
				$table = 'courses';
			}elseif ($tag == "blog") {
				$data = [
					'blog_image' => ''
				];

				$query = $this->db->get_where('blogs', ['id' => $id]);
				if ($query->num_rows() == 0) {
					echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
					die;
				}
				$this->db->where('id', $id);
				$this->db->update('blogs', $data);
				if ($this->db->affected_rows() > 0) {
					echo json_encode(['status' => 'success','message'=> 'Blog has been updated!!']);
				} else {
					echo json_encode(['status' => 'failed', 'message' => 'No rows affected']);
				}
				die;
			}

			if ($table && $id && $image_name && $dbName) {
				// 1. Get the current row
				$this->db->where('id', $id);
				$row = $this->db->get($table)->row();

				if ($row) {
					// 2. Decode the JSON column
					$data = json_decode($row->$dbName, true);

					// 3. Update the target image field
					if (isset($data[$image_name])) {
						$data[$image_name] = ""; // Clear the image
					}

					// 4. Encode it back
					$updatedJson = json_encode($data);

					// 5. Save to DB
					$this->db->where('id', $id);
					$updated = $this->db->update($table, [
						$dbName => $updatedJson
					]);

					if ($updated) {
						echo json_encode(['status' => 'success']);
					} else {
						echo json_encode(['status' => 'db_update_failed']);
					}
				} else {
					echo json_encode(['status' => 'not_found']);
				}
			} else {
				echo json_encode(['status' => 'invalid_params']);
			}
		}
	}

}