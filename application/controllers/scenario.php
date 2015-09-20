<?php

class scenario extends CI_Controller{
    
    //@@Controller
    public function __construct() {
        parent::__construct();
        //Check user and define if it exists
        $this->jgsecurity->usercheck();
    }

    //A List of Items
    public function index(){
        //Load the models
        $this->load->model('scenariomodel');
        $this->load->model('figuremodel');
        
        //Get a list of categories
        $category = $this->figuremodel->getMasterCatAll();
        
        //Look through each category
        foreach($category as $i=>$vVal):
            $category[$i]['keys'] = array();
        endforeach;
        
        //Get a list of all scenarios
        $scenario = $this->scenariomodel->getScenario();
        
        //Map scenarios to categorys
        foreach($scenario as $s=>$value):
            array_push($category[$value['CategoryID']]['keys'], $s);
        endforeach;
        
        //If there are no keys associated remove it from the array
        foreach($category as $i=>$vVal):
            if(sizeof($vVal['keys']) == 0):
                unset($category[$i]);
            endif;
        endforeach;
        
        $data['cat'] = $category;
        $data['scenario'] = $scenario;
        
        //Load the view
        $this->load->view('header/head');
        $this->load->view('scenario/list', $data);
        $this->load->view('header/foot');
        
    }
    
}

?>
