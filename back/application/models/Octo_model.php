<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Octo_model extends CI_Model
{
     public function save_insert($data)
	{
		
			$this->db->insert('octo_transactions', $data);

			return $this->db->insert_id();
		
	}
    
     public function save_update($data, $id)
	{
		if ($id)
		{
			$this->db->where('shop_transaction_id', $id)
					 ->update('octo_transactions', $data);
		}	
	}
    
      public function save_cart($data, $id)
    {
        if ($id)
        {
            $this->db->where('id', $id)
                ->update('cart_u', $data);
        }        
    }
    
}
?>