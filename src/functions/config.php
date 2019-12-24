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
/*
 *
 * get config
 *
 * @param $path (string)
 *
 * @return (string) return value
 *
 */
function cp_config($path){
	if($path) {
		$CONFIG = $GLOBALS['CP_CONFIG'];
		$path = explode('.', $path);
		foreach($path as $p) {
			if(isset($CONFIG[$p])) {
				$CONFIG = $CONFIG[$p];
			}else{
				return FALSE;
			}
		}
		return $CONFIG;

	}
	return FALSE;
}
/*
 *
 * add config
 *
 * @param $path (string)
 *
 * @param $value = (all data type)
 *
 * @return (string) return value
 *
 */
function cp_config_add($path,$value){
	$CONFIG = $GLOBALS['CP_CONFIG'][$path] = $value;
	return $CONFIG;
}
/*
 *
 * delete config
 *
 * @param $path (string)
 *
 */
function cp_config_del($path){
	if(isset($GLOBALS['CP_CONFIG'][$path])){
		unset($GLOBALS['CP_CONFIG'][$path]);
	}else{
		return FALSE;
	}
}
