<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_model extends CI_Model
{
	function add($data)
	{
		$this->db->insert('reviews',$data);
        return $this->db->insert_id();
	}

	function get_reviews()
	{
		return $this->db->get('reviews')->result();
	}

	function delete($id)
	{
		$this->db->delete('reviews',array('id' => $id));
	}

	function update($id,$data)
	{
		$this->db->where('id',$id)
				 ->update('reviews',$data);
	}

	function get_single_review($id)
	{
		return $this->db->where('id',$id)
						->get('reviews')->row();
	}

	function get_active_reviews()
	{
		return $this->db->order_by('id','DESC')
						->get('reviews')->result();
	}
    function get_review_admin($limit, $offset)
	{
		 return $this->db->select('*')
                        ->order_by('id', 'desc')
                        ->get('reviews', $limit, $offset)
                        ->result();    
	}
    
     public function total_active()
    {
        return $this->db->where('active', '1')->count_all_results('reviews');
    }
    
     public function count_all()
    {
        return $this->db->count_all_results('reviews');
    }
    
    public function get_active($limit, $offset)
    {
        return $this->db->select('reviews.*')
        //->join('media', 'reviews.id = media.post_id AND media.is_main = \'1\'', 'left')
                        ->where('active', '1')
                        ->order_by('id', 'desc')
                        ->get('reviews', $limit, $offset)
                        ->result();    
    }
}