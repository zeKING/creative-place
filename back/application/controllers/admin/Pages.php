<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Pages extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->model('posts_model', 'posts');
       // $this->load->model('category_model','category');
       /* if($this->data['user_type'] != 'admin'){
            go_to(site_url('admin/main'));
        }*/
	}

	public function index($group, $param, $offset = 0)
	{
	 
    $base_url = base_url().'/admin/pages/index/'.$group.'/'.$param.'/?';   
  // $category_count = $this->posts->get_posts_p( array('group'=> $group, 'category_id' => $param));   
    $total = $this->posts->count_posts_category_admin($param, $group);
  // $config['total_rows'] = count($category_count) ;
   
    $per_page = 50;
    pagination_block($base_url, $total, $per_page);     
    
     if($this->input->get('sort')){        
         $this->data['posts'] = $this->posts->get_posts_p( array('group'=> $group, 'orderby' => 'sort_order', 'order' => $this->input->get('sort'), 'category_id' => $param, 'limit' => $per_page, 'offset' => (int)$this->input->get('page')) );    
          
     }else{
          $this->data['posts'] = $this->posts->get_posts_p( array('group'=> $group, 'category_id' => $param, 'limit' => $per_page, 'offset' => (int)$this->input->get('page')) );  
     }
    $this->data['category_o'] = $this->posts->get_posts_byID_portfolio($param);
    //$this->data['categories'] = parent_sort($this->category->get_by_alias($param));
         
    $this->data['category_id'] = $param;
     $this->data['category_group'] = $group;
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['sel'] = $group;
    $this->data['cat_id'] = $group.'_'.$param;
    $this->data['body'] = "admin/posts_pages/$group/index";
    $this->load->view('admin/index', $this->data);
	}
    
    
    /*	public function index_ajax($group, $param, $offset = 0)
	{
	 
    $this->load->library('pagination');
    
    $config = array();
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url().'/admin/pages/index/'.$group.'/'.$param.'/?';
    
   $category_count = $this->posts->get_posts_p( array('group'=> $group, 'category_id' => $param));
    
    
   // $config['total_rows'] = $this->posts->count_category($group, $param);
   $config['total_rows'] = count($category_count) ;
   
    $config['per_page'] = 80;
    
    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div><!--pagination-->';
    
    $config['first_link'] = '&laquo;';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';
    
    $config['last_link'] = '&raquo;';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';
    
    $config['next_link'] = '&rarr;';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';
    
    $config['prev_link'] = '&larr;';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';
    
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    //$this->data['posts'] = $this->posts->get_posts_portfolio($group, $param, $config['per_page'], (int)$this->input->get('page'));
    
       
     
   
         if(@$_GET['sort']){
     if($_GET['sort'] == 'DESC'){
     $this->data['posts'] = $this->posts->get_posts_p( array('group'=> $group, 'orderby' => 'sort_order', 'order' => 'DESC', 'category_id' => $param, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')) );  
     } 
     if($_GET['sort'] == 'ASC') {
          $this->data['posts'] = $this->posts->get_posts_p( array('group'=> $group, 'orderby' => 'sort_order', 'order' => 'ASC', 'category_id' => $param, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')) );  
     }
     
     }else{
          $this->data['posts'] = $this->posts->get_posts_p( array('group'=> $group, 'category_id' => $param, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')) );  
     }
    
    $this->data['category_o'] = $this->posts->get_posts_byID_portfolio($param);
    //$this->data['categories'] = parent_sort($this->category->get_by_alias($param));
     /* $lookbook = $this->posts->get( $param );
      $this->data['category_cat_menu'] = $lookbook->category_id;
      $cat_id = $this->posts->get( $lookbook->category_id );
      if($cat_id){
      $this->data['category_cat_menu_1'] = $cat_id->category_id;
      }*/
      
  /*  $this->data['category_id'] = $param;
     $this->data['category_group'] = $group;
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['sel'] = $group;
    $this->data['sel_id'] = $group;
   
   // $this->data['body'] = "admin/group/index";
    $this->load->view('admin/'.$group.'/index_ajax', $this->data);
	}*/
    


	public function save($group, $category_id, $id=false, $page=false)
	{
		if($id)
		{
			$this->form_validation->set_rules('alias', 'Alias', 'trim|required');
			// $this->form_validation->set_rules('category', 'Category', 'trim|required');

			if ($this->form_validation->run())
			{
		/*	 @$ru = mb_substr($_POST['title']['ru'], 0,1,'utf-8');
        @$uz = mb_substr($_POST['title']['uz'], 0,1,'utf-8');
        @$en = mb_substr($_POST['title']['en'], 0,1,'utf-8');*/
            
				$data = array(
                    'title'  	  => serialize($this->input->post('title')),
                    'content'	  => serialize($this->input->post('content')),
                    'content_1'	  => serialize($this->input->post('content_1')),
                    'content_2'	  => serialize($this->input->post('content_2')),
                    'content_3'	  => serialize($this->input->post('content_3')),
                    'short_content'	  => serialize($this->input->post('short_content')),
                    'spec_type'	  => serialize($this->input->post('spec_type')),
                    
                    'category_title'	  => serialize($this->input->post('category_title')),
                    'option_4'	  => serialize($this->input->post('option_4')),   
                    //'destination'	  => serialize($this->input->post('destination')),   
                    'category_id' => ($this->input->post('category_change')) ? $this->input->post('category_change') : $category_id,
                    'category_id2' => $this->input->post('category_id2'),
                    //'status'	  => $this->input->post('status'),
                    'lang_status'	  => $this->input->post('lang_status'),
                    'status_meta' => $this->input->post('status_meta'),
                    //'category_status' => $this->input->post('category_status'),
                    'status_cat'	  => $this->input->post('status_cat'),
                    'spec'	  => $this->input->post('spec'),
                    'link'	  => $this->input->post('link'),
                    'keywords'  	  => @$this->input->post('keywords'),
                    'options'	  => $this->input->post('options'),
                    //'description'  	  => @$this->input->post('description'),
                    'option'  	  => @$this->input->post('option'),
                    'option_1'  	  => preg_replace('/[^A-Za-z0-9\-]/', '', @$this->input->post('option_1')),
                    'option_2'  	  => @$this->input->post('option_2'),
                    'option_3'  	  => serialize(@$this->input->post('option_3')), 
                    'option_5'      => @$this->input->post('option_5'),
                    'cat_id'  	  => @implode(',', $this->input->post('cat_id')),
                    //'dbl'  	  => @$this->input->post('dbl'),
                    //'sgl'  	  => @$this->input->post('sgl'),
                    //'twin'  	  => @$this->input->post('twin'),
//                    'specialty'  	  => @$this->input->post('specialty'),
                    'price'  	  => @$this->input->post('price'),                 
                  
                    'tags' => @implode(',', $this->input->post('tags')),
                    'country_id' => @$this->input->post('country_id'),
                    'city_id'   =>  @$this->input->post('city_id'),  
                    'value_1'  	  => @$this->input->post('value_1'),
                    'value_2'  	  => @$this->input->post('value_2'),
                    'value_3'  	  => @$this->input->post('value_3'),
                    'value_4'  	  => @$this->input->post('value_4'),
                    'value_5'  	  => @$this->input->post('value_5'),
                    'value_6'  	  => @$this->input->post('value_6'),
                    'value_7'  	  => @$this->input->post('value_7'),
                    'value_8'  	  => @$this->input->post('value_8'),
                    'value_9'  	  => @$this->input->post('value_9'),
				);
                
                 foreach($this->lang->languages as $key => $lang)
            {
                $data['status_lang_'.$key] = (@$_POST['title'][$key]) ? 'active': 'inactive';
            }
                


				if ($this->input->post('alias')){
					$data['alias'] = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('alias'));
                    }
   if($this->input->post('created_on')){
          	
        $data['created_on'] = to_date("Y-m-d H:i", $this->input->post('created_on'));
        
        }
        
        if($this->input->post('date1')){
          	
        $data['date1'] = to_date("Y-m-d", $this->input->post('date1'));
        
        }
        
        if($this->input->post('date_creation')){
          $data['date_creation'] = to_date("Y-m-d H:i", $this->input->post('date_creation'));
          }
                /*$upload_data = array();
                if($_FILES['userfile']['size'] > 0 )
                {
                    $result = do_upload('city_map');

                    if(!empty($result['error']))
                    {
                        $error = true;
                        $this->data['error'] = $result['error'];
                    }
                    else
                    {
                        $error = false;
                        $upload_data = $this->upload->data();
                        $data['map_img'] = $upload_data['file_name'];

                        if(!empty($id))
                        {
                            $post = $this->posts->get($id);
                            @unlink('./uploads/video_covers/'.$post->map_img);
                        }
                    }
                }*/
				$this->posts->save($data, $id);

				/*$is_meta = $this->posts->get_meta($id);
				if($this->input->post('meta'))
				{
					if($is_meta)
					{
						foreach($this->input->post('meta') as $key => $value)
						{
							$meta['post_id']	= $id;
							$meta['meta_key']	= $key;
							$meta['value']		= $value;
							$this->posts->save_meta($meta,$id);
						}
					}
					else{
						foreach($this->input->post('meta') as $key => $value)
						{
							$meta['post_id']	= $id;
							$meta['meta_key']	= $key;
							$meta['value']		= $value;
							$this->posts->save_meta($meta);
						}
					}
				}*/
                 if($page){           
                   go_to("admin/pages/index/$group/$category_id/?&page=$page");
                    } else{
                        go_to("admin/pages/index/$group/$category_id");
                    }
			}			
      $this->data['post'] = $this->posts->get($id);
      $this->data['category'] = $this->posts->get($category_id);
      $this->data['category_sub'] = $this->posts->get($category_id);
      
     // $this->data['is_meta'] = $this->posts->get_meta($id);
      $this->data['media_files'] = $this->posts->get_media_files($id);
       $this->data['media_files_poster'] = $this->posts->get_media_files_poster($id);
		}
		else
		{
			$data = array(
				'group' => $group,
			'created_on' => date('Y-m-d H:i:s'),
                'date_creation' => date('Y-m-d H:i:s'),
			);
      
			$new_post_id = $this->posts->save($data, $id);
            
             $data_sort_order['sort_order'] = $new_post_id;
            $this->posts->save($data_sort_order, $new_post_id);
            
			$country = $this->input->get('category');
			go_to("admin/pages/save/$group/$category_id/$new_post_id");
		}

		$this->data['categories'] = '';//parent_sort($this->category->get_by_alias($group));
    		//$this->data['post'] = $this->posts->get($id);
		$this->data['sel'] = $group;
        $this->data['cat_id'] = $group.'_'.$category_id;
    //$this->data['category_site'] = $this->posts->get_posts(array('group'=>'portfolio', 'status' => 'active'));
    $this->data['body'] = "admin/posts_pages/$group/save";

    $this->load->view('admin/index', $this->data);
	}

}
?>