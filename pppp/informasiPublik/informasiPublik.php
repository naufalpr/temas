<?php 

include('../includes/config.php');
include('../includes/database.php');
include('../includes/functions.php');
secure();
include('../includes/header2.php');

?>


<div class="container mt-5">
    <h1 class="display-1">Informasi Publik</h1>
</div>
<div class="container mt-2">
    <div class="row mb-4 gx-3 gy-3">
        <div class="col-md-4">
            <a href="berita/berita.php" style="text-decoration: none;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Berita</h5>
                        <p class="card-text">Update Berita</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="agenda.php" style="text-decoration: none;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Agenda</h5>
                        <p class="card-text">Update Berita</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="pengumuman.php" style="text-decoration: none;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pengumuman</h5>
                        <p class="card-text">Update Berita</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="galeri/galeri.php" style="text-decoration: none;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Galeri</h5>
                        <p class="card-text">Update Berita</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
include('../includes/footer.php');
?>
