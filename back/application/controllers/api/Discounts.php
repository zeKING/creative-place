<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Discounts extends Api_Controller
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
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'discounts'){
                    if($post->status == 'active'){
                         $post_id = $post->id;
                         
                         $category = $this->posts->get_posts_p(array('group' => 'offers', 'category_id' => $post_id ,'order' => 'DESC','status' => 'active', 'limit' => '10000000'));
                        if($category){
                            $tages = array();
                            foreach($category as $item):
                                $tages[] = $item->tags;
                            endforeach;
                            
                            foreach($tages as $item):
                                $tages2[]= implode(',', $tages);
                            endforeach;
                            //var_dump($tages2['0']);
                        }else{
                            $tages2['0'] = "";
                        }
                        $count = count(tags_post($tages2[0], 'products', 1, LANG));
                        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '8';
                        $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
                        $offset = $limit * ($page-1);       
                        $res = tags_post_limit($tages2[0], 'products', (int)$offset, $limit, LANG);
                        if($res){
                        
                        foreach($res as $item1){
                            foreach($item1 as $item){
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
                                    'vendor_code' => $item->vendor_code,
                                    'price' => currency_price($price),
                                    'old_price' => currency_price($old_price),
                                    'currency_title' => config_item('cur_default'),
                                    'counter' => $item->counter,
                                    'slug' => $item->alias
                                );
                            }
                        }
                        }
                        
                        
                                                
                         $status = ($category) ? true : false;
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data, 'status' => $status)));
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
    
      public function info($alias){
        if($alias){            
            $post = $this->posts->get_id_all($alias);
               foreach($this->lang->languages as $key => $lang)
        {
            $lang_post = 'status_lang_'.$key;
            if (LANG == $key) {$status_lang = $post->$lang_post;}
        } 
            if($status_lang == 'active'){
                if($post->group == 'discounts'){
                    if($post->status == 'active'){
                         $post_id = $post->id;
                         $data = array(
                            'title' => _t($post->title,LANG),
                            'content' => _t($post->content,LANG)
                         );
                        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => true)));
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