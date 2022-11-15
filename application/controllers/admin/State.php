<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class State extends My_Controller {

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

		$this->data['page_title'] = 'State';
		$this->data['menu'] = 'state';
		$this->data['submenu'] = 'list';
		

		$this->data["result"] = $this->common->get_all('state');

		
		

		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/state/index',$this->data);
		$this->load->view('admin/templates/footer',$this->data);

	}

	

	public function create() {

		

		if( !in_array( $this->session->userdata('group_id'), array(1)) ) {

			redirect('dashboard');

		}



		$this->data['page_title'] = 'New State';
		$this->data['menu'] = 'state';
		$this->data['submenu'] = 'add';
		$this->data['action'] = 'add';

		

		$this->data['row'] = array(

			'name'=>'',

		);

		

		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		

		if($_POST) {

			if( $this->form_validation->run() == false ){

				$this->data['row'] = array_merge( $this->data['row'], $_POST );

			} else {

				$data_arr = array(

					'name' => trim($this->input->post('name')),

				);

				$id = $this->common->insert( 'state', $data_arr );

				$this->session->set_flashdata('msg','Saved!');

				redirect('admin/state/');

			}

		}

		

		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/state/form',$this->data);
		$this->load->view('admin/templates/footer',$this->data);

	}



	function edit( $state_id = 0) {

		

		if( !in_array( $this->session->userdata('group_id'), array(1)) ) {

			redirect('admin/dashboard');

		}

		

		if( $state_id == '0' ) {

			redirect('admin/dashboard');

		}

		

		$id = decrypt($state_id)*1;

		if( !is_int($id) || !$id ) {

			redirect('admin/dashboard');

		}



		$this->data['page_title'] = 'Edit State';
		$this->data['menu'] = 'state';
		$this->data['submenu'] = 'add';
		$this->data['action'] = 'edit';

		$row = $this->common->get('state', array( 'id' => $id ), 'array');

		if( count($row) == 0 ) {

			redirect('admin/dashboard');

		}

		$this->data['row'] = $row;

		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


		if($_POST) {

			if( $this->form_validation->run() == false ){

				$this->data['row'] = array_merge( $this->data['row'], $_POST );

			} else {

				

				$data_arr = array(

					'name'=> trim($this->input->post('name')),

				);

				

				$this->common->update('state',$data_arr, array('id' => $id ));

				$this->session->set_flashdata('msg','Saved!');

				redirect('admin/state/');  

			}

		}



		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/state/edit_form',$this->data);
		$this->load->view('admin/templates/footer',$this->data);

	}



	public function delete( $state_salt_id = 0 ) {

		

		if( $state_salt_id == '0' ) {

			redirect('admin/dashboard');

		}

		$state_id = decrypt($state_salt_id)*1;

		if( !is_int($state_id) || !$state_id ) {

			redirect('admin/dashboard');

		}

		

		$this->common->delete( 'state', array( 'id' =>  $state_id ) );

		$this->session->set_flashdata('msg','State deleted successfully');

		redirect('admin/state');

	}
	

	

}