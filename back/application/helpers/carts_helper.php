<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function in_cart_id($id){
     $CI =& get_instance();
        return $CI->cart->in_cart($id);
}
 function getPayM($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('payment_method', array('p_id'=>$id))->row();   	


		if ($post) {
			return $post;
      } 
	}
     function getDelM($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('delivery_method', array('d_id'=>$id))->row();   	


		if ($post) {
			return $post;
      } 
	}
    
    function cartUpdate($cart){
        $CI =& get_instance();
           foreach($cart as $item){
                $rowid = $item['rowid'];
                $post = getWorksAll($item['id']);
                $qty = $item['qty'];
                if($post->status == 'active'){


                            $price = $post->price;


                        $data_cart = array(
                            'rowid'   => $rowid,
                			'name' => $post->name,
                			'price' => $price,
                            'amount' => $price,
                			'qty' => $qty,  
                            'options' => array(
                                'user_id'=>$post->user_id,
                                'tag_id'=>$post->tag_id
                            ),                          
                		);

                }else{
                    $data_cart = array(
                        'rowid'   => $rowid,
                        'qty'     => 0
                    );
                }
                $CI->cart->update($data_cart);
            }
           return $CI->cart->contents();
    }
    
function cartQtyButton($id, $qty, $style, $type = 'cart_qty'){
    
   /* if(in_cart_id($id)){
        $qty = in_cart_id($id);
    }*/
    
    if($style == 'carts'){
        $style = '';
        $disabled= "";
    }else{
        $style = '';
        $disabled= "disabled='disabled'";
    }
    
        $min = '1';
        $max = '50';
    
   if($type == 'cart_qty1'){
        $button = "<div class='input-group qty-button qty1-$id' id='qty-$id' style='display:$style'>
                  <span class='input-group-btn'>
                      <button type='button' class='btn btn-default btn-number btn-minus minus-$id' id='minus-$id' $disabled  data-type='minus' data-field='quant[$id]'>
                         <i class='fa fa-minus' aria-hidden='true'></i>
                      </button>
                  </span>
                  <input type='text' id='qty-num-$id' data-typeproduct='$type' name='quant[$id]' data-productid='$id' class='form-control input-number qty-input-$id'  disabled='disabled' value='$qty' min='$min' max='$max'>
                  <span class='input-group-btn'>
                      <button type='button' class='btn btn-default btn-number btn-plus' data-type='plus' data-field='quant[$id]'>
                           <i class='fa fa-plus' aria-hidden='true'></i>
                      </button>
                  </span>
                </div>";
    }else{
         $button = "<div class='input-group qty-button qty1-$id' id='qty-$id' style='display:$style'>
                  
                  <input type='number' id='qty-num-$id' data-typeproduct='$type' name='quant[$id]' data-productid='$id' class='form-control input-number qty-input-$id'  value='$qty' min='$min' max='$max'>
            
                </div>";
    }
    return $button;
}
/*function cartQtyButton($id, $qty, $style, $type = false){
    
    if($style == 'carts'){
        $style = '';
        $disabled= "disabled='disabled'";
    }else{
        $style = 'none';
        $disabled= "disabled='disabled'";
    }
    
    if($type == 'kg'){
        $min = '1';
        $max = '50';
    }else{
        $min = '1';
        $max = '50';
    }
    $link = site_url('cart/action/view');
    $cart_view = lang('cart_view');
    $button = "<div class='input-group qty-button qty1-$id' id='qty-$id' style='display:$style'>
                    <div class='qty-button-block'>
                  <span class='input-group-btn left'>
                      <button type='button' class='btn btn-default btn-number btn-minus minus-$id' id='minus-$id' $disabled  data-type='minus' data-field='quant[$id]'>
                          <i class='minus icon'></i>
                      </button>
                  </span>
                  <input type='text' data-typeproduct='$type' name='quant[$id]' data-productid='$id' class='form-control input-number qty-input-$id'  disabled='disabled' value='$qty' min='$min' max='$max'>
                  <span class='input-group-btn right'>
                      <button type='button' class='btn btn-default btn-number btn-plus' data-type='plus' data-field='quant[$id]'>
                          <i class='plus icon'></i>
                      </button>
                  </span>
                  </div>
                  <a href='$link' class='cart-view-btn cart-btn-$id'>$cart_view</a>
                </div>";
                
    
    return $button;
}*/

