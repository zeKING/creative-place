<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class User extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        
         if($this->data['user_id2']){
            $u_post = $this->data['u_post_main'];
            $this->load->model('model_regions');
            $this->load->model('model_city');
            $this->load->model('users_model', 'users');
            $this->load->model('user_message_model', 'user_message');
            $this->load->model('user_favorites_model', 'user_favorites');
            $this->load->model('user_feed_model', 'user_feed');
            $this->load->model('user_tariff_model', 'user_tariff'); 
            $this->data['sel_main']     = 'user';   
            
       
           // $this->data['cregions_list'] = $this->model_regions->regions_get();
           // $this->data['ccity_list'] = $this->model_city->city_get();
            if($u_post->ban == 'yes'){
                 //$this->session->sess_destroy();
                 //$this->session->unset_userdata('user_id2');
                 $this->session->set_flashdata('error_success', lang('u_account_ban'));     
                 go_to(site_url());
            }   
            /*if($u_post->user_type == 'teacher'){
                $day_reg = DateTime::createFromFormat('Y-m-d H:i:s', $u_post->created);
                $now = new DateTime('now');                
                $diff = $now->diff($day_reg);
                if($u_post->tariff_st_free == 'active'){
                    $d = $this->data['tarrif_days'];
                    if($diff->days >= $d){
                        $data = array(
                            'tariff_st_free' => 'inactive'
                        );
                        $this->users->save2($data, $u_post->user_id);
                        go_to(site_url('user/profile'));
                      
                    }
                   // echo $d;  
                }
            } */      
        }else{
            //$this->session->set_flashdata('error_success', 'Авторизуйтесь на сайте');     
            go_to(site_url());
        }
    }
    
     public function profile(){             
        $this->data['sel_user']       = 'user_info';
        $this->data['title']       = lang('user_profile');              
        $this->data['sel']     = 'profile';         
        $u_post = $this->data['u_post_main'];
        $base_url = base_url() . LANG . '/user/profile/?';
        $user_id = $u_post->user_id;
        $total = $this->user_message->get_count2($user_id);
        $per_page = 10;
        pagination_pages($base_url, $total, $per_page);
        $this->data['message'] = $this->user_message->get_message(array(
            'user_id_m' => $user_id,
            'orderby' => 'id_m',
            'order' => 'DESC',
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        
        if($u_post->user_type == 'teacher'){
             $this->data['favorites'] = $this->user_favorites->get_favorites(array(
                'user_id_f' => $user_id,
                'orderby' => 'id_f',
                'order' => 'DESC',
                'limit' => '3000',
            ));
        }
        if($u_post->user_type == 'student'){
             $this->data['favorites'] = $this->user_favorites->get_favorites(array(
                'user_id_f' => $user_id,
                'orderby' => 'id_f',
                'order' => 'DESC',
                'limit' => '3000',
                'field' => 'user_f_id'
            ));
        }
        
        $this->data['body'] = 'user/profile/index';
        $this->load->view('public/container', $this->data);     
    }
    
      
    
    public function edit(){  
            
        $this->data['sel_user']       = 'user_info';
        $this->data['title']       = lang('p_edit');              
        $this->data['sel']     = 'user';     
        $u_post = $this->data['u_post_main'];
        $this->data['cregions_list'] = $this->model_regions->regions_get();
        $this->data['ccity_list'] = $this->model_city->city_get();
        if($u_post->user_type == 'teacher'){           
            $this->data['body'] = 'user/profile/teacher/edit';         
        }   
        if($u_post->user_type == 'student'){
            $this->data['body'] = 'user/profile/student/edit';
        }          
        
        $this->load->view('public/container', $this->data);
     
    }
    
     public function tariff(){              
        $this->data['sel_user']       = 'user_info';
        $this->data['title']       = lang('p_tariff');              
        $this->data['sel']     = 'tariff';  
        $this->data['sub_sel']     = 'current';  
        $user_id = $this->data['user_id2'];
        $user = $this->data['u_post_main'];
        if($user->user_type == 'teacher'){
            $this->data['active_t'] = $this->user_tariff->get_id($user->tariff_id);
            $this->data['body'] = 'user/profile/teacher/tariff/index';
            $this->load->view('public/container', $this->data);
        }else{
            go_to(site_url('user/profile'));
        }     
    }  
    
     public function prev_tariff(){              
        $this->data['sel_user']       = 'user_info';
        $this->data['title']       = lang('p_prev_tariff');              
        $this->data['sel']     = 'tariff';  
        $this->data['sub_sel']     = 'prev'; 
        $user_id = $this->data['user_id2'];
        $user = $this->data['u_post_main'];
        if($user->user_type == 'teacher'){
            $base_url = base_url() . LANG . '/user/prev_tariff/?';            
            $total = $this->user_tariff->get_count($user_id,'inactive');
            $per_page = 2;
            pagination_pages($base_url, $total, $per_page);
            $this->data['prev_tariff'] = $this->user_tariff->get_user_tariff(array(
                'user_t_id' => $user_id,
                'status_t' => 'inactive',
                'limit' => $per_page,
                'offset' => (int) $this->input->get('page')
            ));
            $this->data['pagination'] = $this->pagination->create_links();
            
            $this->data['body'] = 'user/profile/teacher/tariff/index';
            $this->load->view('public/container', $this->data);
        }else{
            go_to(site_url('user/profile'));
        }     
    } 
    
    public function anketa(){              
        $this->data['sel_user']       = 'user_info';
        $this->data['title']       = lang('p_anketa');              
        $this->data['sel']     = 'user';  
        $user_id = $this->data['user_id2'];
        $user = $this->data['u_post_main'];
        if($user->user_type == 'teacher'){
            $this->data['files'] = $this->users->get_media_files($user_id, 5);   
            $this->data['cregions_list'] = $this->model_regions->regions_get();
            $this->data['ccity_list'] = $this->model_city->city_get();
            $this->data['body'] = 'user/profile/teacher/anketa';
            $this->load->view('public/container', $this->data);
        }else{
            go_to(site_url('user/profile'));
        }     
    }  
    
   public function feed(){             
        $this->data['sel_user']       = 'user_info';
        $this->data['title']       = lang('p_feed');              
        $this->data['sel']     = 'user';         
        $u_post = $this->data['u_post_main'];
        $base_url = base_url() . LANG . '/user/profile/feed?';
        $user_id = $u_post->user_id;
        $total = $this->user_feed->get_count2($user_id);
        $per_page = 10;
        pagination_pages($base_url, $total, $per_page);
        $this->data['message'] = $this->user_feed->get_message(array(
            'user_id_f' => $user_id,
            'orderby' => 'id_feed',
            'order' => 'DESC',
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();     
        
        $this->data['body'] = 'user/profile/teacher/feed';
        $this->load->view('public/container', $this->data);     
    } 
    
    // Выход
    public function logout(){
        $this->session->sess_destroy();
        go_to(site_url());
    }
}  
?>