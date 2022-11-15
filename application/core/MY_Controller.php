<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Controller extends CI_Controller
{
	var $user = FALSE;
	var $core_settings = false;
	protected $data = array();

	function __construct() {
		parent::__construct();
		//echo $_SESSION['user_id']; exit;

		$this->core_settings = $this->data['core_settings'] = $this->common->get( 'core');
		$this->user = $this->session->userdata('user_id') ? $this->common->get( 'users', array( 'id' => $this->session->userdata('user_id'), 'is_active' => 1 ) ) : FALSE;

        if($this->session->userdata('user_id')){

			$this->data['friend_request_count'] = $this->common->get_total_count('friends',
                array('person_two'=>$this->user->id, 'status'=>0, 'seen'=>0 ));
//
//			$left_join = array(
//				'users u'=>'u.id = f.person_one',
//			);
//
//			$condition = array(
//				'f.status'=>0,
//				'f.person_two'=>$this->user->id,
//
//			);
//
//			$this->data['arr_request_list'] = $this->common->get_all('friends f', $condition, 'f.*, u.first_name, u.last_name, u.image, u.id friend_id','','','', $left_join );



//            $condition_friend = "notify_id = '".$this->user->id."' AND status = 0 AND notify_type IN(2,3)";
//
//            $this->data['friend_request_count'] = $this->common->get_total_count('user_notification', $condition_friend );


            $condion_notify = [
                'notify_id' => $this->user->id,
                'status'=>0
            ];

            $this->data['notification_count'] = $this->common->get_total_count('user_notification', $condion_notify );

            $condion_message = [
                'friend_id_to' =>$this->user->id,
                'seen'=>0
            ];

            $this->data['messages_count'] = $this->common->get_total_count('messages', $condion_message );


		}
	}
}
