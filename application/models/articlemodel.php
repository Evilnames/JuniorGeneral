<?php

class articlemodel extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Updates an article.
    public function updateArticle($url, $data) {
        $this->db->where('aUrl', $url);
        $this->db->update('articles', $data);
    }

    //Inserts an article
    public function insertArticle($data) {
        $this->db->insert('articles', $data);

        return $this->db->insert_id();
    }

    //Selects one article from the system
    public function getArticle($url) {
        $this->db->where('aUrl', $url);
        $this->db->join('articlecategory', 'artcatid=category');
        $this->db->from('articles');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllArticles(){
        $this->db->join('articlecategory', 'artcatid=category');
        $this->db->from('articles');

        //Article title must have some kind of data in it.  Otherwise we're just assuming it should be closed/deleted
        $this->db->where('articletitle !=', '');
        $this->db->order_by('datecreated desc');

        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Selects the text for an article
    public function getArticleText($aID) {
        $this->db->select_max('vID');
        $this->db->select('ArticleText');
        $this->db->from('articletext');
        $this->db->group_by('ArticleText');
        $this->db->where(array(
            'aID' => $aID
        ));

        $query = $this->db->get();
        return $query->result_array();
    }

    //Returns any amount of new articles in the system.
    public function getNewArticles($num) {

        $this->db->order_by('datecreated', 'desc');
        $this->db->join('articlecategory', 'artcatid=category');
        $this->db->where(array(
            'dateapproved !=' => '0000-00-00'
        ));

        //Return Query Information
        $query = $this->db->get('articles', $num);
        return $query->result_array();
    }

    //Gets a list of articles and the amount of items in them.
    public function getArticleCategoryCount() {
        $query = $this->db->query("select count(aID), ArticleCatTitle from articles a inner join articlecategory on artcatid = category group by ArticleCatTitle");
        return $query->result_array();
    }

    //Get a list of all articles
    public function getcategorylist() {
        $this->db->from('articlecategory');

        $query = $this->db->get();
        return $query->result_array();
    }

    //Update an articletext
    public function updateArticleText($aID, $data) {

        $data = array('daterevised' => date('m/d/y'));

        $this->db->where('aID', $aID);
        $this->db->update('articletext', $data);
    }

    //Insert an updated article into the db.
    public function insertArticleText($data) {
        $this->db->insert('articletext', $data);
    }

    //Gets all the history of an article
    public function getArticleHistory($aID) {
        $this->db->from('articletext');
        $this->db->where('aID', $aID);
        $this->db->order_by('daterevised', 'asc');

        $query = $this->db->get();
        return $query->result_array();
    }

    //Checks too see if an article exists
    public function checkArticleURL($aUrl){
        $this->db->where('aUrl', $aUrl);
        $this->db->from('articles');
        return $this->db->count_all_results();
    }

}

?>