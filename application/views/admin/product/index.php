<ul>
    <li><a href="<?php echo site_url('admin/product/create') ?>"><?php echo lang('product_list_new') ?></a></li>
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
            <?php foreach (get_lang_list() as $code => $lang) { ?>"<?php echo lang("product_form_title_$code") ?>",<?php }?>
                    "<?php echo lang('product_form_order') ?>",
                    "<?php echo lang('product_form_tabs') ?>",
                    "<?php echo lang('product_form_active') ?>",
                    "",                    
                    "",
                ],
        colModel:
        [
        <?php foreach (get_lang_list() as $code => $lang) { ?>
        {name:"prod_title_<?php echo $code ?>",index:"prod_title_<?php echo $code ?>",width:80},
        <?php } ?>        
            {name:"prod_order",index:"prod_order",width:80,sorttype:function(cell,row){return parseInt($(cell).html());}},
        {name:"tabs",index:"tabs",width:80},
        {name:"prod_is_active",index:"prod_is_active",width:80,classes:'grid_center'},
        {name:"prod_edit",index:"prod_is_active",width:80},
        {name:"prod_delete",index:"prod_is_active",width:80}
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        pager: '#pager2',
        sortname: 'prod_order',
        viewrecords: true,
        sortorder: "desc",
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
    var mydata = <?php echo $json ?>;
    for(var i=0;i<=mydata.length;i++) 
        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>