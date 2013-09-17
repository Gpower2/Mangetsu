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
    echo '<pre>';
    
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

    echo 'ThreadID: ' . $dbManager->GetCurrentThreadID() . '<br />';
    
    echo 'Default database: ' . $dbManager->GetDefaultDatabase() . '<br />';

    echo "Escape String: this is 100% George's cat  => " . $dbManager->EscapeString("this is 100% George's cat") . '<br />';
    echo "Escape String: this is 100% George's cat  => " . $dbManager->EscapeString("this is 100% George's cat", true) . '<br />';
    
    echo 'Server status: ' . $dbManager->GetServerStatus() . '<br />';
    
    echo 'Connection Statistics: ';
    print_r($dbManager->GetConnectionStatistics());
    
    echo 'Test SqlGetArray query: ';
    print_r($dbManager->SqlGetArray("SELECT * FROM phpbb_users LIMIT 0, 40"));
    
    echo 'Test SqlGetSingleValue query: ';
    print_r($dbManager->SqlGetSingleValue("SELECT COUNT(*) FROM phpbb_users"));
    echo '<br />';
    
    try
    {
        echo 'Test SqlMultiExecute query: ';
        //$dbManager->SqlMultiExecute("INSERT INTO mkp_link_types VALUES('test01');INSERT INTO mkp_link_types VALUES('test02'); DELETE FROM mkp_link_types WHERE id > 2");        
        $arraySql = array();
        $arraySql[] = "INSERT INTO mkp_link_types (name) VALUES('test01')";
        $arraySql[] = "INSERT INTO mkp_link_types VALUES('test02')";
        $arraySql[] = "DELETE FROM mkp_link_types WHERE id > 2";
        $dbManager->SqlMultiExecute($arraySql);
    }
    catch (\Exception $exc)
    {
        echo '<br />' . $exc . '<br />';
    }
    
    $dbManager->KillCurrentDatabaseHandler();
    $dbManager->Ping();
    
    echo '</pre>';
}