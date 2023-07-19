<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Action extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
       // $this->load->model('posts_model', 'posts');
        $this->load->model('contacts_model');
        //$this->load->model('order_model');
        $this->load->library('email');
        $this->data['sel'] = 'feedback';

    }
    

    public function feedback_new()
    {
        if(@$_SERVER["HTTP_REFERER"]){
          //  $this->form_validation->set_rules('pochta', 'lang:email', 'trim|required|valid_email');
            $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
            $this->form_validation->set_rules('captcha', 'lang:captcha_error',
                "callback__captcha_check", 'trim|required|xss_clean');
    
    
            if ($this->form_validation->run())
            {
    
                //	$subject = $this->input->post('subject');
                $subject = 'Обратная связь';
                $name = removeTags($this->input->post('name'));
                $message = removeTags($this->input->post('message'));
                $phone = removeTags($this->input->post('phone'));
                $lastname = $this->input->post('lastname');
                $subject1 = $this->input->post('subject');
                $email = removeTags($this->input->post('pochta'));
    
                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                '</title>
                <style type="text/css">
                body {
                font-family: Arial, Verdana, Helvetica, sans-serif;
                font-size: 16px;
                }
                </style>
                </head>
                <body>    
                Имя: ' . $name . '<br />  
                Телефон: ' . $phone . '<br />      
                Сообщение: ' . $message . '<br />  	
                </body>
                </html>';
                // Электронная почта: ' . $email . '<br />  
                // Тема: '.$subject1.'<br />
                //Телефон для контакта: '.$phone.'
                // Фамилия: '.$lastname.'<br />
                // $this->email->from('info@' . $_SERVER['HTTP_HOST'], 'Обратная связь');
              
               $this->email->from(CONTACT_EMAIL, 'Обратная связь');
                $this->email->to(trim(getSiteSettings(1, 'link')));
                $this->email->reply_to($email);
                $this->email->subject($subject);
                $this->email->message($body);
    
                $data = array();
                $data['name'] = $name;
                $data['email'] = ($email) ? $email : '';
                $data['message'] = $message;
                $data['phone'] = $phone;
                $data['date'] = date('Y-m-d H:i:s');
                $data['ip'] = $this->input->ip_address();
    
    
                if ($this->email->send())
                {
    
                    $this->session->set_flashdata('success', lang('success_send'));
                    $this->contacts_model->save($data, '');
                    redirect(site_url());
                    //echo "yes";
                }else{
                    $this->session->set_flashdata('success', lang('success_send'));
                    $this->contacts_model->save($data, '');
                    redirect(site_url());
                }
            } else
            {
                $this->session->set_flashdata('error_success', '<p>' . lang('success_email_error1') .
                    '</p>' . validation_errors());
                redirect(site_url('contacts'));
                //echo "yes";
            }
        }else{
             go_to(site_url());
        }
    }

    
    
    function validate_captcha()
    {
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeHZTIUAAAAAI9-cLQzqmZ0wVavrS0qfAldDAo6&response=" .
            $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false)
        {
            return false;
        } else
        {
            return true;
        }
    }

    public function _name_check($value)
    {
        if (mb_strtolower(lang('name')) == mb_strtolower($value))
        {
            $this->form_validation->set_message('_name_check', lang('required'));
            return false;
        } else
            return true;
    }

    public function _message_check($value)
    {
        if (mb_strtolower(lang('message')) == mb_strtolower($value))
        {
            $this->form_validation->set_message('_message_check', lang('required'));
            return false;
        } else
            return true;
    }

    public function _captcha_check()
    {
        $expiration = time() - 7200; // Two hour limit
        $cap = $this->input->post('captcha');
        if ($this->session->userdata('word') == $cap and $this->session->userdata('ip_address') ==
            $this->input->ip_address() and $this->session->userdata('captcha_time') > $expiration)
        {
            return true;
        } else
        {
            $this->form_validation->set_message('_captcha_check', '%s');
            return false;
        }
    }

    public function generate_captcha()
    {
         if(@$_SERVER["HTTP_REFERER"]){
        $this->load->helper('captcha');
        /*$vals= array(
        'word'       => random_string('numeric', 5),
        'img_path'   => './uploads/captcha/',
        'img_url'    => base_url().'uploads/captcha/',
        'img_width'  => '210',
        'font_path'  => './system/fonts/arial.ttf',
        'font_size'  => '25px',
        'img_height' => '35',
        'expiration' => 7200
        );
        $this->data['cap'] = create_captcha($vals);*/

        $vals = array(
            'word' => random_string('numeric', 5),
            'img_path' => './uploads/captcha/',
            'img_url' => base_url() . 'uploads/captcha/',
            'img_width' => '120',
            'font_path' => './system/fonts/arial.ttf',
            'font_size' => '25px',
            'img_height' => '35',
            'expiration' => 7200);
        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']);
        $this->session->set_userdata($data);


        $this->session->set_userdata($data);
        $return['status'] = 'OK';
        $return['captcha1'] = $cap;
        $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
            go_to(site_url());
        }
    }


    public function generate_captcha1()
    {
        $this->load->helper('captcha');
        /*$vals= array(
        'word'       => random_string('numeric', 5),
        'img_path'   => './uploads/captcha/',
        'img_url'    => base_url().'uploads/captcha/',
        'img_width'  => '210',
        'font_path'  => './system/fonts/arial.ttf',
        'font_size'  => '25px',
        'img_height' => '35',
        'expiration' => 7200
        );
        $this->data['cap'] = create_captcha($vals);*/

        $vals = array(
            'word' => random_string('numeric', 5),
            'img_path' => './uploads/captcha/',
            'img_url' => base_url() . 'uploads/captcha/',
            'img_width' => '175',
            'font_path' => './system/fonts/arial.ttf',
            'font_size' => '25px',
            'img_height' => '35',
            'expiration' => 7200);
        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word_1' => $cap['word']);
        $this->session->set_userdata($data);


        $this->session->set_userdata($data);
        $return['status'] = 'OK';
        $return['captcha'] = $cap;

        $this->output->set_content_type('application/json')->set_output(json_encode($return));
    }

    public function adult(){
        if (@$_SERVER["HTTP_REFERER"])
        {
            $cookie = array(
    'name'   => 'agree',
    'value'  => 'agree',
    'expire' => '14400',

    'secure' => TRUE
);

$this->input->set_cookie($cookie); 

        }else{
            go_to(site_url());
        }
        
    }
}
?>
