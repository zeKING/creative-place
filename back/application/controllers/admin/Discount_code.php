<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Discount_code extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->data['sel'] = 'discount_code';	
        $this->data['sel_users'] = 'discount_code';	
		$this->load->model('discount_code_model', 'discount_code');  
    
        if($this->data['user_type'] != 'admin'){
           go_to(site_url('admin/main'));
        }
    }
    
       public function index($offset = 0)
	{
        $base_url = base_url().'/admin/discount_code?';
        $total = $this->discount_code->count_all();
        $per_page = 50;
        pagination_block($base_url, $total, $per_page);  
        $this->data['posts'] = $this->discount_code->get_posts_p(array('limit' => $per_page, 'offset' => (int)$this->input->get('page')));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['body'] = "admin/discount_code/index";
        $this->load->view('admin/index', $this->data);
	}
    
    	public function save($id=FALSE)
	{
		$edit = '';

		if($id) {
			$this->data['post'] = $this->discount_code->get($id);
			$edit = '.true';
		}

	//	$this->form_validation->set_rules('first_name', 'lang:first_name', 'trim|required');
	//	$this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required');
        /*if($type == 'admin' || $type == 'moderator'){
		$this->form_validation->set_rules('username', 'lang:username', 'trim|is_unique[users.username'.$edit.']');
        }else{
            $this->form_validation->set_rules('phone', 'Телефон', 'trim|is_unique[users.phone'.$edit.']');
          //  echo "test";
        }*/
		//$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|is_unique[users.email'.$edit.']');
	//	$this->form_validation->set_rules('password', 'lang:password', 'trim|required');
	//	$this->form_validation->set_rules('c_password', 'lang:confirm_password', 'trim|required|matches[password]');
	//	$this->form_validation->set_rules('user_type', 'lang:user_type', 'trim|required');
		$this->form_validation->set_rules('amount', 'Значение скидки', 'trim');
        $this->form_validation->set_rules('code', 'Код скидки', 'trim|is_unique[discount_code.code'.$edit.']');

		if($this->form_validation->run()) {      
        
			$data = array(
                'amount' => $this->input->post('amount'),
                'code' => trim($this->input->post('code')),
                'valid_from_date' => to_date('Y-m-d', $this->input->post('valid_from_date')),
                'valid_to_date' => to_date('Y-m-d', $this->input->post('valid_to_date')),
			);
          
        

			$this->discount_code->save($data, $id);

			go_to('admin/discount_code');
		}		
       // $this->data['cregions_list'] = $this->model_regions->regions_get();
        //$this->data['type'] = $type;
		$this->data['body'] = 'admin/discount_code/save';
	    $this->load->view('admin/index',$this->data);
	}
    
    public function status_ajax(){
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
        $this->discount_code->save($data, $id);

        $return['result'] = '<span style="color: green">' . lang('updated') . '</span>';
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
  
    
}
?>