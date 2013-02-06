<form method="POST" >
    <ul>
        <?php foreach (get_lang_list() as $key => $lang) { ?>
        <li>
            <?php echo lang('product_tab_form_title_'.$key,'tab_title_'.$key) ?>
            <input type="text" class="txtbox" name="<?php echo 'tab_title_'.$key ?>" id="<?php echo 'tab_title_'.$key ?>" value="<?php echo set_value('tab_title_'.$key) ?>" />
            <span class="star">*</span>
            <?php echo form_error("tab_title_$key"); ?>
        </li>
        <li>
            <?php echo lang('product_tab_form_description_'.$key,'tab_description_'.$key) ?>
            <?php echo load_editor('tab_description_'.$key, htmlspecialchars_decode(set_value('tab_description_'.$key))); ?>
            <span class="star">*</span>
            <?php echo form_error("tab_description_$key"); ?>
        </li>   
        <?php } ?>
        <?php print_url_info() ?>
        <li>
            <?php echo lang('product_tab_form_order','tab_order') ?>
            <input type="text" class="txtbox" name="<?php echo 'tab_order' ?>" id="<?php echo 'tab_order' ?>" value="<?php echo set_value('tab_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("tab_order"); ?>
        </li>
        <li>
            <?php echo lang("product_tab_form_active",'tab_is_active'); ?>
            <input name="tab_is_active" id="tab_is_active" value="<?php echo set_value("tab_is_active", "0") ?>" <?php echo set_checkbox("tab_is_active", "1") ?>  type="checkbox" />
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url('admin/product/view/' . $prod_id) ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>