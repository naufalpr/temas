<?php 
include('../../includes/config.php');
include('../../includes/database.php');
include('../../includes/functions.php');
secure();
include('../../includes/header3.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    echo 'Login untuk upload file.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alt_text = $_POST['alt_text'];
    $description = $_POST['description'];

    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $tmp = explode('.', $fileName);
    $fileExt = strtolower(end($tmp));
    $allowedImages = array('jpg', 'jpeg', 'png', 'gif', 'svg');
    $allowedVideos = array('mp4','ogg', 'webm');

    if (!in_array($fileExt, $allowedImages) && !in_array($fileExt, $allowedVideos)) {
        echo 'You cannot upload files of this type!';
        exit();
      }

  // Validate file size (adjust as needed)
  $maxSize = 5000000;
  if ($fileSize > $maxSize) {
    echo 'Your file is too big!';
    exit();
  }

  // Check for upload errors
  if ($fileError !== 0) {
    echo 'There was an error uploading your file!';
    exit();
  }

  // Define target directory based on extension
  if (in_array($fileExt, $allowedImages)) {
    $target_dir = "assets/images/";
  } else if (in_array($fileExt, $allowedVideos)){
    $target_dir = "assets/videos/";
  }

  $target_file = $target_dir . basename($fileName);

  $substring1 = 'image';
  $substring2 = 'video';
  if (strpos($target_dir, $substring1)) {
    $filetype = $substring1;
  }elseif (strpos($target_dir, $substring2)) {
    $filetype = $substring2;
  }
  
  // Upload the file
  if (move_uploaded_file($fileTmpName, $target_file)) {
    // Use prepared statements for security
    $sql = "INSERT INTO galeri (username, assets, filetype, alt_text, description) VALUES (?, ?, ?, ?, ?)";
    if ($stm = $connect->prepare($sql)) {
      $null = NULL;
      $stm->bind_param('sssss', $username, $target_file, $filetype, $alt_text, $description);

      // Improved error handling for database operation
      if ($stm->execute()) {
        $stm->close();
        header('Location: galeri.php');
        exit();
      } else {
        echo 'Database error: ' . $connect->error;
        exit();
      }
    } else {
      echo 'Could not prepare statement!';
      exit();
    }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

<div class="container mt-5">
    <h1 class="display-1">Upload Galeri Foto/Video</h1>
</div>
<div class="container mt-5">
    <form action="add_galeri.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <div class="form-outline mb-4 mt-5">
            <input type="text" id="alt_text" name="alt_text" class="form-control" required />
            <label class="form-label" for="alt_text">Judul</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" id="description" name="description" class="form-control" required />
            <label class="form-label" for="description">Deskripsi</label>
        </div>
        <button type="submit" id="submit" onclick="confirmSubmit(this.id)">Submit</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<script>
function confirmSubmit(id) {
    if (confirm("Apakah Anda yakin ingin mengupload foto/video ini?")) {
        window.location.href = "add_galeri.php?submit=" + id;
    }
}
</script>
