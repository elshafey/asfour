<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo get_static_url($banner_path); ?>)!important;
    }
</style>
<div class="inside-banner"></div>
<div class="inside-menu">
    <a href="<?php echo site_url('home/worldwide'); ?>" class="active">Asfour Worldwide</a>
    <span class="separator"></span>
    <a href="<?php echo site_url('home/become_agent'); ?>">Become an Agent</a>
</div>
<div class="clear"></div>
<h1 class="left_title">
    <?php echo $page_title ?>
</h1>
<p class="worldwide-txt">
    Asfour Crystal enjoys a global presence in more than 90 countries across the entire globe. We choose our partners carefully and ensure our representatives, agents and distributors understand the value of the Asfour name and importance of representing it in only the finest and most accommodating manner.
</p>
<div class="become-agent" style="width: 254px">
    <p style="background-color: #cccccc" class="news-title">
        Additional contact information
    </p>
</div>
<div style="width: 254px;float: right;margin-top: 15px;">
    Distributres of Crystal Parts, please send email to: <a href="mailto:  crystal.parts@asfourcrystal.com" style="color: #2CB2CF;"> crystal.parts@asfourcrystal.com</a> <br /><br />
    Distributres of Gifts, please send email to: <a href="mailto: gifts@asfourcrystal.com" style="color: #2CB2CF;">gifts@asfourcrystal.com</a> <br /><br />
    Distributres of Crys-Tile, please send email to: <a href="mailto: crystile@asfourcrystal.com" style="color: #2CB2CF;">crystile@asfourcrystal.com</a> <br />
</div>
<div class="inside-left" style="width: 330px">
    <div class="countries">
        <div class="label"><?php echo lang('home_worldwide_country') ?></div>
        <div>
            <select name="country_id" id="country_id" >
                <option value=""><?php echo lang('global_select') ?></option>
                <?php foreach ($countries as $key => $country) { ?>
                    <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <!--    <div style="margin-top: 20px;" >        
            <div class="label"><?php echo lang('home_worldwide_product') ?></div>
            <div id="products_list">
                <select name="product_id" id="product_id" >
                    <option value=""><?php echo lang('global_select') ?></option>
                </select>
            </div>
        </div>-->
    <!--    <div class="countries_mages" style="width:500px">
    <?php foreach ($countries as $key => $country) { ?>
                    <div class="country_image" id="country_image_<?php echo $country['country_id'] ?>" style="display: none">
                            <span style="color: #38B776;margin-bottom: 6px;"><?php echo $country['country_name'] ?></span>
                                        <div style="clear: both">
                                            <img src="<?php echo base_url() . ($country['country_logo']) ?>">
                                        </div>
                    </div>
    <?php } ?>
        </div>-->
</div>
<div class="inside-right" style="width: 70%;margin-top: 20px">

</div>
<script>
    $(document).ready(function(){
        $('#country_id').change(function(){
            if($('#country_id').val() != ''){
                $('.country_image').hide();
                $('#country_image_'+$(this).val()).show();
                $('#product_id').attr('disable','disable')
                $.post('<?php echo site_url('home/country_agents') ?>/'+$(this).val(),function(data){
                    if(data.length > 3){
                        $('.inside-right').html(data);
                    }else{
                        $('.inside-right').html('<?php echo lang('home_world_wide_no_agents') ?>');
                    }
                })
            }            
        });
    });
</script>
