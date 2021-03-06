<?php 
include '../model/config/includes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/account.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title>Account | Audemars Piguet</title>
</head>
<body>

<!-- Display error or success messages when needed. -->
<?php if (isset($_GET['authentication1']) && $_GET['authentication1'] == 'failed') {
    echo '
    <div class="message-box" id="failed">
        <div class="message-content">
            <p class="message">Account does not exist.</p>
            <a href="account.php" class="close-message bi bi-x-lg"></a>
        </div>
    </div>';
} elseif (isset($_GET['authentication2']) && $_GET['authentication1'] == 'failed') {
    echo '
    <div class="message-box" id="failed">
        <div class="message-content">
            <p class="message">Incorrect password.</p>
            <a href="account.php" class="close-message bi bi-x-lg"></a>
        </div>
    </div>';
} elseif (isset($_GET['registration']) && $_GET['registration'] == 'successful') {
    echo '
    <div class="message-box" id="success">
        <div class="message-content">
            <p class="message">Registration successful.</p>
            <a href="account.php" class="close-message bi bi-x-lg"></a>
        </div>
    </div>';
} elseif (isset($_GET['registration']) && $_GET['registration'] == 'failed') {
    echo '
    <div class="message-box" id="failed">
        <div class="message-content">
            <p class="message">e-mail already exists.</p>
            <a href="account.php" class="close-message bi bi-x-lg"></a>
        </div>
    </div>';
} elseif (isset($_GET['updatePassword']) && $_GET['updatePassword'] == 'successful') {
    echo '
    <div class="message-box" id="success">
        <div class="message-content">
            <p class="message">Password successfully updated.</p>
            <a href="account.php" class="close-message bi bi-x-lg"></a>
        </div>
    </div>';
}
?>

<?php include 'default/header.php'; ?>

<main>
    <section class="account-section">
        <div class="account-form-container">
            <div class="account-form-header"><img src="../media/brand/logo-black-sm.svg" alt=""></div>
            <div class="account-form-body formTab" id="login">
                <p class="form-title">Sign in</p>
                <form action="../index.php?accountFunc=2" method="post"> 
                <div class="form-row">
                    <div class="input-container">
                        <input type="text" id="mail" name="mailaddress" placeholder="Mail" required>    
                    </div>
                    <div class="input-container">
                        <input type="password" id="password" name="pass" placeholder="Password" required>    
                    </div>
                </div>   
                <button type="submit" class="registerBtn">complete authentication</button>
                </form> 
                <p class="tablink" onclick="openForm(event, 'register')" id="defaultOpen">Don't have an account? Sign up!</p>
            </div>    

            <div class="account-form-body formTab" id="register">
                <p class="form-title">Sign up</p>
                <form action="../index.php?accountFunc=1" method="post">
                <div class="form-row" id="half">
                    <div class="input-container">
                        <input type="text" id="fname" name="firstname" placeholder="First name" required>    
                    </div>
                    <div class="input-container">
                        <input type="text" id="lname" name="lastname" placeholder="Last name" required>    
                    </div>
                </div>    
                <div class="form-row">
                    <div class="input-container">
                        <input type="text" id="mail" name="mailaddress" placeholder="Mail" required>    
                    </div>
                    <div class="input-container">
                        <input type="password" id="password" name="pass" placeholder="Password" required>    
                    </div>
                </div>   
                <button type="submit" class="registerBtn">complete registration</button>
                </form> 
                <p class="tablink" onclick="openForm(event, 'login')">already have an account? Sign in!</p>
            </div>    
            </div>
        </div>
    </section>
</main>

<?php include 'default/footer.php'; ?>

<script src="../javascript/default.js"></script>

</body>
</html>
