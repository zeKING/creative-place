<?php

/**
 * @author Rustam OSG
 * @copyright 2018
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'feed';		

		$this->load->model('feed_model', 'feed'); 
	} 

   
    public function index($group, $offset = 0)
	{	 
        $this->load->library('pagination');
        $this->data['sel_sub'] = $group;
        $base_url = base_url().'/admin/feed/index/'.$group.'/?';    
        $total = $this->feed->getfeed_count($group);   
        $per_page = 50;    
        pagination_block($base_url, $total, $per_page);    
        $this->data['feed'] = $this->feed->get_feed(array('groups' => $group, 'limit' => $per_page, 'offset' => (int)$this->input->get('page')));   
        
        $this->data['group'] = $group;
        $this->data['pagination'] = $this->pagination->create_links();     
        $this->data['body'] = "admin/feed/index";
        $this->load->view('admin/index', $this->data);
	}
    
    public function edit($group, $id)
    {
         $this->data['sel_sub'] = $group;
        $this->form_validation->set_rules('name', 'Имя', 'trim|required');
        //$this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        //$this->form_validation->set_rules('phone', 'Телефон', 'trim|required');
       // $this->form_validation->set_rules('message', 'Сообщение', 'trim|required');
        //$this->form_validation->set_rules('time', 'Время', 'trim|required');
       // $this->form_validation->set_rules('people', 'Количество человек', 'trim|required');
       // $this->form_validation->set_rules('status', 'Статус', 'trim|required');
         
        if(!$this->form_validation->run())
        {
            
            $this->data['feed'] =  $this->feed->get($id);
             
    		$this->data['body'] = 'admin/feed/edit';
    	    $this->load->view('admin/index', $this->data);    
        }
        else
        {
            $data = array();
            //$data['name'] = $this->input->post('name');
            //$data['email'] = $this->input->post('email');
            //$data['phone'] = $this->input->post('phone');
            $data['message'] = $this->input->post('message');
           // $data['time'] = $this->input->post('time');
           // $data['people'] = $this->input->post('people');
            //$data['status'] = $this->input->post('status');
            
            $this->feed->save($data, $id);
            
            go_to("admin/feed/index/".$group);
        }        
    }
    
   	public function delete($id)
	{
	  $post = $this->feed->get($id);
      if($post->file){
       	@unlink( "./uploads/$post->groups/$post->file" );
        }
		$this->feed->delete($id);
		go_to();
	}
    
     public function status_ajax()
    {

        if ($this->input->post('status') and $this->input->post('postid')) {
            $id = $this->input->post('postid');
            if ($this->input->post('status') == 'true') {
                $status = "active";
            } else {
                $status = "inactive";
            }
        }


        $data = array(
            'status' => $status,

        );
        $this->feed->save($data, $id);

        $return['result'] = '<span style="color: green">' . lang('updated') . '</span>';
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
}