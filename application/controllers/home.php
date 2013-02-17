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

class Home extends My_Controller {

    function __construct() {
        parent::__construct();
        load_common_data();
    }

    /**
     * Index - Display the default page view
     */
    public function index() {

        $this->data['banners'] = BannersTable::getHomeBanners();
        $this->data['about_us'] = PagesTable::getPageData('about-us');
        $this->data['latest_news'] = ArticlesTable::getLatestNews();
        $this->data['page_title'] = 'Home Page';
//        $this->data['products']=  ProductsTable::getProducts(get_language_id(), TRUE, true);
//        pre_print($this->data['about_us']);

        $url = UrlsTable::getInstance()->findOneBy('url_original', URL_PREFIX_HOME, Doctrine_Core::HYDRATE_ARRAY);
        $this->data['page_title'] = $url['url_meta_title'];

        // get the vedio URL
        $myFile = "uploads/vedio_url.txt";
        $video = unserialize(file_get_contents($myFile));

        $this->data['video_url'] = $video['video_url'];
        $this->data['video_img'] = ($video['video_img'] && file_exists(trim($video['video_img'], '/'))) ?
                $video['video_img'] : base_url() . ('layout/images/video_placeholder.png');
//        pre_print($this->data);
        $this->template->add_css('layout/css/themes/default/default.css');
        $this->template->add_css('layout/css/themes/light/light.css');
        $this->template->add_css('layout/css/themes/dark/dark.css');
        $this->template->add_css('layout/css/themes/bar/bar.css');
        $this->template->add_css('layout/css/nivo-slider.css');
        $this->template->add_js('layout/js/jquery.nivo.slider.js');
        $this->template->add_js('layout/js/popup.js');
        $this->template->add_css('layout/css/popup.css');
        $this->template->write_view('content', 'home/index', $this->data, FALSE);
        $this->template->render();
    }

    public function page($id) {
        if ($id == 'contact-us') {
            $this->contact_us();
        } else {
            $page_data = PagesTable::getPageData($id);
            $page = PagesTable::getInstance()->find($page_data['page_id']);
            $this->data['page_content'] = $page_data['content'];
            $this->data['page_title'] = $page_data['title'];
            $this->data['banner_path'] = $page->page_banner;
            $this->data['pageImages'] = PageImagesTable::getPageImages($page_data['page_id']);
            $this->template->write_view('content', 'home/page', $this->data, FALSE);
            $this->template->render();
        }
    }

    public function view_news($id) {
        $page_data = NewsDetailsTable::getInstance()->findOneBy('news_id', $id, Doctrine_Core::HYDRATE_ARRAY);
        $this->data['page_content'] = $page_data['news_description'];
        $this->data['page_title'] = $page_data['news_title'];
        $this->template->write_view('content', 'home/news_details', $this->data, FALSE);
        $this->template->render();
    }

    public function product($prod_id) {
        $this->load_product_info($prod_id);
    }

    function tab($tab_id) {
        $tabDetails = array_shift(TabDetailsTable::getInstance()
                        ->findBySql('tab_id =? AND lang_id=?', array($tab_id, get_language_id()), Doctrine_Core::HYDRATE_ARRAY));

        $this->data['page_title'] = $tabDetails['tab_title'];
        $this->data['page_content'] = $tabDetails['tab_description'];
        $tab = ProductTabsTable::getInstance()->find($tab_id);

        $this->data['prod_imagges'] = TabImagesTable::getTabImages($tab->tab_id, TRUE);
        $this->data['pdfs'] = ProductPdfsTable::getAllProductPDFs($tab->prod_id, get_language_id(), $tab_id);
        $this->load_product_info($tab->prod_id, FALSE);
    }

