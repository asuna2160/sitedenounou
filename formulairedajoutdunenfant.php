<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<title>Ajout d'enfants</title>
<head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<style>
    h1{
        color:dodgerblue;
        text-align: center;
        font-size: 50px;
        margin-top: 30px;
        background-color: orange;
    }

    .information{
        background-color: white;
    }

</style>

<!--<div class="title" style="background=image/baby1.tiff ">

-->

<h1>AJOUTER DES ENFANTS</h1>

<!-- 
</div> 
<hr>
-->

    <body>
        <form method="post" action="traitementformulaireajoutenfant.php" enctype="multipart/form-data">
    
<?php
$nbenfants = $_POST['nbenfants'];
$num=$_POST['numdeparent'];
echo '<input type="hidden" name="numdeparent" value="' . $num . '">';
echo '<input type="hidden" name="nbenfants" value="' . $nbenfants . '">';

?>
               

    

     
<?php
for ($i = 1; $i <= $nbenfants ; $i++){
            echo '<br><label for="prenom" >Prénom : </label><input name="prenom' . $i . '" id="prenom" type="text" placeholder="prenom">';   
            echo '<br><label for="naissance">Date de naissance : </label><input name="naissance' . $i . '" id="naissance" type="date" >';
            echo '<br><label for="Restrictions alimentaires">Restrictions alimentaires : </label><br><textarea name="restrictions' . $i . '" id="restrictions" rows="5" cols="80" placeholder="Ecrivez ici les restrictions alimentaires de votre enfant."></textarea><br>';
}
?>            

            <input type="reset" value="Effacer" />
            <input type="submit" value="Ajouter">

        </form>
    </body>
</html>