<ul>
    <li><a href="<?php echo site_url('admin/careers/create') ?>"><?php echo lang('careers_list_new') ?></a></li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
<script>
    jQuery("#list2").jqGrid(
    { 
        direction:'<?php echo get_dir() ?>',
        datatype: "local",
        colNames:[
            "<?php echo lang('careers_form_job_code') ?>",
            <?php foreach (get_lang_list() as $code => $lang) { ?>"<?php echo lang("careers_form_title_$code") ?>",<?php }?>
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
        {name:"job_order",index:"job_order",width:80},
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
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
    var mydata = <?php echo $json ?>;
    for(var i=0;i<=mydata.length;i++) 
        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>