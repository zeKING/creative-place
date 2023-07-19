<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class User extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        
         if($this->data['user_id2']){
            $u_post = $this->data['u_post_main'];
            $this->load->model('users_model', 'users');   
            $this->load->model('user_feed_model', 'user_feed'); 
            $this->load->model('user_message_model', 'user_message'); 
            $this->load->model('user_favorites_model', 'user_favorites');       
           //	$this->load->model('main_category_model', 'main_category'); 
           // $this->load->model('category_model', 'category');
           // $this->load->model('specialty_model', 'specialty');
            
            if($u_post->ban == 'yes'){
                 $this->session->set_flashdata('error_success', lang('u_account_ban'));     
                 go_to(site_url());
            }          
        }else{
            $this->session->set_flashdata('error_success', lang('u_auth'));     
            go_to(site_url());
        }
    }
    
    public function profile_save(){
        if(@$_SERVER["HTTP_REFERER"]){
            require_once('application/third_party/slim.php');
            $user =  $this->data['u_post_main'];
            $edit_email = ($this->input->post('email') == $user->email) ? '.true' : '';
            $edit_phone = ($this->input->post('phone') == $user->phone) ? '.true' : '';
            
            $this->form_validation->set_rules('first_name', 'lang:first_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|is_unique[users.phone'.$edit_phone.']');
            if($this->input->post('email')){
           $this->form_validation->set_rules('email', 'lang:p_email', 'trim|valid_email|is_unique_email[users.email'.$edit_email.']');
            }
            //$this->form_validation->set_rules('middle_name', 'lang:middle_name', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $user_id = $this->data['user_id2'];
                
                $images = Slim::getImages();
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                //$middle_name = $this->input->post('middle_name');
                
                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    //'middle_name' => $middle_name,
                    'fio' => $first_name.' '.$last_name,
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'certificates' => $this->input->post('certificates'),
                    'work_day' => implode(',',$this->input->post('work_day')),
                    'address' => $this->input->post('address'),
                    'experience' => $this->input->post('experience'),
                    'about' => trim(removeTags($this->input->post('about'))),
                    //'birthday' => ($this->input->post('birthday')) ? to_date('Y-m-d', $this->input->post('birthday')) : '', 
                    'region_id' => ($this->input->post('region_id')) ? $this->input->post('region_id') : '',
                    'city_id' => ($this->input->post('city_id')) ? $this->input->post('city_id') : '',
                  //  'gender' => $this->input->post('gender'),
                  //  'modified' => date('Y-m-d H:i:s')
                );
                
                   if($images){
                    @unlink('./uploads/profile/'.$user->picture);
                    $image = $images[0]; 
                    $file = Slim::saveFile($image['output']['data'], $image['input']['name'], 'uploads/profile/');
                    $data['picture']  = $file['name'];    
                } 
                
                $this->users->save2($data, $user_id);
               //var_dump($data);
            }else{
                $error = array(
                   // 'first_name' => $this->input->post('first_name'),
                    //'last_name' => $this->input->post('last_name'),
                   // 'middle_name' => $this->input->post('middle_name'),
                   // 'phone' => $this->input->post('phone'),
                   // 'birthday' => $this->input->post('birthday'),
                  //  'region_id' => $this->input->post('region_id'),
                   // 'user' => $this->input->post('user'),
                    'error_success' => "<p>" . lang('success_email_error1') ."</p>" . validation_errors()
                );
               $this->session->set_flashdata($error);
            }
            go_to(site_url('user/profile'));
        }else{
            go_to(site_url());
        }
    }
    
       public function anketa_save(){
        if(@$_SERVER["HTTP_REFERER"]){
            require_once('application/third_party/slim.php');
            $user =  $this->data['u_post_main'];
            if($user->user_type == 'teacher'){
                $edit_email = ($this->input->post('email') == $user->email) ? '.true' : '';
                $edit_phone = ($this->input->post('phone') == $user->phone) ? '.true' : '';
                
                $this->form_validation->set_rules('first_name', 'lang:first_name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|is_unique[users.phone'.$edit_phone.']');
                if($this->input->post('email')){
               $this->form_validation->set_rules('email', 'lang:p_email', 'trim|valid_email|is_unique_email[users.email'.$edit_email.']');
                }
                //$this->form_validation->set_rules('middle_name', 'lang:middle_name', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $user_id = $this->data['user_id2'];
                    
                    $images = Slim::getImages();
                    $first_name = $this->input->post('first_name');
                    $last_name = $this->input->post('last_name');
                    //$middle_name = $this->input->post('middle_name');
                    $time_week = $this->input->post('time_week');
                    if($time_week){              
                       foreach($time_week as $key => $value){
                            $days_week_id[] = $key;
                            foreach($value as $key1 => $val){
                               $time_id[] = $key.'_'.$key1;
                               $time_title[] = (int)$val;
                            }
                            $time_title = array_unique($time_title);
                       }
                       }else{
                         $days_week_id = '';
                         $time_id = '';
                         $time_title = '';
                       }
                    $data = array(
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        //'middle_name' => $middle_name,
                        'fio' => $first_name.' '.$last_name,
                        'phone' => $this->input->post('phone'),
                        'email' => $this->input->post('email'),
                        'experience' => $this->input->post('experience'),
                        'rate' => $this->input->post('rate'),
                        'a_experience' => $this->input->post('a_experience'),
                        'items_id' => implode(',', $this->input->post('items_id')),
                        'educational_id' => $this->input->post('educational_id'),
                        'degree_id' => $this->input->post('degree_id'),
                        'year_ending' => $this->input->post('year_ending'),
                        //'birthday' => ($this->input->post('birthday')) ? to_date('Y-m-d', $this->input->post('birthday')) : '', 
                        'region_list_id' => ($this->input->post('region_list_id')) ? $this->input->post('region_list_id') : '',
                        'city_list_id' => ($this->input->post('city_list_id')) ? $this->input->post('city_list_id') : '',
                        'places_id' => $this->input->post('places_id'),
                        'short_info' => trim(removeTags($this->input->post('short_info'))),
                        'detail_info' => trim(removeTags($this->input->post('detail_info'))),
                        'gender' => $this->input->post('gender'),
                        'age' => $this->input->post('age'),
                        'languages_id' => implode(',', $this->input->post('languages_id')),
                        'days_week_id' => implode(',', $days_week_id),
                        'time_id' => implode(',', $time_id),
                        'time_title' => implode(',', $time_title),
                        'total_anketa' => $this->input->post('total_anketa'),
                        'total_status' => ($this->input->post('total_anketa') >= 90) ? 'active' : 'inactive', 
                      //  'modified' => date('Y-m-d H:i:s')
                    );
                    
                       if($images){
                        @unlink('./uploads/profile/'.$user->picture);
                        $image = $images[0]; 
                        $file = Slim::saveFile($image['output']['data'], $image['input']['name'], 'uploads/profile/');
                        $data['picture']  = $file['name'];    
                    } 
                    
                   $this->users->save2($data, $user_id);
                  
                   
                }else{
                    $error = array(
                       // 'first_name' => $this->input->post('first_name'),
                        //'last_name' => $this->input->post('last_name'),
                       // 'middle_name' => $this->input->post('middle_name'),
                       // 'phone' => $this->input->post('phone'),
                       // 'birthday' => $this->input->post('birthday'),
                      //  'region_id' => $this->input->post('region_id'),
                       // 'user' => $this->input->post('user'),
                        'error_success' => "<p>" . lang('success_email_error1') ."</p>" . validation_errors()
                    );
                   $this->session->set_flashdata($error);
                }
                go_to(site_url('user/profile'));
            }else{
                go_to(site_url());
            }
        }else{
            go_to(site_url());
        }
    }
    
    public function delete_img(){
        if(@$_SERVER["HTTP_REFERER"]){
            $user = $this->data['u_post_main'];
            $user_id = $this->data['user_id2'];
            if($user->picture){
                @unlink('./uploads/profile/'.$user->picture);
                $data['picture']  = '';
                $this->users->save2($data, $user_id); 
            }            
        }else{
             go_to(site_url());
        }
    }
    
    public function add_files(){
        if(@$_SERVER["HTTP_REFERER"]){
            $this->load->library('MediaLibUser');
            $user_id = $this->data['user_id2'];
            $user =  $this->data['u_post_main'];
            if($user->user_type == 'teacher'){
                $files = $this->users->get_media_files($user_id, 5);
                $count = $this->data['count_files'];
                if(count($files) <= $count){
                $data = array(
        			'category' => 'files',
        			'user_id' => $user_id,
        		);
        
        		$result = $this->medialibuser->save2($data, $user_id, 'gif|jpg|jpeg|png|pdf');
        
        		echo json_encode($result);
                }
            }
        }else{
             go_to(site_url());
        }
    }
    
    public function delete_file(){
    
        $id = $this->db->escape_str($this->input->post('id'));
        if($id){
            $media = $this->users->getMediaId($id);
            $user_id = $this->data['user_id2'];
    		if ($media)
    		{
    		  if($media->user_id == $user_id){
    			@unlink( "./uploads/{$media->category}/{$media->user_id}/{$media->url}" );
                $this->users->deleteMedia($id);
                $return['status'] = 'yes';
                $return['count_files'] = count($files = $this->users->get_media_files($user_id, 5));
   			  }else{
   			      $return['status'] = 'no';
   			  }
              $this->output->set_content_type('application/json')->set_output(json_encode($return));
    		}
        }
    }
     

    
    public function password_change(){
        if(@$_SERVER["HTTP_REFERER"]){  
            $this->form_validation->set_rules('password', 'Новый пароль', 'trim|required|xss_clean|min_length[4]|max_length[12]');
            if($this->form_validation->run()) {  
                $user_id = $this->data['user_id2'];
                if($this->input->post('password') != '0') {
                    $data['password'] = $this->bcrypt->hash_password($this->input->post('password'));
                    $data['p_d'] = $this->input->post('password');
                    $this->users->save2($data, $user_id);
                   $error = array('error_success' => "<p>Обновлено</p>");
                    $this->session->set_flashdata($error);       
                }
            }else{
                 $error = array(
                    'error_success' => "<p>".lang('success_email_error1')."</p>" . validation_errors()
                 );
                $this->session->set_flashdata($error);
            }
            go_to();
        }else{
            go_to(site_url());
        }
    }
    
    public function feed(){
        if(@$_SERVER["HTTP_REFERER"]){
         
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('content', 'lang:feed_message', 'trim|required|xss_clean');
           
            if ($this->form_validation->run()) {
                $post_id = trim($this->input->post('post_id'));
               
                if($post_id){
                     $post = $this->users->get2($post_id);
                    $user =  $this->data['u_post_main'];
                    if($post->user_id && $user->user_id){
                        if($post->user_id != $user->user_id){
                            $data = array(
                                'user_id2' => $post->user_id,
                                'user_id2_feed' => $user->user_id,
                                'user_type' => $user->user_type,
                                'phone' => $this->input->post('phone'), 
                                'content' => trim(removeTags($this->input->post('content'))), 
                                'created_on'  => date('Y-m-d H:i:s'),
                                'user_id_f' => $post->user_id.','.$user->user_id
                            );
                            $this->user_feed->save($data);
                            
                            $error = array('error_success' => "<p>".lang('feed_send')."</p>");
                        }
                    }else{
                        $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                    }
                }else{
                     $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                    
                }
                $this->session->set_flashdata(@$error);
                go_to();
            }else{
                 $error = array('error_success' => "<p>".lang('success_email_error1')."</p>". validation_errors());
               $this->session->set_flashdata($error);
            }
        }else{
            redirect(site_url());
        }
    }
    
     public function message_send(){
        if(@$_SERVER["HTTP_REFERER"]){
         
            
            $this->form_validation->set_rules('message', 'lang:feed_message', 'trim|required|xss_clean');
           
            if ($this->form_validation->run()) {
                $post_id = trim($this->input->post('post_id'));
               
                if($post_id){
                     $post = $this->users->get2($post_id);
                    $user =  $this->data['u_post_main'];
                    if($user->user_type == 'student'){
                        if($post->user_id && $user->user_id){
                            if($post->user_id != $user->user_id){
                                $data = array(
                                    'user_m_id' => $post->user_id,
                                    'user_m_id2' => $user->user_id,
                                    'user_m_type' => $user->user_type,
                                      'status_t' => 'read',  
                                  
                                    'message' => trim(removeTags($this->input->post('message'))), 
                                    'created_on'  => date('Y-m-d H:i:s'),
                                    'user_id_m' => $post->user_id.','.$user->user_id
                                );
                                $this->user_message->save($data);
                                
                                $error = array('error_success' => "<p>".lang('feed_send')."</p>");
                            }
                        }else{
                            $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                        }
                    }else{
                        $error = array('error_success' => "<p>".lang('p_messages_access')."</p>");
                    }
                }else{
                     $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                    
                }
                $this->session->set_flashdata(@$error);
                go_to();
            }else{
                 $error = array('error_success' => "<p>".lang('success_email_error1')."</p>". validation_errors());
               $this->session->set_flashdata($error);
            }
        }else{
            redirect(site_url());
        }
    }
    
    public function message_reply(){
        if(@$_SERVER["HTTP_REFERER"]){
         
            
            $this->form_validation->set_rules('message', 'lang:feed_message', 'trim|required|xss_clean');
           
            if ($this->form_validation->run()) {
                $post_id = trim($this->input->post('post_id'));
               
                if($post_id){
                     $post = $this->user_message->get2($post_id);
                    $user =  $this->data['u_post_main'];
                
                        if($post->user_m_id2 != $user->user_id){
                            $data = array(
                                'status_reply' => 'active',  
                                //'status' => 'noread',   
                                'status_t' => 'noread',                      
                              
                                'message_reply' => trim(removeTags($this->input->post('message'))), 
                                'created_on_reply'  => date('Y-m-d H:i:s'),
                            );
                            $this->user_message->save2($data, $post->id_m);
                            
                            $error = array('error_success' => "<p>".lang('feed_send')."</p>");
                        }else{
                            $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                        }
                
                }else{
                     $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                    
                }
                $this->session->set_flashdata(@$error);
                go_to();
            }else{
                 $error = array('error_success' => "<p>".lang('success_email_error1')."</p>". validation_errors());
               $this->session->set_flashdata($error);
            }
        }else{
            redirect(site_url());
        }
    }
    
    public function favorites($id){
        
        if(@$_SERVER["HTTP_REFERER"]){
                    if($id){
                        $user =  $this->data['u_post_main'];
                        $item = $this->users->get2($id);
                        if($user->user_type == 'student' && $item->user_id){
                        $post = get_favorites($item->user_id, $user->user_id);
                        
                
                        if(!$post){
                            $data = array(
                                'user_f_id' => $item->user_id,  
                                'user_f_id2' => $user->user_id,                                                   'user_f_type' => $user->user_type, 
                                'created_on'  => date('Y-m-d H:i:s'),
                                'user_id_f' => $item->user_id.','.$user->user_id
                            );
                            $this->user_favorites->save($data);
                            
                           // $error = array('error_success' => "<p>".lang('feed_send')."</p>");
                        }else{
                            $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                        }
                        }else{
                             $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                        }
                    }else{
                        $error = array('error_success' => "<p>".lang('success_email_error1')."</p>");
                    }                    
              
                $this->session->set_flashdata(@$error);
                go_to();
         
        }else{
            redirect(site_url());
        }
    }
    
    public function favorites_accept(){
        if(@$_SERVER["HTTP_REFERER"]){
            $user =  $this->data['u_post_main'];
            if($this->input->get()){
                if($user->user_type == 'teacher'){
                    $id = $this->db->escape_str($this->input->get('id'));
                    $post_f = $this->user_favorites->get2($id);
                    if($post_f->user_f_id == $user->user_id){
                    $data = array(
                        'status' => 'active',  
                       // 'status_read' => 'noread',                         
                    );
                    $this->user_favorites->save2($data,$post_f->id_f);
                    
                    $return = array(
                        'status' => 'active',                        
                    );
                    }else{
                        $return = array(
                            'status' => 'inactive'
                        );
                    }
                }else{
                    $return = array(
                        'status' => 'inactive'
                    );
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($return));
            }else{
                go_to(site_url());
            }
            
        }else{
           redirect(site_url());  
        }
    }
    
    public function favorites_cancel(){
              if(@$_SERVER["HTTP_REFERER"]){
            $user =  $this->data['u_post_main'];
            if($this->input->get()){
                    $id = $this->db->escape_str($this->input->get('id'));
                    $post_f = $this->user_favorites->get2($id);
                    if($post_f->user_f_id == $user->user_id || $post_f->user_f_id2 == $user->user_id){
                    $data = array(
                        'status' => 'active',  
                       // 'status_read' => 'noread',                         
                    );
                    $this->user_favorites->delete($post_f->id_f);
                    $count_f = ($user->user_type == 'teacher') ? user_favorites_status($user->user_id,'noread','user_f_id') : user_favorites_status($user->user_id,'noread','user_f_id2');
                    $return = array(
                        'status' => 'active', 
                        'count' => $count_f                       
                    );
                    }else{
                        $return = array(
                            'status' => 'inactive'
                        );
                    }
              
                $this->output->set_content_type('application/json')->set_output(json_encode($return));
            }else{
                go_to(site_url());
            }
            
        }else{
           redirect(site_url());  
        }
    }
    
    public function favorites_read(){
        if(@$_SERVER["HTTP_REFERER"]){
            $user =  $this->data['u_post_main'];
            
                $data = array(
                    'status_read' => 'read',                         
                );
                if($user->user_type == 'teacher'){
                    $this->user_favorites->save3($data,$user->user_id);
                }
               /* if($user->user_type == 'student'){
                    $this->user_favorites->save4($data,$user->user_id);
                }*/
        }else{
            redirect(site_url());  
        }
    }
    
    public function generate_password(){
         if(@$_SERVER["HTTP_REFERER"]){ 
             $pass = random_password2();
             $this->output->set_content_type('application/json')->set_output(json_encode(array('pass' => $pass)));
         }else{
             go_to(site_url());
         }
    }
    
}
?>