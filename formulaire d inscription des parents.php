<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<title>inscription parents</title>

<style>
    p{
        color:dodgerblue;
        text-align: center;
        font-size: 50px;
        margin-top: 30px;
        background-color: orange;
    }

    .information{
        background-color: white;
    }

</style>

<!--<div class="title" style="background=image/baby1.tiff ">

-->

<p>CREER UN COMPTE PARENT</p>
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
?>

<!-- </div> -->
<hr>

<div class="information">
    <form method="post" action="traitementformulaireinscriptionparents.php" enctype="multipart/form-data">

<div class="ui form">
    <div class="fields">
        
        <div class="field">
            <label>Login :</label>
            <input name="login" id="login" type="text" placeholder="Votre login">
        </div>
        

        
        <div class="field">
            <label>Mot de passe :</label>
            <input name="mdp" id="mdp" type="text" placeholder="Votre mot de passe">
        </div>
        
        <div class="field">
            <label>Nom de famille :</label>
            <input name="nom" id="nom" type="text" placeholder="nom">
        </div>
        
        

        <div class="field">
            <label>Ville :</label>
            <input name = "ville" id="ville" type="text" placeholder="ville">
        </div>
        <div class="field">
            <label>Mail :</label>
            <input name="mail" id="mail" type="email" placeholder="mail">
        </div>

        <div class="field">
            <label>Informations generales :</label><br>
            <textarea name="infos" id="infos" rows="5" cols="80" placeholder="Vous souhaitez informez les nounous sur un point important de votre famille ?"></textarea>
        </div>



        <div class="required inline field">
            <div class="ui checkbox">
                <input name="conditions" id="conditions" type="checkbox" tabindex="0" class="hidden">
                <label>J'accepte les conditions d'utilisation et usages du site.</label>
            </div>
        </div>
    </div>
</div>
<input type="reset" value="ANNULER" />
<input type="submit" value="S'INSCRIRE">

</form>
</div>
</html>