    function load_product_info($prod_id, $prod_page = true) {
        $prodDetails = array_shift(ProductDetailsTable::getInstance()
                        ->findBySql('prod_id =? AND lang_id=?', array($prod_id, get_language_id()), Doctrine_Core::HYDRATE_ARRAY));

        if ($prod_page) {
            $this->data['page_title'] = $prodDetails['prod_title'];
            $this->data['page_content'] = $prodDetails['prod_description'];
        }

        $this->data['prod_title'] = $prodDetails['prod_title'];

        $product = ProductsTable::getInstance()->findOneBy('prod_id', $prod_id, Doctrine_Core::HYDRATE_ARRAY);
        $this->data['prod_banner'] = $product['prod_banner'];

        if (!isset($this->data['prod_imagges']) || !$this->data['prod_imagges'])
            $this->data['prod_imagges'] = ProductImagesTable::getImages($prod_id,'',true);
        $this->data['prod_tabs'] = ProductTabsTable::getTabs($prod_id, get_language_id(), true, true);
        $this->data['prod_id'] = $prod_id;
        if (!isset($this->data['pdfs']))
            $this->data['pdfs'] = ProductPdfsTable::getAllProductPDFs($prod_id, get_language_id());
//        pre_print($this->data['pdfs']);

        $this->template->write_view('content', 'home/product', $this->data, FALSE);
        $this->template->render();
    }

    function faq($formatted = 'none') {
        $this->data['faqs'] = FaqsTable::getFaqs(true, true);
//        echo more_less_str(strip_tags($this->data['faqs'][4]['FaqDetails'][0]['faq_answer'],'<br>'));exit;

        $url = UrlsTable::getInstance()->findOneBy('url_original', URL_PREFIX_FAQS, Doctrine_Core::HYDRATE_ARRAY);
        $this->data['banner_path'] = get_banner_bath("URL_PREFIX_FAQS");
        $this->data['page_title'] = $url['url_page_title'];
        $this->data['formatted'] = $formatted;
        $this->template->write_view('content', 'home/faq', $this->data, FALSE);
        $this->template->render();
    }

    function worldwide() {
        $url = UrlsTable::getInstance()->findOneBy('url_original', URL_PREFIX_WORLDWIDE, Doctrine_Core::HYDRATE_ARRAY);

        $this->data['page_title'] = $url['url_page_title'];

        $this->data['countries'] = CountriesTable::getCountries();

        $this->data['banner_path'] = get_banner_bath("URL_PREFIX_WORLDWIDE");

        $this->template->write_view('content', 'home/worldwide', $this->data, FALSE);
        $this->template->render();
    }

    function country_products($country_id) {
        $this->data['products'] = ProductDetailsTable::getProductsForCountry($country_id);

        $this->load->view('home/_country_products', $this->data);
    }

    function product_agents($prod_id, $country_id) {
        $this->data['agents'] = ProductAgentsTable::getAgentsForProduct($prod_id, $country_id);
        $this->lang->load('worldwide');
//        pre_print($this->data['agents']);
        $this->load->view('home/_product_agents', $this->data);
    }

    function country_agents($country_id) {
        $this->data['agents'] = ProductAgentsTable::getAgentsForCountry($country_id);
        $this->lang->load('worldwide');
//        pre_print($this->data['agents']);
        $this->load->view('home/_country_agents', $this->data);
    }

    function customer_services() {
        if ($this->input->post('submit')) {
            switch ($this->input->post('department_id')) {
                case '1':
                    $body = '<p><strong>Department: </strong>' . lang('product_cfc') . '<p>';
                    $email = 'cfc@asfourcrystal.com';
                    break;
                case '2':
                    $body = '<p><strong>Department: </strong>' . lang('product_cparts') . '<p>';
                    $email = 'crystal.parts@asfourcrystal.com';
                    break;
                case '3':
                    $body = '<p><strong>Department: </strong>' . lang('product_lighting') . '<p>';
                    $email = 'lighting@asfourcrystal.com';
                    break;
                case '4':
                    $body = '<p><strong>Department: </strong>' . lang('product_gifts') . '<p>';
                    $email = 'gifts@asfourcrystal.com';
                    break;
                case '5':
                    $body = '<p><strong>Department: </strong>' . lang('product_crys_tie') . '<p>';
                    $email = 'crystile@asfourcrystal.com';
                    break;
            }

            $body .= '<p><strong>Name: </strong>' . $this->input->post('name') . '</p>';
            $body .= '<p><strong>Country: </strong>' . $this->input->post('country_id') . '</p>';
            $body .= '<p><strong>Tel.: </strong>' . $this->input->post('tel') . '</p>';
            $body .= '<p><strong>Email: </strong><a href="mailto:' . $this->input->post('email') . '" >' . $this->input->post('email') . '</a></p>';
            $body .= '<p><strong>Message: </strong>' . $this->input->post('message') . '</p>';
            send_email($email, 'Customer Service Form', $body);

            $this->session->set_flashdata('msg', lang('home_form_submit_success'));
            redirect(site_url('customer-services'));
        }

        $url = UrlsTable::getInstance()->findOneBy('url_original', URL_PREFIX_CUSTOMERSERVICE, Doctrine_Core::HYDRATE_ARRAY);
        $this->data['page_title'] = $url['url_meta_title'];
        $this->data['countries'] = CountriesTable::getCountries();
        $this->data['contact_us'] = 'active';
        $this->data['banner_path'] = get_banner_bath("URL_PREFIX_CUSTOMERSERVICE");

        $this->template->add_css('layout/css/form.css');
        $this->template->add_js('layout/js/jquery.validate.js');
        $this->template->write_view('content', 'home/customer_service', $this->data, FALSE);
        $this->template->render();
    }

