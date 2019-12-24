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
class Filter{
/**
 *
 * remove any html tag in $string
 *
 * @param (string) $string
 *
 * @return (string) return value
 *
**/
public static function htmltag($value){
	return (string) strip_tags($value);
}
/**
 *
 * change any html special chars to code
 *
 * @param (string) $string
 *
 * @return (string) return value
 *
**/
public static function specialChars($value){
	return (string) htmlspecialchars($value,ENT_QUOTES);
}
/**
 *
 * accepte only letters , numbers and -_@. only
 *
 * @param (string) $string
 *
 * @return (string) return value
 *
**/
public static function email($value){
	return (string) preg_replace("/[^A-Za-z0-9-@_.]/",'',$value);
}
/**
 *
 * accepte numbers only
 *
 * @param (string) $string
 *
 * @return (string) return value
 *
**/
public static function int($value){
    return (int) preg_replace("/[^0-9]/",'',$value);
}
/**
 *
 * accepte leters only
 *
 * @param (string) $string
 *
 * @return (string) return value
 *
**/
public static function latinLetter($value){
    return (string) preg_replace("/[^A-Za-z]/",'',$value);
}
}
