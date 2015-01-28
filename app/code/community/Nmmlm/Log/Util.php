<?php
/**
 * Additional utilities to handle loggers.
 *
 * Authors: Alex Gusev <alex@flancer64.com>
 */
class Nmmlm_Log_Util
{
   /** Returns all  */
    public static function getAllLoggerAppendersInHierarchy($logger)
    {
        $result = array();
        if ($logger) {
            // add current logger appenders to results
            $result = array_merge($logger->getAllAppenders(), Nmmlm_Log_Util::getAllLoggerAppendersInHierarchy($logger->getParent()));
        }
        return $result;
    }
}
