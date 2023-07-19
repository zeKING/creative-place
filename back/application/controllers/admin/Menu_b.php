<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_b extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('posts_model', 'posts');
        $this->load->model('admin_model', 'admin_main');
       // $this->load->model('category_model', 'category');
        $this->data['sel_users'] = '';
       /* if ($this->data['user_type'] != 'admin' || $this->data['user_type'] != 'osg') {
            go_to(site_url('admin/main'));
        }*/
    }
    public function index()
    {
        $group = 'menu_b';
        $this->data['menu_admin'] = $this->admin_main->MenuAdmin($group);
        $this->data['sel'] = $group;
        $this->data['body'] = "admin/{$group}/index_new";
        $this->load->view('admin/index', $this->data);
    }

    public function save($id = false, $page = false)
    {
        $group = 'menu_b';

        if ($id) {
            foreach ($this->lang->languages as $key => $lang) {
                $this->form_validation->set_rules('title[' . $key . ']', 'Title ' . $key, 'trim');
                // $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');

            }            

            if ($this->form_validation->run()) {
                $posts = $this->input->post();
                /*@$ru = mb_substr($_POST['title']['ru'], 0, 1, 'utf-8');
                @$uz = mb_substr($_POST['title']['uz'], 0, 1, 'utf-8');
                @$en = mb_substr($_POST['title']['en'], 0, 1, 'utf-8');*/

                $data = array(
                    'title'        => serialize($this->input->post('title')),
                    'content'      => serialize($this->input->post('content')),
                    'spec_type'      => serialize($this->input->post('spec_type')),
                    'content_html'      => serialize($this->input->post('content_html')),
                    'category_title'      => serialize($this->input->post('category_title')),
                    'option_4'      => serialize($this->input->post('option_4')),
                    'meta_title'  => serialize($this->input->post('meta_title')),
                    'category_id' => $this->input->post('category_id'),
                    'category_id2' => $this->input->post('category_id2'),
                   // 'status'      => $this->input->post('status'),
                    'status1'      => $this->input->post('status1'),
                    'status2'      => $this->input->post('status2'),
                    'status3'      => $this->input->post('status3'),
                    'option_1'      => $this->input->post('option_1'),
                    'option_2'        => @$this->input->post('option_2'),
                    'option_3'        => @$this->input->post('option_3'),
                    'options'      => $this->input->post('options'),
                    'option'      => $this->input->post('option'),
                    'keywords'        => @$this->input->post('keywords'),
                    'description'        => @$this->input->post('description'),
                    'position_menu' =>  @$this->input->post('position_menu'),
                    /*'status_lang_uz' => $status_uz,
                    'status_lang_ru' => $status_ru,
                    'status_lang_en' => $status_en,
                    'status_lang_oz' => $status_oz,
                    'status_lang_tj' => $status_tj,*/
                );
                 foreach($this->lang->languages as $key => $lang)
            {
                $data['status_lang_'.$key] = (@$_POST['title'][$key]) ? 'active': 'inactive';
            }
            
                if ($this->input->post('created_on')) {
                    $data['created_on'] = to_date("Y-m-d H:i", $this->input->post('created_on'));
                }

                if ($this->input->post('short_content')) {
                    $data['short_content'] = serialize($this->input->post('short_content'));
                }
                if ($this->input->post('alias'))
                    $data['alias'] = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('alias'));
              
             
               /* if (isset($posts['data'])) {
                    foreach ($posts['data'] as $key => $val)
                        $data[$key] = $val;
                }*/
                $error = false;
           
                /*	$is_meta = $this->posts->get_meta($id);
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
              
                if ($error === FALSE) {
                    $this->posts->save($data, $id);
                   go_to("admin/$group");
                    
                }
            }
            $this->data['post'] = $this->posts->get($id);
            $this->data['media_files'] = $this->posts->get_media_files($id);
            $this->data['media_files_poster'] = array(); //$this->posts->get_media_files_poster($id);
        } else {
            $data = array(
                'group' => $group,
                'created_on' => date('Y-m-d H:i:s'),
                'date_creation' => date('Y-m-d H:i:s'),
            );
            $new_post_id = $this->posts->save($data, $id);
            $data_sort_order['sort_order'] = $new_post_id;
            $this->posts->save($data_sort_order, $new_post_id);
            go_to("admin/$group/save/$new_post_id");
        }
        //$this->data['categories'] = parent_sort($this->category->get_cats( $group ));
        
            $this->data['categories'] = $this->posts->get_posts_p(array('group' => $group, 'media' => 'inactive', 'orderby' => 'id'));
        

        $this->data['sel'] = $group;
        $this->data['body'] = "admin/{$group}/save";
        $this->load->view('admin/index', $this->data);
    }
    public function delete($id)
    {
        $media = $this->posts->get_media_files($id);
        $this->posts->delete($id);
        foreach ($media as $item) {
            @unlink("./uploads/{$item->category}/{$item->url}");
        }
        foreach ($media as $item) {
            @unlink("./uploads/{$item->category}/{$item->audio_img}");
        }
        foreach ($media as $item) {
            @unlink("./uploads/{$item->category}/{$item->video_img}");
        }
        $this->db->delete('media', array('post_id' => $id));
        go_to();
    }
      
    public function status_ajax()
    {

        if ($this->input->post('status') and $this->input->post('postid')) {
            $id = $this->input->post('postid');
            if ($this->input->post('status') == 'true') {
                $status = "active";
            } else {
                $status = "inactive";
            }
        }


        $data = array(
            'status' => $status,

        );
        $this->posts->save($data, $id);

        $return['result'] = '<span style="color: green">' . lang('updated') . '</span>';
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
}
?>
