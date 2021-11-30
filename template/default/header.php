<header>
    <div class="navigation-mobile" id="menu"></div>
    <div class="navigation-container">
        <div class="navigation-content">
            <div class="navigation-content-left mobile" id="mobile-menu">
                <span></span>
            </div>
            <div class="navigation-content-left desktop">
                <ul class="navigation-content-left-links">
                    <li><a href="#" class="links">stories</a></li>
                    <li><a href="#" class="links">heritage</a></li>
                    <li><a href="watches.php" class="links">watches</a></li>
                </ul>
            </div>
            <div class="navigation-content-center mobile"><a href="#"><img src="../media/brand/logo-black-sm.svg" alt=""></a></div>
            <div class="navigation-content-center desktop"><a href="#"><img src="../media/brand/logo-black-lg.svg" alt=""></a></div>
            <div class="navigation-content-right">
                <ul class="navigation-content-right-links">
                    <?php if (isset($_SESSION['signedin'])) {
                        echo '
                        <li><a href="#" class="bi bi-bag"></a></li>
                        <li><a href="profile.php" class="bi bi-person-circle"></a></li>
                        <li><a href="../index.php?accountFunc=4" class="bi bi-box-arrow-right"></a></li>';
                    } else {
                        echo '
                        <li><a href="account.php" class="bi bi-person-circle"></a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</header>