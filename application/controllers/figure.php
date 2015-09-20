<?php

class figure extends CI_Controller {

    //@@Controller
    public function __construct() {
        parent::__construct();
        //Check user and define if it exists
        $this->jgsecurity->usercheck();
    }

    //@@Load a single figure.
    public function view($URL) {

        //Load the Model
        $this->load->model('figuremodel');

        //Lookup 
        $set = $this->figuremodel->getFigure($URL);
        $data['iFig'] = $set[0];

        //Load the view
        $this->load->view('header/head');
        $this->load->view('figure/view', $data);
        $this->load->view('header/foot');
    }

    public function figureList($URL) {
        //Load the Model
        $this->load->model('figuremodel');

        //Lookup Data
        $set = $this->figuremodel->getMasterCat($URL);
        $periodID = $set[0]['PeriodID'];

        //Get all subcategories linked to this category
        $subCatList = $this->figuremodel->getSubCategory($periodID);
        //var_dump($subCatList);
        //Get all the correct figures for this time period
        $data['figList'] = $this->figuremodel->getAllFromTimePeriod($periodID);

        $itemList = array();
        //Match Sub Categories to Figures
        foreach ($subCatList as $i => $value) {

            $itemList[$value['Subcatagory']] = array();
            array_push($itemList[$value['Subcatagory']], $value);

            $itemList[$value['Subcatagory']]['figureList'] = array();
        }

        //Associate the locations.
        foreach ($data['figList'] as $z => $zVal):
            //Assign this to the correct id
            if (array_key_exists($zVal['SubPeriod'], $itemList)):
                array_push($itemList[$zVal['SubPeriod']]['figureList'], $zVal);
            endif;
        endforeach;

        //Roll the data package.
        $data['items'] = $itemList;
        $data['masterData'] = $set;

        //Load the view
        $this->load->view('header/head');
        $this->load->view('figure/figureList', $data);
        $this->load->view('header/foot');
    }

   //Shows a list of figures.
    public function showMoreFigures($count=100){
        
        $this->load->model('figuremodel');
        $data['figure'] = $this->figuremodel->newfigures($count);
        $data['lookupCount'] = $count;
        
        
        //Load the view
        $this->load->view('header/head');
        $this->load->view('figure/showMoreFigures', $data);
        $this->load->view('header/foot');
        
    }
    
    
    //@@Updates the URLs for the database This is a translation thing only
    public function updateURLs() {
        $this->load->model('figuremodel');

        $used = array();
        
        $set = $this->figuremodel->allFigures();
        foreach ($set as $i => $value):
            $url = $value['Title'];
            $url = str_replace(' ', '', $url);
            $url = str_replace(',', '', $url);
            $url = str_replace('/', '', $url);
            $url = str_replace('-', '', $url);
            $url = str_replace('@', '', $url);
            $url = str_replace('_', '', $url);
            $url = str_replace('&', '', $url);
            $url = str_replace('#', '', $url);
            $url = str_replace('\'', '', $url);
            $url = str_replace(':', '', $url);
            $url = str_replace('(', '', $url);
            $url = str_replace(')', '', $url);
            $url = str_replace('"', '', $url);
            
            if(in_array($url, $used)):
                $url .= rand(1,1000);
            endif;
            
            array_push($used, $url);
            $this->figuremodel->updateUID($value['UID'], $url);
        endforeach;
    }

    public function updateCatURL() {
        $this->load->model('figuremodel');

        $set = $this->figuremodel->allCategories();
        foreach ($set as $i => $value):
            $url = $value['categoryTitle'];
            $url = str_replace(' ', '', $url);
            $url = str_replace(',', '', $url);
            $url = str_replace('/', '', $url);
            $url = str_replace('-', '', $url);
            $url = str_replace('@', '', $url);
            $url = str_replace('_', '', $url);
            $url = str_replace('&', '', $url);
            $url = str_replace('#', '', $url);
            $url = str_replace('(', '', $url);
            $url = str_replace(')', '', $url);

            $this->figuremodel->updatePeriod($value['PeriodID'], $value['Subcatagory'], $url);
        endforeach;
    }

    //Looks for duplicates.
    public function fixDuplicateURL() {
        $this->load->model('figuremodel');

        $set = $this->figuremodel->allFigures();
        foreach ($set as $i => $value):
            $url = $value['url'];
            $newURL = $url;
            foreach ($set as $x => $xVal):
                $urlb = $xVal['url'];
                if (strtolower($url) == strtolower($urlb)):
                    $newURL = $url . rand(1,10000);
                endif;
            endforeach;

            if ($url != $newURL):
                $this->figuremodel->updateUID($value['UID'], $url);
            endif;
        endforeach;
    }

}

?>
