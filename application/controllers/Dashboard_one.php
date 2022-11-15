<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_one extends My_Controller {



	public function __construct() {

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}
	}

	public function index() {


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

		$left_join = array(
			'categories c' => 'c.id=uc.category_id',
		);

		$condition = array(
			'uc.user_id'=>$this->session->userdata('user_id'),
		);

		$this->data['categories'] = $this->common->get_all('user_categories uc',$condition,'c.*,uc.category_id','','','',$left_join );


        $is_registered = true;

        $basic_details = $this->common->get('basic_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array');
        $profectional_details = $this->common->get('profectional_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array');
        $family_details = $this->common->get('family_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array');

        if( $basic_details == '' ){

            $title = 'Basic Details';
            $step = 1;
            $is_registered = false;

        }

        $this->data['is_registered'] = $is_registered;

        if( $is_registered ){

            $this->data['title'] = '';
            $this->data['step'] = '';

        }else{

            $this->data['title'] = $title;
            $this->data['step'] = $step;


            $this->data['arr_marital_status'] = get_marital_status();

        }

        // list users logic

//        $list_blocked_condition = 'friend_id = '.$this->user->id.' OR user_id = '.$this->user->id;

        $blocked_array = $this->common->get_all('tbl_declient', ['friend_id'=>$this->user->id]);
        $arr_ids_blocked = [];

        foreach( $blocked_array as $row ){
            $arr_ids_blocked[] = $row->user_id;
        }

        $str_ids = implode(',', $arr_ids_blocked);

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
            'vp.id desc','10','', $arr_left_join_visited);

//        echo $this->db->last_query(); exit;

        $this->data['visited_your_profile'] = $visited_your_profile;

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
            'vp.id desc','10','', $arr_left_join_seen);

        $visited_array_count = $this->common->get_all('visited_profiles vp', $seen_condition,
            'vp.host_id,u.*,c.country country_name, s.name state_name, d.name district_name',
            'vp.id desc','','', $arr_left_join_seen);

        $this->data['visited_array'] = $visited_array;

        $arr_ids_visited = [];
        foreach( $visited_array_count as $row ){
            $arr_ids_visited[] = $row->host_id;
        }

        $visited_ids = implode(',', $arr_ids_visited);


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
            '','10','', $arr_left_join);

