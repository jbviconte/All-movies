<?php $title = 'Home Front'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>


<?php

$sql = "SELECT * FROM movies_full ORDER BY RAND() LIMIT 100";

              // preparation de la requête
        $stmt = $pdo->prepare($sql);
        // execution de la requête preparé
        $stmt->execute();
        $films = $stmt->fetchAll();

        //echo '<pre>';
        //print_r($films);
        //echo '</pre>';

?>



<?php include('inc/header.php') ?>

<form action="search.php" method="post">
  <label for="search" >Recherche</label>
  <input type="text" name="search" size="10">
<input type="submit" value="Ok">

</form>


<<<<<<< HEAD
<h1>Home Front</h1>


=======
>>>>>>> a96f1903d0428e59f8b649d160fe3801e999296a
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
