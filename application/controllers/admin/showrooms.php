<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of showrooms
 *
 * @author Asamir
 */
class Showrooms extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
        $this->lang->load('page');
    }

    public function index($type = 'location', $id = '') {
        if ($_POST) {
            validte_url(URL_PREFIX_SHOWROOMS);
            if ($this->form_validation->run()) {
                save_url(URL_PREFIX_SHOWROOMS);
            }
            redirect(site_url('admin/page/showrooms'));
        }
        $showrooms = ShowroomsLocationsTable::getAllShowroomsLocations();

        $responce = array();
        if ($showrooms) {
            foreach ($showrooms as $key => $value) {
                $responce[$key]["showroom_name"] = $value['name'];
                $responce[$key]["showroom_address"] = $value['address'];
                $responce[$key]["showroom_tel"] = $value['tel'];
                $responce[$key]['showroom_edit'] = '<a href="' . site_url('admin/showrooms/edit/' . $value['id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['showroom_delete'] = '<a class="delete_lnk" href="' . site_url('admin/showrooms/delete_showroom/' . $value['id']) . '">' . lang('global_delete') . '</a>';
            }
        }
        populate_url(URL_PREFIX_SHOWROOMS);
        validte_url(URL_PREFIX_SHOWROOMS);
        $this->form_validation->run();
        $this->data['page_title'] = lang('page_showrooms_title');
        $this->data['showroom_json'] = json_encode($responce);
        load_grid_files();
        $this->data['showrooms'] = array();
        $this->template->write_view('content', 'admin/page/showrooms_locations', $this->data, FALSE);
        $this->template->render();
    }

    public function create() {
        if ($_POST) {
            $s = new ShowroomsLocations();
            if ($s->addShowroomLocation($_POST))
                redirect(site_url('admin/showrooms'));
        }
        $this->data['page_title'] = 'Create new showrooms';

        $this->template->write_view('content', 'admin/page/showrooms_form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit($id) {
        $s = ShowroomsLocationsTable::getInstance()->find($id);
        if ($_POST) {
            if ($s->addShowroomLocation($_POST))
                redirect(site_url('admin/page/showrooms'));
        } else {

            $s->populate();
        }

        $this->data['page_title'] = 'Edit showrooms';

        $this->template->write_view('content', 'admin/page/showrooms_form', $this->data, FALSE);
        $this->template->render();
    }

    public function delete_showroom($id) {
        $srl = new ShowroomsLocations();
        $srl->deleteShowroom($id);

        redirect(site_url('admin/page/showrooms'));
    }

}

?>
