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
class GetVisitorInfo{
public function __construct($_IP_ADDRESS = ''){
	//curl request
	$stmt = curl_init();
	curl_setopt($stmt,CURLOPT_URL,"http://www.geoplugin.net/json.gp?ip={$_IP_ADDRESS}");
	curl_setopt($stmt,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($stmt);
	curl_close($stmt);
	$this->_RESPONSE = json_decode($response,TRUE);
	//Country Information
	$this->CountryName = $this->_RESPONSE['geoplugin_countryName'];
	$this->CountryCode = $this->_RESPONSE['geoplugin_countryCode'];
	$this->CountryCurrency = $this->_RESPONSE['geoplugin_currencyCode'];
	$this->CountryCurrencyCode = $this->_RESPONSE['geoplugin_currencySymbol'];
	$this->CountryCurrencyCodeUTF8 = $this->_RESPONSE['geoplugin_currencySymbol_UTF8'];
	//Continent Info
	$this->Continent = $this->_RESPONSE['geoplugin_continentName'];
	$this->ContinentCode = $this->_RESPONSE['geoplugin_continentCode'];
	//TimeZone
	$this->TimeZone = $this->_RESPONSE['geoplugin_timezone'];
	//Region
	$this->Region = $this->_RESPONSE['geoplugin_region'];
	$this->RegionName = $this->_RESPONSE['geoplugin_regionName'];
	$this->RegionCode = $this->_RESPONSE['geoplugin_regionCode'];
	$this->City = $this->_RESPONSE['geoplugin_city'];
	$this->AreaCode = $this->_RESPONSE['geoplugin_areaCode'];
}
/**
 *
 * Response data
 *
*/
private $_RESPONSE;
/**
 *
 * Continent Info
 *
 * @param (string)
 *
*/
private $Continent,
		$ContinentCode;
/**
 *
 * Country Info
 *
 * @param (string)
 *
*/
private $CountryName,
		$CountryCode,
		$CountryCurrency,
		$CountryCurrencyCode,
		$CountryCurrencyCodeUTF8;
/**
 *
 * TimeZone
 *
 * @param (string)
 *
*/
private $TimeZone;
/**
 *
 * Region Information
 *
 * @param (string)
 *
*/
private $Region,
		$RegionName,
		$RegionCode,
		$City,
		$AreaCode;
//Get country name
public function getCountryName(){
	return $this->CountryName;
}
//Get Country Code
public function getCountryCode(){
	return $this->CountryCode;
}
//Get Country Currency
public function getCountryCurrency(){
	return $this->CountryCurrency;
}
//Get Country Currency Code
public function getCountryCurrencyCode(){
	return $this->CountryCurrencyCode;
}
//Get Country Currency Code UTF-8
public function getCountryCurrencyCodeUTF8(){
	return $this->CountryCurrencyCodeUTF8;
}
//Get Continent Name
public function getContinent(){
	return $this->Continent;
}
//Get Continent Code
public function getContinentCode(){
	return $this->ContinentCode;
}
//Get Timezone
public function getTimeZone(){
	return $this->TimeZone;
}
//Get Region
public function getRegion(){
	return $this->Region;
}
//Get Region Name
public function getRegionName(){
	return $this->RegionName;
}
//Get Region Code
public function getRegionCode(){
	return $this->RegionCode;
}
//Get City
public function getCity(){
	return $this->City;
}
//Get Area Code
public function getAreaCode(){
	return $this->AreaCode;
}
public function ShowResult(){
echo "<b>Country Name :</b>".$this->getCountryName()."<br>";
echo "<b>Country Code :</b>".$this->getCountryCode()."<br>";
echo "<b>Country currency :</b>".$this->getCountryCurrency()."<br>";
echo "<b>Country currency code :</b>".$this->getCountryCurrencyCode()."<br>";
echo "<b>Country currency utf8 :</b>".$this->getCountryCurrencyCodeUTF8()."<br>";
echo "<b>Country Continent :</b>".$this->getContinent()."<br>";
echo "<b>Country ContinentCode :</b>".$this->getContinentCode()."<br>";
echo "<b>Timezone :</b>".$this->getTimeZone()."<br>";
echo "<b>Region :</b>".$this->getRegion()."<br>";
echo "<b>Region Name :</b>".$this->getRegionName()."<br>";
echo "<b>Region Code :</b>".$this->getRegionCode()."<br>";
echo "<b>City :</b>".$this->getCity()."<br>";
echo "<b>Area Code :</b>".$this->getAreaCode()."<br>";
}
}
