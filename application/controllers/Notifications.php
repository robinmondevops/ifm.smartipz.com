<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends My_Controller {

	

	public function __construct() {            
		parent::__construct();

		if( $this->user == false ) {
			redirect('login');
		}   

	}

	
	public function index(){

        $this->common->update('user_notification', ['status'=>1], [ 'notify_id'=>$this->user->id ] );


		$this->data['css_files'] = array(
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/pages/js/notifications.js'),            
		); 

		$this->data['page_title'] = 'Notifications';
		$this->data['menu'] = 'notifications';
		$this->data['submenu'] = '';

		$user_id = $this->session->userdata('user_id');

		$left_join = array(
			'users u'=>'u.id = f.notify_from',
		);

		$condition = array(
			'f.notify_id'=>$this->user->id,

		);

		$this->data['n_arr_request_list'] = $this->common->get_all('user_notification f', $condition,
            'f.*, u.first_name, u.last_name, u.image, u.id friend_id','id desc','','', $left_join );


		$this->load->view('templates/header', $this->data);
		$this->load->view('notifications/index', $this->data);   
		$this->load->view('templates/footer', $this->data);

	}   



}