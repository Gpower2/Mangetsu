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
        
        public function GetCharacterSetName()
        {
            
        }
    }
}
