<?php
require_once 'database1.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$numdenounou = $_SESSION['numdenounou'];

$numdeparent=$_SESSION['num'];

$nbenfants= $_SESSION['nbenfants'];

$HD=$_SESSION['HD'];
$HF=$_SESSION['HF'];
$JD=$_SESSION['JD'];
$JF=$_SESSION['JF'];

$HDentiere = $JD . ' ' . $HD;
$HFentiere = $JF . ' ' . $HF;

$explose = explode(' ', $JD);
$exploseHD = explode(':',$HD);

$debutheure= $exploseHD[0];

$exploseHF = explode(':',$HF);

if ($exploseHF[1] == '00'){
    $finheure = $exploseHF[0];
}
else{
    $finheure = $exploseHF[0] + 1;
}


       
if ($JD == $JF){
    $duree= $finheure - $debutheure;
    
        }
else{
    $duree = 24 - $debutheure + $finheure;
        }




$prixalheure = 7;
$nbenfants= $nbenfants -1;
if ($nbenfants > 1){
    for ($i=1; $i=$nbenfants; $i=$i+1){
        $prixalheure = $prixalheure + 4;
    }
}
else{
    $prixalheure = $prixalheure + 4;
}
$prix = $prixalheure * $duree;

$type = $_SESSION['type'];

$enfants= $_SESSION['enfants'];


$sql2 = "INSERT INTO `Prestation`(`Type`, `Montant`, `Virement effectue`, `jour debut`, `jour fin`, `heure debut`, `heure fin`, `enfants`, `nounou`, `parent`) VALUES ( :type, :Montant, 1, :JD, :JF, :HD, :HF, :enfants, :nounou, :parents )";
$inse = $basedd->prepare($sql2);
$inse->execute (array(':type' => $type, ':Montant' => $prix, ':JD' => $JD, ':JF' => $JF, ':HD' => $HDentiere, ':HF' => $HFentiere, ':enfants' => $enfants, ':nounou' => $numdenounou, ':parents' => $numdeparent));









$lirenomdenounou = $basedd->prepare("SELECT * FROM Nounou where numdenounou = ?");
    $lirenomdenounou->bindParam(1, $numdenounou);
    $lirenomdenounou->execute();
    $donnes1 = $lirenomdenounou->fetch();


echo 'Vous devez payer ' . $prix . ' euros à madame ' . $donnes1['prenom'] . ' ' . $donnes1['nom'];

?>

<html>     
    <head>
        <title>OK</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post" action="pagedesparents.php">
            
            <input type="submit" value="Retour à ma page" /><br>   
        </form>   
    </body>
</html>



