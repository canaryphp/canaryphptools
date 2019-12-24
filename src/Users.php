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
class Users{
/**
 *
 * constructor
 *
 */
public function __construct($TableName = null){
    $this->db = new Database;
    $this->TableName = (*$TableName !== null) ? $TableName : 'cp_users' ;
}
/**
 *
 * External Objects
 *
 * @param (object)
 *
**/
private $db;
/**
 *
 * Users TableName
 *
 * @param (string)
 *
**/
protected $TableName;
/**
 *
 * create user table in MYSQL
 *
 */
public function createTable(){
    $sql = str_replace('{TableName}',$this->TableName,@file_get_contents(__DIR__.DS.'sql'.DS.'Users.sql'));
    $this->db->query($sql,[]);
}
/**
 *
 * register data to database
 *
 * @param $data (array)
 *
 */
public function register($params = [],$data = []){
    if($this->db->insert($this->TableName,$params,$data) >0){
        return TRUE;
    }
    return FALSE;
}
/**
 *
 * fetch data from table
 *
 * @param $where (array)
 *
 * @param $type (bool)
 *
 */
public function data($params = [],$data = [],$type = false){
    if (!empty($data)) {
        if($this->db->select($this->TableName,$params,$data) >0){
            $data = $this->db->fetch($this->TableName,$params,$data,$type);
            return $data;
        }
    }
}
/**
 *
 * update user data
 *
 * @param $data (array)
 *
 */
public function update($params = [],$data = []){
    if($this->db->update($this->TableName,$params,$data) >0){
        return TRUE;
    }
    return FALSE;
}
/**
 *
 * delete user from database
 *
 * @param $data (array)
 *
 */
public function delete($params = [],$data = []){
    if($this->db->delete($this->TableName,$params,$data) >0){
        return TRUE;
    }
    return FALSE;
}
/**
 *
 * destructor
 *
 */
public function __destruct(){

}
}
