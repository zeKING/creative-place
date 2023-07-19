<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works_model extends CI_Model
{
    public function get_posts_p($args = null)
    {
        $defaults = array(

            'id' => '',
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'title' => '',
        );

        $q = array_merge($defaults, $args);


        $this->db->select('works.*')->group_by('works.id');




        if ( !empty($q['id']) )
            $this->db->where_in('works.id', $q['id']);
        if (!empty($q['tags'])) {
            $this->db->where('find_in_set("'.(int)$q['tags'].'", works.tags)');
            //  $this->db->where('posts.tags', $q['tags']);

        }
        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);


        if ( !empty($q['title']) ){
            $this->db->like('works.name', $q['title']);
            $this->db->or_like('works.message',$q['title']);
        }
        $this->db->where('works.status', 'active');

        return $this->db->get('works', $q['limit'], $q['offset'])->result();
    }
    public function get_posts_t($tag)
    {

        $this->db->where_in('works.tag_id', $tag);

        $this->db->where('works.status', 'active');

        return $this->db->get('works')->result();
    }
    public function get_posts_tag($word)
    {







        $this->db->like('posts.title', $word);


        $this->db->where('posts.status', 'active');

        return $this->db->get('posts')->result();
    }

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
        if ( !empty($q['orderby']) ) {
            $this->db->order_by($q['orderby'], $q['order']);
        }


        if ( !empty($q['user_id']) ) {
            $this->db->where('user_id', $q['user_id']);
        }
        if ( !empty($q['tag_id']) ) {
            $this->db->where('tag_id', $q['tag_id']);
        }
        $this->db->where('status', 'active');

        return $this->db->get('works', $q['limit'], $q['offset'])->result();
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

        return $this->db->get('works', $q['limit'], $q['offset'])->result();
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

        return $this->db->get('works', $q['limit'], $q['offset'])->result();
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

        return $this->db->get('works', $q['limit'], $q['offset'])->result();
    }

    public function get($contact_id)
    {
        return $this->db->get_where('works', array('id'=>$contact_id))->row();
    }
    public function getMyWorks($contact_id)
    {
        return $this->db->get_where('works', array('user_id'=>$contact_id))->row();
    }

    public function get_history_works($contact_id, $contact)
    {
        $this->db->where('contact_id !=', $contact_id)
            ->where('email', $contact->email);

        return $this->db->get('works')->result();
    }

    public function save($data)
    {
        $this->db->insert('works', $data);
        return $this->db->insert_id();
    }
    public function save_notification($data)
    {
        $this->db->insert('notification', $data);
    }
    public function save2($data, $user_id)
    {
        if($user_id){
            $this->db->where('id', $user_id)
                ->update('works', $data);
        }

    }

    public function delete($contact_id)
    {
        $this->db->delete('works', array('id'=>$contact_id));
    }

    public function count_all_с(){
        return $this->db->count_all('works');
    }
    public function count_all_s(){
        $this->db->from('works')
            ->where('status_slider', 'yes')
            ->where('status', 'active');

        return $this->db->count_all_results();
    }
    public function count_all_w(){
        $this->db->from('works')
            ->where('status', 'active');

        return $this->db->count_all_results();
    }
    public function count_all_h(){
        $this->db->from('works')
            ->where('status_home', 'yes')
            ->where('status', 'active');

        return $this->db->count_all_results();
    }
    public function count_my_с($id){
        $this->db->from('works')
            ->where('status', 'active')
            ->where('user_id', $id);

        return $this->db->count_all_results();
    }
    public function get_count_work($id){
        $this->db->from('works')
            ->where('status', 'active')
            ->where('tag_id', $id);

        return $this->db->count_all_results();
    }

}