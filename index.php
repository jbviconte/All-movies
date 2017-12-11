<?php $title = 'Home Front'; ?>
<?php include('inc/pdo.php') ?>
<?php session_start();?>
<?php include('helper/session.php'); ?>


<?php

$sql = "SELECT * FROM movies_full ORDER BY RAND() LIMIT 100";

              // preparation de la requête
        $stmt = $pdo->prepare($sql);
        // execution de la requête preparé
        $stmt->execute();
        $films = $stmt->fetchAll();

        //echo '<pre>';
        //print_r($films);
        //echo '</pre>';

?>

<!-- <link rel="stylesheet" href="assets/css/style.css"> -->




<?php include('inc/header.php') ?>

<!-- <form action="search.php" method="post">
  <label for="search" >Recherche</label>
  <input type="text" name="search" size="10">
<input type="submit" value="Ok">

</form> -->

<h1>Home Front</h1>
<!-- ==========================Catégorie===================================== -->
<div>
  <h2>Catégorie</h2>

    <label><input type="checkbox" name="check" value="fantastique" />Fantastique</label><br />
    <label><input type="checkbox" name="check" value="action" />Action</label><br />
    <label><input type="checkbox" name="check" value="syfy" />Science-Fiction</label><br />
    <label><input type="checkbox" name="check" value="anime" />Animation</label><br />
    <label><input type="checkbox" name="check" value="western" />Western</label><br />
    <label><input type="checkbox" name="check" value="amour" />Romance</label>
    <br />
    <button id = "bouton" value="1" onclick="checkUncheckALL();" >Tout cocher</button>


</div><br /><br />

<!--=========================Années========================================= -->
<div>
  <h2>Années</h2>
    <label for="year">Year:</label>
    <input type="text" id="year" readonly style="border:0; color:#f6931f; font-weight:bold;">
    <div id="slider-range"></div>
</div><br /><br />
<!--=====================Popularité========================================= -->
<div>
  <h2>Popularité</h2>
    <label for="popularite" class="popularite">Popularite :</label>
    <input type="range" name="popularite" min="1" max="5" value="">
</div><br /><br />
<!--=====================Recherche========================================== -->
<button id="research" value="1" onclick="showThis();">Filtres</button><br /><br />

<div id="search">
  <h2>Recherche</h2>
  <form action="search.php" method="post">
    <label for="search" class="recherche">Rechercher :</label>
    <input type="text" name="search" value="">
    <input type="submit" value="Rechercher">
  </form>
</div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">


//======================= Categorie ========================
var but = document.getElementById('bouton');
  but.addEventListener('click', function(){
   checkUncheck(but);
  }, false
 );
     function checkUncheck(but){
      console.log("checkUncheck");
      var checkboxes = document.getElementsByTagName('input');
      var coch = false;
       for (var i = 0 ; i < checkboxes.length ; i++){
        if (checkboxes[i].type == 'checkbox') {
        if(checkboxes[i].checked == false){
          coch = true;
         }
     }
       }
          if(coch == true) {
          console.log("choch=true");
           but.innerHTML = "Tout decocher";
           cocherdecocherTout(true);
          }else{
            console.log("choch=false");
            but.innerHTML = "Tout cocher";
            cocherdecocherTout(false);
          }
         }
             function cocherdecocherTout(boo){
             console.log("cocherdecocherTout:"+boo);
              var checkboxes = document.getElementsByTagName('input');
              for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
              checkboxes[i].checked = boo;
              }
               }
             }
//==================== année ===========================

 $( function() {
$( "#slider-range" ).slider({
range: true,
min: 1900,
max: 2017,
values: [ 1900, 2017 ],
slide: function( event, ui ) {
 $( "#year" ).val( + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
}
});
$( "#year" ).val( + $( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
} );

//==================== Recherche ===========================

$( function() {
  // run the currently selected effect
  function runEffect() {
    // get effect type from
    var selectedEffect = $( "bounce" ).val();

    // Most effect types need no options passed by default
    var options = {};
    // some effects have required parameters
    if ( selectedEffect === "bounce" ) {
      options = { percent: 50 };
    } else if ( selectedEffect === "size" ) {
      options = { to: { width: 280, height: 185 } };
    }

    // Run the effect
    $( "#search" ).show( selectedEffect, options, 500, callback );
  };

  //callback function to bring a hidden box back
  function callback() {
    setTimeout(function() {
      $( "#effect:visible" ).removeAttr( "style" ).fadeOut();
    }, 1000 );
  };

  // Set effect from select menu value
  $( "#research" ).on( "click", function() {
    runEffect();
  });

  $( "#search" ).hide();
} );

</script>

<br /><br /><br /><br /><br />

<form>
<input type="reset" value="+ de Film !">
</form>

<div class="film">

    <?php foreach ($films as $film) { ?>

      <p>titre        : <?php echo $film['title']; ?></p>
      <p>réalisateurs : <?php echo $film['directors']; ?></p>
      <p>cast         : <?php echo $film['cast']; ?></p>

        <a href="details.php?slug=<?= $film['slug']; ?>">
                <?php getImageFilm($film); ?>
        </a>

    <?php } ?>


<?php include('inc/footer.php') ?>
