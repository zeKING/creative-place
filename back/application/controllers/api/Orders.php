<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Orders extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cart_model', 'cart_u');
        $this->load->model('works_model', 'works');
        $this->load->model('octo_model', 'octo');
    }
    private function log($result) {
        $log = fopen(__DIR__."/log.txt", "a");
        @fwrite($log, $result);
        @fwrite($log, "\n---------------------------------------\n");
        @fclose($log);
    }
    public function index(){
        $this->load->library('cart');
         $this->load->library('session');
        $cart = $this->cart->contents();
         $token = $this->session->tempdata('token');
         $user_id = $this->session->tempdata('user_id2');
         if($token){
            $user = getUserToken($token);
            if(@$user->ban == 'no' || @$user->active == '1'){

                    $status = false;
                    if ($cart){
                        $cart = cartUpdate($cart);

                        $grand_total = 0;
                        foreach($cart as $item) {
                            $grand_total = $grand_total + $item['subtotal'];
                        }
                         $data_post = array(
                             'user_id'=> $user_id,
                            'amount' => $grand_total,
                         );
                         $this->session->set_userdata($data_post);

                         $data = array(
                             'amount' => $grand_total,
                             'created_date' => date('Y-m-d H:i:s'),
                             'user_id' => $user_id,
                             'work_id' => serialize($this->input->post('work_id')),
                         );

                        $cart_u_id = $this->cart_u->insert_customer($data);
                        $order_id = array(
                            'order_id' => $cart_u_id
                        );
                        $this->cart_u->save($order_id, $cart_u_id);
                        /*octo pay*/


                        $this->config->load('octo');

                        $prepare_payment = $this->config->item('prepare_payment');
                        $octo_shop_id =  $this->config->item('octo_shop_id');
                        $octo_secret = $this->config->item('octo_secret');
                        $auto_capture =  $this->config->item('auto_capture');
                        $test =  $this->config->item('test');
                        $currency =  $this->config->item('currency');
                        $ttl =  $this->config->item('ttl');
                        $description =  $this->config->item('description');


                        //$user = $this->users->get($this->session->userdata('user_id'));

                        $data = array(
                            'octo_shop_id' => $octo_shop_id,
                            'octo_secret' => $octo_secret,
                            'shop_transaction_id' => @$cart_u_id,
                            'auto_capture' => $auto_capture,
                            'test' => $test,
                            'init_time' => date('Y-m-d H:i:s'),
                            /*'user_data' => array(
                                'user_id' => $user->id,
                                '' => $user
                            )*/
                            'total_sum' => str_replace(' ', '', getCart_u($cart_u_id, 'amount')), //currency_price_octo($grand_total),
                            'currency' => $currency,
                            'description' => $description.''.$cart_u_id,
                            'return_url' => 'https://dar.5ss.uz/',
                            'notify_url' => base_url('octo/action'),
                            'language' => LANG,
                            'ttl' => $ttl
                        );

                        //



                        $input = json_encode($data);
                        $ch = curl_init($prepare_payment);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=UTF-8'));
                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                        $res = curl_exec($ch);
                        curl_close($ch);
                        $result = json_decode($res, true);
                        $this->log($res);
                        $shop_transaction_id = @$result['shop_transaction_id'];
                        $status = @$result['status'];
                        $data_cart_main = array(
                            'status' =>  $status,
                            'shop_transaction_id' => $shop_transaction_id,
                            'octo_payment_UUID'  => @$result['octo_payment_UUID'],
                            'octo_pay_url' => @$result['octo_pay_url'],
                            'error' => @$result['error'],
                            'errorMessage' => @$result['errorMessage'],
                            'transfer_sum' => @$result['transfer_sum'],
                            'refunded_sum' => @$result['refunded_sum'],
                            't_user_id' => $user_id,

                        );
                        if(getOcto($shop_transaction_id)){
                            $this->octo->save_update($data_cart_main, $shop_transaction_id);
                            switch ($status) {
                                case 'canceled':
                                    $cart_data = array(
                                        'status' => 'canceled',
                                    );
                                    $cart_status= 'canceled';
                                    $this->octo->save_cart($cart_data, $shop_transaction_id);
                                    //$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'canceled')));
                                    break;
                                case 'succeeded':
                                    $cart_data = array(
                                        'status' => 'complete',

                                    );
                                    $cart_status= 'complete';
                                    $this->octo->save_cart($cart_data, $shop_transaction_id);
                                    // $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'succeeded')));
                                    break;
                            }

                            $cart_status = 'created';
                        }else{
                            $this->octo->save_insert($data_cart_main);
                            $cart_status = 'error';
                            //$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'no id')));
                        }
                        /*end octo pay*/

                        $status = true;
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('response'=>http_response_code(200), 'status' =>  $status, 'url'=> @$result['octo_pay_url'])));

                    }else{                       
                        $data = array(
                            'message' => lang('cart_empty'),
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'response'=>http_response_code(404), 'status' => $status)));

                    }

            }else{
                $status = false;
                $data = array(
                    'message' => lang('u_account_ban'),
                );

                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'response'=>http_response_code(404),  'status' => @$status)));
            }
         }else{
            $data = array('message' => lang('u_auth'));
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'response'=>http_response_code(404),  'status' => false)));
         }
        
    }
    
    public function history(){
        $this->load->library('session');

         $token = $this->session->tempdata('token');
         $user_id = $this->session->tempdata('user_id2');
         if($token){
            $user = getUserToken($token);
            if(@$user->ban == 'no' || @$user->active == '1'){
                $order = $this->cart_u->getU($user_id);

                foreach ($order as $item){
                    $id_work = unserialize($item->work_id);

                   foreach (@$id_work as $item1){
                        $work = $this->works->get($item1);
                        if(@$work){
                            $data[]=array(
                                'id' => $work->id,
                        'tag'=> _t(get_tag($work->tag_id)->title,newLANG),
                        'name' => $work->name,
                        "price" => $work->price,
                        "file" => ($work->file) ? base_url('uploads/works/' . $work->file) : '',

                            );
                        }else{
                            $data = null;
                        }

                    }

                }
                $status = true;
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => @$status)));

            }else{
                $status = false;
                $data = array(
                    'message' => lang('u_account_ban'),
                ); 
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => @$status))); 
            }
         }else{
            $data = array('message' => lang('u_auth'));
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
         }
    }
    
    
    public function payment_method(){
        $res =  $this->cart_u->get_admin_payment(array('limit' => '10', 'status' => 'active', 'order' => 'DESC'));
        foreach($res as $item){
            $data[] = array(                
                'title' => _t($item->p_title, LANG),     
                'value' => $item->p_id,          
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));  
    }
    
    public function time_delivery(){
        $res =  $this->cart_u->get_admin_time(array('limit' => '50', 'status' => 'active', 'order' => 'DESC'));
        foreach($res as $item){
            $data[] = array(
                'value' => _t($item->t_title, 'ru'),
                'title' => _t($item->t_title, LANG),               
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));  
    }
    
    
    
}
?>