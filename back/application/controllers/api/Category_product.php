<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Category_product extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
       
    }
    public function index()
    {        
        $res = $this->posts->get_posts_p(array('status_lang_'.LANG => 'active', 'group' => 'category_product', 'status' => 'active', 'media' => 'inactive', 'order' => 'ASC'));       
        
        $data = $this->buildTreeMain($res,0);    
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));          
    }
    
     public function buildTreeMain($cats, $parent_id) {
        $result = array();
        foreach ($cats as $item) 
        {
        if ($item->category_id == $parent_id){
                $result[] = array(
                    'id' => $item->id,
                    'category_id' => $item->category_id,
                    'title' => _t($item->title, LANG),
                    'icon' => ($item->icon) ?  $item->icon : null,
                    //'short_content' => _t($item->short_content,LANG),
                    //'content' => _t($item->content,LANG),                   
                    'slug' => $item->alias,
                   // 'options' => ($item->options) ? $item->options : null,
                    //'keywords' => $item->keywords,
                    //'description' => $item->description,
                    'submenu' => $this->buildTreeMain($cats, $item->id)
                );
            }
        }
        if (count($result) > 0) return $result;
        return null;
     }
    
    /*public function view($id=false){
        if($id){            
            $post = $this->posts->get($id);
            $img = $this->posts->get_media_files($id, 6);
            $news_date = date_parse(@$post->created_on);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'category_product' && $post->status == 'active'){
                    $data = array(
                        'id' => $post->id,
                        'title' => _t($post->title,LANG),
                        'content' => _t($post->content,LANG),
                        'short_content' => _t($post->short_content,LANG),
                        //'views' => $post->views,
                       // "date" => $post->created_on,//$news_date['day'].' '.getMonthName($post->created_on).' '.$news_date['year'],
                      );
                    
                    $gallery = array();
                    
                    foreach($img as $item):
                        $gallery[] = array(
                            'img' => base_url('uploads/'.$item->category.'/'.$item->url)
                        );
                    endforeach;                    
                    
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'gallery' => $gallery)));
                }else{
                     return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => array('error' => '404'))));
                }
            }else{
                return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => array('error' => '404'))));
            }
        }else{
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => array('error' => '404'))));
        }
    }*/
    
    


}
?>