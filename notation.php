<?php $title = 'Notation'; ?>
<?php include('inc/function.php') ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php


if (connecLogin() == false) {
  die('403');
}
// tableau vide qui definit et va permettre d'afficher les erreurs
$error = array();

if(!empty($_GET['id'])) {
  $filmid = $_GET['id'];



    $sql = "SELECT * FROM movies_full WHERE id = :id";
    // preparation
    $query = $pdo->prepare($sql);
   // protection SQL
    $query->bindValue(':id', $filmid, PDO::PARAM_INT);
   // execution
    $query->execute();

  // si le formulaire (ici la note) est soumis(e) alors j'execute les verifications et j'echange avec ma base de données
  if(!empty($_POST['vote'])) {
    $note = trim(strip_tags($_POST['note']));
    $id_user = $_SESSION['user']['id'];
    // definition de insert into, ici on vise a ajouter la note a la base de données
    $sql = "INSERT INTO notes (film_id,user_id,note, created_at) VALUES (:idfilm,:iduser,:note, NOW())";
    // preparation requete
    $query = $pdo->prepare($sql);
    // protection SQL
    $query->bindValue(':note', $note, PDO::PARAM_INT);
    $query->bindValue(':idfilm', $filmid, PDO::PARAM_INT);
    $query->bindValue(':iduser', $id_user, PDO::PARAM_INT);

  //  $filmid


    // execution
    $query->execute();
  }



  } else {
    header('location: index.php');
  }


?>

<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
<link rel="stylesheet" href="assets/css/rating.css">

<header class='header text-center' class="header">
    <h2>Notez ce film</h2>
    <p>Chaque etoile correspond a 20 points (note totale sur 100)</p>
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

<form action="" method="post">
  <input type="number" name="note" value="note" min="0" max="100">
  <input type="submit" class="votation" name="vote" value="Je vote !">
</form>

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
