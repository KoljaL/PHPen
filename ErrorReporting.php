<?php

class ErrorReporting
{
    public static $errorMessage = 'Oops! Something went wrong.';

    private static $cwd;
    private static $debug;

    /**
     * Include this file in your PHP application and add: ErrorReporting::start($debug);
     **/
    public static function start($debug = false)
    {
        // register shutdown to catch fatal errors
        register_shutdown_function('ErrorReporting::shutdownFunction');
        // set to the user defined error and exception handler
        set_error_handler('ErrorReporting::errorHandler');
        set_exception_handler('ErrorReporting::exceptionHandler');
        // store the cwd, as the shutdown function has an inconsistent cwd
        static::$cwd = getcwd();
        static::$debug = $debug;
    }

    /**
     * The shutdown function can detect fatal errors and call the error handler
     */
    public static function shutdownFunction()
    {
        $error=error_get_last();
        if ($error) {
            static::errorHandler($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }

    /**
    * Error handler, passes flow over the exception logger or handler with new ErrorException.
    */
    public static function errorHandler(int $errorNumber, string $errorMessage, string $errorFilename, int $errorLineNumber): bool
    {
        if (!(error_reporting() & $errorNumber)) {
            // This error code is not included in error_reporting
            return false;
        }
        $errorException = new \ErrorException($errorMessage, 0, $errorNumber, $errorFilename, $errorLineNumber);
        if (static::$debug) {
            static::exceptionHandler($errorException);
        } else {
            static::exceptionLogger($errorException);
        }
        // Don't execute PHP internal error handler
        return true;
    }

    /**
     * This function can map an ErrorException's severity (int) to a string: 'Error', 'Warning', 'Notice', 'Strict', 'Deprecated'
     */
    private static function getErrorType(int $code): string
    {
        switch ($code) {
            case E_WARNING:
            case E_USER_WARNING:
            case E_COMPILE_WARNING:
            case E_RECOVERABLE_ERROR:
                return 'Warning';
            case E_NOTICE:
            case E_USER_NOTICE:
                return 'Notice';
            case E_STRICT:
                return 'Strict';
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                return 'Deprecated';
            default:
                return 'Error';
        }
    }

    /**
     * Exception handler, will surpress any output and show the configured error message.
     */
    public static function exceptionHandler(\Throwable $exception)
    {
        if (!static::$debug) {
            while (ob_get_level()) {
                ob_end_clean();
            }
        }
        static::exceptionLogger($exception);
        http_response_code(500);
        if (!static::$debug) {
            die(static::$errorMessage);
        }
    }

    /**
     * Exception logger, will write all information about the error to the 'logs/errors.log' file
     */
    private static function exceptionLogger(\Throwable $exception)
    {
        $uri = $_SERVER['REQUEST_URI']??null;
        $exceptionType = get_class($exception);
        $exceptionMessage = $exception->getMessage();
        $errorNumber = $exception->getCode();
        $filename = $exception->getFile();
        $lineNumber = $exception->getLine();
        $trace = $exception->getTraceAsString();
        $traceHtml = str_replace("\n", "<br />\n", $trace);
        $severity = ($exception instanceof \ErrorException) ? $exception->getSeverity() : 0;
        $errorType = static::getErrorType($severity);
        // error_log("$errorType: $exceptionType: $exceptionMessage in $filename:$lineNumber");

        if (static::$debug) {
            $lineNumber = $lineNumber -11;
            echo "<br />\n<b style='color:#be1100;'>$errorType</b> -> ";
            echo "<b style='color:#cca700;'>$exceptionType</b><br>";
            echo "$exceptionMessage on line <b>$lineNumber</b><br />\n";
        // echo "Stack trace:<br />\n$traceHtml<br />\n<br />\n";
        }
        // if $debug === false
        else {
            // write error as JSON in file
            $error = [
                'type' => $errorType,
                'name' => $exceptionType,
                'number' => ($exception instanceof \ErrorException) ? $severity : $errorNumber,
                'message' => $exceptionMessage,
                'file' => $filename,
                'line' => $lineNumber,
                'uri' => $uri,
                'trace' => $trace,
                'created' => date('Y-m-d H:i:s'),
            ];
            file_put_contents(static::$cwd.'/error.log', json_encode($error)."\n", FILE_APPEND);
        }
    }
}
