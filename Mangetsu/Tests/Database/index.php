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
    echo 'HostInfo: '.$dbManager->GetHostInfo() . '<br />';
    echo 'ClientInfo: '.$dbManager->GetClientInfo() . '<br />';
    echo 'ClientVersion: '.$dbManager->GetClientVersion() . '<br />';
    echo 'ServerInfo: '.$dbManager->GetServerInfo() . '<br />';
    echo 'ServerVersion: '.$dbManager->GetServerVersion() . '<br />';
    echo 'ProtocolInfo: '.$dbManager->GetProtocolInfo() . '<br />';
    
    echo 'GetAutoCommitMode: '.$dbManager->GetAutoCommitMode() . '<br />';
    echo 'SetAutoCommitMode(false): '.$dbManager->SetAutoCommitMode(false) . '<br />';
    echo 'GetAutoCommitMode: '.$dbManager->GetAutoCommitMode() . '<br />';
    echo 'SetAutoCommitMode(true): '.$dbManager->SetAutoCommitMode(true) . '<br />';
    echo 'GetAutoCommitMode: '.$dbManager->GetAutoCommitMode() . '<br />';
    echo 'QueryInformation: '.$dbManager->GetQueryInformation() . '<br />';
    
    echo 'ErrorCode: '.$dbManager->GetErrorCode() . '<br />';
    echo 'ErrorMessage: '.$dbManager->GetErrorMessage() . '<br />';

}