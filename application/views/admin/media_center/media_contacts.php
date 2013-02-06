<form method="POST" >
    <ul>
        <li>
            <?php echo lang('products', 'products') ?>
            <select name="product_details_id">
                <?php foreach ($products as $product) { ?>
                <option value="<?php echo $product['ProductDetails'][0]['detail_id']; ?>"><?php echo $product['ProductDetails'][0]['prod_title']; ?></option>
                <?php } ?>
        </select>
        <span class="star">*</span>
    </li>
    <li>
        <?php echo lang('email', 'email') ?>
        <input type="text" class="txtbox" name="email" id="" value="" />
        <span class="star">*</span>            
    </li>        
    <li class="btns">
        <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
        <a href="<?php echo site_url('admin/news') ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
    </li>
</ul>
</form>

<table id="list2"></table>
        <div id="pager2"></div>
<script>
    jQuery("#list2").jqGrid(
    { 
        direction:'<?php echo get_dir() ?>',
        datatype: "local",
        colNames:[
                    "prod_title",
                    "email",
                ],
        colModel:
        [
        {name:"prod_title",index:"prod_title",width:80},
        {name:"email",index:"email",width:80},        
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        pager: '#pager2',
        sortname: 'showroom_order',
        viewrecords: true,
        sortorder: "desc",
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
    var mydata = <?php echo $media_contacts ?>;
    for(var i=0;i<=mydata.length;i++) 
        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>