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
use \PHPMailer\PHPMailer\Exception;
use \PHPMailer\PHPMailer\PHPMailer;
class Mailer extends PHPMailer{
	public function __construct($exeption = FALSE){
		$this->canary = new Canary;
		$this->tr = new \CanaryPHPTools\ArrayTranslate(dirname(__DIR__).DS.'locale');
		parent::__construct($exeption);
		if (cp_config("smtp.default") == null){
			exit("<b>Mailer ERROR :</b> Default smtp User not found, add this in config file and add your account data: <br><pre>'smtp'=>[
				'default'=>[
					'host'=>'MY_SMTP_HOST',
					'name'=>'SMTP_name',
					'username'=>'MY_APP_USERNAME@host.com',
					'pwd'=>'MY_PASSWORD',
					'secure'=>'TLS',
					'port'=>587,
					'cc'=> FALSE,
					'bcc'=> FALSE,
					'replyto'=>[
						'email'=>FALSE,
						'name'=>'my_reply_to_name'
							],
					],
				],</pre>");
		}
		$this->_MAIL_USER = cp_config("smtp.default");
}
/**
 *
 * External Object
 *
 * @param (obj)
 *
 */
private $tr;
/**
 *
 * mail sent or not
 *
 * @param (book)
 *
**/
public $_MAIL_SENT = FALSE;
/**
 *
 *
 * mail ERRORS
 *
 * @param (array)
 *
**/
public $_MAIL_EXCEPTION = '';
public $_MAIL_ERROR = '';
/**
 *
 *
 * Smtp connected status
 *
 * @param (string)
 *
**/
public $_MAIL_STATUS = FALSE;
/**
 *
 *
 * mail local user
 *
 * @param (array)
 *
**/
private $_MAIL_USER = [];
/**
 *
 *
 * mail ERRORS
 *
 * @param (array)
 *
**/
private $_MAIL_TEMPLATE = '';
/**
 *
 * Mailer template
 *
**/
public function setTemplate($path){
	if(file_exists($path)){
		$this->_MAIL_TEMPLATE = file_get_contents($path);
	}
	return '';
}
/**
 *
 * Mailer set new user
 *
**/
public function setAccount($key){
	if(cp_config("smtp.{$key}") !== null){
		$this->_MAIL_USER = cp_config("smtp.{$key}");
	}
	return '';
}
/**
 *
 * smtp Connection test
 *
**/
public function test_connection(){
	try{
		$this->SMTPDebug = 0;
		$this->isSMTP();
		$this->Host = $this->_MAIL_USER['host'];
		$this->SMTPAuth = true;
		$this->Username = $this->_MAIL_USER['username'];
		$this->Password = $this->_MAIL_USER['pwd'];
		$this->SMTPSecure = $this->_MAIL_USER['secure'];
		$this->Port = $this->_MAIL_USER['port'];
		if($this->smtpConnect()){
			$this->_MAIL_STATUS = TRUE;
		}
}catch(Exception $e) {
		$this->_MAIL_EXCEPTION = $e->getMessage();
		$this->_MAIL_STATUS = FALSE;
}
}
/**
 *
 *
 * send message
 *
 * @param $to where to send mail ,$name
 *
**/
public function prepare($to,$name,$sub,$body){
	$body = str_replace(['{CONTENT}','{SUBJECT}'],[$body,$sub],$this->_MAIL_TEMPLATE);
	try{
			//Server settings
			$this->SMTPDebug = 0;
			$this->isSMTP();
			$this->Host = $this->_MAIL_USER['host'];
			$this->SMTPAuth = true;
			$this->Username = $this->_MAIL_USER['username'];
			$this->Password = $this->_MAIL_USER['pwd'];
			$this->SMTPSecure = $this->_MAIL_USER['secure'];
			$this->Port = $this->_MAIL_USER['port'];
			/* Recipients */
			$this->setFrom($this->_MAIL_USER['username'],$this->_MAIL_USER['name']);
 			//replyto
			if($this->_MAIL_USER['replyto']['email']){$this->addReplyTo($this->_MAIL_USER['replyto']['username'],$this->_MAIL_USER['replyto']['name']);}else{$this->addReplyTo($this->_MAIL_USER['username'],$this->_MAIL_USER['name']);}
			//Recepient
			$this->addAddress($to,$name);
			//CC
			if(cp_config('smtp.cc')){$this->addCC(cp_config('smtp.cc'));}
			//BCC
			if(cp_config('smtp.bcc')){$this->addCC(cp_config('smtp.bcc'));}
			/* Content */
			$this->isHTML(true);
			$this->Subject = " [".cp_config('smtp.name')." ] ".$sub;
			$this->Body = $body;
	}catch(Exception $e) {
		$this->_MAIL_EXCEPTION = $e->getMessage();
		$this->_MAIL_ERROR = $this->tr->_a("MAILER_ERR");
	}
}
/**
 *
 * execute prepared mail
 *
 */
public function execute(){
	if ($this->send()) {
		$this->_MAIL_STATUS = TRUE;
		$this->_MAIL_SENT = TRUE;
	}else {
		$this->_MAIL_STATUS = FALSE;
		$this->_MAIL_SENT = FALSE;
	}
}
public function __destruct(){

}
}
