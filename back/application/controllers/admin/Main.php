<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['sel'] = 'main';

    $this->load->helper('file');
	}

	public function index()
	{
        //$this->data['users']= $this->posts->get_visitor_main();
        //$this->data['mobile']= $this->posts->get_visitor_mobile();
        delete_files('./uploads/cache/', TRUE);      
        $this->data['body'] = 'admin/main/index';
        $this->load->view('admin/index', $this->data);
	}
    
     public function stat_ajax()
	{  
	   $this->load->model('users_model', 'users');
       	$this->load->model('posts_model', 'posts');
        $this->load->model('cart_model', 'cart_m');
	   $data = array(
            'count_user' => $this->users->get_users_count_admin('client'),
            'count_product' => $this->posts->get_posts_count_admin('products'),
            'count_cart' => $this->cart_m->get_admin_cart_filter(array()), 
       );
	   return $this->output->set_content_type('application/json')->set_output(json_encode(array(@$data)));        
    }
    
    public function stat()
	{
        // News menu
	/*	$news = $this->posts->get_posts_count('news');
        $release = $this->posts->get_posts_count('release');
        $marquee = $this->posts->get_posts_count('marquee');
        $info = $this->posts->get_posts_count('info');
        $this->data['news_c']= $news + $release +  $marquee + $info;
        
        // img, doc,  etc
        $jpeg = count_files('image/jpeg'); 
        $png = count_files('image/png');  
        $this->data['img']= count($jpeg) + count($png);
        
        $pdf = count_files('application/pdf'); 
        $docx = count_files('application/vnd.openxmlformats-officedocument.wordprocessingml.document');   
        $doc = count_files('application/msword');     
        
        $this->data['doc_all']= count($pdf) + count($docx) + count($doc);
       
       // Меню
        $this->data['menu_s'] = $this->posts->get_posts_count('menu');
       // Страницы
       	$manage = $this->posts->get_posts_count('manage');
        $central = $this->posts->get_posts_count('central');
        $podrazdel = $this->posts->get_posts_count('podrazdel');
        $submission = $this->posts->get_posts_count('submission');
        
        $speech = $this->posts->get_posts_count('speech');
        $organizations = $this->posts->get_posts_count('organizations');
        $egovernment = $this->posts->get_posts_count('egovernment');
        $activity = $this->posts->get_posts_count('activity');
        
        $events= $this->posts->get_posts_count('events');
        $gazeta = $this->posts->get_posts_count('gazeta');
        $magazines = $this->posts->get_posts_count('magazines');
        $booklets = $this->posts->get_posts_count('booklets');
        
        $this->data['pages_count']= $manage + $central +  $podrazdel + $submission + $speech + $organizations + $egovernment + $activity + $events + $gazeta + $magazines + $booklets;
       
       // Статистика
       $obrashenie = $this->posts->get_posts_count('obrashenie');
        $comparative = $this->posts->get_posts_count('comparative');
        $report = $this->posts->get_posts_count('report');
        
        $this->data['stats_s']= $obrashenie + $comparative +  $report;
       
       // Законодательство
       
       $this->data['laws_s'] = $this->posts->get_posts_count('laws');
       
       // Открытые данные
       $this->data['opendata_s'] = $this->posts->get_posts_count('opendata');
       // Медиа
       
       $gallery = $this->posts->get_posts_count('gallery');
        $video = $this->posts->get_posts_count('video');
        $banner = $this->posts->get_posts_count('banner');
        $banner_1 = $this->posts->get_posts_count('banner_1');
        $this->data['media_c']= $gallery + $video +  $banner + $banner_1;
       
       // Объявления
        $this->data['advert_s'] = $this->posts->get_posts_count('advert');
       //  Вопросы и ответы 
       $faq1 = $this->faq->get_faq_id();
        $question1 = $this->posts->get_posts_count('question');
        $this->data['faq_s']= $faq1 + $question1;
       
		$this->data['body'] = 'admin/main/stat';
	    $this->load->view('admin/index', $this->data);*/
	}
}
