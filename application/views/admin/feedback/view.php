<form>
    <ul>
        <li>
            <?php echo lang('feedback_view_title', ' ') ?>:
            <input disabled value="<?php echo $feedback->title; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_firs_name', ' ') ?>:
            <input disabled value="<?php echo $feedback->first_name; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_last_name', ' ') ?>:
            <input disabled value="<?php echo $feedback->last_name; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_company', ' ') ?>:
            <input disabled value="<?php echo $feedback->company; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_position', ' ') ?>:
            <input disabled value="<?php echo $feedback->position; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_address', ' ') ?>:
            <input disabled value="<?php echo $feedback->address; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_city', ' ') ?>:
            <input disabled value="<?php echo $feedback->city; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_country', ' ') ?>:
            <input disabled value="<?php echo $feedback->country; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_phone', ' ') ?>:
            <input disabled value="<?php echo $feedback->phone; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_fax', ' ') ?>:
            <input disabled value="<?php echo $feedback->fax; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_email', ' ') ?>:
            <input disabled value="<?php echo $feedback->email; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_subject', ' ') ?>:
            <input disabled value="<?php echo $feedback->subject; ?>">
        </li>
        <li>
            <?php echo lang('feedback_view_message', ' ') ?>
            <textarea disabled><?php echo $feedback->message; ?>"</textarea>
        </li>
    </ul>
</form>