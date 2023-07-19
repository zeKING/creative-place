<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Tags extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('works_model', 'works');
        $this->load->model('users_model', 'users');
    }

    public function index(){
        $count = $this->posts->get_posts_countLang('tags', newLANG);
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';
        //$offset = $limit * ($page-1);
        $res = $this->posts->get_posts_p(array('limit' => (int)$limit, 'status_lang_'.newLANG => 'active', 'group' => 'tags', 'status' => 'active', 'offset' => (int)$page));

        if($res){
            foreach($res as $item){
                $img = works_get($item->id);
                $gallery = array();

                foreach($img as $item1):
                    $gallery[] = array(
                        'img' => base_url('uploads/works/'.$item1->file)
                    );
                endforeach;
                $data[] = array(
                    'id'=>$item->id,
                    'title' => _t($item->title, newLANG),
                    "gallery" => $gallery,
                    'slug' => $item->alias,

                );

            }

            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function all(){

        $count = $this->posts->get_posts_countLang('tags', newLANG);
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';
        $res = $this->posts->get_posts_p(array('limit' => (int)$limit, 'status_lang_'.newLANG => 'active', 'group' => 'tags', 'status' => 'active', 'offset' => (int)$page));

        if($res){
            foreach($res as $item){

                $data[] = array(
                    'title' => _t($item->title, newLANG),
                    'id'=> $item->id,
                    'slug' => $item->alias,

                );

            }

            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    public function view($alias){
        $user_id = $this->session->tempdata('user_id2');
        if($alias){

            $post = $this->posts->get_id_all($alias);
            $count = $this->works->get_count_work($post->id);



                if($post->group == 'tags'){
                    if($post->status == 'active'){
                        $img = $this->works->get_list_work(array('tag_id'=>$post->id,));
                        $gallery = array();

                        foreach($img as $item1):
                            $user = $this->users->get($item1->user_id);
                            $f_status = getFavourite($user_id,$item1->id);
                            $fav_status = ($f_status['status'] == 'active') ? true : false;
                            $gallery[] = array(
                                'name'=> $item1->name,
                                'img' => base_url('uploads/works/'.$item1->file),
                                'price'=>$item1->price,
                                'favourite' => $fav_status,
                                'user_date' => to_date('d.m.Y', $user->birthday),
                                'user_name' => $user->fio,
                            );
                        endforeach;
                        $data = array(
                            'title' => _t($post->title,newLANG),
                            'works' => $gallery

                        );


                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'count'=>$count, 'status' => true)));
                    }else{
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
                    }
                }else{
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
                }

        }else{
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
        }
    }
}
?>