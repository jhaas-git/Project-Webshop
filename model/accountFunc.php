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

function authenticateAccount(){
    require 'model/config/connect.php';

    session_start();

    $mail = $_POST['mailaddress'];
    $pass = $_POST['pass'];
    $hash = hash('sha256', $pass);

    // Fetch account details where mail address matches the submitted mail value.
    $authenticateAccount = "SELECT idAccount, sFirstName, sPassword, role_idRole 
    FROM account WHERE sMailAddress =:mail";

    $stmt = $pdo->prepare($authenticateAccount);
    $result = $stmt->execute([
        ':mail' => $mail
    ]);

    if ($stmt->rowCount() == 1){
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        // Make sure the submitted value equals the stored password value.
        if($hash == $account['sPassword']){
            $_SESSION['signedin'] = TRUE;
            $_SESSION['idAccount'] = $account['idAccount'];
            $_SESSION['sFirstName'] = $account['sFirstName'];
            $_SESSION['role_idRole'] = $account['role_idRole'];

            header("Location: template/profile.php");
            // Redirect below might be useful later.
            // header("Location: template/profile.php?user=". $account['idAccount'] ."");
        } else {
            // When the submitted value doesn't equal the stored password value,
            // Redirect the user to the account.php page displaying an error.
            header("Location: template/account.php?authentication=failed");
        }
    }
}

function fetchProfileInformation(){
    require 'config/connect.php';

    // Select the relevant information about the user. This will be displayed on the profile page.
    $selectProfileInformation = 'SELECT sFirstName, sLastName, dDateOfBirth, sCity, sStreetName, iHouseNumber, sPostalCode, sMailAddress
    FROM account
    WHERE idAccount =:idAccount';

    $statement = $pdo->prepare($selectProfileInformation);
    $statement->execute([
        ':idAccount' => $_SESSION['idAccount']
    ]);

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $pdo=null;
    return $row;
}

function editProfileInformation(){
    require 'model/config/connect.php';

    session_start();

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $birthday = $_POST['birthdate'];
    $mail = $_POST['mailaddress'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $number = $_POST['housenumber'];
    $postalcode = $_POST['postal'];

    // Updating any of the fields, values will be assigned to above variables during execution.
    $updateProfileInformation = 'UPDATE account
    SET sFirstName = :firstname, sLastName = :lastname, dDateOfBirth = :birthdate, sCity = :city, 
    sStreetName = :street, iHouseNumber = :number, sPostalCode = :postal, sMailAddress = :mail
    WHERE idAccount =:idAccount';

    $statement = $pdo->prepare($updateProfileInformation);
    $statement->execute([
        ':firstname' => $fname,
        ':lastname' => $lname,
        ':birthdate' => $birthday,
        ':city' => $city,
        ':street' => $street,
        ':number' => $number,
        ':postal' => $postalcode,
        ':mail' => $mail,
        ':idAccount' => $_SESSION['idAccount']
    ]);
    
    header("Location: template/profile.php?editProfile=successful");
}
?>