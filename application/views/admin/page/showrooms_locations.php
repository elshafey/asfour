<a href="<?php echo site_url('admin/showrooms/create') ?>"><?php echo lang('showrooms_new') ?></a>
<br>
<br>
<table id="list2"></table>
<div id="pager2"></div>
<script>
    var mydata = <?php echo $showroom_json ?>;
    jQuery("#list2").jqGrid(
    { 
        direction:'<?php echo get_dir() ?>',
        datatype: "local",
        colNames:[
            "name",
            "address",
            "tel.",                    
            "",
            "",
        ],
        colModel:
            [
            {name:"showroom_name",index:"showroom_name",width:80},
            {name:"showroom_address",index:"showroom_address",width:80},
            {name:"showroom_tel",index:"showroom_tel",width:80},
            {name:"showroom_edit",index:"showroom_edit",width:80},
            {name:"showroom_delete",index:"showroom_delete",width:80}
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        pager: '#pager2',
        sortname: 'showroom_order',
        viewrecords: true,
        sortorder: "desc",
        data:mydata,
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false});
    
//    for(var i=0;i<=mydata.length;i++) 
//        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>
<form method="POST" action="<?php echo site_url('/admin/showrooms/index/meta') ?>">
    <ul>
        <li class="section_title"> <?php echo lang('showrooms_meta_manage') ?></li>
        <?php print_url_info(false, '', true) ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />            
        </li>
    </ul>
</form>