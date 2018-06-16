<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'database1.php';
session_start();
$numparents=$_SESSION['num'];
$numnounou = $_POST['numdenounou'];
$enfants = array();
$lirenumdenfants = $basedd->prepare("SELECT * FROM Enfants where parent = ?");
    $lirenumdenfants->bindParam(1, $num);
    $lirenumdenfants->execute();
while ($donnes1 = $lirenumdenfants->fetch()){
    $numenfant = $donnes1["numero d'enfants"];
    $prenomenfant = $donnes1['prenom'];
    if (isset ($donnes1[$numenfant])){
        $enfants[] = $numenfant;
    }
}
$nbenfants = count($enfants);
