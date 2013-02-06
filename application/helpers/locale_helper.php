<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| Locale Helper
| -------------------------------------------------------------------
| This file specifies user preferences regarding layout languages and direction.
|
| The file contains functions to set appropriate languages and direction for the
| application during the user session. These functions provides availability to
| check for user language and direction at any given time too.
 */

/**
 * Get Localization - Return user locale language (ar-eg || en-us)
 */
function get_locale()
{
    //Get current instance
    $CI =& get_instance();
    //Return locale session
    return $CI->session->userdata('user_locale');
}

/**
 * Get Dir - Return user layout direction (ltr || rtl)
 */
function get_dir()
{
    //Get current instance
    $CI =& get_instance();
    //Reutrn dir session
    return $CI->session->userdata('user_dir');
}

/**
 * Get Locale Options - Return code for the [select] control found on the master
 */
function get_lang_options()
{
    //Get current instance
    $CI =& get_instance();
    //Reutrn dir session
    return $CI->session->userdata('lang_options');
}

/**
 * Set Locale - This function works on settings the appropriate user locale
 * First, check for user posting (through get) for specific language (?lang=)
 * and set cookie on the client machine for incoming requests. If no cookie 
 * found on the client machine then default language from config is applied.
 * The function set user session holding the language value in all cases to be
 * used among all pages.
 */
function set_locale()
{
    //Prepare local variables
    $locale = '';
    $option_start  = '<option value=';
    $option_middle = '>';
    $option_end    = '</option>';
    $options_code  = ''; 

    //Get current instance
    $CI =& get_instance();

    //Check post first
    $post = $CI->input->get_post('lang');

    //If user post language, then
    if(isset($post) && $post != '')
    {
        //Create user lcoale session
        $CI->session->set_userdata('user_locale', $post);
        $locale = $CI->session->userdata('user_locale');

        //Write cookie on the client machine
        $CI->input->set_cookie('locale', $locale, time() + 3000000, '/');
    }

    //Retrieve list of languages from config
    $langs = $CI->config->item('lang_list');

    //See previous session...
    $session = $CI->session->userdata("user_locale");
    
    //Loop for each language in the list
    foreach($langs as $key => $value)
    {
        

        //Case session has been set due to previous client request
        if(isset($session) && $session != NULL)
        {
            if($key == $session)
            {
                $locale = $key;
                $key    .= " selected";
            }
        }
        else //Case no language request from the client / normal
        {
            //Check cookie on the client machine...
            $cookie = $CI->input->cookie('locale');

            //Apply locale cookie if found
            if($cookie != NULL && $cookie == $key)
            {
                $locale = $key;
                $key    .= " selected";
            }
            else //Okay, no session and no cookie, then apply default config language
            {
                $default = $CI->config->item('language');

                if($key == $default)
                {
                    $locale = $key;
                    $key    .= " selected";
                }	
            }  
        }

        //Write option code to session
        $options_code .= $option_start . $key . $option_middle . $value . $option_end;
        $CI->session->set_userdata("lang_options", $options_code);
    }

    //Not to forget creating locale session...
    $CI->session->set_userdata("user_locale", $locale);
    
    $CI->config->set_item('language',$locale);    
    
    //Load global translation file... 
    $CI->lang->load('global', $locale);
    
    //Load error translation file... 
    $CI->lang->load('error', $locale);
    
    //Load notice translation file... 
    $CI->lang->load('notice', $locale);
    
    //Load confirm translation file... 
    $CI->lang->load('confirm', $locale);
    
    //Load specific translation file for each specific request based on 
    //the controller class name.
    //Notice: This ensure that translation file with this particular name
    //should be in place, unless no translation file loaded.
    if(is_file(APPPATH."language/$locale/{$CI->router->class}_lang.php"))
        $CI->lang->load($CI->router->class, $locale);
    
    //Set application direction based on the current locale
    set_dir($locale);
}

/**
* Set Direction - Applying the appropriate layout direction based on the current
 * localization layout.
 * 
 * @param string $locale 
 */
function set_dir($locale = '')
{
    //Default direction
    $user_dir = 'ltr';
    
    //Check if Arabic then apply rtl
    if($locale == 'ar-eg')
    {
        $user_dir = 'rtl';
    }
    
    //Get current instance
    $CI =& get_instance();
    
    //Create direction session
    $CI->session->set_userdata('user_dir', $user_dir);
}


function get_language_id(){
    
    
    $CI = & get_instance();

    $currentLanguage = $CI->session->userdata("lang");

    if (!isset($currentLanguage) || $currentLanguage == "") {
        
        $currentLanguage = LanguagesTable::getLanguage(get_locale());

        $CI->session->set_userdata("lang", $currentLanguage);
    }
    elseif($currentLanguage["lang_code"]!=  get_locale())
    {
        $currentLanguage = LanguagesTable::getLanguage(get_locale());

        $CI->session->set_userdata("lang", $currentLanguage);
    }
    
    return $currentLanguage["lang_id"];
    
    
}

function get_monthes_list()
{
    $CI =& get_instance();
    
    $CI->lang->load('monthes');
    
    return lang("monthes");
}

function get_lang_list(){
    $CI =& get_instance();
    return $CI->config->item('lang_list');
}
/* End of file: locale_helper */
/* Location: ./application/helpers/locale_helper.php */
?>
