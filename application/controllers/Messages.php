<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends My_Controller {

	

	public function __construct() {            

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   
	}

	public function index() {

        $condion_message = [
            'friend_id_to' =>$this->user->id,
        ];

        $data_array = [
            'seen'=>1
        ];

        $this->common->update('messages',$data_array, $condion_message );

		//chmod( base_url('arrowchat/includes/config.php'), 0644); 

		$this->data['css_files'] = array(
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'), 
			base_url('assets/pages/js/messages.js'),
		); 

		$this->data['page_title'] = 'Home';                           
		$this->data['menu'] = 'messages';       
		$this->data['submenu'] = '';


        $join_left_arr = array(
            'users u' => 'u.id = t.user_id_from',
            'users u1' => 'u1.id = t.friend_id_to',
        );

        $condition = 't.friend_id_to ='.$this->user->id.' OR t.user_id_from ='.$this->user->id;

        $this->data['messages'] = $this->common->get_all( 'messages t', $condition,
            't.*, u.first_name, u.last_name,u.image,u1.image image_1,u1.first_name first_name1, u1.last_name last_name1',
            't.id desc', '', '', $join_left_arr,'','','');

//        echo "<pre>"; print_r($this->data['messages']); exit;

//        $this->data['messages'] = $this->common->get_all( 'messages t', $condition, 't.*, u.first_name, u.last_name,u.image', '', '', '', $join_left_arr,'','','t.user_id_from');
		
		$this->load->view( 'templates/header', $this->data );
		$this->load->view( 'messages/index', $this->data );
		$this->load->view( 'templates/footer', $this->data );

	}



    public function send_message( $user_id ) {

        //chmod( base_url('arrowchat/includes/config.php'), 0644);

        $user_id = decrypt($user_id)*1;
        if( !is_int($user_id) || !$user_id ) {
            redirect('dashboard_one');
        }

        $row = $this->common->get('users', array( 'id' => $user_id ), 'array', '' );

        $join_left_arr = array('users u' => 'u.id = t.user_id_from');

        $condition = '(t.friend_id_to ='.$this->user->id.' AND t.user_id_from ='.$row['id'].') OR
        (t.friend_id_to ='.$row['id'].' AND t.user_id_from ='.$this->user->id.')';

        $this->data['messages'] = $this->common->get_all( 'messages t', $condition, 't.*, u.first_name, u.last_name,u.image', 'id asc', '', '', $join_left_arr);

        if( count($row) == 0 ) {
            redirect('dashboard_one');
        }

        $this->data['row'] = $row;


        $this->data['css_files'] = array(
            base_url('assets/pages/css/profile.min.css'),
        );

        $this->data['js_files'] = array(
            base_url('assets/pages/js/profile.min.js'),
            base_url('assets/pages/js/ticket.js?ver=1.0.2'),
        );

        $this->data['page_title'] = 'Home';
        $this->data['menu'] = 'messages';
        $this->data['submenu'] = '';
        $this->data['user_id'] = $user_id;


        $this->load->view( 'templates/header', $this->data );
        $this->load->view( 'messages/send_message', $this->data );
        $this->load->view( 'popup/upgrade_pop', $this->data );
        $this->load->view( 'templates/footer', $this->data );

    }

    public function insert_message(){

        $content  = $_POST['notes'];

        $friend_id_to  = $_POST['friend_id_to'];
        $user_id_from  = $this->user->id;

        $licence_id = is_user_has_licence( $user_id_from );


        if( !$licence_id ){

            $status = 'error';
            $licence_id = 0;
            $url = '';

            $return =[
                'status'=>$status
            ];

        }else{

            $data_arr = array(
                'user_id_from' => $user_id_from,
                'friend_id_to'=> $friend_id_to,
                'message'=> $content,

            );

            $id = $this->common->insert( 'messages', $data_arr );

            if($id){
                $return = [
                    'status'=>'success',
                ];
            }

        }


        echo json_encode($return); exit;



    }




}