<?php

namespace Mangetsu\Tests\Database
{
    spl_autoload_register(function ($argClass) {
        require_once 
            // We go back 3 levels, in order to get back to the root
            // TODO: perhaps we should find a way to define the root globally?
            '/../../../' . 
            // Extremely important! The php file MUST have the same name as the class!
            $argClass . '.php';
    });
    
    $dbManager = new \Mangetsu\Library\Database\DatabaseManager("localhost", "root", "root", "animeclipse");
    echo $dbManager->HostInfo();
}