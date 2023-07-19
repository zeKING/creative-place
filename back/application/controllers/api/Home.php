<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Home extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();        
    }
    
      public function index(){
         return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false/*, 'response' => http_response_code()*/))); 
    }
    
    public function news(){     
        $res = $this->posts->get_posts_p(array('limit' => '2', 'status_lang_'.LANG => 'active', 'group' => 'news', 'status' => 'active'));
        foreach($res as $item){
            $news_date = date_parse($item->created_on);
            $data[] = array(
                //'id' => $item->id,
                'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$item->url) : '',
                'slug' => $item->alias,
                'date' => to_date('d.m.Y', $item->created_on),
                'content' => removeTags(_t($item->content, LANG)),
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));       
    }
    
    public function slides(){     
        $res = $this->posts->get_posts_p(array('limit' => '3', 'status_lang_'.LANG => 'active', 'group' => 'slides', 'status' => 'active'));
        foreach($res as $item){
            $news_date = date_parse($item->created_on);
            $data[] = array(
                //'id' => $item->id,
                'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$item->url) : '',
                'content' => removeTags(_t($item->content, LANG)),
                'link' => $item->options
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));       
    }
    
    public function popular(){
        $res = $this->posts->get_posts_p(array('limit' => '3', 'status_lang_'.LANG => 'active', 'group' => 'category_product', 'option' => 'yes', 'status' => 'active', 'media' => 'inactive','order' => 'ASC'));
        foreach($res as $item){
            $res_products = $this->posts->get_posts_p(array('group' => 'products', 'status_lang_'.LANG => 'active', 'status' => 'active', 'tags' => $item->id,'limit' => '8'));
            foreach($res_products as $item1){
                $discount = getOffers($item1->id, 'offers', 'discount');
                $d = null;
                if ($discount) {
                   $d = '-'.$discount.'%';
                   $percent = percent($discount, $item1->price, '-');
                   $price = $item1->price - $percent;
                   $old_price = $item1->price;
                }else{
                    $price = $item1->price;
                    $old_price = null;
                }
                $products[$item->id][] = array(
                    'id' => $item1->id,
                    'title' => _t($item1->title, LANG),
                    'discount' => $d,
                    // 'content' => _t($item->content,LANG),
                    "url" => ($item1->url) ? base_url('uploads/'.$item1->group.'/'.$item1->url) : '',
                    //'views' => $item->views,
                    'vendor_code' => $item1->vendor_code,
                    'price' => currency_price($price),
                    'old_price' => currency_price($old_price),
                    'currency_title' => config_item('cur_default'),
                    'counter' => $item1->counter,
                    'slug' => $item1->alias
                );
            }
            $data[] = array(
                //'id' => $item->id,
                'tab_title' => _t($item->title, LANG),
                'products' => $products[$item->id],
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));       
    }
    
    public function advantage(){
        $res = $this->posts->get_posts_p(array('limit' => '3', 'status_lang_'.LANG => 'active', 'group' => 'advantage', 'status' => 'active', 'order' => 'ASC'));
        foreach($res as $item){
            $news_date = date_parse($item->created_on);
            $data[] = array(
                'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$item->url) : '',                
            );
        }
        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));     
    }
    
    public function reviews(){
         $this->load->model('review_model', 'review');
         $res = $this->review->get_active(4, 0);
        foreach($res as $item){
            $data[] = array(
                'name' => $item->name,
                'url' => ($item->img) ? base_url('uploads/reviews/'.$item->img) : '',                   'company' => $item->company,   
                'content' => strip_tags($item->content, '<br/><br>'),                   
            );
        }
       $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));     
    }
    
    public function discounts(){
        $res = $this->posts->get_posts_p(array('limit' => '2', 'status_lang_'.LANG => 'active', 'group' => 'discounts', 'status' => 'active'));
        foreach($res as $item){
            $data[] = array(
                'title' => _t($item->title, LANG),
                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$item->url) : '',          
                'slug' => $item->alias      
            );
        }
       $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status))); 
    }
    
}
?>