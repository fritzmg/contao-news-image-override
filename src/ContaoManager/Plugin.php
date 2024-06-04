<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Image Override extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoNewsImageOverride\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\NewsBundle\ContaoNewsBundle;
use InspiredMinds\ContaoNewsImageOverride\ContaoNewsImageOverrideBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoNewsImageOverrideBundle::class)
                ->setLoadAfter([ContaoNewsBundle::class]),
        ];
    }
}
