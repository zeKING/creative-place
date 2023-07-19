<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Works extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('works_model', 'works');
        $this->load->model('users_model', 'users');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
    }

    public function index(){
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false/*, 'response' => http_response_code()*/)));
    }

    public function save()
    {
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('price', 'lang:price', 'trim|required');
        if ($this->form_validation->run()) {
            $user_id = removeTags(addslashes($this->input->post('user_id')));
            $tag_id = removeTags(addslashes($this->input->post('tag_id')));
            $price = removeTags(addslashes($this->input->post('price')));
            $message = removeTags(addslashes($this->input->post('message')));
            $name = removeTags(addslashes($this->input->post('name')));
            $user = $this->users->get($user_id);

            if ($user) {
                if (@$user->phone_verified == '1') {
                    if (@$user->ban == 'no') {
                        $user_id = $user->user_id;
                        $data = array(
                            'user_id' => $user_id,
                            'name' => $name,
                            'tag_id' => $tag_id,
                            'price' => $price,
                            'message' => $message,
                            'created_on' => date('Y-m-d H:i:s')
                        );


                        $upload_data = array();
                        if (@$_FILES['file']['size'] > 0) {
                            $result = getRequests_uploads2('works','file');
                            if (!empty($result['error'])) {
                                $error = true;
                                $this->data['error'] = $result['error'];
                            } else {
                                $error = false;
                                $upload_data = $this->upload->data();
                                $data['file'] = $upload_data['file_name'];
                            }
                        }
                        $work_id = $this->works->save($data);
                        $work_get = $this->works->get(@$work_id);

                        $users = getUsersBuyer();
                        if(@$users) {

                            foreach ($users as $item) {
                                $data_n = array(
                                    'user_id' => $item->user_id,
                                    'name' => $name,
                                    'about' => $message,
                                    'file' =>$work_get->file,
                                    'work_id' =>$work_get->id,
                                    'created_on' => date('Y-m-d H:i:s')
                                );
                                $this->works->save_notification($data_n);
                            }
                        }
                        $userSub = getUsersSubscribe();
                        if(@$userSub) {
                            $mail = $this->email->load();
                            foreach ($userSub as $item) {

                                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Добавлена новая работа в "Дар"</title>
                <style type="text/css">
                body {
                font-family: Arial, Verdana, Helvetica, sans-serif;
                font-size: 16px;
                }
                </style>
                </head>
                <body>    
                 '.$user->fio.' в коллекцию добавлена новая работа<br />  
                Ссылка: <a href="https://dar.5ss.uz/children/'.@$work_id.'">https://dar.5ss.uz/children/' .@$work_id. '</a><br />      
   	
                </body>
                </html>';
                                $mail->addAddress($item->email);
                                $mail->Subject = ('Добавлена новая работа в "Дар"');
                                $mail->Body = $body;
                                $mail->send();
                            }
                        }
                        $status = true;
                        $this->output->set_status_header(200);
                    }
                    else {
                        $status = false;
                        $data = array(
                            'message' => lang('u_account_ban'),
                        );
                        $this->output->set_status_header(401);
                    }
                } else {
                    $status = false;
                    $data = array(
                        'message' => lang('u_account_no_verified'),
                    );
                    $this->output->set_status_header(401);
                }


            } else {
                $status = false;

                $this->output->set_status_header(403);
            }
        }else {
            $status = false;

            $this->output->set_status_header(403);

        }


        return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status)));

    }

    public function getMyWorks(){
        $user_id1 = $this->session->tempdata('user_id2');
        $user_id = removeTags(addslashes($this->input->post('user_id')));
        $count = $this->works->count_my_с($user_id);
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '0';

        $res = $this->works->get_list(array('limit' => (int)$limit, 'user_id' => $user_id, 'offset' => (int)$page));
        if(@$res){
            foreach($res as $item){
                $user = getUsers($item->user_id);
                if(@$user){
                    $user_data = array(
                        'name' => $user->fio,
                        "age" => $this->get_age(to_date('Y-m-d',$user->birthday)),
                        'user_id'=>$user->user_id,
                    );
                }else{
                    $user_data = null;
                }

                $f_status = getFavourite($user_id1,$item->id);
                $fav_status = (@$f_status->status == 'active') ? true : false;
                $data[] = array(
                    'id'=> $item->id,
                    'user'=>$user_data,
                    'name' => $item->name,
                    "price" => $item->price,
                    "file" => ($item->file) ? base_url('uploads/works/'.$item->file) : '',
                    'favourite' => $fav_status,
                    'created_on' => to_date('d.m.Y', $item->created_on),
                    'message' => $item->message,
                    'tag' => _t(get_tag($item->tag_id)->title,'ru'),
                );
            }
            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function getWorks(){
        $user_id = $this->session->tempdata('user_id2');


        $tag_id = $this->input->get('tag_id');
        if(@$tag_id){
            $count = $this->works->get_count_work($tag_id);
        }else{
            $count = $this->works->count_all_w();
        }


        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';
        if(@$tag_id){
            $res = $this->works->get_list(array('tag_id'=> @$tag_id,'limit' => (int)$limit, 'offset' => (int)$page));

        }else{
            $res = $this->works->get_list(array('limit' => (int)$limit, 'offset' => (int)$page));

        }

        if(@$res){
            foreach($res as $item){
                $user = getUsers($item->user_id);
                if(@$user){
                    $user_data = array(
                        'name' => $user->fio,
                        "age" => $this->get_age(to_date('Y-m-d',$user->birthday)),
                        'user_id'=>$user->user_id,
                    );
                }else{
                    $user_data = null;
                }

                $f_status = getFavourite($user_id,$item->id);
                $fav_status = (@$f_status->status == 'active') ? true : false;
              $user = $this->users->get($item->user_id);
                $data[] = array(
                    'id'=>$item->id,
                    'user'=>$user_data,
                    'name' => $item->name,
                    "price" => $item->price,
                    "file" => ($item->file) ? base_url('uploads/works/'.$item->file) : '',
                    'favourite' => $fav_status,

                    'user_date' => (@$user) ? to_date('d.m.Y', @$user->birthday) : null,
                    'user_name' => (@$user) ? @$user->fio : null,

                );
            }
//            $count = count($res);
            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data'=>$data, /*, 'response' => http_response_code()*/ 'status' => $status)));
    }
    public function getWorksHome(){
        $user_id = $this->session->tempdata('user_id2');
        $count = $this->works->count_all_h();
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';

        $res = $this->works->get_list_home(array('limit' => (int)$limit, 'offset' => (int)$page));

        if(@$res){
            foreach($res as $item){
                $users = getUsers($item->user_id);
                if(@$users){
                    $user_data = array(
                        'name' => $users->fio,
                        "age" => $this->get_age(to_date('Y-m-d',$users->birthday)),
                        'user_id'=>$users->user_id,
                    );
                }else{
                    $user_data = null;
                }
                $user = $this->users->get($item->user_id);
                $f_status = getFavourite($user_id,$item->id);
                $fav_status = (@$f_status->status == 'active') ? true : false;
                $data[] = array(
                    'id'=>$item->id,
                    'user'=>$user_data,
                    'name' => $item->name,
                    "price" => $item->price,
                    "file" => ($item->file) ? base_url('uploads/works/'.$item->file) : '',
                    'favourite' => $fav_status,
                    'user_date' => to_date('d.m.Y', $user->birthday),
                    'user_name' => $user->fio,

                );
            }
//            $count = count($res);
            $this->output->set_status_header(200);
        }else{
            $data = null;
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data'=>$data, /*, 'response' => http_response_code()*/ 'status' => $status)));
    }
    public function slider(){
        $user_id = $this->session->tempdata('user_id2');
        $count = $this->works->count_all_s();
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->post('get')) ? ($this->input->post('get') == '-1') ?   1 : $this->input->get('page') : '0';

        $res = $this->works->get_list_slider(array('limit' => (int)$limit, 'offset' => (int)$page));
        if(@$res){
            foreach($res as $item){
                $users = getUsers($item->user_id);
                if(@$users){
                    $user_data = array(
                        'name' => $users->fio,
                        "age" => $this->get_age(to_date('Y-m-d',$users->birthday)),
                        'user_id'=>$users->user_id,
                    );
                }else{
                    $user_data = null;
                }
                $user = $this->users->get($item->user_id);
                $f_status = getFavourite($user_id,$item->id);
                $fav_status = (@$f_status->status == 'active') ? true : false;
                $data[] = array(
                    'id'=> $item->id,
                    'user'=>$user_data,
                    'name' => $item->name,
                    "price" => $item->price,
                    "file" => ($item->file) ? base_url('uploads/works/'.$item->file) : '',
                    'favourite' => $fav_status,
                    'user_name' => $user->fio,

                );
            }
            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }
        $text = array(
          'title' => _t(getPosts(17, 'title'), newLANG),
          'category_title' => _t(getPosts(17,'content_html'), newLANG),
          'video_title'=>removeTags(_t(getPosts(17,'short_content'), newLANG)),
          'video_url' => (getPostsMedia(17,'url')) ? base_url('uploads/pages/'.getPostsMedia(17,'url')) : null

        );
        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data, 'text'=>@$text/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function view($alias){
        $user_id = $this->session->tempdata('user_id2');
        if($alias){


            $post = $this->works->get($alias);
            if(@$post) {
                $user = getUsers($post->user_id);
                $user_data = array(
                    'name' => $user->fio,
                    "age" => $this->get_age(to_date('Y-m-d', $user->birthday)),
                    'user_id' => $user->user_id,
                );


                if ($post->status == 'active') {
                    @$f_status = getFavourite($user_id, $post->id);
                    $fav_status = (@$f_status->status == 'active') ? true : false;
                    $data = array(
                        'name' => $post->name,
                        'user' => $user_data,
                        'tag_id'=> array('id'=>@$post->tag_id,'title'=>_t(@getPosts(@$post->tag_id, 'title'),newLANG)),
                        'price' => $post->price,
                        'text' => $post->message,
                        'favourite' => @$fav_status,
                        'img' => ($post->file) ? base_url('uploads/works/' . $post->file) : ''

                    );


                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => true)));
                } else {
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
                }

            }else{
              return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
            }
        }else{
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
        }
    }
    public function get_age( $birthday ){



        $birthday_timestamp = strtotime($birthday);
        $age = date('Y') - date('Y', $birthday_timestamp);
        if (date('md', $birthday_timestamp) > date('md')) {
            $age--;
        }
        return $age;

    }
}
?>