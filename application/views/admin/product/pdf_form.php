<form method="POST" >
    <ul>
        <?php foreach (get_lang_list() as $key => $lang) { ?>
            <li>
                <?php echo lang('product_pdf_form_title_' . $key, 'pdf_title_' . $key) ?>
                <input type="text" class="txtbox" name="<?php echo 'pdf_title_' . $key ?>" id="<?php echo 'pdf_title_' . $key ?>" value="<?php echo set_value('pdf_title_' . $key) ?>" />
                <span class="star">*</span>
                <?php echo form_error("pdf_title_$key"); ?>
            </li>
        <?php } ?>
        <li>
            <?php echo lang('product_pdf_form_path', 'pdf_path') ?>
            <input type="text" readonly="readonly" class="txtbox" name="pdf_path" id="pdf_path" value="<?php echo set_value('pdf_path') ?>" />
            <input type="button" value="<?php echo lang('product_form_btn_browse') ?>" onclick="BrowseServer();" />
            <?php echo form_error("pdf_path"); ?>
            <?php load_file_finder('pdf_path') ?>
        </li>
        <?php if ($prod_tabs) { ?>
            <li>
                <?php echo lang('product_pdf_form_tab', 'pdf_tab') ?>
                <select id="tab_id" name="tab_id">
                    <option value="0"><?php echo $prod_title ?></option>
                    <?php foreach ($prod_tabs as $value) { ?>
                    <option value="<?php echo $value['tab_id'] ?>" <?php echo set_select('tab_id',$value['tab_id']) ?>><?php echo $value['TabDetails'][0]['tab_title'] ?></option>
                    <?php } ?>
                </select>
            </li>
        <?php } ?>
        <li>
            <?php echo lang('product_pdf_form_order', 'pdf_order') ?>
            <input type="text" class="txtbox" name="<?php echo 'pdf_order' ?>" id="<?php echo 'pdf_order' ?>" value="<?php echo set_value('pdf_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("pdf_order"); ?>
        </li>
        <li>
            <?php echo lang("product_pdf_form_active", 'pdf_is_active'); ?>
            <input name="pdf_is_active" id="pdf_is_active" value="<?php echo set_value("pdf_is_active", "0") ?>" <?php echo set_checkbox("pdf_is_active", "1") ?>  type="checkbox" />
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url('admin/product/view/' . $prod_id) ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>