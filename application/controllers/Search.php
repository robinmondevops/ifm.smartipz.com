<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends My_Controller {

	

	public function __construct() {            

		parent::__construct();

		if( $this->user == false ) {

			redirect('login');

		}   

	}

	public function index(){

		$this->data['css_files'] = array(
			base_url('assets/pages/css/profile.min.css'),
		);

		$this->data['js_files'] = array(
			base_url('assets/pages/js/profile.min.js'),
			base_url('assets/pages/js/friends.js'),            
		); 

		$this->data['page_title'] = 'User Search';
		$this->data['menu'] = 'search';
		$this->data['submenu'] = '';

		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules('typeahead_search', 'Keyword', 'trim|required');
		$this->form_validation->set_error_delimiters('<span style="color:red" class="help-block">', '</span>');

        $this->data['result'] = [];
		if( $_POST ){

			if( !$this->form_validation->run() ) {
				$this->data['result'] = array();

			} else {

				// $left_join = array(
				// 	'friends f1'=>'f1.person_one = u.id',
				// 	'friends f2'=>'f2.person_two = u.id',
				// );

                if( $this->user->gender == 'AF'){
                    $gen = 'AL';
                }else{
                    $gen = 'AF';
                }

				$key = strtoupper( $this->input->post('typeahead_search') );

                $str = ltrim($key, 'KNA');

                $condtion = '((first_name LIKE "%'.$key.'%" OR last_name LIKE "%'.$key.'%") OR ( kna_id ="'.$str.'" ))
                AND is_active=1 AND group_id=2 AND u.id != '.$this->user->id.' AND gender = "'.$gen.'"';

                $arr_left_join = [
                    'countries c' => 'c.id = u.country_id',
                    'state s' => 's.id = u.state',
                    'district d' => 'd.id = u.district',
                ];

                $this->data['result'] = $this->common->get_all('users u', $condtion,'u.*,c.country country_name, s.name state_name, d.name district_name',
                    'id desc','100','', $arr_left_join);

//				$this->data['result'] = $this->common->get_all('users',$condtion );
				//$this->data['result'] = $this->common->get_all('users u','(u.first_name LIKE "%'.$key.'%" OR u.last_name LIKE "%'.$key.'%") AND u.is_active=1 AND u.group_id=2 AND u.id != '.$this->user->id, 'f1.person_one,f1.person_two,f1.status,f2.person_one f2_person_one,f2.person_two f2_person_two,f2.status f2_status,u.*','','','',$left_join);
//				echo $this->db->last_query(); exit;
			}

		}

		$this->load->view('templates/header', $this->data);
		$this->load->view('search/index', $this->data);   
		$this->load->view('templates/footer', $this->data);
	}

	public function typeahead_search() {

		$key = $_GET['query'];

		$result = $this->common->get_all('users','(first_name LIKE "%'.$key.'%" OR last_name LIKE "%'.$key.'%") AND is_active=1 AND group_id=2');  

		$users = array(); 
		foreach($result as $row) 
		$users[] = array( 
			"value" => $row->first_name, 
		);

		echo json_encode($users);   

	}

	


}