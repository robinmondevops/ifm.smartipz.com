<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_profile extends My_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->session->userdata('logged_in') ) {
			redirect('login');
		}
		$this->common->check_user_exists();
	}



	function edit( $tab = '' ) {

		$this->data['page_title'] = 'Edit My Profle';
		$this->data['menu'] = 'edit_profile';
		$this->data['submenu'] = 'edit_profile';

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
		);  
		
		
		$row_users = $this->common->get('users', array( 'id' => $this->session->userdata('user_id') ), 'array', '' );

		$row_basic = $this->common->get('basic_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
		$row_prof = $this->common->get('profectional_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );
		$row_family = $this->common->get('family_details', array( 'user_id' => $this->session->userdata('user_id') ), 'array', '' );

        if( $tab == ''){
            $tab = 'basic';
        }
		


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

		$this->data['tab'] = $tab;

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($_POST) {

			if ( isset($_POST['basic']) ) {

				$this->data['tab'] = 'basic';

				$this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
				$this->form_validation->set_rules('height', 'Height', 'trim|required');
				$this->form_validation->set_rules('weight', 'Weight', 'trim|required');
				$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
				$this->form_validation->set_rules('parish_name', 'Parish Name', 'trim|required');
				$this->form_validation->set_rules('parish_place', 'Parish Place', 'trim|required');
				$this->form_validation->set_rules('family_status', 'Family Status', 'trim|required');
				$this->form_validation->set_rules('about', 'Description', 'trim|required');

				if( $this->form_validation->run() == false ){
					
					$this->data['row'] = array_merge( $this->data['row_basic'], $_POST );
					
				} else {

                    $dob = $this->input->post('dob');
                    $date = new DateTime($dob);

                    $arr_age = calculate_age( $date->format('Y-m-d') );

                    $data_basic = [
                        'dob'=> $date->format('Y-m-d'),
                        'age'=> $arr_age['age'],
                        'months'=> $arr_age['months'],
                        'height'=> $this->input->post('height'),
                        'weight'=> $this->input->post('weight'),
                        'marital_status'=> $this->input->post('marital_status'),
                        'parish_name'=> $this->input->post('parish_name'),
                        'parish_place'=> $this->input->post('parish_place'),
                        'family_status'=> $this->input->post('family_status'),
                        'about'=> $this->input->post('about'),
                    ];


					$this->common->update('basic_details',$data_basic, array('user_id' => $this->session->userdata('user_id') ));
					
					$this->session->set_flashdata('msg','Basic informations updated successfully!');
					redirect('edit_profile/edit/'.$this->data['tab']);
				}

			} else if ( isset($_POST['prof']) ) {

				$this->data['tab'] = 'prof';

                $this->form_validation->set_rules('edu_item', 'Education Detail', 'trim|required');
                $this->form_validation->set_rules('employed_in', 'Employed Type', 'trim|required');

                if( $this->input->post('employed_in') != 6 ){

                    $this->form_validation->set_rules('occ_item', 'Occupation Type', 'trim|required');
                    $this->form_validation->set_rules('annual_income', 'Annual Income', 'trim|required');
                    $this->form_validation->set_rules('working_country', 'Working Country', 'trim|required');
                    $this->form_validation->set_rules('working_city', 'Working City', 'trim|required');

                }


                if( $this->form_validation->run() == false ){

                    $this->data['row'] = array_merge( $this->data['row_prof'], $_POST );

                } else {

                    $profssional_details = [
                        'edu_item'=> $this->input->post('edu_item'),
                        'employed_in'=> $this->input->post('employed_in'),
                    ];

                    if( $this->input->post('employed_in') != 6 ){
                        $profssional_details['occ_item'] = $this->input->post('occ_item');
                        $profssional_details['annual_income'] = $this->input->post('annual_income');
                        $profssional_details['working_country'] = $this->input->post('working_country');
                        $profssional_details['working_city'] = $this->input->post('working_city');
                    }

                    $this->common->update('profectional_details',$profssional_details, array('user_id' => $this->session->userdata('user_id') ));

                    $this->session->set_flashdata('msg','Professional informations updated successfully!');
                    redirect('edit_profile/edit/'.$this->data['tab']);
                }


			} else if ( isset($_POST['family']) ) {

				$this->data['tab'] = 'family';

                $data_family = [
                    'no_brother_unmarried'=> $this->input->post('no_brother_unmarried'),
                    'no_brother_married'=> $this->input->post('no_brother_married'),
                    'no_sister_unmarried'=> $this->input->post('no_sister_unmarried'),
                    'no_sister_married'=> $this->input->post('no_sister_married'),
                    'description'=> $this->input->post('description'),
                ];

                $this->common->update('family_details',$data_family, array('user_id' => $this->session->userdata('user_id') ));

                $this->session->set_flashdata('msg','Family informations updated successfully!');
                redirect('edit_profile/edit/'.$this->data['tab']);


			}else if ( isset($_POST['contact']) ) {

                $this->data['tab'] = 'contact';

                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check['.$this->session->userdata('user_id').']');
                $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

                $this->form_validation->set_rules('country_id', 'Country', 'trim|required');

                if( $this->input->post('country_id') == 78 ){

                    $this->form_validation->set_rules('state', 'State', 'trim|required');
                    $this->form_validation->set_rules('district', 'District', 'trim|required');
                }

                $this->form_validation->set_rules('city', 'City', 'trim|required');

                if( $this->form_validation->run() == false ){

                    $this->data['row'] = array_merge( $this->data['row_users'], $_POST );

                } else {

                    $user_arr = array(
                        'email'=> trim($this->input->post('email')),
                        'first_name'=> trim($this->input->post('first_name')),
                        'phone' => trim($this->input->post('phone')),
                        'country_id' => trim($this->input->post('country_id')),
                        'city' => trim($this->input->post('city')),

                    );

                    if( $this->input->post('country_id') == 78 ){
                        $user_arr['state'] =  trim($this->input->post('state'));
                        $user_arr['district'] =  trim($this->input->post('district'));
                    }


                    $this->common->update('users',$user_arr, array('id' => $this->session->userdata('user_id') ));

                    $this->session->set_flashdata('msg','Contact & location informations updated successfully!');
                    redirect('edit_profile/edit/'.$this->data['tab']);
                }


            }
		}

		$this->load->view('templates/header',$this->data);
		$this->load->view('edit_profile/index',$this->data);
		$this->load->view('templates/footer',$this->data);

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