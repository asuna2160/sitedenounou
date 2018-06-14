<?php

session_start();

require_once 'database1.php';
session_start();
 
$login = $_POST['login'];
$passwd=$_POST['passwd'];
$login_sth=$basedd->prepare("select count(*) from Nounou where login='$login' and motdepasse='$passwd'");
 
$login_sth->execute(array($login,$passwd));
$tot=$login_sth->fetchAll();
if($tot[0][0]==0)
{
    echo "Erreurs sur login ou mot de passer";
    require_once 'login1.php';
}
else
{
    
    
    $lirenumdenounou = $basedd->prepare("SELECT `numdenounou` FROM Nounou where login = ?");
    $lirenumdenounou->bindParam(1, $login);
    $lirenumdenounou->execute();
    $donnes1 = $lirenumdenounou->fetch();
    $_SESSION['num'] = $donnes1['numdenounou']; 
    require_once 'pagedelanounou.php';
}
 


?>
