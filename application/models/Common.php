<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Model{
   
    function insert( $table = '',$data = array() ) {
		$this->db->insert($table,$data);
		return $this->db->insert_id();  
	}
	
	function update( $table = '',$data = array(),$condition = array() ) {
		

		if(!empty($condition))
			$this->db->where($condition);
			
		$this->db->update($table,$data);
	}
	
	function delete( $table = '',$condition = array() ){
		$this->db->where($condition);
		$this->db->delete($table);
	}

	function truncate( $table = '' ){
		$this->db->truncate($table);
	}
	
	function get( $table = '', $condition = array(), $type = 'object', $select = '', $join_arr_left = '', $join_arr = '', $order_by = ''  ) {
		if(!empty($condition))
			$this->db->where($condition);
		
		if($select)
			$this->db->select($select);

		if( $join_arr_left ) {
			foreach( $join_arr_left as $tbl => $cond ) {
				$this->db->join( $tbl, $cond, 'left');
			}
		}
		if( $join_arr ) {
			foreach( $join_arr as $tbl => $cond ) {
				$this->db->join( $tbl, $cond);
			}
		}
		
		if( $order_by ) {	
			$this->db->order_by($order_by);
		}
			
		$query = $this->db->get($table);
		return ($type == 'object'?$query->row():$query->row_array());	
	}
	
	function get_all( $table = '',$condition = array(),$select = '',$order_by = '', $limit = 0, $offset = 0, $join_arr_left = '', $join_arr = '', $join_arr_right='', $group_by='', $type ='' ) {
		if(!empty($condition))
			$this->db->where($condition);
		if($select)	
			$this->db->select($select,false);
		if($order_by)	
			$this->db->order_by($order_by);

		if($group_by)	
			$this->db->group_by($group_by);
		
		if($limit)
			$this->db->limit($limit,$offset);

		if( $join_arr_left ) {
			foreach( $join_arr_left as $tbl => $cond ) {
				$this->db->join( $tbl, $cond, 'left');
			}
		}

		if( $join_arr ) {
			foreach( $join_arr as $tbl => $cond ) {
				$this->db->join( $tbl, $cond);
			}
		}
		if( $join_arr_right ) {
			foreach( $join_arr_right as $tbl => $cond ) {
				$this->db->join( $tbl, $cond, 'right');  
			}
		}	
		$query = $this->db->get($table);

		return ( $type == 'array'?$query->result_array():$query->result() );  

		//return $query->result();	
	}
	
	function get_search_count()	{
		$search_query = 'SELECT FOUND_ROWS() cnt';
		$query = $this->db->query($search_query);
		$row = $query->row();
		return $row->cnt;
	}
	
	function get_total_count($table = '', $condition = '', $join_arr_left = '', $join_arr = '' )	{
		if( $join_arr_left ) {
			foreach( $join_arr_left as $tbl => $cond ) {
				$this->db->join( $tbl, $cond, 'left');
			}
		}
		if( $join_arr ) {
			foreach( $join_arr as $tbl => $cond ) {
				$this->db->join( $tbl, $cond);
			}
		}	

		$this->db->from($table);

		if( $condition )
			$this->db->where($condition);

		return $this->db->count_all_results();
	}
	
	function check_user_exists(){
		$user = $this->get('users', array('id' => $this->session->userdata('user_id')) );
		if( is_array($user) && count($user) == 0 ) {
			$this->session->sess_destroy();
       		redirect('/');
		}
	}

	function get_all_user_categories( $user_id = 0 ){
		if( $user_id > 0 ){
			$this->db->where( array('user_id'=>$user_id) );
			$query = $this->db->get('user_categories'); 
		    $array = array();

		    foreach($query->result() as $row){
		        $array[] = $row->category_id; // add each category id to the array
		    }

		    return $array;

		}
	}

	function update_join( $left_join='',$data = array(),$condition = array() ) {
		
		$this->db->set($data);

		if(!empty($condition))
			$this->db->where($condition);

		$this->db->update($left_join); 
	}


    function admin_login($email,$password,$type = 'object'){

        $sql = "SELECT * FROM `users` WHERE lower(email) = ?  AND `password` = ? AND `is_active` = 1 AND `group_id` = 1 ";

        $query = $this->db->query($sql, [$email,$password]);

        return ($type == 'object'?$query->row():$query->row_array());

    }


}
