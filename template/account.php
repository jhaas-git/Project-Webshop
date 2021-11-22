<?php 

include '../model/accountFunc.php';

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

<?php include 'default/header.php'; ?>

<main>
    <section class="account-section">
        <div class="account-form-container">
            <div class="account-form-header"><img src="../media/brand/logo-black-sm.svg" alt=""></div>
            <div class="account-form-body formTab" id="login">
                <p class="form-title">Sign in</p>
                <form action="#" method="post"> 
                <div class="form-row">
                    <div class="input-container">
                        <input type="text" id="mail" name="" placeholder="Mail" required>    
                    </div>
                    <div class="input-container">
                        <input type="password" id="password" name="" placeholder="Password" required>    
                    </div>
                </div>   
                <button type="submit" class="registerBtn">complete authentication</button>
                </form> 
                <p class="tablink" onclick="openForm(event, 'register')" id="defaultOpen">Don't have an account? Sign up!</p>
            </div>    

            <div class="account-form-body formTab" id="register">
                <?php if ($_GET['registration'] == 'successful') {
                    echo '<p class="message" id="success">Registration successful. <br>You can now sign in.</p>';
                } elseif ($_GET['registration'] == 'failed') {
                    echo '<p class="message" id="failed">e-mail already in use. <br> Please try another.</p>';
                }
                ?>
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
