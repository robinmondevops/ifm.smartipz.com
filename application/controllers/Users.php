<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends My_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->session->userdata('logged_in') ) {
			redirect('login');
		}
		$this->common->check_user_exists();
	}



	function profile( $tab = '' ) {

		$this->data['page_title'] = 'Edit My Profle';
		$this->data['menu'] = 'profile';
		$this->data['submenu'] = 'profile';

		$this->data['css_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
			base_url('assets/global/plugins/image_crop/imgareaselect.css'),
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),  
//			base_url('assets/global/plugins/image_crop/jquery.imgareaselect.js'),
			base_url('assets/global/plugins/image_crop/jquery.form.js'),
			base_url('assets/pages/js/jquery.sparkline.min.js'),  
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/pages/js/profile_crop.js'),
		);  
		
		
		$row = $this->common->get('users', array( 'id' => $this->session->userdata('user_id') ), 'array', '' );

        if( $tab == ''){
            $tab = 'personal';
        }
		
		$row['new_password'] = '';
		$row['retype_new_password'] = '';
		$this->data['row'] = $row;
		$this->data['tab'] = $tab;
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($_POST) {

			if ( isset($_POST['personal_info']) ) {
				$this->data['tab'] = 'personal';
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check['.$this->session->userdata('user_id').']');
				$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
				//$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');

				if( $this->form_validation->run() == false ){
					
					$this->data['row'] = array_merge( $this->data['row'], $_POST );
					
				} else {
					
					$data_arr = array(
						'email'=> trim($this->input->post('email')),
						'first_name'=> trim($this->input->post('first_name')),
						'phone' => trim($this->input->post('phone')),
					);

					$this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));
					
					$this->session->set_flashdata('msg','Personal informations updated successfully!');
					redirect('users/profile');
				}

			} else if ( isset($_POST['profile_pic']) ) {

                $this->data['tab'] = 'profile_pic';

                $config['upload_path'] = './files/profile/';

                $config['encrypt_name'] = TRUE;

                $config['allowed_types'] = 'gif|jpg|jpeg|png';



                $this->load->library('upload', $config);

                if ( $this->upload->do_upload('image') ){

                    $data = array('upload_data' => $this->upload->data());

                    $data_arr['image'] = $data['upload_data']['file_name'];

                    if( !file_exists( getcwd().'/files/profile/'.$this->session->userdata('user_id') ) ) {

                        mkdir( getcwd().'/files/profile/'.$this->session->userdata('user_id') );

                    }

                    rename( getcwd().'/files/profile/'.$data['upload_data']['file_name'], getcwd().'/files/profile/'.$this->session->userdata('user_id').'/'.$data['upload_data']['file_name'] );

                    $old_path = $new_path = getcwd().'/files/profile/'.$this->session->userdata('user_id').'/'.$data['upload_data']['file_name'];

                    $this->AddWaterMark(getcwd().'/files/profile/'.$this->session->userdata('user_id').'/'.$data['upload_data']['file_name'],
                        getcwd().'/files/media/watermark1.png');

                    $this->image_thumb( $old_path, $new_path );

                    $this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));

                    $this->session->set_flashdata('msg','Profile picture updated successfully!');

                    redirect('users/profile');

                } else {

                    $error = array('error' => $this->upload->display_errors());

                    foreach ($error as  $flashdata_error) {

                        $this->session->set_flashdata('error_msg',$flashdata_error);

                    }

                }

			} else if ( isset($_POST['user_password']) ) {
				$this->data['tab'] = 'password';
				$this->form_validation->set_rules('new_password', 'New password', 'trim|required');
				$this->form_validation->set_rules('retype_new_password', 'Retype new password', 'trim|required');

				if( $this->form_validation->run() == false ){
					$this->data['row'] = array_merge( $this->data['row'], $_POST );
				} else {

					$new_password = md5($this->config->item('encryption_key').trim($this->input->post('new_password')));
					$retype_new_password = md5($this->config->item('encryption_key').trim($this->input->post('retype_new_password')));

					if ( $new_password != $retype_new_password ){
						$this->session->set_flashdata('error_msg','Passwords are not matching!');
					} else { 

						$data_arr['password'] =  $new_password;
						$this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));

						$params = array(
							'name' => $row['first_name'].' '.$row['last_name'],
							'site_name' => $this->data['core_settings']->site_name,
							'site_email' => $this->data['core_settings']->email,
						);
						send_mail('password-changed', $this->session->userdata('user_id'), $params);

						$this->session->set_flashdata('msg','Password updated successfully!');
						redirect('users/profile');   
					}
				}
			} 
		}

		$this->load->view('templates/header',$this->data);
		$this->load->view('users/profile',$this->data);
		$this->load->view('templates/footer',$this->data);

	}


    public function AddWaterMark($image_url = NULL, $watermark_url = NULL){

        $this->load->library('image_lib');
        $config['source_image'] = $image_url;
        $config['new_image'] = $image_url;
        $config['wm_overlay_path'] = $watermark_url;

        $config['wm_type'] = 'overlay';
        //the overlay image
        $config['wm_opacity'] = 40;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';

//        $config['wm_width'] = 150;
//        $config['wm_height'] = 50;

        $this->image_lib->initialize($config);

        $this->image_lib->watermark();
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
			$this->changeAvatar();
			break;
			default:
			$this->changeAvatar();
			
		}
	}

	public function changeAvatar() {
        $post = isset($_POST) ? $_POST: array();
        $max_width = "2000";
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
        if($size<(3024*3024)) { // Image size max 1 MB
            $actual_image_name = rand(100,999).'_'.$userId .'.'.$ext;
            $filePath = $path .'/'.$actual_image_name;


            $tmp = $_FILES['photoimg']['tmp_name'];
        
        if(move_uploaded_file($tmp, $filePath)){

        $width = $this->getWidth($filePath);
        $height = $this->getHeight($filePath);
        //Scale the image if it is greater than the width set above
//        if ($width > $max_width){
//            $scale = $max_width/$width;
//            $uploaded = $this->resizeImage($filePath,$width,$height,$scale);
//        }else{
//            $scale = 1;
//            $uploaded = $this->resizeImage($filePath,$width,$height,$scale);
//        }

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