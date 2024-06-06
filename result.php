<?php
require_once "Database.php";
require_once "function.php";
session_start();
if (!isset($_SESSION['login_active'])) {
  header("Location: index.php");
  exit();
}

// Get total questions and correct answers
$totalQuestions = totalquestion($conn);
$correctAnswers = min($_SESSION['score'], $totalQuestions); // Limit to total questions

// Calculate percentage
$percentage = ($correctAnswers / $totalQuestions) * 100;
// Make sure percentage does not exceed 100%
$percentage = min($percentage, 100);

// Display score as X out of Y
$scoreText = "$correctAnswers / $totalQuestions";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            padding-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-title {
            color: #007bff;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-body {
            padding: 20px;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #333;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .badge {
            background-color: #28a745;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 10px;
        }
        .badge.warning {
            background-color: #ffc107;
        }
    </style>
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
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <?php if ($correctAnswers == 0) : ?>
            <div class="card my-2 text-center">
              <div class="card-body">
                <h5 class="card-title py-2">No Questions Attempted</h5>
                <button class="btn btn-warning">Your Score is: <?php echo $scoreText; ?></button>
              </div>
            </div>
          <?php else : ?>
            <div class="card my-2 text-center">
              <div class="card-body">
                <h5 class="card-title py-2">You have attempted all <?php echo $totalQuestions; ?> questions</h5>
                <button class="btn btn-warning">Your Score: <?php echo $scoreText; ?></button>
                <div style="margin-top: 10px; font-weight: bold;">
                  <span class="badge <?php echo $percentage >= 70 ? 'warning' : ''; ?>">Answered <?php echo number_format($percentage, 2); ?>% Questions Correctly!</span>
                </div>
              </div>
            </div>
          <?php endif ?>
          <div class="card my-2 text-center">
            <div class="card-body">
              <a class="btn btn-info" href="quiz.php">Reattempt Quiz</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
