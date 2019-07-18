<?php

class linkmodel extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getLinkList(){
        $this->db->from('links');
        $this->db->order_by('category, title', 'asc');

        $query = $this->db->get();
        return $query->result_array();
    }

    //Save a new link to the database
    public function saveLink($data){
        $this->db->insert('links', $data);
    }
}
?>