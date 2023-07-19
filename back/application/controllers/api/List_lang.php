<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class List_lang extends Api_Controller
{
    public function __construct()
    {
        parent::__construct();        
    }
    
    public function index(){     
        $def['ru'] = 'Русский';
        $data[] = array('title' => $def['ru'],'lang' => 'ru');
        $def['en'] = 'English';
        $data[] = array('title' => $def['en'],'lang' => 'en');
        $def['tj'] = 'Тоҷикӣ';
        $data[] = array('title' => $def['tj'],'lang' => 'tj');
        if(@$def[LANG]){
        $default = array(
           'title' => @$def[LANG],
           'lang' => LANG,
        );
        }else{
            $default = array(
                'title' => '',
                'lang' => '',
            );
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => @$data, 'default' => $default, 'status' => true)));       
    }
    
}
?>