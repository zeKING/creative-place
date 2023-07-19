<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart_admin extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'cart';		

    $this->load->model('cart_model', 'cart_m'); 
	} 

	public function index()
  
	{
        $id = '';
        if($this->input->get('id')){
            $id = addslashes($this->input->get('id'));   
        }
        $year = '';
        if($this->input->get('year')){
            $year = addslashes($this->input->get('year'));   
        }
        $date1 = '';
        $date2 = '';
        if($this->input->get('date1') && $this->input->get('date2')){
            $date1 = to_date('Y-m-d', addslashes($this->input->get('date1')));  
            $date2 = to_date('Y-m-d', addslashes($this->input->get('date2')));   
        }else{
            $date1 = ($this->input->get('date1')) ? to_date('Y-m-d', addslashes($this->input->get('date1'))) : '';  
        }
        
        $base_url = base_url().'/admin/cart_admin/?';
        $total = $this->cart_m->get_admin_cart_filter(array('id' => $id, 'date1' => $date1, 'date2' => $date2, 'year' => $year));
        $per_page = 20;
        
        pagination_block($base_url, $total, $per_page);
        
        $this->data['cart'] = $this->cart_m->get_admin_cart(array('limit' => $per_page, 'offset' => (int)$this->input->get('page'), 'date1' => $date1, 'date2' => $date2, 'id' => $id, 'year' => $year, 'order' => 'DESC'));
        
        $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['body'] = 'admin/cart/index';
        $this->load->view('admin/index', $this->data);
	}
    
   	public function stat()
  
	{
	   	$this->data['sel'] = 'stat_cart';	
        
        
      //  $this->data['cart'] = $this->cart_m->get_admin_cart(array('limit' => $per_page, 'offset' => (int)$this->input->get('page'), 'id' => $id, 'order' => 'DESC'));
      
        
        $this->data['body'] = 'admin/cart/stat/index';
        $this->load->view('admin/index', $this->data);
	}
    
    public function stat_ajax_month(){
        $year = ($this->input->get('year')) ? (int)$this->input->get('year'): date('Y');
        if($this->input->get('action') == 'main'){
            $this->data['cart'] = $this->cart_m->get_admin_cart(array('limit' => 1000000000000, 'offset' => (int)$this->input->get('page')));
        }else{
            $this->data['cart'] = $this->cart_m->get_admin_cart(array('limit' => 1000000000000,'year' => $year, 'offset' => (int)$this->input->get('page')));
        }
         
        $this->load->view('admin/cart/stat/month', $this->data);
    }
    
    
    
    public function save()
    {
        //$this->form_validation->set_rules('name', 'Имя', 'trim|required');
            $id = $this->input->post('id');
            if($id){
                $data = array();
                if(getCart_u($id, 'payment') == 2){
                     $data['state'] = $this->input->post('state');
                }
                $data['status'] = $this->input->post('status'); 
                //$data['pay_status'] = $this->input->post('pay_status');
                
                $data['status_delivery'] = $this->input->post('status_delivery'); 
                         
                
                $this->cart_m->save($data, $id); 
                //$this->session->set_flashdata('success', 'Обновлено');   
            }         
            go_to(base_url('admin/cart_admin'));
                
    }
    
      public function save_cart()
    {
        //$this->form_validation->set_rules('name', 'Имя', 'trim|required');
            $id = $this->input->post('id');
            $data = array();
            $data['status'] = $this->input->post('status');          
            
            $this->cart_m->save_cart($data, $id); 
            $this->session->set_flashdata($id, 'Обновлено');            
            go_to();
                
    }
    
     public function view($id){
        $this->data['sel'] = '';
        $base_url = base_url().'/admin/cart_admin/view/'.$id.'/?';
        $total = $this->cart_m->count_cart_id($id);
        $per_page = 1000;
        pagination_block($base_url, $total, $per_page);
        
        $this->data['cart_u_info'] =  $this->cart_m->get($id);
        
        $this->data['cart'] = $this->cart_m->get_view(array('limit' => $per_page, 'cart_u_id' => $id, 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
        
        $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['body'] = 'admin/cart/view';
        $this->load->view('admin/index', $this->data);  
    }
    
    public function payment_method(){
       
        $this->data['sel'] = 'payment_method';
        $base_url = base_url().'/admin/cart_admin/payment_method/?';
        $total = '';//$this->cart_m->get_admin_cart_filter(array('id' => $id));
        $per_page = 50;
        //pagination_block($base_url, $total, $per_page);
        
        $this->data['posts'] = $this->cart_m->get_admin_payment(array('limit' => $per_page, 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
        
       // $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['body'] = 'admin/cart/payment_method/index';
        $this->load->view('admin/index', $this->data);
    }
    
    	public function payment_method_save($id=FALSE)
	{
	  $this->data['sel'] = 'payment_method';
		$edit = '';
        $this->data['post'] = array();
		if($id) {
			$this->data['post'] = $this->cart_m->get_payment_m($id);
			$edit = '.true';
		}
		foreach($this->lang->languages as $key => $lang)
                {
                    $this->form_validation->set_rules('title['.$key.']', 'Title '.$key, 'trim');
                   // $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');

                }

		if($this->form_validation->run()) {      
        
			$data = array(
                'p_title'  	  => serialize($this->input->post('title')),
                'p_status' => $this->input->post('status'),
			);
            

			$this->cart_m->save_payment_m($data, $id);

			go_to('admin/cart_admin/payment_method');
		}			
        
		$this->data['body'] = 'admin/cart/payment_method/save';
	    $this->load->view('admin/index',$this->data);
      
	}
    public function delivery_method(){
       
        $this->data['sel'] = 'delivery_method';
        $base_url = base_url().'/admin/cart_admin/delivery_method/?';
        $total = '';//$this->cart_m->get_admin_cart_filter(array('id' => $id));
        $per_page = 50;
        //pagination_block($base_url, $total, $per_page);
        
        $this->data['posts'] = $this->cart_m->get_admin_delivery(array('limit' => $per_page, 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
        
       // $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['body'] = 'admin/cart/delivery_method/index';
        $this->load->view('admin/index', $this->data);
    }
    
    	public function delivery_method_save($id=FALSE)
	{
	  $this->data['sel'] = 'delivery_method';
		$edit = '';
        $this->data['post'] = array();
		if($id) {
			$this->data['post'] = $this->cart_m->get_delivery_m($id);
			$edit = '.true';
		}
		foreach($this->lang->languages as $key => $lang)
                {
                    $this->form_validation->set_rules('title['.$key.']', 'Title '.$key, 'trim');
                   // $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');

                }

		if($this->form_validation->run()) {      
        
			$data = array(
                'd_title'  	  => serialize($this->input->post('title')),
                'd_status' => $this->input->post('status'),
			);
            

			$this->cart_m->save_delivery_m($data, $id);

			go_to('admin/cart_admin/delivery_method');
		}			
        
		$this->data['body'] = 'admin/cart/delivery_method/save';
	    $this->load->view('admin/index',$this->data);
      
	}
    // 
    
     public function time_delivery(){
       
        $this->data['sel'] = 'time_delivery';
        $base_url = base_url().'/admin/cart_admin/time_delivery/?';
        $total = '';//$this->cart_m->get_admin_cart_filter(array('id' => $id));
        $per_page = 50;
        //pagination_block($base_url, $total, $per_page);
        
        $this->data['posts'] = $this->cart_m->get_admin_time(array('limit' => $per_page, 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
        
       // $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['body'] = 'admin/cart/time_delivery/index';
        $this->load->view('admin/index', $this->data);
    }
    
    	public function time_delivery_save($id=FALSE)
	{
	  $this->data['sel'] = 'time_delivery';
		$edit = '';
        $this->data['post'] = array();
		if($id) {
			$this->data['post'] = $this->cart_m->get_time_m($id);
			$edit = '.true';
		}
		foreach($this->lang->languages as $key => $lang)
                {
                    $this->form_validation->set_rules('title['.$key.']', 'Title '.$key, 'trim');
                   // $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');

                }

		if($this->form_validation->run()) {      
        
			$data = array(
                't_title'  	  => serialize($this->input->post('title')),
                't_status' => $this->input->post('status'),
			);
            

			$this->cart_m->save_time_delivery($data, $id);

			go_to('admin/cart_admin/time_delivery');
		}			
        
		$this->data['body'] = 'admin/cart/time_delivery/save';
	    $this->load->view('admin/index',$this->data);
      
	}
    
    /*public function send_bts($id){
        if(getCart_u($id, 'id')){
            if(getCart_u($id, 'bts_status') == 'inactive'){
                $result = bts_add($id);
                //var_dump($result);
                if(@$result){
                    if(@$result->orderId){
                        $data = array(
                            'bts_orderid' => @$result->orderId,
                            'bts_status' => 'active'
                        );
                        UpdateStatus($id, $data);
                        $this->session->set_flashdata('success', 'Заказ был отправлен в BTS. Номер заказа в BTS - '.getCart_u($id, 'bts_orderid')); 
                    }else{
                        $this->session->set_flashdata('error', 'Произошла ошибка в API BTS. Попробуйте позже');                        
                    }
                }else{
                    $this->session->set_flashdata('error', 'Произошла ошибка в API BTS. Попробуйте позже');                  
                }
                
            }else{
                $this->session->set_flashdata('error', 'Заказ уже был отправлен в BTS. Номер заказа в BTS - '.getCart_u($id, 'bts_orderid')); 
                
            }
            go_to(); 
        }else{
            go_to(); 
        }
        
       //echo bts_calc(3,3,2000);
    }*/
    
   /* public function detail_bts(){
        
        //echo bts_add(1);
       echo bts_detail(446194);
    }*/
    
   	/*public function delete($id)
	{
		$this->cart_m->delete($id);
    $this->cart_m->delete_cart($id);
		go_to();
	}*/
}