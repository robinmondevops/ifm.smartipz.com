<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends My_Controller {

	

	public function __construct() {            

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');uploads

		}   
	}

	public function index() {

		//chmod( base_url('arrowchat/includes/config.php'), 0644); 

		$this->data['css_files'] = array(
			base_url('uploadifive/uploadifive.css'),
			base_url('fine-uploader/fine-uploader-new.css'),
			base_url('assets/pages/css/profile.min.css'),
			base_url('assets/global/plugins/image_grid/images-grid.css'),
		);

		$this->data['js_files'] = array(
			base_url('uploadifive/jquery.uploadifive.js'),
			base_url('fine-uploader/fine-uploader.js'),
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/global/plugins/image_grid/images-grid.js'),  
			base_url('assets/pages/js/dashboard.js'),            
		); 

		$this->data['page_title'] = 'Home';                           
		$this->data['menu'] = 'dashboard';       
		$this->data['submenu'] = '';

		$user_id = $this->session->userdata('user_id'); 

		$left_join = array(
			'categories c' => 'c.id=uc.category_id',
		);

		$condition = array(
			'uc.user_id'=>$this->session->userdata('user_id'),
		);

		$this->data['categories'] = $this->common->get_all('user_categories uc',$condition,'c.*,uc.category_id','','','',$left_join );



		$condition = "f.user_id = $user_id AND f.status = 1 AND f.deactive = 0";

		$arr_frnd = $this->common->get_all('friends_list f', $condition, 'f.friend_id');

		$arr_frnd = array_map('current', $arr_frnd);
		$string_list = '('.implode(',', $arr_frnd).')';

		$left_join = array(
			'users u'=>'u.id = p.user_id',
			'users post_owner'=>'post_owner.id = p.share_from',
		);

		$condition_post = array(
			'u.id'=>$this->session->userdata('user_id'),
			
		);          


		$post_array = $this->common->get_all( 'posts p',$condition_post , 'p.*,u.first_name,u.last_name,u.image, u.id userid, post_owner.first_name owner_first_name, post_owner.last_name owner_last_name','p.id desc','','', $left_join);

		             

		$ar_post_id =array();
		$post_images =array();
		$post_img_array =array();
		
		foreach ($post_array as $key => $post) {

			$ar_post_id[$key] = $post->id;

			//echo "<pre>"; print_r($post); exit;
		

			$post_images[$post->id] = $this->common->get_all( 'post_image', array('post_id'=>$post->id) );

			$post_img_array[$post->id] = array();

			foreach ($post_images[$post->id] as $key => $image) {

				$post_img_array[$post->id][] = base_url('images/post_images/'.$post->id.'/'.$image->image);
			}

			

		}

		//echo $this->db->last_query(); exit;  

		$this->data['post_images'] = $post_images;
		$this->data['post_img_array'] = $post_img_array;
		$this->data['post_array'] = $post_array;
		$this->data['ar_post_id'] = $ar_post_id;  

		
		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'dashboard/index', $this->data );
		$this->load->view( 'templates/footer', $this->data );

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


}