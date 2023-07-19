<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Public_Controller extends MY_Controller
{
  public function __construct($offset = 0)
  {
  
    parent::__construct();
    //$this->load->model('weather');
    $this->load->language('public');
    $this->load->language('public2');
    $this->load->language('v');
    $this->load->language('user');
    
      $site_status = config_item('site_status');
     $ip = $this->input->ip_address();  
     if($this->blacklist->check_ip($ip)->is_blocked()){
            header('HTTP/1.0 403 Forbidden');
            die();
        }
        
       
    // $this->data['weather_meteo'] = $this->weather->get_weather();
    //$this->load->model('category_model', 'categories');
    $this->load->model('posts_model', 'posts');
    $this->load->model('menu_model', 'menu');
    $this->data['user_id2'] = $this->session->userdata('user_id2');
    if($this->data['user_id2']){
        $u_post = getUserOptionAll($this->session->userdata('user_id2'));
        $this->data['u_post_main'] = $u_post;
        $this->data['count_files'] = 5;   
        $this->data['sel_t']     = '';
        $this->data['tarrif_days'] = '';
//        if($u_post->tariff_st_free == 'active'){
//            $this->data['tarrif_days'] = trim(_t(getPosts(81,'content_html'),'ru'));
//        }
        //echo $this->data['tarrif_days'];
    }else{
         $this->data['u_post_main'] = array();
    }
    $this->data['home_login_reg'] = 'active';
    
    //$this->load->model('site_model', 'site');   
    //$this->load->model('review_model', 'review');
    //$this->load->model('polls_model', 'polls'); 
   // $this->data['user_id2'] = $this->session->userdata('user_id2');
   
    $this->load->library('user_agent');
  if($site_status == 'no'){
        $this->data['catalog_category'] = $this->posts->get_posts_p(array('group' => 'catalog_category', 'order' => 'ASC', 'orderby' => 'sort_order', 'status_lang_' . LANG => 'active', 'status' => 'active', 'media' => 'inactive'));
    // $this->data['menu'] = $this->posts->get_posts_p(array('group' => 'menu', 'order' => 'ASC', 'orderby' => 'sort_order', 'status_lang_' . LANG => 'active', 'status' => 'active', 'media' => 'inactive'));
    /* if($this->data['user_id2']){
        $this->data['menu_user'] = $this->posts->get_posts_p(array('group' => 'menu_user', 'order' => 'ASC', 'orderby' => 'sort_order', 'status_lang_' . LANG => 'active', 'status' => 'active', 'media' => 'inactive'));
     }else{
        $this->data['menu_user'] = array();
     }*/
    /*  $pages = $this->posts->get_posts_p(array('group' => 'pages', 'status' => 'active', 'media' => 'inactive'));
      $this->data['pages_block'] = $pages;
      foreach($pages as $item){
          $p[$item->id] = $item;
          $this->data['p_'.$item->id] = $item;
      }
    //$this->data['address'] = _t($p[30]->content_html, LANG);
    //  $this->data['google_map'] = strip_tags(_t($p[74]->short_content, 'uz'),'<iframe>');
    $this->data['phone'] = _t($p[43]->title, 'ru');
    $this->data['email'] = _t($p[44]->title, 'ru');*/

    


    $this->data['sel_menu'] = '';

    $this->data['meta_global'] = siteSettings('meta_tags_home', 'title+description+keywords');
    $this->data['keywords_glob'] = $this->data['meta_global']['keywords'];
    $this->data['description_glob'] = $this->data['meta_global']['description'];
    $this->data['meta_title_glob'] = $this->data['meta_global']['meta_title'];
    }
  }
}
