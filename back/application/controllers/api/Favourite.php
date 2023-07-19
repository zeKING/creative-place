<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Favourite extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('works_model', 'works');
        $this->load->model('users_model', 'users');
        $this->load->model('favourite_model', 'favourite');
    }

    public function index(){
        $user_id = addslashes($this->input->get('user_id'));
        @$user_data = $this->favourite->get_user($user_id);
        if(@$user_data){

           foreach ($user_data as $item){
               $work = getWorksAll($item->work_id);
               if(@$work){
                   $data[] = array(
                       'work_id'=> @$work->id,
                       'name' => @$work->name,
                       'price' => @$work->price,
                       "file" => (@$work->file) ? base_url('uploads/works/'.@$work->file) : '',
                       'tag' => _t(@get_tag(@$work->tag_id)->title,newLANG),
                   );
               }else{

               }

           }

//            $this->output->set_status_header(200);
            $status =  true;
        }else{
//            $this->output->set_status_header(404);
            $status =  false;
            $data = null;
        }



        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function save(){
     $work_id = addslashes($this->input->post('work_id'));
     $user_id = addslashes($this->input->post('user_id'));
     if($work_id && $user_id && $work_id > 0){
         $data=array(
             'work_id'=> $work_id,
             'user_id'=>$user_id
         );
         $this->favourite->save($data);
         $this->output->set_status_header(200);
         $status =  true;
     }else{
         $this->output->set_status_header(404);
         $status =  false;
     }



        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function delete(){
     $work_id = addslashes($this->input->post('work_id'));
     $user_id = addslashes($this->input->post('user_id'));
     if($work_id && $user_id ){
          $this->favourite->delete($work_id, $user_id);

             $this->output->set_status_header(200);
             $status =  true;



     }else{
         $this->output->set_status_header(404);
         $status =  false;
     }

        return $this->output->set_content_type('application/json')->set_output(json_encode(array(/*, 'response' => http_response_code()*/ 'status' => $status)));
    }


}
?>