    function media_center($type = 'news') {

        $url = UrlsTable::getInstance()->findOneBy('url_original', ($type == 'news') ? URL_PREFIX_ALL_NEWS : URL_PREFIX_ALL_PRESS_RELEASE, Doctrine_Core::HYDRATE_ARRAY);

        $this->data['page_title'] = $url['url_page_title'];

        $this->data['news'] = NewsDetailsTable::gelAllNews(($type == 'news') ? 1 : 2);

        $this->data['news_count'] = NewsDetailsTable::getNewsCount(1);
        $this->data['press_count'] = NewsDetailsTable::getNewsCount(2);
        $this->data['banner_path'] = get_banner_bath("URL_PREFIX_MEDIACENTER");
//        pre_print($this->data);
        $this->data['type'] = $type;
        $this->template->write_view('content', 'home/media_center', $this->data, FALSE);
        $this->template->render();
    }

    function press_release() {
        $this->media_center('press_release');
    }

    function media_contacts() {
        $this->data['page_title'] = 'Media Contacts';
        $this->data['media_contacts'] = MediaContactsTable::getAllMediaContacts();
//        pre_print($this->data['media_contacts']);
        $this->data['mc'] = 'active';
        $this->template->write_view('content', 'home/media_contacts', $this->data, FALSE);
        $this->template->render();
    }

    function contact_us() {
        if ($this->input->post('submit')) {
            switch ($this->input->post('department_id')) {
                case '1':
                    $body = '<p><strong>Department: </strong>' . lang('product_cfc') . '<p>';
                    $email = 'cfc@asfourcrystal.com';
                    break;
                case '2':
                    $body = '<p><strong>Department: </strong>' . lang('product_cparts') . '<p>';
                    $email = 'crystal.parts@asfourcrystal.com';
                    break;
                case '3':
                    $body = '<p><strong>Department: </strong>' . lang('product_lighting') . '<p>';
                    $email = 'lighting@asfourcrystal.com';
                    break;
                case '4':
                    $body = '<p><strong>Department: </strong>' . lang('product_gifts') . '<p>';
                    $email = 'gifts@asfourcrystal.com';
                    break;
                case '5':
                    $body = '<p><strong>Department: </strong>' . lang('product_crys_tie') . '<p>';
                    $email = 'crystile@asfourcrystal.com';
                    break;
            }

            $body .= '<p><strong>Name: </strong>' . $this->input->post('name') . '</p>';
            $body .= '<p><strong>Company: </strong>' . $this->input->post('company') . '</p>';
            $body .= '<p><strong>Country: </strong>' . $this->input->post('country_id') . '</p>';
            $body .= '<p><strong>Tel.: </strong>' . $this->input->post('tel') . '</p>';
            $body .= '<p><strong>Email: </strong><a href="mailto:' . $this->input->post('email') . '" >' . $this->input->post('email') . '</a></p>';
            $body .= '<p><strong>Message: </strong>' . $this->input->post('message') . '</p>';
            send_email($email, 'Contact Us Form', $body);

            $this->session->set_flashdata('msg', lang('home_form_submit_success'));
            redirect(site_url('home/contact_us'));
        }

        $page_data = PagesTable::getPageData('contact-us');
        $this->data['page_content'] = $page_data['content'];

        $this->data['page_title'] = 'Contact Us';
        $this->data['countries'] = CountriesTable::getCountries();

        $this->data['contact_us'] = 'active';
        $this->data['banner_path'] = get_banner_bath("URL_PREFIX_CONTACT_US");
        $this->template->add_css('layout/css/form.css');
        $this->template->add_js('layout/js/jquery.validate.js');
        $this->template->write_view('content', 'home/contact_us', $this->data, FALSE);
        $this->template->render();
    }

