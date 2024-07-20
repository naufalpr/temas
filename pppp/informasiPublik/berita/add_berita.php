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
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $tmp = explode('.', $fileName);
    $fileExt = strtolower(end($tmp));
    $allowedImages = array('jpg', 'jpeg', 'png', 'gif', 'svg');

    if (!in_array($fileExt, $allowedImages)) {
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
    $target_dir = "../images/";
  } 

  $target_file = $target_dir . basename($fileName);
  date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d H:i:s'); 

  // Upload the file
  if (move_uploaded_file($fileTmpName, $target_file)) {
    // Use prepared statements for security
    $sql = "INSERT INTO berita (username, title, content, images, author, date_added) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stm = $connect->prepare($sql)) {
      $null = NULL;
      $stm->bind_param('ssssss', $username, $title, $content, $target_file, $author, $date);

      // Improved error handling for database operation
      if ($stm->execute()) {
        $stm->close();
        header('Location: berita.php');
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
    <h1 class="display-1">Upload Berita</h1>
</div>
<div class="container mt-5">
    <form action="add_berita.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <div class="form-outline mb-4 mt-5">
            <input type="text" id="title" name="title" class="form-control" required />
            <label class="form-label" for="title">Judul</label>
        </div>
        <div class="form-outline mb-4">
            <textarea type="text" id="content" name="content" class="form-control" required></textarea>
            <label class="form-label" for="content">Konten</label>
        </div>
        <div class="form-outline mb-4 mt-5">
            <input type="text" id="author" name="author" class="form-control" required />
            <label class="form-label" for="author">Penulis</label>
        </div>
        <button type="submit" id="submit" onclick="confirmSubmit(this.id)">Submit</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<script>
function confirmSubmit(id) {
    if (confirm("Apakah Anda yakin ingin mengupload berita ini?")) {
        document.querySelector('form').submit(); // Submit the form programmatically
    }
}
</script>