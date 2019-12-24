<?php
/**
 *
 * check if inserted lang is valid
 *
 * @param (string) $lang : language
 *
 * @return (book) TRUE OR FALSE
 *
**/
function valid_lang($lang = ''){
	return in_array($lang,cp_config('languages'));
}
