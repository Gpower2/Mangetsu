<?php
namespace Mangetsu
{
    spl_autoload_register(function ($argClass) {
        require_once 
            // Extremely important! The php file MUST have the same name as the class!
            // We strip the 'Mangetsu\' namespace, since we are already on the root folder
            str_ireplace('Mangetsu\\', '', $argClass) . '.php';
    });    
    
    echo '<pre>';
    print_r($_SERVER);
        
    echo "\r\n" . '$_SERVER["REQUEST_URI"]: = ' . $_SERVER['REQUEST_URI'] . "\r\n";
           
    $requestUri = \Mangetsu\Library\Utilities\MvcHelper::GetCleanRequestUri();
    
    echo "\r\n" . '$requestUri: = ' . $requestUri . "\r\n";
    
    $elements = explode('/', $requestUri);
        
    print_r($elements);
    
    
    
    echo '</pre>';
}