<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------
  | My Controller
  | -------------------------------------------------------------------
  | This file represent parent class for all system controllers.
  |
  | The file contains global shared functions among all controllers and extend
  | Codeigniter Controller. Fucntions such as reading configuration, settings
  | localizations and layout, reading global url request should goes here.
 */

/**
 * @property CI_Session $session
 * @property CI_URI     $uri
 * @property CI_Template     $template
 * @property CI_Lang     $lang
 * @property My_Form_validation     $form_validation
 * 
 */
class My_Controller extends CI_Controller {

    var $data;
    var $process_form = true;

    public function __construct() {
        //Extending parent construction
        parent::__construct();

        //Init class memebers
        $this->data = array();

        //Init local configurations
        if (is_readable(FCPATH . 'application/config/config.local.php')) {
            $this->config->load('config.local');
        }

        if (
                $this->uri->segment(1) == 'admin'
                &&
                $this->uri->rsegment(1) != 'home'
                &&
                $this->uri->rsegment(1) != 'login'
        ) {
            if (!$this->session->userdata('is_login')) {

                redirect('admin/login');

                exit;
            }
        }
        set_locale();
        //Local settings override permanent settings always if found.

        flash_message();
    }

    public function set_var($name, $value) {
        $this->data[$name] = $value;
    }

    public function get_var($name) {
        if (isset($this->data[$name]))
            return $this->data[$name];

        return "";
    }

}

/* End of file: My_Controller */
/* Location: ./application/core/My_Controller.php */
?>
