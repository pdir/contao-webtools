<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ecsConfig): void {

    $date = date('Y');

    $header = <<<EOF
Web-Tools Bundle for Contao Open Source CMS

Copyright (c) $date pdir / digital agentur // pdir GmbH

@package    webtools-bundle
@link       https://pdir.de/contao-webtools/
@license    LGPL-3.0-or-later
@author     Mathias Arzberger <develop@pdir.de>
@author     Christian Mette <develop@pdir.de>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;


    $ecsConfig->sets([__DIR__.'/tools/ecs/vendor/contao/easy-coding-standard/config/contao.php']);

    $ecsConfig->ruleWithConfiguration(HeaderCommentFixer::class, [
        'header' => $header
    ]);

    if (PHP_VERSION_ID < 80000) {
        $ecsConfig->ruleWithConfiguration(\PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer::class, ['elements' => ['arrays'], 'after_heredoc' => true]);
        $ecsConfig->skip([\PhpCsFixer\Fixer\PhpUnit\PhpUnitExpectationFixer::class]); // see https://github.com/symplify/symplify/issues/3130
    }

    // Adjust the configuration according to your needs.
    $parameters = $ecsConfig->parameters();

    //$ecsConfig->set();
};
