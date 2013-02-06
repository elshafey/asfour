<ul>
    <li><a href="<?php echo site_url('admin/news/create') ?>"><?php echo lang('news_list_new') ?></a></li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>


<form method="POST" action="">
    <ul>
        <li class="section_title"><?php echo lang('news_url_news') ?></li>
        <?php print_url_info(false,'',true) ?>
        <li class="section_title"><?php echo lang('news_url_pressrelease') ?></li>
        <?php print_url_info(false,'press_',true) ?>
        <li class="btns">
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
            <?php foreach (get_lang_list() as $code => $lang) { ?>"<?php echo lang("news_form_title_$code") ?>",<?php }?>
                    "<?php echo lang('news_form_created_at') ?>",
                    "<?php echo lang('news_form_active') ?>",
                    "<?php echo lang('news_type') ?>",
                    "",
                    "",
                ],
        colModel:
        [
        <?php foreach (get_lang_list() as $code => $lang) { ?>
        {name:"news_title_<?php echo $code ?>",index:"news_title_<?php echo $code ?>",width:80},
        <?php } ?>
        {name:"news_created_at",index:"news_created_at",width:80},
        {name:"news_is_active",index:"news_is_active",width:80},
        {name:"news_type",index:"news_type",width:80},
        {name:"news_edit",index:"news_is_active",width:80},
        {name:"news_delete",index:"news_is_active",width:80}
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        pager: '#pager2',
        sortname: 'news_order',
        viewrecords: true,
        sortorder: "desc",
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false});
    var mydata = <?php echo $news_json ?>;
    for(var i=0;i<=mydata.length;i++) 
        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>