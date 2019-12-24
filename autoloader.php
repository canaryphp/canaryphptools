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
$GLOBALS['CP_CONFIG'] = [];
require_once __DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'requires.php';
$_AUTOLOADER = [
					'class'=>[
						'Cookie',
						'Mailer',
						'Session',
						'Database',
						'Exception',
						'Users',
						'Request',
						'ArrayTranslate',
						'JsonTranslate',
						'GettextTranslate',
						'Html',
						'Recaptcha',
						'Filter',
						'Validate',
						'Canary',
						'Redirect',
						'TokenGenerator',
					],
];
foreach($_AUTOLOADER as $keys=>$values){
	if ($keys === 'class') {
		foreach($values as $value){
			require CPT_ROOT.DS.$value.'.php';
		}
	}else {
		foreach($values as $value){
			require CPT_ROOT.DS.$keys.DS.$value.'.php';
		}
	}
}
unset($GLOBALS['CP_CONFIG']);
