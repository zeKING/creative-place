<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Menu extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
       


    }
    public function index()
    {
        $res = $this->posts->get_posts_p(array('status_lang_'.newLANG => 'active', 'group' => 'menu', 'status' => 'active', 'media' => 'inactive', 'order' => 'ASC'));


        $data = $this->buildTreeMain($res,0);
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status, 'lang'=>newLANG)));

    }

    public function footer()
    {
        $res = $this->posts->get_posts_p(array('status_lang_'.LANG => 'active', 'group' => 'menu_b', 'status' => 'active', 'media' => 'inactive', 'order' => 'ASC'));

        $data = $this->buildTreeMain($res,0);
        $email = _t(@getPosts(30,'title'),'ru');
            $phone = _t(@getPosts(30,'content_html'),'ru');


       $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status, 'email'=>@$email, 'phone'=>@$phone)));

    }

     public function buildTreeMain($cats, $parent_id) {
        $result = array();
        foreach ($cats as $item)
        {
        if ($item->category_id == $parent_id){
                $link_name = 'slug';
                if($item->options){
                    $link = $item->options;
                     $link_name = 'link';
                }elseif($item->option_2){
                    $link = $item->option_2;
                     $link_name = 'link';
                }else {
                    $link = $item->alias;
                }
                $result[] = array(
                    //'id' => $item->id,
                    //'category_id' => $item->category_id,
                    'title' => _t($item->title, newLANG),
                   // 'short_content' => _t($item->short_content,LANG),
                  //  'content' => _t($item->content,LANG),
                    $link_name => $link,
                    //'options' => ($item->options) ? $item->options : null,
                    //'option_2' => ($item->option_2) ? $item->option_2 : null,
                   // 'keywords' => $item->keywords,
                   // 'description' => $item->description,
                    'submenu' => $this->buildTreeMain($cats, $item->id),

                );
            }
        }
        if (count($result) > 0) return $result;
        return null;
     }

    public function view($alias){
        if($alias){
            $post = $this->posts->get_id_all($alias);
            $img = $this->posts->get_media_files($post->id, 6);
           // $news_date = date_parse(@$post->created_on);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (newLANG == $key) {$status_lang = $post->$lang_post;}
        }
            if($status_lang == 'active'){
                if($post->group == 'menu' || $post->group == 'menu_b'){
                    if($post->status == 'active'){
                        $gallery = array();

                        foreach($img as $item):
                            $gallery[] = array(
                                'img' => base_url('uploads/'.$item->category.'/'.$item->url)
                            );
                        endforeach;
                        $data = array(
                            'title' => _t($post->title,newLANG),
                            'short_content' => str_replace('/uploads/', base_url('uploads/'), _t($post->short_content,newLANG)),
                            'content' => str_replace('/uploads/', base_url('uploads/'), _t($post->content,newLANG)),
                            'gallery'=>$gallery
                            //'views' => $post->views,
                           // "date" => $post->created_on,//$news_date['day'].' '.getMonthName($post->created_on).' '.$news_date['year'],
                          );
                        

                        
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => true)));
                    }else{
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
                    }
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