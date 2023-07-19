<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends Admin_Controller
{ 
    
public function __construct()
{
   parent::__construct();    
   $this->load->model('comments_model', 'comments');
    $this->data['sel_users'] = 'comments';
}


    public function index($group, $offset = 0) {
      $base_url = base_url().'/admin/comments/index/'.$group.'/?';
        $total = $this->comments->get_commentsAdmin_count($group);;
        $per_page = 20;

        pagination_block($base_url, $total, $per_page);
      
        $this->data['comments'] = $this->comments->get_admin_comments(array('groups' => $group,'limit' => $per_page, 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
$this->data['pagination'] = $this->pagination->create_links();
        $this->data['sel'] = 'comments';
        $this->data['body'] = 'admin/comments/index';
        $this->load->view('admin/index', $this->data);
    }

    public function save($group, $id) {

       // $this->form_validation->set_rules('author', 'Name', 'trim|required');
       // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('comment_text', 'Comment', 'trim|required');

        if($this->form_validation->run())
        {
            $data = array(
               // 'author' => $this->input->post('author'),
               // 'email' => $this->input->post('email'),
                'comment_text' => $this->input->post('comment_text'),
                'status' => $this->input->post('status'),
               // 'alias' => $this->input->post('alias'),
               // 'rating' => $this->input->post('rating'),
            );

            $this->comments->save($data, $id);
            go_to('admin/comments/index/'.$group);
        }

        if ($id)
            $this->data['comment'] = $this->comments->get($id);

        $this->data['sel'] = 'comments';
        $this->data['body'] = "admin/comments/save";
        $this->load->view('admin/index', $this->data);
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
        $this->comments->save($data, $id);

        $return['result'] = '<span style="color: green">' . lang('updated') . '</span>';
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
    
   /* public function view($id, $offset = 0){
      
          $config = array();
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  $config['base_url'] = base_url().'/admin/comments/view/'.$id.'/';
  $config['total_rows'] = $this->comments->get_comments_id_view($id);
  $config['per_page'] = 10;
  
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
      
        $this->data['comments'] = $this->comments->get_view_comments(array('limit' => $config['per_page'], 'post_id' => $id, 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
$this->data['pagination'] = $this->pagination->create_links();
   
     
      
       $this->data['sel'] = 'comments';
        $this->data['body'] = 'admin/comments/view';
        $this->load->view('admin/index', $this->data);
    }

public function view_save($id) {

        $this->form_validation->set_rules('author', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('comment_text', 'Comment', 'trim|required');

        if($this->form_validation->run())
        {
            $data = array(
                'author' => $this->input->post('author'),
                'email' => $this->input->post('email'),
                'comment_text' => $this->input->post('comment_text'),
                'status' => $this->input->post('status'),
            );
            
            $category_id = getComments($id, 'post_id');
            
            $this->comments->save($data, $id);
            go_to('admin/comments/view/'.$category_id.'/');
            //go_to('admin/comments');            
        }

        if ($id)
            $this->data['comment'] = $this->comments->get($id);

        $this->data['sel'] = 'comments';
        $this->data['body'] = "admin/comments/save";
        $this->load->view('admin/index', $this->data);
    }*/


public function delete($id) {
    $this->comments_model->delete($id);
    go_to();
}

}
?>