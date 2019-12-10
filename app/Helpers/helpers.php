<?php



if ( !function_exists('trace') ) {

    function trace($msg, $die = false) {

        if ( env('APP_DEBUG', false) == false ) {
            return;
        }

        $s = print_r($msg, true);
        $s .= "\n";
        error_log($s, 3, storage_path("logs/trace.log"));
        if ( $die ) {
            echo ('<pre>');
            print_r($s);
            echo ('</pre>');
        }
    }
}

if ( !function_exists('getCallingFunctionName') ) {
    function getCallingFunctionName($completeTrace = false)
    {
        $trace = debug_backtrace();
        if ($completeTrace) {
            $str = '';
            foreach ($trace as $caller) {
                $str .= " -- Called by {$caller['function']}";
                if (isset($caller['class']))
                    $str .= " From Class {$caller['class']}";
            }
        } else {
            $caller = $trace[2];
            $str = "Called by {$caller['function']}";
            if (isset($caller['class']))
                $str .= " From Class {$caller['class']}";
        }
        trace($str);
    }
}