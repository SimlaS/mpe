<?php

if (isset($message)){
    $messageHtml = "<div class='alert alert-success' >
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Dzi&eogon;kujemy! </strong> $message
                    </div>";
}else{
    $messageHtml = "";
}

return "   
<div class='well' style='padding-bottom:40px;'>
$messageHtml
    <h4>Wybierz siebie z listy rozwijanej...</h4>
    <form id='loginForm' name='loginForm' action='index.php?option=updkomentator' method='post'>
    <div class='row'>
        <div class='col-lg-6'>
            <select name='id' id='komentatorzy' class='form-control chosen-select' title='Komentatorzy' >
                $optionsHtml
            </select>
        </div>
    </div>
    </form>
</div>";

