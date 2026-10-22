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
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FilesModel;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;
use Contao\StringUtil;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsHook('generatePage')]
class GeneratePageListener
{
    public function __construct(
        private readonly RequestStack $requestStack,
        #[Autowire('%kernel.debug%')]
        private readonly bool $debug,
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
    ) {
    }

    public function __invoke(PageModel $pageModel, LayoutModel $layout, PageRegular $pageRegular): void
    {
        // Purge script cache in dev mode
        if ($this->debug) {
            $this->purgeScriptCache($layout);

            return;
        }

        $scripts = $this->requestStack->getCurrentRequest()?->query->get('scripts');

        // Purge script cache via button in back end if WEBTOOLS_ALLOW_PURGE=true
        if (
            isset($_ENV['WEBTOOLS_ALLOW_PURGE']) && 'true' === $_ENV['WEBTOOLS_ALLOW_PURGE'] &&
            'purge' === $scripts
        ) {
            $this->purgeScriptCache($layout);
        }
    }

    /**
     * Special thanks to Marko Cupic for the purgeScriptCache function and the idea!
     * https://github.com/markocupic/contao-theme-boilerplate-bundle/blob/master/src/Resources/contao/hooks/GetPageLayout.php
     * Original license MIT.
     *
     * @author     Marko Cupic <m.cupic@gmx.ch>
     */
    public function purgeScriptCache(LayoutModel $layout): void
    {
        $objAutomator = new Automator();
        $objAutomator->purgeScriptCache();

        if (empty($layout->external)) {
            return;
        }

        $arrExternal = StringUtil::deserialize($layout->external);

        if (empty($arrExternal) || !\is_array($arrExternal)) {
            return;
        }

        $objFile = FilesModel::findMultipleByUuids($arrExternal);

        if (null === $objFile) {
            return;
        }

        while ($objFile->next()) {
            if (is_file($this->projectDir.'/'.$objFile->path)) {
                touch($this->projectDir.'/'.$objFile->path);
            }
        }
    }
}
