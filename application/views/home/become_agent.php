<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo get_static_url($banner_path);?>)!important;
    }
</style>
<script type="text/javascript">
    jQuery.validator.addMethod("selectNone",function(value, element) {
        if (element.value == 0)
        {
            return false;
        }
        else return true;
    },"Required Field" );

    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                department_id: "required",                        
                name: "required",                       
                country_id: "required",                       
                message: "required",                       
                email: {// compound rule
                    required: true,
                    email: true
                },
                tel: {// compound rule
                    required: true,
                    number: true
                }
            }
        });
    });

</script>
<div class="inside-banner"></div>
<div class="inside-menu">
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_WORLDWIDE));?>">Asfour Worldwide</a>
    <span class="separator"></span>
    <a class="active" href="<?php echo site_url(get_routed_url(URL_PREFIX_BE_AGENT));?>">Become an Agent</a>
</div>
<div class="clear"></div>
<div>
    <h1 class="left_title">
        <?php echo $page_title ?>
    </h1>
    <?php echo form_open('', 'id="form1"'); ?>
    <ul>
        <li class="msg">
            <?php 
                $msg = $this->session->flashdata('msg');
                echo $msg;
            ?>
        </li>
        <li>
            <label for=""><?php echo lang('home_contact_us_products') ?>:</label>
            <select name="department_id" id="department_id" >
                <option value=""><?php echo lang('global_select') ?></option>                
                <?php foreach ($products as $key => $value) { ?>
                <option value="<?php echo $value['prod_id'] ?>"><?php echo $value['ProductDetails'][0]['prod_title'] ?></option>  
                <?php } ?>                
            </select>
            <span for="department_id" generated="true" class="error">*</span>
        </li>
        <li>
            <label for="">Name:</label>
            <input type="text" name="name" class="txtbox" />
            <span for="name" generated="true" class="error">*</span>
        </li>
        <li>
            <label for="">Company:</label>
            <input type="text" name="company" class="txtbox" />
        </li>
        <li>
            <label for="">Country:</label>
            <select name="country_id" id="country_id" >
                <option value=""><?php echo lang('global_select') ?></option>
                <?php foreach ($countries as $key => $country) { ?>
                    <option value="<?php echo $country['country_name'] ?>"><?php echo $country['country_name'] ?></option>
                <?php } ?>
            </select>
            <span for="country_id" generated="true" class="error">*</span>
        </li>
        <li>
            <label for="">Tel.:</label>
            <input type="text" name="tel" class="txtbox" />
            <span for="tel" generated="true" class="error">*</span>
        </li>
        <li>
            <label for="">Email:</label>
            <input type="text" name="email" class="txtbox" />
            <span for="email" generated="true" class="error">*</span>
        </li>
        <li>
            <label for="">Message:</label>
            <textarea cols="40" rows="5" style="width: 300px;height: 40px;" name="message" class="txtbox" ></textarea>
            <span for="message" generated="true" class="error">*</span>
        </li>
        <li class="btns">
            <?php echo form_submit('submit', 'Send', 'class="awesome"'); ?>
        </li>
    </ul>
    <?php echo form_close(); ?>
</div>