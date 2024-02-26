<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Rest API</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Rest API</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="pizza.php">Pizza</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="movie.php">Search Movie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="mcu.php">MCU</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3 text-center">
            <h3>Pizza Heart</h3>
            <p id="kategori"></p>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-3">
                <div class="list-group" style="width: 230px;">
                    <button type="button" class="list-group-item list-group-item-action active" aria-current="true">All Menu</button>
                    <button type="button" class="list-group-item list-group-item-action">Pizza</button>
                    <button type="button" class="list-group-item list-group-item-action">Pasta</button>
                    <button type="button" class="list-group-item list-group-item-action">Nasi</button>
                    <button type="button" class="list-group-item list-group-item-action">Minuman</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row" id="daftarMenu">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function getMenu() {
        $.getJSON('pizza.json', function(result) {
            let menu = result.menu;

            $.each(menu, function(i, data) {
                $('#daftarMenu').append(`
                     <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="img/pizza/` + data.gambar + `" class="img-fluid">
                            <div class="card-body">
                                <h5 class="card-title">` + data.nama + `</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Rp ` + data.harga + `</h6>
                                <p class="card-text">` + data.deskripsi + `</p>
                                <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                `);
            })
        })
    }

    getMenu();

    $('#kategori').html('All Menu');

    $('.list-group-item').on('click', function() {
        $('#daftarMenu').html('');
        let kategori = $(this).text();
        $('#kategori').html(kategori);

        if (kategori == 'All Menu') {
            getMenu();
            return;
        }

        $('.list-group-item').removeClass('active');
        $(this).addClass('active');

        $.getJSON('pizza.json', function(result) {
            let menu = result.menu;

            let content = '';

            $.each(menu, function(i, data) {
                if (data.kategori == kategori.toLowerCase()) {
                    content += `<div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="img/pizza/` + data.gambar + `" class="img-fluid">
                            <div class="card-body">
                                <h5 class="card-title">` + data.nama + `</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Rp ` + data.harga + `</h6>
                                <p class="card-text">` + data.deskripsi + `</p>
                                <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>`
                }
            });
            $('#daftarMenu').html(content);
        })
    })
</script>

</html>