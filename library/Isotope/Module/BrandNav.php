<?php

/**
 * Isotope eCommerce for Contao Open Source CMS
 *
 * Copyright (C) 2009-2014 terminal42 gmbh & Isotope eCommerce Workgroup
 *
 * @package    Isotope
 * @link       http://isotopeecommerce.org
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

namespace Isotope\Module;

use Isotope\Isotope;
use Isotope\Model\Brand;
use Haste\Generator\RowClass;



/**
 * Class BrandNav
 *
 * PHP version 5
 * @copyright  360fusion  2014
 * @author     Darrell Martin <darrell@360fusion.co.uk>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
class BrandNav extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_iso_brandnav';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ISOTOPE ECOMMERCE: BRAND NAVIGATION &#169; 360Fusion 2014 ###';

            $objTemplate->title = $this->headline;
            $objTemplate->id    = $this->id;
            $objTemplate->link  = $this->name;
            $objTemplate->href  = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }


    /**
     * Compile brand Navigation.
     */
    protected function compile()
    {

        global $objPage;
        
         $arrBrands = $this->findBrands();
         
  
 				// No Brands found
        if (!is_array($arrBrands) || empty($arrBrands)) {
        	
           $this->Template->empty    = true;
           $this->Template->type     = 'empty';
           $this->Template->message  = $this->iso_brandEmptyMessage ? $this->iso_noBrands : $GLOBALS['TL_LANG']['MSC']['noBrands'];
           $this->Template->brands = array();

           return;
				}


         foreach ($arrBrands as $objBrand) {
            $arrConfig = array(
                'module'        => $this,
                'template'      => ($this->iso_brandnav_layout),
                'jumpTo'  			=> $this->iso_addBrandJumpTo,
            );
	          $arrBuffer[] = array(
	                'class'   => '',
	                'html'    => $objBrand->generate($arrConfig),
	                'brand'   => $objBrand,
	          );
         }
          
          RowClass::withKey('class')->addFirstLast()->applyTo($arrBuffer);
          
          $this->Template->brands = $arrBuffer;
    }
    
    
    
    /**
     * Find all brands we need to list.
     * @return  array
     */
    protected function findBrands()
    {
        $arrColumns    = array();
        $arrFilters    = array();
        $arrSorting    = array();
        $order    		 = 'name';
        $arrColumns[]  = 'tstamp < ' .time();

 				$objBrands = Brand::findBy(
 						$arrColumns,
            $arrValues,
            array(
                 'order'   => $order,
                 'filters' => $arrFilters,
                 'sorting' => $arrSorting,
            )
        );
        return (null === $objBrands) ? array() : $objBrands->getModels();
    }
    
    
}
