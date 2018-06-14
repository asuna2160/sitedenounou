<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'database1.php';

$nounousinscrites = $basedd->prepare("SELECT COUNT(*) FROM Nounou WHERE valide = 1");
$nounousinscrites->execute();
$nounins = $nounousinscrites->fetch();
echo 'Nombre de nounous inscrites : ' . $nounins['COUNT(*)'] . '<br><br>';

$candidaturenounous = $basedd->prepare("SELECT COUNT(*) FROM Nounou WHERE valide = 0");
$candidaturenounous->execute();
$nouncand = $candidaturenounous->fetch();
echo 'Nombre de candidatures de nounous : ' . $nouncand['COUNT(*)'] . '<br><br>';

$revenutotal = $basedd->prepare("SELECT SUM(revenu) FROM Nounou WHERE valide = 1");
$revenutotal->execute();
$revtot= $revenutotal->fetch();
echo "Le chiffre d'affaire total est : " . $revtot['SUM(revenu)'] . "<br><br>";

$revenudecroiss = $basedd->prepare("SELECT * FROM Nounou WHERE`valide`=1 ORDER BY `revenu` DESC");
$revenudecroiss->execute();
echo "Top des nounous les plus rentables par revenus : <br><br>";
while ($revdec= $revenudecroiss->fetch()){
    echo 'Avec ' . $revdec['revenu'] . ' euros de recette, '. $revdec['prenom'] . ' ' . $revdec['nom'] . ' ';
    $numdenounou = $revdec['numdenounou'];

?>   
<html>
<head>        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post" action="traitementpagedeladministrateur.php" enctype="multipart/form-data">
<?php

echo '<input type="hidden" name="num" value="' . $numdenounou . '" >';
?>
            <input type="submit" value="Consulter le profil"/>
        </form>
    </body>
</html>
    
<?php    
}




//Pour calculer et afficher les revenus par années et mois
$anneeactuelle = date ("Y");
$moisactuel= date ("m");


$revenudumois = array();
    
$lesmoisdelannee= array(
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Aout',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre');



for($annee=2017; $annee<=$anneeactuelle; $annee=$annee+1){
    $revenuan[$annee]=0;
    for ($mois=1; $mois<= 12; $mois=$mois+1){
        $revenudumois[$annee][$mois]=0; 
        
    }
}

$revenumois = $basedd->prepare("SELECT * FROM Prestation ORDER BY `jour fin` ASC");
$revenumois->execute();
while($revmois= $revenumois->fetch()){
    $dateprestation=$revmois['jour fin'];
    $num = explode('-' , $dateprestation);
    for($annee=2017; $annee<=$anneeactuelle; $annee=$annee+1){
        
        if ($num[0] == $annee){

            $revenuan[$annee] = $revenuan[$annee] + $revmois['Montant'];
            
            for ($mois=1; $mois<= 12; $mois=$mois+1){
                if ($num[1] == $mois){

                    $revenudumois[$annee][$mois] = $revenudumois[$annee][$mois] + $revmois['Montant'];

                    
                    
                }
            }  
            
        } 
        
 
    }   
}
echo '<p>Revenus par années et par mois : </p>';
for($annee=2017; $annee<=$anneeactuelle; $annee=$annee+1){
    echo '<br> L année ' . $annee . ', le chiffre d affaire est de ' . $revenuan[$annee] . ' euros. <br>';
    if ($annee == $anneeactuelle){
        for ($mois=1; $mois<= $moisactuel; $mois=$mois+1){
        echo $lesmoisdelannee[$mois] . ' => ' . $revenudumois[$annee][$mois] . ' euros. <br>'; 
        }
    }
    else {
        for ($mois=1; $mois<= 12; $mois=$mois+1){
            echo $lesmoisdelannee[$mois] . ' => ' . $revenudumois[$annee][$mois] . ' euros. <br>'; 
        }  
    }
}            



