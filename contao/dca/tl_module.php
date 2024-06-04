<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Image Override extension.
 *
 * (c) INSPIRED MINDS
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_module']['fields']['disallowOverride'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => ['type' => 'boolean', 'default' => false],
];

PaletteManipulator::create()
    ->addField('disallowOverride', 'imgSize')
    ->applyToPalette('newslist', 'tl_module')
    ->applyToPalette('newsreader', 'tl_module')
    ->applyToPalette('newsarchive', 'tl_module')
;
