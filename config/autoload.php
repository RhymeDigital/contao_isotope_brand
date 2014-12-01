<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Isotope_brand
 * @link    https://contao.org
 
 * PHP version 5
 * @copyright  360fusion  2014
 * @author     Darrell Martin <darrell@360fusion.co.uk>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */



/**
 * Register PSR-0 namespace
 */
NamespaceClassLoader::add('Isotope', 'system/modules/isotope_brand/library');



/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_iso_brandnav'               => 'system/modules/isotope_brand/templates/modules',
    'mod_iso_brandlist'              => 'system/modules/isotope_brand/templates/modules',
    'iso_brandnav_textlinks'         => 'system/modules/isotope_brand/templates/brand',
    'iso_brandnav_imagelinks'        => 'system/modules/isotope_brand/templates/brand',
));


