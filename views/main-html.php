<?php

$brakiZasilenHtml = '';
$countBrakiZasilen = count($brakiZasilen);
if ($countBrakiZasilen>0){
    $naglowkiKolumn = array("Id","Data wpisu","Nazwa procesu","Tekst alarmu","Kod alarmu","Data danych","Status","Tekst komentarza","Opcje");
    $naglowkiKolumnHTML = "<tr>";
    foreach ($naglowkiKolumn as $key=>$naglowek){
        $naglowkiKolumnHTML .= "<th data-field='{$key}' data-sortable='true'>$naglowek</th>";
    }
    $naglowkiKolumnHTML .="</tr>";
    $wierszeHTML = "";
    foreach($brakiZasilen as $key => $row){
        $id = $row['ID'];
        $wierszeHTML .= "<form id='kom_$id' name='kom_$id' method='post' action='index.php'>";
        $wierszeHTML .= "<tr>";
        $wierszeHTML .= "<input type=hidden name='id' value='{$id}'>";
        $wierszeHTML .= "<td>$id</td>";
        $wierszeHTML .= "<td>{$row['DATA_WPISU']}</td>";
        $wierszeHTML .= "<td>{$row['NAZWA_PROCESU']}</td>";
        $wierszeHTML .= "<td>{$row['TEKST_ALARMU']}</td>";
        $wierszeHTML .= "<td>{$row['CODE']}</td>";
        $wierszeHTML .= "<td>{$row['DATA_DANYCH']}</td>";
        $tekstKomentarza = $row['TEKST_KOMENTARZA'];
        $status = $row['STATUS_OBSLUGI'];
        if($status=='O'|| $status == 'P'){
            $statusTxt = '<em class=text-danger>do wysy�ki</em>';
            $wierszeHTML .= "<td>$statusTxt</td>";

            $poleKomentarza = "<div class='input-group'><select class='form-control' title='Prosz� wybra�...' name='komentarz' id='komentarz_$id'>$optionHtml</select>";
            $poleKomentarza .= "<span class='input-group-btn'>
                                        <a href=".$_SERVER['SCRIPT_NAME']."?option=komentarze&modal data-target='#myModal' class='btn btn-default' type='button' data-toggle='tooltip' title='Edytuj list�'><i class='fa fa-pencil'></i></a>
                                        </span></div>";
            
            $wierszeHTML .= "<td class=col-lg-4>$poleKomentarza</td>";
            $disabled = '';
        }else{
            if($status == 'A'){ //anulowany
                $statusTxt = '<em class=text-info >anulowany</em>';
                
            }else{ //wys�any
                $statusTxt = '<em class=text-success>wys�any</em>';
            }
            $wierszeHTML .= "<td>$statusTxt</td>";
            $wierszeHTML .= "<td><div>$tekstKomentarza</div>
                                    <div class='text-muted pull-right' style=margin-top:5px;>
                                        <em>{$row['KOMENTATOR']} [{$row['DATA_KOMENTARZA_TXT']}]</em>
                                    </div>
                             </td>";

            $disabled='disabled';
            
        }
        $text = "Wy�lij komentarz dla pozycji nr $id";
        $text2 = "Anuluj pozycj� nr $id";
        $buttonsHtml = "<input type=submit class='btn btn-success' data-toggle='tooltip' title='{$text}' value='Wy�lij' $disabled  style='margin:5px 10px;'>";
        $buttonsHtml .= "<input type=submit class='btn btn-default' data-toggle='tooltip' title='{$text2}' name='anulowanie' value='Anuluj' $disabled style='margin:5px 10px;' >";
        $wierszeHTML .= "<td><div >$buttonsHtml</div></td>";
        $wierszeHTML .= "</tr>";
        $wierszeHTML .= "</form>";
        
    }
    $brakiZasilenHtml .= "
        <table class='table table-striped' id='brakiZasilen' data-search='false' data-toggle='table'>
            <thead>
                $naglowkiKolumnHTML
            </thead>
            <tbody>
                $wierszeHTML
            </tbody>
        </table>";
}else{
    $brakiZasilenHtml .= "Brak danych";
}

if (isset($message)){
    $messageHtml = "<div class='alert alert-success'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Dzi�kujemy! </strong> $message
                    </div>";
}else if (isset($error)){
    $messageHtml = "<div class='alert alert-danger'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>B��d! </strong> $error
                    </div>";
}else{
    $messageHtml = '';
}

return "    
<div class='well' >
$messageHtml
    <div class='panel-group'>
      <div class='panel panel-default'>
        <div class='panel-heading' role='tab' id='headingOne'>
          <div class='panel-title'>
            <h4>Rejestr nieudanych zasile�</h4>
          </div>
        </div>
        <div class='panel-body'>            
            $brakiZasilenHtml
        </div>
      </div>
    </div>
</div>";

