<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_SESSION))
{
	session_start();
}

$_SESSION['num'] = $_POST['num'];
//var_dump($_SESSION);
header('Location: pagedelanounou.php');