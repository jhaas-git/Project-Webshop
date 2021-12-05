<?php 

if (isset($_GET['accountFunc'])) {
    include 'model/accountFunc.php';

    switch ($_GET['accountFunc']) {
        case 1:registerAccount();
        break;
        case 2:authenticateAccount();
        break;
        case 3:editProfileInformation();
        break;
        case 4:accountSignOut();
        break;
        case 5:changePassword();
        break;
    }
} elseif (isset($_GET['productFunc'])) {
    include 'model/productFunc.php';

    switch ($_GET['productFunc']) {
        case 1:insertCollection();
        break;
        case 2:insertMovement();
        break;
        case 3:insertWatch();
        break;
    }
}

?>