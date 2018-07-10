<?php

 //obs³uga logowania przez komentatorów
 include_once "models/Mpe_Komentatorzy_Ip.class.php";
 include_once "models/Mpe_Komentarze.class.php";
 $rejestrKomentatorow = new Mpe_Komentatorzy_Ip_Table($db);

 $ip=$_SERVER['REMOTE_ADDR'];
 //sprawdzamy czy mamy go w tabeli komentatorow
 $komentator = $rejestrKomentatorow->getComentatorByIp($ip);
 if($komentator){
     //jeœli istnieje komentator wrzucamy go do sekcji nawigacji
     $loginTxt = $komentator[0]['IMIE'].' '.$komentator[0]['NAZWISKO'];   
     $pageData->content = include_once 'views/navigation-html.php';
     include_once "models/Mpe_Rejestr_Zasilen.class.php";
     $rejestrZasilen = new Mpe_Rejestr_Zasilen_Table($db); 
     $komentarze = new Mpe_Komentarze_Table($db);
     //sprawdzamy czy wys³ano ¿¹danie anulowania pozycji
     if(isset($_POST['anulowanie'])&&(isset($_POST['id']))){
         $id = (int) $_POST['id'];
         $status = 'A';
         $id_komentatora = (int) $komentator[0]['ID'];
         $komentarz = isset($_POST['komentarz'])? $_POST['komentarz'] : 'nie dotyczy';
         $rejestrZasilen->updateComment($id,$komentarz,$status,$id_komentatora,$ip);
         $message = 'Pozycja zosta³a anulowana.';
     }else{
        //sprawdzamy czy wyslano formularz
        if (isset($_POST['komentarz'])&&(isset($_POST['id']))){
           if(strlen(trim($_POST['komentarz']))>0){
               //pobieramy id, dla którego ma byæ wykonany insert
               $id = (int) $_POST['id'];
               //pobieramy komentarz
               $komentarz = $_POST['komentarz'];
               //insertujemy komentarz do tabeli rejestrow
               $id_komentatora = (int) $komentator[0]['ID'];
               //na podstawien numerzu zasilenia pobierz teraz dane dla insertu do maili oczekujacych
               include_once "models/Mpe_Email_Oczekujace.class.php";
               $maileOczekujace = new Mpe_Email_Oczekujace_Table($db);
               $listaMaili = $maileOczekujace->getReceiverEmailList($id);
               if(count($listaMaili)>0){
                   $status = 'Z';
                   $rejestrZasilen->updateComment($id,$komentarz,$status,$id_komentatora,$ip);
                   foreach ($listaMaili as $row){
                   $email = $row['EMAIL'];
                   $tekst_alarmu = $row['TEKST_ALARMU'];
                   $data_danych = $row['DATA_DANYCH'];
                   $myDateTime = DateTime::createFromFormat('y/m/d', $data_danych);
                   $newDateString = $myDateTime->format('Y-m-d');
                   $data_danych = (string) $newDateString;
                   $maileOczekujace->InsertAwaitingEmail($email, $tekst_alarmu, $data_danych, $komentarz);
                   }
                   $message = 'Komentarz zosta&#322; dodany do listy wysy&#322;kowej.';
               }else{
                   $error = "Brak przypisanych odbiorów email dla pozycji <b>$id</b>. Wiadomoœci dla rejestru <b>$id</b> nie zosta³y wys³ane.";
               }   
           }else{
               $error = 'Komentarz jest pusty, proszê poprawiæ.';
           }   
        }else if(isset($_POST['id'])){
            $error = "Proszê wybraæ komentarz z listy!";
        }
     }
    

     $brakiZasilen = $rejestrZasilen->getAllNotCompleted(); 
     $optionHtml = $komentarze->getAllEntriesOptions();
     $view = include_once "views/main-html.php";
     $view .= include_once "views/templates/modal-mymodal-html.php";
 }else{
     $loginTxt = "niezalogowany";
     $pageData->content = include_once 'views/navigation-html.php';
     $optionsHtml = $rejestrKomentatorow->getAllComentators();
     $view = include_once "views/login-html.php";
 }


return $view;

