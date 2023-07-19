<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class News extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();        
    }
    
    public function index(){
         $count = $this->posts->get_posts_countLang('news', LANG);
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
        $offset = $limit * ($page-1);
        $res = $this->posts->get_posts_p(array('limit' => (int)$limit, 'status_lang_'.LANG => 'active', 'group' => 'news', 'status' => 'active', 'offset' => (int)$offset));
        foreach($res as $item){
            $news_date = date_parse($item->created_on);
            $data[] = array(
                'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$item->url) : '',
                
                'date' => to_date('d.m.Y', $item->created_on),
                'content' => removeTags(_t($item->content, LANG)),
                'slug' => $item->alias,
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }
    
      public function view($alias){
        if($alias){            
            $post = $this->posts->get_id_all($alias);
            //$img = $this->posts->get_media_files($id, 6);
           // $news_date = date_parse(@$post->created_on);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'news'){
                    if($post->status == 'active'){
                        $data = array(
                            'title' => _t($post->title,LANG),
                            //'short_content' => _t($post->short_content,LANG),
                            'content' => str_replace('/uploads/', base_url('uploads/'), _t($post->content,LANG)),
                            "url" => ($post->url) ? base_url('uploads/'.$post->group.'/'.$post->url) : '',
                            'views' => $post->views,
                            'date' => to_date('d.m.Y', $post->created_on),
                        );
                       // $this->load->library('session');
                       // if (!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id) {
                       // $this->session->set_userdata(array('ip_view' => $post->id));
                        $this->posts->update_views($post->id, $post->views);
                       /* } else {
                        }*/
                       /* $gallery = array();
                        
                        foreach($img as $item):
                            $gallery[] = array(
                                'img' => base_url('uploads/'.$item->category.'/'.$item->url)
                            );
                        endforeach;   */                 
                        
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