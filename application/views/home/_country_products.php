<select name="product_id" id="product_id" >
    <option value=""><?php echo lang('global_select') ?></option>
    <?php foreach ($products as $key => $product) { ?>
        <option value="<?php echo $product['prod_id'] ?>"><?php echo $product['prod_title'] ?></option>
    <?php } ?>
</select>
<script>
    $('#product_id').change(function(){
        if($('#product_id').val() != ''){
            $.post('<?php echo site_url('home/product_agents') ?>/'+$(this).val()+'/'+$('#country_id').val(),function(data){
                if(data.length > 3){
                    $('.inside-right').html(data);
                }else{
                    $('.inside-right').html('there is no agent');
                }
                
            })
        }
        
    });
</script>