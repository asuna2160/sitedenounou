<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page Parent</title>
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



$lireinfosparents = $basedd->prepare("SELECT * FROM PARENT where `numero de parent`= ?");
$lireinfosparents->bindParam(1, $num);
$lireinfosparents->execute();
$donpar = $lireinfosparents->fetch();
$nom = $donpar['nom'];
$ville = $donpar['ville'];
$mail = $donpar['mail'];
$infos = $donpar['infos'];
$mdp = $donpar['motdepasse'];
$login = $donpar['login'];
?>
<div class="row">
    <div class="col-4">
        <div class="card m-3">
            <div class="card-header">
                Informations
            </div>
            <div class="card-body">
				<?php
				echo 'Bonjour ' . $login .'<br>';
				echo 'Monsieur, Madame ' . $nom . '<br>';
				echo 'Domiciliés à ' . $ville . '<br>' ;
				echo 'Contact : ' . $mail . '<br><br>';
				?>
            </div>
        </div>
        <div class="card m-3">
            <div class="card-header">
                Ajout d'enfants
            </div>
            <div class="card-body">
                <form method="post" action="formulairedajoutdunenfant.php">
                    <div class="field">
                        <label>Vous souhaitez ajouter des enfants ?</label>
                        <div class="input-group">
							<?php echo '<input type="hidden" name="numdeparent" value="' . $num . '">'; ?>
                            <input type="number" class="form-control" placeholder="Nombre d'enfants à ajouter">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card m-3">
            <div class="card-header">
                Réserver une nounou
            </div>
            <div class="card-body">
				<?php
				$lirenumdenfants = $basedd->prepare("SELECT * FROM Enfants where parent = ?");
				$lirenumdenfants->bindParam(1, $num);
				$lirenumdenfants->execute();

				?>
                Vous souhaitez réserver une nounou ?
                <form method="post" action="demandedegarde.php">
                    <input type="submit" value="Reserver" class="btn btn-primary float-right"/><br>
					<?php
					$enfant=$lirenumdenfants->fetch();
					if(!isset($enfant)){
						echo '<input type="hidden" name="pasdenfant" value="0">';
					}
					echo '<input type="hidden" name="numdeparent" value="' . $num . '">';
					?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card m-3">
            <div class="card-header">
                Vos enfants
            </div>
            <div class="card-body">
				<?php
				$lireenfants = $basedd->prepare("SELECT * FROM ENFANTS where `parent` = ?");
				$lireenfants->bindParam(1, $num);
				$lireenfants->execute();

				while ($donenf = $lireenfants->fetch())
				{
					echo '<div><br>Prenom : ' . $donenf['prenom'] . '<br>Date de naissance : ' . $donenf['date de naissance'] . '<br>Restrictions : ' . $donenf['restrictions alimentaires'] . '</div>';

				}
				echo '<br>';
				?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

