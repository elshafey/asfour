<?php

/**
 * Banners
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Banners extends BaseBanners
{
    var $CI;

    public function __construct($table = null, $isNewEntry = false) {
        parent::__construct($table, $isNewEntry);
        $this->CI = get_instance();
    }
    
    public function processForm($type) {
        if ($_POST && $this->validateForm()) {
            $this->banner_path = $_POST['banner_path'];
            $this->banner_is_active = 1;
            $this->banner_type = $type;
            $this->banner_order=$_POST['banner_order'];
            $this->banner_url=$_POST['banner_url'];
            if($_POST['banner_scope']){
                $this->banner_scope=$_POST['banner_scope'];
            }
            $this->save();
            
            return true;
        }

        return FALSE;
    }
    
    private function validateForm() {

        $this->CI->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        
        $this->CI->form_validation->set_rules("banner_order", "", "required|numeric|xss_clean");
        $this->CI->form_validation->set_rules("banner_path", "", "required|xss_clean");

        return $this->CI->form_validation->run();
    }
}