<?php
include_once 'connection.php';
?>
<header class="header">
    <div class="header-1">
        <a href="index.php" class="logo"><img src="images/Logo.png" alt=""></a>

        <form action="" class="search-form">
            <input type="search" name="" placeholder="Search here..." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <a href="#" class="fas fa-heart"></a>
            <a href="cart.php" class="fas fa-shopping-cart"></a>
            <a href="profile.php" class="fas fa-user">
                <?php
                    if(isset($_SESSION['userID'])){
                        echo $_SESSION['name'];
                    }
                ?>
            </a>
        </div>

    </div>

    <div class="header-2">
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="#featured">featured</a>
            <a href="#arrivals">arrivals</a>
            <a href="#reviews">reviews</a>
            <a href="#blogs">blogs</a>
            <?php
            if(isset($_SESSION['userID'])){
                $userID = $_SESSION['userID'];

                $selectAdmin = "SELECT * FROM users WHERE userID = '$userID';";
                $adminResult = mysqli_query($connect,$selectAdmin);

                if(mysqli_num_rows($adminResult)>0){
                    $user = mysqli_fetch_assoc($adminResult);
                    $userEmail = $user['email'];

                    $checkEmail = "SELECT * FROM admins WHERE email = '$userEmail';";
                    $emailResult = mysqli_query($connect,$checkEmail);

                    if(mysqli_num_rows($emailResult)>0){
                        echo '<a href="adminPannel.php">admin</a>';
                    }
                }
            }
            ?>
            
        </nav>
    </div>
</header>