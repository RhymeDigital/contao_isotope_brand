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

use Isotope\Model\ProductCache;


class BrandCache extends ProductCache
{

    /**
     * Find cache for module on page (including current environment)
     * @param   int
     * @param   int
     * @return  ProductCache|null
     */
    public static function findForPageAndBrandAndModule($intPage, $intModule, $intBrand, array $arrOptions = array())
    {
        return static::findOneBy(
            array(
                 'page_id=?',
                 'brand_id=?',
                 'module_id=?',
                 'requestcache_id=?',
                 "(keywords=? OR keywords='')",
                 '(expires>? OR expires=0)',
                 'groups=?'
            ),
            array($intPage, $intBrand, $intModule, (int) \Input::get('isorc'), (string) \Input::get('keywords'), time(), static::getCacheableGroups()),
            $arrOptions
        );
    }
    


    /**
    * Create a cache object for module on page (including current environment
    * @param   int
    * @param   int
    * @param   int
    * @return  ProductCache
    */
    public static function createForPageAndBrandAndModule($intPage, $intModule, $intBrand)
    {
        $objCache = new static();

        $objCache->setRow(array(
            'page_id'           => $intPage,
            'module_id'         => $intModule,
            'brand_id'          => $intBrand,
            'requestcache_id'   => (int) \Input::get('isorc'),
            'groups'            => static::getCacheableGroups(),
            'keywords'          => (string) \Input::get('keywords'),
        ));

        return $objCache;
    }
    


    /**
     * Delete cache for listing module, also delete expired ones while we're at it...
     * @param   int
     * @param   int
     * @param   int
     */
    public static function deleteForPageAndBrandAndModuleOrExpired($intPage, $intModule, $intBrand)
    {
        $time = time();

        \Database::getInstance()->prepare("
            DELETE FROM " . static::$strTable . "
            WHERE (page_id=? AND module_id=? AND brand_id=? AND requestcache_id=? AND keywords=? AND groups=?) OR (expires>0 AND expires<$time)
        ")->executeUncached($intPage, $intModule, $intBrand, (int) \Input::get('isorc'), (string) \Input::get('keywords'), static::getCacheableGroups());
    }

       
       
}