    function showrooms() {
        $url = UrlsTable::getInstance()->findOneBy('url_original', URL_PREFIX_SHOWROOMS, Doctrine_Core::HYDRATE_ARRAY);

        $this->data['page_title'] = $url['url_page_title'];

        $this->data['showrooms'] = ShowroomsLocationsTable::getAllShowroomsLocations();

        $this->data['active_showrooms'] = 'active';

        $this->data['banner_path'] = get_banner_bath("URL_PREFIX_CONTACT_US");

        $this->template->write_view('content', 'home/showrooms', $this->data, FALSE);
        $this->template->render();
    }

    function become_agent() {
        if ($this->input->post('submit')) {
            switch ($this->input->post('department_id')) {
                case '1':
                    $body = '<p><strong>Department: </strong>' . lang('product_cfc') . '<p>';
                    $email = 'cfc@asfourcrystal.com';
                    break;
                case '2':
                    $body = '<p><strong>Department: </strong>' . lang('product_cparts') . '<p>';
                    $email = 'crystal.parts@asfourcrystal.com';
                    break;
                case '3':
                    $body = '<p><strong>Department: </strong>' . lang('product_lighting') . '<p>';
                    $email = 'lighting@asfourcrystal.com';
                    break;
                case '4':
                    $body = '<p><strong>Department: </strong>' . lang('product_gifts') . '<p>';
                    $email = 'gifts@asfourcrystal.com';
                    break;
                case '5':
                    $body = '<p><strong>Department: </strong>' . lang('product_crys_tie') . '<p>';
                    $email = 'crystile@asfourcrystal.com';
                    break;
            }

            $body .= '<p><strong>Name: </strong>' . $this->input->post('name') . '</p>';
            $body .= '<p><strong>Company: </strong>' . $this->input->post('company') . '</p>';
            $body .= '<p><strong>Country: </strong>' . $this->input->post('country_id') . '</p>';
            $body .= '<p><strong>Tel.: </strong>' . $this->input->post('tel') . '</p>';
            $body .= '<p><strong>Email: </strong><a href="mailto:' . $this->input->post('email') . '" >' . $this->input->post('email') . '</a></p>';
            $body .= '<p><strong>Message: </strong>' . $this->input->post('message') . '</p>';
            send_email($email, 'Become an Agent Form', $body);

            $this->session->set_flashdata('msg', lang('home_form_submit_success'));

            redirect(site_url('home/become_agent'));
        }

        $url = UrlsTable::getInstance()->findOneBy('url_original', URL_PREFIX_BE_AGENT, Doctrine_Core::HYDRATE_ARRAY);
        $this->data['page_title'] = $url['url_page_title'];

        $this->data['banner_path'] = get_banner_bath("URL_PREFIX_WORLDWIDE");
        $this->data['page_title'] = 'Become an Agent';
        $this->data['countries'] = CountriesTable::getCountries();

        $this->template->add_css('layout/css/form.css');
        $this->template->add_js('layout/js/jquery.validate.js');
        $this->template->write_view('content', 'home/become_agent', $this->data, FALSE);
        $this->template->render();
    }

    public function careers($job_id = '') {
        $this->lang->load('careers');
        $this->data['page_title'] = 'Careers';

        $page_data = PagesTable::getPageData('careers');
        $page = PagesTable::getInstance()->find($page_data['page_id']);
        $this->data['banner_path'] = $page->page_banner;
        if (!$job_id) {

            $this->data['page_content'] = $page_data['content'];
            $this->data['jobs'] = JobsTable::getJobs(get_language_id(), true, true);
            $this->template->write_view('content', 'home/careers', $this->data, FALSE);
        } else {
            $this->data['job'] = JobsTable::getJob($job_id);
            $this->template->write_view('content', 'home/job_details', $this->data, FALSE);
        }
        $this->template->render();
    }

    public function sitemap() {
        $this->data['page_title'] = 'Sitemap';

        $this->template->write_view('content', 'home/sitemap', $this->data, FALSE);
        $this->template->render();
    }

    public function notfound() {

        $this->template->write_view('content', 'home/notfound', $this->data, FALSE);
        $this->template->render();
    }

}

/* End of file: dashboard.php */
/* Location: ./application/core/dashboard.php */
?>
