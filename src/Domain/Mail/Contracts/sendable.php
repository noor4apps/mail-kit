<?php

namespace Domain\Mail\Contracts;

interface sendable
{
    public function id(): int;

    public function type(): string;

    public function subject(): string;

    public function content(): string;
}
