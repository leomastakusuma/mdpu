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
function generateNoKontrak($cabang, $length = 5) {
    $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = $cabang;
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $randomString .='-' . date('d');
    return $randomString;
}
