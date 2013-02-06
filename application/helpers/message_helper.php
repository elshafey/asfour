<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * get flash message to display to user.
 * call this helper only from cntroller actions.
 */
function flash_message() {
    // get flash message from CI instance
    $CI =& get_instance();
    $flashmsg = $CI->session->flashdata('message');
    //echo "<pre>message";print_r($flashmsg);exit;
    if(!empty ($flashmsg))
    {
        //print_r($flashmsg);
        $CI->set_var("msg_type",$flashmsg["msg_type"]);
        $CI->set_var("msg_text",$flashmsg["msg_text"]);
    }
    /*
     * type
     * title
     * content
     */
    
}

function generate_message($type,$title,$content){
    
}

?>