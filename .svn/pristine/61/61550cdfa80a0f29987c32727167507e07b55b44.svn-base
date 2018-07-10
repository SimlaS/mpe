<?php

$labelsArray = array(
        'columnNames'=>array(
            'TRESC'=>array(
                'label'=>'Treœæ komentarza',
                'name'=>'TRESC',
                'colGrid'=>'col-md-12',
                'title'=>'Treœæ komentarza',
                'formControl' => 'input',
                'type'=>'text',
                ),
            ),

        'formTitle'=>'Dodawanie nowego komentarza',
        'formAction'=>'index.php?option=komentarze&modal=true&action=dodaj',
        'submitBtnName'=>'nowy-komentarz',
        'showInModal'=>true,
        'linkAnuluj' => 'index.php?option=komentarze&modal=true'
        );


$inputsHtml = '';
$targetModal = isset($labelsArray['showInModal'])? 'data-target=#myModal':''; 

foreach($labelsArray['columnNames'] as $key => $input){
     switch ($input['formControl']) {
            case 'input':
                    $controlFrm = "<input type='{$input['type']}' class='form-control' name='{$input['name']}' id='{$input['name']}' value=''>";                
                break;
                case 'static': //je¿eli pole ma byæ tylko do odczytu
                    $controlFrm = "<div class='form-control-static'><em  id='{$input['name']}'></em></div>"; 
            default:
                break;
        }
        $labelTlp = isset($input['labelTlp'])? "data-toggle=tooltip data-placement=right title='{$input['labelTlp']}'" : "";
        $inputsHtml .= "
            <div class='form-group {$input['colGrid']}' style='height:65px;'>
                <label class='control-label' for='{$input['name']}' $labelTlp >{$input['label']}</label>
                $controlFrm
            </div>";
    
}

return "<h2 class='lead'>{$labelsArray['formTitle']}</h2>
        <form id='defaultForm' enctype='multipart/form-data'  action='{$labelsArray['formAction']}'  method='post'>
            <div class='row'>
                $inputsHtml
            </div>
        <hr />
            <div id='actions' class='row'>
                <div class='col-md-12'>
                  <input type='hidden' name='{$labelsArray['submitBtnName']}' value='ok'>
                  <input type='submit' class='btn btn-primary' $targetModal  value='Zapisz'>
                  <a href='{$labelsArray['linkAnuluj']}' class='btn btn-default' $targetModal data-toggle='tooltip' title='PrzejdŸ do listy'>Anuluj</a>
                </div>
            </div>
        </form>
        ";



