<?php

include '../model/config/connect.php';
include '../model/productFunc.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/watches.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title>Our watches | Audemars Piguet</title>
</head>
<body>
    
<?php include 'default/header.php'; ?>

<main>

<section class="watch-results-section">
    <div class="watch-results-container">
        <?php
            fetchProducts();
        ?>
    </div>
</section>

</main>

<?php include 'default/footer.php'; ?>

<script src="../javascript/default.js"></script>

</body>
</html>
