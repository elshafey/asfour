<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function load_grid_files() {
    $CI = &get_instance();
    $CI->template->add_css("layout/css/grid/jquery-ui-1.8.2.custom.css");
    $CI->template->add_js("layout/js/jquery/jquery-ui.min.js");
    $CI->template->add_css("layout/css/grid/ui.jqgrid.css");
    $CI->template->add_css("layout/css/grid/ui.multiselect.css");
    $CI->template->add_js("layout/js/grid/jquery.layout.js");
    $CI->template->add_js("layout/js/grid/i18n/grid.locale-" . get_locale() . ".js");
    $CI->template->add_js("layout/js/grid/jquery.jqGrid.min.js");
    $CI->template->add_js("layout/js/grid/jquery.tablednd.js");
    $CI->template->add_js("layout/js/grid/jquery.contextmenu.js");
    $CI->template->add_js("layout/js/grid/ui.multiselect.js");
}

function get_grid_json($data) {
    $array = array();
    if ($data) {
        foreach ($data as $index => $items) {
            foreach ($items as $key => $value) {
                $exploded = explode('_', $key);
                unset($exploded[0]);
                $array[$index][implode('_', $exploded)] = $value;
            }
        }
    }
    return $array;
}

function active_icon($state, $controller, $model, $id) {
    return
            '<a href="' . site_url("admin/$controller/" . ($state ? 'deactivate' : 'activate') . "/$model/$id") . '">'
            . '<img height="18" src="' . base_url("layout/images/" . ($state ? 'active' : 'inactive') . '.png') . '" />'
            . '</a>';
}

function order_icon($order, $controller, $model, $id) {
    
    if($model !=''){
        $model = $model. '/';
    }
    return
            '<div class="order_change">' .$order.'</div>'.
            '<div class="arrows">'.
            (
            ($order > 1) ?
                    '<a href="' . site_url("admin/$controller/orderup/$model$id/$order") . '" class="ui-icon ui-icon-circle-arrow-n">
                        &nbsp
                    </a>' : '<div class="empty_arrow"></div>'
            ) .
            '<a href="' . site_url("admin/$controller/orderdown/$model$id/$order") . '" class="ui-icon ui-icon-circle-arrow-s" >
                        &nbsp
             </a>'.
            '</div>';
}

?>