<div class="inside-banner"></div>
<div class="news-section">
    <h1 class="left_title">
        <?php echo $page_title ?>
    </h1>
    <?php foreach ($jobs as $job) { ?>
        <?php $url = site_url() . get_routed_url(URL_PREFIX_CAREER . $job['job_id']); ?>
        <div class="news-title"><?php echo $job['JobDetails'][0]['job_title']; ?></div>
        <span class="news-title"><?php echo lang('careers_form_job_code') ?>:</span><?php echo $job['job_code']  ?>
        <p style="margin-top: 10px;">
            <?php echo sub_string_from_start($job['JobDetails'][0]['job_description'], 200) . anchor($url, 'Read more', 'class="link"'); ?>
        </p>
        <div class="news-separator"></div>
    <?php } ?>
</div>
