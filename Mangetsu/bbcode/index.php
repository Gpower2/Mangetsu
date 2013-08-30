<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1253">
        <title></title>
    </head>
    <body>
        <?php
            include_once 'class.php';

            $text = $_GET["text"];

            $bbcode = new bbcode(); 

            echo nl2br($bbcode -> bb($text));
            //echo nl2br($bbcode -> bbstrip($text));
            //echo nl2br($bbcode -> bbdisable($text));
        ?>
    </body>
</html>