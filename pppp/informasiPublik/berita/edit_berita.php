<?php 

include('../../includes/config.php');
include('../../includes/database.php');
include('../../includes/functions.php');
secure();

include('../../includes/header3.php');
?>

<div class="container mt-5">
    <h1 class="display-1">Edit Berita</h1>
</div>
<div class="container mt-5">
    <form action="add_berita.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <div class="form-outline mb-4 mt-5">
            <input type="text" id="title" name="title" class="form-control" required />
            <label class="form-label" for="title">Judul</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" id="content" name="content" class="form-control" required />
            <label class="form-label" for="content">Konten</label>
        </div>
        <div class="form-outline mb-4 mt-5">
            <input type="text" id="author" name="author" class="form-control" required />
            <label class="form-label" for="author">Penulis</label>
        </div>
        <button type="submit" id="submit" onclick="confirmSubmit(this.id)">Submit</button>
    </form>
</div>


<?php  include('../../includes/footer.php'); ?>

<script>
function confirmSubmit(id) {
    if (confirm("Apakah Anda yakin ingin mengupload berita ini?")) {
        window.location.href = "add_berita.php?submit=" + id;
    }
}
</script>