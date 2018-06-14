<?php
require_once 'database1.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$liredemandenounou = $basedd->query("SELECT * FROM Nounou where valide = 0");

$nounousvalidees = array ();
$nounoussupprimees = array ();

while ($do = $liredemandenounou->fetch()){
    if ($_POST[$do['numdenounou']] == 'valider'){
        $req = $basedd->prepare('UPDATE Nounou SET `valide` = 1 WHERE `numdenounou` = ?');
        $req->execute(array($do['numdenounou']));
        $nounousvalidees [] = $do['prenom'];
    }
    else{
        $req = $basedd->prepare('DELETE FROM `Nounou` WHERE `Nounou`.`numdenounou` = ?');
        $req->execute(array($do['numdenounou']));    
        $nounoussupprimees [] = $do['prenom'];
    }
}

echo 'Vous avez accepté ';
foreach ($nounousvalidees as $nounou){
    echo $nounou . ' ';
    }
echo '<br>';
echo 'Vous avez refusé ';
foreach ($nounoussupprimees as $nounou){
    echo $nounou . ' ';
    }
echo '<br>';


