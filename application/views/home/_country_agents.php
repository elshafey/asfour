<?php foreach ($agents as $key => $agent) {?>
    <div class="agent<?php echo (count($agents)-1==$key)? ' last-agent':'' ?>">
    <ul>
        <li>
            <span class="agent-title" ><?php echo lang('worldwide_crete_country') ?>:</span>
            <span>
                <?php echo $agent['Agents']['Countries']['country_name'] ?>
            </span>
        </li>
        <li>
            <span class="agent-title" ><?php echo lang('worldwide_crete_products') ?>:</span>
            <span>
                <?php 
                    $products=array();
                    foreach ($agent['Agents']['ProductAgents'] as $key => $product) {
                        $products[]=$product['Products']['ProductDetails'][0]['prod_title'];
                    }
                    echo implode(', ', $products);
                ?>
            </span>
        </li>
        <li>
            <span class="agent-title" ><?php echo lang('worldwide_crete_name') ?>:</span>
            <span>
                <?php echo $agent['agent_name'] ?>
            </span>
        </li>
        <li>
            <span class="agent-title" ><?php echo lang('worldwide_crete_tel') ?>:</span>
            <span>
                <?php echo $agent['agent_tel'] ?>
            </span>
        </li>
        <li>
            <span class="agent-title" ><?php echo lang('worldwide_crete_fax') ?>:</span>
            <span>
                <?php echo $agent['agent_fax'] ?>
            </span>
        </li>
<!--        <li>
            <span class="agent-title" ><?php echo lang('worldwide_crete_email') ?>:</span>
            <span>
                <?php echo $agent['agent_email'] ?>
            </span>
        </li>-->
        <li>
            <span class="agent-title" ><?php echo lang('worldwide_crete_address') ?>:</span>
            <span>
                <?php echo $agent['agent_address'] ?>
            </span>
        </li>
    </ul>
</div>
<?php } ?>
