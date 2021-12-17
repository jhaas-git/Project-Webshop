<?php
// Insert a product into the users' bag.
function insertBag() {
    require 'config/connect.php';
    session_start();

    $product = filter_input(INPUT_GET, 'idProduct');

    // Make sure the user trying to add a product to the bag is logged in.
    if ($_SESSION['signedin'] == 'true') {
        $insertProductBag = 'INSERT INTO cart (account_idAccount, product_idProduct)
        VALUES (:user, :product)';

        $stmt = $pdo->prepare($insertProductBag);
        $stmt->execute([
            ':user' => $_SESSION['idAccount'],
            ':product' => $product
        ]);

        // Redirect the user back to the products page. 
        // This refresh will show an amount of products next to their bag.
        header("location: template/product.php?idProduct=$product");
    } else {
        echo 'Can not do that mate';
    }
}

// Display the amount of items inside the users' bag.
function countBag() {
    require 'config/connect.php';
    session_start();

    // Fetch (and count) all items that are in the cart table, related to the signed in user.
    $stmt = $pdo->prepare('SELECT count(*) FROM cart WHERE account_idAccount =:user');
    $stmt->execute([
        ':user' => $_SESSION['idAccount']
    ]);
    $amountBag = $stmt->fetchColumn();
    return $amountBag; // Echo result inside the header.
}

// Display the items inside the users' cart.
function showCart() {
    require 'config/connect.php';

    session_start();

    // Fetch all products inside a cart from the signed in user.
    $fetchItems = 'SELECT cart.account_idAccount, cart.product_idProduct, product.sModelName, product.sReferential, product.sWatchMedia, product.dPrice 
    FROM cart
    JOIN product
    ON cart.product_idProduct = product.idProduct
    WHERE cart.account_idAccount =:user';

    $stmt = $pdo->prepare($fetchItems);
    $stmt->execute([
        ':user' => $_SESSION['idAccount']
    ]);

    // If any results exist, display the items on cart.php
    if ($stmt->rowCount() > 0) {
        $cartItem = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Runs a query to show the signed in users' total price.
        $totalPrice = displayTotal();

        foreach ($cartItem as $item) {
            echo '
            <div class="cart-results-container">
                <div class="cart-results-grid">
                    <div class="cart-information image"><img src="'. $item['sWatchMedia'] .'" alt=""></div>
                    <div class="cart-information model">'. $item['sModelName'] .'</div>
                    <div class="cart-information referential">'. $item['sReferential'] .'</div>
                    <div class="cart-information remove"><a href="../index.php?orderFunc=2&idProduct='. $item['product_idProduct'] .'&delete=single">remove</a></div>
                    <div class="cart-information price">€ '. $item['dPrice'] .'</div>
                </div>
            </div>';
        }
        echo '
        <div class="cart-actions-container">
            <div class="cart-actions-grid">
                <div class="cart-action empty"><a href="../index.php?orderFunc=2&delete=multi">empty cart</a></div>
                <div class="cart-action total">Total: <span>€ '. $totalPrice .'</span></div>
                <div class="cart-action order"><button class="orderButton">Place order</button></div>
            </div>
        </div>';
    } else {
        echo 'Your cart is empty.';
    }
}

// Deleting one or more items from the users' cart.
function deleteProductCart() {
    require 'config/connect.php';
    session_start();

    $idProduct = filter_input(INPUT_GET, 'idProduct');

    // Removing a single item placed inside the cart.
    if ($_GET['delete'] == 'single') {
        // Deleting a specific product from the signed in persons' cart.
        $deleteSingle = 'DELETE FROM cart 
        WHERE product_idProduct =:product
        AND account_idAccount =:user';

        $stmt = $pdo->prepare($deleteSingle);
        $stmt->execute([
            ':product' => $idProduct,
            ':user' => $_SESSION['idAccount']
        ]);

        header("location: template/cart.php");
    } elseif ($_GET['delete'] == 'multi') {
        // Deleting all products from the signed in persons' cart.
        $deleteAll = 'DELETE FROM cart 
        WHERE account_idAccount =:user';

        $stmt = $pdo->prepare($deleteAll);
        $stmt->execute([
            ':user' => $_SESSION['idAccount']
        ]);

        header("location: template/cart.php");
    }
}

// Display the total price from the users' cart.
// Function will be used inside showCart().
function displayTotal() {
    require 'config/connect.php';
    session_start();

    $fetchTotal = 'SELECT SUM(product.dPrice) 
    AS totalPrice
    FROM cart
    INNER JOIN product
    ON cart.product_idProduct = product.idProduct
    WHERE cart.account_idAccount =:user';
    $stmt = $pdo->prepare($fetchTotal);

    $stmt->execute([
        ':user' => $_SESSION['idAccount']
    ]);

    $totalPrice = $stmt->fetchColumn();
    return $totalPrice; // Echo total on cart.php.
}
?>
