<form method="POST">
    <ul>
        <li class="section_title"><?php echo lang('banner_add_new_title'); ?></li>
        <li>
            <?php echo lang('banner_add_path', 'banner_path') ?>
            <input type="text" readonly="readonly" class="txtbox" name="banner_path" id="banner_path" value="<?php echo set_value('banner_path') ?>" />
            <input type="button" value="<?php echo lang('banner_btn_browse') ?>" onclick="BrowseServer();" /> (Dim.: 706 X 257)
            <?php echo form_error("banner_path"); ?>
            <div id="img_thumb" <? if (set_value('banner_path')) { ?> style="background-image: url('<?php echo get_static_url(page_thumb(set_value('banner_path'))) ?>');" class="thumb_div" <? } ?>></div>
            <?php load_file_finder('banner_path') ?>
        </li>
        <li >
            <?php echo lang('banner_order', 'banner_order') ?>
            <input type="text" class="txtbox" name="banner_order" id="banner_order" value="<?php echo set_value('banner_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("banner_order"); ?>
        </li >
        <li>
            <?php echo lang('banner_url', 'banner_url') ?>
            <input type="text" class="txtbox" name="banner_url" value="<?php echo set_value('banner_url') ?>" />
        </li>
        <li>
            <?php echo lang('banner_page', 'banner_page') ?>
            <select name="banner_scope" id="banner_scope">
                <option value="HOME"><?php echo lang('HOME') ?></option>
                <option value="URL_PREFIX_WORLDWIDE"><?php echo lang('URL_PREFIX_WORLDWIDE') ?></option>
                <option value="URL_PREFIX_MEDIACENTER"><?php echo lang('URL_PREFIX_MEDIACENTER') ?></option>
                <option value="URL_PREFIX_FAQS"><?php echo lang('URL_PREFIX_FAQS') ?></option>
                <option value="URL_PREFIX_CUSTOMERSERVICE"><?php echo lang('URL_PREFIX_CUSTOMERSERVICE') ?></option>
                <option value="URL_PREFIX_CONTACT_US"><?php echo lang('URL_PREFIX_CONTACT_US') ?></option>
            </select>
        </li>
        <li class="btns">
            <input type="submit" id="upload_image" value="<?php echo lang('banner_btn_save') ?>" />
        </li>
        <?php if ($banners) { ?>
            <li>
                <table class="images_grid">
                    <thead>
                        <tr>
                            <td width="180"><?php echo lang('banner_grid_preview') ?></td>
                            <td width="180"><?php echo lang('banner_page') ?></td>
                            <td width="180"><?php echo lang('banner_order') ?></td>
                            <td width="180"><?php echo lang('banner_active') ?></td>
                            <td width="180">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banners as $banner) { ?>
                            <tr>
                                <td class="image_preview"><img src="<?php echo get_static_url(page_thumb($banner['banner_path'])); ?>"></td>
                                <td><?php echo lang(($banner['banner_scope'])? $banner['banner_scope']:'HOME') ?></td>
                                <td class="image_order">
                                    <?php echo order_icon($banner['banner_order'], $this->router->class, 'image', $banner['banner_id']) ?>
                                </td>
                                <td><?php echo active_icon($banner['banner_is_active'], $this->router->class, 'image', $banner['banner_id']) ?></td>
                                <td><a class="delete_lnk" href="<?php echo site_url('admin/banner/delete/' . $banner['banner_id']) ?>"><?php echo lang('global_delete') ?></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </li>
        <?php } ?>
    </ul>
</form>

<form method="POST" action="<?php echo site_url();?>admin/banner/change_vedio_url">
    <ul>
        <li class="section_title"><?php echo lang('banner_video_section') ?></li>
        <li>
            <?php echo lang('video_img_path', 'video_img') ?>
            <input type="text" readonly="readonly" class="txtbox" name="video_img" id="video_img" value="<?php echo set_value('video_img') ?>" />
            <input type="button" value="<?php echo lang('banner_btn_browse') ?>" onclick="BrowseServer2();" />
            <?php echo form_error("video_img"); ?>
            <div id="img_thumb" <? if (set_value('video_img')) { ?> style="background-image: url('<?php echo get_static_url(page_thumb(set_value('video_img'))) ?>');" class="thumb_div" <? } ?>></div>
            <?php load_file_finder('video_img','BrowseServer2','SetFileField2') ?>
        </li>
        <li>
             <?php echo lang('video_url', 'vedio_url'); ?>
            <input type="text" class="txtbox" name="video_url" id="video_url" value="<?php echo set_value('video_url') ?>" />
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
        </li>
    </ul>
</form>


<form method="POST" action="<?php echo site_url();?>admin/banner/home_tags">
    <ul>
        <li class="section_title"><?php echo lang('banner_meta_tags') ?></li>
        <?php print_url_info(true) ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
        </li>
        
    </ul>
</form>