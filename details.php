<?php $title = 'Page détails'; ?>
<?php include('inc/pdo.php') ?>

<?php

    $films = array();
    $success = false;



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

<h1>Page détails</h1>

    <div class="film">
        <?php foreach ($films as $film) { ?>

              <p>slug         : <?php echo $film['slug']; ?></p>
              <p>titre        : <?php echo $film['title']; ?></p>
              <p>année        : <?php echo $film['year']; ?></p>
              <p>genres       : <?php echo $film['genres']; ?></p>
              <p>synopsis     : <?php echo $film['plot']; ?></p>
              <p>réalisateurs : <?php echo $film['directors']; ?></p>
              <p>cast         : <?php echo $film['cast']; ?></p>
              <p>scénaristes  : <?php echo $film['writers']; ?></p>
              <p>durée        : <?php echo $film['runtime']; ?></p>
              <p>public       : <?php echo $film['mpaa']; ?></p>
              <p>note         : <?php echo $film['rating']; ?></p>
              <p>popularité   : <?php echo $film['popularity']; ?></p>
              <p>cast         : <?php echo $film['cast']; ?></p>
              <p>modifié le   : <?php echo $film['modified']; ?></p>
              <p>créé le      : <?php echo $film['created']; ?></p>

              <?php getImageFilm($film); ?>
          
        <?php } ?>



    </div>


<?php include('inc/footer.php') ?>


<?php include('inc/footer_back.php') ?>
