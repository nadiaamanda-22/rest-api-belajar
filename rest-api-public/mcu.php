<?php

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://www.omdbapi.com/?apikey=723cfcb9&s=avengers');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result, true);

?>

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
            <h3 class="text-center">10 Movie for MCU</h3>
        </div>
        <hr>
        <div class="row">
            <?php foreach ($result['Search'] as $data) : ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="<?= $data['Poster'] ?>" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['Title'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $data['Year'] ?></h6>
                            <p>Type : <?= $data['Type'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</html>