<script type="text/javascript">
    $(document).ready(function() {
        $('#slider').nivoSlider({pauseTime:5000});
        
        $('#asfour-vedio').click(function(){
            $('#vedio_iframe').attr('src', '<?php echo $video_url;?>');
        });
        
        $('.close_popup').live('click', function(){
            $('#vedio_iframe').attr('src', '');
        });
    });
</script>

<div class="banner_area">
    <div class="banner">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php foreach ($banners as $banner) { ?>
                    <a href="<?php echo $banner['banner_url'] ?>">
                        <img src="<?php echo get_static_url($banner['banner_path']) ?>" alt="" width="706" height="257" />
                    </a>
                <?php } ?>
            </div>           
        </div>        
    </div>  
    <div class="about-us-msg">
        <?php echo sub_string_from_start($about_us['content'], 250) ?>....
        <a href="<?php echo site_url('about-us');?>" class="home-more-link"><?php echo lang('global_more') ?></a>
    </div>
</div>
<div class="news_area">
    <div class="video">
        <a id="asfour-vedio" href="#?w=420" rel="popup_name" class="poplight" style="font-size: 112% !important;">
            <img src="<?php echo $video_img ?>" alt="" width="206" height="101" style="border: none;" />
        </a>
    </div>
    <div class="news_main_title"></div>
    <ul class="news-items">
        <?php foreach ($latest_news as $news) { ?>
        <li style="float: left">
                <div class="news_title"><?php echo date('M Y', strtotime($news['news_created_at'])) ?></div>
                <?php echo sub_string_from_start($news['NewsDetails'][0]['news_description'], 80) ?>
                <a class="home-more-link" style="float: none" href="<?php echo site_url() . get_routed_url(URL_PREFIX_NEWS . $news['news_id']); ?>"><?php echo lang('global_more') ?></a>
            </li>
        <?php } ?>

    </ul>
</div>
<div class="page-separator"></div>

<ul class="boxes">
    <?php 
    foreach ($products as $key => $product) { ?>
        <li class="<?php echo (count($products) == $key + 1) ? 'last-item' : '' ?>">
            <?php //$image = array_shift(get_product_images($product['prod_id'], 1)); ?>
            <?php $url = site_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $product['prod_id']); ?>
            <a href="<?php echo $url ?>" style="text-decoration: none;">
                <span class="corporate-title" style="color: #2CB2CF;"><?php echo $product['ProductDetails'][0]['prod_title'] ?></span>
            </a>
            <a href="<?php echo $url ?>">
                <img src="<?php echo get_static_url($product['prod_home_img']) ?>" alt="<?php echo $product['ProductDetails'][0]['prod_title'] ?>" title="<?php echo $product['ProductDetails'][0]['prod_title'] ?>" width="145" height="94" />
            </a>
            <?php echo sub_string_from_start($product['ProductDetails'][0]['prod_summary'], 40) ?>
            <a href="<?php echo $url ?>" class="home-more-link"><?php echo lang('global_more') ?></a>
        </li>
    <?php } ?>
    
</ul>
<div class="clear"></div>


<div id="popup_name" class="popup_block">   
    <iframe id="vedio_iframe" width="420" height="315" src="<?php echo $video_url;?>" frameborder="0"></iframe>
</div> 