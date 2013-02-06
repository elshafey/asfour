<form method="POST">
    <ul>
        <li>
            <?php echo lang('careers_form_job_code','job_code') ?>
            <input type="text" class="txtbox" name="job_code" id="job_code" value="<?php echo set_value('job_code') ?>" />
                <span class="star">*</span>
                <?php echo form_error("job_code"); ?>
        </li>
        <?php foreach (get_lang_list() as $key => $lang) { ?>
            <li>
                <?php echo lang('careers_form_title_' . $key, 'job_title_' . $key) ?>
                <input type="text" class="txtbox" name="<?php echo 'job_title_' . $key ?>" id="<?php echo 'job_title_' . $key ?>" value="<?php echo set_value('job_title_' . $key) ?>" />
                <span class="star">*</span>
                <?php echo form_error("job_title_$key"); ?>
            </li>
            <li>
                <?php echo lang('careers_form_location_' . $key, 'job_location_' . $key) ?>
                <input type="text" class="txtbox" name="<?php echo 'job_location_' . $key ?>" id="<?php echo 'job_location_' . $key ?>" value="<?php echo set_value('job_location_' . $key) ?>" />
                <span class="star">*</span>
                <?php echo form_error("job_location_$key"); ?>
            </li>
            <li>
                <?php echo lang('careers_form_description_' . $key, 'job_description_' . $key) ?>
                <span class="star">*</span>
                <?php echo form_error("job_description_$key"); ?>
                <?php echo load_editor('job_description_' . $key, htmlspecialchars_decode(set_value('job_description_' . $key))); ?>

            </li>   
        <?php } ?>
        <?php print_url_info() ?>
        <li>
            <?php echo lang('careers_form_order', 'job_order') ?>
            <input type="text" class="txtbox" name="<?php echo 'job_order' ?>" id="<?php echo 'job_order' ?>" value="<?php echo set_value('job_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("job_order"); ?>
        </li>
        <li>
            <?php echo lang('careers_form_active', 'job_is_active'); ?>
            <input name="job_is_active" id="job_is_active" value="<?php echo set_value("job_is_active", "0") ?>" <?php echo set_checkbox("job_is_active", "1") ?>  type="checkbox" />
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url() . 'admin/careers' ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>