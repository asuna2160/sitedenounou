<?php

require_once 'database1.php';
session_start();
//On vérifie que les conditions ont été acceptées
$conditions =$_POST['conditions'];
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
        <form method="post" action="formulaireinscriptionnounou.php">
            <input type="hidden" name="conditions" value="ON">
            <input type="submit" value="Retour au formulaire" /><br>   
        </form>   
    </body>
</html>   
<?php
}
else{

//On récupère le login et on vérifie qu'il n'ait pas été choisi par quelqu'un d'autre
$login=$_POST['login'];
$sql = $basedd->query('SELECT * FROM Nounou');
while ($données = $sql->fetch())
{
 //  Si le login a déjà été utilisé par un autre utilisateur
    if ($login ==$données['login']){
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
        <form method="post" action="formulaireinscriptionnounou.php">

<?php
        echo '<input type="hidden" name="login" value="' . $login . '">';
        echo '<p>Le login ' . $login . ' est déjà utilisé par un autre membre, veuillez en choisir un autre!</p><br>'
?>               
            <input type="submit" value="Choisir un autre login" /><br>
        </form>   
    </body>
</html>

<?php
            exit();
            break ;

    }

}

//On récupère le mot de passe
$mdp=$_POST['mdp'];

//On récupère le nom de la nounou
$nom=strtoupper($_POST['nom']);

//On récupère le prenom de la nounou
$prenom=$_POST['prenom'];

//On récupère la photo de la nounou
$target_dir ="uploads/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// On vérifie que l'image en est bien une, et pas une fausse image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        echo "Ce fichier est une image -" . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Ce fichier n'est pas une image.";
        $uploadOk = 0;
    }
}
// On vérifie que l'image n'existe pas déjà
if (file_exists($target_file)) {
    echo "Vous n'avez pas donné de photo ou bien cette photo a déjà été choisie par un membre. ";
    $uploadOk = 0;
}
// On vérifie que l'image ne soit pas trop grande
if ($_FILES["photo"]["size"] > 500000) {
    echo "Cette image est trop grande.";
    $uploadOk = 0;
}
// On accepte les formats suivant
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Seulement les formats JPG, JPEG, PNG & GIF sont authorisés.";
    $uploadOk = 0;
}
// On vérifie que UploadOK est bon, sinon on a 0 (erreur)
if ($uploadOk == 0) {
    echo " Selectionnez une autre photo.";
?>
<html>     
    <head>
        <title>Erreur</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post" action="formulaireinscriptionnounou.php">
            <input type="hidden" name="conditions" value="ON">
            <input type="submit" value="Retour au formulaire" /><br>   
        </form>   
    </body>
</html>   
<?php
    exit();
// Essaye d'uploader l'image dans uploads/ si tout est bon
} else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
 //       echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
    } else {
        echo "Une erreur s'est produite lors du téléchargement de l'image.";
    }
}

//On récupère les dimensions de l'image
$dimensions = getimagesize($_FILES['photo']['tmp_name']);
$width_orig = $dimensions[0];
$height_orig = $dimensions[1];

// On redimensionne le fichier si différent de 70*70px
    if($width_orig != 70 OR $height_orig != 70)
    {
        // Le fichier
        $filename = $target_file;
 
        // Définition de la largeur et de la hauteur maximale
        $width = 70;
        $height = 70;
 
        // Cacul des nouvelles dimensions
        $ratio_orig = $width_orig/$height_orig;
 
        if ($width/$height > $ratio_orig)
        {
           $width = $height*$ratio_orig;
        }
        else
        {
           $height = $width/$ratio_orig;
        }

        // Redimensionnement
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefrompng($filename . '1');
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
         
    }


//On récupère la ville de la nounou, on enlève les accents et on la met en majuscule car il peut arriver qu'on écrive différemment le nom de sa ville
$ville = strtoupper($_POST['ville']);
$accents = array('@','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý','à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ð','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ');
$replace = array('a','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','Y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y');
$ville=str_replace($accents, $replace, $ville);

//On récupère l'email de la nounou
$mail=$_POST['mail'];


//On récupère le numéro de portable de la nounou
$portable=$_POST['tel'];


//On récupère l'age de la nounou
$age=$_POST['age'];

//On récupère les langues de la nounou
$langues = array ('français', 'anglais', 'chinois', 'espagnol', 'italien', 'portugais', 'hindi', 'arabe', 'allemand', 'russe', 'hongrois'); 
foreach ($langues as $lang2){
    if (isset ($_POST[$lang2])){
        $listedeslangues = $listedeslangues . ' ' . $lang2;
}
}


//On récupère l'expérience de la nounou
$experience=$_POST['experience'];

//On récupère la phrase de présentation de la nounou
$presentation=$_POST['presentation'];

//On insère toutes ces données dans la base de données
$sql2 = "INSERT INTO Nounou (`login`, `motdepasse`, `nom`, `prenom`, `mail`, `ville`, `portable`, `langues`, `photo`, `age`, `experience`, `presentation`) VALUES(:login, :motdepasse, :nom, :prenom, :mail, :ville, :portable, :langues, :photo, :age, :experience, :presentation)";
$inse = $basedd->prepare($sql2);
$inse->execute (array(':login' => $login, ':motdepasse' => $mdp, ':nom' => $nom, ':prenom' => $prenom, ':mail' => $mail, ':ville' => $ville, ':portable' => $portable, ':langues' => $listedeslangues, ':photo' => $target_file, ':age' => $age, ':experience' => $experience, ':presentation' => $presentation));

//On note le numero de la nounou
$lirenumdenounou = $basedd->prepare("SELECT `numdenounou` FROM Nounou where login = ?");
    $lirenumdenounou->bindParam(1, $login);
    $lirenumdenounou->execute();
    $donnes1 = $lirenumdenounou->fetch();

   
    
    $_SESSION['num'] = $donnes1['numdenounou']; 
/*
<html>     
    <head>
        <title>Compte Créé</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
 
 */
?>

        <form method="post" action="pagedelanounou.php">
<?php

?>                    
            <p>Bravo ! Vous avez créé votre compte. Vous pouvez maintenant naviguer vers votre page.</p><br>
            <input type="submit" value="Naviguer vers mon compte" /><br>  

            
        </form>   
    </body>
</html>
<?php

}