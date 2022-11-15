<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class District extends My_Controller {

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

		$this->data['page_title'] = 'District';
		$this->data['menu'] = 'district';
		$this->data['submenu'] = 'list';

		$join_left = array(
			'state s'=>'s.id=d.state_id',
		); 
		
		$this->data["result"] = $this->common->get_all('district d', '', 'd.*,s.name state_name', '', '', '', $join_left);

		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/district/index',$this->data);
		$this->load->view('admin/templates/footer',$this->data);

	}

	public function create() {

		if( !in_array( $this->session->userdata('group_id'), array(1)) ) {
			redirect('dashboard');
		}

		$this->data['page_title'] = 'New District';
		$this->data['menu'] = 'district';
		$this->data['submenu'] = 'add';
		$this->data['action'] = 'add';

		$this->data['arr_state'] = $this->common->get_all('state');

		$this->data['row'] = array(
			'name'=>'',
			'state_id'=>'',
		);

		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('state_id', 'State', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($_POST) {

			if( $this->form_validation->run() == false ){

				$this->data['row'] = array_merge( $this->data['row'], $_POST );

			} else {

				$data_arr = array(

					'name' => trim($this->input->post('name')),
					'state_id' => trim($this->input->post('state_id')),
 				);

				$id = $this->common->insert( 'district', $data_arr );

				$this->session->set_flashdata('msg','Saved!');
				redirect('admin/district/');
			}

		}
		
		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/district/form',$this->data);
		$this->load->view('admin/templates/footer',$this->data);

	}



	function edit( $district_id = 0) {

		if( !in_array( $this->session->userdata('group_id'), array(1)) ) {
			redirect('admin/dashboard');
		}

		if( $district_id == '0' ) {
			redirect('admin/dashboard');
		}

		$id = decrypt($district_id)*1;

		if( !is_int($id) || !$id ) {
			redirect('admin/dashboard');
		}

		$this->data['page_title'] = 'Edit District';
		$this->data['menu'] = 'district';
		$this->data['submenu'] = 'add';
		$this->data['action'] = 'edit';

		$this->data['arr_state'] = $this->common->get_all('state');

		$row = $this->common->get('district', array( 'id' => $id ), 'array');

		if( count($row) == 0 ) {

			redirect('admin/dashboard');

		}

		$this->data['row'] = $row;

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('state_id', 'State', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


		if($_POST) {

			if( $this->form_validation->run() == false ){

				$this->data['row'] = array_merge( $this->data['row'], $_POST );

			} else {

				$data_arr = array(

					'name' => trim($this->input->post('name')),
					'state_id' => trim($this->input->post('state_id')),
				);

				$this->common->update('district',$data_arr, array('id' => $id ));
				$this->session->set_flashdata('msg','Saved!');

				redirect('admin/district/');  

			}

		}

		$this->load->view('admin/templates/header',$this->data);
		$this->load->view('admin/district/edit_form',$this->data);
		$this->load->view('admin/templates/footer',$this->data);

	}



	public function delete( $district_salt_id = 0 ) {

		
		if( $district_salt_id == '0' ) {
			redirect('admin/dashboard');
		}

		$district_id = decrypt($district_salt_id)*1;

		if( !is_int($district_id) || !$district_id ) {
			redirect('admin/dashboard');
		}

		$this->common->delete( 'district', array( 'id' =>  $district_id ) );
		$this->session->set_flashdata('msg','District deleted successfully');
		redirect('admin/district');

	}
	

	

}