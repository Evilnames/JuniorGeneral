<?php

class user extends CI_Controller {

    //@@Controller
    public function __construct() {
        parent::__construct();

        $this->load->library('encrypt');
        //Check user and define if it exists
        $this->jgsecurity->usercheck();
    }

    //Login Page Itself!
    public function index() {
        if (!defined('JGLOGGEDIN')):
            //Load the view
            $this->load->view('header/head');
            $this->load->view('home/login');
            $this->load->view('header/foot');
        else:
            //Redirect the user to the admin screen.
            $this->loadDashboard();

        endif;
    }

    //Check login password
    public function validateuserinformation() {

        if(date('m/d/Y h:i:s', time()) > $this->session->userdata('locktime') || !$this->session->userdata('locktime')){

        } else {
            $this->wait();
            die('Locked for a random amount of time.  Please try again later.');
        }

        //Get required items
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        if (!$user || !$pass):
            $this->wait();
            die('Error:Invalid Username of Password');
        endif;

        //encrypt the password
        $pass = $this->encrypt->sha1($pass);

        //Try the DB now
        $this->load->model('usermodel');

        //Try login
        $data = array(
            'Username' => $user,
            'Password' => $pass
        );

        $userData = $this->usermodel->trylogin($data);

        //Check if this is actually real...
        if(sizeof($userData) > 0){
            if (array_key_exists('UserLevel', $userData[0])):
                $this->login($userData[0]);
                redirect(base_url());
            else:
                //This password or user combo doesn't exist
                $this->wait();
                die('Error:Invalid Username or Password');
            endif;
        } else {
            
            $this->wait();
            die('Error:Invalid Username or Password');
        }
    }

    //Wait...
    private function wait(){
        if($this->session->userdata('Lock') > 0){
            $num = $this->session->userdata('Lock');
            $this->session->set_userdata('Lock', $num * 2);
        } else {
            $this->session->set_userdata('Lock', 2);
        }

        $date = new DateTime();
        $date->modify("+" . $this->session->userdata('Lock') ." minutes"); //or whatever value you want

        $a =  $date->format('Y-m-d H:i:s');
        $this->session->set_userdata('locktime', $a);
    }

