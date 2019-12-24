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
class Session{
/**
 *
 * Start Session IMPORTANT
 *
 */
public static function start(){
	if (session_status() === PHP_SESSION_NONE) {
		session_set_cookie_params(cp_config('sessions.lifetime'),cp_config('sessions.path'),cp_config('sessions.domain'),cp_config('sessions.secure'),cp_config('sessions.httponly'));
		session_start();
		session_regenerate_id();
	}
}
/**
 *
 * Check(string $name) : Check if session exist => result TRUE or FALSE;
 *
 **/
public static function check($name){
	return (isset($_SESSION[$name])) ? TRUE : FALSE;
}
/**
 *
 * Set(string $name,string $value) : $name Session name , $value Session value => result : New Session ;
 *
 **/
public static function set($name,$value){
	return $_SESSION[$name]= $value;
}
/**
 *
 * Get(string $name) : get Session name value => Session value;
 *
 **/
public static function get($name){
	 	return $_SESSION[$name];
}
/**
 *
 *Delete(string $name) : delete session => delete Session ;
 *
 **/
public static function delete($name){
	if(self::check($name)){
	  unset($_SESSION[$name]);
	}
}
/**
 *
 * _unset() : delete All Session ;
 *
 **/
public static function _unset(){
	return session_unset();
}
/**
 *
 *_destroy() : destroy Session
 *
 *
 **/
public static function _destroy(){
	return session_destroy();
}
}
