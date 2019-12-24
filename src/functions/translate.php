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
/**
 * translate normal text
 *
 * @param = (string)
 *
**/
function __(){
try{
	$args = func_get_args();
    return call_user_func_array('\CanaryPHPTools\GettextTranslate::__', $args);
}catch(Exception $e){
	echo '<strong>Exeption :</strong>'.$e->msg().'<br >';
}
}
/**
 * translate normal text with json
 *
 * @param (string)
 *
**/
function _j(){
try{
	$args = func_get_args();
    return call_user_func_array('\CanaryPHPTools\JsonTranslate::_j', $args);
}catch(Exception $e){
	echo '<strong>Exeption :</strong>'.$e->msg().'<br >';
}
}
/**
 * translate normal text with json
 *
 * @param (string)
 *
**/
function _a(){
try{
	$args = func_get_args();
    return call_user_func_array('\CanaryPHPTools\ArrayTranslate::_a', $args);
}catch(Exception $e){
	echo '<b>Exeption :</b>'.$e->msg().'<br >';
}
}
