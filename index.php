<?php $title = 'Home Front'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php include('inc/function.php') ?>


<?php include('inc/header.php') ?>



<h1>Home Front</h1>

<?php
if (connecLogin() == true) {

  echo 'Bonjour, ' . $_SESSION['user']['pseudo'] . '<br />';
  echo '<a href="deconnection.php">Déconnection</a>';

} else {

  echo '<a href="inscription.php">Inscription</a><br />';
  echo '<a href="connection.php">Connection</a>';

}
?>

<?php include('inc/footer.php') ?>
