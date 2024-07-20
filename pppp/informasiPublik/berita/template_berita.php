<?php

include('../../includes/config.php');
include('../../includes/database.php');

if (!isset($_GET['id'])) {
    echo 'No article ID provided!';
    exit();
}

$article_id = intval($_GET['id']);

$sql = 'SELECT * FROM berita WHERE id = ?';
if ($stm = $connect->prepare($sql)) {
    $stm->bind_param('i', $article_id);
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        echo 'Article not found!';
        exit();
    }

    $stm->close();
} else {
    echo 'Error: Could not prepare statement!';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <!-- Include your CSS files here -->
</head>
<body>
    <h1><?php echo htmlspecialchars($article['title']); ?></h1>
    <p>By <?php echo htmlspecialchars($article['author']); ?> on <?php echo htmlspecialchars($article['date_added']); ?></p>
    <img src="<?php echo htmlspecialchars($article['imgPath']); ?>" alt="<?php echo htmlspecialchars($article['alt_text']); ?>" style="width: 100%; height: auto;">
    <div>
        <?php echo nl2br(htmlspecialchars($article['content'])); ?>
    </div>
    <a href="index.php">Back to News List</a>
</body>
</html>

<?php  include('../../includes/footer.php'); ?>

