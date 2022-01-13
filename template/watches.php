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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../design/default/message.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/watches.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title>Our watches | Audemars Piguet</title>
</head>
<body>

<?php 
    if (isset($_GET['deleteProduct']) && $_GET['deleteProduct'] == 'successful') {
        echo '
        <div class="message-box" id="success">
            <div class="message-content">
                <p class="message">Product successfully deleted.</p>
                <a href="watches.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif (isset($_GET['deleteProduct']) && $_GET['deleteProduct'] == 'failed') {
        echo '
        <div class="message-box" id="failed">
            <div class="message-content">
                <p class="message">Product could not be deleted.</p>
                <a href="watches.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif (isset($_GET['insertCollection']) && $_GET['insertCollection'] == 'successful') {
        echo '
        <div class="message-box" id="success">
            <div class="message-content">
                <p class="message">Collection successfully inserted.</p>
                <a href="profile.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif (isset($_GET['insertCollection']) && $_GET['insertCollection'] == 'failed') {
        echo '
        <div class="message-box" id="failed">
            <div class="message-content">
                <p class="message">Collection already exists.</p>
                <a href="profile.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif (isset($_GET['insertMovement']) && $_GET['insertMovement'] == 'successful') {
        echo '
        <div class="message-box" id="success">
            <div class="message-content">
                <p class="message">Movement successfully inserted.</p>
                <a href="profile.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif (isset($_GET['insertMovement']) && $_GET['insertMovement'] == 'failed') {
        echo '
        <div class="message-box" id="failed">
            <div class="message-content">
                <p class="message">Movement already exists.</p>
                <a href="profile.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif (isset($_GET['insertWatch']) && $_GET['insertWatch'] == 'successful') {
        echo '
        <div class="message-box" id="success">
            <div class="message-content">
                <p class="message">Watch successfully inserted.</p>
                <a href="profile.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    } elseif (isset($_GET['insertWatch']) && $_GET['insertWatch'] == 'failed') {
        echo '
        <div class="message-box" id="failed">
            <div class="message-content">
                <p class="message">Watch already exists.</p>
                <a href="profile.php" class="close-message bi bi-x-lg"></a>
            </div>
        </div>';
    }
?>

<?php include 'default/header.php'; ?>

