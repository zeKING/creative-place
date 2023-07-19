<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function get_category_main($args = null){
    $CI =& get_instance();
    $defaults = array(  
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',   
            'orderby' => 'id',  
            'status' => '',   
            'services_id' => '',   
		);

		$q = array_merge($defaults, $args);
        $CI->db->select('main_category.*')->group_by('main_category.id');
        
        if(!empty($q['status']))
            $CI->db->where('main_category.status', $q['status']);           
         
        if ( !empty($q['services_id']) )
        $CI->db->where_in('main_category.services_id', $q['services_id']);
      
    
		if ( !empty($q['orderby']) )
			$CI->db->order_by($q['orderby'], $q['order']);


		return $CI->db->get('main_category', $q['limit'], $q['offset'])->result();
}

function getMain_category_count($id)
{
	$CI =& get_instance();
    $post = $CI->db->get_where('main_category', array('id'=>$id))->row();   	

      

  $sql = "SELECT
  COUNT(*) AS `count`
  FROM category AS p 
  WHERE p.main_id = '".$id."'
  AND p.status = 'active'";
  $count = $CI->db->query($sql)->row('count');
  
  return array($post, $count);
}

  function getGroups_count($id, $groups) {
	            
    $CI =& get_instance();
    $CI->db->like('post_id', $id);
    $CI->db->where_in('groups', $groups);
    $CI->db->from('specialty');  
    return $CI->db->count_all_results();

	}
   
     function countCategorySpec($id, $field, $groups) {
	            
    $CI =& get_instance();
    $CI->db->where($field, $id);
    $CI->db->like('groups', $groups);
    $CI->db->where_in('status', 'active');
    $CI->db->from('specialty');  
    return $CI->db->count_all_results();

	}

?>