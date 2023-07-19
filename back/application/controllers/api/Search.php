<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Search extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Works_model', 'works');
    }
    
      public function index(){
        $word = $this->db->escape_str(addslashes($this->input->get('word')));
        if($word){           
//            $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
//            $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '0';

            $tag = $this->works->get_posts_tag($word);
            if($tag){

                foreach($tag as $item){
                    $res = $this->works->get_posts_t($item->id);
                    foreach ($res as $item1){
                        $data[] = array(
                            'id' => $item1->id,
                            'name' => $item1->name,


                        );
                    }
                    $status = true;

                }


            }else{
                $res = $this->works->get_posts_p(array('title' => $word));
                foreach($res as $item){
                    $data[] = array(
                        'id' => $item->id,
                        'name' => $item->name,


                    );
                }
                $status = true;

            }


           return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'status' => $status)));
        }else{
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false, 'message' => lang('search_no'))));
        }      
    }
    
    public function result(){
        $word = $this->db->escape_str(addslashes($this->input->get('word')));
        if($word){
            $count = $count = $this->posts->get_posts_admin_filter(array('status_lang_'.LANG => 'active', 'group' => 'products', 'title' => $word, 'status' => 'active'));
            $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
            $page = ($this->input->get('page')) ? ($this->input->get('page') == '-1') ?   1 : $this->input->get('page') : '1';
            $offset = $limit * ($page-1);
            $res = $this->posts->get_posts_p(array('limit' => (int)$limit, 'status_lang_'.LANG => 'active', 'group' => 'products', 'title' => $word, 'status' => 'active', 'offset' => (int)$offset));
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
            $status = (@$res) ? true : false;
           return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data, 'status' => $status)));
        }else{
            return $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => false, 'message' => lang('search_no'))));
        } 
    }
    
}
?>