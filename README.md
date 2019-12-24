# CanaryPHPTools Library tools
Tools to improve your project code
# Classes Feature
- Validate , Sanitize tools
- Conection to Database : requires one line
- Mailer : to send mail using smtp
- Manage the more Cookies and Sessions to the easy
- Translation function ready : json ,array,gettext
- Recaptcha checkbox one line only
- Wizard tools : full users manage ,Manage Request POST ,GET
- Built HTML element with php
- Log class
- Get visitor information from his ip {Contry,Reagion,City...}
## How to Install
- Availlable only with Composer :
Command :
```
composer require canaryphp/canaryphptools
```
composer.json
```json
{
    "require":{
        "canaryphp/canaryphptools"
    }
}
```
- After install read :
``CanaryPHPTools START.md``: [START.md](https://github.com/canaryphp/canaryphptools/blob/master/START.md)
## Examples
1. Database class :
- Select data from mysql database :
```php
<?php
require 'vendor/autoload.php';
    $db = new CanaryPHPTools\Database();
    $rowCount = $db->select('canary',['where'=>[':id'=>$id]]);
    //Result : Rowcount
    //The connection closed after getting rowcount
```
- fetch data from mysql Database :
```php
    <?php
    require 'vendor/autoload.php';
    $db = new CanaryPHPTools\Database();
    $data = $db->fetch('canary',['where'=>[':id'=>$id],'sql'=>'LIMIT 10']);
    foreach($data as $user){
        echo "Id :{$user['id']} ".
        echo "Fullname :{$user['fullname']}";
    }
    //Result : Rowcount
    //The connection closed after getting rowcount
```
2. Mailer class (using PHPmailer) :
```php
<?php
    require 'vendor/autoload.php';
    $mail = new CanaryPHPTools\Mailer();
    $to = 'canary@gmail.com';
    $name = 'canary';
    $subject = 'Happy birthday';
    $body = 'Hi, myname is canary';
    $mail->prepare($to,$name,$subject,$body);
    $mail->addAttachment('/happybirthday.jpg', 'hpd.jpg');
    $mail->execute();
    if($mail->_MAIL_SENT){
        echo 'Message has been sent';
    }else{
        echo $mail->_MAIL_ERROR;
    }
```
3. FILTER class and VALIDATE class:
```php
<?php
    require 'vendor/autoload.php';
    //validate :
    $false_e = 'canary@canary.com';
    $true_e = 'canary@gmail.com';
    //check email
    //Alowed email Domains configure in config file
    //1
    $va = new CanaryPHPTools\Validate();
    $va->email('user email',$false_e);
    var_dump($va->EMAIL_PASSED());// false
    var_dump($va->_EMAIL_ERRORS);// array(1) { [0]=> string(62) "Invalid user email domain , enter from available domains ." }
    $va = null;
	//2
	$va = new CanaryPHPTools\Validate();
	$va->email('email',$true_e);
    echo $va->EMAIL_PASSED();// true
    var_dump($va->_EMAIL_ERRORS);// array(0) {}
    //Filter(Sanitize)
    var_dump(CanaryPHPTools\Filter::email("mldfjkgj(_èç_è²)à²==)èàç:::!;!:,@gmail.com"));//string(20) "mldfjkgj__@gmail.com"
```
4. Cookies class and Session class:
```php
<?php
require 'vendor/autoload.php';
    //Cookies
$ck = new CanaryPHPTools\Cookies();
    //Set cookie
$ck->set('cookie','value');
    //get cookie
$ck->get('cookie');//(string) : value
//delete cookie
$ck->delete('cookie');
//Session
$se = new CanaryPHPTools\Session();
//Set Session
$se->set('cookie','value');
    //get Session
$se->get('cookie');//(string) : value
    //delete Session
$se->delete('cookie');
```
5. Translate class :
```php
<?php
    require 'vendor/autoload.php';
//create directory :__ARRAY__ in your_project/locale
//create default.php in : your_project/locale/__ARRAY__
//file content default.php :
/*
        <?php
            $TRAN = [
                "language"=>
                        [
                            "name"=>"english",
                            "code"=>"en"
                        ],
                'msg'=>[],
            ];
$TRAN['msg']['Hello'] = 'Hello world !';*/
$tr = new ArrayTranslate('your_project/locale');
var_dump($tr->_a('Hello'));// (string) : "Hello world !"
```
6. Recaptcha class:
```php
<?php
require 'vendor/autoload.php';
//recaptcha : configure secretkey and site key in config php and add this before </head> : <script src="https://www.google.com/recaptcha/api.js" async defer></script>
$re = new Recaptcha();
$re->checkbox();
//the location you want to show recaptcha box
echo $re->_RECAPTCHA_BOX;//show recaptcha box
//check if recaptcha passed
$re->_RECAPTCHA_PASSED;// (bool)
//recaptcha errors
var_dump($re->_RECAPTCHA_ERRORS);
```
7. Html :
```php
<?php
require 'vendor/autoload.php';
$p = CanaryPHPTools\Html::tag('p',['class'=>'text-success']).'Welcome'.CanaryPHPTools\Html::etag('p');//<p class='text-success'>Welcome</p>
//OR
$p .= CanaryPHPTools\Html::tag('p','class=text-success').'Welcome'.CanaryPHPTools\Html::etag('p');//<p class='text-success'>Welcome</p>
```
8. Log :
```php
<?php
require 'vendor/autoload.php';
$log = new CanaryPHPTools\Log('your_log/directory');
//add log
$log->add('Error connection','d','logfile.txt');// 'd' === danger also(w===warning,i===info)
//you can clear log in : your_log/directory
$log->clear();
```
9. GetVisitorInfo class :
```php
<?php
require 'vendor/autoload.php';
$info = new CanaryPHPTools\GetVisitorInfo('45.56.103.96');//'45.56.103.96' you can replace any valid ip
$info->getCountryName();//for example : Algeria
$info->getCountryCurrency();//For example : DZA
```
10. TokenGenerator class :
```php
<?php
require 'vendor/autoload.php';
$token = CanaryPHPTools\TokenGenerator::generate(25,\CanaryPHPTools\TokenGenerator::MIX);//return  : 'string(25) "iA15df3e3da86d36814470298"'
```
# NOTICE
- `vendor` folder and the `vendor/autoload.php` script are generated by composer ,there are not part from CanaryPHPTools
