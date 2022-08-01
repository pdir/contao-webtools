<?php

declare(strict_types=1);

use Contao\Combiner;

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

if ('BE' === TL_MODE) {
    $assetsDir = 'bundles/pdircontaowebtools';

    $combiner = new Combiner();
    $combiner->add($assetsDir . '/scss/backend.scss');
    $GLOBALS['TL_CSS'][] = str_replace('TL_ASSETS_URL', '', $combiner->getCombinedFile());
}