<?php 

include '../model/productFunc.php';

session_start();

$productResult = fetchWatchInformation();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/product.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title><?php echo $productResult['sReferential'] ?> | Audemars Piguet</title>
</head>
<body>
    
<?php include 'default/header.php'; ?>

<main>

<section class="collection-section">
    <div class="collection-container">
        <div class="collection-container-left"><p class="title">discover <br> <span class="collection reveal"><?php echo $productResult['sCollection'] ?></span></p></div>
        <div class="collection-container-right"><img src="<?php echo $productResult['sWatchMedia'] ?>"></div>
    </div>
</section>

<section class="information-section">
    <div class="information-container">
        <div class="information-header">
            <div class="information-header-left">
                <p class="model"><?php echo $productResult['sModelName'] ?></p>
                <p class="ref"><?php echo $productResult['sReferential'] ?></p>
            </div>
            <?php 
            // Employees are able to edit or delete a product.
            if ($_SESSION['role_idRole'] == 1) {
                echo ' 
                <div class="information-header-right">
                    <a href="#" class="bi bi-pencil editButton"></a>
                    <a href="#" class="bi bi-trash deleteButton"></a>
                </div>';
            } else {
                // Customers will be seeing the price.
                echo '
                <div class="information-header-right">
                    <p class="price"><span>€</span> '. $productResult['dPrice'] .'</p>
                </div>';
            }
            ?>
        </div>

        <div class="information-body">
            <div class="main-carousel" data-flickity='{"contain": true, "wrapAround": true, "autoPlay": 7000}'>
                <div class="information-cell">
                    <div class="information-cell-left"><div class="information-image"><img src="<?php echo $productResult['sCaseMedia'] ?>" alt=""></div></div>
                    <div class="information-cell-right">
                        <div class="information-specs">
                            <div class="information-specs-left">
                                <p class="spec-title">Material</p>
                                <p class="spec-value"><?php echo $productResult['sCaseMaterial'] ?></p>
                                <p class="spec-title">Water resistance</p>
                                <p class="spec-value"><?php echo $productResult['sCaseIPX'] ?></p>
                            </div>
                            <div class="information-specs-right">
                                <p class="spec-title">Thickness</p>
                                <p class="spec-value"><?php echo $productResult['sCaseThickness'] ?></p>
                                <p class="spec-title">Size</p>
                                <p class="spec-value"><?php echo $productResult['sCaseSize'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="information-cell">
                    <div class="information-cell-left"><div class="information-image"><img src="<?php echo $productResult['sCalibreMedia'] ?>" alt=""></div></div>
                    <div class="information-cell-right">
                        <div class="information-specs">
                            <div class="information-specs-left">
                                <p class="spec-title">Mechanism</p>
                                <p class="spec-value"><?php echo $productResult['sMechanism'] ?></p>
                                <p class="spec-title">Function</p>
                                <p class="spec-value"><?php echo $productResult['sFunction'] ?></p>
                            </div>
                            <div class="information-specs-right">
                                <p class="spec-title">Power reserve</p>
                                <p class="spec-value"><?php echo $productResult['sPowerReserve'] ?></p>
                                <p class="spec-title">Number of parts</p>
                                <p class="spec-value"><?php echo $productResult['iNumOfParts'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="information-footer">
            <form action="#" method="#"><button type="submit" class="bi bi-bag bagButton"> place in bag</button></form>
        </div>
    </div>
</section>

</main>

<?php include 'default/footer.php'; ?>

<script src="../javascript/default.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

</body>
</html>