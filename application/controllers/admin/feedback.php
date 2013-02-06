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

class Feedback extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    function index() {
        $feedbacks = FeedbacksTable::getInstance()->findAll(Doctrine_Core::HYDRATE_ARRAY);
        $responce = array();

        foreach ($feedbacks as $key => $value) {
            $responce[$key]['title'] = $value['title'];
            $responce[$key]['name'] = $value['first_name'] . ' ' . $value['last_name'];
            $responce[$key]['position'] = $value['position'];
            $responce[$key]['subject'] = '<a href="' . site_url('admin/feedback/view/' . $value['feedback_id']) . '">' . $value['subject'] . '</a>';
            $responce[$key]['is_new'] = ($value['is_new']) ? '<img height="18" src="' . base_url() . 'layout/images/active.png">' : '<img height="18" src="' . base_url() . 'layout/images/inactive.png">';
            $responce[$key]['delete'] = '<a class="delete_lnk" href="' . site_url('admin/feedback/delete/' . $value['feedback_id']) . '">' . lang('global_delete') . '</a>';
        }

        $this->data['json'] = json_encode($responce);
        $this->data['page_title'] = lang('feedback_page_title');
        load_grid_files();
        
        $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        if ($_POST) {
            validte_url(URL_PREFIX_CUSTOMERSERVICE);
            if ($this->form_validation->run()) {
                save_url(URL_PREFIX_CUSTOMERSERVICE);
                $message = array(
                    'msg_type' => 'success',
                    'msg_text' => lang('confirm_product_added_successfully')
                );

                $this->session->set_flashdata("message", $message);
                redirect('admin/feedback/');
            }
        } else {
            populate_url(URL_PREFIX_CUSTOMERSERVICE);
            validte_url(URL_PREFIX_CUSTOMERSERVICE);
            $this->form_validation->run();
        }
        $this->template->write_view('content', 'admin/feedback/index', $this->data, FALSE);
        $this->template->render();
    }

    function delete($feedback_id) {
        $feedback = FeedbacksTable::getInstance()->find($feedback_id);
        $feedback->delete();
        redirect('admin/feedback');
    }
    function view($feedback_id) {
        $feedback = FeedbacksTable::getInstance()->find($feedback_id);

        if ($feedback->is_new) {
            $feedback->is_new = 0;
            $feedback->save();
        }

        $this->data['page_title'] = $feedback->subject;
        $this->data['feedback'] = $feedback;
        $this->template->write_view('content', 'admin/feedback/view', $this->data, FALSE);
        $this->template->render();
    }

}

?>
