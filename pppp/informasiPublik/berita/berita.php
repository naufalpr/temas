<?php 

include('../../includes/config.php');
include('../../includes/database.php');
include('../../includes/functions.php');
secure();

include('../../includes/header3.php');

?>


<div class="container mt-5">
    <h1 class="display-1">Berita</h1>
</div>

<?php

if (isset($_GET['delete'])) {
    if ($stm = $connect->prepare('DELETE FROM berita WHERE id = ?')) {
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();

        set_message("Berita telah dihapus");
        header('Location: berita.php');
        $stm->close();
        die();
    } else {
        echo 'Could not prepare delete statement!';
    }
}

if ($stm = $connect->prepare('SELECT * FROM berita')) {
    $stm->execute();
    $result = $stm->get_result();
    
    if ($result->num_rows > 0) {
        ?>

        <div class="container mt-5">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Username</th>
                    <th>Judul Berita</th>
                    <th>Konten</th>
                    <th>Tanggal Dibuat</th>
                    <td>Ubah | Hapus</td>
                </tr>

                <?php while ($record = mysqli_fetch_assoc($result)) {
                    
                    ?> 
                <tr>
                    <td><?php echo $record['username']; ?></td>
                    <td><?php echo $record['title']; ?></td>
                    <td><a href="lihatberita.php?id=<?php echo $record['id']; ?>">Lihat Konten</a></td>
                    <td><?php  echo $record['date_added']; ?></td>
                    <td>
                        <a href="edit_berita.php?id=<?php echo $record['id']; ?>">Ubah</a>
                        <a href="javascript:confirmDelete(<?php echo $record['id']; ?>)">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
                <a href="add_berita.php">Tambah Postingan Baru</a>
        </div>
        <?php
    } 
    else {
        ?>

        <div style="text-align: center; transform: translate(0%, 100%);">
            <div class="container">
                <p>Berita Kosong</p>
            </div>
            <div style="position:relative;">
                <div class="container mt-5">
                    <button type="button"><a style="text-decoration: none;" href="add_berita.php">Tambah Postingan Baru</a></button>
                </div>
            </div>
        </div>
        <?php
    }
    $stm->close();

} else {
    echo 'Could not prepare statement!';
}

include('../../includes/footer.php');
?>

<script>
function confirmDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "berita.php?delete=" + id;
    }
}
</script>