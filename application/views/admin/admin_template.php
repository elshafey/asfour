<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="<?php echo get_dir(); ?>">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
        <script>
            var selecValue = "<?php echo lang('global_select_text') ?>";
            var delete_confirm_msg="<?php echo lang('global_confirm_msg') ?>";
        </script>
        <title><?php
if (isset($page_header)) {
    echo strip_tags($page_header);
} elseif (isset($page_title)) {
    echo strip_tags($page_title);
} else {
    echo lang("page_title");
}
?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>layout/favicon.ico" type="image/x-icon" />
        <link href="<?php echo base_url(); ?>layout/css/admin/admin.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>layout/css/admin/form.css" rel="stylesheet" type="text/css" />

        <?php echo $_styles ?>

        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery-1.7.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/content.js" type="text/javascript"></script>

        <?php echo $_scripts ?>
    </head>
    <?php
    $body_classes = '';
    $body_classes .= get_locale() . ' ';
    $body_classes .= str_replace(' ', '-', strtolower(lang("page_title"))) . ' ';
    ?>
    <body class="<?php echo $body_classes; ?>">
        <div id="wrapper">
            <div id="header">
                <a class="logo" href="<?php echo site_url('admin') ?>"></a>
                <div class="header_separator"></div>
                <div class="header_title"><?php echo isset($page_title)? $page_title:'' ?></div>
                <div class="clear"></div>
                <div class="menu">
                    <a href="<?php echo site_url('admin/about-us') ?>">About Us</a>|<a href="<?php echo site_url('admin/product') ?>">Products</a>|<a href="<?php echo site_url('admin/asfour-quality') ?>">Quality</a>|<a href="<?php echo site_url('admin/worldwide') ?>">Worldwide</a>|<a href="<?php echo site_url('admin/faq') ?>">FAQs</a>|<a href="<?php echo site_url('admin/feedback') ?>">Customer Service</a>|<a href="<?php echo site_url('admin/contact-us') ?>">Contact Us</a>|<a href="<?php echo site_url('admin/page/showrooms') ?>">showrooms</a>|<a href="<?php echo site_url('admin/banner') ?>">Banners</a>|<a href="<?php echo site_url('admin/news') ?>">News & Press Releases</a>|<a href="<?php echo site_url('admin/careers') ?>">Careers</a>|<a href="<?php echo site_url('admin/privacy-statement') ?>">Privacy Statement</a>
                </div>
            </div>

            <div id="content">
                <?php
                echo $content;
                ?>
            </div>

            <div class="clear"></div>

            <div id="footer">
                &copy; Asfour Crystal - All Rights Reserved. Privacy Statement
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.delete_lnk').live('click',function(e){
                    e.preventDefault();
                    if(confirm('<?php echo lang('global_delete_confirm') ?>')){
                        location.href=$(this).attr('href');
                    }
                }) 
            });
        </script>
    </body>
</html>
