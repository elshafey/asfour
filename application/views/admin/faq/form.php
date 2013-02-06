<form method="POST" >
    <ul>
        <?php foreach (get_lang_list() as $key => $lang) { ?>
        <li>
            <?php echo lang('faq_form_question_'.$key,'faq_question_'.$key) ?>
            <input type="text" class="txtbox" name="<?php echo 'faq_question_'.$key ?>" id="<?php echo 'faq_question_'.$key ?>" value="<?php echo set_value('faq_question_'.$key) ?>" />
            <span class="star">*</span>
            <?php echo form_error("faq_question_$key"); ?>
        </li>
        <li>
            <?php echo lang('faq_form_answer_'.$key,'faq_answer_'.$key) ?>
            <span class="star">*</span>
            <?php echo form_error("faq_answer_$key"); ?>
            <?php echo load_editor('faq_answer_'.$key, htmlspecialchars_decode(set_value('faq_answer_'.$key))); ?>
            
        </li>   
        <?php } ?>
        <li>
            <?php echo lang('faq_form_order','faq_order') ?>
            <input type="text" class="txtbox" name="<?php echo 'faq_order' ?>" id="<?php echo 'faq_order' ?>" value="<?php echo set_value('faq_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("faq_order"); ?>
        </li>
        <li>
            <?php echo lang("faq_form_active",'faq_is_active'); ?>
            <input name="faq_is_active" id="faq_is_active" value="<?php echo set_value("faq_is_active", "0") ?>" <?php echo set_checkbox("faq_is_active", "1") ?>  type="checkbox" />
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url('admin/faq') ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>