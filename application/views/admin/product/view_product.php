<ul>
    <li class="section_title"><?php echo lang('product_tabs_title'); ?></li>
    <li><a href="<?php echo site_url('admin/product/add_tab/' . $prod_id) ?>"><?php echo lang('product_tabs_list_new') ?></a></li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
    <li class="section_title"><?php echo lang('product_pdf_title'); ?></li>
    <li><a href="<?php echo site_url('admin/product/add_pdf/' . $prod_id) ?>"><?php echo lang('product_pdf_list_new') ?></a></li>
    <li>
        <table id="list3"></table>
        <div id="pager3"></div>
    </li>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
    <div id="product_images">
        <?php $this->load->view('admin/product/product_images') ?>
    </div>

</ul>
<script>
    jQuery("#list2").jqGrid(
    { 
        direction:'<?php echo get_dir() ?>',
        datatype: "local",
        colNames:[
<?php foreach (get_lang_list() as $code => $lang) { ?>"<?php echo lang("product_tab_form_title_$code") ?>",<?php } ?>
                        "<?php echo lang('product_tab_form_order') ?>",
                        "<?php echo lang('product_tab_form_active') ?>",
                        "",
                        "",
                        "",
                    ],
                    colModel:
                        [
<?php foreach (get_lang_list() as $code => $lang) { ?>
                        {name:"tab_title_<?php echo $code ?>",index:"tab_title_<?php echo $code ?>",width:80},
<?php } ?>
                    {name:"tab_order",index:"tab_order",width:80,classes:'grid_center'},
                    {name:"tab_is_active",index:"tab_is_active",width:80,classes:'grid_center'},
                    {name:"tab_edit",index:"tab_edit",width:80},
                    {name:"tab_delete",index:"tab_delete",width:80},
                    {name:"tab_images",index:"tab_images",width:80}
                ],
                rowNum:10,
                rowList:[10,20,30],
                height:230,
                width:910,
                pager: '#pager2',
                sortname: 'tab_order',
                viewrecords: true,
                sortorder: "desc",
                loadonce: true
            });
            jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
            var mydata = <?php echo $tabs_json ?>;
            for(var i=0;i<=mydata.length;i++) 
                jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>
<script>
    jQuery("#list3").jqGrid(
    { 
        direction:'<?php echo get_dir() ?>',
        datatype: "local",
        colNames:[
<?php foreach (get_lang_list() as $code => $lang) { ?>"<?php echo lang("product_pdf_form_title_$code") ?>",<?php } ?>
                        "<?php echo lang('product_pdf_form_tab') ?>",
                        "<?php echo lang('product_pdf_form_order') ?>",
                        "<?php echo lang('product_pdf_form_active') ?>",
                        "",
                        "",
                    ],
                    colModel:
                        [
<?php foreach (get_lang_list() as $code => $lang) { ?>
                        {name:"pdf_title_<?php echo $code ?>",index:"pdf_title_<?php echo $code ?>",width:80},
<?php } ?>
                    {name:"tab_id",index:"tab_id",width:180,classes:''},
                    {name:"pdf_order",index:"pdf_order",width:40,classes:'grid_center'},
                    {name:"pdf_is_active",index:"pdf_is_active",width:40,classes:'grid_center'},
                    {name:"pdf_edit",index:"pdf_is_active",width:40},
                    {name:"pdf_delete",index:"pdf_is_active",width:40}
                ],
                rowNum:10,
                rowList:[10,20,30],
                height:230,
                width:910,
                pager: '#pager3',
                sortname: 'pdf_order',
                viewrecords: true,
                sortorder: "desc",
                loadonce: true
            });
            jQuery("#list3").jqGrid('navGrid','#pager3',{edit:false,add:false,del:false});
            var mydata = <?php echo $pdfs_json ?>;
            for(var i=0;i<=mydata.length;i++) 
                jQuery("#list3").jqGrid('addRowData',i+1,mydata[i]);
</script>