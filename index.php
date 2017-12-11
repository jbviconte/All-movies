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


<?php

$sql = "SELECT * FROM users ORDER BY RAND() LIMIT 100";

              // preparation de la requête
        $stmt = $pdo->prepare($sql);
        // execution de la requête preparé
        $stmt->execute();
        $films = $stmt->fetchAll();

        //echo '<pre>';
        //print_r($films);
        //echo '</pre>';

?>


<div class="film">
    <?php foreach ($films as $film) { ?>

      <p>titre        : <?php echo $film['title']; ?></p>
      <p>réalisateurs : <?php echo $film['directors']; ?></p>
      <p>cast         : <?php echo $film['cast']; ?></p>

        <a href="details.php?slug=<?= $film['slug']; ?>">
                <?php getImageFilm($film); ?>
        </a>

    <?php } ?>


<?php include('inc/footer.php') ?>
