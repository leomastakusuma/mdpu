<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function  pr($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    
}

function nama($nama){
    $valid=TRUE;
    if(is_numeric($nama)){
        echo 'errr';
        $valid=false;
    }

}

function validateEmail($email)
{
	$isValid = true;
	$atIndex = strrpos($email, "@");
	if (is_bool($atIndex) && !$atIndex)
	{
		$isValid = false;
	}
	else
	{
		$domain = substr($email, $atIndex + 1);
		$local = substr($email, 0, $atIndex);
		$localLen = strlen($local);
		$domainLen = strlen($domain);
		if ($localLen <= 2 || $localLen > 30)
		{
			$isValid = false;
		}
		else if ($domainLen < 1 || $domainLen > 255)
		{
			$isValid = false;
		}
		else if ($local[0] == '.' || $local[$localLen - 1] == '.')
		{
			$isValid = false;
		}
		else if (preg_match('/\\.\\./', $local))
		{
			$isValid = false;
		}
//		else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
//		{
//			$isValid = false;
//		}
////		else if (preg_match('/\\.\\./', $domain))
//		{
//			$isValid = false;
//		}
		else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local)))
		{
			if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local)))
			{
				$isValid = false;
			}
		}
//		if ($isValid && !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A")))
//		{
//			$isValid = false;
//		}
	}
	return $isValid;
}

function validname($name){
    $isValid      = true;
    $pattern_name = '/^([a-zA-Z. ]+){1,24}$/';
    preg_match($pattern_name, $name);
    if(preg_match($pattern_name, $name)):
      $isValid=true;
    else :
      $isValid = false;
    endif;
    
    return $isValid;
}
function validaddres($address){
    $isValid      = true;
    $pattern_address = '/^([a-zA-Z0-9-_@(),:.&# \/\s]+)$/i';
    preg_match($pattern_address, $address);
    if(preg_match($pattern_address, $address)):
      $isValid=true;
    else :
      $isValid = false;
    endif;
    
    return $isValid;
    
}

function getErrorMessage ($code = null, $lang = 'en', $return = true)
{
    if (empty($code))
        return false;
    global $Refs;
    $msg = ! empty($Refs->errorCodes->{$code}->{$lang}) ? $Refs->errorCodes->{$code}->{$lang} : null;
    if ($return)
        return $msg;
    else
        echo $msg;
}




//function isPost ()
//    {
//        if ('POST' == $this->getMethod()) {
//            return true;
//        }
//        return false;
//    }
//
//function getPost ($key = null, $default = null)
//    {
//        if (null === $key) {
//            return $_POST;
//        }
//        return (isset($_POST[$key])) ? $_POST[$key] : $default;
//    }
//
//
//