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
class Html{
/**
 *
 * Self closing Html tag
 *
 */
private static $closing_list = ['input','img','hr','br','meta','link'];
/**
 *
 * Html Attributes
 *
 */
private static function addAttr($data = []){
	$attr = '';
	if(is_array($data)){
		foreach($data as $key=>$value){
			if(!is_numeric($key)){
				$attr .= "\x20{$key}=\"{$value}\"";
			}else{
				$attr .= "\x20{$value}\x20";
			}
		}
	}else{
		$data = explode('&',$data);
		foreach($data as $values){
			$values = str_replace(['\n','\x20',PHP_EOL],['','',''],$values);
			$attr .= " ".str_replace('=','="',$values).'"';
		}
	}
	return $attr;
}
/**
 *
 * Html tag
 *
 * @param $tag (string) : Html tag name , $data (string|array) : Html Attributes
 *
*/
public static function tag($tag,$data = []){
	if(in_array($tag,self::$closing_list)){
		return "<$tag".Html::addAttr($data)."/>".PHP_EOL;
	}else{
		return "<$tag".Html::addAttr($data).">".PHP_EOL;
	}
}
/**
 *
 * Html end tag
 *
 * @param $tag (string) : Html endtag name
 *
*/
public static function etag($tag = ''){
	return "</{$tag}>".PHP_EOL;
}
}
