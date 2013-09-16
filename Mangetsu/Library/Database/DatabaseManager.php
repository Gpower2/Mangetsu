<?php
namespace Mangetsu\Library\Database
{
    /**
     * A thin wrapper class for using mysqli extension
     */
    class DatabaseManager
    {
        // Define private variables
        /**
         * The mysqli object that manages the connection to the database
         * @var mysqli  
         */
        private $_DatabaseHandler = null;
        /**
         * the hostname for the MySQL server
         * @var string 
         */
        private $_Hostname = null;
        /**
         * the username for establishing a connection
         * @var string 
         */
        private $_Username = null;
        /**
         * the password for the username
         * @var string 
         */
        private $_Password = null;
        /**
         * the name of the database to connect to
         * @var string
         */
        private $_DatabaseName = null;
               
        
        /**
         * The constructor method for DatabaseManager.
         * It gets all the necessary data in order to create a new mysqli object.
         * @param string $argHostname - the hostname for the MySQL server
         * @param string $argUsername - the username for establishing a connection
         * @param string $argPassword - the password for the username
         * @param string $argDatabaseName - the databse to connect to
         * @throws Exception
         */
        public function __construct($argHostname, $argUsername, $argPassword, $argDatabaseName)
        {
            // check the data
            if(!isset($argHostname))
            {
                throw new \Exception("No hostname for MySQL was specified!");
            }
            if(!isset($argUsername))
            {
                throw new \Exception("No username for MySQL was specified!");
            }
            if(!isset($argPassword))
            {
                throw new \Exception("No password for MySQL was specified!");
            }
            if(!isset($argDatabaseName))
            {
                throw new \Exception("No database for MySQL was specified!");
            }
            // assign the values
            $this->_Hostname = $argHostname;
            $this->_Username = $argUsername;
            $this->_Password = $argPassword;
            $this->_DatabaseName = $argDatabaseName;
        }
        
        /**
         * Check if the DatabaseManager object is instanciated
         * @throws Exception
         */
        private function checkDatabaseManager()
        {
            // check if DatabaseManager is instanciated
            if($this->_DatabaseHandler === null)
            {
                $this->_DatabaseHandler = new \mysqli($this->_Hostname, $this->_Username, $this->_Password, $this->_DatabaseName);
                // check for errors
                if ($this->_DatabaseHandler->connect_errno)
                {
                    // get the error code and message
                    $errorCode = $this->_DatabaseHandler->connect_errno;
                    $errorMessage = $this->_DatabaseHandler->connect_error;
                    // set the database handler object to null
                    $this->_DatabaseHandler = null;
                    // throw the exception
                    throw new \Exception("Could not connect to database! Error code: " . 
                            $errorCode . ". Error message: " . $errorMessage);
                }
                // set autocommit to on
                $this->_DatabaseHandler->autocommit(TRUE);
            }
        }
        
        /**
         * Returns the type of connection used
         * @return string
         */
        public function GetHostInfo()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->host_info;
        }
        
