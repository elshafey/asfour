<style type="text/css">
    .inside-right .inside-boxes li img{
        border: none;
    }
</style>

<div class="inside-banner"></div>
<div class="inside-menu">
    <?php
    if ($prod_tabs) {
        $main_active = '';
        if ($this->uri->segment(2) == 'product') {
            $main_active = 'active';
        }
        ?>
        <a class="<?php echo $main_active; ?>" href="<?php echo site_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $prod_id) ?>" title="<?php echo base_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $prod_id) ?>"><?php echo $prod_title ?></a>
        <?php foreach ($prod_tabs as $key => $value) { ?>
            <span class="separator"></span>
            <?php if ($this->uri->segment(2) == 'tab' && $this->uri->segment(3) == $value['tab_id']) { ?>
                <a class="active" href="<?php echo site_url() . get_routed_url(URL_PREFIX_PRODUCT_TAB_VIEW . $value['tab_id']) ?>" title="<?php echo base_url() . get_routed_url(URL_PREFIX_PRODUCT_TAB_VIEW . $value['tab_id']) ?>"><?php echo $value['TabDetails'][0]['tab_title'] ?></a>
            <?php } else { ?>            
                <a href="<?php echo site_url() . get_routed_url(URL_PREFIX_PRODUCT_TAB_VIEW . $value['tab_id']) ?>" title="<?php echo base_url() . get_routed_url(URL_PREFIX_PRODUCT_TAB_VIEW . $value['tab_id']) ?>"><?php echo $value['TabDetails'][0]['tab_title'] ?></a>
            <?php
            }
        }
        ?>

<?php } ?>
</div>
<div style="clear: both"></div>
<h1 class="left_title"><?php echo $page_title ?></h1>
<div class="inside-left">
    <?php
    echo $page_content;
    ?>

    <?php
    if (count($pdfs)) {
        foreach ($pdfs as $pdf) {
            ?>
            <div class="icons icon_left">
                <span class="pdf-icon"></span> <a target="_blank" href="<?php echo get_static_url(($pdf['pdf_path']));?>"><?php echo $pdf['PdfDetails'][0]['pdf_title']?></a>        
            </div>
        <?php
        }
    }
    ?>
    <div class="clear"></div>
</div>
<div class="inside-right">
    <ul class="inside-boxes">
<?php foreach ($prod_imagges as $key => $image) {  ?>
            <li class="<?php echo (count($prod_imagges) == $key + 1) ? 'last-item' : '' ?>">
                <img src="<?php echo (isset($image['path']))? get_static_url($image['path']):get_static_url($image['image_path']) ?>" width="145" height="94" alt="<?php echo (isset($image['alt']))? $image['alt']:'' ?>" title="<?php echo (isset($image['title']))? $image['title']:'' ?>" />
            </li>
<?php }  ?>
        <div class="clear"></div>
</div>
<style>
    .inside-banner{
        background-image: url('<?php echo get_static_url($prod_banner) ?>');
    }
</style>