function cartLink($id, $style, $class=false){
    
    if($style == 'block'){
        $style = 'block';
    }else{
        $style = 'none';
    }
    
    $link = '<a href='.site_url('cart/action/view').' class="cart-view-btn cart-view-p cart-btn1-'.$id.'  qty1-'.$id.'" id="cart-btn-'.$id.'"  style="display:'.$style.'">'.lang('cart_view').'</a>';
    return $link;
}

function cartQtyButtonBlock($id, $qty, $style, $type = false){
    
    if($style == 'carts'){
        $style = '';
        $disabled= "";
    }else{
        $style = 'none';
        $disabled= "disabled='disabled'";
    }
    
    if($type == 'kg'){
        $min = '1';
        $max = '50';
    }else{
        $min = '1';
        $max = '50';
    }
    $button = "<div class='input-group qty-button qty1-$id' id='qty-$id' style='display:$style'>
                  <span class='input-group-btn'>
                      <button type='button' class='btn btn-default btn-number btn-minus minus-$id' id='minus-$id' $disabled  data-type='minus' data-field='quant[$id]'>
                          <span class='glyphicon glyphicon-minus'></span>
                      </button>
                  </span>
                  <input type='text' data-typeproduct='$type' name='quant[$id]' data-productid='$id' class='form-control input-number qty-input-$id'  disabled='disabled' value='$qty' min='$min' max='$max'>
                  <span class='input-group-btn'>
                      <button type='button' class='btn btn-default btn-number btn-plus' data-type='plus' data-field='quant[$id]'>
                          <span class='glyphicon glyphicon-plus'></span>
                      </button>
                  </span>
                </div>";
                
                /*
                  $button = "<div class='input-group qty-button' id='qty1-$id' style='display:$style'>
                  <span class='input-group-btn'>
                      <button type='button' class='btn btn-default btn-minus btn-number1 minus1-$id' id='minus1-$id' $disabled  data-type1='minus' data-field='quant1[$id]'>
                          <span class='glyphicon glyphicon-minus'></span>
                      </button>
                  </span>
                  <input type='text' data-typeproduct1='$type' name='quant1[$id]' data-productid1='$id' class='form-control input-number1 qty-input1-$id'  disabled='disabled' value='$qty' min='$min' max='$max'>
                  <span class='input-group-btn'>
                      <button type='button' class='btn btn-default btn-plus btn-number1' data-type1='plus' data-field1='quant1[$id]'>
                          <span class='glyphicon glyphicon-plus'></span>
                      </button>
                  </span>
                </div>";
                
                */
    
    return $button;
}

function cartQtyButtonNew($id, $qty, $style, $type = false){
    
    if($style == 'carts'){
        $style = '';
        $disabled= "";
    }else{
        $style = 'none';
        $disabled= "disabled='disabled'";
    }
    
    if($type == 'kg'){
        $min = '1';
        $max = '200';
    }else{
        $min = '1';
        $max = '200';
    }
    $button = "<div class='counter qty1-$id' id='qty-$id' style='display:$style'>
					<button type='button' class='toggler left btn-number minus-$id' id='minus-$id' $disabled data-type='minus' data-field='quant[$id]'><i class='minus icon'></i></button>
					<div class='field'><input class='qty-input-$id'  type='text' data-typeproduct='$type' name='quant[$id]' data-productid='$id' value='$qty' min='$min' max='$max' disabled></div>
					<button type='button' class='toggler right btn-number' data-type='plus' data-field='quant[$id]'><i class='plus icon'></i></button>
				</div>";             
    
    return $button;
}

