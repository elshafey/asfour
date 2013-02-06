<?php if ($slug == 'about-us') { ?>
    <form method="POST">
        <ul>
            <li class="section_title"><?php echo lang('page_images_manage') ?></li>
            <li>
                <?php echo lang('page_image_add_path', 'image_path') ?>
                <input type="text" readonly="readonly" class="txtbox" name="image_path" id="image_path" value="<?php echo set_value('image_path') ?>" />
                <input type="button" value="<?php echo lang('global_btn_browse') ?>" onclick="BrowseServer();" />
                <?php echo form_error("image_path"); ?>
                <div id="img_thumb" <? if (set_value('image_path')) { ?> style="background-image: url('<?php echo get_static_url(page_thumb(set_value('image_path'))) ?>');" class="thumb_div" <? } ?>></div>
            </li>
            <li >
                <?php echo lang('page_image_order', 'image_order') ?>
                <input type="text" class="txtbox" name="image_order" id="image_order" value="<?php echo set_value('image_order') ?>" />
                <span class="star">*</span>
                <?php echo form_error("image_order"); ?>
            </li >
            <li class="btns">
                <input type="hidden" name="action_name"  value="add_image" >
                <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            </li>
            <?php if ($images) { ?>
                <li class="section_title"><?php echo lang('page_images_list') ?></li>
                <li>
                    <table class="images_grid">
                        <thead>
                            <tr>
                                <td width="180"><?php echo lang('page_image_grid_preview') ?></td>
                                <td width="180"><?php echo lang('page_image_order') ?></td>
                                <td width="180"><?php echo lang('page_image_active') ?></td>
                                <td width="180">&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($images as $image) { ?>
                                <tr>
                                    <td class="image_preview"><img src="<?php echo get_static_url(page_thumb($image['image_path'])); ?>"></td>
                                    <td class="image_order">
                                        <?php echo order_icon($image['image_order'], $this->router->class, 'image', $image['image_id']) ?>
                                    </td>
                                    <td><?php echo active_icon($image['image_is_active'], $this->router->class, 'image', $image['image_id']) ?></td>
                                    <td><a class="delete_lnk"  href="<?php echo site_url('admin/page/delete_image/' . $image['image_id']) ?>"><?php echo lang('global_delete') ?></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </li>
            <?php } ?>
        </ul>
    </form>
<?php } ?>
<?php load_file_finder('image_path') ?>
<form method="POST" >
    <ul>
        <li class="section_title"><?php echo lang('page_content_manage') ?></li>
        <?php foreach (get_lang_list() as $key => $lang) { ?>
            <li>
                <?php echo lang('page_form_content_' . $key, 'page_content_' . $key) ?>
                <span class="star">*</span>
                <?php echo form_error("page_content_$key"); ?>
                <?php echo load_editor('page_content_' . $key, htmlspecialchars_decode(set_value('page_content_' . $key))); ?>

            </li>   
        <?php } ?>
        <li>
            <?php echo lang('page_form_banner', 'page_banner') ?>
            <input type="text" readonly="readonly" class="txtbox" name="<?php echo 'page_banner' ?>" id="<?php echo 'page_banner' ?>" value="<?php echo set_value('page_banner') ?>" />
            <input type="button" value="<?php echo lang('global_btn_browse') ?>" onclick="BrowseServer2();" />
            <span class="star">*</span>
            <?php echo form_error("page_banner"); ?>
            <div id="img_thumb" <? if (set_value('page_banner')) { ?> style="background-image: url('<?php echo get_static_url(page_thumb(set_value('page_banner'))) ?>');" class="thumb_div" <? } ?>></div>
            <?php load_file_finder('page_banner', 'BrowseServer2', 'SetFileField2') ?>
        </li>
        <?php print_url_info(); ?>
        <li class="btns">
            <input type="hidden" name="action_name"  value="edit_image" >
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url('admin/news') ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>