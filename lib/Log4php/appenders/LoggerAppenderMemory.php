<?php
/**
 * MemoryAppender appends log events to the operative memory and allows to get events after.
 *
 * Authors: Alex Gusev <alex@flancer64.com>
 */
class LoggerAppenderMemory extends LoggerAppender
{
    private static $events = array();

    /**
     * Forwards the logging event to the destination.
     *
     * Derived appenders should implement this method to perform actual logging.
     *
     * @param LoggerLoggingEvent $event
     */
    protected function append(LoggerLoggingEvent $event)
    {
        $formatted = $this->getLayout()->format($event);
        LoggerAppenderMemory::$events[] = $formatted;
    }

    /**
     * Returns memory stored formatted events as an array.
     * @static
     * @return array
     */
    public static function getEventsAsArray()
    {
        return LoggerAppenderMemory::$events;
    }

    /**
     * * Returns memory stored formatted events as a string.
     * @static
     * @return string
     */
    public static function getEventsAsText()
    {
        return implode(LoggerAppenderMemory::$events);
    }
}
