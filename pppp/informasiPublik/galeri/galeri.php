<?php 
include('../../includes/config.php');
include('../../includes/database.php');
include('../../includes/functions.php');
secure();
include('../../includes/header3.php');

?>

<div class="container mt-5">
    <h1 class="display-1">Galeri</h1>
</div>

<?php

if (isset($_GET['delete'])) {
    if ($stm = $connect->prepare('DELETE FROM galeri WHERE id = ?')) {
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();

        set_message("Foto/Video telah dihapus");
        header('Location: galeri.php');
        $stm->close();
        die();
    } else {
        echo 'Could not prepare delete statement!';
    }
}

if ($stm = $connect->prepare('SELECT * FROM galeri')) {
    $stm->execute();
    $result = $stm->get_result();
    
    if ($result->num_rows > 0) {
        ?>

        <div class="container mt-5">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Username</th>
                    <th>Judul Foto</th>
                    <th>Deskripsi</th>
                    <th>Foto/Video</th>
                    <td>Ubah | Hapus</td>
                </tr>

                <?php while ($record = mysqli_fetch_assoc($result)) {
                    
                    ?> 
                <tr>
                    <td><?php echo $record['username']; ?></td>
                    <td><?php echo $record['alt_text']; ?></td>
                    <td><?php echo $record['description']; ?></td>
                    <td><?php if($record['filetype'] = 'image'){
                                $imagePath = $record['assets'] ?>
                                <img src="<?php echo $imagePath; ?>" style="width: 200px"><?php
                            if($record['filetype'] = 'video'){
                                $videoPath = $record['assets']?>
                                <video src="<?php echo $videoPath; ?>"><?php
                        }
                    };?>
                        
                    </td>
                    <td>
                        <a href="edit_galeri.php?id=<?php echo $record['id']; ?>">Ubah</a>
                        <a href="javascript:confirmDelete(<?php echo $record['id']; ?>)">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
                <a href="add_galeri.php">Tambah Postingan Baru</a>
        </div>
        <?php
    } 
    else {
        ?>

        <div style="text-align: center; transform: translate(0%, 100%);">
            <div class="container">
                <p>Galeri Kosong</p>
            </div>
            <div style="position:relative;">
                <div class="container mt-5">
                    <button type="button"><a style="text-decoration: none;" href="add_galeri.php">Tambah Postingan Baru</a></button>
                </div>
            </div>
        </div>
        <?php
    }
    $stm->close();

} else {
    echo 'Could not prepare statement!';
}
?>

<script>
function confirmDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "galeri.php?delete=" + id;
    }
}
</script>

<?php
include('../../includes/footer.php');
?>
