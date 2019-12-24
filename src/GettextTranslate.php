<?php
/**
 * CanaryPHPTools(tm) : Tools to improve your project code (canaryphp@gmail.com)
 * Copyright (c) Canaryphp Software Foundation, Inc. (canaryphp@gmail.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Canaryphp Software Foundation, Inc. (canaryphp@gmail.com)
 * @link      https://github.com/canaryphp/canaryphptools CanaryPHP(tm) Project
 * @since     1.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace CanaryPHPTools;
class GettextTranslate{
public function __construct($locale_dir = null,$language = null,$charset = 'UTF-8'){
    if($locale_dir !== null){
		self::$dir = $locale_dir;
	}else{
		if(!cp_config('url.locale')) {
            exit("<b>Exception :</b>Locale url not found");
        }
        self::$dir = cp_config('url.locale');
    }
    if($language === null){
        $canary = new \CanaryPHPTools\Canary();
        $language = $canary->language();
    }
    putenv("LC_ALL={$language}");
    setlocale(LC_ALL,$language);
    bindtextdomain('default',self::$dir);
    bind_textdomain_codeset('default',$charset);
    textdomain('default');
}
/**
 *
 * locale dir
 *
 */
private static $dir;
/**
 * Translate with Arrays
 *
 * @param (param)
 *
**/
public static function __(){
	$args = func_get_args();
    $num = func_num_args();
    $args[0] = gettext($args[0]);
    if($num >1){
	    return call_user_func_array('sprintf', $args);
	}else{
		return $args[0];
	}
}
}
