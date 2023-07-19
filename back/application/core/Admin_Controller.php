<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();        
        
		if ( $this->session->userdata('user_id') )
		{
           $u = getUserOptionAll($this->session->userdata('user_id'));
            $user_type = $u->user_type;
            $this->data['user_type'] = $u->user_type;
           // $this->data['menu_id'] =  ($u->menu_id) ? explode(',',  $u->menu_id) : 0;
           // $this->data['group_id2'] =  ($u->group_id) ? explode(',',  $u->group_id) : 0;
            $this->data['u'] = $u;
			if ($user_type !== 'admin' and $user_type !== 'moderator' and $user_type !== 'moderator_main'  )
				redirect(site_url('auth/login'));
		}
		else
		{
			redirect(site_url('auth/login'));
		}
        
        $admin_ip = config_item('admin_ip');
        $ip = $this->input->ip_address();  
        if($admin_ip){
            $adm_ip = array();
            $adm_ip = explode(',', $admin_ip);
            foreach($adm_ip as $val){
                $adm_ip[$val] = $val;
            }
           // var_dump($adm_ip);
           if($user_type == 'osg'){
            
           }else{
                      
        	    if($adm_ip[$ip]){
        	      // echo $adm_ip[$ip];
        	    }else{
        	       $this->session->sess_destroy();
        	       redirect(base_url());
                 
        	    }
            }
        }
        //echo $ip;
       /* if($this->blacklist->check_ip($ip)->is_blocked()){
            header('HTTP/1.0 403 Forbidden');
            die();
        }*/
        
        $this->data['user_id_main'] = $this->session->userdata('user_id');
        //  $this->load->model('faq_model','faq');
        //$this->data['count_msg'] = $this->faq->get_new_message($group = '0');
        // $this->data['get_faq'] = $this->faq->get_no_read(array('limit' => '5'));
        $this->load->helper('admin');
        // Load Language
        $this->load->language('admin');
        // Load Libraries
        $this->load->library('form_validation');
        //  $this->load->model('posts_model', 'admin');
        //  $this->data['user_types'] = array('user','admin','moderator_main','moderator','region');
        // ,'moderator_main','moderator','region' 
        $this->data['user_types'] = array('admin');//array('admin','moderator','user');    
        $this->data['user_types_add'] =  array('seller','buyer'); // array('client' ,'market');
        $this->data['img_lang'] = array('docs','b_side','b_row','b_middle');
        $this->data['sel_users'] = '';
        $this->data['sel_sub'] = '';
        $this->data['cat_id'] = '';
        $this->data['count_files'] = 5;   
        
	}
}
?>