    //Checks to see if a url exists
    public function urlcheck() {

        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;

        //No lower than 3
        $userPermission = $this->session->userdata('UserLevel');
        if ($userPermission <= 2):
            //Unallowed to access this.
            $this->fileuploaderror(array());
        endif;

        $urlToCheck = $this->input->post('url');
        $this->load->model('figuremodel');
        $d = $this->figuremodel->getFigure($urlToCheck);

        $data['result'] = 0;

        if (sizeof($d) > 0):
            //This exists
            $data['result'] = 1;
        endif;

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    //Add a figure route
    public function addfigure() {
        $data = array();

        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;

        //Get the categories
        $this->load->model('figuremodel');
        $data['cat'] = $this->figuremodel->allCategories();
        $data['edit'] = false;

        //Load the view
        $this->load->view('header/head');
        $this->load->view('add/figure', $data);
        $this->load->view('header/foot');
    }

    public function editfigure($figure) {

        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;

        $userPermission = $this->session->userdata('UserLevel');

        //Continuing data gathering.
        $this->load->model('figuremodel');

        $data['cat'] = $this->figuremodel->allCategories();
        $data['figure'] = $this->figuremodel->getFigure($figure);
        $data['edit'] = true;

        //Load the view
        $this->load->view('header/head');
        $this->load->view('add/figure', $data);
        $this->load->view('header/foot');
    }

    //Upload a file
    public function savefile() {
        $this->load->helper('form');

        //Get the username of the user
        $username = $this->session->userdata('Username');

        $edit = $this->input->post('edit');
        $filenamelookup = $this->input->post('userfile');


        if (!$edit || ($edit && $filenamelookup)):
            //Build the directory structure
            $filename = 'uploaded/  ' . date('mdy') . '/';

            //If there is no directory make it.
            if (!is_dir($filename)):
                mkdir($filename, 0775, TRUE);
            endif;

            $config['upload_path'] = $filename;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '5000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()):
                $error = array('error' => $this->upload->display_errors());
            endif;

            //Build Data
            $fData = $this->upload->data();
            $filename .= $fData['file_name'];

        endif;

        $this->load->model('figuremodel');

        //Add this item to the database
        //pTitle    url    pDesigner   Description    category
        //Get this set
        $userPermission = $this->session->userdata('UserLevel');

        $title = $this->input->post('pTitle');
        $url = $this->input->post('url');
        $designer = $this->input->post('pDesigner');
        $description = $this->input->post('Description');
        $Subcategory = $this->input->post('category');

        //Find the PeriodID
        $periodID = $this->figuremodel->getParentfromChildCategory($Subcategory);
        $periodID = $periodID[0]['PeriodID'];

        $data = array(
            'Designer' => $designer,
            'Title' => $title,
            'Description' => $description,
            'SubPeriod' => $Subcategory,
            'TimePeriod' => $periodID,
            'uploader' => $username
        );

        //AK - We want anyone with a user prermission less than this to go through an approval process, even if they're
        //editting a file that was already done.  This prevents people from trying to just destroy files all over the place
        if($userPermission <= 2){
            $data['approved'] = '0';
            $data['approver'] = NULL;
        }

        //If this is not an edit then we want to update the url.  almost everything goes off url to avoid using guids
        if (!$edit):
            $data['url'] = $url;
        endif;

        //If this is an edit but we haven't changed the files then ignore this
        if ($edit && !$filenamelookup):

        else:
            //Mutates the date added because we want updated figures to show up on the home page.
            $data['FileLocation'] = $filename;
            $data['DateUploaded'] = new Date('Y-m-d h:i:sa');
        endif;

        //Auto approve if this is a super user
        if ($userPermission == 3):
            $data['approved'] = 1;
            $data['approver'] = $userName;
        endif;

        //Add to the system
        if (!$edit):
            //Add It
            $this->figuremodel->addFigure($data);

            //Log this change to the DB
            $this->figuremodel->log_figure_change($username, NULL, json_encode($data));
        else:
            
            //Log this change
            $edit_json = json_encode($data);
            
            //Get the current figure and encode it to json for logging
            $current_figure = json_encode($this->figuremodel->getFigure($edit));

            //Update it
            $this->figuremodel->updateFigure($edit, $data);

            //Log this change to the DB
            $this->figuremodel->log_figure_change($username, $current_figure, $edit_json);

        endif;

        //Send an email to Alex and Matt that there is a new file to approve
        if($userPermission <= 2){
            mail("askremer@gmail.com","New file ready for approval","New file ready for approval");
        }

        //Redirect to this unit.
        $to = (!$edit) ? $data['url'] : $edit;
        $path = base_url() . 'index.php/figure/view/' . $to;
        redirect($path);
    }

    //Approve upload route
    public function approveupload() {

        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;

        $userPermission = $this->session->userdata('UserLevel');
        if ($userPermission <= 2):
            //Unallowed to access this.
            $this->fileuploaderror(array());
        endif;

        $this->load->model('figuremodel');
        $data['item'] = $this->figuremodel->getUnapproved();

        //Load the view
        $this->load->view('header/head');
        $this->load->view('add/approve', $data);
        $this->load->view('header/foot');
    }

    //Approve upload route
    public function adduser() {
        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;

        $userPermission = $this->session->userdata('UserLevel');
        if ($userPermission <= 2):
            //Unallowed to access this.
            $this->fileuploaderror(array());
        endif;

        //Load the view
        $this->load->view('header/head');
        $this->load->view('add/user');
        $this->load->view('header/foot');
    }

    //Saves a user
    public function saveuser() {
        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;

        $userPermission = $this->session->userdata('UserLevel');
        if ($userPermission <= 2):
            //Unallowed to access this.
            $this->fileuploaderror(array());
        endif;

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $userper = $this->input->post('userper');

        //Add to db
        $this->createUser($username, $userper, $password);

        redirect(base_url());
    }

    //Approves an item
    public function approvefigure() {

        //MUST BE LOGGED IN
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;

        $id = $this->input->post('id');
        $this->load->model('figuremodel');

        $data = array(
            'approved' => 1,
            'approver' => $this->session->userdata('Username')
        );

        $this->figuremodel->updateFigureID($id, $data);
    }

    //Approves an item
    public function voidfigure() {

        //MUST BE LOGGED IN
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;

        $id = $this->input->post('id');
        $this->load->model('figuremodel');

        $data = array(
            'void' => 1
        );

        $this->figuremodel->updateFigureID($id, $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    //--------------------------------------------------------------------------
    //Scenario Stuff
    public function addscenario() {

        //MUST BE LOGGED IN
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;

        //Get a list of all categories
        $this->load->model('figuremodel');
        $data['cat'] = $this->figuremodel->getMasterCatAll();

        //Load the view
        $this->load->view('header/head');
        $this->load->view('add/scenario', $data);
        $this->load->view('header/foot');
    }

    //--------------------------------------------------------------------------
    //Save a Scenario
    public function savescenario() {

        //MUST BE LOGGED IN
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;
        $this->load->model('scenariomodel');

        $data = array(
            'ScenarioName' => $this->input->post('name'),
            'ScenarioURL' => $this->input->post('url'),
            'ScenarioDescription' => $this->input->post('description'),
            'CategoryID' => $this->input->post('category'),
            'year' => $this->input->post('year'),
            'Type' => $this->input->post('type')
        );

        $this->scenariomodel->newScenario($data);

        redirect(base_url());
    }

    //--------------------------------------------------------------------------
    //Password Changing
    public function changepassword() {
        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;


        //Load the view
        $this->load->view('header/head');
        $this->load->view('add/password');
        $this->load->view('header/foot');
    }

    //Saves a password
    public function savepassword() {
        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN')) : $this->fileuploaderror(array());
        endif;

        $this->load->model('usermodel');
        $password = $this->input->post('password');
        $passwordEncrypt = $this->encrypt->sha1($password);
        $userID = $this->session->userdata('Username');
        $this->usermodel->savepassword($passwordEncrypt, $userID);

        redirect(base_url());
    }

    public function articlelist(){
        //MUST BE LOGGED IN
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;

        $this->load->model('articlemodel');
        $data['articles'] = $this->articlemodel->getAllArticles();
        
        $this->load->view('header/head');
        $this->load->view('article/maintain', $data);
        $this->load->view('header/foot');
    }
    
    public function links(){
        //MUST BE LOGGED IN
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;


        $this->load->view('header/head');
        $this->load->view('add/link');
        $this->load->view('header/foot');
    }

    public function linkAdd(){
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;

        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $category = $this->input->post('Category');
        $website = $this->input->post('Website');

        $data = array(
            'website'       => $website,
            'title'         => $title,
            'category'      => $category,
            'Description'   => $description
        );

        $this->load->model('linkmodel');
        $this->linkmodel->saveLink($data);

        redirect('http://juniorgeneral.org/index.php/user/links');

    }

    //@@URL : /index.php/user/test_email_system/
    public function test_email_system(){
        if (!defined('ADMIN')) : $this->fileuploaderror(array());
        endif;

        mail("askremer@gmail.com","Test Message","Outbound message from juniorgeneral.org");
    }
    
    //--------------------------------------------------------------------------
    //Loads a dashboard
    private function loadDashboard() {
        $data = array();

        //Load model and get data
        $this->load->model('usermodel');
        $userlevel = $this->session->userdata('UserLevel');

        $data['path'] = $this->usermodel->getDashboardLinks($userlevel);

        //Load the view
        $this->load->view('header/head');
        $this->load->view('home/dashboard', $data);
        $this->load->view('header/foot');
    }

    //Error to throw if there is an issue uploading a file.
    private function fileuploaderror($error) {
        die('Error uploading file');
    }

    //Get everything ready for the user data.
    private function login($uData) {
        //Write array to session.
        $this->session->set_userdata($uData);
    }

    //Create a new user in the system.
    private function createUser($userID, $permission, $password) {

        //Load the model
        $this->load->model('usermodel');

        //Encrypt the password
        $passwordEncrypt = $this->encrypt->sha1($password);
        $data = array(
            'Username' => $userID,
            'Password' => $passwordEncrypt,
            'UserLevel' => $permission
        );

        //Add to database
        $this->usermodel->newUser($data);
    }

}

?>
