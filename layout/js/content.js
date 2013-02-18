$(document).ready(function(){
    $(':checkbox').click(function(){
        $(this).parent().remove('input[type="hidden"]');
        if($(this).val()==0){
            $(this).val(1);
            $('#'+$(this).attr('name')+'_hidden').val(1);
        }else{
            $(this).val(0);
            $('#'+$(this).attr('name')+'_hidden').val(0);
        }
    });
    $(':checkbox').each(function(i){
        $(this).parent().append('<input type="hidden" id="'+$(this).attr('name')+'_hidden" value="'+$(this).val()+'" name="'+$(this).attr('name')+'" />');
    })
});
function site_url(controller){
    if(!controller){
        controller= '';
    }
    var pathname = $(location).attr('href');
    var url_parts = pathname.split('/');
    var base_url = '';
    if(url_parts[2] == 'localhost' || url_parts[2] == '127.0.0.1'){
        base_url = url_parts[0] + '//' + url_parts[2] + '/'  + url_parts[3] + '/';
    }else{
        base_url = url_parts[0] + '//' + url_parts[2] + '/';
    }
    var url = base_url + controller;
    return url;
    
}
$(document).ready(
    function(){
//        $('#menu a,#menu span').not('.sub-menu li a').hover(
//            function(){
//                if($('.products').not(':hover')&&$('.sub-menu').is(':visible')){
//                    $('.sub-menu').fadeOut();
//                }
//            },
//            function(){
//                if($('.products').not(':hover')&&$('.sub-menu').is(':visible')){
//                    $('.sub-menu').fadeOut();
//                }
//            }
//            );
//        $('.products').hover(
//            function(){
//                if($('.sub-menu').not(':visible'))
//                    $('.sub-menu').fadeIn();
//                    
//                $('.sub-menu').hover(function(){
//                    if($('.sub-menu').not(':visible'))
//                        $('.sub-menu').fadeIn();
//                }, function(e){
//                    $('.sub-menu').fadeOut();
//                });
//            },function(e){
//                if(parseInt(e.pageY) < 120){
//                    $('.sub-menu').fadeOut();
//                };
//            })
        $('#menu').find('> li').hover(function(){
		$(this).find('ul')
		.removeClass('noJS')
		.stop(true, true).slideToggle('fast');
	});
    })