function cartQtyButtonNew2($id, $qty, $style){
    
   /* if(in_cart_id($id)){
        $qty = in_cart_id($id);
    }*/
    
    if($style == 'carts'){
        $style = '';
        $disabled= "";
    }else{
        $style = '';
        $disabled= "disabled='disabled'";
    }
    
        $min = '1';
        $max = '50';
    
         $button = "<input type='number' id='qty-num-$id' data-typeproduct='' name='quant[$id]' data-productid='$id' class='form-control input-number qty-input-$id'  value='$qty' min='$min' max='$max'>";
    
    return $button;
}

function getOffers($tags, $group, $options) {
	            
    //$this->db->where('group', $group);
    	$CI =& get_instance();
    
    $CI->db->where('find_in_set("'.(int)$tags.'", posts.tags)');
    $CI->db->where('status', 'active');
    $CI->db->where_in('group', $group);
    $CI->db->from('posts');
   $query = $CI->db->get();
$post = $query->row();
  
  if ($post) {
			return $post->$options;
           // var_dump($post);
      } 
  
     
	

	}
    
    function getOffersAdmin($tags, $category_id, $group, $options) {
	            
    //$this->db->where('group', $group);
    
    
    $CI->db->where('find_in_set("'.(int)$tags.'", posts.tags)');
    $CI->db->where('status', 'active');
    $CI->db->where_in('group', $group);
    $CI->db->where_in('id', $category_id);
    $CI->db->from('posts');
   $query = $CI->db->get();
$post = $query->row();
  
  if ($post) {
			return $post->$options;
           // var_dump($post);
      } 
  
     
	

	}
    function currency_active($id){
        	$CI =& get_instance();
       // SELECT * FROM `currency` WHERE `status_def` = 'active'
        $CI->db->where('status_def', 'active');
        $CI->db->from('currency');
        $query = $CI->db->get();
        $post = $query->row();
          if ($post) {
			return $post->$id;
           // var_dump($post);
           } 
  
    }
    function getCurrency($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('currency', array('id'=>$id, 'status_def' => 'active'))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
function getUser($id, $options)
{
    $CI =& get_instance();
    $post = $CI->db->get_where('users', array('user_id'=>$id, 'active' => '1'))->row();


    if ($post) {
        return $post->$options;
    }
}
    function getCurrencyAlias($alias)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('currency', array('alias' => $alias))->row();   	


		if ($post) {
			return $post;
      } else{
     	  return show_404();
      }
	}
    
    function currency_price($price, $alias = false){
        if($price){
        $CI =& get_instance();
        //$CI->load->library('session');
        /*if($CI->session->userdata('currency_type')){
            $currency = getCurrencyAlias($CI->session->userdata('currency_type'));
            
            if($currency->rates == 0){
                $price = number_format($price, 0, '.', ' ');
            }else{
               $price = number_format($price * $currency->rates, 2, '.', ' ');              
            }
            $currency_active = strtolower($currency->title);
        }else{*/
            $rates = (int)config_item('cur_rates');
            $title = config_item('cur_default');
            if($rates == 0){
                $price = number_format($price, 0, '.', ' ');                
            }else{
               $price = number_format($price * $rates, 2, '.', ' ');              
            }
             
             $currency_active = strtolower($title);
        //}
        if($alias){
            return $price ." <span>".$currency_active."</span>";
        }else{
            return $price;
        }
        
        }
        
        
    }
    
    
    function percent($percent, $number, $action) {
	$percent = $percent; // Необходимый процент
	$number_percent = $number / 100 * $percent;
	return $number_percent;
}

    function getListItem($post_id, $options, $is_main) {
	            
    	$CI =& get_instance();
		$post = $CI->db->get_where('lists_item', array('user_id'=> $CI->session->userdata('user_id'), 'post_id' => $post_id, 'list_id' => $is_main))->row();   	


		if ($post) {
			return $post->$options;
      } 
	

	}
    
    function getListItemId($post_id, $options) {
	            
    	$CI =& get_instance();
		$post = $CI->db->get_where('lists_item', array('user_id'=> $CI->session->userdata('user_id'), 'id' => $post_id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	

	}
    
      function getListCategoryTable($post_id, $options) {
	            
    	$CI =& get_instance();
		$post = $CI->db->get_where('lists', array('user_id'=> $CI->session->userdata('user_id'), 'id' => $post_id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	

	}
    
    function delivery_active($id){
        	$CI =& get_instance();
       // SELECT * FROM `currency` WHERE `status_def` = 'active'
        $CI->db->where('status_def', 'active');
        $CI->db->from('delivery');
        $query = $CI->db->get();
        $post = $query->row();
          if ($post) {
			return $post->$id;
           // var_dump($post);
           } 
  
    }
    function getDelivery($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('delivery', array('id'=>$id, 'status_def' => 'active'))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
    
    function getDeliveryAlias($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('delivery', array('id' => $id))->row();   	


		if ($post) {
			return $post;
      } else{
     	  return show_404();
      }
	}
    
     function getDeliveryAlias2($id,$options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('delivery', array('id' => $id))->row();   	


		if ($post) {
			return $post->$options;
      } else{
     	  return show_404();
      }
	}
    
        function currency_delivery_price($count){
       
        $CI =& get_instance();   
        $delivery = getDeliveryAlias($CI->session->userdata('country_del_id'));       
        if($count == 1){              
             $price = $delivery->value_1;                     
        }    
        if($count == 2){              
             $price = $delivery->value_2;              
        }   
        if($count == 3){              
             $price = $delivery->value_3;   
        }  
          if($count == 4){              
             $price = $delivery->value_4;                       
        }
         return $price;       
        
    }
    
    function delivery_price($count, $title_currency = false){
       
        $CI =& get_instance();   
        $currency_type = $CI->session->userdata('currency_type');
        $delivery = getDeliveryAlias($CI->session->userdata('country_del_id'));
        $currency = getCurrencyAlias($currency_type);
        if($count == 1){              
             $price = ($currency_type == 'uzs') ? $currency->rates * $delivery->value_1 : $delivery->value_1;                 
             if($title_currency){ 
                return number_format($price, 2, '.', ' ').' '.$CI->session->userdata('currency_type');
             }else{
                return $price;
             }             
        }    
        if($count == 2){              
             $price = ($currency_type == 'uzs') ? $currency->rates * $delivery->value_2 : $delivery->value_2;                 
             if($title_currency){ 
                return number_format($price, 2, '.', ' ').' '.$CI->session->userdata('currency_type');
             }else{
                return $price;
             }             
        }   
        if($count == 3){              
             $price = ($currency_type == 'uzs') ? $currency->rates * $delivery->value_3 : $delivery->value_3;                 
             if($title_currency){ 
                return number_format($price, 2, '.', ' ').' '.$CI->session->userdata('currency_type');
             }else{
                return $price;
             }             
        }  
          if($count == 4){              
             $price = ($currency_type == 'uzs') ? $currency->rates * $delivery->value_4: $delivery->value_4;                
              if($title_currency){ 
                return number_format($price, 2, '.', ' ').' '.$CI->session->userdata('currency_type');
             }else{
                return $price;
             }             
        }       
        
    }

function countListsItem($id){
    $CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM lists_item AS p 
  WHERE p.list_id = '".$id."'
  AND p.status = 'active'";
  return $CI->db->query($sql)->row('count');
}
function countListsUser(){
    $CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM lists_item AS p 
  WHERE p.user_id = '".$CI->session->userdata('user_id')."'
  AND p.status = 'active'";
  return $CI->db->query($sql)->row('count');
}
?>