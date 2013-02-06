<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of showrooms
 *
 * @author Asamir
 */
class Showrooms extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }
    
    public function index(){
        if($_POST){
            $mc = new MediaContacts();
            $mc->addMediaContact($_POST);
            
            redirect(site_url('admin/showrooms'));
        }
        $this->data['showrooms'] = array();
        $this->template->write_view('content', 'admin/page/showrooms_locations', $this->data, FALSE);
        $this->template->render();
    }
}

?>
