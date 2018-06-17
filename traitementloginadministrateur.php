<?php

require_once 'database1.php';
if(!isset($_SESSION))
{
	session_start();
}
$login = $_POST['login'];
$passwd=$_POST['passwd'];

$logindeladministrateur = 'admin01';
$mdpdeladministrateur = 'mdp01';

if ( $login=='admin01' && $passwd == 'mdp01' )
{
        require_once 'pagedeladministrateur.php';
}
else
{
    echo "Erreurs sur le login ou le mot de passe";
    require_once 'formulairepagedaccueil.php';

}
 
?>