<?php $title = 'Page détails'; ?>
<?php include('inc/pdo.php') ?>
<?php include('inc/function.php') ?>


<?php

    $films = array();
    $success = false;


?>

<?php include('inc/header.php') ?>

<h1>Page détails</h1>

    <div class="film">

        <?php foreach ($films as $film) { ?>


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


            <?php getImageFilm($film); ?>



      <?php  }  ?>




    </div>


<?php include('inc/footer.php') ?>


<?php include('inc/footer_back.php') ?>
