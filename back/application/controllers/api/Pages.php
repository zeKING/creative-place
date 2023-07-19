<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Pages extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function social(){
        $count = $this->posts->get_posts_countLang('social', newLANG);
        $limit = ($this->input->get('limit')) ? ($this->input->get('limit') == '-1') ?   1 : $this->input->get('limit') : '6';
        $page = ($this->input->get('offset')) ? ($this->input->get('offset') == '-1') ?   1 : $this->input->get('offset') : '0';
        //$offset = $limit * ($page-1);
        $res = $this->posts->get_posts_p(array('limit' => (int)$limit, 'status_lang_'.newLANG => 'active', 'group' => 'social', 'status' => 'active', 'offset' => (int)$page));

        if($res){
            foreach($res as $item){


                $data[] = array(
                    'title' => _t($item->title, newLANG),
                    "link" => $item->option_1,


                );

            }

            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(404);
        }

        $status = ($res) ? true : false;
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('count' => $count, 'data' => @$data/*, 'response' => http_response_code()*/, 'status' => $status)));
    }


}
?>