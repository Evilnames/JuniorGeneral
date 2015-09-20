<?php

class landing extends CI_Controller{

    //@@Controller
    public function __construct() {
        parent::__construct();
        
        //Check user and define if it exists
        $this->jgsecurity->usercheck();
    }

    //@@Main landing page
    public function index(){
        
        $this->load->model('figuremodel');
        $data['figure'] = $this->figuremodel->newfigures(10);
        
        $this->load->model('scenariomodel');
        $data['scenario'] = $this->scenariomodel->lastcreated(10);
        
        $this->load->model('articlemodel');
        $data['articles'] = $this->articlemodel->getNewArticles(10);
        
        //Load the view
        $this->load->view('header/head');
        $this->load->view('home/landing', $data);
        $this->load->view('header/foot');
    }
 
    
}

?>
