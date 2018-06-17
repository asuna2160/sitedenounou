
<html>
<body style="background-color: aliceblue">
<link href="old/components/table.css" rel="stylesheet" media="screen" >

<?php
require_once 'database1.php';
session_start();
$num = $_SESSION['num'];

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









    <table class="ui celled striped table">
        <thead>
        <tr><th colspan="3">Planning </th>
        </tr></thead>
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


<?php
}
?>

        <form method="post" action="pagedelanounou.php">
            
            <input type="submit" value="Retour sur ma page" /><br>   
        </form>  


</body>
</html>

