<?php

function static_url() {
    $CI = & get_instance();
    return $CI->config->item('static_url');
}

function is_ajax() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
        return true;
    }

    return false;
}

function check_is_set($field_name) {
    if (isset($_POST[$field_name]) && $_POST[$field_name] != 0)
        return true;

    return false;
}

function pre_print($obj, $with_exit = true) {
    echo "<pre>";
    print_r($obj);
    if ($with_exit)
        exit;
}

function get_seeker_job_template() {
    return ' - <a target="_blank" href="' . base_url()
            . 'ef/profile/view_vacancy/' . '%s'
            . '" style="color: rgb(40, 144, 182);">' . '%s'
            . '</a> - ' . '%s';
}

function print_url_info($home = false, $prefix = '', $with_page_title = false) {
    if (!$home) {
        ?>
        <li>
            <label><?php echo lang('url_routed') ?>:</label>
            <input type="text" class="txtbox" name="<?php echo $prefix ?>url_routed" value="<?php echo set_value($prefix . 'url_routed') ?>" />
            <span class="star">*</span>
            <?php echo form_error("{$prefix}url_routed"); ?>
        </li>
    <?php } ?>
    <li>
        <label><?php echo lang('url_meta_keywords') ?>:</label>
        <input type="text" class="txtbox" name="<?php echo $prefix ?>url_meta_keywords" value="<?php echo set_value($prefix . 'url_meta_keywords') ?>" />
    <!--        <span class="star">*</span>-->
        <?php echo form_error("{$prefix}url_meta_keywords"); ?>
    </li>
    <li>
        <label><?php echo lang('url_meta_title') ?>:</label>
        <input type="text" class="txtbox" name="<?php echo $prefix ?>url_meta_title" value="<?php echo set_value($prefix . 'url_meta_title') ?>" />
    <!--        <span class="star">*</span>-->
        <?php echo form_error("{$prefix}url_meta_title"); ?>
    </li>
    <?php if ($with_page_title) { ?>
        <li>
            <label><?php echo lang('url_page_title') ?>:</label>
            <input type="text" class="txtbox" name="<?php echo $prefix ?>url_page_title" value="<?php echo set_value($prefix . 'url_page_title') ?>" />
            <?php echo form_error("{$prefix}url_page_title"); ?>
        </li>
    <?php } ?>
    <li>
        <label><?php echo lang('url_meta_description') ?>:</label>
        <textarea name="<?php echo $prefix ?>url_meta_description" ><?php echo set_value($prefix . 'url_meta_description') ?></textarea>
    <!--        <span class="star">*</span>-->
        <?php echo form_error("{$prefix}url_meta_description"); ?>
    </li>
    <?php
}

function save_url($url_original, $home = false, $prefix = '') {
    $url = UrlsTable::getInstance()->findOneBy('url_original', $url_original);
    if (!$url)
        $url = new Urls();
    if (!$home) {
        $url->url_original = $url_original;
        $url->url_routed = $_POST[$prefix . 'url_routed'];
    }
    if (isset($_POST[$prefix . 'url_page_title'])) {
        $url->url_page_title = $_POST[$prefix . 'url_page_title'];
    }
    $url->url_meta_title = $_POST[$prefix . 'url_meta_title'];
    $url->url_meta_keywords = $_POST[$prefix . 'url_meta_keywords'];
    $url->url_meta_description = $_POST[$prefix . 'url_meta_description'];
    $url->save();

    $urls = UrlsTable::getInstance()->findAll(Doctrine_Core::HYDRATE_ARRAY);
    if ($urls) {
        $php_code = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
";
        foreach ($urls as $url) {
            $php_code.=sprintf(ROUTS_ITEM_TEMPLATE, $url['url_routed'], $url['url_original']) . '
';
        }
    }
    file_put_contents('application/config/auto_routes.php', $php_code);
}

function delete_url($url_original) {
    Doctrine_Query::create()
            ->delete()
            ->from('Urls')
            ->where('url_original=', $url_original)
            ->execute();
}

function populate_url($url_original, $prefix = '') {
    $url = UrlsTable::getInstance()->findOneBy('url_original', $url_original);
    if ($url) {
        $_POST[$prefix . 'url_routed'] = $url->url_routed;
        $_POST[$prefix . 'url_meta_title'] = $url->url_meta_title;
        $_POST[$prefix . 'url_page_title'] = $url->url_page_title;
        $_POST[$prefix . 'url_meta_keywords'] = $url->url_meta_keywords;
        $_POST[$prefix . 'url_meta_description'] = $url->url_meta_description;
    } else {
        $_POST[$prefix . 'url_routed'] = $url_original;
        $url = new Urls();
        $url->url_routed = $url_original;
        $url->url_original = $url_original;
        $url->save();
    }
}

