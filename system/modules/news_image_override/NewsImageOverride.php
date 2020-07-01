<?php

use Contao\Controller;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\Validator;

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


class NewsImageOverride
{
	/**
	 * Checks if there is an image size present in both the module and the news entry
	 * and re-adds the image to the template, this time using the image size of the news entry
	 */
	public function parseArticles($objTemplate, $arrData, $objModule)
	{
		// check if there is anything to be done at all
		if (!$arrData['addImage'] || empty($arrData['singleSRC']) || $objModule->disallowOverride || Validator::isUuid($objTemplate->singleSRC)) {
			return;
		}

		// check if there is any data in 'size' of article
		if (empty($arrData['size'])) {
			return;
		}

		// inspect size arrays
		$size = StringUtil::deserialize($arrData['size'], true);

		if (empty($size)) {
			return;
		}

		if (3 !== count($size)) {
			return;
		}

		// either width or height must be greater than zero, or third parameter must be numeric or pre-defined image size identifier
		if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2]) || (is_string($size[2]) && 0 === strpos($size[2], '_'))) {
			// Load meta info
			$objFile = FilesModel::findByUuid($arrData['singleSRC']);

			// set path
			$arrData['singleSRC'] = $objTemplate->singleSRC;

			// re-add image to template, but this time use the article size
			Controller::addImageToTemplate($objTemplate, $arrData, null, null, $objFile);
		}
	}
}
