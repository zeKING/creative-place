<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {
    
   public function get_all()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}
    
public function get($id)
    {
        $this->db->where ('id',$id);
        $query = $this->db->get('cart_u');
        return $query->row();
    }

    public function getU($id)
    {
        $this->db->where('user_id',$id);
        return $this->db->get('cart_u')->result();

    }
    public function get_payment_m($id)
    {
        $this->db->where ('p_id',$id);
        $query = $this->db->get('payment_method');
        return $query->row();
    }
    
    public function get_delivery_m($id)
    {
        $this->db->where ('d_id',$id);
        $query = $this->db->get('delivery_method');
        return $query->row();
    }
    
     public function get_time_m($id)
    {
        $this->db->where('t_id',$id);
        $query = $this->db->get('time_delivery');
        return $query->row();
    }
    
    
    
     public function get_user($id)
    {
        $this->db->where ('id',$id);
        $this->db->where_in ('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('cart_u');
        return $query->row();
    }
    
     public function save($data, $id)
    {
        if ($id)
        {
            $this->db->where('id', $id)
                ->update('cart_u', $data);
        }
        else
            $this->db->insert('cart_u', $data);
    }
    
      public function save_payment($data, $id)
    {
        if ($id)
        {
            $this->db->where('cart_u_id', $id)
                ->update('cart_payment', $data);
                
        }
        else
            $this->db->insert('cart_payment', $data);
            	$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;	
    }
    
     public function save_cart($data, $id)
    {
        if ($id)
        {
            $this->db->where('id', $id)
                ->update('cart', $data);
        }
        else
            $this->db->insert('cart', $data);
    }
    public function save_payment_m($data, $id)
    {
        if ($id)
        {
            $this->db->where('p_id', $id)
                ->update('payment_method', $data);
        }
        else
            $this->db->insert('payment_method', $data);
    }
    
     public function save_delivery_m($data, $id)
    {
        if ($id)
        {
            $this->db->where('d_id', $id)
                ->update('delivery_method', $data);
        }
        else
            $this->db->insert('delivery_method', $data);
    }
    
     public function save_time_delivery($data, $id)
    {
        if ($id)
        {
            $this->db->where('t_id', $id)
                ->update('time_delivery', $data);
        }
        else
            $this->db->insert('time_delivery', $data);
    }


	public function insert_customer($data)
	{
		$this->db->insert('cart_u', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
  
  	public function insert_customer_payment($data)
	{
		$this->db->insert('cart_payment', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	
        // Insert order date with customer id in "orders" table in database.
/*	public function insert_order($data)
	{
		$this->db->insert('cart', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}*/
	
        // Insert ordered product detail in "order_detail" table in database.
	public function insert_order_detail($data)
	{
		$this->db->insert('cart', $data);
	}
  
  	public function payment_log($data)
	{
		$this->db->insert('payment_log', $data);
	}
  
  
  
   public function get_admin_cart($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'post_id' => '',
            'status' => '',
            'id' => '',
            'year' => '',
            'month' => '',
            'date1' => '',
            'date2' => '',
		);

		$q = array_merge($defaults, $args);
        if(!empty($q['id'])){
            $this->db->where('id', $q['id']);
        }
        
        if(!empty($q['status'])){
            $this->db->where('status', $q['status']);
        }
      
       if ( !empty($q['orderby']) ){
        $this->db->order_by($q['orderby'], $q['order']); 
       }
       
        if ( !empty($q['year']) )
			$this->db->where('YEAR(cart_u.created_date)', $q['year']);
            
            if ( !empty($q['month']) )
			$this->db->where('MONTH(cart_u.created_date)', $q['month']);
            
             if(!empty($q['date1']) && !empty($q['date2'])){
            $this->db->where('cart_u.created_date >=', $q['date1'].' 00:00:00');
            $this->db->where('cart_u.created_date <=', $q['date2'].' 23:59:59');
            }else{
                 if(!empty($q['date1'])){
                     $this->db->like('cart_u.created_date', $q['date1']);                      
                 }  
            }
            
            /*elseif(!empty($q['date1'])){
                 $this->db->like('cart_u.created_date', $q['date1']);                      
            }elseif(!empty($q['date2'])){
                 $this->db->like('cart_u.created_date', $q['date2']);                      
            }*/
            
			                   
        return $this->db->get('cart_u', $q['limit'], $q['offset'])->result();
    }
    
     public function get_admin_payment($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'p_id',
            'post_id' => '',
            'status' => '',
            'id' => '',
      
            
		);

		$q = array_merge($defaults, $args);
        if(!empty($q['id'])){
            $this->db->where('p_id', $q['id']);
        }
        
        if(!empty($q['status'])){
            $this->db->where('p_status', $q['status']);
        }
      
       if ( !empty($q['orderby']) ){
        $this->db->order_by($q['orderby'], $q['order']); 
       }
			                   
        return $this->db->get('payment_method', $q['limit'], $q['offset'])->result();
    }
    
         public function get_admin_delivery($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'd_id',
            'post_id' => '',
            'status' => '',
            'id' => '',
      
            
		);

		$q = array_merge($defaults, $args);
        if(!empty($q['id'])){
            $this->db->where('d_id', $q['id']);
        }
        
        if(!empty($q['status'])){
            $this->db->where('d_status', $q['status']);
        }
      
       if ( !empty($q['orderby']) ){
        $this->db->order_by($q['orderby'], $q['order']); 
       }
			                   
        return $this->db->get('delivery_method', $q['limit'], $q['offset'])->result();
    }
    
          public function get_admin_time($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 't_id',
            'post_id' => '',
            'status' => '',
            'id' => '',
      
            
		);

		$q = array_merge($defaults, $args);
        if(!empty($q['id'])){
            $this->db->where('t_id', $q['id']);
        }
        
        if(!empty($q['status'])){
            $this->db->where('t_status', $q['status']);
        }
      
       if ( !empty($q['orderby']) ){
        $this->db->order_by($q['orderby'], $q['order']); 
       }
			                   
        return $this->db->get('time_delivery', $q['limit'], $q['offset'])->result();
    }
    
    
    
     public function get_admin_cart_filter($args = null)
    {
      
      $defaults = array(
		
            'post_id' => '',
            'status' => '',
            'id' => '',     
            'year' => '',
            'month' => '',
            'date1' => '',
            'date2' => '',
            
		);

		$q = array_merge($defaults, $args);
        if(!empty($q['id'])){
            $this->db->where('id', $q['id']);
        }
        if ( !empty($q['year']) )
            $this->db->where('YEAR(cart_u.created_date)', $q['year']);
        
        if ( !empty($q['month']) )
            $this->db->where('MONTH(cart_u.created_date)', $q['month']);
        
        if(!empty($q['date1']) && !empty($q['date2'])){
            $this->db->where('cart_u.created_date >=', $q['date1'].' 00:00:00');
            $this->db->where('cart_u.created_date <=', $q['date2'].' 23:59:59');
        }else{
         if(!empty($q['date1'])){
             $this->db->like('cart_u.created_date', $q['date1']);                      
         }  
        }
        
        $this->db->from('cart_u');
        return $this->db->count_all_results();
    }
    
     public function get_user_cart($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
      'post_id' => '',
      'user_id' => '',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
      
        $this->db->order_by($q['orderby'],$q['order']);  
        $this->db->where('user_id',$q['user_id']);                    
        return $this->db->get('cart_u', $q['limit'], $q['offset'])->result();
    }
    
 public function get_view($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'cart_u_id' => '',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
      
        $this->db->order_by ('id','desc');   
        $this->db->where ('cart_u_id',$q['cart_u_id']);                  
        return $this->db->get('cart', $q['limit'], $q['offset'])->result();
    }

    
     public function get_cart_id() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM cart_u AS p
                WHERE p.id";
            return $this->db->query($sql)->row('count');
	}
  
   public function get_user_cart_id($id=false) {
        $user_id = ($id) ? $id : $this->session->userdata('user_id');
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM cart_u AS p
                WHERE p.user_id = ".$user_id."";
            return $this->db->query($sql)->row('count');
	}
  
   public function count_cart_id($id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM cart AS p
                WHERE p.cart_u_id = $id";
            return $this->db->query($sql)->row('count');
	}
  public function count_cart_id_view($id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM cart AS p                
                WHERE p.cart_u_id = $id
                AND p.user_id = ".$this->session->userdata('user_id')."";
            return $this->db->query($sql)->row('count');
	}
  
  
   public function delete($id) {
        $this->db->where('id', $id)
            ->delete('cart_u');
    }
    public function delete_cart($id) {
        $this->db->where('cart_u_id', $id)
            ->delete('cart');
    }
       
}