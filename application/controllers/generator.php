<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generator extends My_Controller {

    public function index() {

        if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
            try {
                Doctrine::generateModelsFromDb(APPPATH . 'models', array('default'), array('generateTableClasses' => true));
            } catch (Exception $exc) {

                echo $exc->__toString();
                exit;
            }
        }
    }

    public function runquery() {

        $res = Doctrine_Query::create()
                ->select('c.country_name')
                ->from('Countries c')
                ->orderBy('country_name ASC')
                ->where('country_id>41')
                ->setHydrationMode(Doctrine_Core::HYDRATE_SINGLE_SCALAR)
                ->execute();
        
        foreach ($res as $k=>$c){
            $res[$k]="('$c')";
        }
        
        $insert='INSERT INTO `countries` (`country_name`) Values 
'.  implode(',
', $res).';';
        pre_print($insert);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */