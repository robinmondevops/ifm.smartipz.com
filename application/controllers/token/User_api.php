<?php  defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH ."../vendor/autoload.php";
use \Firebase\JWT\JWT;
use Razorpay\Api\Api;



class User_api extends My_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
        JWT::$leeway = 10;

    }

    public function login(){


        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $email = '';
        $password = '';

        $data = json_decode(file_get_contents("php://input"));

//        echo json_encode($data);exit;

        $email = $data->email;
        $password = md5($this->config->item('encryption_key').trim($data->password));

        $email = trim($email);
        $password = trim($password);

        if($email && $password){

            $condition = "lower(email) = '".strtolower($email)."' AND password = '".$password."' AND is_active = 1";
            $user = $this->common->get("frontend_user", $condition,"array");

//            echo json_encode([$email,$password]);exit;

            if($user){

                $firstname = $user['name'];

                $secret_key = "123456";
                $issuer_claim = "THE_ISSUER"; // this can be the servername
                $audience_claim = "THE_AUDIENCE";
                $issuedat_claim = time(); // issued at
                $notbefore_claim = $issuedat_claim + 10; //not before in seconds
                $expire_claim = $issuedat_claim + 43800 ; // expire time in seconds   // 1 day ->  60 * 60 * 24 // 43800 valid for month
                $token = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "firstname" => $firstname,
                        "email" => $email,
                        "id"=>$user['id'],
                    ));

                http_response_code(200);

                $jwt = JWT::encode($token, $secret_key);
                echo json_encode(
                    array(
                        "message" => "Successful login.",
                        "jwt" => $jwt,
                        "email" => $email,
                        "expireAt" => $expire_claim
                    ));
            }else{

                http_response_code(401);
                echo json_encode(array("message" => "Login failed.", "password" => $password));
            }
        }

    }

    public function view(){


        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $secret_key = "123456";
        $jwt = null;
//        $databaseService = new DatabaseService();
//        $conn = $databaseService->getConnection();

        $data = json_decode(file_get_contents("php://input"));

//        echo json_encode(getallheaders());exit;

        $header_data = [];

        foreach (getallheaders() as $name => $value) {
//            echo "$name: $value\n";
            $header_data[$name] = $value;
        }

//        echo json_encode($header_data['Authorization']);exit;

//        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $authHeader = $header_data['Authorization'];

//        $arr = explode(" ", $authHeader);


        /*echo json_encode(array(
            "message" => "sd" .$arr[1]
        ));*/
//        echo json_encode($arr);exit;

        $jwt = $authHeader;

        if($jwt){

            try {

                $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

                // Access is granted. Add code of the operation here

                echo json_encode(array(
                    "message" => "Access granted:",
                    "error" => '',
                    "data" => $decoded,
                ));

            }catch (Exception $e){

                http_response_code(401);

                echo json_encode(array(
                    "message" => "Access denied.",
                    "error" => $e->getMessage()
                ));
            }

        }
    }

    public function register_user(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $data = json_decode(file_get_contents("php://input"));

        $kna_id = create_kna_id();

        $name = $data->name;
        $email = $data->email;
        $password = $data->password;
        $phone = $data->phone;
        $country_code = $data->country_code;
        $country = $data->country;
        $city = $data->city;

        $new_password = md5($this->config->item('encryption_key').trim($password));

        $user_arr = array(
            'email'=> $email,
            'first_name'=> $name,
            'password' => $new_password,
            'profile_type' => 1,
            'phone' => $phone,
            'country_code' => $country_code,
            'country_id' => $country,
            'city' => $city,
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



        http_response_code(200);

        $result = [
            'status'=>'success',
            'id'=>$user_id,
        ];

        echo json_encode($result);
        exit;

    }

    public  function get_arr_profile_type(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $arr_profile_type = $this->common->get_all('profile_type' );

        http_response_code(200);
        echo json_encode($arr_profile_type);
        exit;

    }

    public function get_arr_country(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $arr_countries = $this->common->get_all('countries' );

        http_response_code(200);
        echo json_encode($arr_countries);
        exit;

    }

    public function get_arr_state(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $arr_state = $this->common->get_all('state');

        http_response_code(200);
        echo json_encode($arr_state);
        exit;

    }

    public function get_arr_distric(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $state_id = '';

        $data = json_decode(file_get_contents("php://input"));

        $state_id = $data->state_id;

        $arr_dist = $this->common->get_all('district', ['state_id' => $state_id ] );

        http_response_code(200);
        echo json_encode($arr_dist);
        exit;

    }

    public function raz_get_order_id(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $data = json_decode(file_get_contents("php://input"));

        $amount = $data->amount;

        $receipt = rand(100, 999999);


        $api = new Api('rzp_test_XK6R9ZWicjdzEH', 'XDjtRcTt2xfJE2CFj79LxfOw');

        $order = $api->order->create(array(
                'receipt' => $receipt,
                'amount' => $amount,
                'currency' => 'INR'
            )
        );



        $arr_res = [
            'id'=>$order['id'],
            'amount'=>$order['amount'],
            'currency'=>$order['currency'],
            'currency'=>$order['currency'],
            'receipt'=>$order['receipt'],
            'created_at'=>$order['created_at'],
        ];

        http_response_code(200);
        echo json_encode($arr_res);
        exit;

//        try {
//
//            $order  = $api->order->create([
//                'receipt' => 'order_rcptid_32345677777',
//                'amount'  => 50000,
//                'currency' => 'INR'
//            ]);
//
//            http_response_code(200);
//            echo json_encode($order);
//            exit;
//
//        }catch (Exception $e){
//
//            http_response_code(401);
//
//            echo json_encode(array(
//                "message" => "Access denied.",
//                "error" => $e->getMessage()
//            ));
//        }

    }




}