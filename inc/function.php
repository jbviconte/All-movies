<?php

// function connection et déconnetion visible/non-visible
function connecLogin(){
  if(!empty($_SESSION)) {
    if (!empty($_SESSION['user']['pseudo']) && !empty($_SESSION['user']['id']) && is_numeric($_SESSION['user']['id']) && !empty($_SESSION['user']['role']) && !empty($_SESSION['user']['ip']) && $_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
      return true;
    }
  }
  return false;
}


//fonction affichage image sur page détails
function getImageFilm($film)
{
	echo '<img src="posters'.$film['id'].'.jpg" alt="'.$film['id'] .'">';
}
