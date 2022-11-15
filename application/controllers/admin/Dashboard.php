<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends My_Controller {

	

	public function __construct() {            

		parent::__construct();
		

		if( $this->user == false ||  $this->user->group_id != 1 ) {

			redirect('admin/login');

		}

	}

	

	public function index() {

		

		$this->data['page_title'] = 'Dashboard';                           

		$this->data['menu'] = 'dashboard';       

		$this->data['submenu'] = '';      

		

		$this->load->view( 'admin/templates/header', $this->data );

		$this->load->view( 'admin/dashboard/index', $this->data );

		$this->load->view( 'admin/templates/footer', $this->data );

	}

}