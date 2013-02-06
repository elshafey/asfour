<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
define('LATEST_NEWS_LIMIT', 2);
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('MAX_INBOX_COUNT',20);
define('URL_PREFIX_QUALITY', 'asfour-quality');
define('ONLINE_REGISTERED_TYPE','online-registered');
define('URL_PREFIX_PRODUCT_VIEW', 'home/product/');
define('URL_PREFIX_CAREER', 'home/careers/');
define('URL_PREFIX_PRODUCT_TAB_VIEW', 'home/tab/');
define('URL_PREFIX_PAGE', 'home/page/');
define('URL_PREFIX_AGENTS', 'home/worldwide/');
define('URL_PREFIX_FAQS', 'home/faq/');
define('URL_PREFIX_HOME', 'home/index/');
define('URL_PREFIX_WORLDWIDE', 'home/worldwide/');
define('URL_PREFIX_BE_AGENT', 'home/become_agent/');
define('URL_PREFIX_NEWS', 'home/view_news/');
define('URL_PREFIX_MEDIACENTER', 'home/media_center/');
define('URL_PREFIX_ALL_NEWS', 'home/media_center/news');
define('URL_PREFIX_ALL_PRESS_RELEASE', 'home/media_center/press');
define('URL_PREFIX_CUSTOMERSERVICE', 'home/customer_services/');
define('URL_PREFIX_CONTACT_US', 'home/contact_us/');
define('URL_PREFIX_SHOWROOMS', 'home/showrooms/');
define('URL_PREFIX_PAGE_CONTACTUS', 'home/page/contact-us');
define('ROUTS_ITEM_TEMPLATE','$route["%s"]        ="%s";');

/* End of file constants.php */
/* Location: ./application/config/constants.php */