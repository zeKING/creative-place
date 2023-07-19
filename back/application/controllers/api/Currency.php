<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Currency extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('currency_model', 'currency');  
    }
    public function index()
    {        
        $res = $this->currency->getCurrency(array('status' => 'active', 'orderby' => 'sort_order'));
        foreach($res as $item){
            $data[] = array(
                'title' => $item->title,              
            );
        }      
           
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data)));          
    }
    
}
?>