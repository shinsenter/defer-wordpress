<?php

/**
 * 🚀 A WordPress plugin that focuses on minimizing payload size of HTML document
 *    and optimizing processing on the browser when rendering the WordPress page.
 * (c) 2021-2024 SHIN Company <service@shin.company>
 *
 * PHP Version >=5.6
 *
 * @category  Web_Performance_Optimization
 * @package   defer-wordpress
 * @author    Mai Nhut Tan <shin@shin.company>
 * @copyright 2021-2024 SHIN Company
 * @license   https://code.shin.company/defer-wordpress/blob/master/LICENSE GPL-2.0
 * @link      https://code.shin.company/defer-wordpress
 * @see       https://code.shin.company/defer-wordpress/blob/master/README.md
 */

$header = <<<'EOF'
🚀 A WordPress plugin that focuses on minimizing payload size of HTML document
   and optimizing processing on the browser when rendering the WordPress page.
(c) 2021-2024 SHIN Company <service@shin.company>

PHP Version >=5.6

@category  Web_Performance_Optimization
@package   defer-wordpress
@author    Mai Nhut Tan <shin@shin.company>
@copyright 2021-2024 SHIN Company
@license   https://code.shin.company/defer-wordpress/blob/master/LICENSE GPL-2.0
@link      https://code.shin.company/defer-wordpress
@see       https://code.shin.company/defer-wordpress/blob/master/README.md
EOF;

$rules = [
    '@PhpCsFixer'                => true,
    'concat_space'               => ['spacing' => 'one'],
    'header_comment'             => ['header' => $header, 'comment_type' => 'PHPDoc'],
    'increment_style'            => ['style' => 'post'],
    'no_superfluous_phpdoc_tags' => false,
    'phpdoc_summary'             => true,
    'phpdoc_to_comment'          => false,
    'phpdoc_types_order'         => ['null_adjustment' => 'always_last', 'sort_algorithm' => 'none'],

    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],

    'phpdoc_align' => ['align' => 'vertical'],

    'binary_operator_spaces' => [
        'default'   => 'single_space',
        'operators' => [
            '||'  => 'align_single_space_minimal',
            'or'  => 'align_single_space_minimal',
            '='   => 'align_single_space_minimal',
            '=>'  => 'align_single_space_minimal',
            '<=>' => 'align_single_space_minimal',
        ],
    ],

    'visibility_required' => [
        'elements' => ['method', 'property'],
    ],
];

$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->name('*.php')
    ->exclude('.dist')
    ->exclude('.docker')
    ->exclude('.github')
    ->exclude('cache')
    ->exclude('node_modules')
    ->exclude('vendor')
    ->ignoreDotFiles(false)
    ->ignoreVCS(true);

return (new \PhpCsFixer\Config())
    ->setFinder($finder)
    ->setRules($rules)
    ->setIndent('  ')
    ->setLineEnding("\n")
    ->setUsingCache(false);
