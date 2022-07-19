<?php

namespace Manuel\Core\Exceptions;

use Manuel\Core\Exceptions\ExceptionBase;

class CouldNotFindInvoice extends ExceptionBase
{
    public function __construct()
    {
        parent::__construct('Could not find invoice', 2, $previous = null);
    }
}