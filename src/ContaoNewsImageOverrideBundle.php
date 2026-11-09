<?php

declare(strict_types=1);

/*
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoNewsImageOverride;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoNewsImageOverrideBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
