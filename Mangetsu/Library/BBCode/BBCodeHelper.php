<?php
namespace Mangetsu\Library\BBCode;
{   
    class BBCodeHelper 
    {
        /**
         * Parses the text and replaces all the BBCode tags with html code.
         * @param string $argBBCodeText
         * @return string
         */
        public function ConvertBBCodeToHTML($argBBCodeText)
        {
            $bbtags = array
            (
                // Font and text
                '/(?<!\\\\)\[h1(?::\w+)?\](.*?)\[\/h1(?::\w+)?\]/si' 
                    => '<h1>\1</h1>', // Defines HTML headings
                '/(?<!\\\\)\[h2(?::\w+)?\](.*?)\[\/h2(?::\w+)?\]/si' 
                    => '<h2>\1</h2>', // Defines HTML headings
                '/(?<!\\\\)\[h3(?::\w+)?\](.*?)\[\/h3(?::\w+)?\]/si' 
                    => '<h3>\1</h3>', // Defines HTML headings
                '/(?<!\\\\)\[h4(?::\w+)?\](.*?)\[\/h4(?::\w+)?\]/si' 
                    => '<h4>\1</h4>', // Defines HTML headings
                '/(?<!\\\\)\[h5(?::\w+)?\](.*?)\[\/h5(?::\w+)?\]/si' 
                    => '<h5>\1</h5>', // Defines HTML headings
                '/(?<!\\\\)\[h6(?::\w+)?\](.*?)\[\/h6(?::\w+)?\]/si' 
                    => '<h6>\1</h6>', // Defines HTML headings

                '/(?<!\\\\)\[bold(?::\w+)?\](.*?)\[\/bold(?::\w+)?\]/si' 
                    => '<span class="bold">\1</span>', // Defines bold text
                '/(?<!\\\\)\[b(?::\w+)?\](.*?)\[\/b(?::\w+)?\]/si' 
                    => '<span class="bold">\1</span>', // Defines bold text
                '/(?<!\\\\)\[italic(?::\w+)?\](.*?)\[\/italic(?::\w+)?\]/si' 
                    => '<span class="italic">\1</span>',  // The browser displays an italic font style
                '/(?<!\\\\)\[i(?::\w+)?\](.*?)\[\/i(?::\w+)?\]/si' 
                    => '<span class="italic">\1</span>',  // The browser displays an italic font style
                '/(?<!\\\\)\[underline(?::\w+)?\](.*?)\[\/underline(?::\w+)?\]/si' 
                    => '<span class="underline">\1</span>', //Defines a line below the text
                '/(?<!\\\\)\[u(?::\w+)?\](.*?)\[\/u(?::\w+)?\]/si' 
                    => '<span class="underline">\1</span>', //Defines a line below the text
                '/(?<!\\\\)\[s(?::\w+)?\](.*?)\[\/s(?::\w+)?\]/si' 
                    => '<span class="strikethrough">\1</span>', // Strikethrough
                '/(?<!\\\\)\[sup(?::\w+)?\](.*?)\[\/sup(?::\w+)?\]/si' 
                    => '<sup>\1</sup>', // Superscript
                '/(?<!\\\\)\[sub(?::\w+)?\](.*?)\[\/sub(?::\w+)?\]/si' 
                    => '<sub>\1</sub>', // Subscript
                
                '/(?<!\\\\)\[left(?::\w+)?\](.*?)\[\/left(?::\w+)?\]/si' 
                    => '<div class="left">\1</div>', // Aligns the text to the left
                '/(?<!\\\\)\[right(?::\w+)?\](.*?)\[\/right(?::\w+)?\]/si' 
                    => '<div class="right">\1</div>', // Aligns the text to the right
                '/(?<!\\\\)\[center(?::\w+)?\](.*?)\[\/center(?::\w+)?\]/si' 
                    => '<div class="center">\1</div>', // Centers the text
                '/(?<!\\\\)\[justify(?::\w+)?\](.*?)\[\/justify(?::\w+)?\]/si' 
                    => '<div class="justify">\1</div>', // Stretches the lines so that each line has equal width
                
                
                // TODO: change this inline styles! We don't want specific sizes or colors or fonts!
                '/(?<!\\\\)\[font(?::\w+)?=(.*?)\](.*?)\[\/font(?::\w+)?\]/si' 
                    => "<font face=\"\\1\">\\2</font>", // Font                
                /* The only tag that I didn't do in style classes or html markup tags because we want it in pixels */
                '/(?<!\\\\)\[size(?::\w+)?=(.*?)\](.*?)\[\/size(?::\w+)?\]/si' 
                    => "<span style=\"font-size:\\1\px;\">\\2</span>", // Size of font
                '/(?<!\\\\)\[color(?::\w+)?=(.*?)\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<font color=\"\\1\">\\2</font>", // Color of font

                /* We only use code for <pre></pre> tags
                 * We don't want to allow preformatted text otherwise
                '/(?<!\\\\)\[preformatted(?::\w+)?\](.*?)\[\/preformatted(?::\w+)?\]/si' 
                    => "<pre>\\1</pre>", // Defines preformatted text
                '/(?<!\\\\)\[pre(?::\w+)?\](.*?)\[\/pre(?::\w+)?\]/si' 
                    => "<pre>\\1</pre>", // Defines preformatted text
                */                
                
                // List
                '/\[\*(?::\w+)?\]\s*([^\[]*)/si' 
                    => '<li class="ng_list_item">\1</li>', // List
                '/\[list(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/si' 
                    => '<ul class="ng_list">\1</ul>', // Defines an unordered list
                '/\[list(?::\w+)?\](.*?)\[\/list:u(?::\w+)?\]/s' 
                    => '<ul class="ng_list">\1</ul>', // Defines an unordered list
                '/\[list(?::\w+)?\](.*?)\[\/list:o(?::\w+)?\]/s' 
                    => '<ol class="ng_list" style="list-style-type:decimal;">\1</ol>', // Defines an ordered list
                '/\[list=1(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/si' 
                    => '<ol class="list_by_1">\1</ol>', // Defines an ordered list sort by "1"
                '/\[list=i(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' 
                    => '<ol class="list_by_i">\1</ol>', // Defines an ordered list sort by "i"
                '/\[list=I(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' 
                    => '<ol class="list_by_I">\1</ol>', // Defines an ordered list sort by "I"
                '/\[list=a(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' 
                    => '<ol class="list_by_a">\1</ol>', // Defines an ordered list sort by "a"
                '/\[list=A(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/s' 
                    => '<ol class="list_by_A">\1</ol>', // Defines an ordered list sort by "A"
                '/\[list=(?::\w+)?\](.*?)\[\/list(?::\w+)?\]/si' 
                    => '<ol class="list_by_1">\1</ol>', // Defines a malformed ordered list sort by "1" 
                
                // Url
                '/(?<!\\\\)\[url(?::\w+)?\](.*?)\[\/url(?::\w+)?\]/si' 
                    => '<a href="\1" target="_blank" class="bb-url">\1</a>', // URL
                '/(?<!\\\\)\[url(?::\w+)?=(.*?)?\](.*?)\[\/url(?::\w+)?\]/si' 
                    => '<a href="\1" target="_blank" class="bb-url">\2</a>', // URL with text
                    
                // Email
                '/(?<!\\\\)\[email(?::\w+)?=(.*?)\](.*?)\[\/email(?::\w+)?\]/si' 
                    => '<a href="mailto:\1" class="bb-email">\2</a>', // Send e-mail
                
                // Image
                '/(?<!\\\\)\[img=left(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' 
                    => '<img src="\1" align="left" alt="\1" class="img=left" />', // Insert image left
                '/(?<!\\\\)\[img(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' 
                    => '<img src="\1" alt="\1" class="image" />', // Insert image
                '/(?<!\\\\)\[img=right(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' 
                    => '<img src="\1" align="right" alt="\1" class="img=right" />', // Insert image right
                '/(?<!\\\\)\[img=(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si' 
                    => '<img src="\1" alt="\1" class="image" />', // Insert image (malformed input)
                                     
                
                // Youtube
                // TODO: more possible youtube url forms
                '/(?<!\\\\)\[you_tube(?::\w+)?\].*?(?:v=)?([^?&[]+)(&[^[]*)?\[\/you_tube(?::\w+)?\]/si' 
                    => '<embed width="420" height="345" src="http://www.youtube.com/v/\1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true">', // Embed youtube videos
                
                // Spoiler
                // TODO: use of unobtrusive javascript (no onclick assignment)
                '/(?<!\\\\)\[spoiler(?::\w+)?\](.*?)\[\/spoiler(?::\w+)?\]/si' 
                    => "<div class=\"spoiler\"><input class=\"button\" type=\"button\" value=\"Εμφάνιση Spoiler\" onclick=\"this.value=this.value=='Εμφάνιση Spoiler'?'Απόκρυψη Spoiler':'Εμφάνιση Spoiler';\"></div><div class=\"content\"><div class=\"text\">\\1</div></div>", // Spoiler
                
                /* Gpower2: We don't want to support moving text
                // Moving text
                '/(?<!\\\\)\[move(?::\w+)?\](.*?)\[\/move(?::\w+)?\]/si' 
                    => "<marquee behavior=\"scroll\" direction=\"left\" scrollamount=\"10\">\\1</marquee>", // Scrolling text
                */
                
                // Line break
                '/(?<!\\\\)\[break(?::\w+)?\]/si' => '<br />', // Defines a single line break
                '/(?<!\\\\)\[br(?::\w+)?\]/si' => '<br />', // Defines a single line break
                '/(?<!\\\\)\[newline(?::\w+)?\]/si' => '<br />', // Defines a single line break
            );
                       
            // Code
            $finalString = preg_replace('#\[code\](((?R)|.)*?)\[\/code\]#se', 
                    '"<div class=\"code\"><div class=\"code_title\">Code:</div><div class=\"code_text\"><code>".$this->disableBBCodeTags(\'$1\')."</code></div></div>"', 
                    $argBBCodeText);
            
            // Quote
            $finalString = str_replace('[quote]', 
                    '<blockquote><div class="quote"><div class="quote_title">Quote:</div><div class="quote_text">', 
                    $finalString);
            $finalString = preg_replace('#\[quote=("|"|\'|)(.*)\\1\]#seU', 
                    '"<blockquote><div class=\"quote\"><div class=\"quote_title\">Quote By: ".str_replace(array(\'[\', \'\\"\'), array(\'[\', \'"\'), \'$2\')."</div><div class=\"quote_text\">"', 
                    $finalString);            
            $finalString = preg_replace('#\[\/quote\]\s*#', 
                    '</div></div></blockquote>', 
                    $finalString);
            
            $finalString = preg_replace(array_keys($bbtags), array_values($bbtags), $finalString);
            
            // put back the bbcode parenthesis
            $finalString = $this->enableBBCodeTags($finalString);
            
            // Gpower2: we should return valid HTML here
            return nl2br($finalString);
        }
        
        /**
         * Disables the BBCode tags, by replacing the brackets characters []
         * with their html entities equivalents &#91; &#93;
         * @param string $argText the text containing BBCode tags
         * @return string
         */
        private function disableBBCodeTags($argText)
        { 
            $search = array('[', ']');
            $replace = array('&#91;', '&#93;');
            return str_replace($search, $replace, $argText);
        }
        
        /**
         * Enables the BBCode tags, by replacing the html entities &#91; &#93;
         * with the brackets characters []
         * @param string $argText the text containing the html entities &#91; &#93;
         * @return string
         */
        private function enableBBCodeTags($argText)
        {
            $search = array('&#91;', '&#93;');
            $replace = array('[', ']');
            return str_replace($search, $replace, $argText);
        }

        /**
         * Strips the text from all the BBCode tags
         * @param string $argText the text containing the BBCode tags
         * @return string
         */
        public function StripBBCodeTags($argText) 
        { 
            $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
            $replace = '';
            return preg_replace($pattern, $replace, $argText);
        }
    }
}