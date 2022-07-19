<?php

namespace Manuel\Core\Exceptions;

use Manuel\Core\Exceptions\ExceptionBase;

class CouldNotCreateInvoice extends ExceptionBase
{
    public function __construct()
    {
        parent::__construct('Could not create invoice', 2, $previous = null);
    }
}