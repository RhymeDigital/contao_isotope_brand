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
 * Table tl_iso_brand
 */
$GLOBALS['TL_DCA']['tl_iso_brand'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'         => 'Table',
        'enableVersioning'      => true,
        'closed'                => true,
        'onload_callback' => array
        (
            array('Isotope\Backend', 'initializeSetupModule'),
        ),
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
           		  'name' => 'index',
            )
        ),
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'              => 1,
            'fields'            => array('name'),
            'flag'              => 1,
            'panelLayout'       => 'search,limit',
        ),
        'label' => array
        (
            'fields'            => array('name'),
            'format'            => '%s',
        ),
        'global_operations' => array
        (
            'back' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['MSC']['backBT'],
                'href'          => 'mod=&table=',
                'class'         => 'header_back',
                'attributes'    => 'onclick="Backend.getScrollOffset();"',
            ),
            'new' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_iso_brand']['new'],
                'href'          => 'act=create',
                'class'         => 'header_new',
                'attributes'    => 'onclick="Backend.getScrollOffset();"',
            ),
            'all' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'          => 'act=select',
                'class'         => 'header_edit_all',
                'attributes'    => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            ),
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_iso_brand']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.gif'
            ),
            'copy' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_iso_brand']['copy'],
                'href'          => 'act=copy',
                'icon'          => 'copy.gif'
            ),
            'delete' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_iso_brand']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.gif',
                'attributes'    => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'show' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_iso_brand']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.gif'
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        'default'               => '{name_legend},name,description,image',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                 =>  "int(10) unsigned NOT NULL auto_increment",
        ),
        'tstamp' => array
        (
            'sql'                 =>  "int(10) unsigned NOT NULL default '0'",
        ),
        'name' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_iso_brand']['name'],
            'exclude'           => true,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'               => "varchar(255) NOT NULL default ''",
        ),
        'description' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_iso_brand']['description'],
            'exclude'               => true,
            'search'                => true,
            'inputType'             => 'textarea',
            'eval'                  => array('mandatory'=>true, 'rte'=>'tinyMCE', 'tl_class'=>'clr'),
            'attributes'            => array('legend'=>'general_legend', 'multilingual'=>true, 'fe_search'=>true),
            'sql'                   => "text NULL",
        ),
        'image' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_iso_brand']['image'],
            'exclude'               => true,
            'inputType'             => 'mediaManager',
            'explanation'           => 'mediaManager',
            'eval'                  => array('extensions'=>'jpeg,jpg,png,gif', 'helpwizard'=>true, 'tl_class'=>'clr'),
            'attributes'            => array('legend'=>'media_legend', 'fixed'=>true, 'multilingual'=>true, 'dynamic'=>true, 'systemColumn'=>true, 'fetch_fallback'=>true),
            'sql'                   => "blob NULL",
        ),
    )
);
