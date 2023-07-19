<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contacts extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();   
         $this->data['pages_block'] =  $this->posts->get_posts_p(array('group' => 'pages', 'status' => 'active', 'media' => 'inactive')); 
         $this->load->model('contacts_model');
    }

    public function phone(){
        $res = $this->posts->get_posts_p(array('group' => 'prefix', 'status' => 'active'));
        foreach($res as $item){

            $data[] = array(

                'code' => $item->option_1,
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$item->url) : '',

            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }

    public function page(){
        $res = $this->posts->get_posts_p(array('group' => 'contact', 'status' => 'active'));
        foreach($res as $item){

            $data[] = array(

                'address' => _t($item->title, newLANG),
                'vremya_raboti'=> _t($item->category_title, newLANG),
                'phone'=> $item->option_1,
                'email'=>$item->option_2,
                'map'=>$item->option_3

            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function country(){
        $res = $this->posts->get_posts_p(array('group' => 'country', 'status' => 'active'));
        foreach($res as $item){

            $data[] = array(

                'title' => _t($item->title, newLANG),
                'url' => $item->option_1,

            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }

     public function feedback(){
            $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
           
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');

             $status = false;
            if ($this->form_validation->run())
            {
    

                $name = removeTags($this->input->post('name'));

                $phone = removeTags($this->input->post('phone'));

                $email = removeTags($this->input->post('email'));
    

    
                $data1 = array();
                $data1['name'] = $name;
                $data1['email'] = $email;

                $data1['phone'] = ($phone) ? $phone : '';
                $data1['date'] = date('Y-m-d H:i:s');
                $data1['ip'] = $this->input->ip_address();
    
    

                     $status = true;
                    $data = array(
                        'message' => lang('success_send'),
                    );
                    $this->contacts_model->save($data1, '');                   

            } else{
                $status = false;
                $data = array(
                    'message' => lang('success_email_error1').'<br/>'. validation_errors(),
                );

            }
           
             return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));   
       
     }
    
}