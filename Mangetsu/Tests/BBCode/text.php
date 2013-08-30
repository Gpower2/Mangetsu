<?php
namespace Mangetsu\Tests\BBCode;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <title></title>
    </head>
    <body>
        <?php
            require_once '/../../Library/BBCode/BBCodeHelper.php';           

            $bbcode = new \Mangetsu\Library\BBCode\BBCodeHelper();
            
            $text = $_REQUEST["text"];
            echo nl2br($bbcode->ConvertBBCodeToHTML($text) );
            //echo nl2br($bbcode -> bbstrip($text));
            //echo nl2br($bbcode -> bbdisable($text));
            
            // file test
            
            echo "<br/>";
            
            $text = file_get_contents('bbcodeTest01.txt' );
            echo nl2br($bbcode->ConvertBBCodeToHTML($text) );
        ?>
        <br/>
        <a href="index.php">Back</a>
    </body>
</html>