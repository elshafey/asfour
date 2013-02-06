<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------
  | Dashboard Controller
  | -------------------------------------------------------------------
  | This file represent dashboard controller class extending asfour controller class.
  | This class is responsible for displaying the available functionality in the module.
 */

class Admin extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }
    
    function index(){
        $this->data['page_title']=lang('global_dashboard');
        $this->template->write_view('content', 'admin/dashboard', $this->data, FALSE);
        $this->template->render();
    }
}
