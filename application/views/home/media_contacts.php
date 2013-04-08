<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo base_url() . 'layout/images/media-center.jpg';?>)!important;
    }
</style>
<div class="inside-banner"></div>
<div class="inside-menu">
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_NEWS))//site_url('home/media_center'); ?>" class="<?php echo isset($active_news) ? $active_news : ''; ?>">News</a>
    <span class="separator"></span>
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_PRESS_RELEASE))//site_url('home/press_release'); ?>" class="<?php echo isset($press_release) ? $press_release : ''; ?>">Press Releases</a>
    <span class="separator"></span>
    <a href="<?php echo site_url('home/media_contacts'); ?>" class="<?php echo isset($mc) ? $mc : ''; ?>">Media Contacts</a>
</div>
<div class="clear"></div>

<div class="news-section">
    <h1 class="left_title">
    <?php echo $page_title ?>
</h1>
    <?php
    foreach ($media_contacts as $item) {
        if (count($item['MediaContacts'])) {
            ?>
            <div class="news-title"><?php echo $item['prod_title']; ?></div>
            <?php
            foreach ($item['MediaContacts'] as $contact) {
                ?>        
            <p style="">
                    <?php echo $contact['email']; ?>
                </p>                
                <?php
            }
            echo '<div class="news-separator"></div>';
        }
    }
    ?>
</div>