<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_preference extends My_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->session->userdata('logged_in') ) {
			redirect('login');
		}
		$this->common->check_user_exists();
	}



	function edit(  ) {

		$this->data['page_title'] = 'Edit My Preference';
		$this->data['menu'] = 'edit_preference';
		$this->data['submenu'] = 'edit_preference';

		$this->data['css_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
			base_url('assets/global/plugins/image_crop/jquery.form.js'),
			base_url('assets/pages/js/jquery.sparkline.min.js'),
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/pages/js/edit_profile.js'),
		);


		$row_users = $this->common->get('users', array( 'id' => $this->session->userdata('user_id') ), 'array', '' );

		$row_basic = $this->common->get('basic_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
		$row_prof = $this->common->get('profectional_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
		$row_family = $this->common->get('family_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );

		$this->data['row_users'] = $row_users;
		$this->data['row_basic'] = $row_basic;
		$this->data['row_prof'] = $row_prof;
		$this->data['row_family'] = $row_family;

		$this->data['arr_family_status'] = get_family_status();
		$this->data['arr_marital_status'] = get_marital_status();
        $this->data['arr_employed_in'] = get_employed_in();

        $this->data['arr_country'] = $this->common->get_all('countries' );
        $this->data['arr_state'] = $this->common->get_all('state' );

        $this->data['arr_district'] = [];

        if($row_users['state'] != 0 ){

            $this->data['arr_district'] = $this->common->get_all('district', ['state_id'=>$row_users['state'] ] );
        }

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

        $this->data['arr_edu'] = $arr_edu;
        $this->data['arr_occ'] = $arr_occ;

        $row_preference = $this->common->get('tbl_preference', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
        $this->data['row_preference'] = $row_preference;

        $arr_per_merital_status = explode(',', $row_preference['marital_status']);
        $this->data['arr_per_merital_status'] = $arr_per_merital_status;

        $per_edu = $row_preference['education'];

        if( $per_edu == 0 ){
            $str_per_edu = 'Any';
        }else{
//            $arr_per_edu = explode(',', $row_preference['education']);
            $arr_per_cat_list = $this->common->get_all('edu_category_list', 'id IN ('.$row_preference['education'].')' );

            $arr_per_edu = [];
            foreach( $arr_per_cat_list as $key => $row ){
                $arr_per_edu[] = $row->name;
            }

            $str_per_edu = implode(' , ', $arr_per_edu );
        }

        $this->data['str_per_edu'] = $str_per_edu;


        $per_occ = $row_preference['occupation'];

        if( $per_occ == 0 ){
            $str_per_occ = 'Any';
        }else{

            $arr_per_cat_list = $this->common->get_all('occ_category_list', 'id IN ('.$row_preference['occupation'].')' );

            $arr_per_occ = [];
            foreach( $arr_per_cat_list as $key => $row ){
                $arr_per_occ[] = $row->name;
            }

            $str_per_occ = implode(' , ', $arr_per_occ );
        }

        $this->data['str_per_occ'] = $str_per_occ;


        $per_country = $row_preference['country'];

        if( $per_country == 0 ){
            $str_per_country = 'Any';
        }else{

            $arr_per_country_row = $this->common->get_all('countries', 'id IN ('.$row_preference['country'].')' );

            $arr_per_country = [];
            foreach( $arr_per_country_row as $key => $row ){
                $arr_per_country[] = $row->country;
            }

            $str_per_country = implode(' , ', $arr_per_country );
        }

        $this->data['str_per_country'] = $str_per_country;


        $per_district = $row_preference['district'];

        if( $per_district == 0 ){
            $str_per_district = 'Any';
        }else{

            $arr_per_district_row = $this->common->get_all('district', 'id IN ('.$row_preference['district'].')' );

            $arr_per_district = [];
            foreach( $arr_per_district_row as $key => $row ){
                $arr_per_district[] = $row->name;
            }

            $str_per_district = implode(' , ', $arr_per_district );
        }

        $this->data['str_per_district'] = $str_per_district;



		$this->load->view('templates/header',$this->data);
		$this->load->view('edit_preference/index',$this->data);
		$this->load->view('templates/footer',$this->data);

	}


    public function load_edit_form( $type ) {

        $row_users = $this->common->get('users', array( 'id' => $this->session->userdata('user_id') ), 'array', '' );

        $row_basic = $this->common->get('basic_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
        $row_prof = $this->common->get('profectional_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
        $row_family = $this->common->get('family_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );

        $this->data['row_users'] = $row_users;
        $this->data['row_basic'] = $row_basic;
        $this->data['row_prof'] = $row_prof;
        $this->data['row_family'] = $row_family;

        $this->data['arr_family_status'] = get_family_status();
        $this->data['arr_marital_status'] = get_marital_status();
        $this->data['arr_employed_in'] = get_employed_in();

        $this->data['arr_country'] = $this->common->get_all('countries' );
        $this->data['arr_state'] = $this->common->get_all('state' );

        $this->data['arr_district'] = [];

        if($row_users['state'] != 0 ){

            $this->data['arr_district'] = $this->common->get_all('district', ['state_id'=>$row_users['state'] ] );
        }

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

        $this->data['arr_edu'] = $arr_edu;
        $this->data['arr_occ'] = $arr_occ;

        $row_preference = $this->common->get('tbl_preference', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
        $this->data['row_preference'] = $row_preference;

        $arr_per_merital_status = explode(',', $row_preference['marital_status']);
        $this->data['arr_per_merital_status'] = $arr_per_merital_status;

        $per_edu = $row_preference['education'];

        $arr_per_edu_id = [];

        if( $per_edu == 0 ){
            $str_per_edu = 'Any';
        }else{
//            $arr_per_edu = explode(',', $row_preference['education']);
            $arr_per_cat_list = $this->common->get_all('edu_category_list', 'id IN ('.$row_preference['education'].')' );

            $arr_per_edu = [];
            foreach( $arr_per_cat_list as $key => $row ){
                $arr_per_edu[] = $row->name;
                $arr_per_edu_id[] = $row->id;
            }

            $str_per_edu = implode(' , ', $arr_per_edu );
        }

        $this->data['str_per_edu'] = $str_per_edu;

        $this->data['per_edu'] = $per_edu;
        $this->data['arr_per_edu_id'] = $arr_per_edu_id;

//        echo "<pre>"; print_r($this->data['arr_per_edu']); exit;

        $per_occ = $row_preference['occupation'];

        $arr_per_occ_id = [];

        if( $per_occ == 0 ){
            $str_per_occ = 'Any';
        }else{

            $arr_per_cat_list = $this->common->get_all('occ_category_list', 'id IN ('.$row_preference['occupation'].')' );

            $arr_per_occ = [];
            foreach( $arr_per_cat_list as $key => $row ){
                $arr_per_occ[] = $row->name;
                $arr_per_occ_id[] = $row->id;
            }

            $str_per_occ = implode(' , ', $arr_per_occ );
        }

        $this->data['str_per_occ'] = $str_per_occ;
        $this->data['per_occ'] = $per_occ;
        $this->data['arr_per_occ_id'] = $arr_per_occ_id;


        $per_country = $row_preference['country'];

        $arr_per_country_id = [];
        $arr_country = $this->common->get_all('countries', ['active'=>1] );

        if( $per_country == 0 ){
            $str_per_country = 'Any';
        }else{

            $arr_per_country_row = $this->common->get_all('countries', 'id IN ('.$row_preference['country'].')' );


            $arr_per_country = [];
            foreach( $arr_per_country_row as $key => $row ){
                $arr_per_country[] = $row->country;
                $arr_per_country_id[] = $row->id;
            }

            $str_per_country = implode(' , ', $arr_per_country );
        }

        $this->data['str_per_country'] = $str_per_country;

        $this->data['per_country'] = $per_country;
        $this->data['arr_per_country_id'] = $arr_per_country_id;
        $this->data['arr_country'] = $arr_country;


        $per_district = $row_preference['district'];

        $arr_per_district_id = [];
        $arr_district = $this->common->get_all('district' );

        if( $per_district == 0 ){
            $str_per_district = 'Any';
        }else{

            $arr_per_district_row = $this->common->get_all('district', 'id IN ('.$row_preference['district'].')' );

            $arr_per_district = [];
            foreach( $arr_per_district_row as $key => $row ){
                $arr_per_district[] = $row->name;
                $arr_per_district_id[] = $row->id;
            }

            $str_per_district = implode(' , ', $arr_per_district );
        }

        $this->data['str_per_district'] = $str_per_district;

        $this->data['per_district'] = $per_district;
        $this->data['arr_per_district_id'] = $arr_per_district_id;
        $this->data['arr_district'] = $arr_district;

        if( $type == 'age' ){

            $html = $this->load->view('edit_preference/_age_form', $this->data, true);
            $count_type = '';

//            $html = '<p>hello</p>';

        }elseif($type == 'edu'){

            $html = $this->load->view('edit_preference/_edu_form', $this->data, true);
            $count_type = $per_edu;

        }elseif($type == 'occ') {

            $html = $this->load->view('edit_preference/_occ_form', $this->data, true);
            $count_type = $per_occ;

        }elseif($type == 'country'){

            $html = $this->load->view('edit_preference/_country_form', $this->data, true);
            $count_type = $per_country;

        }elseif($type == 'district'){

            $html = $this->load->view('edit_preference/_district_form', $this->data, true);
            $count_type = $per_district;

        }


        $response = array(
            'status' => 'success',
            'html' => $html,
            'count_type' => $count_type,
        );

        header('Content-type: application/json');
        die(json_encode($response));

    }

    public function save_age(){

        $user_id = $this->session->userdata('user_id');

        $data_preference = [
            'age_from'=> $this->input->post('age_from'),
            'age_to'=> $this->input->post('age_to'),

        ];

        $column_html = $this->input->post('age_from').' - '.$this->input->post('age_to').' Yrs';

        $id_preference = $this->common->update( 'tbl_preference', $data_preference, ['user_id' => $user_id ] );

        $response = array(
            'status' => 'success',
            'column_html' =>$column_html
        );
        header('Content-type: application/json');
        die(json_encode($response));

    }

    public function save_edu(){

        $user_id = $this->session->userdata('user_id');


        $arr_edu = $this->input->post('arr_edu');

        if( $this->input->post('chk_all') != null ){

            $education = 0;
        }else{
            if( is_array($arr_edu) && count($arr_edu)>0 ){
                $education = implode(' , ', $arr_edu );
            }else{
                $education = 0;
            }

        }

        $data_preference = [
            'education'=> $education,

        ];

        $per_edu = $education;

        if( $per_edu == 0 ){
            $str_per_edu = 'Any';
        }else{
            $arr_per_cat_list = $this->common->get_all('edu_category_list', 'id IN ('.$education.')' );

            $arr_per_edu = [];
            foreach( $arr_per_cat_list as $key => $row ){
                $arr_per_edu[] = $row->name;
            }

            $str_per_edu = implode(' , ', $arr_per_edu );
        }


        $column_html = $str_per_edu;

        $id_preference = $this->common->update( 'tbl_preference', $data_preference, ['user_id' => $user_id ] );

        $response = array(
            'status' => 'success',
            'column_html' =>$column_html,
            'per_edu' =>$per_edu,
        );
        header('Content-type: application/json');
        die(json_encode($response));

    }

    public function save_occ(){

        $user_id = $this->session->userdata('user_id');


        $arr_occ = $this->input->post('arr_occ');

        if( $this->input->post('chk_all') != null ){

            $occupation = 0;
        }else{
            if( is_array($arr_occ) && count($arr_occ)>0 ){
                $occupation = implode(' , ', $arr_occ );
            }else{
                $occupation = 0;
            }

        }

        $data_preference = [
            'occupation'=> $occupation,

        ];

        $per_occ = $occupation;

        if( $per_occ == 0 ){
            $str_per_occ = 'Any';
        }else{
            $arr_per_cat_list = $this->common->get_all('occ_category_list', 'id IN ('.$occupation.')' );

            $arr_per_edu = [];
            foreach( $arr_per_cat_list as $key => $row ){
                $arr_per_edu[] = $row->name;
            }

            $str_per_occ = implode(' , ', $arr_per_edu );
        }


        $column_html = $str_per_occ;

        $id_preference = $this->common->update( 'tbl_preference', $data_preference, ['user_id' => $user_id ] );

        $response = array(
            'status' => 'success',
            'column_html' =>$column_html,
        );
        header('Content-type: application/json');
        die(json_encode($response));

    }

    public function save_country(){

        $user_id = $this->session->userdata('user_id');


        $arr_country = $this->input->post('arr_country');

        if( $this->input->post('chk_all') != null ){

            $country = 0;
        }else{
            if( is_array($arr_country) && count($arr_country)>0 ){
                $country = implode(' , ', $arr_country );
            }else{
                $country = 0;
            }

        }

        $data_preference = [
            'country'=> $country,

        ];

        $per_country = $country;

        if( $per_country == 0 ){
            $str_per_country = 'Any';
        }else{
            $arr_per_country_list = $this->common->get_all('countries', 'id IN ('.$country.')' );

            $arr_per_country = [];
            foreach( $arr_per_country_list as $key => $row ){
                $arr_per_country[] = $row->country;
            }

            $str_per_country = implode(' , ', $arr_per_country );
        }


        $column_html = $str_per_country;

        $id_preference = $this->common->update( 'tbl_preference', $data_preference, ['user_id' => $user_id ] );

        $response = array(
            'status' => 'success',
            'column_html' =>$column_html,
        );
        header('Content-type: application/json');
        die(json_encode($response));

    }

    public function save_district(){

        $user_id = $this->session->userdata('user_id');


        $arr_district = $this->input->post('arr_district');

        if( $this->input->post('chk_all') != null ){

            $district = 0;
        }else{
            if( is_array($arr_district) && count($arr_district)>0 ){
                $district = implode(' , ', $arr_district );
            }else{
                $district = 0;
            }

        }

        $data_preference = [
            'district'=> $district,

        ];

        $per_district = $district;

        if( $per_district == 0 ){
            $str_per_district = 'Any';
        }else{
            $arr_per_district_list = $this->common->get_all('district', 'id IN ('.$district.')' );

            $arr_per_district = [];
            foreach( $arr_per_district_list as $key => $row ){
                $arr_per_district[] = $row->name;
            }

            $str_per_district = implode(' , ', $arr_per_district );
        }


        $column_html = $str_per_district;

        $id_preference = $this->common->update( 'tbl_preference', $data_preference, ['user_id' => $user_id ] );

        $response = array(
            'status' => 'success',
            'column_html' =>$column_html,
        );
        header('Content-type: application/json');
        die(json_encode($response));

    }


    public function add_group(){

        $row_preference = $this->common->get('tbl_preference', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );

        $arr_per_merital_status = explode(',', $row_preference['marital_status']);

        $category_id = $this->input->post('category_id');
        $user_id = $this->session->userdata('user_id');

        $arr_per_merital_status[] = $category_id;


        $str_per_merital_status = implode(',', $arr_per_merital_status );

        $id_preference = $this->common->update( 'tbl_preference', ['marital_status'=>$str_per_merital_status],
            ['user_id' => $user_id ] );


        $arr_result = array(
            'status' => 'success',
        );

        header('Content-type: application/json');
        echo json_encode($arr_result);

    }


    public function remove_group(){

        $row_preference = $this->common->get('tbl_preference', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );

        $arr_per_merital_status = explode(',', $row_preference['marital_status']);



        $category_id = $this->input->post('category_id');
        $user_id = $this->session->userdata('user_id');

        if (($key = array_search($category_id, $arr_per_merital_status)) !== false) {
            unset($arr_per_merital_status[$key]);
        }

        $str_per_merital_status = implode(',', $arr_per_merital_status );

        $id_preference = $this->common->update( 'tbl_preference', ['marital_status'=>$str_per_merital_status],
            ['user_id' => $user_id ] );


        $arr_result = array(
            'status' => 'success',
        );

        header('Content-type: application/json');
        echo json_encode($arr_result);

    }





	public function email_check( $email, $id ) {

		$count = $this->common->get_total_count( 'users', array('lower(email)' => strtolower($email), 'id <>' => $id ));
		if ( $count > 0 ){
			$this->form_validation->set_message('email_check', 'This email already exists, please try another one.');
			return FALSE;
		} else {
			return TRUE;
		}

	}

	public function image_thumb( $old_path = '', $new_path = '' ) {

		ini_set('memory_limit', '1024M');
        $pathinfo = pathinfo($old_path);
        $original = $old_path;
        if (!file_exists($original)) {
            show_404($original);
        }

        $width = 400;
		$height = 400;
        // only continue with a valid width and height
        if ( $width >= 0 && $height >= 0) {
            // initialize library
            $config["source_image"] = $old_path;
            $config['new_image'] = $new_path;
            $config["width"] = $width;
            $config["height"] = $height;
            $config["dynamic_output"] = FALSE; // always save as cache
            $this->load->library('image_lib');
			$this->image_lib->initialize($config);
            $this->image_lib->fit();
			$this->image_lib->clear();
        }
	}

	public function crop(){

		$post = isset($_POST) ? $_POST: array();
		 //print_R($post);die;
		switch($post['action']) {
			case 'save' :
			$this->saveAvatarTmp();
			break;
			default:
			$this->changeAvatar();

		}
	}

	public function changeAvatar() {
        $post = isset($_POST) ? $_POST: array();
        $max_width = "500";
        $userId = isset($post['hdn-profile-id']) ? intval($post['hdn-profile-id']) : 0;
        if( !file_exists( getcwd().'/files/profile/'.$this->session->userdata('user_id') ) ) {
						mkdir( getcwd().'/files/profile/'.$this->session->userdata('user_id') );
					}
        $path = getcwd().'/files/profile/'.$this->user->id;

        $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
        $name = $_FILES['photoimg']['name'];
        $size = $_FILES['photoimg']['size'];
        if(strlen($name))
        {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
        if($size<(1024*1024)) { // Image size max 1 MB
        $actual_image_name = rand(100,999).'_'.$userId .'.'.$ext;
        $filePath = $path .'/'.$actual_image_name;


        $tmp = $_FILES['photoimg']['tmp_name'];

        if(move_uploaded_file($tmp, $filePath)){

        $width = $this->getWidth($filePath);
        $height = $this->getHeight($filePath);
        //Scale the image if it is greater than the width set above
        if ($width > $max_width){
            $scale = $max_width/$width;
            $uploaded = $this->resizeImage($filePath,$width,$height,$scale);
        }else{
            $scale = 1;
            $uploaded = $this->resizeImage($filePath,$width,$height,$scale);
        }

        $data_arr['image'] = $actual_image_name;


        $this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));
		$this->common->insert('profile_pics', array('name'=>$actual_image_name,'user_id'=>$this->session->userdata('user_id')));

        /*$res = saveAvatar(array(
                        'userId' => isset($userId) ? intval($userId) : 0,
                                                'avatar' => isset($actual_image_name) ? $actual_image_name : '',
                        ));*/

        //mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
        echo "<img id='photo' file-name='".$actual_image_name."' src='".site_url('files/profile/'.$this->user->id.'/'.$actual_image_name)."' class='preview'/>";
        }
        else
        echo "failed";
        }
        else
        echo "Image file size max 1 MB";
        }
        else
        echo "Invalid file format..";
        }
        else
        echo "Please select image..!";
        exit;


    }


    public function saveAvatarTmp() {
        $post = isset($_POST) ? $_POST: array();
        $userId = isset($post['id']) ? intval($post['id']) : 0;
        $path = getcwd().'/files/profile/'.$this->user->id;
        $t_width = 300; // Maximum thumbnail width
        $t_height = 300;    // Maximum thumbnail height

	    if(isset($_POST['t']) and $_POST['t'] == "ajax"){
	        extract($_POST);

	        $imagePath = getcwd().'/files/profile/'.$this->user->id.'/'.$_POST['image_name'];
	        $imagePath_new = site_url('files/profile/'.$this->user->id.'/'.$_POST['image_name']);
	        $ratio = ($t_width/$w1);
	        $nw = ceil($w1 * $ratio);
	        $nh = ceil($h1 * $ratio);
	        $nimg = imagecreatetruecolor($nw,$nh);
	        $im_src = imagecreatefromjpeg($imagePath);
	        imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w1,$h1);
	        imagejpeg($nimg,$imagePath,90);

	    }
	    echo $imagePath_new;
	    exit(0);
    }

	    /*********************************************************************
	     Purpose            : resize image.
	     Parameters         : null
	     Returns            : image
	     ***********************************************************************/
    public function resizeImage($image,$width,$height,$scale) {
	    $newImageWidth = ceil($width * $scale);
	    $newImageHeight = ceil($height * $scale);
	    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	    $source = imagecreatefromjpeg($image);
	    imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	    imagejpeg($newImage,$image,90);
	    chmod($image, 0777);
	    return $image;
	}
	/*********************************************************************
	     Purpose            : get image height.
	     Parameters         : null
	     Returns            : height
	     ***********************************************************************/
	public function getHeight($image) {
	    $sizes = getimagesize($image);
	    $height = $sizes[1];
	    return $height;
	}
	/*********************************************************************
	     Purpose            : get image width.
	     Parameters         : null
	     Returns            : width
	     ***********************************************************************/
	public function getWidth($image) {
	    $sizes = getimagesize($image);
	    $width = $sizes[0];
	    return $width;
	}



}