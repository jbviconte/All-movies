<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';



?>
<?php include('inc/pdo.php') ?>
<?php


$errors = array();
if (!empty($_POST['submit'])) {

    $email = trim(strip_tags($_POST['email']));

    if((!empty($email)) && (filter_var($email, FILTER_VALIDATE_EMAIL))) {

      $sql = "SELECT id, email, token, pseudo FROM users WHERE email = :email";
      $query = $pdo->prepare($sql);
      $query->bindValue(':email', $email, PDO::PARAM_STR);
      $query->execute();
      $user = $query->fetch();

        if (!empty($user)) {

          // require "vendor/autoload.php";
          $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
          try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'tls://smtp.gmail.com:587';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'viconte.jeanbaptiste@gmail.com';                 // SMTP username
            $mail->Password = '';                           // SMTP password
            $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('viconte.jeanbaptiste@gmail.com', 'Mailer');
            $mail->addAddress($user['email'], $user['pseudo']);     // Add a recipient
            // $mail->addAddress('ellen@example.com');                 // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed'=> true));

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Nouveau mot de passe';
            $mail->Body    = '<a href="localhost/17edossier/newpassword.php?id=' . $user['id'] . '&token=' . $user['token'] . '">modifier mot de passe</a>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
          } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
          }
          // echo '<a href="newpassword.php?id=' . $user['id'] . '&token=' . $user['token'] . '">modifier mot de passe</a>';
        }

      } else{
        echo 'Entrez un email valide!';
      }
}




?>
<?php include('inc/header.php') ?>

<form method="post" action="">

  <label for="email" class="email">Entrer votre email : </pseudo>
  <input type="email" name="email" id="email" value="">
  <br />
  <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>

  <input class="submit" type="submit" name="submit" value="Envoyer">

</form>


<?php include('inc/footer.php') ?>
