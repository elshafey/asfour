<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=en"></script>
<script type="text/javascript" src="<?php echo base_url() . 'layout/js/jquery.googlemap.js' ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#map').gMap({
            latitude: $('#latitude'),
            longitude: $('#longitude')            
        });                
    });	    
</script>

<form method="POST" >
    <ul>
        <li>   
            <?php echo lang('showrooms_name', 'showrooms_name'); ?>
            <input type="text" class="txtbox" name="name" id="" value="<?php echo set_value('name') ?>" />
            <span class="star">*</span>
            <?php echo form_error('name') ?>
        </li>
        <li>   
            <?php echo lang('showrooms_address', 'showrooms_address'); ?>
            <input type="text" class="txtbox" name="address" id="" value="<?php echo set_value('address') ?>" />
            <span class="star">*</span>
            <?php echo form_error('address') ?>
        </li>
        <li>   
            <?php echo lang('showrooms_tel', 'showrooms_tel'); ?>
            <input type="text" class="txtbox" name="tel" id="" value="<?php echo set_value('tel') ?>" />
            <span class="star">*</span>
            <?php echo form_error('tel') ?>
        </li>
        <li>  
            <?php echo lang('showrooms_fax', 'showrooms_fax'); ?>
            <input type="text" class="txtbox" name="fax" id="" value="<?php echo set_value('fax') ?>" />
            <span class="star">*</span>
            <?php echo form_error('fax') ?>
        </li>
        <li>   
            <span style="margin-left: 478px;" class="frm_error_msg"><?php if (form_error('longitude') || form_error('latitude')) echo lang('showrooms_location_error') ?></span>
            <div style="width: 400px;margin-left: 175px;" id="map"></div>
            <input type="hidden" class="txtbox" name="longitude" id="longitude" value="<?php echo set_value('longitude') ?>" />            
            <input type="hidden" class="txtbox" name="latitude" id="latitude" value="<?php echo set_value('latitude') ?>" />            
        </li>

        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />            
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
            "name",
            "address",
            "tel.",                    
            "",
        ],
        colModel:
            [
            {name:"showroom_name",index:"showroom_name",width:80},
            {name:"showroom_address",index:"showroom_address",width:80},
            {name:"showroom_tel",index:"showroom_tel",width:80},
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
        loadonce: true
    });
    jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
    var mydata = <?php echo $showroom_json ?>;
    for(var i=0;i<=mydata.length;i++) 
        jQuery("#list2").jqGrid('addRowData',i+1,mydata[i]);
</script>
<form method="POST" action="<?php echo site_url('/admin/page/showrooms/meta') ?>">
    <ul>
        <li class="section_title"> <?php echo lang('showrooms_meta_manage') ?></li>
        <?php print_url_info(false, '', true) ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />            
        </li>
    </ul>
</form>