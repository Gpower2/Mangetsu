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
         * Return the host information for the current database handler
         */
        public function HostInfo()
        {
            $this->checkDatabaseManager();
            return $this->_DatabaseHandler->host_info;
        }
    }
}
