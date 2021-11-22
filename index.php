<?php 

if (isset($_GET['accountFunc'])) {
    include 'model/accountFunc.php';

    switch ($_GET['accountFunc']) {
        case 1:registerAccount();
        break;
    }
}

?>