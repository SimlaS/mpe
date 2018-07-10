<?php

return "<!DOCTYPE html>
<html>
    <head>       
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>$pageData->title</title>
        $pageData->css
        $pageData->embeddedStyle
        $pageData->scriptElements
    </head>
    <body>
        <div class='container-fluid'>
            $pageData->content
        </div>
        $pageData->embeddedScript
    </body>
</html>";