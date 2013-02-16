<ul>
    <li><a href="<?php echo site_url('admin/careers/create') ?>"><?php echo lang('careers_list_new') ?></a></li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
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
            <input type="button" value="<?php echo lang('global_btn_browse') ?>" onclick="BrowseServer();" />
            <span class="star">*</span>
            <?php echo form_error("page_banner"); ?>
            <div id="img_thumb" <? if (set_value('page_banner')) { ?> style="background-image: url('<?php echo get_static_url(page_thumb(set_value('page_banner'))) ?>');" class="thumb_div" <? } ?>></div>
            <?php load_file_finder('page_banner', 'BrowseServer', 'SetFileField') ?>
        </li>
        <li>
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
        </li>
    </ul>
</form>
<script>
    jQuery("#list2").jqGrid(
    { 
        direction:'<?php echo get_dir() ?>',
        datatype: "local",
        colNames:[
            "<?php echo lang('careers_form_job_code') ?>",
<?php foreach (get_lang_list() as $code => $lang) { ?>"<?php echo lang("careers_form_title_$code") ?>",<?php } ?>
            "<?php echo lang('careers_form_order') ?>",
            "<?php echo lang('careers_form_active') ?>",
            "",
            "",
        ],
        colModel:
            [
            {name:"job_code",index:"job_code",width:80,classes:'grid_center'},
<?php foreach (get_lang_list() as $code => $lang) { ?>
                {name:"job_title_<?php echo $code ?>",index:"job_title_<?php echo $code ?>",width:80},
<?php } ?>
            {name:"job_order",index:"job_order",width:80,sorttype:function(cell,row){return parseInt($(cell).text());}},
            {name:"job_is_active",index:"job_is_active",width:80,classes:'grid_center'},
            {name:"job_edit",index:"job_is_active",width:80},
            {name:"job_delete",index:"job_is_active",width:80}
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        pager: '#pager2',
        sortname: 'job_order',
        viewrecords: true,
        sortorder: "desc",
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false});
    var mydata = <?php echo $json ?>;
    for(var i=0;i<=mydata.length;i++) 
        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>