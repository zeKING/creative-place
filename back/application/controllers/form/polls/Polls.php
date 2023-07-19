<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('polls_model', 'polls');
             $this->load->library('form_validation');
    $this->load->language('public');
	}
	
	public function index()
	{
        $javob = $this->input->post('javob');
        $savol_id = $this->input->post('savol_id');
        $this->form_validation->set_rules('javob', 'lang:javob', 'trim|required');
        $savol = $this->polls->get($savol_id);
        
        if ($this->form_validation->run()) {
        if(!$this->session->userdata('ip_savolnoma') || $this->session->userdata('ip_savolnoma') != $_SERVER['REMOTE_ADDR'])
        {
            switch($javob){
                case 'javob_1':
                    $data['count_1'] = $savol->count_1 + 1;
                    $this->polls->save($data, $savol_id);
                    break;
                case 'javob_2':
                    $data['count_2'] = $savol->count_2 + 1;
                    $this->polls->save($data, $savol_id);
                    break;
                case 'javob_3':
                    $data['count_3'] = $savol->count_3 + 1;
                    $this->polls->save($data, $savol_id);
                    break;
                case 'javob_4':
                    $data['count_4'] = $savol->count_4 + 1;
                    $this->polls->save($data, $savol_id);
                    break;
              /*  case 'javob_5':
                    $data['count_5'] = $savol->count_5 + 1;
                    $this->polls->save($data, $savol_id);
                    break;*/
            }
            $this->session->set_userdata(array('ip_savolnoma' => $_SERVER['REMOTE_ADDR']));
            $post = $this->polls->get_all_polls_admin(array('status' => 'active', 'limit' => '1','order' => 'DESC'));
            $return['status'] = '<div class="alert alert-success">'.lang('javob_kabul_kilindi').'</div>';
             $all_polls = $post['0']->count_1 + $post['0']->count_2 + $post['0']->count_3 + $post['0']->count_4;
                                    $all_polls = ($all_polls) ? round(100 / $all_polls, 1) : '0';
             $return['res'] = array(
                '1' => $all_polls * $post[0]->count_1,
                '2' => $all_polls * $post[0]->count_2,
                '3' => $all_polls * $post[0]->count_3,
                '4' => $all_polls * $post[0]->count_4,
             ); 
        }
        else
        {
            $return['status'] = '<div class="alert alert-danger">'.lang('siz_javob_bergansiz').'</div>';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($return));
        } else {
            $return['status'] = '<div class="alert alert-danger">'.lang('variant_otveta').'</div>';
             $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }
	}
  
  
  
}
