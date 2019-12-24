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
class TokenGenerator{
/**
 *
 * Charcters [a-zA-z]
 *
 * @param (string)
 *
 */
private static $_CHARS = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
/**
 *
 * numbers [0-9]
 *
 * @param (string)
 *
 */
private static $_NUMS = "0123456789";
/**
 *
 * Special charcters [_-@]
 *
 * @param (string)
 *
 */
private static $_SPECIAL_CHARS = "_-@";
/**
 *
 * Charcters [a-zA-z] AND Numbers [0-9]
 *
 * @param (string)
 *
 */
private static $_CHARS_NUMS = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
/**
 *
 * Charcters [a-zA-z] AND  Special charcters [_-@]
 *
 * @param (string)
 *
 */
private static $_CHARS_SPECIALCHARS = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-@";
/**
 *
 * Numbers [0-9] AND Special charcters [_-@]
 *
 * @param (string)
 *
 */
private static $_NUMS_SPECIALCHARS = "0123456789_-@";
/**
 *
 * Charcters [a-zA-z] , Numbers [0-9] AND Special charcters [_-@]
 *
 * @param (string)
 *
 */
private static $_MIX = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-@";
/**
 *
 * Token types
 *
 */
//Characters
public const CHARS = 1;
//Special characters
public const SPECIAL_CHARS = 2;
//Numbers
public const NUMS = 3;
//Charcters AND Numbers
public const CHARS_NUMS = 4;
//Charcters AND  Special charcters
public const CHARS_SPECIALCHARS = 5;
//Numbers AND Special charcters
public const NUMS_SPECIALCHARS = 6;
//Numbers , Special charcters AND Characters
public const MIX = 7;
/**
 *
 * Generate unique token
 *
 */
public function generate($lenght = 8,$type = self::CHARS){
    if($lenght < 1 OR $lenght > 204){
        throw new \CanaryPHPTools\Exception("(TokenGenerator->chars) : The lenght should be between '1' as the minimum value and '204' as the maximum");
    }else{
        switch ($type) {
            case self::CHARS:
                $token = substr(str_shuffle(str_repeat(self::$_CHARS,4)),0,$lenght);
            break;
            case self::SPECIAL_CHARS:
                $token = substr(str_shuffle(str_repeat(self::$_SPECIAL_CHARS,68)),0,$lenght);
            break;
            case self::NUMS:
                $token = substr(str_shuffle(str_repeat(self::$_NUMS,21)),0,$lenght);
            break;
            case self::CHARS_NUMS:
                if($lenght > 13 && $lenght <= 23){
                    $lenght -=13;
                    $token = str_replace('.','',uniqid(substr(str_shuffle(str_repeat(self::$_CHARS_NUMS,4)),0,$lenght)));
                }elseif($lenght > 23){
                    $lenght -=22;
                    $token = str_replace('.','',uniqid(substr(str_shuffle(str_repeat(self::$_CHARS_NUMS,4)),0,$lenght),TRUE));
                }else{
                    $token = substr(str_shuffle(str_repeat(self::$_CHARS_NUMS,4)),0,$lenght);
                }
            break;
            case self::CHARS_SPECIALCHARS:
                $token = substr(str_shuffle(str_repeat(self::$_CHARS_SPECIALCHARS,8)),0,$lenght);
            break;
            case self::NUMS_SPECIALCHARS:
                $token = substr(str_shuffle(str_repeat(self::$_NUMS_SPECIALCHARS,16)),0,$lenght);
            break;
            case self::MIX:
                if($lenght > 13 && $lenght <= 23){
                    $lenght -=13;
                    $token = str_replace('.','',uniqid(substr(str_shuffle(str_repeat(self::$_MIX,4)),0,$lenght)));
                }elseif($lenght > 23){
                    $lenght -=22;
                    $token = str_replace('.','',uniqid(substr(str_shuffle(str_repeat(self::$_MIX,4)),0,$lenght),TRUE));
                }else{
                    $token = substr(str_shuffle(str_repeat(self::$_MIXS,4)),0,$lenght);
                }
            break;
            default:

            break;
        }
        return $token;
    }
}
}
