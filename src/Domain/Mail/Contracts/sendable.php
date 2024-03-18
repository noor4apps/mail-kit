<?php

namespace Domain\Mail\Contracts;

interface sendable
{
    public function id(): int;

    public function type(): string;
}
