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

class Careers extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    public function index() {
        $jobs = JobsTable::getJobs();

//        pre_print($jobs);
        $responce = array();
        if ($jobs) {
            foreach ($jobs as $key => $value) {
                $responce[$key]["job_id"] = $value['job_id'];
                $responce[$key]["job_code"] = $value['job_code'];
                foreach (get_lang_list() as $code => $lang) {
                    $jobDetail = JobDetailsTable::getJobDetail($value['job_id'], $code);
                    $responce[$key]["job_title_$code"] = '<a href="' . site_url('admin/careers/edit/' . $value['job_id']) . '">' . $jobDetail[0]['job_title'] . '</a>';
                }
                $responce[$key]["job_order"] = order_icon($value['job_order'], 'careers', 'job', $value['job_id']);
//                $responce[$key]["job_order"] = order_icon($value['job_order'],'careers','job',$value['job_id']);
                $responce[$key]["job_is_active"] = active_icon($value['job_is_active'], 'careers', 'job', $value['job_id']);
                $responce[$key]['job_edit'] = '<a href="' . site_url('admin/careers/edit/' . $value['job_id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['job_delete'] = '<a class="delete_lnk" href="' . site_url('admin/careers/delete/' . $value['job_id']) . '">' . lang('global_delete') . '</a>';
            }
        }
//        pre_print($responce);
//        
        $this->lang->load('page');
        /* @var Pages $page */
        $page = PagesTable::getInstance()->findOneBy('slug', 'careers');
        $page->populateContentForm();
        if ($this->process_form){    
            $page->processContentForm();
        }

        $this->data['json'] = json_encode($responce);
        $this->data['page_title'] = lang('careers_page_title');
        load_grid_files();
        $this->template->write_view('content', 'admin/careers/index', $this->data, FALSE);
        $this->template->render();
    }

    public function create() {

        $this->data['page_title'] = lang('careers_form_create_page_title');

        $job = new Jobs();
        if ($job->processForm()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/careers/');
        }

        $this->template->write_view('content', 'admin/careers/form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit($job_id) {
        $jobs = $this->check($job_id);
        $jobs->populateForm();

        $this->data['page_title'] = lang('careers_form_edit_page_title');

        if ($this->process_form && $jobs->processForm()) {

            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/careers');
        }
        $this->template->write_view('content', 'admin/careers/form', $this->data, FALSE);
        $this->template->render();
    }

    /**
     *
     * @param int $faqs_id
     * @return Faqs 
     */
    private function check($jobs_id) {

        $jobs = JobsTable::getInstance()->findOneBy('job_id', $jobs_id);
        if (!$jobs) {
            $message = array(
                'msg_type' => 'error',
                'msg_text' => lang('error_no_such_item')
            );

            $this->session->set_flashdata("message", $message);

            redirect('admin/careers/');
        }

        return $jobs;
    }

    public function activate($model, $id) {
        $this->activation($model, $id, 1);
    }

    public function deactivate($model, $id) {
        $this->activation($model, $id, 0);
    }

    private function activation($model, $id, $new_state) {
        $obj = JobsTable::getInstance()
                ->find($id);

        $obj->job_is_active = $new_state;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );
        $this->session->set_flashdata("message", $message);
        redirect('admin/careers');
    }

    public function orderup($model, $id, $order) {
        $this->change_order($model, $id, $order - 1);
    }

    public function orderdown($model, $id, $order) {
        $this->change_order($model, $id, $order + 1);
    }

    private function change_order($model, $id, $new_order) {

        $obj = JobsTable::getInstance()
                ->find($id);

        $obj->job_order = $new_order;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/careers');
    }

    public function delete($job_id) {
        $jobs = $this->check($job_id);
        $jobs->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/careers');
    }

}