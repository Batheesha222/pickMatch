<?php
session_start();
include_once 'connection.php';
include_once 'header2.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $checkEmail = "SELECT * from admins where email = '$email';";

    $checkEmailResult = mysqli_query($connect, $checkEmail);

    if (mysqli_num_rows($checkEmailResult) > 0) {

        echo "Admin already exists!";
    } elseif ($password != $confirmPassword) {
        echo "Password does not match!";
    } else {

        $insertAdmin = "INSERT INTO admins (name,email,password) VALUES ('$name','$email','$password');";

        mysqli_query($connect, $insertAdmin);

        $insertUser = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password');";

        mysqli_query($connect, $insertUser);
    }
}


if (isset($_POST['add'])) {
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['img']['name'];
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $imageLoc = 'product-images/' . $image;
    $temp_image = $_FILES['img']['tmp_name'];

    $insert = "INSERT INTO `products`(`productName`, `quantity`, `price`, `image`, `description`) VALUES ('$productName','$quantity','$price','$image','$description');";
    $result_insert = mysqli_query($connect, $insert);

    if ($result_insert) {
        move_uploaded_file($temp_image, $imageLoc);
    }
}


if (isset($_POST['post'])) {
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $content = mysqli_real_escape_string($connect, $_POST['content']);
    $imageLoc = 'blog-images/' . $image;
    $temp_image = $_FILES['image']['tmp_name'];

    $insert = "INSERT INTO `blogs`(`title`, `image`, `content`) VALUES ('$title','$image','$content');";
    $result_insert = mysqli_query($connect, $insert);

    if ($result_insert) {
        move_uploaded_file($temp_image, $imageLoc);
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
    

    <?php

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];


        $selectSuperAdmin = "SELECT * FROM superAdmin WHERE userID = '$userID';";

        $superAdminResult = mysqli_query($connect, $selectSuperAdmin);

        if (mysqli_num_rows($superAdminResult) > 0) {
            echo '
                    
    <section id="add-admin">
        <div class="form-container">
            <form action="" method="post">
                <h3>Add admins</h3>

                <input type="text" name="name" required placeholder="Name">
                <input type="email" name="email" required placeholder="Email">
                <input type="password" name="password" required placeholder="Password">
                <input type="password" name="confirmPassword" required placeholder="Confirm Password">

                <input type="submit" name="submit" value="Add" class="form-btn">
            </form>
        </div>
    </section>                   
                    ';
        }
    }
    ?>


    <section id="add-product">
        <div class="form-container">
            <form enctype="multipart/form-data" method="post">
                <h3>Add products</h3>

                <input type="text" name="productName" placeholder="Product Name" required>
                <input type="text" name="price" placeholder="Price" required>
                <input type="text" name="quantity" placeholder="Quantity" required>
                <input type="file" name="img" accept="image/png,image/jpg,image/jpeg" required>
                <input type="text" name="description" placeholder="Description" required>

                <input type="submit" name="add" value="Add" class="form-btn">
            </form>
        </div>
    </section>

    <section id="add-blogs">
        <div class="form-container">
            <form enctype="multipart/form-data" method="post">
                <h3>Add Blogs</h3>

                <input type="text" name="title" placeholder="Title" required>
                <input type="file" name="image" accept="image/png,image/jpg,image/jpeg" required>
                <input type="text" name="content" placeholder="Content" required>

                <input type="submit" name="post" value="Add" class="form-btn">
            </form>
        </div>
    </section>

</body>

</html>