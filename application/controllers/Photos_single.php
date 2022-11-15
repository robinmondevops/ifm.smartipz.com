<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos_single extends My_Controller {

	

	public function __construct() {            

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   

	}

	

	public function view( $user_id ) {

		$this->data['css_files'] = array(
			base_url('uploadify/uploadify.css'),
			base_url('assets/pages/css/profile.min.css'),
            base_url('assets/global/css/prettyPhoto.css')
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),
			base_url('uploadify/jquery.uploadify.js'),
			base_url('assets/pages/js/photos.js'),
            base_url('assets/global/scripts/jquery.prettyPhoto.js'),
		); 

		$this->data['page_title'] = 'Photos';                           
		$this->data['menu'] = 'single_photos';       
		$this->data['submenu'] = '';

		$this->data['arr_profile_pic'] = $this->common->get_all('profile_pics',array('user_id'=>$user_id ) ); 

		$condition = array(

			'user_id' => $user_id,
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
		$this->data['user_id'] = $user_id; 

		$this->data['user'] = $this->common->get('users',array('id'=>$user_id ) );   

		//echo "<pre>"; print_r($this->data['arr_albm']); exit;

        $this->data['arr_album_pic'] = $this->common->get_all('album_image',array('album_id'=>$user_id ) );

//        echo "<pre>"; print_r($this->data['arr_album_pic']); exit;


		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'photos_single/index', $this->data );
		$this->load->view( 'templates/footer', $this->data );

	} 

	public function user_categories( $user_id ) {

        $visit_id = $user_id;

		$this->data['css_files'] = array(
			base_url('assets/pages/css/profile.min.css'),
			base_url('assets/global/plugins/image_grid/images-grid.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),  
			base_url('assets/global/plugins/image_grid/images-grid.js'),           
			base_url('assets/pages/js/user_categories.js'),            
			base_url('assets/pages/js/upgrade_pop.js'),
		);

		$this->data['page_title'] = 'User Dashboard';                           
		$this->data['menu'] = 'single_dashboard';       
		$this->data['submenu'] = '';

        $arr_left_join = [
            'countries c' => 'c.id = u.country_id',
            'state s' => 's.id = u.state',
            'district d' => 'd.id = u.district',
            'profile_type p' => 'p.id = u.profile_type',
        ];

		$friend = $this->common->get('users u',array('u.id'=>$user_id ), 'object',
            'u.*,c.country country_name, s.name state_name, d.name district_name, p.name profile_created', $arr_left_join );

		$this->data['user'] = $friend;


		$user_id_loged = $this->user->id;
	    $friend_id = $friend->id;
	    
	    $friend_status = get_friend_status( $user_id_loged, $friend_id );


	    $this->data['action'] = $friend_status['action'];      
	    $this->data['label'] = $friend_status['label'];


        $user_id = $this->user->id;

        $row_contact = $this->common->get('user_contacts', ['user_id' => $user_id , 'contacted_user'=>$friend_id] );
        $this->data['is_open_contact'] = 0;
        if( $row_contact ){
            $this->data['is_open_contact'] = 1;
        }
        $friend_status = get_friend_status( $user_id, $friend_id );

        $friend_basic_details = $this->common->get('basic_details',['user_id'=>$friend_id]);

        $left_join = array(
            'edu_category_list cl' => 'pd.edu_item=cl.id',
        );

        $friend_occ_details = $this->common->get('profectional_details pd',
            ['user_id'=>$friend_id],'','', $left_join);


        $arr_details = [];
        $arr_details[] = $friend_basic_details->age.' Yrs';
        $arr_details[] = $friend_occ_details['name'];
        $arr_details[] = $friend->city;
        $arr_details[] = $friend->district_name;
        $arr_details[] = $friend->state_name;
        $arr_details[] = $friend->country_name;

        $str_details = implode(' , ', array_filter($arr_details));
        $this->data['str_details'] = $str_details;

        $arr_left_join_prof = [
            'edu_category_list el' => 'el.id = p.edu_item',
            'edu_category e' => 'e.id = el.category_id',
            'occ_category_list ol' => 'ol.id = p.occ_item',
            'occ_category o' => 'o.id = ol.category_id',

        ];


        $row_prof = $this->common->get('profectional_details p', array( 'p.user_id' => $friend_id ), 'array',
            'p.*, e.name edu_category_name, el.category_id,el.name edu_stream, o.name occ_cat, ol.name occ_name',  $arr_left_join_prof);

        $row_family = $this->common->get('family_details', array( 'user_id' => $friend_id ), 'array', '' );

        $this->data['row_family'] = $row_family;
        $this->data['friend_basic_details'] = $friend_basic_details;
        $this->data['row_prof'] = $row_prof;

        $this->data['total_brother'] = $row_family['no_brother_married'] + $row_family['no_brother_married'];
        $this->data['total_sister'] = $row_family['no_sister_married'] + $row_family['no_sister_unmarried'];

        //insert as user already seen this profile

        $data_array = [
            'visitor_id'=>$this->user->id,
            'host_id'=>$visit_id,
        ];

        $this->common->delete('visited_profiles', $data_array);

        $this->common->insert('visited_profiles', $data_array);

        // for notify insert

        $data_notify = [
          'notify_id' =>$visit_id,
          'notify_from' =>$this->user->id,
          'notify_type' =>1,
          'created_at' =>date('Y-m-d H:i:s'),
        ];

        $conditon_notify = [
            'notify_id' =>$visit_id,
            'notify_from' =>$this->user->id,
            'notify_type' =>1,
        ];

        $this->common->delete('user_notification', $conditon_notify);

        if( $visit_id != $this->user->id ){
            $this->common->insert('user_notification', $data_notify);
        }



		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'single_dashboard/index', $this->data );
        $this->load->view( 'popup/upgrade_pop', $this->data );       // for upgrade popup
		$this->load->view( 'templates/footer', $this->data );

	} 

	public function friends( $friend_id = 0 ){

		$this->data['css_files'] = array(
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/pages/js/friend_list.js'),            
		); 

		$this->data['page_title'] = 'Friends List';
		$this->data['menu'] = 'friends';
		$this->data['submenu'] = '';

		$this->data['user_id'] = $friend_id;

		$this->data['user'] = $this->common->get('users',array('id'=>$friend_id ) );

		

		$left_join = array(
			'users u'=>'u.id = f.person_one or u.id = f.person_two',
		);

		$condition = "(f.person_two = ".$friend_id." OR f.person_one = ".$friend_id.") AND f.status = 1 AND u.id != ".$friend_id;

		

		$this->data['arr_friend_list'] = $this->common->get_all('friends f', $condition, 'f.*, u.first_name, u.last_name, u.image, u.id friend_id','','','', $left_join );

		

		$this->load->view('templates/header', $this->data);
		$this->load->view('friend_list/user_friend_list', $this->data);   
		$this->load->view('templates/footer', $this->data);

	}






}