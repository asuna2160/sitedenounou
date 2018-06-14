<?php

require_once 'database1.php';
session_start();
 
$login = $_POST['login'];
$passwd=$_POST['passwd'];
$login_sth=$basedd->prepare("select count(*) from Parent where login='$login' and motdepasse='$passwd'");
 
$login_sth->execute(array($login,$passwd));
$tot=$login_sth->fetchAll();
if($tot[0][0]==0)
{
    echo "Erreurs sur login ou mot de passer";
    require_once 'login1.php';
}
else
{
    $lirenumdeparents = $basedd->prepare("SELECT `numero de parent` FROM PARENT where login = ?");
    $lirenumdeparents->bindParam(1, $login);
    $lirenumdeparents->execute();
    $donnes1 = $lirenumdeparents->fetch();
    $_SESSION['num'] = $donnes1['numero de parent']; 
    require_once 'pagedesparents.php';
}
 
?>