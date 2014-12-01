<?php

/**
 * Isotope eCommerce for Contao Open Source CMS
 *
 * Copyright (C) 2009-2014 terminal42 gmbh & Isotope eCommerce Workgroup
 *
 * @package    Isotope
 * @link       http://isotopeecommerce.org
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 
 * PHP version 5
 * @copyright  360fusion  2014
 * @author     Darrell Martin <darrell@360fusion.co.uk>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 
 */

namespace Isotope\Model;



class Brand extends \Model
{
    /**
     * Name of the current table
     * @var string
     */
    protected static $strTable = 'tl_iso_brand';
    
    

    /**
     * Generate a brand template
     * @param   array
     * @return  string
     */
    public function generate(array $arrConfig)
    {
    		global $objPage;
    	  $arrImages = deserialize($this->arrData['image']);
    	  foreach ($arrImages as $image) { 
    	  	$strImage = 'isotope/' . strtolower(substr($image['src'], 0, 1)) . '/' . $image['src']; 
    	  	$size = @getimagesize(TL_ROOT . '/' . $strImage);
    	  	}       
    	  
    	  $objTemplate = new \Isotope\Template($arrConfig['template']);
        $objTemplate->setData($this->arrData);
        $objTemplate->brand = $this;
        $objTemplate->config  = $arrConfig;
        $objTemplate->url = strtolower(\Environment::get('base').$this->getPageFromID($arrConfig['jumpTo']).'/name/'.str_replace(' ', '-', $this->arrData['name']));
			  $objTemplate->src = $strImage;
 				$objTemplate->width = $size[0];
 				$objTemplate->height = $size[1];
 				
        return $objTemplate->parse();
    }
    
    
  	/**
     * Returns product brand id
     * @param brandname
     * @return array
     */
 		 public static function getBrandData($brandname)
    {
    	$brandname = str_replace('-', ' ', $brandname);
    		$arrayBrand = array();
        $arrayBrand = \Database::getInstance()->execute("SELECT * FROM " . Brand::getTable() . " WHERE name='".addslashes($brandname)."'");
        return $arrayBrand;
    }
    
    
    
   
  	/**
     * Returns all product brands for backend dca
     * @param DataContainer
     * @return array
     */
    public function getOptions(\DataContainer $dc)
    {

        $arrProductTypes = array();
        $objProductTypes = \Database::getInstance()->execute("SELECT id,name FROM " . Brand::getTable() . " ORDER BY name");
        while ($objProductTypes->next()) {
            $arrProductTypes[$objProductTypes->id] = $objProductTypes->name;
        }
        return $arrProductTypes;
    }
   
   
  	/**
     * Returns Page Alias
     * @param intId
     * @return String
     */
	 	protected function getPageFromID($intId){
					global $objPage;
					if (strlen($intId))
					{
						$objNextPage = \Database::getInstance()->execute("SELECT id, alias FROM tl_page WHERE id=".$intId."");
						if ($objNextPage->numRows)
						{
							return ($this->getUrl($objNextPage->fetchAssoc()));
						}
					}
					return;
		}
	    
    
  	/**
     * Returns URL String
     * @param arrRow
     * @param strParams
     * @return String
     */
		protected function getUrl($arrRow, $strParams=''){
			$strUrl = ($GLOBALS['TL_CONFIG']['rewriteURL'] ? '' : 'index.php/') . (strlen($arrRow['alias']) ? $arrRow['alias'] : $arrRow['id']) . $strParams . $GLOBALS['TL_CONFIG']['urlSuffix'];
	
			if ($GLOBALS['TL_CONFIG']['disableAlias'])
			{
				$strRequest = '';
	
				if ($strParams)
				{
					$arrChunks = explode('/', preg_replace('@^/@', '', $strParams));
	
					for ($i=0; $i<count($arrChunks); $i=($i+2))
					{
						$strRequest .= sprintf('&%s=%s', $arrChunks[$i], $arrChunks[($i+1)]);
					}
				}
	
				$strUrl = 'index.php?id=' . $arrRow['id'] . $strRequest;
			}

			// HOOK: add custom logic
			if (isset($GLOBALS['TL_HOOKS']['generateFrontendUrl']) && is_array($GLOBALS['TL_HOOKS']['generateFrontendUrl']))
			{
				foreach ($GLOBALS['TL_HOOKS']['generateFrontendUrl'] as $callback)
				{					
					$objCallback = \System::importStatic($callback[0]);
					$strUrl = $objCallback->$callback[1]($arrRow, $strParams, $strUrl);
				}
			}
			return $strUrl;
		}
   


    
}
