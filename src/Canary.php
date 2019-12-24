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
require_once __DIR__.DIRECTORY_SEPARATOR.'requires.php';
class Canary{
/**
 *
 * Declare classes
 *
**/
public function arraytranslate($locale_dir = null,$language = null){
	return new \CanaryPHPTools\ArrayTranslate($locale_dir,$language);
}
public function jsontranslate($locale_dir = null,$language = null){
	return new \CanaryPHPTools\JsonTranslate($locale_dir,$language);
}
public function gettexttranslate($locale_dir = null,$language = null){
	return new \CanaryPHPTools\GettextTranslate($locale_dir,$language);
}
public function session(){
	return new \CanaryPHPTools\Session();
}
public function cookie(){
	return new \CanaryPHPTools\Cookie();
}
public function database(){
	return new \CanaryPHPTools\Database();
}
public function filter(){
	return new \CanaryPHPTools\Filter();
}
public function getvisitorinfo($_IP_ADDRESS = ''){
	return new \CanaryPHPTools\GetVisitorInfo($_IP_ADDRESS);
}
public function html(){
	return new \CanaryPHPTools\Html();
}
public function log($logDir = null){
	return new \CanaryPHPTools\Log($logDir);
}
public function mailer($ex = false){
	return new \CanaryPHPTools\Mailer($ex);
}
public function recaptcha(){
	return new \CanaryPHPTools\Recaptcha();
}
public function request(){
	return new \CanaryPHPTools\Request();
}
public function users($table = null){
	return new \CanaryPHPTools\Users($table);
}
public function validate(){
	return new \CanaryPHPTools\Validate();
}
public function tokengenerator(){
	return new \CanaryPHPTools\TokenGenerator();
}
/**
 *
 * prepare language
 *
 * @return current language
 *
 */
public function setLanguage($lang = null){
    $cookie = new Cookie();
	$filter = new Filter();
        if(isset($_GET['lang']) && valid_lang($_GET['lang'])){
			$lang = $filter->htmltag($_GET['lang']);
			$cookie->set('lang',$lang);
        }elseif($cookie->check('lang') && valid_lang($cookie->get('lang'))){
            $lang = $cookie->get('lang');
		}elseif($lang !== null && valid_lang($lang)){
			$lang = $lang;
		}else{
			$lang = cp_config('languages')[0];
			$cookie->set('lang',$lang);
		}
	return $lang;
}
/**
 *
 * get language
 *
 * @return current language
 *
 */
public function language(){
    $cookie = new Cookie();
	$filter = new Filter();
        if(isset($_GET['lang']) && valid_lang($_GET['lang'])){
            $lang = $filter->htmltag($_GET['lang']);
        }elseif($cookie->check('lang') && valid_lang($cookie->get('lang'))){
            $lang = $cookie->get('lang');
        }else{
            $lang = cp_config('languages')[0];
		}
	return $lang;
}
}
