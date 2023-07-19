<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model 
{  
	public function check_user($username, $password)
	{
	   $username = $this->db->escape_str($username);
       $password = $this->db->escape_str($password);
		$this->db->where("(username = '$username' OR email = '$username' OR phone = '$username')")
		         ->where('password', $password)
             ->where('active', '1');
		return $this->db->get('users')->row();
	}
	public function getUserByPhone($username)
	{
	   $username = $this->db->escape_str($username);

		$this->db->where("phone", $username)

             ->where('active', '1');
		return $this->db->get('users')->row();
	}
	public function check_user1($username, $password)
	{
	   $username = $this->db->escape_str($username);
	   $code = $this->db->escape_str($password);
		$this->db->where("user_id", $username)
		         ->where('activation_code', $code)
		         ->where('active', '1');
		return $this->db->get('users')->row_array();
	}
	public function check_user2($username, $password)
	{
	   $username = $this->db->escape_str($username);
	   $code = $this->db->escape_str($password);
		$this->db->where("user_id", $username)
		         ->where('activation_code', $code)
		         ->where('active', '1');
		return $this->db->get('users')->row_array();
	}
    function getUserByLogin($username, $password) {
        $username = $this->db->escape_str($username);
        $password = $this->db->escape_str($password);
        $this->db->where("(username = '$username' OR email = '$username' OR phone = '$username')")
            ->where('active', '1');

        $result = $this->getUsers($password);
    
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    function getUserByLogin1($username, $password) {
        $username = $this->db->escape_str($username);
        $password = $this->db->escape_str($password);
        $this->db->where("user_id", $username)
            ->where('active', '1');

        $result = $this->getPassword($password);

        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    
   	public function save_login_attempts($data, $ip_address=false)
	{
		if ($ip_address)
		{
			$this->db->where('ip_address', $ip_address)
					 ->update('login_attempts', $data);
		}
		else
		{
			$this->db->insert('login_attempts', $data);

			return $this->db->insert_id();
		}
	}
    
    public function get_login_attempts($ip_address)
	{
	   	$this->db->select('*')		       
		         ->where('ip_address', $ip_address);
      
		$post = $this->db->get('login_attempts')->row();
        
        if ($post)
			return $post;
	
	}
    
    public function clear_login_attempts($ip_address)
	{
	  
            $this->db->where('ip_address', $ip_address);			

			return $this->db->delete('login_attempts');
	
			// Make sure $old_attempts_expire_period is at least equals to lockout_time
		//	$old_attempts_expire_period = max($old_attempts_expire_period, $this->config->item('lockout_time', 'ion_auth'));

			/*	$this->db->like('ip_address', $ip_address);
			
			// Purge obsolete login attempts
			$this->db->where('time < NOW() - INTERVAL '.$time.' SECOND');

			return $this->db->delete('login_attempts');*/
           //return  $this->db->query('DELETE FROM login_attempts WHERE `ip_address` = '.$ip_address.'  AND time < (NOW() - INTERVAL '.$time.' SECOND)');
		
	}
    
    
    public function get_users_count_admin_social($group) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM users AS p
            WHERE p.user_type_social = '".$group."'
            AND p.user_id";
            return $this->db->query($sql)->row('count');
	}
    public function get_list_social($args = null)
    {
      
      $defaults = array(
			'user_type_social' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'user_id',
			'phone_verified' => '',
            'status' => '',


		);

	@$q = array_merge($defaults, $args);
      
        $this->db->where('user_type_social', $q['user_type_social']);

                 //->order_by('user_id DESC');
                 	if ( !empty($q['orderby']) ){
			$this->db->order_by($q['orderby'], $q['order']);
      }



        return $this->db->get('users', $q['limit'], $q['offset'])->result();
    }
    function getUsers($password) {
        $query = $this->db->get('users');
    
        if ($query->num_rows() > 0) {
    
            $result = $query->row_array();
    
            if ($this->bcrypt->check_password($password, $result['password'])) {
               
                return $result;
            } else {
               
                return array();
            }
    
        } else {
            return array();
        }
}
    function getPassword($password) {
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {

            $result = $query->row_array();

            if ($this->bcrypt->check_password($password, $result['password'])) {

                return $result;
            } else {

                return array();
            }

        } else {
            return array();
        }
}


	
	
  public function check_user_active($id)
	{
		$this->db->where('user_id', $id);             
		return $this->db->get('users')->row();
	}
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
          'phone'=>'',


            
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
        if ( !empty($q['phone']) ){
            $this->db->where('phone_verified', $q['phone']);
        }
        return $this->db->get('users', $q['limit'], $q['offset'])->result();
    }
     public function get_list_users($args = null)
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
            'items_id' => '',
            'filter' => 'inactive',      
            'total_status' => '',    
            'filter_array' => '',
            'filter_count' => 'inactive'
        );
    
        @$q = array_merge($defaults, $args);
        if ($q['filter'] == 'active'){
         // $this->db->distinct();
          }
        $this->db->where('user_type', $q['user_type']);
                 //->order_by('user_id DESC');
        if ( !empty($q['orderby']) ){
            $this->db->order_by($q['orderby'], $q['order']);
        }
        if ( !empty($q['active']) ){
            $this->db->where_in('active', $q['active']);
        }
        if ( !empty($q['total_status']) ){
            $this->db->where_in('total_status', $q['total_status']);
        }
        if ($q['filter'] == 'active'){
            if(!empty($q['filter_array'])){
                foreach($q['filter_array'] as $key => $value){
                    $val = $this->db->escape_str($value);
                   // echo $key;
                    if($key == 'rate'){
                        $rate = explode(',', $val);
                        $min = @$rate[0];
                        $max = @$rate[1];
                        if($min && $max){                            
                        $this->db->where('users.rate >=',(int)$min);
		               $this->db->where('users.rate <=',(int)$max);
                        }else{
                             $this->db->where('users.rate',(int)$min);
                        }
                    }
                    if($key == 'time'){
                        /*$time = explode(',', $val);
                        $min_time = $time[0];
                        $max_time = $time[1];*/
                       // $time = ($val < 10) ? '0'.$val : $val; 
                        $this->db->where('find_in_set('.$val.', users.time_title)');
                        //echo (int)'10:00';
		              // $this->db->where('find_in_set('.$max_time.', time_title)');+
                     // $this->db->where('users.time_title >=',(int)8);
		            //   $this->db->where('users.time_title <=',(int)22);
                       
                    }
                    if($key == 'gender'){
                        $this->db->where_in('users.gender',$val);
                    }
                    if($key == 'places_id'){
                        $this->db->where_in('users.places_id',$val);
                    }
                     if($key == 'region_list_id'){
                        $this->db->where('users.region_list_id',$val);
                       
                    }
                    if($key == 'city_list_id'){
                        $this->db->where('users.city_list_id',$val);
                    }
                    
                    
                    if($key == 'first_name'){
                        $this->db->like('users.first_name',$val);
                    }
                    if($key == 'a_experience'){
                        $this->db->like('users.a_experience',$val);
                    }
                    if($key == 'items_id'){
                        //$v = implode(',', $val);
                        $i1 = 1;foreach($val as $v){
                            if($i1 == 1){
                                $this->db->where('find_in_set('.(int)$v.', items_id)');
                            }else{
                             $this->db->or_where('find_in_set('.(int)$v.', items_id)');
                             }
                        $i1++;}                        
                    }
                    if($key == 'days_week'){
                     
                        $i = 1; foreach($val as $d){
                            if($i == 1){
                               $this->db->where('find_in_set("'.(int)$d.'", users.days_week_id)'); 
                            }else{
                                 $this->db->or_where('find_in_set("'.(int)$d.'", users.days_week_id)');  
                            }
                            
                        $i++;}
                    }
                }
            }
        }else{
            if ( !empty($q['items_id']) ){
                $this->db->where('find_in_set("'.(int)$q['items_id'].'", users.items_id)');
            }
        }
         if ($q['filter_count'] == 'active'){
                $this->db->from('users');
            
            return $this->db->count_all_results();
        }else{
                return $this->db->get('users', $q['limit'], $q['offset'])->result();
        }
    }
    
         public function get_list_users2($args = null)
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
            'items_id' => '',
            'filter' => 'inactive',      
            'total_status' => '',    
            'filter_array' => '',
            'filter_count' => 'inactive'
        );
    
        @$q = array_merge($defaults, $args);
        if ($q['filter'] == 'active'){
         // $this->db->distinct();
          }
        $this->db->where('user_type', $q['user_type']);
                 //->order_by('user_id DESC');
        if ( !empty($q['orderby']) ){
            $this->db->order_by($q['orderby'], $q['order']);
        }
        if ( !empty($q['active']) ){
            $this->db->where_in('active', $q['active']);
        }
        if ( !empty($q['total_status']) ){
            $this->db->where_in('total_status', $q['total_status']);
        }
        if ($q['filter'] == 'active'){
            if(!empty($q['filter_array'])){
                foreach($q['filter_array'] as $key => $value){
                    $val = $this->db->escape_str($value);
                  //  $filter[] = array_unique($key);

                }
                
                
                    if($key == 'rate'){
                        $rate = explode(',', $val);
                        $min = @$rate[0];
                        $max = @$rate[1];
                        if($min && $max){                            
                        $this->db->where('users.rate >=',(int)$min);
		               $this->db->where('users.rate <=',(int)$max);
                        }else{
                             $this->db->where('users.rate',(int)$min);
                        }
                    }
                    if($key == 'time'){
                        /*$time = explode(',', $val);
                        $min_time = $time[0];
                        $max_time = $time[1];*/
                       // $time = ($val < 10) ? '0'.$val : $val; 
                        $this->db->where('find_in_set('.$val.', users.time_title)');
                        //echo (int)'10:00';
		              // $this->db->where('find_in_set('.$max_time.', time_title)');+
                     // $this->db->where('users.time_title >=',(int)8);
		            //   $this->db->where('users.time_title <=',(int)22);
                       
                    }
                    if($key == 'gender'){
                        $this->db->where_in('users.gender',$val);
                    }
                    if($key == 'places_id'){
                        $this->db->where_in('users.places_id',$val);
                    }
                     if($key == 'region_list_id'){
                        $this->db->where('users.region_list_id',$val);
                       
                    }
                    if($key == 'city_list_id'){
                        $this->db->where('users.city_list_id',$val);
                    }
                    
                    
                    if($key == 'first_name'){
                        $this->db->like('users.first_name',$val);
                    }
                    if($key == 'a_experience'){
                        $this->db->like('users.a_experience',$val);
                    }
                    if($key == 'items_id'){
                        //$v = implode(',', $val);
                        $i1 = 1;foreach($val as $v){
                            if($i1 == 1){
                                $this->db->where('find_in_set('.(int)$v.', items_id)');
                            }else{
                             $this->db->or_where('find_in_set('.(int)$v.', items_id)');
                             }
                        $i1++;}                        
                    }
                    if($key == 'days_week'){
                     
                        $i = 1; foreach($val as $d){
                            if($i == 1){
                               $this->db->where('find_in_set("'.(int)$d.'", users.days_week_id)'); 
                            }else{
                                 $this->db->or_where('find_in_set("'.(int)$d.'", users.days_week_id)');  
                            }
                            
                        $i++;}
                    }
            }
        }else{
            if ( !empty($q['items_id']) ){
                $this->db->where('find_in_set("'.(int)$q['items_id'].'", users.items_id)');
            }
        }
         if ($q['filter_count'] == 'active'){
                $this->db->from('users');
            
            return $this->db->count_all_results();
        }else{
                return $this->db->get('users', $q['limit'], $q['offset'])->result();
        }
    }
    public function get($user_id)
    {
        return $this->db->get_where('users', array('user_id'=>$user_id))->row();
    }
    public function getType($user_id, $user_type)
    {
        return $this->db->get_where('users', array('user_id'=>$user_id, 'user_type'=>$user_type))->row();
    }
     public function get2($id) {
		$this->db->where('user_id', $id);
		return $this->db->get('users')->row();
	}
    	public function get_id($alias)
	{
		$post = $this->db->get_where('users', array('username'=>$alias))->row();

		if ($post)
			return $post->user_id;
		else
			return show_404();
	}
   /* public function save($data, $user_id)
    {
        if($user_id)
            $this->db->update('users', $data, array('user_id'=>$user_id));
        else
            $this->db->insert('users', $data);
    }*/
    public function get_users_count_admin($group) {
    $sql = "SELECT
            COUNT(*) AS count
            FROM users AS p
            WHERE p.user_type = '".$group."'
            AND p.user_id";
            return $this->db->query($sql)->row('count');
  }
  public function get_users_count_active($group) {
    $sql = "SELECT
            COUNT(*) AS count
            FROM users AS p
            WHERE p.user_type = '".$group."'
            AND p.active = '1'";
            return $this->db->query($sql)->row('count');
  }
     public function save_username($data_username, $id)
	{
		$this->db->where('user_id', $id)
					   ->update('posts_u', $data_username);
		
	
	}
  public function update_views($post_id ,$counter_data) {
            /* $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('posts');*/
             $this->db->query("UPDATE users SET views = $counter_data+1 WHERE user_id = $post_id");
             
             
     }
  	
  
  	public function get_users($id, $status = false) {
		$this->db->select('posts.*, media.url, categories.alias AS category')
		         ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
		         ->join('categories', 'posts.category_id = categories.category_id', 'left')
		         ->where('posts.id', $id);
        if($status)
            $this->db->where('posts.status', $status);

		return $this->db->get('posts')->row();
	}
  
    public function delete($user_id)
    {
        $this->db->delete('users', array('user_id'=>$user_id));
    }
  /*    public function delete_img($img)
    {$this->db->where('img', $img);
  $this->db->delete('users');
    }
     public function delete_img($img)
    {$this->db->where('img', $img);
  $this->db->delete('users');
    }*/   
    	public function delete_img($img)
	{
			@unlink( "./uploads/admin/{$img}" );
		}
  	public function delete_profile_img($img)
	{
			@unlink( "./uploads/profile/{$img}" );
		}
    public function user_email($email)
	{
		return $this->db->get_where('users',array('email' => $email))->row();
	}
  
   public function user_newsletter()
	{
		return $this->db->get_where('users',array('user_sub' => 'subscriber'))->result();
	}
  
	public function save($data, $user_id=false)
	{
		if($user_id){
			$this->db->update('users', $data, array('user_id'=>$user_id));
			return $this->db->get_where('users',array('user_id'=>$user_id))->row();
		}
		else{
			$this->db->insert('users', $data);
			$user = $this->db->get_where('users',array('user_id'=>$this->db->insert_id()))->row();
		//	$this->db->insert('user_settings',array('user_id'=>$this->db->insert_id(),'subscribe' => $this->input->post('subscribe')));
			return $user;
		}
	}
    public function save2($data, $user_id)
	{
		if($user_id){
            $this->db->where('user_id', $user_id)
					 ->update('users', $data);
		}
        
	}
    public function saveMedia($data, $user_id)
	{
		if($user_id){
 	      $this->db->insert('media_u', $data);
		}
        
	}
     public function saveMedia2($data, $id)
	{
		if($id){
            $this->db->where('id', $id)
					 ->update('media_u', $data);
		}
        
	}
    
    public function getMediaId($id) {
		$this->db->select('media_u.*')->where('id', $id);
		return $this->db->get('media_u')->row();
	}
    
    	public function get_media_files($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('user_id', $id)
				 ->order_by('id');

		return $this->db->get('media_u', $limit, $offset)->result();
	
}
        
        public function get_media_files_all($args = null)
	{
        $defaults = array(
            'user_id' => '',
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'type_post' => '',
            
        );
       	$q = array_merge($defaults, $args);
        $this->db->select('media_u.*')->group_by('media_u.id');
        
        if(!empty($q['user_id']))
            $this->db->where('media_u.user_id', $q['user_id']);
        if(!empty($q['type_post']))
            $this->db->where_in('media_u.type_post', $q['type_post']);
            
		return $this->db->get('media_u', $q['limit'], $q['offset'])->result();
	
}
    public function deleteMedia($id){
        $this->db->delete('media_u', array('id'=>$id));
    }
	public function change_pass($code,$data)
	{
		$this->db->update('users', $data, array('activation_code' => $code));
		return $this->db->affected_rows();
	}
	public function delete_user($data)
	{
		$this->db->update('users',$data['update'], array('user_id' => $data['update']['user_id']));
		$this->db->insert('deleted_users', $data['insert']);
	}
	public function activate($activation_code, $phone=false)
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
	}
  
  	public function activate_user($activation_code, $id, $phone=false)
	{
		if($phone)
			$this->db->set('phone_verified','1');
		else
			$this->db->set('email_verified','1');
			$this->db->set('active','1')
				 ->set('activation_code','')         
				 ->where('activation_code',$activation_code)        
				 ->update('users');
		$user = $this->db->get_where('users',array('user_id' => $id ))->row();
		return $user;
	}
	/*public function user_exists($data)
	{
		return $this->db->join('user_settings','user_settings.user_id=users.user_id')
						->get_where('users',array('social_id'=> $data['social_id']))->row();
	}*/
  	public function user_exists($data)
	{
		return $this->db->get_where('users',array('social_id'=> $data['social_id']))->row();
	}
	public function save_notifications($data)
	{
		$this->db->update('user_settings', $data, array('user_id'=>$this->session->userdata('user_id')));
	}
	public function save_car($data, $id=false,$car_id=false)
	{
		if($id)
			$this->db->update('cars', $data, array('user_id' => $id,'id'=>$car_id));
		else
			$this->db->insert('cars', $data);
	}
	public function get_cars($user_id)
	{
		return $this->db->get_where('cars',array('user_id' => $user_id))->result();
	}
	public function get_car($id)
	{
		return $this->db->get_where('cars',array('id' => $id))->row();
	}
	public function delete_car($id)
	{
		$this->db->delete('cars',array('id' => $id));
	}
	public function save_alert($data,$id=false)
	{
		/*if($id){
			$this->db->update('email_alerts', $data, array('id'=>$id));
			return $this->db->get_where('email_alerts',array('id'=>$id))->row();
		}
		else{
			$this->db->insert('email_alerts', $data);
			return $this->db->get_where('email_alerts',array('id'=>$this->db->insert_id()))->row();
		}*/
	}
	public function get_alerts($id)
	{
		return $this->db->order_by('id','desc')
						->get_where('email_alerts',array('user_id'=>$id))->result();
	}
	public function delete_alert($id)
	{
		$this->db->delete('email_alerts',array('id'=>$id));
	}
	public function save_messages($data, $where=false)
	{
		if($where){
			$this->db->update('messages', $data, $where);
		}
		else
		{
			$this->db->insert_batch('messages',$data);
		}
	}
	public function get_messages($user_id,$type=false, $response=false)
	{
	/*	$this->db->join('rides', 'rides.id=messages.ride_id');
		if($type=='archive'){
			$this->db->join('users','users.user_id=messages.user_from')
					 ->where('messages.owner_id',$user_id)
					 ->where('messages.archive','1')
					 ->group_by('messages.ride_id')
					 ->select('messages.*,rides.*,users.*, COUNT(messages.id) as count');
		}
		elseif($type=='unread'){
			$this->db->join('users','users.user_id=messages.user_from')
					 ->where('messages.is_read','0')
					 ->where('messages.user_to',$user_id)
					 ->where('messages.owner_id',$user_id);
		}
		elseif($type=='sent'){
			$this->db->join('users','users.user_id=messages.user_to')
					 ->where('messages.owner_id',$user_id)
					 ->where('messages.user_from',$user_id)
					 ->where('messages.archive','0')
					 ->group_by('messages.ride_id')
					 ->group_by('messages.user_to')
					 ->select('messages.*,rides.*,users.*, COUNT(messages.id) as count');
		}
		else{
			$this->db->join('users','users.user_id=messages.user_from')
					 ->where('messages.owner_id', $user_id)
					 ->where('messages.user_to', $user_id)
					 ->where('messages.archive','0')
					 ->group_by('messages.ride_id')
					 ->group_by('messages.user_from')
					 ->select('messages.*,rides.*,users.*, COUNT(messages.id) as count, count(case when messages.is_read="0" then messages.id else null end) as c_isread');
		}
		return $this->db->get('messages')->result();*/
	}
	public function delete_message($where)
	{
		/*$this->db->where('ride_id',$where['ride_id'])
				 ->where('owner_id',$where['owner_id'])
				 ->where('(user_from = '.$where['int_id'].' or user_to = '.$where['int_id'].')')
				 ->delete('messages');*/
	}
	public function archive_message($data,$where)
	{
		/*$this->db->where('ride_id',$where['ride_id'])
				 ->where('owner_id',$where['owner_id'])
				 ->where('(user_from = '.$where['int_id'].' or user_to = '.$where['int_id'].')')
				 ->update('messages',$data);*/
	}
	public function get_conversation($ride_id,$user)
	{
		/*$this->db->join('rides', 'rides.id=messages.ride_id')
				 ->join('users','users.user_id=messages.user_from')
				 ->where('messages.ride_id',$ride_id)
				 ->where('messages.owner_id',$this->session->userdata('user_id'))
				 ->where('(messages.user_from = '.$user.' or messages.user_to = '.$user.')')
				 ->order_by('messages.send_time')
				 ;
		return $this->db->get('messages')->result();*/
	}
	public function save_rating($data)
	{
		$this->db->insert('ratings',$data);
	}
	public function get_left_ratings($from)
	{
		$this->db->where('ratings.rate_from',$from)
				 ->join('users','users.user_id=rate_to');
		return $this->db->get('ratings')->result();
	}
	public function get_received_ratings($to)
	{
		$this->db->where('ratings.rate_to',$to)
				 ->join('users','users.user_id=rate_from');
		return $this->db->get('ratings')->result();
	}
	public function find_member($phone)
	{
		$this->db->where('phone', $phone);
		return $this->db->get('users')->row();
	}
	public function get_m_users($id)
	{
	/*	$this->db->select('users.*, messages.*, u.first_name as f_name, u.last_name as l_name, rides.*')
				 ->join('users','users.user_id=messages.user_from')
				 ->join('users as u','u.user_id=messages.user_to')
				 ->join('rides','rides.id=messages.ride_id')
				 ->where('messages.user_from',$id)
				 ->or_where('messages.user_to',$id)
				 ->group_by('messages.ride_id');
		return $this->db->get('messages')->result();*/
	}
	public function get_admin_conversation($ride_id, $user1, $user2, $limit=100000,$offset=false)
	{
	/*	$this->db->join('rides', 'rides.id=messages.ride_id')
				 ->join('users','users.user_id=messages.user_from')
				 ->where('messages.ride_id',$ride_id)
				 ->where('(messages.user_from = '.$user1.' or messages.user_to = '.$user1.')')
				 ->where('(messages.user_from = '.$user2.' or messages.user_to = '.$user2.')')
				 ->order_by('messages.send_time');
		return $this->db->get('messages',$limit, $offset)->result();*/
	}
	public function get_photos()
	{
		return $this->db->where('user_type !=','admin')
						->where('photo_approved','0')
						->where('picture !=','')
						->get('users')->result();
	}
	public function get_by_search($name)
	{
		$this->db->like('first_name',$name)
				 ->or_like('last_name',$name)
				 ->where('user_type !=','admin');
		return $this->db->get('users')->result();
	}
    
      public function search_count($title, $group) {
	            
    //$this->db->where('group', $group);
    
    
    $this->db->like('fio', $title);
    $this->db->where('user_type', $group);
    $this->db->from('users');
  
    return $this->db->count_all_results();
	}
    
	public function save_visitor($data)
	{
		$sql = $this->db->insert_string('visitors', $data) . ' ON DUPLICATE KEY UPDATE visits=visits+1,visit_date=CURRENT_TIMESTAMP';
		$this->db->query($sql);
		$id = $this->db->insert_id();
	}
	public function get_visitors($id,$limit=10000)
	{
		$this->db->select('visitors.*,users.*,v.sum')
				 ->join('users','users.user_id=visitors.user_id')
				 ->join('(SELECT SUM(visits) as sum FROM visitors) as v','true')
				 ->where('visitors.ride_id',$id)
				 ->order_by('visitors.visit_date','DESC');
		return $this->db->get('visitors',$limit)->result();
	}
      public function user_phone($phone)
	{
		return $this->db->get_where('users',array('phone' => $phone))->row();
	}
    
    public function check_phone($alias, $post_id){
         if($post_id){
	       $this->db->where('phone', $alias)
                 ->where('user_id !=', $post_id);
	   }else{
	    $this->db->where('phone', $alias);   
	   }
			         

		return $this->db->get('users')->row();
    }
    
    public function check_email($alias, $post_id){
         if($post_id){
	       $this->db->where('email', $alias)
                 ->where('user_id !=', $post_id);
	   }else{
	    $this->db->where('email', $alias);   
	   }
			         

		return $this->db->get('users')->row();
    }
    public function get_users_list_home($args = null)
    {

        $defaults = array(
            'user_type' => '',
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'user_id',

            'show_home' => '',

            'user_id' => '',
            'phone'=>''

        );

        @$q = array_merge($defaults, $args);

        $this->db->where('user_type', $q['user_type']);

        if ( !empty($q['orderby']) ){
            $this->db->order_by($q['orderby'], $q['order']);
        }



        if ( !empty($q['show_home']) ){
            $this->db->where('show_home', $q['show_home']);
        }


        if ( !empty($q['phone']) ){
            $this->db->where('phone_verified', $q['phone']);
        }
        $this->db->where('ban', 'no');
        $this->db->where('active', '1');
        return $this->db->get('users', $q['limit'], $q['offset'])->result();
    }
    public function count_all_sh(){
        $this->db->from('users')
                ->where('show_home', 'active');

        return $this->db->count_all_results();
    }
    public function count_all_u(){
        $this->db->from('users')
                ->where('user_type', 'seller')
                ->where('phone', '1');

        return $this->db->count_all_results();
    }
}