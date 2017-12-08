<?php session_start();?>
<?php $title = 'Home'; ?>
<?php include('inc/pdo.php') ?>
<?php

$errors = array();
if(!empty($_POST['submit'])) {

      $pseudo   = trim(strip_tags($_POST['pseudo']));
      $email   = trim(strip_tags($_POST['email']));
      $password = trim(strip_tags($_POST['password']));
      $goodPassword = trim(strip_tags($_POST['goodPassword']));


      //validation pseudo
      if(!empty($pseudo)) {
            if(strlen($pseudo) < 5) {
                $errors['pseudo'] = 'Min 5 caracteres';
                
            } elseif (strlen($pseudo) > 150) {
                $errors['pseudo'] = 'Max 150 caracteres';

            } elseif(strlen($pseudo) > 5 && strlen($pseudo) < 150){
                $sql = "SELECT pseudo FROM users WHERE pseudo = :pseudo";
                $query = $pdo->prepare($sql);
                $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
                $query->execute();
                $pseudos = $query->fetch();

                if(!empty($pseudos)){
                  $errors['pseudo'] = 'Ce pseudo est déjat pris !';
                }
            }

      } else {
          $errors['pseudo'] = 'Veuillez renseigner ce champ';
      }

      //validation email
      if((!empty($email)) && (filter_var($email, FILTER_VALIDATE_EMAIL))) {
        if(strlen($email) > 150) {
          $errors['email'] = 'Votre email ne doit pas dépasser 150 caractères !';

        }elseif((!empty($email)) && (filter_var($email, FILTER_VALIDATE_EMAIL))){
          $sql = "SELECT email FROM users WHERE email = :email";
          $query = $pdo->prepare($sql);
          $query->bindValue(':email', $email, PDO::PARAM_STR);
          $query->execute();
          $emails = $query->fetch();

          if(!empty($emails)){
            $errors['email'] = 'Cet email est déja pris !';
          }
        }else{
          die('404');
        }
      }else {
          $errors['email'] = 'Veuillez renseigner un email valide !';
      }

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


      //veification erreur et insertion
      if(count($errors) == 0) {
        $token = bin2hex(openssl_random_pseudo_bytes(60));
        $password = password_hash($password, PASSWORD_DEFAULT);

         $sql = "INSERT INTO users (pseudo, password, email, token, created_at, role) VALUES (:pseudo,:password,:email,:token,NOW(),'user')";

         $query = $pdo->prepare($sql);
         $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
         $query->bindValue(':password', $password, PDO::PARAM_STR);
         $query->bindValue(':email', $email, PDO::PARAM_STR);
         $query->bindValue(':token', $token, PDO::PARAM_STR);
         $query->execute();

         header('Location: connection.php');

      } else {
        // print_r($errors);
      }
}
if (!empty($_SESSION)) {
  header('Location: index.php');
}
?>
<?php include('inc/header.php') ?>



<h1>Home</h1>

<form action="" method="post" class="inscription">

  <label for="pseudo" class="pseudo">Pseudo :</label>
  <input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_POST['pseudo'])) {echo $_POST['pseudo']; } ?>">
  <br />
  <span class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></span>
  <br />
  <label for="email" class="email">Email :</label>
  <input type="email" name="email" id="email" value="<?php if(!empty($_POST['email'])) {echo $_POST['email']; } ?>">
  <br />
  <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>
  <br />
  <label for="password" class="password">Mot de passe :</label>
  <input type="password" name="password" id="password" value="<?php if(!empty($_POST['password'])) {echo $_POST['password']; } ?>">
  <br />
  <span class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>
  <br />
  <label for="googPassword" class="goodPassword">Confirmation de mot de passe :</label>
  <input type="password" name="goodPassword" id="goodPassword" value="<?php if(!empty($_POST['goodPassword'])) {echo $_POST['goodPassword']; } ?>">
  <br />
  <span class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>

  <input class="submit" type="submit" name="submit" value="Envoyer">

</form>

<?php include('inc/footer.php') ?>
