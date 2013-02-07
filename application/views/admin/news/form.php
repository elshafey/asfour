<form method="POST" >
    <ul>
        <?php foreach (get_lang_list() as $key => $lang) { ?>
        <li>
            <?php echo lang('news_form_title_'.$key,'news_title_'.$key) ?>
            <input type="text" class="txtbox" name="<?php echo 'news_title_'.$key ?>" id="<?php echo 'news_title_'.$key ?>" value="<?php echo set_value('news_title_'.$key) ?>" />
            <span class="star">*</span>
            <?php echo form_error("news_title_$key"); ?>
        </li>
        <li>
            <?php echo lang('news_form_description_'.$key,'news_description_'.$key) ?>
            <span class="star">*</span>
            <?php echo form_error("news_description_$key"); ?>
            <?php echo load_editor('news_description_'.$key, htmlspecialchars_decode(set_value('news_description_'.$key))); ?>
            
        </li>          
        <?php } ?>
        
        <?php print_url_info(); ?>
        <li>
            <?php echo lang('news_form_created_at','news_created_at') ?>
            <input type="text" readonly="readonly" class="txtbox" name="<?php echo 'news_created_at' ?>" id="<?php echo 'news_created_at' ?>" value="<?php echo set_value('news_created_at') ?>" />
            <span class="star">*</span>
            <?php echo form_error("news_created_at"); ?>
        </li>
        <li>
            <?php echo lang("news_form_active",'news_is_active'); ?>
            <input name="news_is_active" id="news_is_active" value="<?php echo set_value("news_is_active", "0") ?>" <?php echo set_checkbox("news_is_active", "1") ?>  type="checkbox" />
        </li>
        <li>
            <?php echo lang('news_form_type','news_type'); ?>:
            <input type="radio" name="news_type" <?php echo set_checkbox('news_type', '1', true) ?> value="1" /> News <span style="width: 20px;display: inline-block;"></span>
            <input type="radio" name="news_type" <?php echo set_checkbox('news_type', '2') ?> value="2" /> Press Release
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url('admin/news') ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>
<script>
    $('#news_created_at').datepicker(
    { 
        dateFormat: 'yy-mm-dd'
    });
</script>