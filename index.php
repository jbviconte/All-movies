<?php $title = 'Home Front'; ?>
<?php include('inc/pdo.php') ?>
<link rel="stylesheet" href="assets/css/style.css">

<?php
?>
<?php include('inc/header.php') ?>

<h1>Home Front</h1>
<!--==========================Catégorie===================================== -->
<div>
  <h2>Catégorie</h2>

    <label><input type="checkbox" name="check" value="fantasy" />Fantasy</label><br />
    <label><input type="checkbox" name="check" value="action" />Action</label><br />
    <label><input type="checkbox" name="check" value="sci_fi" />Sci-Fi</label><br />
    <label><input type="checkbox" name="check" value="animation" />Animation</label><br />
    <label><input type="checkbox" name="check" value="romance" />Romance</label>
    <label><input type="checkbox" name="check" value="drama" />Drama</label>
    <label><input type="checkbox" name="check" value="thriller" />Thriller</label>
    <label><input type="checkbox" name="check" value="comedy" />Comedy</label>
    <label><input type="checkbox" name="check" value="crime" />Crime</label>
    <label><input type="checkbox" name="check" value="horror" />Horror</label>
    <label><input type="checkbox" name="check" value="familly" />Familly</label>
    <label><input type="checkbox" name="check" value="mystery" />Mystery</label>
    <label><input type="checkbox" name="check" value="adventure" />Adventure</label>
    <label><input type="checkbox" name="check" value="music" />Music</label>
    <label><input type="checkbox" name="check" value="war" />War</label>
    <label><input type="checkbox" name="check" value="biography" />Biography</label>
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
                  <form>
                      <label for="searchs" class="recherche">Rechercher :</label>
                      <input type="text" name="searchs" value="">
                  </form>
            </div>


<form>
<input type="submit" value="Rechercher">
</form>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
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
}, 20);

//==================== Recherche ===========================

function showThis(_div){
    var obj = document.getElementById("search");
    if(obj.style.display == "block") {
        obj.style.display = "none";
  } else {
        obj.style.display = "block";
      }
          $( "#research" ).click(function() {
          $( "#search" ).show( "slide", "right", 1000  );
          });
}



</script>

<br /><br /><br /><br /><br />

<form>
<input type="reset" value="+ de Film !">
</form>

<?php include('inc/footer.php') ?>
