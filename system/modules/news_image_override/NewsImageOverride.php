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


class NewsImageOverride extends \Frontend
{
	/**
	 * Checks if there is an image size present in both the module and the news entry
	 * and re-adds the image to the template, this time using the image size of the news entry
	 */
	public function parseArticles( $objTemplate, $arrData, $objModule )
	{
		// check if there is anything to be done at all
		if( !$arrData['addImage'] || $arrData['singleSRC'] == '' || $objModule->disallowOverride )
			return;

		// in versions prior to 3.2.3 we need to fetch the original article data (*NOT* from the \NewsModel)
		// see https://github.com/contao/core/blob/3.2.2/system/modules/news/modules/ModuleNews.php#L176
		//  vs https://github.com/contao/core/blob/3.2.3/system/modules/news/modules/ModuleNews.php#L170  
		if( version_compare( VERSION, '3.2.3', '<' ) )
		{
			$objArticle = \Database::getInstance()->prepare('SELECT * FROM tl_news WHERE id = ?')->execute( $arrData['id'] );
			$arrData = $objArticle->row();
		}

		// check if there is any data in 'size' of article and module
		if( $arrData['size'] == '' || $objModule->imgSize == '' )
			return;

		// inspect size arrays
		$itemSize = deserialize( $arrData['size'] );
		$moduleSize = deserialize( $objModule->imgSize );

		// either width or height must be greater than zero, or third parameter must be numeric
		if( ( $itemSize[0] > 0 || $itemSize[1] > 0 || is_numeric( $itemSize[2] ) ) && ( $moduleSize[0] > 0 || $moduleSize[1] > 0 || is_numeric( $moduleSize[2] ) ) )
		{
			// set path
			$arrData['singleSRC'] = $objTemplate->singleSRC;

			// re-add image to template, but this time use the article size
			$this->addImageToTemplate( $objTemplate, $arrData );
		}
	}
}
