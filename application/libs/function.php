<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function pr($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function rupiah($angka) {
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

/**
 * 
 * @param type $cabang
 * @param type $length
 * @return string
 */
function generateNoKontrak($cabang,$last, $length = 5) {
    $characters =(!empty($last)? $last : 1);
    
    $charLength     = $length - strlen($characters);
    $nol            = '';
    if($charLength>=0){
        for($i=0;$i<$charLength;$i++){
           $nol .='0';
        }    
    };
    $randomString = $cabang;
    $randomString .=$nol.$characters.'-' . date('y');
    return $randomString;
}

/**
 * 
 * @param type $cabang
 * @param type $length
 * @return string
 */
function generateKwintansi($last, $length = 6) {
    $characters =(!empty($last)? $last : 1);
    
    $charLength     = $length - strlen($characters);
    $nol            = '';
    if($charLength>=0){
        for($i=0;$i<$charLength;$i++){
           $nol .='0';
        }    
    };
//    #$randomString = 'KW-';
    $randomString = '';
    $randomString .=$nol.$characters;
    return $randomString;
}

/**
 * 
 * @param type $cabang
 * @param type $length
 * @return string
 */
function generateID($last, $length = 3) {
    $randomString = '';
    $characters =(!empty($last)? $last+1 : 1);
    
    $charLength     = $length - strlen($characters);
    $nol            = '';
    if($charLength>=0){
        for($i=0;$i<$charLength;$i++){
           $nol .='0';
        }    
    }

    $randomString .=$nol.$characters;
    return $randomString;
}


/**
 * 
 * @param type $string_number
 * @return type Float
 */
function isFloatNum($string_number){
  return  $number = floatval(str_replace(',', '.', str_replace('.', '', $string_number)));
}