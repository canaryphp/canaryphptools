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
$TRAN = [
    "language"=>
        [
            "name"=>"english",
            "code"=>"en"
        ],
    'msg'=>[],
];
//Validate class
$TRAN['msg']['VALIDATE_REQUIRED'] = '%s : is required .';
$TRAN['msg']['VALIDATE_MIN'] = '%s : minimum alowed is %s characters .';
$TRAN['msg']['VALIDATE_MAX'] = '%s : maximum alowed is %s characters';
$TRAN['msg']['VALIDATE_EMAIL'] = 'please enter valid %s .';
$TRAN['msg']['VALIDATE_EMAIL_DOMAIN'] = 'Invalid %s domain , enter from available domains .';
$TRAN['msg']['VALIDATE_NUM'] = '%s is not number .';
$TRAN['msg']['VALIDATE_LETTER'] = '%s is not letters [a-zA-Z] .';
//Mailer class
$TRAN['msg']['MAILER_ERR'] = 'Message could not be sent.';
//Rcaptcha class
$TRAN['msg']['RECAPTCHA_REQUIRED'] = 'Recaptcha required .';
