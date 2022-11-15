<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payresponse extends My_Controller {

	public function __construct() {            

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   
	}

	public function success() {

        $id = $this->session->userdata('user_id');
        $date = date('Y-m-d');
        $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($date)));

        $data_array = [
            'user_id'=>$id,
            'from_date'=>$date,
            'to_date'=>$effectiveDate,
        ];

        $this->common->delete( 'subscription', ['user_id'=>$id] );

        $this->common->insert( 'subscription', $data_array );

        $this->session->set_flashdata('msg','You have activated classic package, Now you can chat with your matches and contacts!');

        redirect('/');

	}

    public function fail() {

        $this->session->set_flashdata('error_msg','You Payment Failed . Please try again!');

        redirect('/');

    }

    public function cancel() {

        $this->session->set_flashdata('error_msg','You Have canceled your payment, please try again!');

        redirect('/');

    }

}