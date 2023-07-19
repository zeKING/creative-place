<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Site extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('site_model', 'site');
         $this->load->helper('admin');
         if($this->data['user_type'] == 'admin' || $this->data['user_type'] == 'osg'){
             
         }else{
            go_to(site_url('admin/main'));
         }
	}
	public function save($group, $id=false)	{
	    $this->load->library('Config_Writer');
 
		if ($id == 1)
		{
			 foreach($this->lang->languages as $key => $lang)
                {
                    $this->form_validation->set_rules('title['.$key.']', 'Title '.$key, 'trim');
                   // $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');
                }
			if ($this->form_validation->run())
			{
				$posts = $this->input->post();
				$data = array(
                    //'title'  	  => serialize($this->input->post('title')),
                    'content'	  => serialize($this->input->post('content')),
                    'meta_title'  => serialize($this->input->post('meta_title')),
                    'keywords'  	  => @$this->input->post('keywords'),               
                    'description'  	  => @$this->input->post('description'), 
                    'specialty'  	  => @$this->input->post('specialty'),
                    'site_off'  	  => @$this->input->post('site_off'),
                    'link' =>  @$this->input->post('link'),
                    'admin_ip' =>  @$this->input->post('admin_ip'),
                    'blacklist_ip' => @$this->input->post('blacklist_ip'),
                                                                    
				);
                 $writer = $this->config_writer->gcw();
                 if($this->input->post('admin_ip')){
                    //to write the main config file, omit the argument

                    $writer->write('admin_ip' , @$this->input->post('admin_ip'));
                }else{
                    $writer->write('admin_ip' , '');
                }
                $blacklist_ip = $this->config_writer->gcw(APPPATH.'config/blacklist.php');
                if($this->input->post('blacklist_ip')){
                    //$ip = array();
                   $ip = explode(',', @$this->input->post('blacklist_ip'));
                   //$ip_list = '';
                   $ip_list = array();
                   foreach($ip as $item){
                        //$ip_list .= "'".trim($item)."',";
                         $ip_list[] = trim($item);
                   }
                   $ip = array_values($ip_list);
                   //var_dump($ip);
                   
                   //$ip_list = rtrim($ip_list, ', ');
                   
                   //$ip_list = implode(',',$ip_list);
                 //  $ip_list = config_item('ip_addresses');
                  // var_dump($ip_list);
                  // $ip_list = array($ip_list);
                  //$ip = implode(',',$ip_list);
                //var_dump($ip_list[0]);
                // var_dump($ip_list);
                  /*  $ip = explode(',', @$this->input->post('blacklist_ip'));
                    foreach($ip as $item){
                        $ip[] = $item;
                    }
                    
                 
                  $result = implode(',', $ip);
                  $array = array('lastname', 'email', 'phone'); $comma_separated = implode("','", $array); $comma_separated = "'".$comma_separated."'";*/
                
                    $blacklist_ip->write('ip_array', $ip);
                }else{
                    $blacklist_ip->write('ip_array', '');
                }
                if($this->input->post('site_off') == 'yes'){
                    //to write the main config file, omit the argument

                    $writer->write('site_status' , 'yes');
                }
                if($this->input->post('site_off') == 'no'){
                    $writer->write('site_status' , 'no');
                }
                if(@$this->input->post('delivery_price')){
                    $writer->write('delivery_price' , @$this->input->post('delivery_price'));
                }else{
                   $writer->write('delivery_price' , 0); 
                }
				if (isset($posts['data']))
				{
					foreach ($posts['data'] as $key=>$val)
	                    $data[$key] = $val;
	            }
                    $this->site->save($data, $id);
            go_to("admin/main");
			}
			$this->data['post'] = $this->site->get($id);
            $this->data['sel'] = $group;
    		$this->data['body'] = "admin/{$group}/save";
    	    $this->load->view('admin/index', $this->data);
		}else{
		  go_to("admin/main");
		}                    
		
	}
}
?>