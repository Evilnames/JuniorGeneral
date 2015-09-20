<?php

class nations extends CI_Controller{

    //@@Controller
    public function __construct() {
        parent::__construct();
        //Check user and define if it exists
        $this->jgsecurity->usercheck();
    }

    //A List of Items
    public function index(){
        
        //Load the view
        $this->load->view('header/head');
        $this->load->view('nations/comingsoon');
        $this->load->view('header/foot');
        
    }
    
}

?>
