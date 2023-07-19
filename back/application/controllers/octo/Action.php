<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Action extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('cart_model', 'cart_m'); 
        $this->load->model('octo_model', 'octo');
        $this->load->model('users_model', 'users');
        /*error_reporting(0);
        @ini_set('display_errors', 0);*/
    }

    private function log($result) {
        $log = fopen(__DIR__."/log.txt", "a");
        @fwrite($log, $result);
        @fwrite($log, "\n---------------------------------------\n");
        @fclose($log);
    }
    
    public function index()	{
	     $raw_post = file_get_contents('php://input');
         if($raw_post){
      	     $result = json_decode($raw_post, true);
             // $this->log($raw_post);
             //  var_dump($result);
             $shop_transaction_id = @$result['shop_transaction_id'];
             $status = @$result['status'];
                    
            $data = array(
              'status' =>  $status,
              'shop_transaction_id' => $shop_transaction_id,
              'octo_payment_UUID'  => @$result['octo_payment_UUID'],
              'octo_pay_url' => @$result['octo_pay_url'], 
              'error' => @$result['error'],
              'errorMessage' => @$result['errorMessage'],
              'transfer_sum' => @$result['transfer_sum'],
              'refunded_sum' => @$result['refunded_sum'],
              'signature' => @$result['signature'],
              'hash_key' => @$result['hash_key'],
            );
            
                              
            $octo = getOcto($shop_transaction_id);
           if($octo){
               $this->octo->save_update($data, $shop_transaction_id); 
               switch ($status) {
                case 'canceled':
                    $cart_data = array(
                        'status' => 'canceled',
                        'link' => @$result['octo_pay_url']
                    );
                    $this->octo->save_cart($cart_data, $shop_transaction_id);
                    //$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'canceled')));
                    break;
                case 'succeeded':
                     $cart_data = array(
                        'status' => 'complete',
                        'link' => @$result['octo_pay_url']
                    );
                    $this->octo->save_cart($cart_data, $shop_transaction_id);
                    $transfer_sum = @$result['transfer_sum'];
                    $balance_current = $octo->balance_current;
                    $wallet = $transfer_sum + $balance_current;
                    $user_id = $octo->t_user_id;
                    $user_data = array(
                        'wallet' => $wallet
                    );
                    $this->users->save2($user_data,$user_id);
                    // $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'succeeded')));
                    break;
                }
               //$this->session->set_userdata('octo_pay_url', @$result['octo_pay_url']);      
           
           }/*else{
            $this->octo->save_insert($data);
            //$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'no id')));
           }*/
           
         }else{
            $this->output->set_content_type('application/json')->set_output(json_encode(array('error' => 'no information')));
         }
	   
    }
    
     public function mycart(){
        //	if ($cart = $this->cart->contents()):
            $grand_total = 0;
            $cart_u_id = 33;
            $i = 1;	foreach ($cart as $item):     
            $grand_total = $grand_total + $item['subtotal'];
                    $order_detail[$i] = array(
                            'cart_u_id' => @$cart_u_id,
                            'user_id' 		=> $this->session->userdata('user_id'),
                            'product_id' 	=> $item['id'],
                            'created_date' => date('Y-m-d H:i:s'),      
                            // Количество товара
                            'count' 		=> $item['qty'],
                            'price' 		=> $item['price'],
        				);	  
                        $basket[] = array(
                            'position_desc' => _t(getPosts($item['id'], 'title'), 'en'). ' №'.$item['id'],
                            'count' => $item['qty'],
                            'price' => currency_price_octo($item['price'])
                        );      
                                    // Insert product imformation with order detail, store in cart also store in database. 
        		        // $this->cart_m->insert_order_detail($order_detail[$i]);
        		$i++;	endforeach;
            
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
                'total_sum' => str_replace(' ', '', getCart_u($cart_u_id, 'price')), //currency_price_octo($grand_total),
                'currency' => $currency,
                'description' => $description.''.$cart_u_id,
                //'basket' => $basket,
                'return_url' => site_url('profile/orderview/'.@$cart_u_id),
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
                  
                );
                
               
                
                 if(getOcto($shop_transaction_id)){
               $this->octo->save_update($data_cart_main, $shop_transaction_id); 
                 switch ($status) {
                case 'canceled':
                    $cart_data = array(
                        'status' => 'canceled',
                    );
                    $this->octo->save_cart($cart_data, $shop_transaction_id);
                    //$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'canceled')));
                    break;
                case 'succeeded':
                     $cart_data = array(
                        'status' => 'complete',
                    );
                    $this->octo->save_cart($cart_data, $shop_transaction_id);
                    // $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'succeeded')));
                    break;
                }
                   
           
           }else{
            $this->octo->save_insert($data_cart_main);
            //$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'no id')));
           }
                 $octo_pay_url = @$result['octo_pay_url'];
                
                $this->output->set_content_type('application/json')->set_output(json_encode($data_cart_main));
                
        		//endif;
    }
    
 }
 ?>