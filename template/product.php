<?php 

include '../model/config/connect.php';
include '../model/config/includes.php';
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
    <link rel="stylesheet" href="../design/default/message.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/product.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title><?php echo $productResult['sReferential'] ?> | Audemars Piguet</title>
</head>
<body>
    <?php if ($_GET['editWatch'] == 'successful') {
        echo '
        <div class="message-box" id="success">
            <div class="message-content">
                <p class="message">Product successfully updated.</p>
                <a href="product.php?idProduct='. $productResult['idProduct'] .'" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif ($_GET['insertBag'] == 'failed') {
        echo '
        <div class="message-box" id="failed">
            <div class="message-content">
                <p class="message">User must be signed in.</p>
                <a href="product.php?idProduct='. $productResult['idProduct'] .'" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    }
    ?>

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
                <div class="information-header-left"><p class="model"><?php echo $productResult['sModelName'] ?></p><p class="ref"><?php echo $productResult['sReferential'] ?></p></div>
                <?php 
                // Employees are able to edit or delete a product.
                if ($_SESSION['role_idRole'] == 1) {
                    if ($_GET['editProduct'] || $_GET['deleteProduct'] == 'true') {
                        echo ' <div class="information-header-right"><a href="product.php?idProduct='. $productResult['idProduct'] .'" id="cancel">Cancel</a></div> ';
                    } else {
                        echo '
                        <div class="information-header-right">
                            <a href="product.php?idProduct='. $productResult['idProduct'] .'&editProduct=true" class="bi bi-pencil editButton"></a>
                            <a href="product.php?idProduct='. $productResult['idProduct'] .'&deleteProduct=true" class="bi bi-trash deleteButton"></a>
                        </div>';
                    }
                } else {
                    // Customers will be seeing the price.
                    echo ' <div class="information-header-right"><p class="price"><span>€</span> '. $productResult['dPrice'] .'</p></div> ';
                }
                ?>
            </div>

            <!-- Echo the update state only when the users' role is 1. -->
            <?php if ($_SESSION['role_idRole'] == 1 && $_GET['editProduct'] == 'true') {
                echo '
                <form action="../index.php?productFunc=4&idProduct='. $productResult['idProduct'] .'" method="post">
                    <div class="edit-body">
                        <div class="body-content">
                            <div class="content-row" id="half">
                                <div class="input-container"><label class="title">Collection *</label><select class="editInput" name="collection" required>'; fetchCollection(); echo '</select></div>
                                <div class="input-container"><label class="title">Model Name *</label><input class="editInput" type="text" value="'. $productResult['sModelName'] .'" name="model" required></div>
                            </div>
                            <div class="content-row">
                                <div class="input-container"><label class="title">Referential number *</label><input class="editInput" type="text" value="'. $productResult['sReferential'] .'" name="referential" required></div>
                                <div class="input-container"><label class="title">Movement *</label><select class="editInput" name="movement" required>'; fetchMovements(); echo '</select></div>
                                <div class="input-container"><label class="title">Watch image *</label><input class="editInput" type="text" value="'. $productResult['sWatchMedia'] .'" name="watch" required></div>
                                <div class="input-container"><label class="title">Price *</label><input class="editInput" type="text" value="'. $productResult['dPrice'] .'" name="price" required></div>
                            </div>
                        </div>
                        <div class="body-content">
                            <div class="content-row">
                                <div class="input-container"><label class="title">Case Material *</label><input class="editInput" type="text" value="'. $productResult['sCaseMaterial'] .'" name="material"></div>
                                <div class="input-container"><label class="title">Case IPX *</label><input class="editInput" type="text" value="'. $productResult['sCaseIPX'] .'" name="ipx"></div>
                            </div>
                            <div class="content-row" id="half">
                                <div class="input-container"><label class="title">Case Thickness *</label><input class="editInput" type="text" value="'. $productResult['sCaseThickness'] .'" name="thickness"></div>
                                <div class="input-container"><label class="title">Case Size *</label><input class="editInput" type="text" value="'. $productResult['sCaseSize'] .'" name="size"></div>
                            </div>
                            <div class="content-row"><div class="input-container"><label class="title">Case image</label><input class="editInput" type="text" value="'. $productResult['sCaseMedia'] .'" name="case" required></div></div>
                        </div>
                    </div>
                    <div class="information-footer"><button type="submit" class="bagButton">Update product</button></div>
                </form>';
            } elseif ($_SESSION['role_idRole'] == 1 && $_GET['deleteProduct'] == 'true') {
                echo '
                <form action="../index.php?productFunc=6&idProduct='. $productResult['idProduct'] .'" method="post">
                <div class="delete-body">
                    <div class="body-content">
                        <img src="'. $productResult['sWatchMedia'] .'" alt="case_image">
                        <p>Confirm before deletion<br><span class="ref">'. $productResult['sReferential'] .'</span></p>
                    </div>
                </div>
                <div class="information-footer"><button type="submit" class="bagButton">Confirm deletion</button></div>
                </form>
                ';
            } else {
                echo '
                <div class="information-body">
                <div class="main-carousel">
                    <div class="information-cell">
                        <div class="information-cell-left"><div class="information-image"><img src="'. $productResult['sCaseMedia'] .'" alt="case_image"></div></div>
                        <div class="information-cell-right">
                            <div class="information-specs">
                                <div class="information-specs-left">
                                <p class="spec-title">Material</p>
                                    <p class="spec-value">'. $productResult['sCaseMaterial'] .'</p>
                                    <p class="spec-title">Water resistance</p>
                                    <p class="spec-value">'. $productResult['sCaseIPX'] .'</p>
                                </div>
                                <div class="information-specs-right">
                                    <p class="spec-title">Thickness</p>
                                    <p class="spec-value">'. $productResult['sCaseThickness'] .'</p>
                                    <p class="spec-title">Size</p>
                                    <p class="spec-value">'. $productResult['sCaseSize'] .'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="information-cell">
                        <div class="information-cell-left"><div class="information-image"><img src="'. $productResult['sCalibreMedia'] .'" alt="calibre_image"></div></div>
                        <div class="information-cell-right">
                            <div class="information-specs">
                                <div class="information-specs-left">
                                    <p class="spec-title">Mechanism</p>
                                    <p class="spec-value">'. $productResult['sMechanism'] .'</p>
                                    <p class="spec-title">Function</p>
                                    <p class="spec-value">'. $productResult['sFunction'] .'</p>
                                </div>
                                <div class="information-specs-right">
                                    <p class="spec-title">Power reserve</p>
                                    <p class="spec-value">'. $productResult['sPowerReserve'] .'</p>
                                    <p class="spec-title">Number of parts</p>
                                    <p class="spec-value">'. $productResult['iNumOfParts'] .'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="information-footer"><a href="../index.php?orderFunc=1&idProduct='. $productResult['idProduct'] .'"><button class="bi bi-bag bagButton"> Place in bag</button></a></div>';
            } ?>
        </div>
        </section>
    </main>

    <?php include 'default/footer.php'; ?>

    <script src="../javascript/default.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="../javascript/carousel.js"></script>

</body>
</html>