<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Subscribe extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('subscribe_model', 'subs');

    }
    
    public function index(){
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $status = false; 
        if($this->form_validation->run()){
            $email = $this->input->post('email');
             if($this->subs->user_email($email)){
                $status = false; 
                $data = array(
                    'message' => lang('sub_title_3'),
                );
                 $this->output->set_status_header(400);
             }else{
                $s_data = array(
                    'active' => '1', 
                    'user_sub' => 'subscriber',  
                    'user_type' => 'subscriber', 
                    'email' => $email,
                    'activation_code' => md5($email.time())
                );
                $this->subs->save2($s_data);
                $status = true;
                $data = array(
                    'message' => lang('success_send'),
                );
                 $this->output->set_status_header(200);
             }
           
        }else{
           $status = false; 
            $data = array(
                    'message' => lang('success_email_error1').'<br/>'. validation_errors(),                    
                );
            $this->output->set_status_header(400);
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));
    }

    public function send(){
        $mail = $this->email->load();

        $mail->addAddress('nnnaimov@gmail.com');
        $mail->Subject = ("test subject");
        $mail->Body = "test body";
        if($mail->send()){
            echo "Good";
        }else{
            show_error($mail->ErrorInfo);
        }
    }
    
}
?>