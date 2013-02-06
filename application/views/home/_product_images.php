<?php
 $product_images = array(
        'layout/images/cfc.png',
        'layout/images/crystal-parts.png',
        'layout/images/lightning.png',
        'layout/images/gifts.png',
        'layout/images/crys.jpg'
    );
?>

<div class="inside-right">
    <h2 class="product-title"></h2>
    <ul class="inside-boxes">
        <?php 
        $i=0;
        foreach ($products as $key => $product) { ?>
            <li class="<?php echo (count($products) == $key + 1) ? 'last-item' : '' ?>">
                <?php $image = array_shift(get_product_images($product['prod_id'], 1)); ?>
                <?php $url = site_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $product['prod_id']); ?>
                <a href="<?php echo $url ?>">
                    <span class="corporate-title"><?php echo $product['ProductDetails'][0]['prod_title'] ?></span>
                </a>
                <a href="<?php echo $url ?>">
                    <img src="<?php echo base_url() . $product_images[$i]; ?>" alt="<?php echo $image['alt'] ?>" alt="<?php echo $image['title'] ?>" width="145" height="94" />
                </a>
                <?php echo sub_string_from_start($product['ProductDetails'][0]['prod_description'], 40) ?>...
                <a href="<?php echo $url ?>" class="home-more-link"><?php echo lang('global_more') ?></a>
            </li>
        <?php $i++; } ?>
        <div class="clear"></div>
    </ul>
</div>