<?php
include_once "models/Mpe_Komentarze.class.php";
$komentarze = new Mpe_Komentarze_Table($db);

$akcja = (isset($_GET['action']))? $_GET['action']: '';
switch ($akcja) {
    case 'dodaj':
        $addNewItem = isset($_POST["nowy-komentarz"]);
        if ($addNewItem){
            foreach($_POST as $KEY=>$VAL){
                if($KEY !== "nowy-komentarz") $columnsArr[$KEY]=iconv("UTF-8","WINDOWS-1250",$VAL);
            }
            try{
                $columnsArr['STATUS']='O';
                $komentarze->addNewItem($columnsArr);
                } catch (Exception $ex) { //ten modu³ error_on = false w OCI
                    $adminMessageHtml['error'] = $ex->getMessage();
                    return include_once "views/table-html.php";
                }
                $options = 1;
                echo $options;
                exit();
        }else{
            return include_once "views/add-edit-html.php";
        }
        
        break;
    case 'usun':
        $idFound = isset($_GET['id'])? $_GET['id']: '';
        if ($idFound){
            try{
                $komentarze->deleteItem($idFound);
                } catch (Exception $ex) { //ten modu³ error_on = false w OCI
                    $adminMessageHtml['error'] = $ex->getMessage();
                    $rowsDataArray = $komentarze->getAllOpen();
                    return include_once "views/table-html.php";
                }
            $adminMessageHtml['success'] = 'Pozycja zosta³a prawid³owo usuniêta';
        }else{
            $adminMessageHtml['error'] = 'Brak pozycji, dla której ma nast¹piæ usuniêcie';
        }
            $rowsDataArray = $komentarze->getAllOpen();
            return include_once "views/table-html.php";
        
        break;

    default:
        
        $rowsDataArray = $komentarze->getAllOpen();
        return include_once "views/table-html.php";
        
        break;
}


