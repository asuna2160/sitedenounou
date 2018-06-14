
<?php
$conditions =$_POST['conditions'];
$login = $_POST['login'];
if (isset($conditions)){
    echo "Vous devez accepter les Condiitions d'Utilisation pour poursuivre.";
}
if (isset($login)){
    echo 'Le login ' . $login . ' est déjà utilisé. Veuillez en choisir un autre.';
}
unset ($login);
unset ($_POST['conditions']);

 ?>
 
<html>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<title>Inscription nounou</title>
<style>
    h1{
        color:dodgerblue;
        text-align: center;
        font-size: 50px;
        margin-top: 30px;
        background-color: orange;
    }
</style>



<h1>DEVENIR NOUNOU</h1>
    <body>
        <form method="post" action="traitementinscriptionnounou.php" enctype="multipart/form-data">
            <label>Login: </label>
            <input name="login" id="login" type="text" placeholder="login"><br>
            <label>Mot de passe : </label>
            <input name="mdp" id="mdp" type="text" placeholder="votre mot de passe"><br>
            <label>Nom</label>
            <input name="nom" id="nom" type="text" placeholder="nom"><br>
            <label>Prenom</label>
            <input name="prenom" id="prenom" type="text" placeholder="prenom"><br>
            <label for="photo" title="Recherchez le fichier à uploader !">Votre photo </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="MAX_SIZE" />
            <input type="file" name="photo" id="photo"><br>
            <label>Ville</label>
            <input name = "ville" id="ville" type="text" placeholder="ville"><br>
            <label>Mail</label>
            <input name="mail" id="mail" type="email" placeholder="mail"><br>
            <label>Portable</label>
            <input name="tel" id="tel" type="tel" placeholder="portable"><br>
            <label>Age</label>
            <input name="age" id="age" type="number" placeholder="age" min="13"><br>
            <label>Langues Parlées</label><br>
<?php
$langues = array ('français', 'anglais', 'chinois', 'espagnol', 'italien', 'portugais', 'hindi', 'arabe', 'allemand', 'russe', 'hongrois'); 
foreach ($langues as $lang){
    echo '<div><input name="' . $lang . '" id="' . $lang . '" type ="checkbox" >' . $lang . '</div>';
}
?>  
            <label>Experience:</label><br/>
            <textarea name="experience" id="experience" rows="5" cols="80"></textarea><br/>
            <label>Phrase de présentation:</label><br/>
            <textarea name="presentation" id="presentation" rows="5" cols="80"></textarea><br/>
            <input name="conditions" id="conditions" type="checkbox">
            <label>J'accepte les conditions d'utilisation et usages du site.</label><br>
            
            
            
            <input type="reset" value="Effacer" />
            <input type="submit" value="Ajouter">

        </form>
    </body>
</html>