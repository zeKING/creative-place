<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Notification extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('notification_model', 'notification');
        $this->load->model('users_model', 'users');
        $this->load->library('form_validation');
    }

    public function index(){
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false/*, 'response' => http_response_code()*/)));
    }
    public function get(){
        $user_id = $this->input->get('user_id');
        $count = $this->notification->count_all_с($user_id);

        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '50';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';

        $res = $this->notification->get_list(array('limit' => (int)$limit,'order'=>'DESC', 'offset' => (int)$page, 'user_id'=>@$user_id));

        if(@$res){
            foreach($res as $item){
                $data[] = array(
                    'id'=>$item->id,
                    'name' => $item->name,
                    "message" => $item->about,
                    "is_read" => $item->is_read,
                    "work_id" => $item->work_id,
                    "created_on" => to_date('d-m-Y H:i:s', $item->created_on),
                    "file" => ($item->file) ? base_url('uploads/works/'.$item->file) : '',

                );
                if($item->is_read == 'false'){
                    $update = array('is_read'=>true);
                    $this->notification->update($update, $item->id);
                }

            }

            
        }else{
            $data = null;

        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data'=>$data, /*, 'response' => http_response_code()*/ 'status' => $status)));
    }
    public function delete(){
        $user_id = $this->input->post('id');
        $this->notification->delete($user_id);



            $this->output->set_status_header(200);

        $status = true;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array( /*, 'response' => http_response_code()*/ 'status' => $status)));
    }

}
?>