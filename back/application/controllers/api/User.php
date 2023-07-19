<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class User extends Apiuser_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('users_model', 'users');
        $this->load->model('works_model', 'works');
        $this->load->library('form_validation');

    }

    public function changePhone()
    {
        $user_id1 = $this->session->tempdata('user_id2');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|xss_clean');
        if($user_id1){
            if ($this->form_validation->run()) {
                $username = addslashes($this->input->post('phone'));


                $user_post = getUserOptionAll($user_id1);
                if(@$user_post){
                    if (@$user_post->phone_verified == '1'){
                        if(@$user_post->ban == 'no'){
                            $user_id = $user_post->user_id;




                            $rand = rand(10000,99999);

                            $data1 = array(
                                'activation_code' => $rand,
                                'number_act_code' => $rand,

                            );
                            $data = array(
                                'user_id' => $user_id,


                            );
                            $this->users->save2($data1, $user_id);
                            $phone1 = phone_tel($username);
                            $message = $rand;
                            sms($user_id, $phone1, $message);
                            $status = true;

                            $this->output->set_status_header(200);

                        }else{
                            $status = false;
                            $data = array(
                                'message' => lang('u_account_ban'),
                            );
                            $this->output->set_status_header(401);
                        }
                    }else{
                        $status = false;
                        $data = array(
                            'message' => lang('u_account_no_verified'),
                        );
                        $this->output->set_status_header(401);
                    }


                }else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_login_incorrect'),
                    );
                    $this->output->set_status_header(401);
                }
            }else{
                $status = false;
                $data = array(
                    'message' => lang('success_email_error1').'<br/>'. validation_errors(),
                );
                $this->output->set_status_header(404);
            }
        }else{
            $status = false;
            $data = array(
                'message' => lang('u_account_no_verified'),
            );
            $this->output->set_status_header(401);
        }


        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));

    }
    public function changePhoneVerify(){
        $user_id1 = $this->session->tempdata('user_id2');
        $this->form_validation->set_rules('activation_code', 'lang:activation_code', 'trim|required|xss_clean');
        if(@$user_id1){
            if ($this->form_validation->run()) {

                $code = addslashes($this->input->post('activation_code'));
                $phone = addslashes($this->input->post('phone'));
                $user = $this->users->check_user2($user_id1, $code);
                if($user){


                    $user_id = $user['user_id'];

                    $data_user = array(
                        'ip' => $this->input->ip_address(),
                        'phone_verified'=> '1',
                        'last_login' => date('Y-m-d H:i:s'),
                        'phone' => $phone,
                    );

                    $this->users->save2($data_user, $user_id);
//                        $user_post = getUserOptionAll($user_id);
                    $data = array(
                        'user_id'=>$user_id
//                            'access_token' => $user_post->token,
                    );

                    $status = true;
                    $this->output->set_status_header(200);
                }
                else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_data_incorrect'),
                    );
                    $this->output->set_status_header(401);
                }
            }else{
                $status = false;
                $data = array(
                    'message' => lang('success_email_error1').'<br/>'. validation_errors(),
                );
                $this->output->set_content_type('application/json')->set_status_header(401);

            }
        }else{
            $status = false;
            $data = array(
                'message' => lang('u_account_no_verified'),
            );
            $this->output->set_status_header(401);
        }



        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));

    }



    public function changePassword()
    {   $user_id1 = $this->session->tempdata('user_id2');
        $this->form_validation->set_rules('oldPassword', 'lang:oldPassword', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'lang:password', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {

            if(@$user_id1){
                $oldPassword = addslashes($this->input->post('oldPassword'));
                $pass = addslashes($this->input->post('password'));
                $user = $this->users->getUserByLogin1($user_id1, $oldPassword);
                if($user){
                    if (@$user['phone_verified'] == '1'){
                        if(@$user['ban'] == 'no'){

                            $data_user = array(
                                'ip' => $this->input->ip_address(),
                                'password'=> $this->bcrypt->hash_password($pass),
                                'p_d'=> $pass,


                            );

                            $this->users->save2($data_user, $user_id1);

                            $data = array(
                                'message'=>"Change password"
                            );

                            $status = true;

                            $this->output->set_status_header(200);
                        }else{
                            $status = false;
                            $data = array(
                                'message' => lang('u_account_ban'),
                            );
                            $this->output->set_status_header(401);
                        }
                    }else{
                        $status = false;
                        $data = array(
                            'message' => lang('u_account_no_verified'),
                        );
                        $this->output->set_status_header(401);
                    }


                }else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_login_incorrect'),
                    );
                    $this->output->set_status_header(400);
                }
            }else{
                $status = false;
                $data = array(
                    'message' => lang('u_account_no_verified'),
                );
                $this->output->set_status_header(401);
            }

        }else{
            $status = false;
            $data = array(
                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
            );
            $this->output->set_status_header(404);
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));

    }

    public function login()
    {        
         $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'lang:password', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $username = addslashes($this->input->post('phone'));
            $pass = addslashes($this->input->post('password')); 
            $user = $this->users->getUserByLogin($username, $pass);
            if($user){
                if (@$user['phone_verified'] == '1'){
                    if(@$user['ban'] == 'no'){
                        $user_id = $user['user_id'];
//                    $token = md5($user['user_id'].time());
                        $token = $this->token($user['user_id'], $user['user_type']);
                        $data_user = array(
                            'ip' => $this->input->ip_address(),
                            'last_login' => date('Y-m-d H:i:s'),
                            'token' => $token,
                        );

                        $this->users->save2($data_user, $user_id);
                        $user_post = getUserOptionAll($user_id);
                        $data = array(
                            //  'user_id' => $user_post->user_id,
                            'access_token' => $user_post->token,
                            'roomid' => $user_post->roomid,
//                        'first_name' => $user_post->first_name,
//                        'last_name' => $user_post->last_name,

                        );
                        $u = array(
                            'user_id' => $user_post->user_id,
                            'token' => $user_post->token,
                        );
                        $status = true;
                        authorize_api_user($u);
                        $this->output->set_status_header(200);
                    }else{
                        $status = false;
                        $data = array(
                            'message' => lang('u_account_ban'),
                        );
                        $this->output->set_status_header(401);
                    }
                }else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_account_no_verified'),
                    );
                    $this->output->set_status_header(401);
                }


            }else{
                 $status = false;
               $data = array(
                    'message' => lang('u_login_incorrect'),
                );
                $this->output->set_status_header(401);
            }
        }else{
             $status = false;
            $data = array(
                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
            );
            $this->output->set_status_header(401);
        }

    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));

    }
    public function verified_phone(){
        $this->form_validation->set_rules('activation_code', 'lang:activation_code', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $code = addslashes($this->input->post('activation_code'));
            $user_id = addslashes($this->input->post('user_id'));
            $user = $this->users->check_user1($user_id, $code);
            if($user){


                        $user_id = $user['user_id'];
                        $token = $this->token($user['user_id'], $user['user_type']);
                        $data_user = array(
                            'ip' => $this->input->ip_address(),
                            'phone_verified'=> '1',
                            'last_login' => date('Y-m-d H:i:s'),
                            'token' => $token,
                        );

                        $this->users->save2($data_user, $user_id);
//                        $user_post = getUserOptionAll($user_id);
                        $data = array(
                            'user_id'=>$user_id
//                            'access_token' => $user_post->token,
                        );

                        $status = true;
                $this->output->set_status_header(200);
            }
            else{
                $status = false;
                $data = array(
                    'message' => lang('u_data_incorrect'),
                );
                $this->output->set_status_header(401);
            }
        }else{
            $status = false;
            $data = array(
                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
            );
            $this->output->set_content_type('application/json')->set_status_header(401);

        }

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));

    }
    public function reg(){
        @error_reporting(0);
        @ini_set('display_errors', 0);
        $this->form_validation->set_rules('password', 'lang:password', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|is_unique[users.phone]');
        if ($this->form_validation->run()) {
            $rand = rand(10000,99999);
           $phone2 = $this->input->post('phone');

           $user_type = $this->input->post('user_type');


           $data = array(
                'password' => $this->bcrypt->hash_password($this->input->post('password')),
                'p_d' => $this->input->post('password'),


                'user_type' => $user_type,
                'active' => '1',
                'ip' => $this->input->ip_address(),
                'created'  => date('Y-m-d H:i:s'),
//                'token'=>$token,
                'activation_code'=>$rand,
                'number_act_code' => $rand,
            );
            $user = $this->users->save($data);
            $user_post = getUserOptionAll($user->user_id);
            $message = $rand;
            $phone1 = $phone2;
            $phone = phone_tel($phone1);
            sms($user->user_id, $phone, $message);

//            $u = array(
//                'user_id' => $user_post->user_id,
//                'token' => $user_post->token,
//            );

            //authorize_api_user($u);
            $token = $this->token($user->user_id, $user->user_type);

            $newData['token'] = $token;
            $this->users->save($newData,$user->user_id);
             $status = true;
            $data = array(
                'message' => 'Успешно',
                'user_id'=>$user->user_id

            );
            $this->output->set_status_header(200);
        }else{
             $status = false;
             $data = array(
                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
            );
            $this->output->set_status_header(401);


        }

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));

    }
    public function reset_sms(){

            $id = $this->input->post('user_id');
            $check = $this->users->get($id);

            if($check){
                if(@$check->ban == 'no'){
                    $phone = $check->phone;
                    $rand = rand(10000,99999);
                    $user_id = $check->user_id;
                    $data = array(
                        'activation_code' => $rand,
                        'number_act_code' => $rand,
                        'phone_verified'=>'0'
                    );
                    $this->users->save2($data, $user_id);
                    $phone1 = phone_tel($phone);
                    $message = $rand;
                    sms($check->user_id, $phone1, $message);
                    $status = true;
                    $data = array(
                        'message' => 'Успешно',
                    );

                }else{
                    $status = false;
                    $data = array(
                        'message' => lang('u_account_ban'),
                    );
                }
            }else{
                $status = false;
                $data = array(
                    'message' => lang('u_not_found_phone'),
                );
            }

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));
    }
    public function forgot_password(){
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {    
            $phone = $this->input->post('phone');
            $check = $this->users->user_phone($phone);
            if($check){
                if(@$check->ban == 'no' && @$check->active == 1){                    

                    $pass = rand(10000,99999);
                    $user_id = $check->user_id;
                    $data = array(
                        'activation_code' => $pass,
                        'number_act_code' => $pass,
                        'phone_verified'=>'0'
                    );
                    $this->users->save2($data, $user_id);
                    $phone1 = phone_tel($phone);
                    $message = $pass;
                    sms($check->user_id, $phone1, $message);
                    $status = true;
                    $data = array(
                        'message' => lang('u_new_pass_send_phone'),
                        'user_id'=>$check->user_id,
                        'phone'=>$check->phone,

                    );
                    $this->output->set_status_header(200);
                    //sms($user_id, $phone, $message);
                }else{
                    $this->output->set_status_header(401);
                    $status = false;
                    $data = array(
                        'message' => lang('u_account_ban'),
                    );
                }                
            }else{
                $this->output->set_status_header(401);
                $status = false;
                $data = array(
                    'message' => lang('u_not_found_phone'),
                );
            }
        }else{
            $status = false;

            $data = array(
                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
            );
        }
         return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));  
    }

    public function change_password(){
        $this->form_validation->set_rules('password', 'lang:password', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
        if ($this->form_validation->run()) {

            $password = $this->input->post('password');

            $user_id = $this->input->post('user_id');
            $phone = $this->input->post('phone');


            $check = $this->users->user_phone($phone);


                if($check){
                    if(@$check->ban == 'no' && @$check->active == 1){
                        if(@$check->user_id == $user_id){
                            $data2 = array(
                                'password' => $this->bcrypt->hash_password($password),
                                'p_d' => $password,

                            );
                            $this->users->save($data2, $user_id);
                            $data = array(
                                'message' => "successful",
                            );
                            $status = true;
                            $this->output->set_status_header(200);
                        }else{
                            $this->output->set_status_header(401);
                            $status = false;
                            $data = array(
                                'message' => lang('u_account_ban'),
                            );
                        }

                    }else{
                        $this->output->set_status_header(401);
                        $status = false;
                        $data = array(
                            'message' => lang('u_account_ban'),
                        );
                    }
                }else{
                    $this->output->set_status_header(401);
                    $status = false;
                    $data = array(
                        'message' => lang('u_not_found_phone'),
                    );
                }



        }else{
            $status = false;
            $data = array(
                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
            );
            $this->output->set_status_header(401);


        }

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));

    }

    public function token($user_id, $user_type){
        $jwt = new JWT();

        $jwtSecretKey = "MySecretCode";
        $data = array(
            'user_id'=>$user_id,
            'user_type'=>$user_type,
            'exp'=> time() + (60*60*24)
        );
        $token = $jwt->encode($data,$jwtSecretKey,'HS256');
        return $token;

    }


    public function edit()
    {
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('email', 'lang:email', 'trim|required');

        if ($this->form_validation->run()) {
            $user_id = removeTags(addslashes($this->input->post('user_id')));
            $name = removeTags(addslashes($this->input->post('name')));
            $birthday = removeTags(addslashes($this->input->post('birthday')));
            $phone = removeTags(addslashes($this->input->post('phone')));
            $email = removeTags(addslashes($this->input->post('email')));
            $user = $this->users->get($user_id);

            if ($user) {
                if (@$user->phone_verified == '1') {
                    if (@$user->ban == 'no') {
                        $user_id = $user->user_id;
                        $data_user = array(
                            'fio' => $name,
                            'birthday' => to_date('Y-m-d', $birthday),
                            'phone' => $phone,
                            'email' => $email,

                        );

                        $this->users->save2($data_user, $user_id);


                        $phone = $user->phone;
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
//                $data = array(
//                    'message' => lang('u_login_incorrect'),
//                );
                $this->output->set_status_header(403);
            }
        }else {
            $status = false;
//            $data = array(
//                'message' => lang('success_email_error1') . '<br/>' . validation_errors(),
//            );
            $this->output->set_status_header(403);

        }


            return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status)));

    }


    public function reg2()
    {
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        if ($this->form_validation->run()) {
            $user_id = removeTags(addslashes($this->input->post('user_id')));
            $phone = removeTags(addslashes($this->input->post('phone')));
            $name = removeTags(addslashes($this->input->post('name')));
            $birthday = removeTags(addslashes($this->input->post('birthday')));
            $about_me = removeTags(addslashes($this->input->post('about_me')));

            $user = $this->users->get($user_id);

            if ($user) {
                if (@$user->phone_verified == '1') {
                    if (@$user->ban == 'no') {
                        $user_id = $user->user_id;
                        $data_user = array(
                            'fio' => $name,
                            'birthday' => to_date('Y-m-d', $birthday),
                            'about_me' => $about_me,
                            'phone' => $phone,
                            'roomid' => $user_id,


                        );
                        $upload_data = array();
                        if (@$_FILES['photo']['size'] > 0) {
                            $result = getRequests_uploads2('users','photo');
                            if (!empty($result['error'])) {
                                $error = true;
                                $this->data['error'] = $result['error'];
                            } else {
                                $error = false;
                                $upload_data = $this->upload->data();
                                $data_user['img'] = $upload_data['file_name'];
                            }
                        }

                        $this->users->save2($data_user, $user_id);


                        $user_post = getUserOptionAll($user_id);
                        $data = array(
                           'access_token' => $user_post->token,
                           'roomid' => $user_post->roomid,
                        );
                        $u = array(
                            'user_id' => $user_post->user_id,
                            'token' => $user_post->token,
                        );

                        authorize_api_user($u);
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
                $data = array(
                    'message' => lang('u_login_incorrect'),
                );
                $this->output->set_status_header(403);
            }
        }else {
            $status = false;
            $data = array(
                'message' => lang('success_email_error1') . '<br/>' . validation_errors(),
            );
            $this->output->set_status_header(403);

        }


        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>@$data,'status' => $status)));

    }

    public function usersHome(){

        $count = $this->users->count_all_sh();
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';
//        $offset = $limit * ($page-1);
        $res = $this->users->get_users_list_home(array('limit' => (int)$limit,'user_type'=>'seller','show_home'=>'active','phone'=>'1', 'offset' => (int)$page));
        if(@$res){
            foreach($res as $item){

                $data[] = array(
                    'name' => $item->fio,
                    "age" => $this->get_age(to_date('Y-m-d',$item->birthday)),
                    "photo" => ($item->img) ? base_url('uploads/users/'.$item->img) : '',
                    'user_id'=>$item->user_id,
                    'about_me' => $item->about_me,
                    'count_work'=>count_work($item->user_id)
                );
            }
            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function users(){

        $count = $this->users->count_all_u();
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';
//        $offset = $limit * ($page-1);
        $res = $this->users->get_users_list_home(array('limit' => (int)$limit,'user_type'=>'seller','phone'=>'1', 'offset' => (int)$page));
        if(@$res){
            foreach($res as $item){

                $data[] = array(
                    'name' => $item->fio,
                    'roomid' => $item->roomid,
                    "age" => $this->get_age(to_date('Y-m-d',$item->birthday)),
                    "photo" => ($item->img) ? base_url('uploads/users/'.$item->img) : '',
                    'user_id'=>$item->user_id,
                    'about_me' => $item->about_me,
                    'count_work'=>count_work($item->user_id)
                );
            }
            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function _captcha_check(){
        $expiration = time()-7200; // Two hour limit
        $cap=$this->input->post('captcha');
        if($this->session->userdata('word')== $cap
         AND $this->session->userdata('ip_address')== $this->input->ip_address()
         AND $this->session->userdata('captcha_time')> $expiration)
        {
            return true;
        }else{
         $this->form_validation->set_message('_captcha_check', '%s'.$this->session->userdata('word'));
         return false;
        }
    }
    public function profile(){
        $user_id = $this->session->tempdata('user_id2');
        $user = $this->users->get($user_id);
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '12';
        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '0';

        $res = $this->works->get_list(array( 'user_id' => $user_id));
        if(@$user){
            $works=array();
            if(@$res) {
                foreach ($res as $item) {
                    $f_status = getFavourite($user_id,$item->id);
                    $fav_status = (@$f_status->status == 'active') ? true : false;
                    $works[] = array(
                        'id' => $item->id,
                        'favourite' => $fav_status,
                        'tag'=> _t(get_tag($item->tag_id)->title,newLANG),
                        'name' => $item->name,
                        "price" => $item->price,
                        "file" => ($item->file) ? base_url('uploads/works/' . $item->file) : '',

                    );
                }
            }

            $data=array(
                'name'=>$user->fio,
                'email'=>$user->email,
                'roomid' => $user->roomid,
                'age'=> $this->get_age(to_date('Y-m-d',$user->birthday)),
                'photo'=>($user->img) ? base_url('uploads/users/'.$user->img) : '',
                'count_work'=>count_work($user->user_id),
                'works'=>$works,
                'sel'=>258

            );
            $this->output->set_status_header(200);
        }else{
           $data = null;
        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function detail($user_id){

        $user = $this->users->get($user_id);
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '0';

        $res = $this->works->get_list(array( 'user_id' => $user_id));
        if(@$user){
            $works=array();
            if(@$res) {
                foreach ($res as $item) {
                    $f_status = getFavourite($user_id,$item->id);
                    $fav_status = (@$f_status->status == 'active') ? true : false;
                    $works[] = array(
                        'id' => $item->id,
                        'favourite' => $fav_status,
                        'tag'=> _t(get_tag($item->tag_id)->title,newLANG),
                        'name' => $item->name,
                        "price" => $item->price,
                        "file" => ($item->file) ? base_url('uploads/works/' . $item->file) : '',

                    );
                }
            }

            $data=array(
                'name'=>$user->fio,
                'email'=>$user->email,
                'roomid' => $user->roomid,
                'age'=> $this->get_age(to_date('Y-m-d',$user->birthday)),
                'photo'=>($user->img) ? base_url('uploads/users/'.$user->img) : '',
                'count_work'=>count_work($user->user_id),
                'works'=>$works,
                'sel'=>258

            );
            $this->output->set_status_header(200);
        }else{
            $data = null;
        }

        $status = ($res) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
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