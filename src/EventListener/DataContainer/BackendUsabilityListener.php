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

namespace Pdir\ContaoWebtoolsBundle\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("loadDataContainer")
 */
class BackendUsabilityListener
{
    public function __invoke(string $table): void
    {
        if ('tl_page' === $table) {
            // Show page ids
            $GLOBALS['TL_DCA']['tl_page']['list']['label']['fields'][] = 'id';
            $GLOBALS['TL_DCA']['tl_page']['list']['label']['format'] = '%s <span style="color:#999;padding-left:3px;">(ID: %s)</span>';
        }

        if ('tl_article' === $table) {
            // Show article ids
            $GLOBALS['TL_DCA']['tl_article']['list']['label']['fields'][] = 'id';
            $GLOBALS['TL_DCA']['tl_article']['list']['label']['format'] = '%s <span style="color:#999; padding-left: 3px;">[%s] (ID: %s)</span>';
        }

        if ('tl_module' === $table) {
            // Show module ids
            $GLOBALS['TL_DCA']['tl_module']['list']['sorting']['child_record_callback'] = static fn($row) => '<div style="float:left;">' . $row['name'] . ' <span style="color:#999;padding-left:3px;">[' . $GLOBALS['TL_LANG']['FMD'][$row['type']][0] . '] (ID: ' . $row['id'] . ")</span></div>\n";
        }
    }
}
