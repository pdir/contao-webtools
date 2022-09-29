<?php

declare(strict_types=1);

/*
 * Web-Tools Bundle for Contao Open Source CMS
 *
 * Copyright (c) 2022 pdir / digital agentur // pdir GmbH
 *
 * @package    webtools-bundle
 * @link       https://pdir.de/contao-webtools/
 * @license    LGPL-3.0-or-later
 * @author     Mathias Arzberger <develop@pdir.de>
 * @author     Christian Mette <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Contao\System;
use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('pdump')) {
    function pdump($var, ...$moreVars)
    {
        if (System::getContainer()->get('kernel')->isDebug()) {
            VarDumper::dump($var);

            foreach ($moreVars as $v) {
                VarDumper::dump($v);
            }

            if (1 < func_num_args()) {
                return func_get_args();
            }

            return $var;
        }
    }
}
