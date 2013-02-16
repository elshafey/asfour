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

class Page extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    public function edit($slug) {

        $page = PagesTable::getInstance()->findOneBy('slug', $slug);
        if ($_POST && $_POST['action_name'] == 'add_image') {
            $this->add_image($page->page_id, $slug);
            $page->populateForm(true);
        } else {
            $page->populateForm();
        }

        $pageDetails = PageDetailsTable::getInstance()
                ->findBySql('page_id =? AND lang_id=?', array($page->page_id, get_language_id())
                , Doctrine_Core::HYDRATE_ARRAY);

        $this->data['page_id'] = $page->page_id;
        $this->data['slug'] = $slug;
        $this->data['page_title'] = $pageDetails[0]['page_title'];


        if ($this->process_form)
            $page->processForm();


        $this->data['images'] = PageImagesTable::getInstance()
                ->findBySql('page_id =?', array($page->page_id)
                , Doctrine_Core::HYDRATE_ARRAY);

        $this->template->add_css("layout/css/grid/jquery-ui-1.8.2.custom.css");
        $this->template->write_view('content', 'admin/page/form', $this->data, FALSE);
        $this->template->render();
    }

    private function add_image($page_id, $slug) {
        $image = new PageImages();
        if ($image->processForm($page_id)) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/' . $slug);
        }
    }

    public function activate($model, $id) {
        $this->activation($model, $id, 1);
    }

    public function deactivate($model, $id) {
        $this->activation($model, $id, 0);
    }

    public function orderup($model, $id, $order) {
        $this->change_order($model, $id, $order - 1);
    }

    public function orderdown($model, $id, $order) {
        $this->change_order($model, $id, $order + 1);
    }

    private function activation($model, $id, $new_state) {
        $obj = PageImagesTable::getInstance()
                ->find($id);

        $page = PagesTable::getInstance()->find($obj->page_id);
        $obj->image_is_active = $new_state;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        redirect('admin/' . $page->slug);
    }

    private function change_order($model, $id, $new_order) {

        $obj = PageImagesTable::getInstance()
                ->find($id);

        $page = PagesTable::getInstance()->find($obj->page_id);
        $obj->image_order = $new_order;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/' . $page->slug);
    }

    function delete_image($id) {
        $obj = PageImagesTable::getInstance()
                ->find($id);

        $page = PagesTable::getInstance()->find($obj->page_id);
        $obj->delete();

        redirect('admin/' . $page->slug);
    }

    public function showrooms($type = 'location', $id = '') {
        if ($type == 'edit') {
            $s = ShowroomsLocationsTable::getInstance()->find($id);
            if ($_POST) {
                if ($s->addShowroomLocation($_POST))
                    redirect(site_url('admin/page/showrooms'));
            } else {

                $s->populate();
            }
        } elseif ($_POST && $type == 'location') {
            $s = new ShowroomsLocations();

            if ($s->addShowroomLocation($_POST))
                redirect(site_url('admin/page/showrooms'));
        }elseif ($_POST) {
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
                $responce[$key]['showroom_edit'] = '<a href="' . site_url('admin/page/showrooms/edit/' . $value['id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['showroom_delete'] = '<a class="delete_lnk" href="' . site_url('admin/page/delete_showroom/' . $value['id']) . '">' . lang('global_delete') . '</a>';
            }
        }
        populate_url(URL_PREFIX_SHOWROOMS);
        validte_url(URL_PREFIX_SHOWROOMS);
        $this->form_validation->run();
        $this->data['page_title'] =lang('page_showrooms_title');
        $this->data['showroom_json'] = json_encode($responce);
        load_grid_files();
        $this->data['showrooms'] = array();
        $this->template->write_view('content', 'admin/page/showrooms_locations', $this->data, FALSE);
        $this->template->render();
    }

    public function delete_showroom($id) {
        $srl = new ShowroomsLocations();
        $srl->deleteShowroom($id);

        redirect(site_url('admin/page/showrooms'));
    }

}