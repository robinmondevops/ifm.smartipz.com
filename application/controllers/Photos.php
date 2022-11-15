<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends My_Controller {

	

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
            base_url('assets/global/css/prettyPhoto.css'),
            base_url('assets/global/plugins/dropzone/dist/min/dropzone.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),
			base_url('uploadify/jquery.uploadify.js'),
			base_url('fine-uploader/fine-uploader.js'),
			base_url('assets/pages/js/photos.js'),
            base_url('assets/global/scripts/jquery.prettyPhoto.js'),
            base_url('assets/global/plugins/dropzone/dist/min/dropzone.min.js'),
		); 

		$this->data['page_title'] = 'Photos';                           
		$this->data['menu'] = 'photos';       
		$this->data['submenu'] = '';

		$this->data['arr_profile_pic'] = $this->common->get_all('profile_pics',array('user_id'=>$this->user->id ) ); 

		$condition = array(

			'user_id' => $this->user->id,
		);

		$arr_albm = array();		

		$user_album = $this->common->get_all('album', $condition); 

		foreach ($user_album as $key => $album) {
			$arr_albm[$key]['id'] = $album->id;
			$arr_albm[$key]['title'] = $album->title;
			$arr_albm[$key]['description'] = $album->description;
			$album_image = $this->common->get('album_image', array('album_id'=>$album->id));
			$arr_albm[$key]['image'] = $album_image->image;
			$arr_albm[$key]['thumb'] = $album_image->thumb;
		}

		$this->data['arr_albm'] = $arr_albm;   

		//echo "<pre>"; print_r($this->data['arr_albm']); exit;

        $this->data['arr_album_pic'] = $this->common->get_all('album_image',array('album_id'=>$this->user->id ) );

        $count_pics = count( $this->data['arr_album_pic'] );

        $pics_balance = 20 - $count_pics;
        $this->data['pics_balance'] = $pics_balance;


		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'photos/index', $this->data );
		$this->load->view( 'templates/footer', $this->data );

	}

    public function create_image(){

        $user_id = $this->session->userdata('user_id');

        if(!empty($_FILES)){

            // File path configuration
            $uploadDir = "uploads/";
            $uploadDirNew = "images/client_images/.$user_id";

            if( !file_exists( getcwd().'/images/client_images/'.$user_id ) ) {

                mkdir( getcwd().'/images/client_images/'.$user_id );

            }

            $fileName = rand(111,999).basename($_FILES['file']['name']);
            $uploadFilePath = $uploadDir.$fileName;

            $extension =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            $fileName_new = rand(111,999).'_'.$user_id.'.'.$extension;

            // Upload file to server
            if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)){
                // Insert file information in the database

                rename( getcwd().'/uploads/'.$fileName, getcwd().'/images/client_images/'.$user_id.'/'.$fileName_new );

                $this->AddWaterMark(getcwd().'/images/client_images/'.$user_id.'/'.$fileName_new,
                    getcwd().'/files/media/watermark1.png');

                $this->load->library('image_lib');

                $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  getcwd().'/images/client_images/'.$user_id.'/'.$fileName_new,
                    'maintain_ratio'  =>  TRUE,
                    'width'           =>  640,
                    'height'          =>  480,
                );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

                $old_path = getcwd().'/images/client_images/'.$user_id.'/'.$fileName_new;
                $new_path = getcwd().'/images/client_images/'.$user_id.'/t-'.$fileName_new;

                if( @getimagesize($old_path) ) {
                    $this->image_thumb( $old_path, $new_path );
                    if( file_exists($new_path) ) {
                        $thumb = 't-'.$fileName_new;
                    } else {
                        $thumb = $fileName_new;
                    }
                } else {
                    $thumb = $fileName_new;
                }


                $data_arr =[
                    'album_id'=>$user_id,
                    'image'=>$fileName_new,
                    'thumb'=>$thumb,
                ];
                $this->common->insert('album_image',$data_arr);
            }


        }

    }


    public function AddWaterMark($image_url = NULL, $watermark_url = NULL)
    {
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

	public function load_form(  ) {

		$html = $this->load->view('photos/_form_album', $this->data, true);

		$response = array(
			'status' => 'success',
			'html' => $html,
		);
		header('Content-type: application/json');
		die(json_encode($response));

	}

	public function set_profile(){

		$pic_id = $this->input->post('pic_id');
		$pic_name = $this->input->post('pic_name');
		$data_arr['image'] = $pic_name;
		$this->common->update('users',$data_arr, array('id' => $this->session->userdata('user_id') ));

		$image_left = $this->load->view('photos/_image_left', array('pic_name'=>$pic_name), true);
		$image_top = $this->load->view('photos/_image_top', array('pic_name'=>$pic_name), true);

		$response = array(
			'status' => 'success',
			'image_left' => $image_left,
			'image_top' => $image_top,
		);
		header('Content-type: application/json');
		die(json_encode($response));

	}


	public function delete_profile(){

		$pic_id = $this->input->post('pic_id');

        $row = $this->common->get('profile_pics',array('id' => $pic_id ) );

        $image_name = $row->name;
        $path = FCPATH.'files/profile/'.$this->user->id.'/'.$image_name;

        @unlink($path);  // for deleting image

		$this->common->delete('profile_pics',array('id' => $pic_id ) );

		$response = array(
			'status' => 'success',
		);

		header('Content-type: application/json');
		die(json_encode($response));

	}

	public function save_album(){

		ini_set('memory_limit', '-1');
    	ini_set('max_execution_time', '0');
        set_time_limit('0');


        $user_id = $this->session->userdata('user_id');

		$uploaded_files = explode( '||', $this->input->post('uploaded_files') );
			
		if( !file_exists( getcwd().'/images/client_images/'.$user_id ) ) {
			mkdir( getcwd().'/images/client_images/'.$user_id );
		}
		$i = 0;
		foreach( $uploaded_files as $filename ) {    
			if( $filename != '' &&  file_exists( getcwd().'/uploads/'.$filename ) ) {
				$new_name = rand(100, 999).'.jpg';

				rename(getcwd().'/uploads/'.$filename, getcwd().'/images/client_images/'.$user_id.'/'.$new_name );
					
				$old_path = getcwd().'/images/client_images/'.$user_id.'/'.$new_name;  
				$new_path = getcwd().'/images/client_images/'.$user_id.'/t-'.$new_name; 

				$data_arr = array(
					'album_id' => $user_id,
				);    

				if( @getimagesize($old_path) ) {
					$this->image_thumb( $old_path, $new_path );
					if( file_exists($new_path) ) {
						$data_arr['thumb'] = 't-'.$new_name;
					} else {
						$data_arr['thumb'] = $new_name;
					}
				} else {
					$data_arr['thumb'] = $new_name;
				} 

				$data_arr['image'] = $new_name;  
				$this->common->insert( 'album_image', $data_arr );
				$i++;
			}
			
		}



        $arr_album_pic= $this->common->get_all('album_image',array('album_id'=>$this->user->id ) );

		$html = $this->load->view('photos/_album_list',array('arr_album_pic'=>$arr_album_pic), true);

		$response = array(
			'status' => 'success',
			'html' => $html,
		);
		header('Content-type: application/json');
		die(json_encode($response));


	}


	function image_thumb( $old_path = '', $new_path = '' ) {
		  // basic info
		//ini_set('memory_limit', '1024M'); 
		ini_set('memory_limit', '-1');
        $pathinfo = pathinfo($old_path);
        $original = $old_path;
        // original image not found, show 404
        if (!file_exists($original)) {
            show_404($original);
        }
		
        $width = 600; 
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


    public function delete_pic(){

        $pic_id = $this->input->post('pic_id');
        $row = $this->common->get('album_image',array('id' => $pic_id ) );

        $image_name = $row->image;
        $path = FCPATH.'images/client_images/'.$this->user->id.'/'.$image_name;
        $path1 = FCPATH.'images/client_images/'.$this->user->id.'/t-'.$image_name;

        @unlink($path);
        @unlink($path1);

        $this->common->delete('album_image',array('id' => $pic_id ) );

        $count = $this->common->get_total_count('album_image',array('id' => $pic_id ));

        if( $count == 0 ){
            $this->common->delete('album',array('id' => $row->album_id ) );
        }

        $response = array(
            'status' => 'success',
        );
        header('Content-type: application/json');
        die(json_encode($response));

    }


}