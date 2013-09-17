<?php
namespace Mangetsu\Library\Database
{
    /**
     * A custom Exception object used to describe Database Operation Exceptions
     */
    class DatabaseException extends \Exception
    {
        protected $_SqlQuery = '';
        protected $_SqlErrorCode = '';
        protected $_SqlErrorMessage = '';
        
        /**
         * The constructor of the Exception, redefined so that it requires the message.
         * @param string $message The generic message of the Exception
         * @param int $argSqlErrorCode The SQL Error code
         * @param string $argSqlErrorMessage The SQL Error message
         * @param string $argSqlQuery the SQL query that generated the Exception
         */
        public function __construct($message, $argSqlErrorCode = 0, $argSqlErrorMessage = '', $argSqlQuery = '') 
        {
            // set the custom variables            
            $this->_SqlErrorCode = $argSqlErrorCode;
            $this->_SqlErrorMessage = $argSqlErrorMessage;
            $this->_SqlQuery = $argSqlQuery;
            
            // make sure everything is assigned properly
            parent::__construct($message, 0, null);
        }

        /**
         * Returns the SQL query
         * @return string
         */
        public function GetSqlQuery()
        {
            return $this->_SqlQuery;
        }
        
        /**
         * Returns the SQL error code
         * @return int
         */
        public function GetSqlErrorCode()
        {
            return $this->_SqlErrorCode;
        }
        
        /**
         * Returns the SQL error message
         * @return string
         */
        public function GetSqlErrorMessage()
        {
            return $this->_SqlErrorMessage;
        }
        
        /**
         * Returns the string representation of the DatabaseException object.
         * It contains the generic message, the SQL error code, the SQL error 
         * message and the SQL query
         * @return string
         */
        public function __toString() 
        {
            return $this->message . "\r\nError code: " . $this->_SqlErrorCode . 
                    "\r\n Error message: " . $this->_SqlErrorMessage . 
                    "\r\n Sql query:\r\n" . $this->_SqlQuery;
        }
    }
}