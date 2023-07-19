<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Menu_model extends CI_Model
{
    
          /* Menu Full */
          public function getMenuTreesMainFull() {
            $this->db->select('posts.*')
              // ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
               ->where('group','menu')
               ->where('status','active')
               ->where('status_lang_'.LANG, 'active')
               ->order_by('sort_order', 'ASC');
           $items = $this->db->get('posts')->result();
           $cats = array();
           if (count($items) > 0) {
               foreach ($items as $cat) {
                   $cats[$cat->category_id][] = $cat;
               }
           }
           return $trees = $this->buildTreeMainFull($cats,0);
       }
       public function buildTreeMainFull($cats, $parent_id, &$k = 0) {  
               if (is_array($cats) && isset($cats[$parent_id])) {
               $k++;
               if ($k > 3) { $k = 3; }
               
               if ($k == 1){ 
                 $tree = ' <ul class="accordion">'.'';
               }                                        
               else { 
                   $tree = '<ul class="inner">'; 
               }
               $count = 1; foreach($cats[$parent_id] as $cat) {
                   $title = unserialize($cat->title);
                   $sub = countSubMenu('menu', $cat->id, LANG); //getOptionsData(array('group' => 'menu', 'media' => 'inactive', 'status_lang_'.LANG => 'active', 'category_id' => $cat->id, 'order' => 'ASC', 'status' => 'active'));
                   $icon_menu = ($sub) ? '' : '' ;
                   $nav_link = ($sub) ? 'nav-link' : '' ;
                   $no_link = ($sub) ? 'no-link' : '' ;
                   
                   $nav_sub = ($sub) ? 'nav-submenu' : '' ;
                   //<i class="fa fa-chevron-down" aria-hidden="true"></i>
                   /* if($cat->category_id == 13 || $cat->category_id == 7){
                       if($cat->category_id == 13){
                         $link1 = site_url('manage/'.$cat->alias);
                       }
                        if($cat->category_id == 7){
                         $link1 = site_url('news/category/'.$cat->alias);
                       }
                       
                      
                       $toggleClass = ($sub) ? 'toggle' : '';
                   }else{*/
                       if($cat->options){
                        $link1 = ($sub) ? 'javascript:void(0);' : site_url($cat->options);
                       }elseif($cat->option_2){
                        $link1 = ($sub) ? 'javascript:void(0);' : site_url($cat->option_2);
                       }else {
                           $link1 = ($sub) ? 'javascript:void(0);' : site_url('menu/'.$cat->alias);
                       }
                       $toggleClass = ($sub) ? 'toggle' : '';
                  // }
                                    
                   if ($cat->category_id == 0) {
                       // folow code works when menu is from main
                    
                         $link = '<li class="'.$nav_sub.'"><a class="'.$toggleClass.'" href="'.$link1.'">'.@$title[LANG].$icon_menu.'</a>';
                       
                       
                   }  else {            
                              
                        
                         $link = '<li class="'.$nav_sub.'"><a class="'.$toggleClass.'" href="'.$link1.'">'.@$title[LANG].'</a>';
                       
                       
                         //}
                       // folow code works when menu is from sub menu
                   }
                   $tree .= $link;
                   $tree .= $this->buildTreeMainFull($cats, $cat->id, $k);
                   //$tree .= '<li class="border"></li>';
               $count++; } 
               $tree .= '</ul>';
               if($parent_id !== 0) $tree .= '';
           }
           else {
               return null;
           }
           return $tree;
         
       }
          /* Menu Mobile */
    public function getMenuTreesMainMobile() {
         $this->db->select('posts.*')
           // ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->where('group','menu')
            ->where('status','active')
            ->where('status_lang_'.LANG, 'active')
            ->order_by('sort_order', 'ASC');
        $items = $this->db->get('posts')->result();
        $cats = array();
        if (count($items) > 0) {
            foreach ($items as $cat) {
                $cats[$cat->category_id][] = $cat;
            }
        }
        return $trees = $this->buildTreeMainMobile($cats,0);
    }
    public function buildTreeMainMobile($cats, $parent_id, &$k = 0) {  
            if (is_array($cats) && isset($cats[$parent_id])) {
            $k++;
            if ($k > 3) { $k = 3; }
            
            if ($k == 1){ $tree = ' <ul>'.'';
            
                                             
            }                                        
            else { 
                
                $tree = '<ul>'; 
            }
            $count = 1; foreach($cats[$parent_id] as $cat) {
                $title = unserialize($cat->title);
                $sub = countSubMenu('menu', $cat->id, LANG); //getOptionsData(array('group' => 'menu', 'media' => 'inactive', 'status_lang_'.LANG => 'active', 'category_id' => $cat->id, 'order' => 'ASC', 'status' => 'active'));
                $icon_menu = ($sub) ? '' : '' ;
                $nav_link = ($sub) ? 'nav-link' : '' ;
                $no_link = ($sub) ? 'no-link' : '' ;
                
                $nav_sub = ($sub) ? 'nav-submenu' : '' ;
                //<i class="fa fa-chevron-down" aria-hidden="true"></i>
             
                   /* if($cat->category_id == 13 || $cat->category_id == 7){
                       if($cat->category_id == 13){
                         $link1 = site_url('manage/'.$cat->alias);
                       }
                        if($cat->category_id == 7){
                         $link1 = site_url('news/category/'.$cat->alias);
                       }
                      
                    }else{*/
                        if($cat->options){
                        $link1 = site_url($cat->options);
                        }elseif($cat->option_2){
                        $link1 = $cat->option_2;
                        }else {
                            $link1 = site_url('menu/'.$cat->alias);
                        }
                    //}
                                 
                if ($cat->category_id == 0) {
                    // folow code works when menu is from main
                  
                      $link = '<li class="'.$nav_sub.'"><a class="'.$nav_link.' '.$no_link.'" href="'.$link1.'">'.@$title[LANG].$icon_menu.'</a>';
                    
                    
                }  else {            
                       
                      $link = '<li class="'.$nav_sub.'"><a href="'.$link1.'">'.@$title[LANG].'</a>';
                    
                    
                      //}
                    // folow code works when menu is from sub menu
                }
                $tree .= $link;
                $tree .= $this->buildTreeMainMobile($cats, $cat->id, $k);
                //$tree .= '<li class="border"></li>';
            $count++; } 
            $tree .= '</ul>';
            if($parent_id !== 0) $tree .= '';
        }
        else {
            return null;
        }
        return $tree;
      
    }
/* Menu */
    public function getMenuTreesMain() {
      $this->db->select('posts.*')
        //  ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
          ->where('group','menu')
          ->where('status','active')
          ->where('status_lang_'.LANG, 'active')
        // ->limit(4, 0)
         // ->like('option','yes')
          ->order_by('sort_order', 'ASC');
      $items = $this->db->get('posts')->result();
      $cats = array();
      if (count($items) > 0) {
          foreach ($items as $cat) {
              $cats[$cat->category_id][] = $cat;
          }
      }
      return $trees = $this->buildTreeMain($cats,0);
    }
     public function buildTreeMain($cats, $parent_id, &$k = 0) {
           /* $this->db->select('posts.*, media.url')
            ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->where('group','directions')           
            ->where('status','active')
            ->order_by('id', 'ASC');                      
          $col = array();
          $col = $this->db->get('posts', '7', '0')->result();*/
          //var_dump($col);
        if (is_array($cats) && isset($cats[$parent_id])) {
            $k++;
            if ($k > 3) { $k = 3; }
            //'.(($sel=='home')?'active':'').'
            // <li class="current_page_item dropdown"><a href="'.base_url().'">'.lang('home').'</a></li>
            // .'<li class="current_page_item dropdown"><a href="'.base_url().'">'.lang('home').'</a></li>'.'<li class="current_page_item dropdown"><a href="'.base_url().'">'.lang('home').'</a></li>'
            if ($k == 1){ $tree = ' <ul class="nav navbar-nav" id="main-menu">';
            // if ($k == 1) $tree = '<ul id="menu">';
                                             
            }                                        
            else { 
                
                $tree = '<ul class="dropdown-menu ">'; 
            }
            $count = 1; foreach($cats[$parent_id] as $cat) {
                $title = unserialize($cat->title);
                $sub = countSubMenu('menu', $cat->id, LANG);//getOptionsData(array('group' => 'menu', 'media' => 'inactive', 'status_lang_'.LANG => 'active', 'category_id' => $cat->id, 'order' => 'ASC', 'status' => 'active'));
                
                // fa fa-angle-down
                $icon_menu = ($sub) ? '<i class="fa fa-angle-down" aria-hidden="true"></i>' : '' ;
                $nav_link = ($sub) ? 'nav-link' : 'nav-link' ;
                $no_link = ($sub) ? 'no-link' : '' ;
              //  if($cat->category_id == 2){
                 //   $link1 = site_url('catalog/category/'.getPosts($cat->id, 'alias'));
                  
               // }else{
                    /* if($cat->category_id == 13 || $cat->category_id == 7){
                       if($cat->category_id == 13){
                         $link1 = site_url('manage/'.$cat->alias);
                       }
                        if($cat->category_id == 7){
                         $link1 = site_url('news/category/'.$cat->alias);
                       }
                      
                    }else{*/
                        if($cat->options){
                        $link1 = site_url($cat->options);
                        }elseif($cat->option_2){
                        $link1 = $cat->option_2;
                        }else {
                            $link1 = site_url('menu/'.$cat->alias);
                        }
                  //  }
                
                    //***//
                    /*
                     if($cat->options){
                    $link1 = ($sub) ? site_url('#'):site_url($cat->options);
                    }elseif($cat->option_2){
                    $link1 = site_url($cat->option_2);
                    }else {
                        $link1 = ($sub) ? site_url('#'):site_url('menu/'.$cat->alias);
                    }
                    */
                //}

                
                if ($cat->category_id == 0) {           
               
                      $link = '<li class="dropdown nav-item"><a class="dropdown-toggle1  '.$no_link.' '.$nav_link.'" href="'.$link1.'">'.@$title[LANG].$icon_menu.'</a>';
                                       
                   // }
                }  else {
                    /*if($cat->id == 402){
                        foreach($col as $item){
                          if($item->status_cat == 'active'){
                            $link = '<li class="dropdown"><a href="'.site_url('product/subcategory/'.$item->alias).'">'.@_t($item->title, LANG).'</a>';
                          } else {
                            $link = '<li class="dropdown"><a href="'.site_url('product/category/'.$item->alias).'">'.@_t($item->title, LANG).'</a>';
                          }
                        }*/
                     // } else {
                     $sub1 = ''; //getOptionsData(array('group' => 'menu', 'category_id' => $cat->id, 'order' => 'ASC', 'status' => 'active'));
                $icon_menu1 = ($sub) ? '<i class="fa fa-angle-right" aria-hidden="true"></i>' : '' ;
                
                      $link = '<li class="dropdown nav-item-2"><a class="dropdown-item" href="'.$link1.'">'.@$title[LANG].$icon_menu1.'</a>';
                    
                    
                      //}
                    // folow code works when menu is from sub menu
                }
                $tree .= $link;
                $tree .= $this->buildTreeMain($cats, $cat->id, $k);
                //$tree .= '<li class="border"></li>';
            $count++; } 
            $tree .= '</ul>';
            if($parent_id !== 0) $tree .= '';
            /*if ($k == 1){
                $tree .='<li>
                            <a href="#" class="header-search-button  search-toggle"><i class="icons icon-magnifying-glass"></i></a>
                        </li>';
            }*/
        }
        else {
            return null;
        }
        return $tree;
    }
    /* Menu */
    public function getMenuSiteMap() {
        $this->db->select('posts.*')
          //  ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->where('group','menu')
            ->where('status','active')
            ->where('status_lang_'.LANG, 'active')
            ->order_by('sort_order', 'ASC');
        $items = $this->db->get('posts')->result();
        $cats = array();
        if (count($items) > 0) {
            foreach ($items as $cat) {
                $cats[$cat->category_id][] = $cat;
            }
        }
        return $trees = $this->buildMenuSiteMap($cats,0);
    }
     public function buildMenuSiteMap($cats, $parent_id, &$k = 0) {
        /*$this->db->select('posts.*, media.url')
            ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->where('group','directions')           
            ->where('status','active')
            ->order_by('id', 'ASC');                      
          $col = array();
          $col = $this->db->get('posts', '7', '0')->result();*/
          //var_dump($col);
        if (is_array($cats) && isset($cats[$parent_id])) {
            $k++;
            if ($k > 3) { $k = 3; }
            if ($k == 1) $tree = ' <ul id="nav-sitemap"><li><a href="'.base_url().'">'.lang('home').'</a></li>';
            // if ($k == 1) $tree = '<ul id="menu">';
            else { $tree = '<ul class="dropdown-menu-sitemap">'; 
            }
            $count = 1; foreach($cats[$parent_id] as $cat) {
                $title = unserialize($cat->title);
                if ($cat->category_id == 0) {
                    // folow code works when menu is from main
                    /*if($cat->as_menu == 1) {
                    if($cat->options){
                    $link = '<li class="dropdown"><a href="'.site_url($cat->options).'">'.@$title[LANG].'</a>';
                    } else {
                      $link = '<li class="dropdown"><a href="'.site_url('menu/'.$cat->alias).'">'.@$title[LANG].'</a>';
                    }
                    } else */{
                      if($cat->options){
                    $link = '<li class="dropdown-sitemap"><a  href="'.site_url($cat->options).'">'.@$title[LANG].'</a>';
                    } else {
                      $link = '<li class="dropdown-sitemap"><a href="'.site_url('menu/'.$cat->alias).'">'.@$title[LANG].'</a>';
                    }
                    }
                }  else {
                    /*if($cat->id == 402){
                        foreach($col as $item){
                          if($item->status_cat == 'active'){
                            $link = '<li class="dropdown"><a href="'.site_url('product/subcategory/'.$item->alias).'">'.@_t($item->title, LANG).'</a>';
                          } else {
                            $link = '<li class="dropdown"><a href="'.site_url('product/category/'.$item->alias).'">'.@_t($item->title, LANG).'</a>';
                          }
                        }*/
                     // } else {
                           if($cat->options){
                    $link = '<li><a href="'.site_url($cat->options).'">'.@$title[LANG].'</a>';
                    } else {
                      /*if($cat->category_id == 2){
                       $link = '<li><a href="'.site_url('customer-service/'.$cat->alias).'">'.@$title[LANG].'</a>';
                       } elseif($cat->category_id == 3){
                        $link = '<li><a href="'.site_url('about/'.$cat->alias).'">'.@$title[LANG].'</a>';
                       }else{*/
                        $link = '<li><a href="'.site_url('menu/'.$cat->alias).'">'.@$title[LANG].'</a>';
                       //}
                    }
                      //}
                    // folow code works when menu is from sub menu
                }
                $tree .= $link;
                $tree .= $this->buildMenuSiteMap($cats, $cat->id, $k);
                $tree .= '';
            $count++; } 
            $tree .= '</ul>';
            if($parent_id !== 0) $tree .= '';
        }
        else {
            return null;
        }
        return $tree;
    }
}