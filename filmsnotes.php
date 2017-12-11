<?php $title = 'Films notés'; ?>
<?php include('inc/pdo.php') ?>
<?php include('inc/fonctions.php') ?>
<?php

// tableau vide qui definit et va permettre d'afficher les erreurs
$error = array();

// si le vote est soumis (submit envoyé)
if(!empty($_POST['vote'])) {
  // que l'utilisateur existe dans la base de données et qu'il est connecté
  if(!empty($_POST['user_id'])) {
    // on va chercher l'id de l'utilisateur pour verifier si il existe, ce qui permet aussi de savoir si il est connecté
    $sql    = "SELECT * FROM notes WHERE user_id = :user_id";
    // preparation requete
    $query  = $pdo->prepare($sql);
    // protections SQL
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    // execution de la requete
    $query->execute();
    // affichage de cette requete
    $userid = $query->fetch();
  };

  // si la note est valide et bien renseignée (apres clic sur je vote)
  if(!empty($_POST['note'])) {
    // on va chercher celle-ci dans la base de données
    $sql    = "SELECT * FROM notes WHERE note = :note";
    // preparation requete
    $query  = $pdo->prepare($sql);
    // protection SQL
    $query->bindValue(':note', $note, PDO::PARAM_INT);
    // execution de la requete
    $query->execute();
    // affichage de cette requete
    $note   = $query->fetch();
  };

  // si ces deux elements sont validés, on va afficher les films notés en les classant selon la date de leur note
  /* if(!empty($POST['user_id']) && !empty($_POST['note'])) {
    $sql    = "SELECT * FROM films WHERE user_id = :user_id && note = :note"
  }; */

  $sql = "INSERT INTO notes (id, user_id, film_id, note, created_at) VALUES (:id, :user_id, :film_id, :note, NOW())";
  // preparation
  $query = $pdo->prepare($sql);
  // protection SQL
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query->bindValue(':user_id', $user_id, PDO::PARAM_STR);
  $query->bindValue(':film_id', $film_id, PDO::PARAM_STR);
  $query->bindValue(':note', $note, PDO::PARAM_INT);
  $query->bindValue(':created_at', $created_at, PDO::PARAM_STR);
  // Execution
  $query->execute();
}

?>


<?php include('inc/header.php') ?>



<h1>Films notés</h1>

<input type="text" name="boboba" value="">
<input type="submit" name=vote"" value="vote">


<?php include('inc/footer.php') ?>
