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
    }
}

?>