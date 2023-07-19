<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Product extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
    }    
    
      public function index(){
         return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false))); 
    }
     public function view($alias){
        if($alias){            
            $post = $this->posts->get_id_all($alias);
           
           // $news_date = date_parse(@$post->created_on);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'products'){
                    if($post->status == 'active'){
                        $img = $this->posts->get_media_files($post->id, 50);
                        $discount = getOffers($post->id, 'offers', 'discount');
                        $d = null;
                        if ($discount) {
                           $d = '-'.$discount.'%';
                           $percent = percent($discount, $post->price, '-');
                           $price = $post->price - $percent;
                           $old_price = $post->price;
                        }else{
                            $price = $post->price;
                            $old_price = null;
                        }
                        foreach($img as $item):
                            $gallery[] = array(
                                'url' => base_url('uploads/'.$item->category.'/'.$item->url)
                            );
                        endforeach; 
                        $data = array(
                            'id' => $post->id,
                            'title' => _t($post->title, LANG),
                            'discount' => $d,
                             'content' => str_replace('/uploads/', base_url('uploads/'), _t($post->content,LANG)),
                           // "url" => ($post->url) ? base_url('uploads/'.$post->group.'/'.$post->url) : '',
                            //'views' => $item->views,
                            'vendor_code' => $post->vendor_code,
                            'price' => currency_price($price),
                            'old_price' => currency_price($old_price),
                            'currency_title' => config_item('cur_default'),
                            'counter' => $post->counter,
                            'slug' => $post->alias,
                            'rating' => commentsRating($post->id),
                            'gallery' => $gallery,
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
    
      public function modal($alias){
        if($alias){            
            $post = $this->posts->get_id_all($alias);
            
           // $news_date = date_parse(@$post->created_on);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'products'){
                    if($post->status == 'active'){
                        $img = $this->posts->get_media_files($post->id, 50);
                        $discount = getOffers($post->id, 'offers', 'discount');
                        $d = null;
                        if ($discount) {
                           $d = '-'.$discount.'%';
                           $percent = percent($discount, $post->price, '-');
                           $price = $post->price - $percent;
                           $old_price = $post->price;
                        }else{
                            $price = $post->price;
                            $old_price = null;
                        }
                        foreach($img as $item):
                            $gallery[] = array(
                                'url' => base_url('uploads/'.$item->category.'/'.$item->url)
                            );
                        endforeach; 
                        $data = array(
                            'id' => $post->id,
                            'title' => _t($post->title, LANG),
                            'discount' => $d,
                             'content' => str_replace('/uploads/', base_url('uploads/'), _t($post->content,LANG)),
                           // "url" => ($post->url) ? base_url('uploads/'.$post->group.'/'.$post->url) : '',
                            //'views' => $item->views,
                            'vendor_code' => $post->vendor_code,
                            'price' => currency_price($price),
                            'old_price' => currency_price($old_price),
                            'currency_title' => config_item('cur_default'),
                            'counter' => $post->counter,
                            'slug' => $post->alias,
                            'rating' => commentsRating($post->id),
                           // 'gallery' => $gallery,
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
    
    public function info(){
        $data = array(
            'content' => _t(getPosts(3029,'content_html'), LANG),
        );
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => true)));
    }
    
    public function similar($alias){
          if($alias){            
            $post = $this->posts->get_id_all($alias);
            //$img = $this->posts->get_media_files($post->id, 50);
           // $news_date = date_parse(@$post->created_on);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'products'){
                    if($post->status == 'active'){
                        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '10';
                        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
                        $offset = $limit * ($page-1);
                        $tags = $post->tags;
                        $res = $this->posts->get_posts_p(array('limit' => (int)$limit, 'status_lang_'.LANG => 'active', 'group' => 'products', 'not_like' => $post->id, 'tags' => $tags, 'status' => 'active', 'offset' => (int)$offset));
                        foreach($res as $item){
                            $discount = getOffers($item->id, 'offers', 'discount');
                            $d = null;
                            if ($discount) {
                               $d = '-'.$discount.'%';
                               $percent = percent($discount, $item->price, '-');
                               $price = $item->price - $percent;
                               $old_price = $item->price;
                            }else{
                                $price = $item->price;
                                $old_price = null;
                            }
                            $data[] = array(
                                'id' => $item->id,
                                'title' => _t($item->title, LANG),
                                'discount' => $d,
                                // 'content' => _t($item->content,LANG),
                                "url" => ($item->url) ? base_url('uploads/'.$item->group.'/'.$item->url) : '',
                                //'views' => $item->views,
                                //'vendor_code' => $item->vendor_code,
                                'price' => currency_price($price),
                                'old_price' => currency_price($old_price),
                                'currency_title' => config_item('cur_default'),
                                'counter' => $item->counter,
                                'slug' => $item->alias
                            );
                        }             
                        
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
    
    public function comments($alias){
        if($alias){            
            $this->load->model('comments_model', 'comments');
            $post = $this->posts->get_id_all($alias);
            //$img = $this->posts->get_media_files($post->id, 50);
           // $news_date = date_parse(@$post->created_on);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'products'){
                    if($post->status == 'active'){
                        $count = $this->comments->get_comments_id_view($post->id,'active');
                        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '10';
                        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
                        $offset = $limit * ($page-1);                        
                        $res =  $this->comments->get_main_comments( array('post_id'=>$post->id, 'status' => 'active', 'limit' => $limit, 'offset' => (int)$offset));
                        foreach($res as $item){
                           $data[] = array(
                                'name' => getUserOption($item->user_id, 'first_name'),
                                'date' => to_date("d.m.Y", $item->date),
                                'rating' => $item->rating,
                                'content' => $item->comment_text,
                            );
                        }             
                        
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => $data, 'status' => true)));
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
    
    public function form($alias=false){
        if($alias){
             $this->load->library('session');
             $this->load->model('comments_model', 'comments');
             $token = $this->session->userdata('token');
             if($token){
                $post = $this->posts->get_id_all($alias);               
                if($post->group == 'products'){
                    if($post->status == 'active'){
                        $this->form_validation->set_rules('comment_text', 'lang:comment_text', 'trim|required');   
                         if ($this->form_validation->run()) {   
                            $user = getUserToken($token);
                            $rating = ($this->input->post('rating')) ? $this->input->post('rating') : '5';
                             
                            $data_c = array(
                                'post_id' => $post->id,
                                'user_id' => $user->user_id,
                                'rating' => $this->db->escape_str($rating),
                                'comment_text' => $this->db->escape_str($this->input->post('comment_text')),
                                'groups' => 'products',
                                'date' => date('Y-m-d H:i:s'),
                            );
                            $this->comments->save($data_c,false);
                            $data = array(                                
                                'message' => lang('success_send'),
                            );
                            
                            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => true)));
                         }else{
                            $data = array(                                
                                'message' => lang('success_email_error1').'<br/>'. validation_errors(),
                            );
                            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
                         }
                     }else{
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
                     }
                 }else{
                    return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false))); 
                 }
             }else{
                $data = array(                                
                    'message' => lang('u_auth'),
                );
                 return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data, 'status' => false)));
             }
         }else{
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => null, 'status' => false)));
         }         
       
    }
    
}
?>