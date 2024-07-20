<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Temas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="css/mdb.min.css" />
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<header id="header">
<div class="navbar bg-light my-auto">
    <button class="btn border-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><h2 class="bi bi-list"></h2>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Admin Website Temas</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
            <ol class="list-group" style="list-style-type: none;">
                <li><a class="list-group-item" href="../dashboard.php">Dashboard</a></li>
                <li><a class="list-group-item" href="../profil/profil.php">Profil</a></li>
                <li><a class="list-group-item" href=""></a></li>
                <li><a class="list-group-item" href="">Wisata</a></li>
                <li><a class="list-group-item" href="../informasiPublik/informasiPublik.php">Informasi Publik</a></li>
            </ol>
        </div>
    </div>

    <div class="me-auto">
        <h4>ADMIN TEMAS</h4>
    </div>
</div>
</header>

<?php get_message(); ?>
    
