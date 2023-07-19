<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency_model extends CI_Model
{
	function add($data)
	{
		$this->db->insert('currency',$data);
        return $this->db->insert_id();
	}

	function get_currency()
	{
		return $this->db->get('currency')->result();
	}
    
    public function get_count_currency() {
        /*$this->db->where('user_tariff.user_t_id', $user_id);
        $this->db->where('user_tariff.status_t', $status);*/
        $this->db->from('currency');        
        return $this->db->count_all_results();
    }
    
    public function getCurrency($args = null)
    {
      
      $defaults = array(
			'id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',     
            'status' => 'active'
		);

	@$q = array_merge($defaults, (array)$args);
      
       // $this->db->where('post_id', $q['post_id']);
                 //->order_by('user_id DESC');
            if(!empty($q['status']))
            $this->db->where('currency.status', $q['status']);
                 
              
            if ( !empty($q['orderby']) ){
			$this->db->order_by($q['orderby'], $q['order']);
      }
        return $this->db->get('currency', $q['limit'], $q['offset'])->result();
    }
    
	/*function delete($id)
	{
		$this->db->delete('currency',array('id' => $id));
	}*/

	function save($id,$data)
	{
		$this->db->where('id',$id)
				 ->update('currency',$data);
	}

	function get_single_currency($id)
	{
		return $this->db->where('id',$id)
						->get('currency')->row();
	}

	function get_active_currency()
	{
		return $this->db->order_by('id','DESC')
						->get('currency')->result();
	}
    function get_currency_admin($limit, $offset)
	{
		 return $this->db->select('*')
                        ->order_by('id', 'desc')
                        ->get('currency', $limit, $offset)
                        ->result();    
	}
    
     public function total_active()
    {
        return $this->db->where('active', '1')->count_all_results('currency');
    }
    
    public function get_active($limit, $offset)
    {
        return $this->db->select('currency.*, media.url')->join('media', 'currency.id = media.post_id AND media.is_main = \'1\'', 'left')
                        //->where('active', '1')
                        ->order_by('id', 'desc')
                        ->get('currency', $limit, $offset)
                        ->result();    
    }
}