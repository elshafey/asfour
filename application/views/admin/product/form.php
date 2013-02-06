<form method="POST" >
    <ul>
        <?php foreach (get_lang_list() as $key => $lang) { ?>
        <li>
            <?php echo lang('product_form_title_'.$key,'prod_title_'.$key) ?>
            <input type="text" class="txtbox" name="<?php echo 'prod_title_'.$key ?>" id="<?php echo 'prod_title_'.$key ?>" value="<?php echo set_value('prod_title_'.$key) ?>" />
            <span class="star">*</span>
            <?php echo form_error("prod_title_$key"); ?>
        </li>
        <li>
            <?php echo lang('product_form_description_'.$key,'prod_description_'.$key) ?>
            <span class="star">*</span>
            <?php echo form_error("prod_description_$key"); ?>
            <?php echo load_editor('prod_description_'.$key, htmlspecialchars_decode(set_value('prod_description_'.$key))); ?>
            
        </li>   
        <li>
            <?php echo lang('product_form_summary_'.$key,'prod_summary_'.$key) ?>
            <textarea name="<?php echo 'prod_summary_'.$key ?>" id="<?php echo 'prod_summary_'.$key ?>" ><?php echo set_value('prod_summary_'.$key) ?></textarea>
            <span class="star">*</span>
            <?php echo form_error("prod_summary_$key"); ?>
        </li>  
        <?php } ?>
        <li>
            <?php echo lang('product_form_banner','prod_banner') ?>
            <input type="text" readonly="readonly" class="txtbox" name="<?php echo 'prod_banner' ?>" id="<?php echo 'prod_banner' ?>" value="<?php echo set_value('prod_banner') ?>" />
            <input type="button" value="<?php echo lang('product_form_btn_browse') ?>" onclick="BrowseServer();" />
            <span class="star">*</span>
            <?php echo form_error("prod_banner"); ?>
            <div id="img_thumb" <? if(set_value('prod_banner')) {?> style="background-image: url('<?php echo  get_static_url(page_thumb(set_value('prod_banner'))) ?>');" class="thumb_div" <?}?>></div>
            <?php load_file_finder('prod_banner') ?>
        </li>
        <li>
            <?php echo lang('product_form_home_img','prod_home_img') ?>
            <input type="text" readonly="readonly" class="txtbox" name="<?php echo 'prod_home_img' ?>" id="<?php echo 'prod_home_img' ?>" value="<?php echo set_value('prod_home_img') ?>" />
            <input type="button" value="<?php echo lang('product_form_btn_browse') ?>" onclick="BrowseServer2();" />
            <span class="star">*</span>
            <?php echo form_error("prod_home_img"); ?>
            <div id="img_thumb" <? if(set_value('prod_home_img')) {?> style="background-image: url('<?php echo  get_static_url(page_thumb(set_value('prod_home_img'))) ?>');" class="thumb_div" <?}?>></div>
            <?php load_file_finder('prod_home_img','BrowseServer2','SetFileField2') ?>
        </li>
        <?php print_url_info() ?>
        <li>
            <?php echo lang('product_form_order','prod_order') ?>
            <input type="text" class="txtbox" name="<?php echo 'prod_order' ?>" id="<?php echo 'prod_order' ?>" value="<?php echo set_value('prod_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("prod_order"); ?>
        </li>
        <li>
            <?php echo lang("product_form_active",'prod_is_active'); ?>
            <input name="prod_is_active" id="prod_is_active" value="<?php echo set_value("prod_is_active", "0") ?>" <?php echo set_checkbox("prod_is_active", "1") ?>  type="checkbox" />
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('product_form_btn_save') ?>" />
            <a href="<?php echo site_url().'admin/product' ?>" class="cancel_link" value=""><?php echo lang("product_form_btn_cancell"); ?></a>
        </li>
    </ul>
</form>
<script>
//    $('form').submit(function(e){e.preventDefault()});
</script>