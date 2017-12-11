<?php $title = ''; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php

if (!empty($_GET['slug'])) {
  $slug = $_GET['slug'];

  $sql = "SELECT * FROM movies_full WHERE slug = :slug";
  $query = $pdo->prepare($sql);
  // bindValue
  $query->bindValue(':slug', $slug, PDO::PARAM_INT);
  $query->execute();
  $film = $query->fetch();

        //echo '<pre>';
        //print_r($films);
        //echo '</pre>';
}
?>

<?php include('inc/header.php') ?>



<div class="film">

  <?php getImageFilm($film); ?>
  <p>id           : <?php echo $film['id']; ?>        </p>
  <p>slug         : <?php echo $film['slug']; ?>      </p>
  <p>titre        : <?php echo $film['title']; ?>     </p>
  <p>année        : <?php echo $film['year']; ?>      </p>
  <p>genres       : <?php echo $film['genres']; ?>    </p>
  <p>synopsis     : <?php echo $film['plot']; ?>      </p>
  <p>réalisateurs : <?php echo $film['directors']; ?> </p>
  <p>cast         : <?php echo $film['cast']; ?>      </p>
  <p>scénaristes  : <?php echo $film['writers']; ?>   </p>
  <p>durée        : <?php echo $film['runtime']; ?>   </p>
  <p>public       : <?php echo $film['mpaa']; ?>      </p>
  <p>note         : <?php echo $film['rating']; ?>    </p>
  <p>popularité   : <?php echo $film['popularity']; ?></p>
  <p>cast         : <?php echo $film['cast']; ?>      </p>
  <p>modifié le   : <?php echo $film['modified']; ?>  </p>
  <p>créé le      : <?php echo $film['created']; ?>   </p>



</div>

<?php include('inc/footer.php') ?>
