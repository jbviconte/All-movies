<?php include('inc/function.php') ?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

  <div id="wrapper">

    <header>
      <?php
      if (connecLogin() == true) {

        echo 'Bonjour, ' . $_SESSION['user']['pseudo'] . '<br />';
        echo '<a href="deconnection.php">Déconnection</a>';

      } else {

        echo '<a href="inscription.php">Inscription</a><br />';
        echo '<a href="connection.php">Connection</a>';

      }
      ?>
    </header>

    <div id="content">
