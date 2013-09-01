<?php
namespace Mangetsu\Library\BBCode;
{
    class BBCodeHelper 
    {
        function ConvertBBCodeToHTML($argBBCodeText)
        {
            $bbtags = array(
                // Font and text
                '/(?<!\\\\)\[h1(?::\w+)?\](.*?)\[\/h1(?::\w+)?\]/si' => "<h1>\\1</h1>", // Defines HTML headings
                '/(?<!\\\\)\[h2(?::\w+)?\](.*?)\[\/h2(?::\w+)?\]/si' => "<h2>\\1</h2>", // Defines HTML headings
                '/(?<!\\\\)\[h3(?::\w+)?\](.*?)\[\/h3(?::\w+)?\]/si' => "<h3>\\1</h3>", // Defines HTML headings
                '/(?<!\\\\)\[h4(?::\w+)?\](.*?)\[\/h4(?::\w+)?\]/si' => "<h4>\\1</h4>", // Defines HTML headings
                '/(?<!\\\\)\[h5(?::\w+)?\](.*?)\[\/h5(?::\w+)?\]/si' => "<h5>\\1</h5>", // Defines HTML headings
                '/(?<!\\\\)\[h6(?::\w+)?\](.*?)\[\/h6(?::\w+)?\]/si' => "<h6>\\1</h6>", // Defines HTML headings
                '/(?<!\\\\)\[bold(?::\w+)?\](.*?)\[\/bold(?::\w+)?\]/si' => "<span style=\"font-weight:bold;\">\\1</span>", // Defines bold text
                '/(?<!\\\\)\[b(?::\w+)?\](.*?)\[\/b(?::\w+)?\]/si' => "<span style=\"font-weight:bold;\">\\1</span>", // Defines bold text
                '/(?<!\\\\)\[italic(?::\w+)?\](.*?)\[\/italic(?::\w+)?\]/si' => "<span style=\"font-style:italic;\">\\1</span>",  // The browser displays an italic font style
                '/(?<!\\\\)\[i(?::\w+)?\](.*?)\[\/i(?::\w+)?\]/si' => "<span style=\"font-style:italic;\">\\1</span>",  // The browser displays an italic font style
                '/(?<!\\\\)\[underline(?::\w+)?\](.*?)\[\/underline(?::\w+)?\]/si' => "<span style=\"text-decoration:underline;\">\\1</span>", //Defines a line below the text
                '/(?<!\\\\)\[u(?::\w+)?\](.*?)\[\/u(?::\w+)?\]/si' => "<span style=\"text-decoration:underline;\">\\1</span>", //Defines a line below the text
                '/(?<!\\\\)\[left(?::\w+)?\](.*?)\[\/left(?::\w+)?\]/si' => "<div style=\"text-align:left;\">\\1</div>", // Aligns the text to the left
                '/(?<!\\\\)\[right(?::\w+)?\](.*?)\[\/right(?::\w+)?\]/si' => "<div style=\"text-align:right;\">\\1</div>", // Aligns the text to the right
                '/(?<!\\\\)\[center(?::\w+)?\](.*?)\[\/center(?::\w+)?\]/si' => "<div style=\"text-align:center;\">\\1</div>", // Centers the text
                '/(?<!\\\\)\[justify(?::\w+)?\](.*?)\[\/justify(?::\w+)?\]/si' => "<div style=\"text-align:justify;\">\\1</div>", // Stretches the lines so that each line has equal width
                '/(?<!\\\\)\[font(?::\w+)?=(.*?)\](.*?)\[\/font(?::\w+)?\]/si' => "<span style=\"font-family:\\1;\">\\2</span>", // Font
                '/(?<!\\\\)\[size(?::\w+)?=(.*?)\](.*?)\[\/size(?::\w+)?\]/si' => "<span style=\"font-size:\\1\\px;\">\\2</span>", // Size of font
                '/(?<!\\\\)\[color(?::\w+)?=(.*?)\](.*?)\[\/color(?::\w+)?\]/si' => "<span style=\"color:\\1\">\\2</span>", // Color of font
                '/(?<!\\\\)\[s(?::\w+)?\](.*?)\[\/s(?::\w+)?\]/si' => "<span style=\"text-decoration: line-through;\">\\1</span>", // Strikethrough
                '/(?<!\\\\)\[preformatted(?::\w+)?\](.*?)\[\/preformatted(?::\w+)?\]/si' => "<pre>\\1</pre>", // Defines preformatted text
                '/(?<!\\\\)\[pre(?::\w+)?\](.*?)\[\/pre(?::\w+)?\]/si' => "<pre>\\1</pre>", // Defines preformatted text
                '/(?<!\\\\)\[sup(?::\w+)?\](.*?)\[\/sup(?::\w+)?\]/si' => "<sup>\\1</sup>", // Superscript
                '/(?<!\\\\)\[sub(?::\w+)?\](.*?)\[\/sub(?::\w+)?\]/si' => "<sub>\\1</sub>", // Subscript
                // List
                '/\[\*(?::\w+)?\]\s*([^\[]*)/si' => "<li class=\"ng_list_item\">\\1</li>", // List
                '/\[list(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/si' => "<ul class=\"ng_list\">\\1</ul>", // Defines an unordered list
                '/\[list(?::\w+)?\](.*?)\[\/list:u(?::\w+)?\]/s' => "<ul class=\"ng_list\">\\1</ul>", // Defines an unordered list
                '/\[list(?::\w+)?\](.*?)\[\/list:o(?::\w+)?\]/s' => "<ol class=\"ng_list\" style=\"list-style-type:decimal;\">\\1</ol>", // Defines an ordered list
                '/\[list=1(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/si' => "<ol class=\"ng_list\" style=\"list-style-type:decimal;\">\\1</ol>", // Defines an ordered list sort by "1"
                '/\[list=i(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' => "<ol class=\"ng_list\" style=\"list-style-type:lower-roman;\">\\1</ol>", // Defines an ordered list sort by "i"
                '/\[list=I(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' => "<ol class=\"ng_list\" style=\"list-style-type:upper-roman;\">\\1</ol>", // Defines an ordered list sort by "I"
                '/\[list=a(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' => "<ol class=\"ng_list\" style=\"list-style-type:lower-alpha;\">\\1</ol>", // Defines an ordered list sort by "a"
                '/\[list=A(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' => "<ol class=\"ng_list\" style=\"list-style-type:upper-alpha;\">\\1</ol>", // Defines an ordered list sort by "A"
                // Url
                '/(?<!\\\\)\[url(?::\w+)?\](.*?)\[\/url(?::\w+)?\]/si' => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\1</a>", // URL
                '/(?<!\\\\)\[url(?::\w+)?=(.*?)?\](.*?)\[\/url(?::\w+)?\]/si' => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\2</a>", // URL with text
                // Email
                '/(?<!\\\\)\[email(?::\w+)?=(.*?)\](.*?)\[\/email(?::\w+)?\]/si' => "<a href=\"mailto:\\1\" class=\"bb-email\">\\2</a>", // Send e-mail
                // Img
                '/(?<!\\\\)\[img=left(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' => "<img src=\"\\1\" align=\"left\" alt=\"\\1\" class=\"img=left\" />", // Insert image left
                '/(?<!\\\\)\[img(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' => "<img src=\"\\1\" alt=\"\\1\" class=\"image\" />", // Insert image
                '/(?<!\\\\)\[img=right(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' => "<img src=\"\\1\" align=\"right\" alt=\"\\1\" class=\"img=right\" />", // Insert image right
                // Videos
                '/(?<!\\\\)\[you_tube(?::\w+)?\].*?(?:v=)?([^?&[]+)(&[^[]*)?\\[\/you_tube(?::\w+)?\]/si' => "<iframe width=\"420\" height=\"345\" src=\"http://www.youtube.com/embed/\\1\"></iframe>", // Embed youtube videos
                '/(?<!\\\\)\[video(?::\w+)?\](.*?)\[\/video(?::\w+)?\]/si' => "<div class='bbvideo' data-url='\\1' style='width: 640px; height: 390px; margin: 2px 0; display: inline-block; background: #000; color: #fff; overflow: hidden; vertical-align: bottom;'><div style='height: 100%;'><script>if (typeof bbmedia == 'undefined') { bbmedia = true; var e = document.createElement('script'); e.async = true; e.src = 'http://phpbbex.com/api/bbmedia.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(e, s); }</script></div><div style='text-align: right; height: 14px; margin-top: -14px; padding-right: 2px; font: 10px/10px Verdana; color: #555;'><a style='color: #105289; text-decoration: none;' href='http://phpbbex.com/' target='_blank'>phpBB</a> &#91;video&#93;</div></div>", // Embed videos
                // Spoiler
                '/(?<!\\\\)\[spoiler(?::\w+)?\](.*?)\[\/spoiler(?::\w+)?\]/si' => "<div style=\"margin:20px; margin-top:5px;\"><div class=\"smallfont\" style=\"margin-bottom: 2px\"><b>Spoiler</b>: <input type=\"button\" value=\"Show\" style=\"width:45px;font-size:10px;margin:0px;padding:0px;\" onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Hide'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'Show'; }\"></div><div class=\"alt2\" style=\"margin: 0px; padding: 6px; border: 1px inset;\"><div style=\"display: none\">\\1</div></div></div>", // Spoiler
                '/(?<!\\\\)\[spoiler(?::\w+)?=(.*?)\](.*?)\[\/spoiler(?::\w+)?\]/si' => "<div style=\"margin:20px; margin-top:5px;\"><div class=\"smallfont\" style=\"margin-bottom: 2px\"><b>Spoiler</b> <i>\\1</i>: <input type=\"button\" value=\"Show\" style=\"width:45px;font-size:10px;margin:0px;padding:0px;\" onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Hide'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'Show'; }\"></div><div class=\"alt2\" style=\"margin: 0px; padding: 6px; border: 1px inset;\"><div style=\"display: none\">\\2</div></div></div>", // Spoiler with title
                // Moving text
                '/(?<!\\\\)\[move(?::\w+)?\](.*?)\[\/move(?::\w+)?\]/si' => "<marquee direction=\"left\"  height=\"100%\" width=\"100%\">\\1</marquee>", // Scrolling text
                // Line break
                '/(?<!\\\\)\[break(?::\w+)?\]/si' => "<br>", // Defines a single line break
                '/(?<!\\\\)\[br(?::\w+)?\]/si' => "<br>", // Defines a single line break
                '/(?<!\\\\)\[newline(?::\w+)?\]/si' => "<br>", // Defines a single line break
            );
        // Quote
        if (strpos($argBBCodeText, 'quote') !== false){
            $argBBCodeText = str_replace('[quote]', '<blockquote><div class="quote"><div style="background-color: #B0B0B0; padding: 4px; border: 1px inset;">Quote:</div><div class=\"quote\" style="padding: 7px; border: 1px inset;">', $argBBCodeText);
            $argBBCodeText = preg_replace('#\[quote=("|"|\'|)(.*)\\1\]#seU', '"<blockquote><div class=\"quote-by\"><div style=\"background-color: #B0B0B0; padding: 4px; border: 1px inset;\">Quote By: ".str_replace(array(\'[\', \'\\"\'), array(\'[\', \'"\'), \'$2\')."</div><div class=\"quote-by\" style=\"padding: 7px; border: 1px inset;\">"', $argBBCodeText);
            $argBBCodeText = preg_replace('#\[\/quote\]\s*#', '</div></div></blockquote>', $argBBCodeText);
        }
        // Code ~> I am not sure if the code must to be like the quote
        if (strpos($argBBCodeText, 'code') !== false){
                $argBBCodeText = str_replace('[code]', '<div class="code" style="margin-top: 10px; margin-left: 40px; margin-right: 40px;"><div style="background-color: green; padding: 4px; border: 1px inset;">Code:</div><div style="padding: 7px; border: 1px inset;"><code>', $argBBCodeText);
            $argBBCodeText = preg_replace('#\[\/code\]\s*#', '</code></div></div>', $argBBCodeText);
        }            
            $argBBCodeText = preg_replace(array_keys($bbtags), array_values($bbtags), $argBBCodeText);
            // Gpower2: we should return valid HTML here
            return nl2br($argBBCodeText);
        }
              
         /* Gpower2: Do we really need those functions????
         * 
        //Disabling BBcode
        function bbdisable($bbtext)
        { 
            $search = array('[', ']');
            $replace = array('&#91;', '&#93;');
            return str_replace($search, $replace, $bbtext);
        }
        
        // Clearing BBcode
        function bbstrip($bbtext) 
        { 
            $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
            $replace = '';
            return preg_replace($pattern, $replace, $bbtext);
        }
          */
    }
}