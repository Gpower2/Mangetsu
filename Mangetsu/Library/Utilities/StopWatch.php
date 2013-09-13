<?php
namespace Mangetsu\Library\Utilities
{
    /**
     * A stopwatch class used to measure elapsed time.
     * It relies on the microtime function.
     */
    class StopWatch
    {
        private $_State;
        private $_StartTime;
        private $_EndTime;
        
        /**
         * It initializes a StopWatch instance, defining the private constants,
         * and initializing the state and time variables.
         */
        public function __construct()
        {
            define('STOPWATCH_UNINITIALIZED', 0);
            define('STOPWATCH_STARTED', 1);
            define('STOPWATCH_STOPPED', 2);
            
            $this->_State = STOPWATCH_UNINITIALIZED;
            $this->_StartTime = 0.0;
            $this->_EndTime = 0.0;
        }
        
        /**
         * Starts the stopwatch
         */
        public function Start()
        {            
            $this->_StartTime = microtime(true);
            $this->_State = STOPWATCH_STARTED;
        }        
        
        /**
         * Stops the stopwatch
         */
        public function Stop()
        {
            $this->_EndTime = microtime(true);
            $this->_State = STOPWATCH_STOPPED;
        }
        
        /**
         * Returns the current elapsed time in seconds since the start time.
         * WARNING! It ignores the stopped state! It only check if the stopwatch
         * wa started and returns the elapsed time from then!
         * @return float
         */
        public function GetCurrentElapsedSeconds()
        {
            if($this->_State == STOPWATCH_UNINITIALIZED)
            {
                return 0.0;
            }
            else
            {
                return microtime(true) - $this->_StartTime;
            }
        }
        
        /**
         * Returns the elapsed time in seconds from stop time to start time
         * @return float
         */
        public function GetElapsedSeconds()
        {
            if($this->_State == STOPWATCH_STOPPED)
            {
                return $this->_EndTime - $this->_StartTime;
            }
            elseif($this->_State == STOPWATCH_UNINITIALIZED ||
                   $this->_State == STOPWATCH_STARTED )
            {
                return 0.0;
            }
        }
        
        /**
         * Returns the current state of the stopwatch
         * @return type
         */
        public function GetState()
        {
            return $this->_State;
        }
    }
}
?>
