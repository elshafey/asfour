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

class News extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    public function index() {
        $news = ArticlesTable::getNews();

        $responce = array();
        if ($news) {
            foreach ($news as $key => $value) {
                $responce[$key]["news_id"] = $value['news_id'];
                foreach (get_lang_list() as $code => $lang) {
                    $newsDetail = Details::getDetail('NewsDetails', 'news_id', $value['news_id'], $code);
                    $responce[$key]["news_title_$code"] = '<a href="' . site_url('admin/news/edit/' . $value['news_id']) . '">' . $newsDetail[0]['news_title'] . '</a>';
                }
                $responce[$key]["news_created_at"] = substr($value['news_created_at'],0,10);
                $responce[$key]["news_is_active"] = active_icon($value['news_is_active'], 'news', 'article', $value['news_id']);
                $news_type = 'News';
                if ($newsDetail[0]['news_type'] == 2) {
                    $news_type = 'Press Release';
                }
                $responce[$key]["news_type"] = $news_type;
                $responce[$key]['news_edit'] = '<a href="' . site_url('admin/news/edit/' . $value['news_id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['news_delete'] = '<a class="delete_lnk" href="' . site_url('admin/news/delete/' . $value['news_id']) . '">' . lang('global_delete') . '</a>';
            }
        }

        $this->data['news_json'] = json_encode($responce);
        load_grid_files();

        $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');

        if ($_POST) {
            validte_url(URL_PREFIX_ALL_NEWS);
            validte_url(URL_PREFIX_ALL_PRESS_RELEASE, 'press_');
            if ($this->form_validation->run()) {
                save_url(URL_PREFIX_ALL_PRESS_RELEASE, FALSE, 'press_');
                save_url(URL_PREFIX_ALL_NEWS);

                $message = array(
                    'msg_type' => 'success',
                    'msg_text' => lang('confirm_product_added_successfully')
                );

                $this->session->set_flashdata("message", $message);
                redirect('admin/news/');
            }
        } else {
            //news populate
            populate_url(URL_PREFIX_ALL_NEWS);
            validte_url(URL_PREFIX_ALL_NEWS);

            //press release populate
            populate_url(URL_PREFIX_ALL_PRESS_RELEASE, 'press_');
            validte_url(URL_PREFIX_ALL_PRESS_RELEASE, 'press_');

            $this->form_validation->run();
        }


        $this->data['page_title'] = lang('news_title');
        $this->template->write_view('content', 'admin/news/index', $this->data, FALSE);
        $this->template->render();
    }

    public function create() {

        $this->data['page_title'] = lang('news_form_create_page_title');

        $new = new Articles();
        if ($new->processForm()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/news/');
        }
        $this->template->add_css("layout/css/jquery-ui.css");
        $this->template->add_js("layout/js/jquery/jquery-ui.min.js");
        $this->template->write_view('content', 'admin/news/form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit($news_id) {
        $news = $this->check($news_id);
        $news->populateForm();

        $this->data['page_title'] = sprintf(lang('news_form_edit_page_title'), $_POST['news_title_' . get_locale()]);

        if ($this->process_form && $news->processForm()) {

            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/news');
        }
        $this->template->add_css("layout/css/grid/jquery-ui-1.8.2.custom.css");
        $this->template->add_js("layout/js/jquery/jquery-ui.min.js");
        $this->template->write_view('content', 'admin/news/form', $this->data, FALSE);
        $this->template->render();
    }

    public function delete($news_id) {
        $news = $this->check($news_id);
        $news->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/news');
    }

    /**
     *
     * @param int $news_id
     * @return Articles 
     */
    private function check($news_id) {

        $news = ArticlesTable::getInstance()->findOneBy('news_id', $news_id);
        if (!$news) {
            $message = array(
                'msg_type' => 'error',
                'msg_text' => lang('error_no_such_item')
            );

            $this->session->set_flashdata("message", $message);

            redirect('admin/news/');
        }

        return $news;
    }

    public function activate($model, $id) {
        $this->activation($model, $id, 1);
    }

    public function deactivate($model, $id) {
        $this->activation($model, $id, 0);
    }

    private function activation($model, $id, $new_state) {
        $obj = ArticlesTable::getInstance()
                ->find($id);

        $obj->news_is_active = $new_state;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );
        $this->session->set_flashdata("message", $message);
        redirect('admin/news');
    }

}