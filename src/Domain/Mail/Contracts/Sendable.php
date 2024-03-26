<?php

namespace Domain\Mail\Contracts;

use Domain\Mail\DataTransferObjects\FilterData;

interface Sendable
{
    public function id(): int;

    public function type(): string;

    public function subject(): string;

    public function content(): string;

    public function filters(): FilterData;
}
