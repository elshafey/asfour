<form method="POST" >
    <ul>
        <li>
            <?php echo lang('worldwide_crete_name', 'agent_name') ?>
            <input type="text" class="txtbox" name="agent_name" id="agent_name" value="<?php echo set_value('agent_name') ?>" />
            <span class="star">*</span>
            <?php echo form_error("agent_name"); ?>
        </li>
        <li>
            <?php $products= ProductDetailsTable::getInstance()->findBy('lang_id',(get_language_id()),Doctrine_Core::HYDRATE_ARRAY) ?>
            <?php echo lang('worldwide_crete_product', 'agent_product') ?>
            <select name="agent_product[]" id="agent_product" multiple="multiple" class="multiple_select">
                <?php foreach ($products as $value) {?>
                <option value="<?php echo $value['prod_id'] ?>" <?php echo set_select('agent_product',$value['prod_id']) ?>><?php echo $value['prod_title'] ?></option>
                <?php } ?>
            </select>
            <span class="star">*</span>
            <?php echo form_error("agent_product"); ?>
        </li>
        <li>
            <?php $countries=  CountriesTable::getCountries() ?>
            <?php echo lang('worldwide_crete_country', 'agent_country') ?>
             <select name="agent_country" id="agent_country">
                <option><?php echo lang('global_select') ?></option>
                <?php foreach ($countries as $value) {?>
                <option value="<?php echo $value['country_id'] ?>" <?php echo set_select('agent_country',$value['country_id']) ?>><?php echo $value['country_name'] ?></option>
                <?php } ?>
            </select>
            <span class="star">*</span>
            <?php echo form_error("agent_country"); ?>
        </li>
        <li>
            <?php echo lang('worldwide_crete_fax', 'agent_fax') ?>
            <input type="text" class="txtbox" name="agent_fax" id="agent_fax" value="<?php echo set_value('agent_fax') ?>" />
            <span class="star">*</span>
            <?php echo form_error("agent_fax"); ?>
        </li>
        <li>
            <?php echo lang('worldwide_crete_tel', 'agent_tel') ?>
            <input type="text" class="txtbox" name="agent_tel" id="agent_tel" value="<?php echo set_value('agent_tel') ?>" />
            <span class="star">*</span>
            <?php echo form_error("agent_tel"); ?>
        </li>
        <li>
            <?php echo lang('worldwide_crete_address', 'agent_address') ?>
            <input type="text" class="txtbox" name="agent_address" id="agent_address" value="<?php echo set_value('agent_address') ?>" />
            <span class="star">*</span>
            <?php echo form_error("agent_address"); ?>
        </li>
        <li>
            <?php echo lang('worldwide_crete_email', 'agent_email') ?>
            <input type="text" class="txtbox" name="agent_email" id="agent_email" value="<?php echo set_value('agent_email') ?>" />
            <span class="star">*</span>
            <?php echo form_error("agent_email"); ?>
        </li>
        <li>
            <?php echo lang('worldwide_crete_order','agent_order') ?>
            <input type="text" class="txtbox" name="<?php echo 'agent_order' ?>" id="<?php echo 'agent_order' ?>" value="<?php echo set_value('agent_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("agent_order"); ?>
        </li>
        <li>
            <?php echo lang("worldwide_crete_is_active",'agent_is_active'); ?>
            <input name="agent_is_active" id="agent_is_active" value="<?php echo set_value("agent_is_active", "0") ?>" <?php echo set_checkbox("agent_is_active", "1") ?>  type="checkbox" />
        </li>
        <?php // print_url_info() ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url('admin/worldwide') ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>