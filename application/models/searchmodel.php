<?php

class searchmodel extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Adds values to the search engine
    public function addSearch($data) {
        $this->db->insert('search_keys', $data);
    }

    //@@Looks up a key and gives a list of UID's and results.
    public function getKeySearch($key) {
        $query = $this->db->query("select count(SID) as num, UID from search_keys where Text like '%" . $key . "%' group by UID");

        //Return the Query
        return $query->result_array();
    }

}

?>
