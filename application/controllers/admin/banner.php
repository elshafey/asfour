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

class Banner extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    public function index($type = 'banner') {
        $banner = new Banners();
        if ($banner->processForm($type)) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/' . (($type == 'banner') ? 'banner' : 'media_center'));
        }
        
        load_video_data();
        populate_url(URL_PREFIX_HOME);
        validte_url(URL_PREFIX_HOME);
        $this->form_validation->run();

        $this->data['banners'] = BannersTable::getBanners($type);
        $this->data['page_title'] = lang('banners_title');
        $this->template->add_css("layout/css/grid/jquery-ui-1.8.2.custom.css");
        $this->template->write_view('content', 'admin/banner/index', $this->data, FALSE);
        $this->template->render();
    }

    public function delete($banner_id) {
        $banner = BannersTable::getInstance()
                ->find($banner_id);
        $banner->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/' . (($banner->banner_type == 'banner') ? 'banner' : 'media_center'));
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
        $obj = BannersTable::getInstance()
                ->find($id);

        $obj->banner_is_active = $new_state;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        redirect('admin/' . (($obj->banner_type == 'banner') ? 'banner' : 'media_center'));
    }

    private function change_order($model, $id, $new_order) {

        $obj = BannersTable::getInstance()
                ->find($id);

        $obj->banner_order = $new_order;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/' . (($obj->banner_type == 'banner') ? 'banner' : 'media_center'));
    }

    public function home_tags() {
        $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        if ($_POST) {            
                save_url(URL_PREFIX_HOME, true);
                $message = array(
                    'msg_type' => 'success',
                    'msg_text' => lang('confirm_product_added_successfully')
                );

                $this->session->set_flashdata("message", $message);
                redirect('admin/banner/');
        }
    }
    
    public function change_vedio_url(){
        file_put_contents("uploads/vedio_url.txt",  serialize($_POST));
        redirect('admin/banner/');
    }

}
