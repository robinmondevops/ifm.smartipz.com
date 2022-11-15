<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends My_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function register(){

		if ( $this->session->userdata('logged_in') ) {
			redirect('/dashboard_one');
		}

		$this->data['js_files'] = array(
			base_url('assets/pages/js/register.js?ver=1.0.1')
		);

		$this->data['page_title'] = 'Sign Up';
		$this->data["row"] = array(
			'first_name' => '',
			'last_name' => '',
			'email' => '',
			'phone' => '',
			'gender' => '',
			'password' => '',
			'rpassword' => '',
			'tnc' => '',
			'profile_type' => '',
			'country_id' => '',
			'state' => '',
			'district' => '',
			'city' => '',
			'country_code' => 78,
		);

		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',  array('is_unique' => 'This email is already being used by someone.'));
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_unique[users.phone]');

		$this->form_validation->set_rules('country_id', 'Country', 'trim|required');


		$this->form_validation->set_rules('city', 'City', 'trim|required');

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|matches[rpassword]');
		$this->form_validation->set_rules('rpassword', 'Re-type Password', 'trim|required');
		$this->form_validation->set_rules('tnc', 'Terms and Conditions', 'trim|required');

        $this->form_validation->set_rules('profile_type', 'Profile For', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if( $_POST ){



            if( $this->input->post('country_id') == 78 ){

                $this->form_validation->set_rules('state', 'State', 'trim|required');
                $this->form_validation->set_rules('district', 'District', 'trim|required');

            }

            if( in_array( trim($this->input->post('profile_type')), [0,1,6,7] )){

                $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

                $gender = trim($this->input->post('gender'));

            }else{

                if( in_array( trim($this->input->post('profile_type')), [2,4] )){
                    $gender = 'AF';
                }else{
                    $gender = 'AL';
                }

            }



			$_POST['terms'] = isset($_POST['terms']) ? 1 : '';

			if( !$this->form_validation->run() ) {

				$this->data["row"] = array_merge( $this->data["row"], $_POST );

			} else {


				$key = random_string();

                $kna_id = create_kna_id();

				$user_arr = array(
					'email'=> trim($this->input->post('email')),
					'first_name'=> trim($this->input->post('first_name')),
					'password' => md5( $this->config->item('encryption_key').$this->input->post('password') ),
					'profile_type' => trim($this->input->post('profile_type')),
					'phone' => trim($this->input->post('phone')),
					'country_code' => trim($this->input->post('country_code')),
					'country_id' => trim($this->input->post('country_id')),
					'city' => trim($this->input->post('city')),
                    'gender' => $gender,
                    'kna_id' => $kna_id,
					'group_id' => 2,
					'invite_key' => $key,
					'is_active' => 2,
					'created_at' => date('Y-m-d H:i:s'),
				);

                if( $this->input->post('country_id') == 78 ){
                    $user_arr['state'] =  trim($this->input->post('state'));
                    $user_arr['district'] =  trim($this->input->post('district'));
                }

				$user_id = $this->common->insert( 'users', $user_arr );



				$click_here = 'Your Knanaya Matrimony ID Is : KNA'.$kna_id.'</br> <a href="'.site_url('activate/'.$key).'" target="_blank">'.site_url('activate/'.$key).' </a>';
				$params = array(
					'name' => trim($this->input->post('first_name')).' '.trim($this->input->post('last_name')),
					'invite-url' => $click_here,
					'site_name' => $this->data['core_settings']->site_name,
					'site_email' => $this->data['core_settings']->email,
				);

				send_mail('invite-user', $user_id, $params);

                $name_sms = trim($this->input->post('first_name')).' '.trim($this->input->post('last_name'));
                $site_name = $this->data['core_settings']->site_name;

                $sms_parms = [
                    'phone' => trim($this->input->post('phone')),
                    'message' => 'Hi '.$name_sms.', You have registered to '.$site_name.'. Your Knanaya Matrimony ID Is : KNA'.$kna_id.'. please click the link to get activated '.urldecode(site_url("activate/".$key)),
                ];

//                echo "<pre>"; print_r($sms_parms); exit;

                $res = send_single_sms( $sms_parms );


				$this->session->set_flashdata('msg','Please check your email or SMS to activate your account!');

				redirect('/');
			}
		}

        $arr_profile_type = $this->common->get_all('profile_type' );
        $this->data['arr_profile_type'] = $arr_profile_type;
        $this->data['arr_state'] = $this->common->get_all('state' );
        $this->data['arr_country'] = $this->common->get_all('countries' );

        $this->data['arr_district'] = [];

        if($this->data["row"]['state'] != '' ){

            $this->data['arr_district'] = $this->common->get_all('district', ['state_id' => $this->data["row"]['state'] ] );
        }



		$this->data['csrf'] = array(
		    'name' => $this->security->get_csrf_token_name(),
		    'hash' => $this->security->get_csrf_hash()
		);

		$this->load->view('templates/header_ui', $this->data);
		$this->load->view('auth/register', $this->data);
		$this->load->view('templates/footer_ui', $this->data);
	}



    public function change_district(){

        $state_id = $this->input->post('state_id');
        $result = $this->common->get_all('district', array( 'state_id' => $state_id ), 'id, name');
        $html = '<option value="">Select</option>';
        foreach($result as $row) {
            $html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        header('Content-type: application/json');
        die(json_encode( array('html' => $html) ));
    }

	public function login() {

		if ( $this->session->userdata('logged_in') && ( $this->session->userdata('group_id') == 2 ) ) {
			redirect('dashboard_one');
		}

        $this->data['js_files'] = array(
            base_url('assets/pages/js/login.js?ver=1.0.0')
        );

		$this->data['error'] = '';
		$this->data['page_title'] = 'Sign In';

		if ( $_POST ){

			$email = trim($this->input->post('username'));
			$password = md5($this->config->item('encryption_key').trim($this->input->post('password')));

            $email = trim( strtolower($email) ,"kna");

			if($email && $password){

				$condition = '( lower(email) = "'.strtolower($email).'" OR phone  = "'.$email.'"
				OR  kna_id  = "'.$email.'"  ) AND password = "'.$password.'" AND is_active = 1 AND group_id = 2';
				$user = $this->common->get('users', $condition);

				if( !empty($user) ){

					$cookie_chat = array(
						'name' => 'chat_id',
						'value' => $user->id,
						'expire' => '2592000'
					);
					set_cookie($cookie_chat);

					if ( $this->input->post('remember') == 1 ) {

						$cookie = array(
							'name' => 'booup_username',
							'value' => $email,
							'expire' => '2592000'
						);
						set_cookie($cookie);

					} else {

						$cookie = array(
							'name' => 'booup_username',
							'value' => '',
							'expire' => '1'
						);
						set_cookie($cookie);
					}

					if ( $user->is_active == 1 ) {
						$sess_array = array(
							'username'       => $user->email,
							'email'          => $user->email,
							'user_id'        => $user->id,
							'logged_in' => TRUE,
							'group_id'       => $user->group_id,
						);
						$this->session->set_userdata($sess_array);

						$this->common->update('users', array( 'last_login' => date('Y-m-d H:i:s') ), array( 'id' => $user->id ) );
						redirect('dashboard_one');
					} else {
						$this->data['error'] = 'Your account is not active. Please contact admin.';
					}
				}else {

					$condition = 'lower(email) = "'.strtolower($email).'" AND password = "'.$password.'" AND is_active = 2 AND group_id = 2';
					$deactivated_user = $this->common->get('users', $condition);
					if( !empty($deactivated_user) ){
						$this->data['error'] = 'Your account is not activated, please check your mail or contact admin';
					} else {
						$this->data['error'] = 'Invalid Email or Password';
					}


				}

			} else {
				$this->data['error'] = 'Invalid Email or Password';
			}
		}

		$this->data['csrf'] = array(
		    'name' => $this->security->get_csrf_token_name(),
		    'hash' => $this->security->get_csrf_hash()
		);

		$this->load->view('templates/header_ui', $this->data);
		$this->load->view('auth/login', $this->data);
		$this->load->view('templates/footer_ui', $this->data);
	}

	public function forgot_password(){

		if ($this->session->userdata('logged_in') && ( $this->session->userdata('group_id') == 2 ) )
			redirect('/');

		$defaults =  array('email' => '');
		$this->data['error'] = '';
		$this->data['success'] = '';
		$this->data['page_title'] = 'Forgot Password';

		if($_POST) {

			$email = trim($this->input->post('email'));
			if( $email ) {

				$user = $this->common->get( 'users', array( 'lower(email)'=>strtolower($email), 'is_active' => 1 ) );
				if( !empty($user) ) {
					$key = random_string();
					$today = time();
					$tomorrow = date('Y-m-d H:i:s', strtotime('+1 day', $today));

					$update_arr = array(
						'password_reset_key' => $key,
						'password_reset_key_expiration' => $tomorrow
					);

					$this->common->update('users',$update_arr,array('id'=>$user->id));
					$click_here = '<a href="'.site_url('reset_password/'.$key).'" target="_blank">'.site_url('reset_password/'.$key).' </a>';
					//send reset mail
					$params = array(
						'name' => $user->first_name.' '.$user->last_name,
						'reset-url' => $click_here,
						'site_name' => $this->data['core_settings']->site_name,
						'site_email' => $this->data['core_settings']->email,
					);

					$mail = send_mail('forgot-password', $user->id, $params);
					$this->data['success'] = 'Email has been sent to the address you entered.';

				} else {
					$this->data['success'] = 'You will receive an email if the email you have entered is correct.';
				}
			} else {
				$this->data['success'] = 'You will receive an email if the email you have entered is correct.';
			}
		}


		$this->data['csrf'] = array(
		    'name' => $this->security->get_csrf_token_name(),
		    'hash' => $this->security->get_csrf_hash()
		);

		$this->load->view('templates/header_ui', $this->data);
		$this->load->view('auth/forgot_password', $this->data);
		$this->load->view('templates/footer_ui', $this->data);
	}

	public function reset_password( $key = "" ){

		if ($this->session->userdata('logged_in') && ( $this->session->userdata('group_id') == 2 ))
			redirect('/');

		$this->data['page_title'] = 'Reset Password';
		$query = $this->db->query("select * from users WHERE password_reset_key ='".$key."' AND ( password_reset_key_expiration > (NOW() - INTERVAL 1 DAY))");
		$user = $query->row();
		if(empty($user)){
			$this->session->set_flashdata('error', 'Your  password reset time expired. Please try again. ');
			redirect('forgot_password');
		}

		$this->data["row"] = array(
			'password' => '',
			'cpassword' => '',
		);

		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|matches[cpassword]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($_POST) {

			if ( $this->form_validation->run() ) {

				$update_arr = array(
					'password' => md5( $this->config->item('encryption_key').$this->input->post('password') ),
					'password_reset_key' => '',
					'password_reset_key_expiration' => ''
				);

				$this->common->update( 'users',$update_arr,array('id' => $user->id) );

				$params = array(
					'name' => $user->first_name.' '.$user->last_name,
					'site_name' => $this->data['core_settings']->site_name,
					'site_email' => $this->data['core_settings']->email,
				);

				send_mail('password-changed ', $user_id, $params);

				$this->session->set_flashdata('success', 'Your password changed successfully. ');
				redirect('/login');

			} else {
				$this->data["row"] = array_merge($this->data["row"],$_POST);
			}
		}

		$this->data['csrf'] = array(
		    'name' => $this->security->get_csrf_token_name(),
		    'hash' => $this->security->get_csrf_hash()
		);

		$this->load->view('templates/header_ui', $this->data);
		$this->load->view('auth/reset_password', $this->data);
		$this->load->view('templates/footer_ui', $this->data);
	}

	public function set_password( $key = "" ){

		if ($this->session->userdata('logged_in') && ( $this->session->userdata('group_id') == 2 ) )
			redirect('/');

		$this->data['page_title'] = 'Set Password';

		$user = $this->common->get( 'users', array( 'invite_key' => $key ) );

		if( empty($user) ){
			redirect('login');
		}

		$this->data["row"] = array(
			'password' => '',
			'cpassword' => '',
		);

		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|matches[cpassword]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($_POST) {

			if ( $this->form_validation->run() ) {
				$update_arr = array(
					'password' => md5( $this->config->item('encryption_key').$this->input->post('password') ),
					'invite_key' => '',
					'is_active' => 1,
				);
				$this->common->update( 'users', $update_arr, array('id' => $user->id) );
				$sess_array = array(
					'username'       => $user->email,
					'email'          => $user->email,
					'user_id'        => $user->id,
					'logged_in' => TRUE,
					'group_id'       => $user->group_id,
				);

				$this->session->set_userdata($sess_array);
				$this->common->update('users', array( 'last_login' => date('Y-m-d H:i:s') ), array( 'id' => $user->id ) );
				redirect('/dashboard_one');
			} else {
				$this->data["row"] = array_merge($this->data["row"],$_POST);
			}
		}

		$this->data['csrf'] = array(
		    'name' => $this->security->get_csrf_token_name(),
		    'hash' => $this->security->get_csrf_hash()
		);

		$this->load->view('templates/header_ui', $this->data);
		$this->load->view('auth/set_password', $this->data);
		$this->load->view('templates/footer_ui', $this->data);
	}

	public function activate( $key = "" ){

		if ($this->session->userdata('logged_in') && ( $this->session->userdata('group_id') == 2 ) )
			redirect('/');

		$user = $this->common->get( 'users', array( 'invite_key' => $key ) );

		if( empty($user) ){
			$this->session->set_flashdata('msg', 'Your activation key expired. ');
			redirect('login');
		}

		$update_arr = array(
			'invite_key' => '',
			'is_active' => 1,
		);
		$this->common->update( 'users', $update_arr, array('id' => $user->id) );

		$sess_array = array(
			'username'       => $user->email,
			'email'          => $user->email,
			'user_id'        => $user->id,
			'logged_in' => TRUE,
			'group_id'       => $user->group_id,
		);

		$this->session->set_userdata($sess_array);
		$this->common->update('users', array( 'last_login' => date('Y-m-d H:i:s') ), array( 'id' => $user->id ) );
		redirect('/dashboard_one');


	}

	public function logout(){
		$this->session->sess_destroy();
		delete_cookie("chat_id");
        redirect('/');
	}


    public function send_otp_to_phone( $phone ){

        $condition = " phone ='".$phone."'  AND is_active = 1";

        $row = $this->common->get('users', $condition );


        if( $row ){

            $key = rand(1000,9999);

            $site_name = $this->data['core_settings']->site_name;

            $sms_parms = [
                'phone' => $phone,
                'message' => $key.' is your OTP for login to '.$site_name,
            ];

            $res = send_single_sms( $sms_parms );


            $today = time();
            $tomorrow = date('Y-m-d H:i:s', strtotime('+1 day', $today));

            $update_arr = array(
                'otp' => $key,
                'otp_expiration' => $tomorrow
            );

            $this->common->update('users',$update_arr,array('id'=>$row->id));


            header('Content-type: application/json');
            die(json_encode( [
                'status'=>'success',
            ] ));

        }else{

            header('Content-type: application/json');
            die(json_encode( [
                'status'=>'fail',

            ] ));

        }


    }

    public function otp_login( $key ){

//        $key = $_POST['otp'];

        if( $key ){

            if ($this->session->userdata('logged_in') && ( $this->session->userdata('group_id') == 2 ) )
                redirect('/');

            $user = $this->common->get( 'users', array( 'otp' => $key ) );

            if( empty($user) ){
                $this->session->set_flashdata('msg', 'Your activation key expired. ');
                redirect('login');
            }

            $update_arr = array(
                'otp' => '',
                'otp_expiration' => '',
            );
            $this->common->update( 'users', $update_arr, array('id' => $user->id) );

            $sess_array = array(
                'username'       => $user->email,
                'email'          => $user->email,
                'user_id'        => $user->id,
                'logged_in' => TRUE,
                'group_id'       => $user->group_id,
            );

            $this->session->set_userdata($sess_array);
            $this->common->update('users', array( 'last_login' => date('Y-m-d H:i:s') ), array( 'id' => $user->id ) );
            $url = site_url('/dashboard_one');

            $response = [
                'status'=>'success',
                'url'=>$url,

            ];

        }else{

            $response = [
                'status'=>'error',

            ];

        }

        header('Content-type: application/json');
        die(json_encode( $response ));


    }

}