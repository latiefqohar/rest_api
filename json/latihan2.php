<?php
 
 $data=file_get_contents('coba.json'); //ambil data json pada latihan2.php kemudian simpan pada $data
 $mahasiswa=json_decode($data,true);//decode $data ke $mahasiswa, true berfungsi merubah object menjadi array.
     var_dump($mahasiswa);
 
?>