<?php

$labelsArray = array(
        'columnNames'=>array(
            'ID'=>array(
                'title'=>'Id',
                'tooltip'=>'Numer porz¹dkowy',
                ),
            'TRESC'=>array(
                'title'=>'Pe³na treœæ komentarza',
                'tooltip'=>'Pe³na treœæ komentarza',
                ),
            ),
        'buttonsMain'=>array(
            'Delete' => array(
                            'link'=>'index.php?option=komentarze&action=usun&modal=true&id=',
                            'linkAttr'=>' data-toggle=modal data-target=#delete-modal data-href=index.php',
                            'class'=>'danger',
                            'faClass'=>'trash',
                            'text'=>'Usuwanie pozycji ',
                            ),
            ),
        'id'=>'ID',
        'tableClass'=>'table table-striped',
        'tableName'=>'Komentarze',
        'showInModal'=>true,
        'headerTitle' => "Lista komentarzy",
           'headerButtons'=>array(     
                        'Add' => array(
                                        'link'=>'index.php?option=komentarze&modal=true&action=dodaj',
                                        'class'=>'primary',
                                        'faClass'=>'plus',
                                        'text'=>'Nowy komentarz',
                                        ),
                        ),
    
        );

$naglowkiKolumnHTML = "<tr>";
$naglowkiKolumn = $labelsArray['columnNames'];

foreach ($naglowkiKolumn as $key => $naglowek){ 
    $toolTip = isset($naglowek['tooltip'])? "data-toggle='tooltip' data-placement='bottom' title='{$naglowek['tooltip']}'": '';
    $title = isset($naglowek['title'])? $naglowek['title']:$naglowek;
    $naglowkiKolumnHTML .= "<th data-field='{$key}' data-sortable='true'><span $toolTip >$title</span></th>";
}

if (isset($labelsArray['buttonsMain'])){ //Jeœ³i g³ówne przyciski s¹ w³¹czone, wtedy renderuj dodatkow¹ kolumnê opcji
    $naglowkiKolumnHTML .= "<th>Opcje</th>";
}
$naglowkiKolumnHTML .="</tr>";
$id = isset($labelsArray['id'])? $labelsArray['id']:'';
$det = isset($labelsArray['details'])? $labelsArray['details']:'';
$targetModal = isset($labelsArray['showInModal'])? 'data-target=#myModal':'';
$wierszeHTML = "";
    foreach($rowsDataArray as $key=>$row){
    $tdHtml = '';
        //jeœli potrzebujemy dodatkowe informacje aby wygenerowaæ link do innej strony mo¿emy u¿yæ $linkAdd
        $linkAdd = isset($labelsArray['linkAdd'])? $row[$labelsArray['linkAdd']]:'';
        $wierszeHTML .= "<tr>";    
        foreach (array_keys($naglowkiKolumn) as $nazwaKolumny){ //pierwsza seria przycisków
            $tdHtml .= "<td data-{$nazwaKolumny}='{$row[$nazwaKolumny]}'>$row[$nazwaKolumny]</td>";  
        }
        if (isset($labelsArray['buttonsMain'])){
            $buttonsHtml = '';
                //generowanie przycisków w kolumnie Opcje        
                foreach ($labelsArray['buttonsMain'] as $button){ //druga seria przycisków       
                    
                        $link = $button['link'];
                        $linkAttr = $button['linkAttr'];
                        $class = $button['class'];
                        $faclass = $button['faClass'];
                        $text = $button['text']; 
                        $buttonsHtml .= "<a href={$link}{$row[$id]} class='btn btn-$class' $targetModal data-toggle='tooltip' title='{$text}{$row[$id]}'><i class='fa fa-$faclass'></i></a> ";
                }

        $tdHtml .= "<td>$buttonsHtml</td>";
        }
    $wierszeHTML .= $tdHtml."</tr>";
    }
$tableParams = isset($labelsArray['tableParams'])? $labelsArray['tableParams']:'';
$tableView = "
<div id='list' class='row'>
    <div class='table-responsive col-md-12' cellspacing='0' cellpadding='0'>
        <table class='{$labelsArray['tableClass']}' id='{$labelsArray['tableName']}' data-pagination='false' data-locale='pl-PL' $tableParams>
            <thead>
                $naglowkiKolumnHTML
            </thead>
            <tbody>
                $wierszeHTML
            </tbody>
        </table>
    </div>
</div>";
        



/// HEADER ///
        
$headerBtnHtml = '';

if(isset($labelsArray['headerButtons'])){
    foreach ($labelsArray['headerButtons'] as $button){ 
        $linkAttr = isset($button['linkAttr'])? $button['linkAttr']:'';
        $headerBtnHtml .= "<a class='btn btn-sm btn-{$button['class']}' href='{$button['link']}' $linkAttr $targetModal><i class='fa fa-{$button['faClass']}'></i> {$button['text']}</a>\n\t";    
    }
} 
$adminMessageHtml = "";
if (isset($adminFormMessage)){
    foreach($adminFormMessage as $key => $message){
        if (empty($message)){
            $adminMessageHtml .= "";
        }else{
            if($key === 'general'){
                $adminMessageHtml .= "
                <div class='alert alert-success fade in' >
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Dziêkujemy!</strong> $message
                </div>";

            }else if($key === 'mailing'){
                $adminMessageHtml .= "
                <div class='alert alert-info fade in' >
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Informacja!</strong> $message
                </div>";
            }else if($key === 'warning'){
                $adminMessageHtml .= "
                <div class='alert alert-warning fade in' >
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Uwaga!</strong> $message
                </div>";
            }else if($key === 'error'){
                $adminMessageHtml .= "
                <div class='alert alert-danger fade in' >
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Uwaga!</strong> $message
                </div>";
            }
        }
    }
}
        
        

$headerView = "  
    <div class='row'>
        <div class='col-sm-8'>
            <h2 class='lead'>{$labelsArray['headerTitle']}</h2>
        </div>
        
        <div class='col-sm-4 text-right h2'>
            $headerBtnHtml
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12'>
            $adminMessageHtml
        </div>
    </div>
";

return $headerView.$tableView;