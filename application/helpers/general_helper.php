<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if( !function_exists('create_slug') ) {
	
	function create_slug( $title = '' ) {
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $title);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '_', $clean);
		
		if ( slug_exists($clean, $id) ) {
			$clean = make_slug_unique($clean);
		}
		return $clean;
	}
	
}
if( !function_exists('slug_exists') ) {
	function slug_exists( $slug ) {
		$ci = &get_instance();
		$ci->db->from('processes');
		$ci->db->where('slug', $slug);
		return $ci->db->count_all_results();
	}
}
if( !function_exists('make_slug_unique') ) {
	function make_slug_unique( $slug ) {
		for ( $i=1; $i<100000; $i++ ) {
			$proposedslug = $slug .'-'. $i;
			if ( !slug_exists( $proposedslug ) ){
				return $proposedslug;
				break;
			}
		}
	}
}

if( !function_exists('random_string') ) {
	function random_string($stirng = 15){  //password_hash("rasmuslerdorf", PASSWORD_DEFAULT)
		
		$rnd_id = password_hash(uniqid(rand(),1), PASSWORD_DEFAULT);
		$rnd_id = strip_tags(stripslashes($rnd_id)); 
		$rnd_id = str_replace(".","",$rnd_id); 
		$rnd_id = strrev(str_replace("/","",$rnd_id)); 
		$rnd_id = substr($rnd_id,0,$stirng); 
		return $rnd_id;
	}
}

