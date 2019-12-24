# Before the beginning of a project included this part follow the following steps
1. Create config file **config.php** AND include before composers includes:

```php
<?php
$GLOBALS['CP_CONFIG'] = [
/**
 *
 * host : (string) Database host
 * user : (string) Database username
 * pwd : (string) Database password
 * name : (string) Database name
 *
 **/
'database'=>[
	'host'=>'localhost',
	'user'=>'root',
	'pwd'=>'',
	'name'=>'test',
	],
/**
 *
 * host : (string) SMTP host
 * name : (string) SMTP name (site name)
 * username : (string) SMTP username
 * pwd : (string) SMTP password
 * secure : (string) SMTP secure
 * port : (int) SMTP port
 * cc : (if true (string)) SMTP cc
 * bcc : (if true (string)) SMTP bcc
 * reply_to : (array) SMTP reply to
 *
 */
'smtp'=>[
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
],
/**
 *
 * Recaptcha check box
 *
 * get screet key and site key from googlerecaptcha
 *
 * If you do not want recaptcha , 'enabled'=>FALSE,
 *
 **/
'recaptcha'=>[
	'enabled'=>FALSE,
		'sitekey'=>'your_recaptcha_site_key',
		'secretkey'=>'your_recaptcha_secret_key',
],
/*
 time : (int) Time of the cookie in seconds
 path : (string) Path on the domain where the cookie will work
 domain : (string) the Cookie domain;
 secure: (bool) If TRUE cookie will only be sent over secure connections
 httponly: (bool) If TRUE then PHP will attempt to send the httponly flag
 */
'cookies'=>[
	'lifetime'=>time() + 3600*24, //1day = 3600*24 , 2day= 3600*24*2 , 7day = 3600*24*7
	'path'=> '/',
	'domain'=> NULL,
	'secure'=> FALSE,
	'httponly'=>TRUE,
],
/**
* lifetime : (int) time of the session cookie in seconds;
* path: (string) Path on the domain where the cookie will work;
* domain: (string) the session Cookie domain ;
* secure: (bool) If TRUE session cookie will only be sent over secure connections;
* httponly: (bool) If TRUE then PHP will attempt to send the httponly flag ;
**/
'sessions'=>[
	 'lifetime'=>time() + 3600*24, //1day = 3600*24 , 2day= 3600*24*2 , 7day = 3600*24*7
	 'path'=> '/',
	 'domain'=> NULL,
	 'secure'=> FALSE,
	 'httponly'=>TRUE,
],
/**
 *
 * Languages : Available languages
 *
 */
'languages'=>['en'],
 /**
 *
 * email : select the allowed domains for email
 *
 */
'email' => ['gmail.com','mail.ru','yahoo.com','yahoo.fr'],
/**
 *
 * Project urls
 *
 * locale : locale url (trnslate)
 *
 */
'email' => ['locale'=>null,'log'=>null],
];
```
