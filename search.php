<?php $title = 'Recherche'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php

$error = array();
$recherche = $pdo->query("SELECT * FROM movies_full");

if(isset($_GET['search']) && !empty($_GET['search'])){
  $search = htmlspecialchars($_GET['search']);

    $recherche = $pdo->query('SELECT title, cast, directors, slug, year FROM movies_full WHERE title LIKE "%'.$search.'%" OR cast LIKE "%'.$search.'%" OR directors LIKE "%'.$search.'%"');

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
  echo '</div>';
}
