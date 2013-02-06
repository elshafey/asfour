<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo get_static_url($banner_path);?>)!important;
    }
    .see_more,.see_less{
        color:#4472c4;
        cursor: pointer;
    }
</style>
<div class="inside-banner"></div>
<?php if($formatted=='formatted'){ ?>
<div class="inside-left">
    <h1 class="left_title"><?php echo $page_title ?></h1>
    <div id="accordion">
        <?php foreach ($faqs as $key => $value) { ?>
        <p class="news-title" style="background-color: <?php ($key%2)? '#cccccc':'#F5F5F5' ?>"><span><?php echo $value['FaqDetails'][0]['faq_question'] ?></span></p>
            <div class="news_text">
                <?php echo $value['FaqDetails'][0]['faq_answer'] ?>
                <div class="news-separator"></div>
            </div>
        <?php } ?>
    </div>
    <script type="text/javascript">

//        $('#accordion div').hide();
////        $('#accordion div:first').show();
//        $('#accordion p span').click(function(){
//            $('#accordion div').slideUp();
//            $(this).parent().next().slideDown();
//            return false;
//        });

    </script>
</div>
<?php }else{ ?>
<div class="inside-left" style="width: 90%">
    <h1 class="left_title"><?php echo $page_title ?></h1>
    <div id="accordion">
        <?php foreach ($faqs as $key => $value) { ?>
            <p class="news-title" style="background-color: <?php echo ($key%2)? '#cccccc':'#F5F5F5' ?>"><span><?php echo $value['FaqDetails'][0]['faq_question'] ?></span></p>
            <div class="news_text" style="margin-left: 10px;margin-bottom: 10px!important">
                <?php echo more_less_str(strip_tags($value['FaqDetails'][0]['faq_answer'],'<br>')) ?>
            </div>
            <div class="news-separator"></div>
        <?php } ?>
    </div>
    <script type="text/javascript">
    $('.see_more').click(function(){
        $(this).parent().hide();
        $(this).parent().next('.mored').show();
    });
    $('.see_less').click(function(){
        $(this).parent().hide();
        $(this).parent().prev('.lessed').show();
    })
    </script>
</div>

<?php } ?>
