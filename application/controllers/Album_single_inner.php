<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_single_inner extends My_Controller {
	

	public function __construct() {   



		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   

	}

	

	public function view( $album_id = 0 , $user_id = 0 ) {  

		$this->data['user'] = $this->common->get('users',array('id'=>$user_id ) ); 

		$this->data['css_files'] = array(
			base_url('assets/pages/css/profile.min.css'),
			base_url('assets/global/css/prettyPhoto.css')
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/global/scripts/jquery.prettyPhoto.js'),
			base_url('assets/pages/js/album_inner.js'),            
		); 

		$this->data['page_title'] = 'Photos';                           
		$this->data['menu'] = 'photos';       
		$this->data['submenu'] = '';

		$this->data['arr_album_pic'] = $this->common->get_all('album_image',array('album_id'=>$album_id ) ); 
		


		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'photos_single_inner/index', $this->data );
		$this->load->view( 'templates/footer', $this->data );

	} 



	


}