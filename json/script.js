// //object to json

// let mahasiswa = { //membuat object dengan nama mahasiswa
//     nama: "abdul Latief Qohar", //isi object
//     nrp: "02225125", //isi object
//     email: "alq@alq.co"
// }

// console.log(JSON.stringify(mahasiswa)); //JSON.stringifly fungsi mengubah objev=ct menjadi json


//json to object

// let xhr = new XMLHttpRequest(); //memanggil object http request
// xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) { //jika sudah siap
//         let mahasiswa = JSON.parse(this.responseText); //apapu respon dari ajax disimpan pada mahasiswa, Json.parse digunakan untuk merubah json menjadi object
//         console.log(mahasiswa)
//     }
// }
// xhr.open('GET', 'coba.json', true);
// xhr.send();

//json to object dengan jquery
$.getJSON('coba.json', function (data) {
    console.log(data);
})