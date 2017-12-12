<?php $title = 'Notation'; ?>
<?php include('inc/pdo.php') ?>
<?php

// tableau vide qui definit et va permettre d'afficher les erreurs
$error = array();

  if(!empty($_POST['vote'])) {
    if(!empty($_GET['user_id']) && is_numeric($_GET['user_id'])) {
      $userid = $_GET['user_id'];
    } else {
      header('location: connection.php');
    }

    $sql = "SELECT * FROM movies_full WHERE id = :id";
    // preparation
    $query = $pdo->prepare($sql);
    // protection SQL
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    // execution
    $query->execute();
    // affichage
    $film = $query->fetchAll();

    echo '<pre>';
    print_r($film);
    echo '</pre>';

    // definition de insert into, ici on vise a ajouter la note a la base de données
    $sql = "INSERT INTO notes (id, user_id, film_id, note, created_at) VALUES (:id, :user_id, :film_id, :note, NOW())";
    // preparation requete
    $query = $pdo->prepare($sql);
    // protection SQL
    $query->bindValue(':id', $id, PDO::PARAM_INT); // definir l'id a recuperer (ici le film visé)
    $query->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $query->bindValue(':film_id', $film_id, PDO::PARAM_STR);
    $query->bindValue(':note', $note, PDO::PARAM_INT);
    $query->bindValue(':created_at', $created_at, PDO::PARAM_STR);
    // execution
    $query->execute();
  };




echo '<pre>';
print_r($error);
echo '</pre>';






 include('inc/header.php')

?>

<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

<header class='header text-center' class="header">
    <h2>Notez ce film</h2>
    <p>Chaque etoile correspond a 20 point (note totale sur 100)</p>
</header>

<section class='rating-widget'>

  <!-- Rating Stars Box -->
  <div class='rating-stars text-center'>
    <ul id='stars'>
      <li class='star' data-value='1'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' data-value='2'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' data-value='3'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' data-value='4'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' data-value='5'>
        <i class='fa fa-star fa-fw'></i>
      </li>
    </ul>
  </div>

  <div class='success-box'>
    <img alt='tick image' width='32' src='https://i.imgur.com/3C3apOp.png' />
    <a href="All-movies/images/valida.png"></a>
    <div class='text-message'></div>
  </div>

  <input type="number" name="note" value="note" min="0" max="100">
  <input type="submit" class="vote" name="vote" value="Je vote !">


</section>

<script src="./assets/javascript/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/javascript/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

// Visualisation du hover
$('#stars li').on('mouseover', function(){
  var onStar = parseInt($(this).data('value'), 10); // Survol des etoiles

  // ajout d'une classe hover pour chaque etoile
  $(this).parent().children('li.star').each(function(e){
    if (e < onStar) {
      $(this).addClass('hover');
    }
    else {
      $(this).removeClass('hover');
    }
  });

  // quand la souris sors d'une etoile, la classe hover disparait
}).on('mouseout', function(){
  $(this).parent().children('li.star').each(function(e){
    $(this).removeClass('hover');
  });
});


// reaction onclick
$('#stars li').on('click', function(){
  var onStar = parseInt($(this).data('value'), 10);
  var stars = $(this).parent().children('li.star');

  for (i = 0; i < stars.length; i++) {
    $(stars[i]).removeClass('selected');
  }

  for (i = 0; i < onStar; i++) {
    $(stars[i]).addClass('selected');
  }

  // Juste la reponse (pas necessaire)
  var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
  var msg = "";
  if (ratingValue > 0) {
      msg = "Vous votez 1 etoile, soit une note de 20/100, c'est pas fou !";
  }
  if (ratingValue > 1) {
    msg = "Vous votez 2 etoiles, soit une note de 40/100, peut mieux faire !";
  }
  if (ratingValue > 2) {
    msg = "Vous votez 3 etoiles, soit une note de 60/100, pas mal !";
  }
  if (ratingValue > 3) {
    msg = "Vous votez 4 etoiles, soit une note de 80/100, c'est beau !";
  }
  if (ratingValue > 4) {
    msg = "Vous votez 5 etoiles, soit une note de 100/100, incroyable !";
  }
  responseMessage(msg);

});

});

function responseMessage(msg) {
$('.success-box').fadeIn(200);
$('.success-box div.text-message').html("<span>" + msg + "</span>");
}

</script>





<?php include('inc/footer.php') ?>
