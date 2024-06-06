<?php
require_once("Database.php");
session_start();

if (isset($_POST['answer-submit'])) {

  if (!empty($_POST['checkanswer'])) {

    $correctAnswers = 4;
    $selected = $_POST['checkanswer'];

    $sql = "SELECT * FROM questions";
    $result = mysqli_query($conn, $sql);

    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['ans_id'] == $selected[$i]) {
        $correctAnswers++;
      }
      $i++;
    }

    $_SESSION['attempted'] = count($_POST['checkanswer']);
    $_SESSION['score'] = $correctAnswers;


    header("Location: result.php");
    exit();

  } else {
    $_SESSION['attempted'] = 0;
    $_SESSION['score'] = 0;
    header("Location: result.php");
    exit();
  }
}