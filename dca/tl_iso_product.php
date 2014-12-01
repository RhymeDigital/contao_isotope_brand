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
 * Add fields to tl_iso_product
 */
$GLOBALS['TL_DCA']['tl_iso_product']['fields']['brand'] = array
(
            'label'                 => &$GLOBALS['TL_LANG']['tl_iso_product']['brand'],
            'exclude'               => true,
            'search'                => true,
            'sorting'               => true,
            'inputType'             => 'select',
            'options_callback'      => array('Isotope\Model\Brand', 'getOptions'),
            'foreignKey'            => \Isotope\Model\Brand::getTable().'.name',
            'eval' 									=> array('includeBlankOption'=> true),
            'attributes'            => array('legend'=>'general_legend', 'multilingual'=>true, 'fixed'=>true, 'fe_sorting'=>true, 'fe_search'=>true),
            'sql'                   => "varchar(255) NOT NULL default ''",

);


class tl_iso_product_brands extends Backend {}
