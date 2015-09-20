<?php

class jgsecurity {

    public function usercheck() {
        $CI = & get_instance();
        $user = $CI->session->all_userdata();
        
        if(array_key_exists('UserLevel', $user)):
            define('JGLOGGEDIN', true);
        if($user['UserLevel'] == 3):
            define('ADMIN', TRUE);
        endif;
        endif;
    }

}

?>
