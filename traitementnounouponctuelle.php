
<html>
    <head>
        
        
        
    </head>

<?php
require_once 'database1.php';
session_start();
$num=$_SESSION['num'];

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$enfantsgardes = array();
$lirenumdenfants = $basedd->prepare("SELECT * FROM Enfants where parent = ?");
    $lirenumdenfants->bindParam(1, $num);    
    $lirenumdenfants->execute();
    
    while($lirenenf = $lirenumdenfants -> fetch()){        
        if (isset ($_POST[$lirenenf["numero d'enfants"]])){
            $enfantsgardes[] = $lirenenf["numero d'enfants"];
        }
    }

 $_SESSION['nbenfants'] = count ($enfantsgardes);
 $_SESSION['enfants'] = implode (' ', $enfantsgardes);
 
 
 
$_SESSION['type'] = $_POST['type'];



$recurrence = $_POST['recurrence']; 
$type1 = $_POST['type'];
$typearegarder = array(
    'ponctuellement' => 0,
    'regulierement' => 1
);
$type = $typearegarder[$type1];
$JD=$_POST['JD'];
$JF=$_POST['JF'];
//var_dump($_POST);
$moisenchiffres = array(
    "Janvier" => "01",
    "Février" => "02",
    "Mars" => "03",
    "Avril" => "04",
    "Mai" => "05",
    "Juin" => "06",
    "Juillet" => "07",
    "Aout" => "08",
    "Septembre" => "09",
    "Octobre" => "10",
    "Novembre" => "11",
    "Décembre" => "12"
);




$explose = explode(' ', $JD);
    $explose[1] = $moisenchiffres[$explose[1]];
    $JD = $explose[2] . '-' . $explose[1] . '-' . $explose[0];
    
$explose = explode(' ', $JF);
    $explose[1] = $moisenchiffres[$explose[1]];
    $JF = $explose[2] . '-' . $explose[1] . '-' . $explose[0];
    



$HD=$_POST['HD'];
$HF=$_POST['HF'];

$_SESSION['HD']=$HD;
$_SESSION['HF']=$HF;      


$HD = $JD . ' ' . $HD;
$HF = $JF . ' ' . $HF;


$_SESSION['JD']=$JD;
$_SESSION['JF']=$JF;

//echo $JD . '<br>';
//echo $JF . '<br>';

//var_dump($_POST);


$nounoudisponible= array();
$alreadyused = 0; 
//echo 1;
$lire = $basedd->prepare("SELECT * FROM Disponibilite where `jour debut` <= ? and `jour fin` >= ? ");
$lire->bindParam(1, $JD);
$lire->bindParam(2, $JF);
//var_dump($lireinfosnounou);
//echo '<br>' . 12;
$lire->execute();
//echo 3;
while ($donnoun = $lire->fetch())
{
 //echo 1;
    $numdenounou=$donnoun['nounou'];
    foreach($nounoudisponible as $value){
        if ($numdenounou == $value){
//            echo 'a';
            $alreadyused = $alreadyused + 1;
 //           echo $alreadyused;
        }
    }
    if ($alreadyused <= 1){
    $nounoudisponible[] = $numdenounou;
    
    
    }
    $alreadyused = 0;
}
/* 
$lireinfosnounou1 = $basedd->prepare("SELECT * FROM Nounou,Evaluation where nounou=numdenounou");
$lireinfosnounou1->execute();
$donnoun1 = $lireinfosnounou1->fetch();
*/ 
    /*
$numdenounou=$donnoun['nounou'];
$nounoudisponible[] = $numdenounou;
    foreach ($nounoudisponible as $value) {
        if($numdenounou == $value){
            exit(1);
           
        }
 
    }
    

    
    
/*
$nom=$donnoun['nom'];
$prenom=$donnoun['prenom'];
$ville=$donnoun['ville'];
$email=$donnoun['mail'];
$portable=$donnoun['portable'];
$langue=$donnoun['langues'];
$image=$donnoun['photo'];
$age=$donnoun['age'];
$experience=$donnoun['experience'];
$presentation=$donnoun['presentation'];
$note=$donnoun1['note'];
    foreach ($nounoudisponible as $value) {
        if($numdenounou == $value){
            exit(1);
           
        }
 
    }
$nounoudisponible[] = $numdenounou;
 * 
 */
$lireinfosnounou = $basedd->prepare("SELECT * FROM Nounou");
    $lireinfosnounou->execute();
    while ($donnee = $lireinfosnounou->fetch()){
        $numdenounou = $donnee['numdenounou'];
        foreach ($nounoudisponible as $value){
            if ($numdenounou == $value){
                $nom=$donnee['nom'];
                $prenom=$donnee['prenom'];
                $ville=$donnee['ville'];
                $email=$donnee['mail'];
                $portable=$donnee['portable'];
                $langue=$donnee['langues'];
                $image=$donnee['photo'];
                $age=$donnee['age'];
                $experience=$donnee['experience'];
                $presentation=$donnee['presentation'];
                $note=$donnee['note'];




?>
 
    
<link href="./components/card.css" rel="stylesheet" media="screen" >
<link rel="stylesheet" type="text/css" href="CSS.css">
<div class="ui card">
    <div class="content">
        <div class="header"><?php echo $nom; echo $prenom?></div>
    </div>
    
<?php

print '<img class=\'trombi\' src="' . $image . '" alt="texte alternatif" />';

?>
    
    <div class="content">
        <h4 class="ui sub header"> INFORMATION</h4>
        <div class="ui small feed">
            <div class="event">
                <div class="content">
                    <div class="summary"><a>AGE:</a><a><?php echo $age;?></a></div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary"><a>Ville:</a><a><?php echo $ville;?></a></div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary"><a>PORTABLE:</a> <?php echo $portable;?> <a> </div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary"><a>LANGUES:</a><a><?php echo $langue;?> </a>  </div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary"><a>EXPERIENCE:</a><a><?php echo $experience;?> </a>  </div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary"><a>PRESENTATION:</a><a><?php echo $presentation;?> </a>  </div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary"><a>NOTE:</a><a><?php echo $note;?> </a>  </div>
                </div>
            </div>
 
        </div>
    </div>
    <div class="extra content">
        <form method="post" action="paiementnounou.php">
            
<?php
$_SESSION['numdenounou']= $numdenounou;

?>
        <button class="ui button">CHOISIR</button>
        </form>
    </div>
</div>
 
 
 
 
</html>
<?php
            }
        }
    }
