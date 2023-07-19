<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Banner extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();        
    }
    
    public function index(){
         return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false/*, 'response' => http_response_code()*/))); 
    }
    
    public function side(){     
        $res = $this->posts->get_posts_p(array('limit' => '1', 'group' => 'b_side', 'status' => 'active'));
        foreach($res as $item){
            $langs = get_mediaLang($item->id, LANG, 1);
            $img = ($langs) ? $langs[0]->url : $item->url;
            $data[] = array(
                //'id' => $item->id,
                //'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$img) : '',
                //'link' => 'news/'.$item->alias
            );
        }
       $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));       
    }
    
    public function middle(){     
        $res = $this->posts->get_posts_p(array('limit' => '1', 'group' => 'b_middle', 'status' => 'active'));
        foreach($res as $item){
            $langs = get_mediaLang($item->id, LANG, 1);
            $img = ($langs) ? $langs[0]->url : $item->url;
            $data[] = array(
                //'id' => $item->id,
                //'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$img) : '',
                //'link' => 'news/'.$item->alias
            );
        }
       $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));      
    }
    
    public function row_home(){     
        $res = $this->posts->get_posts_p(array('limit' => '3', 'group' => 'b_row', 'status' => 'active'));
        foreach($res as $item){
            $langs = get_mediaLang($item->id, LANG, 1);
            $img = ($langs) ? $langs[0]->url : $item->url;
            $data[] = array(
                //'id' => $item->id,
                //'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$img) : '',
                //'link' => 'news/'.$item->alias
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));      
    }
    
        public function row_pages(){     
        $res = $this->posts->get_posts_p(array('limit' => '3', 'group' => 'b_row', 'status' => 'active', 'order' => 'RANDOM'));
        foreach($res as $item){
            $langs = get_mediaLang($item->id, LANG, 1);
            $img = ($langs) ? $langs[0]->url : $item->url;
            $data[] = array(
                //'id' => $item->id,
                //'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$img) : '',
                //'link' => 'news/'.$item->alias
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));     
    }
    
}
?>