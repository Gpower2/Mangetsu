<?php

namespace Mangetsu\Tests\Database
{
    use \Mangetsu\Library\Database\DatabaseManager;
    
    spl_autoload_register(function ($argClass) {
        require_once 
            // We go back 3 levels, in order to get back to the root
            // TODO: perhaps we should find a way to define the root globally?
            '/../../../' . 
            // Extremely important! The php file MUST have the same name as the class!
            $argClass . '.php';
    });
    
    $dbManager = new DatabaseManager("localhost", "root", "root", "animeclipse");
    $dbManager->SetCharacterSetName("utf8");
    echo ' <meta charset="UTF-8"> ';
    
    echo '<pre>';  

    echo 'Charset: '.$dbManager->GetCharacterSetName() . '<br />';
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
    
    echo '<br />GetTotalQueries: ' . $dbManager->GetTotalQueries(). '<br />';
    
    echo 'Test SqlGetArray query: ';
    print_r($dbManager->SqlGetArray("SELECT * FROM phpbb_users LIMIT 0, 10"));
    echo '<br />GetLastQuery: ' . $dbManager->GetLastQuery(). '<br />';
    echo '<br />GetLastQueryElapsedTime: ' . $dbManager->GetLastQueryElapsedTime(). '<br />';
    echo '<br />GetTotalQueries: ' . $dbManager->GetTotalQueries(). '<br />';
    
    echo 'Test SqlGetArray query with class: ';
    $results = $dbManager->SqlGetArray("SELECT * FROM phpbb_users LIMIT 0, 10", "\Mangetsu\Models\User");
    print_r($results);
    echo '<br />GetLastQuery: ' . $dbManager->GetLastQuery(). '<br />';
    echo '<br />GetLastQueryElapsedTime: ' . $dbManager->GetLastQueryElapsedTime(). '<br />';
    echo '<br />GetTotalQueries: ' . $dbManager->GetTotalQueries(). '<br />';
    echo $results[0]->username . "<br />";
    
    echo 'Test SqlGetSingleValue query: ';
    print_r($dbManager->SqlGetSingleValue("SELECT COUNT(*) FROM phpbb_users"));
    echo '<br />GetLastQuery: ' . $dbManager->GetLastQuery(). '<br />';
    echo '<br />GetLastQueryElapsedTime: ' . $dbManager->GetLastQueryElapsedTime(). '<br />';
    echo '<br />GetTotalQueries: ' . $dbManager->GetTotalQueries(). '<br />';
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
        echo '<br />GetLastQuery: ' . $dbManager->GetLastQuery(). '<br />';
        echo '<br />GetLastQueryElapsedTime: ' . $dbManager->GetLastQueryElapsedTime(). '<br />';
        echo '<br />GetTotalQueries: ' . $dbManager->GetTotalQueries(). '<br />';
    }
    catch (\Exception $exc)
    {
        echo '<br />' . $exc . '<br />';
        echo '<br />GetLastQuery: ' . $dbManager->GetLastQuery(). '<br />';
        echo '<br />GetLastQueryElapsedTime: ' . $dbManager->GetLastQueryElapsedTime(). '<br />';
        echo '<br />GetTotalQueries: ' . $dbManager->GetTotalQueries(). '<br />';
    }
    
    echo '<br />GetLastQuery: ' . $dbManager->GetLastQuery(). '<br />';
    echo '<br />GetLastQueryElapsedTime: ' . $dbManager->GetLastQueryElapsedTime(). '<br />';
    echo '<br />GetTotalQueries: ' . $dbManager->GetTotalQueries(). '<br />';
    
    echo '<br />GetTotalExecutionTime: ' . $dbManager->GetTotalExecutionTime(). '<br />';
    
    $dbManager->KillCurrentDatabaseHandler();
    $dbManager->Ping();
    
    echo '</pre>';
}