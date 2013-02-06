
<li>
    <form id="upload_form">
        <ul>
            <li class="section_title"><?php echo lang('product_images_title'); ?></li>
            <li>
                <?php echo lang('product_image_form_path', 'prod_image') ?>
                <input type="text" readonly="readonly" class="txtbox" name="path" id="path" value="<?php echo set_value('path') ?>" />
                <input type="button" value="<?php echo lang('product_form_btn_browse') ?>" onclick="BrowseServer();" />
                <?php echo form_error("path"); ?>
                <div id="img_thumb" <? if (set_value('path')) { ?> style="background-image: url('<?php echo get_static_url(page_thumb(set_value('path'))) ?>');" class="thumb_div" <? } ?>></div>
                <?php if(!is_ajax()) load_file_finder('path') ?>
            </li>
            <li >
                <?php echo lang('product_image_form_order', 'image_order') ?>
                <input type="text" class="txtbox" name="<?php echo 'image_order' ?>" id="<?php echo 'image_order' ?>" value="<?php echo set_value('image_order') ?>" />
                <span class="star">*</span>
                <?php echo form_error("image_order"); ?>
            </li>
            <?php print_image_alt_title() ?>
            <li class="btns">
<!--                <input type="reset" id="reset" />-->
                <input type="submit" id="upload_image" value="<?php echo lang('product_form_btn_save') ?>" />
            </li>

            <?php if ($prodImages) { ?>
                <li>
                    <table>
                        <thead>
                            <tr>
                                <td width="180"><?php echo lang('prod_image_grid_preview') ?></td>
                                <td width="180"><?php echo lang('product_image_form_order') ?></td>
                                <td width="180"><?php echo lang('product_image_form_active') ?></td>
                                <td width="180">&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prodImages as $image) { ?>
                                <tr>
                                    <td><img height="50" src="<?php echo get_static_url(page_thumb($image['path'])) ?>"></td>
                                    <td class="image_order">
                                        <?php echo order_icon($image['image_order'], 'product', 'image', $image['image_id']) ?>
                                    </td>
                                    <td><?php echo active_icon($image['image_is_active'], 'product', 'image', $image['image_id']) ?></td>
                                    <td><a class="delete_lnk" href="<?php echo site_url('admin/product/delete_image/' . $image['image_id']) ?>"><?php echo lang('global_delete') ?></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </li>

            <?php } ?>
            <script>
                $('#upload_image').click(function(e){
                    e.preventDefault();
                    $.post(site_url('asfour/index.php?/admin/product/add_image/<?php echo $prod_id ?>'),{
                        path:$('#path').val(),
                        image_alt:$('#image_alt').val(),
                        image_title:$('#image_title').val(),
                        image_order:$('#image_order').val()
                    },function(data){
                        $('#product_images').html(data);
//                        $('#reset').click();
                        location.href=location.href;
                    });
                })
            </script>
        </ul>
    </form>
</li>