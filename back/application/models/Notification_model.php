<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model
{

    public function get_list($args = null)
    {
        $defaults = array(
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'created_on',
            'user_id'=> '',

        );

        $q = array_merge($defaults, $args);
        $this->db->select('*');
        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);


        if ( !empty($q['user_id']) )
            $this->db->where('user_id', $q['user_id']);


        return $this->db->get('notification', $q['limit'], $q['offset'])->result();
    }


    public function get($contact_id)
    {
        return $this->db->get_where('notification', array('id'=>$contact_id))->row();
    }


    public function update($data, $id)
    {
        if ($id)
        {
            $this->db->where('id', $id)
                ->update('notification', $data);
        }

    }
    public function delete($contact_id)
    {
        $this->db->delete('notification', array('id'=>$contact_id));
    }

    public function count_all_с($id){
        $this->db->from('notification')
            ->where('user_id', $id);

        return $this->db->count_all_results();
    }

}