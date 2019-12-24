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
class Database extends \PDO{
/**
 *
 * Database connection information
 *
**/
private $_DB_HOST = '';
private	$_DB_USER = '';
private $_DB_PASS = '';
private $_DB_NAME = '';
/**
 *
 * Exeternel object
 *
 * @param (obj)
 *
**/
private $canary,$tr;
/**
 *
 * Exception Queries Errors
 *
 */
public $_EXCEPTIONS = [];
/**
 *
 * DATABASE STATUS
 *
**/
public $_STATUS = FALSE;
/**
 *
 * QUERY STATEMENT
 *
**/
private $_QUERY = null;
/**
 *
 * Constructor
 *
 */
 public function __construct(){
 		$this->_DB_HOST = cp_config('database.host');
 		$this->_DB_USER = cp_config('database.user');
 		$this->_DB_PASS = cp_config('database.pwd');
 		$this->_DB_NAME = cp_config('database.name');
 	try {
 		$prepare = "mysql:host={$this->_DB_HOST};dbname={$this->_DB_NAME}";
 			parent::__construct($prepare,$this->_DB_USER,$this->_DB_PASS);
 				$this->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
 					$this->_STATUS = TRUE;
 	}catch(\PDOException $e) {
 			$this->_EXCEPTIONS[] = 'Connection failed :'.$e->getMessage()."<br>";
 	}
 }
/**
 *
 * Connection exceptions
 *
**/
private function addException($message = ''){
	$this->_EXCEPTIONS[] = $message;
}
/**
 *
 * Print catched exceptions
 *
**/
public function getExceptions(){
	$ex = '';
		foreach ($this->_EXCEPTIONS as $key => $value) {
			$number = ($key + 1);
			$ex .= "<b>Exception n{'$number'} :</b> {$value} .<br>";
		return $ex;
	}
}
/**
 *
 * select data from db
 *
 * @return return rowCount
 *
**/
public function select($table,$params = [],$data = []){
if($this->_STATUS){
	$where = '';
	$and = '';
	$sql = '';
	foreach ($params as $keys => $values) {
		if($keys === 'sql'){
			$sql = "\x20{$values}";
		}else{
			if($keys === 'where'){
				foreach ($values as $key => $value) {
					$where = sprintf("\x20WHERE %s=%s ",ltrim($key,':'),$key);
					$data[$key] = $value;
				}
			}elseif($keys === 'and'){
				foreach ($values as $key => $value) {
					$and = sprintf("\x20AND %s=%s",ltrim($key,':'),$key);
					$data[$key] = $value;
				}
			}
		}
	}
try{
	$full_sql = sprintf("SELECT * FROM %s %s %s %s",$table,$where,$and,$sql);
	$stmt = $this->prepare($full_sql);
	$stmt->execute($data);
		$result = $stmt->rowCount();
	$stmt = null;
			return $result;
}catch(\PDOException $e){
	$this->_EXCEPTIONS[] = $this->addException($e->getMessage());
}
}
}
/**
 *
 * insert data to database
 *
 * @return return rowCount
 *
**/
public function insert($table,$params = [],$data = []){
if($this->_STATUS){
	$values = '';
	$columns = '';
	$sql = '';
	foreach ($params as $key => $value) {
		if($key === 'sql'){
			$sql = "\x20{$value}";
		}else{
			$columns .= ltrim("{$key},",':');
			$values  .= "{$key},";
			$data[$key] = $value;
		}
	}
	try{
		$full_sql = "INSERT INTO {$table} (".rtrim($columns,',').") VALUES (".rtrim($values,',').") {$sql}";
		$stmt= $this->prepare($full_sql);
				$stmt->execute($data);
			$result= $stmt->rowCount();
					$stmt = null;
			return $result;
		}catch(\PDOException $e){
			$this->_EXCEPTIONS[] = $this->addException($e->getMessage());
		}
	}
}
/**
 *
 * update data from database
 *
 * @example update('example',['plus'=>[':views'=>'+1'],'where'=>[':id'=>10],'sql'=>'LIMIT 1'])
 *
 *@return return rowCount
 *
**/
public function update($table,$params = [],$data = []){
if($this->_STATUS){
$where = '';
$sql = '';
$and = '';
$cv = '';
	foreach ($params as $keys => $values) {
		if($keys === 'sql'){
			$sql = "\x20{$values}";
		}else{
			if($keys === 'where'){
				foreach($values as $key => $value) {
					$where = sprintf("\x20WHERE %s=%s ",ltrim($key,':'),$key);
					$data[$key] = $value;
				}
			}elseif($keys === 'and'){
				foreach($values as $key => $value) {
					$and = sprintf("\x20AND %s=%s",ltrim($key,':'),$key);
					$data[$key] = $value;
				}
			}elseif($keys === 'plus'){
				foreach ($values as $key => $value) {
					$cv .= sprintf("%s=%s + %s ,",ltrim($key,':'),ltrim($key,':'),$key);
					$data[$key] = $value;
				}
			}else{
					$cv .= sprintf("%s = %s ,",ltrim($keys,':'),$keys);
					$data[$keys] = $values;
			}

		}
	}
		try{
				$full_sql = "UPDATE {$table} SET  ".rtrim($cv,',')." {$where} {$and} {$sql}";
				$stmt = $this->prepare($full_sql);
				$stmt->execute($data);
					$result = $stmt->rowCount();
						$stmt = null;
							return $result;
		}catch(\PDOException $e){
			$this->_EXCEPTIONS[] = $this->addException($e->getMessage());
		}
}
}
/**
 *
 * delete data from db
 *
 * @example delete('exaple',[':id'=>10,'and'=>[':email'=>'hello@example.com'],'sql'=>'LIMIT 1']);
 *
 * @return return rowCount
 *
**/
public function delete($table,$params = [],$data = []){
if($this->_STATUS){
$where = '';
$and = '';
$sql = '';
	foreach ($params as $keys => $values) {
		if($keys === 'sql'){
			$sql = "\x20{$values}";
		}else{
			if($keys === 'where'){
				foreach ($values as $key => $value) {
					$where = sprintf("\x20WHERE %s=%s ",ltrim($key,':'),$key);
					$data[$key] = $value;
				}
			}elseif($keys === 'and'){
				foreach ($values as $key => $value) {
					$and = sprintf("\x20AND %s=%s",ltrim($key,':'),$key);
					$data[$key] = $value;
				}
			}
		}
	}
		try{
		$full_sql = "DELETE FROM {$table} {$where} {$and} {$sql}";
			$stmt = $this->prepare($full_sql);
			$stmt->execute($data);
				$result = $stmt->rowCount();
					$stmt = null;
						return $result;
		}catch(\PDOException $e){
			$this->_EXCEPTIONS[] = $this->addException($e->getMessage());
		}
}
}
/**
 *
 * fetch data from db
 *
 * @return return data (array)
 *
 * @example fetch($table,$params = [],$columns = '*')
 *
**/
public function fetch($table,$params = [],$data = [],$fetchType = false){
if($this->_STATUS){
	$where = '';
	$and = '';
	$sql = '';
		foreach ($params as $keys => $values) {
			if($keys === 'sql'){
				$sql = "\x20{$values}";
			}else{
				if($keys === 'where'){
					foreach ($values as $key => $value) {
						$where = sprintf("\x20WHERE %s=%s ",ltrim($key,':'),$key);
						$data[$key] = $value;
					}
				}elseif($keys === 'and'){
					foreach ($values as $key => $value) {
						$and = sprintf("\x20AND %s=%s",ltrim($key,':'),$key);
						$data[$key] = $value;
					}
				}
			}
		}
try {
$full_sql = "SELECT * FROM {$table} {$where} {$and} {$sql}";
		$stmt = $this->prepare($full_sql);
			$stmt->execute($data);
				$result = ($fetchType) ? $stmt->fetch(Database::FETCH_ASSOC) : $stmt->fetchAll();
					$stmt = null;
				return $result;
		}catch(\PDOException $e){
			$this->_EXCEPTIONS[] = $this->addException($e->getMessage());
		}
}
}
/**
 *
 * execute query
 *
 * @return return (PDO statement)
 *
 * @example query($qwery,$params = [])
 *
**/
public function query($query,$params = []){
if($this->_STATUS){
		try{
			$this->_QUERY = NULL;
			$this->_QUERY = $this->prepare($query);
			$this->_QUERY->execute($params);
			return $this->_QUERY;
		}catch(\PDOException $e){
			$this->_EXCEPTIONS[] = $this->addException($e->getMessage());
		}
}
}
public function __destruct(){
	$this->_QUERY = NULL;
}
}
