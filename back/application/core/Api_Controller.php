<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Api_Controller extends CI_Controller
{
	public function __construct()
	{
	   	parent::__construct();
		$this->load->language('public');
        $this->load->language('public2');        
        $this->load->language('v');
        $this->load->language('user');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->model('posts_model', 'posts');         
        $this->load->model('users_model', 'users');
        @error_reporting(0);
	  	@ini_set('display_errors', 0);
        $this->load->library('session');
        $headers = $this->input->get_request_header('lang');
        if($headers == 'uz'){$headers = 'oz';}
        if($headers){define('newLANG', $headers);}else{define('newLANG', LANG);}
        header('Content-Type: text/html; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: *");
    }
 
 }
 ?>