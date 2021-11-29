<?php
function fetchProducts(){
    require 'config/connect.php';

    // Get watch information and order them by collection.
    // Ordering by collection makes it easier to search.
    $selectProducts = $pdo->query('SELECT idProduct, sModelName, dPrice, sWatchMedia FROM product ORDER BY product.collection_idCollection ASC;');

    foreach ($selectProducts as $productInfo) {
        echo ' 
        <div class="product-display">
        <a href="product.php?idProduct='. $productInfo['idProduct'] .'">
            <div class="product-image">
            <img src="'. $productInfo["sWatchMedia"] .'"></div>
            <div class="product-values">
                <ul>
                    <li id="model-name">'. $productInfo["sModelName"] .'</li>
                    <li id="model-price">'. $productInfo["dPrice"] .'</li>
                </ul>
            </div>
        </a>
        </div>';
    }
    $pdo=null;
}

function fetchWatchInformation(){
    require 'config/connect.php';

    $selectWatchInformation = 'SELECT idProduct, sModelName, sReferential, sCaseMaterial, sCaseIPX, sCaseThickness, sCaseSize, dPrice,
    sWatchMedia, sCaseMedia, idCollection, sCollection, idMovement, sFunction, sMechanism, sPowerReserve, iNumOfParts, sCalibreMedia 
    FROM product
    INNER JOIN collection
    ON product.collection_idCollection = collection.idCollection
    INNER JOIN movement
    ON product.movement_idMovement = movement.idMovement
    WHERE product.idProduct =:idProduct
    AND product.collection_idCollection = collection.idCollection
    AND product.movement_idMovement = movement.idMovement';

    $statement = $pdo->prepare($selectWatchInformation);
    $statement->execute([
        ':idProduct' => $_GET['idProduct']
    ]);

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $pdo=null;
    return $row;
}
?>