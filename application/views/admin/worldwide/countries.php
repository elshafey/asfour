<form method="POST">
    <ul>
        <li class="section_title"><?php echo lang('worlwide_add_new_country'); ?></li>
        <li >
            <?php echo lang('worlwide_add_new_country_name', 'country_name') ?>
            <input type="text" class="txtbox" name="country_name" id="country_name" value="<?php echo set_value('country_name') ?>" />
            <span class="star">*</span>
            <?php echo form_error("country_name"); ?>
        </li >
        <li>
            <?php echo lang('worldwide_add_country_logo_path', 'country_logo') ?>
            <input type="text" readonly="readonly" class="txtbox" name="country_logo" id="country_logo" value="<?php echo set_value('country_logo') ?>" />
            <input type="button" value="<?php echo lang('global_btn_browse') ?>" onclick="BrowseServer();" />
            <?php echo form_error("country_logo"); ?>
            <div id="img_thumb" <? if (set_value('country_logo')) { ?> style="background-image: url('<?php echo get_static_url().page_thumb(set_value('country_logo')) ?>');" class="thumb_div" <? } ?>></div>
            <?php load_file_finder('country_logo') ?>
        </li>

        <li class="btns">
            <input type="submit" id="upload_image" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url('admin/worldwide') ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
        <?php if ($countries) { ?>
            <li>
                <table class="images_grid">
                    <thead>
                        <tr>
                            <td class="country_name tbl_header" width="180"><?php echo lang('country_grid_name') ?></td>
                            <td class="country_name tbl_header" width="180"><?php echo lang('country_grid_logo') ?></td>
                            <td width="180">&nbsp;</td>
                            <td width="180">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($countries as $country) { ?>
                            <tr>
                                <td class="country_name">
                                    <?php echo $country['country_name'] ?>
                                </td>
                                <td class="country_name">
                                    <img height="20" alt="<?php echo $country['country_name'] ?> logo" src="<?php echo get_static_url(page_thumb($country['country_logo'])) ?>">
                                </td>
                                <td>
                                    <a href="<?php echo site_url('admin/worldwide/countries/' . $country['country_id']) ?>">
                                        <?php echo lang('global_edit') ?>
                                    </a>
                                </td>
                                <td>
                                    <a class="delete_lnk" href="<?php echo site_url('admin/worldwide/delete_country/' . $country['country_id']) ?>">
                                        <?php echo lang('global_delete') ?>
                                    </a>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </li>
        <?php } ?>
    </ul>
</form>