<main>
<?php if ($_SESSION['role_idRole'] == 1) {
echo '
<section class="product-action-section">
    <div class="product-action-container">
        <div class="product-action-header">
            <div class="header-title">'; ?><?php if (isset($_GET['insertCollection'])) {
                echo '<p>Insert collection</p>';
            } elseif (isset($_GET['insertMovement'])) {
                echo '<p>Insert movement</p>';
            } else {
                echo '<p>Insert watch</p>';
            } ?></div>
            <div class="header-actions"><?php if (isset($_GET['insertCollection'])) {
                echo '<a href="watches.php" id="insert">Watch</a>
                <a href="watches.php?insertMovement=true" id="insert">Movement</a>';
            } elseif (isset($_GET['insertMovement'])) {
                echo '<a href="watches.php" id="insert">Watch</a>
                <a href="watches.php?insertCollection=true" id="insert">Collection</a>';
            } else {
                echo '<a href="watches.php?insertCollection=true" id="insert">Collection</a>
                <a href="watches.php?insertMovement=true" id="insert">Movement</a>';
            } ?></div>
        </div>
        <div class="product-action-body">
            <?php if (isset($_GET['insertCollection']) && $_GET['insertCollection'] == 'true') {
                echo '
                <div class="body-content">
                <form action="../index.php?productFunc=1" method="post">
                    <div class="body-row" id="double">
                        <div class="body-input"><label class="value">Collection *</label><input class="insertInput" type="text" name="collection" required></div>
                        <div class="body-input"><label class="value">Description *</label><input class="insertInput" type="text" name="description" required></div>
                    </div>
                </div>
                <div class="body-content">
                    <div class="body-row">
                        <div class="body-input"><label class="value">Collection image *</label><input class="insertInput" type="text" name="image" required></div>
                    </div>
                </div>
                <div class="product-action-footer"><button type="submit" class="submitButton">Insert collection</button></div>
                </form>';
            } elseif (isset($_GET['insertMovement']) && $_GET['insertMovement'] == 'true') {
                echo '
                <div class="body-content">
                <form action="../index.php?productFunc=2" method="post">
                    <div class="body-row" id="double">
                        <div class="body-input"><label class="value">Calibre *</label><input class="insertInput" type="text" name="calibre" required></div>
                        <div class="body-input"><label class="value">Amount of Parts *</label><input class="insertInput" type="number" name="parts" required></div>
                    </div>
                    <div class="body-row">
                        <div class="body-input"><label class="value">Power Reserve *</label><input class="insertInput" type="text" name="power" required></div>
                        <div class="body-input"><label class="value">Mechanism *</label><input class="insertInput" type="text" name="mechanism" required></div>
                    </div>
                </div>
                <div class="body-content">
                    <div class="body-row">
                        <div class="body-input"><label class="value">Function *</label><input class="insertInput" type="text" name="function" required></div>
                        <div class="body-input"><label class="value">Calibre image *</label><input class="insertInput" type="text" name="image" required></div>
                    </div>
                </div>
                <div class="product-action-footer"><button type="submit" class="submitButton">Insert movement</button></div>
                </form>';
            } else {
                echo '
                <div class="body-content">
                <form action="../index.php?productFunc=3" method="post">
                    <div class="body-row" id="double">
                        <div class="body-input"><label class="value">Model Name *</label><input class="insertInput" type="text" name="model" required></div>
                        <div class="body-input"><label class="value">Collection *</label><select class="insertInput" name="collection" required>'; fetchCollection(); echo '</select></div>
                    </div>
                    <div class="body-row">
                        <div class="body-input"><label class="value">Ref *</label><input class="insertInput" type="text" name="referential" required></div>
                        <div class="input-container"><label class="value">Movement *</label><select class="insertInput" name="movement" required>'; fetchMovements(); echo '</select></div>
                        <div class="body-input"><label class="value">Watch image</label><input class="insertInput" type="text" name="watch" required></div>
                        <div class="body-input"><label class="value">Price *</label><input class="insertInput" type="text" name="price"></div>
                    </div>
                </div>
                <div class="body-content">
                    <div class="body-row">
                        <div class="body-input"><label class="value">Case IPX *</label><input class="insertInput" type="text" name="ipx"></div>
                        <div class="body-input"><label class="value">Material *</label><input class="insertInput" type="text" name="material"></div>
                    </div>
                    <div class="body-row" id="double">
                        <div class="body-input"><label class="value">Case Thickness *</label><input class="insertInput" type="text" name="thickness"></div>
                        <div class="body-input"><label class="value">Case Size *</label><input class="insertInput" type="text" name="size"></div>
                    </div>
                    <div class="body-row">
                        <div class="body-input"><label class="value">Case image</label><input class="insertInput" type="text" name="case" required></div>
                    </div>
                </div>
                <div class="product-action-footer"><button type="submit" class="submitButton">Insert product</button></div>
                </form>';
            } ?> <?php echo '
        </div>
    </div>
</section>
'; } ?>

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
                            <ul>
                                <?php fetchCollectionFilter() ?>
                            </ul>
                        </div>
                    </div>
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Calibre</p></div>
                        <div class="subject-content">
                            <ul>
                                <?php fetchCalibreFilter() ?>
                            </ul>
                        </div>
                    </div>
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Material</p></div>
                        <div class="subject-content">
                            <ul>
                                <?php fetchMaterialFilter() ?>
                            </ul>
                        </div>
                    </div>
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Size</p></div>
                        <div class="subject-content">
                            <ul>
                                <?php fetchSizeFilter() ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<section class="watch-results-section">
    <div class="watch-results-container filter_data">
        <script>
            $(document).ready(function(){
                filter_data();

                function filter_data(){
                    $('.filter_data').html('<div id="loading"></div>');
                    var action = 'fetch_data';
                    // create a variable to know which value is filtered.
                    var collection = get_filter('collection');
                    var calibre = get_filter('calibre');
                    var material = get_filter('material');
                    var size = get_filter('size');

                    $.ajax({
                        url:'../index.php?productFunc=5',
                        method:'post',
                        // Simply add a variable and post values together.
                        data:{action:action, collection:collection, calibre:calibre, material:material, size:size},
                        success:function(data){
                            $('.filter_data').html(data);
                        }
                    });
                }

                function get_filter(class_name){
                    var filter = [];
                    $('.'+class_name+':checked').each(function(){
                        filter.push($(this).val());
                    });
                    return filter;
                }

                $('.common_selector').click(function(){
                    filter_data();
                });
            });
        </script>
    </div>
</section>

</main>

<?php include 'default/footer.php'; ?>

<script src="../javascript/default.js"></script>
<script src="../javascript/filter.js"></script>

</body>
</html>