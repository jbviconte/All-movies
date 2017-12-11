<?php $title = 'Recherche'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php

$error = array();
$recherche = $pdo->query("SELECT * FROM movies_full");

if(isset($_GET['search']) && !empty($_GET['search'])){
  $recherche = htmlspecialchars($_GET['search']);

    $recherche = $pdo->query("SELECT * FROM movies_full WHERE title LIKE "%$recherche%" OR cast LIKE "%$recherche%" OR directors LIKE "%$recherche%"");

}

echo'<pre>';
print_r($error);
echo'</pre>';

while ($r = $recherche->fetch()) {
  echo '<p>' . $r['title'] . '</p>';
  echo '<p>' . $r['cast'] . '</p>';
  echo '<p>' . $r['directors'] . '</p>';
}
