<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| Theme Helper
| -------------------------------------------------------------------
| This file specifies user preferences regarding layout themes and colors.
|
| The file contains functions to set appropriate theme based on the config value.
| The available colors/themes in config are red, green and blue. The selected
| theme are going to be apply on all pages and forms.
 */

/**
 * Get Theme - Return system theme (red || green || blue)
 */
function get_theme()
{
    //Get current instance
    $CI =& get_instance();
    //Return locale session
    return $CI->config->item('theme');
}

/* End of file: theme_helper */
/* Location: ./application/helpers/theme_helper.php */
?>
