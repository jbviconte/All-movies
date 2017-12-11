<?php $title = 'Recherche'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php

$error = array();
if(!empty($_GET['submit'])){
  $sql = "SELECT * FROM movies_full";

  if(!empty($_GET['search'])){
    $recherche = $_GET['search'];

    $sql .= "WHERE title LIKE :recherche OR cast LIKE :recherche OR directors LIKE :recherche";
  }

  $query = $pdo->prepare($sql);
  $query->bindValue(':recherche', '%'.$recherche.'%', PDO::PARAM_INT);
  $query->execute();



}

echo'<pre>';
print_r($error);
echo'</pre>';



while ($r = $query->fetch()) {
  $r['title'];
}
