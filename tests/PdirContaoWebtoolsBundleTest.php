<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Pdir\ContaoWebtoolsBundle\Tests;

use Pdir\ContaoWebtoolsBundle\DependencyInjection\PdirContaoWebtoolsExtension;
use PHPUnit\Framework\TestCase;

class PdirContaoWebtoolsBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new PdirContaoWebtoolsExtension();

        $this->assertInstanceOf('Pdir\ContaoWebtoolsBundle\PdirContaoWebtoolsExtension', $bundle);
    }
}
