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
class Validate{
public function __construct(){
	$this->canary = new \CanaryPHPTools\Canary;
	$tr = new \CanaryPHPTools\ArrayTranslate(dirname(__DIR__).DS.'locale');
}
/**
 *
 * Exeternel object
 *
 * @param (obj)
 *
**/
private $canary;
/**
 *
 * validate check errors
 *
 * @param (array)
 *
**/
public $_CHECK_ERRORS = [];
/**
 *
 * store boolen for multi check validate
 *
 * @param (array)
 *
**/
private $_CHECK_STORE = [];
/**
 *
 * validate email error
 *
 * @param (array)
 *
**/
public $_EMAIL_ERRORS = [];
/**
 *
 * store boolen for multi email validate
 *
 * @param (array)
 *
**/
private $_EMAIL_STORE = [];
/**
 *
 * validate int error
 *
 * @param (array)
 *
**/
public $_INT_ERRORS = [];
/**
 *
 * store boolen for multi int validate
 *
 * @param (array)
 *
**/
public $_INT_STORE = [];
/**
 *
 * validate letter error
 *
 * @param (array)
 *
**/
public $_LETTER_ERRORS = [];
/**
 *
 * store boolen for muti validate
 *
 * @param (array)
 *
**/
public $_LETTER_STORE = [];
/**
 *
 * All validate errors
 *
 */
public $_VALIDATE_ERRORS = [];
/**
 *
 * Store boolen for All validate
 *
 */
public $_VALIDATE_STORE = [];
/**
 *
 * Add error
 *
 */
public function addErr($value,$num){
switch ($num) {
	case 1:
		$this->_CHECK_ERRORS[] = $value;
		$this->_CHECK_STORE[] = FALSE;
		$this->_VALIDATE_ERRORS[] = $value;
		$this->_VALIDATE_STORE[] = FALSE;
	break;
	case 2:
		$this->_EMAIL_ERRORS[] = $value;
		$this->_EMAIL_STORE[] = FALSE;
		$this->_VALIDATE_ERRORS[] = $value;
		$this->_VALIDATE_STORE[] = FALSE;
	break;
	case 3:
		$this->_INT_ERRORS[] = $value;
		$this->_INT_STORE[] = FALSE;
		$this->_VALIDATE_ERRORS[] = $value;
		$this->_VALIDATE_STORE[] = FALSE;
	break;
	case 4:
		$this->_LETTER_ERRORS[] = $value;
		$this->_LETTER_STORE[] = FALSE;
		$this->_VALIDATE_ERRORS[] = $value;
		$this->_VALIDATE_STORE[] = FALSE;
	break;
}
}
/**
 *
 * check any string
 *
 * @param (string) $string validate check value , (string) $name Name of check Value , (string) $param parameter
 *
**/
public function check($name,$string,$param = []){
	foreach($param as $key=>$value){
		if($key === 'required' && empty($string)){
			$this->addErr(_a('VALIDATE_REQUIRED',$name),1);
			break;
		}elseif($key === 'min'){
			if(strlen($string) < $value){
				$this->addErr(_a("VALIDATE_MIN",$name,$value),$name,1);
			}
		}elseif($key === 'max'){
			if(strlen($string) > $value){
				$this->addErr(_a("VALIDATE_MAX",$name,$value),$name,1);
			}
		}
	}
	return $this;
}
/**
 *
 * check if passed
 *
**/
public function CHECK_PASSED(){
	if (count($this->_CHECK_STORE) >1) {
		$store = array_reduce($this->_CHECK_STORE,function ($x,$y){return $x && $y;},true);
	} else {
		$store = (isset($this->_CHECK_STORE[0])) ? $this->_CHECK_STORE[0] : TRUE;
	}
	return $store;
}
/**
 *
 * validate any email
 *
 * @param (string) $email email
 *
**/
public function email($name,$email){
	if(filter_var($email,FILTER_VALIDATE_EMAIL)){
		$domain = explode('@',$email);
		$domain = end($domain);
		if(!in_array($domain,cp_config('email'))){
			$this->addErr(_a("VALIDATE_EMAIL_DOMAIN",$name),2);
		}else {
			$this->_EMAIL_STORE[] = TRUE;
		}
	}else{
		$this->addErr(_a("VALIDATE_EMAIL",$name),2);
	}
	return $this;
}
/**
 *
 * check if if passed
 *
**/
public function EMAIL_PASSED(){
	if (count($this->_EMAIL_STORE) >1) {
		$store = array_reduce($this->_EMAIL_STORE,function ($x,$y){return $x && $y;},true);
	} else {
		$store = (isset($this->_EMAIL_STORE[0])) ? $this->_EMAIL_STORE[0] : TRUE;
	}
	return $store;
}
/**
 *
 * validate any string
 *
 * @param (int) $int
 *
**/
public function int($name,$int){
	if(!filter_var($int,FILTER_VALIDATE_INT)){
		$this->addErr(_a("VALIDATE_NUM",$name),3);
	}else{
		$this->_INT_STORE[] = TRUE;
	}
	return $this;
}
/**
 *
 * check if passed
 *
**/
public function INT_PASSED(){
	if (count($this->_INT_STORE) >1) {
		$store = array_reduce($this->_INT_STORE,function ($x,$y){return $x && $y;},TRUE);
	} else {
		$store = (isset($this->_INT_STORE[0])) ? $this->_INT_STORE[0] : TRUE;
	}
	return $store;
}
/**
 *
 * validate any string
 *
 * @param (string) $str
 *
**/
public function latinLetter($name,$str){
	if(preg_match("/[^A-Za-z]/",$str)){
		$this->_LETTER_ERRORS[] = _a("VALIDATE_LETTER",$name);
		$this->addErr(_a("VALIDATE_LETTER",$name),4);
	}else{
		$this->_LETTER_STORE[] = TRUE;
	}
	return $this;
}
/**
 *
 * check if passed
 *
**/
public function LETTER_PASSED(){
	if (count($this->_LETTER_STORE) >1) {
		$store = array_reduce($this->_LETTER_STORE,function ($x,$y){return $x && $y;},TRUE);
	} else {
		$store = (isset($this->_LETTER_STORE[0])) ? $this->_LETTER_STORE[0] : TRUE;
	}
	return $store;
}
/**
 *  Check if validate passed
 *
 */
public function VALIDATE_PASSED(){
	if (count($this->_VALIDATE_STORE) >1) {
		$store = array_reduce($this->_VALIDATE_STORE,function ($x,$y){return $x && $y;},TRUE);
	} else {
		$store = (isset($this->_VALIDATE_STORE[0])) ? $this->_VALIDATE_STORE[0] : TRUE;
	}
	return $store;
}
}
