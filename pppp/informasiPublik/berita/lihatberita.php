<?php 

include('../../includes/config.php');
include('../../includes/database.php');
include('../../includes/functions.php');
secure();

include('../../includes/header3.php');

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    if ($stm = $connect->prepare('SELECT * FROM berita WHERE id = ?')) {
        $stm->bind_param('i', $news_id);
        $stm->execute();
        $result = $stm->get_result();
    
        if ($result->num_rows > 0) {
            while ($record = mysqli_fetch_assoc($result)) {?> 
                <div class="container mt-5">
                    <h1><?php echo $record['title']?></h1>
                    <h3>Penulis: <?php if ($record['author'] == NULL){
                        echo $record['username'];
                    }else{
                        echo$record['author'];}?></h3>
                    <div class="container mt-5">
                        <img src="<?php echo $record['images']?>" style="width: 400px"/>
                    </div>
                    <div class="container mt-5">
                        <p><?php echo $record['content']?></p>
                    </div>
                </div>
                <?php } 
        } 
        else {
            ?>
            <div style="text-align: center; transform: translate(0%, 100%);">
                <div class="container">
                    <p>Berita Kosong</p>
                </div>
            </div>
            <?php
        }
        $stm->close();

    } else {
        echo 'Could not prepare statement!';
    }
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