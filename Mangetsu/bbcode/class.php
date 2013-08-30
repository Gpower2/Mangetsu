<?php
    class bbcode {
        function bb($bbtext){
            $bbtags = array(
                '/(?<!\\\\)\[h1(?::\w+)?\](.*?)\[\/h1(?::\w+)?\]/si' => "<h1>\\1</h1>", // Defines HTML headings
                '/(?<!\\\\)\[h2(?::\w+)?\](.*?)\[\/h2(?::\w+)?\]/si' => "<h2>\\1</h2>", // Defines HTML headings
                '/(?<!\\\\)\[h3(?::\w+)?\](.*?)\[\/h3(?::\w+)?\]/si' => "<h3>\\1</h3>", // Defines HTML headings
                '/(?<!\\\\)\[h4(?::\w+)?\](.*?)\[\/h4(?::\w+)?\]/si' => "<h4>\\1</h4>", // Defines HTML headings
                '/(?<!\\\\)\[h5(?::\w+)?\](.*?)\[\/h5(?::\w+)?\]/si' => "<h5>\\1</h5>", // Defines HTML headings
                '/(?<!\\\\)\[h6(?::\w+)?\](.*?)\[\/h6(?::\w+)?\]/si' => "<h6>\\1</h6>", // Defines HTML headings
                '/(?<!\\\\)\[break(?::\w+)?\]/si' => "<br>", // Defines a single line break
                '/(?<!\\\\)\[br(?::\w+)?\]/si' => "<br>", // Defines a single line break
                '/(?<!\\\\)\[newline(?::\w+)?\]/si' => "<br>", // Defines a single line break
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
                '/(?<!\\\\)\[color(?::\w+)?=(.*?)\](.*?)\[\/color(?::\w+)?\]/si' => "<span style=\"color:\\1'\">\\2</span>", // Color of font
                '/(?<!\\\\)\[s(?::\w+)?\](.*?)\[\/s(?::\w+)?\]/si' => "<span style=\"text-decoration: line-through;\">\\1</span>", // Strikethrough
                '/(?<!\\\\)\[unordered_list(?::\w+)?\](.*?)\[\/unordered_list(?::\w+)?\]/si' => "<ul>\\1</ul>", // Defines an unordered list
                '/(?<!\\\\)\[list(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/si' => "<ul>\\1</ul>", // Defines an unordered list
                '/(?<!\\\\)\[ul(?::\w+)?\](.*?)\[\/ul(?::\w+)?\]/si' => "<ul>\\1</ul>", // Defines an unordered list
                '/(?<!\\\\)\[ordered_list(?::\w+)?\](.*?)\[\/ordered_list(?::\w+)?\]/si' => "<ol>\\1</ol>", // Defines an ordered list
                '/(?<!\\\\)\[ol(?::\w+)?\](.*?)\[\/ol(?::\w+)?\]/si' => "<ol>\\1</ol>", // Defines an ordered list
                '/(?<!\\\\)\[list_item(?::\w+)?\](.*?)\[\/list_item(?::\w+)?\]/si' => "<li>\\1</li>", // Defines a list item
                '/(?<!\\\\)\[li(?::\w+)?\](.*?)\[\/li(?::\w+)?\]/si' => "<li>\\1</li>", // Defines a list item
                '/(?<!\\\\)\[preformatted(?::\w+)?\](.*?)\[\/preformatted(?::\w+)?\]/si' => "<pre>\\1</pre>", // Defines preformatted text
                '/(?<!\\\\)\[pre(?::\w+)?\](.*?)\[\/pre(?::\w+)?\]/si' => "<pre>\\1</pre>", // Defines preformatted text
                '/(?<!\\\\)\[sup(?::\w+)?\](.*?)\[\/sup(?::\w+)?\]/si' => "<sup>\\1</sup>", // Superscript
                '/(?<!\\\\)\[sub(?::\w+)?\](.*?)\[\/sub(?::\w+)?\]/si' => "<sub>\\1</sub>", // Subscript
                '/(?<!\\\\)\[url(?::\w+)?\](.*?)\[\/url(?::\w+)?\]/si' => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\1</a>", // URL
                '/(?<!\\\\)\[url(?::\w+)?=(.*?)?\](.*?)\[\/url(?::\w+)?\]/si' => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\2</a>", // URL with text
                '/(?<!\\\\)\[email(?::\w+)?=(.*?)\](.*?)\[\/email(?::\w+)?\]/si' => "<a href=\"mailto:\\1\" class=\"bb-email\">\\2</a>", // Send e-mail
                '/(?<!\\\\)\[img(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' => "<img src=\"\\1\" alt=\"\\1\" class=\"bb-image\" />", // Insert image
                '/(?<!\\\\)\[code(?::\w+)?\]([^[]*)\[\/code(?::\w+)?\]/si' => "<div class=\"quote-by\" style=\"background-color: green; margin: 0px; padding: 4px; border: 1px inset;\">Code:</div><code><div class=\"quote\" style=\"margin: 0px; padding: 10px; border: 1px inset;\">\\1</div></code>", // Defines a piece of computer code,
                '/(?<!\\\\)\[quote_name(?::\w+)?=(.*?)\](.*?)\[\/quote_name(?::\w+)?\]/si' => "<div class=\"quote-by\" style=\"background-color: #B0B0B0; margin: 0px; padding: 4px; border: 1px inset;\">Quote By: \\1</div><div class=\"quote\" style=\"margin: 0px; padding: 10px; border: 1px inset;\">\\2</div>", // Quote
                '/(?<!\\\\)\[youtube(?::\w+)?\](.*?)\[\/youtube(?::\w+)?\]/si' => "<iframe width=\"420\" height=\"345\" src=\"http://www.youtube.com/embed/\\1\"></iframe>", // Embed youtube videos
                '/(?<!\\\\)\[video(?::\w+)?\](.*?)\[\/video(?::\w+)?\]/si' => "<div class='bbvideo' data-url='\\1' style='width: 640px; height: 390px; margin: 2px 0; display: inline-block; background: #000; color: #fff; overflow: hidden; vertical-align: bottom;'><div style='height: 100%;'><script>if (typeof bbmedia == 'undefined') { bbmedia = true; var e = document.createElement('script'); e.async = true; e.src = 'http://phpbbex.com/api/bbmedia.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(e, s); }</script></div><div style='text-align: right; height: 14px; margin-top: -14px; padding-right: 2px; font: 10px/10px Verdana; color: #555;'><a style='color: #105289; text-decoration: none;' href='http://phpbbex.com/' target='_blank'>phpBB</a> &#91;video&#93;</div></div>", // Embed videos
                '/(?<!\\\\)\[spoiler(?::\w+)?\](.*?)\[\/spoiler(?::\w+)?\]/si' => "<div style=\"margin:20px; margin-top:5px;\"><div class=\"smallfont\" style=\"margin-bottom: 2px\"><b>Spoiler</b>: <input type=\"button\" value=\"Show\" style=\"width:45px;font-size:10px;margin:0px;padding:0px;\" onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Hide'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'Show'; }\"></div><div class=\"alt2\" style=\"margin: 0px; padding: 6px; border: 1px inset;\"><div style=\"display: none\">\\1</div></div></div>", // Spoiler
                '/(?<!\\\\)\[spoiler(?::\w+)?=(.*?)\](.*?)\[\/spoiler(?::\w+)?\]/si' => "<div style=\"margin:20px; margin-top:5px;\"><div class=\"smallfont\" style=\"margin-bottom: 2px\"><b>Spoiler</b> <i>\\1</i>: <input type=\"button\" value=\"Show\" style=\"width:45px;font-size:10px;margin:0px;padding:0px;\" onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Hide'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'Show'; }\"></div><div class=\"alt2\" style=\"margin: 0px; padding: 6px; border: 1px inset;\"><div style=\"display: none\">\\2</div></div></div>", // Spoiler with title
                '/(?<!\\\\)\[move(?::\w+)?\](.*?)\[\/move(?::\w+)?\]/si' => "<marquee direction=\"left\"  height=\"100%\" width=\"100%\">\\1</marquee>", // Scrolling text
            );
            
            $bbtext = preg_replace(array_keys($bbtags), array_values($bbtags), $bbtext);
            return $bbtext;
        }
                
        function bbdisable($bbtext){ //Disabling BBcode
            $search = array('[', ']');
            $replace = array('&#91;', '&#93;');
            return str_replace($search, $replace, $bbtext);
        }
        
        function bbstrip($bbtext) { // Clearing BBcode
            $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
            $replace = '';
            return preg_replace($pattern, $replace, $bbtext);
        }
    }
?>