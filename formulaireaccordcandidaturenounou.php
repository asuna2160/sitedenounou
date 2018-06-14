<?php
require_once 'database1.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
<title>Candidature des nounous</title>
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

<h1>Proposition de nounous</h1>

<!-- 
</div> 
<hr>
-->

    <body>
        <form method="post" action="traitementaccordnounou.php" enctype="multipart/form-data">
        <link rel="stylesheet" type="text/css" href="CSS.css">
<?php

$liredemandenounou = $basedd->query("SELECT * FROM Nounou where valide = 0");

while ($do = $liredemandenounou->fetch())
{
    echo 'Nounou numero ' . $do['numdenounou'] . '<br>';
    $image = $do['photo'];
    print '<img class=\'trombi\' src="' . $image . '" alt="texte alternatif" />';
    echo '<br>';
    echo  $do['prenom'] . ' ';
    echo  $do['nom'] . '<br>';
    echo 'Email : ' . $do['mail'] . '<br>';
    echo 'Ville : ' . $do['ville'] . '<br>';
    echo 'tel : ' . $do['portable'] . '<br>';
    $langueparlees = explode(" ", $do['langues']);
    echo 'Langues parlées : <br>';
    foreach ($langueparlees as $value) {

        if ($value == ''){
        }
        else {
            echo '  - ' . $value . '<br>';
        }
    }
    echo 'Age : ' . $do['age'] . '<br>';
    echo 'Son expérience : ' . $do['experience'] . '<br>';
    echo 'Sa phrase de presentation : ' . $do['presentation'] . '<br>';
    echo '<br>';
    echo '<input type="radio" name="' . $do['numdenounou'] . '" value="valider">Accepter la nounou ';
    echo '<input type="radio" name="' . $do['numdenounou'] . '" value="refuser">Refuser la nounou';   
    echo '<br><br>';
}

?>
               

    

     
          

            <input type="reset" value="Annuler" />
            <input type="submit" value="Valider">

        </form>
    </body>
</html>