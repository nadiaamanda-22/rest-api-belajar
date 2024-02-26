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
        <div class="row mt-3 justify-content-center">
            <h3 class="text-center">Search Movie</h3>
            <div class="input-group mb-3" style="width: 50%;">
                <input type="text" class="form-control" placeholder="search movie ..." id="inputSearch">
                <button class="btn btn-dark" type="button" id="buttonSearch">Search</button>
            </div>
        </div>
        <hr>

        <div class="row" id="daftarMovie">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Movie</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body isiModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    function getMovie() {
        $.ajax({
            url: 'http://www.omdbapi.com/',
            type: 'GET',
            dataType: 'json',
            data: {
                'apikey': '723cfcb9',
                's': $('#inputSearch').val()
            },
            success: function(result) {
                if (result.Response == 'True') {

                    let movie = result.Search;

                    $.each(movie, function(i, data) {
                        $('#daftarMovie').append(`
                             <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="` + data.Poster + `" class="img-fluid">
                                    <div class="card-body">
                                        <h5 class="card-title">` + data.Title + `</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">` + data.Year + `</h6>
                                        <a href="#" class="card-link seeDetail" style="text-decoration: none;" data-id="` + data.imdbID + `" data-bs-toggle="modal" data-bs-target="#exampleModal">see detail</a>
                                    </div>
                                </div>
                            </div>
                        `);
                    })

                } else {
                    $('#daftarMovie').html(`<h4 class="text-center">` + result.Error + `</h4>`);
                }

                $('#inputSearch').val('');
            }

        })
    }

    $('#buttonSearch').on('click', function() {
        getMovie();
    })

    $('#inputSearch').on('keyup', function(e) {
        if (e.which == 13) {
            getMovie();
        }
    })

    $('#daftarMovie').on('click', '.seeDetail', function() {
        $('.isiModal').html('');
        $.ajax({
            url: 'http://www.omdbapi.com/',
            type: 'get',
            dataType: 'json',
            data: {
                'apikey': '723cfcb9',
                'i': $(this).data('id')
            },
            success: function(movie) {
                $('.isiModal').append(`
                    <div class="row">
                        <div class="col-md-4">
                            <img src="` + movie.Poster + `" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><h4>` + movie.Title + `</h4></li>
                                    <li class="list-group-item">Released : ` + movie.Released + `</li>
                                    <li class="list-group-item">Country : ` + movie.Country + `</li>
                                    <li class="list-group-item">Director : ` + movie.Director + `</li>
                                    <li class="list-group-item">Actors : ` + movie.Actors + `</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                `)
            }
        })
    })
</script>

</html>