<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favourite_model extends CI_Model
{

    public function get_list($args = null)
    {
        $defaults = array(
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'created_on',
            'user_id'=> '',
            'tag_id'=> '',

        );

        $q = array_merge($defaults, $args);
        $this->db->select('*');
        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);


        if ( !empty($q['user_id']) )
            $this->db->where('user_id', $q['user_id']);
        if ( !empty($q['tag_id']) )
            $this->db->where('tag_id', $q['tag_id']);
        $this->db->where('status', 'active');

        return $this->db->get('favourite', $q['limit'], $q['offset'])->result();
    }
    public function get_list_home($args = null)
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
        $this->db->where('status', 'active');
        $this->db->where('status_home', 'yes');

        return $this->db->get('favourite', $q['limit'], $q['offset'])->result();
    }
    public function get_list_work($args = null)
    {
        $defaults = array(
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'created_on',
            'user_id'=> '',
            'tag_id'=> '',

        );

        $q = array_merge($defaults, $args);
        $this->db->select('*');
        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);
        if ( !empty($q['tag_id']) )
            $this->db->where('tag_id', $q['tag_id']);
        $this->db->where('status', 'active');

        return $this->db->get('favourite', $q['limit'], $q['offset'])->result();
    }
    public function get_list_slider($args = null)
    {
        $defaults = array(
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'created_on',


        );

        $q = array_merge($defaults, $args);
        $this->db->select('*');
        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        $this->db->where('status', 'active');
        $this->db->where('status_slider', 'yes');

        return $this->db->get('favourite', $q['limit'], $q['offset'])->result();
    }

    public function get($contact_id)
    {
        return $this->db->get_where('favourite', array('id'=>$contact_id))->row();
    }
    public function get_user($contact_id)
    {
        return $this->db->get_where('favourite', array('user_id'=>$contact_id))->result();
    }



    public function save($data)
    {
        $this->db->insert('favourite', $data);
        return $this->db->insert_id();
    }


    public function delete($work_id, $user_id)
    {
       $this->db->delete('favourite', array('work_id'=>$work_id, 'user_id'=>$user_id));
    }

    public function count_all_с(){
        return $this->db->count_all('favourite');
    }
    public function count_all_s(){
        $this->db->from('favourite')
            ->where('status_slider', 'yes')
            ->where('status', 'active');

        return $this->db->count_all_results();
    }
    public function count_all_w(){
        $this->db->from('favourite')
            ->where('status', 'active');

        return $this->db->count_all_results();
    }
    public function count_all_h(){
        $this->db->from('favourite')
            ->where('status_home', 'yes')
            ->where('status', 'active');

        return $this->db->count_all_results();
    }
    public function count_my_с($id){
        $this->db->from('favourite')
            ->where('status', 'active')
            ->where('user_id', $id);

        return $this->db->count_all_results();
    }
    public function get_count_work($id){
        $this->db->from('favourite')
            ->where('status', 'active')
            ->where('tag_id', $id);

        return $this->db->count_all_results();
    }

}