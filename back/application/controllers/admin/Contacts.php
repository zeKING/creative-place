<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'contacts';		

		$this->load->model('contacts_model', 'contacts'); 
	} 

	public function index()
	{
	       $base_url = base_url().'/admin/contacts/?';
        $total = $this->contacts->count_all_с();
        $per_page = 50;

        pagination_block($base_url, $total, $per_page);
        		$this->data['contacts'] = $this->contacts->get_list(array('limit' => $per_page, 'offset' => (int)$this->input->get('page')));
                $this->data['pagination'] = $this->pagination->create_links();

		$this->data['body'] = 'admin/contacts/index';
	    $this->load->view('admin/index', $this->data);
	}

	public function view($contact_id)
	{
		$this->data['contact'] = $this->contacts->get($contact_id);
	//	$this->data['contacts'] = $this->contacts->get_history_contacts($contact_id, $contact);
        if($this->data['contact']){
		$this->data['body'] = 'admin/contacts/view';
	    $this->load->view('admin/index', $this->data);
        }else{
           go_to(base_url('admin/contacts'));
        }
	}

	public function reply($contact_id)
	{
		/*-$this->form_validation->set_rules('message', 'Message', 'trim|required');

		if($this->form_validation->run()) {
			$to = $this->input->post('email');
			$phone = $this->input->post('phone');
			$message = $this->input->post('message');
			$subject = 'confirmation';
			//mark as replied
			$this->db->update('contacts', array('reply'=>'1'), array('contact_id'=>$contact_id));

            //email('','', $to, $subject, $message);			

			go_to('admin/contacts');
		}

		$this->data['contact'] = $this->contacts->get($contact_id);

		$this->data['body'] = 'admin/contacts/reply';
	    $this->load->view('admin/index', $this->data);*/
	}

	public function delete($contact_id)
	{
		$this->contacts->delete($contact_id);
		go_to();
	}
}
?>