<?php
include_once 'connection.php';
session_start();
include_once 'header.php';

if (isset($_SESSION['userID'])) {

    $userID = $_SESSION['userID'];
    $selectUser = "SELECT * FROM users WHERE userID = '$userID';";

    $selectUserResult = mysqli_query($connect, $selectUser);

    if (mysqli_num_rows($selectUserResult) > 0) {
        $row = mysqli_fetch_assoc($selectUserResult);
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PickMatch</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="form-container">
        <form action="" method="post">
            <h3>register</h3>
            
            <input type="text" name="name" required placeholder="<?php $name ?>">
            <input type="email" name="email" required placeholder="<?php $email ?>">
            <!-- <input type="password" name="password" required placeholder="Password">
            <input type="password" name="confirmPassword" required placeholder="Confirm Password"> -->
            <input type="submit" name="submit" value="Update" class="form-btn">
            
        </form>
    </div>

</body>

</html>