<ul>
    <li><a href="<?php echo site_url('admin/faq/create') ?>"><?php echo lang('faq_list_new') ?></a></li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
<form method="POST" action="">
    <ul>
        
        <?php print_url_info(false,'',true) ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
        </li>
        
    </ul>
</form>
<script>
    var mydata = <?php echo $faq_json ?>;
    jQuery("#list2").jqGrid(
    { 
        direction:'<?php echo get_dir() ?>',
        datatype: "local",
        colNames:[
            <?php foreach (get_lang_list() as $code => $lang) { ?>"<?php echo lang("faq_form_question_$code") ?>",<?php }?>
                    "<?php echo lang('faq_form_order') ?>",
                    "<?php echo lang('faq_form_active') ?>",
                    "",
                    "",
                ],
        colModel:
        [
        <?php foreach (get_lang_list() as $code => $lang) { ?>
        {name:"faq_question_<?php echo $code ?>",index:"faq_question_<?php echo $code ?>",width:80},
        <?php } ?>
        {name:"faq_order",index:"faq_order",width:80,width:80,classes:'grid_center',sorttype:function(cell,row){return parseInt($(cell).text());}},
        {name:"faq_is_active",index:"faq_is_active",width:80,width:80,classes:'grid_center'},
        {name:"faq_edit",index:"faq_is_active",width:80},
        {name:"faq_delete",index:"faq_is_active",width:80}
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        pager: '#pager2',
        sortname: 'faq_order',
        viewrecords: true,
        sortorder: "desc",
        data:mydata,
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false});
    
</script>