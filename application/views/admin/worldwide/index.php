<ul>
    <li>
        <a href="<?php echo site_url('admin/worldwide/create') ?>" ><?php echo lang('worldwide_index_new_agency') ?></a>
        <span class="manage_countries">
           <a href="<?php echo site_url('admin/worldwide/countries') ?>" ><?php echo lang('worldwide_manage_countries_page_title') ?></a> 
        </span>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
<form method="POST" action="">
    <ul>
        <li class="section_title"><?php echo lang('worldwide_meta_worldwide') ?></li>
        <?php print_url_info(false,'',true) ?>
        
        <li class="section_title"><?php echo lang('worldwide_meta_be_agent') ?></li>
        <?php print_url_info(false,'be_agent_',true) ?>
        
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
            '<?php echo lang('worldwide_crete_name') ?>',
            '<?php echo lang('worldwide_crete_product') ?>',
            '<?php echo lang('worldwide_crete_country') ?>',
            '<?php echo lang('worldwide_crete_address') ?>',
            '<?php echo lang('worldwide_crete_fax') ?>',
            '<?php echo lang('worldwide_crete_tel') ?>',
            '<?php echo lang('worldwide_crete_email') ?>',
            '<?php echo lang('worldwide_crete_order') ?>',
            '<?php echo lang('worldwide_crete_is_active') ?>',
            '',
            ''
                ],
        colModel:
        [
        {name:"agent_name",index:"agent_name",width:130},
        {name:"agent_products",index:"agent_products",width:120},
        {name:"agent_country",index:"agent_country",width:80},
        {name:"agent_address",index:"agent_address",width:120},
        {name:"agent_fax",index:"agent_fax",width:80},
        {name:"agent_tel",index:"agent_tel",width:80},
        {name:"agent_email",index:"agent_email",width:100},
        {name:"agent_order",index:"agent_order",width:80},
        {name:"agent_is_active",index:"agent_is_active",width:80,classes:'grid_center'},
        {name:"agent_edit",index:"agent_edit",width:80},
        {name:"agent_delete",index:"agent_delete",width:80},
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        shrinkToFit:false,
        pager: '#pager2',
        sortname: 'prod_order',
        viewrecords: true,
        sortorder: "desc",
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
    var mydata = <?php echo $agents_json ?>;
    for(var i=0;i<=mydata.length;i++) 
        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>