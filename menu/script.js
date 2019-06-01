function tampilkanMenu() { //membuat fungsi tampilkan menu
    $.getJSON('data/pizza.json', function (data) { //ambil json di data/pizza.json, jika berhasil jalankan fungsi ini dan simpan pada "data"
        let menu = data.menu; //mengambil object menjadi array
        $.each(menu, function (i, data) { //CARA LOOPING
            $('#daftar-menu').append('<div class="col-md-4"><div class="card mb-3" ><img src="img/menu/' + data.gambar + '" class="card-img-top" ><div class="card-body"><h5 class="card-title">' + data.nama + '</h5><p class="card-text">' + data.deskripsi + '</p><h5 class="card-title">Rp. ' + data.harga + '</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>');

        });
    });

}
tampilkanMenu();


$('.nav-link').on('click', function () { //cari class nav-link,jika di klik jalankan fungsi ini
    $('.nav-link').removeClass('active'); //hilangkan semua class active pada class nav-link
    $(this).addClass('active'); //tambahkan class active pada class yang di klik

    let kategori = $(this).html(); // ambil value html yang di klik dan simpan ke kkategori
    $('H1').html(kategori); //rubah H1 dengan kategori
    if (kategori == 'All Menu') { //jika kategori = All Menu
        $('#daftar-menu').html(''); //hapus tampilan sebelumnya
        tampilkanMenu(); //tampilkan menu
        return;
    }

    //sortir
    $.getJSON('data/pizza.json', function (data) { //ambil data pizza.json, jika berhasil simpan ke parameter data dan jalankan fungsi ini
        let menu = data.menu; //merubah object menu menjadi array, data dari fungsi, menu dari menu pada pizza.json
        let content = ''; //variable content dengan isi awal kosong.


        $.each(menu, function (i, data) { //LOOPING menu dan simpan ke data
            if (data.kategori == kategori.toLowerCase()) { //jika kategori yang ada di data json sama dengan kategori yang diinput di html
                //rubah content diisi dengan data json
                content += '<div class="col-md-4"><div class="card mb-3" ><img src="img/menu/' + data.gambar + '" class="card-img-top" ><div class="card-body"><h5 class="card-title">' + data.nama + '</h5><p class="card-text">' + data.deskripsi + '</p><h5 class="card-title">Rp. ' + data.harga + '</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>';
                //console.log(content);
            }
        });
        //console.log(content);
        $('#daftar-menu').html(content); // isi class daftar menu dengan content.
    });
});