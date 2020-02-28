#!/bin/php
<?php
error_reporting(0);
try{
    $url = "http://api.aladhan.com/v1/timingsByCity/{date('d-m-Y')}?country=Morocco&city=Casablanca";
    $response = file_get_contents($url);
    $data = json_decode($response);

    $salates = ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
    $time = date('Hi' ) * 1;

    foreach($data->data->timings as $key => $value ) {
        if( in_array($key, $salates) ) {
            $newTime = str_replace(':', '', $value) * 1;
            if( $time < $newTime ) {
                echo "$key $value |\n"; 
                exit;
            }
        }
    } 

    $date= new DateTime();
    $t = $date->add(new DateInterval('P1D'));

    $url = "http://api.aladhan.com/v1/timingsByCity/{$t->format('d-m-Y')}?country=Morocco&city=Casablanca";
    $response = file_get_contents($url);
    $data = json_decode($response);
    foreach($data->data->timings as $key => $value ) {
        echo "$key $value |\n"; 
        exit;
    } 
} catch(Exception $e) {
    echo " ... |\n";
}
