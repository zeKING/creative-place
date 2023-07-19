<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['sel'] = 'works';
        $this->load->model('posts_model', 'posts');
        $this->load->model('works_model', 'works');
        $this->load->model('users_model', 'users');
    }

    public function index()
    {
        $base_url = base_url().'/admin/works/?';
        $total = $this->works->count_all_с();
        $per_page = 50;

        pagination_block($base_url, $total, $per_page);
        $this->data['contacts'] = $this->works->get_list(array('limit' => $per_page, 'offset' => (int)$this->input->get('page')));
        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['body'] = 'admin/works/index';
        $this->load->view('admin/index', $this->data);
    }

    public function view($contact_id)
    {
        if($this->input->post()){
            $data = array(
              'user_id'=>removeTags(addslashes($this->input->post('user_id'))),
              'name'=>removeTags(addslashes($this->input->post('name'))),
              'tag_id'=>removeTags(addslashes($this->input->post('tag_id'))),
              'price'=>removeTags(addslashes($this->input->post('price'))),
              'status_slider'=>removeTags(addslashes($this->input->post('status_slider'))),
              'message'=>removeTags(addslashes($this->input->post('message'))),
              'status_home'=>removeTags(addslashes($this->input->post('status_home'))),
              'created_on'=>to_date('Y-m-d H:i:s',removeTags(addslashes($this->input->post('created_on')))),
            );
            $upload_data = array();

            if($_FILES['file']['size'] > 0 ) {

                $result = do_upload('works');

                if(!empty($result['error'])) {
                    $error = true;
                    $this->data['error'] = $result['error'];
                } else {
                    $error = false;
                    $upload_data = $this->upload->data();
                    $data['file'] = $upload_data['file_name'];

                    if($contact_id) {
                        $post = $this->works->get($contact_id);
                        @unlink('./uploads/works/'.$post->file);
                    }

                }
            }
            $this->works->save2($data,$contact_id);
            go_to(base_url('admin/works'));
        }
        $this->data['post'] = $post =$this->works->get($contact_id);
        $this->data['tags'] = $this->posts->get_posts(array('group'=>'tags','status'=>'active', 'orderby' => 'sort_order'));
        $this->data['users'] = $this->users->get_list(array('user_type'=>'seller','phone'=>'1'));

        //	$this->data['works'] = $this->works->get_history_works($contact_id, $contact);

        if($this->data['post']){
            $this->data['body'] = 'admin/works/view';
            $this->load->view('admin/index', $this->data);
        }else{
            go_to(base_url('admin/works'));
        }
    }



    public function delete($contact_id)
    {
        $pos = $this->works->get($contact_id);

        @unlink( "./uploads/works/$pos->file" );
        $this->works->delete($contact_id);
        go_to();
    }
}
?>