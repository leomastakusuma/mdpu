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
    $rupiah = number_format($angka, 2, ',', '.');
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
function generateKwintansi($last, $length = 5) {
    $characters =(!empty($last)? $last : 1);
    
    $charLength     = $length - strlen($characters);
    $nol            = '';
    if($charLength>=0){
        for($i=0;$i<$charLength;$i++){
           $nol .='0';
        }    
    };
    $randomString = 'KW-';
    $randomString .=$nol.$characters.'-' . date('m').'-'.date('y');
    return $randomString;
}
