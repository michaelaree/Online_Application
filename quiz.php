<?php
require_once "Database.php";
require_once "function.php";
session_start();
if (!isset($_SESSION['login_active'])) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Application</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
            color: white;
        }
        .navbar-brand {
            color: #ffc107;
            font-weight: bold;
        }
        .navbar-toggler-icon {
            background-color: white;
        }
        .nav-link {
            color: white !important;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .main-section {
            padding: 20px;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            background-color: white;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #007bff;
        }
        .form-check-input {
            margin-right: 5px;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>
<section class="main-section">
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Quiz</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
            </li>
          </ul>
          <div class="d-flex">
            <a class="btn btn-danger" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>
    <form action="checkanswers.php" method="post">
      <?php for ($i = 1; $i <= totalquestion($conn); $i++) :
        $sql = "SELECT * FROM questions where qid = $i";
        $result = mysqli_query($conn, $sql);
      ?>
        <div class="container">
          <div class="row justify-content-center">
            <?php while ($row = mysqli_fetch_assoc($result)) :
              $sql = "SELECT * FROM answers where ans_id = $i";
              $result = mysqli_query($conn, $sql);
            ?>
              <div class="col-md-8">
                <div class="card my-2 p-3">
                  <div class="card-body">
                    <h5 class="card-title py-2">Q.<?php echo $row['qid'] . " " . $row["question"];; ?> </h5>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="checkanswer[<?php echo $row['ans_id']; ?>]" value="<?php echo $row['aid']; ?>">
                        <?php echo $row['answer']; ?>
                      </div>
                    <?php endwhile ?>
                  </div>
                </div>
              </div>
            <?php endwhile ?>
          <?php endfor ?>
            <div class="col-md-8 mb-5">
              <button type="submit" class="btn btn-success" name="answer-submit">Submit Answers</button>
            </div>
          </div>
        </div>
    </form>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

