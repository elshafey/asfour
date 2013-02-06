<ul>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>

<form method="POST" action="">
    <ul>
        
        <?php print_url_info() ?>
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
            "<?php echo lang('feedback_form_title') ?>",
            "<?php echo lang('feedback_form_name') ?>",
            "<?php echo lang('feedback_form_position') ?>",
            "<?php echo lang('feedback_form_subject') ?>",
            "<?php echo lang('feedback_form_is_new') ?>",
            "<?php echo lang('') ?>",
                ],
        colModel:
        [
        {name:"title",index:"title",width:80,classes:'grid_center'},
        {name:"name",index:"name",width:80,classes:'grid_center'},
        {name:"position",index:"position",width:80},
        {name:"subject",index:"subject",width:80},
        {name:"is_new",index:"is_new",width:80,classes:'grid_center'},
        {name:"delete",index:"delete",width:80},
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