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
 * Add palettes to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'iso_brandEmptyMessage';
$GLOBALS['TL_DCA']['tl_module']['palettes']['iso_brandnav']  = '{title_legend},name,headline,type;{template_legend:hide},iso_brandnav_layout,iso_brandIncludeMessages,iso_brandEmptyMessage;{redirect_legend},iso_addBrandJumpTo;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['iso_brandlist'] = '{title_legend},name,headline,type;{config_legend},numberOfItems,perPage,iso_list_where,iso_filterModules,iso_newFilter,iso_listingSortField,iso_listingSortDirection;{redirect_legend},iso_addProductJumpTo,iso_jump_first;{reference_legend:hide},defineRoot;{template_legend:hide},iso_list_layout,iso_gallery,iso_cols,iso_use_quantity,iso_hide_list,iso_includeMessages,iso_emptyMessage,iso_emptyFilter,iso_buttons;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';




/**
 * Add subpalettes to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['subpalettes']['iso_brandEmptyMessage']      = 'iso_noBrands';




/**
 * Add fields to tl_module
 */
 
$GLOBALS['TL_DCA']['tl_module']['fields']['iso_brandnav_layout'] = array
(
    'label'                     => &$GLOBALS['TL_LANG']['tl_module']['iso_brandnav_layout'],
    'exclude'                   => true,
    'inputType'                 => 'select',
    'options_callback'          => function(\DataContainer $dc) {
        return \Isotope\Backend::getTemplates('iso_brandnav_');
    },
    'eval'                      => array('includeBlankOption'=>true, 'tl_class'=>'w90', 'chosen'=>true),
    'sql'                       => "varchar(64) NOT NULL default ''",
);


$GLOBALS['TL_DCA']['tl_module']['fields']['iso_brandIncludeMessages'] = array
(
    'label'                     => &$GLOBALS['TL_LANG']['tl_module']['iso_brandIncludeMessages'],
    'exclude'                   => true,
    'inputType'                 => 'checkbox',
    'eval'                      => array('doNotCopy'=>true, 'tl_class'=>'w50'),
    'sql'                       => "char(1) NOT NULL default ''",
);


$GLOBALS['TL_DCA']['tl_module']['fields']['iso_brandEmptyMessage'] = array
(
    'label'                     => &$GLOBALS['TL_LANG']['tl_module']['iso_brandEmptyMessage'],
    'exclude'                   => true,
    'inputType'                 => 'checkbox',
    'eval'                      => array('submitOnChange'=>true, 'tl_class'=>'clr w50'),
    'sql'                       => "char(1) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['iso_noBrands'] = array
(
    'label'                     => &$GLOBALS['TL_LANG']['tl_module']['iso_noBrands'],
    'exclude'                   => true,
    'inputType'                 => 'text',
    'eval'                      => array('maxlength'=>255, 'tl_class'=>'clr long'),
    'sql'                       => "varchar(255) NOT NULL default ''",
);



$GLOBALS['TL_DCA']['tl_module']['fields']['iso_addBrandJumpTo'] = array
(
    'label'                     => &$GLOBALS['TL_LANG']['tl_module']['iso_addBrandJumpTo'],
    'exclude'                   => true,
    'inputType'                 => 'pageTree',
    'foreignKey'                => 'tl_page.title',
    'eval'                      => array('fieldType'=>'radio', 'tl_class'=>'clr'),
    'explanation'               => 'jumpTo',
    'sql'                       => "int(10) unsigned NOT NULL default '0'",
    'relation'                  => array('type'=>'hasOne', 'load'=>'lazy'),
);