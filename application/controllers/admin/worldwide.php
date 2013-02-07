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

class Worldwide extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    public function index() {

        $agents = AgentsTable::getAgents();

        $responce = array();
        foreach ($agents as $key => $value) {
            $responce[$key]['agent_id'] = $value['agent_id'];
            foreach ($value['AgentDetails']['0'] as $field => $v) {
                $responce[$key][$field] = $v;
            }
            $responce[$key]['agent_country'] = $value['Countries']['country_name'];
            $responce[$key]['agent_products'] = '';
            foreach ($value['ProductAgents'] as $product) {
                $responce[$key]['agent_products'].=',' . $product['Products']['ProductDetails'][0]['prod_title'];
            }
            $responce[$key]['agent_products'] = trim($responce[$key]['agent_products'], ',');

            $responce[$key]["agent_order"] = order_icon($value['agent_order'], 'worldwide', 'agent', $value['agent_id']);
            $responce[$key]["agent_is_active"] = active_icon($value['agent_is_active'], 'worldwide', 'agent', $value['agent_id']);
            $responce[$key]['agent_edit'] = '<a href="' . site_url('admin/worldwide/edit/' . $value['agent_id']) . '">' . lang('global_edit') . '</a>';
            $responce[$key]['agent_delete'] = '<a class="delete_lnk" href="' . site_url('admin/worldwide/delete/' . $value['agent_id']) . '">' . lang('global_delete') . '</a>';
        }
        $this->data['agents_json'] = json_encode($responce);
        $this->data['page_title'] = lang('worldwide_index_page_title');
        load_grid_files();
        $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        if ($_POST) {
            validte_url(URL_PREFIX_WORLDWIDE);
            validte_url(URL_PREFIX_BE_AGENT,'be_agent_');
            if ($this->form_validation->run()) {
                save_url(URL_PREFIX_WORLDWIDE);
                save_url(URL_PREFIX_BE_AGENT,FALSE,'be_agent_');
                $message = array(
                    'msg_type' => 'success',
                    'msg_text' => lang('confirm_product_added_successfully')
                );

                $this->session->set_flashdata("message", $message);
                redirect('admin/worldwide/');
            }
        } else {
            populate_url(URL_PREFIX_WORLDWIDE);
            validte_url(URL_PREFIX_WORLDWIDE);
            
            populate_url(URL_PREFIX_BE_AGENT,'be_agent_');
            validte_url(URL_PREFIX_BE_AGENT,'be_agent_');
            
            $this->form_validation->run();
        }
        $this->template->write_view('content', 'admin/worldwide/index', $this->data, FALSE);
        $this->template->render();
    }

    public function create() {
        $agent = new Agents();
        if ($agent->processForm()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/worldwide');
        }
        $this->data['page_title'] = lang('worldwide_crete_page_title');
        $this->template->write_view('content', 'admin/worldwide/form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit($agent_id) {
        $agent = $this->check_agent($agent_id);

        $agent->populate();
//        pre_print($_POST);
        if ($this->process_form && $agent->processForm()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/worldwide');
        }
        $this->template->write_view('content', 'admin/worldwide/form', $this->data, FALSE);
        $this->template->render();
    }

    public function delete($agent_id) {
        $agent = $this->check_agent($agent_id);
        $agent->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/worldwide');
    }

    public function activate($model, $id) {
        $this->activation($model, $id, 1);
    }

    public function deactivate($model, $id) {
        $this->activation($model, $id, 0);
    }

    private function activation($model, $id, $new_state) {
        $obj = AgentsTable::getInstance()
                ->find($id);

        $obj->agent_is_active = $new_state;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );
        $this->session->set_flashdata("message", $message);
        redirect('admin/worldwide');
    }

    public function orderup($model, $id, $order) {
        $this->change_order($model, $id, $order - 1);
    }

    public function orderdown($model, $id, $order) {
        $this->change_order($model, $id, $order + 1);
    }

    private function change_order($model, $id, $new_order) {

        $obj = AgentsTable::getInstance()
                ->find($id);

        $obj->agent_order = $new_order;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/worldwide');
    }

    /**
     *
     * @param type $agent_id
     * @return Agents 
     */
    private function check_agent($agent_id) {
        $agent = AgentsTable::getInstance()->findOneBy('agent_id', $agent_id);
        if (!$agent) {
            $message = array(
                'msg_type' => 'error',
                'msg_text' => lang('error_no_such_item')
            );

            $this->session->set_flashdata("message", $message);

            redirect('admin/worldwide/');
        }

        return $agent;
    }

    public function countries($country_id=''){
        
        if($country_id){
            $country= CountriesTable::getInstance()->find($country_id);
            $country->populate();
        }
        else
            $country = new Countries();
        if ($this->process_form&&$country->processForm()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );
            $this->session->set_flashdata("message", $message);
            redirect('admin/worldwide/countries');
        }
        $this->data['countries']=  CountriesTable::getCountries();
        
        $this->data['page_title'] = lang('worldwide_manage_countries_page_title');
        
        $this->template->write_view('content', 'admin/worldwide/countries', $this->data, FALSE);
        $this->template->render();
    }
    
    public function delete_country($country_id){
        $country= CountriesTable::getInstance()->find($country_id);
        $country->delete();
        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/worldwide/countries');
    }
}