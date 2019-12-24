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
            "name"=>"arabic (Algeria)",
            "code"=>"ar_DZ"
        ],
    'msg'=>[],
];
//Validate class
$TRAN['msg']['VALIDATE_REQUIRED'] = '%s : مطلوب .';
$TRAN['msg']['VALIDATE_MIN'] = '%s : الحد الادنى المسموح به %s حروف) حرف) .';
$TRAN['msg']['VALIDATE_MAX'] = '%s : الحد الأقصي المسموح به  %s حروف) حرف)';
$TRAN['msg']['VALIDATE_EMAIL'] = 'من فضللك أدخل %s صالح.';
$TRAN['msg']['VALIDATE_EMAIL_DOMAIN'] = 'نطاق %s غير صالح ,ادخل من النطاقات المسموح بها .';
$TRAN['msg']['VALIDATE_NUM'] = '%s ليس عددا .';
$TRAN['msg']['VALIDATE_LETTER'] = '%s ليس من الحروف اللاتينية [a-zA-Z] .';
//Mailer class
$TRAN['msg']['MAILER_ERR'] = 'لم يتم ارسال الرسالة.';
//Rcaptcha class
$TRAN['msg']['RECAPTCHA_REQUIRED'] = 'حقل ريكابتشا مطلوب .';
