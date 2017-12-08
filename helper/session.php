<?php

if(!empty($_COOKIE['usercook']) && empty($_SESSION['user'])){

  $auth = $_COOKIE['usercook'];
	$auth = explode('---',$auth);

  $sql = "SELECT * FROM users WHERE id = :id";
  $queryCook = $pdo->prepare($sql);
  $queryCook->bindValue(':id',$auth[0]);
  $queryCook->execute();
  $user = $queryCook->fetch();

  if(!empty($user)){
    $key = sha1($user['pseudo'].$user['password'].$_SERVER['REMOTE_ADDR']);
    if($key == $auth[1]) {
			$_SESSION['user'] = array(
    			'id'     => $user['id'],
    			'pseudo' => $user['pseudo'],
    			'role'   => $user['role'],
          'ip'     => $_SERVER['REMOTE_ADDR'],
    		);
        setcookie('usercook', $user['id'] . '---' . $key , time() + 3600 * 24 * 5,'/');
    		echo 'Bon retour parmi nous '. $user['pseudo'];
    } else{
        setcookie('usercook', '', time() - 3600 , '/');
    }
  }
}
