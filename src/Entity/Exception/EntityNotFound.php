<?php

declare(strict_types=1);

namespace Entity\Exception;

class EntityNotFound extends \OutOfBoundsException
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
