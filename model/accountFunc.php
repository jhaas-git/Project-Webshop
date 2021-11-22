<?php 
function registerAccount(){
    require 'model/config/connect.php';

    // Assign variables to the post values.
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $mail = $_POST['mailaddress'];
    $pass = $_POST['pass'];
    $hash = hash('sha256', $pass); // Hashing password.

    // Fetch users to check if email already exists.
    $checkMail = "SELECT * FROM account WHERE sMailAddress =:mail";
    $stmt = $pdo->prepare($checkMail);
    $stmt->execute([
        ':mail' => $mail
    ]);

    // If no results exist,
    if ($stmt->rowCount() == 0) {
    // Register the users' account.
    $registerAccount = "INSERT INTO account (sFirstName, sLastName, sMailAddress, sPassword, role_idRole)
    VALUES (:firstname, :lastname, :mail, :pass, :role)";

    $stmt = $pdo->prepare($registerAccount);
    $stmt->execute([
        ':firstname' => $fname,
        ':lastname' => $lname,
        ':mail' => $mail,
        ':pass' => $hash,
        ':role' => 2 // idRole 2 defines a regular user.
    ]);

    // When a new account was inserted, a success message will be displayed.
    header("location: template/account.php?registration=successful");

    } else {
        // If the account couldn't be created, an error will be displayed.
        header("location: template/account.php?registration=failed");
    }
}
?>