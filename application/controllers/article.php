<?php

class article extends CI_Controller {

    //@@Controller
    public function __construct() {
        parent::__construct();
        //Check user and define if it exists
        $this->jgsecurity->usercheck();
    }

//------------------------------------------------------------------------------
//Accessable Methods
//------------------------------------------------------------------------------
    //Main page for articles
    public function index() {
        $this->load->model('articlemodel');
        $data['article'] = $this->articlemodel->getAllArticles();
        
        $this->load->view('header/head');
        $this->load->view('article/view', $data);
        $this->load->view('header/foot');
    }

    //Views an articles
    public function view($url) {

        $data = array();
        $this->load->model('articlemodel');

        $data['article'] = $this->articlemodel->getArticle($url);
        //error
        if (!array_key_exists(0, $data['article'])):
            $this->load->view('article/error');
        endif;

        $data['articleText'] = $this->articlemodel->getArticleText($data['article'][0]['aID']);

        $this->load->view('header/head');
        $this->load->view('article/read', $data);
        $this->load->view('header/foot');
    }

    //Approve an item
    public function approve() {

        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN'))
            die('Not Logged In');

        if ($this->session->userdata('UserLevel') >= 2) {

            $this->load->model('articlemodel');
            $this->articlemodel->updateArticle($this->input->post('url'), array('dateapproved' => date('y-m-d')));
        }
    }

    //Edits an article
    public function modify($url = '') {

        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN'))
            die('Not Logged In');

        //Defination ARea
        $data['method'] = ($url == '') ? 'new' : 'edit';
        $data['URL'] = $url;
        $this->load->model('articlemodel');

        //If its not a new one get the information to edit this.
        if ($data['method'] != 'new'):
            $data['article'] = $this->articlemodel->getArticle($url);

            $aID = $data['article'][0]['aID'];
            if ($data['article'][0]['dateapproved'] != '0000-00-00' && $this->session->userdata('UserLevel') < 3):
                die('ERROR : YOU ARE NOT ALLOWED TO ACCESS THIS BECAUSE THIS ARTICLE HAS ALREADY BEEN APPROVED.');

            endif;

            $data['articleText'] = $this->articlemodel->getArticleText($aID);
            $data['articleText'][0]['ArticleText'] = str_replace(chr(13), "", $data['articleText'][0]['ArticleText']);
            $data['articleText'][0]['ArticleText'] = str_replace(chr(10), "", $data['articleText'][0]['ArticleText']);
            $data['articleText'][0]['ArticleText'] = htmlspecialchars($data['articleText'][0]['ArticleText']);
        endif;

        //Get the category list 
        $data['articlecategorys'] = $this->articlemodel->getcategorylist();

        //Load the page
        //Load the view
        $this->load->view('header/head');
        $this->load->view('add/article', $data);
        $this->load->view('header/foot');
    }

//------------------------------------------------------------------------------
//Backend AJAX Methods
//------------------------------------------------------------------------------
    //Saves an article either new or edit.
    public function save() {
        //MUST BE LOGGED IN
        if (!defined('JGLOGGEDIN'))
            die('Not Logged In');

        $type = $this->input->post('type');
        $this->load->model('articlemodel');

        //Is this article New or an edit?
        //Get the data.
        if ($type == 'new'):
            $id = $this->articlemodel->insertArticle(array(
                'author' => $this->input->post('author'),
                'category' => $this->input->post('category'),
                'aUrl' => $this->input->post('aUrl'),
                'articletitle' => $this->input->post('articletitle')
            ));

            //Add the article itself
            $this->articlemodel->insertArticleText(array(
                'aID' => $id,
                'createdUser' => $this->session->userdata('Username'),
                'daterevised' => date('Y-m-d H:i:s'),
                'ArticleText' => $this->input->post('articletext')
            ));

            $this->load->view('header/head');

            $this->load->view('header/foot');

        else:
            $this->articlemodel->updateArticle($this->input->post('aUrl'), array(
                'articletitle' => $this->input->post('articletitle'),
                'category' => $this->input->post('category'),
                'author' => $this->input->post('author')

            ));

            $a = $this->articlemodel->getArticle($this->input->post('aUrl'));

            $this->articlemodel->insertArticleText(array(
                'aID' => $a[0]['aID'],
                'createdUser' => $this->session->userdata('Username'),
                'daterevised' => date('Y-m-d H:i:s'),
                'ArticleText' => $this->input->post('articletext')
            ));
        endif;
        //REdirect back somewhere.
        redirect(base_url());
    }

    //Checks if article url is already taken
    public function checkURL() {
        if (!defined('JGLOGGEDIN')) : die(); endif;
        
        $aUrl = $this->input->post('url');
        $this->load->model('articlemodel');
        $a['result'] = $this->articlemodel->checkArticleURL($aUrl);

        header('Content-Type: application/json');
        $data['json'] = json_encode($a);
        $this->load->view('json', $data);
    }

}

?>
