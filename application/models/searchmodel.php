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

    public function logSearch($key, $resultCount){
        $SQL = "insert into search_history(search_term, result_count) values(?, ?)";
        $query = $this->db->query($SQL, array($key, $resultCount));
        return 'ok';
    }

    //@@Looks up a key and gives a list of UID's and results.
    public function getKeySearch($key) {
        $SQL = "select count(SID) as num, UID from search_keys where Text like '%".$key."%' group by UID";
        $query = $this->db->query($SQL);
        
        //Return the Query
        return $query->result_array();
    }

}

?>
