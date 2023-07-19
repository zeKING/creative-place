<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('users_model', 'users');
		$this->load->helper('cookie');
	} 

    public function login()
	{
        $time = 300;   
        $ip_address = $this->input->ip_address();
        $la = $this->users->get_login_attempts($ip_address);
        $counter = ($la) ? $la->counter : 0;
        $this->data['counter'] = $counter;
        $this->data['link'] = '';
        $admin_ip = config_item('admin_ip');
        if($admin_ip){
            $adm_ip = array();
            $adm_ip = explode(',', $admin_ip);
            foreach($adm_ip as $val){
                $adm_ip[$val] = $val;
            }
                $ip = $this->input->ip_address();        
        	    if($adm_ip[$ip]){
        	      // echo $adm_ip[$ip];
        	    }else{
        	       $this->session->sess_destroy();
        	       redirect(base_url());
                 
        	    }
            
        }
     
	    if(@$counter == 3){	          
               if($la->ip_address){
                    if($la->time < (time() - $time)){
    	               $this->users->clear_login_attempts($la->ip_address);
                        $this->session->sess_destroy();
                    }
               }
	    }else{   
            $this->form_validation->set_rules('username', 'Логин', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Пароль', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
              
                $username = addslashes($this->input->post('username'));
                $pass = addslashes($this->input->post('password'));
        
              
              $user = $this->users->getUserByLogin($username, $pass);
                // var_dump($user);
              //$user = $this->users->check_user($this->input->post('username'), $this->input->post('password'));
              
                if($user) {
                	authorize_bcrypt($user);
                //$user_type = getUserOption($user['user_id'], 'user_type');
               /* if($user_type == 'region'){
                      redirect(base_url('admin/main'));
                }elseif($user_type == 'moderator'){
                    redirect(base_url('admin/main'));
                }elseif($user_type == 'moderator_main'){
                    redirect(base_url('admin/main'));
                }else{*/
                    redirect(base_url('admin/main'));
              //  }
                
              }else {
                $this->session->set_flashdata('error', 'Пользователь не найден');               
                
                if($la){        
                    $data['counter'] = $counter+1;
                    $data['time'] = time();
                    $this->users->save_login_attempts($data, $ip_address);
                    //$this->session->set_tempdata('counter', $counter+1, $time);
                }else{
                   // $this->session->set_tempdata('counter', 1, $time);
                    $data = array(
                        'ip_address' => $ip_address,
                        'login' => $username,
                        'time' => time(),
                        'counter' => 1
                    );
                    $this->users->save_login_attempts($data);
                }
             //   go_to('auth/login');
                redirect(base_url('auth/login'));
              }
            }
        }
	    $this->load->view('public/auth/login', $this->data);
        
	}
     public function osg()
	{	
	    if($this->input->get('access') == 'yes'){   
	       $time = 300;   
        $ip_address = $this->input->ip_address();
        $la = $this->users->get_login_attempts($ip_address);
        $counter = ($la) ? $la->counter : 0;
        $this->data['counter'] = $counter;
        $this->data['link'] = base_url('auth/osg?'.http_build_query(@$_GET));
     
	    if(@$counter == 3){	          
               if($la->ip_address){
                    if($la->time < (time() - $time)){
    	               $this->users->clear_login_attempts($la->ip_address);
                        $this->session->sess_destroy();
                    }
               }
	    }else{   
            $this->form_validation->set_rules('username', 'Логин', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Пароль', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
              
                $username = addslashes($this->input->post('username'));
                $pass = addslashes($this->input->post('password'));
        
              
              $user = $this->users->getUserByLogin($username, $pass);
                // var_dump($user);
              //$user = $this->users->check_user($this->input->post('username'), $this->input->post('password'));
              
                if($user) {
                	authorize_bcrypt($user);
                //$user_type = getUserOption($user['user_id'], 'user_type');
               /* if($user_type == 'region'){
                      redirect(base_url('admin/main'));
                }elseif($user_type == 'moderator'){
                    redirect(base_url('admin/main'));
                }elseif($user_type == 'moderator_main'){
                    redirect(base_url('admin/main'));
                }else{*/
                    redirect(base_url('admin/main'));
              //  }
                
              }else {
                $this->session->set_flashdata('error', 'Пользователь не найден');               
                
                if($la){        
                    $data['counter'] = $counter+1;
                    $data['time'] = time();
                    $this->users->save_login_attempts($data, $ip_address);
                    //$this->session->set_tempdata('counter', $counter+1, $time);
                }else{
                   // $this->session->set_tempdata('counter', 1, $time);
                    $data = array(
                        'ip_address' => $ip_address,
                        'login' => $username,
                        'time' => time(),
                        'counter' => 1
                    );
                    $this->users->save_login_attempts($data);
                }
             //   go_to('auth/login');
             
                redirect(base_url('auth/login'.$link));
              }
            }
        }
        }
	    $this->load->view('public/auth/login', $this->data);
        
        
	}
 

	public function logout_admin()
	{
        $this->session->sess_destroy();
		redirect(base_url('auth/login'));
	}
  


}
?>