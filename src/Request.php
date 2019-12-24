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
class Request{
/**
 *
 * constructor
 *
 */
public function __construct(){
    $this->post = $_POST;
    $this->get = $_GET;
}
/**
 *
 * Requests ARRAY
 *
 * @param (array)
 *
**/
protected $post,$get;
/**
 *
 * check request is post
 *
 */
public function is(){
        $arr = ['post'=>FALSE,'get'=>FALSE];
        $result = ($_SERVER['REQUEST_METHOD'] === 'POST') ? (object) ['post'=>TRUE,'get'=>FALSE] : (object) ['post'=>FALSE,'get'=>TRUE];
        return $result;
}
/**
 *
 * request post data
 *
 */
public function data(){
    $new_data = [];
    $req = ($this->is()->get) ? 'get' : 'post' ;
    if($this->is()->$req){
        foreach ($this->$req as $key => $value) {
            $accept_key = mb_substr($key,0,2);
            if($accept_key === '__') {
                $new_key = ltrim($key,'__');
                $new_data[':'.$new_key] = $value;
            }else {
                break;
            }
        }
        return $new_data;
    }
}
/**
 *
 * destructor
 *
 */
public function __destruct(){
    $this->post =null;
    $this->get = null;
}
}
