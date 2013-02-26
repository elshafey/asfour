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
<!--            <span class="star">*</span>-->
            <?php echo form_error('tel') ?>
        </li>
        <li>  
            <?php echo lang('showrooms_fax', 'showrooms_fax'); ?>
            <input type="text" class="txtbox" name="fax" id="" value="<?php echo set_value('fax') ?>" />
<!--            <span class="star">*</span>-->
            <?php echo form_error('fax') ?>
        </li>
        <li>
            <?php echo lang('showrooms_form_order','location_order') ?>
            <input type="text" class="txtbox" name="<?php echo 'location_order' ?>" id="<?php echo 'location_order' ?>" value="<?php echo set_value('location_order') ?>" />
            <span class="star">*</span>
            <?php echo form_error("location_order"); ?>
        </li>
        <li>
            <?php echo lang("showrooms_form_active",'is_active'); ?>
            <input name="is_active" id="is_active" value="<?php echo set_value("is_active", "0") ?>" <?php echo set_checkbox("is_active", "1") ?>  type="checkbox" />
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