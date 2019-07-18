<?php

class links extends CI_Controller {

    //@@Controller
    public function __construct() {
        parent::__construct();
        //Check user and define if it exists
        $this->jgsecurity->usercheck();
    }

    public function index(){

        //Load the Model
        $this->load->model('linkmodel');

        //Lookup 
        $links = $this->linkmodel->getLinkList();
        $ret = array();
        foreach($links as $i => $link){
            if(!array_key_exists($link['category'], $ret)){
                $ret[$link['category']] = array();
            }

            array_push($ret[$link['category']], $link);
        }

        $data['list'] = $ret;

        //Load the view
        $this->load->view('header/head');
        $this->load->view('link/viewLinkList', $data);
        $this->load->view('header/foot');

    }


}