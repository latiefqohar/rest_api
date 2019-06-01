function searchMovie() {
    $('#movie-list').html(''); // menghapus hasil pencarian sebelumnya
    $.ajax({
        url: 'http://omdbapi.com', //url yang diakses
        type: 'get', //method get
        dataType: 'json', //data yang diambil json
        data: {
            'apikey': 'e1cc6c3e', //parameter apikey==api yang didapat
            's': $('#search-input').val() //parameter s == hasil inputan dengan id search-input
        },
        success: function (result) { //jika suksess jalanka fungsi ini dan hasilnya disimpan dalam result
            //console.log(result);
            if (result.Response == "True") { //true didapat dari json
                let movies = result.Search; //object search disimpan dalam variable movies

                $.each(movies, function (i, data) { //looping movies dqan disimpan dalam data
                    //rubah class movie-list menjadi berikut  
                    //agar menghiraukan spasi maka digunakan tanda petik disamping angka 1
                    $('#movie-list').append(`
                    <div class="col-md-4">
                    <div class="card mb3" >
                    <img src="` + data.Poster + `" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">` + data.Title + `</h5>
                        <h6 class="card-subtitle mb-2 text-muted">` + data.Year + `</h6>
                        <a href="#" class="btn btn-primary see-detail" data-toggle="modal" data-target="#exampleModal" data-id=` + data.imdbID + `>see detail</a>
                    </div>
                    </div>
                    </div>
                    `);
                });
            } else { //jika tidak maka rubah movie list menjadi movie not found
                $('#movie-list').html('<h1 >Movie not found!</h1>')
            }
        }
    })
}

$('#search-button').on('click', function () { //ambil id search-button jika di klik jalankan fungsi ini
    searchMovie();
});

$('#search-input').on('keyup', function (e) { //jika id search-input ditekan enter
    if (e.keyCode === 13) {
        searchMovie(); // jalankan fungsi ini
    }
});


$('#movie-list').on('click', '.see-detail', function () { // cari id movie-list, jika class seedetail di klik jalankan fungsi ini
    console.log($(this).data('id'));
    $.ajax({
        url: 'http://omdbapi.com', //url yang diakses
        type: 'get', //method get
        dataType: 'json', //data yang diambil json
        data: {
            'apikey': 'e1cc6c3e', //parameter apikey==api yang didapat
            'i': $(this).data('id') //parameter s == hasil inputan dengan id search-input
        },
        success: function (movie) { //jika berhasil jalankan fungsi ini dan simpan dalam parameter
            if (movie.Response === "True") { //jika respon = "True"
                //rubah ini class modal-body dengan berikut...
                $('.modal-body').html(`
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="` + movie.Poster + `" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group">
                                <li class="list-group-item"><h3>` + movie.Title + `</h3></li>
                                <li class="list-group-item"> Release :` + movie.Released + `</li>
                                <li class="list-group-item"> Runtime :` + movie.Runtime + `</li>
                                <li class="list-group-item"> Plot :` + movie.Plot + `</li>
                                
                            </ul>
                        </div> 
                    </div>
                </div>
                `)
            }
        }
    })
})