<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mailbox extends My_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->session->userdata('logged_in') ) {
			redirect('login');
		}
		$this->common->check_user_exists();
	}



	function index( $tab = '' ) {

		$this->data['page_title'] = 'Mailbox';
		$this->data['menu'] = 'mailbox';
		$this->data['submenu'] = 'mailbox';

		$this->data['css_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
			base_url('assets/pages/css/profile.min.css'),
            base_url('assets/global/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
			base_url('assets/global/plugins/image_crop/jquery.form.js'),   
			base_url('assets/pages/js/jquery.sparkline.min.js'),  
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/pages/js/edit_profile.js'),
            base_url('assets/global/plugins/datetimepicker/moment/min/moment.min.js'),
            base_url('assets/global/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js'),
            base_url('assets/pages/js/mailbox.js'),
            base_url('assets/pages/js/upgrade_pop.js'),
		);
		
		
		$row_users = $this->common->get('users', array( 'id' => $this->session->userdata('user_id') ), 'array', '' );



        if( $tab == ''){
            $tab = 'accepted';
        }



        $this->common->update('friends',
            ['seen'=>1 ], ['person_two'=>$this->user->id ] );


        //accepted

        $user_id = $this->session->userdata('user_id');

        $left_join = array(
            'users u'=>'u.id = f.person_one or u.id = f.person_two',
        );

        $condition = "(f.person_two = ".$user_id." OR f.person_one = ".$user_id.") AND f.status = 1 AND u.id != ".$user_id;

        $arr_friends_list = $this->common->get_all('friends f', $condition, 'f.*, u.first_name, u.last_name, u.image, u.id friend_id',
            'f.id desc','','', $left_join );


        $arr_friends_id = [];
        foreach( $arr_friends_list as $row ){
            $arr_friends_id[] = $row->friend_id;
        }


        $arr_left_join = [
            'countries c' => 'c.id = u.country_id',
            'state s' => 's.id = u.state',
            'district d' => 'd.id = u.district',
        ];


        if( is_array($arr_friends_id) AND count($arr_friends_id)>0 ){

            $str_ids = implode(',', $arr_friends_id);

            $str_condition = 'u.id IN ('.$str_ids.')';

            //query for order by ids in IN ids order "FIELD"

            $this->data['result'] = $this->common->get_all('users u', $str_condition,'u.*,c.country country_name, s.name state_name, d.name district_name',
                'u.id desc, FIELD(u.id, '.$str_ids.')','','', $arr_left_join);
        }else{

            $this->data['result'] = [];

        }

        //requested


        $left_join_req = array(
            'users u'=>'u.id = f.person_one',
        );

        $condition = array(
            'f.status'=>0,
            'f.person_two'=>$user_id,
        );

        $arr_request = $this->common->get_all('friends f', $condition, 'f.*, u.first_name, u.last_name, u.image, u.id friend_id',
            'u.id desc','','', $left_join_req );

        $arr_pending_id = [];

        foreach( $arr_request as $row ){
            $arr_pending_id[] = $row->friend_id;
        }

        if( is_array($arr_pending_id) AND count($arr_pending_id)>0 ){

            $tab = 'pending';

            $str_ids = implode(',', $arr_pending_id);

            $str_condition = 'u.id IN ('.$str_ids.')';

            $this->data['pending_result'] = $this->common->get_all('users u', $str_condition,'u.*,c.country country_name, s.name state_name, d.name district_name',
                'u.id desc, FIELD(u.id, '.$str_ids.')','','', $arr_left_join);
        }else{

            $this->data['pending_result'] = [];

        }

        // blocked

//        $left_join_req = array(
//            'users u'=>'u.id = d.user_id',
//        );
//
//        $condition = array(
//            'd.friend_id'=>$user_id,
//        );
//
//        $arr_reject = $this->common->get_all('tbl_declient d', $condition,
//            'd.*, u.first_name, u.last_name, u.image, u.id friend_id','','','', $left_join_req );
//
//        $arr_reject_id = [];
//
//        foreach( $arr_reject as $row ){
//            $arr_reject_id[] = $row->friend_id;
//        }

        $blocked_array = $this->common->get_all('tbl_declient', ['friend_id'=>$this->user->id]);
        $arr_reject_id = [];

        foreach( $blocked_array as $row ){
            $arr_reject_id[] = $row->user_id;
        }

        if( is_array($arr_reject_id) AND count($arr_reject_id)>0 ){


            $str_ids = implode(',', $arr_reject_id);

            $str_condition = 'u.id IN ('.$str_ids.')';

            $this->data['rejected_result'] = $this->common->get_all('users u', $str_condition,
                'u.*,c.country country_name, s.name state_name, d.name district_name',
                'u.id desc, FIELD(u.id, '.$str_ids.')','','', $arr_left_join);
        }else{

            $this->data['rejected_result'] = [];

        }

        $this->data['tab'] = $tab;

        $this->load->view('templates/header',$this->data);
		$this->load->view('mailbox/index',$this->data);
        $this->load->view( 'popup/upgrade_pop', $this->data );
		$this->load->view('templates/footer',$this->data);

	}


}  