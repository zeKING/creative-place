<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Category extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index($alias=false)
    {
        if($alias){
            $post = $this->posts->get_id_all($alias);
            if(@$post->group == 'category_product' && @$post->status == 'active'){                
                foreach($this->lang->languages as $key => $lang){
                    $lang_post = 'status_lang_'.$key;
                    if (LANG == $key) {$status_lang = $post->$lang_post;}
                }
                if($status_lang == 'active'){ 
                    $tags = $post->id;
                    $min = $this->db->escape_str($this->input->get('min_price'));
                    $max = $this->db->escape_str($this->input->get('max_price'));
                    $brands_id = $this->db->escape_str($this->input->get('brands_id'));
                    
                    $count = $this->posts->get_posts_admin_filter(array('status_lang_'.LANG => 'active', 'group' => 'products', 'mincost' => $min, 'brands_id' => $brands_id, 'maxcost' => $max, 'tags' => $tags, 'status' => 'active'));
                    $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
                    $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
                    $offset = $limit * ($page-1);
                    
                    $res = $this->posts->get_posts_p(array('limit' => (int)$limit, 'status_lang_'.LANG => 'active', 'group' => 'products', 'tags' => $tags, 'status' => 'active', 'mincost' => $min, 'maxcost' => $max, 'brands_id' => $brands_id,  'offset' => (int)$offset));
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
                            'vendor_code' => $item->vendor_code,
                            'price' => currency_price($price),
                            'old_price' => currency_price($old_price),
                            'currency_title' => config_item('cur_default'),
                            'counter' => $item->counter,
                            'slug' => $item->alias
                        );
                    }
                  
                    $status = ($res) ? true : false;
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
        
    }
    
    public function filter($alias=false){
         if($alias){
            $post = $this->posts->get_id_all($alias);
            if(@$post->group == 'category_product' && @$post->status == 'active'){                
                foreach($this->lang->languages as $key => $lang){
                    $lang_post = 'status_lang_'.$key;
                    if (LANG == $key) {$status_lang = $post->$lang_post;}
                }
                if($status_lang == 'active'){ 
                    $tags = $post->id;
                  
                    $category = $this->posts->get_posts_p(array('status_lang_'.LANG => 'active', 'group' => 'category_product', 'media' => 'inactive', 'category_id' => $tags, 'status' => 'active'));
                    foreach($category as $item){
                        $submenu[] = array(
                            'title' => _t($item->title,LANG),
                            'slug' => $item->alias,
                        );
                    }
                    if($post->category_id == 0){
                        $id = $post->id;                        
                    }else{
                        $id = $post->category_id;  
                    }
                    
                    $brands = $this->posts->get_posts_p(array('status_lang_'.LANG => 'active', 'group' => 'brands', 'category_id' => $id, 'media' => 'inactive', 'status' => 'active'));
                    foreach($brands as $item){
                        $b[] = array(
                            'title' => _t($item->title,LANG),
                            'id' => $item->id,
                            'count' => count_tags($item->id,'brands','products'),
                        );
                    }
                    $data = array(
                       // 'id' => $post->id,
                       // 'category_id' => $id,
                        'title' => _t($post->title, LANG),
                        'submenu' => (@$submenu) ? $submenu : null,
                        'brands' => @$b,
                        'price' => array(
                            'min' => 500,
                            'max' => 3000000
                        )
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
    }
    
   /* public function brand(){
        $arrContextOptions=array(
	"ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
	),
);  
$output = json_decode(@file_get_contents("https://shop2.osg.tj/ru/cron/action/getBrand", false, stream_context_create($arrContextOptions)), true);

 $res = $this->posts->get_posts_p(array('group' => 'products', 'media' => 'inactive', 'brands' => 'no'));
        foreach($output['data'] as $item){
            $tags = $item['tags'];
            $id = $item['id'];
            foreach($res as $item1){
                if($item1->id == $id){
                    
                    $data = array(
                        'brands' => $tags,
                    );
                    $this->posts->save2($data, $item1->id);
                    
                }
            }
        }
        var_dump($res);
    }*/
}
?>