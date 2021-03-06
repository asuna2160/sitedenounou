<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page Nounou</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="background-color: aliceblue">

<?php
require_once 'database1.php';

if(!isset($_SESSION))
{
	session_start();
}

$num=$_SESSION['num'];

$lireinfosnounou = $basedd->prepare("SELECT * FROM Nounou where `numdenounou`= ?");
    $lireinfosnounou->bindParam(1, $num);
    $lireinfosnounou->execute();
    $donnoun = $lireinfosnounou->fetch();
    $login = $donnoun['login'];
    $mdp = $donnoun['motdepasse'];
    $nom = $donnoun['nom'];
    $prenom = $donnoun['prenom'];
    $mail = $donnoun['mail'];
    $ville = $donnoun['ville'];
    $portable = $donnoun['portable'];      
    $langues = $donnoun['langues'];
    $photo = $donnoun['photo'];
    $age = $donnoun['age'];
    $experience = $donnoun['experience'];      
    $presentation = $donnoun['presentation'];
    $revenu = $donnoun['revenu'];

?>

<div class="row">
    <div class="col-4">
        <div class="card m-3">
            <div class="card-header">
                Informations
            </div>
            <div class="card-body">
                <?php
                echo 'Bonjour ' . $prenom . ' ' . $nom . '<br>';
                echo 'Domiciliés à ' . $ville . '<br>' ;
                echo 'Contact : <br>' . '0' . $portable . '<br>' .$mail;
                ?>
            </div>
        </div>
        <div class="card m-3">
            <div class="card-header">
                Actions
            </div>
            <div class="card-body text-center">
                <form action="disponibilite.php" method="POST" enctype="multipart/form-data">
                    <?php
                    echo '<input type="hidden" name="numdenounou" value="' . $num . '">';
                    ?>
                    <input type="submit" value="Ajouter une disponibilité" class="btn btn-outline-primary">
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
	    <?php
	    $typededispo = array(
		    0 => 'Ponctuelle',
		    1 => 'Reguliere'
	    );

	    $moisenlettres = array(
		    "01" => "Janvier",
		    "02" => "Février",
		    "03" => "Mars",
		    "04" => "Avril",
		    "05" => "Mai",
		    "06" => "Juin",
		    "07" => "Juillet",
		    "08" => "Aout",
		    "09" => "Septembre",
		    "10" => "Octobre",
		    "11" => "Novembre",
		    "12" => "Décembre"
	    );


	    $liredispos = $basedd->prepare("SELECT * FROM Disponibilite where nounou = ? AND `horaire reserve` = 0");
	    $liredispos->bindParam(1, $num);
	    $liredispos->execute();
	    while ($donnes1 = $liredispos->fetch()){





		    $type = $typededispo[$donnes1['type']];
		    $JD = $donnes1['jour debut'];
		    $JF = $donnes1['jour fin'];
		    $HD = $donnes1['heure debut'];
		    $HF = $donnes1['heure fin'];
		    $recurrence = $donnes1['reccurence'];




		    $explose1 = explode('-', $JD);
		    $explose1[1] = $moisenlettres[$explose1[1]];
		    $JD = $explose1[2] . ' ' . $explose1[1] . ' ' . $explose1[0];

		    $explose2 = explode('-', $JF);
		    $explose2[1] = $moisenlettres[$explose2[1]];
		    $JF = $explose2[2] . ' ' . $explose2[1] . ' ' . $explose2[0];

		    $explose3 = explode(' ', $HD);
		    $explose4 = explode('-', $explose3[0]);
		    $explose4[1] = $moisenlettres[$explose4[1]];
		    $HD = $explose4[2] . ' ' . $explose4[1] . ' ' . $explose4[0];
		    $explose5 = explode(':', $explose3[1]);
		    $HD = $HD . ' à ' . $explose5[0] . ' h ' . $explose5[1];

		    $explose6 = explode(' ', $HF);
		    $explose7 = explode('-', $explose6[0]);
		    $explose7[1] = $moisenlettres[$explose7[1]];
		    $HF = $explose7[2] . ' ' . $explose7[1] . ' ' . $explose7[0];
		    $explose8 = explode(':', $explose6[1]);
		    $HF = $HF . ' à ' . $explose8[0] . ' h ' . $explose8[1];


		    ?>
            <div class="card m-3">
                <div class="card-header">
                    Planning
                </div>
            <div class="card-body">
                <table class="ui celled striped table">
                    <tbody>
                    <tr>
                        <td class="collapsing"><i class="folder icon"></i> Type de disponibilité </td>
                        <td>  <?php echo $type;?></td>
                    </tr>
                    <tr>
                        <td><i class="file outline icon"></i> Date de début </td>
                        <td> <?php echo $HD;?></td>
                    </tr>
                    <tr>
                        <td><i class="file outline icon"></i> Date de fin </td>
                        <td><?php echo $HF;?></td>
                    </tr>
                    <tr>
                        <td><i class="file outline icon"></i> Récurrence</td>
                        <td> <?php echo $recurrence;?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
		    <?php
	    };

	    ?>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="old/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
