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
require __DIR__.DIRECTORY_SEPARATOR.'constants'.DIRECTORY_SEPARATOR.'constants.php';
if (!isset($GLOBALS['CP_CONFIG'])) {
	exit('(CanaryPHPTools "'.CPT_VERSION.'") : Undefined GLOBALS Configuration araay');
}
if(version_compare(PHP_VERSION,'5.5.9') < 0) {
	exit('(CanaryPHPTools "'.CPT_VERSION.'") : Your PHP version must be equal or higher than 5.6.0 to use our script ,Update your php version or contact your hosting provider .');
}
//fix paths error in windows
function win_path($path,$status = FALSE){
	if($status){
		return str_replace(DS,'/',$path);
	}
    $serv = strtoupper(substr(PHP_OS,0,3));
    if($serv === 'WIN'){
        $path = str_replace('/',DS,$path);
    }
    return $path;
   }
$_AUTOLOADER = [
			'functions'=>[
						'config',
						'translate',
						'client_ip',
						'valid_lang',
					],
];
foreach($_AUTOLOADER as $keys=>$values){
	foreach($values as $value){
		require CPT_ROOT.DS.$keys.DS.$value.'.php';
	}
}