        /**
         * Returns the MySQL client library version
         * @return string
         */
        public function GetClientInfo()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->client_info;
        }
        
        /**
         * Returns the client version number (in format: main_version*10000 + minor_version *100 + sub_version)
         * @return int
         */
        public function GetClientVersion()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->client_version;
        }
        
        /**
         * Returns the last error code for the most recent MySQLi function call that can succeed or fail
         * @return int
         */
        public function GetErrorCode()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->errno;
        }
        
        /**
         * Returns the last error message for the most recent MySQLi function call that can succeed or fail
         * @return string
         */
        public function GetErrorMessage()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->error;
        }
        
        /**
         * Returns the version of the MySQL protocol used
         * @return int
         */
        public function GetProtocolInfo()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->protocol_version;          
        }
        
        /**
         * Returns the version of the MySQL server
         * @return string 
         */
        public function GetServerInfo()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->server_info;                    
        }
        
        /**
         * Returns the version of the MySQL server
         * @return int
         */
        public function GetServerVersion()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->server_version;
        }
        
        /**
         * Returns information about the most recently executed query
         * @return string
         */
        public function GetQueryInformation()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->info;
        }
        
        /**
         * Turns on or off auto-committing database modifications
         * @param bool $argMode
         * @return bool Returns TRUE on success or FALSE on failure
         */
        public function SetAutoCommitMode($argMode)
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->autocommit($argMode);
        }
        
        /**
         * Returns the current state of autocommit mode on queries for the database connection
         * @return bool
         */
        public function GetAutoCommitMode()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->query("SELECT @@autocommit")->fetch_row()[0];
        }
        
        /**
         * Returns the current character set for the database connection
         * @return String
         */
        public function GetCharacterSetName()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->character_set_name();
        }
        
        /**
         * Sets the default character set for the database connection
         * @param type $argCharacterSetName the charset to be set as default
         * @return bool Returns TRUE on success or FALSE on failure. 
         */
        public function SetCharacterSetName($argCharacterSetName)
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->set_charset($argCharacterSetName);
        }
        
        /**
         * Returns statistics about the client connection. Available only with mysqlnd
         * @return array
         */
        public function GetConnectionStatistics()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->get_connection_stats();
        }
        
        /**
         * Gets the current system status.
         * Returns a string containing information similar to that provided by 
         * the 'mysqladmin status' command. This includes uptime in seconds and 
         * the number of running threads, questions, reloads, and open tables. 
         * @return string
         */
        public function GetServerStatus()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->stat();
        }
        
        /**
         * Returns the current process/thread ID
         * @return int
         */
        public function GetCurrentThreadID()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->thread_id;
        }
        
        /**
         * Kills the current Database handler object, only if it is instanciated
         */
        public function KillCurrentDatabaseHandler()
        {
            // check if our database handler exists
            if($this->_DatabaseHandler !== null)
            {
                // Kill connection
                $this->_DatabaseHandler->kill($this->_DatabaseHandler->thread_id);
                // Close connection
                $this->_DatabaseHandler->close();
                // Dereference the closed object
                $this->_DatabaseHandler = null;                
            }
        }
        
        /**
         * Returns whether the connection to the server is working
         * @return bool
         */
        public function Ping()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->ping();
        }
        
        /**
         * Selects the default database for database queries
         * @param type $argDatabaseName The database name
         * @return bool Returns TRUE on success or FALSE on failure. 
         */
        public function SetDefaultDatabase($argDatabaseName)
        {
            $this->checkDatabaseManager();
            if($this->_DatabaseHandler->select_db($argDatabaseName))
            {
                $this->_DatabaseName = $argDatabaseName;
                return true;
            }
            return false;
        }
        
        /**
         * Returns the name of the selected default database for database queries
         * @return string
         */
        public function GetDefaultDatabase()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->query("SELECT DATABASE()")->fetch_row()[0];
        }
        
        /**
         * Escapes special characters in a string for use in an SQL statement, 
         * taking into account the current charset of the connection.
         * Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z. 
         * It can also escape underscore (_) and percent (%) characters, 
         * if it is so specified.
         * @param string $argString The string to be escaped. 
         * @param bool $argEscapeUnderscorePercentCharacters whether to escape underscore and percent characters
         * @return string The escaped string
         */
        public function EscapeString($argString, $argEscapeUnderscorePercentCharacters = false)
        {
            $this->checkDatabaseManager();
            $escapedString = $this->_DatabaseHandler->real_escape_string($argString);
            if($argEscapeUnderscorePercentCharacters)
            {
                $escapedString = addcslashes($escapedString, '%_');
            }
            return $escapedString;
        }        
        
        public function SqlGetArray($argSql, $argClassName = '')
        {
            $this->checkDatabaseManager();            
            $result = $this->_DatabaseHandler->query($argSql);
            if ($result) 
            {
                // Create the final result array to return to the user
                $finalArray = array();
                
                // check if user provided with $argClassName
                if($argClassName == '')
                {
                    // we don't have an object definition, so fetch an array
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        $finalArray[] = $row;
                    }                    
                }
                else
                {
                    // we have an object definition, so fetch an object
                    while ($obj = $result->fetch_object($argClassName)) 
                    {
                        $finalArray[] = $obj;
                    }                    
                }
                // free result set
                $result->close();                
                return $finalArray;
            }
            else
            {
                throw new \Exception("Error on query!");
            }            
        }
        
        public function SqlGetSingleValue($argSql)
        {
            $this->checkDatabaseManager();
            $result = $this->_DatabaseHandler->query($argSql);
            if ($result) 
            {
                $row = $result->fetch_array(MYSQLI_NUM);
                if($row !== NULL)
                {
                    return $row[0];
                }
                else
                {
                    return NULL;
                }
            }
            else
            {
                throw new \Exception("Error on query:\r\n" . $this->GetErrorMessage() . "\r\n" . "SQL query:\r\n" . $argSql);
            }
        }
        
        public function SqlExecute($argSql)
        {
            $this->checkDatabaseManager();
            // DML queries don't return a result set
            if ($this->_DatabaseHandler->query($argSql) !== TRUE) 
            {
                throw new \Exception("Error on query:\r\n" . $this->GetErrorMessage() . "\r\n" . "SQL query:\r\n" . $argSql);
            }
        }
        
        public function SqlMultiExecute($argSqlArray)
        {
            $this->checkDatabaseManager();
            // ALWAYS USE TRANSACTION!!!
            
            // set autocommit to off
            $this->_DatabaseHandler->autocommit(FALSE);
            
            // iterrate through all the sql queries
            foreach ($argSqlArray as $argSql)
            {
                // Execute the query and check for errors
                if ($this->_DatabaseHandler->query($argSql) !== TRUE) 
                {
                    $errorMessage = $this->GetErrorMessage();
                    // rollback the transaction
                    $this->_DatabaseHandler->rollback();
                    // set autocommit to on
                    $this->_DatabaseHandler->autocommit(TRUE);
                    // throw the exception
                    throw new \Exception("Error on query:\r\n" . $errorMessage . "\r\n" . "SQL query:\r\n" . $argSql);
                }
            }
            // if we got here without an exception, everything went according to plan
            // commit transaction
            $this->_DatabaseHandler->commit();
            
            // set autocommit to on
            $this->_DatabaseHandler->autocommit(TRUE);            
            
            /* The same using multi_query method
             * 
            // execute multi query
            if ($this->_DatabaseHandler->multi_query($argSql)) 
            {
                do 
                {
                    // We only support DML queries, so we don't need the result object
                    // Check to see if there are more results (actually, more queries)
                    if ($this->_DatabaseHandler->more_results()) 
                    {
                        // Check to see if there is an error
                        if(!$this->_DatabaseHandler->next_result())
                        {
                            // rollback the transaction
                            $this->_DatabaseHandler->rollback();
                            // set autocommit to on
                            $this->_DatabaseHandler->autocommit(TRUE);
                            // throw the exception
                            echo $this->GetErrorMessage();
                            throw new \Exception("Error on query!");                            
                        }
                    }                    
                } while (TRUE);
            }
            else
            {
                echo $this->GetErrorMessage();
                // rollback transaction
                $this->_DatabaseHandler->rollback();
                // set autocommit to on
                $this->_DatabaseHandler->autocommit(TRUE);
                // throw the exception                
                throw new \Exception("Error on query!");
            }
            
            // commit transaction
            $this->_DatabaseHandler->commit();
            
            // set autocommit to on
            $this->_DatabaseHandler->autocommit(TRUE);
             * 
             */
        }        
    }
}
