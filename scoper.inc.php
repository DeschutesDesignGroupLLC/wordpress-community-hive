<?php

declare(strict_types=1);

use Isolated\Symfony\Component\Finder\Finder;

return [
    'prefix' => 'CommunityHive\Vendor',
    'output-dir' => 'build',
    'finders' => [
        Finder::create()
            ->files()
            ->in('src'),
        Finder::create()
            ->files()
            ->ignoreVCS(true)
            ->notName('/LICENSE|.*\\.md|.*\\.dist|Makefile|composer\\.json|composer\\.lock/')
            ->exclude([
                'doc',
                'test',
                'test_old',
                'tests',
                'Tests',
                'vendor-bin',
            ])
            ->in('vendor'),
        Finder::create()->append([
            'communityhive.php',
            'composer.json'
        ])
    ],
    'exclude-files' => [
        ...array_values(array_map(
            static fn (SplFileInfo $fileInfo) => $fileInfo->getPathName(),
            iterator_to_array(
                Finder::create()
                    ->files()
                    ->in('vendor/illuminate/console/resources/views/components')
            )
        ))
    ],
    'patchers' => [],
    'exclude-namespaces' => [
        'CommunityHive\App',
        'CommunityHive\Database',
        'CommunityHive\Tests',
        'Illuminate'
    ],
    'exclude-classes' => ['WP', 'WP_Theme', 'WP_CLI', 'WP_User'],
    'exclude-functions' => ['get_theme_file_path', 'apply_filters'],
    'exclude-constants' => [],
    'expose-global-constants' => true,
    'expose-global-classes' => true,
    'expose-global-functions' => true,
    'expose-namespaces' => [],
    'expose-classes' => [],
    'expose-functions' => [],
    'expose-constants' => [],
];
