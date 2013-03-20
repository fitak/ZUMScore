<?php

namespace ZUMStats\Exceptions;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZUMException
 *
 * @author Jenda
 */
class ZUMException extends \Exception { 
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

?>
