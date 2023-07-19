<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_Controller extends MY_Controller
{
	public function __construct($offset = 0)
	{
		parent::__construct();

		$this->load->language('public');
        $this->load->language('public2');
        $ip = $this->input->ip_address();  
        if($this->blacklist->check_ip($ip)->is_blocked()){
            header('HTTP/1.0 403 Forbidden');
            die();
        }
        //$this->data['user_id2'] = $this->session->userdata('user_id2');
        if($this->data['user_id2']){
            $u_post = $this->data['u_post_main'];
            if($u_post->ban == 'yes'){
                 //$this->session->sess_destroy();
                 //$this->session->unset_userdata('user_id2');
                 $this->session->set_flashdata('error_success', 'Аккаунт заблокирован');     
                 go_to(site_url());
            }
            $this->data['meta_global'] = siteSettings('meta_tags_home', 'title+description+keywords');
            $this->data['keywords_glob'] = $this->data['meta_global']['keywords'];
            $this->data['description_glob'] = $this->data['meta_global']['description'];
            $this->data['meta_title_glob'] = $this->data['meta_global']['meta_title'];
        }else{
            $this->session->set_flashdata('error_success', 'Авторизуйтесь на сайте');     
            go_to(site_url());
        }
        
         

	}
}