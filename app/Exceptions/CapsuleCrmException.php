<?php

namespace App\Exceptions;

use Exception;

/**
 * Exception Handler for Capsule Crm
 */
class CapsuleCrmException extends Exception {

    public function __construct(string $message)
    {
       parent::__construct($message);
    }

}

?>