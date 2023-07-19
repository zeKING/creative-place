<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Site_model extends CI_Model
{
	public function get($id, $status = false) {
		$this->db->select('site.*')
		         //->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
		         //->join('categories', 'site.category_id = categories.category_id', 'left')
		         ->where('site.id', $id);
        if($status)
            $this->db->where('site.status', $status);

		return $this->db->get('site')->row();
	}
    
    	public function get_site_off($args = null)
	{
		$defaults = array(
            'group' => 'video',
            'category_ids' => array(),
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'id',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'site_off' => '',
            'category_direction' => ''            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('site.*')
				 //->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
				 //->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->where('site.group', $q['group'])
                 ->where('site.site_off', $q['site_off'])
				 ->group_by('site.id');

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		return $this->db->get('site', $q['limit'], $q['offset'])->result();
	}


	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('site', $data);
		}
		else
		{
			$this->db->insert('site', $data);

			return $this->db->insert_id();
		}
	}

}
?>