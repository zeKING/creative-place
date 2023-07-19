<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Profile extends Apiuser_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model', 'users');    
        $this->load->model('cart_model', 'cart_u');      
        $this->load->library('form_validation');
        $token = $this->session->userdata('token');
        $this->data['token'] = $token;
        if(!$token){
            $data = array('message' => lang('u_auth'));
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
        }
    }
  
    public function index(){
        $token = $this->data['token'];
        if($token){
            $user = getUserToken($token);
            $data = array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
                'email' => $user->email,
                'birthday' => array(
                    'day' => to_date('d', $user->birthday),
                    'month' => to_date('m', $user->birthday),
                    'year' => to_date('Y', $user->birthday),
                    //'full' => to_date('d.m.Y', $user->birthday),
                ),
                'gender' => $user->gender
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => true)));        
        }
    }
    
    public function profile_form(){
        $token = $this->data['token'];
        if($token){
            $user = getUserToken($token);
            $user_id = $user->user_id;
            $this->form_validation->set_rules('first_name', 'lang:first_name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required');
            if($this->input->post('email') !== $user->email){
    	   //$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|is_unique[users.email]');
            }
            $status = false;
            if ($this->form_validation->run()){
                if($user->ban == 'no' || $user->active == '1'){
                    $day = $this->db->escape_str(trim($this->input->post('day')));
                    $month = $this->db->escape_str(trim($this->input->post('month')));
                    $year = $this->db->escape_str(trim($this->input->post('year')));
                    
                    if($day && $month  && $year){
                        $b = implode("-", array($day, $month, $year));
                        $birthday = to_date("Y-m-d", $b);
                    }else{
                        $birthday = '0000-00-00';  
                    }
                    $gender = $this->db->escape_str($this->input->post('gender'));
                    
                    $data_u = array(
                        'first_name' => $this->db->escape_str($this->input->post('first_name')),
                        'last_name' => $this->db->escape_str($this->input->post('last_name')),
                        'fio' => $this->input->post('last_name').' '.$this->input->post('first_name'),
                        'email' => $this->db->escape_str($this->input->post('email')),
                        'gender' => ($gender) ? $gender : 'no_gender',
                        'birthday' => $birthday,
                    );
                    $this->users->save($data_u, $user_id);
                    $status = true;
                    $data = array(
                        'message' => lang('update'),
                        //'data' => $data_u
                    ); 
                }else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_account_ban'),
                    ); 
                }
            }else{
                $status = false;
                $data = array(
                    'message' => lang('success_email_error1').'<br/>'. validation_errors(),
                );
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));
        }
    }
    
    public function change_password_form(){
        $token = $this->data['token'];
        if($token){
            $user = getUserToken($token);
            $user_id = $user->user_id;
            $this->form_validation->set_rules('old_pass', 'lang:old_pass', 'trim|required');            
            $this->form_validation->set_rules('pass', 'lang:new_pass', 'trim|required');
            $this->form_validation->set_rules('pass_conf', 'lang:password_conf', 'trim|required|matches[pass]');
         
            $status = false;
            if ($this->form_validation->run()){
                if(@$user->ban == 'no' || @$user->active == '1'){
                    $old_pass = @$this->bcrypt->check_password($this->input->post('old_pass'), $user->password);
                    if($old_pass){
                        $data_u = array(
                            'p_d' => $this->input->post('pass_conf'),
                            'password' => @$this->bcrypt->hash_password($this->input->post('pass')),
                        );
                        $this->users->save($data_u, $user_id);
                        $status = true;
                        $data = array(
                            'message' => lang('update'),
                            //'data' => $data_u
                        ); 
                    }else{
                        $status = false;
                        $data = array(
                            'message' => lang('invalid_old_pass'),
                        );
                    }
                }else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_account_ban'),
                    ); 
                }
            }else{
                $status = false;
                $data = array(
                    'message' => lang('success_email_error1').'<br/>'. validation_errors(),
                );
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));            
        }
    }
    
    public function myorder(){
        $token = $this->data['token'];
        if($token){
            $user = getUserToken($token);
            $user_id = $user->user_id;
             if(@$user->ban == 'no' || @$user->active == '1'){
                $count = $this->cart_u->get_user_cart_id($user_id);
                $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '10';
                $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
                $offset = $limit * ($page-1);
                $res = $this->cart_u->get_user_cart(array('limit' => (int)$limit,  'user_id' => $user_id, 'offset' => (int)$offset));
                 
                 foreach($res as $item){
                     $payment_status = ($item->payment == 2) ? lang('payment_'.$item->state) : lang('payment_'.$item->status); 
                     $data[] = array(
                       // 'id' => $item->id,
                        'title' => lang('order_zakaz').' '.$item->id,                  
                        'date' => to_date('d.m.Y',$item->created_date),
                        'payment_status' => $payment_status, 
                        'delivery_status' => lang('payment_'.$item->status_delivery),
                        'slug' => $item->id,
                     );
                 }
                 $status = ($res) ? true : false;
                 return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => @$count, 'data' => @$data, 'status' => @$status))); 
             }else{
                $status = false;
                $data = array(
                    'message' => lang('u_account_ban'),
                ); 
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => @$status))); 
             }
         }        
    }  
    
    public function orderview($id=false){
        $token = $this->data['token'];
        if($token){       
            if($id){
                $user = getUserToken($token);
                $user_id = $user->user_id;
                if(@$user->ban == 'no' || @$user->active == '1'){
                   $cart_post = $this->cart_u->get($id);
                   if($cart_post->user_id == $user_id){
                        $payment_status = ($cart_post->payment == 2) ? lang('payment_'.$cart_post->state) : lang('payment_'.$cart_post->status); 
                        $pay = getPayM(@$cart_post->payment);
                        $delivery_price = $cart_post->delivery_price;
                        $info = array(
                            'title' => lang('order_zakaz').' '.$cart_post->id,
                            'payment_method' => _t($pay->p_title, LANG),
                            'payment_status' => $payment_status, 
                            'delivery_status' => lang('payment_'.$cart_post->status_delivery),
                            'fio' =>  @$cart_post->last_name.' '.@$cart_post->first_name,
                            'phone' => @$cart_post->phone,
                            'date_delivery' => to_date('d.m.Y', $cart_post->dates),
                            'time_delivery' => $cart_post->delivery_time,
                            'address' => $cart_post->address,
                            'total_price' => currency_price($cart_post->price),
                            'total_price_product' => currency_price($cart_post->price - $delivery_price),
                            'delivery_price' => currency_price($delivery_price),
                            'currency_title' => config_item('cur_default'),
                        );
                        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '50';
                        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
                        $offset = $limit * ($page-1);
                        $res = $this->cart_u->get_view(array('limit' => $limit, 'cart_u_id' => $id, 'offset' => $offset, 'order' => 'DESC'));
                        foreach($res as $item){
                            $p = getPostsAll($item->product_id,'active');
                            $totals = $item->price * $item->count;
                            $data[] = array(                               
                                'title' => _t($p->title, LANG),
                                'url' => base_url().'uploads/'.$p->group.'/'.$p->url,
                                'price' => currency_price($p->price),
                                'count_product' => $item->count,
                                'total' => currency_price($totals),
                                'slug' => $p->alias,
                                'currency_title' => config_item('cur_default'),
                            );
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('info' => $info, 'data' => $data, 'status' => true)));
                   }else{
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
                   }
                }else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_account_ban'),
                    ); 
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => @$status)));
                }
            }else{
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false))); 
            }
        }
        
    }
    
    public function logout(){
        $token = $this->data['token'];
        if($token){
            $array_items = array('user_id2', 'token');
            $this->session->unset_userdata($array_items);
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => true))); 
        }
    }
}
?>