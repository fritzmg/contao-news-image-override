<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Image Override extension.
 *
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
