<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Basket extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('works_model', 'works');
    }
   
    public function index(){
        $user_id = $this->session->tempdata('user_id2');
         $cart = $this->cart->contents();

         if($cart){

            $cart = cartUpdate($cart);

            $grand_total = 0;
            foreach($cart as $item){
                $grand_total = $grand_total + $item['subtotal'];
                $price = $item['price'];
                $amount = $price * $item['qty'];
                $op = $this->cart->product_options($item['rowid']);
                $work = $this->works->get($item['id']);
                $f_status = getFavourite($user_id,$work->id);
                $fav_status = (@$f_status->status == 'active') ? true : false;
                $data[] = array(
                    'rowid' => $item['rowid'],
                    'favourite' => $fav_status,
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'user_name' => getUser(@$op['user_id'], 'fio'),
                    'price' => $price,
                    'amount' =>$amount,
                    'qty' => $item['qty'],
                    'user_id' => @$op['user_id'],
                    'tag_id' => _t(get_tag(@$op['tag_id'])->title,newLANG),
                    "file" => (@$work->file) ? base_url('uploads/works/'.@$work->file) : '',
                );
            }

             return $this->output->set_content_type('application/json')->set_output(json_encode(array('total_count' => count($cart), 'total_sum' => $grand_total, 'data' => $data, 'status' => true)));
         }else{
            $data = null;
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
         }

    }

    public function add(){
        $id = $this->db->escape_str(trim($this->input->post('id')));
        if(@$id){
            $post = getWorksAll($id);

            if(@$post->status == 'active'){

                if($this->cart->in_cart($id)){
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false)));
                }
                else{
                    $price = $post->price;
                    $insert_data = array(
                        'id' => $id,
                        'name' => $post->name,
                        'price' => $price,
                        'amount' => $price,
                        'qty' => '1',
                        'options' => array(
                            'user_id' => $post->user_id,
                            'tag_id' => $post->tag_id

                        ),
                    );
                    $this->cart->insert($insert_data);
                    $this->output->set_status_header(200);
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => true)));

                }


            }else{
                $this->output->set_status_header(404);
                return $this->output->set_content_type('application/json')->set_output(json_encode(array( 'status' => false)));
            }

        }else{
            $this->output->set_status_header(404);
            return $this->output->set_content_type('application/json')->set_output(json_encode(array( 'status' => false)));
        }
    }

    public function remove(){
        $cart = $this->cart->contents();
        if($cart){
            $rowid = $this->db->escape_str(trim($this->input->post('rowid')));
            if($rowid){
                if($this->cart->get_item($rowid)){
                	$this->cart->remove($rowid);
                    $data = array(
                        'rowid' => $rowid,
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data,'status' => true)));
                }else{
                     return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false)));
                }
            }else{
                return $this->output->set_content_type('application/json')->set_output(json_encode(array( 'status' => false)));
            }
        }else{
             $data = null;
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
        }
    }
    
    public function clear(){
        $cart = $this->cart->contents();
        if($cart){
            $this->cart->destroy();     
            $data = null;
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
        }else{
            $data = array(
                'message' => lang('success_email_error1')
            );            
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => true)));
        }
    }
    
    public function qty_plus(){
        $cart = $this->cart->contents();
        if($cart){
            if(is_numeric(trim($this->input->post('id'))) && is_numeric(trim($this->input->post('qty')))){
                $id = trim($this->input->post('id'));
                $qty = trim($this->input->post('qty'));              
                $check_cart = $this->cart->in_cart_get($id);
                if($check_cart){
                    $rowid = $check_cart['rowid'];
                    $price = $check_cart['price'];
                    $qty =   $check_cart['qty'] + $qty;

                    $amount = $price * $qty;
                    

                        $data = array(
                            'rowid' => $rowid,          
                            'price' => $price,
                            'amount' =>  $amount,
                            'qty' => $qty,             
                        );
                        $this->cart->update($data);
                        $d = array(
                            'id' => $id,
                            'qty' => $qty
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$d, 'status' => true)));

                   
                }else{
                     return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => false)));
                }
               
            }else{
                $data = array(
                    'message' => lang('success_email_error1')
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
            }            
        }else{
            $data = null;
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
        }
    }
    
    public function qty_minus(){
        $cart = $this->cart->contents();
        if($cart){
            if(is_numeric(trim($this->input->post('id'))) && is_numeric(trim($this->input->post('qty')))){
                $id = trim($this->input->post('id'));
                $qty = trim($this->input->post('qty'));              
                $check_cart = $this->cart->in_cart_get($id);
                if($check_cart){
                    $rowid = $check_cart['rowid'];
                    $price = $check_cart['price'];
                    $qty =   $check_cart['qty'] - $qty;
                    if($qty == 0 || $qty == 1){
                        $qty = 1;
                    }
                    $amount = $price * $qty;
                        $data = array(
                            'rowid' => $rowid,          
                            'price' => $price,
                            'amount' =>  $amount,
                            'qty' => $qty,             
                        );
                        $this->cart->update($data);
                        $d = array(
                            'id' => $id,
                            'qty' => $qty
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$d, 'status' => true)));
                    
                   
                }else{
                     return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => false)));
                }
               
            }else{
                $data = array(
                    'message' => lang('success_email_error1')
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
            }            
        }else{
            $data = null;
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
        }
    }
}
?>