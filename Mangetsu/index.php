<?php
namespace Mangetsu
{
    /**
     * This is the main and ONLY endpoint for all the Page requests.
     */
    
    // Set that the default charset is UTF-8
    ini_set('default_charset', 'UTF-8');
    
    // We register the autoload function in order to avoid "include", "import" 
    // and "require" statements
    spl_autoload_register(function ($argClass) {
        // Use require_once in order to avoid multiple request for the same file
        require_once 
            // Extremely important! The php file MUST have the same name as the class!
            // We strip the 'Mangetsu\' namespace, since we are already on the root folder
            // We use str_ireplace to ignore case
            str_ireplace('Mangetsu\\', '', $argClass) . '.php';
    });
    
    // We get a clean request Uri in order to process the route request
    $cleanRequestUri = \Mangetsu\Library\Utilities\MvcHelper::GetCleanRequestUri();
    
    // We get the route elements from the clean request Uri
    $routeElements = explode('/', $cleanRequestUri);
    
    echo '<pre>';
    
    print_r($_SERVER);
        
    echo "\r\n" . '$_SERVER["REQUEST_URI"]: = ' . $_SERVER['REQUEST_URI'] . "\r\n";           
    
    echo "\r\n" . '$cleanRequestUri: = ' . $cleanRequestUri . "\r\n";    
        
    print_r($routeElements);       
    
    echo '</pre>';
}