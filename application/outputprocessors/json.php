<?php

namespace OutputProcessors;

/**
 * Class containing logic to pack output data as JSON string
 */
class Json implements \Interfaces\OutputProcessor {
    
    /**
     * Generates JSON output in a standard API response form
     * 
     * @param string $status overall processing status
     * @param mixed $output any output to be encoded
     * @return string
     * @throws Exception
     */
    public function generate($status, $output) {
        if(function_exists('json_encode')) {
            $response = new\stdClass();
            $response->status = $status;
            $response->body = $output;
            if($r = json_encode($response)) {
                return $r;
            } else {
                $error = json_last_error_msg();
                \Logger::error($error);
                throw \ExceptionHandler::exception(__('Internal error occurred.'));
            }
            return null;
        } else {
            throw \ExceptionHandler::exception(__('JSON extension is now available for PHP'));
        }
    }
}
