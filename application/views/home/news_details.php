<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo get_static_url($banner_path);?>)!important;
    }
</style>
<div class="inside-banner"></div>
<div class="inside-menu">
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_NEWS))//site_url('home/media_center');?>" class="<?php echo isset($active_news) ? $active_news: ''; ?>">News</a>
    <span class="separator"></span>
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_PRESS_RELEASE))//site_url('home/press_release');?>" class="<?php echo isset($press_release) ? $press_release: ''; ?>">Press Releases</a>
    <span class="separator"></span>
<!--    <a href="">Medica Contacts</a>-->
</div>
<div class="clear"></div>

<div class="news-section">
        <div class="news-title"><?php echo $page_title; ?></div>
        <p>
            <?php echo $page_content; ?>
        </p>
</div>