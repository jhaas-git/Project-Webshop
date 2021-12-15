<?php
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

function insertCollection() {
    require 'model/config/connect.php';
    session_start();
    
    $collectionName = $_POST['collection'];
    $collectionDescription = $_POST['description'];
    $collectionImage = $_POST['image'];

    // Fetch collections to check if submitted collection already exists.
    $checkCollection = "SELECT * FROM collection WHERE sCollection =:collectionName";
    $stmt = $pdo->prepare($checkCollection);
    $stmt->execute([
        ':collectionName' => $collectionName
    ]);

    // Insert the new collection when none exists yet.
    if ($stmt->rowCount() == 0) {
        $insertCollection = "INSERT INTO collection (sCollection, tDescription, sCollectionMedia)
        VALUES (:collection, :description, :image)";
    
        $stmt = $pdo->prepare($insertCollection);
        $stmt->execute([
            ':collection' => $collectionName,
            ':description' => $collectionDescription,
            ':image' => $collectionImage
        ]);

        // When a new collection was inserted, a success message will be displayed.
        header("location: template/profile.php?insertCollection=successful");
    } else {
        header("location: template/profile.php?insertCollection=failed");
    }
    $pdo=null;
}

function insertMovement() {
    require 'model/config/connect.php';
    session_start();
    
    $calibreName = $_POST['calibre'];
    $mechanism = $_POST['mechanism'];
    $numOfParts = $_POST['parts'];
    $calibreImage = $_POST['image'];
    $powerReserve = $_POST['power'];
    $functionality = $_POST['function'];

    // Fetch movements to check if submitted calibre already exists.
    $checkMovement = "SELECT * FROM movement WHERE sCalibre =:calibre";
    $stmt = $pdo->prepare($checkMovement);
    $stmt->execute([
        ':calibre' => $calibreName
    ]);

    // Insert the new movement when none exists yet.
    if ($stmt->rowCount() == 0) {
        $insertMovement = "INSERT INTO movement (sCalibre, sFunction, sMechanism, sPowerReserve, iNumOfParts, sCalibreMedia)
        VALUES (:calibre, :function, :mechanism, :powerreserve, :parts, :image)";
    
        $stmt = $pdo->prepare($insertMovement);
        $stmt->execute([
            ':calibre' => $calibreName,
            ':function' => $functionality,
            ':mechanism' => $mechanism,
            ':powerreserve' => $powerReserve,
            ':parts' => $numOfParts,
            ':image' => $calibreImage
        ]);

        // When a new movement was inserted, a success message will be displayed.
        header("location: template/profile.php?insertMovement=successful");
    } else {
        header("location: template/profile.php?insertMovement=failed");
    }
    $pdo=null;
}

function insertWatch() {
    require 'model/config/connect.php';
    session_start();

    $collectionName = $_POST['collection'];
    $modelName = $_POST['model'];
    $referentialNum = $_POST['referential'];
    $movementName = $_POST['movement'];
    $watchImage = $_POST['watch'];
    $price = $_POST['price'];
    $caseMaterial = $_POST['material'];
    $caseIPX = $_POST['ipx'];
    $caseThickness = $_POST['thickness'];
    $caseSize = $_POST['size'];
    $caseImage = $_POST['case'];

    // Fetch watches to check if submitted watch already exists.
    $checkWatch = 'SELECT * FROM product WHERE sReferential =:ref';
    $stmt = $pdo->prepare($checkWatch);
    $stmt->execute([
        ':ref' => $referentialNum
    ]);

    if ($stmt->rowCount() == 0) {
        $insertWatch = 'INSERT INTO product (sModelName, sReferential, sCaseMaterial, sCaseIPX, sCaseThickness, sCaseSize, dPrice, sWatchMedia, sCaseMedia, movement_idMovement, collection_idCollection) 
        VALUES (:model, :ref, :material, :ipx, :thickness, :size, :price, :watch, :case, :movement, :collection)';
        
        $stmt = $pdo->prepare($insertWatch);
        $stmt->execute([
            ':model' => $modelName,
            ':ref' => $referentialNum,
            ':material' => $caseMaterial,
            ':ipx' => $caseIPX,
            ':thickness' => $caseThickness,
            ':size' => $caseSize,
            ':price' => $price,
            ':watch' => $watchImage,
            ':case' => $caseImage,
            ':movement' => $movementName,
            ':collection' => $collectionName
        ]);

        // When a new watch was inserted, a success message will be displayed.
        header("location: template/profile.php?insertWatch=successful");
    } else {
        header("location: template/profile.php?insertWatch=failed");
    }
    $pdo=null;
}

function fetchMovements() {
    require '../model/config/connect.php';

    $selectMovement = $pdo->query('SELECT idMovement, sCalibre FROM movement');

    // Make a select option for every movement that's inside the database.
    foreach ($selectMovement as $movement) {
        echo '<option value='. $movement['idMovement'] .'>'. $movement['sCalibre'] .'</option>';
    }
    $pdo=null;
}

function fetchCollection() {
    require '../model/config/connect.php';

    $selectCollection = $pdo->query('SELECT idCollection, sCollection FROM collection');

    // Make a select option for every collection that's inside the database.
    foreach ($selectCollection as $collection) {
        echo '<option value='. $collection['idCollection'] .'>'. $collection['sCollection'] .'</option>';
    }
    $pdo=null;
}

