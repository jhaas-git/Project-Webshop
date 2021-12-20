<?php

include '../model/config/includes.php';
include '../model/config/connect.php';

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

<!-- Display error or success messages when needed. -->
<?php if ($_GET['editProfile'] == 'successful') {
    echo '
    <div class="message-box" id="success">
        <div class="message-content">
            <p class="message">Profile successfully updated.</p>
            <a href="profile.php" class="close-message bi bi-x-lg"></a>
        </div>
    </div>';
} elseif ($_GET['updatePassword'] == 'failed') {
    echo '
    <div class="message-box" id="failed">
        <div class="message-content">
            <p class="message">Repeated password does not match.</p>
            <a href="profile.php?changePass=true" class="close-message bi bi-x-lg"></a>
        </div>
    </div>';
}
?>

<?php include 'default/header.php'; ?>

<main>
    <section class="profile-information-section">
        <div class="profile-information-container">
            <div class="profile-information-content">
                <div class="profile-content-header">
                    <div class="header-title"><p>Profile</p></div>
                    <div class="header-actions">
                        <?php if ($_GET['editProfile'] == 'true') {
                            echo '<a href="profile.php" class="bi bi-x-lg"></a>';
                        } else {
                            echo '<a href="profile.php?editProfile=true" class="bi bi-pencil editButton"></a>';
                        }?>
                    </div>
                </div>
                <div class="profile-content-body">
                    <form action="../index.php?accountFunc=3" method="post">
                    <div class="body-row" id="double">
                        <?php if ($_GET['editProfile'] == 'true') {
                            echo '
                            <div class="body-input"><label>First name</label><input type="text" name="firstname" value="'. $profileResult['sFirstName'] .'"></div>
                            <div class="body-input"><label>Last name</label><input type="text" name="lastname" value="'. $profileResult['sLastName'] .'"></div>';                                
                        } else {
                            echo '
                            <div class="body-input"><label>First name</label><p class="value">'. $profileResult['sFirstName'] .'</p></div>
                            <div class="body-input" id="alignment"><label>Last name</label><p class="value">'. $profileResult['sLastName'] .'</p></div>';
                        } ?>
                    </div>
                    <div class="body-row">
                        <?php if ($_GET['editProfile'] == 'true') {
                            echo '
                            <div class="body-input"><label>Date of Birth</label><input type="date" name="birthdate" value="'. $profileResult['dDateOfBirth'] .'"></div>
                            <div class="body-input"><label>E-mail</label><input type="text" name="mailaddress" value="'. $profileResult['sMailAddress'] .'"></div>';                                
                        } else {
                            echo '
                            <div class="body-input"><label>Date of Birth</label><p class="value">'. $profileResult['dDateOfBirth'] .'</p></div>
                            <div class="body-input"><label>E-mail</label><p class="value">'. $profileResult['sMailAddress'] .'</p></div>';
                        } ?>
                    </div>
                </div>
                <?php if ($_GET['editProfile'] =='true') {
                    echo '<div class="profile-content-footer"><button type="submit" class="submitButton">Update profile</button></div>';
                } ?>
                </form>
            </div>
            <div class="profile-information-content">
                <div class="profile-content-header">
                    <div class="header-title">Shipping address</div>
                    <div class="header-actions">
                        <?php if ($_GET['editAddress'] == 'true') {
                            echo '<a href="profile.php" class="bi bi-x-lg"></a>';
                        } else {
                            echo '<a href="profile.php?editAddress=true" class="bi bi-pencil editButton"></a>';
                        } ?>
                    </div>
                </div>
                <div class="profile-content-body">
                    <form action="../index.php?accountFunc=6" method="post">
                    <div class="body-row" id="double">
                        <?php if ($_GET['editAddress'] == 'true') {
                            echo '
                            <div class="body-input"><label>Street</label><input type="text" name="street" value="'. $profileResult['sStreetName'] .'"></div>
                            <div class="body-input"><label>House number</label><input type="text" name="housenumber" value="'. $profileResult['iHouseNumber'] .'"></div>';                                
                        } else {
                            echo '
                            <div class="body-input"><label>Street</label><p class="value">'. $profileResult['sStreetName'] .'</p></div>
                            <div class="body-input" id="alignment"><label>House number</label><p class="value">'. $profileResult['iHouseNumber'] .'</p></div>';
                        } ?>
                    </div>
                    <div class="body-row">
                        <?php if ($_GET['editAddress'] == 'true') {
                            echo '
                            <div class="body-input"><label>Postal code</label><input type="text" name="postal" value="'. $profileResult['sPostalCode'] .'"></div>
                            <div class="body-input"><label>Street</label><input type="text" name="city" value="'. $profileResult['sCity'] .'"></div>';                                
                        } else {
                            echo '
                            <div class="body-input"><label>Postal code</label><p class="value">'. $profileResult['sPostalCode'] .'</p></div>
                            <div class="body-input"><label>City</label><p class="value">'. $profileResult['sCity'] .'</p></div>';
                        } ?>
                    </div>
                </div>
                <?php if ($_GET['editAddress'] =='true') {
                    echo '<div class="profile-content-footer"><button type="submit" class="submitButton">Update address</button></div>';
                } ?>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include 'default/footer.php'; ?>

</body>
</html>