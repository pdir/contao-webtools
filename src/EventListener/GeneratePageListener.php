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

namespace Pdir\ContaoWebtoolsBundle\EventListener;

use Contao\Automator;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FilesModel;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;
use Contao\StringUtil;
use Contao\System;

/**
 * @Hook("generatePage")
 */
class GeneratePageListener
{
    private $scripts;
    private $layout;

    public function __invoke(PageModel $pageModel, LayoutModel $layout, PageRegular $pageRegular): void
    {
        $container = System::getContainer();
        $kernel = $container->get('kernel');

        $this->scripts = $container->get('request_stack')->getCurrentRequest()->get('scripts');
        $this->layout = $layout;

        // Purge script cache in dev mode
        if ($kernel->isDebug()) {
            $this->purgeScriptCache();

            return;
        }

        // Purge script cache via button in back end if WEBTOOLS_ALLOW_PURGE=true
        if (
            isset($_ENV['WEBTOOLS_ALLOW_PURGE']) && 'true' === $_ENV['WEBTOOLS_ALLOW_PURGE'] &&
            'purge' === $this->scripts
        ) {
            $this->purgeScriptCache();
        }
    }

    /**
     * Special thanks to Marko Cupic for the purgeScriptCache function and the idea!
     * https://github.com/markocupic/contao-theme-boilerplate-bundle/blob/master/src/Resources/contao/hooks/GetPageLayout.php
     * Original license MIT.
     *
     * @author     Marko Cupic <m.cupic@gmx.ch>
     */
    public function purgeScriptCache(): void
    {
        $objAutomator = new Automator();
        $objAutomator->purgeScriptCache();
        $rootDir = System::getContainer()->getParameter('kernel.project_dir');

        if ('' !== $this->layout->external) {
            $arrExternal = StringUtil::deserialize($this->layout->external);

            if (!empty($arrExternal) && \is_array($arrExternal)) {
                $objFile = FilesModel::findMultipleByUuids($arrExternal);

                while ($objFile->next()) {
                    if (is_file($rootDir.'/'.$objFile->path)) {
                        touch($rootDir.'/'.$objFile->path);
                    }
                }
            }
        }
    }
}
