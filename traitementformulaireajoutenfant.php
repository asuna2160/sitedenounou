<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'database1.php';

if(!isset($_SESSION))
{
	session_start();
}

$num=$_POST['numdeparent'];


$nbenfants = $_POST['nbenfants'];




//Intégrer les enfants dans la base de données

$matriceenfant = array();

$sql = "INSERT INTO Enfants(`prenom`, `parent`, `date de naissance`, `restrictions alimentaires`) VALUES(:prenom, :parent, :naissance, :restrictions)";
$ins = $basedd->prepare($sql);

for ($i = 1; $i <= $nbenfants; $i++) {
    $matriceenfant[$i][1] = $_POST['prenom' . $i];
    $matriceenfant[$i][2] = $_POST['naissance' . $i];    
    $matriceenfant[$i][3] = $_POST['restrictions' . $i];

$ins-> execute (array(':parent' => $num, ':prenom' => $matriceenfant[$i][1], ':naissance' => $matriceenfant[$i][2], ':restrictions' => $matriceenfant[$i][3]));
}
$_SESSION['num'] = $num;

header('Location: pagedesparents.php');
exit();

?>
