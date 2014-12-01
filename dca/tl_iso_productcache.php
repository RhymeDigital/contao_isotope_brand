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




/**
 * Add fields to tl_iso_productcache
 */
$GLOBALS['TL_DCA']['tl_iso_productcache']['fields']['brand_id'] = array
(
            'sql'  => "int(10) unsigned NOT NULL default '0'",
);



/**
 * Add keys to tl_iso_productcache
 */
 
array_insert($GLOBALS['TL_DCA']['tl_iso_productcache']['config']['sql']['keys'], 1, array 
(
  'brand_id'    => 'index',
));






class tl_iso_productcache_brands extends Backend {}
