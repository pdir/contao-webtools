<?php

declare(strict_types=1);

namespace Pdir\ContaoWebtools\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Pdir\ContaoWebtools\PdirContaoWebtools;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(PdirContaoWebtools::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
