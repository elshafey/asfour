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

class Faq extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    public function index() {
        $faqs = FaqsTable::getFaqs();

        $responce = array();
        if ($faqs) {
            foreach ($faqs as $key => $value) {
                $responce[$key]["faq_id"] = $value['faq_id'];
                foreach (get_lang_list() as $code => $lang) {
                    $faqsDetail = Details::getDetail('FaqDetails', 'faq_id', $value['faq_id'], $code);
                    $responce[$key]["faq_question_$code"] = '<a href="' . site_url('admin/faq/edit/' . $value['faq_id']) . '">' . $faqsDetail[0]['faq_question'] . '</a>';
                }
                $responce[$key]["faq_order"] = order_icon($value['faq_order'], 'faq', '', $value['faq_id']);
                ;
                $responce[$key]["faq_is_active"] = active_icon($value['faq_is_active'], 'faq', 'faq', $value['faq_id']);
                $responce[$key]['faq_edit'] = '<a href="' . site_url('admin/faq/edit/' . $value['faq_id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['faq_delete'] = '<a class="delete_lnk" href="' . site_url('admin/faq/delete/' . $value['faq_id']) . '">' . lang('global_delete') . '</a>';
            }
        }

        $this->data['faq_json'] = json_encode($responce);
        load_grid_files();
        $this->data['page_title'] = lang('faq_title');

        $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        if ($_POST) {
            validte_url(URL_PREFIX_FAQS);
            if ($this->form_validation->run()) {
                save_url(URL_PREFIX_FAQS);
                $message = array(
                    'msg_type' => 'success',
                    'msg_text' => lang('confirm_product_added_successfully')
                );

                $this->session->set_flashdata("message", $message);
                redirect('admin/faq/');
            }
        } else {
            populate_url(URL_PREFIX_FAQS);
            validte_url(URL_PREFIX_FAQS);
            $this->form_validation->run();
        }
        $this->template->write_view('content', 'admin/faq/index', $this->data, FALSE);
        $this->template->render();
    }

    public function create() {

        $this->data['page_title'] = lang('faq_form_create_page_title');

        $new = new Faqs();
        if ($new->processForm()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/faq/');
        }

        $this->template->write_view('content', 'admin/faq/form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit($faqs_id) {
        $faqs = $this->check($faqs_id);
        $faqs->populateForm();

        $this->data['page_title'] = sprintf(lang('faq_form_edit_page_title'), $_POST['faq_question_' . get_locale()]);

        if ($this->process_form && $faqs->processForm()) {

            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/faq');
        }
        $this->template->write_view('content', 'admin/faq/form', $this->data, FALSE);
        $this->template->render();
    }

    public function delete($faqs_id) {
        $faqs = $this->check($faqs_id);
        $faqs->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/faq');
    }

    public function add_url_info() {
        validte_url(URL_PREFIX_FAQS);
        if ($this->form_validation->run()) {
            save_url(URL_PREFIX_FAQS);
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/faq/');
        }

        $this->index();
    }

    /**
     *
     * @param int $faqs_id
     * @return Faqs 
     */
    private function check($faqs_id) {

        $faqs = FaqsTable::getInstance()->findOneBy('faq_id', $faqs_id);
        if (!$faqs) {
            $message = array(
                'msg_type' => 'error',
                'msg_text' => lang('error_no_such_item')
            );

            $this->session->set_flashdata("message", $message);

            redirect('admin/faq/');
        }

        return $faqs;
    }

    public function activate($model, $id) {
        $this->activation($model, $id, 1);
    }

    public function deactivate($model, $id) {
        $this->activation($model, $id, 0);
    }

    private function activation($model, $id, $new_state) {
        $obj = FaqsTable::getInstance()
                ->find($id);

        $obj->faq_is_active = $new_state;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );
        $this->session->set_flashdata("message", $message);
        redirect('admin/faq');
    }
    
     public function orderup($id,$order){
        $this->change_order($id, $order-1);
    }

    public function orderdown($id,$order){
        $this->change_order($id, $order+1);
    }
    
    private function change_order($id,$new_order) {
        $modelClass = 'FaqsTable';
        $obj = $modelClass::getInstance()
                ->find($id);
        $order_field = 'faq_order';
        $obj->$order_field = $new_order;
        $obj->save();       
       
        redirect('admin/faq');
       
    }

}