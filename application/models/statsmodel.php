<?php

class statsmodel extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function topDesigners(){
        $SQL = "select count(UID) as Submitted, Designer from figures where void = 0 and approved = 1 and title != '' and Designer != '' group by designer order by count(UID) Desc";
        $query = $this->db->query($SQL);

        //Return the Query
        return $query->result_array();
    }

}