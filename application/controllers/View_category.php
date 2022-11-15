<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_category extends My_Controller {

	

	public function __construct() {            

		parent::__construct();

		

		if( $this->user == false ) {

			redirect('login');

		}   

	}

	

	public function view( $category_id = 0 ) {

		$this->data['css_files'] = array(
			base_url('uploadify/uploadify.css'),
			base_url('fine-uploader/fine-uploader-new.css'),
			base_url('assets/pages/css/profile.min.css'),
			base_url('assets/global/plugins/image_grid/images-grid.css'),
		);

		$this->data['js_files'] = array(
			base_url('uploadify/jquery.uploadify.js'),
			base_url('fine-uploader/fine-uploader.js'),
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/global/plugins/image_grid/images-grid.js'),  
			base_url('assets/pages/js/dashboard.js'),            
		);

		$this->data['page_title'] = 'View Group';                           
		$this->data['menu'] = 'dashboard';       
		$this->data['submenu'] = ''; 
		$this->data['category_id'] = $category_id;

		$this->data['category'] = $this->common->get('categories',array('id'=>$category_id));


		$left_join = array(
			'users u'=>'u.id = p.user_id',
		);

		$condition_post = array(
			'p.category_id'=>$category_id,
		);


		$post_array = $this->common->get_all( 'posts p',$condition_post , 'p.*,u.first_name,u.last_name,u.image, u.id userid','p.id desc','','', $left_join);             

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

		$this->data['post_images'] = $post_images;
		$this->data['post_img_array'] = $post_img_array;
		$this->data['post_array'] = $post_array;
		$this->data['ar_post_id'] = $ar_post_id;


		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'view_category/index', $this->data );
		$this->load->view( 'templates/footer', $this->data );

	}

}