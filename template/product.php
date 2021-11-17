<!-- SELECT * FROM watches
INNER JOIN collections
ON watches.collections_idCollection = collections.idCollection
INNER JOIN movements
ON watches.movements_idMovement = movements.idMovement
WHERE watches.movements_idMovement = movements.idMovement
AND watches.collections_idCollection = collections.idCollection; -->

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
    <title>echo modelname | Audemars Piguet</title>
</head>
<body>
    
<?php include 'default/header.php'; ?>

<main>

<section class="collection-section">
    <div class="collection-container">
        <div class="collection-container-left"><p class="title">discover <br> <span class="collection reveal">royal oak</span></p></div>
        <div class="collection-container-right"><img src="../media/test/watch.png" alt=""></div>
    </div>
</section>

<section class="information-section">
    <div class="information-container">
        <div class="information-header">
            <div class="information-header-left">
                <p class="model">Minute Repeater Supersonnerie</p>
                <p class="ref">Ref. 26591TI.OO.1252TI.02</p>
            </div>
            <div class="information-header-right">
                <a href="#" class="bi bi-pencil editButton"></a>
                <a href="#" class="bi bi-trash deleteButton"></a>
            </div>
        </div>

        <div class="information-body">
            <div class="main-carousel" data-flickity='{"contain": true, "wrapAround": true, "autoPlay": 7000}'>
                <div class="information-cell">
                    <div class="information-cell-left"><div class="information-image"><img src="../media/test/case.png" alt=""></div></div>
                    <div class="information-cell-right">
                        <div class="information-specs">
                            <div class="information-specs-left">
                                <p class="spec-title">Material</p>
                                <p class="spec-value">Titanium</p>
                                <p class="spec-title">Water resistance</p>
                                <p class="spec-value">20 metres</p>
                            </div>
                            <div class="information-specs-right">
                                <p class="spec-title">Thickness</p>
                                <p class="spec-value">14 mm</p>
                                <p class="spec-title">Size</p>
                                <p class="spec-value">42 mm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="information-cell">
                    <div class="information-cell-left"><div class="information-image"><img src="../media/test/calibre.png" alt=""></div></div>
                    <div class="information-cell-right">
                        <div class="information-specs">
                            <div class="information-specs-left">
                                <p class="spec-title">Mechanism</p>
                                <p class="spec-value">Selfwinding</p>
                                <p class="spec-title">Frequency</p>
                                <p class="spec-value">3hz 21600 vph</p>
                            </div>
                            <div class="information-specs-right">
                                <p class="spec-title">Power reserve</p>
                                <p class="spec-value">72 hours</p>
                                <p class="spec-title">Number of parts</p>
                                <p class="spec-value">362</p>
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