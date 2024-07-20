<?php

include('../includes/config.php');
include('../includes/database.php');

$sql = 'SELECT * FROM berita ORDER BY id DESC';

$data = [];  

if ($stm = $connect->prepare($sql)) {
  $stm->execute();
  $result = $stm->get_result();

  if ($result->num_rows > 0) {
    while ($record = $result->fetch_assoc()) {
      $base_path = '/temasfull/cms/informasiPublik/images/';
      $berita_data = [
        'id' => $record['id'],
        'username' => $record['username'],
        'title' => $record['title'],
        'content' => $record['content'],
        'imgPath' => $base_path . $record['images'],
        'alt_text' => $record['alt_text'],
        'author' => $record['author'],
        'date_added' => $record['date_added'],
      ];

      $data[] = $berita_data;
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
