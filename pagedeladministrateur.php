<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page de l'administrateur</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body style="background-color: aliceblue">
<?php
    require_once 'database1.php';

    $nounousinscrites = $basedd->prepare("SELECT COUNT(*) FROM Nounou WHERE valide = 1");
    $nounousinscrites->execute();
    $nounins = $nounousinscrites->fetch();
    $candidaturenounous = $basedd->prepare("SELECT COUNT(*) FROM Nounou WHERE valide = 0");
    $candidaturenounous->execute();
    $nouncand = $candidaturenounous->fetch();
    $revenutotal = $basedd->prepare("SELECT SUM(revenu) FROM Nounou WHERE valide = 1");
    $revenutotal->execute();
    $revtot= $revenutotal->fetch();
?>
<div class="row">
    <div class="col-5">
        <div class="card ml-3 mt-3 md-3">
            <div class="card-header">
                Informations
            </div>
            <div class="card-body">
                <?php
                echo 'Nombre de nounous inscrites : ' . $nounins['COUNT(*)'] . '<br><br>';
                echo 'Nombre de candidatures de nounous : ' . $nouncand['COUNT(*)'] . '<br><br>';
                echo "Le chiffre d'affaire total est : " . $revtot['SUM(revenu)'] . " €<br><br>";
                ?>
            </div>
        </div>
        <div class="card ml-3 mt-3 md-3">
            <div class="card-header">
                Top des nounous les plus rentables par revenus
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Revenu</th>
                        <th scope="col">Lien</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $revenudecroiss = $basedd->prepare("SELECT * FROM Nounou WHERE`valide`=1 ORDER BY `revenu` DESC");
                        $revenudecroiss->execute();

                        while ($revdec= $revenudecroiss->fetch()){ ?>
                            <tr>
                                <td><?php echo($revdec['nom']) ?></td>
                                <td><?php echo($revdec['prenom']) ?></td>
                                <td><?php echo($revdec['revenu']) ?> € </td>
                                <td>
                                    <form method="post" action="traitementpagedeladministrateur.php" enctype="multipart/form-data">
                                        <input type="hidden" name="num" value="<?php echo($revdec['numdenounou']) ?>" />
                                        <input type="submit" value="Consulter le profil" class="btn btn-primary"/>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card mr-3 mt-3 md-3">
            <div class="card-header">
                Revenus par années et par mois :
            </div>
            <div class="card-body">
                <?php

                //Pour calculer et afficher les revenus par années et mois
                $anneeactuelle = date ("Y");
                $moisactuel= date ("m");


                $revenudumois = array();

                $lesmoisdelannee= array(
                    1 => 'Janvier',
                    2 => 'Février',
                    3 => 'Mars',
                    4 => 'Avril',
                    5 => 'Mai',
                    6 => 'Juin',
                    7 => 'Juillet',
                    8 => 'Aout',
                    9 => 'Septembre',
                    10 => 'Octobre',
                    11 => 'Novembre',
                    12 => 'Décembre');



                for($annee=2017; $annee<=$anneeactuelle; $annee=$annee+1){
                    $revenuan[$annee]=0;
                    for ($mois=1; $mois<= 12; $mois=$mois+1){
                        $revenudumois[$annee][$mois]=0;

                    }
                }

                $revenumois = $basedd->prepare("SELECT * FROM Prestation ORDER BY `jour fin` ASC");
                $revenumois->execute();
                while($revmois= $revenumois->fetch()){
                    $dateprestation=$revmois['jour fin'];
                    $num = explode('-' , $dateprestation);
                    for($annee=2017; $annee<=$anneeactuelle; $annee=$annee+1){

                        if ($num[0] == $annee){

                            $revenuan[$annee] = $revenuan[$annee] + $revmois['Montant'];

                            for ($mois=1; $mois<= 12; $mois=$mois+1){
                                if ($num[1] == $mois){

                                    $revenudumois[$annee][$mois] = $revenudumois[$annee][$mois] + $revmois['Montant'];



                                }
                            }

                        }


                    }
                }
                for($annee=2017; $annee<=$anneeactuelle; $annee=$annee+1){
                    echo '<h5>L\'année ' . $annee . ', le chiffre d affaire est de ' . $revenuan[$annee] . ' euros. </h5><br>';
                    if ($annee == $anneeactuelle){
                        for ($mois=1; $mois<= $moisactuel; $mois=$mois+1){
                            echo $lesmoisdelannee[$mois] . ' => ' . $revenudumois[$annee][$mois] . ' euros. <br>';
                        }
                    }
                    else {
                        for ($mois=1; $mois<= 12; $mois=$mois+1){
                            echo $lesmoisdelannee[$mois] . ' => ' . $revenudumois[$annee][$mois] . ' euros. <br>';
                        }
                    }
                    echo("<br>");
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>