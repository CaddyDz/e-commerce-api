<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return (new Config())
    ->setRules([
        '@PSR12' => true,
    ])->setFinder(
        (new Finder())
            ->in(__DIR__)
            ->name('*.php')
            ->notPath('bootstrap/cache')
            ->notPath('node_modules')
            ->notPath('nova')
            ->notPath('storage')
            ->notPath('vendor')
            ->notName('*.blade.php')
            ->notName('_ide_helper.php')
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->append([__FILE__])
    );
