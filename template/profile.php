<?php

include '../model/config/connect.php';
include '../model/accountFunc.php';

session_start();
if (!isset($_SESSION['signedin'])) {
    // Check if the session is active. If not, redirect to account.php.
    header('Location: account.php'); 
    exit;
}

$profileResult = fetchProfileInformation();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/profile.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title>Welcome, <?php echo $_SESSION['sFirstName']; ?>. | Audemars Piguet</title>
</head>
<body>

<?php include 'default/header.php'; ?>

<main>
    <section class="profile-information-section">
        <div class="profile-information-container">
            <div class="profile-information-header">
            <?php if ($_GET['editProfile'] == 'true') {
            echo '
                <div class="header-title">Update profile</div>
                <div class="header-actions"><a href="profile.php" id="cancel">cancel</a></div>';
            } elseif ($_GET['changePass'] == 'true') {
                echo '
                <div class="header-title">Change Password</div>
                <div class="header-actions"><a href="profile.php" id="cancel">cancel</a></div>';
            } else {
            echo '
                <div class="header-title">Profile information</div>
                <div class="header-actions">
                    <a href="profile.php?editProfile=true" class="bi bi-pencil actionButton"></a>
                    <a href="profile.php?changePass=true" class="bi bi-shield-lock actionButton"></a>
                </div>';
            } ?>
            </div>
            <?php 
            // When clicking the pencil, the editProfile state will be true.
            // This will display the form used for changing profile details.
            if ($_GET['editProfile'] == 'true') {
            echo '
                <form action="#" method="post">
                <div class="profile-information-body">
                    <div class="body-content">
                        <div class="content-row" id="half">
                            <div class="input-container"><label class="title">First name *</label><input class="editInput" type="text" id="" name="" placeholder="Audemars" required></div>
                            <div class="input-container"><label class="title">Last name *</label><input class="editInput" type="text" id="" name="" placeholder="Piguet" required></div>
                        </div>
                        <div class="content-row">
                            <div class="input-container"><label class="title">Date of Birth</label><input class="editInput" type="date" id="" name="" placeholder=""></div>
                            <div class="input-container"><label class="title">E-mail *</label><input class="editInput" type="email" id="" name="" placeholder="info@audemarspiguet.com" required></div>
                        </div>
                    </div>
                    <div class="body-content">
                        <div class="content-row">
                            <div class="input-container"><label class="title">City</label><input class="editInput" type="text" id="" name="" placeholder="Le Brassus"></div>
                            <div class="input-container"><label class="title">Street</label><input class="editInput" type="text" id="" name="" placeholder="Route de France"></div>
                        </div>
                        <div class="content-row" id="half">
                            <div class="input-container"><label class="title">House number</label><input class="editInput" type="number" id="" name="" placeholder="15"></div>
                            <div class="input-container"><label class="title">Postal code</label><input class="editInput" type="text" id="" name="" placeholder="1348 LB"></div>
                        </div>
                    </div>
                </div>
                <div class="profile-information-footer"><button type="submit" class="updateButton">Update profile</button></div>
                </form>';
            } 
            // When clicking the shield lock, the changePassword state will be true.
            // This will display the change password form.
            elseif ($_GET['changePass'] == 'true') {
            echo '
            <form action="#" method="post">
            <div class="profile-information-body password">
                <div class="body-content">
                    <div class="content-row">
                        <div class="input-container"><label class="title">New password</label><input class="editInput" type="password" id="" name="" placeholder="************"></div>
                        <div class="input-container"><label class="title">Repeat new password</label><input class="editInput" type="password" id="" name="" placeholder="************" required></div>
                    </div>
                </div>
            </div>
            <div class="profile-information-footer"><button type="submit" class="updateButton">Change password</button></div>
            </form>';
            } 
            // When opening the profile.php page this (your profile information) will be displayed on default.
            else {
                echo '
                <div class="profile-information-body">
                    <div class="body-content">
                        <div class="content-row" id="half">
                            <div class="input-container"><label class="title">First name</label><p class="value">'. $profileResult['sFirstName'] .'</p></div>
                            <div class="input-container"><label class="title">Last name</label><p class="value">'. $profileResult['sLastName'] .'</p></div>
                        </div>
                        <div class="content-row">
                            <div class="input-container"><label class="title">Date of Birth</label><p class="value">'. $profileResult['dDateOfBirth'] .'</p></div>
                            <div class="input-container"><label class="title">E-mail</label><p class="value">'. $profileResult['sMailAddress'] .'</p></div>
                        </div>
                    </div>
                    <div class="body-content">
                        <div class="content-row">
                            <div class="input-container"><label class="title">City</label><p class="value">'. $profileResult['sCity'] .'</p></div>
                            <div class="input-container"><label class="title">Street</label><p class="value">'. $profileResult['sStreetName'] .'</p></div>
                        </div>
                        <div class="content-row" id="half">
                            <div class="input-container"><label class="title">House number</label><p class="value">'. $profileResult['iHouseNumber'] .'</p></div>
                            <div class="input-container"><label class="title">Postal code</label><p class="value">'. $profileResult['sPostalCode'] .'</p></div>
                        </div>
                    </div>
                </div>';
            }?>
        </div>
    </section>
</main>

<?php include 'default/footer.php'; ?>

</body>
</html>