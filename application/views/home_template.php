<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php print_meta_data(isset($page_title) ? $page_title : lang('page_title')) ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--        <title><?php echo isset($page_title) ? $page_title : lang('page_title') ?></title>-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('layout/css/asfour.css') ?>"/>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>layout/images/favicon.ico" type="image/x-icon" />
        <?php echo $_styles ?>
        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery-1.7.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/content.js" type="text/javascript"></script>
        <?php echo $_scripts ?>
        <?php // $menuProducts= ProductsTable::getProducts(get_language_id(), true, true) ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <a class="logo" href="<?php echo site_url() ?>"></a>
                <div class="header_separator"></div>
                <div class="header_title"></div>
                <div class="clear"></div>

                <div id="menu">                  
                    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_PAGE . 'about-us')) ?>" class="about_us"></a><span class="separator"></span>
                    <div class="products">
                        <ul class="sub-menu" style="display: none">
                            <?php foreach ($products as $key => $value) { ?>
                                <li><a href="<?php echo site_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $value['prod_id']) ?>" title="<?php echo base_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $value['prod_id']) ?>"><?php echo $value['ProductDetails'][0]['prod_title'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <span class="separator"></span>
                    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_PAGE) . URL_PREFIX_QUALITY) ?>" class="quality"></a><span class="separator"></span>
                    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_WORLDWIDE)) ?>" class="worldwide"></a><span class="separator"></span>
                    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_NEWS)) ?>" class="media_center"></a><span class="separator"></span>
                    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_FAQS)) ?>" class="faq"></a><span class="separator"></span>
                    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_CAREER)) ?>" class="careers"></a><span class="separator"></span>
                    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_PAGE_CONTACTUS)) ?>" class="contact_us"></a>
                    <div class="clear"></div>
                </div>

            </div>

            <div id="content">
                <?php echo $content ?>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>

            <div id="footer">
                <div class="menu">
                    <a href="<?php echo site_url('home/media_center'); ?>">News</a> | <a href="<?php echo site_url('home/sitemap'); ?>">Site Map</a>
                </div>
                &copy; Asfour Crystal - All Rights Reserved. <a href="<?php echo site_url(get_routed_url('home/page/privacy-statement')) ?>" style="font-size: 10px">Privacy Statement</a>
            </div>
        </div>
    </body>
</html>
