<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Auth extends Apiuser_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('users_model', 'users');
        $this->load->model('works_model', 'works');
        $this->load->library('cart');
        $this->load->library('form_validation');

    }









    public function user(){
        $user_id = $this->input->request_headers('Authorization');
        $token = explode(' ',$user_id['Authorization'])[1];
        $jwt = new JWT();
        $jwtSecretKey = "MySecretCode";
        $data = $jwt->decode($token,$jwtSecretKey,'HS256');
        $user_id = $data->user_id;
        $user_type = $data->user_type;
        $user = $this->users->getType($user_id, $user_type);
        $cart = $this->cart->contents();
        

        if(@$user){


            $not = getNotification($user->user_id);
            $fav = getFavouriteStatus($user->user_id);

            $favourite = (@$fav) ? true : false;
            $notification = (@$not) ? true : false;
            $data1=array(
                'user_id'=>$user->user_id,
                'name'=>$user->fio,
                'phone'=>$user->phone,
                'user_type'=>$user->user_type,
                'isNewNotification'=> $notification,
                'isNewFavorite'=> $favourite,
                'isNewCart'=>(@$cart) ? true : false,
                'email'=>$user->email,
                'age'=> $this->get_age(to_date('Y-m-d',$user->birthday)),
                'birthday'=> to_date('Y-m-d',$user->birthday),
                'photo'=>($user->img) ? base_url('uploads/users/'.$user->img) : '',
                'roomid'=>$user->roomid

            );
            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(401);
        }

        $status = (@$user) ? true : false;

        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data1, 'status' => $status)));

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