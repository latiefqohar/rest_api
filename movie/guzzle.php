<?php
 require 'vendor/autoload.php'; //menghubungkan dengan vendor

 use GuzzleHttp\Client; //namespace
 
 $client = new Client(); //buat object baru

 $response = $client->request('GET', 'http://omdbapi.com', [ //request methode GET http omdb
    'query'=> [
        'apikey'=>'e1cc6c3e', //parameter  yang dikirim
        's'=> 'transformers' //parameter yang dikirim
    ]
 ]);

//echo $response->getBody()->getContents();//ambil body dari $response
$result=json_decode($response);
?>