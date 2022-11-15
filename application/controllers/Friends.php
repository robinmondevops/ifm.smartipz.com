<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends My_Controller {

	

	public function __construct() {            

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   

	}

    public function has_licence(){

        $user_id = $this->input->post('user_id');
        $friend_id = $this->input->post('friend_id');

        $licence_id = is_user_has_licence( $user_id );


        if( !$licence_id ){

            $status = 'error';
            $licence_id = 0;
            $url = '';

        }else{
            $status = 'success';
            $url = site_url('messages/send_message/'.encrypt($friend_id));

        }

        $response = [
            'status'=>$status,
            'licence_id'=>$licence_id,
            'redirect_url'=>$url,
        ];

        header('Content-type: application/json');
        die(json_encode($response));

    }


    public function has_licence_contact(){

        $user_id = $this->input->post('user_id');
        $friend_id = $this->input->post('friend_id');

        $row_friend = $this->common->get('users', ['id'=>$friend_id] );

        $this->data['row_friend'] = $row_friend;

        $licence_id = is_user_has_licence( $user_id );

        $balance_contact = 0;
        $contact_available = 0;
        $contacts_taken = 0;
        $html_contact = '';

        if( !$licence_id ){

            $status = 'error';
            $licence_id = 0;

        }else{

            $status = 'success';
            $contact_result = is_user_has_licence_contact( $user_id, $licence_id );
            $contact_available = $contact_result['is_available'];
            $contacts_taken = $contact_result['contacts_taken'];

            $html_contact = $this->load->view('popup/view_contact', $this->data, true);

            if($html_contact){

                $data_array_condition = [
                    'user_id'=>$user_id,
                    'contacted_user'=>$friend_id,
                ];

                $array_contacts = $this->common->get_all('user_contacts', $data_array_condition );

                if( count($array_contacts)==0 ){

                    $data_array = [
                        'user_id'=>$user_id,
                        'contacted_user'=>$friend_id,
                        'licence_id'=>$licence_id,
                    ];

                    $this->common->insert('user_contacts', $data_array );

                }

            }

        }

        $response = [
            'status'=>$status,
            'licence_id'=>$licence_id,
            'html_contact'=>$html_contact,
            'contacts_taken'=>$contacts_taken,
            'contact_available'=>$contact_available,
        ];

        header('Content-type: application/json');
        die(json_encode($response));

    }

	

	public function friend_request() {

		$user_id = $this->input->post('user_id');
		$friend_id = $this->input->post('friend_id');

		$arr_user_cat = $this->common->get_all('user_categories', array('user_id'=>$user_id),'','','','','','','','','array' );
		$arr_friend_cat = $this->common->get_all('user_categories', array('user_id'=>$friend_id),'category_id','','','','','','','','array' );

		$user_cat = array_column($arr_user_cat, 'category_id');
		$friend_cat = array_column($arr_friend_cat, 'category_id');

		$common_array = array_intersect($user_cat, $friend_cat);

		//$count = count($common_array);  
		if ( !empty($common_array) || true ){

			$arr_data = array(
				'person_one' =>  $user_id,
				'person_two' =>  $friend_id,
				'created_at' =>  date('Y-m-d H:i:s'),
			);

			$this->common->insert('friends',$arr_data);

            // notification row

            $data_notify = [
                'notify_id' =>$friend_id,
                'notify_from' =>$user_id,
                'notify_type' =>2,
                'created_at' =>date('Y-m-d H:i:s'),
            ];

            if( $friend_id != $user_id ){
                $this->common->insert('user_notification', $data_notify);
            }

			$response = array(
				'status' => 'success',
			);

		} else {
			$response = array(
				'status' => 'error',
			);

		}

		header('Content-type: application/json');
		die(json_encode($response));

	} 


	public function requested_list( $user_id = 0) {


		$this->data['css_files'] = array(
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/pages/js/friend_request.js'),            
		); 

		$this->data['page_title'] = 'Friend Request';
		$this->data['menu'] = 'friends';
		$this->data['submenu'] = '';

		
		$left_join = array(
			'users u'=>'u.id = f.person_one',
		);

		$condition = array(
			'f.status'=>0,
			'f.person_two'=>$user_id,
		);

		$this->data['arr_request'] = $this->common->get_all('friends f', $condition, 'f.*, u.first_name, u.last_name, u.image, u.id friend_id','','','', $left_join );
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('friend_request/index', $this->data);   
		$this->load->view('templates/footer', $this->data);
		

	}


	public function accept_request() {     

		$user_id = $this->input->post('user_id');
		$friend_id = $this->input->post('friend_id');

		$condition = array(
			'person_one' =>  $friend_id,
			'person_two' =>  $user_id,
		);

		$this->common->update('friends', array('status'=>1), $condition);

		$this->common->insert( 'friends_list', array('user_id'=>$friend_id,'friend_id'=>$user_id,'status'=>1) );
		$this->common->insert( 'friends_list', array('user_id'=>$user_id,'friend_id'=>$friend_id,'status'=>1) );

        // notification accept

        $data_notify = [
            'notify_id' =>$friend_id,
            'notify_from' =>$user_id,
            'notify_type' =>3,
            'created_at' =>date('Y-m-d H:i:s'),
        ];

        if( $friend_id != $user_id ){
            $this->common->insert('user_notification', $data_notify);
        }


		$response = array(
			'status' => 'success',   
		);

		header('Content-type: application/json');
		die(json_encode($response));

	}

	public function update_req_notify($user_id = 0){
		if( $user_id > 0 ){
			$condition = array(
				'person_two' =>  $user_id,
			);

			$this->common->update('friends', array('seen'=>1), $condition);

			$response = array(
				'status' => 'success',   
			);

			header('Content-type: application/json');
			die(json_encode($response));

		}
	}


	public function user_friends(){


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

		$user_id = $this->session->userdata('user_id');

		$left_join = array(
			'users u'=>'u.id = f.person_one or u.id = f.person_two',
		);

		$condition = "(f.person_two = ".$user_id." OR f.person_one = ".$user_id.") AND f.status = 1 AND u.id != ".$user_id;

		$this->data['arr_friend_list'] = $this->common->get_all('friends f', $condition, 'f.*, u.first_name, u.last_name, u.image, u.id friend_id','','','', $left_join );

		$this->load->view('templates/header', $this->data);
		$this->load->view('friend_list/index', $this->data);   
		$this->load->view('templates/footer', $this->data);

	}


	public function unfriend() {

		$user_id = $this->input->post('user_id');
		$friend_id = $this->input->post('friend_id');

		

		$condition = '( person_one =  '.$user_id.' or person_two =  '.$user_id.') AND ( person_one =  '.$friend_id.' or person_two =  '.$friend_id.')';

		$condition_friend_list = '( user_id =  '.$user_id.' or friend_id =  '.$user_id.') AND ( user_id =  '.$friend_id.' or friend_id =  '.$friend_id.')';

		$this->common->delete('friends',$condition);        
		$this->common->delete('friends_list',$condition_friend_list);

        $this->common->insert('tbl_declient',['user_id'=>$user_id, 'friend_id'=>$friend_id]);

		$response = array(
			'status' => 'success',   
		);

		header('Content-type: application/json');
		die(json_encode($response));

	} 



	public function update_req_like($user_id = 0){

		if( $user_id > 0 ){


			$arr_posts = $this->common->get_all('posts', array('user_id'=>$user_id));
			foreach ($arr_posts as  $post) {

				$condition = array(
					'post_id' =>  $post->id,
				);

				$this->common->update('post_like', array('seen'=>1), $condition);
				$this->common->update('post_share', array('seen'=>1), $condition);
			}

			$response = array(
				'status' => 'success',   
			);

			header('Content-type: application/json');
			die(json_encode($response));

		}
	}



	// public function update_req_share($user_id = 0){

	// 	if( $user_id > 0 ){


	// 		$arr_posts = $this->common->get_all('posts', array('user_id'=>$user_id));
	// 		foreach ($arr_posts as  $post) {

	// 			$condition = array(
	// 				'post_id' =>  $post->id,
	// 			);

	// 			$this->common->update('post_share', array('seen'=>1), $condition);
	// 		}

	// 		$response = array(
	// 			'status' => 'success',   
	// 		);

	// 		header('Content-type: application/json');
	// 		die(json_encode($response));

	// 	}
	// }





}