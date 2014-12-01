<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  360fusion  2014
 * @author     Darrell Martin <darrell@360fusion.co.uk>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */



/**
 * Isotope Modules
 */
array_insert($GLOBALS['ISO_MOD']['product'], 4, array 
(
			 'brand' => array
        (
            'tables'	=> array(\Isotope\Model\Brand::getTable()),
            'icon'		=> 'system/modules/isotope_brand/assets/images/setup-brands.png'
        ),
));



/**
 * Models
 */
$GLOBALS['TL_MODELS'][\Isotope\Model\Brand::getTable()] = 'Isotope\Model\Brand';
$GLOBALS['TL_MODELS'][\Isotope\Model\BrandCache::getTable()] = 'Isotope\Model\BrandCache';



// Enable tables in iso_setup
if ($_GET['do'] == 'iso_setup')
{
    foreach ($GLOBALS['ISO_MOD'] as $strGroup=>$arrModules)
    {
        foreach ($arrModules as $strModule => $arrConfig)
        {
            if (is_array($arrConfig['tables']))
            {
                $GLOBALS['BE_MOD']['isotope']['iso_setup']['tables'] = array_merge($GLOBALS['BE_MOD']['isotope']['iso_setup']['tables'], $arrConfig['tables']);
            }
        }
    }
}



/**
 * Frontend modules
 */
 
array_insert($GLOBALS['FE_MOD']['isotope'], 1, array 
(
 'iso_brandnav'           => 'Isotope\Module\BrandNav',
 'iso_brandlist'          => 'Isotope\Module\BrandList',
));

      
?>