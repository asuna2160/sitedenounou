<?php

require_once 'database1.php';

if(!isset($_SESSION))
{
	session_start();
}

if(isset($_POST['login']) and isset($_POST['passwd'])){
	$login = $_POST['login'];
	$passwd=$_POST['passwd'];

	$login_sth=$basedd->prepare("select count(*) from Nounou where login='$login' and motdepasse='$passwd'");

	$login_sth->execute(array($login,$passwd));
	$tot=$login_sth->fetchAll();
} else {
    $tot = null;
}

if($tot[0][0]==0)
{
 
    ?>
<form method="post" action="formulairepagedaccueil.php">          
    <p>Vous avez fait une erreur sur le login ou le mot de passe !</p><br>
    <input type="hidden" name="type" value="nounou"/>
    <input type="submit" value="Réessayer" /><br>  
</form>    
    <?php

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