if ( !function_exists('username') ) {
	function username( $id = 0 ) {
		
		if( $id > 0 ) {
			$ci = &get_instance();
			$ci->db->select('username');
			$ci->db->where( 'id' , $id );
			$row = $ci->db->get('users')->row();
			if( count($row) > 0 ) {
				return $row->username;
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
}

if ( !function_exists('user_details') ) {
	function user_details( $id = 0 ) {
		$ci = &get_instance();
		$ci->db->where( 'id' , $id );
		$row = $ci->db->get('users')->row();
		return $row;
	}
}


if( !function_exists('get_settings_item') ) {
	
	function get_settings_item($key = '') {
		
		$ci = &get_instance();
		$ci->db->where('field', $key);
		$row = $ci->db->get('settings')->row();
		if( count($row) > 0 ) {
			return $row->value;
		} else {
			return '';
		}
	}
	
}

if( !function_exists('get_role_name') ) {
	
	function get_role_name( $id = '' ) {
		
		$ci = &get_instance();
		$ci->db->where('id', $id);
		$row = $ci->db->get('groups')->row();
		if( count($row) > 0 ) {
			return $row->title;
		} else {
			return '';
		}
	}
	
}


if( !function_exists('get_user_type') ) {
	
	function get_user_type( $id = '' ) {  
		
		$user_type_arr = array(
			1 => 'Administrator',
			2 => 'Host',
		);
		if(!empty($id)){
			return $user_type_arr[$id];
		} else {
			return $user_type_arr;
		}
	}
	
}


if( !function_exists('is_user_active') ) {
	function is_user_active( $id = 0 ) {
		$ci = &get_instance();
		$ci->db->where( 'id' , $id );
		$row = $ci->db->get('users')->row();
		
		if( count($row) > 0 ) {
			
			if( $row->expire_date < time() ) {
				return false;
			} else {
				return true;
			}
			
		} else {
			return false;
		}
	}
}

if ( !function_exists('get_user_status') ) {
	function get_user_status( $key  = 0) {
		$st_arr = array(
			1 => 'Active',
			2 => 'Inactive',
			3 => 'Deleted',
		);
		return $st_arr[$key];
	}
}

if ( !function_exists('get_user_status_class') ) {
	function get_user_status_class( $key  = 0) {
		$st_arr = array(
			1 => 'success',
			2 => 'warning',
			3 => 'danger',
		);
		return $st_arr[$key];
	}
}


if ( !function_exists('send_mail') ) {
	function send_mail( $name, $user_id = 0, $params = array() ){
		
		$ci = &get_instance();
		
		$settings = $ci->db->get('core')->row();
		
		$to_name = $to_email = '';
		if (false !== ($pos = strpos($user_id, '@'))) {
			$to_email = $user_id;
			if( $to_email == '' ) {
				return;
			}
		} else {
			
			$ci->db->where( 'id' , $user_id );
			$user = $ci->db->get('users')->row();
			
			if( is_array($user) && count($user) == 0 ){
				return;
			}
			$to_name = $user->first_name.' '.$user->last_name;
			$to_email = $user->email;
		}
		
		$ci->db->where( 'slug' , $name );
		$model = $ci->db->get('emails')->row();
		
		if( is_array($model) && count($model) == 0 ){
			return;
		}
		
		$template = $model->body;
		$subject = $model->subject;
		
		$template = str_replace(array_map(function($key) {
			return '[*' . $key . '*]';
		}, array_keys($params)), array_values($params), $template);

		$subject = str_replace(array_map(function($key) {
			return '[*' . $key . '*]';
		}, array_keys($params)), array_values($params), $subject);

		
		$ci->load->library('phpmailer');
		
		$ci->phpmailer->IsHTML(true);
		
		$is_smtp = $settings->is_smtp;
		
		if( $is_smtp == 1 ) {
			$ci->phpmailer->IsSMTP(); 
			$ci->phpmailer->SMTPSecure = $settings->connection_prefix;
			$ci->phpmailer->SMTPAuth   = true;                  
			$ci->phpmailer->Host       = $settings->smtp_host;
			$ci->phpmailer->Port       = $settings->smtp_port;        
			$ci->phpmailer->Username   = $settings->smtp_username; 
			$ci->phpmailer->Password   = $settings->smtp_password;
		}

		$ci->phpmailer->SetFrom( $settings->email, $settings->site_name );
		$ci->phpmailer->AddAddress( $to_email, $to_name );
		$ci->phpmailer->Subject = $subject;
		$ci->phpmailer->Body = $template;
		$ci->phpmailer->Send();
		$ci->phpmailer->ClearAddresses();
	}
}  


if ( !function_exists('get_friend_status') ) {
	function get_friend_status( $user_id = 0, $friend_id = 0 ){
		$friend_status = array();
		$ci = &get_instance();

		//echo $user_id.' '.$friend_id;

		$condition = '(person_one = '.$user_id.' AND person_two = '.$friend_id.') OR ( person_one = '.$friend_id.' AND person_two = '.$user_id.')';

		$ci->db->from('friends');

		if( $condition )
			$ci->db->where($condition);

		$count = $ci->db->count_all_results();

		//echo $count; exit;

		if ( $count > 0 ){

			$ci->db->where($condition);
			$query = $ci->db->get('friends');
			$result_row =  $query->row();

			//echo "<pre>"; print_r($result_row); 

			if( $result_row->status == 1 ){
				$friend_status['action'] = 'friends';
				$friend_status['label'] = 'Send Mail';
			} else {
				if( $result_row->person_one == $user_id ){
					$friend_status['action'] = 'requested';
					$friend_status['label'] = 'Requested';
				}else{
					$friend_status['action'] = 'accept';
					$friend_status['label'] = 'Accept';
				}
			}
			

		}else {
			$friend_status['action'] = 'add_friend';
			$friend_status['label'] = 'Send Interest';
		}

		return $friend_status;
		
		
		
		
	}
} 



if ( !function_exists('category_name') ) {
	function category_name( $id = 0 ) {
		
		if( $id > 0 ) {
			$ci = &get_instance();
			$ci->db->select('name');
			$ci->db->where( 'id' , $id );
			$row = $ci->db->get('categories')->row();
			if( count($row) > 0 ) {
				return $row->name;
			} else {
				return '';
			}
		} else {
			return 'General';
		}
	}
}


if ( !function_exists('is_like') ) {
	function is_like( $user_id = 0, $post_id = 0 ) {
		
		if( $user_id > 0 && $post_id > 0 ) {

			$condition = 'user_id = '.$user_id.' AND post_id = '.$post_id;
			$ci = &get_instance();
			$ci->db->select('id');
			$ci->db->where( $condition );
			$row = $ci->db->get('post_like')->row();
			if( count($row) > 0 ) {
				return 1;
			} else {
				return 0;
			}
		}
	}
}


if ( !function_exists('post_like_count') ) {   
	function post_like_count( $post_id = 0 ) {   
		
		if( $post_id > 0 ) {

			$condition = 'post_id = '.$post_id;
			$ci = &get_instance();
			$ci->db->select('id');
			$ci->db->where( $condition );
			$row = $ci->db->get('post_like')->result();
			return count($row);     
		}
	}
}


if ( !function_exists('post_comment_count') ) {   
	function post_comment_count( $post_id = 0 ) {   
		
		if( $post_id > 0 ) {

			$condition = 'post_id = '.$post_id;
			$ci = &get_instance();
			$ci->db->select('id');
			$ci->db->where( $condition );
			$row = $ci->db->get('post_comment')->result();
			return count($row);     
		}
	}
}


if ( !function_exists('is_share') ) {
	function is_share( $user_id = 0, $post_id = 0 ) {
		
		if( $user_id > 0 && $post_id > 0 ) {

			$condition = 'user_id = '.$user_id.' AND post_id = '.$post_id;
			$ci = &get_instance();
			$ci->db->select('id');
			$ci->db->where( $condition );
			$row = $ci->db->get('post_share')->row();
			if( count($row) > 0 ) {
				return 1;
			} else {
				return 0;
			}
		}
	}
}

if ( !function_exists('post_share_count') ) {   
	function post_share_count( $post_id = 0 ) {   
		
		if( $post_id > 0 ) {

			$condition = 'post_id = '.$post_id;
			$ci = &get_instance();
			$ci->db->select('id');
			$ci->db->where( $condition );
			$row = $ci->db->get('post_share')->result();
			return count($row);     
		}
	}
}

if( !function_exists('create_kna_id') ) {

    function create_kna_id() {

        $ci = &get_instance();

        $ci->db->where( 'group_id' , 2 );
        $ci->db->order_by('kna_id desc');
        $ci->db->limit(1,0);
        $row = $ci->db->get('users')->row();

        if( $row ) {

            $last_kna_id = $row->kna_id;
            $new_kna_id = $last_kna_id+1;

            return $new_kna_id;

        } else {
            return 200001;
        }
    }
}

if( !function_exists('personHeightOptions') ) {
    function personHeightOptions( $height = '' ){
        $itotal = 95; $r = '';
        for($foot=6;$foot>=3;$foot--){
            for($inches=11;$inches>=0;$inches--){

                $inches_total = ($foot * 12) + $inches;
                $cm = (int) round($inches_total / 0.393701);

                $select = '';


                if($inches==0){

                    if( $foot.' Ft 0 In / '.$cm.' Cms' == $height){
                        $select = 'selected';
                    }

                    $r .= "<option ".$select." value='$foot Ft 0 In / $cm Cms'> $foot Ft 0 In / $cm Cms </option>";
                }else{

                    if( $foot.' Ft '.$inches.' In / '.$cm.' Cms' == $height){
                        $select = 'selected';
                    }

                    $r .= "<option ".$select." value='$foot Ft $inches In / $cm Cms'> $foot Ft $inches In / $cm Cms </option>";
                }
                $itotal--;
            }
        }
        return $r;
    }
}



if ( !function_exists('get_marital_status') ) {
    function get_marital_status( $key  = 0) {
        $st_arr = array(
            1 => 'Never Married',
            2 => 'Widower',
            3 => 'Divorced',
            4 => 'Awaiting Divorced',
        );

        if( $key == 0 ){
            return $st_arr;
        }
        return $st_arr[$key];
    }
}


if ( !function_exists('get_employed_in') ) {
    function get_employed_in( $key  = 0) {
        $st_arr = array(
            1 => 'Government',
            2 => 'Private',
            3 => 'Bussiness',
            4 => 'Defence',
            5 => 'Self Emplyed',
            6 => 'Not Working',
        );

        if( $key == 0 ){
            return $st_arr;
        }
        return $st_arr[$key];
    }
}

if ( !function_exists('get_family_status') ) {

    function get_family_status( $key = 0) {

        $st_arr = array(
            1 => 'Middle Class',
            2 => 'Upper Middle Class',
            3 => 'Rich',
            4 => 'Affluent',
        );

        if( $key == 0 ){
            return $st_arr;
        }

        return $st_arr[$key];
    }
}

if ( !function_exists('calculate_age') ) {

    function calculate_age( $dob = '' ) {

        $from = new DateTime($dob);
        $to   = new DateTime('today');
        $months_total = $from->diff($to)->m;

        $age = $from->diff($to)->y;

        $months_age = $age* 12;

        $months_remaining = $months_total - $months_age;

        return [
            'age'=>$age,
            'months'=>$months_total,
        ];

    }
}

if( !function_exists('is_user_has_licence') ) {
    function is_user_has_licence( $id = 0 ) {

        $bDate = new DateTime();
        $today = $bDate->format('Y-m-d');

        $ci = &get_instance();
        $ci->db->where( 'user_id = '.$id.' AND DATE_FORMAT(`to_date`,"%Y-%m-%d") >= "'.$today.'"' );

        $row = $ci->db->get('subscription')->row();

        if( $row ) {

            return $row->id;

        } else {

            return false;

        }
    }
}

if( !function_exists('is_user_has_licence_contact') ) {
    function is_user_has_licence_contact( $id = 0, $licence_id = 0 ) {

        $ci = &get_instance();
        $ci->db->where( 'user_id = '.$id.' AND licence_id = '.$licence_id );
        $row = $ci->db->get('user_contacts')->result();

        if( count($row) < 40 ) {

            $arr_result = [
                'contacts_taken' => count($row),
                'is_available' => 1,
                ];

        } else {
            $arr_result = [
                'contacts_taken' => count($row),
                'is_available' => 0,
            ];
        }

        return $arr_result;
    }
}

if( !function_exists('is_mobile') ) {

    function is_mobile(){

        $useragent=$_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

            return true;

        }else{

            return false;

        }

    }
}

if( !function_exists('get_user_tag') ) {
    function get_user_tag( $id = 0 ) {

        $bDate = new DateTime();
        $today = $bDate->format('Y-m-d');

        $ci = &get_instance();
        $ci->db->where( 'user_id = '.$id.' AND DATE_FORMAT(`to_date`,"%Y-%m-%d") >= "'.$today.'"' );

        $row = $ci->db->get('subscription')->row();

        $ci_user = &get_instance();
        $ci->db->where( 'id = '.$id );
        $row_user = $ci_user->db->get('users')->row();
        $user_country = $row_user->country_id;

        $ci_prof = &get_instance();
        $user_profection = $ci_prof->db->get('profectional_details')->row();

        $user_working_country = '';
        if( $user_profection ){
            $user_working_country = $user_profection->working_country;
        }


        $is_nri = 0;

        if( $user_country != 78 || $user_working_country != 78 ){

            $is_nri = 1;
        }

        $tag = '';

        if( $row ) {

            if( $is_nri == 1 ){
                $tag = '<span class="badge badge-danger"><i class="fa fa-crown"></i>PREMIUM-NRI</span>';
            }else{
                $tag = '<span class="badge badge-danger"><i class="fa fa-crown"></i>PREMIUM</span>';
            }
        }else{

//            if( $is_nri == 1 ){
//                $tag = '<span class="badge badge-danger"><i class="fa fa-crown"></i>NRI</span>';
//            }else{
//                $tag = '<span class="badge badge-danger"><i class="fa fa-crown"></i>PREMIUM</span>';
//            }
        }

        return $tag;
    }
}


if ( !function_exists('get_notify_type') ) {

    function get_notify_type( $key = 0) {

        $st_arr = array(
            1 => 'Visited Your Profile',
            2 => 'Send You an Interest',
            3 => 'Acepted Your Interest',
        );

        if( $key == 0 ){
            return $st_arr;
        }

        return $st_arr[$key];
    }
}


if( !function_exists('send_single_sms') ) {

    function send_single_sms($parms = []) {

        $ci = &get_instance();


        $row = $ci->db->get('core')->row();


        if( $row ) {

            $url_parms = [
                'user' => $row->sms_user,
                'password' => $row->sms_password,
                'msisdn' => $parms["phone"],
                'sid' => $row->sms_sender_id,
                'msg' => $parms["message"],
                'fl' => 0,
                'gwid' => 2,
            ];


            $url = 'http://txt.smartipz.com/vendorsms/pushsms.aspx';

            $url = $url . "?" . http_build_query($url_parms);


            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            if($response){
                return true;
            }else{
                return false;
            }


        } else {

            return false;
        }
    }

}




