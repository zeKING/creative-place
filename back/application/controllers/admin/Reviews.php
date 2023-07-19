<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['sel'] = 'reviews';
		$this->load->model('review_model', 'review');
		
	}

	public function index()
	{
	     $base_url = base_url().'/admin/reviews/?';
        $total = $this->review->count_all();
        $per_page = 50;
        pagination_block($base_url, $total, $per_page);
        $this->data['posts'] = $this->review->get_review_admin($per_page, (int)$this->input->get('page'));
        $this->data['pagination'] = $this->pagination->create_links();

		$this->data['body'] = 'admin/reviews/index';
	    $this->load->view('admin/index', $this->data);
	}
    public function save()
	{
	   
      $data = array(
			
                'date' => date('Y-m-d H:i:s'),
			);

			$new_post_id = $this->review->add($data);
            
            go_to("admin/reviews/edit/$new_post_id");
       
	   		$this->data['body'] = 'admin/reviews/add';
	    $this->load->view('admin/index', $this->data);
    }
    
 
    
    
	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Имя', 'trim');
		$this->form_validation->set_rules('content', 'Описание', 'trim');
		if($this->form_validation->run()) {
		  
    
			
			$data = array(
				'name'  	=> $this->input->post('name'),
				'content'  	=> $this->input->post('content'),
				'active'  	=> $this->input->post('active'),
			//	'email'  	=> $this->input->post('email'),
              //  'address'  	=> $this->input->post('address'),
                'company' => $this->input->post('company'),
				);
                
                        if($_FILES['userfile']['size'] > 0 ) {
                    $result = do_upload('reviews');
            
                    if(!empty($result['error'])) {
                        $error = true;
                        $this->data['error'] = $result['error'];
                    } else {
                        $error = false;
                        $upload_data = $this->upload->data();
                        $data['img'] = $upload_data['file_name'];
            
                        if(!empty($id)) {
                            $post = $this->review->get_single_review($id);
                            @unlink('./uploads/reviews/'.$post->img);
                        }
            
                    }
                   // var_dump($result);
                }

			$this->review->update($id, $data);
			go_to('admin/reviews');
		}

		$this->data['post'] = $this->review->get_single_review($id);
		$this->data['body'] = 'admin/reviews/save';
	    $this->load->view('admin/index', $this->data);
	}
    
     public function delete_img($id){
        if($id){
            $post = $this->review->get_single_review($id);
            @unlink('./uploads/reviews/'.$post->img);
            $data = array(
                'img' => '',
            );
            $this->review->update($id, $data);
        }
         go_to();
        
    }
    
	public function delete($id)
	{
	    if($id){
            $post = $this->review->get_single_review($id);
            @unlink('./uploads/reviews/'.$post->img);
            $this->review->delete($id);
        }
        go_to();
	}
}