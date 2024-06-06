<?php
require_once "Database.php";
require_once "function.php";
session_start();
if (isset($_POST['signup'])) {
  $name = santize($_POST['name']);
  $email = santize($_POST['email']);
  $inputpassword = santize($_POST['password']);
  $password = md5($inputpassword);
  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password');";
  if (mysqli_query($conn, $sql)) {
    $_SESSION['msg'] = "You have Signed Up Successfully";
    $_SESSION['class'] = "text-bg-success";
    header("Location: index.php");
    exit();
  } else {
    $_SESSION['msg'] = "Sign Up failed";
    $_SESSION['class'] = "text-bg-danger";
    header("Location: index.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Application</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <section class="main-section">
        <div class="container">
            <div class="justify-content-center align-items-center">
                <div class="col-md-7 col-lg-4">
                    <div class="box rounded">
                        <div>
                            <div class="login-box p-5">
                                <h2 class="pb-4">Sign Up</h2>
                                <form action="" method="post">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" placeholder="Enter Name" name="name" required>
                                    </div>
                                    <div class="mb-4">
                                        <input type="email" class="form-control" placeholder="Enter Email address" name="email" required>
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary-1" name="signup">Sign Up</button>
                                    </div>
                                </form>
                                <div class="py-4 text-center">
                                    <a href="login.php" class="link">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>