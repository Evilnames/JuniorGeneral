<?php

class figuremodel extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //@@Returns a figure based on its URL Name
    public function getFigure($url) {

        //Build the query
        $SQL = "select * from figures inner join titles on PeriodID = TimePeriod AND subcatagory = SubPeriod where url=?";
        $query = $this->db->query($SQL, array($url));

        //Return the Query
        return $query->result_array();
    }

    //@@Returns all unapproved items
    public function getUnapproved() {

        $query = $this->db->query('select * from figures inner join titles on PeriodID = TimePeriod AND subcatagory = SubPeriod where approved = 0 and void = 0');

        //Return the Query
        return $query->result_array();
    }

    public function allFigures() {
        $this->db->from('figures');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEverything($periodID = 0) {
        $query = $this->db->query('select * from figures inner join titles on PeriodID = TimePeriod AND subcatagory = SubPeriod where TimePeriod=?', array($periodID));
        return $query->result_array();
    }

    public function geteverythingfromarray($arr) {
        $string = '';
        foreach ($arr as $i):
            $string .= $i . ", ";
        endforeach;

        $string = substr($string, 0, strlen($string) - 2);

        $query = $this->db->query('select * from figures inner join titles on PeriodID = TimePeriod AND subcatagory = SubPeriod where UID in (' . $string . ')');
        return $query->result_array();
    }

    public function allCategories() {
        $query = $this->db->query("SELECT * FROM (`titles`) JOIN `mastercat` ON `mastercat`.`PeriodID` = `titles`.`PeriodID` ORDER BY `titles`.`PeriodID`");

        return $query->result_array();
    }

    //@@Updates an UID's url
    public function updateUID($UID, $URL) {
        $where = array(
            'url' => $URL
        );

        $this->db->where('UID', $UID);
        $this->db->set($where);
        $this->db->update('figures');
    }

    public function updatePeriod($periodID, $subCat, $URL) {
        $where = array(
            'url' => $URL
        );

        $this->db->where('PeriodID', $periodID);
        $this->db->where('Subcatagory', $subCat);
        $this->db->set($where);
        $this->db->update('titles');
    }

    //@@REturns all master category items
    public function getMasterCatAll() {
        $this->db->from('mastercat');

        //Return Query Information
        $query = $this->db->get();
        return $query->result_array();
    }

    //@@Returns a master category row based on the URL
    public function getMasterCat($URL) {

        $this->db->where('masterURL', $URL);
        $this->db->from('mastercat');

        //Return Query Information
        $query = $this->db->get();
        return $query->result_array();
    }

    //Returns a list of items related to a subcategory
    public function getSubCategory($periodID) {
        //Build the query
        $this->db->where('PeriodID', $periodID);
        $this->db->from('titles');

        //Return Query Information
        $query = $this->db->get();
        return $query->result_array();
    }

    //Gets all figures with the period and subperiod id
    public function getAllFromTimePeriod($periodID) {

        $where = array('TimePeriod' => $periodID,
            'approved' => 1,
            'void' => 0,
            'Title !=' => ''
        );

        //Build the query
        $this->db->where($where);
        $this->db->from('figures');
        $this->db->order_by('Title');

        //Return Query Information
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllFromDesigner($Designer)
    {
        $Designer = strtolower($Designer);
        $Designer = str_replace("%20", " ", $Designer);
        $SQL = "select * from figures f inner join mastercat m on m.PeriodID = f.TimePeriod inner join titles t on t.Subcatagory = f.SubPeriod  where lower(ltrim(rtrim(designer))) = ? and approved = 1 and void = 0 and Title != '' order by f.TimePeriod, f.SubPeriod, f.Title";

        //Return Query Information
        $query = $this->db->query($SQL, array($Designer));
        return $query->result_array();
    }

    //Gets PeriodID of a subcategory
    public function getParentfromChildCategory($cat) {
        $this->db->select('PeriodID');
        $this->db->where('Subcatagory', $cat);
        $this->db->from('titles');

        //Return Query Information
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addFigure($data) {
        $this->db->insert('figures', $data);
    }

    public function updateFigure($url, $data) {
        $this->db->where('url', $url);
        $this->db->update('figures', $data);
    }

    public function updateFigureID($id, $data) {
        $this->db->where('UID', $id);
        $this->db->update('figures', $data);
    }

    public function newfigures($amt) {

        $this->db->order_by('DateUploaded', 'desc');
        $this->db->where(array(
            'void' => 0,
            'approved' => 1,
            'TimePeriod !=' => 999,
            'Title !=' => ''
        ));

        //Return Query Information
        $query = $this->db->get('figures', $amt);
        return $query->result_array();
    }

}

?>
