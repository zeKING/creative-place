<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
     function getOcto($id)
	{
	 	$CI =& get_instance();
	//	$post = $CI->db->get_where('octo_transactions', array('shop_transaction_id'=>$id))->row();   	
       
 	    $CI->db->where('shop_transaction_id', $id);
		return $CI->db->get('octo_transactions')->row();
 
	}
    
      function currency_price_octo($price){
        if($price){
        $CI =& get_instance();
        $rates = currency_active('rates');
            if($rates == 0){
                $price = number_format($price, 0, ',', ' ');
            }else{
               $price = number_format($price / $rates, 2, '.', ' ');              
            }
             
            return $price;     
        }
        
        
    }
?>