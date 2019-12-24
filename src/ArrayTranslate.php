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
class ArrayTranslate{
public function __construct($locale_dir = null,$language = null){
    //Create Canary object
    self::$canary = new Canary;
	if($locale_dir !== null){
		self::$dir = $locale_dir;
	}else{
		if(!cp_config('url.locale')) {
            exit("<b>Exception :</b>Locale url not found");
        }
        self::$dir = cp_config('url.locale');
    }
    if($language === null){
        $language = self::$canary->language();
    }
    //Full path to Translate file
    $full_path = self::$dir.DS.'__ARRAY__'.$language.DS.'default.php';
    //Check file if exist : if false return default dir
    $full_path = (file_exists($full_path)) ? $full_path : self::$dir.DS.'__ARRAY__'.DS.'default.php';
    //Check translate :if false return exception
    if(file_exists($full_path)){
        require $full_path;
        $LANGUAGE = $TRAN;
        self::$_NAME = $LANGUAGE['language']['name'];
        self::$_CODE = $LANGUAGE['language']['code'];
        self::$_MSG = $LANGUAGE['msg'];
	}else{
        throw new \CanaryPHPTools\Exception("Translate file dosn't exist, \n create file in : \n".$full_path);
    }
}
/**
 *
 * locale dir
 *
 */
private static $dir;
/**
 *
 * Exeternel object
 *
 * @param (obj)
 *
**/
private static $canary;
/**
 *
 * Locale language information
 *
 * @param (string)
 *
**/
public static $_NAME,$_CODE,$_MSG;
/**
 * Translate with Arrays
 *
 * @param (param)
 *
**/
public static function _a(){
	$args = func_get_args();
	$numargs = func_num_args();
	if($numargs >=1){
		if(isset(self::$_MSG[$args[0]])){
			$args[0] = self::$_MSG[$args[0]];
		}
		return call_user_func_array('sprintf',$args);
	}else{
		return $args[0];
	}
}
}
