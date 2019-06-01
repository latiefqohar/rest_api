<?php
//jika datanya hanya 1
//  $mahasiswa = array( //buat array dengan php
//      'nama' =>'abdul latief qohar',//key dan value array
//      'nim' => '20012200', //key dan value array
//      'email'=> 'alq@alq.com' //key dan value array
//     );

//     //var_dump($mahasiswa);
//     $data=json_encode($mahasiswa); //array to json
//     echo $data; //tampilkan json


// //jika data mahasiswanya lebih dari 1
//     $mahasiswa1 = array( //membuat array
//         [ //didalam array ada array
//             'nama' =>'latief qohar', //key dan value
//             'nim' => '12200',  //key dan value
//             'email'=> 'latief@alq.com' //key dan value
//         ], //tutup array pertama lalu pisahkan koma
//         [
//             'nama' =>'abdul latief qohar',
//             'nim' => '20012200', 
//             'email'=> 'alq@alq.com'
//         ] 
//        );

//        //var_dump($mahasiswa);
//        $data1=json_encode($mahasiswa1); //array to json
//        echo $data1; //tampilkan json


// ambil data dari database dan dijadikan JSON

$con = mysqli_connect("localhost", "root", "", "inventory");
$query = mysqli_query($con, "SELECT * FROM barang");
while ($hasil = mysqli_fetch_assoc($query)) {
    $data2[] = $hasil;
}
$json = json_encode($data2);
echo $json; 
?>