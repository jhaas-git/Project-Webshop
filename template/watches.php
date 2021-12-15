<?php

include '../model/config/connect.php';
include '../model/config/includes.php';

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

<section class="filter-results-section">
    <div class="filter-results-container">
        <button class="filter"><p class="bi bi-funnel"> Filter</p><span class="bi bi-plus-lg"></span></button>
        <div class="panel">
            <form action="#" method="post">
            <div class="filter-content">
                <div class="filter-content-grid">
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Collection</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchCollectionFilter() ?></ul>
                        </div>
                    </div>                    
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Calibre</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchCalibreFilter() ?></ul>
                        </div>
                    </div>                    
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Material</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchMaterialFilter() ?></ul>
                        </div>
                    </div>                    
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Case size</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchSizeFilter() ?></ul>
                        </div>
                    </div>                         
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

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
<script src="../javascript/filter.js"></script>

</body>
</html>