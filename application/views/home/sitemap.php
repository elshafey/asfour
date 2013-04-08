<style type="text/css">
    .inside-left ul li{
        list-style: circle;
    }
    .inside-left ul li a{
        text-decoration: none;
        color: #2CB2CF;
    }
    .inside-left ul li a:hover{
        text-decoration: underline;
    }
    .inside-left ul{
        margin-left: 60px;
    }
    .inside-left ul li ul {
        margin-left: 20px;
    }
</style>

<div class="inside-banner"></div>

<div class="inside-left">
    <h1 class="left_title"><?php echo $page_title ?></h1>
    <ul>
        <li><a href="<?php echo site_url(get_routed_url(URL_PREFIX_PAGE . 'about-us'))//site_url('home/page/about-us'); ?>">ABOUT US</a></li>
<!--        <li style="text-transform: uppercase;"><a href="<?php echo site_url('Crystal-Fashion-Components'); ?>">Crystal Fashion Components</a></li>
        <li style="text-transform: uppercase;"><a href="<?php echo site_url('Crystal-Parts'); ?>">Crystal Parts</a></li>
        <li style="text-transform: uppercase;"><a href="<?php echo site_url('Lighting'); ?>">Lighting Collection</a></li>
        <li style="text-transform: uppercase;"><a href="<?php echo site_url('Gifts'); ?>">Gifts</a></li>
        <li style="text-transform: uppercase;"><a href="<?php echo site_url('Crys-Tile'); ?>">Crys-Tile</a></li>-->
        <?php foreach ($products as $key => $value) { ?>
            <li style="text-transform: uppercase;">
                <a href="<?php echo site_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $value['prod_id']) ?>" title="<?php echo base_url() . get_routed_url(URL_PREFIX_PRODUCT_VIEW . $value['prod_id']) ?>"><?php echo $value['ProductDetails'][0]['prod_title'] ?></a>
                <?php $prod_tabs = ProductTabsTable::getTabs($value['prod_id'], get_language_id(), true, true); ?>
                <?php if ($prod_tabs) { ?>
                    <ul>
                        <?php foreach ($prod_tabs as $key => $value) { ?>
                            <li>
                                <a class="<?php echo get_active_tab(URL_PREFIX_PRODUCT_TAB_VIEW . $value['tab_id']); ?>" href="<?php echo site_url() . get_routed_url(URL_PREFIX_PRODUCT_TAB_VIEW . $value['tab_id']) ?>" title="<?php echo base_url() . get_routed_url(URL_PREFIX_PRODUCT_TAB_VIEW . $value['tab_id']) ?>"><?php echo $value['TabDetails'][0]['tab_title'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
        <li><a href="<?php echo site_url(get_routed_url(URL_PREFIX_PAGE. URL_PREFIX_QUALITY)); ?>">ASFOUR QUALITY</a></li>
        <li><a href="<?php echo site_url(get_routed_url(URL_PREFIX_WORLDWIDE))//site_url('home/worldwide'); ?>">ASFOUR WORLDWIDE</a></li>
        <li><a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_NEWS)); ?>">MEDIA CENTER</a></li>
        <li><a href="<?php echo site_url(get_routed_url(URL_PREFIX_FAQS)); ?>">FAQs</a></li>
<!--        <li><a href="<?php echo site_url('home/customer_services'); ?>">CUSTOMER SERVICE</a></li>-->
        <li><a href="<?php echo site_url(get_routed_url(URL_PREFIX_PAGE_CONTACTUS)); ?>">CONTACT US</a></li>
        <li><a href="<?php echo site_url(get_routed_url(URL_PREFIX_ALL_NEWS)); ?>">NEWS</a></li>
        <li><a href="<?php echo site_url(URL_PREFIX_CAREER); ?>">CAREERS</a></li>
    </ul>
</div>