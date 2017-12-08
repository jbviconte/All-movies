<?php $title = 'Connection'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>
<?php

$errors = array();
if(!empty($_POST['submit'])) {


  $pseudo   = trim(strip_tags($_POST['pseudo']));
  $password = trim(strip_tags($_POST['password']));



  if(count($errors) == 0){


    $sql = "SELECT * FROM users WHERE pseudo = :pseudo OR email = :pseudo AND password = :password";
    $query = $pdo->prepare($sql);
    $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $query->bindValue(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $connection = $query->fetch();

    if(!empty($connection)){

      //connection password
      if(!empty($password)){


        if(password_verify($password,$connection['password']) == true){

          //cookie
          if(!empty($_POST['remember'])) {
            setcookie('usercook', $connection['id']. '---' . sha1($connection['pseudo'] . $connection['password'] . $_SERVER['REMOTE_ADDR']) , time() + 3600 * 24 * 5,'/');

          }
          //SESSION
          $_SESSION['user'] = array(
            'pseudo' => $connection['pseudo'],
            'id' => $connection['id'],
            'password' => $connection['password'],
            'role' => $connection['role'],
            'ip' => $_SERVER['REMOTE_ADDR'],
          );

          header('Location: index.php');
        } else {
            $errors['password'] = 'Mot de passe érroné';
        }
      }else{
        $errors['password'] = 'Veuillez entré un mot de passe';
      }

    }else{
      $errors['pseudo'] && $errors['email'] = 'pseudo ou email érroné';
    }


  }else{
    $errors['pseudo'] && $errors['email'] = 'Veuillez saisir un pseudo ou un email valide';
  }
}

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if (!empty($_SESSION)) {
  header('Location: index.php');
}
?>
<?php include('inc/header.php') ?>



<h1>Connection</h1>

<form method="post" action="">

  <label for="pseudo" class="pseudo">Pseudo ou email : </pseudo>
  <input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_POST['pseudo'])) {echo $_POST['pseudo']; } ?>">
  <br />
  <span class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></span>
  <br />
  <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>
  <br />
  <label for="password" class="password">Mot de passe :</label>
  <input type="password" name="password" id="password" value="<?php if(!empty($_POST['password'])) {echo $_POST['password']; } ?>">
  <br />
  <label for="remember" class="radio">Se souvenir de moi : </label>
  <input type="checkbox" name="remember" id="radio">
  <input class="submit" type="submit" name="submit" value="Envoyer">

</form>
<a href="passforget.php">Mot de passe oublié</a>
<?php include('inc/footer.php') ?>
