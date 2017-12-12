<?php $title = 'Recherche'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php

$error = array();
$recherche = $pdo->query("SELECT title FROM movies_full");

if(isset($_GET['search']) && !empty($_GET['search'])){
  $search = htmlspecialchars($_GET['search']);

    $recherche = $pdo->query('SELECT title FROM movies_full WHERE title LIKE "%'.$search.'%"');

}

echo'<pre>';
print_r($error);
echo'</pre>';

while ($r = $recherche->fetch()) {
  echo '<p>' . $r['title'] . '</p>';
  // echo '<p>' . $r['cast'] . '</p>';
  // echo '<p>' . $r['directors'] . '</p>';
}
