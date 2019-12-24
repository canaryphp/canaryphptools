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
class Recaptcha{
public function __construct(){
	$this->_RECAPTCHA_ENABLED = cp_config('recaptcha.enabled');
	$this->_RECAPTCHA_SITEKEY = cp_config('recaptcha.sitekey');
	$this->_RECAPTCHA_SECRETKEY = cp_config('recaptcha.secretkey');
	$this->ck = new Cookie;
	$this->request = new Request();
	$tr = new \CanaryPHPTools\ArrayTranslate(dirname(__DIR__).DS.'locale');
}
/**
 *
 * Externel Object
 *
 * (object)
 *
 */
private $ck,$request;
/**
 *
 * recapcha site key
 *
 * @param (string)
 *
**/
	public $_RECAPTCHA_SITEKEY ='';
/**
 *
 * recapcha screet key
 *
 * @param (string)
 *
**/
	public $_RECAPTCHA_SECRETKEY ='';
/**
 *
 * recapcha errors
 *
 * @param (array)
 *
**/
	public $_RECAPTCHA_ERRORS =[];
/**
 *
 * recapcha is passed or no
 *
 * @param (bool)
 *
**/
	public $_RECAPTCHA_PASSED = FALSE;
/**
 *
 * recapcha box (when to show Recaptcha box
 *
 * @param (string)
 *
**/
	public $_RECAPTCHA_BOX = '';

/**
 *
 * Recaptcha check box
 *
**/
public function checkbox(){
	if($this->_RECAPTCHA_ENABLED){
        $lang = $this->ck->get('lang');
		$this->_RECAPTCHA_BOX = '<div class="g-recaptcha form-field" data-sitekey="'.$this->_RECAPTCHA_SITEKEY.'"></div>'.EOL;
		if($this->request->is()->post){
			$response= (isset($_POST['g-recaptcha-response'])) ? $_POST['g-recaptcha-response']: '';
			$data = [
			    'secret' =>$this->_RECAPTCHA_SECRETKEY,
			    'response' => $response,
			    'remoteip'=>client_ip(),
            ];

			$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($verify);
				curl_close($verify);
			$response = json_decode($response);
			if($response->success){
				$this->_RECAPTCHA_PASSED = TRUE;
			}else{
				$this->_RECAPTCHA_ERRORS[] = _a('RECAPTCHA_REQUIRED');
			}
		}
	}else{
		$this->_RECAPTCHA_PASSED = TRUE;
	}
}
}
