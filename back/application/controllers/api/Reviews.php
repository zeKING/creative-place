<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Reviews extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('feed_model'); 
    }
    
    public function index(){
        for($i = 1; $i <= 3; $i++){
            $type[] = array(
                'value' => $i,
                'title' => lang('rev_value_'.$i)
            );
        }
        $data = array(
            'content' => _t(getPosts(59,'content_html'), LANG),
            'type' => $type,
        );
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => true)));
    }
    
    public function form(){
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');   
        $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email'); 
        $this->form_validation->set_rules('message', 'lang:message', 'trim|required'); 
            $status = false;
          if ($this->form_validation->run()) {
            $data = array();
            $type = $this->input->post('type');
            if($type == 1 || $type == 2 || $type == 3){
                $data['name']   = $this->input->post('name');
                $data['email']  = $this->input->post('email');
                $data['message'] = $this->input->post('message');
                 if($type == '1'){
                        $data['groups'] = 'thanks';
                 }
                 if($type == '2'){
                        $data['groups'] = 'offer';
                 }
                 if($type == '3'){
                        $data['groups'] = 'abuse';
                 }
                
                $data['date'] = date('Y-m-d H:i:s');
                $data['ip']     = $this->input->ip_address();
                $this->feed_model->save($data,'');
                $data = array(                                
                    'message' => lang('success_send'),
                );
            }else{
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status)));
            }
          }else{
            $data = array(                                
                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
            );
          }
          return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => $status)));
    }
    
}
?>