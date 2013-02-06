
<form method="POST">
    <ul>
        <li>
            <label>&nbsp;</label>
            <a href="<?php echo site_url('admin/product/view/'.$prod_id) ?>" ><?php echo lang('product_tab_back') ?></a>
        </li>
        <li>&nbsp;</li>
        <li>
            <?php echo lang('product_image_form_path', 'image_path') ?>
            <input type="text" readonly="readonly" class="txtbox" name="image_path" id="image_path" value="<?php echo set_value('image_path') ?>" />
            <input type="button" value="<?php echo lang('global_btn_browse') ?>" onclick="BrowseServer();" />
            <?php echo form_error("image_path"); ?>
            <div id="img_thumb" <? if (set_value('image_path')) { ?> style="background-image: url('<?php echo get_static_url(page_thumb(set_value('image_path'))) ?>');" class="thumb_div" <? } ?>></div>
            <?php load_file_finder('image_path') ?>
        </li>
        <li >
            <?php echo lang('product_image_form_order', 'image_order') ?>
            <input type="text" class="txtbox" name="image_order" id="image_order" value="<?php echo set_value('image_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("image_order"); ?>
        </li >
        <li class="btns">
            <input type="hidden" name="action_name"  value="add_image" >
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
        </li>
        <?php if ($images) { ?>
            <li>
                <table class="images_grid">
                    <thead>
                        <tr>
                            <td width="180"><?php echo lang('prod_image_grid_preview') ?></td>
                            <td width="180"><?php echo lang('product_image_form_order') ?></td>
                            <td width="180"><?php echo lang('product_image_form_active') ?></td>
                            <td width="180">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($images as $image) { ?>
                            <tr>
                                <td class="image_preview"><img src="<?php echo get_static_url(page_thumb($image['image_path'])); ?>"></td>
                                <td class="image_order">
                                    <?php echo order_icon($image['image_order'], $this->router->class, 'tab_image', $image['image_id']) ?>
                                </td>
                                <td><?php echo active_icon($image['image_is_active'], $this->router->class, 'tab_image', $image['image_id']) ?></td>
                                <td><a class="delete_lnk" href="<?php echo site_url('admin/product/delete_tab_image/' . $image['image_id']) ?>"><?php echo lang('global_delete') ?></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </li>
        <?php } ?>
    </ul>
</form>