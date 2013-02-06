<?php

/**
 * ProductImages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ProductImages extends BaseProductImages
{
    
    var $CI;

    public function __construct($table = null, $isNewEntry = false) {
        parent::__construct($table, $isNewEntry);
        $this->CI = get_instance();
    }
    
    public function processForm($prod_id) {
        if ($_POST && $this->validateForm()) {
            $this->path = $_POST['path'];
            $this->image_is_active = 1;
            $this->image_order=$_POST['image_order'];
            $this->prod_id=$prod_id;
            assign_image_alt_title($this);
            $this->save();
            
            return true;
        }

        return FALSE;
    }
    
    private function validateForm() {

        $this->CI->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        
        $this->CI->form_validation->set_rules("image_order", "", "required|numeric|xss_clean");
        $this->CI->form_validation->set_rules("path", "", "required|xss_clean");
        validte_image_alt_title();
        return $this->CI->form_validation->run();
    }
    
    public function resetForm(){
        $this->CI->form_validation->set_rules("image_order", "", "xss_clean");
        $this->CI->form_validation->set_rules("path", "", "xss_clean");

        return $this->CI->form_validation->run();
    }
}