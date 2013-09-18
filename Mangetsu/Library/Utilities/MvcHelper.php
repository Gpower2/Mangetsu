<?php
namespace Mangetsu\Library\Utilities
{
    class MvcHelper
    {
        /**
         * 
         * @return string
         */
        public static function GetCleanRequestUri()
        {
            // check if request uri contains the script name (index.php)
            if(stripos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) !== FALSE)
            {
                // remove the index.php from the request uri
                // this is used for pure php implementation 
                // requests have the form: http://www.mysite.com/index.php/controller/action
                // or http://www.mysite.com/subfolder/index.php/controller/action
                $requestUri = str_ireplace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']);
            }
            else
            {
                // remove the path of the script in order to allow folders in server
                // requests have the form: http://www.mysite.com/controller/action
                // or http://www.mysite.com/subfolder/controller/action
                $requestUri = str_ireplace(str_ireplace('/index.php', '', $_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
            }
            // return the clean request uri
            return $requestUri;
        }
        
    }
}
