<div class="inside-banner"></div>
<div class="news-section">
    <h1 class="left_title">
        <?php echo $job['JobDetails'][0]['job_title'] ?>
    </h1>
    <p>
        <span class="news-title"><?php echo lang('careers_form_job_code') ?>:</span>
        <?php echo $job['job_code'] ?>
    </p>
    <p style="margin-bottom: 10px;">
        <span class="news-title"><?php echo lang('careers_form_location') ?>:</span>
        <?php echo $job['JobDetails'][0]['job_location'] ?>
    </p>
    <?php echo $job['JobDetails'][0]['job_description'] ?>

</div>