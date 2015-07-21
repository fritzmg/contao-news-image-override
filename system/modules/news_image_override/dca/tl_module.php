<?php

/**
 * Contao Open Source CMS
 *
 * Allows the image settings of each news entry in Contao to override the image settings of the news module
 * 
 * @copyright inspiredminds 2015
 * @package   news_image_override
 * @link      http://www.inspiredminds.at
 * @author    Fritz Michael Gschwantner <fmg@inspiredminds.at>
 * @license   GPL-2.0
 */


$GLOBALS['TL_DCA']['tl_module']['palettes']['newslist']    = str_replace(',imgSize', ',imgSize,disallowOverride', $GLOBALS['TL_DCA']['tl_module']['palettes']['newslist']);
$GLOBALS['TL_DCA']['tl_module']['palettes']['newsreader']  = str_replace(',imgSize', ',imgSize,disallowOverride', $GLOBALS['TL_DCA']['tl_module']['palettes']['newsreader']);
$GLOBALS['TL_DCA']['tl_module']['palettes']['newsarchive'] = str_replace(',imgSize', ',imgSize,disallowOverride', $GLOBALS['TL_DCA']['tl_module']['palettes']['newsarchive']);

$GLOBALS['TL_DCA']['tl_module']['fields']['disallowOverride'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['disallowOverride'],
	'exclude'   => true,
	'inputType' => 'checkbox',
	'eval'      => array('tl_class'=>'w50 m12'),
	'sql'       => "char(1) NOT NULL default ''"
);
