<?php
require_once "Database.php";
require_once "function.php";
session_start();
if (isset($_SESSION['login_active'])) {
    header("Location: dashboard.php");
    exit();
} else {
    if (isset($_POST['login'])) {
        $email = santize($_POST['email']);
        $inputpassword = santize($_POST['password']);
        $password = md5($inputpassword);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['login_active'] = [$row["name"], $row["email"]];
                $_SESSION['msg'] = "Welcome to Dashboard";
                $_SESSION['class'] = "text-bg-success";
                header("Location: dashboard.php");
                exit();
            }
        } else {
            $_SESSION['msg'] = "Check Email & Password";
            $_SESSION['class'] = "text-bg-danger";
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #044f69;
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #fff;
        }

        .header {
            background-color: #044f69;
            padding: 15px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 250px;

        }

        .content {
            background-color: #fff;
            padding: 15px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .welcome-section {
            padding: 50px 30px;
            text-align: center;
        }

        .welcome-text {
            font-size: 30px;
            margin-bottom: 100px;
            color: black;
        }

        .cta-buttons {
            margin-top: 20px;
        }

        .cta-buttons li {
            display: inline;
            margin-right: 15px;
        }

        .cta-buttons a {
            background-color: black;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-buttons a:hover {
            background-color: #044f69;
        }

        .features {
            padding: 50px 20px;
            background-color: #fff;
            text-align: center;
        }

        .feature-item {
            margin-bottom: 20px;
        }

        .feature-icon {
            font-size: 36px;
            margin-bottom: 10px;
            color: #007bff;
        }

        .feature-title {
            font-size: 25px;
            margin-bottom: 10px;
            color: black;
            font-weight: bold;
        }

        .feature-description {
            font-size: 18px;
            color: black;
        }

        .experience {
            margin-top: 20px;
        }

        .experience h3 {
            color: #044f69;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .experience p {
            margin: 10px 0;
            font-size: 14px;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>
    <section class="main-section">
        <div class="container">
        <?php if (isset($_SESSION['msg'])) : ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Message</strong>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close">
                        </button>
                    </div>
                    <div class="toast-body"></div>
                    <?php
                    $message = $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    echo $message;
                    ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="row justify-content-center align-items-center" style="height: 100vh">
                <div class="col-md-7 col-lg-4">
                    <div class="box rounded">
                        <div class="img"></div>
                        <div class="login-box p-5">
                            <h2 class="pb-4">Login</h2>
                            <form action="" method="post">
                                <div class="mb-4">
                                    <input type="email" class="form-control" placeholder="Enter Email address"
                                        name="email" />
                                </div>
                                <div class="mb-4">
                                    <input type="password" class="form-control" placeholder="Enter Password"
                                        name="password" />
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" name="login">
                                        Login
                                    </button>
                                </div>
                            </form>
                            <div class="py-4 text-center">
                                You new <br>
                                <a href="signup.php" class="link">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>