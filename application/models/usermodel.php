<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usermodel
 *
 * @author Evilnames
 */
class usermodel extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Select a user from the db
    public function trylogin($data) {

        //Get the information
        $this->db->where($data);
        $this->db->from('jguser');

        //Return the Query
        $query = $this->db->get();
        return $query->result_array();
    }

    //Add a user to the db
    public function newUser($data) {
        $this->db->insert('jguser', $data);
    }

    //Get dashboard items
    public function getDashboardLinks($userLevel) {
        $this->db->where('userlevel <=', $userLevel);
        $this->db->from('dashboard');

        //Return the Query
        $query = $this->db->get();
        return $query->result_array();
    }

    //Updates a password based on username
    public function savepassword($pass, $user) {
        $data = array(
            'Password' => $pass
        );

        $this->db->where('Username', $user);
        $this->db->update('jguser', $data);
    }

}

?>
