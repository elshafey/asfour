<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'application/controllers/admin/banner.php';
/*
  | -------------------------------------------------------------------
  | Dashboard Controller
  | -------------------------------------------------------------------
  | This file represent dashboard controller class extending asfour controller class.
  | This class is responsible for displaying the available functionality in the module.
 */

class Media_center extends Banner {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }
    
    public function index($type = 'media') {
        parent::index($type);
    }
    
    public function media_contacts(){
        if($_POST){
            $mc = new MediaContacts();
            $mc->addMediaContact($_POST);
            
            redirect(site_url('admin/media_center/media_contacts'));
        }
        $this->data['products']=  ProductsTable::getProducts(get_language_id(), TRUE, true);
        $media_contacts= MediaContactsTable::getAllMediaContacts();  

        
        $responce = array();
        if ($media_contacts) {
            foreach ($media_contacts as $key => $value) {
                $responce[$key]["prod_title"] = $value['prod_title']; 
                $emails = '';
                foreach($value['MediaContacts'] as $contact){
                    $emails .= $contact['email'] . ', ';
                }
                $responce[$key]["email"] = $emails;                         
                
            }
        }
        
        $this->data['media_contacts'] = json_encode($responce);
        load_grid_files();
        $this->template->write_view('content', 'admin/media_center/media_contacts', $this->data, FALSE);
        $this->template->render();
    }
}