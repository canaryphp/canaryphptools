<?php
/**
 *
 * DS = DIRECTORY_SEPARATOR = (/) (slash)
 *
 */
defined('DS') OR define('DS',DIRECTORY_SEPARATOR);
/**
 *
 * CHARSET the default charset
 *
 */
defined('CHARSET') OR define('CHARSET','utf-8');
/**
 *
 * PS = PATH_SEPARATOR = (:) (Two point)
 *
 */
defined('PS') OR define('PS',PATH_SEPARATOR);
/**
 *
 * EOL = PHP_EOL = ('\n') (new line)
 *s
 */
defined('EOL') OR define('EOL',PHP_EOL);
/**
 *
 * ROOT home base url
 *
 */
defined('CPT_ROOT') OR define('CPT_ROOT',dirname(__DIR__));
/**
 *
 * HOST hostname (domainname)
 *
 */
defined('HOST') OR define('HOST',$_SERVER['HTTP_HOST']);
/**
 *
 *  LOG logs base url
 *
 */
defined('CPT_LOG') OR define('CPT_LOG',CPT_ROOT.DS.'logs');
/**
 *
 * LOCALE locale base url (translation)
 *
 */
defined('CPT_LOCALE') OR define('CPT_LOCALE',CPT_ROOT.DS.'locale');
/**
 *
 *  Default time zone
 *
 */
defined('CPT_DEFAULT_TIME_ZONE') OR define('CPT_DEFAULT_TIME_ZONE','Africa/Algiers');
/**
 *
 * local script version
 *
 */
defined('CPT_VERSION') OR define('CPT_VERSION',file_get_contents(dirname(CPT_ROOT).DS.'VERSION'));
