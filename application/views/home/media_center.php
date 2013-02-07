<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo get_static_url($banner_path);?>)!important;
    }
</style>
<div class="inside-banner"></div>
<div class="inside-menu">
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_NEWS)); ?>" class="<?php echo ($type=='news') ? 'active' : ''; ?>"><?php echo lang('home_media_center_news') ?></a>
    <?php if(isset($press_count)&&$press_count){ ?>
    <span class="separator"></span>
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_PRESS_RELEASE)); ?>" class="<?php echo ($type!='news') ? 'active' : ''; ?>"><?php echo lang('home_media_center_pressrelease') ?></a>    
    <?php } ?>
</div>
<div class="clear"></div>

<div class="news-section">
    <h1 class="left_title">
        <?php echo $page_title ?>
    </h1>
    <?php foreach ($news as $item) { ?>
        <?php $url = site_url() . get_routed_url(URL_PREFIX_NEWS . $item['news_id']); ?>
        <div class="news-title"><?php echo $item['news_title']; ?></div>
        <p>
            <?php echo sub_string_from_start($item['news_description'], 200) . anchor($url, lang('global_more'), 'class="link"'); ?>
        </p>
        <div class="news-separator"></div>
    <?php } ?>
</div>