//        echo "<pre>"; print_r($this->data['result']); exit;

        $this->load->view( 'templates/header', $this->data );
        $this->load->view( 'dashboard_one/index', $this->data );
        $this->load->view( 'popup/upgrade_pop', $this->data );
        $this->load->view( 'templates/footer', $this->data );


	}

    public function load_reg_form( $step ) {

        $arr_edu_cat = $this->common->get_all('edu_category' );
        $arr_edu = [];
        foreach( $arr_edu_cat as $category ){

            $arr_edu_cat_list = $this->common->get_all('edu_category_list', ['category_id'=>$category->id] );

            $arr_edu[$category->name] = $arr_edu_cat_list;

        }

        $arr_occ_cat = $this->common->get_all('occ_category' );
        $arr_occ = [];
        foreach( $arr_occ_cat as $category ){

            $arr_occ_cat_list = $this->common->get_all('occ_category_list', ['category_id'=>$category->id] );

            $arr_occ[$category->name] = $arr_occ_cat_list;

        }

        $this->data['arr_marital_status'] = get_marital_status();
        $this->data['arr_family_status'] = get_family_status();

        $this->data['arr_employed_in'] = get_employed_in();
//        $this->data['arr_country'] = $this->common->get_all('countries', ['active'=>1] );
        $this->data['arr_country'] = $this->common->get_all('countries' );

        $this->data['arr_edu'] = $arr_edu;
        $this->data['arr_occ'] = $arr_occ;

        $html = $this->load->view('dashboard_one/_form_'.$step, $this->data, true);

        $response = array(
            'status' => 'success',
            'html' => $html,
        );

        header('Content-type: application/json');
        die(json_encode($response));

    }

    public function save_form(){

        $user_id = $this->session->userdata('user_id');

        $dob = $this->input->post('dob');
        $date = new DateTime($dob);

        $arr_age = calculate_age( $date->format('Y-m-d') );

        $data_basic = [
            'user_id'=> $user_id,
            'dob'=> $date->format('Y-m-d'),
            'age'=> $arr_age['age'],
            'months'=> $arr_age['months'],
            'height'=> $this->input->post('height'),
            'weight'=> $this->input->post('weight'),
            'marital_status'=> $this->input->post('marital_status'),
            'parish_name'=> $this->input->post('parish_name'),
            'parish_place'=> $this->input->post('parish_place'),
            'family_status'=> $this->input->post('family_status'),
        ];


        $profssional_details = [
            'user_id'=> $user_id,
            'edu_item'=> $this->input->post('edu_item'),
            'employed_in'=> $this->input->post('employed_in'),
        ];

        if( $this->input->post('employed_in') != 6 ){

            $profssional_details['occ_item'] = $this->input->post('occ_item');
            $profssional_details['annual_income'] = $this->input->post('annual_income');
            $profssional_details['working_country'] = $this->input->post('working_country');
            $profssional_details['working_city'] = $this->input->post('working_city');
        }


        $data_family = [
            'user_id'=> $user_id,
            'no_brother_unmarried'=> $this->input->post('no_brother_unmarried'),
            'no_brother_married'=> $this->input->post('no_brother_married'),
            'no_sister_unmarried'=> $this->input->post('no_sister_unmarried'),
            'no_sister_married'=> $this->input->post('no_sister_married'),
        ];

        $id_basic = $this->common->insert( 'basic_details', $data_basic );
        $id_prof = $this->common->insert( 'profectional_details', $profssional_details );
        $id_family = $this->common->insert( 'family_details', $data_family );

        $row_user = $this->common->get('users', array( 'id' => $this->session->userdata('user_id') ) );

        $profile_type = $row_user->profile_type;
        $profile_type_row = $this->common->get('profile_type', array( 'id' => $profile_type ) );

        $edu_item_row = $this->common->get('edu_category_list', array( 'id' => $this->input->post('edu_item') ) );
        $edu_category_row = $this->common->get('edu_category', array( 'id' => $edu_item_row->category_id ) );

        $country_row = $this->common->get('countries', array( 'id' => $this->input->post('working_country') ) );

        $she_he = 'i';
        $her_his = 'my';
        $i_am = 'i am';

        if( $profile_type != 1 ){

            if( $row_user->gender == 'AL' ){

                $she_he = 'he';
                $her_his = 'his';
                $i_am = 'he is';

            }else{

                $she_he = 'she';
                $her_his = 'her';
                $i_am = 'she is';
            }
        }

        $about = '';

        if( $profile_type != 1 ){

            $about .= 'I am creating this profile on behalf of my '.$profile_type_row->name.' '.$row_user->first_name.'.';
        }

        $about .= $she_he.' have done '.$her_his.' '.$edu_category_row->name.' ( '.$edu_item_row->name.' ). ';

        if( $this->input->post('employed_in') != 6 ){

            $about .= $i_am.' working in '.$country_row->country.'. ';

        }else{
            $about .= 'Currently '.$i_am.' not working. ';
        }

        $about .= $she_he.' come from '.get_family_status( $this->input->post('family_status')).' family.' ;

        $about .= ' Currently living in '.$row_user->city.'.';

        $this->common->update('basic_details',['about'=>$about], array('user_id' => $this->session->userdata('user_id') ));

        if( $row_user->gender == 'AL' ){

            $age_from = $arr_age['age'] - 8;

            if( $age_from < 18 ){
                $age_from = 18;
            }

            $age_to = $arr_age['age'];


        }else{

            $age_from = $arr_age['age'];

            $age_to = $arr_age['age']+10;

        }


        $data_preference = [
            'user_id'=> $user_id,
            'age_from'=> $age_from,
            'age_to'=> $age_to,
            'height_from'=> 0,
            'height_to'=> 0,
            'marital_status'=> '1,2,3,4',
            'smoking_habits'=> 0,
            'drinking_habits'=> 0,
            'education'=> 0,
            'occupation'=> 0,
            'country'=> 0,
            'district'=> 0,
        ];

        $id_preference = $this->common->insert( 'tbl_preference', $data_preference );


        $response = array(
            'status' => 'success',
        );
        header('Content-type: application/json');
        die(json_encode($response));


    }

	public function upload(){

		$px = 30;
		$max_width = 47;
		$change_time = 3.8;

		//require_once "handler.php";
		require_once( getcwd().'/assets/classes/handler.php' );

		$uploader = new UploadHandler();
		$uploader->allowedExtensions = array();
		$uploader->sizeLimit = null;
		$uploader->inputName = "qqfile";
		$uploader->chunksFolder = "chunks";

		$method = $this->get_request_method();

		if ($method == "POST") {
		    header("Content-Type: text/plain");


		    if (isset($_GET["done"])) {
		        $result = $uploader->combineChunks("uploads");
		    }

		    else {

		        $result = $uploader->handleUpload("uploads");
		        $result["uploadName"] = $uploader->getUploadName();
		    }

		   // echo "<pre>"; print_r($result); exit;

		    echo json_encode($result);
		}

		else if ($method == "DELETE") {
		    $result = $uploader->handleDelete("uploads");
		    echo json_encode($result);
		}
		else {
		    header("HTTP/1.0 405 Method Not Allowed");
		}

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

	public function save_post(){

		ini_set('memory_limit', '-1');
    	ini_set('max_execution_time', '0');
        set_time_limit('0');

        //echo "<pre>"; print_r($_POST); exit;

        $user_arr = array(
			'user_id'=> trim($this->input->post('user_id')),
			'content'=> trim($this->input->post('content')),
			'created_at' => date('Y-m-d H:i:s'),
		);

		$post_id = $this->common->insert( 'posts', $user_arr );


		$uploaded_files = explode( '||', $this->input->post('uploaded_files') );

		if( !file_exists( getcwd().'/images/post_images/'.$post_id ) ) {
			mkdir( getcwd().'/images/post_images/'.$post_id );
		}
		$i = 0;
		foreach( $uploaded_files as $filename ) {

			if( $filename != '' &&  file_exists( getcwd().'/uploads/'.$filename ) ) {
				$new_name = rand(100, 999).'-post-'.$post_id.'-'.$i.'.jpg';

				rename(getcwd().'/uploads/'.$filename, getcwd().'/images/post_images/'.$post_id.'/'.$new_name );
				$data_arr = array(
					'post_id' => $post_id,
				);
				$old_path = getcwd().'/images/post_images/'.$post_id.'/'.$new_name;
				$new_path = getcwd().'/images/post_images/'.$post_id.'/t-'.$new_name;

				/*if( @getimagesize($old_path) ) {
					$this->image_thumb( $old_path, $new_path );
					if( file_exists($new_path) ) {
						$data_arr['thumb'] = 't-'.$new_name;
					} else {
						$data_arr['thumb'] = $new_name;
					}
				} else {
					$data_arr['thumb'] = $new_name;
				}  */

				$data_arr['image'] = $new_name;
				$this->common->insert( 'post_image', $data_arr );
				$i++;
			}

		}

		$left_join = array(
			'users u'=>'u.id = p.user_id',
		);

		$post = $this->common->get( 'posts p', array('p.id'=>$post_id), 'object', 'p.*,u.first_name,u.last_name,u.image', $left_join);

		$this->data['post'] = $post;

		$post_images = $this->common->get_all( 'post_image', array('post_id'=>$post_id) );

		$post_img_array = array();

		foreach ($post_images as $key => $image) {
			$post_img_array[] = base_url('images/post_images/'.$post->id.'/'.$image->image);
		}

		$this->data['post_images'] = $post_images;
		$this->data['post_img_array'] = $post_img_array;

		$html = $this->load->view('dashboard/_post_ajax', $this->data, true);

		$response = array(
			'status' => 'success',
			'html' => $html,
			'post_img_array' => $post_img_array,
			'galery_id' => $post->id,
		);

		header('Content-type: application/json');
		die(json_encode($response));

	}

	public function remove_group(){

		$category_id = $this->input->post('category_id');
		$user_id = $this->session->userdata('user_id');

		$data_arr = array(
			'user_id'=>$user_id,
			'category_id'=>$category_id,
		);

		$this->common->delete('user_categories', $data_arr);

		$arr_result = array(
			'status' => 'success',
		);

		header('Content-type: application/json');
		echo json_encode($arr_result);

	}






}