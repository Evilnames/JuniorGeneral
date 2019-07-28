<?php
/**
 * Description of search
 *
 * @author Evilnames
 */
class sitestats extends CI_Controller {

    //@@Controller
    public function __construct() {
        parent::__construct();
    }

    //@@URL : /index.php/sitestats/topDesigners/
    public function topDesigners()
    {   
        $this->load->model('statsmodel');
        $topDesigners = $this->statsmodel->topDesigners();

        $data['total'] = sizeof($topDesigners);
        
        //Get the first 100 designers from the list
        $data['designers'] = array_slice($topDesigners, 0, 100);

        //Load the display
        $this->load->view('header/head');
        $this->load->view('stat_view/topdesigner', $data);
        $this->load->view('header/foot');

    }

}