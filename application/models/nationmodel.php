<?php

class nationmodel extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Gets a list of universes
    public function getUniverse(){
        $this->db->from('universe');
        $this->db->order_by('category, title', 'asc');

        $query = $this->db->get();
        return $query->result_array();
    }


}
?>