<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_inner extends My_Controller {
	

	public function __construct() {   



		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   

	}

	

	public function view( $album_id = 0 ) {  



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
		$this->load->view( 'photos_inner/index', $this->data );
		$this->load->view( 'templates/footer', $this->data );

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


	public function delete_pic(){

		$pic_id = $this->input->post('pic_id');
		$row = $this->common->get('album_image',array('id' => $pic_id ) );
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

	public function save_album(){

		ini_set('memory_limit', '-1');
    	ini_set('max_execution_time', '0');
        set_time_limit('0');

        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $user_id = $this->session->userdata('user_id');

        $data_arr = array(
        	'title'=>$name,
        	'description'=>$description,
        	'user_id'=>$user_id,
    	);

        $album_id = $this->common->insert('album',$data_arr);

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
					'album_id' => $album_id,
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

		$condition = array(

			'user_id' => $user_id,
			'image !=' => '',
		);

		$join_left = array(
			'album_image ai'=>'a.id=ai.album_id',
		);

		$arr_albm = $this->common->get_all('album a', $condition, 'a.*, ai.id image_id, ai.album_id, ai.image, ai.thumb','','','',$join_left,'','','a.id');

		$html = $this->load->view('photos/_album_list',array('arr_albm'=>$arr_albm), true);  

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


}