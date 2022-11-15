<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_all extends My_Controller {



	public function __construct() {

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}
	}

	public function view( $type = 0 ) {


		$this->data['css_files'] = array(
			base_url('uploadify/uploadify.css'),
			base_url('fine-uploader/fine-uploader-new.css'),
			base_url('assets/pages/css/profile.min.css'),
			base_url('assets/global/plugins/image_grid/images-grid.css'),
            base_url('assets/global/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('uploadify/jquery.uploadify.js'),
			base_url('fine-uploader/fine-uploader.js'),
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/global/plugins/image_grid/images-grid.js'),
			base_url('assets/pages/js/dashboard_one.js'),
            base_url('assets/global/plugins/datetimepicker/moment/min/moment.min.js'),
            base_url('assets/global/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js'),
            base_url('assets/pages/js/friends.js'),
            base_url('assets/pages/js/upgrade_pop.js'),
        );

		$this->data['page_title'] = 'Dashboard';
		$this->data['menu'] = 'dashboard_one';
		$this->data['submenu'] = '';



        // list users logic



        $blocked_array = $this->common->get_all('tbl_declient', ['friend_id'=>$this->user->id]);
        $arr_ids_blocked = [];
        foreach( $blocked_array as $row ){
            $arr_ids_blocked[] = $row->user_id;
        }

        $str_ids = implode(',', $arr_ids_blocked);


        //already seen ids

        $arr_left_join_seen = [
            'users u' => 'u.id = vp.host_id',
            'countries c' => 'c.id = u.country_id',
            'state s' => 's.id = u.state',
            'district d' => 'd.id = u.district',
        ];

        $seen_condition = [
            'visitor_id'=>$this->user->id,
            'host_id !='=>$this->user->id,
        ];

        $visited_array = $this->common->get_all('visited_profiles vp', $seen_condition,
            'vp.host_id,u.*,c.country country_name, s.name state_name, d.name district_name',
            'vp.id desc','50','', $arr_left_join_seen);



        $arr_ids_visited = [];
        foreach( $visited_array as $row ){
            $arr_ids_visited[] = $row->host_id;
        }

        $visited_ids = implode(',', $arr_ids_visited);

        $this->data['result'] = [];


        if( $type == 2 ){

            $this->data['type'] = 'Members Looking For You';

            // people visited your profile

            $arr_left_join_visited = [
                'users u' => 'u.id = vp.visitor_id',
                'countries c' => 'c.id = u.country_id',
                'state s' => 's.id = u.state',
                'district d' => 'd.id = u.district',
            ];

            $visited_condition = [
                'host_id'=>$this->user->id,
                'visitor_id !='=>$this->user->id,
            ];

            $visited_your_profile = $this->common->get_all('visited_profiles vp', $visited_condition,
                'vp.visitor_id,u.*,c.country country_name, s.name state_name, d.name district_name',
                'vp.id desc','50','', $arr_left_join_visited);

            $this->data['result'] = $visited_your_profile;

        }elseif( $type == 3 ){

            $this->data['result'] = $visited_array;
            $this->data['type'] = 'Profiles you viewed';

        }elseif( $type == 1 ){

            $arr_left_join = [
                'countries c' => 'c.id = u.country_id',
                'state s' => 's.id = u.state',
                'district d' => 'd.id = u.district',
            ];


            if( $this->user->gender == 'AF'){
                $gen = 'AL';
            }else{
                $gen = 'AF';
            }

            $arr_condition = [];
            $arr_condition[] = 'u.is_active=1 AND u.group_id=2 AND u.id != '.$this->user->id.' AND u.gender = "'.$gen.'"';
            if( $str_ids != '' ){
                $arr_condition[] = 'u.id NOT IN ('.$str_ids.')';
            }

            if( $visited_ids != '' ){
                $arr_condition[] = 'u.id NOT IN ('.$visited_ids.')';
            }

            $str_condition = implode(' AND ', $arr_condition);

            $this->data['result'] = $this->common->get_all('users u', $str_condition,'u.*,c.country country_name, s.name state_name, d.name district_name',
                'u.id desc','50','', $arr_left_join);

            $this->data['type'] = 'Matching Profiles';

        }



        $this->load->view( 'templates/header', $this->data );
        $this->load->view( 'view_all/index', $this->data );
        $this->load->view( 'templates/footer', $this->data );


	}



	public function get_request_method() {
	    global $HTTP_RAW_POST_DATA;
	    if(isset($HTTP_RAW_POST_DATA)) {
	    	parse_str($HTTP_RAW_POST_DATA, $_POST);
	    }

	    if (isset($_POST["_method"]) && $_POST["_method"] != null) {
	        return $_POST["_method"];
	    }
	    return $_SERVER["REQUEST_METHOD"];
	}







}