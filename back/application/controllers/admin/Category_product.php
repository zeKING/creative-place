<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_product extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();        
        $this->load->model('admin_category_product_model', 'admin_main');
        $this->load->model('posts_model', 'posts');
        $this->data['sel_users'] = '';
       /* if ($this->data['user_type'] != 'admin' || $this->data['user_type'] != 'osg') {
            go_to(site_url('admin/main'));
        }*/
    }
    public function index()
    {
        $group = 'category_product';
        $this->data['menu_admin'] = $this->admin_main->MenuAdmin();
        $this->data['sel'] = $group;
        $this->data['body'] = "admin/{$group}/index_new";
        $this->load->view('admin/index', $this->data);
    }

    public function save($id = false, $page = false)
    {
        $group = 'category_product';

        if ($id) {
            foreach ($this->lang->languages as $key => $lang) {
                $this->form_validation->set_rules('title[' . $key . ']', 'Title ' . $key, 'trim');              

            }            

            if ($this->form_validation->run()) {
                $posts = $this->input->post();

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
                    'options'      => $this->input->post('options'),
                    'option'      => $this->input->post('option'),
                    'keywords'        => @$this->input->post('keywords'),
                    'description'        => @$this->input->post('description'),
                    'icon' => @$this->input->post('icon'),
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
              
                    $this->posts->save($data, $id);
                   go_to("admin/".$group);
                    
                
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
            go_to("admin/category_product/save/$new_post_id");
        }
            $this->data['categories'] = $this->posts->get_posts_p(array('group' => $group, 'media' => 'inactive', 'orderby' => 'id', 'order' => 'ASC'));
        

        $this->data['sel'] = $group;
        $this->data['status_cat'] = 'inactive';
        $this->data['body'] = "admin/{$group}/save";
        $this->load->view('admin/index', $this->data);
    }
     public function add_category($category_id, $id = false, $page = false)
    {
        $group = 'category_product';

        if ($id) {
            foreach ($this->lang->languages as $key => $lang) {
                $this->form_validation->set_rules('title[' . $key . ']', 'Title ' . $key, 'trim');              

            }            

            if ($this->form_validation->run()) {
                $posts = $this->input->post();

                $data = array(
                    'title'        => serialize($this->input->post('title')),
                    'content'      => serialize($this->input->post('content')),
                    'spec_type'      => serialize($this->input->post('spec_type')),
                    'content_html'      => serialize($this->input->post('content_html')),
                    'category_title'      => serialize($this->input->post('category_title')),
                    'option_4'      => serialize($this->input->post('option_4')),
                    'meta_title'  => serialize($this->input->post('meta_title')),
                    'category_id' => $category_id,
                    'category_id2' => $this->input->post('category_id2'),
                    'options'      => $this->input->post('options'),
                    'keywords'        => @$this->input->post('keywords'),
                    'description'        => @$this->input->post('description'),
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
              
                    $this->posts->save($data, $id);
                   go_to("admin/".$group);
                    
                
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
            go_to("admin/category_product/add_category/$category_id/$new_post_id");
        }
            $this->data['categories'] = $this->posts->get_posts_p(array('group' => $group, 'media' => 'inactive', 'orderby' => 'id', 'order' => 'ASC'));
        

        $this->data['sel'] = $group;
        $this->data['status_cat'] = 'active';
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
