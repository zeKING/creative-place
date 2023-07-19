<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Discount_code_model extends CI_Model
{
    public function get($id, $status = false) {
		$this->db->select('discount_code.*')		       
		         ->where('discount_code.id', $id);
        if($status)
            $this->db->where('discount_code.status', $status);

		return $this->db->get('discount_code')->row();
	}
      public function get_id_all($alias)
	{
	   	$this->db->select('discount_code.*')
		         ->where('discount_code.id', $alias);
      
		$post = $this->db->get('discount_code')->row();
        
        if ($post)
			return $post;
		else
			return show_404();
	
	}
    
     public function get_posts_p($args = null)
	{
		$defaults = array(            
            'id' => '',
            'limit' => 1000000,
            'offset' => 0,
            'order' => 'DESC',   
            'orderby' => 'id',  
            'status' => '',   
            'code' => '',   
		);

		$q = array_merge($defaults, $args);
       // $this->db->cache_on();
        $this->db->select('discount_code.*')->group_by('discount_code.id');
        
        if(!empty($q['status']))
            $this->db->where('discount_code.status', $q['status']);  
        if(!empty($q['code']))
            $this->db->where('discount_code.code', $q['code']);              
         
        /*if ( !empty($q['category_id']) )
        $this->db->where_in('discount_code.category_id', $q['category_id']);
       
        if ( !empty($q['region_id']) )
        $this->db->where_in('discount_code.region_id', $q['region_id']);
        
          if ( !empty($q['filter']) ){
            foreach($q['filter'] as $key => $val){
                    if($key == 'org_name' || $key == 'location_address' || $key == 'inn' || $key == 'lic_num' || $key == 'phones'){
                        
                    
        			$this->db->like('discount_code.'.$key, $val);
                    }
            }
            }*/
    
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);


		return $this->db->get('discount_code', $q['limit'], $q['offset'])->result();
          // $this->db->cache_off();
	}
    
    public function save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('discount_code', $data);
		}
		else
		{
			$this->db->insert('discount_code', $data);

			return $this->db->insert_id();
		}
	}
 
    
    public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('discount_code');    	

	
			//$this->db->delete('media', array('post_id'=>$id));
		
	}
    
    public function count_all(){
      return $this->db->count_all('discount_code');
    }
    
 }
 ?>