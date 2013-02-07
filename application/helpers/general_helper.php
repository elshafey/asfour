<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function load_common_data(){
    $CI=  get_instance();
    $CI->data['products']=  ProductsTable::getProducts(get_language_id(),true,true);
    $pagesTitles=  PagesTable::getPagesTitles();
    $CI->data['about_us_title']=$pagesTitles['about-us'];
    $CI->data['quality_title']=$pagesTitles['asfour-quality'];
    $CI->data['contact_us_title']=$pagesTitles['contact-us'];
}

function sub_string_from_start($string,$length){
    return substr(strip_tags($string), 0,$length).((strlen($string)>$length)?'...':'');
}

function get_product_images($prod_id,$limit){
    $productImages= ProductImagesTable::getImages($prod_id,$limit,true);
//    foreach ($productImages as $key => $value) {
//        $images[]=$value['path'];
//    }
    return $productImages;
}

function get_active_menu_item($slug = ''){
    $menu = array();
    switch($slug){
        case 'about-us':
            $menu = array('active', '', '', '', '', '', '', '');
            break;
        case 'contact-us':
            $menu = array('', '', '', '', '', '', '', 'active');
            break;
        case 'asfour-quality':
            $menu = array('', '', 'active', '', '', '', '', '');
            break;        
        case '':
            $menu = array('', '', '', '', '', '', '', '');
            break;        
    }
    
    return $menu;
}

function more_less_str($str){
//    pre_print($str);
    $lines=  explode('<br />', trim($str));
    
    $lessed=$lines[0];
    if(count($lines)>=2){
        $words=explode(' ', $lines[0]);
        if(count($words)>30){
            $arr=array_slice($words,0,40);
            $lessed=implode(' ',$arr);
        }else{
            $lessed=implode(' ',$words);
            $words2=explode(' ', $lines[1]);
            if(count($words)+  count($words2)>=60){
                $arr=array_slice($words2,0,20);
                $lessed.='<br>'.implode(' ',$arr);
            }else{
                $lessed.='<br>'.implode(' ',$words2);
            }
        }
    }else{
        $words=explode(' ', $lines[0]);
        if(count($words)>54){
            $arr=array_slice($words,0,40);
            $lessed=implode(' ',$arr);
        }
    }
    $lessed=(count(explode(' ',trim($str)))<=count(explode(' ',trim($lessed))))? $lessed:$lessed.'...<span class="see_more link">'.lang('global_more').'</span>';
    return
    '<div class="lessed">'.$lessed.'</div>'
    .'<div class="mored"  style="display:none">'.implode('<br>', $lines).' <span class="see_less">...Less</span></div>'    
        ;    
//    pre_print($lines);
}
?>
