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
            // Using autoload feature, in order to require the classes only when needed!
            spl_autoload_register(function ($argClass) {
                require_once 
                    // We go back 3 levels, in order to get back to the root
                    // TODO: perhaps we should find a way to define the root globally?
                    '/../../../' . 
                    // Extremely important! The php file MUST have the same name as the class!
                    $argClass . '.php';
            });
            
            $bbcode = new \Mangetsu\Library\BBCode\BBCodeHelper();
            
            // Using $_REQUEST in order to get both GET and POST data
            $text = $_REQUEST["text"];
            
            //echo nl2br($bbcode->ConvertBBCodeToHTML($text) );
            // Gpower2: nl2br should not be needed, since the output is HTML
            echo $bbcode->ConvertBBCodeToHTML($text);
            //echo nl2br($bbcode -> bbstrip($text));
            //echo nl2br($bbcode -> bbdisable($text));
            
            // file test
            
            echo "<br/>";
            
            $text = file_get_contents('bbcodeTest01.txt' );
            //echo nl2br($bbcode->ConvertBBCodeToHTML($text) );
            // Gpower2: nl2br should not be needed, since the output is HTML
            echo $bbcode->ConvertBBCodeToHTML($text);
        ?>
        <br/>
        <a href="index.php">Back</a>
    </body>
</html>