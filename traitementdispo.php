<?php
/**
 * Created by PhpStorm.
 * User: daerlv
 * Date: 09/06/2018
 * Time: 18:14
 */
 
require_once 'database1.php';

if(!isset($_SESSION))
{
	session_start();
}

$num=$_POST['numdenounou'];
 
//var_dump($_POST);
//$recurrence = $_POST['recurrence']; 
//$type = $_POST['type'];
/*$typededispo = array(
    'ponctuellement' => 0,
    'regulierement' => 1
);
$type = $typededispo[$type];
*/

 $JD=$_POST['JD'];
 
$JF=$_POST['JF'];

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
/*function transformjour($olddate){
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
    $explose = explode(' ', $olddate);
    $explose[1] = $moisenchiffres[$explose[1]];
    $newdate = $explose[2] . '-' . $explose[1] . '-' . $explose[0];
    echo $newdate;
    $olddate = $newdate;
} 

*/


$explose = explode(' ', $JD);
    $explose[1] = $moisenchiffres[$explose[1]];
    $JD = $explose[2] . '-' . $explose[1] . '-' . $explose[0];
    
$explose = explode(' ', $JF);
    $explose[1] = $moisenchiffres[$explose[1]];
    $JF = $explose[2] . '-' . $explose[1] . '-' . $explose[0];
    
      



$HD=$_POST['HD'];
$HF=$_POST['HF'];



$HD = $JD . ' ' . $HD;
$HF = $JF . ' ' . $HF;
//echo $HF;

//$recurrence=$_POST['recurrence'];
 
/*
echo $JD . ' <br>';
echo $JF . ' <br>';
echo $HD . ' <br>';
echo $HF . ' <br>';
echo $num . ' <br>';
echo $recurrence . ' <br>';
echo $type . ' <br>';
*/
$sql = "INSERT INTO Disponibilite (`jour debut`, `jour fin`, `heure debut`, `heure fin`, `nounou`, `reccurence`, `horaire reserve`, `type`) VALUES (:JD,:JF,:HD,:HF,:nounou,'une seule fois','0')";

//echo 1;
$inse = $basedd->prepare($sql);
//echo 2;
$inse->execute (array(':JD' => $JD, ':JF' => $JF, ':HD' => $HD, ':HF' => $HF, ':nounou' => $num));
//var_dump($inse);

$_SESSION['num'] = $num;
//var_dump($_SESSION);
//header('Location: pagedelanounou.php');
//header('Location: planning.php');
exit();
//header('Location: http://www.example.com/');
//exit;
?>