function editProduct() {
    require 'model/config/connect.php';
    session_start();
    
    // Assign the product id taken from the URL.
    $product = filter_input(INPUT_GET, 'idProduct');
    $collectionName = $_POST['collection'];
    $modelName = $_POST['model'];
    $referentialNum = $_POST['referential'];
    $movementName = $_POST['movement'];
    $watchImage = $_POST['watch'];
    $price = $_POST['price'];
    $caseMaterial = $_POST['material'];
    $caseIPX = $_POST['ipx'];
    $caseThickness = $_POST['thickness'];
    $caseSize = $_POST['size'];
    $caseImage = $_POST['case'];
        
    // Updating any of the fields, values will be assigned to above variables during execution.
    $updateProductInformation = 'UPDATE product
    SET sModelName = :model, sReferential = :ref, sCaseMaterial = :material, sCaseIPX = :ipx, 
    sCaseThickness = :thickness, sCaseSize = :size, dPrice = :price, sWatchMedia = :watch,
    sCaseMedia = :case, movement_idMovement = :movement, collection_idCollection = :collection
    WHERE idProduct =:idProduct';
        
    $stmt = $pdo->prepare($updateProductInformation);
    $stmt->execute([
        ':idProduct' => $product,
        ':model' => $modelName,
        ':ref' => $referentialNum,
        ':material' => $caseMaterial,
        ':ipx' => $caseIPX,
        ':thickness' => $caseThickness,
        ':size' => $caseSize,
        ':price' => $price,
        ':watch' => $watchImage,
        ':case' => $caseImage,
        ':movement' => $movementName,
        ':collection' => $collectionName
    ]);
            
    header("Location: template/product.php?idProduct=$product&editWatch=successful");   
}

function fetchCollectionFilter() {
    require '../model/config/connect.php';

    $selectFilterOption = 'SELECT DISTINCT(collection_idCollection), sCollection FROM product
    JOIN collection
    ON collection_idCollection = idCollection';
    $stmt = $pdo->prepare($selectFilterOption);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $filterValue) {
        echo '<li><label><input type="checkbox" class="common_selector collection" value="'. $filterValue['collection_idCollection'] .'" > '. $filterValue['sCollection'] .'</label></li>';
    }
}

function fetchCalibreFilter() {
    require '../model/config/connect.php';

    $selectFilterOption = 'SELECT DISTINCT(movement_idMovement), sCalibre FROM product
    INNER JOIN movement
    ON product.movement_idMovement = movement.idMovement';
    $stmt = $pdo->prepare($selectFilterOption);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $filterValue) {
        echo '<li><label><input type="checkbox" class="common_selector calibre" value="'. $filterValue['movement_idMovement'] .'" > '. $filterValue['sCalibre'] .'</label></li>';
    }
}

function fetchMaterialFilter() {
    require '../model/config/connect.php';

    $selectFilterOption = 'SELECT DISTINCT(sCaseMaterial) FROM product';
    $stmt = $pdo->prepare($selectFilterOption);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $filterValue) {
        echo '<li><label><input type="checkbox" class="common_selector material" value="'. $filterValue['sCaseMaterial'] .'" > '. $filterValue['sCaseMaterial'] .'</label></li>';
    }
}

function fetchSizeFilter() {
    require '../model/config/connect.php';

    $selectFilterOption = 'SELECT DISTINCT(sCaseSize) FROM product';
    $stmt = $pdo->prepare($selectFilterOption);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $filterValue) {
        echo '<li><label><input type="checkbox" class="common_selector size" value="'. $filterValue['sCaseSize'] .'" > '. $filterValue['sCaseSize'] .'</label></li>';
    }
}

function displayProducts() {
    include('config/connect.php');

    if(isset($_POST['action'])){
        // Select to fetch all watches
        $fetchProducts = 'SELECT * FROM product 
        INNER JOIN collection
        ON collection_idCollection = idCollection
        INNER JOIN movement
        ON movement_idMovement = idMovement
        WHERE idProduct > 0';
    
        if(isset($_POST['collection'])){
            $collection_filter = implode('","', $_POST['collection']);
            $fetchProducts .= '
            AND collection_idCollection IN("'.$collection_filter.'")';
        }
        if(isset($_POST['calibre'])){
            $calibre_filter = implode('","', $_POST['calibre']);
            $fetchProducts .= '
            AND movement_idMovement IN("'.$calibre_filter.'")';
        }
        if(isset($_POST['material'])){
            $material_filter = implode('","', $_POST['material']);
            $fetchProducts .= ' 
            AND sCaseMaterial IN("'.$material_filter.'")';
        }
        if(isset($_POST['size'])){
            $size_filter = implode('","', $_POST['size']);
            $fetchProducts .= ' 
            AND sCaseSize IN("'.$size_filter.'")';
        }

        $statement = $pdo->prepare($fetchProducts);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_products = $statement->rowCount();
        $products = ''; // will be filled with (if statement below) either the results or echo that no products are found.

        if ($total_products > 0) {
            foreach ($result as $row) {
                $products .= '
                <div class="product-display">
                <a href="product.php?idProduct='. $row['idProduct'] .'">
                    <div class="product-image">
                    <img src="'. $row["sWatchMedia"] .'"></div>
                    <div class="product-values">
                        <ul>
                            <li id="model-name">'. $row["sModelName"] .'</li>
                            <li id="model-price">€ '. $row["dPrice"] .'</li>
                        </ul>
                    </div>
                </a>
                </div>';
            }
        } else {
            $products = '<p class="noResult">No products found.</p>';
        }
        echo $products;    
    }
}
?>