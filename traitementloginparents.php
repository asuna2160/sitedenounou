<?php

require_once 'database1.php';
if(!isset($_SESSION))
{
	session_start();
}
$login = $_POST['login'];
$passwd=$_POST['passwd'];
$login_sth=$basedd->prepare("select count(*) from Parent where login='$login' and motdepasse='$passwd'");
 
$login_sth->execute(array($login,$passwd));
$tot=$login_sth->fetchAll();
if($tot[0][0]==0)
{
     ?>
<form method="post" action="formulairepagedaccueil.php">          
    <p>Vous avez fait une erreur sur le login ou le mot de passe !</p><br>
    <input type="hidden" name="type" value="parent"/>
    <input type="submit" value="Réessayer" /><br>  
</form>    
    <?php
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