<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Subscribe extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('subscribe_model', 'subs');
        	$this->data['sel'] = 'subscribe';
    }
    
    public function index(){
        
        
        $base_url = base_url().'/admin/subscribe/?';
        $total = $this->subs->get_count('subscriber');
        $per_page = 20;
        
        pagination_block($base_url, $total, $per_page);
        
        $this->data['users'] = $this->subs->get_list(array('user_type'=>'subscriber', 'limit' => $per_page, 'offset' => (int)$this->input->get('page')));
        
        $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['body'] = 'admin/subscribe/index';
        $this->load->view('admin/index', $this->data);
    }
    
    	public function delete($user_id, $img = FALSE)
	{
        $this->subs->delete($user_id, $img);	  
        
		go_to();
	}
    
}
?>