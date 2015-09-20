<?php
/**
 * Description of search
 *
 * @author Evilnames
 */
class search extends CI_Controller {

    //@@Controller
    public function __construct() {
        parent::__construct();
    }

    public function searchItem() {
        //Load the models
        $this->load->model('searchmodel');

        $search = $this->input->post('search');

        //Get the distinct keys
        $searchKeys = explode(" ", $search);

        //Get all the search key items
        foreach ($searchKeys as $i => $value):
            $dSet[$i] = $this->searchmodel->getKeySearch($value);
        endforeach;

        //Merge the dSets into one thing with one set of UID's as the key
        $data = array();
        $lookup = array();

        //Build actual array of data
        foreach ($dSet as $i => $value):
            foreach ($value as $x => $xval):
                if (!array_key_exists($xval['UID'], $data)):
                    $data[$xval['UID']]['value'] = 0;
                    array_push($lookup, $xval['UID']);
                endif;
                $data[$xval['UID']]['value'] += $xval['num'];
            endforeach;
        endforeach;

        arsort($data);
        if (sizeof($data) != 0):

            //Get the information for all of these items
            $this->load->model('figuremodel');

            $pool = $this->figuremodel->geteverythingfromarray($lookup);

            //Build the display array
            foreach ($data as $ii => $value):
                //Find the matching item in the pool
                foreach ($pool as $p => $pVal):
                    //If it is equal then match it.
                    if ($pVal['UID'] == $ii):
                        $data[$ii]['info'] = $pVal;
                        //var_dump($data[$ii]);
                        unset($pool[$p]);
                    endif;
                endforeach;
            endforeach;
        
            else:
                $result['data']['info'] = 'No Search Results';
            
            endif;
            
        $result['data'] = $data;
        
        //Load the display
        $this->load->view('header/head');
        $this->load->view('search/results', $result);
        $this->load->view('header/foot');
    }

    public function buildIndex($period) {
        $this->load->model('figuremodel');
        $this->load->model('searchmodel');

        $figs = $this->figuremodel->getEverything($period);

        foreach ($figs as $i => $value):

            //Break out the keys
            $titlekeys = explode(" ", $value['Title']);
            $designerkeys = explode(" ", $value['Designer']);
            $Descriptionkeys = explode(" ", $value['Description']);
            $urlkeys = explode(" ", $value['url']);
            $categorykeys = explode(" ", $value['categoryTitle']);
            $uid = $value['UID'];

            //Merge the keys together
            $data = array();
            $data = array_merge($data, $titlekeys);
            $data = array_merge($data, $designerkeys);
            $data = array_merge($data, $Descriptionkeys);
            $data = array_merge($data, $urlkeys);
            $data = array_merge($data, $categorykeys);

            foreach ($data as $x => $xVal):
                $set = array(
                    'UID' => $uid,
                    'Text' => $xVal
                );

                $this->searchmodel->addSearch($set);
            endforeach;

        endforeach;
    }

}

?>
