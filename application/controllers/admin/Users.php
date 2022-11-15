<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends My_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->session->userdata('logged_in') ) {
			redirect('login');
		}
		$this->common->check_user_exists();
	}

	public function index() {
		
		if( !in_array( $this->session->userdata('group_id'), array(1)) ) {
			redirect('admin/dashboard');
		}

		$this->data['page_title'] = 'Users';
		$this->data['menu'] = 'admin';
		$this->data['menu_level_two'] = 'users';

		$this->data['submenu'] = 'list';

		$this->data['css_files'] = array(
			base_url('assets/global/plugins/datatables/datatables.min.css'),
			base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
			base_url('assets/global/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css'),
		);
		$this->data['js_files'] = array(
			base_url('assets/global/scripts/datatable.js'),
			base_url('assets/global/plugins/datatables/datatables.min.js'),
			base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
			base_url('assets/global/plugins/datetimepicker/moment/min/moment.min.js'),
			base_url('assets/global/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js'),
			base_url('assets/pages/js/users.js?ver=1.0.1'),  
		);
		
		
		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/users/index',$this->data);
		$this->load->view('admin/templates/footer',$this->data);  

	}

	function get_all()
	{


		$keyword = '';
		if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ) {
			$keyword = $_REQUEST['search']['value'];  
		}

		$join_arr_left = array();


		$condition = '1=1 AND t.deleted = 0 ';
		if( $keyword != '' ) {
			$condition .= ' AND (t.first_name LIKE "%'.$keyword.'%" OR t.last_name LIKE "%'.$keyword.'%" OR t.email LIKE "%'.$keyword.'%")';
		}

		if( isset($_REQUEST['name']) && $_REQUEST['name'] ) {
			$condition .= ' AND ( t.first_name LIKE "%'.$_REQUEST['name'].'%" OR t.last_name LIKE "%'.$_REQUEST['name'].'%" )';
		}

		if( isset($_REQUEST['email']) && $_REQUEST['email'] ) {
			$condition .= ' AND t.email LIKE "%'.$_REQUEST['email'].'%"';
		}

		if( isset($_REQUEST['group_id']) && $_REQUEST['group_id'] ) {
			$condition .= ' AND t.group_id = "'.$_REQUEST['group_id'].'"';
		}

		if( isset($_REQUEST['is_active']) && $_REQUEST['is_active'] ) {
			$condition .= ' AND t.is_active = "'.$_REQUEST['is_active'].'"';
		}

		if( isset($_REQUEST['created_at']) && $_REQUEST['created_at'] ) {
			$bDate = new DateTime( $_REQUEST['created_at'] );
			$created_at = $bDate->format('Y-m-d');
			$condition .= ' AND DATE_FORMAT(`t`.`created_at`,"%Y-%m-%d") = "'.$created_at.'"';

		}


		$iTotalRecords = $this->common->get_total_count( 'users t', $condition, $join_arr_left );

		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array();

		$limit = $iDisplayLength;
		$offset = $iDisplayStart;

		$columns = array(
			1 => 'first_name',
			2 => 'email',
			3 => 'group_id',
			4 => 'is_active',
			5 => 'created_at',
		);

		$order_by = $columns[$_REQUEST['order'][0]['column']];  
		$order = $_REQUEST['order'][0]['dir'];
		$sort = $order_by.' '.$order;

		$result = $this->common->get_all( 'users t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

		//echo $this->db->last_query(); exit;

		foreach( $result as $row ) {

			if( $row->image && file_exists( getcwd().'/files/profile/'.$row->id.'/'.$row->image) ){
                $image = '<img class="user-pic rounded" src="'.base_url('files/profile/'.$row->id.'/'.$row->image).'" width="28">';
            } else {
                $image = '<img class="user-pic rounded" src="'.base_url('assets/layouts/layout/img/avatar.png').'" width="28">';
            }

            /*if ( $row->invite_key ) { 
             	
             	$actions = '<div class="center-block"><a href="'.site_url('admin/users/edit/'.encrypt($row->id)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a><a href="javascript:;" class="user-delete"  data-url="'.site_url('admin/users/delete/'.encrypt($row->id)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a><a title="Re-invite" href="javascript:;" class="user-reinvite"  data-url="'.site_url('admin/users/reinvite/'.encrypt($row->id)).'" ><i class="fa fa-users"></a></div>';
           	} else {
           		$actions =  '<div class="center-block"><a href="'.site_url('admin/users/edit/'.encrypt($row->id)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a><a href="javascript:;" class="user-delete"  data-url="'.site_url('admin/users/delete/'.encrypt($row->id)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>';
           	}*/

           	$actions =  '<div class="center-block">
           	<a href="'.site_url('admin/users/edit/'.encrypt($row->id)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>
           	<a href="javascript:;" class="user-delete"  data-url="'.site_url('admin/users/delete/'.encrypt($row->id)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>';

            

			$records["data"][] = array(
				$image,
				$row->first_name.' '.$row->last_name,
				'<a href="mailto:'.$row->email.'">'.$row->email.'</a>',
				get_user_type($row->group_id),
				get_user_status($row->is_active),
				date('M d, Y', strtotime($row->created_at)),
				$actions,
			);
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		header('Content-type: application/json');
		echo json_encode($records);
	}

	function profile() {

		$this->data['page_title'] = 'Edit My Profle';
		$this->data['menu'] = 'admin';
		$this->data['submenu'] = 'profile';

		$this->data['css_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
			base_url('assets/pages/js/jquery.sparkline.min.js'),
			base_url('assets/pages/js/profile.min.js'),
		);  
		
		
		$row = $this->common->get('users', array( 'id' => $this->session->userdata('user_id') ), 'array', '' );
		
		$row['new_password'] = '';
		$row['retype_new_password'] = '';
		$this->data['row'] = $row;
		$this->data['tab'] = 'personal';
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($_POST) {

			if ( isset($_POST['personal_info']) ) {
				$this->data['tab'] = 'personal';
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check['.$this->session->userdata('user_id').']');
				$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
				$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
				$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');

				if( $this->form_validation->run() == false ){
					
					$this->data['row'] = array_merge( $this->data['row'], $_POST );
					
				} else {
					
					$data_arr = array(
						'email'=> trim($this->input->post('email')),
						'first_name'=> trim($this->input->post('first_name')),
						'last_name' => trim($this->input->post('last_name')),
						'phone' => trim($this->input->post('phone')),
					);

					$this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));
					
					$this->session->set_flashdata('msg','Personal informations updated successfully!');
					redirect('admin/users/profile');
				}

			} else if ( isset($_POST['profile_pic']) ) {

				$this->data['tab'] = 'profile_pic';
				$config['upload_path'] = './files/profile/';
				$config['encrypt_name'] = TRUE;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';

				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('image') ){ 
					$data = array('upload_data' => $this->upload->data());
					$data_arr['image'] = $data['upload_data']['file_name'];

					if( !file_exists( getcwd().'/files/profile/'.$this->session->userdata('user_id') ) ) {
						mkdir( getcwd().'/files/profile/'.$this->session->userdata('user_id') );
					}

					rename( getcwd().'/files/profile/'.$data['upload_data']['file_name'], getcwd().'/files/profile/'.$this->session->userdata('user_id').'/'.$data['upload_data']['file_name'] );

					$old_path = $new_path = getcwd().'/files/profile/'.$this->session->userdata('user_id').'/'.$data['upload_data']['file_name'];
					$this->image_thumb( $old_path, $new_path );

					$this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));
					$this->session->set_flashdata('msg','Profile picture updated successfully!');
					redirect('admin/users/profile');  

				} else {

					 $error = array('error' => $this->upload->display_errors());
					 foreach ($error as  $flashdata_error) {
					 	$this->session->set_flashdata('error_msg',$flashdata_error);
					 }
				}

			} else if ( isset($_POST['user_password']) ) {
				$this->data['tab'] = 'password';
				$this->form_validation->set_rules('new_password', 'New password', 'trim|required');
				$this->form_validation->set_rules('retype_new_password', 'Retype new password', 'trim|required');

				if( $this->form_validation->run() == false ){
					$this->data['row'] = array_merge( $this->data['row'], $_POST );
				} else {

					$new_password = md5($this->config->item('encryption_key').trim($this->input->post('new_password')));
					$retype_new_password = md5($this->config->item('encryption_key').trim($this->input->post('retype_new_password')));

					if ( $new_password != $retype_new_password ){
						$this->session->set_flashdata('error_msg','Passwords are not matching!');
					} else { 

						$data_arr['password'] =  $new_password;
						$this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));

						$params = array(
							'name' => $row['first_name'].' '.$row['last_name'],
							'site_name' => $this->data['core_settings']->site_name,
							'site_email' => $this->data['core_settings']->email,
						);
						send_mail('password-changed', $this->session->userdata('user_id'), $params);

						$this->session->set_flashdata('msg','Password updated successfully!');
						redirect('admin/users/profile');   
					}
				}
			} 
		}

		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/users/profile',$this->data);
		$this->load->view('admin/templates/footer',$this->data);

	}

	public function create() {

		if( !in_array( $this->session->userdata('group_id'), array(1)) ) {
			redirect('admin/dashboard');
		}

		$this->data['page_title'] = 'New User';
		$this->data['menu'] = 'admin';
		$this->data['menu_level_two'] = 'users';
		$this->data['submenu'] = 'add';
		$this->data['action'] = 'add';
		
		$this->data['js_files'] = array(
			base_url('assets/pages/js/users.js?ver=1.0.0'),
		); 

		$this->data['row'] = array(
			'group_id'=>'',
			'email'=>'',
			'password'=>'',
			'first_name'=>'',
			'last_name' => '',
			'phone'=>'',
			'is_active' => 0,
			'image' => '',
		);

		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',  array('is_unique' => 'This email is already being used by someone.'));
		$this->form_validation->set_rules('group_id', 'User Type', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');       

		if($_POST) {
			
			if(  in_array( $this->input->post('group_id'), array(2, 3) ) ) {
				$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			}

			if(  in_array( $this->input->post('group_id'), array(3) ) ) {
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
			}

			if( $this->form_validation->run() == false ){
				$this->data['row'] = array_merge( $this->data['row'], $_POST );
			} else {

				$key = random_string();

				$data_arr = array(
					'group_id' => trim($this->input->post('group_id')),
					'email'=> trim($this->input->post('email')),
					'first_name'=> trim($this->input->post('first_name')),
					'last_name' => trim($this->input->post('last_name')),
					'created_at' => date('Y-m-d H:i:s'),
					'invite_key' => $key,
					'is_active' => 2,
					'phone' => trim($this->input->post('phone')),
				);
				$is_active = 2;
				if(isset($_POST['is_active']))
					$is_active = 1;
				$data_arr['is_active'] = $is_active; 
				
				

				$id = $this->common->insert( 'users', $data_arr );
				
				$config['upload_path'] = './files/profile/';
				$config['encrypt_name'] = TRUE;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';

				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('image') ){ 
					$image = '';
					$data = array('upload_data' => $this->upload->data());
					$image = $data['upload_data']['file_name'];
					if( !file_exists( getcwd().'/files/profile/'.$id ) ) {
						mkdir( getcwd().'/files/profile/'.$id );
					}

					rename( getcwd().'/files/profile/'.$data['upload_data']['file_name'], getcwd().'/files/profile/'.$id.'/'.$data['upload_data']['file_name'] );
					$old_path = $new_path = getcwd().'/files/profile/'.$id.'/'.$data['upload_data']['file_name'];
					$this->image_thumb( $old_path, $new_path );
					
					$this->common->update('users',array('image' => $image), array('id' => $id ));
				} 
				

				$click_here = '<a href="'.site_url('admin/set_password/'.$key).'" target="_blank">'.site_url('admin/set_password/'.$key).' </a>'; 
				$params = array(
					'name' => trim($this->input->post('first_name')).' '.trim($this->input->post('last_name')),
					'invite-url' => $click_here,
					'site_name' => $this->data['core_settings']->site_name,
					'site_email' => $this->data['core_settings']->email,
				);
				send_mail('invite-user', $id, $params);

				$this->session->set_flashdata('msg','Saved!');
				if( isset($_POST['invite_close']) ) {
					redirect('admin/users');
				} else {
					redirect('admin/users/edit/'.encrypt($id));
				}
			}
		}

		$this->load->view('admin/templates/header', $this->data);
		$this->load->view('admin/users/form', $this->data);
		$this->load->view('admin/templates/footer', $this->data);

	}

	function edit( $user_salt_id = 0) {

		$this->data['js_files'] = array(
			base_url('assets/pages/js/users.js?ver=1.0.0'),
		); 

		if( !in_array( $this->session->userdata('group_id'), array(1)) ) {
			redirect('admin/dashboard');
		}

		if( $user_salt_id == '0' ) {
			redirect('admin/dashboard');
		}

		$id = decrypt($user_salt_id)*1;
		if( !is_int($id) || !$id ) {
			redirect('admin/dashboard');
		}

		$this->data['page_title'] = 'Edit User';
		$this->data['menu'] = 'admin';
		$this->data['menu_level_two'] = 'users';  
		$this->data['submenu'] = 'add';
		$this->data['action'] = 'edit'; 

		
		$row = $this->common->get('users', array( 'id' => $id ), 'array', '' );

		if( count($row) == 0 ) {
			redirect('admin/dashboard');
		}

		$this->data['row'] = $row;
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check['.$id.']');
		$this->form_validation->set_rules('group_id', 'User Type', 'trim|required');
//		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($_POST) {
			

			if(  in_array( $this->input->post('group_id'), array(2) ) ) {
				$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			}


			

			if( $this->form_validation->run() == false ){

				$this->data['row'] = array_merge( $this->data['row'], $_POST );

			} else {

				$data_arr = array(
					'group_id' => trim($this->input->post('group_id')),
					'email'=> trim($this->input->post('email')),
					'first_name'=> trim($this->input->post('first_name')),
					'last_name' => trim($this->input->post('last_name')),
					'phone' => trim($this->input->post('phone')),
				);
				
				$is_active = 2;
				if(isset($_POST['is_active']))
					$is_active = 1;
				$data_arr['is_active'] = $is_active; 
				
				

				$config['upload_path'] = './files/profile/';
				$config['encrypt_name'] = TRUE;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';

				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('image') ){ 
					$data = array('upload_data' => $this->upload->data());
					$data_arr['image'] = $data['upload_data']['file_name'];
					if( !file_exists( getcwd().'/files/profile/'.$id ) ) {
						mkdir( getcwd().'/files/profile/'.$id );
					}

					rename( getcwd().'/files/profile/'.$data['upload_data']['file_name'], getcwd().'/files/profile/'.$id.'/'.$data['upload_data']['file_name'] );
					$old_path = $new_path = getcwd().'/files/profile/'.$id.'/'.$data['upload_data']['file_name'];
					$this->image_thumb( $old_path, $new_path );
				} 

				$this->common->update('users',$data_arr, array('id' => $id ));
				$this->session->set_flashdata('msg','Saved!');
				if( isset($_POST['save_close']) ) {
					redirect('admin/users');
				} else {
					redirect('admin/users/edit/'.encrypt($id));
				}
			}
		}

		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/users/form',$this->data);
		$this->load->view('admin/templates/footer',$this->data);
	}




	public function delete( $user_salt_id = 0 ) {

		if( $user_salt_id == '0' ) {
			
		}else {
			$user_id = decrypt($user_salt_id)*1;
			if( !is_int($user_id) || !$user_id ) {
				
			}else{
				$this->common->update( 'users', array('deleted' => 1), array( 'id' =>  $user_id ) );
			}
		}
	}

	public function email_check( $email, $id ) {

		$count = $this->common->get_total_count( 'users', array('lower(email)' => strtolower($email), 'id <>' => $id )); 
		if ( $count > 0 ){
			$this->form_validation->set_message('email_check', 'This email already exists, please try another one.');
			return FALSE;
		} else {
			return TRUE;
		}

	}

	public function image_thumb( $old_path = '', $new_path = '' ) {

		ini_set('memory_limit', '1024M'); 
        $pathinfo = pathinfo($old_path);
        $original = $old_path;
        if (!file_exists($original)) {
            show_404($original);
        }

        $width = 400; 
		$height = 400;
        // only continue with a valid width and height
        if ( $width >= 0 && $height >= 0) {
            // initialize library
            $config["source_image"] = $old_path;
            $config['new_image'] = $new_path;
            $config["width"] = $width;
            $config["height"] = $height;
            $config["dynamic_output"] = FALSE; // always save as cache
            $this->load->library('image_lib');
			$this->image_lib->initialize($config);
            $this->image_lib->fit();
			$this->image_lib->clear();
        }
	}     

	  

}