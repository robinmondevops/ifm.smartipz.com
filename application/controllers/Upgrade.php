<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade extends My_Controller {

	

	public function __construct() {            

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   
	}

	public function general() {


		$this->data['css_files'] = array(

		);

		$this->data['js_files'] = array(

			base_url('assets/pages/js/general.js'),
		);

        $hashSequence =
            'key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||salt';
        $hash = hash("sha512", $hashSequence);

        $this->data['page_title'] = 'Upgrade';
        $this->data['menu'] = 'upgrade';
        $this->data['submenu'] = '';


		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'popup/general', $this->data );
		$this->load->view( 'templates/footer', $this->data );

	}

}