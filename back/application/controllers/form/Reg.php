<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Reg extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->config('social');
        $this->load->helper('cookie');
    }
    
       /* public function activate($activation_code = false, $id = false)
    {
        $this->data['user'] = $this->users->check_user_active($id);
        if ($this->data['user'])
        {
            if ($id and $activation_code)
            {

                $this->data['user'] = $this->users->check_user_active($id);
                if ($this->data['user']->email_verified == '0')
                {
                    if ($this->data['user']->email_act_code === $activation_code)
                    {
                        $user = $this->users->activate_user($activation_code, $id);
                        $this->session->set_flashdata('message', 'Вы активировали свой E-mail');
                        authorize($user);
                        //go_to(site_url('dashboard'));
                        go_to(site_url('profile'));

                    } else
                    {
                        $this->session->set_flashdata('message', 'Этот код устарел! Попробуйте снова');
                        //go_to(site_url('dashboard'));
                        go_to(site_url());
                    }
                } else
                {
                    $this->session->set_flashdata('message',
                        'Вы уже активировали свой E-mail. Авторизуйтесь на сайте.');
                    //go_to(site_url('dashboard'));
                    go_to(site_url());
                }

            } else
            {
                $this->session->set_flashdata('message', 'Неправильная ссылка');
                go_to(site_url());
            }
        } else
        {
            $this->session->set_flashdata('message',
                'Пользователь не существует или был удален');
            go_to(site_url());
        }


    }*/
    
    public function login(){
        if(@$_SERVER["HTTP_REFERER"]){
             $this->form_validation->set_rules('username', 'lang:phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'lang:password', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {              
                $username = addslashes($this->input->post('username'));
                $pass = addslashes($this->input->post('password'));   
                $action = addslashes($this->input->post('action'));          
                $user = $this->users->getUserByLogin($username, $pass);                
                 if($user) {
                    if($user['ban'] == 'no'){                          
                        $user_id = $user['user_id'];
                        $client_count_st = $user['client_count_st'];
                        $employer_count_st = $user['employer_count_st'];
                        $data = array(
                        'ip' => $this->input->ip_address(),
                        'last_login' => date('Y-m-d H:i:s'),                      
                        );
                        $this->users->save2($data, $user_id);
                        //var_dump($user);                  
                       authorize_bcrypt_user($user_id);
                       if($action == 'active'){
                        go_to(site_url('user/profile'));
                       }else{
                        go_to();
                       }
                     
                    }else{
                        $this->session->set_flashdata('error_success', lang('u_account_ban'));     
                      go_to();
                    }
                 }else{
                      $this->session->set_flashdata('error_success', lang('u_login_incorrect'));   
                      go_to();
                 }
                
            }else{
                $this->session->set_flashdata('error_success', lang('u_data_incorrect'));
                go_to();
            }
        }else{
            redirect(site_url());
        }
    }
    
    public function forgot_password(){
        if(@$_SERVER["HTTP_REFERER"]){
            $this->form_validation->set_rules('phone', 'Телефон', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {        
                $phone = $this->input->post('phone');
                $check = $this->users->user_phone($phone);
                if($check){
                    if($check->ban == 'no'){
                        $pass = random_password2();
                        $user_id = $check->user_id;
                        $data = array(
                            'password' => $this->bcrypt->hash_password($pass),
                            'p_d' => $pass,
                        );
                        $this->users->save2($data, $user_id);
                        $this->session->set_flashdata('error_success', lang('u_new_pass_send_phone'));
                    }else{
                        $this->session->set_flashdata('error_success', lang('u_account_ban'));
                    }                    
                }else{
                    $this->session->set_flashdata('error_success', lang('u_not_found_phone'));
                }
            }else{
                $error = array(
                'error_success' => "<p>" . lang('success_email_error1') ."</p>" . validation_errors()
                 );
                $this->session->set_flashdata($error);
            }
            go_to();
        }else{
            go_to(site_url());
        }
    }
    
    
    public function registration()
    {
        if(@$_SERVER["HTTP_REFERER"]){
        $this->data['sel'] = 'signup';
        // matches[pass_conf]
        $this->form_validation->set_rules('pass', 'lang:password', 'trim|required');
        $this->form_validation->set_rules('pass_conf', 'lang:password_conf', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|is_unique[users.phone]');
        $this->form_validation->set_rules('first_name', 'lang:first_name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required');
       // $this->form_validation->set_rules('g-recaptcha-response', 'lang:reg_captcha', 'required|callback_validate_captcha');
        if ($this->form_validation->run())
        {
           $rand = rand(10000,99999); 
           $user_pr = $this->input->post('user');  
           $first_name = $this->input->post('first_name');
           $last_name = $this->input->post('last_name');
           $action = addslashes($this->input->post('action'));    
          // $user_type = $this->input->post('user_type');
           if($this->input->post('user_type') == '1'){
            $user_type = 'teacher';
           }
           if($this->input->post('user_type') == '2'){
            $user_type = 'student';
           }
           $data = array(                
                'password' => $this->bcrypt->hash_password($this->input->post('pass')),
                'p_d' => $this->input->post('pass'),
               // 'activation_code' => md5($this->input->post('email') . time()),
                //'email_act_code' => md5($this->input->post('email') . time()),
                'first_name' => $first_name,
                'last_name' => $last_name,
                'fio' => $first_name.' '.$last_name,
                'phone' => $this->input->post('phone'),               
                'user_type' => $user_type,  
                'active' => '1',
                'ip' => $this->input->ip_address(),
                'created'  => date('Y-m-d H:i:s'),
                
                'activation_code'=>$rand, 
                'number_act_code' => $rand, 
            );
            
            
            $user = $this->users->save($data);
            $user_post = getUserOptionAll($user->user_id);
            //$user_post = getUserOptionAll(4);
            //$this->session->set_userdata('phones', $user_post->phone);
            //$this->session->set_userdata('number_user', $user->user_id);
            
            
            
            $message = $rand;
            $phone1 = $user_post->phone;
            $phone = phone_tel($phone1);
            authorize_bcrypt_user($user_post->user_id);
            $success = array(
                'reg_success' => 'active'
            );
            $this->session->set_flashdata($success);
            //sms($id, $phone, $message);
            //go_to(site_url('user/profile'));
             if($action == 'active'){
                    go_to(site_url());
               }else{
                    go_to();
               }
         } else  {
           $error = array(
                //'first_name' => $this->input->post('first_name'),
                //'last_name' => $this->input->post('last_name'),                
                //'middle_name' => $this->input->post('middle_name'),
                //'phone' => $this->input->post('phone'),
               // 'user' => $this->input->post('user'),
                'error_success' => "<p>" . lang('success_email_error1') ."</p>" . validation_errors()
           );
           $this->session->set_flashdata($error);
            go_to();
        }
        

    }else{
        redirect(site_url());
    }
    }
    
      public function check_phone(){
        $field_id = $this->input->get('fieldId');
        $has_alias = $this->users->check_phone( $this->input->get('fieldValue'), $this->input->get('post_id') );
        if ($has_alias)
		{
			echo '["'.$field_id.'",false]';
		}
		else
		{
			echo '["'.$field_id.'",true]';
		}
    }
    
     public function check_email(){
        $field_id = $this->input->get('fieldId');
        $action = $this->input->get('action');
        $has_alias = $this->users->check_email( $this->input->get('fieldValue'), $this->input->get('post_id2') );
        if ($has_alias)
		{
			echo 'false';
		}
		else
		{
			echo 'true';
		}
    }
    public function check_user_login(){
        $user_id = $this->data['user_id2'];
        if($user_id){
            echo 'active';
        }else{
             $this->session->set_flashdata('error_success', lang('u_auth')); 
            echo 'inactive';
        }
    }
    
}

?>