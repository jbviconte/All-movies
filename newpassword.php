<?php include('inc/pdo.php') ?>
<?php
$errors = array();
if ((!empty($_GET['token'])) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "SELECT password, token FROM users WHERE id = :id";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query->execute();
  $user = $query->fetch();


  if(!empty($_POST['submit'])){

    $password = trim(strip_tags($_POST['password']));
    $goodPassword = trim(strip_tags($_POST['goodPassword']));

    //validation password
    if(!empty($password)) {
          if(strlen($password) < 8) {
            $errors['password'] = 'Min 8 caracteres';
          } elseif (strlen($password) > 250) {
            $errors['password'] = 'Max 250 caracteres';
          }
          elseif ($password != $goodPassword){
            echo 'Veuillez renseigner les mêmes mots de passe';
          }

    } else {
      $errors['password'] = 'Veuillez renseigner ce champ';
    }

    if(count($errors) == 0) {

      $token = bin2hex(openssl_random_pseudo_bytes(60));
      $password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "UPDATE users SET password = :password, token = :token WHERE id = :id";
      $query = $pdo->prepare($sql);
      $query->bindValue(':token', $token, PDO::PARAM_STR);
      $query->bindValue(':id', $id, PDO::PARAM_STR);
      $query->bindValue(':password', $password, PDO::PARAM_STR);
      $query->execute();

      header('Location: connection.php');
      // print_r($errors);
    } else {

    }
  }

}

?>
<?php include('inc/header.php') ?>


<form method="post" action="">

  <label for="password" class="password">Nouveau mot de passe : </pseudo>
  <input type="password" name="password" id="password" value="">
  <br />
  <span class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>
  <br />
  <label for="goodPassword" class="goodPassword">Confirmation du nouveau mot de passe : </pseudo>
  <input type="password" name="goodPassword" id="goodPassword" value="">
  <br />
  <span class="error"><?php if(!empty($errors['goodPassword'])) { echo $errors['goodPassword']; } ?></span>

  <input class="submit" type="submit" name="submit" value="Envoyer">

</form>


<?php include('inc/footer.php') ?>
