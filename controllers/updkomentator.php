<?php

//obsługa aktualizacji ip dla komentatorów
 include_once "models/Mpe_Komentatorzy_Ip.class.php";
 $rejestrKomentatorow = new Mpe_Komentatorzy_Ip_Table($db);
 $ip=$_SERVER['REMOTE_ADDR'];
 if(isset($_POST['id'])){
    $id=$_POST['id'];
    $rejestrKomentatorow->updateKomentator($id, $ip);
 }
 header("Location: index.php");

