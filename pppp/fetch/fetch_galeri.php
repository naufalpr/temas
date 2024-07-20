<?php

include('../includes/config.php');
include('../includes/database.php');

$sql = 'SELECT * FROM galeri ORDER BY id DESC';

$data = []; 

if ($stm = $connect->prepare($sql)) {
  $stm->execute();
  $result = $stm->get_result();

  if ($result->num_rows > 0) {
    while ($record = $result->fetch_assoc()) {
      $base_path = '/temasfull/cms/informasiPublik/assets';
      $image_data = [
        'id' => $record['id'],
        'username' => $record['username'],
        'alt_text' => $record['alt_text'],
        'description' => $record['description'],
        'assets' => $base_path . $record['assets']
      ];

      $data[] = $image_data;
    }
  }

  $stm->close();
} else {
  echo 'Error: Could not prepare statement!';
  exit();
}

$json_data = json_encode($data);

header('Content-Type: application/json');

echo $json_data;
?>
