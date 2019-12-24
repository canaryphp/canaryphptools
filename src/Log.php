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
class Log{
public function __construct($logDir = null){
    if($logDir == null AND is_bool(cp_config('url.log'))){
        throw new Exception("Construct parameter #1 required");
	}
	$this->logDir = ($logDir !== null) ? $logDir : cp_config('url.log');
}
/**
 *
 * Log directory
 *
 */
private $logDir;
/**
 *
 * create file log in $this->logDir
 *
 * @param $value (string): Log message , $type (string) : Log type , $logFileName (string) : log file name
 *
 */
public function add($value,$type = 'd',$logFileName = 'logs.txt'){
    //Types of log
	$Types = ['w'=>'Warning','d'=>'Danger','i'=>'Info'];
	$type = (empty($Types[$type])) ? $type : $Types[$type];
	$date = date('d-M-Y');
	$time = date('H:i:s');
	$ip = client_ip();
	$path = $_SERVER['PHP_SELF'];
	if(!file_exists($this->logDir.DS.$date)) {
		mkdir($this->logDir.DS.$date, 0777, true);
	}
	$fopen = fopen($this->logDir.DS.$date.DS.$logFileName,"a+");
	$content = "[User:\x20{$ip}\x20]\x20---\x20[Date:\x20{$date}\x20Time:\x20{$time}\x20]\x20---\x20[Type:\x20{$type}]\x20---\x20[path:\x20$path]\x20---\x20[Content:\x20$value\x20]".PHP_EOL;
	fwrite($fopen,$content);
	fclose($fopen);
}
/**
 *
 * clear current log file
 *
 */
public function clear(){
	if(is_dir($this->logDir)){
		//get folder list
		$folders_list = glob($this->logDir.DS.'*');
		for ($i=0; $i < count($folders_list); $i++) {
			// if dir
			if (is_dir($folders_list[$i])){
				//$folders_list[$i] get folder list
				$sub_folders_list = glob($folders_list[$i].DS.'*');
				//if not empty $folders_list[$i]
				if (!empty($sub_folders_list)){
					for($x=0; $x < count($sub_folders_list); $x++){
						//if is file delete
						if (is_file($sub_folders_list[$x])) {
							unlink($sub_folders_list[$x]);
						}
					}
					//if empty $folders_list[$i] delete dir
					if (empty($sub_folders_list)) {
						rmdir($folders_list[$i]);
					}
				}else {
					if (is_dir($folders_list[$i])) {
						rmdir($folders_list[$i]);
					}
				}
			}else {
				//if $folders_list[$i] is file delete
				if (is_file($folders_list[$i])) {
					unlink($folders_list[$i]);
				}
			}
		}
		return TRUE;
	}
	return FALSE;
}
}
