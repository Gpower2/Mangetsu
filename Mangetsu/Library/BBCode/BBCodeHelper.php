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
                
                // Font Names
                '/(?<!\\\\)\[font(?::\w+)?=Arial\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"arial\">\\1</span>", // Arial
                '/(?<!\\\\)\[font(?::\w+)?=Georgia\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"georgia\">\\1</span>", // Georgia
                '/(?<!\\\\)\[font(?::\w+)?=Impact\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"impact\">\\1</span>", // Impact
                '/(?<!\\\\)\[font(?::\w+)?=Symbol\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"symbol\">\\1</span>", // Symbol
                '/(?<!\\\\)\[font(?::\w+)?=Tahoma\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"tahoma\">\\1</span>", // Tahoma
                '/(?<!\\\\)\[font(?::\w+)?=Times New Roman\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"tnr\">\\1</span>", // Times New Roman
                '/(?<!\\\\)\[font(?::\w+)?=Verdana\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"verdana\">\\1</span>", // Verdana
                '/(?<!\\\\)\[font(?::\w+)?=Webdings\](.*?)\[\/font(?::\w+)?\]/si'
                    => "<span class=\"webdings\">\\1</span>", // Webdings
                // Font Colors
                '/(?<!\\\\)\[color(?::\w+)?=Black\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"black\">\\1</span>", // Black
                '/(?<!\\\\)\[color(?::\w+)?=DarkBlue\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"darkblue\">\\1</span>", // DarkBlue
                '/(?<!\\\\)\[color(?::\w+)?=Blue\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"blue\">\\1</span>", // Blue
                '/(?<!\\\\)\[color(?::\w+)?=DarkRed\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"darkred\">\\1</span>", // DarkRed
                '/(?<!\\\\)\[color(?::\w+)?=Red\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"red\">\\1</span>", // Red
                '/(?<!\\\\)\[color(?::\w+)?=Brown\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"brown\">\\1</span>", // Brown
                '/(?<!\\\\)\[color(?::\w+)?=Orange\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"orange\">\\1</span>", // Orange
                '/(?<!\\\\)\[color(?::\w+)?=Olive\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"olive\">\\1</span>", // Olive
                '/(?<!\\\\)\[color(?::\w+)?=Green\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"green\">\\1</span>", // Green
                '/(?<!\\\\)\[color(?::\w+)?=Yellow\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"yellow\">\\1</span>", // Yellow
                '/(?<!\\\\)\[color(?::\w+)?=Indigo\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"indigo\">\\1</span>", // Indigo
                '/(?<!\\\\)\[color(?::\w+)?=Violet\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"violet\">\\1</span>", // Violet
                '/(?<!\\\\)\[color(?::\w+)?=Cyan\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"cyan\">\\1</span>", // Cyan
                '/(?<!\\\\)\[color(?::\w+)?=White\](.*?)\[\/color(?::\w+)?\]/si' 
                    => "<span class=\"white\">\\1</span>", // White
                // Font Sizes
                '/(?<!\\\\)\[size(?::\w+)?=7\](.*?)\[\/size(?::\w+)?\]/si'
                    => "<span class=\"tiny\">\\1</span>", // Tiny
                '/(?<!\\\\)\[size(?::\w+)?=9\](.*?)\[\/size(?::\w+)?\]/si'
                    => "<span class=\"small\">\\1</span>", // Small
                '/(?<!\\\\)\[size(?::\w+)?=12\](.*?)\[\/size(?::\w+)?\]/si'
                    => "<span class=\"normal\">\\1</span>", // Normal
                '/(?<!\\\\)\[size(?::\w+)?=18\](.*?)\[\/size(?::\w+)?\]/si'
                    => "<span class=\"medium\">\\1</span>", // Medium
                '/(?<!\\\\)\[size(?::\w+)?=24\](.*?)\[\/size(?::\w+)?\]/si'
                    => "<span class=\"large\">\\1</span>", // Large
                '/(?<!\\\\)\[size(?::\w+)?=30\](.*?)\[\/size(?::\w+)?\]/si'
                    => "<span class=\"huge\">\\1</span>", // Huge

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
                '/(?<!\\\\)\[spoiler(?::\w+)?\](.*?)\[\/spoiler(?::\w+)?\]/si' 
                    => "<div class=\"spoiler\"><input id=\"spoiler_button\" class=\"button\" type=\"button\" value=\"Εμφάνιση Spoiler\"></div><div class=\"content\"><div class=\"text\">\\1</div></div>", // Spoiler
                
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
                    '"<div class=\"code\"><div class=\"code_title\">Code:</div><div class=\"code_text\"><code>" . $this->disableBBCodeTags("$1") . "</code></div></div>"', 
                    $argBBCodeText);
            
            // Quote
            $finalString = str_replace('[quote]', 
                    '<blockquote><div class="quote"><div class="quote_title">Quote:</div><div class="quote_text">', 
                    $finalString);
            $finalString = preg_replace('#\[quote=("|"|\'|)(.*)\\1\]#seU', 
                    '"<blockquote><div class=\"quote\"><div class=\"quote_title\">Quote By: " . str_replace(array(\'[\', \'\\"\'), array(\'[\', \'"\'), \'$2\') . "</div><div class=\"quote_text\">"', 
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
        
        /**
         * Check the text for valid pairs of BBCode tags.
         * @param string $argText
         */
        public function CheckBBCodes($argText)
        {   
            // Check for tags that have valid pairs

            // Quote tag check
            $openQuoteTagCounter  = preg_match_all('#\[quote\]#i', $argText);
            $openQuoteNameTagCounter  = preg_match_all('#\[quote=("|"|\'|)(.*)\\1\]#seU', $argText);
            $closeQuoteTagCounter = preg_match_all('#\[/quote\]#i', $argText);
            if($openQuoteTagCounter > $closeQuoteTagCounter & $openQuoteNameTagCounter == 0)
            {
                 throw new \Exception("There are more open quote tags than close quote tags!");
            }
            if($closeQuoteTagCounter > $openQuoteTagCounter & $openQuoteNameTagCounter == 0)
            {
                 throw new \Exception("There are more close quote tags than open quote tags!");
            }
            if($openQuoteNameTagCounter > $closeQuoteTagCounter & $openQuoteTagCounter == 0)
            {
                 throw new \Exception("There are more open quote tags than close quote tags!");
            }
            if($closeQuoteTagCounter > $openQuoteNameTagCounter & $openQuoteTagCounter == 0)
            {
                 throw new \Exception("There are more close quote tags than open quote tags!");
            }
            
            // Bold tag check
            $openBoldTagCounter  = preg_match_all('#\[b\]#i', $argText);
            $closeBoldTagCounter = preg_match_all('#\[/b\]#i', $argText);
            if($openBoldTagCounter > $closeBoldTagCounter)
            {
                 throw new \Exception("There are more open bold tags than close bold tags!");
            }
            if($closeBoldTagCounter > $openBoldTagCounter)
            {
                 throw new \Exception("There are more close bold tags than open bold tags!");
            }
            
            // Italic tag check
            $openItalicTagCounter  = preg_match_all('#\[i\]#i', $argText);
            $closeItalicTagCounter = preg_match_all('#\[/i\]#i', $argText);
            if($openItalicTagCounter > $closeItalicTagCounter)
            {
                 throw new \Exception("There are more open italic tags than close italic tags!");
            }
            if($closeItalicTagCounter > $openItalicTagCounter)
            {
                 throw new \Exception("There are more close italic tags than open italic tags!");
            }
            
            // Underline tag check
            $openUnderlineTagCounter  = preg_match_all('#\[u\]#i', $argText);
            $closeUnderlineTagCounter = preg_match_all('#\[/u\]#i', $argText);
            if($openUnderlineTagCounter > $closeUnderlineTagCounter)
            {
                 throw new \Exception("There are more open underline tags than close underline tags!");
            }
            if($closeUnderlineTagCounter > $openUnderlineTagCounter)
            {
                 throw new \Exception("There are more close underline tags than open underline tags!");
            }
            
            // YouTube tag check
            $openYouTubeTagCounter  = preg_match_all('#\[you_tube\]#i', $argText);
            $closeYouTubeTagCounter = preg_match_all('#\[/you_tube\]#i', $argText);
            if($openYouTubeTagCounter > $closeYouTubeTagCounter)
            {
                 throw new \Exception("There are more open youtube tags than close youtube tags!");
            }
            if($closeYouTubeTagCounter > $openYouTubeTagCounter)
            {
                 throw new \Exception("There are more close youtube tags than open youtube tags!");
            }
            
            // Code tag check
            $openCodeTagCounter  = preg_match_all('#\[code\]#i', $argText);
            $closeCodeTagCounter = preg_match_all('#\[/code\]#i', $argText);
            if($openCodeTagCounter > 0 & $closeCodeTagCounter == 0)
            {
                 throw new \Exception("There are only open code tags!");
            }
            if($closeCodeTagCounter > 0 & $openCodeTagCounter == 0)
            {
                 throw new \Exception("There are only close code tags!");
            }
            
            // Spoiler tag check
            $openSpoilerTagCounter  = preg_match_all('#\[spoiler\]#i', $argText);
            $closeSpoilerTagCounter = preg_match_all('#\[/spoiler\]#i', $argText);
            if($openSpoilerTagCounter > $closeSpoilerTagCounter)
            {
                 throw new \Exception("There are more open spoiler tags than close spoiler tags!");
            }
            if($closeSpoilerTagCounter > $openSpoilerTagCounter)
            {
                 throw new \Exception("There are more close spoiler tags than open spoiler tags!");
            }            
        }
    }
}