function validte_url($url_original = '', $prefix = '') {
    $CI = get_instance();

    if (!$url_original) {
        $CI->form_validation->set_rules("{$prefix}url_routed", "", "required|unique[UrlsTable,checkUrl]|xss_clean");
    } else {
        $CI->form_validation->set_rules("{$prefix}url_routed", "", "required|unique[UrlsTable,checkUrl,url_routed,$url_original]|xss_clean");
    }

    $CI->form_validation->set_rules("{$prefix}url_meta_title", "", "xss_clean");
    $CI->form_validation->set_rules("{$prefix}url_page_title", "", "xss_clean");
    $CI->form_validation->set_rules("{$prefix}url_meta_keywords", "", "xss_clean");
    $CI->form_validation->set_rules("{$prefix}url_meta_description", "", "xss_clean");
}

function get_routed_url($url_original) {
    global $route;
    $url_routed = array_search($url_original, $route);
    if ($url_routed) {
        return $url_routed;
    }

    return $url_original;
}

function print_meta_data($page_title) {
    global $route;
    $CI = get_instance();
    $uri_string='';
    if (isset($route[$CI->uri->uri_string])) {
        $uri_string=$CI->uri->uri_string;
    } elseif (isset($route[trim($CI->uri->uri_string, '/')])) {
        $uri_string=trim($CI->uri->uri_string, '/');
    } elseif (isset($route[$CI->uri->uri_string . '/'])) {
        $uri_string=$CI->uri->uri_string . '/';
    }
//    echo $CI->uri->uri_string;exit;
    if ($uri_string) {

        $url = UrlsTable::getInstance()->findOneBy('url_original', $route[$uri_string]);
        ?>
        <meta name="description" content="<?php echo $url['url_meta_description'] ?>" />
        <meta name="keywords" content="<?php echo $url['url_meta_keywords'] ?>" />
        <meta name="title" content="<?php echo $url['url_meta_title'] ?>" />
        <title><?php echo $url['url_meta_title'] ?></title>
    <? } else {
        ?>
        <title><?php echo $page_title ?></title>
        <?php
    }
}

function print_image_alt_title() {
    ?>
    <li>
        <label><?php echo lang('image_alt') ?>:</label>
        <input type="text" class="txtbox" name="image_alt" id="image_alt" value="<?php echo set_value('image_alt') ?>" />
        <span class="star">*</span>
        <?php echo form_error("image_alt"); ?>
    </li>
    <li>
        <label><?php echo lang('image_title') ?>:</label>
        <input type="text" class="txtbox" name="image_title" id="image_title" value="<?php echo set_value('image_title') ?>" />
        <span class="star">*</span>
        <?php echo form_error("image_title"); ?>
    </li>
    <?php
}

function validte_image_alt_title() {
    $CI = get_instance();

    $CI->form_validation->set_rules("image_title", "", "required|xss_clean");
    $CI->form_validation->set_rules("image_alt", "", "required|xss_clean");
}

function populate_image_alt_title($OBJ) {
    $_POST['image_alt'] = $OBJ->alt;
    $_POST['image_title'] = $OBJ->title;
}

function assign_image_alt_title($OBJ) {
    $OBJ->alt = $_POST['image_alt'];
    $OBJ->title = $_POST['image_title'];
}

function get_static_url($uri = '') {
    $CI = get_instance();
    return $CI->config->item('base_static_url') . trim($uri, '/');
}

function get_banner_bath($page_scope) {
    $banner = BannersTable::getInstance()->findOneBy('banner_scope', $page_scope, Doctrine_Core::HYDRATE_ARRAY);
    if ($banner)
        return $banner['banner_path'];
}

function load_video_data() {
    $CI = get_instance();
    $video = unserialize(file_get_contents('uploads/vedio_url.txt'));
//    pre_print($video);
    if (isset($video['video_img']))
        $_POST['video_img'] = $video['video_img'];

    if (isset($video['video_url']))
        $_POST['video_url'] = $video['video_url'];

    $CI->form_validation->set_rules("video_img", "", "xss_clean");
    $CI->form_validation->set_rules("video_url", "", "xss_clean");
}

function get_encoded_url($path){
    $exp=  explode('/', $path);
//    pre_print($exp,false);
    $exp[count($exp)-1]=  urlencode($exp[count($exp)-1]);
//    pre_print($exp);
    return implode('/', $exp);
}

function get_active_tab($url){
    /* @var $CI My_Controller */
    $CI=  get_instance();
    if(implode('/', $CI->uri->rsegments)==trim($url,'/'))
        return 'active';
    
}
    ?>
