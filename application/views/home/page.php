<?php
//    if($this->uri->segment(3) == 'about-us'){
//        $background = base_url() . 'layout/images/Corporate.jpg';
//    }else if($this->uri->segment(3) == 'asfour-quality'){
//        $background = base_url() . 'layout/images/quality.jpg';
//    }
?>
<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo get_static_url($banner_path); ?>)!important;
    }
</style>


<div class="inside-banner"></div>

<div class="inside-left">
    <h1 class="left_title">
        <?php echo $page_title ?>
    </h1>
    <?php
    echo $page_content;
    ?>
</div>
<?php if ($pageImages) { ?>
    <div class="inside-right">
        <?php $img = array_shift($pageImages) ?>
        <img class="about_us_main_img" src="<?php echo get_static_url($img['image_path']); ?>" />
        <?php if ($pageImages) { ?>
        <?php //$count=count($pageImages) ?>
            <div class="about_us_small_img">
                <?php foreach ($pageImages as $key => $img) { ?>
                    <img class="<?php echo ($key%2==1)? 'last_img':''?>" src="<?php echo get_static_url($img['image_path']); ?>" />        
                <?php } ?>
            </div>    
        <?php } ?>
    </div>
<?php } ?>