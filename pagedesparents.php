<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'database1.php';

session_start();

$num=$_SESSION['num'];



    $lireinfosparents = $basedd->prepare("SELECT * FROM PARENT where `numero de parent`= ?");
    $lireinfosparents->bindParam(1, $num);
    $lireinfosparents->execute();
    $donpar = $lireinfosparents->fetch();
    $nom = $donpar['nom'];
    $ville = $donpar['ville'];
    $mail = $donpar['mail'];
    $infos = $donpar['infos'];
    $mdp = $donpar['motdepasse'];      
    $login = $donpar['login'];

echo 'Bonjour ' . $login .'<br>';
echo 'Monsieur, Madame ' . $nom . '<br>';
echo 'Domiciliés à ' . $ville . '<br>' ;
echo 'Contact : ' . $mail . '<br><br>';



    $lireenfants = $basedd->prepare("SELECT * FROM ENFANTS where `parent` = ?");
    $lireenfants->bindParam(1, $num);
    $lireenfants->execute();
if (isset($donenf["numero d'enfants"])){
    echo 'Vos enfants : <br>';
}

while ($donenf = $lireenfants->fetch())
{
    echo '<div><br>Prenom : ' . $donenf['prenom'] . '<br>Date de naissance : ' . $donenf['date de naissance'] . '<br>Restrictions : ' . $donenf['restrictions alimentaires'] . '</div>';

}
echo '<br>';
//var_dump($donenf);
?>

<html>
    <head>
        <title>page de la nounou</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="CSS.css">
    </head>
    <body>
        <form method="post" action="formulairedajoutdunenfant.php">
            
            <div class="field">
            <label>Vous souhaitez ajouter des enfants ?</label>
            <input name="nbenfants" id="nbenfants" type="number"  min="1">
            </div>
            
            <div class="field">
            <input type="submit" value="Ajouter" /><br>  
<?php
echo '<input type="hidden" name="numdeparent" value="' . $num . '">';
?>
            </div>
          
        </form>   
    </body>
</html>

<?php

    



?>

<html>
    <head>
        <title>Louer une nounou</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="CSS.css">
    </head>
    
<?php

if (!isset($donenf["numero d'enfants"])){
    echo '<div class="field">
            <label>Il faut avoir des enfants pour avoir la chance de les faire garder !</label>
            </div>';
}
else{
    


?>
    <body>
        <form method="post" action="demandedegarde.php">
            <div class="field">
            <label>Vous souhaitez réserver une nounou ?</label>
            </div>
            <div class="field">
            
                <input type="submit" value="Réserver">


<?php
//$enfant=$lirenumdenfants->fetch();
if(!isset($enfant)){
    echo '<input type="hidden" name="pasdenfant" value="0">';
}
echo '<input type="hidden" name="numdeparent" value="' . $num . '"></div>';
}
?>
        </form>   
    </body>
</html>


