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

class Product extends My_Controller {

    var $_models = array(
        'tab' => 'ProductTabs',
        'pdf' => 'ProductPdfs',
        'prod' => 'Products',
        'image' => 'ProductImages',
        'tab_image' => 'TabImages',
    );

    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }

    /**
     * Index - Display the default page view
     */
    public function index() {

        $products = ProductsTable::getProducts('', false, false, true);

//        pre_print($products);
        $responce = array();
        if ($products) {
            foreach ($products as $key => $value) {
                $responce[$key]["prod_id"] = $value['prod_id'];
                foreach (get_lang_list() as $code => $lang) {
                    $prodDetail = ProductDetailsTable::getProductDetail($value['prod_id'], $code);
                    $responce[$key]["prod_title_$code"] = '<a href="' . site_url('admin/product/view/' . $value['prod_id']) . '">' . $prodDetail[0]['prod_title'] . '</a>';
                }
                $responce[$key]["prod_order"] = order_icon($value['prod_order'], 'product', 'prod', $value['prod_id']);
                $responce[$key]["tabs"] = count($value['ProductTabs']);
                $responce[$key]["prod_is_active"] = active_icon($value['prod_is_active'], 'product', 'prod', $value['prod_id']);
                $responce[$key]['prod_edit'] = '<a href="' . site_url('admin/product/edit/' . $value['prod_id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['prod_delete'] = '<a class="delete_lnk" href="' . site_url('admin/product/delete/' . $value['prod_id']) . '">' . lang('global_delete') . '</a>';
            }
        }
        $this->data['json'] = json_encode($responce);
        $this->data['page_title'] = lang('product_page_title');
        load_grid_files();
        $this->template->write_view('content', 'admin/product/index', $this->data, FALSE);
        $this->template->render();
    }

    public function view($prod_id) {
        $product = $this->check_product($prod_id);
        $productDetail = ProductDetailsTable::getProductDetail(
                        $product->prod_id, get_locale());
        
        $tabs = ProductTabsTable::getTabs($prod_id);

        $responce = array();
        if ($tabs) {
            foreach ($tabs as $key => $value) {
                $responce[$key]["tab_id"] = $value['tab_id'];
                foreach (get_lang_list() as $code => $lang) {
                    $tabDetail = Details::getDetail('TabDetails', 'tab_id', $value['tab_id'], $code);
                    $responce[$key]["tab_title_$code"] = '<a href="' . site_url('admin/product/edit_tab/' . $value['tab_id']) . '">' . $tabDetail[0]['tab_title'] . '</a>';
                }
                $responce[$key]["tab_order"] = order_icon($value['tab_order'], 'product', 'tab', $value['tab_id']);
                $responce[$key]["tab_is_active"] = active_icon($value['tab_is_active'], 'product', 'tab', $value['tab_id']);
                $responce[$key]['tab_edit'] = '<a href="' . site_url('admin/product/edit_tab/' . $value['tab_id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['tab_delete'] = '<a class="delete_lnk" href="' . site_url('admin/product/delete_tab/' . $value['tab_id']) . '">' . lang('global_delete') . '</a>';
                $responce[$key]['tab_images'] = '<a href="' . site_url('admin/product/tab_images/' . $value['tab_id']) . '">' . lang('prod_tab_manage_images') . '</a>';
            }
        }
        $this->data['prod_id'] = $prod_id;
        $this->data['tabs_json'] = json_encode($responce);

        $pdfs = Details::getList('ProductPdfs', 'pdf_order', 'prod_id', $prod_id);
        $responce = array();
        if ($pdfs) {
            foreach ($pdfs as $key => $value) {
                $responce[$key]["pdf_id"] = $value['pdf_id'];
                foreach (get_lang_list() as $code => $lang) {
                    $pdfDetail = Details::getDetail('PdfDetails', 'pdf_id', $value['pdf_id'], $code);
                    $responce[$key]["pdf_title_$code"] = '<a href="' . site_url('admin/product/edit_pdf/' . $value['pdf_id']) . '">' . $pdfDetail[0]['pdf_title'] . '</a>';
                }
                $responce[$key]["tab_id"] = ($value['tab_id'])? TabDetailsTable::getTabTitle($value['tab_id']):$productDetail[0]['prod_title'];
                $responce[$key]["pdf_order"] = order_icon($value['pdf_order'], 'product', 'pdf', $value['pdf_id']);
                $responce[$key]["pdf_is_active"] = active_icon($value['pdf_is_active'], 'product', 'pdf', $value['pdf_id']);
//                $value['pdf_is_active'];
                $responce[$key]['pdf_edit'] = '<a href="' . site_url('admin/product/edit_pdf/' . $value['pdf_id']) . '">' . lang('global_edit') . '</a>';
                $responce[$key]['pdf_delete'] = '<a class="delete_lnk" href="' . site_url('admin/product/delete_pdf/' . $value['pdf_id']) . '">' . lang('global_delete') . '</a>';
            }
        }
        
        $this->data['pdfs_json'] = json_encode($responce);

        $this->data['prodImages'] = ProductImagesTable::getImages($prod_id);
        
        load_grid_files();
        $this->data['page_title'] = sprintf(lang('product_list_details_page_title'), $productDetail[0]['prod_title']);
        $this->template->write_view('content', 'admin/product/view_product', $this->data, FALSE);
        $this->template->render();
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

    public function create() {

        $product = new Products();
        if ($product->processForm()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/product');
        }
        $this->data['page_title'] = lang('product_form_create_page_title');
        $this->template->write_view('content', 'admin/product/form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit($prod_id) {

        $product = $this->check_product($prod_id);
        $product->populateForm();
//        echo $_POST['prod_description_en-us'];exit;
        if ($this->process_form && $product->processForm()) {

            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/product');
        }
        $this->template->write_view('content', 'admin/product/form', $this->data, FALSE);
        $this->template->render();
    }

    public function delete($prod_id) {
        $product = $this->check_product($prod_id);
        $product->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/product');
    }

    public function add_tab($prod_id) {

        $product = $this->check_product($prod_id);
        $productDetail = ProductDetailsTable::getProductDetail(
                        $product->prod_id, get_locale());
        $this->data['page_title'] = sprintf(lang('product_tab_form_create_page_title'), $productDetail[0]['prod_title']);
        $this->data['prod_id'] = $prod_id;

        $tab = new ProductTabs();
        if ($tab->processForm($prod_id)) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/product/view/' . $prod_id);
        }

        $this->template->write_view('content', 'admin/product/tab_form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit_tab($tab_id) {
        $tab = $this->check_tab($tab_id);
        $tab->populateForm();
//        echo $_POST['tab_description_en-us'];exit;
        $productDetail = ProductDetailsTable::getProductDetail(
                        $tab->prod_id, get_locale());
        $tabDetails = TabDetailsTable::getInstance()
                ->findBySql('tab_id=? AND lang_id=?', array($tab->tab_id, get_language_id()), Doctrine_Core::HYDRATE_ARRAY);

        $this->data['page_title'] = sprintf(lang('product_tab_form_edit_page_title')
                , $tabDetails[0]['tab_title']
                , $productDetail[0]['prod_title']);
        $this->data['prod_id'] = $tab->prod_id;

        if ($this->process_form && $tab->processForm($tab->prod_id)) {

            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/product/view/' . $tab->prod_id);
        }
        $this->template->write_view('content', 'admin/product/tab_form', $this->data, FALSE);
        $this->template->render();
    }

    public function delete_tab($tab_id) {
        $tab = $this->check_tab($tab_id);
        $tab->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/product/view/' . $tab->prod_id);
    }

    public function tab_images($tab_id) {
        $tab=  ProductTabsTable::getInstance()->find($tab_id);
        $this->data['prod_id']=$tab->prod_id;
        $image = new TabImages();
        if ($image->processForm($tab_id)) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/product/tab_images/' . $tab_id);
        }

        $this->data['images'] = TabImagesTable::getTabImages($tab_id);

        $this->data['page_title'] = lang('prod_tab_manage_images');

        $this->template->add_css("layout/css/grid/jquery-ui-1.8.2.custom.css");
        $this->template->write_view('content', 'admin/product/tab_images', $this->data, FALSE);
        $this->template->render();
    }

    public function delete_tab_image($image_id) {
        $img = TabImagesTable::getInstance()
                ->find($image_id);
        $img->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/product/tab_images/' . $img->tab_id);
    }

    public function delete_image($image_id) {
        $tab = ProductImagesTable::getInstance()
                ->find($image_id);
        $tab->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/product/view/' . $tab->prod_id);
    }

    public function add_pdf($prod_id) {

        $product = $this->check_product($prod_id);
        $productDetail = ProductDetailsTable::getProductDetail(
                        $product->prod_id, get_locale());
        $this->data['page_title'] = sprintf(lang('product_pdf_form_create_page_title'), $productDetail[0]['prod_title']);
        $this->data['prod_id'] = $prod_id;
        $this->data['prod_title']=$productDetail[0]['prod_title'];
        $this->data['prod_tabs']=  ProductTabsTable::getTabs($prod_id, get_language_id(), true);
        
        $pdf = new ProductPdfs();
        if ($pdf->processForm($prod_id)) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/product/view/' . $prod_id);
        }

        $this->template->write_view('content', 'admin/product/pdf_form', $this->data, FALSE);
        $this->template->render();
    }

    public function edit_pdf($pdf_id) {
        $pdf = $this->check_pdf($pdf_id);
        $pdf->populateForm();

        $productDetail = ProductDetailsTable::getProductDetail(
                        $pdf->prod_id, get_locale());
        $pdfDetails = PdfDetailsTable::getInstance()
                ->findBySql('pdf_id=? AND lang_id=?', array($pdf->pdf_id, get_language_id()), Doctrine_Core::HYDRATE_ARRAY);

        $this->data['prod_title']=$productDetail[0]['prod_title'];
        $this->data['prod_tabs']=  ProductTabsTable::getTabs($pdf->prod_id, get_language_id(), true);
        $this->data['page_title'] = sprintf(lang('product_pdf_form_edit_page_title')
                , $pdfDetails[0]['pdf_title']
                , $productDetail[0]['prod_title']);
        $this->data['prod_id'] = $pdf->prod_id;

        if ($this->process_form && $pdf->processForm($pdf->prod_id)) {

            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('confirm_product_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/product/view/' . $pdf->prod_id);
        }
        $this->template->write_view('content', 'admin/product/pdf_form', $this->data, FALSE);
        $this->template->render();
    }

    public function delete_pdf($pdf_id) {
        $pdf = $this->check_pdf($pdf_id);
        $pdf->delete();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('notice_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);

        redirect('admin/product/view/' . $pdf->prod_id);
    }

    public function add_image($prod_id) {

        $image = new ProductImages();
        if ($image->processForm($prod_id)) {
            $_POST = array();
            $image->resetForm();
        }
        $this->data['prodImages'] = ProductImagesTable::getInstance()
                ->findBySql('prod_id=?', array($prod_id), Doctrine_Core::HYDRATE_ARRAY);
        $this->data['prod_id'] = $prod_id;
        $this->load->view('admin/product/product_images', $this->data);
    }

    private function check_product($prod_id) {

        $product = ProductsTable::getInstance()->findOneBy('prod_id', $prod_id);
        if (!$prod_id) {
            $message = array(
                'msg_type' => 'error',
                'msg_text' => lang('error_no_such_item')
            );

            $this->session->set_flashdata("message", $message);

            redirect('admin/product');
        }

        return $product;
    }

    private function check_tab($tab_id) {

        $tab = ProductTabsTable::getInstance()->findOneBy('tab_id', $tab_id);
        if (!$tab) {
            $message = array(
                'msg_type' => 'error',
                'msg_text' => lang('error_no_such_item')
            );

            $this->session->set_flashdata("message", $message);

            redirect('admin/product/view/' . $tab->prod_id);
        }

        return $tab;
    }

    /**
     *
     * @param int $pdf_id
     * @return ProductPdfs 
     */
    private function check_pdf($pdf_id) {

        $pdf = ProductPdfsTable::getInstance()->findOneBy('pdf_id', $pdf_id);

        if (!$pdf) {
            $message = array(
                'msg_type' => 'error',
                'msg_text' => lang('error_no_such_item')
            );

            $this->session->set_flashdata("message", $message);

            redirect('admin/product/view/' . $pdf->prod_id);
        }

        return $pdf;
    }

    private function activation($model, $id, $new_state) {
        $modelClass = $this->_models[$model] . 'Table';
        $obj = $modelClass::getInstance()
                ->find($id);
        $active_field = ($model == 'tab_image') ? 'image_is_active' : $model . '_is_active';
        $obj->$active_field = $new_state;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        $this->session->set_flashdata("message", $message);
        if ($model == 'prod')
            redirect('admin/product');
        elseif ($model == 'tab_image') {
            redirect('admin/product/tab_images/' . $obj->tab_id);
        } else {
            redirect('admin/product/view/' . $obj->prod_id);
        }
    }

    private function change_order($model, $id, $new_order) {
        $modelClass = $this->_models[$model] . 'Table';
        $obj = $modelClass::getInstance()
                ->find($id);

        $order_field = ($model == 'tab_image') ? 'image_order' : $model . '_order';

        $obj->$order_field = $new_order;
        $obj->save();

        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('confirm_product_added_successfully')
        );

        $this->session->set_flashdata("message", $message);
        if ($model == 'prod')
            redirect('admin/product');
        elseif ($model == 'tab_image') {
            redirect('admin/product/tab_images/' . $obj->tab_id);
        }else {
            redirect('admin/product/view/' . $obj->prod_id);
        }
    }

}

/* End of file: dashboard.php */
/* Location: ./application/core/dashboard.php */
?>
