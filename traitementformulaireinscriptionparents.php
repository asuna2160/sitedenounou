<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'database1.php';
session_start();

$nom= strtoupper($_POST['nom']);
$ville = strtoupper($_POST['ville']);
$mail=$_POST['mail'];
$infos=$_POST['infos'];
$login=$_POST['login'];
$mdp=$_POST['mdp'];
$conditions =$_POST['conditions'];

/*
echo $nom;
echo $ville;
echo $mail;
echo $infos;
echo $login;
echo $mdp;
*/



if (!isset($conditions)){
    echo "Pour poursuivre, vous devez accepter les Conditions Générales d'Utilisation !" ;
?>
    <html>     
    <head>
        <title>Erreur</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post" action="formulaire d inscription des parents.php">
            <input type="hidden" name="conditions" value="ON">
            <input type="submit" value="Retour au formulaire" /><br>   
        </form>   
    </body>
</html>
    
    
    
    
    
<?php
}
else{

$sql3 = $basedd->query('SELECT * FROM Parent');
while ($données3 = $sql3->fetch())
{
 //  Si le login a déjà été utilisé par un autre utilisateur
    if ($login ==$données3['login']){
 //       echo "<br> le login " . $données3['login'] . " est déjà utilisé par un autre membre !";
       $loginalreadyused = '1';

        ?>
    <html>     
    <head>
        <title>Compte Créé</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="tp02_exo4.css">
    </head>
    <body>
        <form method="post" action="formulaire d inscription des parents.php">

<?php
        echo '<input type="hidden" name="login" value="' . $login . '">';
?>               
            <p>Ce login est déjà utilisé par un autre utilisateur, veuillez en choisir un autre.</p><br>
            <input type="submit" value="Choisir un autre login" /><br>
        </form>   
    </body>
</html>

<?php
            break ;

    }

}

if (isset($loginalreadyused)){
}
else{
$sql = "INSERT INTO Parent (`nom`,`ville`,`mail`,`infos`,`login`,`motdepasse`) VALUES(:nom, :ville, :mail, :infos, :login, :mdp)";
$ins = $basedd->prepare($sql);
$ins-> execute (array(':nom' => $nom, ':ville' => $ville, ':mail' => $mail, ':infos' => $infos, ':login' => $login, ':mdp' => $mdp));

$lirenumdeparents = $basedd->prepare("SELECT `numero de parent` FROM PARENT where login = ?");
    $lirenumdeparents->bindParam(1, $login);
    $lirenumdeparents->execute();
    $donnes1 = $lirenumdeparents->fetch();
    $_SESSION['num'] = $donnes1['numero de parent']; 
?>
<html>     
    <head>
        <title>Compte Créé</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="tp02_exo4.css">
    </head>
    <body>
        <form method="post" action="pagedesparents.php">
<?php

        echo '<input type="hidden" name="num" value ="' . $_SESSION['num'] . '">';
?>                    
            <p>Bravo ! Vous avez créé votre compte. Vous pouvez maintenant naviguer vers votre page et inscrire vos enfants</p><br>
            <input type="submit" value="Naviguer vers mon compte" /><br>  
            
<?php
foreach ($données as $key => $value)
    echo '<input type="hidden" name="' . $key . '" value="' . $value . '" />'


?>
            
        </form>   
    </body>
</html>
<?php
}
}




?>
                                        
