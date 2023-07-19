<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_city extends CI_Model {
    private $table_city = 'site_city';

    function __construct() {
        parent::__construct();
    }

    /*
     * Select data table from city	 * **/
    function city_get($id = 0) {
        if ($id > 0)
            $this -> db -> where('id_city', $id);
        $this -> db -> where('c_status', 'A');
        $data = $this -> db -> get($this -> table_city);
        return $data -> result_array();
    }
    
    function city_get2($id = 0) {
        if ($id > 0)
            $this -> db -> where('id_city', $id);
        $this -> db -> where('c_status', 'A');
        $data = $this -> db -> get($this -> table_city);
        return $data -> result();
    }
    
       public function get_list($args = null)
    {
      
      $defaults = array(
      'user_type' => '',
      'limit' => 10000,
      'offset' => 0,
      'order' => 'DESC',
      'orderby' => 'id_city',
            'region_id' => '',         
            
    );

    @$q = array_merge($defaults, $args);
    
    $this->db->select('site_city.*, site_regions.r_name')
		          ->join('site_regions', 'site_regions.id_regions = site_city.region_id', 'left');
      
        $this->db->where('c_status', 'A');
                 //->order_by('user_id DESC');
                   if ( !empty($q['orderby']) ){
      $this->db->order_by($q['orderby'], $q['order']);
      }
       if ( !empty($q['region_id']) ){
        $this->db->where_in('region_id', $q['region_id']);
       }
        return $this->db->get($this -> table_city, $q['limit'], $q['offset'])->result_array();
    }

    /*
     * Update data table city	 **/

    function city_update($id, $name, $title, $visible, $parent, $region_id) {

        $sql_data = array('c_name' => $name, //
        'title' => $title, //
            'c_visible' => $visible, //
            'c_status' => 'A', //
            'c_parent' => $parent,
            'region_id' => $region_id,
            'c_mod_date' => date("Y-m-d H:i:s"));

        $this -> db -> where('id_city', $id);
        $this -> db -> update($this -> table_city, $sql_data);

        return 0;
    }

    /*
     * Insert data to table city	 * **/
    function city_save($name, $title, $visible, $parent, $region_id) {

        $sql_data = array('c_name' => $name, //
        'title' => $title,
            'c_visible' => $visible, //
            'c_status' => 'A', //
            'c_parent' => $parent,
            'region_id' => $region_id,
            'c_mod_date' => date("Y-m-d H:i:s"));
        $this -> db -> insert($this -> table_city, $sql_data);
        $insertID = $this -> db -> insert_id();
        return $insertID;
    }

    function city_delete($id) {

        $sql_data = array('c_status' => 'D', //
            'c_mod_date' => date("Y-m-d H:i:s"));

        $this -> db -> where('id_city', $id);
        $this -> db -> update($this -> table_city, $sql_data);

        return 0;
    }

}

//* End of file modul_city.php */
