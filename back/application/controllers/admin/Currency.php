<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['sel'] = 'currency';
        $this->data['sel_users'] = 'currency';
        
		$this->load->model('currency_model', 'currency');
		
	}

	public function index()
	{
        $base_url = base_url().'/admin/currency/?';
        $total = $this->currency->get_count_currency();
        $per_page = 50;
        pagination_block($base_url, $total, $per_page);
        $this->data['posts'] = $this->currency->get_currency_admin($per_page, (int)$this->input->get('page'));
        $this->data['pagination'] = $this->pagination->create_links();        
        $this->data['body'] = 'admin/currency/index';
        $this->load->view('admin/index', $this->data);
	}
    public function save()
	{
	   
        $data = array(			
           'date' => date('Y-m-d H:i:s'),
           'status'  	=> 'inactive',
    	);
    	$new_post_id = $this->currency->add($data);            
        $data1 = array(
    	
           'sort_order' => $new_post_id,
    	);            
        $this->currency->save($new_post_id, $data1);            
        go_to("admin/currency/edit/$new_post_id");
    }
    
    public function edit($id)
	{
		$this->form_validation->set_rules('title', 'Заголовок', 'trim');
	//	$this->form_validation->set_rules('content', 'Content', 'trim');
		if($this->form_validation->run()) {
			$this->load->library('Config_Writer');
             $writer = $this->config_writer->gcw();
			$data = array(
				'title'  	=> $this->input->post('title'),
				'content'  	=> $this->input->post('content'),
				'status'  	=> $this->input->post('status'),
				'rates'  	=> $this->input->post('rates'),
                'alias'  	=> $this->input->post('alias'),
                'sort_order' => $this->input->post('sort_order'),
                'status_def' => $this->input->post('status_def'),
				);
                
            
                
                if($this->input->post('status_def') == 'active'){
                    //to write the main config file, omit the argument

                    $writer->write('cur_default' , @$this->input->post('title'));
                    $writer->write('cur_rates' , @$this->input->post('rates'));
                }

			$this->currency->save($id, $data);
			go_to('admin/currency');
		}

		$this->data['post'] = $this->currency->get_single_currency($id);
 	   // $this->data['media_files'] = $this->posts->get_media_files($id);
		$this->data['body'] = 'admin/currency/save';
	    $this->load->view('admin/index', $this->data);
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
        $this->currency->save($id,$data);

        $return['result'] = '<span style="color: green">' . lang('updated') . '</span>';
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
    
/*	public function delete($id)
	{
		$this->currency->delete($id);
		go_to('admin/currency');
	}*/
}