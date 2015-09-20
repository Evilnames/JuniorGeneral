<?php

class scenariomodel extends CI_Model{

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Inserts into the scenario table.
    public function newScenario($data){
        $this->db->insert('scenario', $data);
    }
    
    //@@Returns all things from the scenario table
    public function getScenario(){
        $this->db->from('scenario');
        $this->db->order_by('year');
        
        //Return Query Information
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //@@Returns the newest scenarios in the system
        public function lastcreated($amt) {

        $this->db->order_by('createdate', 'desc');
        
        //Return Query Information
        $query = $this->db->get('scenario', $amt);
        return $query->result_array();
    }
    
    
}

?>
