<?php

dump(__FILE__);

/*
 * Backend modules
 */
$GLOBALS['BE_MOD']['pdir']['pano_product'] = [
    'tables' => ['tl_pano_product'],
    'stylesheet' => 'assets/app/css/be.css'
];

/*
 * Models
 */
#$GLOBALS['TL_MODELS']['tl_pano_product'] = PanoProductModel::class;
