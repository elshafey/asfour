<?php echo form_open('','AUTOCOMPLETE="OFF"'); ?>
<ul>
    <li>
        <label>Username:</label>
        <input type="text" class="txtbox" name="username" />
    </li>
    <li>
        <label>Password:</label>
        <input type="password" class="txtbox" name="password" />
    </li>
    <li class="btns">
        <?php echo form_submit('submit', 'Login');?>
    </li>
</ul>
<?php echo form_close(); ?>