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
class Cookie{
/**
 *
 * check(string $name) : Check if COOKIE exist => result TRUE or FALSE;
 *
 **/
public function check($name){
	return isset($_COOKIE[$name]) ? TRUE : FALSE;
}
/**
 *
 * set(string $name,string $value) : $name Cookie name , $value Cookie value => result : New Cookie;
 *
 **/
public function set($name,$value,$time = NULL,$path = NULL,$domain = NULL,$secure = NULL,$httponly = NULL){
	if(!$time){$time = cp_config('cookies.lifetime'); }
 	if(!$path){$path = cp_config('cookies.path'); }
	if(!$domain){$domain = cp_config('cookies.domain'); }
	if(!$secure){$secure = cp_config('cookies.secure'); }
	if(!$httponly){$httponly= cp_config('cookies.httponly'); }
	setcookie($name,$value,$time,$path,$domain,$secure,$httponly);
}
/**
 *
 * get(string $name) : get Cookie value ;
 *
 **/
public function get($name){
	if($this->check($name)){
		return $_COOKIE[$name];
	}
}
/**
 *
 *delete(string $name) : delete cookie => delete Cookie;
 *
 *
 **/
public function delete($name,$path = null){
	if(self::check($name)){
 		if(!$path){$path = cp_config('cookies.path'); }
  		setcookie($name,'',time()- (3600*24*30*360),$path);
	}
}
}
