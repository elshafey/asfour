<?php

/**
 * Pages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Pages extends BasePages {

    var $CI;

    public function __construct($table = null, $isNewEntry = false) {
        parent::__construct($table, $isNewEntry);
        $this->CI = get_instance();
    }

    public function processForm() {
        if ($_POST && $this->validateForm()) {
            $this->page_banner=$_POST['page_banner'];
            $this->save();
            
            foreach (get_lang_list() as $key => $lang) {
                $language = LanguagesTable::getLanguage($key);
                $pageDetails = PageDetailsTable::getInstance()
                        ->findBySql('page_id =? AND lang_id=?', array($this->page_id, $language['lang_id']));

                $pageDetail = $pageDetails[0];
                $pageDetail->page_id = $this->page_id;
                $pageDetail->page_content = $_POST['page_content_' . $key];
                $pageDetail->lang_id = $language['lang_id'];
                $pageDetail->save();
            }
            
            save_url(URL_PREFIX_PAGE.$this->slug);
            return true;
        }

        return FALSE;
    }
    
    public function processContentForm() {
        if ($_POST && $this->validateContentForm()) {
            $this->page_banner=$_POST['page_banner'];
            $this->save();
            foreach (get_lang_list() as $key => $lang) {
                $language = LanguagesTable::getLanguage($key);
                $pageDetails = PageDetailsTable::getInstance()
                        ->findBySql('page_id =? AND lang_id=?', array($this->page_id, $language['lang_id']));

                $pageDetail = $pageDetails[0];
                $pageDetail->page_id = $this->page_id;
                $pageDetail->page_content = $_POST['page_content_' . $key];
                $pageDetail->lang_id = $language['lang_id'];
                $pageDetail->save();
            }
            save_url(URL_PREFIX_CAREER);
            return true;
        }

        return FALSE;
    }
    
    public function populateForm($img_add=false) {
        if (!$_POST||$img_add) {
            foreach (get_lang_list() as $key => $lang) {
                $language = LanguagesTable::getLanguage($key);
                $pageDetails = PageDetailsTable::getInstance()->
                        findBySql(
                        'page_id =? AND lang_id=?', array($this->page_id,
                    $language['lang_id']), Doctrine_Core::HYDRATE_ARRAY);

                $_POST["page_title_$key"] = $pageDetails[0]['page_title'];
                $_POST["page_content_$key"] = $pageDetails[0]['page_content'];
            }
            $_POST['page_banner']=  $this->page_banner;
            populate_url(URL_PREFIX_PAGE.$this->slug);
            $this->CI->process_form = false;
            
            $this->validateForm();
        }
    }
    
    public function populateContentForm($img_add=false) {
        if (!$_POST||$img_add) {
            foreach (get_lang_list() as $key => $lang) {
                $language = LanguagesTable::getLanguage($key);
                $pageDetails = PageDetailsTable::getInstance()->
                        findBySql(
                        'page_id =? AND lang_id=?', array($this->page_id,
                    $language['lang_id']), Doctrine_Core::HYDRATE_ARRAY);

                $_POST["page_content_$key"] = $pageDetails[0]['page_content'];
            }
            $_POST['page_banner']=  $this->page_banner;
            $this->CI->process_form = false;
            populate_url(URL_PREFIX_CAREER);
            $this->validateContentForm();
        }
    }
    
    private function validateForm() {

        $this->CI->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        foreach (get_lang_list() as $key => $lang) {
            $this->CI->form_validation->set_rules("page_content_$key", "", "required");
        }
        $this->CI->form_validation->set_rules("page_banner", "", "required");
        if($this->page_id){
            validte_url(URL_PREFIX_PAGE.$this->slug);
        }else{
            validte_url();
        }
        return $this->CI->form_validation->run();
    }
    private function validateContentForm() {

        $this->CI->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        foreach (get_lang_list() as $key => $lang) {
            $this->CI->form_validation->set_rules("page_content_$key", "", "required");
        }
        if($this->page_id){
            validte_url(URL_PREFIX_CAREER);
        }else{
            validte_url();
        }
        $this->CI->form_validation->set_rules("page_banner", "", "required");
        return $this->CI->form_validation->run();
    }

}