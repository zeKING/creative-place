<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 // Подписаться на рассылку
class Subscribe_model extends CI_Model
{
/*	public function check_user($email, $pass)
	{
		$this->db->where("(email = '$email' OR username = '$email')")
				 ->where('password', $pass)
				 ->where('active','1');

		return $this->db->get('users')->row();
	}*/

 public function get_list($args = null)
    {
      
      $defaults = array(
      'user_type' => '',
      'limit' => 10000,
      'offset' => 0,
      'order' => 'DESC',
      'orderby' => 'user_id',
            'status' => '',
            'active' => '',  
            'fio' => '', 
            'user_id' => '',         
            
    );

    @$q = array_merge($defaults, $args);
      
        $this->db->where('user_type', $q['user_type']);
                 //->order_by('user_id DESC');
                   if ( !empty($q['orderby']) ){
      $this->db->order_by($q['orderby'], $q['order']);
      }
       if ( !empty($q['active']) ){
        $this->db->where_in('active', $q['active']);
       }
        if ( !empty($q['fio']) ){
        $this->db->like('fio', $q['fio']);
       }
       if ( !empty($q['user_id']) ){
        $this->db->like('user_id', $q['user_id']);
       }
        return $this->db->get('subscribe', $q['limit'], $q['offset'])->result();
    }

/*	public function get($user_id)
	{
		return $this->db->where('users.user_id',$user_id)
						->where('users.active','1')
						->get('users')->row();
	}

    public function get_by_type($type)
    {
        return $this->db->where('users.user_type',$type)
            ->where('users.active','1')
            ->get('users')->result_array();
    }

    public function get_($user_id, $code)
    {
        return $this->db->where('users.user_id', $user_id)
            ->where('users.activation_code', $code)
            ->get('users')->row();
    }*/

	public function user_email($email)
	{
		return $this->db->get_where('subscribe',array('email' => $email))->row();
	}
	/*public function save($data, $user_id=false)
	{
		if($user_id){
			$this->db->update('users', $data, array('user_id'=>$user_id));
			return $this->db->get_where('users',array('user_id'=>$user_id))->row();
		}
		else{
			$this->db->insert('users', $data);
			$user = $this->db->get_where('users',array('user_id'=>$this->db->insert_id()))->row();
			return $user;
		}
	}*/
    public function save2($data)
	{
	   $this->db->insert('subscribe', $data);
		
	}
    public function delete($user_id)
	{
		$this->db->delete('subscribe', array('user_id'=>$user_id));
	}
    public function get_count($group)
    {
        return $this->db->where('user_type', $group)->count_all_results('subscribe');
    }
    
/*	public function change_pass($code,$data)
	{
		$this->db->update('users', $data, array('activation_code' => $code));
		return $this->db->affected_rows();
	}
	public function delete($user_id)
	{
		$this->db->delete('users', array('user_id'=>$user_id));
	}
	public function delete_user($data)
	{
		$this->db->update('users',$data['update'], array('user_id' => $data['update']['user_id']));
		$this->db->insert('deleted_users', $data['insert']);
	}*/
/*	public function activate($activation_code, $phone=false)
	{
		if($phone)
			$this->db->set('phone_verified','1');
		else
			$this->db->set('email_verified','1');
			$this->db->set('active','1')
				 ->set('activation_code','')
				 ->where('activation_code',$activation_code)
				 ->update('users');
		$user = $this->db->get_where('users',array('user_id' => $this->session->userdata('user_id') ))->row();
		return $user;
	}*/
	/*public function user_exists($data)
	{
		return $this->db->get_where('users',array('social_id'=> $data['social_id']))->row();
	}*/
}