<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Pdir\ContaoWebtools;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PdirContaoWebtoolsBundle extends Bundle
{
    public function __construct()
    {
        dump(__FUNCTION__);
    }
}
