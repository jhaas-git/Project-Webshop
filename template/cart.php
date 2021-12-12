<?php

include '../model/config/includes.php';
include '../model/config/connect.php';

session_start();
if (!isset($_SESSION['signedin'])) {
    // Check if the session is active. If not, redirect to account.php.
    header('Location: account.php'); 
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/cart.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title>Document</title>
</head>
<body>
    
<?php include 'default/header.php'; ?>

<main>
    <section class="cart-results-section">
        <?php showCart() ?>
    </section>
</main>    

<?php include 'default/footer.php'; ?>

</body>
</html>