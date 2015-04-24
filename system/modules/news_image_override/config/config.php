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


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['parseArticles'][] = array('NewsImageOverride','parseArticles');
