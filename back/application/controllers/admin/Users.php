<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();		

		$this->data['sel'] = 'users';
        $this->data['sel_users'] = 'users';
        		

		$this->load->model('users_model', 'users');
        $this->load->model('model_regions');
       // $this->load->model('user_events_model', 'user_events');
    // $this->load->model("faq_model", "faq");
		//$this->config->set_item('language', 'russian');
   if(($this->data['user_type'] == 'admin') || ($this->data['user_type'] == 'moderator')){
  
   }else{
      go_to(site_url('admin/main'));
   }
	} 

	public function index($type)
	{
	   if($type){
        /*if($type == 'user'){
        $base_url = base_url().'/admin/users/?';
        
        } else {*/
        $base_url = base_url().'/admin/users/index/'.$type.'/?';
        //}
        $total = $this->users->get_users_count_admin($type);
        $per_page = 50;
        
        pagination_block($base_url, $total, $per_page);
        
        $this->data['users'] = $this->users->get_list(array('user_type'=>$type,'phone'=>'1', 'limit' => $per_page, 'offset' => (int)$this->input->get('page')));
        
        $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['sub_sel'] = $type;
        $this->data['body'] = 'admin/users/index';
        $this->load->view('admin/index',$this->data);
        }else{
            go_to(base_url('admin/main'));
        }
	}
  
     

	public function save($type, $user_id=FALSE)
	{
        
		$edit_email = '';
        $edit_phone = '';
        $edit_username = '';
		if($user_id) {
            $post = $this->users->get($user_id);
			$this->data['user'] = $post;
			$edit_email = ($this->input->post('email') == $post->email) ? '.true' : '';
            $edit_phone = ($this->input->post('phone') == $post->phone) ? '.true' : '';
            $edit_username = ($this->input->post('username') == $post->username) ? '.true' : '';
		}else{
		      if($type == 'user'){
		          go_to(base_url('admin/users/index/user'));
		      }
		}

	//	$this->form_validation->set_rules('first_name', 'lang:first_name', 'trim|required');
	//	$this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required');
        if($type == 'admin' || $type == 'moderator'){
		$this->form_validation->set_rules('username', 'lang:username', 'trim|is_unique[users.username'.$edit_username.']');
        }else{
            $this->form_validation->set_rules('phone', 'Телефон', 'trim|is_unique[users.phone'.$edit_phone.']');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|valid_email|is_unique[users.email'.$edit_email.']');
          //  echo "test";
        }
		//$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|is_unique[users.email'.$edit.']');
	//	$this->form_validation->set_rules('password', 'lang:password', 'trim|required');
	//	$this->form_validation->set_rules('c_password', 'lang:confirm_password', 'trim|required|matches[password]');
	//	$this->form_validation->set_rules('user_type', 'lang:user_type', 'trim|required');
		$this->form_validation->set_rules('active', 'lang:active', 'trim');

		if($this->form_validation->run()) {      
        
			$data = array(
                'fio' => $this->input->post('fio'),

                //'username' => $this->input->post('username'),
                'show_home' => $this->input->post('show_home'),
                'about_me' => $this->input->post('about_me'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
               // 'description' => $this->input->post('description'),	
                'user_type' => $this->input->post('user_type'),
                //'region_id' => $this->input->post('region_id'),
                'active' => $this->input->post('active'),
                //'category_id' => $this->input->post('category_id'),
                
                // 'dob' => $this->input->post('dob'),                
                'ban' => $this->input->post('ban'),                
                // 'phone_verified' => $this->input->post('phone_verified'),
                // 'email_verified' => $this->input->post('email_verified'),    
                //'created' => date('Y-m-d H:i:s'),
                'ip' => $this->input->ip_address(),
                //  'company' => $this->input->post('company'),
                //  'position' => $this->input->post('position'),
                // 'company_scope' =>  $this->input->post('company_scope'),
                //'promocode' => $this->input->post('promocode'),
			);
            
        	if($user_id) {
        	   $data['modified']  = date('Y-m-d H:i:s');
            }else{
                $data['created']  = date('Y-m-d H:i:s');
            }
           /* if($type == 'admin' || $type == 'moderator'){
                $data['username']  = $this->input->post('username');
            }else{
                $data['region_id']  = $this->input->post('region_id');
                $data['email']  = $this->input->post('email');
                $data['phone']  = $this->input->post('phone');
                $data['address']  = $this->input->post('address');
                
                
            }*/
            if(!empty($_FILES['userfile']['name'])){
				$this->load->library('MediaLib');
				$this->medialib->single_upload('users');
				$picture = $this->upload->data();
				$data['img']  = $picture['file_name'];
                $a_picture = array(
                    'a_picture' => $picture['file_name'],
                );
                $picture_user = array(
                    'img' => $picture['file_name'],
                );
			}      

            if($this->input->post('password') != '0') {
                $data['password'] = $this->bcrypt->hash_password($this->input->post('password'));
            }
            if($this->input->post('c_password') != '0') {
                $data['p_d'] = $this->input->post('password');
            }
			$this->users->save($data, $user_id);

			go_to('admin/users/index/'.$data['user_type']);
		}		
        $this->data['cregions_list'] = $this->model_regions->regions_get();
        $this->data['type'] = $type;
		$this->data['body'] = 'admin/users/save';
	    $this->load->view('admin/index',$this->data);
	}
    
      
    
  /*  public function export($id)
    {
    $this->load->library('phpexcel');
    
    //$this->data['clients'] = $this->clients_m->get(NULL, FALSE, array('user_id'=>$user_id)); 
    //$users = $this->users->get_list_s(array('user_type_social_1' => 'resident'));   
    $users = $this->user_events->get_list( array('post_id' => $id));  
    
    $objPHPExcel = new PHPExcel();
    $heading=array('Имя','Фамилия','Email','Телефон','Дата рождения');
    //$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
    $objPHPExcel->getActiveSheet()->setTitle("Участники");
    $rowNumberH = 1;
    $colH = 'A';
    foreach($heading as $h){
    $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
    $colH++;    
    }
    $objPHPExcel->setActiveSheetIndex(0); 
    $i=2; foreach($users as $item){
    $objPHPExcel->getActiveSheet()->setCellValue("A$i", getUserOption($item->user_id, 'first_name')); 
    $objPHPExcel->getActiveSheet()->setCellValue("B$i", getUserOption($item->user_id, 'last_name')); 
    $objPHPExcel->getActiveSheet()->setCellValue("C$i", getUserOption($item->user_id, 'email')); 
    $objPHPExcel->getActiveSheet()->setCellValue("D$i", getUserOption($item->user_id, 'phone')); 
    $objPHPExcel->getActiveSheet()->setCellValue("E$i", to_date('d.m.Y', getUserOption($item->user_id, 'birthday'))); 
    //$objPHPExcel->getActiveSheet()->setCellValue("F$i", _t(getPosts($id, 'title'))); 
    $i++;
    }
    
    
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    /* Записываем в файл */
    //header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
  /*  header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="events_'.date('d-m-y').'.xls"');
    header('Cache-Control: max-age=0');
    
    // Выводим содержимое файла
    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    $objWriter->save('php://output');
    go_to(base_url('admin/users/resident'));
    //var_dump($users);
    }*/

    
  
  	public function profile($user_id)
	{
		$this->data['user'] = $this->users->get($user_id);		

			$this->data['body'] = 'admin/users/profile/index';
	    $this->load->view('admin/index',$this->data);
	}

	public function delete($user_id, $img = FALSE)
	{
        $user = $this->users->get($user_id);
        if($user->user_type == 'seller' || $user->user_type == 'buyer'){
          $this->users->delete($user_id, $img);		  
        }
		go_to();
	}
    
    public function delete_resident($user_id, $social)
	{
	   $data = array(
       'user_type_social_1' => $social,
       );
		$this->users->save($data, $user_id);
    
		go_to();
	}
    
    
  public function delete_img($img, $user_id)
	{
		$this->users->delete_img($img);
    $data['img'] = '';
    $this->users->save($data, $user_id);
    
   
		go_to();
	}
  public function delete_profile_img($img, $user_id)
	{
		$this->users->delete_profile_img($img);
       $data1['picture'] = '';
        $data2['a_picture'] = '';
      
       $this->users->save($data1, $user_id);
//        $this->faq->save_img_a($data2, $user_id);
   
		go_to();
	}
  
  
  
    public function search($type)
	{
            if($type){ 
            $fio = addslashes($this->input->get('fio'));
            $base_url = base_url().'/admin/users/search/'.$type.'/?';           
            $total = $this->users->search_count($type, $fio);
            $per_page = 50;
            
            pagination_block($base_url, $total, $per_page);
            
            $this->data['users'] = $this->users->get_list(array('user_type'=>$type, 'fio' => $fio, 'limit' => $per_page, 'offset' => (int)$this->input->get('page')));
            
            $this->data['pagination'] = $this->pagination->create_links();
            
            $this->data['sub_sel'] = $type;
            $this->data['body'] = 'admin/users/index';
            $this->load->view('admin/index',$this->data);
            }else{
                go_to(base_url('admin/main'));
            }
	}
    
     public function search_id($type)
	{
            if($type){ 
            $id = addslashes($this->input->get('id'));
            
            $this->data['users'] = $this->users->get_list(array('user_type'=>$type, 'user_id' => $id,  'offset' => (int)$this->input->get('page')));
            
            $this->data['pagination'] = $this->pagination->create_links();
            
            $this->data['sub_sel'] = $type;
            $this->data['body'] = 'admin/users/index';
            $this->load->view('admin/index',$this->data);
            }else{
                go_to(base_url('admin/main'));
            }
	}
  
    
    public function generate_password(){
         $pass = random_password();
         $this->output->set_content_type('application/json')->set_output(json_encode(array('pass' => $pass)));
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
        $has_alias = $this->users->check_email( $this->input->get('fieldValue'), $this->input->get('post_id') );
        if ($has_alias)
		{
			echo '["'.$field_id.'",false]';
		}
		else
		{
				echo '["'.$field_id.'",true]';
		}
    }
    
     public function status_ajax()
    {
        if ($this->input->post('status') and $this->input->post('postid')) {
            $id = $this->input->post('postid');
            if ($this->input->post('status') == 'true') {
                $status = "1";
            } else {
                $status = "0";
            }
        }

        $data = array(
            'active' => $status,

        );
        $this->users->save($data, $id);

        $return['result'] = '<span style="color: green">' . lang('updated') . '</span>';
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
    
    public function status_ban_ajax()
    {
        if ($this->input->post('status') and $this->input->post('postid')) {
            $id = $this->input->post('postid');
            if ($this->input->post('status') == 'true') {
                $status = "yes";
            } else {
                $status = "no";
            }
        }

        $data = array(
            'ban' => $status,

        );
        $this->users->save($data, $id);

        $return['result'] = '<span style="color: green">' . lang('updated') . '</span>';
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
}