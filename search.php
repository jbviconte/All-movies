<?php $title = 'Recherche'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php

$error = array();
$recherche = $pdo->query("SELECT * FROM movies_full");

if(isset($_GET['search']) && !empty($_GET['search']) || isset($_GET['check'])){
  $search = htmlspecialchars($_GET['search']);
  $check = htmlspecialchars($_GET['check']);

    $recherche = $pdo->query('SELECT title, cast, directors, slug, year, genres FROM movies_full WHERE title LIKE "%'.$search.'%" OR cast LIKE "%'.$search.'%" OR directors LIKE "%'.$search.'%" OR genres LIKE '.$check.'');



}

// echo'<pre>';
// print_r($error);
// echo'</pre>';

while ($r = $recherche->fetch()) {
  echo '<div>';
  echo '<p><a href="details.php?slug='.$r['slug'].'">' . $r['title'] . '</a></p>';
  echo '<p>' . $r['cast'] . '</p>';
  echo '<p>' . $r['directors'] . '</p>';
  echo '<p>' . $r['year'] . '</p>';
  echo '<p>' . $r['genres'] . '</p>';
  echo '</div>';
}
